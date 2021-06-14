<x-admin-master>
    @section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Adauga prieten</h6>
        </div>
   
        <div class="card-body">
            <form method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control form-control @error('username') is-invalid @enderror" id="username" aria-describedby="" placeholder="Username">
                </div>

                <div class="form-group">
                    <label for="firstname">Nume</label>
                    <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="firstname" aria-describedby="" placeholder="Nume">
                </div>

                <div class="form-group">
                    <label for="lastname">Prenume</label>
                    <input type="text" name="lastname" class="form-control form-control @error('lastname') is-invalid @enderror" id="lastname" aria-describedby="" placeholder="Prenume">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control form-control @error('email') is-invalid @enderror" id="email" aria-describedby="" placeholder="Email">
                </div>

                @error('email')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="password">Parola</label>
                    <input type="password" name="password" class="form-control form-control @error('password') is-invalid @enderror" id="password">
                </div>

                <div class="form-group">
                    <label for="password">Confirma parola</label>
                    <input type="password" name="password_confirmation" class="form-control form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary">Adauga prieten</button>
            </form>
        </div>
    </div>
    @endsection
</x-admin-master>