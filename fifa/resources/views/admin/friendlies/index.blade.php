<x-admin-master>
    @section('content')

    @if(Session::has('edit-game-friendly'))   
            <div class="alert alert-success">{{session('edit-game-friendly')}}</div>
        @endif

    <div class="d-flex">
        <div class="p-2 mb-4">
            <a class="btn btn-primary shadow" href="{{route('friendlies.create')}}" role="button"><i class="fas fa-plus icon-btn"></i> Adauga amical</a>
        </div>
    </div>

      <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Toate meciurile amicale</h6>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>Jucator gazda</th>
                    <th>Echipa gazda</th>
                    <th>Goluri gazde</th>
                    <th>Goluri oaspeti</th>
                    <th>Jucator oaspete</th>
                    <th>Echipa oaspeti</th>
                    <th>Editeaza / Sterge</th>
                </tr>
              </thead>

              <tbody>
                @foreach($friendlies as $friendly)
                <tr>
                  <td>{{$friendly->firstplayer_lastname}} {{$friendly->firstplayer_firstname}}</td>
                  <td>{{$friendly->firstplayer_team}}</td>
                  <td>{{$friendly->firstplayer_goals}}</td>
                  <td>{{$friendly->secondplayer_goals}}</td>
                  <td>{{$friendly->secondplayer_lastname}} {{$friendly->secondplayer_firstname}}</td>
                  <td>{{$friendly->secondplayer_team}}</td>
                  <td>
                    <div class="d-flex">
                        <div class="p-2"><a class="btn btn-warning btn-sm shadow" href="{{route('friendlies.edit', $friendly->id)}}" role="button">Edit</a></div>
                        <div class="p-2">
                          <form method="post" action="{{route('friendlies.destroy', $friendly->id)}}" enctype="multipart/form-data">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm">Sterge</button>
                          </form>
                        </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>

    <div class="d-flex">
        <div class="mx-auto">
            
        </div>
    </div>
    @endsection
</x-admin-master>