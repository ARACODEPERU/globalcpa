@extends('layouts.webpage')

@section('content')
{{-- Ideally, this CSS should be in the <head> of your main layout file (e.g., layouts/webpage.blade.php) --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>
    <!-- Loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->




    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <x-header />
        <!-- Page Header Ends-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <x-sidebar />
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                    <br><br>
                <div data-aos="fade-in">
                     <x-slider />
                </div>
                <div data-aos="fade-up"><x-courses.list-card /></div>
                <div data-aos="fade-up"><x-eleva /></div>
                <div data-aos="fade-up"><x-teachers /></div>
                <div data-aos="fade-up"><x-solutions /></div>
                <div data-aos="fade-up"><x-clients-logo /></div>
                <br>
            </div>
        </div>
        <!-- footer start-->
        <x-footer />
    </div>


    {{-- Ideally, this JS should be at the end of your <body> in the main layout file --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            mirror: true, // This makes animations trigger on scroll up as well
            duration: 800, // Animation duration
        });
    </script>

@stop
