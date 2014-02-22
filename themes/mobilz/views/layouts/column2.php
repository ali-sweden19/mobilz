<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
    <?php $imagesFolder= Yii::app()->request->baseUrl .'/images/'; ?>
    <!-- Carousel 
    ============================================= -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div id="carousel-id" class="carousel slide shadow-bot" data-ride="carousel" data-interval="3000">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-id" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-id" data-slide-to="1"></li>
                    <li data-target="#carousel-id" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img alt="image 1" src="<?php echo $imagesFolder.'mobiles_think_smart_2.jpg';?>" />
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>My Heading Text</h1>
                                <p>This text will appear on the slide</p>
                                <p><a href="#" class="btn btn-primary">Learn more</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <img alt="image 1" src="<?php echo $imagesFolder.'galaxy-banner.jpg'; ?>" />
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>My Heading Text</h1>
                                <p>This text will appear on the slide</p>
                                <p><a href="#" class="btn btn-primary">Learn more</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <img alt="image 1" src="<?php echo $imagesFolder.'img3.jpeg'; ?>" />
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>My Heading Text</h1>
                                <p>This text will appear on the slide</p>
                                <p><a href="#" class="btn btn-primary">Learn more</a></p>
                            </div>
                        </div>
                    </div>

                </div>

                <a href="#carousel-id" class="left carousel-control" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a href="#carousel-id" class="right carousel-control" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div> <!--carousel -->
            </div>
        </div>
    </div>
    
    <br />
    <!-- Header Box -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-box">
                    <div class="col-md-4">
                        <div class="col-md-2">
                            <a href="#"><img width="45" height="45" alt="Buy" src="<?php echo $imagesFolder.'manual.png'; ?>"></a>
                        </div>
                        <div class="col-md-10">
                            <a href="#">Buy</a><br><span class="small">Select items to buy</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="col-md-2">
                            <a href="#"><img width="45" height="45" alt="Pay" src="<?php echo $imagesFolder.'tour.png'; ?>"></a>
                        </div>
                        <div class="col-md-10">
                            <a href="#">Pay</a><br><span class="small">You can pay via any credit card</span>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="col-md-2">
                            <a href="#"><img width="45" height="45" alt="Contact" src="<?php echo $imagesFolder.'contact-icon.png'; ?>"></a>
                        </div>
                        <div class="col-md-10">
                            <a href="#">Contact Us</a><br><span class="small">support@domain.com</span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div
    
    <?php echo $content; ?>
    
    
    <!-- Payment method
    ====================================== -->
    <div class="container">

       <div class="row">
            <div class="col-md-12">
                <div class="header-box" style="padding-top: 20px;">
                    <div class="col-md-6">
                        <div class="credit-card col-md-2">
                            <label class="payment-method visa"></label>
                        </div>

                        <div class="credit-card col-md-2">
                            <label class="payment-method master-card"></label>
                        </div>

                        <div class="credit-card col-md-2">
                            <label class="payment-method america-express"></label>
                        </div>

                        <div class="credit-card col-md-2">
                            <label class="payment-method jcb"></label>
                        </div>

                        <div class="credit-card col-md-2">
                            <label class="payment-method diners-club"></label>
                        </div>

                        <div class="credit-card col-md-2">
                            <label class="payment-method discover"></label>
                        </div>

                    </div>
                    <div class="col-md-4 col-md-offset-2">

                        <div class="credit-card col-md-2">
                            <label class="payment-method-banks seb"></label>
                        </div>
                        <div class="credit-card col-md-2">
                            <label class="payment-method-banks swed"></label>
                        </div>
                        <div class="credit-card col-md-2">
                            <label class="payment-method-banks handelsbanken"></label>
                        </div>
                        <div class="credit-card col-md-2">
                            <label class="payment-method-banks nordea"></label>
                        </div>

                  </div>
               </div>
            </div>
        </div>
    </div>


<?php $this->endContent(); ?>
