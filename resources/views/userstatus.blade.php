@extends('layouts.app')

@section('content')
<div class="container">
        <h1>Edit User Status</h1>
        <h2>Id      #{{ $user->id }}</h2>
        <h2>Name    {{ $user->name }}</h2>
        <h2>Email   {{ $user->email }}</h2>
        @if(!isset($user->active))
        <h2> Active Account</h2>
        @elseif($user->active === 'No')
        <h2> Account is suspended! </h2>
        @endif
        
        @can('user-edit')
        <a>
                {{ Form::open([ 'route' => 'disable-account' ]) }}
                {{ Form::hidden('id',  $user->id); }}
                {{ Form::submit('Disable', ['class' => 'btn btn-primary']); }}
                {{ Form::close() }}
        </a>                           
        @endcan
</div>
@endsection