<?php

class MasGOR extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
//-----------------------------------------------------------------------------------------------------------------
	public function tableName(){
		return 'mas_group_of_role';
	}
//-----------------------------------------------------------------------------------------------------------------
	public function search() {
		$sql = " SELECT * FROM mas_group_of_role WHERE gr_status = 1 ";
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_data($gor_id,$app) {
		$createby = Yii::app()->session['em_username'];
		$conn = Yii::app()->db;
		
		$sql = "SELECT * FROM mas_grole WHERE app_id = ".$app." AND status = 1 ORDER BY ra_id";
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($rows as $dataitem) {
			$sql = "SELECT COUNT(id_gor_role) AS ct FROM mas_gor_role WHERE gr_id = ".$gor_id." AND rol_id = ".$dataitem["ra_id"];
			$rowcount = Yii::app()->db->createCommand($sql)->queryAll();
			if ($rowcount[0]['ct'] == 0) {
				$sql = "SELECT COUNT(id_gor_role) AS status FROM mas_gor_role WHERE gr_id = ".$gor_id." AND status = 1";
				$rowcount2 = Yii::app()->db->createCommand($sql)->queryAll();
				if ($rowcount2[0]['status'] == 0) {
					$status = "1";
				}else{
					$status = "0";
				}
				
				$sql = "INSERT INTO mas_gor_role(gr_id, rol_id, status, create_by, create_date, update_by, update_date) VALUES(:gr_id, :rol_id , :status, '$createby', now(), '$createby', now())";
				$command = $conn->createCommand($sql);
				$command->bindValue(":gr_id", $gor_id);
				$command->bindValue(":rol_id", $dataitem["ra_id"]);
				$command->bindValue(":status", $status);
				$command->execute();
			}
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public function searchrol($gor_id) {
		$sql = "
			SELECT
				mas_gor_role.id_gor_role,
				mas_gor_role.gr_id,
				mas_gor_role.rol_id,
				mas_grole.ra_code,
				mas_grole.ra_name,
				mas_gor_role.status,
				mas_gor_role.create_by,
				mas_gor_role.create_date,
				mas_gor_role.update_by,
				mas_gor_role.update_date
			FROM
				mas_gor_role
				INNER JOIN mas_grole ON mas_grole.ra_id = mas_gor_role.rol_id
			WHERE
				mas_gor_role.gr_id = ".$gor_id." AND
				mas_grole.status = 1
			ORDER BY
				mas_gor_role.id_gor_role ASC
		";
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public $sw_array;
	public $sw_status_array;
	public function savedata() {
		$createby = Yii::app()->session['em_username'];
		$conn = Yii::app()->db;
		
		for ($i = 1; $i <= count($this->sw_array); $i++) {
			$sql = "UPDATE mas_gor_role SET status = :status, update_by = '$createby', update_date = now() WHERE id_gor_role = :id";
			$command = $conn->createCommand($sql);
			$command->bindValue(":id", $this->sw_array[$i-1]);
			$command->bindValue(":status", $this->sw_status_array[$i-1]);
			$command->execute();
		}
	}
}