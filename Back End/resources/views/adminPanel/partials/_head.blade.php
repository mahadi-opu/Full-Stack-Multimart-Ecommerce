<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
{{--    <link rel="icon" href="{{asset('$company_info_share->company_logo')}}" type="image/png"/>--}}
    <link rel="shortcut icon" href="{{asset('$company_info_share->company_logo')}}" />
{{--    <link rel="icon" href="{{asset('$company_info_share->company_logo')}}" type="image/png"/>--}}
    <!--plugins-->
    <link href="{{asset('assets/adminPanel')}}/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
    <link href="{{asset('assets/adminPanel')}}/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
    <link href="{{asset('assets/adminPanel')}}/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet"/>
    <link href="{{asset('assets/adminPanel')}}/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet"/>
    <link href="{{asset('assets/adminPanel')}}/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('assets/adminPanel')}}/css/pace.min.css" rel="stylesheet"/>
    <script src="{{asset('assets/adminPanel')}}/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/adminPanel')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('assets/adminPanel')}}/css/bootstrap-extended.css" rel="stylesheet">

    {{--    select2--}}
    {{--    <link rel="stylesheet" href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/css/select2.min.css" />--}}
    {{--    <link rel="stylesheet" href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2-bootstrap-5-theme%401.3.0/dist/select2-bootstrap-5-theme.min.css" />--}}
    {{--    select2--}}


    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{asset('assets/adminPanel')}}/css/app.css" rel="stylesheet">
    <link href="{{asset('assets/adminPanel')}}/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/adminPanel')}}/css/dark-theme.css"/>
    <link rel="stylesheet" href="{{asset('assets/adminPanel')}}/css/semi-dark.css"/>
    <link rel="stylesheet" href="{{asset('assets/adminPanel')}}/css/header-colors.css"/>

    {{--image croper--}}
    <script src="{{asset('assets/adminPanel/imagecroper')}}/libs/jquery.js"></script>
    <script src="{{asset('assets/adminPanel/imagecroper')}}/dist/rcrop.min.js"></script>
    <link href="{{asset('assets/adminPanel/imagecroper')}}/dist/rcrop.min.css" media="screen" rel="stylesheet" type="text/css">
    {{--image croper--}}

    @yield('css_plugins')
    <title>{{$company_info_share->name}}</title>
    @yield('css')
    <link rel="stylesheet" href="{{asset('assets/adminPanel')}}/css/custom.css"/>
</head>






