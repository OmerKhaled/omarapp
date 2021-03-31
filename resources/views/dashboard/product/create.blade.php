@extends("layouts.dashboard.main")



@section("content")

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{Route("dashboard")}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{Route("product.index")}}">Products</a></li>
            <li class="breadcrumb-item active">Create</li>

            <!--<li class="breadcrumb-item active">create</li>-->

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
        <div class="container-fluid">
          @if (count($categories)== 0)
          <div class="alert alert-danger"><h1>There is No Category !</h1></div>
           
          @endif
 
            <section class="content">

                @include("layouts.dashboard._error")
                    <form method="POST" action="{{Route("product.store")}}" enctype="multipart/form-data">
                      @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title">Create Product</h3>
              
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="form-group">
                              <label for="inputName">Product Name</label>
                              <input type="text" name="name" id="inputName" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="inputDescription">Product Description</label>
                              <textarea id="inputDescription"  name="description" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                              <label for="inputStatus">Category</label>
                              <select id="inputStatus" name="category_id" class="form-control custom-select">
                                <option selected disabled>Select one</option>
                                @foreach ($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="inputClientCompany">Purchase Price</label>
                              <input type="number" min=0 name="purchase_price" placeholder = "$" id="inputClientCompany" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="inputProjectLeader">Sale Price</label>
                              <input type="number" min=0 name="sale_price" id="inputProjectLeader" class="form-control" placeholder="$">
                            </div>
                            <div class="form-group">
                                <label for="inputProjectLeader">Stoke</label>
                                <input type="number" min=0 name="stoke" placeholder="Number" id="inputProjectLeader" class="form-control">
                              </div>
                          </div>
                          
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <div class="col-md-6">
                        <div class="card card-secondary">
                          <div class="card-header">
                            <h3 class="card-title">Product Image</h3>
              
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                          </div>
                          <div class="card-body">
                            <img class="img-fluid image_preview" src="../../dist/img/photo1.png" alt="Photo" style="max-height: 400px;">
                            <br>
                            <br>
                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" name="img" class="custom-file-input image" id="exampleInputFile"/>
                                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                               
                              </div>      
                            </div>
                          <!-- /.card-body --> 
                        </div>
                        <!-- /.card -->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <a href="{{Route("product.index")}}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Create new product" class="btn btn-success float-right">
                      </div>
                    </div>
                </form>
              </section>
          


 
          </div>

  </section>
  <!-- Main Content  Start -->


<br/>
@endsection