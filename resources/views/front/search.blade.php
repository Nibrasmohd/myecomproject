@extends('front.layout')
@section('pagetitle','search');
@section('wrapper')

<section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
                @if (isset($products[0]))        
                    @foreach ($products as $item)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="{{ url('product/'.$item->slug) }}"><img src="{{ asset('images/'.$item->image) }}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="#" onclick="home_add_to_cart('{{ $productsattr[$item->id][0]->prid }}','{{ $productsattr[$item->id][0]->title }}','{{ $productsattr[$item->id][0]->colour }}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption> 
                          <h4 class="aa-product-title"><a href="#">{{ $item->name }}</a></h4>
                          <span class="aa-product-price">$ {{ $productsattr[$item->id][0]->price }}</span><span class="aa-product-price"><del>${{ $productsattr[$item->id][0]->mrp }}</del></span>
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
         
          </div>
        </div>
        
       
      </div>
    </div>
  </section>


@endsection