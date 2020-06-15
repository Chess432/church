@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Welcome to the sermons area</h2>

    {!! Form::open(['action' => 'AdminSermonController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    <div class="form-group row">
        {{Form::label('subject', 'Subject', ['class' => 'col-sm-2 col-form-label'])}}
            <div class="col-sm-10">
                {{Form::text('subject', '', ['class' => 'form-control', 'placeholder' => 'subject'])}}
            </div>
    </div>

    <div class="form-group row">
        {{Form::label('text', 'Text', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::text('text', '', ['class' => 'form-control', 'value' => '1', 'placeholder' => 'Bible book, chapter, verse(s)'])}}
        </div>
    </div>

    <div class="form-group row">
        {{Form::label('speaker', 'Speaker', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::text('speaker', '', ['class' => 'form-control', 'value' => '1', 'placeholder' => 'speaker'])}}
        </div>
    </div>
    
    <div class="form-group row">
        {{Form::label('date', 'Date', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::date('date', '', ['class' => 'form-control', 'placeholder' => 'Event date'])}}
        </div>
    </div>
  
    
    <div class="form-group row">
        {{Form::label('scripture', 'Scripture', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::textarea('scripture', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Scripture'])}}
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