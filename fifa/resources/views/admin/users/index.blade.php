<x-admin-master>
    @section('content')
        @if(Session::has('create-user')) 
            <div class="alert alert-success">{{session('create-user')}}</div>
        @endif

        <div class="d-flex">
          <div class="p-2 mb-4">
              <a class="btn btn-primary shadow" href="{{route('users.create')}}" role="button"><i class="fas fa-user-plus icon-btn"></i>  Adauga prieten</a>
          </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Toti prietenii</h6>
            </div>
            @if($users->isEmpty())
              <i class="fas fa-smile-wink fa-2x text-gray-400 text-center mt-5"></i>
              <p class="text-center p-4">Oops! Se pare ca inca nu ai adaugat prieteni</p>
            @else
              <div class="card-body">
                <div class="scroll-table text-center mb-2">
                  <i class="fas fa-arrows-alt-h text-gray-400"></i>
                </div>

                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                          <th>Username</th>
                          <th>Nume</th>
                          <th>Prenume</th>
                          <!-- <th>Profil</th> -->
                      </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                        <tr>
                          <td>
                            <div class="d-flex align-items-center">
                                <div class="user-image">
                                    <img src="{{$user->avatar}}" class="img-fluid rounded-circle d-block m-auto" width="40rem">
                                </div>

                                <div class="user-name ml-4">
                                    {{$user->username}}
                                </div>
                            </div>
                          </td>
                          <td>{{$user->firstname}}</td>
                          <td>{{$user->lastname}}</td>
                          <!-- <td><a class="btn btn-info btn-sm" href="{{route('users.profile.show', $user->id)}}" role="button"><i class="fas fa-eye font-awesome-icon"></i></a></td> -->
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="d-flex">
                    <div class="mx-auto mb-2 mt-2">
                      {{$users->links("pagination::bootstrap-4")}}
                    </div>
                </div>
              </div>
            @endif
          </div>
    @endsection
</x-admin-master>