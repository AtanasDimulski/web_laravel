@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-light text-center">
                    <h3>Dashboard
                        <a href="admin/create" class="btn btn-primary float-right">Add code</a>
                    </h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Administration panel:
                            <div class="row">
                                <div class="col-sm-5">
                                    <p><strong>Admin Code</strong></p>
                                </div>
                                <div class="col-sm-7">
                                    <p><strong>Company/Oraganisation name</strong></p>
                                </div>
                            </div>
                            <div class="row">
                                @if(count($adminCodes) >=1)
                                    @foreach($adminCodes as $code)
                                        <div class="col-sm-4">
                                            <p>{{$code->admin_code}}</p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p>{{$code->company_name}}</p>
                                        </div>
                                        <div class="col-sm-4">
                                            {!!Form::open(['action' => [ 'AdminController@destroy',$code->id,4], 'method' => 'POST', 'class' => 'float-right'])!!}
                                            {{Form::hidden('type',4, ['class' => 'form-control','placeholder' => 'Place comment here.....'])}}
                                            {!!Form::hidden('_method','DELETE')!!}
                                            {!!Form::submit('Delete',['class' => 'btn btn-danger'])!!}
                                            {!!Form::close()!!}

                                            <a href="/admin/{{$code->id}}/edit" class="btn btn-warning float-right">Edit Code</a>
                                        </div>

                                    @endforeach
                                @endif
                            </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <br>
        <div class="card">
            <div class="card-header bg-dark text-light text-center">
                <h3>Export panel</h3>
            </div>
            <div class="card-body">
                <div class="row">
                     <div class="col-sm-6 text-right">
                        <p>Export all users to excel file</p>
                     </div>
                     <div class="col-sm-6">
                         <a href="/excel" class="btn btn-primary">Download</a>
                     </div>
                </div>

                <div class="row">
                    <div class="col-sm-8">

                    </div>
                    <div class="col-sm-4">

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<div>
    <br>
</div>

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-4">

            <div class="card">
                <div class="card-header bg-dark text-light text-center"><h4>Posts</h4></div>
                <div class="card-body">
                    @if(count($posts) >= 1)
                        <ul class="list-group-flush">
                            @foreach($posts as $post)
                                <li class="list-group-item container-fluid">

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>{{$post->title}}</p>
                                            <small>{{$post->created_at}}</small>
                                        </div>
                                        <div class="col-sm-4">
                                            {!!Form::open(['action' => [ 'AdminController@destroy',$code->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                            {{Form::hidden('type',1, ['class' => 'form-control','placeholder' => 'Place comment here.....'])}}
                                            {{Form::hidden('post_id',$post->id, ['class' => 'form-control','placeholder' => 'Place comment here.....'])}}
                                            {!!Form::hidden('_method','DELETE')!!}
                                            {!!Form::submit('Delete',['class' => 'btn btn-danger'])!!}
                                            {!!Form::close()!!}


                                        </div>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>

        <div class="col-sm-4">

            <div class="card">
                <div class="card-header bg-dark text-light text-center"><h4>Comments</h4></div>
                <div class="card-body">

                    @if(count($comments) >= 1)
                        <ul class="list-group-flush">
                            @foreach($comments as $comment)
                                <li class="list-group-item container-fluid">

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>{{$comment->qoute}}</p>
                                            <small>{{$comment->comment_name}}</small>
                                            <small>{{$comment->created_at}}</small>
                                        </div>
                                        <div class="col-sm-4">
                                            {!!Form::open(['action' => [ 'AdminController@destroy',$code->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                            {{Form::hidden('type',2, ['class' => 'form-control','placeholder' => 'Place comment here.....'])}}
                                            {{Form::hidden('comment_id',$comment->id, ['class' => 'form-control','placeholder' => 'Place comment here.....'])}}
                                            {!!Form::hidden('_method','DELETE')!!}
                                            {!!Form::submit('Delete',['class' => 'btn btn-danger'])!!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>

            </div>

        </div>

        <div class="col-sm-4">

            <div class="card">
                <div class="card-header bg-dark text-light text-center"><h4>Users</h4></div>
                <div class="card-body">
                    @if(count($comments) >= 1)
                        <ul class="list-group-flush">
                            @foreach($users as $user)
                                <li class="list-group-item container-fluid">

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p><strong>ID:</strong> {{$user->id}}</p>
                                            <p><strong>Name:</strong> {{$user->name}}</p>
                                            <p><strong>Email:</strong> {{$user->email}}</p>
                                            <small class="">{{$comment->created_at}}</small>
                                        </div>
                                        <div class="col-sm-4">
                                            {!!Form::open(['action' => [ 'AdminController@destroy',$code->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                            {{Form::hidden('type',3, ['class' => 'form-control','placeholder' => 'Place comment here.....'])}}
                                            {{Form::hidden('user_id',$user->id, ['class' => 'form-control','placeholder' => 'Place comment here.....'])}}
                                            {!!Form::hidden('_method','DELETE')!!}
                                            {!!Form::submit('Delete',['class' => 'btn btn-danger'])!!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
