<?php

class CartController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','add', 'admin', 'delete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Cart;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cart']))
		{
			$model->attributes=$_POST['Cart'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cart']))
		{
			$model->attributes=$_POST['Cart'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        if (Yii::app()->user->isGuest) {
            $sCart = new SessionCart;
            $sCart->remove($id);
        } else {
            $this->loadModel($id)->delete();
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex2()
	{
		$dataProvider=new CActiveDataProvider('Cart');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
        $this->updateQuantity();
        if(Yii::app()->user->isGuest) {
            $dataProvider=new CActiveDataProvider('Cart', array(
                'data'=> Cart::model()->sessionToCart(),
            ));
        } else {
            $user_id = Yii::app()->user->id;
            $dataProvider=new CActiveDataProvider('Cart', array(
                'criteria'=> array(
                    'condition'=>"user_id=$user_id"
                )
            ));
        }
        
		$this->render('admin',array(
			'dataProvider'=>$dataProvider,
		));
	}
    
    private function updateQuantity() {
        if (isset($_POST['quantity'])) { // you want to update cart 
            $quantity = $_POST['quantity']; $model_errors='';
            $user = Yii::app()->getComponent('user');
            $noErrors = true;
            if(Yii::app()->user->isGuest) {
                $sCart = new SessionCart;
                $sessionCarts = $sCart->getCarts();
                foreach($quantity as $cart_id=>$qty) {
                    $model = new Cart; // we will validate by using dummy Cart model
                    $model->product_id = $sessionCarts[$cart_id]->getId();
                    $model->quantity = $qty;
                    $model->validate();
                    if($model->hasErrors()){
                        $model_errors = CHtml::errorSummary($model);
                        $user->setFlash(
                            'error',
                            "<strong> $model_errors </strong>"
                        );
                        $noErrors=FALSE;
                    } else {
                       $sessionCarts[$cart_id]->updateQuantity($cart_id, $qty);
                    }
                }
            } else {
                foreach($quantity as $cart_id=>$qty) {
                    $model = Cart::model()->findByPk($cart_id);
                    $model->quantity=$qty;
                    $model->save();
                    if($model->hasErrors()){
                        $model_errors = CHtml::errorSummary($model);
                        $user->setFlash(
                            'error',
                            "<strong> $model_errors </strong>"
                        );
                        $noErrors=FALSE;
                    }
                }
            }
            
            if($noErrors) {
                $user->setFlash(
                     'success',
                     "<strong> Updated successfully. </strong>"
                 );
            }
            
		}
    }
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cart the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cart::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cart $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cart-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    /**
	 * To add item by ajax to Cart
	 */
    public function actionAdd() {
        $id = $_POST['id'];
        // Check if product is valid 
        $product = Product::model()->getPublishedProduct($id);
        if ($product === null) {
            echo json_encode(array(
                'status'=>'product-not-valid'
            ));
            return;
        }
        
        $link =  $this->createUrl('cart/index');
        $linkButton = '<button onclick=window.location.href="'.$link.'" type="button" class="view_cart btn btn-info">View</button>';
        
        // check if user is logged in
        if(Yii::app()->user->isGuest) {
            $cart = new SessionCart();
            $cart->add($id, 1);
            $cart->saveToSession();
        } else {
            $user_id = Yii::app()->user->id;
            Cart::model()->addProduct($product, $user_id);
        }
        $count = Cart::model()->getItemsCount();
        echo json_encode(array(
            'status'=>'ok',
            'items'=>"Items ($count)",
            'linkButton'=>$linkButton,
        ));
	}
}
