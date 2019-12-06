<!--

=========================================================
* Argon Dashboard - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
      Redeem Coupon App - SCORE SPORTS AND LOUNGE
  </title>
  <!-- Favicon -->
<link href="{{asset('img/brand/score.png')}}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
<link href="{{asset('js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
<link href="{{asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
<link href="{{asset('css/argon-dashboard.css?v=1.1.0')}}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="{{asset('js/plugins/fancybox-master/dist/jquery.fancybox.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <div class="row justify-content-center">
        <div class="col text-center">
            <img src="{{asset('img/brand/score.png')}}" width="200">
        </div>
      </div>
      <a class="navbar-brand pt-0" href="">
        <br>
        Admin Page
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <!-- <img alt="Image placeholder" src="./assets/img/theme/team-1-800x800.jpg"> -->
              </span>
            </div>
          </a>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <!-- <img src="./assets/img/brand/blue.png"> -->
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item"  class="active">
            <a class=" nav-link @yield('customer')" href="{{route('customer.index')}}"> <i class="fas fa-users fa-fw text-primary"></i> 
              Customer
            </a>
            <a class=" nav-link @yield('redeem')" href="{{route('point.index')}}"> <i class="fas fa-coins fa-fw text-primary"></i> 
              Redeem
            </a>
            <a class=" nav-link @yield('transaction')" href="{{route('admin.transaksi.index')}}"> <i class="fas fa-receipt fa-fw text-primary"></i> 
              History
            </a>
            <a class=" nav-link @yield('setting')" href="{{route('rule.index')}}"> <i class="fas fa-cog fa-fw text-primary"></i> 
              Setting
            </a>
            <a class="nav-link" href="{{route('auth.logout')}}"> <i class="fas fa-sign-out-alt fa-fw text-primary"></i> 
              Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="main-content">

    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">@yield("brand")</a>
            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
              <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media align-items-center">
                      <span class="avatar avatar-sm rounded-circle">
                        <!-- <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg"> -->
                        <i class="fa fa-user"></i>
                      </span>
                      <div class="media-body ml-2 d-none d-lg-block">
                        <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->name}}</span>
                      </div>
                  </div>
                </a>
            </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
          @if (session('message'))
            @component('component.alert')
              {{ session('message') }}
            @endcomponent
          @endif
          @if ($errors->any())
            @component('component.alert')
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
            @endcomponent
          @endif
        </div>
    </div>

    <!-- CONTENT -->
    @yield('content')
    <!-- END CONTENT -->
  </div>

  <!--   Core   -->
<script src="{{asset('js/plugins/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!--   Optional JS   -->
<script src="{{asset('js/plugins/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{asset('js/plugins/chart.js/dist/Chart.extension.js')}}"></script>
<script src="{{asset('js/plugins/numeraljs/min/numeral.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.0/b-colvis-1.6.0/b-html5-1.6.0/b-print-1.6.0/r-2.2.3/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="{{asset('js/plugins/jquery-number-master/jquery.number.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/fancybox-master/dist/jquery.fancybox.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/datatable/pipelining.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
<!-- App scripts -->
@stack("scripts")
<!--   Argon JS   -->
<script src="{{asset('js/argon-dashboard.min.js?v=1.1.0')}}"></script>
<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
<script src="{{asset('js/custom.js')}}"></script>
</body>

</html>