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
              <h3 class="mb-0">Users Table</h3>
              <div class="justify-content-end ms-auto ">
                @if (Auth()->user()->role =="admin" || Auth()->user()->role =="kordinator")


                <form class="" action="{{ url('/home/users/search') }}" method="post">
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
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">No hp</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender</th>
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
                            <h6 class="mb-0 text-sm text-center">{{ $a->name }}</h6>

                          </div>
                    </td>
                    <td>
                         <div class="text-center">
                            <div>
                                <h6 class="mb-0 text-sm text-center">
                                    {{-- {{ $a->status }} --}}

                                            {{ $a->email }}
                                </h6>

                          </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0 text-center">{{ $a->username }}</p>
                    </td>

                    <td class="align-middle text-center text-sm">
                      <span class="">
                        {{ $a->no_hp }}
                      </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <span class="">{{ $a->role }}</span>
                      </td>

                      <td class="align-middle text-center text-sm">


                        <span>
                            {{ $a->gender }}
                        </span>
                      </td>


                    <td class="text-center align-middle">
                        <a type="button" data-id="{{$a->id}}"  class="text-primary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModa-{{ $a->id }}" >
                            Edit
                          </a>

                          <a style="padding-left:10px;"  onclick="return confirm('are you sure?')" href="{{ url('/home/users/delete/'.$a->id) }}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                            Delete
                          </a>
                    </td>

                    @foreach ($all as $al )


                    <div class="modal fade" id="exampleModa-{{ $al->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Modal Edit Users</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ url('/home/users/edit/') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $al->id }}">
                                    <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">Name</label>
                                      <input type="text" name="name" value="{{ $al->name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                      <div id="emailHelp" class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                      <label for="exampleInputPassword1" class="form-label">Email</label>
                                      <input type="text" name="email" value="{{ $al->email }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Username</label>
                                        <input type="text" name="username" value="{{ $al->username }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                        <div id="emailHelp" class="form-text"></div>
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Password</label>
                                        <input type="text" name="password" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text"></div>
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">No hp</label>
                                        <input type="number" name="no_hp" value="{{ $al->no_hp }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                        <div id="emailHelp" class="form-text"></div>
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Role</label>
                                        <select name="role" class="form-control" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ...">
                                            @if ($al->role == 'admin')
                                            <option value="admin" selected>Admin</option>
                                            <option value="kordinator">Kordinator</option>
                                            <option value="user">User</option>
                                            @elseif ($al->role == 'kordinator')
                                            <option value="admin" >Admin</option>
                                            <option value="kordinator" selected>Kordinator</option>
                                            <option value="user">User</option>
                                            @elseif ($al->role == "user")
                                            <option value="admin" >Admin</option>
                                            <option value="kordinator" >Kordinator</option>
                                            <option value="user" selected>User</option>
                                            @else
                                            <option value="admin" >Admin</option>
                                            <option value="kordinator" >Kordinator</option>
                                            <option value="user" selected>User</option>
                                            @endif
                                        </select>
                                        <div id="emailHelp" class="form-text"></div>
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Gender</label>
                                        <select name="gender" class="form-control" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ...">
                                            @if ($al->gender == 'pria')
                                            <option value="pria" selected>Pria</option>
                                            <option value="wanita">wanita</option>
                                            @else
                                            <option value="pria" >Pria</option>
                                            <option value="wanita" selected>wanita</option>
                                            @endif


                                        </select>
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

{{-- asdasd --}}


@endsection

@extends('dashboard.layouts.footer')
@extends('dashboard.layouts.endwrap')
