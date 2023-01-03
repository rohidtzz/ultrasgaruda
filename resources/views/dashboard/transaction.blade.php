@extends('dashboard.layouts.master')
@extends('dashboard.layouts.sidebar')
@extends('dashboard.layouts.wrap')
@extends('dashboard.layouts.navbar')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <h3 class="mb-0">Transaction Table</h3>
              <div class="justify-content-end ms-auto ">
                @if (Auth()->user()->role =="admin" || Auth()->user()->role =="kordinator")


                <form class="" action="{{ url('/home/transaction/search') }}" method="post">
                <div class="input-group">

                  <span style="height: 50px" class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>


                        @csrf
                        <input name="search" style="height: 50px" type="text" class="form-control" placeholder="Type here...">
                        <button type="submit" style="height: 50px" class=" btn btn-primary">Search</button>

                </div>

                </div>
            </form>
            @endif
            </div>
          </div>
          <br>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">



              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">No invoice</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                    {{-- <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Shipping</th> --}}
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">users</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1
                    @endphp
                @foreach ($all as $a)
                  <tr>
                    <td>
                      <div class="">
                        <div class="text-center">
                            {{ $no++ }}
                        </div>



                    </td>
                    <td>
                        <div class="d-flex flex-column  justify-content-center">
                            <h6 class="mb-0 text-sm text-center">{{ $a->no_invoice }}</h6>
                            {{-- <p class="text-xs text-secondary mb-0">john@creative-tim.com</p> --}}
                          </div>
                    </td>
                    <td>
                         <div class="text-center">
                            <div>
                                <h6 class="mb-0 text-sm text-center">
                                    {{-- {{ $a->status }} --}}

                                            {{ $a->status }}
                                </h6>
                            {{-- <img src="{{ asset('/product/img/'.$a->image) }}" class="avatar avatar-xl me-3" alt="user1"> --}}
                          </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0 text-center">Rp.{{ number_format($a->total) }}</p>
                    </td>
                    {{-- <td>
                        <p class="text-xs text-center font-weight-bold mb-0">
                            @foreach (json_decode($a->data) as $dat=>$value)

                                {{$value->size}}


                            @endforeach</p>
                      </td> --}}
                    {{-- <td class="align-middle text-center text-sm">
                      <span class="">
                        @if ($a->shipping)
                        <a type="button" data-id="{{$a->id}}" style="padding-left:10px;" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleM-{{ $a->id }}" >
                            Detail shipping
                          </a>

                          @else

                          <p>ke lokasi ug</p>

                        @endif
                      </span>
                    </td> --}}
                    <td class="align-middle text-center text-sm">
                        <span class="">{{ App\Models\User::find($a->user_id)->name }}</span>
                      </td>

                      <td class="align-middle text-center text-sm">
                        {{-- <span class="">
                            @foreach (json_decode($a->data) as $dat=>$value)

                            @endforeach



                        </span> --}}

                        <span>
                            <a type="button" data-id="{{$a->id}}" style="padding-left:10px;" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleMo-{{ $a->id }}" >
                                Detail Product
                              </a>
                        </span>
                      </td>
                      <td class="text-center align-middle">

                     @if (Auth()->user()->role == "admin" || Auth()->user()->role == "kordinator")

                      {{-- @if ($a->status == "unpaid") --}}
                      @if($a->paytrans)
                      <a type="button" data-id="{{$a->id}}" style="padding-left:10px;" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Detail
                      </a>

                      @endif





                      @elseif (Auth()->user()->role == "user")

                      @if ($a->status == "unpaid")
                      <a type="button" data-id="{{$a->id}}"  style="padding-left:10px;" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Payment
                      </a>
                      @endif

                      @if ($a->status == "validation")
                      <a type="button" data-id="{{$a->id}}"  style="padding-left:10px;" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Payment detail
                      </a>
                      @endif

                      @if ($a->status == "payment successful")
                      <a type="button" data-id="{{$a->id}}"  style="padding-left:10px;" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Payment detail
                      </a>
                      @endif



                      @endif

                      </td>


                    <td class="text-center align-middle">
                      {{-- <a type="button" data-id="{{$a->id}}"  class="text-primary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Accept
                      </a> --}}


                      @if (Auth()->user()->role == "admin" || Auth()->user()->role == "kordinator")

                      @if ($a->status == "unpaid")
                      <a style="padding-left:10px;"  onclick="return confirm('are you sure?')" href="{{ url('/home/transaction/reject/'.$a->id) }}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Reject
                      </a>
                      @endif


                      @if($a->status == "validation")
                        <a type="button" onclick="return confirm('are you sure?')" href="{{ url('/home/transaction/accept/'.$a->id) }}" style="padding-left:10px;" class="text-info font-weight-bold text-xs">
                            Accept
                        </a>

                      <a style="padding-left:10px;"  onclick="return confirm('are you sure?')" href="{{ url('/home/transaction/reject/'.$a->id) }}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Reject
                      </a>
                      @endif

                      {{-- @if($a->status == "reject")
                      <a type="button" data-id="{{$a->id}}" style="padding-left:10px;" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Detail
                      </a>
                      @endif --}}











                      @elseif (Auth()->user()->role == "user")

                      @if ($a->status == "unpaid")

                      <a style="padding-left:10px;"  onclick="return confirm('are you sure?')" href="{{ url('/home/transaction/cancel/'.$a->id) }}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Cancel
                      </a>
                      @endif










                      @endif
                    </td>


                  </tr>



                  <div class="modal fade" id="exampleModa-{{ $a->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modal Detail Transaction</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        @if($a->paytrans)
                        <div class="modal-body">
                            @if($a->status == "validation")
                            <span>Pembayaran Anda Sedang Divalidasi</span><br>
                            <span>Contact Person jika ada kendala: 089612121703 (rohid) </span>
                            @elseif ($a->status == "payment successful")
                            <span>Pembayaran Anda successful</span><br>
                            <span>Contact Person jika ada kendala: 089612121703 (rohid) </span>
                            @else
                            @endif

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Atas nama Bank Pengirim</label>
                                    <input type="text" name="nama_bank" value="{{ $a->paytrans->nama_bank }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"disabled>
                                    <div id="emailHelp" class="form-text"></div>
                                  </div>

                                <div class="mb-3">
                                  <label for="exampleInputEmail1" class="form-label">Atas nama Bank Pengirim</label>
                                  <input type="text" name="nama_pengirim" value="{{ $a->paytrans->nama_pengirim }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"disabled>
                                  <div id="emailHelp" class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">NO Rek Bank Pengirim</label>
                                    <input type="number" name="no_rek" value="{{ $a->paytrans->no_rek }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                    <div id="emailHelp" class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                  <label for="exampleInputPassword1" class="form-label">Bukti Transfer</label>
                                  <picture>
                                    <source srcset="{{ asset('trans/img/'.$a->paytrans->bukti_image) }}" type="image/svg+xml">
                                    <img src="{{ asset('trans/img/'.$a->paytrans->bukti_image) }}" class="img-fluid img-thumbnail" alt="...">
                                  </picture>
                                  {{-- <img src="{{ asset('trans/img/'.$a->bukti_image) }}" wi alt=""> --}}
                                </div>
                        </div>
                        @else
                        <div class="modal-body">
                            <form method="POST" action="{{ url('/home/transaction/payment/post') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $a->id }}">
                                <span> Transfer ke Rekening BCA:</span><br>
                                <span>BCA: 252529179 | A/n Rohid ammar firdaus </span>
                                <p>Isi Form Di bawah ini berserta Bukti Transfer </p>
                                <p>Jumlah Yang Harus dibayar Rp. {{ number_format($a->total) }}</p>
                                <span>Contact Person jika ada kendala: 089612121703 (rohid) </span>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">nama Bank Pengirim</label>
                                    <input type="text" name="nama_bank" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                    <div id="emailHelp" class="form-text"></div>
                                  </div>

                                <div class="mb-3">
                                  <label for="exampleInputEmail1" class="form-label">Atas nama Bank Pengirim</label>
                                  <input type="text" name="nama_pengirim" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                  <div id="emailHelp" class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">NO Rek Bank Pengirim</label>
                                    <input type="number" name="no_rek" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                    <div id="emailHelp" class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                  <label for="exampleInputPassword1" class="form-label">Bukti Transfer</label>
                                  <input type="file" id="fileUpload" name="bukti_image" class="form-control" id="exampleInputPassword1">


                                </div>





                        </div>
                        @endif




                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          @if ($a->paytrans)

                          @else
                          <button type="submit" class="btn btn-primary">Submit Payment</button>
                          @endif

                        </div>
                    </form>
                      </div>
                    </div>
                  </div>

                @endforeach






                </tbody>

              </table>
              {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet"> --}}

              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {{ $all->links() }}
                </ul>
              </nav>


              {{-- {{ $all->links() }} --}}

            </div>
          </div>
        </div>
      </div>
    </div>

</div>
@foreach ($all as $a)


 <div class="modal fade" id="exampleMo-{{ $a->id }}" tabindex="-1" aria-labelledby="exampleMo" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modal Detail Product</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table align-items-center ">
                                    <thead>
                                        <tr>
                                        <th>Img</th>
                                        <th>product</th>
                                        <th>size</th>
                                        <th>qty</th>

                                        <th>sub total</th>
                                        </tr>

                                    </thead>
                                  <tbody>
                                    @foreach (json_decode($a->data) as $dak=>$value )


                                    <tr>
                                        <td><img class="img-thumbnail" src="{{ asset('product/img/'.App\Models\Product::find($value->product_id)->image) }}" alt=""></td>
                                        <td>{{ App\Models\Product::find($value->product_id)->name }}</td>
                                        <td>{{ $value->size }}</td>
                                        <td>{{ $value->qty }}</td>

                                        <td>Rp. {{ number_format($a->total) }}</td>

                                    </tr>

                                    @endforeach
                                    <tr>
                                        <td>Total qty: </td>
                                        <td>{{$a->qty}}</td>
                                    </tr>
                                    <tr>
                                        <td>total price:</td>
                                        <td>Rp. {{ number_format($a->total) }}</td>
                                    </tr>


                                  </tbody>
                                </table>
                              </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                          </div>
                      </form>
                        </div>
                      </div>
                    </div>

                    @if ($a->shipping)

                    <div class="modal fade" id="exampleM-{{ $a->id }}" tabindex="-1" aria-labelledby="exampleM" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Modal Detail Shipping</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form action="{{ url('/transaction/update/resi') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $a->id }}" name="id">
                            <div class="modal-body">
                                    <span>Contact Person jika ada kendala: 089612121703 (rohid) </span>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Alamat lengkap</label>
                                        <textarea type="text" name="nama_bank" rows="5" value="{{ $a->shipping->alamat }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"disabled>{{ $a->shipping->alamat }} </textarea>
                                        <div id="emailHelp" class="form-text"></div>
                                      </div>

                                    <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">no rumah</label>
                                      <input type="text" name="nama_pengirim" value="{{ $a->shipping->no_rumah}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"disabled>
                                      <div id="emailHelp" class="form-text"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Provinsi</label>
                                        <input type="text" name="no_rek" value="{{ $a->shipping->provinsi }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Kota</label>
                                        <input type="text" name="no_rek" value="{{ $a->shipping->kota }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
                                        <input type="text" name="no_rek" value="{{ $a->shipping->kecamatan }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Kelurahan</label>
                                        <input type="text" name="no_rek" value="{{ $a->shipping->kelurahan }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Kode pos</label>
                                        <input type="number" name="no_rek" value="{{ $a->shipping->kode_pos }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>

                                    @if (auth()->user()->role == "admin" || auth()->user()->role == "kordinator")
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">no resi</label>
                                        <input type="text" name="no_resi" value="{{ $a->shipping->no_resi }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
                                    @else
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">no resi</label>
                                        <input type="text" name="no_rek" value="{{ $a->shipping->no_resi }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
                                    @endif





                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">jasa ekspedisi</label>
                                        <input type="text" name="no_rek" value="{{ $a->shipping->jasa_expedisi }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">jenis layanan</label>
                                        <input type="text" name="no_rek" value="{{ $a->shipping->layanan_ekspedisi }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">harga layanan</label>
                                        <input type="number" name="no_rek" value="{{ $a->shipping->harga_layanan }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>


                            </div>




                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                              @if (auth()->user()->role == "admin" || auth()->user()->role == "kordinator")
                              <button type="submit" class="btn btn-primary">update no resi</button>
                              @else

                              @endif


                            </form>

                            </div>
                        </form>
                          </div>
                        </div>
                      </div>
                      @else
                      @endif
@endforeach




@endsection

@extends('dashboard.layouts.footer')
@extends('dashboard.layouts.endwrap')
