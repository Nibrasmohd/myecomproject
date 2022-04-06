@extends('admin.layout');
@section('page_title','Costomer')
@section('costomer_select','active')
@section('content')
@if (session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissable fade show">
 {{ session('message') }}
 <button type="button" class="close" data-dismiss="alert" aria-label="close">
   <span>x</span>
</button>
</div>
@endif
         <div class="row justify-content-start">
            <h1>Costomer</h1>
         </div>
         <div class="row m-t-30">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>city</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($result as $res)
                                <tr>
                                    <td>{{ $res->id }}</td>
                                    <td>{{ $res->name }}</td>
                                    <td>{{ $res->email }}</td>
                                    <td>{{ $res->mobile }}</td>
                                    <td>{{ $res->city }}</td>
                                    <td>
                                        <a href="{{ url('admin/Costomer/view') }}/{{ $res->id }}">
                                            <button class="btn btn-warning">View</button>
                                        </a>
                                        @if ($res->status==0)
                                         <a href="{{ url('admin/Costomer/status/1')}}/{{ $res->id }} ">
                                           <button class="btn btn-warning">DeActive</button>
                                         </a>  
                                        @elseif($res->status==1)
                                         <a href="{{ url('admin/Costomer/status/0')}}/{{ $res->id }} ">
                                           <button class="btn btn-success">Active</button>
                                         </a>  
                                      @endif
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
