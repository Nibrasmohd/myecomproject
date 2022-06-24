@extends('front.layout')
@section('pagetitle','category page');
@section('wrapper')

<section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="" onchange="sort_by()" id="sort_by_value">
                    <option value="1" selected="Default">Default</option>
                    <option value="name">Name</option>
                    <option value="price-desc">Price - DESC</option>
                    <option value="price-asc">Price - ASC</option>
                    <option value="date">Date</option>
                  </select>
                </form>
                {{ $sort_text }}
                {{-- <form action="" class="aa-show-form">
                  <label for="">Show</label>
                  <select name="">
                    <option value="1" selected="12">12</option>
                    <option value="2">24</option>
                    <option value="3">36</option>
                  </select>
                </form> --}}
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
                @if (isset($catogoryproducts[0]))
                        
                  
                    @foreach ($catogoryproducts as $item)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="{{ url('product/'.$item->slug) }}"><img src="{{ asset('images/'.$item->image) }}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="#" onclick="home_add_to_cart('{{ $catogoryproducts_attribute[$item->pid][0]->prid }}','{{ $catogoryproducts_attribute[$item->pid][0]->title }}','{{ $catogoryproducts_attribute[$item->pid][0]->colour }}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption> 
                          <h4 class="aa-product-title"><a href="#">{{ $item->name }}</a></h4>
                          <span class="aa-product-price">$ {{ $catogoryproducts_attribute[$item->pid][0]->price }}</span><span class="aa-product-price"><del>${{ $catogoryproducts_attribute[$item->pid][0]->mrp }}</del></span>
                        </figcaption>
                      </figure>                     
                    </li>
                    @endforeach

                    @else
                    <li>
                      <figure>
                        <p class="text-muted text-center my-5">There is no products in this catogory</p>
                      </figure>
                    <li>                                          
                     @endif                                           
              </ul>
                
            </div>
            <div class="aa-product-catg-pagination">
              <nav>
                <ul class="pagination">
                  <li>
                    <a href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li>
                    <a href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <ul class="aa-catg-nav">
                  @foreach ($catogories as $item)
                  @if ( $item->catogory_slug == $slug)
                   <li><a class="left_cat_active" href="{{ url('category/'.$item->catogory_slug) }}">{{ $item->catogory_name }}</a></li>
                  @else
                  <li><a  href="{{ url('category/'.$item->catogory_slug) }}">{{ $item->catogory_name }}</a></li>
                  @endif
                  @endforeach
              </ul>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Tags</h3>
              <div class="tag-cloud">
                <a href="#">Fashion</a>
                <a href="#">Ecommerce</a>
                <a href="#">Shop</a>
                <a href="#">Hand Bag</a>
                <a href="#">Laptop</a>
                <a href="#">Head Phone</a>
                <a href="#">Pen Drive</a>
              </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>              
              <!-- price range -->
              <div class="aa-sidebar-price-range">
               <form action="">
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val">{{ $pricestart  }}</span>
                 <span id="skip-value-upper" class="example-val">{{ $priceend  }}</span>
                 <button onclick="sort_price_filter()" class="aa-filter-btn" type="button">Filter</button>
               </form>
              </div>              

            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">
                 @foreach ($colour as $col)
                   @php
                       $colarr=[];
                       if(isset($sortcolour[0])){
                         $colarr = explode(':',$sortcolour);
                       }
                   @endphp
                   @if (in_array($col->id,$colarr))
                     <a class="aa-color-{{ $col->colour }} active-color" onclick="setColour('{{ $col->id }}','1')" href="javascript:void(0);"></a>    
                   @else
                     <a class="aa-color-{{ $col->colour }}" onclick="setColour('{{ $col->id }}','0')" href="javascript:void(0);"></a>
                   @endif
                 @endforeach
              </div>                            
            </div>
       
          </aside>
        </div>
       
      </div>
    </div>
  </section>

    

<form action="" id="catogoryfilter">
    <input  type="text" hidden name="sort" id="sort" value="{{ $sort }}">
    <input  type="text" hidden name="pricestart" id="pricestartid" value="{{ $pricestart }}">
    <input  type="text" hidden name="priceend" id="priceendid" value="{{ $priceend }}">
    <input  type="text" hidden name="setcolor" id="setcolorid" value="{{ $sortcolour }}">
</form>
@endsection