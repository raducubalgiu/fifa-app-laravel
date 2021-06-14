<x-admin-master>
    @section('content')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Adauga meci amical</h6>
            </div>
            
            <div class="card-body">
                <form method="post" action="{{route('friendlies.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="firstplayer_name">Jucator Gazda</label>
                        <select class="form-control" id="firstplayer_name" name="firstplayer_name">
                            @foreach($room->users as $user)
                                <option value="{{$user->id}}">{{$user->firstname}} {{$user->lastname}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="firstplayer_team">Echipa jucator gazda</label>
                        <input type="text" name="firstplayer_team" class="form-control" id="firstplayer_team" aria-describedby="">
                    </div>

                    @error('firstplayer_team')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="firstplayer_goals">Goluri jucator gazda</label>
                        <input type="number" name="firstplayer_goals" class="form-control" id="firstplayer_goals" aria-describedby="">
                    </div>

                    @error('firstplayer_goals')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="secondplayer_name">Jucator Oaspete</label>
                        <select class="form-control" id="secondplayer_name" name="secondplayer_name">
                            @foreach($room->users as $user)
                                <option value="{{$user->id}}">{{$user->firstname}} {{$user->lastname}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="secondplayer_team">Echipa jucator oaspete</label>
                        <input type="text" name="secondplayer_team" class="form-control" id="secondplayer_team" aria-describedby="">
                    </div>

                    @error('secondplayer_team')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="secondplayer_goals">Goluri jucator gazda</label>
                        <input type="number" name="secondplayer_goals" class="form-control" id="secondplayer_goals" aria-describedby="">
                    </div>

                    @error('secondplayer_goals')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Adauga amical</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>