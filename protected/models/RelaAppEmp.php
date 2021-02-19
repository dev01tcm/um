<?php

/**
 * This is the model class for table "rela_app_emp".
 *
 * The followings are the available columns in table 'rela_app_emp':
 * @property integer $ae_id
 * @property string $mas_app_id
 * @property string $um_emp_id
 * @property string $ae_status
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class RelaAppEmp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rela_app_emp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mas_app_id, um_emp_id, createby, updateby', 'required'),
			array('mas_app_id, um_emp_id, createby, updateby', 'length', 'max'=>100),
			array('ae_status', 'length', 'max'=>10),
			array('updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
        	array('createdate,updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ae_id, mas_app_id, um_emp_id, ae_status, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'ae_id' => 'Ae',
			'mas_app_id' => 'Mas App',
			'um_emp_id' => 'Um Emp',
			'ae_status' => 'Ae Status',
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

		$criteria->compare('ae_id',$this->ae_id);
		$criteria->compare('mas_app_id',$this->mas_app_id,true);
		$criteria->compare('um_emp_id',$this->um_emp_id,true);
		$criteria->compare('ae_status',$this->ae_status,true);
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
	 * @return RelaAppEmp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
