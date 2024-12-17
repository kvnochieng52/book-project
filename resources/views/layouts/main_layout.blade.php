<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kitabu Swap | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/vendor/signericafat.css">
    <link rel="stylesheet" href="/assets/css/vendor/cerebrisans.css">
    <link rel="stylesheet" href="/assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="/assets/css/vendor/elegant.css">
    <link rel="stylesheet" href="/assets/css/vendor/linear-icon.css">
    <link rel="stylesheet" href="/assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="/assets/css/plugins/easyzoom.css">
    <link rel="stylesheet" href="/assets/css/plugins/slick.css">
    <link rel="stylesheet" href="/assets/css/plugins/animate.css">
    <link rel="stylesheet" href="/assets/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/plugins/jquery-ui.css">
    <link rel="stylesheet" href="/assets/css/main_style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css" />



    @yield('css-scripts')

    <!-- Start of LiveChat (www.livechat.com) code -->

</head>

<body class=" hold-transition layout-top-nav">
    <div class="wrapper">
        <div class="main-wrapper box-layout-width-2">
            <header class="header-area">
                <div class="header-large-device">

                    <div class="header-middle header-middle-padding-2">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-2 col-lg-2">
                                    <div class="logo">

                                        <a href="/"><img src="/assets/images/logo/new_logo.png" alt="logo"></a>
                                    </div>
                                </div>
                                <div class="col-xl-7 col-lg-7">

                                    <div class="same-style same-style-mrg-2 language-wrap">

                                        <a href="/browse" class="btn btn-secondary">
                                            <i class="fas fa-search"></i> SEARCH BOOKS
                                        </a>

                                        <a href="/book/submit-book" class="btn btn-secondary">
                                            <i class="fas fa-plus"></i> SUBMIT BOOK
                                        </a>

                                    </div>

                                    {{-- {!! Form::open([
                                    'action' => 'App\Http\Controllers\BookController@search',
                                    'method' => 'GET',
                                    'class' => 'form candidate_form',
                                    'enctype' => 'multipart/form-data',
                                    ]) !!}

                                    <div class="row">

                                        <div class="col-md-4">

                                            {{ Form::select('category', App\Models\BookLevel::getBookLevels(), null,
                                            ['class' => 'form-control',
                                            'placeholder' => '--All Categories--']) }}
                                        </div>
                                        <div class="col-md-6">
                                            {{ Form::text('keywords', null, ['class' => 'form-control', 'placeholder'
                                            => 'Book Name or Title']) }}
                                        </div>
                                        <div class="col-md-2">

                                            <button type="submit" class="btn btn-success">Search</button>
                                        </div>

                                    </div>


                                    {!! Form::close() !!} --}}




                                    {{-- <div class="categori-style-1">
                                        <select class="nice-select nice-select-style-1">
                                            <option>All Categories </option>
                                            <option>Junior School </option>
                                            <option>Primary School</option>
                                            <option>Secondary School</option>
                                            <option>Higher Laearning</option>
                                            <option>Novel & Story Books</option>
                                        </select>
                                    </div> --}}
                                    {{-- <div class="search-wrap-3">

                                        <input placeholder="Search the book you want to exchange" type="text">
                                        <button><i class="lnr lnr-magnifier"></i></button>
                                        </form>
                                    </div> --}}

                                </div>
                                <div class="col-xl-3 col-lg-3">
                                    <div class="hotline-2-wrap">

                                        <div class="hotline-2-content">
                                            <?php if (auth()->check()) { ?>
                                            Welcome, <b>{{auth()->user()->name}}</b><br />
                                            {{-- <a href="" class="btn btn-sm btn-danger"></a> --}}


                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <a href="/dashboard" style="color: white"
                                                    class="btn btn-sm btn-info">Dashboard</a>
                                                <button type="submit">Logout</button>


                                            </form>
                                            <?php  } else { ?>
                                            <a href="/login" class="btn btn-success"
                                                style="color:white; font-size: 14px;"><i class="fas fa-user"></i>
                                                LOGIN/REGISTER</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-bottom">
                        <div class="container">
                            <div class="bg-green-2">
                                <div class="row">

                                    <div class="col-lg-9" style="padding-left: 25px">
                                        <div
                                            class="main-menu main-menu-white main-menu-padding-1 main-menu-font-size-14 main-menu-lh-5">
                                            <nav>
                                                <ul>
                                                    <li><a href="/">HOME </a>

                                                    </li>
                                                    <li><a href="/browse">BROWSE/SEARCH BOOKS </a>
                                                        <!-- <ul class="sub-menu-style">
                                                                                <li><a href="">Home version 1 </a></li>
                                                                                <li><a href="">Home version 2</a></li>
                                                                                <li><a href="">Home version 3</a></li>
                                                                                <li><a href="">Home version 4</a></li>
                                                                                <li><a href="">Home version 5</a></li>
                                                                                <li><a href="">Home version 6</a></li>
                                                                                <li><a href="">Home version 7</a></li>
                                                                                <li><a href="">Home version 8</a></li>
                                                                                <li><a href="">Home version 9</a></li>
                                                                                <li><a href="">Home version 10</a></li>
                                                                            </ul> -->
                                                    </li>
                                                    {{-- <li><a href="/">ABOUT US </a>

                                                    </li>

                                                    <li><a href="/">CONTACT </a></li> --}}
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>

                                    <div class="col-lg-3" style="padding-top: 13px">

                                        @auth
                                        <div class="header-action header-action-flex pr-20">

                                            <div
                                                class="same-style-2 same-style-2-white same-style-2-font-dec header-cart">
                                                <a class="cart-active" href="#">
                                                    <i class="icon-star"></i>
                                                    <span class="cart-amount white">Your Points:
                                                        {{App\Models\UserBookPoint::getUserPoints()}}</span>
                                                </a>
                                            </div>
                                        </div>
                                        @endauth
                                    </div>




                                </div>







                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-small-device small-device-ptb-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="mobile-logo">
                                    <a href="/">
                                        <img alt="" src="/assets/images/logo/new_logo.png" style="width: 150px">
                                    </a>
                                </div>
                            </div>



                        </div>




                        <div class="row">

                            <div class="col-6">

                                <?php if (auth()->check()) { ?>
                                <a href="/dashboard" class="btn btn-success btn-block">
                                    Your Points:<br />
                                    <strong>{{App\Models\UserBookPoint::getUserPoints()}}</strong>


                                </a>

                                <?php }else{ ?>


                                <div class="btn-group">

                                    <button type="button"
                                        class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Search or Submit Book</strong>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/browse">
                                            <strong> <i class="fas fa-search"></i> Search Books</strong>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/book/submit-book">

                                            <strong><i class="fas fa-book"></i> Submit Book</strong>

                                        </a>

                                    </div>
                                </div>


                                <?php } ?>


                            </div>

                            <div class="col-6">



                                <?php if (auth()->check()) { ?>

                                <div class="same-style-2 main-menu-icon" style="float: right">
                                    <a class="mobile-header-button-active" href="#">
                                        <b> <i class="icon-user"></i> {{auth()->user()->name}}</b>

                                        <i class="icon-arrow-down"></i>
                                    </a>
                                </div>

                                <?php }else{ ?>

                                <div class="btn-group" style="float: right">

                                    <button type="button"
                                        class="btn btn-block btn-primary btn-sm dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Login/Register
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/login">
                                            <strong> <i class="fas fa-user"></i> Login</strong>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/register">

                                            <strong><i class="fas fa-lock"></i> Register</strong>

                                        </a>

                                    </div>
                                </div>


                                <?php } ?>

                            </div>
                        </div>



                    </div>
                </div>
            </header>
            <!-- mobile header start -->
            <div class="mobile-header-active mobile-header-wrapper-style">
                <div class="clickalbe-sidebar-wrap">
                    <a class="sidebar-close"><i class="icon_close"></i></a>
                    <div class="mobile-header-content-area">
                        <div class="mobile-menu-wrap mobile-header-padding-border-2">
                            <!-- mobile menu start -->
                            <nav>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <ul class="mobile-menu">
                                        <li><a href="/dashboard">Dashboard</a></li>
                                        <li><a href="/book/submit-book">Submit Book</a></li>
                                        <li><a href="/dashboard/your-books">Your Books</a></li>
                                        <li><a href="/dashboard/mini-search">Search Book</a></li>
                                        <li><a href="/dashboard/your-orders">Your Orders</a></li>
                                        {{-- <li><a href="/">Settings</a></li> --}}

                                        <li><button type="submit" class="btn"
                                                style="padding-left: 0px !important">Logout</button></li>

                                    </ul>

                                </form>
                            </nav>
                            <!-- mobile menu end -->
                        </div>

                    </div>
                </div>
            </div>
            <!-- mini cart start -->
            <div class="sidebar-cart-active">
                <div class="sidebar-cart-all">
                    <a class="cart-close" href="#"><i class="icon_close"></i></a>
                    <div class="cart-content">
                        <h3>Shopping Cart</h3>
                        <ul>
                            <li class="single-product-cart">
                                <div class="cart-img">
                                    <a href="#"><img src="/assets/images/cart/cart-1.jpg" alt=""></a>
                                </div>
                                <div class="cart-title">
                                    <h4><a href="#">Simple Black T-Shirt</a></h4>
                                    <span> 1 × $49.00 </span>
                                </div>
                                <div class="cart-delete">
                                    <a href="#">×</a>
                                </div>
                            </li>
                            <li class="single-product-cart">
                                <div class="cart-img">
                                    <a href="#"><img src="/assets/images/cart/cart-2.jpg" alt=""></a>
                                </div>
                                <div class="cart-title">
                                    <h4><a href="#">Norda Backpack</a></h4>
                                    <span> 1 × $49.00 </span>
                                </div>
                                <div class="cart-delete">
                                    <a href="#">×</a>
                                </div>
                            </li>
                        </ul>
                        <div class="cart-total">
                            <h4>Subtotal: <span>$170.00</span></h4>
                        </div>
                        <div class="cart-checkout-btn">
                            <a class="btn-hover cart-btn-style" href="cart.html">view cart</a>
                            <a class="no-mrg btn-hover cart-btn-style" href="checkout.html">checkout</a>
                        </div>
                    </div>
                </div>
            </div>


            @yield('content')


            <footer class="footer-area pt-95">
                {{-- <div class="footer-top border-bottom-4 pb-55">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="footer-widget mb-40">
                                    <h3 class="footer-title">About Us</h3>
                                    <div class="footer-info-list info-list-50-parcent">
                                        <p>Concept is to offer fashion and quality at the best price. It has since it
                                            was
                                            founded in 2018 grown into one of the best WooCommerce Fashion Theme. The
                                            content of this site is copyright-protected and is the property
                                            of David Moye Creative.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="footer-widget ml-70 mb-40">
                                    <h3 class="footer-title">useful links</h3>
                                    <div class="footer-info-list">
                                        <ul>
                                            <li><a href="my-account.html">My Account</a></li>
                                            <li><a href="wishlist.html">My Wishlish</a></li>
                                            <li><a href="#">Term & Conditions</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                            <li><a href="#">Track Order</a></li>
                                            <li><a href="#">Shop</a></li>
                                            <li><a href="about-us.html">About Us</a></li>
                                            <li><a href="#">Returns/Exchange</a></li>
                                            <li><a href="#">FAQs</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="footer-widget mb-40 ">
                                    <h3 class="footer-title">Contact Us</h3>
                                    <div class="contact-info-2">
                                        <div class="single-contact-info-2">
                                            <div class="contact-info-2-icon">
                                                <i class="icon-call-end"></i>
                                            </div>
                                            <div class="contact-info-2-content">
                                                <p>Got a question? Call us 24/7</p>
                                                <h3 class="green-2">(254) 713 295 853 </h3>
                                            </div>
                                        </div>
                                        <div class="single-contact-info-2">
                                            <div class="contact-info-2-icon">
                                                <i class="icon-cursor icons"></i>
                                            </div>
                                            <div class="contact-info-2-content">
                                                <p>268 Orchard St, Mahattan, 12005, CA, United State</p>
                                            </div>
                                        </div>
                                        <div class="single-contact-info-2">
                                            <div class="contact-info-2-icon">
                                                <i class="icon-envelope-open "></i>
                                            </div>
                                            <div class="contact-info-2-content">
                                                <p>contact@norda.com</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="social-style-1 social-style-1-font-inc social-style-1-mrg-2">
                                        <a href="#"><i class="icon-social-twitter"></i></a>
                                        <a href="#"><i class="icon-social-facebook"></i></a>
                                        <a href="#"><i class="icon-social-instagram"></i></a>
                                        <a href="#"><i class="icon-social-youtube"></i></a>
                                        <a href="#"><i class="icon-social-pinterest"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="footer-bottom pt-30 pb-30" style="border-top:1px solid #ccc">
                    <div class="container">
                        <div class="row">


                            <div class="col-lg-7 col-md-7">
                                <div>

                                    <p style="font-size:18px; margin-bottom:10px"><i class="fas fa-envelope"></i>
                                        info@kitabuswap.com &nbsp; |&nbsp; <i class="fas fa-phone"></i> +254728535001
                                        &nbsp;|
                                        &nbsp;
                                        <a href="">Terms &
                                            Conditions</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5">
                                <div class="copyright" style="text-align: right">

                                    <p style="font-size:18px">Copyright © 2023 Kitabu Swap.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="/assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/plugins/slick.js"></script>
    <script src="/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="/assets/js/plugins/jquery.instagramfeed.min.js"></script>
    <script src="/assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="/assets/js/plugins/wow.js"></script>
    <script src="/assets/js/plugins/jquery-ui-touch-punch.js"></script>
    <script src="/assets/js/plugins/jquery-ui.js"></script>
    <script src="/assets/js/plugins/magnific-popup.js"></script>
    <script src="/assets/js/plugins/sticky-sidebar.js"></script>
    <script src="/assets/js/plugins/easyzoom.js"></script>
    <script src="/assets/js/plugins/scrollup.js"></script>
    <script src="/assets/js/plugins/ajax-mail.js"></script>
    <script src="/assets/js/main.js"></script>

    @yield('js-scripts')

    <!-- Start of LiveChat (www.livechat.com) code -->
    {{-- <script>
        window.__lc = window.__lc || {};
        window.__lc.license = 16906206;
        ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
    </script>
    <noscript><a href="https://www.livechat.com/chat-with/16906206/" rel="nofollow">Chat with us</a>, powered by <a
            href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
    --}}
    <!-- End of LiveChat code -->
</body>

</html>