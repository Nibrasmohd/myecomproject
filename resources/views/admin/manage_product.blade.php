@extends('admin.layout');
@section('page_title','Manage product')
@section('product_select','active')
@section('content')

@if ($productid > 0)
  {{ $image_required = '' }}
@else
  {{ $image_required = 'required' }}
@endif
         <div class="row justify-content-between">
            <h1>Manage Product</h1>
            @if ($errors->has('attrimage'))
            <p class="text-danger">{{ $errors->first('attrimage') }}</p>
            @endif
            {{ session('sku_error') }}
            <a href="{{ url('admin/Product') }}">
               <button type="button" class="btn btn-primary mt-2">Back</button>
            </a>
         </div>
         <div class="row m-t-30">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{  route('Productprocess') }}" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body">
                               
                                    @csrf
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">name</label>
                                        <input id="proname" name="proname" type="text" class="form-control" value="{{ $name }}"  aria-required="true" aria-invalid="false" >
                                        @if ($errors->has('proname'))
                                            <p class="text-danger">{{ $errors->first('proname') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">slug</label>
                                        <input id="slug" name="slugs" type="text" class="form-control" value="{{ $slug }}"  aria-required="true" aria-invalid="false" >
                                        @if ($errors->has('slugs'))
                                            <p class="text-danger">{{ $errors->first('slugs') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">image</label>
                                        <input id="image" name="image" type="file"  class="form-control"   aria-required="true" aria-invalid="false" {{ $image_required }}>
                                        @if ($errors->has('image'))
                                            <p class="text-danger">{{ $errors->first('image') }}</p>
                                        @endif
                                        @if ($image!='')
                                            <img style="width: 50px;height:50px" src="{{ asset('images/'.$image) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="row">
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">Catogory</label>
                                            <select name="catogoryid" class="form-control" id="catogory_id">
                                                <option value="">select catogories</option>
                                                @foreach ($catogory as $item)
                                                   @if ( $item->id == $catogory_id  )
                                                    <option selected value="{{ $item->id }}">{{ $item->catogory_name }}</option>
                                                   @else
                                                   <option value="{{ $item->id }}">{{ $item->catogory_name }}</option>    
                                                   @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">brand</label>
                                               <select name="brand" class="form-control" id="brand">
                                                   <option value="">select brand</option>
                                                   @foreach ($brands as $item)
                                                       @if ($item->id == $brand)
                                                           <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                                       @else
                                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                       @endif
                                                      
                                                   @endforeach
                                               </select>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1">model</label>
                                                <input id="model" name="model" type="text" class="form-control" value="{{ $model }}"  aria-required="true" aria-invalid="false" >
                                                
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">short_desc</label>
                                        <textarea name="shortdesc" class="form-control" id="short_desc" cols="30" rows="2">{{ $shortdec }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">descvribtion</label>
                                        <textarea name="desc" id="desc"class="form-control" cols="30" rows="2">{{ $desc }}</textarea>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">keywords</label>
                                        <textarea name="keywords" class="form-control" id="keywords" cols="30" rows="2">{{ $keyword }}</textarea>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">technical_specification</label>
                                        <textarea name="technicalspn" class="form-control" id="technicalspn" cols="30" rows="2">{{ $teechspec }}</textarea>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">uses</label>
                                        <textarea name="uses" id="uses" class="form-control" cols="30" rows="2">{{ $uses }}</textarea>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="control-label mb-1">warenty</label>
                                        <textarea name="warenty" id="warenty" class="form-control" cols="30" rows="2">{{ $warenty }}</textarea>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="lead_time">Lead time</label>
                                            <input type="text" class="form-control" name="lead_time" id="lead_time" value="{{ $lead_time }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tax_id">Tax</label>
                                            <select name="tax_id" class="form-control" id="tax_id">
                                                <option value="">select brand</option>
                                                @foreach ($tax as $item)
                                                    @if ($item->id == $tax_id)
                                                        <option selected value="{{ $item->id }}">{{ $item->tax_desc }}</option>
                                                    @else
                                                       <option value="{{ $item->id }}">{{ $item->tax_desc }}</option>
                                                    @endif
                                                   
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                       
                                        <div class="col-md-3 mt-3">
                                            <label for="is_promo">Is Promo</label>
                                            <select name="is_promo" id="is_promo" class="form-control" required>
                                            @if ($is_promo == 1)
                                              <option selected value="1">YES</option>
                                              <option value="0">NO</option>
                                            @elseif($is_promo == 0)
                                              <option value="1">YES</option>
                                              <option selected value="0">NO</option>
                                            @else
                                              <option value="1">YES</option>
                                              <option value="0">NO</option>
                                            @endif
                                            
                                            </select>
                                        </div>
                                       
                                            <div class="col-md-3 mt-3">
                                                <label for="is_featured">Is Featured</label>
                                                <select name="is_featured" id="is_featured" class="form-control" required>
                                                @if ($is_featured == 1)
                                                  <option selected value="1">YES</option>
                                                  <option value="0">NO</option>
                                                @elseif($is_featured == 0)
                                                  <option value="1">YES</option>
                                                  <option selected value="0">NO</option>
                                                @else
                                                  <option value="1">YES</option>
                                                  <option value="0">NO</option>
                                                @endif
                                                
                                                </select>
                                            </div>
                                        
                                            <div class="col-md-3 mt-3">
                                                <label for="is_discounted">Is Discounted</label>
                                                <select name="is_discounted" id="is_discounted" class="form-control" required>
                                                @if ($is_discounted == 1)
                                                  <option selected value="1">YES</option>
                                                  <option value="0">NO</option>
                                                @elseif($is_discounted == 0)
                                                  <option value="1">YES</option>
                                                  <option selected value="0">NO</option>
                                                @else
                                                  <option value="1">YES</option>
                                                  <option value="0">NO</option>
                                                @endif
                                                
                                                </select>
                                            </div>
                                       
                                            <div class="col-md-3 mt-3">
                                                <label for="is_trending">Is Trending</label>
                                                <select name="is_trending" id="is_trending" class="form-control" required>
                                                @if ($is_trending == 1)
                                                  <option selected value="1">YES</option>
                                                  <option value="0">NO</option>
                                                @elseif($is_trending == 0)
                                                  <option value="1">YES</option>
                                                  <option selected value="0">NO</option>
                                                @else
                                                  <option value="1">YES</option>
                                                  <option value="0">NO</option>
                                                @endif
                                                
                                                </select>
                                            </div>
                                        
                                    </div>
                                   
                                    
                                    <input type="hidden" name="productid" value="{{ $productid }}">
                                
                            </div>
                        </div>
                        <h2>product images</h2>
                        <div class="row" >
                            @php
                                $loop_count = 1;                               
                            @endphp
                                
                            @foreach ($productattrimages as $item)
                            <?php 
                                 $mkimg = (array)$item;
                                 $loop_count_prev = $loop_count;  
                            ?>
                            
                            <div class="card" id="attr_productimg_{{ $loop_count++ }}">
                                <div class="card-body">
                                   <div class="row" id="attr_productimg_wrapper">
                                       <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" hidden name="proimgid[]" value="{{ $mkimg['id'] }}">
                                            <label for="title" class="control-label mb-1">product Images</label>
                                            <input id="proimages" name="proimages[]" type="file"  class="form-control"   aria-required="true" aria-invalid="false" {{ $image_required }}>
                                            @if ( $mkimg['images']!='')
                                             <img style="width: 50px;height:50px" src="{{ asset('images/'.$mkimg['images']) }}" alt="">
                                            @endif
                                        </div>
                                        
                                        @if ( $loop_count == 2)
                                        <button type="button" class="btn  btn-success btn-lg" onclick="addmore_image_more()"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD</button>
                                        @else
                                        <a href="{{ url('admin/Product_attr_image_delete')}}/{{ $mkimg['id']  }}/{{ $productid  }}">
                                            <button type="button" class="btn  btn-danger btn-lg" ><i class="fa fa-minus"></i>&nbsp;&nbsp;remove</button>
                                        </a>
                                        @endif
                                    </div> 
                                   </div>
                                </div>
                            </div>
                            
                            @endforeach
                            
                        </div>
                        <h2>product attribute</h2>
                        <div class="row" id="attr_product_wrapper">
                            @php
                                $loop_count = 1;                               
                            @endphp
                                
                            @foreach ($productattr as $item)
                            <?php 
                                 $mkarr = (array)$item;
                                 $loop_count_prev = $loop_count;  
                            ?>
                            <input type="text" hidden name="proid[]" value="{{ $mkarr['id'] }}">
                            <div class="card" class="product_images" id="attr_product_{{ $loop_count++ }}">
                                <div class="card-body">
                                   <div class="row">
                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">sku</label>
                                            <input id="sku" name="sku[]" type="text" value="{{ $mkarr['sku'] }}" class="form-control" aria-required="true" required aria-invalid="false" >
                                        </div>
                                      </div>
                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">mrp</label>
                                            <input id="mrp" name="mrp[]" type="text" value="{{ $mkarr['mrp'] }}" class="form-control" aria-required="true" required aria-invalid="false" >
                                        </div>
                                      </div>
                                      <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">price</label>
                                            <input id="price" name="price[]" type="text" value="{{ $mkarr['price'] }}" class="form-control" aria-required="true" required aria-invalid="false" >
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">size</label>
                                            <select id="size_id" name="size[]" class="form-control">
                                                <option value="">select</option>
                                                @foreach ($size as $val)
                                                    @if ( $val->id == $mkarr['size_id'] )
                                                      <option selected value="{{ $val->id }}">{{ $val->title }}</option>
                                                    @else
                                                      <option value="{{ $val->id }}">{{ $val->title }}</option> 
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">color</label>
                                            <select id="color_id" name="color[]" class="form-control">
                                                <option value="">select</option>
                                                @foreach ($color as $col)
                                                @if ( $col->id == $mkarr['color_id'] )
                                                  <option selected value="{{ $col->id }}">{{ $col->colour }}</option>
                                                @else
                                                  <option value="{{ $col->id }}">{{ $col->colour }}</option> 
                                                @endif
                                            @endforeach
                                            </select>
                                        </div>
                                      </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">qty</label>
                                            <input id="qty" name="qty[]" value="{{ $mkarr['qty'] }}"  type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                        </div>
                                       </div>
                                       <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">Attr_image</label>
                                            <input id="attrimage" name="attrimage[]" type="file"  class="form-control"   aria-required="true" aria-invalid="false" >
                                            @if ( $mkarr['image']!='')
                                             <img style="width: 50px;height:50px" src="{{ asset('images/'.$mkarr['image']) }}" alt="">
                                            @endif
                                        </div>
                                       </div>
                                       <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="title" class="control-label mb-1">&nbsp;&nbsp;</label>
                                            @if ( $loop_count == 2)
                                            <button type="button" class="btn mt-3 btn-success btn-lg" onclick="addmore()"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD</button>
                                            @else
                                            <a href="{{ url('admin/Product_attr_delete')}}/{{ $mkarr['id'] }}/{{ $productid  }}">
                                                <button type="button" class="btn mt-3 btn-danger btn-lg" ><i class="fa fa-minus"></i>&nbsp;&nbsp;remove</button>
                                            </a>
                                            @endif
                                        </div>

                                       </div>
                                   </div>
                                </div>
                            </div>
                            
                            @endforeach
                            
                        </div>
                        
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info ">
                                Submit
                            </button>
                        </div>
                    
                        </form>
                    </div>
                
                </div>
            </div>
        </div>


@endsection
<script>
     
    loop_count=1
    
      addmore=()=>{
       loop_count++
       sizesinner=$('#size_id').html()
       colorinner=$('#color_id').html()
       sizesinner=sizesinner.replace('selected','')
       colorinner=colorinner.replace('selected','')
   
       console.log(sizesinner);
       console.log(colorinner);
       
       htmlcontent = `
       <input type="text" hidden name="proid[]" value="">
       <div class="card" id="attr_product_${loop_count}">
                                   <div class="card-body">
                                      <div class="row">
                                         <div class="col-md-2">
                                           <div class="form-group">
                                               <label for="title" class="control-label mb-1">sku</label>
                                               <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" required aria-invalid="false" >
                                           </div>
                                         </div>
                                         <div class="col-md-2">
                                           <div class="form-group">
                                               <label for="title" class="control-label mb-1">mrp</label>
                                               <input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" required aria-invalid="false" >
                                           </div>
                                         </div>
                                         <div class="col-md-2">
                                           <div class="form-group">
                                               <label for="title" class="control-label mb-1">price</label>
                                               <input id="price" name="price[]" type="text" class="form-control" aria-required="true" required aria-invalid="false" >
                                           </div>
                                         </div>
                                         <div class="col-md-3">
                                           <div class="form-group">
                                               <label for="title" class="control-label mb-1">size</label>
                                               <select id="size_id" name="size[]" class="form-control">
                                                   ${sizesinner}
                                               </select>
                                           </div>
                                         </div>
                                         <div class="col-md-3">
                                           <div class="form-group">
                                               <label for="title" class="control-label mb-1">color</label>
                                               <select id="color_id" name="color[]" class="form-control">
                                                   ${colorinner}
                                               </select>
                                           </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-2">
                                           <div class="form-group">
                                               <label for="title" class="control-label mb-1">qty</label>
                                               <input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                           </div>
                                          </div>
                                          <div class="col-md-4">
                                           <div class="form-group">
                                               <label for="title" class="control-label mb-1">Attr_image</label>
                                               <input id="attrimage" name="attrimage[]" type="file"  class="form-control"   aria-required="true" aria-invalid="false" {{ $image_required }}>
                                           </div>
                                          </div>
                                          <div class="col-md-2">
                                           <div class="form-group">
                                               <label for="title" class="control-label mb-1">&nbsp;&nbsp;</label>
                                               <button type="button" class="btn mt-3 btn-danger btn-lg" onclick="removeimgitem(${loop_count})"><i class="fa fa-minus"></i>&nbsp;&nbsp;remove</button>
                                           </div>
                                          </div>
                                      </div>
                                   </div>
                               </div>`
   
          $('#attr_product_wrapper').append(htmlcontent)
      }
   
      removeimgitem=(count)=>{
          $(`#attr_product_${count}`).remove();
      }

      removeitem=(count)=>{
          $(`#attr_productimgs_${count}`).remove();
      }
   
   
      loop_counts=1;
      addmore_image_more=()=>{
        
          innertext=`
                  <div class="col-md-4" id="attr_productimgs_${loop_counts}">
                                           <div class="form-group">
                                               <input type="text" hidden name="proimgid[]" value="">
                                               <label for="title" class="control-label mb-1">product Images</label>
                                               <input id="proimages" name="proimages[]" type="file"  class="form-control"   aria-required="true" aria-invalid="false" {{ $image_required }}>
                                               
                                           </div>
                                            <button type="button" class="btn btn-lg btn-danger" onclick="removeitem(${loop_counts})"><i class="fa fa-minus"></i>&nbsp;&nbsp;remove</button>
                                           
                                        </div> 
                                      `
   
           $('#attr_productimg_wrapper').append(innertext)
           loop_counts++;                    
           }
   </script>
   