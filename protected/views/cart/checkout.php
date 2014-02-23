      
<!-- Credit card details
========================================== -->
<div class="container">
    <!-- Custom thumbnail -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Credit card details</h3>
            <div class="hidden-xs">
               <hr /> 
            </div>
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php 
                // Render them all with single `TbAlert`
                $this->widget('bootstrap.widgets.TbAlert', array(
                    'block' => true,
                    'fade' => true,
                    'closeText' => '&times;', // false equals no close link
                    'events' => array(),
                    'htmlOptions' => array(),
                    'userComponentId' => 'user',
                    'alerts' => array( // configurations per alert type
                        // success, info, warning, error or danger
                        'success' => array('closeText' => '&times;'),
                        'info', // you don't need to specify full config
                        'warning' => array('block' => false, 'closeText' => false),
                        'error' => array('block' => false, 'closeText' => 'x')
                    ),
                ));
            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            
            <form class="form-horizontal" autocomplete="off" id="payment-form" action="<?php echo $this->createUrl('cart/request'); ?>" method="POST">

                <div id="payment-form-cc" class="payment-input">
                  <input class="card-amount" type="hidden" value="<?php echo $amount ;?>"/>
                  <input class="card-currency" type="hidden" value="USD"/>
                  <div class="form-group">
                      <label  class="col-xs-3 col-sm-2 control-label">Amount($)</label>
                      <label style="text-align: left;" class="col-xs-3 col-sm-2 control-label"><?php echo $amount ;?></label>
                  </div>
                  <div class="form-group">
                      <label for="card-number" class="col-xs-3 col-sm-2 control-label">Card number</label>
                      <div class="col-xs-9 col-sm-6 col-md-4">
                        <input name="card-number" class="card-number form-control" type="text" size="20" value="4111111111111111"/>
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="card-number" class="col-xs-3 col-sm-2 control-label">CVC</label>
                    <div class="col-xs-9 col-sm-6 col-md-4">
                        <input class="card-cvc form-inline" type="text" size="4" value="111"/>
                    </div>
                  </div>
                  
                  <div class="form-group">
                      <label for="card-number" class="col-xs-3 col-sm-2 control-label">Card holder</label>
                      <div class="col-xs-9 col-sm-6 col-md-4">
                        <input class="card-holdername form-control" type="text" size="20" value="Max Mustermann"/>
                      </div>
                  </div> 
                  
                  
                  <div class="form-group">
                      <label for="card-number" class="col-xs-3 col-sm-2 control-label">Valid until (MM/YYYY)</label>
                      <div class="col-xs-9 col-sm-6 col-md-4">
                        <input class="card-expiry-month  form-inline" type="text" size="2" value="12"/>
                        <input class="card-expiry-year form-inline" type="text" size="4" value="2015"/>
                      </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-xs-offset-3 col-xs-9 col-sm-offset-2 col-sm-6 col-md-4">
                    <?php  if(! ($amount <=0)) { ?>
                    <button class="btn btn-large btn-success " type="submit">Pay now</button>
                    <?php } ?>
                  </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

<br /><br /><br />














<script src="https://bridge.paymill.com/"></script>
  <script language="javascript" type="text/javascript">
      $(document).ready(function () {
          function PaymillResponseHandler(error, result) {
              if (error) {
                  // Show the error message above the form
                  $(".payment-errors").text(error.apierror);
              } else {
                  $(".payment-errors").text("");
                  var form = $("#payment-form");
                  // Token
                  var token = result.token;
                  // Insert token into the payment form
                  form.append("<input type='hidden' name='paymillToken' value='" + token + "'/>");
                  form.get(0).submit();
              }
              $(".submit-button").removeAttr("disabled");
          }
 
          $("#payment-form").submit(function (event) {
              // Deactivate the submit button to avoid further clicks
              $('.submit-button').attr("disabled", "disabled");
              if (false == paymill.validateCardNumber($('.card-number').val())) {
                  $(".payment-errors").text("Invalid card number");
                  $(".submit-button").removeAttr("disabled");
                  return false;
              }
 
              if (false == paymill.validateExpiry($('.card-expiry-month').val(), $('.card-expiry-year').val())) {
                  $(".payment-errors").text("Invalid date of expiry");
                  $(".submit-button").removeAttr("disabled");
                  return false;
              }
 
              var method = 'cc';
                if (jQuery('#btn-paymenttype-elv').hasClass('btn-primary')) method = 'elv';
                if (jQuery('#btn-paymenttype-iban').hasClass('btn-primary')) method = 'iban/bic';
 
                switch (method) {
                    case "cc":
                        var params = {
                            amount:         $('.card-amount').val(),
                            currency:       $('.card-currency').val(),
                            number:         $('.card-number').val(),
                            exp_month:      $('.card-expiry-month').val(),
                            exp_year:       $('.card-expiry-year').val(),
                            cvc:            $('.card-cvc').val(),
                            cardholdername: $('.card-holdername').val()
                        };
                        break;
 
                    case "elv":
                        var params = {
                            number:         $('.elv-account').val(),
                            bank:           $('.elv-bankcode').val(),
                            accountholder:  $('.elv-holdername').val()
                        };
                        break;
 
                    case "iban/bic":
                        var params = {
                            iban:           $('.iban').val(),
                            bic:            $('.bic').val(),
                            accountholder:  $('.ibanbic-holdername').val()
                        };
                        break;
              }
              paymill.createToken(params, PaymillResponseHandler);
 
              return false;
          });
 
          // Toggle buttons and forms
         $(".paymenttype").click(function() {
            if (jQuery(this).hasClass('btn-primary')) return;
 
            jQuery('.paymenttype').removeClass('btn-primary');
            jQuery(this).addClass('btn-primary');
            var index = jQuery('.paymenttype').index(this);
 
            jQuery('.payment-input').hide();
            jQuery('.payment-input').eq(index).show();
        });
      });
  </script>