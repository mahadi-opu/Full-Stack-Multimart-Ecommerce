<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/rocker/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Mar 2023 08:45:44 GMT -->
@include('adminPanel.partials._head')
<body>
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    @include('adminPanel.partials._sidebar')
    <!--end sidebar wrapper -->
    <!--start header -->
    @include('adminPanel.partials._header')

    <!--end header -->
    <!--start page wrapper -->
    <div class="page-wrapper">
        @yield('main_content')
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button-->

    @include('adminPanel.partials._footer')

</div>

@include('adminPanel.partials._scripts')
</body>

</html>









