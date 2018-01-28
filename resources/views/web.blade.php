@extends('layouts.web.main')
@section('title', 'Vadmin Demo | Inicio')

@section('styles')
    {{-- Slider --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/swiper-slider/swiper.min.css') }}">
@endsection

@section('content')

    <div id="ActualSection" data-section="home"></div> {{-- JS Anchor --}}
    {{-- Home Section Desktop --}}
    <div  class="main-home" data-parallax="scroll">
        <div class="main-info wow animated fadeIn" data-wow-delay="0s" data-wow-duration="1s">
            <img src="{{ asset('webimages/logos/main-logo.png') }}">
            <h1>Sitio de Demostración</h1>
        </div>
    </div>


    {{--  @include('layouts.web.partials.contact-tab')  --}}
    @include('layouts.web.partials.contact')
    @include('layouts.web.partials.foot')
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('plugins/parallax/parallax.min.js') }}"></script>
    {{-- Slider --}}
    <script type="text/javascript" src="{{ asset('plugins/swiper-slider/swiper.jquery.min.js') }}"></script>
@endsection

@section('custom_js')
<script>    
    // Home Parallax
    var image = "{{ asset('webimages/gral/home/home-back.jpg') }}";
    $('.main-home').parallax({ imageSrc: image });

    var mySwiper2 = new Swiper('.swiper-container-services', {
        grabCursor: true,
        autoplay: true,
        autoHeight: true,
        spaceBetween: 150,
        autoplay: {
            delay: 4000,
        },
        loop: true,
        speed: 2000
    });
    
    // var swiper = new Swiper('.swiper-container');
    var mySwiper = new Swiper('.swiper-container', {
        // autoplay:true,
        pagination: true,
        // speed: 10000,
        spaceBetween: 0,
        //autoplay: true,
        autoplay: {
            delay: 2000,
        },
        delay: 0,
        loop: true,
        speed: 2500,
    }); 

    $(document).on('submit','#MainContactForm',function(e){
        e.preventDefault();
        var data   = $(this).serialize();
        var route  = "{{ url('mail_sender') }}";
        // var route  = "{{ url('test_sender') }}";
        var loader = '<img src="{{ asset("images/loaders/loader-sm.svg") }}"/>' + '<div style="color: #fff; margin-left: 15px">Enviando...</div>';

        $.ajax({
            type: "POST",
            url: route,
            dataType: 'json',
            data: data,
            beforeSend: function(){
                var loader = "<img src='{{ asset('images/loaders/loader-sm.svg') }}'>";
                $('#ContactBtn').html('Enviando ' + loader);
            },
            success: function(data) {
                $('#MainContactForm').hide();
                $('#FormSuccess').removeClass('Hidden');
                $('#FormResponse').hide();
                console.log(data);
            },
            error: function(data) {
                $('#FormResponse').hide();
                $('#MainContactForm').hide();
                $('#ContactBtn').html('ENVIAR');
                $('#FormError').removeClass('Hidden');
                console.log(data);
            }
        });
    });
</script>
@endsection