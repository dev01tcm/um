<?php

class MasObjective extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_objective';
	}
	
	public function rules() {
		return array(
			array('ob_name, app_id, createby, updateby', 'required'),
			array('ob_name', 'length', 'max'=>255),
			array('app_id', 'length', 'max'=>11),
			array('updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
			array('createdate,updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			array('ob_id, ob_name, app_id, ob_status, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
		);
	}
	
	public function search() {
		$criteria=new CDbCriteria;
		
		$criteria->compare('ob_id',$this->ob_id);
		$criteria->compare('ob_name',$this->ob_name,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('ob_status',$this->ob_status,true);
		$criteria->compare('createby',$this->createby,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('updateby',$this->updateby,true);
		$criteria->compare('updatedate',$this->updatedate,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
//-----------------------------------------------------------------------------------------------------------------
	public $id;
	public $name;
	public function save_insert() {
		try{
			$createby = Yii::app()->session['em_username'];
			
			$conn = Yii::app()->db; 
			
			$transaction = $conn->beginTransaction();
			$sql = "
			INSERT INTO mas_objective (ob_name, app_id, createby, createdate, updateby, updatedate)
			VALUES (:name, :app_id, '$createby', now(), '$createby', now())
			";
			$command = $conn->createCommand($sql);
			$command->bindValue(":name", $this->name);
			$command->bindValue(":app_id", $this->app_id);
			$command->execute();
			
			$transaction->commit();
			return true;
		}catch (Exception $e) {
			$transaction->rollBack();
			Yii::app()->session['errmsg']='error : '.$e->getMessage();
			return false;
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public function save_update() {
		try{
			$createby = Yii::app()->session['em_username'];
			
			$conn = Yii::app()->db; 
			
			$transaction = $conn->beginTransaction();
			$sql = "UPDATE mas_objective SET ob_name=:name, updatedate=now(), updateby='$createby' WHERE ob_id=:id";
			$command = $conn->createCommand($sql);
			$command->bindValue(":id", $this->id);
			$command->bindValue(":name", $this->name);
			$command->execute();
			
			$transaction->commit();
			return true;
		}catch (Exception $e) {
			$transaction->rollBack();
			Yii::app()->session['errmsg']='error : '.$e->getMessage();
			return false;
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public function save_delete() {
		$createby = Yii::app()->session['em_username'];
		
		$sql = "update mas_objective set ob_status=0, updatedate=now(), updateby='$createby' where ob_id = '".$this->id."'";
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถลบข้อมูลได้'.$sql;
			return false;
		}
	}
}