<?php

/**
 * This is the model class for table "db_dpis".
 *
 * The followings are the available columns in table 'db_dpis':
 * @property string $PER_ID
 * @property string $SSOFIRSTNAME
 * @property string $SSOSURNAME
 * @property string $SSOPERSONEMPDATE
 * @property string $TITLE
 * @property string $INITIALS
 * @property string $EMPLOYEETYPE
 * @property string $GIVENNAME
 * @property string $SN
 * @property string $WORKINGDEPTDESCRIPTION
 * @property string $SSOPERSONCLASS
 * @property string $SSOPERSONPOSITION
 * @property string $PMNAME
 * @property string $PN_NAME
 * @property string $SSOPERSONCITIZENID
 * @property string $ACCOUNTACTIVE
 * @property string $SSOPERSONBIRTHDATE
 * @property string $PICPATH
 * @property string $PIC_UPDATE
 * @property string $PER_GENDER
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class Db extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Db the static model class
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
		return 'db_dpis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PER_ID, createby, updateby', 'required'),
			array('PER_ID, ACCOUNTACTIVE, PER_GENDER', 'length', 'max'=>10),
			array('SSOFIRSTNAME, SSOSURNAME, TITLE, INITIALS, EMPLOYEETYPE, GIVENNAME, SN', 'length', 'max'=>50),
			array('SSOPERSONEMPDATE, SSOPERSONBIRTHDATE, PIC_UPDATE', 'length', 'max'=>20),
			array('WORKINGDEPTDESCRIPTION, SSOPERSONCLASS, SSOPERSONPOSITION, PN_NAME, PICPATH, createby, updateby', 'length', 'max'=>100),
			array('PMNAME', 'length', 'max'=>255),
			array('SSOPERSONCITIZENID', 'length', 'max'=>13),
			array('createdate, updatedate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PER_ID, SSOFIRSTNAME, SSOSURNAME, SSOPERSONEMPDATE, TITLE, INITIALS, EMPLOYEETYPE, GIVENNAME, SN, WORKINGDEPTDESCRIPTION, SSOPERSONCLASS, SSOPERSONPOSITION, PMNAME, PN_NAME, SSOPERSONCITIZENID, ACCOUNTACTIVE, SSOPERSONBIRTHDATE, PICPATH, PIC_UPDATE, PER_GENDER, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'PER_ID' => 'Per',
			'SSOFIRSTNAME' => 'Ssofirstname',
			'SSOSURNAME' => 'Ssosurname',
			'SSOPERSONEMPDATE' => 'Ssopersonempdate',
			'TITLE' => 'Title',
			'INITIALS' => 'Initials',
			'EMPLOYEETYPE' => 'Employeetype',
			'GIVENNAME' => 'Givenname',
			'SN' => 'Sn',
			'WORKINGDEPTDESCRIPTION' => 'Workingdeptdescription',
			'SSOPERSONCLASS' => 'Ssopersonclass',
			'SSOPERSONPOSITION' => 'Ssopersonposition',
			'PMNAME' => 'Pmname',
			'PN_NAME' => 'Pn Name',
			'SSOPERSONCITIZENID' => 'Ssopersoncitizenid',
			'ACCOUNTACTIVE' => 'Accountactive',
			'SSOPERSONBIRTHDATE' => 'Ssopersonbirthdate',
			'PICPATH' => 'Picpath',
			'PIC_UPDATE' => 'Pic Update',
			'PER_GENDER' => 'Per Gender',
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

		$criteria->compare('PER_ID',$this->PER_ID,true);
		$criteria->compare('SSOFIRSTNAME',$this->SSOFIRSTNAME,true);
		$criteria->compare('SSOSURNAME',$this->SSOSURNAME,true);
		$criteria->compare('SSOPERSONEMPDATE',$this->SSOPERSONEMPDATE,true);
		$criteria->compare('TITLE',$this->TITLE,true);
		$criteria->compare('INITIALS',$this->INITIALS,true);
		$criteria->compare('EMPLOYEETYPE',$this->EMPLOYEETYPE,true);
		$criteria->compare('GIVENNAME',$this->GIVENNAME,true);
		$criteria->compare('SN',$this->SN,true);
		$criteria->compare('WORKINGDEPTDESCRIPTION',$this->WORKINGDEPTDESCRIPTION,true);
		$criteria->compare('SSOPERSONCLASS',$this->SSOPERSONCLASS,true);
		$criteria->compare('SSOPERSONPOSITION',$this->SSOPERSONPOSITION,true);
		$criteria->compare('PMNAME',$this->PMNAME,true);
		$criteria->compare('PN_NAME',$this->PN_NAME,true);
		$criteria->compare('SSOPERSONCITIZENID',$this->SSOPERSONCITIZENID,true);
		$criteria->compare('ACCOUNTACTIVE',$this->ACCOUNTACTIVE,true);
		$criteria->compare('SSOPERSONBIRTHDATE',$this->SSOPERSONBIRTHDATE,true);
		$criteria->compare('PICPATH',$this->PICPATH,true);
		$criteria->compare('PIC_UPDATE',$this->PIC_UPDATE,true);
		$criteria->compare('PER_GENDER',$this->PER_GENDER,true);
		$criteria->compare('createby',$this->createby,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('updateby',$this->updateby,true);
		$criteria->compare('updatedate',$this->updatedate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}