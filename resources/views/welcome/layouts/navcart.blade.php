@section('navcart')
<!-- Header section -->
<header style="" class="header-section">
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
            <a href="{{ url('/cart') }}" class="card-bag"><img src="{{ asset('plaza/img/icons/bag.png') }}" alt=""><span>{{ $cart }}</span></a>
            <a href="{{ url('/home/transaction') }}" class="search"><img width="30px" src="{{ asset('plaza/img/icons/icoo.png') }}" alt=""></a>
        </div>



        <!-- site menu -->
        <ul class="main-menu">
            <li><a  href="{{ url('/') }}">Home</a></li>
            <li><a  href="{{ url('/#section1') }}">Product</a></li>
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
