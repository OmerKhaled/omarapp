@extends("layouts.dashboard.main")



@section("content")

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create Category Form</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{Route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{Route('category.index')}}">Category</a></li>
            <li class="breadcrumb-item active">Create</li>

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
              <h3 class="card-title">Create Form </h3>
            </div>

            
            <script>

              new Noty([
                  type: 'success',
                  layout: 'topRight',
                  text: "{{ session('success') }}",
                  timeout: 2000, 
                  killer: true
              ]).show();
          </script>
            <!-- /.card-header -->

            <!-- form start -->
            <form method="POST" action="{{route("category.store")}}" enctype="multipart/form-data">
              @csrf
              @method("POST")
              <div class="card-body">
                @include("layouts.dashboard._error")
                <div class="form-group">  
                  <label for="categoryName">Category Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Category Name" id="categoryName" value=" {{ old("name")}}" placeholder="Enter Category  Name">
                </div>

         

              </div>
              <!-- /.card-body -->
              <br/>
            
      
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </div>

  </section>
  <!-- Main Content  Start -->



@endsection

