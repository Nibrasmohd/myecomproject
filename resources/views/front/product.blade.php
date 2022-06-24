@extends('front.layout')
@section('pagetitle','Product page');
@section('wrapper')


 
   <!-- product category -->
   <section id="aa-product-details">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="aa-product-details-area">
             <div class="aa-product-details-content">
               <div class="row">
                 <!-- Modal view slider -->
                 <div class="col-md-5 col-sm-5 col-xs-12">                              
                   <div class="aa-product-view-slider">                                
                     <div id="demo-1" class="simpleLens-gallery-container">
                       <div class="simpleLens-container">
                         <div class="simpleLens-big-image-container">
                             <a data-lens-image="{{ asset('images/'.$products[0]->image) }}" class="simpleLens-lens-image"><img src="{{ asset('images/'.$products[0]->image) }}" class="simpleLens-big-image"></a></div>
                       </div>
                       <div class="simpleLens-thumbnails-container">
                          <a data-big-image="{{ asset('images/'.$products[0]->image) }}" data-lens-image="{{ asset('images/'.$products[0]->image) }}" class="simpleLens-thumbnail-wrapper" href="javascript:void(0)">
                            <img width="70px" src="{{ asset('images/'.$products[0]->image) }}">
                           </a>
                           @if (isset($productsimg[0]))
                            @foreach ($productsimg as $item)
                            <a data-big-image="{{ asset('images/'.$item->images) }}" data-lens-image="{{ asset('images/'.$item->images) }}" class="simpleLens-thumbnail-wrapper" href="javascript:void(0)">
                             <img width="70px" src="{{ asset('images/'.$item->images) }}">
                            </a>  
                            @endforeach
                           @endif                                                        
                       </div>
                     </div>
                   </div>
                 </div>
                 <!-- Modal view content -->
                 <div class="col-md-7 col-sm-7 col-xs-12">
                   <div class="aa-product-view-content">
                     <h3>{{ $products[0]->name }}</h3>
                     <div class="aa-price-block">
                       <span class="aa-product-view-price">Rs {{ $productsattr[0]->price }}&nbsp;&nbsp;&nbsp;</span>
                       <span class="text-danger aa-product-view-price"><del>Rs {{ $productsattr[0]->mrp }}</del></span>
                       <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                       @if ($products[0]->lead_time!='')
                          <p class="lead_time">{{ $products[0]->lead_time }} </p>                          
                       @endif
                     </div>
                     <p></p>
                     <h4>Size</h4>
                     <div class="aa-prod-view-size">
                         @php
                            $arr=[];
                            foreach ($productsattr as $item) {
                              array_push($arr,$item->title);
                            }
                            $arr=array_unique($arr) 
                         @endphp
                         @foreach ($arr as $item)
                               <a href="javascript:void(0)" class="allsizes size_{{$item}}" onclick="selectSize('{{ $item }}')" >{{ $item}}</a>
                
                         @endforeach
                     </div>

                     <h4>Color</h4>
                     <div class="aa-color-tag">
                        @foreach ($productsattr as $items)
                        @if ($items->colour!='')
                        <a href="javascript:void(0)" onclick="change_product_colourandsize_image('{{ $items->image }}','{{ $items->colour }}')" class="allcolours color_{{ $items->title}} aa-color-{{strtolower($items->colour)}}"></a>  
                        @endif
                        @endforeach                 
                     </div>

                     <div class="aa-prod-quantity">
                       <form action="">
                         <select id="productqties" onclick="addquant()" name="">
                          @for ($i = 1; $i < 11; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                          @endfor
                         </select>
                       </form>
                       <p class="aa-prod-category">
                         model: <a href="#">{{$products[0]->model }}</a>
                       </p>
                     </div>
                     <div class="aa-prod-view-bottom">
                       <a class="aa-add-to-cart-btn" onclick="add_to_cart('{{ $productsattr[0]->color_id }}','{{ $productsattr[0]->size_id }}')" href="#">Add To Cart</a>
                     </div>
                     <div id="addcartmessge">
                         
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <div class="aa-product-details-bottom">
               <ul class="nav nav-tabs" id="myTab2">
                 <li><a href="#description" data-toggle="tab">Description</a></li>
                 <li><a href="#tecnicalspec" data-toggle="tab">Technical specification</a></li>
                 <li><a href="#uses" data-toggle="tab">Uses</a></li>
                 <li><a href="#warenty" data-toggle="tab">Warenty</a></li>
                 <li><a href="#review" data-toggle="tab">Reviews</a></li>                
               </ul>
 
               <!-- Tab panes -->
               <div class="tab-content">
                 <div class="tab-pane fade in active" id="description">
                    <p>{{ $products[0]->desc }}</p>
                 </div>
                 <div class="tab-pane fade" id="tecnicalspec">
                    <p>{{ $products[0]->technical_specification }}</p>
                 </div>
                 <div class="tab-pane fade" id="uses">
                    <p>{{ $products[0]->uses }}</p>
                 </div>
                 <div class="tab-pane fade" id="warenty">
                    <p>{{ $products[0]->warenty }}</p>
                 </div>
                 <div class="tab-pane fade " id="review">
                  <div class="aa-product-review-area">
                    <h4>2 Reviews for T-Shirt</h4> 
                    <ul class="aa-review-nav">
                       <li>
                         <div class="media">
                           <div class="media-left">
                             <a href="#">
                               <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                             </a>
                           </div>
                           <div class="media-body">
                             <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                             <div class="aa-product-rating">
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star-o"></span>
                             </div>
                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                           </div>
                         </div>
                       </li>
                    </ul>
                    <h4>Add a review</h4>
                    <div class="aa-your-rating">
                      <p>Your Rating</p>
                      <a href="#"><span class="fa fa-star-o"></span></a>
                      <a href="#"><span class="fa fa-star-o"></span></a>
                      <a href="#"><span class="fa fa-star-o"></span></a>
                      <a href="#"><span class="fa fa-star-o"></span></a>
                      <a href="#"><span class="fa fa-star-o"></span></a>
                    </div>
                    <!-- review form -->
                    <form action="" class="aa-review-form">
                       <div class="form-group">
                         <label for="message">Your Review</label>
                         <textarea class="form-control" rows="3" id="message"></textarea>
                       </div>
                       <div class="form-group">
                         <label for="name">Name</label>
                         <input type="text" class="form-control" id="name" placeholder="Name">
                       </div>  
                       <div class="form-group">
                         <label for="email">Email</label>
                         <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                       </div>
 
                       <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                    </form>
                  </div>
                 </div>            
               </div>
             </div>
             <!-- Related product -->
             <div class="aa-product-related-item">
               <h3>Related Products</h3>
               <ul class="aa-product-catg aa-related-item-slider">
                 <!-- start single product item -->
                 @foreach ($productrelated as $item)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="{{ url('product/'.$item->slug) }}"><img src="{{ asset('images/'.$item->image) }}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption>
                          <h4 class="aa-product-title"><a href="#">{{ $item->name }}</a></h4>
                          <span class="aa-product-price">${{ $productrelatedattr[$item->id][0]->price }}</span><span class="aa-product-price"><del>${{ $productrelatedattr[$item->id][0]->price }}</del></span>
                        </figcaption>
                      </figure>                     
                    </li>
                    @endforeach
                  <!-- start single product item -->                                                                                  
               </ul>
                
             </div>  
           </div>
         </div>
       </div>
     </div>
   </section>
   <!-- / product category -->
 
 
   <!-- Subscribe section -->
   <section id="aa-subscribe">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="aa-subscribe-area">
             <h3>Subscribe our newsletter </h3>
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
             <form action="" class="aa-subscribe-form">
               <input type="email" name="" id="" placeholder="Enter your Email">
               <input type="submit" value="Subscribe">
             </form>
           </div>
         </div>
       </div>
     </div>
     <form action="" id="frmAddtocart">
       <input type="text" name="sizeid" id="sizeid">
       <input type="text" name="colorid" id="colorid">
       <input type="text" name="productqty" value="1" id="productqty">
       <input type="text" name="product_id" value="{{ $products[0]->id }}" id="product_id">
       @csrf
     </form>
   </section>
    
@endsection

   

