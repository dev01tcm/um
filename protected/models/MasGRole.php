<?php

class MasGRole extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_grole';
	}
	
	public function rules() {
		return array(
			array('ra_code','app_id, ra_name, ,ra_description, create_by, update_by', 'required'),
			array('ra_code', 'length', 'max'=>100),
			array('app_id', 'length', 'max'=>11),
			array('ra_name', 'length', 'max'=>255),
			array('ra_description', 'length', 'max'=>255),
			array('update_date','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
			array('create_date, update_date','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			array('ra_id, app_id, ma_name, ra_description, status, create_by, create_date, update_by, update_date', 'safe', 'on'=>'search'),
		);
	}
	
	public function search() {
		$criteria=new CDbCriteria;
		
		$criteria->compare('ra_id',$this->ma_id);
		$criteria->compare('ra_code',$this->ra_code,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('ra_name',$this->ma_name,true);
		$criteria->compare('ra_description',$this->ma_description,true);
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
			INSERT INTO mas_grole (ra_code, app_id, ra_name, ra_description, create_by, create_date, update_by, update_date)
			VALUES (:ra_code, :app_id, :ma_name, :descri, '$createby', now(), '$createby', now())
			";
			$command = $conn->createCommand($sql);
			$command->bindValue(":ra_code", $this->code);
			$command->bindValue(":app_id", $this->app_id);
			$command->bindValue(":ma_name", $this->name);
			$command->bindValue(":descri", $this->descri);
			$command->bindValue(":app_id", $this->app_id);
			$command->execute();
			
			$sql2 = " SELECT ra_id FROM mas_grole ORDER BY ra_id DESC LIMIT 1 ";
			$rows = Yii::app()->db->createCommand($sql2)->queryAll();
			foreach ($rows as $dataitem){
				$r1 = MasGroleMod::check_gor($dataitem["ra_id"],$this->app_id);
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
			$sql = "UPDATE mas_grole SET ra_code=:ra_code, app_id=:app_id, ra_name=:ma_name, ra_description=:descri, update_date=now(), update_by='$createby' WHERE ra_id=:id";
			$command = $conn->createCommand($sql);
			$command->bindValue(":id", $this->id);
			$command->bindValue(":ra_code", $this->code);
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
		
		$sql = "update mas_grole set status=0, update_date=now(), update_by='$createby' where ra_id = '".$this->id."'";
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถลบข้อมูลได้'.$sql;
			return false;
		}
	}
}