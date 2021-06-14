<x-admin-master>
    @section('content')

        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('roles.update', $role->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{$role->name}}">
                    </div>

                    <div>
                        @error('name')
                            <span>{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Update Role</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>