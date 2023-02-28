@extends('layouts.app')

@section('content')

    <h3 style="max-width: 1024px; margin:auto; padding-bottom:20px">Transaction Detail</h3>
     <table class="table" id="userTable">
     
            <thead>
            <tr style="background-color: rgb(51, 51, 51); color:white">
                <th>No</th>
                <th colspan="3">Item Name</th>
                <th colspan="2">Item Detail</th>
                <th colspan="2">Price</th>
                <th colspan="2">Quantity</th>
                <th colspan="2">Sub Total</th>
            </tr>
            </thead>

            <tbody>

                @php
                    $grandTotal = 0;
                @endphp

                @foreach ($data as $dt)
                    <tr>
                        <th>{{ $loop->iteration}}</th>
                        <td colspan="3">{{ $dt->title}}</td>
                        <td colspan="2">{{ $dt->description}}</td>
                        <td colspan="2">{{ $dt->price}}</td>
                        <td colspan="2">{{ $dt->quantity}}</td>
                        <th colspan="2">{{ $dt->product->price * $dt->quantity}}</th>

                    </tr> 
                    
                    @php
                        $grandTotal += $dt->product->price * $dt->quantity;
                    @endphp

                @endforeach
            </tbody>      
    </table>

    <h5 style="max-width: 1024px; margin:auto; padding-bottom:10px; padding-top:20px">Grand Total: Rp.{{$grandTotal}},-</h5>
    
@endsection