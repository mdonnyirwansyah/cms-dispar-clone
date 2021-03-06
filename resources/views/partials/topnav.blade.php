<form class="form-inline mr-auto" action="">
  <ul class="navbar-nav mr-3">
    <li>
      <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>
</form>
<ul class="navbar-nav navbar-right">
  <li class="dropdown dropdown-list-toggle">
    <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg nav-link-user d-flex">
      <i class="fas fa-globe-americas"></i>
      <div style="font-size: 14px; margin-top: 3px;" class="d-sm-none d-lg-inline-block ml-1">EN</div>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
      <div class="dropdown-title">Select your language</div>
      <a href="#" class="dropdown-item">
        English
      </a>
      <a href="#" class="dropdown-item">
        Indonesian
      </a>
  </li>
  <div class="text-white font-weight-bold p-0" style="margin-top: 2px">|</div>
  <li class="dropdown">
    <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg nav-link-user d-flex">
      <i class="fas fa-user-circle"></i>
      <div class="d-sm-none d-lg-inline-block ml-1">{{ Auth::user()->name }}</div>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
      <div class="dropdown-title">Welcome, {{ Auth::user()->name }}</div>
      <a href="{{ route('user-profile-information') }}" class="dropdown-item has-icon">
        <i class="far fa-user"></i> Profile Information
      </a>
      <a href="{{ route('user-password') }}" class="dropdown-item has-icon">
        <i class="fas fa-lock"></i> Update Password
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i>
        Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </div>
  </li>
</ul>
