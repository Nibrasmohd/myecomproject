@extends('admin.layout');
@section('page_title','Manage brand')
@section('brand_select','active')
@section('content')
         <div class="row justify-content-between">
            <h1>Manage Size</h1>
            <a href="{{ url('admin/Brand') }}">
               <button type="button" class="btn btn-primary mt-2">Back</button>
            </a>
         </div>
         <div class="row m-t-30">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{  route('Brandprocess') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">Name Brand</label>
                                        <input id="namebrand" name="namebrand" type="text" class="form-control" value="{{ $name }}" aria-required="true" aria-invalid="false" >
                                        @if ($errors->has('namebrand'))
                                            <p class="text-danger">{{ $errors->first('namebrand') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">Name Brand</label>
                                        <input id="brandimg" name="brandimg" type="file" class="form-control" value="" aria-required="true" aria-invalid="false" >
                                        @if ($image!='')
                                            <img style="width: 50px;height:50px" src="{{ asset('images/'.$image) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="is_home">show in home page</label>
                                        @if ( $is_home == 1)
                                          <input type="checkbox" name="is_home" checked id="is_home">
                                        @else
                                         <input type="checkbox" name="is_home"  id="is_home">
                                        @endif
                                    </div>
                                   
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            Submit
                                        </button>
                                    </div>
                                    <input type="hidden" name="brandid" value="{{ $id }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection