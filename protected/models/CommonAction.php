<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CommonAction extends CFormModel
{

	public $uid;
	public $SSOfirstname;
	public $ssobranch_code;
	public $SSOsurname;
	public $download_dir;
	public $download_file;
	public $ssopersoncitizenid;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('uid', 'required','ssopersoncitizenid'),
		);
	}


	public function Check_mas_user() {
		

			$sql ="SELECT em_username FROM um_employee WHERE em_username=:uid ";
			$rows= Yii::app()->db->createCommand($sql)->bindValue('uid', $this->uid)->queryAll();
			return $rows;
			/*
			if (count($rows) > 0){
				return true;
			}else{
				return false;
			}
			*/
			
	}


	public function Add_mas_user() {
			$host=Yii::app()->params['prg_ctrl']['ipservice']['ipzonedev'];

		try{
			$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;
			
			$conn = Yii::app()->db;
			$transaction = $conn->beginTransaction();
			$data_array = array("filter" => array("exp" => $this->uid),);	
			$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/ldapinfosearch.php', json_encode($data_array));
			$data = json_decode($make_call, true);
			foreach($data as $key => $val)
				{
					//echo "$key,";
					//action,data,attribute,
					 if($key=='data'){
						//print_r($val);
						foreach($val as $key2 => $val2){
						//	echo "$key2 => $val2, ";
							$uid=$val2;
						}
					}
				}
		foreach ($uid as $dataitem)
			{
				
				$personcitizenid=$dataitem["ssopersoncitizenid"];
			}
			
		//	$position='3190600291948';
			$data_array = array("filter" => array("exp" => $personcitizenid),);	
			$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/dpisinfosearch.php', json_encode($data_array));
			$data1 = json_decode($make_call, true);
			$updatesucess= new frm_profile;	
			foreach($data1 as $dataitem)
			{
				
			
				
				$updatesucess->PER_ID=$dataitem["PER_ID"];
				$updatesucess->ssofirstname=$dataitem["ssofirstname"];
				$updatesucess->ssopersoncitizenid=$dataitem["ssopersoncitizenid"];
				$updatesucess->givenName=$dataitem["givenName"];
				$updatesucess->ssosurname=$dataitem["ssosurname"];
			//	$updatesucess->maildrop=$dataitem["maildrop"];
				$updatesucess->ssopersonempdate=isset($dataitem['ssopersonempdate'])?addslashes(trim($dataitem['ssopersonempdate'])):'';
			//	var_dump($updatesucess->ssopersonempdate);
				$updatesucess->title=$dataitem["title"];
				$updatesucess->initials=$dataitem["initials"];
				$updatesucess->employeeType=$dataitem["employeeType"];
			//	$updatesucess->email=$dataitem["mail"];
				$updatesucess->workingdeptdescription=$dataitem["workingdeptdescription"];
				$updatesucess->sn=$dataitem["sn"];
				$updatesucess->ssopersonposition=$dataitem["ssopersonposition"];
				$updatesucess->ssopersonbirthdate=$dataitem["ssopersonbirthdate"];
				$updatesucess->accountActive=$dataitem["accountActive"];
				$updatesucess->ssopersonclass=$dataitem["ssopersonclass"];
				$updatesucess->cn=$dataitem["cn"];
				$updatesucess->PICPATH=$dataitem["PICPATH"];
				$updatesucess->PIC_UPDATE=$dataitem["PIC_UPDATE"];
				$updatesucess->PER_GENDER=$dataitem["PER_GENDER"];
				$updatesucess->PER_GENDER=$dataitem["PER_DOCDATE"];
				// $updatesucess->dataflowdpis();
				// $updatesucess->dataprocessum();
				$updatesucess->dataprocessumday();
				// $updatesucess->updateldap();
				
			
			}
			
	
	
		/*	
	    $host=Yii::app()->params['prg_ctrl']['ldap']['server']; 
		$port=Yii::app()->params['prg_ctrl']['ldap']['port'];
		$bind_uid=Yii::app()->params['prg_ctrl']['ldap']['bind_uid'];		
		$bind_pwd=Yii::app()->params['prg_ctrl']['ldap']['bind_pwd'];			
		$bind_dn=Yii::app()->params['prg_ctrl']['ldap']['bind_dn'];		
		$filter_attr=Yii::app()->params['prg_ctrl']['ldap']['filter_attr'];	
		$publiccode_attr=Yii::app()->params['prg_ctrl']['ldap']['publiccode_attr'];				
		$arr_search_attr=Yii::app()->params['prg_ctrl']['ldap']['arr_search_attr'];			
		$arr_basedn=Yii::app()->params['prg_ctrl']['ldap']['arr_basedn'];			
					
		$ldapcon = ldap_connect($host,$port);		
			if(!$ldapcon) { 
		
				echo '<br> ldap cannot connect';
			 
		}
		
		ldap_set_option($ldapcon, LDAP_OPT_PROTOCOL_VERSION, 3);
		$ldapbind = ldap_bind($ldapcon,$bind_dn,$bind_pwd);
		if(!$ldapbind) { 
			
			ldap_close($ldapcon); 
			 
		}
		$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=". $this->uid, array_values($arr_search_attr))  ;
		$entry = @ldap_get_entries($ldapcon, $ldapsr);
		
			
			foreach (array_keys($arr_search_attr) as $attr)
			{
		
				$ldap_user_info [$attr] = $entry[0][$arr_search_attr[$attr]][0];
			}
				
			 $this->ssopersoncitizenid = isset($ldap_user_info['publiccode'])?$ldap_user_info['publiccode']:'';
		
		
		

			$sql = "INSERT INTO tran_employee (UserName, FirstNameTH, DeptID,LastNameTH,CitizenID,UMLevelID) VALUES(:uid, :SSOfirstname, :ssobranch_code,:SSOsurname,:ssopersoncitizenid,4)";

			$command = $conn->createCommand($sql);
			$command->bindValue(":uid", $this->uid);		
			$command->bindValue(":SSOfirstname", $this->SSOfirstname);	
			$command->bindValue(":ssobranch_code", $this->ssobranch_code);
			$command->bindValue(":SSOsurname", $this->SSOsurname);
			$command->bindValue(":ssopersoncitizenid", $this->ssopersoncitizenid);
			$command->execute();
			$user_id = $conn->getLastInsertID();

			//Add_mas_user_permission($user_id, $this->ssobranch_code);
			*/
			/*
			//เปิดสิทธิ์เนื้อหา
			$sql = "INSERT INTO mas_user_permission(user_id, ssobranch_code, app_id, user_role, create_by, create_date) VALUES(:user_id, :ssobranch_code, :app_id, :user_role, $createby, now())";
			$command = $conn->createCommand($sql);
			$command->bindValue(":user_id", $user_id);		
			$command->bindValue(":ssobranch_code", $this->ssobranch_code);		
			$command->bindValue(":app_id", '1');	
			$command->bindValue(":user_role",'4');
			$command->execute();

			//เปิดสิทธิ์แอดมิน
			$sql = "INSERT INTO mas_user_permission(user_id, ssobranch_code, app_id, user_role, create_by, create_date) VALUES(:user_id, :ssobranch_code, :app_id, :user_role, $createby, now())";
			$command = $conn->createCommand($sql);
			$command->bindValue(":user_id", $user_id);		
			$command->bindValue(":ssobranch_code", $this->ssobranch_code);		
			$command->bindValue(":app_id", '5');	
			$command->bindValue(":user_role",'4');
			$command->execute();
			*/

			$transaction->commit();
			
			return true;
		}catch (Exception $e) {
           //  var_dump("11111");
			  
			$transaction->rollBack();
			Yii::app()->session['errmsg_adduser']='error '. $e->getMessage() ;
			
			return false;

		}
	

	}
	public function update_mas_user()
		{
			
			
		//	$data1=lkup_oracledpis::dataldap($this->uid);
			$data1=lkup_oracledpis::dataldaptest($this->uid);
			
	
				try{
					
					$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;
					
					$conn = Yii::app()->db;
					$transaction = $conn->beginTransaction();
					
				//	$position='3190600291948';
			
				
					
					
					$updatesucess= new frm_profile;	
					foreach($data1 as $dataitem)
					{
						
					
					//	var_dump("ergregerger");exit;
						$updatesucess->PER_ID=$dataitem["PER_ID"];
						$updatesucess->ssofirstname=$dataitem["SSOFIRSTNAME"];
						$updatesucess->ssopersoncitizenid=$dataitem["SSOPERSONCITIZENID"];
						$updatesucess->givenName=$dataitem["GIVENNAME"];
						$updatesucess->ssosurname=$dataitem["SSOSURNAME"];
					//	$updatesucess->maildrop=$dataitem["maildrop"];
						$updatesucess->ssopersonempdate=isset($dataitem['SSOPERSONEMPDATE'])?addslashes(trim($dataitem['SSOPERSONEMPDATE'])):'';
					//	var_dump($updatesucess->ssopersonempdate);
						$updatesucess->title=$dataitem["TITLE"];
						$updatesucess->initials=$dataitem["INITIALS"];
						$updatesucess->employeeType=$dataitem["EMPLOYEETYPE"];
					//	$updatesucess->email=$dataitem["mail"];
						$updatesucess->workingdeptdescription=$dataitem["WORKINGDEPTDESCRIPTION"];
						$updatesucess->sn=$dataitem["SN"];
						$updatesucess->ssopersonposition=$dataitem["SSOPERSONPOSITION"];
						$updatesucess->ssopersonbirthdate=$dataitem["SSOPERSONBIRTHDATE"];
						$updatesucess->accountActive=$dataitem["ACCOUNTACTIVE"];
						$updatesucess->ssopersonclass=$dataitem["SSOPERSONCLASS"];
					//	$model->cn=$dataitem["CN"];
						$updatesucess->PICPATH=$dataitem["PICPATH"];
					//	$model->PIC_UPDATE=$dataitem["PIC_UPDATE"];
						$updatesucess->PER_GENDER=$dataitem["PER_GENDER"];
					//	$updatesucess->dataflowdpis();	
						// $updatesucess->dataprocessumtest();	
						$updatesucess->dataprocessumday();

						
					//	$updatesucess->updateldap();
						
					
					}
					/*
					foreach($data1 as $dataitem)
					{
						
					
						
						$updatesucess->PER_ID=$dataitem["PER_ID"];
						$updatesucess->ssofirstname=$dataitem["ssofirstname"];
						$updatesucess->ssopersoncitizenid=$dataitem["ssopersoncitizenid"];
						$updatesucess->givenName=$dataitem["givenName"];
						$updatesucess->ssosurname=$dataitem["ssosurname"];
					//	$updatesucess->maildrop=$dataitem["maildrop"];
						$updatesucess->ssopersonempdate=isset($dataitem['ssopersonempdate'])?addslashes(trim($dataitem['ssopersonempdate'])):'';
					//	var_dump($updatesucess->ssopersonempdate);
						$updatesucess->title=$dataitem["title"];
						$updatesucess->initials=$dataitem["initials"];
						$updatesucess->employeeType=$dataitem["employeeType"];
					//	$updatesucess->email=$dataitem["mail"];
						$updatesucess->workingdeptdescription=$dataitem["workingdeptdescription"];
						$updatesucess->sn=$dataitem["sn"];
						$updatesucess->ssopersonposition=$dataitem["ssopersonposition"];
						$updatesucess->ssopersonbirthdate=$dataitem["ssopersonbirthdate"];
						$updatesucess->accountActive=$dataitem["accountActive"];
						$updatesucess->ssopersonclass=$dataitem["ssopersonclass"];
						$updatesucess->cn=$dataitem["cn"];
						$updatesucess->PICPATH=$dataitem["PICPATH"];
						$updatesucess->PIC_UPDATE=$dataitem["PIC_UPDATE"];
						$updatesucess->PER_GENDER=$dataitem["PER_GENDER"];
						$updatesucess->PER_GENDER=$dataitem["PER_DOCDATE"];
						$updatesucess->dataflowdpis();	
						$updatesucess->dataprocessum();	
						
						$updatesucess->updateldap();
					
					}
				*/
					$transaction->commit();
					
						return true;
					}catch (Exception $e) {
					   //  var_dump("11111");
						  
						$transaction->rollBack();
						Yii::app()->session['errmsg_adduser']='error '. $e->getMessage() ;
						return false;
					}
			
		}

	public function Add_mas_user_permission($user_id, $ssobranch_code) {
		//ALTER TABLE `itrdb`.`mas_user_permission` ADD UNIQUE INDEX (`user_id`, `app_id`); 
			$sql ="SELECT * FROM mas_app_permission WHERE status=1 order by id ";
			$rows= Yii::app()->db->createCommand($sql)->queryAll();
				
			$conn = Yii::app()->db;
			foreach($rows as $dataitem) { 
        		$sql = "INSERT IGNORE INTO mas_user_permission(user_id, ssobranch_code, app_id, user_role, create_by, create_date) VALUES(:user_id, :ssobranch_code, :app_id, :user_role, $user_id, now())";
				$command = $conn->createCommand($sql);
				$command->bindValue(":user_id", $user_id);		
				$command->bindValue(":ssobranch_code", $ssobranch_code);		
				$command->bindValue(":app_id", $dataitem["id"]);	
				$command->bindValue(":user_role",'4');
				$command->execute();
            }
	}

	public function Downloadfile() {
	 
		ignore_user_abort(true);
		set_time_limit(0); // disable the time limit for this script
		 
		$path = $this->download_dir ;  // change the path to fit your websites document structure
		 
		$dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', $this->download_file); // simple file name validation
		$dl_file = filter_var($dl_file, FILTER_SANITIZE_URL); // Remove (more) invalid characters
		$fullPath = $path.$dl_file;
		 
		if ($fd = fopen ($fullPath, "r")) {
			$fsize = filesize($fullPath);
			$path_parts = pathinfo($fullPath);
			$ext = strtolower($path_parts["extension"]);
			$type = mime_content_type($fullPath);

			header('Content-Type: ' . $type);
			header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
			header("Content-length: $fsize");
			header("Cache-control: private"); //use this to open files directly
			while(!feof($fd)) {
				$buffer = fread($fd, 2048);
				echo $buffer;
			}
		}
		fclose ($fd);
		exit;
	}

	public function AddAdminLog($action, $description) {
		try{
			$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;

			$conn = Yii::app()->db;
			$transaction = $conn->beginTransaction();

			$sql = "INSERT INTO trn_log(action, description, action_by, action_date, ipaddresss) VALUES(:action, :description, $createby, now(), :ipaddresss)";

			$command = $conn->createCommand($sql);
			$command->bindValue(":action", $action);		
			$command->bindValue(":description", $description);	
			$command->bindValue(":ipaddresss", Yii::app()->request->getUserHostAddress());	
			$command->execute();
			$user_id = $conn->getLastInsertID();

			$transaction->commit();
			return $user_id;
		}catch (Exception $e) {

			$transaction->rollBack();
			Yii::app()->session['errmsg_addlog']='error '. $e->getMessage() ;
			return false;

		}
	}

	public function AddLoginLog($action="Login", $description="") {
		try{
			//$createby = !Yii::app()->user->isGuest?Yii::app()->user->id:0;
			$createby = Yii::app()->user->getState("sub");

			$conn = Yii::app()->db;
			$transaction = $conn->beginTransaction();
			
			$sql ="
			INSERT INTO log_login (
			  `log_date`,
			  `log_type`,
			  `descp`,
			  `log_createby`,
			  `log_ipaddress`
			)
			VALUES
			  (
				NOW(),
				:log_type,
				:descp,
				:log_createby,
				:log_ipaddress
			  );";

			$command = $conn->createCommand($sql);
			$command->bindValue(":log_type", $action);		
			$command->bindValue(":descp", $description);	
			$command->bindValue(":log_createby", $createby);	
			$command->bindValue(":log_ipaddress", Yii::app()->request->getUserHostAddress());	
			$command->execute();
			$log_id = $conn->getLastInsertID();

			$transaction->commit();
			return $log_id;
		}catch (Exception $e) {

			$transaction->rollBack();
			Yii::app()->session['errmsg_addlog']='error '. $e->getMessage() ;
			return false;

		}
	}


}
