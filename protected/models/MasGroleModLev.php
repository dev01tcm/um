<?php

class MasGroleModLev extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_grole_mod_rlevel';
	}
//-----------------------------------------------------------------------------------------------------------------
	public function search($grm_id) {
		$sql = "
			SELECT
				mas_grole_mod_rlevel.id,
				mas_grole_mod_rlevel.ver_no,
				mas_grole_mod_rlevel.grm_id,
				mas_grole_mod.mod_id,
				mas_grole_mod_rlevel.rol_id,
				mas_role_app.ra_code,
				mas_role_app.ra_name,
				mas_grole_mod_rlevel.status,
				mas_grole_mod_rlevel.create_by,
				mas_grole_mod_rlevel.create_date,
				mas_grole_mod_rlevel.update_by,
				mas_grole_mod_rlevel.update_date,
				mas_role_mod.status AS lev_status
			FROM
				mas_grole_mod_rlevel
				INNER JOIN mas_grole_mod ON mas_grole_mod.id = mas_grole_mod_rlevel.grm_id
				INNER JOIN mas_role_app ON mas_role_app.ra_id = mas_grole_mod_rlevel.rol_id
				INNER JOIN mas_role_mod ON mas_role_app.ra_id = mas_role_mod.ra_id AND mas_grole_mod.mod_id = mas_role_mod.mod_id
			WHERE
				mas_grole_mod_rlevel.grm_id = ".$grm_id." AND
				mas_role_app.status = 1 AND
				mas_role_mod.status = 1
		";
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function searchversion($grm_id) {
		$sql = "
			SELECT
				mas_version.ver_id,
				mas_version.ver_no,
				mas_version.grm_id,
				mas_version.update_date,
				mas_version.update_by,
				um_employee.em_name_th,
				um_employee.em_surname_th,
				mas_version.status
			FROM
				mas_version
				INNER JOIN um_employee ON um_employee.em_username = mas_version.update_by
			WHERE
				mas_version.grm_id = ".$grm_id."
		";
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function checkversion($rol,$ver) {
		$sql = "
			SELECT
				mas_grole_mod_rlevel.id,
				mas_grole_mod_rlevel.ver_no,
				mas_grole_mod_rlevel.grm_id,
				mas_grole_mod.mod_id,
				mas_module_app.ma_code,
				mas_module_app.ma_name,
				mas_grole_mod_rlevel.rol_id,
				mas_role_app.ra_code,
				mas_role_app.ra_name
			FROM
				mas_grole_mod_rlevel
				INNER JOIN mas_grole_mod ON mas_grole_mod.id = mas_grole_mod_rlevel.grm_id
				INNER JOIN mas_role_app ON mas_role_app.ra_id = mas_grole_mod_rlevel.rol_id
				INNER JOIN mas_role_mod ON mas_role_app.ra_id = mas_role_mod.ra_id AND mas_grole_mod.mod_id = mas_role_mod.mod_id
				INNER JOIN mas_module_app ON mas_module_app.ma_id = mas_role_mod.mod_id
			WHERE
				mas_grole_mod.rol_id = ".$rol." AND
				mas_role_app.status = 1 AND
				mas_role_mod.status = 1 AND
				mas_grole_mod_rlevel.status = 1 AND
				mas_grole_mod_rlevel.ver_no = ".$ver."
			ORDER BY
				mas_role_mod.mod_id ASC,
				mas_grole_mod_rlevel.grm_id ASC
		";
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_stat_all($grm) {
		$conn = Yii::app()->db;
		
		$sql = "
			SELECT
				COUNT(*) AS cnt 
			FROM
				mas_grole_mod_rlevel
				INNER JOIN mas_grole_mod ON mas_grole_mod.id = mas_grole_mod_rlevel.grm_id
				INNER JOIN mas_role_app ON mas_role_app.ra_id = mas_grole_mod_rlevel.rol_id
				INNER JOIN mas_role_mod ON mas_role_app.ra_id = mas_role_mod.ra_id AND mas_grole_mod.mod_id = mas_role_mod.mod_id
			WHERE
				mas_grole_mod_rlevel.grm_id = ".$grm." AND
				mas_role_app.status = 1 AND
				mas_role_mod.status = 1
		";
		
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_gor($id,$app,$ver) {
		$createby = Yii::app()->session['em_username'];
		$conn = Yii::app()->db;
		
		$sql = "SELECT * FROM mas_role_app WHERE app_id = ".$app." AND status = 1 ORDER BY ra_id";
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($rows as $dataitem) {
			$sql = "SELECT COUNT(id) AS ct_status FROM mas_grole_mod_rlevel WHERE grm_id = ".$id." AND status = 1 AND ver_no = ".$ver." order by id";
			$rowcount2 = Yii::app()->db->createCommand($sql)->queryAll();
			if ($rowcount2[0]['ct_status'] == 0) {
				$status = "1";
			}else{
				$status = "0";
			}
				
			$sql = "SELECT COUNT(id) AS ct FROM mas_grole_mod_rlevel WHERE grm_id = ".$id." AND rol_id = ".$dataitem["ra_id"]." AND ver_no = ".$ver." order by id";
			$rowcount = Yii::app()->db->createCommand($sql)->queryAll();
			if ($rowcount[0]['ct'] == 0) {
				$sql = "INSERT INTO mas_grole_mod_rlevel(grm_id, rol_id, ver_no, status, create_by, create_date, update_by, update_date) VALUES(:grm_id, :rol_id, :ver_no, :status, '$createby', now(), '$createby', now())";
				$command = $conn->createCommand($sql);
				$command->bindValue(":grm_id", $id);
				$command->bindValue(":rol_id", $dataitem["ra_id"]);
				$command->bindValue(":ver_no", $ver);
				$command->bindValue(":status", $status);
				$command->execute();
			}
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public function save_change() {
		$createby = Yii::app()->session['em_username'];
		
		$sql = "update mas_grole_mod_rlevel set status = ".$this->status.", update_date=now(), update_by='$createby' where id = ".$this->id;
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถแก้ไขข้อมูลได้'.$sql;
			return false;
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public $grm;
	public function save_all() {
		$createby = Yii::app()->session['em_username'];
		
		$sql = "update mas_grole_mod_rlevel set status = ".$this->status.", update_date=now(), update_by='$createby' where grm_id = ".$this->grm;
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
			return true;
		} else {
			Yii::app()->session['errmsg_user']='ไม่สามารถแก้ไขข้อมูลได้'.$sql;
			return false;
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getnowver($grm_id) {
		$sql  = "SELECT ver_no FROM mas_version WHERE status = 1 AND grm_id = ".$grm_id;
		$rows = Yii::app()->db->createCommand($sql)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public $grm_id;
	public $ver;
	public $mod;
	public $rol_array;
	public $status_array;
	public $mod_array;
	public $status_mo_array;
	public function savedata() {
		$createby = Yii::app()->session['em_username'];
		$conn = Yii::app()->db;
		$transaction = $conn->beginTransaction();
		
		$grm_id = $this->grm_id;
		$mod = $this->mod;
		$sql = "UPDATE mas_version SET status = 0 WHERE grm_id = ".$this->rol_id;
		$command = $conn->createCommand($sql);
		$command->execute();
		
		$sql = "SELECT COUNT(ver_id) AS ct FROM mas_version WHERE grm_id = ".$this->rol_id;
		$rowcount02 = Yii::app()->db->createCommand($sql)->queryAll();
		$nver = $rowcount02[0]['ct'];
		
		$sql = "INSERT INTO mas_version(ver_no, grm_id, status, create_by, create_date, update_by, update_date) VALUES(:ver_no, :grm_id, 1, '$createby', now(), '$createby', now())";
		$command = $conn->createCommand($sql);
		$command->bindValue(":ver_no", $nver);
		$command->bindValue(":grm_id", $this->rol_id);
		$command->execute();
		
		for ($i = 1; $i <= count($this->mod_array); $i++) {
			$sql = " INSERT INTO mas_grole_mod(rol_id, mod_id, ver_no, status, create_by, create_date, update_by, update_date)
				     VALUES(".$this->rol_id.", ".$this->mod_array[$i - 1].", ".$nver.", ".$this->status_mo_array[$i - 1].", '$createby', now(), '$createby', now())";
			$command = $conn->createCommand($sql);
			$command->execute();
			
			/*$sql2 = " SELECT id FROM mas_grole_mod WHERE rol_id = ".$this->rol_id." AND mod_id = ".$this->mod_array[$i - 1]." AND ver_no = ".$nver." ORDER BY rol_id DESC";
			$rows = Yii::app()->db->createCommand($sql2)->queryAll();
			foreach ($rows as $dataitem03){
				if($mod != $this->mod_array[$i - 1]){
					$sql = "
						SELECT
							mas_grole_mod_rlevel.id,
							mas_grole_mod_rlevel.ver_no,
							mas_grole_mod_rlevel.grm_id,
							mas_role_mod.ra_id,
							mas_grole_mod.mod_id,
							mas_grole_mod_rlevel.rol_id,
							mas_role_app.ra_code,
							mas_role_app.ra_name,
							mas_grole_mod_rlevel.status,
							mas_grole_mod_rlevel.create_by,
							mas_grole_mod_rlevel.create_date,
							mas_grole_mod_rlevel.update_by,
							mas_grole_mod_rlevel.update_date,
							mas_role_mod.status AS lev_status
						FROM
							mas_grole_mod_rlevel
							INNER JOIN mas_grole_mod ON mas_grole_mod.id = mas_grole_mod_rlevel.grm_id
							INNER JOIN mas_role_app ON mas_role_app.ra_id = mas_grole_mod_rlevel.rol_id
							INNER JOIN mas_role_mod ON mas_role_app.ra_id = mas_role_mod.ra_id AND mas_grole_mod.mod_id = mas_role_mod.mod_id
						WHERE
							mas_grole_mod.mod_id = ".$this->mod_array[$i - 1]." AND
							mas_grole_mod_rlevel.ver_no = 1
					";
					$rows = Yii::app()->db->createCommand($sql)->queryAll();
					foreach ($rows as $dataitem04) {
						$sql = "SELECT COUNT(id) AS ct FROM mas_grole_mod_rlevel WHERE grm_id = ".$dataitem03["id"]." AND rol_id = ".$dataitem04["ra_id"]." order by id";
						$rowcount = Yii::app()->db->createCommand($sql)->queryAll();
						if ($rowcount[0]['ct'] == 0) {
							$sql = " INSERT INTO mas_grole_mod_rlevel(grm_id, rol_id, ver_no, status, create_by, create_date, update_by, update_date)
									 VALUES(:grm_id, :rol_id, :ver_no, :status, '$createby', now(), '$createby', now())";
							$command = $conn->createCommand($sql);
							$command->bindValue(":grm_id", $dataitem03["id"]);
							$command->bindValue(":rol_id", $dataitem04["ra_id"]);
							$command->bindValue(":status", $dataitem04["status"]);
							$command->bindValue(":ver_no", $rowcount02[0]['ct'] + 1);
							$command->execute();
						}
					}
				}else{
					for ($ii = 1; $ii <= count($this->rol_array); $ii++) {
						$sql = "
							INSERT INTO mas_grole_mod_rlevel(grm_id, rol_id, ver_no, status, create_by, create_date, update_by, update_date)
							VALUES(".$dataitem03['id'].", ".$this->rol_array[$ii - 1].", ".$nver.", ".$this->status_array[$ii - 1].", '$createby', now(), '$createby', now())
						";
						$command = $conn->createCommand($sql);
						$command->execute();
					}
				}
			}*/
		}
		$transaction->commit();
		return true;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function save_ver() {
		$createby = Yii::app()->session['em_username'];
		$conn = Yii::app()->db;
		$transaction = $conn->beginTransaction();
		
		$sql = "UPDATE mas_version SET status = 0 WHERE grm_id = ".$this->grm_id;
		$command = $conn->createCommand($sql);
		$command->execute();
		
		$sql = "UPDATE mas_version SET status = 1 WHERE ver_id = ".$this->id;
		$command = $conn->createCommand($sql);
		$command->execute();
		
		$transaction->commit();
		return true;
	}
}