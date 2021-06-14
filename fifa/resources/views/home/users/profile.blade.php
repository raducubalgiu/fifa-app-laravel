<x-home-master>
    @section('content')
    <div class="container">
        <div class="wrapper">
            <div class="card shadow p-5 mb-4">
                <div class="user-profile mb-4">
                    <div class="d-flex align-items-center">
                        <div class="user-profile-image">
                            <img src="{{auth()->user()->avatar}}" class="img-fluid rounded-circle">
                        </div>

                        <div class="user-profile-details ml-4">
                            <h3 class="user-profile-name mb-1">{{auth()->user()->lastname}} {{auth()->user()->firstname}}</h3>
                            <h4 class="user-profile-username mb-3">@ {{auth()->user()->username}}</h4>
                            @foreach(auth()->user()->roles as $role)
                                @if($role->name == 'Admin')
                                <span class="user-profile-role bg-success text-white p-1 rounded">{{$role->name}}</span>
                                @else
                                <span class="user-profile-role bg-warning text-white p-1 rounded">{{$role->name}}</span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <hr>

                @if(Session::has('user-profile-frontend'))   
                    <div class="alert alert-success">{{session('user-profile-frontend')}}</div>
                @endif

                <form method="post" action="{{route('home.profile.update', auth()->user()->id)}}" enctype="multipart/form-data" class="mt-4">
                    @csrf 
                    @method('PATCH')
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="" value="{{auth()->user()->username}}" >
                    </div>

                    @error('username')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="firstname">Nume</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" aria-describedby="" value="{{auth()->user()->firstname}}" >
                    </div>

                    @error('firstname')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="lastname">Prenume</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" aria-describedby="" value="{{auth()->user()->lastname}}">
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
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="" value="{{auth()->user()->email}}">
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
    </div>
    @endsection
</x-home-master>