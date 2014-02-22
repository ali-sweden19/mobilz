<?php
/* @var $this CartController */
/* @var $model Cart */

$this->breadcrumbs=array(
	'Carts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Cart', 'url'=>array('index')),
	array('label'=>'Create Cart', 'url'=>array('create')),
);

?>

<!-- Items list
========================================== -->
<div class="container">
    <!-- Custom thumbnail -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Cart</h3>
            <div class="hidden-xs">
               <hr /> 
            </div>
            
        </div>
    </div>
    
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'cart-form',
        'type'=>'vertical',
        'method'=>'post',
    )); ?>    
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
            <?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
                'id'=>'cart-grid',
                'dataProvider'=>$dataProvider,
                'type'=>'striped bordered',
                'columns'=>array(
                    array(
                        'header'=>'',
                        'value'=>'$data->getThumbImgPath()',
                        'type'=>'raw',
                    ),
                    array(
                        'name'=>'product_id',
                        'value'=>'$data->product->name',
                    ),
                    array(
                        'header'=>'Price',
                        'value'=>'$data->product->price',
                    ),
                    array(
                        'name'=>'quantity',
                        'type'=>'raw',
                        'value'=>'CHtml::textField("quantity[$data->id]",$data->quantity,array("style"=>"width:50px;"))',
                        'footer'=>'<strong>Total Price</strong>',
                    ),
                    array(
                        'header'=>'Total',
                        'value'=>'$data->getTotalPrice()',
                        'class'=>'bootstrap.widgets.TbTotalSumColumn',
                    ),
                    array(
                        'header' => Yii::t('ses', 'Remove'),
                        'class' => 'bootstrap.widgets.TbButtonColumn',
                        'deleteButtonUrl' => 'Yii::app()->createUrl("cart/delete/", array("id"=>$data->id))',
                        "template"=>"{delete}",
                    ),
                ),
            )); ?>

            <div class="pull-right">
                <button type="submit" class="btn btn-primary">Update</button>
                <?php if(Yii::app()->user->isGuest) { ?>
                    <button id="proceed-to-checkout" type="button" class="btn btn-success">Proceed to checkout</button>
                <?php } else { ?>
                    <a href="<?php echo $this->createUrl('cart/checkout') ;?>"  class="btn btn-success">Proceed to checkout</a>
                <?php }?>
            </div>
            <div class="pull-left">
                <a href="<?php echo $this->createUrl('product/index') ;?>" class="btn btn-info">Continue shopping</a>
            </div>
        </div>
        
    </div>
    <?php $this->endWidget(); ?>    
</div> <!-- container -->


<br /><br /><br /><br />

<?php 
    Yii::app()->clientScript->registerScript('show-loginbox', "
    $('#proceed-to-checkout').live('click',function(){
        $('#login-modal').click();
        return false;
    });

    ");
?>