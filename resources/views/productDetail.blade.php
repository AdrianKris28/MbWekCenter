@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
    @forelse ($data as $dt)
    <div style="display: flex">
        <div class="left-section" style="padding-right:30px">
        <img src="{{ Storage::url($dt->image) }}" alt="No Image" width="500px" height="400px">
        </div>

        <div class="right-section" style="max-width: 500px">
            <h3>{{$dt->title}}</h4>
            <h5>Description : </h5>
            <table style="border: solid 1px rgb(124, 124, 124); width:500px">
                <tr>
                    <td><p>{{$dt->description}}</p></td>
                </tr>
            </table>
            <h5 style="margin-top: 10px">Stock :</h5>
            <p>{{$dt->stock}} piece(s)</p>
            <h5>Price :</h5>
            <p>Rp. {{$dt->price}},-</p>

            @if ( Auth::user()->name != 'Admin' )
            <br>
                <h5>Add To Cart</h5>
                <div class="quantity" style="display: flex">
                    <p>Quantity :</p>
                    <form action="route{{ 'home' }}" method="POST" style="margin-left: 15px">
                        @csrf
                        <input type="number" name="quantity" id="quantity" style="border: solid 1px rgb(124, 124, 124); width:422px">
                         <br>
                        <input type="hidden" name="productId" value="{{$dt->id}}">
                        
                        <a href="/addToCart">
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px; width:200px">
                                        {{ __('Submit') }}
                            </button>
                        </a>
                    </form>
                </div>



            @endif

        </div>

    </div>
    @empty
        
    @endforelse
    </div>
@endsection