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
                                <th>Field</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td>{{ $result->name }}</td>
                            </tr>
                            <tr>    
                                <td><strong>Email</strong></td>
                                <td>{{ $result->email }}</td>
                            </tr>
                            <tr>    
                                <td><strong>mobile</strong></td>
                                <td>{{ $result->mobile }}</td>
                            </tr>
                            <tr>    
                                <td><strong>Adress</strong></td>
                                <td>{{ $result->Adress }}</td>
                            </tr>
                            <tr>    
                                <td><strong>City</strong></td>
                                <td>{{ $result->city }}</td>
                            </tr>
                            <tr>    
                                <td><strong>state</strong></td>
                                <td>{{ $result->state }}</td>
                            </tr>
                            <tr>    
                                <td><strong>zipcode</strong></td>
                                <td>{{ $result->zipcode }}</td>
                            </tr>
                            <tr>    
                                <td><strong>company</strong></td>
                                <td>{{ $result->company }}</td>
                            </tr>
                            <tr>    
                                <td><strong>Gst no</strong></td>
                                <td>{{ $result->gstin}}</td>
                            </tr>
                            <tr>    
                                <td><strong>Added on</strong></td>
                                <td>{{ \Carbon\Carbon::parse($result->created_at->format('d-m-Y h:i:s'))}}</td>
                            </tr>
                            <tr>    
                                <td><strong>updated on</strong></td>
                                <td>{{ \Carbon\Carbon::parse($result->updated_at->format('d-m-y h:i:s'))}}</td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
                <!-- END DATA TABLE-->
            </div>
        </div>

@endsection
