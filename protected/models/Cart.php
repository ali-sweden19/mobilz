<?php

/**
 * This is the model class for table "cart".
 *
 * The followings are the available columns in table 'cart':
 * @property integer $id
 * @property integer $card_id
 * @property integer $quantity
 *
 * The followings are the available model relations:
 * @property Card $card
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
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('card_id, quantity', 'numerical', 'integerOnly'=>true),
			array('quantity', 'numerical', 'min'=>1, 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, card_id, user_id, quantity', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'card' => array(self::BELONGS_TO, 'Card', 'card_id'),
		);
	}

	public function getThumbImgPath() {
		$image_file='thumb_'.$this->card->image_file;
		$image= file_exists(Yii::app()->basePath.'/../images/'.$image_file) ? $image_file : "thumb_no-image.jpg"; 
		return  Yii::app()->baseUrl . '/images/'.$image;
		
	}
	
	public function getTotalPrice() {
		return $this->card->price * $this->quantity;
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'card_id' => 'Card',
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
		$criteria->compare('card_id',$this->card_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('quantity',$this->quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    /**
     * Finds tracking_id and save new one there. The current id in rec
     * is available one, adds one to it and saves back
     * @param int $user_id
     * @param ind $tracking_id
     * @return double $amount total amount of Cart items
     */
    public function saveTrackingID($user_id, $tracking_id, $status=0) {
        $carts = $this->getCarts($user_id);
        $amount=0;
        foreach ($carts as $cart) {
            $cart->tracking_id=$tracking_id;
            if($status > 0) {
                $cart->status_id=$status;
            }
            $amount = $amount + ($cart->card->price * $cart->quantity);
            $cart->save();
        }
        return $amount;
    }
    
    public function cartEmpty($user_id) {
        $carts=$this->getCarts($user_id);
        if(isset($carts) && count($carts) > 0)
            return false;
        return true;
    }

    public function alreadyExists($user_id, $card_id) {
        $carts = $this->getCarts($user_id);
        foreach($carts as $cart) {
            if($cart->card_id==$card_id)
                return TRUE;
        }
        return FALSE;
    }

    public function getCarts($user_id) {
        $criteria = new CDbCriteria;
        $criteria->condition="user_id=$user_id AND (status_id <> 3 OR status_id is NULL)";
        $carts = Cart::model()->findAll($criteria);
        return $carts;
    }
    public function getCartsByTrackingID($tracking_id, $status=10) {
        $criteria = new CDbCriteria; 
        $criteria->condition="tracking_id=$tracking_id AND status_id= $status";
        $carts = Cart::model()->findAll($criteria);
        return $carts;
    }
    
    public function setStatus($tracking_id, $status) {
        $carts = Cart::model()->findAllByAttributes(array('tracking_id'=>$tracking_id));
        foreach ($carts as $cart) {
            $cart->status_id=$status;
            $cart->save();
        }
    }
    
    public function findCartAmount($tracking_id) {
        $model= Cart::model()->findAllByAttributes(array('tracking_id'=>$tracking_id));
        if(isset($model)) {
            $amount = 0;
            foreach ($model as $cart) {
                $amount += ($cart->quantity * $cart->card->price);
            }
            Ipnlog::model()->saveIpnlog($tracking_id, 'findCartAmount:' . $amount);
            return $amount;
        } else {
            Ipnlog::model()->saveIpnlog($tracking_id, 'Purchase had been made already, but IPN recv again');
            return -1;
        }
    }
    
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
}