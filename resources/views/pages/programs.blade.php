@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Welcome to the programs area</h2>

    @if(count($programs) > 0)
        @foreach($programs as $program)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="/storage/programs_images/{{ $program -> photo }}" alt="Card image cap">
                <div class="card-body">
                <h5 class="card-title">{{$program -> name}}</h5>
                <p class="card-text">{!! $program -> description !!}.</p>
                <a href="#" class="btn btn-primary">Learn More</a>
                <a href="/programs/{{$program->id}}/edit" class="btn btn-success">Edit</a>
                {!!Form::open(['action' => ['AdminProgramsController@destroy', $program->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger mt-1'])}}
                {!!Form::close()!!}
                </div>
            </div>
        @endforeach
        {{$programs->links()}}
    @else
        <p class="text-danger">There are no programs found</p>
@endif
      <a href="/programs/create" class="btn btn-primary mt-5">Create New Program</a>

</div>
@endsection