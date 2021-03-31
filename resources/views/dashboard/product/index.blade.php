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
            <li class="breadcrumb-item active">Products</li>
            <!--<li class="breadcrumb-item active">create</li>-->

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
                  <h3 class="card-title">Products Table</h3>
                </div>  
                <!-- /.card-header -->

                <div class="card-body">
                    <a href="{{Route('product.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New Product</a>

                  <table style="margin-top:10px;"class="table table-bordered text-center">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Purchase_price</th>
                        <th>sale_price</th>
                        <th>stoke</th>
                        <th>category</th>
                        <th>profit</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                

                      @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td><img src="{{$product->image_path}}" alt="Product image" style="width:100px; height: 100px;"></td>
                            <td>{{$product->purchase_price}}$</td>
                            <td>{{$product->sale_price}}$</td>
                            <td>{{$product->stoke}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->profit_percent}}$</td>



                            <td>
                              @if(Auth::user()->hasPermission('products_update'))
        
                                <a href="/dashboard/product/{{$product->id}}/edit" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                              @else
                              <button class="btn btn-sm" disabled><i class="fas fa-user-edit"></i></button>
                              @endif
                              @if(Auth::user()->hasPermission('products_delete'))
                              <form action="/dashboard/product/{{$product->id}}" method="POST">
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
                  {{$products->links()}}

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