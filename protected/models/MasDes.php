<?php

class MasDes extends CActiveRecord {
		
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_app';
	}
	
	public function rules() {
		return array(
            array('app_name_th, app_name_en, app_shortname, app_img, app_type, createby, updateby', 'required'),
            array('app_name_th', 'length', 'max'=>255),
            array('app_name_en, createby, updateby', 'length', 'max'=>100),
            array('app_shortname', 'length', 'max'=>50),
            array('app_img', 'length', 'max'=>100),
            array('app_type, app_status', 'length', 'max'=>10),
            array('updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
        	array('createdate,updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
            array('app_id, app_name_th, app_name_en, app_shortname, app_img, app_type, app_status, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
		);
	}
	
	public $app_id;
	public $app_name_th;
	public $app_name_en;
	public $app_shortname;
	public $app_img;
	public function save_update_im() {
		try{
			$createby = 1;
			
			$conn = Yii::app()->db; 
			
			$transaction = $conn->beginTransaction();
			$sql = "UPDATE mas_app SET app_name_th=:app_name_th, app_name_en=:app_name_en ,app_shortname=:app_shortname, app_img=:app_img, app_contact=:app_contact, app_phone=:app_phone, updatedate=now(), updateby='$createby' WHERE app_id=:app_id";
			$command = $conn->createCommand($sql);
			$command->bindValue(":app_id", $this->app_id);
			$command->bindValue(":app_name_th", $this->app_name_th);
			$command->bindValue(":app_name_en", $this->app_name_en);
			$command->bindValue(":app_shortname", $this->app_shortname);
			$command->bindValue(":app_img", $this->app_img);
			$command->bindValue(":app_contact", $this->app_contact);
			$command->bindValue(":app_phone", $this->app_phone);
			$command->execute();
			
			$transaction->commit();
			return true;
		}catch (Exception $e) {
			$transaction->rollBack();
			Yii::app()->session['msg']='error : '.$e->getMessage();
			return false;
		}
	}
	
		public function save_update_noim() {
		try{
			$createby = 1;
			
			$conn = Yii::app()->db; 
			
			$transaction = $conn->beginTransaction();
			$sql = "UPDATE mas_app SET app_name_th=:app_name_th, app_name_en=:app_name_en ,app_shortname=:app_shortname, app_contact=:app_contact, app_phone=:app_phone, updatedate=now(), updateby='$createby' WHERE app_id=:app_id";
			$command = $conn->createCommand($sql);
			$command->bindValue(":app_id", $this->app_id);
			$command->bindValue(":app_name_th", $this->app_name_th);
			$command->bindValue(":app_name_en", $this->app_name_en);
			$command->bindValue(":app_shortname", $this->app_shortname);
			$command->bindValue(":app_contact", $this->app_contact);
			$command->bindValue(":app_phone", $this->app_phone);
			$command->execute();
			
			$transaction->commit();
			return true;
		}catch (Exception $e) {
			$transaction->rollBack();
			Yii::app()->session['msg']='error : '.$e->getMessage();
			return false;
		}
	}
}