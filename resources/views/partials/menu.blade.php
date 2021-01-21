 <!-- Header -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ asset('images/logo.png') }}" alt="Hartley payroll" class="brand-image elevation-3">
      <span class="brand-text font-weight-light"><strong>Payroll</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://ui-avatars.com/api/?background=f2f0ed&color=cf1518&bold=true&size=100&name={{ Auth::user()->name }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ url('/') }}" class="nav-link {{request()->routeIs('dashboards.*')?'active':''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                 Dashboard
                <i class="right fas "></i>
              </p>
            </a>           
          </li> 
          <li class="nav-item has-treeview {{request()->routeIs('employees.*')?'menu-open':''}}">
            <a href="{{route('employees.index')}}" class="nav-link {{request()->routeIs('employees.*')?'active':''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Employee Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('employees.create')}}" class="nav-link {{request()->routeIs('employees.create')?'active':''}}">
                  <i class="ion ion-person-add"></i>
                  <p>Add New Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employees.index')}}" class="nav-link {{request()->routeIs('employees.index')?'active':''}}">
                  <i class="far fas fa-users"></i>
                  <p>List of Employees</p>
                </a>
              </li>              
            </ul>
          </li>
          <li class="nav-item has-treeview {{request()->routeIs('roles.*')?'menu-open':''}}">
            <a href="{{route('roles.index')}}" class="nav-link {{request()->routeIs('roles.*')?'active':''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Role Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('roles.create')}}" class="nav-link {{request()->routeIs('roles.create')?'active':''}}">
                  <i class="ion ion-person-add"></i>
                  <p>Add New Role</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('roles.index')}}" class="nav-link {{request()->routeIs('roles.index')?'active':''}}">
                  <i class="far fas fa-users"></i>
                  <p>List of Roles</p>
                </a>
              </li>              
            </ul>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                   <i class="far fa-circle nav-icon"></i>
                 
                  <p> {{ __('Logout') }}</p>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
          </li>       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
