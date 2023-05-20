<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="{{ asset('assets/css/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}"
        rel='stylesheet'type='text/css'>
    <link href="{{ asset('assets/css/plugins/custom/prismjs/prismjs.bundle.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/plugins/global/plugins.bundle.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/media/logos/social.gif') }}">
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <link href="{{ asset('assets/media/logos/favicon.ico') }}"rel="shortcut icon" />
    <link rel='stylesheet'
        href='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

    <link href="{{ asset('assets/css/choices.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/choices.min.js') }}"></script>

    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>


</head>
<style>
    ::file-selector-button {
        display: none;
    }

    .table th,
    .table td {
        font-size: 13px;
        padding: 6px;
    }

    .btn i {
        font-size: 10px;
    }
</style>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">

    @if (Auth::user())
    @include('user.includes.user_drawer')

    @endif
    @yield('content')
</body>

<script>
    function checkDelete() {
        return confirm("Are you Sure You Want To Delete This Record?");
    }
</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>

</html>
