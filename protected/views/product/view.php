<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

<!-- Item details
========================================== -->
<div class="container">
    <!-- Custom thumbnail -->
    <div class="row">
        <div class="col-md-12">
            <h3>Details of <?php echo $model->name; ?></h3>
            <hr />
        </div>
    </div>

    <div class="row">
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$model->search(),
            'itemView'=>'_view',
            'summaryText'=>false,
        )); ?>
    </div>

</div>

