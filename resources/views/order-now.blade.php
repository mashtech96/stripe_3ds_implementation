<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="author" content="Email Software">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Stripe 3DS </title>
        <link rel="icon" href="" type="image/gif" sizes="16x16">
        <link href="{{asset('assets/css/shape-animation.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/aos.css')}}" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;500;600&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/8612db66ee.js"></script>
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    </head>
   <body class="es-tool">
   <header>
      <div id="fixed-header" class="marketing-head">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="marketing-nav">
                     <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container-fluid p-0">
                           <a class="navbar-brand" href="#">
                              Stripe 3DS
                           </a>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>


<div class="price-section" style="position:relative">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="price_view">
               <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 price-plan">
                     <div class="price-holder text-center" data-aos="fade-up">
                        <div class="price-head">
                           <h4 class="plan-type">Basic Plan</h4>
                           <!-- <span class="plan-desc">Free</span> -->
                           <span style="display: none;" class="plan-price">30</span>
                           <h2>
                              <span>$30/month</span>
                           </h2>
                           <a href="#payment-order" class="join-now has-blue" data-price-id="put your price id here">JOIN NOW</a>
                        </div>
                     </div>
                  </div>
                  <!--  -->
                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 price-plan">
                     <div class="price-holder text-center" data-aos="fade-up">
                        <div class="price-head">
                           <h4 class="plan-type">Standard Plan</h4>
                           <!-- <span class="plan-desc">Yearly or Monthly Membership</span> -->
                           <span style="display: none;" class="plan-price">50</span>
                           <h2>
                              <span>$50/month</span>
                           </h2>
                           <a href="#payment-order" class="join-now has-green" data-price-id="put your price id here">JOIN NOW</a>
                        </div>
                     </div>
                  </div>
                  <!--  -->
                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 price-plan">
                     <div class="price-holder text-center" data-aos="fade-up">
                        <div class="price-head">
                           <h4 class="plan-type">Premium Plan</h4>
                           <!-- <span class="plan-desc">Lifetime Membership</span> -->
                           <span style="display: none;" class="plan-price">80</span>
                           <h2>
                              <span>$80/month</span>
                           </h2>
                           <a href="#payment-order" class="join-now has-red" data-price-id="put your price id here">JOIN NOW</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            
            <div style="display: none;" id="payment-order"   class="payment-details">
               <div class="summery-wrapper active">
                  <div class="inner">
                     <h4 class="order-sum">Your Order Summary</h4>
                     <div class="payment-top">
                        <div class="payment-plan">
                           <span class="pull-left value-plan-desc"></span>
                           <span class="pull-right value-plan-price"></span>
                        </div>
                        <div class="old-price-discount">
                           <div class="payment-plan pre-applied-discount"><span class="pull-left">Discount</span><span class="pull-right"><span class="red"></span></span></div>
                        </div>
                     </div>
                     <div class="payment-total  discount_applied"><span class="pull-left"> Total </span> <span class="pull-right" id="payment_total" data-total-price="47.76"></span></div>
                  </div>
               </div>
               <div class="payment-form">
                 
                     {{csrf_field()}}
                     <input type="hidden" name="plan_type" class="plan_type_hidden">
                     <input type="hidden" name="stripeToken" class="stripeToken">
                     <input type="hidden" name="plan_price_id" class="plan_price_id">
                     
                     
                     <div class="form-group">
                        <div class="cart-cred">
                           <div class="row cart-cred">
                              <div class="col-lg-6">
                                 <div class="email">
                                    <input required type="text" class="form-control customer_full_name" id="full_name" placeholder="Full name" name="full_name" autocomplete="off">
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="email">
                                    <input required id="input_email" type="email" class="form-control customer_email" placeholder="Email address" name="email" autocomplete="off">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="password">
                                    <input required type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Set password">
                                    <span class="password-eye-icon"></span>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="confirm_password">
                                    <input required type="password" class="form-control" name="confirm_password" id="confirm_password" autocomplete="off" placeholder="Confirm password">
                                    <span class="password-eye-icon"></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="card-holder">
                                 <input type="text" class="form-control" name="name" id="input_name" placeholder="Card holder name" autocomplete="off">
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="card-holder payment_stripe">
                                 <input type="hidden" name="token"  placeholder="Card holder Number" autocomplete="off"/>
                                 <div class="group">
                                    <label>
                                       <div id="card-element" class="field"></div>
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-12 error-div" style="display: none;">
                                 <p class="error-message" style="text-align: center; color: red;"></p>
                           </div>
                        </div>
                     </div>
                     <div class="payment-button" id="payment-button">
                        <button type="button" disabled="disabled" class="payment-btn col-sm-7">
                        <i class="fa fa-lock" aria-hidden="true"></i> <span>Pay Now <i style="display: none;" class="fa fa-spinner fa-spin"></i> </span>
                        </button>
                       
                     </div>
                   
                 
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<a href="#top" class="top-btn">
   <i class="fa fa-arrow-up" aria-hidden="true"></i>
</a>

<script src="{{asset('assets/js/poper.js')}}"></script>
<script src="{{asset('assets/js/boostrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/aos.js')}}"></script>
<script src="{{asset('assets/js/calendar.js')}}"></script>
<script src="{{asset('assets/js/highlight.min.js')}}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
   AOS.init({
      easing: 'ease-out-back',
      duration: 1000
   });
</script>
<script>
   $(".join-now").click(function() {

      var planType = $(this).parents('.price-head').children('.plan-type').text();
      var planPrice = $(this).parents('.price-head').children('.plan-price').text();
      // var planDesc   = $(this).parents('.price-head').children('.plan-desc').text();

      // $(".value-plan-desc").text(planDesc);
      $(".value-plan-price").text('$' + planPrice);
      $("#payment_total").text('$' + planPrice);
      $(".plan_type_hidden").val(planType)
      var priceId = $(this).data('price-id'); //getter
      $(".plan_price_id").val(priceId)


      $("#payment-order").show();

      $([document.documentElement, document.body]).animate({
         scrollTop: $("#payment-order").offset().top
      }, );
   });
   var stripe = Stripe('<?php echo env('STRIPE_KEY'); ?>');
   var elements = stripe.elements();

   var card = elements.create('card', {
      hidePostalCode: true,
      style: {
         base: {
            iconColor: '#666EE8',
            color: '#31325F',
            lineHeight: '40px',
            fontWeight: 300,
            fontFamily: 'Helvetica Neue',
            fontSize: '15px',

            '::placeholder': {
               color: '#CFD7E0',
            },
         },
      }
   });
   card.mount('#card-element');
   function setOutcome(result) {
      if (result.error) {
         $('.payment-btn').attr('disabled', 'disabled');
         $(".error-message").text('Please enter a valid card information!');
         $(".error-div").show();

      } else {
         $('.payment-btn').removeAttr('disabled');
         $(".error-message").text();
         $(".error-div").hide();
        
      }
   }

   card.on('change', function(event) {
      setOutcome(event);
   });

   $(".payment-btn").click(function(){
      var password         = $("#password").val();
      var confirmPassword  = $("#confirm_password").val();
      if(password !== confirmPassword){
         $(".error-message").text('Confirm password does not match!');
         $(".error-div").show();
         return false;
      }
      else{
         $(".error-message").text('');
         $(".error-div").hide();
      }
      $(".fa-spinner").show();
   
      let customer_name = $(".customer_full_name").val();
      var customer_email= $(".customer_email").val();
      let plan_price_id = $(".plan_price_id").val();
      var planPrice =  $(".value-plan-price").text();
      planPrice = planPrice.replace('$', '');
      var planType = $(".plan_type_hidden").val();

      // Post the subscription info to the server-side script
      $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
     

      $.ajax({
         type: 'POST',
         url: '/payment-init',
         data: {request_type:'create_customer_subscription',name:customer_name, email:customer_email, plan_price_id:plan_price_id, password:password, planPrice:planPrice, planType:planType},
         success: function(data) {
           
            if (data.subscriptionId && data.clientSecret) {
              
               let customer_name    = $(".customer_full_name").val();
               var subscriptionId   = data.subscriptionId;
               var clientSecret     = data.clientSecret;
               var customerId       = data.customerId;
               //for 3d secure process
               stripe.confirmCardPayment(clientSecret, {
                  payment_method: {
                     card: card,
                     billing_details: {
                        name: customer_name,
                     },
                  }
               }).then((result) => {
                  if (result.error) {
                     //3d secure failed
                     $(".fa-spinner").hide();
                     $(".error-message").text('Error processing payment!');
                     $(".error-div").show();
                     
                  } else {
                     $(".error-div").hide();
                     // Successful subscription payment
                     // Post the transaction info to the server-side script and redirect to the payment status page
                     $.ajax({
                        type: 'POST',
                        url: '/payment-init',
                        data: {request_type:'payment_insert', subscription_id:subscriptionId, customer_id:customerId, payment_intent:result.paymentIntent, customer_email:customer_email},
                        success: function(data) {
                           if (data.id) {
                              alert('Awesome! Payment added succesfully!')
                           } else {
                              $(".fa-spinner").hide();
                              $(".error-message").text('Error completing payment!');
                              $(".error-div").show();
                              
                           }

                        }
                     });

                  }
               });
            } else {
               $(".fa-spinner").hide();
               $(".error-message").text('Error creating customer or subscription!');
               $(".error-div").show();
            }

         }
      });
      

   });


  
</script>

</body>

</html>