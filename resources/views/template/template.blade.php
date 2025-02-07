<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title', 'Listagem da aplicação')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href=" {{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet">
  <link href=" {{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }} " rel="stylesheet">
  <link href=" {{ asset('assets/vendor/boxicons/css/boxicons.min.css') }} " rel="stylesheet">
  <link href=" {{ asset('assets/vendor/quill/quill.snow.css') }} " rel="stylesheet">
  <link href=" {{ asset('assets/vendor/quill/quill.bubble.css') }} " rel="stylesheet">
  <link href=" {{ asset('assets/vendor/remixicon/remixicon.css') }} " rel="stylesheet">
  <link href=" {{ asset('assets/vendor/simple-datatables/style.css') }} " rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href=" {{ asset('assets/css/style.css') }} " rel="stylesheet">

</head>
<style>
  #cardScale{

    cursor: pointer !important;
    transition: background-color 0.3s, transform 0.2s !important; 
    
  }
  #cardScale:hover {

    transform: scale(1.02); /* Leve aumento no tamanho para dar destaque */
    
  }
</style>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href=" {{ route('listagem') }} " class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Medicamentos</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          {{-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number"> <!-- valor aqui --> </span>
          </a> --}} <!-- ADICIONAR NOTIFICACOES EM BREVE -->

        </li>

        <!-- ADICIONAR MENSAGENS EM BREVE -->
        {{-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav --> --}}

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"> {{ auth()->user()->name }} </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6> {{ auth()->user()->name }}  </h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href=" {{ route('logout') }} ">
                <i class="bi bi-box-arrow-right"></i>
                <span>Deslogar</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="{{ route('listagem') }}">
          <i class="bx bx-grid-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('incluir') }}">
          <i class="bi bi-capsule"></i>
          <span>Incluir medicamento</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('medicamento.entrada') }}">
          <i class="bi bi-plus-square"></i>
          <span>Dar entrada</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('medicamento.saida') }}">
          <i class="bi bi-dash-square "></i>
          <span>Dar saída</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('relatorio') }}">
          <i class="bx bxs-report"></i>
          <span>Relatório</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="d-flex justify-content-between">
      
        <div class="pagetitle">
          <h1>@yield('topo', 'teste')</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('listagem') }}">Home</a></li>
              <li class="breadcrumb-item active">@yield('topo', 'teste')</li>
            </ol>
          </nav>
        </div>
        @if($menssagem = session()->get('message'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <i class="bi bi-info-circle me-1"></i>
          {{ $menssagem }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>

    @yield('main')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    {{-- <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div> --}}
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://www.instagram.com/ayslancosta_/" target="__blank">Ayslan Costa</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src=" {{ asset('assets/vendor/apexcharts/apexcharts.min.js') }} "></script>
  <script src=" {{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
  <script src=" {{ asset('assets/vendor/chart.js/chart.umd.js') }} "></script>
  <script src=" {{ asset('assets/vendor/echarts/echarts.min.js') }} "></script>
  <script src=" {{ asset('assets/vendor/quill/quill.js') }} "></script>
  <script src=" {{ asset('assets/vendor/simple-datatables/simple-datatables.js') }} "></script>
  <script src=" {{ asset('assets/vendor/tinymce/tinymce.min.js') }} "></script>
  <script src=" {{ asset('assets/vendor/php-email-form/validate.js') }} "></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

  
  <!-- Template Main JS File -->
  <script src=" {{ asset('assets/js/main.js') }}"></script>
  <script src=" {{ asset('assets/js/scripts.js') }}?v=12312"></script>


</body>

</html>