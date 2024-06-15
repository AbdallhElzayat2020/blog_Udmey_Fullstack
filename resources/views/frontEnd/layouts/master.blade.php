<!DOCTYPE html>
<html lang="">

@include("frontEnd.layouts.main-head")

<body>

<!-- Header  -->
@include('frontEnd.layouts.header')
<!-- End Header  -->


@yield('content')
@include('frontEnd.layouts.main-footer')
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
@include('frontEnd.layouts.scripts')
</body>

</html>
