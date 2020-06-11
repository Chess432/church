@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Welcome to the admin area</h2>
    @guest
    <h2>Please <a href="/login"> Login </a> to access panel</h2>
    @endguest
</div>
@endsection