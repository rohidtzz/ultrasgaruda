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
                        <div class="row text-muted">Size: {{ $a->size }}</div>
                    </div>

                    <div class="col">
                        <a href="{{ url('/cart/qty/min/'.$a->id ) }}" min="0">-</a><a href="#" value="{{ $a->qty }}" min="0" class="border">{{ $a->qty }}</a><a href="{{ url('/cart/qty/up/'.$a->id ) }}">+</a>
                    </div>

                    <div class="col">&nbsp; <?php echo 'Rp. ' . $number_format; ?> <span class="close"><a href="{{ url('/cart/destroy/'.$a->id ) }}">&#10005;</a></span></div>
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
                <div class="col">TOTAL PRICE</div>
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
            <button type="submit" onclick="return confirm('yakin Checkout?')" class="btn btn-primary" >CHECKOUT COD</button>
            </form>
            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal" >CHECKOUT dengan kurir</button>
            @endif


        </div>
    </div>

</div>

<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form name="frm_edit" id="frm_edit" class="form-horizontal" action="{{url('transaction')}}" method="POST" enctype="multipart/form-data">
            @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">CheckOut</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="form-group ">


                    {{-- <h2>Halaman Checkout</h2> --}}

                    {{-- <form class="ps-checkout__form" action="" method="post">
                    @csrf --}}

                    {{-- <h3 class="mt-5 mb-5">Alamat Pengiriman</h3> --}}
                    <div class="form-group ">
                    {{-- <label>Provinsi asal</label> --}}
                    <input type="hidden" type="text" value="3" class="form-control" name="province_origin">
                    </div>
                    <div class="form-group ">
                    {{-- <label>Kota Asal</label> --}}
                    <input type="hidden" value="456"  class="form-control" id="city_origin" name="city_origin">
                    </div>
                    <div class="form-group ">
                    <label>Alamat Anda<span></span>
                    </label>
                    <textarea name="address" class="form-control" rows="5" placeholder="isi dengan Alamat Lengkap Anda" ></textarea>
                    </div>
                    <div class="form-group form-group--inline">
                        <label for="provinsi">Provinsi Anda</label>
                        <select name="province_id" id="province_id" class="form-control">
                        <option value="">pilih provinsi</option>
                        @foreach ($provinsi  as $row)
                        <option value="{{$row['province_id']}}" namaprovinsi="{{$row['province']}}">{{$row['province']}}</option>
                        @endforeach
                        </select>
                        </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="nama_provinsi" nama="nama_provinsi" placeholder="ini untuk menangkap nama provinsi ">
                    </div>
                    <div class="form-group ">
                    <label>Kota Anda<span>*</span>
                    </label>
                    <select name="kota_id" id="kota_id" class="form-control">
                    <option value="">Pilih Kota</option>
                    </select>
                    </div>

                    <label>Pilih Ekspedisi<span>*</span>
                    </label>
                    <select name="kurir" id="kurir" class="form-control">
                    <option value="">Pilih kurir</option>
                    <option value="jne">JNE</option>
                    <option value="tiki">TIKI</option>
                    <option value="pos">POS INDONESIA</option>
                    </select>

                    <div class="form-group">
                        <label>Pilih Layanan<span>*</span>
                        </label>
                        <select name="layanan" id="layanan" class="form-control">
                        <option value="">Pilih layanan</option>
                        </select>

                        </div>
                    </div>


                    {{-- <div class="form-group">
                    <input type="text" class="form-control" nama="nama_kota" id="nama_kota"  placeholder="ini untuk menangkap nama kota">
                    </div>
                    <div class="form-group ">
                    <label>Kode Pos<span>*</span>
                    </label>
                    <input type="text" name="kode_pos" class="form-control" >
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group ">
                    <label>Total Belanja<span>*</span>
                    </label>
                    <input type="text" name="totalbelanja" class="form-control" >
                    </div> --}}
                    <div class="form-group ">
                    {{-- <label>total berat (gram) </label> --}}
                    <input type="hidden" value="200" id="weight" name="weight">
                    </div>
                    {{-- <div class="form-group ">
                    <label>total ongkos kirim </label>
                    <input class="form-control" type="text" id="ongkos_kirim" name="ongkos_kirim">
                    </div>
                    <div class="form-group ">
                    <label>total keseluruhan </label>
                    <input class="form-control" type="text" id="ongkos_kirim" name="ongkos_kirim">
                    </div>
                    <div class="form-group">
                    <button class="btn btn-primary" type="submit">Proses Order</button>
                    </div> --}}




        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" id="id">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" onclick="return confirm('pastikan data anda sudah benar')" class="btn btn-primary">Submit</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.js"
integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
crossorigin="anonymous"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> --}}


  <script>
        $('select[name="kurir"]').on('change', function(){
        // kita buat variable untuk menampung data data dari  inputan
        // name city_origin di dapat dari input text name city_origin
        let origin = $("input[name=city_origin]").val();
        // name kota_id di dapat dari select text name kota_id
        let destination = $("select[name=kota_id]").val();
        // name kurir di dapat dari select text name kurir
        let courier = $("select[name=kurir]").val();
        // name weight di dapat dari select text name weight
        let weight = $("input[name=weight]").val();
        // alert(courier);
        if(courier){
jQuery.ajax({
url:"/origin="+origin+"&destination="+destination+"&weight="+weight+"&courier="+courier,
type:'GET',
dataType:'json',
success:function(data){
$('select[name="layanan"]').empty();
// ini untuk looping data result nya
$.each(data, function(key, value){
// ini looping data layanan misal jne reg, jne oke, jne yes
$.each(value.costs, function(key1, value1){
// ini untuk looping cost nya masing masing
// silahkan pelajari cara menampilkan data json agar lebi paham
$.each(value1.cost, function(key2, value2){
$('select[name="layanan"]').append('<option value="'+ key +'">' + value1.service + '-' + value1.description + '-' +value2.value+ '</option>');
});
});
});
}
});
} else {
$('select[name="layanan"]').empty();
}
        });
  </script>

<script>
    $(document).ready(function(){
    //ini ketika provinsi tujuan di klik maka akan eksekusi perintah yg kita mau
    //name select nama nya "provinve_id" kalian bisa sesuaikan dengan form select kalian
    $('select[name="province_id"]').on('change', function(){
// membuat variable namaprovinsiku untyk mendapatkan atribut nama provinsi
    var namaprovinsiku = $("#province_id option:selected").attr("namaprovinsi");
// menampilkan hasil nama provinsi ke input id nama_provinsi
    $("#nama_provinsi").val(namaprovinsiku);


    let provinceid = $(this).val();
    //kita cek jika id di dpatkan maka apa yg akan kita eksekusi
    if(provinceid){
    // jika di temukan id nya kita buat eksekusi ajax GET
    jQuery.ajax({
    // url yg di root yang kita buat tadi
    url:"/kota/"+provinceid,
    // aksion GET, karena kita mau mengambil data
    type:'GET',
    // type data json
    dataType:'json',
    // jika data berhasil di dapat maka kita mau apain nih
    success:function(data){


    // jika tidak ada select dr provinsi maka select kota kososng / empty
    $('select[name="kota_id"]').empty();
    // jika ada kita looping dengan each
    $.each(data, function(key, value){
    // perhtikan dimana kita akan menampilkan data select nya, di sini saya memberi name select kota adalah kota_id
    $('select[name="kota_id"]').append('<option value="'+ value.city_id +'" namakota="'+ value.type +' ' +value.city_name+ '">' + value.type + ' ' + value.city_name + '</option>');
    });
    }
    });
    }else {
    $('select[name="kota_id"]').empty();
    }
    });


    });


    </script>


{{-- <script>
    function increaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('number').value = value;
}

function decreaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? value = 1 : '';
  value--;
  document.getElementById('number').value = value;
}
</script> --}}





@endsection

