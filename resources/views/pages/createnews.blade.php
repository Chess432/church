@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Welcome to the news area</h2>

    {!! Form::open(['action' => 'AdminNewsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    <div class="form-group row">
        {{Form::label('subject', 'Subject', ['class' => 'col-sm-2 col-form-label'])}}
            <div class="col-sm-10">
                {{Form::text('subject', '', ['class' => 'form-control', 'placeholder' => 'subject'])}}
            </div>
    </div>
    
    <div class="form-group row">
        {{Form::label('date', 'Date', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::date('date', '', ['class' => 'form-control', 'placeholder' => 'Event date'])}}
        </div>
    </div>
  
    <div class="form-group row">
        {{Form::label('venue', 'Venue', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::text('venue', '', ['class' => 'form-control', 'value' => '1', 'placeholder' => 'venue'])}}
        </div>
    </div>
    <div class="form-group row">
        {{Form::label('description', 'Description', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description'])}}
        </div>
    </div>
    <div class="form-group row">
        {{Form::label('photo', 'Photo', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::file('cover_image')}}
        </div>
    </div>    
    {{Form::submit('submit', ['class' => 'btn btn-success btn-lg'])}}
    <a href="/news" class="btn btn-primary btn-lg ml-5">Back</a>
   
{!! Form::close() !!}
</div>
@endsection