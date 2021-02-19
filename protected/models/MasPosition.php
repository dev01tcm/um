<?php

/**
 * This is the model class for table "mas_position".
 *
 * The followings are the available columns in table 'mas_position':
 * @property integer $PositID
 * @property string $PositNameTH
 * @property string $PositNameEN
 * @property string $StatusData
 * @property string $CreateDate
 * @property string $CreateBy
 * @property string $UpdateDate
 * @property string $UpdateBy
 */
class MasPosition extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MasPosition the static model class
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
		return 'mas_position';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PositNameTH, PositNameEN, CreateBy, UpdateBy', 'length', 'max'=>100),
			array('StatusData', 'length', 'max'=>10),
			array('UpdateDate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
        	array('CreateDate,UpdateDate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PositID, PositNameTH, PositNameEN, StatusData, CreateDate, CreateBy, UpdateDate, UpdateBy', 'safe', 'on'=>'search'),
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
			'PositID' => 'Posit',
			'PositNameTH' => 'Posit Name Th',
			'PositNameEN' => 'Posit Name En',
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

		$criteria->compare('PositID',$this->PositID);
		$criteria->compare('PositNameTH',$this->PositNameTH,true);
		$criteria->compare('PositNameEN',$this->PositNameEN,true);
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