<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link @if(strpos(\Route::currentRouteName(), 'ligue') === false) collapsed @endif" href="{{route('ligue')}}">
          <i class="bi bi-grid"></i>
          <span>Ligue / Region</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link @if(strpos(\Route::currentRouteName(), 'section') === false) collapsed @endif" href="{{route('section.list')}}">
          <i class="bi bi-grid"></i>
          <span>Section</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link @if(strpos(\Route::currentRouteName(), 'club') === false && strpos(\Route::currentRouteName(), 'association') === false) collapsed @endif" data-bs-target="#club-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Clubs / Association</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="club-nav" class="nav-content @if(strpos(\Route::currentRouteName(), 'club') === false && strpos(\Route::currentRouteName(), 'association') === false) collapse @endif " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('club.list')}}">
              <i class="bi bi-circle"></i><span>Clubs</span>
            </a>
          </li>
          <li>
            <a href="{{route('association.list')}}">
              <i class="bi bi-circle"></i><span>Association | Etablissement</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Components Nav -->


       <li class="nav-item">
        <a class="nav-link @if(strpos(\Route::currentRouteName(), 'personnel') === false && strpos(\Route::currentRouteName(), 'jeune') === false) collapsed @endif" data-bs-target="#personnels-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-circle"></i><span>Personnels</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="personnels-nav" class="nav-content @if(strpos(\Route::currentRouteName(), 'personnel') === false && strpos(\Route::currentRouteName(), 'jeune') === false) collapse @endif " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('personnel.list')}}">
              <i class="bi bi-circle"></i><span>Personnels MR</span>
            </a>
          </li>
          <li>
            <a href="{{route('jeune.list')}}">
              <i class="bi bi-circle"></i><span>Jeunes</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Components Nav -->
      

      <li class="nav-item">
        <a class="nav-link collapsed" href="/">
          <i class="ri-arrow-left-right-fill"></i>
          <span>Mutations</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/">
          <i class="bx bxs-ball"></i>
          <span>Matchs</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('stat')}}">
          <i class="bi bi-grid"></i>
          <span>Statistiques</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/">
          <i class="bi bi-gear"></i>
          <span>Paramètres</span>
        </a>
      </li><!-- End Dashboard Nav -->


    </ul>

  </aside><!-- End Sidebar-->