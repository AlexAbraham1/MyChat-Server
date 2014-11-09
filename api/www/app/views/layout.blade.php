<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>MyChat</title>
    {{ HTML::style('/css/style.css') }}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
    <div id="container">
        <div id="nav">
            <ul>
                <li>{{ HTML::link(URL::route('home'), 'Home') }}</li>
                @if(Auth::check())
                    <li>{{ HTML::link(URL::route('me'), 'Messages' ) }}</li>
                    <li>{{ HTML::link(URL::route('logout'), 'Logout ('.Auth::user()->username.')') }}</li>
                @else
                    <li>{{ HTML::link(URL::route('login'), 'Login') }}</li>
                @endif
            </ul>
        </div><!-- end nav -->

        <!-- check for flash notification message -->
        @if(Session::has('flash_notice'))
            <div id="flash_notice">{{ Session::get('flash_notice') }}</div>
        @endif

        @yield('content')
    </div><!-- end container -->
</body>
</html>