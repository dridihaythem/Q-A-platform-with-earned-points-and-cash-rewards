<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <link href="https://cdn.rtlcss.com/bootstrap/v4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/custom.css') }}" rel="stylesheet">
    @stack('css')
</head>

<body class="rtls">

    <div id="wrapper">

        @include('partials.admin.menu')

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                @include('partials.admin.navbar')
            </div>
            @yield('content')
            @include('partials.admin.footer')
        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.7/metisMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.6/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/admin/inspinia.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.0/pace.min.js"></script>
    @stack('js')
</body>

</html>