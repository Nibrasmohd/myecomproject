/** 
  * Template Name: Daily Shop
  * Version: 1.0  
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS
  

  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER 
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER) 
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER) 
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER 
  13. RELATED ITEM SLIDER (SLICK SLIDER)

  
**/

jQuery(function($){

  
  /* ----------------------------------------------------------- */
  /*  1. CARTBOX 
  /* ----------------------------------------------------------- */
    
     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );   
  
  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */    
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER 
  /* ----------------------------------------------------------- */    

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
        loading_image: 'demo/images/loading.gif'
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-popular-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 

  
  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });
    
  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */     
    
    jQuery('.aa-testimonial-slider').slick({
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */  

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */        

    jQuery(function(){
      if($('body').is('.productPage')){
       var skipSlider = document.getElementById('skipstep');
       var pricestart = $('#pricestartid').val();
       var priceend = $('#priceendid').val();
       if( pricestart == '' || priceend == ''){
           pricestart = 100;
           priceend = 1700;
       }
        noUiSlider.create(skipSlider, {
            range: {
                'min': 0,
                '10%': 100,
                '20%': 300,
                '30%': 500,
                '40%': 700,
                '50%': 900,
                '60%': 1100,
                '70%': 1300,
                '80%': 1500,
                '90%': 1700,
                'max': 1900
            },
            snap: true,
            connect: true,
            start: [pricestart, priceend]
        });
        // for value print
        var skipValues = [
          document.getElementById('skip-value-lower'),
          document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function( values, handle ) {
          skipValues[handle].innerHTML = values[handle];
        });
      }
    });


    
  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });
     
    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });
  
  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded      
      jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out      
    })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER 
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 
    
});



function change_product_colourandsize_image(img,color){
    $('img.simpleLens-big-image').attr('src',`http://127.0.0.1:8000/images/${img}`)
    $('a.simpleLens-lens-image').attr('data-lens-image',`http://127.0.0.1:8000/images/${img}`) 

    $('#colorid').val(color)
} 

function selectSize(size) {
  
  $('.allcolours').hide();
  $(`.color_${size}`).show();

  $('.allsizes').css("border","none");
  $(`.size_${size}`).css("border", "1px solid black");

  $('#sizeid').val(size)

}


addquant=()=>{
  $('#productqty').val($('#productqties').val());
}

add_to_cart=(color_ids,size_ids)=>{
  data=$('#frmAddtocart').serialize();
  console.log(data);
   size=$('#sizeid').val()
   color=$('#colorid').val()
   console.log(color_ids,size_ids);
   var htmls='';
   if(size == '' && size_ids != 0 ){
     htmls='<div style="margin-top:10px;" class="alert alert-danger fade in alert-dismissible">please select size <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">X</a> </div>'
   }else if(color == '' && color_ids != 0){
    htmls='<div style="margin-top:10px;" class="alert alert-danger fade in alert-dismissible">please select colour <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">X</a> </div>'
    console.log('color not selected');
   }else{
    $.ajax({
      url: '/addtocart',
      data: $('#frmAddtocart').serialize(),
      type: "post",
      dataType: "json",
      success: function(res){
           console.log(res.msg);
           if(res.cartqaunt == 0 ){
              $('.aa-cart-notify').html(0)
              $('.aa-cartbox-summary').remove();
           }else{
              var totalprice=0;
              $('.aa-cart-notify').html(res.cartqaunt)
              $('.aa-cartbox-summary').remove();
              var html='<div class="aa-cartbox-summary"><ul>'
              $.each(res.data, function(key,val){
                console.log(val);
                  totalprice=totalprice + (val.quantity*val.price)
                  html+=`<li id="cart_box${val.attr_id}">
                  <a class="aa-cartbox-img" href="product/${val.slug}">
                      <img src="${PRODUCTIMAGE}/${val.image}" alt="${val.image}"></a>
                  <div class="aa-cartbox-info">
                    <h4><a href="#">${val.name}</a></h4>
                    <p>${val.quantity} x $ ${val.price }</p>
                  </div>         
                  <a class="aa-remove-product" onclick="delete_cart('${val.attr_id}','${ val.cartid }')" href="#"><span class="fa fa-times"></span></a>
                </li>  `
              });
              html+=`<li>
                      <span class="aa-cartbox-total-title">
                        Total
                      </span>
                      <span class="aa-cartbox-total-price">$ ${totalprice}</span>
                    </li>
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="checkout.html">Checkout</a>
                </div>`
               
               $('#cattbox').after(html) 
           }
      }
    });   
   }
   $('#addcartmessge').html(htmls)
   

}

function home_add_to_cart(proid,sizeid,colorid){
   
  console.log(sizeid);
  console.log(colorid);
  $('#product_id').val(proid);
  $('#sizeid').val(sizeid)
  $('#colorid').val(colorid)
  add_to_cart(colorid,sizeid)

}

updateQty=(proid,size,color,proattrid,price)=>{
  $('#product_id').val(proid);
  $('#sizeid').val(size)
  $('#colorid').val(color)
  qty=$(`#qty${proattrid}`).val();
  console.log(qty);
  $('#productqty').val(qty)
  $('#tot'+proattrid).html("Rs "+price*qty);
  add_to_cart(colorid,sizeid)
}

delete_cart=(pttrid,cartid)=>{
   console.log(pttrid,cartid);
   $('#cart_box'+pttrid).remove();
   $.ajax({
    url: '/deletecart',
    data: {
      cartids : cartid
    },
    type: "get",
    dataType: "json",
    success: function(res){
          console.log(res.msg);
          if(res.cartqaunt == 0 ){
            $('.aa-cart-notify').html(0)
            $('.aa-cartbox-summary').remove();
          }else{
            $('.aa-cart-notify').html(res.cartqaunt)
            var totalprice=0;
             $.each(res.data, function(key,val){
                totalprice=totalprice + (val.quantity*val.price)
             })
             $('.aa-cartbox-total-price').html(totalprice);    
          }
    }
  });  
}

sort_by=()=>{
  sortval=$('#sort_by_value').val();
  $('#sort').val(sortval)
  $('#catogoryfilter').submit();  
}

sort_price_filter=()=>{
  var lover=$('#skip-value-lower').html();
  var upper=$('#skip-value-upper').html();
  $('#pricestartid').val(lover)
  $('#priceendid').val(upper)
  $('#catogoryfilter').submit(); 
}

setColour=(col,type)=>{
  colours = $('#setcolorid').val();
    if(type == 1){
      if(colours.length == 1 ){
        var new_color = '';
      }else{
        var new_color = colours.replace(':'+col,'');
      }
       $('#setcolorid').val(new_color)
    }else{
      $('#setcolorid').val(colours+':'+col)
    }
  

  $('#catogoryfilter').submit(); 
}

funsearch=()=>{
  
  var str=$('#search_str').val();
  
  if(str != ''){
    window.location.href='/search/'+str;
  }
}

$('#fromregistration').submit(function(e){
  e.preventDefault();
  $('.field_error').val('');

  $.ajax({
    url: 'registration_process',
    data: $('#fromregistration').serialize(),
    type: "post",
    success: function(res){
       console.log(res.status);
       if(res.status == 'error'){
         $.each(res.error,function(key,val){
            $(`#${key}_error`).html(val[0]);
         })
       }  
       if(res.status == 'success'){
          $('#fromregistration')[0].reset();
          $('#thank_you_msg').html(res.msg)
       }  
       if(res.status == 'not sussess'){
          $('#fromregistration').reset();
          $('#thank_you_msg').html(res.msg)
       }  
    },
  }); 
})

$('#frmlogin').submit(function(e){
  e.preventDefault();
  $('#login_msg').html('');
  $.ajax({
    url: 'login_process',
    data: $('#frmlogin').serialize(),
    type: "post",
    success: function(res){
       console.log(res.status);
       if(res.status == 'error'){
          $('#login_msg').html(res.msg)
       }  
       if(res.status == 'success'){
            window.location.href='/'
       }  
    }
  }); 
})

