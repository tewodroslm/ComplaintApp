@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Feedbacks</h2>
                </div>
                <div class="pull-right">
                    @can('complaint-create')
                    <a class="btn btn-success" href="{{ route('complaint.create') }}"> Create New feedback</a>
                    @endcan
                </div>
            </div>
        </div>


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
            @foreach ($complaints as $complaint)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $complaint->comment }}</td> 
                <td>                        
                    @can('complaint-edit')
                    <a class="btn btn-primary" href="{{ route('complaint.edit',$complaint->id) }}">Edit feedback</a>
                    @endcan

                    @can('user-edit')
                    <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">User Status</a>
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

