      
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
            
            
            <form id="payment-form" action="<?php echo $this->createUrl('cart/request'); ?>" method="POST">
                <div class="clearfix"></div>

                <div id="payment-form-cc" class="payment-input">
                  <input class="card-amount" type="hidden" value="40"/>
                  <input class="card-currency" type="hidden" value="EUR"/>
                  <div class="controls controls-row">
                    <div class="span3"><label>Card number</label>
                        <input class="card-number span3" type="text" size="20" value="4111111111111111"/>
                    </div>
                    <div class="span1"><label>CVC</label>
                        <input class="card-cvc span1" type="text" size="4" value="111"/>
                    </div>
                  </div>
                  <div class="controls">
                    <div class="span4">
                      <label>Card holder</label>
                      <input class="card-holdername span4" type="text" size="20" value="Max Mustermann"/>
                    </div>
                  </div>
                  <div class="controls">
                    <div class="span3">
                      <label>Valid until (MM/YYYY)</label>
                      <input class="card-expiry-month span1" type="text" size="2" value="12"/>
                      <span> / </span>
                      <input class="card-expiry-year span1" type="text" size="4" value="2015"/>
                    </div>
                  </div>
                </div>

                <div id="payment-form-elv" class="payment-input" style="display: none;">
                  <div class="controls">
                    <div class="span3">
                      <label>Account holder</label>
                      <input class="elv-holdername span3" type="text" size="20" value="Max Mustermann"/>
                    </div>
                  </div>
                  <div class="controls controls-row">
                    <div class="span3"><label>Account number</label>
                        <input class="elv-account span3" type="text" size="20" value="1234567890"/>
                    </div>
                  </div>
                  <div class="controls">
                    <div class="span3">
                      <label>Bank code</label>
                      <input class="elv-bankcode span3" type="text" size="20" value="40050150"/>
                    </div>
                  </div>
                </div>

                <div id="payment-form-iban" class="payment-input" style="display: none;">
                  <div class="controls">
                    <div class="span3">
                      <label translate="iframe">Kontoinhaber</label>
                      <input class="ibanbic-holdername span3" type="text" size="20" value="Max Mustermann"/>
                    </div>
                  </div>
                  <div class="controls controls-row">
                    <div class="span3"><label translate="iframe">IBAN</label>
                        <input class="iban span3" type="text" size="27" value="DE12 3456 7890 1234 5678 90"/>
                    </div>
                  </div>
                  <div class="controls">
                    <div class="span3">
                      <label translate="iframe">BIC</label>
                      <input class="bic span3" type="text" size="20" value="MARKDEF1100"/>
                    </div>
                  </div>
                </div>

                <div class="controls">
                  <div class="span3">
                    <button class="submit-button btn btn-primary" type="submit">Buy now</button>
                  </div>
                </div>
            </form>
            
        </div>
    </div>
</div>














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