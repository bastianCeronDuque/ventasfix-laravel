<nav class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="ti ti-menu-2 ti-md"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <li class="nav-item dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <i class="ti ti-user me-3 ti-md"></i>
              <span class="align-middle">Perfil</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="ti ti-logout me-3 ti-md"></i>
              <span class="align-middle">Salir</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
