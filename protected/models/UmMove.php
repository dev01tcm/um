<?php

/**
 * This is the model class for table "um_move".
 *
 * The followings are the available columns in table 'um_move':
 * @property integer $mo_id
 * @property string $mo_content
 * @property string $mo_description
 * @property string $mo_status
 * @property string $mo_branch
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class UmMove extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'um_move';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mo_content, mo_description, mo_status, mo_branch, createby, updateby', 'required'),
			array('mo_content, mo_description', 'length', 'max'=>255),
			array('mo_status', 'length', 'max'=>10),
			array('mo_branch', 'length', 'max'=>4),
			array('createby, updateby', 'length', 'max'=>100),
			array('updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
        	array('createdate,updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'), 
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mo_id, mo_content, mo_description, mo_status, mo_branch, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'mo_id' => 'Mo',
			'mo_content' => 'Mo Content',
			'mo_description' => 'Mo Description',
			'mo_status' => 'Mo Status',
			'mo_branch' => 'Mo Branch',
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

		$criteria->compare('mo_id',$this->mo_id);
		$criteria->compare('mo_content',$this->mo_content,true);
		$criteria->compare('mo_description',$this->mo_description,true);
		$criteria->compare('mo_status',$this->mo_status,true);
		$criteria->compare('mo_branch',$this->mo_branch,true);
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
	 * @return UmMove the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
