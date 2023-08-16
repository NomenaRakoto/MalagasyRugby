<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center rounded-circle">
        <img src="/assets/img/malagasyrugby.jpg" alt="">
        <span class="d-none d-lg-block">MalagasyRugby</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    @if(strpos(\Route::currentRouteName(), 'personnel.list') !== false)
    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="{{route('personnel.list.search')}}@if(isset($club))?id_club={{$club->id}}@endif">
        {{ csrf_field() }}
        <input type="text" name="query" placeholder="Search" title="Enter search keyword" value="@if(isset($query)){{$query}}@endif">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>

        <input class='ipt-search' type="text" name="saison" placeholder="Saison" title="Enter saison" value="@if(isset($saison)){{$saison}}@endif">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->
    @endif

    @if(strpos(\Route::currentRouteName(), 'club.list') !== false)
    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="{{route('club.list.search')}}">
        {{ csrf_field() }}
        <input type="text" name="query" placeholder="Search" title="Enter search keyword" value="@if(isset($query)){{$query}}@endif">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->
    @endif

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">José RAKOTOBE</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{\Auth::user()->name}}</h6>
              <span>Administrateur</span>
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Paramètres</span>
              </a>
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Se Deconnecter</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->