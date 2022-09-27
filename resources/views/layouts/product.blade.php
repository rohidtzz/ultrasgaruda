@section('product')
<section class="product-section spad" id="section1">
    <div class="container">
        <div class="section-title">
            <h2>Product</h2>
            <p>We Recomended</p>
        </div>
        {{-- <ul class="product-filter controls">
            <li class="control" data-filter=".new">New arrivals</li>
            <li class="control" data-filter="all">Recommended</li>
            <li class="control" data-filter=".best">Best sellers</li>
        </ul> --}}

        <div class="row" id="product-filter">
            <div class="mix col-lg-3 col-md-6 best">
                <div class="product-item">
                    <figure>
                        <img src="{{ asset('plaza/img/tiket.jpg') }}" alt="">
                        {{-- <div class="pi-meta">
                            <div class="pi-m-left">
                                <a href=""><img src="{{ asset('plaza/img/icons/eye.png') }}" alt=""></a>
                                <a href=""><p>quick view</p></a>
                            </div>
                            <div class="pi-m-right">
                                <img src="{{ asset('plaza/img/icons/heart.png') }}" alt="">
                                <p>save</p>
                            </div>
                        </div> --}}
                    </figure>
                    <div class="product-info">
                        <h6>tiket nobar</h6>
                        <p>Rp. 20.000</p>
                        <a href="#" class="site-btn btn-line">BUY NOW!</a>
                    </div>
                </div>
            </div>
            <div class="mix col-lg-3 col-md-6 new">
                <div class="product-item">
                    <figure>
                        <img src="{{ asset('plaza/img/baju.jpg') }}" alt="">
                        <div class="bache sale">SALE</div>
                        {{-- <div class="pi-meta">
                            <div class="pi-m-left">
                                <img src="{{ asset('plaza/img/icons/eye.png') }}" alt="">
                                <p>quick view</p>
                            </div>
                            <div class="pi-m-right">
                                <img src="{{ asset('plaza/img/icons/heart.png') }}" alt="">
                                <p>save</p>
                            </div>
                        </div> --}}
                    </figure>
                    <div class="product-info">
                        <h6>Baju Ultras Garuda</h6>
                        <p>Rp. 120.000</p>
                        <a href="#" class="site-btn btn-line">BUY NOW!</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Product section end -->



@endsection
