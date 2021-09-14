@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @if (Auth::user()->hasRole('basic'))
                <div class="card-header">
                    <a class="btn btn-info" href="{{ route('all-complaints') }}">My feedbacks</a>
                </div>
            @endif
            @if (Auth::user()->hasRole('Admin'))
                <div class="card-header">
                    <a class="btn btn-info" href="{{ route('admin-all-complaints') }}">Feedbacks</a>
                </div>
            @endif
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
            <div>
		<div class="myform form ">
			<div class="logo mb-3">
				<div class="col-md-12 text-center">
					<h1>Create Your ticket here.</h1>
				</div>
			</div>

            @if(!isset($complaint))
            <form action="{{route('createFeedback')}}" enctype="multipart/form-data" method="POST">
            @else
            <form action="{{route('update-complaint')}}" enctype="multipart/form-data" method="POST">             
            @endif
                       @csrf
                <div class="row">
                    <div class="col-md-12">
                       
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $username ?? '' }}" required>
                        </div>
                            
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $useremail ?? '' }}" required>
                        </div>
                       
                        <div class="form-group">
                            <label>Feed back</label> 
                            <textarea 
                                    rows="5%"
                                    cols="105%"
                                    name="comment"  
                                    require
                                >
                                {{ $complaint->comment ?? '' }}
                            </textarea>
                        </div>
            
                        <div class="form-group">
                            <input type="file" name="file" placeholder="Choose file" id="file">
                                @error('file')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                        <input type="hidden" name="complaintid" value="{{ $complaint->id ?? ''  }}">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </div>     
            </form>
	 
			</div> 
		</div>
         
    </div> 
</div>
@endsection
