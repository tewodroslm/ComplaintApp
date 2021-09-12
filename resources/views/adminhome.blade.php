@extends('layouts.app')

@section('content')
<div class="container">
    <div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">email</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto@gmail.com</td>
                <td>  
                     <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a> 
	            </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton@gmail.com</td>
                <td>  
                     <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a> 
	            </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>larry@gmail.com</td>
                <td>  
                     <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a> 
	            </td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
@endsection

