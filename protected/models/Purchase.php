<?php

/**
 * This is the model class for table "purchase".
 *
 * The followings are the available columns in table 'purchase':
 * @property integer $id
 * @property integer $token
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $quantity
 * @property string $purchase_date
 * @property integer $status_id
 * @property integer $sent
 * @property integer $shortage
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Purchase extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'purchase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, product_id, quantity, status_id, sent, shortage', 'numerical', 'integerOnly'=>true),
			array('purchase_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, token_id, user_id, product_id, quantity, purchase_date, status_id, sent, shortage', 'safe', 'on'=>'search'),
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
            'token' => array(self::BELONGS_TO, 'Paymilltoken', 'token_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'token_id' => 'Token',
			'user_id' => 'User',
			'product_id' => 'Product',
			'quantity' => 'Quantity',
			'purchase_date' => 'Purchase Date',
			'status_id' => 'Status',
			'sent' => 'Sent',
			'shortage' => 'Shortage',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('token',$this->token);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('purchase_date',$this->purchase_date,true);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('sent',$this->sent);
		$criteria->compare('shortage',$this->shortage);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Purchase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    /**
     * Add Carts after payment to order/purchase table
     * Then deletes/clear Carts
     * 
     * @param string $token
     */
    public function addCarts($token) {
        $user_id = Yii::app()->user->id;
        $carts = Cart::model()->getCarts($user_id, $token);
        
        foreach ($carts as $cart) {
            $purchase = new Purchase();
            $purchase->token= $cart->token;
            $purchase->user_id=$cart->user_id;
            $purchase->product_id=$cart->product_id;
            $purchase->quantity=$cart->quantity;
            $purchase->status_id = 10; // IPN_AMOUNT_OK
            $purchase->save();
            $cart->delete();
        }
    }
}
