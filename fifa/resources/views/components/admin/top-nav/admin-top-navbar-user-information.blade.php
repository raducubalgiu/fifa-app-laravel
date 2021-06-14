<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
        @if(Auth::check())
            {{auth()->user()->username}}
        @endif
    </span>
    <img class="img-profile rounded-circle" src="{{auth()->user()->avatar}}">
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
    <a class="dropdown-item" href="{{route('users.profile.show', auth()->user()->id)}}">
        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
        Profil
    </a>
    <a class="dropdown-item" href="{{route('settings.index')}}">
        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
        Setari
    </a>
    <a class="dropdown-item" href="{{route('report.index')}}">
        <i class="fas fa-exclamation-triangle fa-sm fa-fw mr-2 text-gray-400"></i>
        Raporteaza o problema
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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