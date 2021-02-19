<?php

class MasRoleMod extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_role_mod';
	}
		
	public function search($mod) {
		$sql = "
		SELECT
			mas_role_mod.id,
			mas_role_mod.mod_id,
			mas_role_app.ra_code,
			mas_role_mod.ra_id,
			mas_role_app.ra_name,
			mas_role_mod.ra_default,
			mas_role_mod.status,
			mas_role_mod.create_by,
			mas_role_mod.create_date,
			mas_role_mod.update_by,
			mas_role_mod.update_date
		FROM
			mas_role_mod
		INNER JOIN mas_role_app ON mas_role_app.ra_id = mas_role_mod.ra_id
		WHERE mas_role_mod.mod_id = ".$mod." AND mas_role_app.status = 1";
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_stat_all($mod) {
		$conn = Yii::app()->db;
		
		$sql = "SELECT COUNT(*) AS cnt FROM mas_role_mod WHERE mod_id = ".$mod." AND status = 1";
		
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_def_all($mod) {
		$conn = Yii::app()->db;
		
		$sql = "SELECT COUNT(*) AS cnt FROM mas_role_mod WHERE mod_id = ".$mod." AND ra_default = 1";
		
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_role_mod($app,$mod) {
		$createby = Yii::app()->session['em_username'];
		
		$conn = Yii::app()->db;
		
		$sql = "SELECT * FROM mas_role_app WHERE app_id = ".$app." ORDER BY ra_id";
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($rows as $dataitem) {
			$sql = "SELECT COUNT(id) AS ct FROM mas_role_mod WHERE mod_id = ".$mod." AND ra_id = ".$dataitem["ra_id"]." ORDER BY id";
			$rowcount = Yii::app()->db->createCommand($sql)->queryAll();
			if ($rowcount[0]['ct'] == 0) {
				$sql = "INSERT INTO mas_role_mod(mod_id, ra_id, ra_default, create_by, create_date, update_by, update_date) VALUES(:mod_id, :ra_id ,0, '$createby', now(), '$createby', now())";
				$command = $conn->createCommand($sql);
				$command->bindValue(":mod_id", $mod);
				$command->bindValue(":ra_id", $dataitem["ra_id"]);
				$command->execute();
			}
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public $modid;
	public $sw_array;
	public $sw_status_array;
	public $df_id;
	public function savedata() {
		$createby = Yii::app()->session['em_username'];
		
		$conn = Yii::app()->db;
		
		$sql = "UPDATE mas_role_mod SET ra_default = 0 WHERE mod_id = ".$this->modid;
		$command = $conn->createCommand($sql);
		$command->execute();
		
		$sql = "UPDATE mas_role_mod SET ra_default = 1 WHERE id = ".$this->df_id;
		$command = $conn->createCommand($sql);
		$command->execute();
		
		for ($i = 1; $i <= count($this->sw_array); $i++) {
			$sql = "UPDATE mas_role_mod SET status = ".$this->sw_status_array[$i - 1]." WHERE id = ".$this->sw_array[$i - 1];
			$command = $conn->createCommand($sql);
			$command->execute();
		}
	}
}