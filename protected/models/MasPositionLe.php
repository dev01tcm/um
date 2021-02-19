<?php

/**
 * This is the model class for table "mas_position_le".
 *
 * The followings are the available columns in table 'mas_position_le':
 * @property integer $PositLevelID
 * @property string $PositLevelNameTH
 * @property string $PositLevelNameEN
 * @property string $StatusData
 * @property string $id_user_type
 * @property string $CreateDate
 * @property string $CreateBy
 * @property string $UpdateDate
 * @property string $UpdateBy
 */
class MasPositionLe extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mas_position_le';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user_type', 'required'),
			array('PositLevelNameTH, PositLevelNameEN, id_user_type, CreateBy, UpdateBy', 'length', 'max'=>100),
			array('StatusData', 'length', 'max'=>10),
			array('UpdateDate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
        	array('CreateDate,UpdateDate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PositLevelID, PositLevelNameTH, PositLevelNameEN, StatusData, id_user_type, CreateDate, CreateBy, UpdateDate, UpdateBy', 'safe', 'on'=>'search'),
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
			'PositLevelID' => 'Posit Level',
			'PositLevelNameTH' => 'Posit Level Name Th',
			'PositLevelNameEN' => 'Posit Level Name En',
			'StatusData' => 'Status Data',
			'id_user_type' => 'Id User Type',
			'CreateDate' => 'Create Date',
			'CreateBy' => 'Create By',
			'UpdateDate' => 'Update Date',
			'UpdateBy' => 'Update By',
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

		$criteria->compare('PositLevelID',$this->PositLevelID);
		$criteria->compare('PositLevelNameTH',$this->PositLevelNameTH,true);
		$criteria->compare('PositLevelNameEN',$this->PositLevelNameEN,true);
		$criteria->compare('StatusData',$this->StatusData,true);
		$criteria->compare('id_user_type',$this->id_user_type,true);
		$criteria->compare('CreateDate',$this->CreateDate,true);
		$criteria->compare('CreateBy',$this->CreateBy,true);
		$criteria->compare('UpdateDate',$this->UpdateDate,true);
		$criteria->compare('UpdateBy',$this->UpdateBy,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MasPositionLe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
