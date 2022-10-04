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
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Size</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Qty</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">users</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th> --}}
                    {{-- <th class="text-secondary opacity-7"></th> --}}
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
                    <td>
                        <p class="text-xs text-center font-weight-bold mb-0">
                            @foreach (json_decode($a->data) as $dat=>$value)
                            {{-- {{dd(json_encode($value->id))}} --}}
                                {{-- {{ $value->id }} --}}
                               {{-- <span>Qty: </span> {{ $value->qty }} <br> --}}



                                {{-- <span>Size: </span>{{ $value->size }},
                                <br> --}}
                                {{$value->size}}

                                {{-- <br> --}}
                                {{-- @foreach ($value as $kim )
                                    {{ dd($kim) }}
                                @endforeach --}}
                            @endforeach</p>
                      </td>
                    <td class="align-middle text-center text-sm">
                      <span class="">{{ $a->qty }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <span class="">{{ App\Models\User::find($a->user_id)->name }}</span>
                      </td>

                      <td class="align-middle text-center text-sm">
                        <span class="">
                            @foreach (json_decode($a->data) as $dat=>$value)
                            {{-- {{dd(json_encode($value->id))}} --}}
                                {{-- {{ $value->id }} --}}
                               {{-- <span>Qty: </span> {{ $value->qty }} <br> --}}



                                {{-- <span>Size: </span>{{ $value->size }},
                                <br> --}}
                                {{App\Models\Product::find($value->product_id)->name }}
                                {{$value->qty}} |

                                {{-- <br> --}}
                                {{-- @foreach ($value as $kim )
                                    {{ dd($kim) }}
                                @endforeach --}}
                            @endforeach



                        </span>
                      </td>

                    <td class="text-center align-middle">
                      {{-- <a type="button" data-id="{{$a->id}}"  class="text-primary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Accept
                      </a> --}}


                      @if (Auth()->user()->role == "admin" || Auth()->user()->role == "kordinator")

                      {{-- @if ($a->status == "unpaid") --}}
                      @if($a->nama_pengirim)
                      <a type="button" data-id="{{$a->id}}" style="padding-left:10px;" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Detail
                      </a>

                      @endif

                      @if($a->status == "validation")
                      <a type="button" onclick="return confirm('are you sure?')" href="{{ url('/home/transaction/accept/'.$a->id) }}" style="padding-left:10px;" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" >
                        Accept
                      </a>

                      <a style="padding-left:10px;"  onclick="return confirm('are you sure?')" href="{{ url('/home/transaction/reject/'.$a->id) }}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Reject
                      </a>
                      @endif

                      @if($a->status == "reject")
                      <a type="button" data-id="{{$a->id}}" style="padding-left:10px;" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Detail
                      </a>
                      @endif











                      @elseif (Auth()->user()->role == "user")

                      @if ($a->status == "unpaid")
                      <a type="button" data-id="{{$a->id}}"  style="padding-left:10px;" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Detail
                      </a>

                      <a style="padding-left:10px;"  onclick="return confirm('are you sure?')" href="{{ url('/home/transaction/cancel/'.$a->id) }}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Cancel
                      </a>
                      @endif

                      @if ($a->status == "validation")
                      <a type="button" data-id="{{$a->id}}" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Detail
                      </a>
                      @endif

                      @if ($a->status == "payment successful")
                      <a type="button" data-id="{{$a->id}}" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Detail
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

                        @if($a->nama_pengirim)
                        <div class="modal-body">
                                <span>Pembayaran Anda Sedang Divalidasi</span><br>
                                <span>Contact Person jika ada kendala: 089612121703 (rohid) </span>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Atas nama Bank Pengirim</label>
                                    <input type="text" name="nama_bank" value="{{ $a->nama_bank }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"disabled>
                                    <div id="emailHelp" class="form-text"></div>
                                  </div>

                                <div class="mb-3">
                                  <label for="exampleInputEmail1" class="form-label">Atas nama Bank Pengirim</label>
                                  <input type="text" name="nama_pengirim" value="{{ $a->nama_pengirim }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"disabled>
                                  <div id="emailHelp" class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">NO Rek Bank Pengirim</label>
                                    <input type="number" name="no_rek" value="{{ $a->no_rek }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                    <div id="emailHelp" class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                  <label for="exampleInputPassword1" class="form-label">Bukti Transfer</label>
                                  <picture>
                                    <source srcset="{{ asset('trans/img/'.$a->bukti_image) }}" type="image/svg+xml">
                                    <img src="{{ asset('trans/img/'.$a->bukti_image) }}" class="img-fluid img-thumbnail" alt="...">
                                  </picture>
                                  {{-- <img src="{{ asset('trans/img/'.$a->bukti_image) }}" wi alt=""> --}}
                                </div>
                        </div>
                        @else
                        <div class="modal-body">
                            <form method="POST" action="{{ url('/home/transaction/detail/post') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $a->id }}">
                                <span> Transfer ke Rekening BCA:</span><br>
                                <span>BCA: 252529179 | A/n Rohid ammar firdaus </span>
                                <p>Isi Form Di bawah ini berserta Bukti Transfer </p>
                                <p>Jumlah Yang Harus dibayar Rp. {{ number_format($a->total) }}</p>
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
                                  <input type="file" name="bukti_image" class="form-control" id="exampleInputPassword1">
                                </div>
                        </div>
                        @endif


                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          @if ($a->nama_pengirim)

                          @else
                          <button type="submit" class="btn btn-primary">Submit Payment</button>
                          @endif

                        </div>
                    </form>
                      </div>
                    </div>
                  </div>

                @endforeach





                {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet"> --}}


                {{-- <style type="text/css">
                    .pagination li{
                        float: left;
                        list-style-type: none;
                        margin:5px;
                    }
                </style> --}}

                    {{-- <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user2">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Alexa Liras</h6>
                          <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Programator</p>
                      <p class="text-xs text-secondary mb-0">Developer</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                    </td>
                    <td class="align-middle">
                      <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Edit
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user3">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                          <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Executive</p>
                      <p class="text-xs text-secondary mb-0">Projects</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success">Online</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                    </td>
                    <td class="align-middle">
                      <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Edit
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user4">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Michael Levi</h6>
                          <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Programator</p>
                      <p class="text-xs text-secondary mb-0">Developer</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success">Online</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">24/12/08</span>
                    </td>
                    <td class="align-middle">
                      <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Edit
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user5">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Richard Gran</h6>
                          <p class="text-xs text-secondary mb-0">richard@creative-tim.com</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Manager</p>
                      <p class="text-xs text-secondary mb-0">Executive</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                    </td>
                    <td class="align-middle">
                      <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Edit
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user6">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Miriam Eric</h6>
                          <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Programtor</p>
                      <p class="text-xs text-secondary mb-0">Developer</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">14/09/20</span>
                    </td>
                    <td class="align-middle">
                      <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Edit
                      </a>
                    </td>
                  </tr> --}}
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




@endsection

@extends('dashboard.layouts.footer')
@extends('dashboard.layouts.endwrap')
