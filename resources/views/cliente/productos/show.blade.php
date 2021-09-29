@extends("layouts.app")
@section("content")
    <div class="swiper-container principal">
        <div class="swiper-wrapper">
            @foreach($imagenesP as $imagen)
                <div class="swiper-slide"><img class="primary-img" src="{{ asset($imagen->imagen_producto) }}"></div>
            @endforeach

        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
    <section id="products" class="our-services-area bg-gray section-padding-100-0 text-justify">
        <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading ">
                        <h1 style="color: #FF8000; font-family:Tahoma; text-align: center">{{ $servicio->nombre }}</h1>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-12 col-lg-5">
                    <div class="alazea-service-area mb-100">
                        <!-- Single Service Area -->
                        <div class="single-service-area d-flex align-items-center wow fadeInUp" data-wow-delay="100ms">
                            <!-- Content -->
                            <div class="service-content">
                                {!! $servicio->introduccion !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="mb-100">
                        <img src="{{$servicio->imagen_producto1}}" alt="">
                    </div>
                </div>
            </div>
        </div>
            <br>
            <br>
        </section>
        <section class="our-services-area bg-gray section-padding-100-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        {!! $servicio->descripcion !!}
                    </div>
                </div>
            </div>
        </section>
        <section class="our-services-area bg-gray section-padding-100-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        {!! $servicio->contenido !!}
                    </div>
                </div>
            </div>
        </section>
        <section class="our-services-area bg-gray section-padding-100-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        {!! $servicio->diferenciadores !!}
                    </div>
                </div>
            </div>
        </section>
        <section class="our-services-area bg-gray section-padding-100-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        {!! $servicio->carac_adi !!}
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12 col-lg-5">
                        <div class="mb-100">
                            <img src="{{$servicio->imagen_producto2}}" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="alazea-service-area mb-100">
                            <!-- Section Heading -->
                            <div class="section-heading ">
                                {!! $servicio->info_adi !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

@section('scripts')
    <script>
        var swiper = new Swiper('.principal', {
            cssMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination'
            },
            mousewheel: true,
            keyboard: true,
        });
    </script>
@endsection
