<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title') - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="{{ asset('css/bootstrap-cerulean.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/charisma-app.css') }}" rel="stylesheet">
    <link href='{{ asset('bower_components/fullcalendar/dist/fullcalendar.css') }}' rel='stylesheet'>
    <link href='{{ asset('bower_components/fullcalendar/dist/fullcalendar.print.css') }}' rel='stylesheet' media='print'>
    <link href='{{ asset('bower_components/chosen/chosen.min.css') }}' rel='stylesheet'>
    <link href='{{ asset('bower_components/colorbox/example3/colorbox.css') }}' rel='stylesheet'>
    <link href='{{ asset('bower_components/responsive-tables/responsive-tables.css') }}' rel='stylesheet'>
    <link href='{{ asset('bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css') }}' rel='stylesheet'>
    <link href='{{ asset('css/jquery.noty.css') }}' rel='stylesheet'>
    <link href='{{ asset('css/noty_theme_default.css') }}' rel='stylesheet'>
    <link href='{{ asset('css/elfinder.min.css') }}' rel='stylesheet'>
    <link href='{{ asset('css/elfinder.theme.css') }}' rel='stylesheet'>
    <link href='{{ asset('css/jquery.iphone.toggle.css') }}' rel='stylesheet'>
    <link href='{{ asset('css/uploadify.css') }}' rel='stylesheet'>
    <link href='{{ asset('css/animate.min.css') }}' rel='stylesheet'>
    @stack('styles')

    <!-- jQuery -->
    <script src="{{ asset('bower_components/jquery/jquery.min.js') }}"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

    <script>
        window.Mise = {!!
            json_encode([
                'csrfToken' => csrf_token(),
                'baseUrl' => url('/'),
                'authorUrl' => route('authors')
            ])
         !!}
    </script>

</head>

<body>

    @if( ! isset($no_visible_elements) || ! $no_visible_elements )
        @include('admin.layouts.header')
    @endif

    <div class="ch-container">
        <div class="row">
            @if(!isset($no_visible_elements) || !$no_visible_elements)
                @include('admin.layouts.sidebar')
            @endif

            <div id="content" class="col-lg-10 col-sm-10">
                @yield('content')
            </div>
        </div>

        @if(!isset($no_visible_elements) || !$no_visible_elements)
            @include('admin.layouts.footer')
        @endif
    </div>

    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.cookie.js') }}"></script>
    <script src='{{ asset('bower_components/moment/min/moment.min.js') }}'></script>
    <script src='{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.js') }}'></script>
    <script src='{{ asset('js/jquery.dataTables.min.js') }}'></script>
    <script src="{{ asset('bower_components/chosen/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/colorbox/jquery.colorbox-min.js') }}"></script>
    <script src="{{ asset('js/jquery.noty.js') }}"></script>
    <script src="{{ asset('bower_components/responsive-tables/responsive-tables.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js') }}"></script>
    <script src="{{ asset('js/jquery.raty.min.js') }}"></script>
    <script src="{{ asset('js/jquery.iphone.toggle.js') }}"></script>
    <script src="{{ asset('js/jquery.autogrow-textarea.js') }}"></script>
    <script src="{{ asset('js/jquery.uploadify-3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.history.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('js/charisma.js') }}"></script>
</body>
</html>
