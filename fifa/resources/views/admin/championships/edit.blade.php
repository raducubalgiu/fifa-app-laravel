<x-admin-master>
    @section('content')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{$championship->championship_no_of_room}}</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Jucator</th>
                                <th>Echipa</th>
                                <th>M</th>
                                <th>V</th>
                                <th>E</th>
                                <th>I</th>
                                <th>G</th>
                                <th>P</th>
                            </tr>
                        </thead>

                        <tbody class="championship">
                            @foreach($results as $result)
                            <tr>
                                <td>{{$result->player_username}}</td>
                                <td>{{$result->player_team}}</td>
                                <td>{{$result->matches_number}}</td>
                                <td>{{$result->player_victory}}</td>
                                <td>{{$result->player_draw}}</td>
                                <td>{{$result->player_lose}}</td>
                                <td>{{$result->player_goals}} : {{$result->goal_received}}</td>
                                <td>{{$result->player_points}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
              </div>

              <p class="paragraph-details mb-2">*Departajarea se face in functie de punctaj, golaveraj, goluri marcate</p>
            </div>
        </div>

        @if(Session::has('create-game')) 
        <div class="alert alert-success">{{session('create-game')}}</div>
        @elseif(Session::has('destroy-game'))
        <div class="alert alert-success">{{session('destroy-game')}}</div>
        @endif

        @if(Session::has('update-game'))
        <div class="alert alert-success">{{session('update-game')}}</div>
        @endif

        <div class="card shadow mb-4 d-flex">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Meciurile campionatului</h6>
            </div>

            <div class="p-2 mt-2 ml-3">
                <a class="btn btn-primary" href="{{route('championships.games.create', $championship->id)}}" role="button"><i class="fas fa-plus icon-btn"></i> Adauga meci</a>
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
                                <th>Sterge / Editeaza</th>
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
                                        <div class="p-2">
                                            <form method="post" action="{{route('championships.games.destroy', $game->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Sterge</button>
                                            </form>
                                        </div>

                                        <div class="p-2">
                                            <a href="{{route('championships.games.edit', $game->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
              </div>

                <div class="d-flex">
                    <div class="mx-auto mb-2 mt-2">
                        {{$games->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>

        </div>

        

    @endsection
</x-admin-master>