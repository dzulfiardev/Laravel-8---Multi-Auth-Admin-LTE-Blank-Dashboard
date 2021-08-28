<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('') }}/assets/index3.html" class="brand-link">
    <img src="{{ url('') }}/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ url('image') }}/profile/{{ $profile->image }}" class="img-circle elevation-2" alt="User Image"
          style="width:40px;height:40px;object-fit:cover;object-position:cover;">
      </div>
      <div class="info">
        <a href="{{ url('profile') }}" class="d-block">{{ $profile->fullname }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        {{-- Dashboard --}}
        <li class="nav-item">
          <a href="{{ url('') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        {{-- My Profile --}}
        <li class="nav-item">
          <a href="{{ url('profile') }}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>My Profile</p>
          </a>
        </li>

        {{-- App Settings --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              App Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Setting 1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Setting 2</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Setting 3</p>
              </a>
            </li>
          </ul>
        </li>

        {{-- Logout --}}
        <li class="nav-item">
          <a href="{{ route('logout') }}" type="submit" class="nav-link"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
          <form action="{{ route('logout') }}" method="post" id="logout-form" style="display:none">
            @csrf
          </form>
        </li>

        <li class="nav-header">Examples Label</li>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
