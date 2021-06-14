<x-admin-master>
    @section('content')
        @if(Session::has('edit-game-friendly')) 
            <div class="alert alert-success">{{session('edit-game-friendly')}}</div>
            @elseif(Session::has('create-game-friendly'))
            <div class="alert alert-success">{{session('create-game-friendly')}}</div>
        @endif

    <div class="d-flex">
        <div class="p-2 mb-4">
            <a class="btn btn-primary shadow" href="{{route('games.create')}}" role="button"><i class="fas fa-plus icon-btn"></i> Adauga amical</a>
        </div>
    </div>

      <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Toate meciurile amicale</h6>
        </div>

        @if($games->isEmpty())
        <i class="fas fa-smile-wink fa-3x text-gray-400 text-center mt-5"></i>
        <p class="text-center p-4">Oops! Se pare ca nu ati jucat meciuri amicale</p>
        @else
          <div class="card-body">
            <div class="scroll-table text-center mb-2">
              <i class="fas fa-arrows-alt-h text-gray-400"></i>
            </div>
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
                    @foreach($games as $game)
                      <tr>
                        <td>{{$game->firstplayer_username}}</td>
                        <td>{{$game->firstplayer_team}}</td>
                        <td>{{$game->firstplayer_goals}}</td>
                        <td>{{$game->secondplayer_goals}}</td>
                        <td>{{$game->secondplayer_username}}</td>
                        <td>{{$game->secondplayer_team}}</td>
                        <td>
                          <div class="d-flex">
                              <div class="p-2"><a class="btn btn-warning btn-sm shadow" href="{{route('games.edit', $game->id)}}" role="button">Edit</a></div>
                              
                              <div class="p-2">
                                <form method="post" action="{{route('games.destroy', $game->id)}}" enctype="multipart/form-data">
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
        @endif
    </div>

    <div class="d-flex">
        <div class="mx-auto">
            {{$games->links("pagination::bootstrap-4")}}
        </div>
    </div>
    @endsection
</x-admin-master>