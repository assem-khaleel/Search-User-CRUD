<!doctype html>
<html>
@include('layouts.head')


<body class="fix-header card-no-border">

<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
@include('layouts.header')


<!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        @yield('wrapper')
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    @include('layouts.footer')
</div>

<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
@stack("footer")
@include('layouts.script')

</body>
</html>