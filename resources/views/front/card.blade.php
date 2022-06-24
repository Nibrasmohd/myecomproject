@extends('front.layout')
@section('pagetitle','Product page');
@section('wrapper')

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <div class="aa-catg-head-banner-area">
      <div class="container">
    
      </div>
    </div>
   </section>
   <!-- / catg header banner section -->

    <!-- Cart view section -->
 <section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table">
              <form action="">
                  @if (isset($list[0]))
                      
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th></th>
                         <th></th>
                         <th>Product</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Total</th>
                       </tr>
                     </thead>
                     <tbody>
                         @foreach ($list as $item)
                         <tr id="cart_box{{ $item->attr_id }}">
                            <td><a class="remove" onclick="delete_cart('{{ $item->attr_id }}','{{ $item->cartid }}')" href="javascript:void(0)"><fa class="fa fa-close"></fa></a></td>
                            <td><a href="{{ url('product/'.$item->slug) }}">
                                @if ($item->image != '')
                                  <img src="{{ asset('images/'.$item->image) }}" alt="{{ $item->image }}"></a>
                                @endif
                            </td>
                            <td><a class="aa-cart-title" href="#">{{ $item->name }}</a> <br>
                            @if ($item->title != '')
                                Size : {{ $item->title }}
                            @endif
                            <br>
                            @if ($item->colour != '')
                                Size : {{ $item->colour }}
                            @endif
                            </td>
                            <td >Rs {{ $item->price }}</td>
                            <td><input class="aa-cart-quantity" id="qty{{ $item->attr_id }}" onchange="updateQty('{{ $item->pid }}','{{ $item->title }}','{{ $item->colour }}','{{ $item->attr_id }}','{{ $item->price }}')" type="number" value="{{ $item->quantity }}"></td>
                            <td id="tot{{ $item->attr_id }}">Rs {{ $item->price*$item->quantity }}</td>
                          </tr>
                          <tr>
                         @endforeach
                         <td colspan="6" class="aa-cart-view-bottom">
                           
                           <input class="aa-cart-view-btn" type="button" value="Checkout">
                         </td>
                       </tr>
                       </tbody>
                   </table>
                 </div>
                 @else
                   <h3>Data not fround</h3>
                 @endif
              </form>
              <!-- Cart Total view -->
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <form action="" id="catogoryfilter">
        <input type="text" name="sizeid" hidden id="sizeid">
        <input type="text" name="colorid"  hidden id="colorid">
        <input type="text" name="productqty" hidden value="1" id="productqty">
        <input hidden type="text" name="product_id" value="" id="product_id">
        @csrf
    </form>
  </section>
  <!-- / Cart view section -->


@endsection