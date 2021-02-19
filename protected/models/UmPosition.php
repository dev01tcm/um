<?php

/**
 * This is the model class for table "um_position".
 *
 * The followings are the available columns in table 'um_position':
 * @property integer $ps_id
 * @property string $ps_per_id
 * @property string $ps_citizen
 * @property string $ps_work_type
 * @property string $ps_startdate
 * @property string $ps_enddate
 * @property string $ps_docdate
 * @property string $ps_position_le
 * @property string $ps_position
 * @property string $ps_work_area1
 * @property string $ps_work_area2
 * @property string $ps_work_area3
 * @property string $ps_work_area4
 * @property string $ps_work_area5
 * @property string $ps_update_docdate
 * @property string $ps_statusdoc
 * @property string $ps_description
 * @property string $ps_position_type
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class UmPosition extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UmPosition the static model class
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
		return 'um_position';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createby, createdate, updateby', 'required'),
			array('ps_per_id, ps_work_type, ps_startdate, ps_enddate, ps_docdate, ps_update_docdate, createby, updateby', 'length', 'max'=>100),
			array('ps_citizen', 'length', 'max'=>13),
			array('ps_position_le, ps_position, ps_work_area1, ps_work_area2, ps_work_area3, ps_work_area4, ps_work_area5', 'length', 'max'=>255),
			array('ps_statusdoc, ps_position_type', 'length', 'max'=>10),
			array('ps_description, updatedate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ps_id, ps_per_id, ps_citizen, ps_work_type, ps_startdate, ps_enddate, ps_docdate, ps_position_le, ps_position, ps_work_area1, ps_work_area2, ps_work_area3, ps_work_area4, ps_work_area5, ps_update_docdate, ps_statusdoc, ps_description, ps_position_type, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'ps_id' => 'Ps',
			'ps_per_id' => 'Ps Per',
			'ps_citizen' => 'Ps Citizen',
			'ps_work_type' => 'Ps Work Type',
			'ps_startdate' => 'Ps Startdate',
			'ps_enddate' => 'Ps Enddate',
			'ps_docdate' => 'Ps Docdate',
			'ps_position_le' => 'Ps Position Le',
			'ps_position' => 'Ps Position',
			'ps_work_area1' => 'Ps Work Area1',
			'ps_work_area2' => 'Ps Work Area2',
			'ps_work_area3' => 'Ps Work Area3',
			'ps_work_area4' => 'Ps Work Area4',
			'ps_work_area5' => 'Ps Work Area5',
			'ps_update_docdate' => 'Ps Update Docdate',
			'ps_statusdoc' => 'Ps Statusdoc',
			'ps_description' => 'Ps Description',
			'ps_position_type' => 'Ps Position Type',
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

		$criteria->compare('ps_id',$this->ps_id);
		$criteria->compare('ps_per_id',$this->ps_per_id,true);
		$criteria->compare('ps_citizen',$this->ps_citizen,true);
		$criteria->compare('ps_work_type',$this->ps_work_type,true);
		$criteria->compare('ps_startdate',$this->ps_startdate,true);
		$criteria->compare('ps_enddate',$this->ps_enddate,true);
		$criteria->compare('ps_docdate',$this->ps_docdate,true);
		$criteria->compare('ps_position_le',$this->ps_position_le,true);
		$criteria->compare('ps_position',$this->ps_position,true);
		$criteria->compare('ps_work_area1',$this->ps_work_area1,true);
		$criteria->compare('ps_work_area2',$this->ps_work_area2,true);
		$criteria->compare('ps_work_area3',$this->ps_work_area3,true);
		$criteria->compare('ps_work_area4',$this->ps_work_area4,true);
		$criteria->compare('ps_work_area5',$this->ps_work_area5,true);
		$criteria->compare('ps_update_docdate',$this->ps_update_docdate,true);
		$criteria->compare('ps_statusdoc',$this->ps_statusdoc,true);
		$criteria->compare('ps_description',$this->ps_description,true);
		$criteria->compare('ps_position_type',$this->ps_position_type,true);
		$criteria->compare('createby',$this->createby,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('updateby',$this->updateby,true);
		$criteria->compare('updatedate',$this->updatedate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}