<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<?php $this->endWidget(); ?>



<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>


<!-- Form 
        ======================================= -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Contact Form</h2>
                    <p>
                        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
                    </p>
                    <p class="note">Fields with <span class="required">*</span> are required.</p>
                    <?php echo $form->errorSummary($model); ?>
                    <hr />
                    <form class="form-horizontal" autocomplete="on">
                        <div class="form-group">
                            <label for="name" class="col-xs-3 col-sm-2 control-label">Name</label> 
                            <div class="col-xs-9 col-sm-6 col-md-4">
                                <input type="text" required autofocus name="name" class="form-control" placeholder="Enter Name ..."/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="col-xs-3 col-sm-2 control-label">Email</label> 
                            <div class="col-xs-9 col-sm-6 col-md-4">
                                <input type="email" name="email" class="form-control" placeholder="Enter Email ..."/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="col-xs-3 col-sm-2 control-label">Message</label> 
                            <div class="col-xs-9 col-sm-6 col-md-4">
                                <textarea rows="5" name="email" class="form-control" placeholder="Enter Message ..."></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="websites" class="col-xs-3 col-sm-2 control-label">Favourite websites</label>
                            <div class="col-xs-9 col-sm-6 col-md-4">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="option1" /> YouTube
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="option1" /> Twitter
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="gender" class="col-xs-3 col-sm-2 control-label">Gender</label>
                            <div class="col-xs-9 col-sm-6 col-md-4">
                                <label class="checkbox-inline">
                                    <input type="radio" required name="gender" value="option1" /> Male
                                </label>
                                <label class="checkbox-inline">
                                    <input type="radio" required name="gender"  value="option1" /> Female
                                </label>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label for="city" class="col-xs-3 col-sm-2 control-label">City</label> 
                            <div class="col-xs-9 col-sm-6 col-md-4">
                                <select class="form-control">
                                    <option>Stockholm</option>
                                    <option>Gothunberg</option>
                                    <option>Mälmo</option>
                                    <option>Linköping</option>
                                </select>
                            </div>
                        </div>
                        
                        <?php if(CCaptcha::checkRequirements()): ?>
                        <div class="form-group">
                            <?php echo $form->labelEx($model,'verifyCode', array('class'=>'col-xs-3 col-sm-2 control-label')); ?>
                            <div class="col-xs-9 col-sm-6 col-md-4">
                                <?php $this->widget('CCaptcha'); ?>
                                <?php echo $form->textField($model,'verifyCode', array('class'=>'form-control')); ?>
                                Letters are not case-sensitive.
                            </div>
                            <?php echo $form->error($model,'verifyCode'); ?>
                        </div>
                        <?php endif; ?>
                        
                        
                        <div class="form-group">
                            <div class="col-xs-offset-3 col-xs-9 col-sm-offset-2 col-sm-6 col-md-4">
                                <input type="submit" class="btn btn-primary" value="Submit" />
                                <input type="reset" class="btn btn-default" value="Clear"/>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

<?php endif; ?>