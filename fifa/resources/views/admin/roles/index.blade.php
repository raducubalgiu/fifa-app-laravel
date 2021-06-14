<x-admin-master>
    @section('content')
    <div class="row">
            <div class="col-sm-3 mt-4">
                <form method="post" action="{{route('roles.store')}}">
                    @csrf

                    <div class="form-group">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nume">
                    </div>

                    <div>
                        @error('name')
                            <span>{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Creeaza rol</button>
                </form>
            </div>

            <div class="col-sm-9">
                <!-- DataTales Example -->
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Toate rolurile</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td><a href="{{route('roles.edit', $role->id)}}">{{$role->name}}</a></td>
                                        <td>{{$role->slug}}</td>
                                        <td>{{$role->created_at->diffForHumans()}}</td>
                                        <td>{{$role->updated_at->diffForHumans()}}</td>
                                        <td>
                                            <form method="post" action="{{route('roles.destroy', $role->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>