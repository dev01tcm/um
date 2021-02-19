<?php

class MasDepartmentRol extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_department_rol';
	}
	
	public function search($rol) {
		$sql = "
		SELECT
			mas_department_rol.id,
			mas_department_rol.rol_id,
			mas_department_rol.dp_id,
			mas_department.DeptID,
			mas_department.DeptNameTH,
			mas_department_rol.status,
			mas_department_rol.create_by,
			mas_department_rol.create_date,
			mas_department_rol.update_by,
			mas_department_rol.update_date
		FROM
			mas_department_rol
		INNER JOIN mas_department ON mas_department.dp_id = mas_department_rol.dp_id
		WHERE mas_department_rol.rol_id = ".$rol." AND mas_department.StatusData = 1";
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_department_rol($rol) {
		$createby = Yii::app()->session['em_username'];
		
		$conn = Yii::app()->db;
		
		$sql = "SELECT * FROM mas_department ORDER BY DeptID";
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($rows as $dataitem) {
			$sql = "SELECT COUNT(id) AS ct FROM mas_department_rol WHERE rol_id = ".$rol." AND dp_id = ".$dataitem["dp_id"]." order by id ";
			$rowcount = Yii::app()->db->createCommand($sql)->queryAll();
			if ($rowcount[0]['ct'] == 0) {
				$sql = "INSERT INTO mas_department_rol(rol_id, dp_id, status, create_by, create_date, update_by, update_date) VALUES(:rol_id, :dp_id, 1, '$createby', now(), '$createby', now())";
				$command = $conn->createCommand($sql);
				$command->bindValue(":rol_id", $rol);
				$command->bindValue(":dp_id", $dataitem["dp_id"]);
				$command->execute();
			}
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public function save_change() {
		$createby = Yii::app()->session['em_username'];
		
		$sql = "update mas_department_rol set status = ".$this->status.", update_date=now(), update_by='$createby' where id = ".$this->id;
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
		
		$sql = "update mas_department_rol set status = ".$this->status.", update_date=now(), update_by='$createby' where rol_id = ".$this->rol;
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถแก้ไขข้อมูลได้'.$sql;
			return false;
		}
	}
}