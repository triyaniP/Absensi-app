<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset ('assets')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Absensi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('v1/attendance/')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Absen
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url ('v1/courses/')}}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Mata Kuliah
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url ('v1/students/')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Mahasiswa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url ('logout')}}" class="nav-link">
              <p>
                Logout
              </p>
              <i class="right fas fa-angle-right"></i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
