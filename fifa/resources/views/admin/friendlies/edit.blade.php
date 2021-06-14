<x-admin-master>
    @section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Editeaza meciul</h6>
        </div>

        <div class="card-body">
            <form method="post" action="{{route('friendlies.update', $friendly->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="firstplayer_name">Jucator Gazda</label>
                    <select class="form-control" id="firstplayer_name" name="firstplayer_name">
                        <option value="{{$friendly->firstplayer_id}}">{{$friendly->firstplayer_lastname}} {{$friendly->firstplayer_firstname}}</option>

                        @foreach($firstplayerUsers as $firstplayerUser)
                            <option value="{{$firstplayerUser->id}}">{{$firstplayerUser->lastname}} {{$firstplayerUser->firstname}}</option>
                        @endforeach
                    </select>
                </div>

                @error('firstplayer_name')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="firstplayer_team">Echipa Gazda</label>
                    <input type="text" name="firstplayer_team" class="form-control" id="firstplayer_team" aria-describedby="" value="{{$friendly->firstplayer_team}}">
                </div>

                @error('firstplayer_team')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="firstplayer_goals">Goluri jucator gazda</label>
                    <input type="number" name="firstplayer_goals" class="form-control" id="firstplayer_goals" aria-describedby="" value="{{$friendly->firstplayer_goals}}">
                </div>

                @error('firstplayer_goals')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="secondplayer_name">Jucator Oaspete</label>
                    <select class="form-control" id="secondplayer_name" name="secondplayer_name">
                        <option value="{{$friendly->secondplayer_id}}">{{$friendly->secondplayer_lastname}} {{$friendly->secondplayer_firstname}}</option>
                        @foreach($secondplayerUsers as $secondplayerUser)
                            <option value="{{$secondplayerUser->id}}">{{$secondplayerUser->lastname}} {{$secondplayerUser->firstname}}</option>
                        @endforeach
                    </select>
                </div>

                @error('secondplayer_name')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="secondplayer_team">Echipa Oaspete</label>
                    <input type="text" name="secondplayer_team" class="form-control" id="secondplayer_team" aria-describedby="" value="{{$friendly->secondplayer_team}}">
                </div>

                @error('secondplayer_team')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="secondplayer_goals">Goluri jucator oaspete</label>
                    <input type="number" name="secondplayer_goals" class="form-control" id="secondplayer_goals" aria-describedby="" value="{{$friendly->secondplayer_goals}}">
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