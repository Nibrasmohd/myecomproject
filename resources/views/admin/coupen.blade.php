@extends('admin.layout');
@section('page_title','Catogory')
@section('coupen_select','active')
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
            <h1>Coupen</h1>
            <a href="{{ url('admin/Coupem/manage_coupen') }}">
               <button type="button" class="btn btn-primary mt-2">Add Coupen</button>
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
                                <th>Title</th>
                                <th>code</th>
                                <th>value</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($result as $res)
                                <tr>
                                    <td>{{ $res->id }}</td>
                                    <td>{{ $res->title }}</td>
                                    <td>{{ $res->code }}</td>
                                    <td>{{ $res->value }}</td>
                                    <td>
                                          <a href="{{ url('admin/Coupem/manage_coupen')}}/{{ $res->id }} ">
                                             <button class="btn btn-primary">Edit</button>
                                          </a>
                                        @if ($res->status==0)
                                          <a href="{{ url('admin/Coupem/status/1')}}/{{ $res->id }} ">
                                             <button class="btn btn-warning">DeActive</button>
                                          </a>  
                                        @elseif($res->status==1)
                                        <a href="{{ url('admin/Coupem/status/0')}}/{{ $res->id }} ">
                                            <button class="btn btn-success">Active</button>
                                         </a>  
                                        @endif
                                        <a href="{{ url('admin/Coupem/delete') }}/{{ $res->id }}">
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
