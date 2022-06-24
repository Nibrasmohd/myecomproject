@extends('front.layout')
@section('pagetitle','registration page');
@section('wrapper')

<meta name="csrf-token" content="{{ csrf_token() }}">

<section id="aa-myaccount">
 <div class="container">
   <div class="row">
     <div class="col-md-6">
      <div class="aa-myaccount-area">         
          <div class="row">
            <div class="col-md-10">
              <div class="aa-myaccount-register">                 
               <h4>Register</h4>
               <form action="" method="POST" class="aa-login-form" id="fromregistration">
                  @csrf
                  <label for="">Name<span>*</span></label>
                  <input type="text" name="name" placeholder="Name" required>
                  <div id="name_error" class="field_error"></div>

                  <label for="">Email<span>*</span></label>
                  <input type="email" name="email" placeholder="Email" required>
                  <div id="email_error" class="field_error"></div>

                  <label for="">Password<span>*</span></label>
                  <input type="password" placeholder="Password" name="password">
                  <div id="Password_error" class="field_error"></div>               

                  <label for="">Mobile<span>*</span></label>
                  <input type="text" placeholder="mobile" name="mobile">
                  <div id="mobile_error" class="field_error"></div>

                  <button type="submit" id="btnregistration" class="aa-browse-btn">Register</button> 
                                
                </form>
              </div>
              <div id="thank_you_msg" class="field_error">
                 
              </div>
            </div>
          </div>          
       </div>
     </div>
   </div>
 </div>
</section>


@endsection
