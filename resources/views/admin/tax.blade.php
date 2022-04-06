@extends('admin.layout');
@section('page_title','tax')
@section('tax_select','active')
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
            <h1>SIZE</h1>
            <a href="{{ url('admin/Tax/manage_Tax') }}">
               <button type="button" class="btn btn-primary mt-2">Add Tax</button>
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
                                <th>TAX desc</th>
                                <th>Tax Value</th>
                                <th>status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($result as $res)
                                <tr>
                                    <td>{{ $res->id }}</td>
                                    <td>{{ $res->tax_desc }}</td>
                                    <td>{{ $res->tax_value }}</td>
                                    <td>
                                        @if ($res->status==0)
                                         <a href="{{ url('admin/Tax/status/1')}}/{{ $res->id }} ">
                                           <button class="btn btn-warning">DeActive</button>
                                         </a>  
                                        @elseif($res->status==1)
                                         <a href="{{ url('admin/Tax/status/0')}}/{{ $res->id }} ">
                                           <button class="btn btn-success">Active</button>
                                         </a>  
                                      @endif
                                    </td>
                                    <td>
                                          <a href="{{ url('admin/Tax/Tax_manage')}}/{{ $res->id }} ">
                                             <button class="btn btn-primary">Edit</button>
                                          </a>
                                        
                                        <a href="{{ url('admin/Tax/delete') }}/{{ $res->id }}">
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
