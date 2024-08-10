<nav
class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
  <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
    <i class="bx bx-menu bx-sm"></i>
  </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  <div class="navbar-nav align-items-center">
    <div class="nav-item d-flex align-items-center">
      <span>Jam : </span>&nbsp;
      <div class="clock"></div>
    </div>
  </div>
  <ul class="navbar-nav flex-row align-items-center ms-auto">
   
    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
          <img src="{{ asset('/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item" href="#">
            <div class="d-flex">
              <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online">
                  <img src="{{ asset('/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                </div>
              </div>
              <div class="flex-grow-1">
                <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                <small class="text-muted">Admin</small>
              </div>
            </div>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <a class="dropdown-item" href="{{route('table')}}">
            <i class="bx bx-user me-2"></i>
            <span class="align-middle">My Profile</span>
          </a>
        </li>
        {{-- <li>
          <a class="dropdown-item" href="{{route('password.reset')}}">
            <i class="bx bx-cog me-2"></i>
            <span class="align-middle">Ubah Password</span>
          </a>
        </li> --}}
        <li>
          <a class="dropdown-item" href="#">
            <span class="d-flex align-items-center align-middle">
              <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
              <span class="flex-grow-1 align-middle">Galleri</span>
              <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
            </span>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <!-- Tautan Logout -->
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault(); 
             document.getElementById('logout-form').submit();" 
             role="button">-Logout</a>
      
          <!-- Form Logout menggunakan metode POST -->
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
      
          <!-- Alternatif Form Logout dengan metode GET (dikomentari karena tidak disarankan) -->
          {{-- <form id="logout-form" action="{{ route('logout') }}" method="GET">
              @csrf
              <button class="dropdown-item" type="submit">
                  <span class="align-middle">Log Out</span>
              </button>
          </form> --}}
      </li>
      
    <!--/ User -->
  </ul>
</div>
</nav>
<script>
  function clock() {
      var time = new Date(),
          hours = time.getHours(),
          minutes = time.getMinutes(),
          seconds = time.getSeconds();
  
      var ampm = hours >= 12 ? 'PM' : 'AM'; // Menentukan apakah pagi atau sore
  
      hours = hours % 12;
      hours = hours ? hours : 12; // Format jam 12 jam
  
      document.querySelectorAll('.clock')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds) + " " + ampm;
  
      function harold(standIn) {
          if (standIn < 10) {
              standIn = '0' + standIn
          }
          return standIn;
      }
  }
  setInterval(clock, 1000);
  </script>
  