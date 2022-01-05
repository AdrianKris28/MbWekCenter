<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

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
        return view('updateProduct', compact('data'));
    }

    public function updateProd(Request $req)
    {
        // dd($req);

        $validatedData = $req->validate([
            'category' => ['required'],
            'title' => ['required', 'string', 'min:5', 'max:25'],
            'description' => ['required', 'string', 'min:10', 'max:100'],
            'price' => ['required', 'integer', 'gte:1000', 'lte:10000000'],
            'stock' => ['required', 'integer', 'gte:1'],
            'image' => ['required', 'file'],
        ]);

        $image = $req->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imageLocation = 'images/' . $imageName;
        Storage::putFileAs('public/images', $image, $imageName);

        Product::where('product.id', '=', $req['productId'])
            ->update([
                'category' => $validatedData['category'],
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'stock' => $validatedData['stock'],
                'image' => $imageLocation,
            ]);

        return redirect('updateProduct');
    }

    public function insertProduct()
    {
        return view('insertProduct');
    }

    public function insertProd(Request $req)
    {
        $validatedData = $req->validate([
            'category' => ['required'],
            'title' => ['required', 'string', 'min:5', 'max:25'],
            'description' => ['required', 'string', 'min:10', 'max:100'],
            'price' => ['required', 'integer', 'gte:1000', 'lte:10000000'],
            'stock' => ['required', 'integer', 'gte:1'],
            'image' => ['required', 'file'],
        ]);

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

    public function profileUpdate()
    {
        return view('updateprofile');
    }

    public function updateprof(Request $req)
    {
        // dd($req);
        User::where('users.id', '=', Auth::user()->id)
            ->update([
                'name' => $req['name'],
                'password' => Hash::make($req['password']),
                'gender' => $req['gender'],
            ]);

        return redirect('updateprofile');
    }

    public function detailProduct($id)
    {
        $data = Product::where('product.id', '=', $id)->get();
        return view('productDetail', compact('data'));
    }

    public function addCartProduct(Request $req)
    {
        // dd($req);
        $data = Product::where('product.id', '=', $req['productId'])->get();
        // $validatedData = $req->validate([
        //     'quantity' => ['required', 'integer', 'lte'],
        // ]);
        Transaction::create([
            'product_id' => $data['id'],
            'quantity' => $req['quantity'],
        ]);

        return redirect('productDetail');
    }
}
