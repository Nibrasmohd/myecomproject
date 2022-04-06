@extends('admin.layout')

@section('page_title','Catogory')
@section('coupen_select','active')

@section('content')
<div class="row justify-content-between">
    <h1>Manage Coupen</h1>
    <a href="{{ url('admin/Coupem') }}">
       <button type="button" class="btn btn-primary mt-2">Back</button>
    </a>
 </div>
 <div class="row m-t-30">
 
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('coloumaddanupdateprocess') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="title" class="control-label mb-1">Title</label>
                                        <input id="title" name="title" type="text" class="form-control" value="{{ $title  }}"  aria-required="true" aria-invalid="false" >
                                        @if ($errors->has('title'))
                                            <p class="text-danger">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="code" class="control-label mb-1">Code</label>
                                        <input id="code" name="code" type="text"  class="form-control" value="{{ $code }}" aria-required="true" aria-invalid="false" >
                                        @if ($errors->has('code'))
                                        <p class="text-danger">{{ $errors->first('code') }}</p>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                      <label for="value" class="control-label mb-1">Value</label>
                                      <input id="value" name="value" type="text"  class="form-control" value="{{ $value  }}" aria-required="true" aria-invalid="false" >
                                      @if ($errors->has('value'))
                                        <p class="text-danger">{{ $errors->first('value') }}</p>
                                      @endif
                                    </div>
                                    <div class="col-md-6">
                                            <label for="type">Type</label>
                                            <select name="type" id="type" class="form-control" required>
                                            @if ($type == 'Value')
                                              <option selected value="Value">Value</option>
                                              <option value="per">Per</option>
                                            @elseif($type == 'per')
                                              <option value="Value">Value</option>
                                              <option selected value="per">Per</option>
                                            @else
                                              <option value="Value">Value</option>
                                              <option value="per">Per</option>
                                            @endif
                                            
                                            </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                      <label for="min_order_amt" class="control-label mb-1">Min order Amt</label>
                                      <input id="min_order_amt" name="min_order_amt" type="text"  class="form-control" value="{{ $min_order_amt  }}" aria-required="true" aria-invalid="false" >
                                      @if ($errors->has('min_order_amt'))
                                        <p class="text-danger">{{ $errors->first('min_order_amt') }}</p>
                                      @endif
                                    </div>
                                    <div class="col-md-6">
                                            <label for="is_one_time">is_one_time</label>
                                            <select name="is_one_time" id="is_one_time" class="form-control" required>
                                            @if ($is_one_time == '1')
                                              <option selected value="1">Yes</option>
                                              <option value="0">No</option>
                                            @elseif($is_one_time == '0')
                                              <option value="1">YES</option>
                                              <option selected value="0">NO</option>
                                            @else
                                              <option value="1">YES</option>
                                              <option value="0">NO</option>
                                            @endif
                                            
                                            </select>
                                    </div>
                                </div>
                            </div>
                           
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    Submit
                                </button>
                            </div>
                            <input type="hidden" name="coupenid" value="{{ $id }}" >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection