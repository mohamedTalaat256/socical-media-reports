<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>@yield('title')</title>





    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/css/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel='stylesheet'
        type='text/css'>
    <link href="{{ asset('assets/css/plugins/custom/prismjs/prismjs.bundle.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/plugins/global/plugins.bundle.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/bootstrap-tagsinput.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/bootstrap-select.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/chat.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/media/logos/social.gif') }}">
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>


    <script src="{{ asset('assets/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script> --}}
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script type="text/javascript">
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('6b5d410bac4156a5c4c5', {
            cluster: 'eu',
            authEndpoint: 'http://localhost/social/admin/pusher/auth',
            auth: {
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                },
            }
        });

        var channel = pusher.subscribe('presence-requests');
        channel.bind('request', function(data) {
            alert(JSON.stringify(data));
        });
    </script>


    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
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

        .header-menu .menu-nav>.menu-item>.menu-link {
            padding: 0.55rem 1rem;
        }

        ::-webkit-scrollbar {
            width: 9px;
            /* width of the entire scrollbar */
        }

        ::-webkit-scrollbar-track {
            background: rgb(179, 178, 178);
            /* color of the tracking area */
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgb(201, 201, 201);
            /* color of the scroll thumb */
            border-radius: 20px;
            /* roundness of the scroll thumb */
        }

        .iconClass {
            position: relative;
        }

        .iconClass span {
            position: absolute;
            top: 0px;
            right: 0px;
            display: block;
        }
    </style>
</head>


<body id="kt_body" class="header-fixed  subheader-enabled page-loading">

    @include('admin.includes.user_drawer')
    @yield('content')

    @include('admin.includes.scrolltotop')
</body>

<script>
    var base_url = APP_URL + '/';

    function checkDelete() {
        return confirm("Are you Sure You Want To Delete This Record?");
    }
</script>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>

<script src="{{ asset('assets/js/html2canvas.js') }}"></script>

{{-- @if (request()->routeIs('admin_chat'))
    <script src="{{ asset('assets/js/admin_chat.js') }}"></script>
@endif
 --}}
{{-- <script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script> --}}

</html>
