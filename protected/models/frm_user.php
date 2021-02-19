<?php

class frm_user extends CFormModel
{
		public $ssofirstname;
		public $ssopersoncitizenid;
		public $givenName;
		public $ssosurname;
		public $maildrop;
		public $ssopersonempdate;
		public $title;
		public $initials;
		public $employeeType;
		public $email;
		public $workingdeptdescription;
		public $sn;
		public $ssopersonposition;
		public $ssopersonbirthdate;
		public $accountActive;
		public $ssopersonclass;
		public $cn;
		public $PER_MGTPM_NAME;
		public $PER_PERSONALUPDATE_DATE;
		public $PER_EFFECTIVEDATE;
		public $PER_POS_NAMEPN_NAME;	
		public $userid;
		public $textpro;
		public $password;
		public $SSObranchCode;
		public $quota;
		public $userlevel_id;
		public $PER_ID;
		public $PICPATH;
		public $PIC_UPDATE;
		public $PER_GENDER;
		public $PN_NAME;
		public $PM_NAME;
		public $PER_DOCDATE;
	public function rules()
	{
		return array(
			array('ssofirstname','ssopersoncitizenid','givenName','ssosurname','maildrop','ssopersonempdate','title','initials','employeeType'
			,'email','workingdeptdescription','sn','ssopersonposition','ssopersonbirthdate','accountActive','ssopersonclass','cn','PM_NAME',
			'PER_MGTPM_NAME','PER_PERSONALUPDATE_DATE','PER_EFFECTIVEDATE','PER_POS_NAMEPN_NAME','userid','password','SSObranchCode','userlevel_id','PER_ID','PICPATH','PIC_UPDATE','PER_GENDER','PN_NAME','PER_DOCDATE'),				
		);
	}

	public function attributeLabels()
	{
		return array(

		);
	}
	public function updatemas_user_group($id,$drpdep)
	{
		$sql="update um_employee set um_user_group_id=:um_user_group_id  where em_id=".$id;
		$command=yii::app()->db->createCommand($sql);			
		$command->bindValue(":um_user_group_id", $drpdep);
		if($command->execute()) {
								
					return true;
					} else {
					
					return false;
						}
	}
	public function deleteum_employee($id,$userid)
	{
		$sql="update um_employee set em_status=0  where em_id=".$id;
		$command=yii::app()->db->createCommand($sql);			
		if($command->execute()) {
								
					return true;
					} else {
					
					return false;
						}
						
		$sql="update db_ldap set ACCOUNTACTIVE=0  where em_id=".$userid;
		$command=yii::app()->db->createCommand($sql);
		if($command->execute()) {
								
					return true;
					} else {
					
					return false;
						}		
	}
	public function searchdataemployee($id)
	{
		$sql="seiect a.em_id ,a.em_username,a.em_name_th,a.em_surname_th from um_employee a inner joinv where em_id=".$id;
		
	}
	public $page; 
	public $recordsPerPage;
	public $start;
	public $noOfRecords;
	public $FSearch;
	public function Listuser($masusertype=null,$masusergroup=null,$masdepartment=null)
	{
		
		
		$Condition = "";
		if($masusertype!=''){							
			$Condition.= " and a.mas_user_type_id =".$masusertype."";			
		}
		if($masusergroup!=''){							
			$Condition.= " and a.um_user_group_id=".$masusergroup."";			
		}
		if($masdepartment!=''){							
			$Condition.= " and a.mas_department_id=".$masdepartment."";			
		}

			$sql = "SELECT * FROM um_employee ORDER BY em_id";

			$sql="SET @rownum := 0;";
			$command = Yii::app()->db->createCommand($sql)->execute();
			$sql ="
			SELECT * FROM
			(select @rownum := @rownum+1 AS NUMBER,a.em_id,a.em_per_id,a.em_email,a.em_work_status,a.em_username,a.em_citizen_id,a.em_name_th,a.em_surname_th,a.em_name_en,a.em_surname_en,a.em_birthday,b.DeptNameTH,c.PositNameTH,d.PositLevelNameTH,e.ug_id,e.ug_name ";
			$sql.="from um_employee a inner join mas_department b on a.mas_department_id = b.DeptID inner join mas_position c on a.um_position_id = c.PositID inner join mas_position_le d on a.mas_position_le_id = d.PositLevelID inner join mas_user_group e on a.um_user_group_id=e.ug_id where a.um_data_complete_id = 1 and a.em_status=1 ".$Condition." ORDER BY a.createdate DESC ) AS TBL ";
			$sql.="WHERE  NUMBER BETWEEN :rowstart AND :rowend ";
			
			$command = Yii::app()->db->createCommand($sql);
			$command->bindValue(":rowstart", ($this->start + 1));
			$command->bindValue(":rowend", ($this->start + $this->recordsPerPage)); 
			$rows = $command->queryAll(); 
			
			
			if($rows==null)
			{
				echo CJSON::encode(array('status' => 'error', ));
			}
			$arr = array();
			
			foreach($rows as $dataitem) {
				//$new =  array_push($dataitem,"xxx");
				$stn1='';
				$stnselect='';
				$arr['NUMBER']=$dataitem['NUMBER'];
				$arr['em_name_th']=$dataitem['em_name_th']." ".$dataitem['em_surname_th'];
				$arr['em_username']=$dataitem['em_username'];
				$arr['PositNameTH']=$dataitem['PositNameTH'];
				$arr['PositLevelNameTH']=$dataitem['PositLevelNameTH'];
				$arr['DeptNameTH']=$dataitem['DeptNameTH'];
			//	$arr['DeptNameTH1']=$dataitem['DeptNameTH'];
			//	$arr['DeptNameTH2']=$dataitem['DeptNameTH'];
			//	$arr['DeptNameTH3']=$dataitem['DeptNameTH'];
				
				
			$stnselect='
					<div class="btn-group" role="group">
					
						<select class="form-control drpdep11111" id="drpdep11111'.$dataitem['em_id'].'" data-id="'.$dataitem['em_id'].'" onchange="changedata(this)" >';
						 $datausergroup = lkup_user::group_user();
						 $stnselect.='<option value="'.$dataitem['ug_id'].'">'.$dataitem['ug_name'].'</option>';
						 foreach($datausergroup as $dataitem11) 
						{
							$stnselect.='<option value="'.$dataitem11['ug_id'].'">'.$dataitem11['ug_name'].'</option>';
						}
						
						$stnselect.=' </select>
					</div>';
					$strbtn ='
					<div class="btn-group" role="group">
						<button class="btn btn-floating btn-warning btn-sm" type="button" data-id="'.$dataitem['em_id'].'" onclick="editdata(this)" title="แก้ไข"><i class="fa fa-edit" aria-hidden="true"></i></button>
					</div>
					';
					$strbtn1 ='
					<div class="btn-group" role="group">
						<button class="btn btn-floating btn-danger btn-sm" type="button" data-id="'.$dataitem['em_id'].'" data-user="'.$dataitem['em_username'].'" onclick="deletedata(this)" title="ลบ"><i class="fa fa-folder" aria-hidden="true" ></i></button>
					</div>
					';
				$arr['stnselect'] = $stnselect ;	
				$arr['strbtn'] = $strbtn ;
				$arr['strbtn1'] = $strbtn1 ;
				$arr1[] = array_values($arr) ;  
				
			}
		//	var_dump($arr1);
		//	exit;
	
					$jsondata = json_encode($arr1); 
					
					$sql = "SELECT COUNT(*) As ct FROM um_employee a where a.um_data_complete_id = 1 and a.em_status=1 ".$Condition."";

				//	$command = $conn->createCommand($sql);
					
					$rows=Yii::app()->db->createCommand($sql)->queryAll();
					
					$noOfRecords =  $rows[0]['ct'];

					echo '{"recordsTotal":' . $noOfRecords . ',"recordsFiltered":' . $noOfRecords . ',"data":'. $jsondata . '}';
				

		//$rows= Yii::app()->db->createCommand($sql)->queryAll();
	   	//return $rows;
	}
	public function reportuser($StartDate=null,$EndDate=null)
	{
		$startdate1 = date("Y-m-d", strtotime(str_replace('/', '-',$StartDate))) ;
		$EndDate1 = date("Y-m-d", strtotime(str_replace('/', '-',$EndDate))) ;
		
	//	var_dump($startdate1);
	//	var_dump($EndDate1);
	//	exit;
	/*	if($masdepartment!=''){							
			$Condition.= " and a.mas_department_id=".$masdepartment."";			
		}

*/

			$sql = "SELECT * FROM um_employee ORDER BY em_id";

			$sql="SET @rownum := 0;";
			$command = Yii::app()->db->createCommand($sql)->execute();
			$sql ="
			SELECT * FROM
			(select @rownum := @rownum+1 AS NUMBER,a.em_id,a.em_per_id,a.em_email,a.em_work_status,a.em_username,a.em_citizen_id,a.em_name_th,a.em_surname_th,a.em_name_en,a.em_surname_en,a.em_birthday,b.DeptNameTH,c.PositNameTH,d.PositLevelNameTH,e.ug_id,e.ug_name ";
			$sql.="from um_employee a inner join mas_department b on a.mas_department_id = b.DeptID inner join mas_position c on a.um_position_id = c.PositID inner join mas_position_le d on a.mas_position_le_id = d.PositLevelID inner join mas_user_group e on a.um_user_group_id=e.ug_id where a.um_data_complete_id = 0 and a.em_status=1 and (DATE_FORMAT(a.createDate,'%Y-%m-%d') between '$startdate1' and '$EndDate1' )) AS TBL ";
			$sql.="WHERE  NUMBER BETWEEN :rowstart AND :rowend 
			
			";
			$command = Yii::app()->db->createCommand($sql);
			$command->bindValue(":rowstart", ($this->start + 1));
			$command->bindValue(":rowend", ($this->start + $this->recordsPerPage)); 
			
			$rows = $command->queryAll(); 
		
			if($rows==null)
			{
				echo CJSON::encode(array('status' => 'error', ));
			}
			$arr = array();
			$icon_nulldata = "<div class='text-center'><i class='fa fa-ban text-danger' style='font-size:20px;'></i></div>";
			foreach($rows as $dataitem) {
				//$new =  array_push($dataitem,"xxx");
				$stn1='';
				$stnselect='';
				$arr['NUMBER']=$dataitem['NUMBER'];
				$arr['em_username']=$dataitem['em_username'] == '' ? $icon_nulldata : $dataitem['em_username'];
				$arr['em_name_th']=$dataitem['em_name_th'] == '' ? $icon_nulldata : $dataitem['em_name_th'];
				$arr['em_surname_th']=$dataitem['em_surname_th'] == '' ? $icon_nulldata : $dataitem['em_surname_th'];
				$arr['PositNameTH']=$dataitem['PositNameTH']== '' ? $icon_nulldata : $dataitem['PositNameTH'];
				$arr['PositLevelNameTH']=$dataitem['PositLevelNameTH']== '' ? $icon_nulldata : $dataitem['PositLevelNameTH'];
				$arr['DeptNameTH']=$dataitem['DeptNameTH']== '' ? $icon_nulldata : $dataitem['DeptNameTH'];
			//	$arr['DeptNameTH1']=$dataitem['DeptNameTH'];
			//	$arr['DeptNameTH2']=$dataitem['DeptNameTH'];
			//	$arr['DeptNameTH3']=$dataitem['DeptNameTH'];
				
				
			
				$arr1[] = array_values($arr) ;  
				
			}
		//	var_dump($arr1);
		//	exit;
	
					$jsondata = json_encode($arr1); 
					
					$sql = "SELECT COUNT(*) As ct FROM um_employee a where a.um_data_complete_id = 0 and a.em_status=1 and (DATE_FORMAT(a.createDate,'%Y-%m-%d') between '$startdate1' and '$EndDate1' )";

				//	$command = $conn->createCommand($sql);
					
					$rows=Yii::app()->db->createCommand($sql)->queryAll();
					
					$noOfRecords =  $rows[0]['ct'];

					echo '{"recordsTotal":' . $noOfRecords . ',"recordsFiltered":' . $noOfRecords . ',"data":'. $jsondata . '}';
				

		//$rows= Yii::app()->db->createCommand($sql)->queryAll();
	   	//return $rows;
	}
	public function searchuser($masusertype=null,$masusergroup=null,$masdepartment=null,$typesearch=null,$idsearch=null)
	{
		
	
		
		$Condition = "";
		if($masusertype!=''){							
			$Condition.= " and a.mas_user_type_id =".$masusertype."";			
		}
		if($masusergroup!=''){							
			$Condition.= " and a.um_user_group_id=".$masusergroup."";			
		}
		if($masdepartment!=''){							
			$Condition.= " and a.mas_department_id=".$masdepartment."";			
		}
		if($typesearch==1){
			$Condition.= " and a.em_citizen_id =".$idsearch."";		
		}
		if($typesearch==2){
			$Condition.= " and a.em_username ='".$idsearch."' ";		
		}
		if($typesearch==3){
			$Condition.= " and a.em_name_th like '%".$idsearch."%' or a.em_surname_th like '%".$idsearch."%'";		
		}
		$sql = "select a.em_id,a.em_per_id,a.em_email,a.em_work_status,a.em_username,a.em_citizen_id,a.em_name_th,a.em_surname_th,a.em_name_en,a.em_surname_en,a.em_birthday,b.DeptNameTH,c.PositNameTH,d.PositLevelNameTH,e.ug_id,e.ug_name ";
		$sql.="from um_employee a inner join mas_department b on a.mas_department_id = b.DeptID inner join mas_position c on a.um_position_id = c.PositID inner join mas_position_le d on a.mas_position_le_id = d.PositLevelID inner join mas_user_group e on a.um_user_group_id=e.ug_id where a.um_data_complete_id = 1 and a.em_status=1 ".$Condition." ORDER BY a.createdate DESC ";
		$row =Yii::app()->db->createCommand($sql)->queryAll();
		return $row;
	}
	public function searchusernew()
	{
		$sql = "select a.em_id,a.em_per_id,a.em_email,a.em_work_status,a.em_username,a.em_citizen_id,a.em_name_th,a.em_surname_th,a.em_name_en,a.em_surname_en,a.em_birthday,b.DeptNameTH,c.PositNameTH,d.PositLevelNameTH,e.ug_id,e.ug_name ";
		$sql.="from um_employee a inner join mas_department b on a.mas_department_id = b.DeptID inner join mas_position c on a.um_position_id = c.PositID inner join mas_position_le d on a.mas_position_le_id = d.PositLevelID inner join mas_user_group e on a.um_user_group_id=e.ug_id where a.um_data_complete_id = 1 and a.em_status=1 ORDER BY a.em_id DESC  LIMIT 1";
		$row =Yii::app()->db->createCommand($sql)->queryAll();
		return $row;
	}
}
