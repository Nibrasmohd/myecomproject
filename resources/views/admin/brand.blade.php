@extends('admin.layout');
@section('page_title','brand')
@section('brand_select','active')
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
            <h1>BRAND</h1>
            <a href="{{ url('admin/Brand/manage_Brand') }}">
               <button type="button" class="btn btn-primary mt-2">Add Brand</button>
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
                                <th>name</th>
                                <th>image</th>
                                <th>status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($result as $res)
                                <tr>
                                    <td>{{ $res->id }}</td>
                                    <td>{{ $res->name }}</td>
                                    <td>
                                        @if ($res->image!='')
                                            <img style="width: 50px;height:50px" src="{{ asset('images/'.$res->image) }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($res->status==0)
                                         <a href="{{ url('admin/Brand/status/1')}}/{{ $res->id }} ">
                                           <button class="btn btn-warning">DeActive</button>
                                         </a>  
                                        @elseif($res->status==1)
                                         <a href="{{ url('admin/Brand/status/0')}}/{{ $res->id }} ">
                                           <button class="btn btn-success">Active</button>
                                         </a>  
                                      @endif
                                    </td>
                                    <td>
                                          <a href="{{ url('admin/Brand/Brand_manage')}}/{{ $res->id }} ">
                                             <button class="btn btn-primary">Edit</button>
                                          </a>
                                        
                                        <a href="{{ url('admin/Brand/delete') }}/{{ $res->id }}">
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
