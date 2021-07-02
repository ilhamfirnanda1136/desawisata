  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" style="color:grey !important;"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" style="color: slategray !important;">
          <i class="fa fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{ Auth::user()->name }}
                </h3>
                <p class="text-sm"> {{ Auth::user()->email }}</p>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <!-- Message End -->
          </a>
          <a href="{{ route('profile.index') }}" class="dropdown-item dropdown-footer text-left"><i class="fa fa-user nav-icon"  aria-hidden="true"></i> Ubah Profile</a>
          <a href="{{ route('profile.change-password') }}" class="dropdown-item dropdown-footer text-left"><i class="fa fa-lock nav-icon"></i> Ubah Password</a>
          <a href="{{url('logout')}}" class="dropdown-item dropdown-footer text-left"><i class="fa fa-sign-out nav-icon"></i> Log Out</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
   
  
    </ul>


  </nav>
  <!-- /.navbar -->
