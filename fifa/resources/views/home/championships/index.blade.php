<x-home-master>
    @section('content')
        <div class="container">
            <div class="wrapper">
                <!-- Card champinships --> 
                <div class="card shadow mt-4 mb-4">
                    

                    <div class="table-championships-list">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Toate Campionatele</h6>
                        </div>

                        @if($championships->isEmpty())
                            <div class="check-empty text-center">
                                <i class="fas fa-smile-wink fa-3x text-gray-400 text-center mt-5"></i>
                                <p class="text-center p-4">Oops! Se pare ca inca nu ati jucat nici un campionat</p>
                            </div>
                        @else
                            <div class="card-body">
                                <table class="table table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col text-center">Camp</th>
                                            <th scope="col text-center">Data</th>
                                            <th scope="col text-center">Castigator</th>
                                            <th scope="col text-center">Clasament</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($championships as $championship)
                                            <tr>
                                                <td>{{Str::substr($championship->championship_no_of_room, 12, 2)}}</td> 
                                                <td>{{$championship->created_at->format('d-m-Y')}}</td>
                                                <td>Raducu Balgiu</td>
                                                <td><a class="btn btn-sm btn-secondary" style="color: #fff; " href="{{route('home.championships.ranking', $championship->id)}}"><i class="fas fa-angle-right" style="color: #fff; "></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

                @if(!$championships->isEmpty())
                <!-- Card winner champinships --> 
                <div class="card shadow mt-4">
                    <div class="table-championships-list">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Castigatori campionate</h6>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th scope="col text-center">Camp</th>
                                        <th scope="col text-center">Castigator</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($championships as $championship)
                                        <tr>
                                            <td>{{Str::substr($championship->championship_no_of_room, 12, 2)}}</td> 
                                            <td class="winner-champ">{{$championship->winner_championship}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                <!-- Pagination -->
                <div class="d-flex mt-4 mb-2">
                    <div class="mx-auto">
                        {{$championships->links("pagination::bootstrap-4")}}
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