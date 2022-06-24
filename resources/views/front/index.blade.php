@extends('front.layout')
@section('pagetitle','Home page');
@section('wrapper')
<section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
          @foreach ($homebanner as $item)
          <li>
            <div class="seq-model">
              <img data-seq src="{{ asset('images/banner/'.$item->image) }}" alt="Men slide img" />
            </div>
            <div class="seq-title">
              <a data-seq target="_blank" href="{{ $homebanner[0]->btn_link }}" class="aa-shop-now-btn aa-secondary-btn">{{ $homebanner[0]->btn_txt }}</a>
            </div>
          </li>
          @endforeach
            <!-- single slide item -->                  
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
<section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <div class="col-md-12 no-padding">
                <div class="aa-promo-right">
                 @foreach ($home_catogories as $item)
                   <div class="aa-single-promo-right">
                     <div class="aa-promo-banner">                      
                       <img src="{{ asset('images/catogory/'.$item->catogory_image) }}" alt="img">                      
                       <div class="aa-prom-content">
                         <h4><a href="{{ url('catogory/'.$item->catogory_slug) }}">For {{ $item->catogory_name }}</a></h4>                        
                       </div>
                     </div>
                  </div>
                 @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">
                     @foreach ($home_catogories as $item)
                         <li class=""><a href="#cat{{ $item->id }}" data-toggle="tab">{{ $item->catogory_name }}</a></li>
                     @endforeach
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- Start men product category -->
                    @php
                      $loop_count = 1;
                    @endphp
                    @foreach ($home_catogories as $item)
                    @php
                        if ($loop_count == 1) {
                          $activeclass = "in active";
                      }else{
                        $activeclass=''; 
                      }
                    @endphp
                  
                    <div class="tab-pane fade {{ $activeclass }}" id="cat{{ $item->id }}">
                       
                          @if (isset($home_catogories_products[$item->id][0]))
                              @foreach ($home_catogories_products[$item->id] as $list)
                              <ul class="aa-product-catg">
                              <li>
                                
                              <figure>
                                <a class="aa-product-img" href="{{ url('product/'.$list->slug) }}"><img src="{{ asset('images/'.$list->image) }}" alt="polo shirt img"></a>
                                <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{ $home_products_attr[$list->id][0]->proid }}','{{ $home_products_attr[$list->id][0]->title }}','{{ $home_products_attr[$list->id][0]->colour }}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                  <figcaption>
                                  <h4 class="aa-product-title"><a href="#">{{ $list->name }}</a></h4>
                                    <span class="aa-product-price">${{ $home_products_attr[$list->id][0]->price }}</span><span class="aa-product-price"><del>${{ $home_products_attr[$list->id][0]->mrp }}</del></span>
                                  </figcaption>
                                </figure>                        
                              </li>  
                            </ul>  
                            @endforeach   
                          @else
                          <ul class="aa-product-catg">
                          <li>
                            <figure>
                              <p class="text-muted text-center my-5">There is no products in this catogory</p>
                            </figure>
                          <li>
                          </ul>                                           
                          @endif                                          
                                        
                      </div>
                      @php
                        $loop_count=$loop_count+1;
                      @endphp
                    @endforeach
                  
                                 
                    <!-- / electronic product category -->
                  </div>
                  <!-- quick view modal -->                  
                            
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
 

  <!-- / Products section -->
  <!-- banner section -->
  <section id="aa-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">        
          <div class="row">
            <div class="aa-banner-area">
            <a href="#"><img src="{{ asset('front_assets/img/fashion-banner.jpg') }}" alt="fashion banner img"></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- popular section -->
  <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
              <!-- start prduct navigation -->
             <ul class="nav nav-tabs aa-products-tab">
                <li class="active"><a href="#featured" data-toggle="tab">Featured</a></li>
                <li><a href="#trendnig" data-toggle="tab">Trending</a></li>
                <li><a href="#discounted" data-toggle="tab">Discounted</a></li>                    
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Start men trendnig category -->
                <div class="tab-pane fade in active" id="featured">
                  <ul class="aa-product-catg aa-popular-slider">
                    <!-- start single product item -->
                    @if (isset($featured[0]))
                    @foreach ($featured as $item)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="#"><img src="{{ asset('images/'.$item->image) }}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{ $home_products_featured[$item->id][0]->prid }}','{{ $home_products_featured[$item->id][0]->title }}','{{ $home_products_featured[$item->id][0]->colour }}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption>
                          <h4 class="aa-product-title"><a href="#"> {{ $item->name }}</a></h4>
                          <span class="aa-product-price">${{ $home_products_featured[$item->id][0]->price }}</span><span class="aa-product-price"><del>${{ $home_products_featured[$item->id][0]->mrp }}</del></span>
                        </figcaption>
                      </figure>                     
                    </li>
                    @endforeach 
                    @else
                          <li>
                            <figure>
                              <p class="text-muted text-center my-5">There is no Featured products</p>
                            </figure>
                          <li>                                          
                     @endif                                                                           
                  </ul>
                  
                </div>
                <!-- / popular product category -->
                
                <!-- start trendnig product category -->
                <div class="tab-pane fade" id="discounted">
                 <ul class="aa-product-catg aa-featured-slider">
                    <!-- start single product item -->
                    @if (isset($discount[0]))         
                    @foreach ($discount as $item)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="#"><img src="{{ asset('images/'.$item->image) }}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="#" onclick="home_add_to_cart('{{ $home_products_discount[$item->id][0]->prid }}','{{ $home_products_discount[$item->id][0]->title }}','{{ $home_products_discount[$item->id][0]->colour }}')"><span class="fa fa-shopping-cart" ></span>Add To Cart</a>
                         <figcaption>
                          <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                          <span class="aa-product-price">${{ $home_products_discount[$item->id][0]->price }}</span><span class="aa-product-price"><del>${{ $home_products_discount[$item->id][0]->price }}</del></span>
                        </figcaption>
                      </figure>                     
                    </li>
                    @endforeach
                    @else
                    <li>
                      <figure>
                        <p class="text-muted text-center my-5">There is no products in discount</p>
                      </figure>
                    <li>                                          
                    @endif  
                     <!-- start single product item -->
                                                                                                      
                  </ul>
                  <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / featured product category -->

                <!-- start discounted product category -->
                <div class="tab-pane fade" id="trendnig">
                  <ul class="aa-product-catg aa-latest-slider">
                    <!-- start single product item -->
                    @if (isset($trend[0]))
                        
                  
                    @foreach ($trend as $item)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="#"><img src="{{ asset('images/'.$item->image) }}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="#" onclick="home_add_to_cart('{{ $home_products_trend[$item->id][0]->prid }}','{{ $home_products_trend[$item->id][0]->title }}','{{ $home_products_trend[$item->id][0]->colour }}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption> 
                          <h4 class="aa-product-title"><a href="#">{{ $item->name }}</a></h4>
                          <span class="aa-product-price">$ {{ $home_products_trend[$item->id][0]->price }}</span><span class="aa-product-price"><del>${{ $home_products_trend[$item->id][0]->mrp }}</del></span>
                        </figcaption>
                      </figure>                     
                    </li>
                    @endforeach

                    @else
                    <li>
                      <figure>
                        <p class="text-muted text-center my-5">There is no products in trend</p>
                      </figure>
                    <li>                                          
                     @endif  
                     <!-- start single product item -->                                                                                   
                  </ul>
                   <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / latest product category -->              
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>
  <!-- / popular section -->
  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <form action="" id="frmAddtocart">
      <input type="text" name="sizeid" id="sizeid">
      <input type="text" name="colorid" id="colorid">
      <input type="text" name="productqty" value="1" id="qty">
      <input type="text" name="product_id"  id="product_id">
      @csrf
    </form>
  </section>
 

  <!-- Client Brand -->
  <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
              @foreach ($brands as $item)
                <li><a href="#"><img src="{{ asset('images/'.$item->image) }}" alt="{{ $item->image }}"></a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
    
@endsection