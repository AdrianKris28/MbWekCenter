@extends('layouts.app')

@section('content')

    <h3 style="max-width: 1024px; margin:auto; padding-bottom:20px">Transaction</h3>
     <table class="table" id="userTable">
     
            <thead>
            <tr style="background-color: rgb(51, 51, 51); color:white">
                <th>No</th>
                <th colspan="5">Transaction Time</th>
                <th colspan="5">Detail Transaction</th>
            </tr>
            </thead>

            <tbody>

                @forelse ($data as $dt)
                    <tr>
                        <th>{{ $loop->iteration}}</th>
                        <td colspan="5">{{$dt->deleted_at}}</td>
                        <td colspan="5"> 
                            <a href="/transactionDetail/{{$dt->deleted_at}}">
                            <button type="submit" class="btn btn-primary">
                                    {{ __('Check Detail') }}
                            </button>
                            </a>
                        </td>
                  </tr>

                @empty
                    <td id="datanotfound" colspan="11">No Transaction Has Been Processed </td>
                @endforelse
            </tbody>      
    </table>
@endsection