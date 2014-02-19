<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
    <?php $imagesFolder= Yii::app()->request->baseUrl .'/images/'; ?>
    <!-- Carousel 
    ============================================= -->
    <div id="carousel-id" class="carousel slide" data-ride="carousel" data-interval="3000">
        <ol class="carousel-indicators">
            <li data-target="#carousel-id" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-id" data-slide-to="1"></li>
            <li data-target="#carousel-id" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item active">
                <img alt="image 1" src="<?php echo $imagesFolder.'img1.jpeg'; ?>" />
                <div class="container">
                    <div class="carousel-caption">
                        <h1>My Heading Text</h1>
                        <p>This text will appear on the slide</p>
                        <p><a href="#" class="btn btn-primary">Learn more</a></p>
                    </div>
                </div>
            </div>

            <div class="item">
                <img alt="image 1" src="<?php echo $imagesFolder.'img2.jpeg'; ?>" />
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

    <?php echo $content; ?>
    

<?php $this->endContent(); ?>
