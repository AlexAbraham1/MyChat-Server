@extends('layout')

@section('content')
    <h1>Home page</h1>
    <p>Current time: {{ date('F j, Y, g:i A') }}  </p>

    @if(Auth::check())
        <p>Current User: "{{ Auth::user()->username }}"</p>
    @else
        <p>CLICK {{HTML::link(URL::route('login'), 'HERE')}} TO LOGIN</p>
    @endif
@stop