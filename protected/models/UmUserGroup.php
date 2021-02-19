<?php

/**
 * This is the model class for table "um_user_group".
 *
 * The followings are the available columns in table 'um_user_group':
 * @property integer $ug_id
 * @property string $um_employee_id
 * @property string $mas_user_group_id
 * @property string $ug_status
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class UmUserGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UmUserGroup the static model class
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
		return 'um_user_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('um_employee_id, mas_user_group_id, createby, updateby', 'required'),
			array('um_employee_id, mas_user_group_id, ug_status', 'length', 'max'=>10),
			array('createby, updateby', 'length', 'max'=>100),
			array('createdate, updatedate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ug_id, um_employee_id, mas_user_group_id, ug_status, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'um_employee_id' => 'Um Employee',
			'mas_user_group_id' => 'Mas User Group',
			'ug_status' => 'Ug Status',
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

		$criteria->compare('ug_id',$this->ug_id);
		$criteria->compare('um_employee_id',$this->um_employee_id,true);
		$criteria->compare('mas_user_group_id',$this->mas_user_group_id,true);
		$criteria->compare('ug_status',$this->ug_status,true);
		$criteria->compare('createby',$this->createby,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('updateby',$this->updateby,true);
		$criteria->compare('updatedate',$this->updatedate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}