@extends('layouts.app')

@section('content')
    <div>
        <a href="/posts" class="btn btn-primary">Go Back</a>
    </div>
{{--    <section class="jumbotron text-white bg-dark text-center">--}}
{{--        <div class="container">--}}
{{--            <h1 class="jumbotron-heading">{{Auth::user()->email}}</h1>--}}
{{--            <p class="lead text-muted">ADMIN</p>--}}
{{--            <p>--}}
{{--                <small>ADMIN, {{Auth::user()->name}}</small>--}}
{{--            </p>--}}
{{--        </div>--}}
{{--    </section>--}}


    <div class="row">
        <div class="col-md-12">

            <div class="container">
                <img id="profile_picture" src="/storage/profile_pictures/{{$user->profile_picture }}" style="width: 150px; height: 150px; float: left;  margin-right: 25px;" onmouseover="this.src='/storage/profile_pictures/pixel{{$user->profile_picture }}'"
                onmouseout="this.src='/storage/profile_pictures/{{$user->profile_picture }}'">
            </div>
            <h2>{{$user->name}}'s Profile</h2>

        </div>

    </div>
    <div class="row">
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
                                                {!!Form::open(['action' => [ 'HomeController@destroy',$comment->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                                {{Form::hidden('type',2, ['class' => 'form-control','placeholder' => 'Place comment here.....'])}}
                                                {!!Form::hidden('_method','DELETE')!!}
                                                {!!Form::submit('Delete',['class' => 'btn btn-danger'])!!}
                                                {!!Form::close()!!}
                                            </div>
                                        </div>

                                    </li>

                            @endforeach
                        </ul>
                    @else
                        <div>
                            <p>User has posted no comments</p>
                        </div>
                    @endif

                </div>

            </div>

        </div>
        <div class="col-sm-4">

            <div class="card">
                <div class="card-header bg-dark text-light text-center"><h4>Info</h4></div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">ID: </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="nameHelp" placeholder="{{{Auth::user()->id}}}" readonly>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your ID with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name: </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="nameHelp" placeholder="{{{Auth::user()->name}}}" readonly>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{{Auth::user()->email}}}" readonly>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-sm-4">
            {!!Form::open(['action' => [ 'HomeController@destroy',Auth::user()->id], 'method' => 'POST', 'class' => 'float-md-right'])!!}
            {{Form::hidden('type',1, ['class' => 'form-control','placeholder' => 'Place comment here.....'])}}
            {!!Form::hidden('_method','DELETE')!!}
            {!!Form::submit('Delete',['class' => 'btn btn-danger'])!!}
            {!!Form::close()!!}

            <a href="/profile/{{Auth::user()->id}}/edit" class="btn btn-warning float-md-left">Edit Profile</a>
        </div>
    </div>

<script>
    $(function(){
        $("#profile_picture").on({
            mouseenter: function(){
                $(this).attr('src','http://www.clker.com/cliparts/d/3/R/P/q/e/hot-pink-home-icon-md.png');
            },
            mouseleave: function(){
                $(this).attr('src','http://openclipart.org/image/800px/svg_to_png/17103/claudita_home_icon.png');
            }
        });

    });
</script>

@endsection
