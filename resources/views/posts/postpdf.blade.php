@extends('layouts.app')

@section('content')

<div>
    <h1>{{$post->title}}</h1>
    <small>Written by {{$post->author}}</small>
    <h3>Post Blog</h3>
    <p>{{$post->body}}</p>
</div>

<div>
    <br>
    <br>
    <h1>Comments</h1>
    @if(count($comments) >= 1)
        <ul class="">
        @foreach($comments as $comment)
            @if($comment->post_id == $post->id)
                <li class="">
                    <p>{{$comment->qoute}}</p>
                    <div>
                        <p><small class="float-left">{{$comment->comment_name}}</small> <small class="float-right">{{$comment->created_at}}</small></p>
                    </div>
                </li>
            @else
            @endif
        @endforeach
        </ul>
        <p><strong>No comments to show.</strong></p>
    @else
        <p><strong>No comments to show.</strong></p>
    @endif
</div>
@endsection
