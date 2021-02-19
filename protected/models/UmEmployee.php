<?php

/**
 * This is the model class for table "um_employee".
 *
 * The followings are the available columns in table 'um_employee':
 * @property integer $em_id
 * @property string $em_per_id
 * @property string $em_username
 * @property string $em_password
 * @property string $em_citizen_id
 * @property string $mas_prefix_id
 * @property string $em_name_th
 * @property string $em_surname_th
 * @property string $em_name_en
 * @property string $em_surname_en
 * @property string $em_birthday
 * @property string $em_email
 * @property string $em_image
 * @property string $em_workactive_date
 * @property string $em_description
 * @property string $em_in_phone
 * @property string $em_mobile
 * @property string $em_work_status
 * @property string $em_status
 * @property string $um_assign_id
 * @property string $um_user_group_id
 * @property string $mas_user_type_id
 * @property string $mas_department_id
 * @property string $mas_position_le_id
 * @property string $um_position_id
 * @property string $um_data_complete_id
 * @property string $um_user_module_id
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class UmEmployee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'um_employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('em_per_id, em_email, em_in_phone, em_mobile, createby, updateby', 'length', 'max'=>100),
			array('em_username, em_password, em_name_th, em_surname_th, em_name_en, em_surname_en, em_image', 'length', 'max'=>255),
			array('em_citizen_id', 'length', 'max'=>13),
			array('mas_prefix_id, em_work_status, em_status, um_assign_id, um_user_group_id, mas_user_type_id, mas_department_id, mas_position_le_id, um_position_id, um_data_complete_id, um_user_module_id', 'length', 'max'=>10),
			array('em_birthday, em_workactive_date', 'length', 'max'=>50),
			array('em_description', 'safe'),
			array('updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
        	array('createdate,updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('em_id, em_per_id, em_username, em_password, em_citizen_id, mas_prefix_id, em_name_th, em_surname_th, em_name_en, em_surname_en, em_birthday, em_email, em_image, em_workactive_date, em_description, em_in_phone, em_mobile, em_work_status, em_status, um_assign_id, um_user_group_id, mas_user_type_id, mas_department_id, mas_position_le_id, um_position_id, um_data_complete_id, um_user_module_id, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'em_id' => 'Em',
			'em_per_id' => 'Em Per',
			'em_username' => 'Em Username',
			'em_password' => 'Em Password',
			'em_citizen_id' => 'Em Citizen',
			'mas_prefix_id' => 'Mas Prefix',
			'em_name_th' => 'Em Name Th',
			'em_surname_th' => 'Em Surname Th',
			'em_name_en' => 'Em Name En',
			'em_surname_en' => 'Em Surname En',
			'em_birthday' => 'Em Birthday',
			'em_email' => 'Em Email',
			'em_image' => 'Em Image',
			'em_workactive_date' => 'Em Workactive Date',
			'em_description' => 'Em Description',
			'em_in_phone' => 'Em In Phone',
			'em_mobile' => 'Em Mobile',
			'em_work_status' => 'Em Work Status',
			'em_status' => 'Em Status',
			'um_assign_id' => 'Um Assign',
			'um_user_group_id' => 'Um User Group',
			'mas_user_type_id' => 'Mas User Type',
			'mas_department_id' => 'Mas Department',
			'mas_position_le_id' => 'Mas Position Le',
			'um_position_id' => 'Um Position',
			'um_data_complete_id' => 'Um Data Complete',
			'um_user_module_id' => 'Um User Module',
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

		$criteria->compare('em_id',$this->em_id);
		$criteria->compare('em_per_id',$this->em_per_id,true);
		$criteria->compare('em_username',$this->em_username,true);
		$criteria->compare('em_password',$this->em_password,true);
		$criteria->compare('em_citizen_id',$this->em_citizen_id,true);
		$criteria->compare('mas_prefix_id',$this->mas_prefix_id,true);
		$criteria->compare('em_name_th',$this->em_name_th,true);
		$criteria->compare('em_surname_th',$this->em_surname_th,true);
		$criteria->compare('em_name_en',$this->em_name_en,true);
		$criteria->compare('em_surname_en',$this->em_surname_en,true);
		$criteria->compare('em_birthday',$this->em_birthday,true);
		$criteria->compare('em_email',$this->em_email,true);
		$criteria->compare('em_image',$this->em_image,true);
		$criteria->compare('em_workactive_date',$this->em_workactive_date,true);
		$criteria->compare('em_description',$this->em_description,true);
		$criteria->compare('em_in_phone',$this->em_in_phone,true);
		$criteria->compare('em_mobile',$this->em_mobile,true);
		$criteria->compare('em_work_status',$this->em_work_status,true);
		$criteria->compare('em_status',$this->em_status,true);
		$criteria->compare('um_assign_id',$this->um_assign_id,true);
		$criteria->compare('um_user_group_id',$this->um_user_group_id,true);
		$criteria->compare('mas_user_type_id',$this->mas_user_type_id,true);
		$criteria->compare('mas_department_id',$this->mas_department_id,true);
		$criteria->compare('mas_position_le_id',$this->mas_position_le_id,true);
		$criteria->compare('um_position_id',$this->um_position_id,true);
		$criteria->compare('um_data_complete_id',$this->um_data_complete_id,true);
		$criteria->compare('um_user_module_id',$this->um_user_module_id,true);
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
	 * @return UmEmployee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
