<div class="bg-white shadow navigation fixed-top">
    <div class="container-fluid d-flex">
        <div class="mr-auto p-2">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="{{route('home')}}" class="logo"><img src="{{ asset('/images/logo-fifa-2.png') }}" width="50"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav mt-lg-0 navbar-left">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home.users.index')}}">Prieteni</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home.games')}}">Meciuri</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home.championships.index')}}">Campionate</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home.ranking.index')}}">Clasament general</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home.statistics.index')}}">Statistici</a>
                        </li>
                    </ul>

                    @if(auth()->user()->userHasRole('admin'))
                    <a class="btn btn-standard" href="{{route('admin.index')}}" role="button">Admin</a>
                    @endif
                </div>
            </nav>
        </div>

        <div class="p-2">
            <!-- Topbar Navbar -->
            <ul class="navbar-nav mr-2">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                        @if(Auth::check())
                        {{auth()->user()->username}}
                        @endif
                    </span>
                    <img class="img-profile-home rounded-circle" src="{{auth()->user()->avatar}}" width="40rem" height="40rem">
                    </a>
                    
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{route('home.users.profile', auth()->user()->id)}}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profil
                        </a>

                        <a class="dropdown-item" href="{{route('home.settings.index')}}">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Setari
                        </a>
                        <a class="dropdown-item" href="{{route('home.report.index')}}">
                            <i class="fas fa-exclamation-triangle fa-sm fa-fw mr-2 text-gray-400"></i>
                            Raporteaza o problema
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Deconectare
                        </a>
                    </div>
                </li>

                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Gata...ne parasesti?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        </div>
                        <div class="modal-body">Apasa pe butonul de "Log out" pentru a te deloga</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                            <form action="/logout" method="post">
                                @csrf

                                <button class="btn btn-danger btn-sm">Log out</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</div>

