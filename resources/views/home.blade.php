@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="productContainer" style="display: grid; grid-template-columns: repeat(3, 1fr); padding-bottom: 40px">
            @forelse ($product as $pd)
            
                    <div style="padding: 10px">
                    <img src="{{ Storage::url($pd->image) }}" alt="No Image" width="300px" height="200px"><br>
                        <h5 style="padding:0; margin:10px"> {{$pd->title}} </h5>
                        <p style="padding:0; margin:10px">{{$pd->description}}</p> 
                            @if (Auth::check())
                                @if ( Auth::user()->name == 'Admin' )
                                    <a href="/updateProduct/{{$pd->id}}">
                                    <button type="submit" class="btn btn-danger" style="width: 90%; margin:10px">
                                            {{ __('Update Product') }}
                                    </button>
                                    </a><br>
                                @endif  
                            @endif

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
    </div>
</div>
@endsection
