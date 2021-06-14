<x-home-master>
    @section('content')
        <div class="container">
            <div class="wrapper">
                <div class="card shadow mb-4 mt-4"> 
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="d-flex justify-content-around align-items-center pt-4 pb-4">
                                    <div class="player-card text-center">
                                        <img src="{{$firstplayer_avatar}}" class="img-fluid rounded-circle d-block m-auto player-image-score player-winner">
                                        <h3 class="heading-player-card mt-4"><strong>@</strong><strong>{{$game->firstplayer_username}}</strong></h3>
                                    </div>

                                    <div class="game-score">
                                        {{$game->firstplayer_goals}} - {{$game->secondplayer_goals}}
                                    </div>

                                    <div class="player-card text-center">
                                        <img src="{{$secondplayer_avatar}}" class="img-fluid rounded-circle d-block m-auto player-image-score player-winner">
                                        <h3 class="heading-player-card mt-4"><strong>@</strong><strong>{{$game->secondplayer_username}}</strong></h3>
                                    </div>
                                </div>
                                <hr>

                                <p class="text-center mt-5 mb-2"><strong>Statistica meciurilor directe</strong></p>

                                <div class="d-flex align-items-center justify-content-around pt-4 pb-4">
                                    <div class="player-card-statistic text-center">
                                        <p><strong>20</strong></p>
                                        <p><strong>5</strong></p>
                                        <p><strong>10</strong></p>
                                        <p><strong>150</strong></p>
                                        <p><strong>+10</strong></p>
                                    </div>

                                    <div class="statistic-description text-center">
                                        <p>Victorii</p>
                                        <p>Egaluri</p>
                                        <p>Infrangeri</p>
                                        <p>Goluri marcate</p>
                                        <p>Golaveraj</p>
                                    </div>

                                    <div class="player-card-statistic text-center">
                                        <p><strong>20</strong></p>
                                        <p><strong>5</strong></p>
                                        <p><strong>10</strong></p>
                                        <p><strong>150</strong></p>
                                        <p><strong>+10</strong></p>
                                    </div>
                                </div>

                                <hr>

                                <div class="table-game-list">
                                    <p class="mt-5 mb-4">Ultimele meciuri: <span class="player-name-title"><strong>@</strong>{{$game->firstplayer_username}}</span></p>

                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col text-center">Data</th>
                                                <th scope="col text-center">Gazde</th>
                                                <th scope="col text-center">Scor</th>
                                                <th scope="col text-center">Oaspeti</th>
                                            </tr>
                                        </thead>

                                        <tbody>   
                                            @foreach($firstplayer_matches as $fp_match)
                                                @if($fp_match->firstplayer_goals > $fp_match->secondplayer_goals)                     
                                                <tr>
                                                    <td>{{$fp_match->created_at}}</td> 
                                                    <td class="text-success font-weight-bold">{{$fp_match->firstplayer_username}}</td>
                                                    <td><a href="{{route('home.game', $fp_match->id)}}" class="font-weight-bold">{{$fp_match->firstplayer_goals}}-{{$fp_match->secondplayer_goals}}</a></td>
                                                    <td>{{$fp_match->secondplayer_username}}</td>
                                                </tr>
                                                @elseif($fp_match->firstplayer_goals < $fp_match->secondplayer_goals)
                                                <tr>
                                                    <td>{{$fp_match->created_at}}</td> 
                                                    <td>{{$fp_match->firstplayer_username}}</td>
                                                    <td><a href="{{route('home.game', $fp_match->id)}}" class="font-weight-bold">{{$fp_match->firstplayer_goals}}-{{$fp_match->secondplayer_goals}}</a></td>
                                                    <td class="text-success font-weight-bold">{{$fp_match->secondplayer_username}}</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td>{{$fp_match->created_at}}</td> 
                                                    <td>{{$fp_match->firstplayer_username}}</td>
                                                    <td><a href="{{route('home.game', $fp_match->id)}}" class="font-weight-bold">{{$fp_match->firstplayer_goals}}-{{$fp_match->secondplayer_goals}}</a></td>
                                                    <td>{{$fp_match->secondplayer_username}}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-game-list">
                                    <p class="mt-5 mb-4">Ultimele meciuri: <span class="player-name-title"><strong>@</strong>{{$game->secondplayer_username}}</span></p>

                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col text-center">Data</th>
                                                <th scope="col text-center">Gazde</th>
                                                <th scope="col text-center">Scor</th>
                                                <th scope="col text-center">Oaspeti</th>
                                            </tr>
                                        </thead>

                                        <tbody>                        
                                            @foreach($secondplayer_matches as $sp_match)
                                                @if($sp_match->firstplayer_goals > $sp_match->secondplayer_goals)                     
                                                <tr>
                                                    <td>{{$sp_match->created_at}}</td> 
                                                    <td class="text-success font-weight-bold">{{$sp_match->firstplayer_username}}</td>
                                                    <td><a href="{{route('home.game', $sp_match->id)}}" class="font-weight-bold">{{$sp_match->firstplayer_goals}}-{{$sp_match->secondplayer_goals}}</a></td>
                                                    <td>{{$sp_match->secondplayer_username}}</td>
                                                </tr>
                                                @elseif($sp_match->firstplayer_goals < $sp_match->secondplayer_goals)
                                                <tr>
                                                    <td>{{$sp_match->created_at}}</td> 
                                                    <td>{{$sp_match->firstplayer_username}}</td>
                                                    <td><a href="{{route('home.game', $sp_match->id)}}" class="font-weight-bold">{{$sp_match->firstplayer_goals}}-{{$sp_match->secondplayer_goals}}</a></td>
                                                    <td class="text-success font-weight-bold">{{$sp_match->secondplayer_username}}</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td>{{$sp_match->created_at}}</td> 
                                                    <td>{{$sp_match->firstplayer_username}}</td>
                                                    <td><a href="{{route('home.game', $sp_match->id)}}" class="font-weight-bold">{{$sp_match->firstplayer_goals}}-{{$sp_match->secondplayer_goals}}</a></td>
                                                    <td>{{$sp_match->secondplayer_username}}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                <div class="table-game-list">
                                    <p class="mt-5 mb-4">Meciuri directe</p>
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col text-center">Data</th>
                                                <th scope="col text-center">Gazde</th>
                                                <th scope="col text-center">Scor</th>
                                                <th scope="col text-center">Oaspeti</th>
                                            </tr>
                                        </thead>

                                        <tbody>                        
                                        @foreach($headTohead_matches as $match)
                                                @if($match->firstplayer_goals > $match->secondplayer_goals)                     
                                                <tr>
                                                    <td>{{$match->created_at}}</td> 
                                                    <td class="text-success font-weight-bold">{{$match->firstplayer_username}}</td>
                                                    <td><a href="{{route('home.game', $match->id)}}" class="font-weight-bold">{{$match->firstplayer_goals}}-{{$match->secondplayer_goals}}</a></td>
                                                    <td>{{$match->secondplayer_username}}</td>
                                                </tr>
                                                @elseif($match->firstplayer_goals < $match->secondplayer_goals)
                                                <tr>
                                                    <td>{{$match->created_at}}</td> 
                                                    <td>{{$match->firstplayer_username}}</td>
                                                    <td><a href="{{route('home.game', $match->id)}}" class="font-weight-bold">{{$match->firstplayer_goals}}-{{$match->secondplayer_goals}}</a></td>
                                                    <td class="text-success font-weight-bold">{{$match->secondplayer_username}}</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td>{{$match->created_at}}</td> 
                                                    <td>{{$match->firstplayer_username}}</td>
                                                    <td><a href="{{route('home.game', $match->id)}}" class="font-weight-bold">{{$match->firstplayer_goals}}-{{$match->secondplayer_goals}}</a></td>
                                                    <td>{{$match->secondplayer_username}}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endsection
</x-home-master>