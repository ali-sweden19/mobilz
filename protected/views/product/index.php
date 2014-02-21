<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Products',
);

$this->menu=array(
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

<!-- Items list
========================================== -->
<div class="container">
    <!-- Custom thumbnail -->
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-9">
                <h3>Items available</h3>
            </div>
            <div class="col-md-3">
                <div class="shopping-cart"><span id="shopping-cart">Items (0)</span> <button class="btn btn-sm btn-success">Checkout</button> </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr />
        </div>
    </div>
    
    <div class="row">
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
        )); ?>
    </div>

</div>

<!-- Add Ajax call for adding product to cart 
=================================================== -->
<?php 
    $url = Yii::app()->createUrl('cart/add');
    Yii::app()->clientScript->registerScript('add-product', "
        $('.add-to-cart').live('click',function(){
            var id=$(this).attr('id');
            var but= this;
            $.ajax({
                type: 'POST',
                url: '$url',
                dataType: 'json',
                data: {'id':id},
                timeout:19200,
                error: function(request, error) {
                    if(error=='timeout') {
                        alert('The request timed out, please resubmit');
                    }
                    $('#login-modal').click();
                },
                success: function(response) {
                    if(response['status']=='ok') {
                        $(but).replaceWith(response['link']);
                        $('#shopping-cart').html(response['items']);
                    }
                }
            });
            return false;
        });
	");
?>
