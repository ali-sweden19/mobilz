<?php

/**
 * This is the model class for table "cart".
 *
 * The followings are the available columns in table 'cart':
 * @property integer $id
 * @property integer $product_id
 * @property integer $quantity
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class Cart extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cart the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cart';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('product_id, quantity', 'numerical', 'integerOnly'=>true),
			array('quantity', 'numerical', 'min'=>1, 'max'=>2),
			array('id, product_id, user_id, quantity', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

    /**
     * Provides path to the image thumb
     * 
     * @return string image tag with image src
     */
	public function getThumbImgPath() {
        $imagesFolder= Yii::app()->request->baseUrl .'/images/';
		$image_file='thumb_' . $this->product->image_file;
		$image= file_exists($imagesFolder . $image_file) ? $image_file : $this->product->image_file; 
		return '<img style="width:50px;" src="' .  $imagesFolder.$image . '" />';
		
	}
	
    /**
     * Calculates the total price for the current model
     * 
     * @return integer
     */
	public function getTotalPrice() {
		return $this->product->price * $this->quantity;
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'quantity' => 'Quantity',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('quantity',$this->quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    /**
     * Finds carts with specified token and sets their status
     * 
     * @param string $toekn
     * @param integer $status
     * @return double $amount total amount of Cart items
     */
    public function saveToken($token, $status=0) {
        $user_id = Yii::app()->user->id;
        $carts = $this->getCarts($user_id);
        $amount = 0;
        foreach ($carts as $cart) {
            $cart->token=$token;
            if($status > 0) {
                $cart->status_id=$status;
            }
            $amount = $amount + ($cart->product->price * $cart->quantity);
            $cart->save();
        }
        return $amount;
    }
    
    /**
     * Checks if cart is empty for the user
     * 
     * @param integer $user_id
     * @return boolean
     */
    public function cartEmpty($user_id) {
        $carts=$this->getCarts($user_id);
        if(isset($carts) && count($carts) > 0)
            return false;
        return true;
    }

    /**
     * Checks if a product already exists in the user cart
     * 
     * @param integer $user_id
     * @param integer $product_id
     * @return boolean
     */
    public function alreadyExists($user_id, $product_id) {
        $carts = $this->getCarts($user_id);
        foreach($carts as $cart) {
            if($cart->product_id==$product_id)
                return TRUE;
        }
        return FALSE;
    }

    /**
     * Finds and returns the carts of a user
     * 
     * @param integer $user_id
     * @return Cart
     */
    public function getCarts($user_id) {
        $criteria = new CDbCriteria;
        $criteria->condition="user_id=$user_id";
        $carts = Cart::model()->findAll($criteria);
        return $carts;
    }
    
    /**
     * Find carts by tracking ID in the specified status (default 10)
     * 
     * @param integer $tracking_id
     * @param integer $status
     * @return Cart
     */
    public function getCartsByTrackingID($tracking_id, $status=10) {
        $criteria = new CDbCriteria; 
        $criteria->condition="tracking_id=$tracking_id AND status_id= $status";
        $carts = Cart::model()->findAll($criteria);
        return $carts;
    }
    
    /**
     * Finds carts by tracking id and sets their status
     * 
     * @param integer $tracking_id
     * @param interger $status
     */
    public function setStatus($tracking_id, $status) {
        $carts = Cart::model()->findAllByAttributes(array('tracking_id'=>$tracking_id));
        foreach ($carts as $cart) {
            $cart->status_id=$status;
            $cart->save();
        }
    }
    
    /**
     * Find the total cart amount for all the items
     * 
     * @param integer $tracking_id
     * @return double
     */
    public function findCartAmount($tracking_id) {
        if($tracking_id === FALSE) {
            $user_id = Yii::app()->user->id;
            $model= Cart::model()->findAllByAttributes(array('user_id'=>$user_id));
        } else {
            $model= Cart::model()->findAllByAttributes(array('tracking_id'=>$tracking_id));
        }
        if(isset($model)) {
            $amount = 0;
            foreach ($model as $cart) {
                $amount += ($cart->quantity * $cart->product->price);
            }
            Ipnlog::model()->saveIpnlog($tracking_id, 'findCartAmount:' . $amount);
            return $amount;
        } else {
            Ipnlog::model()->saveIpnlog($tracking_id, 'Purchase had been made already, but IPN recv again');
            return -1;
        }
    }
    
    /**
     * Adds a product to a user cart
     * 
     * @param Product $product
     * @param integer $user_id
     * @return boolean
     */
    public function addProduct($product, $user_id) {
        // check if already added
        if ($this->alreadyExists($user_id, $product->id))  { 
            return TRUE;
        } else {
            $cart=new Cart;
            $cart->product_id = $product->id;
            $cart->quantity = 1;
            $cart->user_id = $user_id;
            if($cart->save(FALSE)) 
                return TRUE;
            else 
                return FALSE;
        }
    }
    
    /**
     * Finds and return the no of items in the cart
     * 
     * @return integer
     */
    public function getItemsCount() {
        if(Yii::app()->user->isGuest) {
            $sessionCart = new SessionCart();
            $count = $sessionCart->getItemsCount();
        } else {
            $user_id = Yii::app()->user->id;
            $count = Cart::model()->count('user_id=:user_id', array(':user_id' =>$user_id));
        }
        return $count;
    }
    
    /**
     * When the user logins the cart table is updated
     * By his session carts if there exists any
     * 
     */
    public function updateFromSession() {
        $sCart = new SessionCart;
        if($sCart->getItemsCount() == 0) { // if not item then return
            return;
        }
        $sessionCarts = $sCart->getCarts();
        $user_id = Yii::app()->user->id;
        $carts = $this->getCarts($user_id);
        foreach ($carts as $cart) { // clear previous carts in db
            $cart->delete();
        }
        $this->sessionToCart(TRUE); // update from session
        
    }
    
    /**
     * Converts sessionCarts to cart models
     * if $save is true then saves session cart to db cart table
     * @return array of carts
     */
    public function sessionToCart($save = FALSE) {
        $carts = array();
        $sCart = new SessionCart();
        $sessionCarts = $sCart->getCarts();
        foreach ($sessionCarts as $sessionCart) {
            $cart = new Cart;
            if(! $save)
                $cart->id = $sessionCart->getId();
            $cart->product_id = $sessionCart->getId();
            $cart->quantity = $sessionCart->getQuantity();
            if($save) {
                $cart->user_id = Yii::app()->user->id;
                $cart->save();
            }
            $carts[] = $cart;
        }
        
        return $carts;
    }
    
}