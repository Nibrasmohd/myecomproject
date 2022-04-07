@extends('admin.layout');
@section('page_title','Manage Banner')
@section('banner_select','active')
@section('content')
         <div class="row justify-content-between">
            <h1>Manage HomeBanner</h1>
            <a href="{{ url('admin/HomeBanner') }}">
               <button type="button" class="btn btn-primary mt-2">Back</button>
            </a>
         </div>
         <div class="row m-t-30">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{  route('HomeBannerprocess') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="bannerimage" class="control-label mb-1">Image</label>
                                        <input id="bannerimage" name="bannerimage" type="file" class="form-control" >
                                        @if ($errors->has('bannerimage'))
                                            <p class="text-danger">{{ $errors->first('color') }}</p>
                                        @endif
                                        @if ($image!='')
                                        <img style="width: 50px;height:50px" src="{{ asset('images/banner/'.$image) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn_text">Button Text</label>
                                        <input type="text" name="btn_text" class="form-control" value="{{ $btntxt }}" id="btn_text">
                                    </div>
                                    <div class="form-group">
                                        <label for="btn_text">Button Link</label>
                                        <input type="text" name="btn_link" class="form-control" value="{{ $btnlink }}" id="btn_link">
                                    </div>
                                   
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            Submit
                                        </button>
                                    </div>
                                    <input type="hidden" name="bannerid" value="{{ $id }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection