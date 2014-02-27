<?php
// $yii='/opt/lampp/htdocs/yii/framework/yii.php';
// require_once($yii);
/**
 * This is the model class for table "paymilltoken".
 *
 * The followings are the available columns in table 'paymilltoken':
 * @property integer $id
 * @property string $token
 */
class Paymilltoken extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paymilltoken';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('token', 'length', 'max'=>25),
			array('id, token', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'purchases' => array(self::HAS_MANY, 'Purchase', 'token_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'token' => 'Token',
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
		$criteria->compare('token',$this->token,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Paymilltoken the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function alreadyProcessed($token) {
        $model = Paymilltoken::model()->findByAttributes(array('token'=>$token));
        if(isset($model)) {
            return TRUE;
        }
        return FALSE;
    }
    
    public function addToken($token) {
        if(!$this->alreadyProcessed($token)) {
            $model = new Paymilltoken;
            $model->token = $token;
            return $model->save();
        } else {
            return FALSE;
        }
    }
}
