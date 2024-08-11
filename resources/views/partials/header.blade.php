<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>@yield('title')</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <script src="https://kit.fontawesome.com/a351b990a2.js" crossorigin="anonymous"></script>

    <!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Email: </strong>{{ Auth::user()->email }}
                    &nbsp;&nbsp;
                    <strong>Support: </strong>{{ Auth::user()->no_telp }}
                </div>

            </div>
        </div>
    </header>
    <!-- HEADER END-->
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                @if (Auth::user()->level == 'merchant')
                    <a class="navbar-brand" href="{{ route('merchant') }}">
                        <h1 style="color :white; position:relative; text-align:center;">Catering</h1>
                        {{-- <img src="assets/img/logo.png" /> --}}
                    </a>
                @elseif(Auth::user()->level == 'kantor')
                    <a class="navbar-brand" href="{{ route('kantor') }}">
                        <h1 style="color :white; position:relative; text-align:center;">
                            {{ Auth::user()->nama_perusahaan }}</h1>
                        {{-- <img src="assets/img/logo.png" /> --}}
                    </a>
                @endif

            </div>

            <div class="left-div">
                <i class="fas fa-utensils login-icon"></i>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            {{-- <li><a class="menu-top-active" href="index.html">Dashboard</a></li> --}}
                            @if (Auth::user()->level == 'merchant')
                                <li><a href="{{ route('merchant') }}">Dashboard</a></li>
                                <li><a href="{{ route('DataMakanan') }}">Data Menu</a></li>
                                <li><a href="forms.html">Daftar Orderan</a></li>
                                <li><a href="login.html">Invoice</a></li>
                                <li><a href="{{ route('logout') }}">Logout</a></li>
                            @elseif(Auth::user()->level == 'kantor')
                                <li><a href="{{ route('merchant') }}">Dashboard</a></li>
                                <li><a href="#">Menu</a></li>
                                <li><a href="forms.html">Daftar Orderan</a></li>
                                <li><a href="login.html">Invoice</a></li>
                                <li><a href="{{ route('logout') }}">Logout</a></li>
                            @endif

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->
