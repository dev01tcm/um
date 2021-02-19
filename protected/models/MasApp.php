<?php

/**
 * This is the model class for table "mas_app".
 *
 * The followings are the available columns in table 'mas_app':
 * @property integer $app_id
 * @property string $app_name_th
 * @property string $app_name_en
 * @property string $app_shortname
 * @property string $app_img
 * @property string $app_contact
 * @property string $app_phone
 * @property string $app_token
 * @property string $app_type
 * @property string $app_status
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class MasApp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mas_app';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_name_th, app_name_en, app_shortname, app_img, app_contact, app_phone, app_token, app_type, createby, updateby', 'required'),
			array('app_name_th, app_contact, app_token', 'length', 'max'=>255),
			array('app_name_en, app_img, app_phone, createby, updateby', 'length', 'max'=>100),
			array('app_shortname', 'length', 'max'=>50),
			array('app_type, app_status', 'length', 'max'=>10),
			array('createdate, updatedate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('app_id, app_name_th, app_name_en, app_shortname, app_img, app_contact, app_phone, app_token, app_type, app_status, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'app_id' => 'App',
			'app_name_th' => 'App Name Th',
			'app_name_en' => 'App Name En',
			'app_shortname' => 'App Shortname',
			'app_img' => 'App Img',
			'app_contact' => 'App Contact',
			'app_phone' => 'App Phone',
			'app_token' => 'App Token',
			'app_type' => 'App Type',
			'app_status' => 'App Status',
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

		$criteria->compare('app_id',$this->app_id);
		$criteria->compare('app_name_th',$this->app_name_th,true);
		$criteria->compare('app_name_en',$this->app_name_en,true);
		$criteria->compare('app_shortname',$this->app_shortname,true);
		$criteria->compare('app_img',$this->app_img,true);
		$criteria->compare('app_contact',$this->app_contact,true);
		$criteria->compare('app_phone',$this->app_phone,true);
		$criteria->compare('app_token',$this->app_token,true);
		$criteria->compare('app_type',$this->app_type,true);
		$criteria->compare('app_status',$this->app_status,true);
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
	 * @return MasApp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
