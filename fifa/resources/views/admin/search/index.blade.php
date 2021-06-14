<x-admin-master>
    @section('content')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Rezultatele cautarii</h6>
            </div>
            @if($findUsers->isEmpty())
              <i class="fas fa-smile-wink fa-2x text-gray-400 text-center mt-5"></i>
              <p class="text-center p-4">Oops! Se pare ca nu am gasit nimic</p>
            @else
              <div class="card-body">
                <div class="scroll-table text-center mb-2">
                  <i class="fas fa-arrows-alt-h text-gray-400"></i>
                </div>

                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                          <th>Nume</th>
                          <th>Prenume</th>
                          <!-- <th>Sterge</th> -->
                          <th>Profil</th>
                      </tr>
                    </thead>

                    <tbody>
                        @foreach($findUsers as $findUser)
                        <tr>
                          <td>{{$findUser->firstname}}</td>
                          <td>{{$findUser->lastname}}</td>
                          <td><a class="btn btn-info btn-sm" href="" role="button"><i class="fas fa-eye font-awesome-icon"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="d-flex">
                    <div class="mx-auto mb-2 mt-2">
                      {{$findUsers->links("pagination::bootstrap-4")}}
                    </div>
                </div>
              </div>
            @endif
          </div>
    @endsection
</x-admin-master>