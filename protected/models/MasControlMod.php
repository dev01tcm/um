<?php

class MasControlMod extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_control_mod';
	}
	
	public function rules() {
		return array(
			array('ct_type, ct_name, ct_check, ct_order, app_id, createby, updateby', 'required'),
			array('ct_type', 'length', 'max'=>255),
			array('ct_name', 'length', 'max'=>255),
			array('ct_check', 'length', 'max'=>255),
			array('ct_order', 'length', 'max'=>255),
			array('app_id', 'length', 'max'=>11),
			array('updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
			array('createdate,updatedate','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			array('ct_id, ct_type, ct_name, ct_check, ct_order, app_id, createby, createdate, updateby, updatedate', 'safe', 'on'=>'search'),
		);
	}
	
	public function search() {
		$criteria=new CDbCriteria;
		
		$criteria->compare('ct_id',$this->ct_id);
		$criteria->compare('ct_type',$this->ct_type,true);
		$criteria->compare('ct_name',$this->ct_name,true);
		$criteria->compare('ct_check',$this->ct_check,true);
		$criteria->compare('ct_order',$this->ct_order,true);
		$criteria->compare('ct_status',$this->ob_status,true);
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
	public $type;
	public $name;
	public $check;
	public $order;
	public function save_insert() {
		try{
			$createby = Yii::app()->session['em_username'];
			
			$conn = Yii::app()->db; 
			
			$transaction = $conn->beginTransaction();
			$sql = "
			INSERT INTO mas_control_mod (ct_type, ct_name, ct_check, ct_order, mod_id, createby, createdate, updateby, updatedate)
			VALUES (:type, :name, :check, :order, :mod_id, '$createby', now(), '$createby', now())
			";
			$command = $conn->createCommand($sql);
			$command->bindValue(":type", $this->type);
			$command->bindValue(":name", $this->name);
			$command->bindValue(":check", $this->check);
			$command->bindValue(":order", $this->order);
			$command->bindValue(":mod_id", $this->mod_id);
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
			$sql = "UPDATE mas_control_mod SET ct_type=:type ,ct_name=:name, ct_check=:check, updatedate=now(), updateby='$createby' WHERE ct_id=:id";
			$command = $conn->createCommand($sql);
			$command->bindValue(":id", $this->id);
			$command->bindValue(":type", $this->type);
			$command->bindValue(":name", $this->name);
			$command->bindValue(":check", $this->check);
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
			
		$sql = "update mas_control_mod set ct_status=0, updatedate=now(), updateby='$createby' where ct_id = '".$this->id."'";
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถลบข้อมูลได้'.$sql;
			return false;
		}
	}
}