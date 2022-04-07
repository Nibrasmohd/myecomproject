@extends('admin.layout');
@section('page_title','brand')
@section('banner_select','active')
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
            <h1>Home Banner</h1>
            <a href="{{ url('admin/HomeBanner/manage_HomeBanner') }}">
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
                                <th>image</th>
                                <th>btn-txt</th>
                                <th>btn-link</th>
                                <th>status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($result as $res)
                                <tr>
                                    <td>
                                        @if ($res->image!='')
                                            <img style="width: 50px;height:50px" src="{{ asset('images/banner/'.$res->image) }}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $res->btn_txt }}</td>
                                    <td>{{ $res->btn_link }}</td>
                                    <td>
                                        @if ($res->status==0)
                                         <a href="{{ url('admin/HomeBanner/status/1')}}/{{ $res->id }} ">
                                           <button class="btn btn-warning">DeActive</button>
                                         </a>  
                                        @elseif($res->status==1)
                                         <a href="{{ url('admin/HomeBanner/status/0')}}/{{ $res->id }} ">
                                           <button class="btn btn-success">Active</button>
                                         </a>  
                                      @endif
                                    </td>
                                    <td>
                                          <a href="{{ url('admin/HomeBanner/HomeBanner_manage')}}/{{ $res->id }} ">
                                             <button class="btn btn-primary">Edit</button>
                                          </a>
                                        
                                        <a href="{{ url('admin/HomeBanner/delete') }}/{{ $res->id }}">
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
