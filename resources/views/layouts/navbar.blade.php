@section('navbar')


<!-- Header section -->
<header class="header-section">
    <div class="container-fluid">
        <!-- logo -->
        <div class="site-logo">
            <img src="{{ asset('plaza/img/logi.png') }}" alt="logo">
        </div>
        <!-- responsive -->
        <div class="nav-switch">
            <i class="fa fa-bars"></i>
        </div>
        <div class="header-right">
            <a href="{{ url('/cart') }}" class="card-bag"><img src="{{ asset('plaza/img/icons/bag.png') }}" alt=""><span>2</span></a>
            <a href="#" class="search"><img width="30px" src="{{ asset('plaza/img/icons/icoo.png') }}" alt=""></a>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>



        <!-- site menu -->
        <ul class="main-menu">
            <li><a href="index.html">Home</a></li>
            <li><a  href="#section1">Product</a></li>
            {{-- <li><a href="#">Man</a></li> --}}
            {{-- <li><a href="#">LookBook</a></li>
            <li><a href="#">Blog</a></li> --}}
            <li><a href="contact.html">Contact</a></li>

            {{-- <li><a href="{{ route('login') }}">login</a></li>
            <li><a href="{{ route('register') }}">register</a></li> --}}
        </ul>
    </div>
</header>
<!-- Header section end -->



@endsection
