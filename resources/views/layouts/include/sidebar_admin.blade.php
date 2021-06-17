<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="logo-dewi p-3 mx-2"  style="border-bottom: 1px solid #4F5962">
      <div class="d-flex justify-content-center">
        <a href="{{url('home')}}" class="">
          <img src="{{asset('images/logo-dewi.png')}}"
               alt="AdminLTE Logo"
               class="brand-image "
               style="opacity: .8; width:10em;">
               {{-- <span class="brand-text font-weight-light">AdminLTE 3</span> --}}
        </a>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/guest.png')}}" class="img-circle elevation-1" alt="User Image" style="width:10px">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}<br> </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
           <a href="{{url('home')}}" class="nav-link {{request()->segment(1)=='home'? 'active' :''}}">
            <i class="nav-icon fa fa-home"></i>
             <p>
              Beranda
             </p>
           </a>
         </li>
         <li class="nav-item">
          <a href="{{url('pendamping')}}" class="nav-link {{request()->segment(1)=='pendamping'? 'active' :''}}">
           <i class="nav-icon fa fa-users"></i>
            <p>
             Pendamping
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('wisata')}}" class="nav-link {{request()->segment(1)=='wisata'? 'active' :''}}">
           <i class="nav-icon fa fa-map"></i>
            <p>
             Desa Wisata
            </p>
          </a>
        </li>
          <li class="nav-item has-treeview {{request()->segment(1)=='aparat'? 'menu-open' :''}}">
            <a href="#" class="nav-link {{request()->segment(1)=='aparat'? 'active' :''}}">
              <i class="nav-icon fa fa-university"></i>
              <p>
                Aparat Desa
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('aparat/master')}}" class="nav-link {{ request()->segment(2)=='master' ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Master Jabatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/aparat/desa')}}" class="nav-link {{ request()->segment(2)=='desa' ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Aparat Desa</p>
                </a>
              </li>
          </ul>
          </li>
          <li class="nav-item has-treeview {{request()->segment(1)=='master-project'? 'menu-open' :''}}">
            <a href="#" class="nav-link {{request()->segment(1)=='master-project'? 'active' :''}}">
              <i class="nav-icon fa fa-tasks"></i>
              <p>
                Project
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('project-type.index')}}" class="nav-link {{ request()->segment(2)=='project-type' ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Jenis Project</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('project.index')}}" class="nav-link {{ request()->segment(2)=='project' ? 'active' : '' }}">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Project</p>
                </a>
              </li>
          </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('map.index')}}" class="nav-link {{request()->segment(1)=='peta'? 'active' :''}}">
             <i class="nav-icon fa fa-map"></i>
              <p>
               Peta
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link {{request()->segment(1)=='user'? 'active' :''}}">
             <i class="nav-icon fa fa-users"></i>
              <p>
               Users
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
