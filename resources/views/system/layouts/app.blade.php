<!DOCTYPE html>
<html lang="en" data-footer="true">
 
@php
$path = explode('/', request()->path());
$path[1] = (array_key_exists(1, $path)> 0)?$path[1]:'';
$path[2] = (array_key_exists(2, $path)> 0)?$path[2]:'';
$path[0] = ($path[0] === '')?'documents':$path[0];
@endphp
<?php

 
$path = explode('/', request()->path());
 $firstLevel = $path[0] ?? null;
$secondLevel = $path[1] ?? null;
$thridLevel = $path[2] ?? null;

?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Facturación Electrónica</title>
    <link rel="stylesheet" href="{{ asset('porto-light/css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('porto-light/css/custom.css') }}" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('acorn_dashboard/font/CS-Interface/style.css') }}" />
    <!-- Font Tags End -->
    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="{{ asset('acorn_dashboard/css/vendor/bootstrap.min.css') }}" />
 
    <link rel="stylesheet" href="{{ asset('acorn_dashboard/css/vendor/OverlayScrollbars.min.css') }}" />
    <!-- Vendor Styles End -->
     <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="{{ asset('acorn_dashboard/css/styles.css') }}" />
    <!-- Template Base Styles End -->
    <link rel="stylesheet" href="{{ asset('acorn_dashboard/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('acorn/css/theme-chalk.css') }}">
    <link rel="stylesheet" href="{{ asset('porto-light/vendor/font-awesome/5.11/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('acorn_dashboard/css/main.css') }}" />
    <script src="{{ asset('acorn_dashboard/js/base/loader.js') }}"></script>
 <style>
.card .card-body, .card .card-footer, .card .card-header {
    padding: 10px !important;
}
@media (min-width: 1400px){
.container, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
    max-width: 100% !important;
}
}
.progress1 {
  width: 70px;
  height: 70px;
  background: none;
  position: relative;
}

.progress1::after {
  content: "";
  width: 100%;
  height: 100%;
  border-radius: 50%;
  border: 6px solid #eee;
  position: absolute;
  top: 0;
  left: 0;
}

.progress1>span {
  width: 50%;
  height: 100%;
  overflow: hidden;
  position: absolute;
  top: 0;
  z-index: 1;
}

.progress1 .progress1-left {
  left: 0;
}

.progress1 .progress1-bar {
  width: 100%;
  height: 100%;
  background: none;
  border-width: 6px;
  border-style: solid;
  position: absolute;
  top: 0;
}

.progress1 .progress1-left .progress1-bar {
  left: 100%;
  border-top-right-radius: 80px;
  border-bottom-right-radius: 80px;
  border-left: 0;
  -webkit-transform-origin: center left;
  transform-origin: center left;
}

.progress1 .progress1-right {
  right: 0;
}

.progress1 .progress1-right .progress1-bar {
  left: -100%;
  border-top-left-radius: 80px;
  border-bottom-left-radius: 80px;
  border-right: 0;
  -webkit-transform-origin: center right;
  transform-origin: center right;
}

.progress1 .progress1-value {
  position: absolute;
  top: 0;
  left: 0;
  font-size: 1rem;
  font-weight: bold;
}
.widget-summary .summary .amount {
    font-size: 1.1rem;
}
@media (max-width: 1440px) {
  .widget-summary .summary .amount {
      font-size: 0.8rem;
  }
}

.notifications .notification-menu {
    width: 280px;
}
/* .notifications .notification-menu .notification-title {
    border-radius: 3px;
} */

.widget-summary .summary {
    word-break: break-word;
}
 </style>
 

</head>

<body>
    <div id="root">
        <div id="nav" class="nav-container d-flex">
          <div class="nav-content d-flex">
            <!-- Logo Start -->
            <div class="logo position-relative">
              <a href="dashboard">
                <!-- Logo can be added directly -->
                <!-- <img src="img/logo/logo-white.svg" alt="logo" /> -->
  
                <!-- Or added via css to provide different ones for different color themes -->
                <div class="img"></div>
              </a>
            </div>
            <!-- Logo End -->
  
          <!-- User Menu Start -->
          <div class="user-container d-flex">
            <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{-- <img class="profile" alt="profile" src="img/profile/profile-9.webp" /> --}}
              <div class="border rounded-circle text-center profile"><i class="fa fa-user fa-lg mt-2"></i></div>
              <div class="name">
                <span class="name">{{ \Auth::getUser()->name }}</span><br>
                <span class="role">{{ \Auth::getUser()->email }}</span>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end user-menu wide">
                <div class="row  ms-0 me-0">
                    <div class="col-12 pe-1 ps-1">
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ route('system.users.create') }}">
                                    <i class="fas fa-user"></i>
                                    <span class="align-middle">Perfil</span>
                                </a>
                                
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    <span class="align-middle">Cerrar Sessión</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
          </div>
          <!-- User Menu End -->
  
            <!-- Icons Menu Start -->
            <ul class="list-unstyled list-inline text-center menu-icons">
              
            
              <li class="list-inline-item">
                <a href="#" id="colorButton">
                  <i data-acorn-icon="light-on" class="light" data-acorn-size="18"></i>
                  <i data-acorn-icon="light-off" class="dark" data-acorn-size="18"></i>
                </a>
              </li>
          
            </ul>
            <!-- Icons Menu End -->
  
            <!-- Menu Start -->
            <div class="menu-container flex-grow-1">
                {{-- @include('system.layouts.partials.header') --}}
              <ul id="menu" class="menu">
                <li>
                    <a href="{{route('system.dashboard')}}" class="{{ (in_array($path[0], ['clients', 'dashboard'])) ? 'active':'' }}">
                        <i class="fas fa-chart-line"></i>&nbsp;&nbsp;
                        <span class="label">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a  href="{{route('system.plans.index')}}" class="{{ ($path[0] === 'plans') ? 'active':'' }}">
                        <i class="fas fa-shopping-cart"></i>&nbsp;&nbsp;<span>Planes</span>
                    </a>
                </li>
                <li >
                    <a href="{{route('system.accounting.index')}}" class="{{ ($path[0] === 'accounting') ? 'active':'' }}">
                        <i class="fas fa-calculator"></i>&nbsp;&nbsp;<span>Contabilidad</span>
                    </a>
                </li>
                <li >
                    <a href="{{route('system.configuration.index')}}" class="{{ ($path[0] === 'configurations') ? 'active':'' }}">
                        <i class="fas fa-cogs"></i>&nbsp;&nbsp;<span>Configuracion</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('system.update')}}" class="{{ ($path[0] === 'auto-update') ? 'active':'' }}">
                        <i class="fas fa-code-branch"></i>&nbsp;&nbsp;<span>Actualización</span>
                    </a>
                </li>
                {{-- <li >
                    <a href="{{route('system.questions')}}" class="{{ ($path[0] === 'backup') ? 'active':'' }}">
                      <i class="bi bi-whatsapp"></i> &nbsp;&nbsp;<span>Whatsapp</span>
                    </a>
                </li> --}}
                {{-- <li>
                  <a href="#whatsapp" data-href="Pages.html">
                    <i class="fas fa-robot"></i>&nbsp;&nbsp;
                    <span class="label">ChatBoot</span>
                  </a>
                  <ul id="whatsapp">
                    <li>
                      <a href="{{route('tenant.questions')}}" class="{{ ($path[0] === 'questions') ? 'active':'' }}">
                        <i class="fa fa-question"></i>
                        <span class="label">Preguntas</span>
                      </a>
                      
                    </li>
                    <li>
                      <a href="{{route('tenant.answers')}}" class="{{ ($path[0] === 'answers') ? 'active':'' }}">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span class="label">Respuestas</span>
                      </a>
                     
                    </li>
                  </ul>
                </li> --}}
                <li >
                    <a href="{{route('system.information')}}" class="{{ ($path[0] === 'information') ? 'active':'' }}">
                        <i class="fas fa-info"></i>&nbsp;&nbsp;<span>Información</span>
                    </a>
                </li>
                 
                <li class="">
                    <a  href="{{url('logs')}}" target="_BLANK">
                        <i class="fas fa-bug"></i>&nbsp;&nbsp;<span>Logs</span>
                    </a>
                </li>
                <li >
                    <a  href="{{ route('system.list-reports') }}" class="{{ ($path[0] === 'reports') ? 'active':'' }}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-pie-chart">
                            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                            <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                        </svg>&nbsp;&nbsp;
                        <span>Reportes</span>
                    </a>
                </li>   
                {{-- <li>
                  <a href="Blog.html">
                    <i data-acorn-icon="file-text" class="icon" data-acorn-size="18"></i>
                    <span class="label">Blog</span>
                  </a>
                </li>
                <li>
                  <a href="Upgrade.html">
                    <i data-acorn-icon="trend-up" class="icon" data-acorn-size="18"></i>
                    <span class="label">Upgrade</span>
                  </a>
                </li>
                <li>
                  <a href="Community.html">
                    <i data-acorn-icon="messages" class="icon" data-acorn-size="18"></i>
                    <span class="label">Community</span>
                  </a>
                </li> --}}
              </ul>
            </div>
            <!-- Menu End -->
  
            <!-- Mobile Buttons Start -->
            <div class="mobile-buttons-container">
              <!-- Menu Button Start -->
              <a href="#" id="mobileMenuButton" class="menu-button">
                <i data-acorn-icon="menu"></i>
              </a>
              <!-- Menu Button End -->
            </div>
            <!-- Mobile Buttons End -->
          </div>
          <div class="nav-shadow"></div>
        </div>
  
        <main>
          <div class="container">
            <div class="row">
              <!-- Menu Start -->
               
              <!-- Menu End -->
  
              <!-- Page Content Start -->
              <div class="col">
                <div id="main-wrapper">
                    @yield('content')
                </div>
            </div>
              <!-- Page Content End -->
            </div>
          </div>
        </main>
       
      </div>
  
      <!-- Theme Settings Modal Start -->
      
  
      <!-- Niches Modal Start -->
       
      <!-- Niches Modal End -->
  
      <!-- Theme Settings & Niches Buttons Start -->
     
      <!-- Theme Settings & Niches Buttons End -->
  
      <!-- Search Modal Start -->
      <div class="modal fade modal-under-nav modal-search modal-close-out" id="searchPagesModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header border-0 p-0">
              <button type="button" class="btn-close btn btn-icon btn-icon-only btn-foreground" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ps-5 pe-5 pb-0 border-0">
              <input id="searchPagesInput" class="form-control form-control-xl borderless ps-0 pe-0 mb-1 auto-complete" type="text" autocomplete="off" />
            </div>
            <div class="modal-footer border-top justify-content-start ps-5 pe-5 pb-3 pt-3 border-0">
              <span class="text-alternate d-inline-block m-0 me-3">
                <i data-acorn-icon="arrow-bottom" data-acorn-size="15" class="text-alternate align-middle me-1"></i>
                <span class="align-middle text-medium">Navigate</span>
              </span>
              <span class="text-alternate d-inline-block m-0 me-3">
                <i data-acorn-icon="arrow-bottom-left" data-acorn-size="15" class="text-alternate align-middle me-1"></i>
                <span class="align-middle text-medium">Select</span>
              </span>
            </div>
          </div>
        </div>
      </div>
      <!-- Search Modal End -->
      <script src="{{ asset('acorn_dashboard/js/vendor/jquery-3.5.1.min.js') }}"></script>
      <script src="{{ asset('acorn_dashboard/js/vendor/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('acorn_dashboard/js/vendor/OverlayScrollbars.min.js') }}"></script>
      <script src="{{ asset('acorn_dashboard/js/vendor/autoComplete.min.js') }}"></script>
      <script src="{{ asset('acorn_dashboard/js/vendor/clamp.min.js') }}"></script>
      <script src="{{ asset('acorn_dashboard/icon/acorn-icons.js') }}"></script>
      <script src="{{ asset('acorn_dashboard/icon/acorn-icons-interface.js') }}"></script>
      <script src="{{ asset('acorn_dashboard/icon/acorn-icons-commerce.js') }}"></script>
  
      <!-- Vendor Scripts End -->
  
      <!-- Template Base Scripts Start -->
      <script src="{{ asset('acorn_dashboard/js/base/helpers.js') }}"></script>
      <script src="{{ asset('acorn_dashboard/js/base/globals.js') }}"></script>
      <script src="{{ asset('acorn_dashboard/js/base/nav.js') }}"></script>
      <script src="{{ asset('acorn_dashboard/js/base/search.js') }}"></script>
      <script src="{{ asset('acorn_dashboard/js/base/settings.js') }}"></script>
      <!-- Template Base Scripts End -->
      <!-- Page Specific Scripts Start -->
  
      <script src="{{ asset('acorn_dashboard/js/common.js') }}"></script>
      <script src="{{ asset('acorn_dashboard/js/scripts.js') }}"></script>
      <script src="{{ asset('porto-light/vendor/jquery-loading/dist/jquery.loading.js') }}"></script>
      <script src="{{ asset('js/manifest.js') }}"></script>
      <script src="{{ asset('js/vendor.js') }}"></script>
      <script defer src="{{ mix('js/app.js') }}"></script>
   

</body>

</html>
