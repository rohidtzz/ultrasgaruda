@extends('dashboard.layouts.master')
@extends('dashboard.layouts.sidebar')
@extends('dashboard.layouts.wrap')
@extends('dashboard.layouts.navbar')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">

            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <h3 class="mb-0">Products Table</h3>
                  <div class="justify-content-end ms-auto ">
                    <div class="input-group">


                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Create Product
                      </button>

                    </div>
                </div>
                </div>
              </div>
              <br>

              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal Create Product</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('/home/product/create') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Name</label>
                              <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                              <div id="emailHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">img</label>
                              <input type="file" name="image" class="form-control" id="exampleInputPassword1">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                <div id="emailHelp" class="form-text"></div>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                <div id="emailHelp" class="form-text"></div>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Size</label>
                                <input type="text" name="size" value="S,M,L,XL,XXL" class="form-control"  aria-describedby="emailHelp" disabled>
                                <div id="emailHelp" class="form-text"></div>
                              </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>



          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Img</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Desc</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stock</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Size</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
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
                            <h6 class="mb-0 text-sm text-center">{{ $a->name }}</h6>
                          </div>
                    </td>
                    <td>
                         <div class="text-center">
                            <div>
                            <img src="{{ asset('/product/img/'.$a->image) }}" class="avatar avatar-xl me-3" alt="user1">
                          </div>
                      </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0 text-center">{{ $a->desc }}</p>
                      </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0 text-center">Rp.{{ number_format($a->price) }}</p>
                    </td>
                    <td>
                        <p class="text-xs text-center font-weight-bold mb-0">{{ $a->stock }}</p>
                      </td>
                    <td class="align-middle text-center text-sm">
                      <span class="">{{ $a->size }}</span>
                    </td>

                    <td class="text-center align-middle">
                      <a type="button" data-id="{{$a->id}}"  class="text-primary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                        Edit
                      </a>






                      <a style="padding-left:10px;"  onclick="return confirm('are you sure?')" href="{{ url('/home/product/delete/'.$a->id) }}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Delete
                      </a>
                    </td>

                    @foreach ($all as $al )


                    <div class="modal fade" id="exampleModa-{{ $al->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Modal Edit Product</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ url('/home/product/edit/') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $al->id }}">
                                    <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">Name</label>
                                      <input type="text" name="name" value="{{ $al->name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                      <div id="emailHelp" class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                      <label for="exampleInputPassword1" class="form-label">img</label>
                                      <input type="file" name="image" class="form-control" id="exampleInputPassword1">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Price</label>
                                        <input type="number" name="price" value="{{ $al->price }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                        <div id="emailHelp" class="form-text"></div>
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Desc</label>
                                        <input type="text" name="desc" value="{{ $al->desc }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                        <div id="emailHelp" class="form-text"></div>
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Stock</label>
                                        <input type="number" name="stock" value="{{ $al->stock }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                        <div id="emailHelp" class="form-text"></div>
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Size</label>
                                        <input type="text" name="sizes" value="S,M,L,XL,XXL" class="form-control"  aria-describedby="emailHelp" disabled>
                                        <div id="emailHelp" class="form-text"></div>
                                      </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                          </div>
                        </div>
                      </div>
                      @endforeach

                  </tr>
                @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>




@endsection

@extends('dashboard.layouts.footer')
@extends('dashboard.layouts.endwrap')
