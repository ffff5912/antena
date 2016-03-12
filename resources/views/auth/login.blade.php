@extends('layout')

@section('content')
<form method="POST" action="/login">
    {!! csrf_field() !!}

    <div>
        Name
        <input type="text" name="username" value="{{ isset($username) ? $username : '' }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>
@stop
