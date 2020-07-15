@extends('layouts.app')

@section('content')
    <div>
        <a href="/posts" class="btn btn-primary">Go Back</a>
        @guest

        @else
            @can('admins-only',Auth::user())
                {!!Form::open(['action' => [ 'PostsController@destroy',$post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {!!Form::hidden('_method','DELETE')!!}
                {!!Form::submit('Delete',['class' => 'btn btn-danger'])!!}
                {!!Form::close()!!}

                <a href="/pdf/{{$post->id}}" class="btn btn-primary">Download</a>
                <a href="/posts/{{$post->id}}/edit" class="btn btn-warning float-right">Edit Post</a>
                <form action="{{ url('/api/apipost', ['id' => $post->id]) }}" method="post">
                    <input class="btn btn-danger" type="submit" value="ApiDelete" />
                    {!! method_field('delete') !!}
                    {!! csrf_field() !!}
                </form>
            @endcan
        @endguest

    </div>
    <section class="jumbotron text-white bg-dark text-center" style="width: 100%; height: 450px; background-repeat: no-repeat; background-size: 100% 100%; background-image: url('/storage/cover_images/{{$post->overview_image}}') ">
        <div class="container">
            <h1 class="jumbotron-heading">{{$post->title}}</h1>

            <p>
                <small>Written by {{$post->author}}</small>
            </p>
        </div>
    </section>

    <div class="row">
        <div class="col-sm-8">
            <section class="jumbotron text-center" style="width: 100%; height: 350px; background-repeat: no-repeat; background-size: 100% 100%; background-image: url('/storage/cover_images/{{$post->cover_image}}') ">
                <div class="container">
                </div>
            </section>

            <p>{!! $post->body!!}</p>
        </div>

        <div class="col-sm-4">
            @guest
                <div class="align-content-center">
                    <p class="text-center"><strong>Create an account to post a comment</strong> <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a></p>
                </div>
            @else
                <h5 class="text-center">Add Comment</h5>
                <div class="row">
                    {!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('qoute','Comment:')}}
                        {{Form::text('qoute','', ['class' => 'form-control','placeholder' => 'Place comment here.....'])}}
                        {{Form::hidden('post_id',$post->id, ['class' => 'form-control','placeholder' => 'Place comment here.....'])}}
                        <small id="emailHelp" class="form-text text-muted">Note!!!!! Once posted its visible till deleted.</small>
                    </div>
                    {{Form::submit('Post Comment',['class'=> 'btn btn-primary'])}}
                    {!! Form::close() !!}﻿
                    <br>
                    <br>
                </div>
            @endguest
            <h3 class="text-center">Comments</h3>

            <div class="row">
                @if(count($comments) >= 1)
                    @foreach($comments as $comment)
                    @if($comment->post_id == $post->id)
                    <div class="col-sm-12">
                       <div class="row">
                           <div class="col-sm-4">
                               <img  src="/storage/profile_pictures/{{$comment->comment_picture}}" style="width: 50px; height: 50px; float: right; border-radius: 50%;" >
                           </div>
                           <div class="col-sm-8">
                               <p>{{$comment->qoute}}</p>
                               <div>
                                   <p><small class="float-left">{{$comment->comment_name}}</small> <small class="float-right">{{$comment->created_at}}</small></p>
                               </div>

                           </div>
                       </div>

                    </div>
                    @else
                    @endif
                    @endforeach
                        <div class="col-sm-12">
                            <p class="text-center">No more comments to show</p>
                        </div>

                @else
                    <p>No comments to show at the moment</p>
                @endif
            </div>

        </div>
    </div>
@endsection
