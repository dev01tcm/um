<?php

class MasLevelApp extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_position_le_app';
	}
	
	public function search($app) {
		$sql = "
		SELECT
			mas_position_le_app.id,
			mas_position_le_app.app_id,
			mas_position_le_app.level_id,
			mas_position_le.PositLevelNameTH,
			mas_position_le_app.status,
			mas_position_le_app.create_by,
			mas_position_le_app.create_date,
			mas_position_le_app.update_by,
			mas_position_le_app.update_date
		FROM
			mas_position_le_app
		INNER JOIN mas_position_le ON mas_position_le.PositLevelID = mas_position_le_app.level_id
		WHERE mas_position_le_app.app_id = ".$app." AND mas_position_le.StatusData = 1";
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_stat_all($app) {
		$conn = Yii::app()->db;
		
		$sql = "SELECT COUNT(*) AS cnt FROM mas_position_le_app WHERE app_id = ".$app." AND status = 1";
		
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_level_app($app) {
		$createby = Yii::app()->session['em_username'];
		
		$conn = Yii::app()->db;
		
		$sql = "SELECT * FROM mas_position_le ORDER BY PositLevelID";
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($rows as $dataitem) {
			$sql = "SELECT COUNT(id) AS ct FROM mas_position_le_app WHERE app_id = ".$app." AND level_id = ".$dataitem["PositLevelID"]." ORDER BY id ";
			$rowcount = Yii::app()->db->createCommand($sql)->queryAll();
			if ($rowcount[0]['ct'] == 0) {
				$sql = "INSERT INTO mas_position_le_app(app_id, level_id, status, create_by, create_date, update_by, update_date) VALUES(:app_id, :level_id, 1, '$createby', now(), '$createby', now())";
				$command = $conn->createCommand($sql);
				$command->bindValue(":app_id", $app);
				$command->bindValue(":level_id", $dataitem["PositLevelID"]);
				$command->execute();
			}
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public function save_change() {
		$createby = Yii::app()->session['em_username'];
		
		$sql = "update mas_position_le_app set status = ".$this->status.", update_date=now(), update_by='$createby' where id = ".$this->id;
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
		
		$sql = "update mas_position_le_app set status = ".$this->status.", update_date=now(), update_by='$createby' where app_id = ".$this->app;
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถแก้ไขข้อมูลได้'.$sql;
			return false;
		}
	}
}