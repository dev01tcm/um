<?php

/**
 * This is the model class for table "mas_department".
 *
 * The followings are the available columns in table 'mas_department':
 * @property integer $dp_id
 * @property string $DeptID
 * @property string $DeptNameTH
 * @property string $DeptNameEN
 * @property string $DeptNameDpisTH
 * @property string $DeptNameDpisEN
 * @property string $DeptShortName
 * @property integer $BranchTypeID
 * @property string $StatusData
 * @property string $CreateDate
 * @property string $CreateBy
 * @property string $UpdateDate
 * @property string $UpdateBy
 */
class MasDepartment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MasDepartment the static model class
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
		return 'mas_department';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DeptID', 'required'),
			array('BranchTypeID', 'numerical', 'integerOnly'=>true),
			array('DeptID', 'length', 'max'=>4),
			array('DeptNameTH, DeptNameEN, DeptNameDpisTH, DeptNameDpisEN, DeptShortName, CreateBy, UpdateBy', 'length', 'max'=>100),
			array('StatusData', 'length', 'max'=>10),
			array('UpdateDate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
        	array('CreateDate,UpdateDate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dp_id, DeptID, DeptNameTH, DeptNameEN, DeptNameDpisTH, DeptNameDpisEN, DeptShortName, BranchTypeID, StatusData, CreateDate, CreateBy, UpdateDate, UpdateBy', 'safe', 'on'=>'search'),
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
			'DeptID' => 'Dept',
			'DeptNameTH' => 'Dept Name Th',
			'DeptNameEN' => 'Dept Name En',
			'DeptNameDpisTH' => 'Dept Name Dpis Th',
			'DeptNameDpisEN' => 'Dept Name Dpis En',
			'DeptShortName' => 'Dept Short Name',
			'BranchTypeID' => 'Branch Type',
			'StatusData' => 'Status Data',
			'CreateDate' => 'Create Date',
			'CreateBy' => 'Create By',
			'UpdateDate' => 'Update Date',
			'UpdateBy' => 'Update By',
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

		$criteria->compare('dp_id',$this->dp_id);
		$criteria->compare('DeptID',$this->DeptID,true);
		$criteria->compare('DeptNameTH',$this->DeptNameTH,true);
		$criteria->compare('DeptNameEN',$this->DeptNameEN,true);
		$criteria->compare('DeptNameDpisTH',$this->DeptNameDpisTH,true);
		$criteria->compare('DeptNameDpisEN',$this->DeptNameDpisEN,true);
		$criteria->compare('DeptShortName',$this->DeptShortName,true);
		$criteria->compare('BranchTypeID',$this->BranchTypeID);
		$criteria->compare('StatusData',$this->StatusData,true);
		$criteria->compare('CreateDate',$this->CreateDate,true);
		$criteria->compare('CreateBy',$this->CreateBy,true);
		$criteria->compare('UpdateDate',$this->UpdateDate,true);
		$criteria->compare('UpdateBy',$this->UpdateBy,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}