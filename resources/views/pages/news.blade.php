@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Welcome to the news area</h2>
    @if(count($news) > 0)
        @foreach($news as $new)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ $new -> photo }}" alt="Card image cap">
                <div class="card-body">
                <h5 class="card-title">{{$new -> subject}}</h5>
                <p class="card-text">{{$new -> venue}}.</p>
                <a href="#" class="btn btn-primary">Learn More</a>
                <a href="/news/{{$new->id}}/edit" class="btn btn-success">Edit</a>
                {!!Form::open(['action' => ['AdminNewsController@destroy', $new->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger mt-1'])}}
                {!!Form::close()!!}
                </div>
            </div>
        @endforeach
        {{$news->links()}}
    @else
        <p class="text-danger">There are no news found</p>
@endif
      <a href="news/create" class="btn btn-primary mt-5">Create New Item</a>

</div>
@endsection