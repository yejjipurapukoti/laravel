<header class="custom-header">
    <div class="d-flex align-items-center logo-box justify-content-start">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
            <div class="logo-lg">
                <img src="{{ asset('assets/images/borigam.png') }}" alt="Logo">
            </div>
        </a>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-static-top">
        <div class="app-menu">
            <ul class="header-megamenu nav">
                <!-- Sidebar toggle -->
                <li class="btn-group nav-item">
                    <a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu" role="button">
                        <i data-feather="menu"></i>
                    </a>
                </li>

                <!-- Search box -->
                <li class="btn-group d-lg-inline-flex d-none">
                    <div class="search-bx mx-3">
                        <form>
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Search...">
                                <button class="btn btn-light" type="submit">
                                    <i class="icon-Search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Right side menu -->
        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <!-- Logout Button -->
                <li class="btn-group nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="waves-effect waves-light nav-link btn-light svg-bt-icon" title="Logout">
                        <i data-feather="log-out"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

{{-- ✅ Custom Header Style --}}
<style>
.custom-header {
  background-color: #ffffff !important;
  color: #1e293b !important;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  height: 80px;
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 25px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

/* Logo alignment */
.custom-header .logo-lg img {
  height: 55px;
  width: auto;
  display: block;
}

/* Navbar */
.custom-header .navbar {
  background: transparent !important;
  padding: 0;
  margin: 0;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* Navbar links */
.custom-header .navbar .nav > li > a {
  color: #1e293b !important;
  font-weight: 500;
  padding: 10px 12px;
  transition: 0.3s;
  border-radius: 6px;
}

.custom-header .navbar .nav > li > a:hover {
  background-color: rgba(0,0,0,0.05);
  color: #0f172a !important;
}

/* Search box */
.search-bx input {
  border: 1px solid #e2e8f0;
  border-radius: 5px 0 0 5px;
  height: 40px;
}

.search-bx .btn {
  border-radius: 0 5px 5px 0;
  background-color: #f1f5f9;
}

/* Responsive fix */
@media (max-width: 991px) {
  .custom-header {
    height: 70px;
    padding: 0 15px;
  }

  .custom-header .logo-lg img {
    height: 45px;
  }

  .search-bx {
    display: none;
  }
}
</style>
