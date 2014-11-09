@extends('layout')

@section('content')
    <h1>Login</h1>

    <!-- check for login error flash var -->
    @if (Session::has('flash_error'))
        <div id="flash_error">{{ Session::get('flash_error') }}</div>

    @endif

    {{ Form::open(array('url' => 'login', 'method' => 'post')) }}

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
    <p>
        {{ Form::checkbox('rememberme', 'Remember Me') }} Remember Me<br /><br />
        {{ Form::submit('Login') }}
    </p>

    {{ Form::close() }}

    <h3>{{ HTML::link(URL::route('create_user'), 'Create New Account') }}</h3>
@stop