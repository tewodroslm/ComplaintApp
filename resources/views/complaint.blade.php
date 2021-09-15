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
                    @if (Auth::user()->hasRole('basic'))
                    @if (Auth::user()->active !== 'No')
                    <div>
                        {{ Form::open([ 'route' => 'edit-complaint-form' ]) }}
                        {{ Form::hidden('id',  $complaint->id); }}
                        {{ Form::submit('Edit feedback',array('class' => 'btn btn-info')); }}
                        {{ Form::close() }} 
                    </div>
                    @elseif(Auth::user()->active === 'No')
                    <div>
                        <a class='btn btn-info'> Your account has been suspended</a>
                    </div>
                    @endif
                    @endif
                    @can('user-edit')
                    <a>
                        {{ Form::open([ 'route' => 'get-disable-account' ]) }}
                        {{ Form::hidden('id',  $complaint->id); }}
                        {{ Form::submit('User status', ['class' => 'btn btn-primary']); }}
                        {{ Form::close() }}
                    </a>
                    @endcan
                </td>
                <td>
                    {{ Form::open(array('url' => 'feedback')) }}
                    {{ Form::hidden('id',  $complaint->id); }}
                    {{ Form::submit('Show', ['class' => 'btn btn-primary']); }}
                    {{ Form::close() }} 
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="row">
            <div class="col-lg-6 margin-tb">
                <div class="pull-right">
                    @can('complaint-create')
                    <a class="btn btn-success" href="{{ route('getFeedbackPage') }}"> Create New feedback</a>
                    @endcan
                </div>
            </div>
            <div class="col-lg-6 margin-tb"> 
                    {!! $feedbacks->links() !!} 
            </div>
     </div>
    
</div>


@endsection

