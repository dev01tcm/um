<?php

/**
 * This is the model class for table "mas_officer_po".
 *
 * The followings are the available columns in table 'mas_officer_po':
 * @property integer $op_id
 * @property string $op_name
 * @property string $op_description
 * @property string $op_status
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class MasOfficerPo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MasOfficerPo the static model class
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
		return 'mas_officer_po';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('op_name, op_description, createby, updateby', 'required'),
			array('op_name, createby, updateby', 'length', 'max'=>100),
			array('op_description', 'length', 'max'=>255),
			array('op_status', 'length', 'max'=>10),
			array('createdate, updatedate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('op_id, op_name, op_description, op_status, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'op_id' => 'Op',
			'op_name' => 'Op Name',
			'op_description' => 'Op Description',
			'op_status' => 'Op Status',
			'createby' => 'Createby',
			'createdate' => 'Createdate',
			'updateby' => 'Updateby',
			'updatedate' => 'Updatedate',
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

		$criteria->compare('op_id',$this->op_id);
		$criteria->compare('op_name',$this->op_name,true);
		$criteria->compare('op_description',$this->op_description,true);
		$criteria->compare('op_status',$this->op_status,true);
		$criteria->compare('createby',$this->createby,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('updateby',$this->updateby,true);
		$criteria->compare('updatedate',$this->updatedate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}