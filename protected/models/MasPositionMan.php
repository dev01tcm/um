<?php

/**
 * This is the model class for table "mas_position_man".
 *
 * The followings are the available columns in table 'mas_position_man':
 * @property integer $pm_id
 * @property string $pm_name_th
 * @property string $pm_name_en
 * @property string $pm_status
 * @property string $id_user_type
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class MasPositionMan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mas_position_man';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user_type, createby, updateby', 'required'),
			array('pm_name_th, pm_name_en, createby, updateby', 'length', 'max'=>255),
			array('pm_status', 'length', 'max'=>10),
			array('id_user_type', 'length', 'max'=>100),
			array('updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
        	array('createdate,updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pm_id, pm_name_th, pm_name_en, pm_status, id_user_type, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'pm_id' => 'Pm',
			'pm_name_th' => 'Pm Name Th',
			'pm_name_en' => 'Pm Name En',
			'pm_status' => 'Pm Status',
			'id_user_type' => 'Id User Type',
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

		$criteria->compare('pm_id',$this->pm_id);
		$criteria->compare('pm_name_th',$this->pm_name_th,true);
		$criteria->compare('pm_name_en',$this->pm_name_en,true);
		$criteria->compare('pm_status',$this->pm_status,true);
		$criteria->compare('id_user_type',$this->id_user_type,true);
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
	 * @return MasPositionMan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
