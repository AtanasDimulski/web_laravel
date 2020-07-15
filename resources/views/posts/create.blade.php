@extends('layouts.main')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostApiController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','', ['class' => 'form-control','placeholder' => 'Title'])}}
        </div>

        <div class="form-group">
            {{Form::label('author','Author')}}
            {{Form::text('author','', ['class' => 'form-control','placeholder' => 'Name of writer'])}}
        </div>

        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body','', ['id' => 'article-ckeditor','class' => 'form-control','placeholder' => 'Main Blog Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('cover_image','Blog Image')}} <br>
            {{Form::file('cover_image')}}
        </div>
        <div class="form-group">
            {{Form::label('overview_image','Blog overview Image')}} <br>
            {{Form::file('overview_image')}}
        </div>
        {{Form::submit('Create',['class'=> 'btn btn-primary'])}}
    {!! Form::close() !!}﻿
@endsection
