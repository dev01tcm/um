<?php

/**
 * This is the model class for table "tran_group_of_role".
 *
 * The followings are the available columns in table 'tran_group_of_role':
 * @property integer $tg_id
 * @property string $id_group_of_role
 * @property string $id_position_man
 * @property string $id_user_type
 * @property string $id_position_level
 * @property string $tg_status
 * @property string $createby
 * @property string $createdate
 * @property string $updateby
 * @property string $updatedate
 */
class TranGroupOfRole extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tran_group_of_role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_group_of_role, id_position_man, id_user_type, id_position_level, createby, updateby', 'required'),
			array('id_group_of_role, id_position_man, id_user_type, id_position_level, createby, updateby', 'length', 'max'=>100),
			array('tg_status', 'length', 'max'=>10),
			array('createdate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
        	array('createdate,updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tg_id, id_group_of_role, id_position_man, id_user_type, id_position_level, tg_status, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
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
			'tg_id' => 'Tg',
			'id_group_of_role' => 'Id Group Of Role',
			'id_position_man' => 'Id Position Man',
			'id_user_type' => 'Id User Type',
			'id_position_level' => 'Id Position Level',
			'tg_status' => 'Tg Status',
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

		$criteria->compare('tg_id',$this->tg_id);
		$criteria->compare('id_group_of_role',$this->id_group_of_role,true);
		$criteria->compare('id_position_man',$this->id_position_man,true);
		$criteria->compare('id_user_type',$this->id_user_type,true);
		$criteria->compare('id_position_level',$this->id_position_level,true);
		$criteria->compare('tg_status',$this->tg_status,true);
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
	 * @return TranGroupOfRole the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
