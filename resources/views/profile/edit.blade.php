@extends('layouts.main')

@section('content')
    <h1>Edit Profile</h1>
    <div class="row">
        <div class="col-sm-4">
            <section class="jumbotron text-center" style="width: 100%; height: 225px; background-repeat: no-repeat; background-size: 100% 100%; background-image: url('/storage/profile_pictures/{{$post->profile_picture}}') ">
                <div class="container">
                    <h1 class="jumbotron-heading text-light">Update profile picture</h1>
                </div>
            </section>
        </div>
    </div>
    {!! Form::open(['action' => ['HomeController@update',Auth::user()->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('profile_picture','Profile picture')}} <br>
        {{Form::file('profile_picture')}}
    </div>

    <div class="form-group">
        {{Form::label('name','Name')}}
        {{Form::text('name',Auth::user()->name, ['class' => 'form-control','placeholder' => 'Name'])}}
    </div>

    <div class="form-group">
        {{Form::label('email','Email')}}
        {{Form::text('email',Auth::user()->email, ['class' => 'form-control','placeholder' => 'Email Address'])}}
    </div>

    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Update',['class'=> 'btn btn-primary'])}}
    {!! Form::close() !!}﻿
@endsection
