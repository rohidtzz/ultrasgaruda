@section('hero')

<!-- Hero section -->
<section class="hero-section set-bg" data-setbg="{{ asset('plaza/img/ind.jpg') }}">
    <div class="hero-slider owl-carousel">
        <div class="hs-item">
            <div class="hs-left"><img src="{{ asset('plaza/img/tgr.png') }}" alt=""></div>
            <div class="hs-right">
                <div class="hs-content">
                    {{-- <div class="price">from $19.90</div> --}}
                    {{-- <h2 ><span>2018</span> <br>summer collection</h2> --}}

                    {{-- <h2 style="color: black; padding-left: 100px">UNITY</h3>
                        <H2 style="color: black; padding-left:200px">IN</H2>
                        <H2 style="color: black;">DIVERSITY</H2> --}}

                        <div>

                            {{-- <h2>UNITY IN DIVERSITY</h2> --}}
                            <h3 style="font-size: 50px">Unity of Indonesian Suppoerter</h3>

                        </div>
                    {{-- <a href="" class="site-btn">Shop NOW!</a> --}}
                </div>
            </div>
        </div>
        {{-- <div class="hs-item">
            <div class="hs-left"><img src="{{ asset('plaza/img/ult.png') }}" alt=""></div>
            <div class="hs-right">
                <div class="hs-content">
                    <div>


                        <h3 style="font-size: 50px">UNITY IN DIVERSITY</h3>

                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</section>


@endsection
