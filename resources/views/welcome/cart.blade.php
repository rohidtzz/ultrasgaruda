@extends('welcome.layouts.master')
@extends('welcome.layouts.navcart')
<br><br><br><br><br>
@section('cart')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
    body{
        background-image: url({{ asset('plaza/img/ind.jpg') }}) ;
    }

    .title{
    margin-bottom: 5vh;
}
.card{
    margin: auto;
    max-width: 950px;
    width: 90%;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 1rem;
    border: transparent;
}
@media(max-width:767px){
    .card{
        margin: 3vh auto;
    }
}
.cart{
    background-color: #fff;
    padding: 4vh 5vh;
    border-bottom-left-radius: 1rem;
    border-top-left-radius: 1rem;
}
@media(max-width:767px){
    .cart{
        padding: 4vh;
        border-bottom-left-radius: unset;
        border-top-right-radius: 1rem;
    }
}
.summary{
    background-color: #ddd;
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    padding: 4vh;
    color: rgb(65, 65, 65);
}
@media(max-width:767px){
    .summary{
    border-top-right-radius: unset;
    border-bottom-left-radius: 1rem;
    }
}
.summary .col-2{
    padding: 0;
}
.summary .col-10
{
    padding: 0;
}.row{
    margin: 0;
}
.title b{
    font-size: 1.5rem;
}
.main{
    margin: 0;
    padding: 2vh 0;
    width: 100%;
}
.col-2, .col{
    padding: 0 1vh;
}
a{
    padding: 0 1vh;
}
.close{
    margin-left: auto;
    font-size: 0.7rem;
}


.back-to-shop{
    margin-top: 4.5rem;
}
h5{
    margin-top: 4vh;
}
hr{
    margin-top: 1.25rem;
}
form{
    padding: 2vh 0;
}
select{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
input{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
input:focus::-webkit-input-placeholder
{
      color:transparent;
}
.btn{
    /* background-color: #000; */
    /* border-color: #000; */
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin-top: 4vh;
    padding: 1vh;
    border-radius: 0;
}
.btn:focus{
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none;
}
.btn:hover{
    color: white;
}
a{
    color: black;
}
a:hover{
    color: black;
    text-decoration: none;
}
 #code{
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253) , rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center;
}
</style>

<div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col"><h4><b>Shopping Cart</b></h4></div>
                    {{-- <div class="col align-self-center text-right "><button style="width:50px;" class="btn btn-primary">EDIT</button></div> --}}


                </div>
            </div>
            @foreach ($all as $a )




            @php
                        $number_format  = number_format($a->total);
                        $el = App\Models\Product::find($a->product_id);
            @endphp


            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="{{ asset('/product/img/'.$el->image) }}"></div>
                    <div class="col">
                        <div class="row">{{ App\Models\Product::find($a->product_id)->name }}</div>
                        <div class="row text-muted">{{ App\Models\Product::find($a->product_id)->desc }}</div>
                    </div>

                    <div class="col">
                        {{-- <a href="{{ url('/cart/qty/min/'.$a->id ) }}" min="0">-</a> --}}
                        <a href="#" value="{{ $a->qty }}" min="0" class="border">{{ $a->qty }}</a>
                        {{-- <a href="{{ url('/cart/qty/up/'.$a->id ) }}">+</a> --}}
                    </div>

                    <div class="col">&nbsp; <?php echo 'Rp. ' .  number_format($a->subtotal) ; ?> <span class="close"><a href="{{ url('/cart/destroy/'.$a->id ) }}">&#10005;</a></span></div>
                </div>
            </div>
            @endforeach
            {{-- <div class="row">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="{{ asset('plaza/img/baju.jpg') }}"></div>
                    <div class="col">
                        <div class="row text-muted">Shirt</div>
                        <div class="row">Cotton T-shirt</div>
                    </div>
                    <div class="col">
                        <div class="form-group" style="margin-top: 28px; margin-left:4px; width:60px;" >


                            <input value="1" disabled class="form-control" >
                            <select class="form-control" id="exampleFormControlSelect1">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                    </div>
                    <div class="col">&nbsp; 120.000 <span class="close">&#10005;</span></div>
                </div>
            </div> --}}

            <div class="back-to-shop"><a href="{{ url('/#section1') }}">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
        </div>
        <div class="col-md-4 summary">
            <div><h5><b>Summary</b></h5></div>


            {{-- <form>
                <p>SHIPPING</p>
                <select><option class="text-muted">Standard-Delivery- &euro;5.00</option></select>
                <p>GIVE CODE</p>
                <input id="code" placeholder="Enter your code">
            </form> --}}

            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">Product PRICE</div>
                <div class="col text-right">&nbsp; Rp.
                {{ number_format($total)  }}</div>
            </div>

            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">TOTAL Qty</div>
                <div class="col text-right">
                {{ $totalqty  }}</div>
            </div>
            @if($totalqty == 0)

            @else
            <form action="{{ url('/transaction') }}" method="POST">
                @csrf
                <input type="hidden" name="total" value="{{ $total }}">
                <input type="hidden" name="totalqty" value="{{ $totalqty }}">
            <button type="submit" onclick="return confirm('yakin Checkout?')" class="btn btn-primary" >chekout</button>
            </form>
            {{-- <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal" >CHECKOUT dengan jasa ekspedisi</button> --}}
            @endif


        </div>
    </div>

</div>





@endsection

