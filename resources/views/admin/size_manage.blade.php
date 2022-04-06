@extends('admin.layout');
@section('page_title','Manage size')
@section('size_select','active')
@section('content')
         <div class="row justify-content-between">
            <h1>Manage Size</h1>
            <a href="{{ url('admin/Size') }}">
               <button type="button" class="btn btn-primary mt-2">Back</button>
            </a>
         </div>
         <div class="row m-t-30">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{  route('sizeprocess') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">TITLE</label>
                                        <input id="title" name="title" type="text" class="form-control" value="{{ $title }}" aria-required="true" aria-invalid="false" >
                                        @if ($errors->has('title'))
                                            <p class="text-danger">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                   
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            Submit
                                        </button>
                                    </div>
                                    <input type="hidden" name="sizeid" value="{{ $id }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection