<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use NunoMaduro\Collision\Adapters\Laravel\Exceptions\RequirementsException;

class PageController extends Controller
{
    // public function login(Request $req)
    // {
    //     $credential = [
    //         'email' => $req->email,
    //         'password' => $req->password,
    //     ];

    //     // dd($credential);

    //     if (Auth::attempt($credential)) {
    //         return redirect('/home');
    //     }

    //     return redirect('/viewLoginPage');
    // }

    public function home()
    {
        $product = Product::all();
        // ->paginate(5);
        return view('home', compact('product'));
    }

    public function viewUser()
    {
        $data = User::where('name', '!=', 'Admin')->get();
        return view('manageUser', compact('data'));
    }

    public function deleteUser($id)
    {
        // dd();
        User::where('id', '=', $id)->delete();
        return redirect('manageUser');
    }

    public function updateProduct($id)
    {
        $data = Product::where('product.id', '=', $id)->get();
        // dd($data);
        return view('updateProduct', compact('data'));
    }

    public function updateProd(Request $req)
    {
        // dd($req);

        $imageLocation = $req['imageOld'];

        $validatedData = $req->validate([
            'category' => ['required'],
            'title' => ['required', 'string', 'min:5', 'max:25'],
            'description' => ['required', 'string', 'min:10', 'max:100'],
            'price' => ['required', 'integer', 'gte:1000', 'lte:10000000'],
            'stock' => ['required', 'integer', 'gte:1'],
            'image' => ['file'],
        ]);

        if ($req->file('image') != null) {
            $image = $req->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imageLocation = 'images/' . $imageName;
            Storage::putFileAs('public/images', $image, $imageName);
        }

        Product::where('product.id', '=', $req['productId'])
            ->update([
                'category' => $validatedData['category'],
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'stock' => $validatedData['stock'],
                'image' => $imageLocation,
            ]);

        return redirect('home');
    }

    public function insertProduct()
    {
        return view('insertProduct');
    }

    public function insertProd(Request $req)
    {
        // dd($req->file('image'));
        $validatedData = $req->validate([
            'category' => ['required'],
            'title' => ['required', 'string', 'min:5', 'max:25'],
            'description' => ['required', 'string', 'min:10', 'max:100'],
            'price' => ['required', 'integer', 'gte:1000', 'lte:10000000'],
            'stock' => ['required', 'integer', 'gte:1'],
            'image' => ['required', 'file'],
        ]);


        //Connect storage
        // php artisan storage::link

        $image = $req->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imageLocation = 'images/' . $imageName;
        Storage::putFileAs('public/images', $image, $imageName);
        Product::create([
            'category' => $validatedData['category'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'image' => $imageLocation,
        ]);
        return redirect('insertProduct');
    }

    public function searchProduct()
    {
        $product = Product::paginate(6);
        return view('searchProduct', compact('product'));
        // return view('searchProduct', ['product' => $product]);
    }

    public function searchButton(Request $req)
    {
        $query = $req['query'];
        $category = $req['category'];
        $product = Product::where('product.category', '=', $category)->where('product.title', 'LIKE', "%$query%")->paginate(6);

        return view('searchClicked', compact('product'));
    }

    public function profileUpdate()
    {
        return view('updateprofile');
    }

    public function updateprof(Request $req)
    {
        // dd($req);
        $req->validate([
            'name' => ['required', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['required', 'string'],
        ]);

        User::where('users.id', '=', Auth::user()->id)
            ->update([
                'name' => $req['name'],
                'password' => Hash::make($req['password']),
                'gender' => $req['gender'],
            ]);

        return redirect('home');
    }

    public function detailProduct($id)
    {
        $data = Product::where('product.id', '=', $id)->get();
        return view('productDetail', compact('data'));
    }

    public function addCartProduct(Request $req)
    {
        // dd($req);
        // $data = Product::where('product.id', '=', $req['productId'])->get();

        $req->validate([
            'quantity' => ['required', 'integer', 'lte:' . $req['stock'], 'gte:1'],
        ]);

        Transaction::create([
            'product_id' => $req['productId'],
            'quantity' => $req['quantity'],
            'user_id' => Auth::user()->id,
        ]);

        $id = $req['productId'];

        return redirect('productDetail/' . $id);
    }

    public function viewCart()
    {
        $data = Transaction::where('transaction.user_id', '=', Auth::user()->id)->get();
        return view('cart', compact('data'));
    }

    public function deleteCart($id)
    {
        Transaction::where('transaction.id', '=', $id)->forceDelete();
        return redirect('cart');
    }

    public function checkoutCart()
    {

        $totalQuantity = Transaction::select('transaction.product_id', DB::raw('SUM(quantity) as totalquantity'), 'product.stock')
            ->where('transaction.user_id', '=', Auth::user()->id)->join('product', 'transaction.product_id', '=', 'product.id')
            ->groupBy(['product_id', 'stock'])->get(['product_id', 'totalquantity', 'stock']);

        foreach ($totalQuantity as $tq) {

            $temp = Transaction::select('transaction.product_id', DB::raw('SUM(quantity) as totalquantity'), 'product.stock')
                ->where('transaction.user_id', '=', Auth::user()->id)
                ->where('transaction.product_id', '=', $tq['product_id'])
                ->join('product', 'transaction.product_id', '=', 'product.id')
                ->groupBy(['product_id', 'stock'])->get(['product_id', 'totalquantity', 'stock'])->first();


            if ($temp['stock'] - $temp['totalquantity'] < 0) {
                Product::where('product.id', '=', $tq['product_id'])
                    ->update([
                        'stock' => 0,
                    ]);
            } else {
                Product::where('product.id', '=', $tq['product_id'])
                    ->update([
                        'stock' => DB::raw($tq['stock'] - $tq['totalquantity']),
                    ]);
            }

            Transaction::where('transaction.user_id', '=', Auth::user()->id)
                ->where('transaction.product_id', '=', $tq['product_id'])
                ->delete();
        }
        // dd($value);

        return redirect('transaction');
    }

    public function transaction()
    {
        $data = Transaction::groupby(['user_id', 'deleted_at'])->onlyTrashed()->get(['user_id', 'deleted_at']);
        // dd($data);
        return view('transaction', ['data' => $data]);
    }

    public function detailTransaction($deleted_at)
    {
        $data = Transaction::join('product', 'transaction.product_id', '=', 'product.id')
            ->where('transaction.deleted_at', '=', $deleted_at)->onlyTrashed()->get();
        // dd($data);
        return view('detailTransaction', ['data' => $data]);
    }
}
