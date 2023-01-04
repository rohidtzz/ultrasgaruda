@section('product')
<section class="product-section spad" id="section1">
    <div class="container">
        <div class="section-title">
            <h2>Product</h2>
            <p>We Recomended</p>
        </div>


        <div class="row" id="product-filter">


            @foreach ($all as $a )




            <div class="mix col-lg-3 col-md-6 new">
                <div class="product-item">
                    <figure>
                        <img src="{{ asset('/product/img/'.$a->image) }}" alt="">
                        @if ($a->stock == 0)
                        <div class="bache sale">SOLD</div>
                        @else
                        {{-- <div class="bache sale">SALE</div> --}}
                        @endif


                    </figure>
                    @php
                        $number_format  = number_format($a->price);
                    @endphp
                    <div class="product-info">



                        <h6>{{ $a->name }}</h6>
                        <form action="{{ url('/cart/add/' ) }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $a->id }}">
                            <div>{{ $a->desc }}</div>
                        {{-- <div>Size: <select class="form-select" name="sizes" id="">
                            <option selected value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select></div> --}}
                        <div id="stok"></div>

                        <p><?php echo 'Rp. ' . $number_format; ?></p>
                        @if (Auth::check())
                        <button class="site-btn btn-line">ADD TO CART !</button>
                        </form>
                        @else
                        <a href="{{ url('/login') }}" class="site-btn btn-line">BUY NOW!</a>
                        @endif

                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</section>
<script>
    $(document).ready(function(){

        // selesai()
        setInterval(() => {
            show()
        }, 1000);
    });

    function show(){

    $.ajax({
        url: "/stock",
        type: "GET",
        success: function(data){
            $('#stok').empty()
            let kata = `stock: ${data[0].stock}`

            document.getElementById("stok").innerHTML = kata
        },
        error: function(data){
            alert("Terjadi Kesalahan!");
        }
    });

    }
</script>
<!-- Product section end -->



@endsection
