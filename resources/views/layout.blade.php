<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset("css/app.css")}}">
</head>
<body class="antialiased">

@if (session('alert'))
    <div class="alert-success">
        {{ session('alert') }}
    </div>
@endif

@if(count(config('app.languages')) > 1)
    <a class="language-switcher">
        {{ strtoupper(app()->getLocale()) }}
    </a>
    <div class="language-menu">
        @foreach(config('app.languages') as $langLocale => $langName)
            <a href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ __('languages.' . $langName) }}</a>
        @endforeach
    </div>
@endif

@if(\Auth::check())
    <?php echo \Auth::user()->name; ?>
    <form action="/logout" method="post" >
        @csrf
        <button>{{__('controls.log_out')}}</button>
    </form>
@endif

@yield('content')

</body>
</html>
