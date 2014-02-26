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
        <div class="col-md-8 col-md-offset-2">
            <?php if(Yii::app()->user->hasFlash('success')): ?>

            <div class="alert alert-block alert-success">
                <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
            <div class="bs-callout bs-callout-info">
            <h4>Checkout completed.</h4>
            <p>Your purchase was successful, We received your order.</p><p>Thanks for shopping with us. Please visit again.</p>    
            </div>
            <?php else: ?>
            <div class="alert alert-block alert-error">
                <?php echo Yii::app()->user->getFlash('error'); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    
</div>

<br /><br /><br /><br />