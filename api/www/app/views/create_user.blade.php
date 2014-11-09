@extends('layout')

@section('content')
    <h1>Create New User</h1>

    <!-- check for login error flash var -->
    @if (Session::has('flash_error'))
        <div id="flash_error">{{ Session::get('flash_error') }}</div>

    @endif

    {{ Form::open(array('url' => 'new/user', 'method' => 'post')) }}

    <!-- username field -->
    <p>
        {{ Form::label('username', 'Username') }}<br/>
        {{ Form::text('username', Input::old('username')) }}
    </p>

    <!-- password field -->
    <p>
        {{ Form::label('password', 'Password') }}<br/>
        {{ Form::password('password') }}
    </p>

    <!-- submit button -->
    <p>{{ Form::submit('Create User') }}</p>

    {{ Form::close() }}

    <h3>{{ HTML::link(URL::route('login'), 'Login') }}</h3>
@stop