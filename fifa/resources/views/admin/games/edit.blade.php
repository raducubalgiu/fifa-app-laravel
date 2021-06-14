<x-admin-master>
    @section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Editeaza meciul</h6>
        </div>

        <div class="card-body">
            <form method="post" action="{{route('games.update', $game->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="fp_username_id">Jucator Gazda</label>
                    <select class="form-control" id="fp_username_id" name="fp_username_id">
                        <option value="{{$game->firstplayer_id}}">{{$game->firstplayer_username}}</option>

                        @foreach($firstplayerUsers as $firstplayerUser)
                            <option value="{{$firstplayerUser->id}}">{{$firstplayerUser->username}}</option>
                        @endforeach
                    </select>
                </div>

                @error('fp_username_id')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="firstplayer_team">Echipa Gazda</label>
                    <input type="text" name="firstplayer_team" class="form-control" id="firstplayer_team" aria-describedby="" value="{{$game->firstplayer_team}}">
                </div>

                @error('firstplayer_team')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="firstplayer_goals">Goluri jucator gazda</label>
                    <input type="number" name="firstplayer_goals" class="form-control" id="firstplayer_goals" aria-describedby="" value="{{$game->firstplayer_goals}}">
                </div>

                @error('firstplayer_goals')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="sp_username_id">Jucator Oaspete</label>
                    <select class="form-control" id="sp_username_id" name="sp_username_id">
                        <option value="{{$game->secondplayer_id}}">{{$game->secondplayer_username}}</option>
                        @foreach($secondplayerUsers as $secondplayerUser)
                            <option value="{{$secondplayerUser->id}}">{{$secondplayerUser->username}}</option>
                        @endforeach
                    </select>
                </div>

                @error('sp_username_id')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="secondplayer_team">Echipa Oaspete</label>
                    <input type="text" name="secondplayer_team" class="form-control" id="secondplayer_team" aria-describedby="" value="{{$game->secondplayer_team}}">
                </div>

                @error('secondplayer_team')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="secondplayer_goals">Goluri jucator oaspete</label>
                    <input type="number" name="secondplayer_goals" class="form-control" id="secondplayer_goals" aria-describedby="" value="{{$game->secondplayer_goals}}">
                </div>

                @error('secondplayer_goals')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

                <button type="submit" class="btn btn-primary">Editeaza meciul</button>
            </form>
        </div>
    </div>
    @endsection
</x-admin-master>