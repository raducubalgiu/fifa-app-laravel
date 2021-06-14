<x-admin-master>
    @section('content')

        @if(Session::has('championship-created'))   
            <div class="alert alert-success">{{session('championship-created')}}</div> 
        @endif

        <div class="d-flex">
            <div class="p-2 mb-4">
                <a class="btn btn-primary shadow" href="{{route('championships.store')}}"><i class="fas fa-table icon-btn"></i> Campionat nou</a>
            </div>
        </div>

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Toate campionatele</h6>
            </div>

            @if($championships->isEmpty())
                <i class="fas fa-smile-wink fa-3x text-gray-400 text-center mt-5"></i>
                <p class="text-center p-4">Oops! Se pare ca inca nu ati jucat nici un campionat</p>
            @else
                <div class="card-body">
                    <div class="scroll-table text-center mb-2">
                    <i class="fas fa-arrows-alt-h text-gray-400"></i>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Campionat</th>
                                    <th>Data</th>
                                    <th>Vezi</th>
                                    <th>Sterge</th>
                                </tr>
                            </thead>

                            <tbody>
                                    @foreach($championships as $championship)
                                        <tr>
                                            <td>{{$championship->championship_no_of_room}}</td>
                                            <td>{{$championship->created_at->format('d/m/Y')}}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="{{route('championships.edit', $championship->id)}}" role="button"><i class="fas fa-eye font-awesome-icon"></i></a>
                                            </td>
                                            <td>
                                                <form method="post" action="{{route('championships.destroy', $championship->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i type="submit" class="fas fa-trash-alt font-awesome-icon"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                </div>

                    <div class="d-flex">
                        <div class="mx-auto mb-2 mt-2">
                            {{$championships->links("pagination::bootstrap-4")}}
                        </div>
                    </div>

                    <p class="paragraph-details mb-2">Nota: Fiecare jucator isi va alege o singura echipa pe tot parcursul unui campionat</p>
                </div>
            @endif
        </div>
    @endsection
</x-admin-master>