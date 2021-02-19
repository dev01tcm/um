<?php

class MasRequest extends CActiveRecord {
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName(){
		return 'mas_requester';
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getUserid($id = null) {
		$sql="select a.em_per_id,a.em_email,a.em_work_status,a.em_username,a.em_citizen_id,a.em_name_th,a.em_surname_th,e.ug_name,a.em_name_en,a.em_surname_en,a.em_birthday,b.DeptNameTH,b.DeptID,d.PositLevelNameTH,c.PositNameTH,a.um_position_id,a.mas_position_le_id from um_employee a left join mas_department b on a.mas_department_id = b.DeptID left join mas_position c on a.um_position_id = c.PositID left join mas_position_le d on a.mas_position_le_id = d.PositLevelID ";
		$sql.="left join mas_user_group e on a.um_user_group_id = e.ug_id where a.em_username ='".$id."'";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_app($app) {
		$vall = "";
		if(Yii::app()->session['um_user_group_id'] == 1 || Yii::app()->session['um_user_group_id'] == 2) {
			$vall = "";
		}else{
			$vall = " AND create_by = '".Yii::app()->session['em_username']."'";
		}
		
		$sql ="SELECT * FROM mas_requester WHERE app_id = :id".$vall;
		
		$rows= Yii::app()->db->createCommand($sql)->bindValue('id',$app)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function check_appprove($pos_id,$lev_id,$dept_id) {
		$sql = "
			SELECT
				mas_app.app_id,
				mas_app.app_name_th,
				mas_position_app.pos_id,
				mas_position.PositNameTH,
				mas_position_le_app.level_id,
				mas_position_le.PositLevelNameTH,
				mas_department_app.dp_id,
				mas_department.DeptNameTH
			FROM
				mas_app
				INNER JOIN mas_position_app ON mas_app.app_id = mas_position_app.app_id
				INNER JOIN mas_position_le_app ON mas_app.app_id = mas_position_le_app.app_id
				INNER JOIN mas_department_app ON mas_app.app_id = mas_department_app.app_id
				INNER JOIN mas_department ON mas_department.dp_id = mas_department_app.dp_id
				INNER JOIN mas_position_le ON mas_position_le.PositLevelID = mas_position_le_app.level_id
				INNER JOIN mas_position ON mas_position.PositID = mas_position_app.pos_id
			WHERE
				mas_position_app.status = '1' AND
				mas_position_le_app.status = '1' AND
				mas_department_app.status = '1' AND
				mas_position_app.pos_id = ".$pos_id." AND
				mas_position_le_app.level_id = ".$lev_id." AND
				mas_department.DeptID = ".$dept_id;
		
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function get_service($req_code) {
		$sql = "
		SELECT
			mas_form.id_form,
			mas_form.req_code,
			mas_requester.ob_id,
			mas_form.app_id,
			mas_app.app_shortname,
			mas_app.app_name_th,
			mas_module_app.ma_code,
			mas_module_app.ma_name,
			mas_role_app.ra_code,
			mas_role_app.ra_name,
			mas_requester.create_by,
			mas_requester.req_approve_by
		FROM
		mas_form
			INNER JOIN mas_role_mod ON mas_role_mod.id = mas_form.form_value
			INNER JOIN mas_role_app ON mas_role_app.ra_id = mas_role_mod.ra_id
			INNER JOIN mas_module_app ON mas_module_app.ma_id = mas_role_mod.mod_id
			INNER JOIN mas_app ON mas_app.app_id = mas_form.app_id
			INNER JOIN mas_requester ON mas_requester.req_code = mas_form.req_code
		WHERE
			mas_form.form_type = 'select' AND
			not form_value = 0 AND
			mas_form.req_code = '".$req_code."'
		ORDER BY
			mas_form.id_form ASC";
		
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function search($emp,$status){
		$vall = "";
		if(Yii::app()->session['um_user_group_id'] == 1 || Yii::app()->session['um_user_group_id'] == 2) {
			$vall.= "";
		}else{
			$vall.= " AND mas_requester.create_by = '".Yii::app()->session['em_username']."'";
		}
		
		if($status == "0") {
			$vall.= "";
		}else{
			$vall.= " AND mas_requester.req_status = ".$status;
		}
		
		$sql ="
		SELECT
			mas_requester.req_id,
			mas_requester.req_code,
			mas_requester.app_id,
			mas_app.app_shortname,
			mas_requester.ob_id,
			mas_objective.ob_name,
			mas_requester.req_date,
			DATEDIFF(now(), mas_requester.req_date) as req_day,
			mas_requester.req_status,
			mas_requester.req_approve_by,
			mas_requester.req_approve_date,
			um_employee.em_name_th,
			um_employee.em_surname_th,
			mas_requester.status
		FROM
			mas_requester
			INNER JOIN mas_app ON mas_app.app_id = mas_requester.app_id
			INNER JOIN mas_objective ON mas_objective.ob_id = mas_requester.ob_id
			INNER JOIN um_employee ON um_employee.em_username = mas_requester.create_by
		WHERE
			mas_requester.status = 1".$vall."
		GROUP BY req_code
		ORDER BY mas_requester.req_status ASC, req_day ASC, mas_requester.req_date ASC
		";
		
		$rows= Yii::app()->db->createCommand($sql)->bindValue('emp',$emp)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getCountreq() {
		$vall = "";
		if(Yii::app()->session['um_user_group_id'] == 1 || Yii::app()->session['um_user_group_id'] == 2) {
			$vall = "";
		}else{
			$data=lkup_user::getUserid(Yii::app()->user->id);
			foreach($data as $dataitem) {
				$depid = $dataitem["DeptID"];
			}
			$vall = " AND um_employee.mas_department_id like '".substr($depid,0,-2)."%'";
		}
		
		$sql = "
		SELECT
			COUNT(*) AS cnt_req
		FROM
			mas_requester
			INNER JOIN mas_app ON mas_app.app_id = mas_requester.app_id
			INNER JOIN mas_objective ON mas_objective.ob_id = mas_requester.ob_id
			INNER JOIN um_employee ON um_employee.em_username = mas_requester.create_by
		WHERE
			mas_requester.status = 1 AND mas_requester.req_status = 1".$vall;
		
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function searchapprove($emp,$status){
		$vall = "";
		if(Yii::app()->session['um_user_group_id'] == 1 || Yii::app()->session['um_user_group_id'] == 2) {
			$vall = "";
		}else{
			$data=lkup_user::getUserid(Yii::app()->user->id);
			foreach($data as $dataitem) {
				$depid = $dataitem["DeptID"];
			}
			$vall = "AND um_employee.mas_department_id like '".substr($depid,0,-2)."%'";
		}
		
		if($status == "0") {
			$vall.= "";
		}else{
			$vall.= " AND mas_requester.req_status = ".$status;
		}
		
		$sql ="
		SELECT
			mas_requester.req_id,
			mas_requester.req_code,
			mas_requester.app_id,
			mas_app.app_shortname,
			mas_requester.ob_id,
			mas_objective.ob_name,
			mas_requester.req_date,
			DATEDIFF(now(), mas_requester.req_date) as req_day,
			mas_requester.req_status,
			mas_requester.req_approve_by,
			mas_requester.req_approve_date,
			um_employee.em_name_th,
			um_employee.em_surname_th,
			mas_requester.status,
			um_employee.mas_department_id
		FROM
			mas_requester
			INNER JOIN mas_app ON mas_app.app_id = mas_requester.app_id
			INNER JOIN mas_objective ON mas_objective.ob_id = mas_requester.ob_id
			INNER JOIN um_employee ON um_employee.em_username = mas_requester.create_by
		WHERE
			mas_requester.status = 1".$vall."
		GROUP BY req_code
		ORDER BY mas_requester.req_status ASC, req_day ASC, mas_requester.req_date ASC
		";
		
		$rows= Yii::app()->db->createCommand($sql)->bindValue('emp',$emp)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getdata($id){
		$sql ="
		SELECT
			mas_requester.req_id,
			mas_requester.req_code,
			mas_requester.app_id,
			mas_requester.ob_id,
			mas_requester.req_type,
			mas_requester.req_type_val,
			mas_position_le.PositLevelNameTH,
			mas_grole.ra_name,
			mas_requester.req_status,
			mas_requester.req_approve_by,
			mas_requester.req_approve_date,
			mas_requester.status,
			mas_requester.create_by,
			mas_requester.create_date,
			mas_requester.update_by,
			mas_requester.update_date
		FROM
			mas_requester
			LEFT OUTER JOIN mas_position_le ON mas_position_le.PositLevelID = mas_requester.req_type_val
			LEFT OUTER JOIN mas_grole ON mas_grole.ra_id = mas_requester.req_type_val
		WHERE mas_requester.req_id = :id";
		
		$rows= Yii::app()->db->createCommand($sql)->bindValue('id',$id)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getdatamod($id,$mod){
		if($mod != ""){ $va = "mas_form.mod_id = ".$mod." "; }else{ $va = ""; }
		$sql ="
		SELECT
			mas_form.id_form,
			mas_form.mod_id,
			mas_module_app.ma_name,
			mas_form.ra_id,
			mas_role_app.ra_name,
			mas_role_app.status
		FROM
			mas_form
			INNER JOIN mas_role_app ON mas_role_app.ra_id = mas_form.ra_id
			INNER JOIN mas_module_app ON mas_module_app.ma_id = mas_form.mod_id
		WHERE
			mas_form.req_code = :id AND
			mas_role_app.status = 1

		";

		// var_dump($sql);
		
		$rows= Yii::app()->db->createCommand($sql)->bindValue('id',$id)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getconrole($id,$mod,$ct){
		if($ct != ""){ $va = " AND mas_form.r_ct_id = ".$ct; }else{ $va = ""; }
		$sql ="
		SELECT
			mas_form.req_code,
			mas_form.mod_id,
			mas_form.r_ct_id,
			mas_control_rol.ct_check,
			mas_control_rol.ct_name,
			mas_form.form_type,
			mas_form.form_value
		FROM
			mas_form
		INNER JOIN mas_control_rol ON mas_control_rol.ct_id = mas_form.r_ct_id
		WHERE
			mas_form.req_code = '".$id."' AND
			mas_form.mod_id = ".$mod.$va;
		
		$rows= Yii::app()->db->createCommand($sql)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getconmod($id,$mod,$ct){
		if($ct != ""){ $va = " AND mas_form.m_ct_id = ".$ct; }else{ $va = ""; }
		$sql ="
		SELECT
			mas_form.id_form,
			mas_form.req_code,
			mas_form.mod_id,
			mas_form.m_ct_id,
			mas_form.form_type,
			mas_control_mod.ct_name,
			mas_form.form_value
		FROM
			mas_form
			INNER JOIN mas_control_mod ON mas_control_mod.ct_id = mas_form.m_ct_id
		WHERE
			mas_form.req_code = '".$id."' AND
			mas_form.mod_id = ".$mod.$va;
		
		$rows= Yii::app()->db->createCommand($sql)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getconapp($id,$ct){
		if($ct != ""){ $va = " AND mas_form.a_ct_id = ".$ct; }else{ $va = ""; }
		$sql ="
		SELECT
			mas_form.id_form,
			mas_form.req_code,
			mas_form.a_ct_id,
			mas_form.form_type,
			mas_control_app.ct_name,
			mas_form.form_value
		FROM
			mas_form
			INNER JOIN mas_control_app ON mas_control_app.ct_id = mas_form.a_ct_id
		WHERE
			mas_form.req_code = '".$id."'".$va;
		
		$rows= Yii::app()->db->createCommand($sql)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getmodule($app) {
		$sql ="
		SELECT
			m.ma_id,
			m.app_id,
			m.ma_name
		FROM
			mas_module_app as m
		WHERE
			m.app_id = ".$app." AND
			m.status = 1
		ORDER BY m.ma_id";
		
		$rows= Yii::app()->db->createCommand($sql)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getrole($mod) {
		$sql ="
		SELECT
			mas_role_mod.id,
			mas_role_mod.ra_id,
			mas_role_app.ra_name,
			mas_role_mod.ra_default,
			mas_role_mod.status
		FROM
			mas_role_mod
		INNER JOIN mas_role_app ON mas_role_app.ra_id = mas_role_mod.ra_id
		WHERE
			mas_role_mod.mod_id = ".$mod." AND
			mas_role_mod.status = 1 AND
			mas_role_app.status = 1
		ORDER BY mas_role_mod.id";
		
		$rows= Yii::app()->db->createCommand($sql)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getcontrol($app) {
		$sql ="SELECT * FROM mas_control_app WHERE app_id = ".$app." AND ct_status = 1 ORDER BY ct_type DESC, ct_id ASC";
		
		$rows= Yii::app()->db->createCommand($sql)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getcontrolmod($mod) {
		$sql ="SELECT * FROM mas_control_mod WHERE mod_id = ".$mod." AND ct_status = 1 ORDER BY ct_type DESC, ct_id ASC";
		
		$rows= Yii::app()->db->createCommand($sql)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getcontrolrol($rol) {
		$sql ="SELECT * FROM mas_control_rol WHERE rol_id = ".$rol." AND ct_status = 1 ORDER BY ct_type DESC, ct_id ASC";
		
		$rows= Yii::app()->db->createCommand($sql)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getrunid($app) {
		$sql ="SELECT COUNT(*) as runid FROM mas_requester WHERE app_id = ".$app." AND req_date like '%".date("Y")."%'";
		
		$rows= Yii::app()->db->createCommand($sql)->queryAll(); 
		return $rows;
	}
//-----------------------------------------------------------------------------------------------------------------
	public $oreq_code;
	public $req_code;
	public $app;
	public $obj;
	public $req_type;
	public $req_type_val;
	public $mod_array;
	public $level_array;
	public function saveform() {
		try {
			$createby = Yii::app()->session['em_username'];
			
			$conn = Yii::app()->db;
			$transaction = $conn->beginTransaction();
			
			$sql = "UPDATE mas_requester SET status = 0 WHERE req_code = '".$this->oreq_code."'";
			$command = $conn->createCommand($sql);
			$command->execute();
			
			//req_id, req_code, app_id, ob_id, req_date, req_type, req_type_val, req_status, req_approve_by, req_approve_date, status, create_by, create_date, update_by, update_date
			
			$sql = "
			INSERT INTO mas_requester (req_code, app_id, ob_id, req_date, req_type, req_type_val, req_status, req_approve_by, req_approve_date, status, create_by, create_date, update_by, update_date)
			VALUES ('".$this->req_code."', ".$this->app.", ".$this->obj.", now(), ".$this->req_type.", ".$this->req_type_val.", '1', '', '', '1', '$createby', now(), '$createby', now())
			";
			$command = $conn->createCommand($sql);
			$command->execute();
			
			for ($i = 1; $i <= count($this->mod_array); $i++) {
				//req_code, app_id, mod_id, ra_id, status, create_by, create_date, update_by, update_date

				$sql = "
				INSERT INTO mas_form (req_code, app_id, mod_id, ra_id, status, create_by, create_date, update_by, update_date)
				VALUES ('".$this->req_code."',".$this->app.", ".$this->mod_array[$i - 1].", ".$this->level_array[$i - 1].", '1', '$createby', now(), '$createby', now())
				";
				$command = $conn->createCommand($sql);
				$command->execute();
			}
			$transaction->commit();
			return true;
		} catch (Exception $e) {
			$transaction->rollBack();
			Yii::app()->session['errmsg_calendar'] = 'error ' . $e->getMessage();
			return false;
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public $req_id;
	public $status;
	public function switchform() {
		try {
			$createby = Yii::app()->session['em_username'];
			
			$conn = Yii::app()->db;
			$transaction = $conn->beginTransaction();
			
			$sql = "UPDATE mas_requester SET req_status = ".$this->status.",req_approve_by = '".$createby."',req_approve_date = now() WHERE req_id = ".$this->req_id;
			$command = $conn->createCommand($sql);
			$command->execute();
			
			$transaction->commit();
			return true;
		} catch (Exception $e) {
			$transaction->rollBack();
			Yii::app()->session['errmsg_calendar'] = 'error ' . $e->getMessage();
			return false;
		}
	}
//-----------------------------------------------------------------------------------------------------------------
	public function getrelaposition($posi) {
		$sql ="
			SELECT
				mas_gor_role.rol_id
			FROM
				rela_grouprole_le
				INNER JOIN mas_gor_role ON mas_gor_role.gr_id = rela_grouprole_le.id_grouprole
			WHERE
				rela_grouprole_le.id_position = ".$posi." AND
				rela_grouprole_le.gl_status = 1 AND
				mas_gor_role.status = 1
		";
		
		$rows= Yii::app()->db->createCommand($sql)->queryAll(); 
		return $rows;
	}
}