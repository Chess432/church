@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Welcome to the news update area</h2>

    {!! Form::open(['action' => ['AdminNewsController@update', $news->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    <div class="form-group row">
        {{Form::label('subject', 'Subject', ['class' => 'col-sm-2 col-form-label'])}}
            <div class="col-sm-10">
                {{Form::text('subject', $news->subject, ['class' => 'form-control', 'placeholder' => 'subject'])}}
            </div>
    </div>
    
    <div class="form-group row">
        {{Form::label('date', 'Date', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::date('date', $news->date, ['class' => 'form-control', 'placeholder' => 'Event date'])}}
        </div>
    </div>
  
    <div class="form-group row">
        {{Form::label('venue', 'Venue', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::text('venue', $news->venue, ['class' => 'form-control', 'value' => '1', 'placeholder' => 'venue'])}}
        </div>
    </div>
    <div class="form-group row">
        {{Form::label('description', 'Description', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::textarea('description', $news->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description'])}}
        </div>
    </div>
    <div class="form-group row">
        {{Form::label('photo', 'Photo', ['class' => 'col-sm-2 col-form-label'])}}
        <div class="col-sm-10">
            {{Form::file('cover_image')}}
        </div>
    </div>    

    {{Form::hidden('_method', 'PUT')}}
    
    {{Form::submit('submit', ['class' => 'btn btn-success btn-lg'])}}
    <a href="/news" class="btn btn-primary btn-lg ml-5">Back</a>
   
{!! Form::close() !!}
</div>
@endsection