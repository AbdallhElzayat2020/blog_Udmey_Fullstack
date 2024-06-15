@extends('frontEnd.layouts.master')

@section('title')
    Home Page
@endsection

@section("content")
    <!-- Tranding news  carousel-->
    @include('frontEnd.home-components.tranding-news')
    <!-- End Tranding news carousel -->

    <!-- start hero-slider -->
    @include('frontEnd.home-components.hero-slider')
    <!-- End hero-slider-->

    <div class="large_add_banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="large_add_banner_img">
                        <img src="images/placeholder_large.jpg" alt="adds">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular news category -->
    @include('frontEnd.home-components.main-news')
    <!-- End Popular news category -->

@endsection
