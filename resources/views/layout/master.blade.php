<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>
 @include('layout.style')
 @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset ('assets')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div>

    <!-- Navbar -->
    @include('layout.navbar')
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    @include('layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col --
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            @yield('contents')
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@include('layout.script')
@yield('script')
</body>
</html>
