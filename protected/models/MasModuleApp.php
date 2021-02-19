<?php

class MasModuleApp extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_module_app';
	}
	
	public function rules() {
		return array(
			array('ma_code','app_id, ma_name, ,ma_description, create_by, update_by', 'required'),
			array('ma_code', 'length', 'max'=>100),
			array('app_id', 'length', 'max'=>11),
			array('ma_name', 'length', 'max'=>255),
			array('ma_description', 'length', 'max'=>255),
			array('update_date','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
			array('create_date, update_date','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			array('ma_id, app_id, ma_name, ma_description, status, create_by, create_date, update_by, update_date', 'safe', 'on'=>'search'),
		);
	}
	
	public function search() {
		$criteria=new CDbCriteria;
		
		$criteria->compare('ma_id',$this->ma_id);
		$criteria->compare('ma_code',$this->ma_code,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('ma_name',$this->ma_name,true);
		$criteria->compare('ma_description',$this->ma_description,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_by',$this->create_by,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_by',$this->update_by,true);
		$criteria->compare('update_date',$this->update_date,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
//-----------------------------------------------------------------------------------------------------------------
	public $id;
	public $code;
	public $app_id;
	public $name;
	public $descri;
	public function save_insert() {
		try{
			$createby = Yii::app()->session['em_username'];
			
			$conn = Yii::app()->db; 
			
			$transaction = $conn->beginTransaction();
			$sql = "
			INSERT INTO mas_module_app (ma_code, app_id, ma_name, ma_description, create_by, create_date, update_by, update_date)
			VALUES (:ma_code, :app_id, :ma_name, :descri, '$createby', now(), '$createby', now())
			";
			$command = $conn->createCommand($sql);
			$command->bindValue(":ma_code", $this->code);
			$command->bindValue(":app_id", $this->app_id);
			$command->bindValue(":ma_name", $this->name);
			$command->bindValue(":descri", $this->descri);
			$command->bindValue(":app_id", $this->app_id);
			$command->execute();
			
			$sql2 = " SELECT ma_id FROM mas_module_app ORDER BY ma_id DESC LIMIT 1 ";
			$rows = Yii::app()->db->createCommand($sql2)->queryAll();
			foreach ($rows as $dataitem){
				$r1 = MasPositionMod::check_position_mod($dataitem["ma_id"]);
				$r2 = MasLevelMod::check_level_mod($dataitem["ma_id"]);
				$r3 = MasDepartmentMod::check_department_mod($dataitem["ma_id"]);
			}
			
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
			$sql = "UPDATE mas_module_app SET ma_code=:ma_code, app_id=:app_id, ma_name=:ma_name, ma_description=:descri, update_date=now(), update_by='$createby' WHERE ma_id=:id";
			$command = $conn->createCommand($sql);
			$command->bindValue(":id", $this->id);
			$command->bindValue(":ma_code", $this->code);
			$command->bindValue(":app_id", $this->app_id);
			$command->bindValue(":ma_name", $this->name);
			$command->bindValue(":descri", $this->descri);
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
			
		$sql = "update mas_module_app set status=0, update_date=now(), update_by='$createby' where ma_id = '".$this->id."'";
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถลบข้อมูลได้'.$sql;
			return false;
		}
	}
}