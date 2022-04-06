@extends('admin.layout');
@section('page_title','Manage tax')
@section('tax_select','active')
@section('content')
         <div class="row justify-content-between">
            <h1>Manage Tax</h1>
            <a href="{{ url('admin/Tax') }}">
               <button type="button" class="btn btn-primary mt-2">Back</button>
            </a>
         </div>
         <div class="row m-t-30">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{  route('Taxprocess') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                      <div class="row">
                                         <div class="col-md-6">
                                            <label for="tax_desc" class="control-label mb-1">Tax Desc</label>
                                            <input id="tax_desc" name="tax_desc" type="text" class="form-control" value="{{ $tax_desc }}" aria-required="true" aria-invalid="false" >
                                            @if ($errors->has('tax_desc'))
                                                <p class="text-danger">{{ $errors->first('tax_desc') }}</p>
                                            @endif
                                         </div>
                                         <div class="col-md-6">
                                            <label for="tax_value" class="control-label mb-1">Tax Value</label>
                                            <input id="tax_value" name="tax_value" type="text" class="form-control" value="{{ $tax_value }}" aria-required="true" aria-invalid="false" >
                                            @if ($errors->has('tax_value'))
                                                <p class="text-danger">{{ $errors->first('tax_value') }}</p>
                                            @endif
                                         </div>
                                      </div>
                                    </div>
                                   
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            Submit
                                        </button>
                                    </div>
                                    <input type="hidden" name="taxid" value="{{ $id }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection