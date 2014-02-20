<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<?php $imagesFolder= Yii::app()->request->baseUrl .'/images/'; ?>

<!-- Header Box -->
<div class="container">
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="header-box">
                <div class="col-md-4">
                    <div style="float: left">
                        <a href="#"><img width="45" height="45" alt="Buy" src="<?php echo $imagesFolder.'manual.png'; ?>"></a>
                    </div>
                    <div class="spaceLeft10" style="float: left">
                        <a href="#">Buy</a><br><span class="small">Select items to buy</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div style="float: left">
                        <a href="#"><img width="45" height="45" alt="Pay" src="<?php echo $imagesFolder.'tour.png'; ?>"></a>
                    </div>
                    <div class="spaceLeft10" style="float: left">
                        <a href="#">Pay</a><br><span class="small">You can pay via any credit card</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div style="float: left">
                        <a href="#"><img width="40" height="40" alt="Contact" src="<?php echo $imagesFolder.'contact-icon.png'; ?>"></a>
                    </div>
                    <div class="spaceLeft10" style="float: left">
                        <a href="#">Contact Us</a><br><span class="small">support@domain.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div

<!-- Items list
    ========================================== -->
    <div class="container">
        <!-- Custom thumbnail -->
        <div class="row">
            <div class="col-md-12">
                <h3>Items available</h3>
                <hr />
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="thumbnail">
                    <a href="#">
                        <img class="img-responsive" src="<?php echo $imagesFolder.'iphone5.jpg'; ?>" />
                    </a>
                    <div class="caption">
                        <h3>This is heading</h3>
                        <p>This is some text.</p>
                        <p>
                            <a href="#" class="btn btn-success">Learn more</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="thumbnail">
                    <a href="#">
                        <img class="img-responsive" src="<?php echo $imagesFolder.'galaxys3.jpg'; ?>"  />
                    </a>
                    <div class="caption">
                        <h3>This is heading</h3>
                        <p>This is some text.</p>
                        <p>
                            <a href="#" class="btn btn-success">Learn more</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="thumbnail">
                    <a href="#">
                        <img class="img-responsive" src="<?php echo $imagesFolder.'sony-xperia-z1.jpg'; ?>"  />
                    </a>
                    <div class="caption">
                        <h3>This is heading</h3>
                        <p>This is some text.</p>
                        <p>
                            <a href="#" class="btn btn-success">Learn more</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="thumbnail">
                    <a href="#">
                        <img class="img-responsive" src="<?php echo $imagesFolder.'ascend-p6.jpg'; ?>"  />
                    </a>
                    <div class="caption">
                        <h3>This is heading</h3>
                        <p>This is some text.</p>
                        <p>
                            <a href="#" class="btn btn-success">Learn more</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

<!-- Payment method
====================================== -->
<div class="container">

   <div class="row">
        <div class="col-md-12">
            <div class="header-box" style="padding-top: 20px;">
                <div class="col-md-6">
                    <div class="credit-card">
                        <label class="payment-method visa"></label>
                    </div>

                    <div class="credit-card">
                        <label class="payment-method master-card"></label>
                    </div>

                    <div class="credit-card">
                        <label class="payment-method america-express"></label>
                    </div>

                    <div class="credit-card">
                        <label class="payment-method jcb"></label>
                    </div>

                    <div class="credit-card">
                        <label class="payment-method diners-club"></label>
                    </div>

                    <div class="credit-card">
                        <label class="payment-method discover"></label>
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="credit-card">
                        <label class="payment-method-banks seb"></label>
                    </div>
                    <div class="credit-card">
                        <label class="payment-method-banks swed"></label>
                    </div>
                    <div class="credit-card">
                        <label class="payment-method-banks handelsbanken"></label>
                    </div>
                    <div class="credit-card">
                        <label class="payment-method-banks nordea"></label>
                    </div>

              </div>
           </div>
        </div>
    </div>
</div>
