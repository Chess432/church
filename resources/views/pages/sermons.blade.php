@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Welcome to the sermons area</h2>

    @if(count($sermons) > 0)
    @foreach($sermons as $sermon)
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="/storage/sermons_images/{{ $sermon -> image }}" alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">{{$sermon -> subject}}</h5>
            <p class="card-text">{!! $sermon -> text !!}.</p>
            <p class="card-text">{!! $sermon -> Speaker !!}.</p>
            <a href="#" class="btn btn-primary">Learn More</a>
            <a href="/sermons/{{$sermon->id}}/edit" class="btn btn-success">Edit</a>
                {!!Form::open(['action' => ['AdminSermonController@destroy', $sermon->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger mt-1'])}}
                {!!Form::close()!!}
            </div>
        </div>
    @endforeach
    {{$sermons->links()}}
@else
    <p class="text-danger">There are no sermons found</p>
@endif
  <a href="sermons/create" class="btn btn-primary mt-5">Create New Sermon</a>

</div>
@endsection