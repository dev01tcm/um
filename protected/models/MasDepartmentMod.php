<?php

class MasDepartmentMod extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_department_mod';
	}
	
	public function search($mod) {
		$sql = "
		SELECT
			mas_department_mod.id,
			mas_department_mod.mod_id,
			mas_department_mod.dp_id,
			mas_department.DeptID,
			mas_department.DeptNameTH,
			mas_department_mod.status,
			mas_department_mod.create_by,
			mas_department_mod.create_date,
			mas_department_mod.update_by,
			mas_department_mod.update_date
		FROM
			mas_department_mod
		INNER JOIN mas_department ON mas_department.dp_id = mas_department_mod.dp_id
		WHERE mas_department_mod.mod_id = ".$mod." AND mas_department.StatusData = 1";
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_stat_all($mod) {
		$conn = Yii::app()->db;
		
		$sql = "SELECT COUNT(*) AS cnt FROM mas_department_mod WHERE mod_id = ".$mod." AND status = 1";
		
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_department_mod($mod) {
		$createby = Yii::app()->session['em_username'];
		
		$conn = Yii::app()->db;
		
		$sql = "SELECT * FROM mas_department ORDER BY DeptID";
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($rows as $dataitem) {
			$sql = "SELECT COUNT(id) AS ct FROM mas_department_mod WHERE mod_id = ".$mod." AND dp_id = ".$dataitem["dp_id"]." order by id ";
			$rowcount = Yii::app()->db->createCommand($sql)->queryAll();
			if ($rowcount[0]['ct'] == 0) {
				$sql = "INSERT INTO mas_department_mod(mod_id, dp_id, status, create_by, create_date, update_by, update_date) VALUES(:mod_id, :dp_id, 1, '$createby', now(), '$createby', now())";
				$command = $conn->createCommand($sql);
				$command->bindValue(":mod_id", $mod);
				$command->bindValue(":dp_id", $dataitem["dp_id"]);
				$command->execute();
			}
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public function save_change() {
		$createby = Yii::app()->session['em_username'];
		
		$sql = "update mas_department_mod set status = ".$this->status.", update_date=now(), update_by='$createby' where id = ".$this->id;
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถแก้ไขข้อมูลได้'.$sql;
			return false;
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public $mod;
	public function save_all() {
		$createby = Yii::app()->session['em_username'];
		
		$sql = "update mas_department_mod set status = ".$this->status.", update_date=now(), update_by='$createby' where mod_id = ".$this->mod;
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถแก้ไขข้อมูลได้'.$sql;
			return false;
		}
	}
}