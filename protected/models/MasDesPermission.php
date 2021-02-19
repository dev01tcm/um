<?php

/**
 * This is the model class for table "mas_des_permission".
 *
 * The followings are the available columns in table 'mas_des_permission':
 * @property integer $dp_id
 * @property string $mas_app_id
 * @property string $mas_module_id
 * @property string $mas_officer_id
 * @property string $dp_description
 * @property string $dp_status
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class MasDesPermission extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mas_des_permission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mas_app_id, mas_module_id, mas_officer_id, dp_description, createby, updateby', 'required'),
			array('mas_app_id, mas_module_id, mas_officer_id, dp_status', 'length', 'max'=>10),
			array('createby, updateby', 'length', 'max'=>100),
			array('updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
        	array('createdate,updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('dp_id, mas_app_id, mas_module_id, mas_officer_id, dp_description, dp_status, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'dp_id' => 'Dp',
			'mas_app_id' => 'Mas App',
			'mas_module_id' => 'Mas Module',
			'mas_officer_id' => 'Mas Officer',
			'dp_description' => 'Dp Description',
			'dp_status' => 'Dp Status',
			'createby' => 'Createby',
			'createdate' => 'Createdate',
			'updateby' => 'Updateby',
			'updatedate' => 'Updatedate',
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

		$criteria->compare('dp_id',$this->dp_id);
		$criteria->compare('mas_app_id',$this->mas_app_id,true);
		$criteria->compare('mas_module_id',$this->mas_module_id,true);
		$criteria->compare('mas_officer_id',$this->mas_officer_id,true);
		$criteria->compare('dp_description',$this->dp_description,true);
		$criteria->compare('dp_status',$this->dp_status,true);
		$criteria->compare('createby',$this->createby,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('updateby',$this->updateby,true);
		$criteria->compare('updatedate',$this->updatedate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MasDesPermission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
