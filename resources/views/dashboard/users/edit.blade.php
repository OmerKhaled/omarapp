@extends("layouts.dashboard.main")



@section("content")

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create User Form</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
            <li class="breadcrumb-item active">Edit</li>

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Form </h3>
            </div>

    
            <!-- /.card-header -->

            <!-- form start -->
            <form method="POST" action="{{route("users.update", $user->id)}}" enctype="multipart/form-data">
              @csrf
              @method("PUT")
              <div class="card-body">
                @include("layouts.dashboard._error")
                <div class="form-group">  
                  <label for="firstName">First Name</label>
                  <input type="text"name="first_name" class="form-control" placeholder="First Name" value="{{$user->first_name}}" id="firstName">
                </div>
                <div class="form-group">
                  <label for="lastName">Last Name</label>
                  <input type="text"name="last_name" class="form-control" placeholder="Last Name" id="lastName" value=" {{$user->last_name}}">
                </div>
                <div class="form-group">
                  <label for="userEmail">Email</label>
                  <input type="text" name="email" class="form-control" id="userEmail" value="{{$user->email}}" >
                </div>
                <div class="form-group">
                  <label for="userImg">Image</label>
                  <input type="file" name="img" class="form-control image" id="userImg"/>
                </div>
                <div class="form-group">
                  <img  class="image_preview"src="{{$user->image_path}}" alt="img" style="width:100px; height:100px;">
                </div>


         

              </div>
              <!-- /.card-body -->
              <br/>
              <div class="row">
                <div class="col-12">
                  <!-- Custom Tabs -->
                  <div class="card">
                    <div class="card-header d-flex p-0">
                      <h3 class="card-title p-3">Tabs</h3>
                      <ul class="nav nav-pills ml-auto p-2">
                        @php
                            
                          $models = ["users","category"]; 
                          $maps   = ["create", "read", "update", "delete"];
                        @endphp

                        @foreach ($models as $index=>$model)
                        <li class="nav-item"><a class="nav-link {{$index == 0 ? "active" : '' }}" href="#{{$model}}" data-toggle="tab">{{$model}}</a></li>

                        @endforeach
                      </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content">
                        @foreach ($models as$index => $model)
                        <div class="tab-pane {{$index == 0 ? "active" : ''}}" id="{{$model}}">
                          <div class="form-check">
                            @foreach ($maps as $map)
                            <label style="margin-left: 30px;"class="form-check-label" for="{{$map}}"> <input value="{{$model}}_{{$map}} " type="checkbox" name="permission[]" {{$user->hasPermission($model."_".$map) ? "checked" : ''}} class="form-check-input" id="{{$map}}"/>{{$map}}</label>

                            @endforeach


              
                          </div>
                          
        
                        </div>
                        @endforeach

                        <!-- /.tab-pane -->

                        <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                  </div>
                  <!-- ./card -->
                </div>
                <!-- /.col -->
              </div>
      
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </div>

  </section>
  <!-- Main Content  Start -->



@endsection

