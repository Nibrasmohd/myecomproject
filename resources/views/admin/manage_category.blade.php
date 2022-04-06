@extends('admin.layout');
@section('page_title','Manage catogory')
@section('catogory_select','active')
@section('content')
         <div class="row justify-content-between">
            <h1>Manage Catogory</h1>
            <a href="{{ url('admin/Catogory') }}">
               <button type="button" class="btn btn-primary mt-2">Back</button>
            </a>
         </div>
         <div class="row m-t-30">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{  route('category.manage_category_process') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="catogory" class="control-label mb-1">Catogoty</label>
                                                <input id="catogory" name="catogory" type="text" class="form-control" value="{{ $catogory_name }}" aria-required="true" aria-invalid="false" >
                                                @if ($errors->has('catogory'))
                                                    <p class="text-danger">{{ $errors->first('catogory') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label for="title" class="control-label mb-1">Parent Catogory</label>
                                                <select name="parent_catogory_id" class="form-control" id="parent_catogory_id" required>
                                                <option value="0">select catogories</option>
                                                @foreach ($catogories as $item)
                                                    @if ( $item->id == $parent_catogory_id )
                                                     <option selected value="{{ $item->id }}">{{ $item->catogory_name }}</option>
                                                    @else
                                                     <option value="{{ $item->id }}">{{ $item->catogory_name }}</option>    
                                                    @endif
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="catogory_slug" class="control-label mb-1">Catogoty slug</label>
                                                <input id="catogory_slug" name="catogory_slug" type="text" value="{{ $catogory_slug }}" class="form-control" aria-required="true" aria-invalid="false" >
                                                @if ($errors->has('catogory_slug'))
                                                    <p class="text-danger">{{ $errors->first('catogory_slug') }}</p>
                                                @endif
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">Image</label>
                                        <input id="catogory_image" name="catogory_image" type="file"  class="form-control"   aria-required="true" aria-invalid="false" >
                                        @if ($errors->has('catogory_image'))
                                            <p class="text-danger">{{ $errors->first('catogory_image') }}</p>
                                        @endif
                                        @if ( $catogory_image!='')
                                        <img style="width: 50px;height:50px" src="{{ asset('images/catogory/'.$catogory_image) }}" alt="">
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
                                    <input type="hidden" name="id" value="{{ $id }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
@endsection