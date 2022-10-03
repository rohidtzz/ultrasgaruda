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
                <form class="" action="{{ url('/home/transaction/search') }}" method="post">
                <div class="input-group">

                  <span style="height: 50px" class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>


                        @csrf
                        <input name="search" style="height: 50px" type="text" class="form-control" placeholder="Type here...">
                        <button type="submit" style="height: 50px" class=" btn btn-primary">Search</button>

                </div>

            </div>
        </form>
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

                      <a type="button" data-id="{{$a->id}}"  style="padding-left:10px;" class="text-info font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Detail
                      </a>

                      <a style="padding-left:10px;"  onclick="return confirm('are you sure?')" href="{{ url('/home/product/delete/'.$a->id) }}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Reject
                      </a>
                    </td>


                  </tr>

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
