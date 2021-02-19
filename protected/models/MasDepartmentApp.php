<?php

class MasDepartmentApp extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_department_app';
	}
	
	public function search($app) {
		$sql = "
		SELECT
			mas_department_app.id,
			mas_department_app.app_id,
			mas_department_app.dp_id,
			mas_department.DeptID,
			mas_department.DeptNameTH,
			mas_department_app.status,
			mas_department_app.create_by,
			mas_department_app.create_date,
			mas_department_app.update_by,
			mas_department_app.update_date
		FROM
			mas_department_app
		INNER JOIN mas_department ON mas_department.dp_id = mas_department_app.dp_id
		WHERE mas_department_app.app_id = ".$app." AND mas_department.StatusData = 1";
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_stat_all($app) {
		$conn = Yii::app()->db;
		
		$sql = "SELECT COUNT(*) AS cnt FROM mas_department_app WHERE app_id = ".$app." AND status = 1";
		
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_department_app($app) {
		$createby = Yii::app()->session['em_username'];
		
		$conn = Yii::app()->db;
		
		$sql = "SELECT * FROM mas_department ORDER BY DeptID";
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($rows as $dataitem) {
			$sql = "SELECT COUNT(id) AS ct FROM mas_department_app WHERE app_id = ".$app." AND dp_id = ".$dataitem["dp_id"]." order by id ";
			$rowcount = Yii::app()->db->createCommand($sql)->queryAll();
			if ($rowcount[0]['ct'] == 0) {
				$sql = "INSERT INTO mas_department_app(app_id, dp_id, status, create_by, create_date, update_by, update_date) VALUES(:app_id, :dp_id, 1, '$createby', now(), '$createby', now())";
				$command = $conn->createCommand($sql);
				$command->bindValue(":app_id", $app);
				$command->bindValue(":dp_id", $dataitem["dp_id"]);
				$command->execute();
			}
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public function save_change() {
		$createby = Yii::app()->session['em_username'];
		
		$sql = "update mas_department_app set status = ".$this->status.", update_date=now(), update_by='$createby' where id = ".$this->id;
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถแก้ไขข้อมูลได้'.$sql;
			return false;
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public $app;
	public function save_all() {
		$createby = Yii::app()->session['em_username'];
		
		$sql = "update mas_department_app set status = ".$this->status.", update_date=now(), update_by='$createby' where app_id = ".$this->app;
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถแก้ไขข้อมูลได้'.$sql;
			return false;
		}
	}
}