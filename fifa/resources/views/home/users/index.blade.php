<x-home-master>
    @section('content')
    <div class="container">
        <div class="wrapper">
            <div class="card shadow mt-4">
                <div class="table-list-users">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Prietenii tai</h6>
                    </div>
                        <div class="card-body text-center">
                            @if($users->isEmpty())
                                <i class="fas fa-smile-wink fa-3x text-gray-400 text-center mt-5"></i>
                                <p class="text-center p-4">Oops! Se pare ca inca nu ai adaugat prieteni</p>
                            @else
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-image">
                                                        <img src="{{$user->avatar}}" class="img-fluid rounded-circle d-block m-auto" width="40rem">
                                                    </div>

                                                    <div class="user-name ml-4">
                                                        {{$user->lastname}} {{$user->firstname}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="back-button mt-4">
                <a class="btn btn-back" href="{{ URL::previous() }}"><i class="fas fa-long-arrow-alt-left"></i></a>
            </div>
        </div>
    </div>
    @endsection
</x-home-master>