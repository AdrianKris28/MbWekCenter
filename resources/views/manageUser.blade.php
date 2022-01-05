@extends('layouts.app')

@section('content')
     <table class="table" id="userTable">
            <thead>
            <tr>
                <th>User ID</th>
                <th colspan="2">Username</th>
            </tr>
            </thead>

            <tbody>
                @forelse ($data as $dt)
                    <tr>
                        <td>{{ $dt->id}}</td>
                        <td>{{ $dt->name}}</td>
                        <td> 
                            <a href="/manageUser/delete/{{$dt->id}}">
                            <button type="submit" class="btn btn-primary">
                                    {{ __('Delete') }}
                            </button>
                            </a>
                        </td>
                    </tr> 
                @empty
                    <td id="datanotfound" colspan="2">No User Has Registered</td>
                @endforelse
            </tbody>      
    </table>
@endsection