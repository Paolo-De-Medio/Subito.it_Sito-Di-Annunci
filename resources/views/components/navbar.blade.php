<header>
    <div class="bg-nav">
      <img src="/img/presto-logo.png" class="mini-logo mx-auto" alt="Presto.it">
    </div>
  <nav class="navbar navbar-expand-lg bg-nav navbar-light shadow-nav">
      <div class="container-fluid ">
        <div class="mx-auto">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-shopping-bag tc-accent fs-1"></i>
          </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
            <li class="nav-item">
              <a class="nav-link hvr-underline-from-center" aria-current="page" href="{{route('homepage')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link hvr-underline-from-center" href="{{route('ad.index')}}">I nostri annunci!</a>
            </li>
            @auth
            <li class="nav-item">
              <a class="nav-link hvr-underline-from-center" href="{{route('ad.create')}}">Inserisci il tuo annuncio!</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Benvenuto, {{Auth::user()->name}}!
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

            @if(Auth::user()->is_revisor)
                <li><a class="dropdown-item" href="{{route('revisor.index')}}"><i class="fas fa-user-secret tc-accent me-1"></i> Zona Revisore</a></li>
                <li class="dropdown-item"><i class="fas fa-pause-circle tc-accent"></i> In sospeso: <span style="color: green">{{\App\Models\Ad::ToBeRevisionedCount()}}</span></li>
            @endif
                <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle tc-accent me-2"></i>Profilo</a></li>
                <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('form-logout').submit();"><i class="fas fa-sign-out-alt tc-accent me-2"></i>Esci</a></li>
                <form method="POST" action="{{route('logout')}}" style="display: none" id="form-logout">
                  @csrf
                </form>
              </ul>
              @else
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Benvenuto, Ospite!
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{route('register')}}"><i class="fas fa-user-plus"></i> Registrati</a></li>
                  <li><a class="dropdown-item" href="{{route('login')}}"><i class="fas fa-user-check"></i> Accedi</a></li>
                </ul>
                @endauth
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
