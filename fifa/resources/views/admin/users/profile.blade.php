<x-admin-master>
    @section('content')
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Profil:</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$user->lastname}} {{$user->firstname}}</div>
                            </div>
                            <div class="col-auto">
                                <img class="img-profile-big rounded-circle" src="{{$user->avatar}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-left-success shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Editeaza profilul</h6>
            </div>

            @if(Session::has('edit-profile')) 
            <div class="alert alert-success">{{session('edit-profile')}}</div>
            @endif

            <div class="card-body">
                <form method="post" action="{{route('users.profile.update', $user->id)}}" enctype="multipart/form-data">
                    @csrf 
                    @method('PATCH')
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="" value="{{$user->username}}" >
                    </div>

                    @error('username')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="firstname">Nume</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" aria-describedby="" value="{{$user->firstname}}" >
                    </div>

                    @error('firstname')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="lastname">Prenume</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" aria-describedby="" value="{{$user->lastname}}">
                    </div>

                    @error('lastname')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="avatar">Alege o fotografie</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="avatar">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                    @error('avatar')
                    <div class="alert alert-danger">
                        {{$avatar}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="" value="{{$user->email}}">
                    </div>

                    @error('email')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="password">Parola</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>

                    @error('password')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="password">Confirma parola</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                    </div>

                    @error('password_confirmation')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit icon-btn"></i> Editeaza profilul</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>