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


        @if (Auth::check())
                <div class="header-right">
            <a href="{{ url('/cart') }}" class="card-bag"><img src="{{ asset('plaza/img/icons/bag.png') }}" alt=""><span>{{ $cart  }}</span></a>
            <a href="{{ url('/home/transaction') }}" class="search"><img width="30px" src="{{ asset('plaza/img/icons/icoo.png') }}" alt=""></a>
        </div>
        @else
        <div class="header-right">
            <a  href="{{ url('login') }}"><button style="display: inline-block;
                font-size: 14px;
                text-transform: uppercase;
                font-weight: 600;
                color: #fff;
                padding: 1px 5px 0px;
                margin-left: 50px;" class="btn btn-info">login</button>
            </a>

            <a  href="{{ url('register') }}"><button style="
                font-size: 14px;
                text-transform: uppercase;
                font-weight: 600;
                color: #fff;
                padding: 1px 5px 0px;
                " class="btn btn-info">register</button>
            </a>
        </div>
        @endif






        <!-- site menu -->
        <ul class="main-menu">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a  href="#section1">Product</a></li>
            {{-- <li><a href="#">Man</a></li> --}}
            {{-- <li><a href="#">LookBook</a></li>
            <li><a href="#">Blog</a></li> --}}
            <li><a href="https://wa.me/62085156850530">Contact</a></li>

            {{-- <li><a href="{{ route('login') }}">login</a></li>
            <li><a href="{{ route('register') }}">register</a></li> --}}
        </ul>
    </div>


</header>
<!-- Header section end -->



@endsection
