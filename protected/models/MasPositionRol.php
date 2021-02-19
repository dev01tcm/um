<?php

class MasPositionRol extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_position_rol';
	}
	
	public function search($rol) {
		$sql = "
		SELECT
			mas_position_rol.id,
			mas_position_rol.rol_id,
			mas_position_rol.pos_id,
			mas_position.PositNameTH,
			mas_position_rol.status,
			mas_position_rol.create_by,
			mas_position_rol.create_date,
			mas_position_rol.update_by,
			mas_position_rol.update_date
		FROM
			mas_position_rol
		INNER JOIN mas_position ON mas_position.PositID = mas_position_rol.pos_id
		WHERE mas_position_rol.rol_id = ".$rol." AND mas_position.StatusData = 1";
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_position_rol($rol) {
		$createby = Yii::app()->session['em_username'];
			
		$conn = Yii::app()->db;
		
		$sql = "SELECT * FROM mas_position ORDER BY PositID";
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($rows as $dataitem) {
			$sql = "SELECT COUNT(id) AS ct FROM mas_position_rol WHERE rol_id = ".$rol." AND pos_id = ".$dataitem["PositID"]." order by id ";
			$rowcount = Yii::app()->db->createCommand($sql)->queryAll();
			if ($rowcount[0]['ct'] == 0) {
				$sql = "INSERT INTO mas_position_rol(rol_id, pos_id, status, create_by, create_date, update_by, update_date) VALUES(:rol_id, :pos_id, 1, '$createby', now(), '$createby', now())";
				$command = $conn->createCommand($sql);
				$command->bindValue(":rol_id", $rol);
				$command->bindValue(":pos_id", $dataitem["PositID"]);
				$command->execute();
			}
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public function save_change() {
		$createby = Yii::app()->session['em_username'];
		
		$sql = "update mas_position_rol set status = ".$this->status.", update_date=now(), update_by='$createby' where id = ".$this->id;
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถแก้ไขข้อมูลได้'.$sql;
			return false;
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public $rol;
	public function save_all() {
		$createby = Yii::app()->session['em_username'];
		
		$sql = "update mas_position_rol set status = ".$this->status.", update_date=now(), update_by='$createby' where rol_id = ".$this->rol;
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถแก้ไขข้อมูลได้'.$sql;
			return false;
		}
	}
}