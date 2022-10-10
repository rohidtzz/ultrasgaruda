<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Ultras Garuda Indonesia</title>
	<meta charset="UTF-8">
	<meta name="description" content="Ultras Garuda Indonesia Seizone Tangerang">
	<meta name="keywords" content="Ultras Garuda">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="{{ asset('ico/ico.ico') }}" rel="shortcut icon"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <style>
.card-body{-ms-flex: 1 1 auto;flex: 1 1 auto;padding: 1.40rem}.img-sm{width: 80px;height: 80px}.itemside .info{padding-left: 15px;padding-right: 7px}.table-shopping-cart .price-wrap{line-height: 1.2}.table-shopping-cart .price{font-weight: bold;margin-right: 5px;display: block}.text-muted{color: #969696 !important}a{text-decoration: none !important}.card{position: relative;display: -ms-flexbox;display: flex;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0,0,0,.125);border-radius: 0px}.itemside{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100%}.dlist-align{display: -webkit-box;display: -ms-flexbox;display: flex}[class*="dlist-"]{margin-bottom: 5px}.coupon{border-radius: 1px}.price{font-weight: 600;color: #212529}.btn.btn-out{outline: 1px solid #fff;outline-offset: -5px}.btn-main{border-radius: 2px;text-transform: capitalize;font-size: 15px;padding: 10px 19px;cursor: pointer;color: #fff;width: 100%}.btn-light{color: #ffffff;background-color: #F44336;border-color: #f8f9fa;font-size: 12px}.btn-light:hover{color: #ffffff;background-color: #F44336;border-color: #F44336}.btn-apply{font-size: 11px}

        body {
          position: relative;
        }









        #section2 {padding-top:50px;height:500px;color: #fff; background-color: #673ab7;}
        #section3 {padding-top:50px;height:500px;color: #fff; background-color: #ff9800;}
        #section41 {padding-top:50px;height:500px;color: #fff; background-color: #00bcd4;}
        #section42 {padding-top:50px;height:500px;color: #fff; background-color: #009688;}
        </style>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{ asset('plaza/css/bootstrap.min.css') }}"/>
	{{-- <link rel="stylesheet" href="{{ asset('plaza/css/font-awesome.min.css') }}"/> --}}
	<link rel="stylesheet" href="{{ asset('plaza/css/owl.carousel.css') }}"/>
	 <link rel="stylesheet" href="{{ asset('plaza/css/style.css') }}"/>
	<link rel="stylesheet" href="{{ asset('plaza/css/animate.css') }}"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
    <body data-spy="scroll" data-target=".navbar" data-offset="50">


        @yield('navbar')
        @yield('navcart')
        @yield('cart')
        @yield('hero')
        @yield('product')
        @yield('footer')




        <!--====== Javascripts & Jquery ======-->
        <script src="{{ asset('plaza/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('plaza/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plaza/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('plaza/js/mixitup.min.js') }}"></script>
        <script src="{{ asset('plaza/js/sly.min.js') }}"></script>
        <script src="{{ asset('plaza/js/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('plaza/js/main.js') }}"></script>



{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}


<script>

$(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){

        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });

});

</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/634411e454f06e12d8995919/1gf0ubq02';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    </body>
</html>
