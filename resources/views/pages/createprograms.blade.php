@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Welcome to the Programs area</h2>

    {!! Form::open(['action' => 'AdminProgramsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    <div class="form-group row">
        {{Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label'])}}
            <div class="col-sm-10">
                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Program name'])}}
            </div>
    </div>
    
    <div class="form-group row">
        {{Form::label('description', 'Description', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'description'])}}
        </div>
    </div>
    <div class="form-group row">
        {{Form::label('photo', 'Photo', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::file('cover_image')}}
        </div>
    </div>    
    {{Form::submit('submit', ['class' => 'btn btn-success btn-lg'])}}
    <a href="/programs" class="btn btn-primary btn-lg ml-5">Back</a>
   
{!! Form::close() !!}
</div>
@endsection