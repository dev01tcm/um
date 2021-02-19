<?php

class MasRela extends CActiveRecord {
 	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'rela_app_emp';
	}
	
//-----------------------------------------------------------------------------------------------------------------
	public function check_app_emp($emp) {
		$sql ="SELECT * FROM rela_app_emp WHERE um_emp_id = :id";
		
		$rows= Yii::app()->db->createCommand($sql)->bindValue('id',$emp)->queryAll(); 
		return $rows;
	}
}