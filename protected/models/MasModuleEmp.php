<?php

/**
 * This is the model class for table "mas_module_emp".
 *
 * The followings are the available columns in table 'mas_module_emp':
 * @property integer $mme_id
 * @property string $app_id
 * @property string $module_id
 * @property string $module_name
 * @property string $module_code
 * @property string $user_id
 * @property string $status
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class MasModuleEmp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mas_module_emp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, module_id, module_name, module_code, user_id, createby, updateby', 'required'),
			array('app_id, module_id, module_name, module_code, user_id, createby, updateby', 'length', 'max'=>100),
			array('status', 'length', 'max'=>10),
			array('updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
        	array('createdate,updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'), 
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mme_id, app_id, module_id, module_name, module_code, user_id, status, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'mme_id' => 'Mme',
			'app_id' => 'App',
			'module_id' => 'Module',
			'module_name' => 'Module Name',
			'module_code' => 'Module Code',
			'user_id' => 'User',
			'status' => 'Status',
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

		$criteria->compare('mme_id',$this->mme_id);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('module_id',$this->module_id,true);
		$criteria->compare('module_name',$this->module_name,true);
		$criteria->compare('module_code',$this->module_code,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('status',$this->status,true);
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
	 * @return MasModuleEmp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}