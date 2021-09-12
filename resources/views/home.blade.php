@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @if (Auth::user()->hasRole('basic'))
                <div class="card-header">
                    <a class="btn btn-info">My feedbacks</a>
                </div>
            @endif
            @if (Auth::user()->hasRole('Admin'))
                <div class="card-header">
                    <a class="btn btn-info">Complaints</a>
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
	
			    <form @submit.prevent="postTicket">

                    <div> 
                        <div class="container fluid">
                            <textarea 
                                    rows="5%"
                                    cols="105%"
                                    name="input-7-1" 
                                >
                            </textarea>
                        </div> 
                    </div>
                    
			    </form> 
			</div> 
		</div>
        <div class="container mt-4">
 
            <h3 class="text-center">Upload pdf.</h3>
            
                <form class="text-center" method="POST" enctype="multipart/form-data" id="upload-file" action="{{ url('store') }}" >
                            
                    <div class="row">
            
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="file" name="file" placeholder="Choose file" id="file">
                                    @error('file')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                            
                        <div class="col-md-4 text-center mb-3" >
                            <button type="submit" class=" btn btn-block btn-primary ">submit</button>
                        </div> 
                    </div>     
                </form>
            </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection
