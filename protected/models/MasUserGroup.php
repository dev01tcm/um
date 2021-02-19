<?php

/**
 * This is the model class for table "mas_user_group".
 *
 * The followings are the available columns in table 'mas_user_group':
 * @property integer $ug_id
 * @property string $ug_name
 * @property string $ug_description
 * @property string $ug_status
 * @property string $ud_createby
 * @property string $ud_createdate
 * @property string $ud_updateby
 * @property string $ud_updatedate
 */
class MasUserGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MasUserGroup the static model class
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
		return 'mas_user_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ug_name, ug_description, ud_createby, ud_updateby', 'required'),
			array('ug_name, ug_description', 'length', 'max'=>255),
			array('ug_status', 'length', 'max'=>10),
			array('ud_createby, ud_updateby', 'length', 'max'=>100),
			array('ud_updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
        	array('ud_createdate,ud_updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ug_id, ug_name, ug_description, ug_status, ud_createby, ud_createdate, ud_updateby, ud_updatedate', 'safe', 'on'=>'search'),
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
			'ug_id' => 'Ug',
			'ug_name' => 'Ug Name',
			'ug_description' => 'Ug Description',
			'ug_status' => 'Ug Status',
			'ud_createby' => 'Ud Createby',
			'ud_createdate' => 'Ud Createdate',
			'ud_updateby' => 'Ud Updateby',
			'ud_updatedate' => 'Ud Updatedate',
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

		$criteria->compare('ug_id',$this->ug_id);
		$criteria->compare('ug_name',$this->ug_name,true);
		$criteria->compare('ug_description',$this->ug_description,true);
		$criteria->compare('ug_status',$this->ug_status,true);
		$criteria->compare('ud_createby',$this->ud_createby,true);
		$criteria->compare('ud_createdate',$this->ud_createdate,true);
		$criteria->compare('ud_updateby',$this->ud_updateby,true);
		$criteria->compare('ud_updatedate',$this->ud_updatedate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}