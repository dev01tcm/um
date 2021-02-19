<?php

/**
 * This is the model class for table "mas_permisstion_type".
 *
 * The followings are the available columns in table 'mas_permisstion_type':
 * @property integer $pt_id
 * @property string $pt_name
 * @property string $pt_description
 * @property string $pt_status
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class MasPermisstionType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MasPermisstionType the static model class
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
		return 'mas_permisstion_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pt_name, pt_description, createby, updateby', 'required'),
			array('pt_name, createby, updateby', 'length', 'max'=>100),
			array('pt_description', 'length', 'max'=>255),
			array('pt_status', 'length', 'max'=>10),
			array('createdate, updatedate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pt_id, pt_name, pt_description, pt_status, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'pt_id' => 'Pt',
			'pt_name' => 'Pt Name',
			'pt_description' => 'Pt Description',
			'pt_status' => 'Pt Status',
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

		$criteria->compare('pt_id',$this->pt_id);
		$criteria->compare('pt_name',$this->pt_name,true);
		$criteria->compare('pt_description',$this->pt_description,true);
		$criteria->compare('pt_status',$this->pt_status,true);
		$criteria->compare('createby',$this->createby,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('updateby',$this->updateby,true);
		$criteria->compare('updatedate',$this->updatedate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}