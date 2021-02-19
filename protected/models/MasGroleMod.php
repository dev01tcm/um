<?php

class MasGroleMod extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_grole_mod';
	}
	
	public function search($rol) {
		$sql = "
			SELECT
				mas_grole_mod.id,
				mas_grole_mod.rol_id,
				mas_grole_mod.ver_no,
				mas_grole_mod.mod_id,
				mas_module_app.ma_code,
				mas_module_app.ma_name,
				mas_grole_mod.status,
				mas_grole_mod.create_by,
				mas_grole_mod.create_date,
				mas_grole_mod.update_by,
				mas_grole_mod.update_date,
				mas_version.status AS ver_status
			FROM
				mas_grole_mod
				INNER JOIN mas_module_app ON mas_module_app.ma_id = mas_grole_mod.mod_id
				INNER JOIN mas_version ON mas_version.grm_id = mas_grole_mod.rol_id AND mas_version.ver_no = mas_grole_mod.ver_no
			WHERE
				mas_grole_mod.rol_id = ".$rol." AND
				mas_module_app.status = 1 AND
				mas_version.status = 1
		";

		// var_dump($sql);
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_stat_all($rol_id) {
		$conn = Yii::app()->db;
		
		$sql = "SELECT COUNT(*) AS cnt FROM mas_grole_mod WHERE rol_id = ".$rol_id." AND status = 1";
		
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_gor($rol,$app) {
		$createby = Yii::app()->session['em_username'];
		
		$conn = Yii::app()->db;
		
		$sql = "SELECT COUNT(ver_id) AS ct FROM mas_version WHERE grm_id = ".$rol;
		$rowcount02 = Yii::app()->db->createCommand($sql)->queryAll();
		if ($rowcount02[0]['ct'] == 0) {
			$sql = "INSERT INTO mas_version(ver_no, grm_id, status, create_by, create_date, update_by, update_date) VALUES(0, :grm_id, 1, '$createby', now(), '$createby', now())";
			$command = $conn->createCommand($sql);
			$command->bindValue(":grm_id", $rol);
			$command->execute();
		}
		if($rowcount02[0]['ct'] == 0){
			$ver = $rowcount02[0]['ct'];
		}
		
		$sql = "SELECT * FROM mas_module_app WHERE app_id = ".$app." AND status = 1 ORDER BY ma_id";
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($rows as $dataitem) {
			$sql = "SELECT COUNT(id) AS ct FROM mas_grole_mod WHERE rol_id = ".$rol." AND mod_id = ".$dataitem["ma_id"];
			$rowcount = Yii::app()->db->createCommand($sql)->queryAll();
			if ($rowcount[0]['ct'] == 0) {
				$sql = "INSERT INTO mas_grole_mod(rol_id, mod_id, ver_no, status, create_by, create_date, update_by, update_date) VALUES(:rol_id, :mod_id, :ver_no, 1, '$createby', now(), '$createby', now())";
				$command = $conn->createCommand($sql);
				$command->bindValue(":rol_id", $rol);
				$command->bindValue(":mod_id", $dataitem["ma_id"]);
				$command->bindValue(":ver_no", $ver);
				$command->execute();
				
				$sql2 = " SELECT id FROM mas_grole_mod WHERE rol_id = ".$rol." AND mod_id = ".$dataitem["ma_id"]." ORDER BY rol_id DESC";
				$rows = Yii::app()->db->createCommand($sql2)->queryAll();
				foreach ($rows as $dataitem03){
					$sql = "SELECT * FROM mas_role_app WHERE app_id = ".$app." AND status = 1 ORDER BY ra_id";
					$rows = Yii::app()->db->createCommand($sql)->queryAll();
					foreach ($rows as $dataitem04) {
						$sql = "SELECT COUNT(id) AS ct_status FROM mas_grole_mod_rlevel WHERE grm_id = ".$dataitem03["id"]." AND status = 1 AND ver_no = ".$ver." order by id";
						$rowcount2 = Yii::app()->db->createCommand($sql)->queryAll();
						if ($rowcount2[0]['ct_status'] == 0) {
							$status = "1";
						}else{
							$status = "0";
						}
						
						$sql = "SELECT COUNT(id) AS ct FROM mas_grole_mod_rlevel WHERE grm_id = ".$dataitem03["id"]." AND rol_id = ".$dataitem04["ra_id"]." order by id";
						$rowcount = Yii::app()->db->createCommand($sql)->queryAll();
						// var_dump($sql);
						if ($rowcount[0]['ct'] == 0) {
							$sql = "INSERT INTO mas_grole_mod_rlevel(grm_id, rol_id, ver_no, status, create_by, create_date, update_by, update_date) VALUES(:grm_id, :rol_id, :ver_no, :status, '$createby', now(), '$createby', now())";
							$command = $conn->createCommand($sql);
							$command->bindValue(":grm_id", $dataitem03["id"]);
							$command->bindValue(":rol_id", $dataitem04["ra_id"]);
							$command->bindValue(":ver_no", $ver);
							$command->bindValue(":status", $status);
							$command->execute();
						}
					}
				}
			}
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public function save_change() {
		$createby = Yii::app()->session['em_username'];
		
		$sql = "update mas_position_mod set status = ".$this->status.", update_date=now(), update_by='$createby' where id = ".$this->id;
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
		
		$sql = "update mas_position_mod set status = ".$this->status.", update_date=now(), update_by='$createby' where mod_id = ".$this->mod;
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
	public $ver_now;
	public $rol_id;
	public $mod_array;
	public $status_array;
	public $rol_array;
	public $mod_array2;
	public $status_array2;
	public function savedata() {
		$createby = Yii::app()->session['em_username'];
		$conn = Yii::app()->db;
		$transaction = $conn->beginTransaction();
		
		$app = $this->app;
		$ver_now = $this->ver_now;
		$rol_id = $this->rol_id;
		$sql = "UPDATE mas_version SET status = 0 WHERE grm_id = ".$this->rol_id;
		$command = $conn->createCommand($sql);
		$command->execute();
		
		$sql = "SELECT COUNT(ver_id) AS ct FROM mas_version WHERE grm_id = ".$this->rol_id;
		$rowcount02 = Yii::app()->db->createCommand($sql)->queryAll();
		$nver = $rowcount02[0]['ct'];
		
		$sql = "INSERT INTO mas_version(ver_no, grm_id, status, create_by, create_date, update_by, update_date) VALUES(:ver_no, :grm_id, 1, '$createby', now(), '$createby', now())";
		$command = $conn->createCommand($sql);
		$command->bindValue(":ver_no", $nver);
		$command->bindValue(":grm_id", $rol_id);
		$command->execute();
		
		$grm_id = array();
		$omod = array();
		// var_dump(count($this->mod_array));
		for ($i = 1; $i <= count($this->mod_array); $i++) {
			$sql = " INSERT INTO mas_grole_mod(rol_id, mod_id, ver_no, status, create_by, create_date, update_by, update_date)
				     VALUES(".$rol_id.", ".$this->mod_array[$i - 1].", ".$nver.", ".$this->status_array[$i - 1].", '$createby', now(), '$createby', now())";
			$command = $conn->createCommand($sql);
			$command->execute();
			
			$sql2 = " SELECT id, mod_id FROM mas_grole_mod WHERE rol_id = ".$rol_id." AND ver_no = ".$nver." ORDER BY id DESC LIMIT 1";
			// var_dump($sql2);
			$rows = Yii::app()->db->createCommand($sql2)->queryAll();
			foreach ($rows as $dataitem03){
				$id = $dataitem03["id"];
				$mod_id = $dataitem03["mod_id"];
				for ($i2 = 1; $i2 <= count($this->mod_array2); $i2++) {
					if($this->mod_array2[$i2 - 1] == $mod_id){
						$grm_id[] = $id;
						$omod[] = $mod_id;
					}
				}
			}
		}
		// var_dump($omod);
		for ($i2 = 1; $i2 <= count($this->mod_array2); $i2++) {
			$sql = " INSERT INTO mas_grole_mod_rlevel(grm_id, rol_id, ver_no, status, create_by, create_date, update_by, update_date)
					 VALUES(:grm_id, :rol_id, :ver_no, :status, '$createby', now(), '$createby', now())";
			var_dump($sql);
			$command = $conn->createCommand($sql);
			$command->bindValue(":grm_id", $grm_id[$i2 - 1]);
			$command->bindValue(":rol_id", $this->rol_array[$i2 - 1]);
			$command->bindValue(":status", $this->status_array2[$i2 - 1]);
			$command->bindValue(":ver_no", $nver);
			$command->execute();
		}
		
		/*$sql2 = " SELECT id, mod_id FROM mas_grole_mod WHERE rol_id = ".$rol_id." AND ver_no = ".$nver." ORDER BY id DESC LIMIT 1";
		$rows = Yii::app()->db->createCommand($sql2)->queryAll();
		foreach ($rows as $dataitem03){
			$grm_id = $dataitem03["id"];
			$mod_id = $dataitem03["mod_id"];
			
		}*/
		/*
		$sql2 = " SELECT id FROM mas_grole_mod WHERE rol_id = ".$rol_id." AND mod_id = ".$this->mod_array[$i - 1]." AND ver_no = ".$nver." ORDER BY rol_id DESC";
		$rows = Yii::app()->db->createCommand($sql2)->queryAll();
		foreach ($rows as $dataitem03){
			for ($i2 = 1; $i2 <= count($this->rol_array); $i2++) {
				$sql = "SELECT COUNT(id) AS ct FROM mas_grole_mod_rlevel WHERE grm_id = ".$dataitem03["id"]." AND rol_id = ".$this->rol_array[$i2 - 1]." order by id";
				$rowcount = Yii::app()->db->createCommand($sql)->queryAll();
				if ($rowcount[0]['ct'] == 0) {
					$sql = " INSERT INTO mas_grole_mod_rlevel(grm_id, rol_id, ver_no, status, create_by, create_date, update_by, update_date)
							 VALUES(:grm_id, :rol_id, :ver_no, :status, '$createby', now(), '$createby', now())";
					$command = $conn->createCommand($sql);
					$command->bindValue(":grm_id", $dataitem03["id"]);
					$command->bindValue(":rol_id", $this->rol_array[$i2 - 1]);
					$command->bindValue(":status", $this->status_array2[$i2 - 1]);
					$command->bindValue(":ver_no", $nver);
					$command->execute();
				}
			}
		}*/
		$transaction->commit();
		return true;
	}
}