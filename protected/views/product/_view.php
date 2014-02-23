<?php
/* @var $this ProductController */
/* @var $data Product */
?>
<div class="col-md-3">
    <div class="thumbnail">
        <a href="#">
            <img class="img-responsive" src="<?php echo $this->imagesFolder . CHtml::encode($data->image_file); ?>" />
        </a>
        <div class="caption">
            <h3><?php echo CHtml::encode($data->name); ?></h3>
            <p>USD: <?php echo CHtml::encode($data->price); ?></p>
            <p>
                <a href="<?php echo $this->createUrl('product/view/', array('slug'=>CHtml::encode($data->slug))) ; ?>" class="btn btn-default">Details</a>
                <a href="#" id="<?php echo CHtml::encode($data->id);?>" class="btn btn-success add-to-cart">Buy</a>
            </p>
        </div>
    </div>
</div>
