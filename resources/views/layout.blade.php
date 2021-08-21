<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset("css/app.css")}}">
</head>
<body class="antialiased">

@if (session('alert-success'))
    <div class="alert alert-success">
        {{ session('alert-success') }}
    </div>
@endif

@if (session('alert-danger'))
    <div class="alert alert-danger">
        {{ session('alert-danger') }}
    </div>
@endif

@if(count(config('app.languages')) > 1)
    <a class="language-switcher">
        @if (app()->getLocale() == 'lv')
            🇱🇻
        @endif
        @if (app()->getLocale() == 'en')
            🇺🇸
        @endif
        {{ strtoupper(app()->getLocale()) }}
    </a>
    <div class="language-menu">
        @foreach(config('app.languages') as $langLocale => $langName)
            <a href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ __('languages.' . $langName) }}</a>
        @endforeach
    </div>
@endif

@if(\Auth::check())
    <div class="admin-controls">
        <?php echo '👤 ' . __('content.logged_in_as') . ' <strong>' . \Auth::user()->name . '</strong>'; ?>
        <form action="/logout" method="post">
            @csrf
            <button>{{__('controls.log_out')}}</button>
        </form>
    </div>
@endif

@yield('content')

</body>
</html>
