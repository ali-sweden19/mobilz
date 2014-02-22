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
                <button type="button" class="btn btn-success">Proceed to checkout</button>
            </div>

        </div>
        
    </div>

</div> <!-- container -->


<br /><br /><br /><br />