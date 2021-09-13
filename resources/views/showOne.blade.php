@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Feedback #{{ $feedback->id }}</h3> </br>
    <div class="d-flex justify-content-center">
       
        <div>
            {{ $feedback->comment }}
        </div>
        </br>
    </div>
    <div class="d-flex justify-content-center">
        <div>
           User id  #{{ $feedback->user_id }}
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ Form::open(array('url' => 'pdffile')) }}
        {{ Form::hidden('id',  $feedback->id); }}
        {{ Form::submit('Get File'); }}
        {{ Form::close() }} 
    </div>

</div>
@endsection

