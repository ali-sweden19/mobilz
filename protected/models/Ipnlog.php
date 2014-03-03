<?php

/**
 * This is the model class for table "ipnlog".
 *
 * The followings are the available columns in table 'ipnlog':
 * @property integer $id
 * @property integer $purchase_id
 * @property string $date
 * @property string $description
 */
class Ipnlog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ipnlog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('purchase_id', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>65),
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, purchase_id, date, description', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'purchase_id' => 'Purchase',
			'date' => 'Date',
			'description' => 'Description',
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
		$criteria->compare('purchase_id',$this->purchase_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ipnlog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    /**
     * Computes the date and time before saving 
     * 
     * @return boolean
     */
    protected function beforeSave() {
        if(parent::beforeSave()){
            $this->date=date("Y-m-d H:i:s");
            return TRUE;
        } else {
            return false;
        }
    } 
    
    /**
     * Saves log for tracking id
     * 
     * @param integer $tracking_id
     * @param string $description
     */
    public function saveIpnlog($tracking_id, $description) {
        $filename = dirname(Yii::app()->request->scriptFile).'/data/'.'test.txt';
        file_put_contents($filename, "\n============= saveIpnlog($tracking_id, $description) ================\n" , FILE_APPEND);
        
        $model = new Ipnlog;
        $model->purchase_id=$tracking_id;
        $model->description="$description";
        $model->save();
    }
}
