<?php
Yii::import('zii.widgets.CPortlet');
 
class Steps extends CPortlet
{
	public $class;
	public $id;
	public $headerText;
	public $image_file;
	public $description;
	
    public function init()
    {
        parent::init();
    }
 
    protected function renderContent()
    {
        $this->render('steps', array(
        	'class'=>$this->class,
        	'id'=>$this->id,
        	'headerText'=>$this->headerText,
        	'image_file'=>$this->image_file,
        	'description'=>$this->description,
        ));
    }
}
?>