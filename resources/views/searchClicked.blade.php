@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
       
        <form action="/searchProduct/searchButton" method="get">
            <table>
                <td>
                    <h5>Search: </h5>
                </td>
                <td>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}" required autocomplete="category" autofocus>
                                            <option value="Animal">Animal</option>
                                            <option value="Food & Beverages">Food & Beverages</option>
                                            <option value="Furniture">Furniture</option>
                    </select>
                </td>

                <td>
                    <input type="text" placeholder="Search.." name="query" style="width:570px">
                </td>

                <td>
                <button type="submit" class="btn btn-primary" style="width: 100px">
                                        {{ __('Search') }}
                </button>
                </td>
            
            </table>
        </form>
        <div class="productContainer" style="display: grid; grid-template-columns: repeat(3, 1fr); padding-bottom: 40px">

            @forelse ($product as $pd)
            
                    <div style="padding: 10px">
                    <img src="{{ Storage::url($pd->image) }}" alt="No Image" width="300px" height="200px"><br>
                        <h5 style="padding:0; margin:10px"> {{$pd->title}} </h5>
                        <p style="padding:0; margin:10px">{{$pd->description}}</p> 
                        {{-- @if (Auth::check()) --}}

                            {{-- @if ( Auth::user()->name == 'Admin' )
                                <a href="/updateProduct/{{$pd->id}}">
                                <button type="submit" class="btn btn-danger" style="width: 90%; margin:10px">
                                        {{ __('Update Product') }}
                                </button>
                                </a><br>
                            @endif --}}
                            
                        {{-- @endif --}}

                            <a href="/productDetail/{{$pd->id}}">
                                <button type="submit" class="btn btn-primary" style="width: 90%; margin:10px">
                                    {{ __('Product Detail') }}
                                </button>
                        </a>
                        
                    </div>
                
            @empty
                <h1 style="margin-top: 30px"> There is no product yet </h1>
            @endforelse
        </div>
        {{-- {!! $product->render() !!} --}}

    </div>
         {{$product->links()}}
</div>
@endsection
