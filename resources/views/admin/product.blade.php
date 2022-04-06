@extends('admin.layout');
@section('page_title','Catogory')
@section('product_select','active')

@section('content')
       @if (session()->has('message'))
         <div class="sufee-alert alert with-close alert-success alert-dismissable fade show">
          {{ session('message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span>x</span>
         </button>
       </div>
       @endif
      
         <div class="row justify-content-between">
            <h1>Product</h1>
            <a href="Product/manage_Product">
               <button type="button" class="btn btn-primary mt-2">Add Prdouct</button>
            </a>
         </div>
         <div class="row m-t-30">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>product_Name</th>
                                <th>product_Slug</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($result as $item)
                                
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>
                                    @if ( $item->image!='')
                                       <img style="width: 50px;height:50px" src="{{ asset('images/'.$item->image) }}" alt="">
                                    @endif
                                    </td>
                                    <td>
                                          <a href="{{ url('admin/Product/Product_manage')}}/{{ $item->id }}">
                                            <button class="btn btn-primary">Edit</button>
                                          </a>
                                        @if ($item->status==1)
                                          <a href="{{ url('admin/Product/status/0')}}/{{ $item->id }}">
                                             <button class="btn btn-Success">Active</button>
                                          </a>
                                        @elseif($item->status==0)
                                        <a href="{{ url('admin/Product/status/1')}}/{{ $item->id }}">
                                            <button class="btn btn-warning">DeActive</button>
                                         </a>
                                        @endif
                                        <a href="{{ url('admin/Product/delete')}}/{{ $item->id }}">
                                            <button class="btn btn-danger">Delete</button>
                                         </a>
                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE-->
            </div>
        </div>

@endsection