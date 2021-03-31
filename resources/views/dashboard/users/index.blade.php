@extends("layouts.dashboard.main")



@section("content")

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">users</li>
            <li class="breadcrumb-item active">create</li>

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Users Table</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <a href="{{route("users.create")}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New User</a>

                  <table style="margin-top:10px;"class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Image</th>

                        <th >Email</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
             

                      @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td><img src = "{{$user->image_path}}" alt="image" title="user image" style="width:100px; height:100px"/></td>

                            <td>{{$user->email}}</td>
                            <td>
                              @if(Auth::user()->hasPermission('users_update'))
        
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                              @else
                              <button class="btn btn-sm" disabled><i class="fas fa-user-edit"></i></button>
                              @endif
                              @if(Auth::user()->hasPermission('users_delete'))
                              <form action="/dashboard/users/{{$user->id}}" method="POST">
                                @csrf
                                @method("delete")
                                <button type="submit "class="btn btn-danger btn-sm"><i class="fas fa-user-minus"></i></button>
                              </form>
                              @else
                              <button class="btn btn-sm" disabled><i class="fas fa-user-minus"></i></button>
                              @endif
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                    
                  </table>
                  <br/>
                  {{$users->links()}}

                </div>
                <!-- /.card-body -->
                {{-- <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div> --}}
              </div>

        </div>

          </div>
    </div>

  </section>
  <!-- Main Content  Start -->



@endsection