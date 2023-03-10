@extends('layouts.app')

@section('content')

    <h3 style="max-width: 1024px; margin:auto; padding-bottom:20px">Cart</h3>
     <table class="table" id="userTable">
     
            <thead>
            <tr style="background-color: rgb(51, 51, 51); color:white">
                <th>No</th>
                <th colspan="3">Item Name</th>
                <th colspan="2">Price</th>
                <th colspan="2">Quantity</th>
                <th colspan="2">Sub Total</th>
                <th colspan="2">Delete</th>
            </tr>
            </thead>

            <tbody>

                @php
                    $grandTotal = 0;
                @endphp

                @forelse ($data as $dt)
                    <tr>
                        <th>{{ $loop->iteration}}</th>
                        <td colspan="3">{{ $dt->product->title}}</td>
                        <td colspan="2">{{ $dt->product->price}}</td>
                        <td colspan="2">{{ $dt->quantity}}</td>
                        <th colspan="2">{{ $dt->product->price * $dt->quantity}}</th>
                        <td colspan="2"> 
                            <a href="/cart/delete/{{$dt->id}}">
                            <button type="submit" class="btn btn-danger">
                                    {{ __('Delete') }}
                            </button>
                            </a>
                        </td>
                    </tr> 
                    
                    @php
                        $grandTotal += $dt->product->price * $dt->quantity;
                    @endphp

                @empty
                    <td id="datanotfound" colspan="12">No Product Has Been Added to Cart</td>
                @endforelse
            </tbody>      
    </table>

    <h5 style="max-width: 1024px; margin:auto; padding-bottom:10px; padding-top:20px">Grand Total: Rp.{{$grandTotal}},-</h5>
    <div style="max-width: 1024px; margin:auto;">
    <form action="/cart/checkout" method="post">
        @csrf
        <button type="submit" class="btn btn-primary" style="font-size: 18px">
                {{ __('Checkout') }}
        </button>
    </form>
    </div>
    
@endsection