@extends('layouts.app')

@section('content')
<div class="container">
    <div class="pull-left">
        <h2>Feedbacks</h2>
    </div>
    </br>
    <div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Feedback</th> 
                <th width="280px">Action</th>
            </tr>
            @foreach ($feedbacks as $complaint)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $complaint->comment }}</td> 
                <td>                        
                    @can('complaint-edit')
                    <a class="btn btn-primary">Edit feedback</a>
                    @endcan

                    @can('user-edit')
                    <a class="btn btn-primary">User Status</a>
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    @can('complaint-create')
                    <a class="btn btn-success" href="{{ route('getFeedbackPage') }}"> Create New feedback</a>
                    @endcan
                </div>
            </div>
        </div>
</div>
@endsection

