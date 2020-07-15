@extends('layouts.main')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'AdminController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('admin_code','Admin_code')}}
        {{Form::text('admin_code','', ['class' => 'form-control','placeholder' => 'Admin_code'])}}
    </div>

    <div class="form-group">
        {{Form::label('company_name','Company_name')}}
        {{Form::text('company_name','', ['class' => 'form-control','placeholder' => 'Company_name'])}}
    </div>
    {{Form::submit('Create',['class'=> 'btn btn-primary'])}}
    {!! Form::close() !!}﻿
@endsection
