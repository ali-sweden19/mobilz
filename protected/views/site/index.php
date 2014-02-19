<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<?php $imagesFolder= Yii::app()->request->baseUrl .'/images/'; ?>
<!-- Items list
    ========================================== -->
    <div class="container">
        <br /><br /><br />
        <div class="row">
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
            <div class="col-md-6">
                <h1> This is header 1 of the text. </h1>
                <p>This is another paragraph.This is another paragraph.This is another paragraph.This is another paragraph.</p>
            </div>
        </div>

        <!-- Custom thumbnail -->
        <div class="row">
            <div class="col-md-12">
                <h3>Custom thumbnail</h3>
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


