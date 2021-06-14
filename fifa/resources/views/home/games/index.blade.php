<x-home-master>
    @section('content')

    <!-- Begin Page Content -->
    <div class="container">
        <div class="wrapper">
            <div class="d-flex align-item-center justify-content-end mb-4">
                <div class="list-matches ml-aut mr-2">
                    <button type="button" class="bg-transparent border-0">
                        <i class="fas fa-id-card-alt text-gray-500 p-2 rounded bg-white shadow"></i>
                    </button>
                </div>

                <div class="list-matches mr-2 p-2">
                    <button type="button" class="bg-transparent border-0">
                        <i class="fas fa-list text-gray-500"></i>
                    </button>
                </div>
                
                <div class="filter-matches mr-2 p-2">
                    <div class="dropdown">
                        <button type="button" class="bg-transparent border-0" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-filter text-gray-500"></i>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <div class="form-group mt-2 ml-2 mb-0 pb-2 pt-4 pl-2 pr-2">
                                <input type="radio" id="male" name="gender" value="male">
                                <label for="male">Toate meciurile</label><br>
                                <input type="radio" id="female" name="gender" value="female">
                                <label for="female">Meciurile tale</label><br>
                            </div>

                            <button type="submit" class="btn btn-sm btn-warning ml-4 mb-2">Filtreaza</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($games as $game)
                    <div class="col-lg-4 mb-4">
                        <div class="card shadow p-2">
                            <a href="{{route('home.game',  $game->id)}}">
                                <div class="card-top d-flex align-items-center justify-content-between">
                                    <div class="player text-center">
                                        @foreach($users->where('id', $game->firstplayer_id) as $user)
                                            @if($game->firstplayer_goals > $game->secondplayer_goals)
                                                <div class="player-image-box">
                                                    <img src="{{$user->avatar}}" class="rounded-circle player-winner">
                                                    <div class="icon-firstplayer shadow">
                                                        <i class="far fa-thumbs-up winner"></i>
                                                    </div>
                                                </div>
                                            @elseif($game->firstplayer_goals < $game->secondplayer_goals)
                                                <div class="player-image-box">
                                                    <img src="{{$user->avatar}}" class="rounded-circle player-winner">
                                                    <div class="icon-firstplayer shadow">
                                                        <i class="fas fa-thumbs-down lose"></i>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="player-image-box">
                                                    <img src="{{$user->avatar}}" class="rounded-circle player-winner">
                                                    <div class="icon-firstplayer shadow">
                                                        <i class="fas fa-hand-peace equal"></i>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        <h3 class="player-name">{{$game->firstplayer_username}}</h3>
                                    </div>

                                    <div class="result">
                                        <h3>{{$game->firstplayer_goals}} - {{$game->secondplayer_goals}}</h3>
                                    </div>

                                    <div class="player text-center">
                                        @foreach($users->where('id', $game->secondplayer_id) as $user)
                                            @if($game->firstplayer_goals > $game->secondplayer_goals)
                                                <div class="player-image-box">
                                                    <img src="{{$user->avatar}}" class="rounded-circle player-winner">
                                                    <div class="icon-secondplayer shadow">
                                                        <i class="fas fa-thumbs-down lose"></i>
                                                    </div>
                                                </div>
                                            @elseif($game->firstplayer_goals == $game->secondplayer_goals)
                                                <div class="player-image-box">
                                                    <img src="{{$user->avatar}}" class="rounded-circle player-winner">
                                                    <div class="icon-secondplayer shadow">
                                                        <i class="fas fa-hand-peace equal"></i>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="player-image-box">
                                                    <img src="{{$user->avatar}}" class="rounded-circle player-winner">
                                                    <div class="icon-secondplayer shadow">
                                                        <i class="fas fa-thumbs-up winner"></i>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        <h3 class="player-name">{{$game->secondplayer_username}}</h3>
                                    </div>
                                </div>

                                <div class="see-more text-center">
                                    <i class="fas fa-eye see-more"></i>
                                </div>

                                <div class="match-type text-center">
                                    <p>{{$game->match_type}}</p>
                                </div>

                                <div class="match-date text-center">
                                    <p>{{$game->created_at->format('d-m-Y')}}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex">
                <div class="mx-auto mt-2">
                    {{$games->links("pagination::bootstrap-4")}}
                </div>
            </div>

            <!-- Back Button -->
            <div class="back-button mt-4 mb-4">
                <a class="btn btn-back" href="{{ URL::previous() }}"><i class="fas fa-long-arrow-alt-left"></i></a>
            </div>
        </div>
    </div>
    @endsection


</x-home-master>