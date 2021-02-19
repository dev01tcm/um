<?php

class frm_profile extends CFormModel
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
		public $UPDATE_DPIS;
	public function rules()
	{
		return array(
			array('ssofirstname','ssopersoncitizenid','givenName','ssosurname','maildrop','ssopersonempdate','title','initials','employeeType'
			,'email','workingdeptdescription','sn','ssopersonposition','ssopersonbirthdate','accountActive','ssopersonclass','cn','PM_NAME',
			'PER_MGTPM_NAME','PER_PERSONALUPDATE_DATE','PER_EFFECTIVEDATE','PER_POS_NAMEPN_NAME','userid','password','SSObranchCode','userlevel_id','PER_ID','PICPATH','PIC_UPDATE','PER_GENDER','PN_NAME','PER_DOCDATE','UPDATE_DPIS'),				
		);
	}

	public function attributeLabels()
	{
		return array(

		);
	}
	public function updateprofileum() 

	{
	
			
					
	}
				


public function	insertldapdb($uidname,$mails,$DeptID)
{
			
			$sql ="select * from db_ldap where UID='" .$uidname."'";
			$rows =Yii::app()->db->createCommand($sql)->queryAll();
			
			if($this->accountActive==1 || $this->accountActive ==2)
			{
				$this->accountActive="true";
			}
		else{
			$this->accountActive="false";
			}
		
			if($this->title=='')
					{
				   if($this->PER_GENDER==1)
					  {
						  $this->title='Mr.';
				 }else{
						 $this->title='Miss';
					 }
						}
			if($rows == null)
			{    
				
					$sql = "INSERT INTO db_ldap(UID,PER_ID,SSOBRANCHCODE,USERPASSWORD,CN,DISPLAYNAME,SSOFIRSTNAME,SSOSURNAME,SSOPERSONCITIZENID,GIVENNAME,SSOPERSONBIRTHDATE,SSOPERSONEMPDATE,SN,ACCOUNTACTIVE,TITLE,INITIALS,WORKINGDEPTDESCRIPTION,SSOPERSONCLASS,SSOPERSONPOSITION,EMPLOYEETYPE,PER_GENDER,createby,createdate,updateby,updatedate,MAIL)"; 
					$sql.= " VALUES(:UID,:PER_ID,:SSOBRANCHCODE,:USERPASSWORD,:CN,:DISPLAYNAME,:SSOFIRSTNAME,:SSOSURNAME,:SSOPERSONCITIZENID,:GIVENNAME,:SSOPERSONBIRTHDATE,:SSOPERSONEMPDATE,:SN,:ACCOUNTACTIVE,:TITLE,:INITIALS,:WORKINGDEPTDESCRIPTION,:SSOPERSONCLASS,:SSOPERSONPOSITION,:EMPLOYEETYPE,:PER_GENDER,:createby,now(),:updateby,now(),:MAIL)";			
					$command=yii::app()->db->createCommand($sql);			
					$command->bindValue(":UID", $uidname);
					$command->bindValue(":PER_ID", $this->PER_ID);
					$command->bindValue(":SSOBRANCHCODE", $DeptID);	
					$command->bindValue(":USERPASSWORD",1);
					$command->bindValue(":CN", $this->givenName." ".$this->sn);
					$command->bindValue(":DISPLAYNAME", $this->ssofirstname." ".$this->ssosurname);
					$command->bindValue(":SSOFIRSTNAME", $this->ssofirstname);
					$command->bindValue(":SSOSURNAME", $this->ssosurname);		
					$command->bindValue(":SSOPERSONCITIZENID", $this->ssopersoncitizenid);
					$command->bindValue(":GIVENNAME", $this->givenName);		
					$command->bindValue(":SSOPERSONBIRTHDATE", $this->ssopersonbirthdate);
					$command->bindValue(":SSOPERSONEMPDATE", $this->ssopersonempdate);		
					$command->bindValue(":SN", $this->sn);
					$command->bindValue(":ACCOUNTACTIVE", $this->accountActive);	
					$command->bindValue(":TITLE", $this->title);	
					$command->bindValue(":SSOPERSONCLASS", $this->ssopersonclass);	
					$command->bindValue(":INITIALS", $this->initials);	
				//	$command->bindValue(":PM_NAME", $this->PM_NAME);	
					$command->bindValue(":WORKINGDEPTDESCRIPTION", $this->workingdeptdescription);	
					$command->bindValue(":SSOPERSONPOSITION", $this->ssopersonposition);	
					$command->bindValue(":PER_GENDER", $this->PER_GENDER);	
					$command->bindValue(":EMPLOYEETYPE", $this->employeeType);	
					$command->bindValue(":createby","AUTO");
					$command->bindValue(":updateby","AUTO");
					$command->bindValue(":MAIL",$mails);
					
					if($command->execute()) {
					
				
					
					
					} else {
					
						}
				
			}else{
				
					$sql = "update db_ldap set PER_ID=:PER_ID,SSOBRANCHCODE=:SSOBRANCHCODE,USERPASSWORD=:USERPASSWORD,CN=:CN,DISPLAYNAME=:DISPLAYNAME,SSOPERSONCLASS=:SSOPERSONCLASS, ";
					$sql.= "SSOFIRSTNAME=:SSOFIRSTNAME,SSOSURNAME=:SSOSURNAME,SSOPERSONCITIZENID=:SSOPERSONCITIZENID,GIVENNAME=:GIVENNAME,SSOPERSONBIRTHDATE=:SSOPERSONBIRTHDATE,";
					$sql.= "SSOPERSONEMPDATE=:SSOPERSONEMPDATE,SN=:SN,ACCOUNTACTIVE=:ACCOUNTACTIVE,TITLE=:TITLE,INITIALS=:INITIALS,WORKINGDEPTDESCRIPTION=:WORKINGDEPTDESCRIPTION,SSOPERSONPOSITION=:SSOPERSONPOSITION,PER_GENDER=:PER_GENDER, ";
					$sql.= "EMPLOYEETYPE=:EMPLOYEETYPE,createby=:createby,updateby=:updateby,MAIL=:MAIL,createdate=now(),updatedate=now() where UID='".$uidname."'";	
					$command=yii::app()->db->createCommand($sql);			
				//	$command->bindValue(":UID", $uidname);
					$command->bindValue(":PER_ID", $this->PER_ID);
					$command->bindValue(":SSOBRANCHCODE", $DeptID);	
					$command->bindValue(":USERPASSWORD",1);
					$command->bindValue(":CN", $this->givenName." ".$this->sn);
					$command->bindValue(":DISPLAYNAME", $this->ssofirstname." ".$this->ssosurname);
					$command->bindValue(":SSOFIRSTNAME", $this->ssofirstname);
					$command->bindValue(":SSOSURNAME", $this->ssosurname);		
					$command->bindValue(":SSOPERSONCITIZENID", $this->ssopersoncitizenid);
					$command->bindValue(":GIVENNAME", $this->givenName);		
					$command->bindValue(":SSOPERSONBIRTHDATE", $this->ssopersonbirthdate);
					$command->bindValue(":SSOPERSONEMPDATE", $this->ssopersonempdate);		
					$command->bindValue(":SN", $this->sn);
					$command->bindValue(":ACCOUNTACTIVE", $this->accountActive);	
					$command->bindValue(":TITLE", $this->title);	
					$command->bindValue(":SSOPERSONCLASS", $this->ssopersonclass);	
					$command->bindValue(":INITIALS", $this->initials);	
				//	$command->bindValue(":PM_NAME", $this->PM_NAME);	
					$command->bindValue(":WORKINGDEPTDESCRIPTION", $this->workingdeptdescription);	
					$command->bindValue(":SSOPERSONPOSITION", $this->ssopersonposition);	
					$command->bindValue(":PER_GENDER", $this->PER_GENDER);	
					$command->bindValue(":EMPLOYEETYPE", $this->employeeType);	
					$command->bindValue(":createby","AUTO");
					$command->bindValue(":updateby","AUTO");
					$command->bindValue(":MAIL",$mails);		
					
				} 
					if($command->execute()) {
					
				
					
					
					}else {
						
						}
			
	
}
public function	insertldap()
	
	{
				$host=Yii::app()->params['prg_ctrl']['ldap']['server']; 
				$port=Yii::app()->params['prg_ctrl']['ldap']['port'];
				$bind_uid=Yii::app()->params['prg_ctrl']['ldap']['bind_uid'];		
				$bind_pwd=Yii::app()->params['prg_ctrl']['ldap']['bind_pwd'];			
				$bind_dn=Yii::app()->params['prg_ctrl']['ldap']['bind_dn'];		
				$filter_attr=Yii::app()->params['prg_ctrl']['ldap']['filter_attr'];	
				$publiccode_attr=Yii::app()->params['prg_ctrl']['ldap']['publiccode_attr'];				
				$arr_search_attr=Yii::app()->params['prg_ctrl']['ldap']['arr_search_attr'];			
				$arr_basedn=Yii::app()->params['prg_ctrl']['ldap']['arr_basedn'];			
							
				$ldapcon = ldap_connect($host);		
					if(!$ldapcon) { 
				
						echo '<br> ldap cannot connect';
					 
				}
				
				ldap_set_option($ldapcon, LDAP_OPT_PROTOCOL_VERSION, 3);
				$ldapbind = ldap_bind($ldapcon,$bind_dn,$bind_pwd);
				if(!$ldapbind) { 
					
					ldap_close($ldapcon); 
					 
				}
						$data["objectclass"][0]="inetOrgPerson";
						$data["objectclass"][1]="SSOPerson";
						$data["objectclass"][2]="mailAccount";
						$data["objectclass"][3]="top";
						$data["objectclass"][4]="person";
						$data["objectclass"][5]="organizationalPerson";
						$data["uid"] = $userid;
						$data["ssofirstname"] = $ssofirstname;
						$data["ssopersoncitizenid"] = $ssopersoncitizenid;
						$data["givenName"] = $givenName;
						$data["ssosurname"] = $ssosurname;
						$data["maildrop"] = $maildrop;
						$data["ssopersonempdate"] = $ssopersonempdate;
						$data["title"] = $title;
						$data["initials"] = $initials;
						$data["employeeType"] = $employeeType;
						$data["mail"] = $email;
						$data["workingdeptdescription"] = $workingdeptdescription;
						$data["sn"] = $sn;
						$data["ssopersonposition"] = $ssopersonposition;
						$data["ssopersonbirthdate"] = $ssopersonbirthdate;
						$data["accountActive"] = $accountActive;
						$data["ssopersonclass"] = $ssopersonclass;
						$data["SSObranchCode"] = $SSObranchCode;
						$data["displayName"] = $ssofirstname." ". $sosurname;
						$data["cn"] = $givenName." ". $sn;
						$data["quota"] = "512000000";
						$data["userPassword"] =  $password;
						
						$ldapbind=ldap_add($ldapcon, "uid=$userid,cn=Users,ou=internal,DC=ESSS,DC=SSO,DC=GO,DC=TH",$data);
						ldap_close($ldapcon); 
	}
	public function	updateldap($uidname,$DeptID)
	{
		$host=Yii::app()->params['prg_ctrl']['ipservice']['ipzonedev']; 
					if($this->accountActive==1 || $this->accountActive ==2)
						{
							$this->accountActive="true";
						}
					else{
						$this->accountActive="false";
						}
					if($this->title=='')
						{
						   if($this->PER_GENDER==1)
						   {
							   $this->title='Mr.';
						   }else{
							  $this->title='Miss';
						   }
						}
				
			$data_array = array("filter" => array("exp" => $uidname),);	
			$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/ldapinfosearch.php', json_encode($data_array));
			$data = json_decode($make_call, true);
			foreach($data as $key => $val)
				{
					if($key=='code'){
						$code=$val["code"];
					}
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
			if($code==204)
			{
				
				$data_array = array("attribute"=>array(
												"ssofirstname" => $this->ssofirstname,
												"ssosurname" => $this->ssosurname,
												"ssobranchcode" =>$DeptID,
												"ssopersoncitizenid" => $this->ssopersoncitizenid,
												"givenName" => $this->givenName,
												"sn" => $this->sn,
												"employeeType" => $this->employeeType,
												"accountActive" => $this->accountActive,
												"ssopersonclass" => $this->ssopersonclass,
												"initials" => $this->initials,
												"ssopersonempdate" => $this->ssopersonbirthdate,
												"title" => $this->title,
												"workingdeptdescription" => $this->workingdeptdescription,
												"ssopersonposition" => $this->ssopersonposition
											)
											);	
						$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/ldapinsert.php', json_encode($data_array));
						$dataaaa = json_decode($make_call, true);
						if($dataaaa=="insertldap susess")
						{
						
							return true;
						}
					
			}else{
				
				
						
						$data_array = array("filter" => array("exp" => $uidname),
											"attribute"=>array(
												"accountActive" => $this->accountActive,
												"ssofirstname" => $this->ssofirstname,
												"ssopersoncitizenid" => $this->ssopersoncitizenid,
												"givenName" => $this->givenName,
												"ssosurname" => $this->ssosurname,
												"ssopersonempdate" => $this->ssopersonbirthdate,
												"title" => $this->title,
												"initials" => $this->initials,
												"sn" => $this->sn,
												"employeeType" => $this->employeeType,
												"workingdeptdescription" => $this->workingdeptdescription,
												"ssopersonposition" => $this->ssopersonposition,
												"ssopersonclass" => $this->ssopersonclass,
												"displayName" => $this->ssofirstname." ". $this->ssosurname,
												"cn" => $this->givenName." ". $this->sn,
											)
											);	
											
						
						$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/ldapupdate.php', json_encode($data_array));
				//		$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/ldapinfosearch.php', json_encode($data_array));
						
						$dataaaa = json_decode($make_call, true);
						if($dataaaa=="success")
						{
						
							return true;
						}else{
						}
						
			}	
	}
	
public function dataflowdpis()
{
	/*
		$sql ="select * from db_dpis where PER_ID='" .$this->PER_ID."' and EMPLOYEETYPE='".$this->employeeType."' and (SSOFIRSTNAME !='".$this->ssofirstname."' or SSOSURNAME !='".$this->ssosurname."' or ACCOUNTACTIVE !='".$this->accountActive."'";
		$sql.=" or EMPLOYEETYPE !='".$this->employeeType."' or GIVENNAME !='".$this->givenName."' or SSOPERSONCLASS !='".$this->ssopersonclass."' ";
		$sql.="or WORKINGDEPTDESCRIPTION !='".$this->workingdeptdescription."' or TITLE !='".$this->title."' or SSOPERSONPOSITION !='".$this->ssopersonposition."' or SN !='".$this->sn."' )";
	//	$sql ="select * from db_dpis where PER_ID='" .$this->PER_ID."' and EMPLOYEETYPE='".$this->employeeType."'";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		
	
	
	//array list
					$sql ="select * from db_dpis where PER_ID='" .$this->PER_ID."' and EMPLOYEETYPE='".$this->employeeType."'";
					$rows =Yii::app()->db->createCommand($sql)->queryAll();
					var_dump($rows);
					exit;
		*/				
	
		
		/*
					$sql ="select count(*)  from db_dpis where PER_ID='" .$this->PER_ID."' and EMPLOYEETYPE='".$this->employeeType."'";
					$rows =Yii::app()->db->createCommand($sql)->queryAll();
					
					
					if($rows == 0)
					{
					var_dump("wfwefefwef");
					exit;
					*/
							$sql = "INSERT INTO db_dpis(PER_ID,SSOFIRSTNAME,SSOSURNAME,SSOPERSONCITIZENID,GIVENNAME,SSOPERSONBIRTHDATE,SSOPERSONEMPDATE,SN,ACCOUNTACTIVE,TITLE,INITIALS,WORKINGDEPTDESCRIPTION,SSOPERSONCLASS,SSOPERSONPOSITION,PICPATH,PIC_UPDATE,PER_GENDER,EMPLOYEETYPE,createby,createdate,updateby,updatedate,update_dpis)"; 
							$sql.= " VALUES(:PER_ID,:SSOFIRSTNAME,:SSOSURNAME,:SSOPERSONCITIZENID,:GIVENNAME,:SSOPERSONBIRTHDATE,:PER_STARTDATE,:SN,:ACCOUNTACTIVE,:TITLE,:INITIALS,:WORKINGDEPTDESCRIPTION,:SSOPERSONCLASS,:SSOPERSONPOSITION,:PICPATH,:PIC_UPDATE,:PER_GENDER,:EMPLOYEETYPE,:createby,now(),:updateby,now(),:UPDATE_DPIS)";			
							$command=yii::app()->db->createCommand($sql);			
							$command->bindValue(":PER_ID", $this->PER_ID);
							$command->bindValue(":SSOFIRSTNAME", $this->ssofirstname);
							$command->bindValue(":SSOSURNAME", $this->ssosurname);		
							$command->bindValue(":SSOPERSONCITIZENID", $this->ssopersoncitizenid);
							$command->bindValue(":GIVENNAME", $this->givenName);		
							$command->bindValue(":SSOPERSONBIRTHDATE", $this->ssopersonbirthdate);
							$command->bindValue(":PER_STARTDATE", $this->ssopersonempdate);		
							$command->bindValue(":SN", $this->sn);
							$command->bindValue(":ACCOUNTACTIVE", $this->accountActive);	
							$command->bindValue(":TITLE", $this->title);	
							$command->bindValue(":SSOPERSONCLASS", $this->ssopersonclass);	
							$command->bindValue(":INITIALS", $this->initials);	
						//	$command->bindValue(":PM_NAME", $this->PM_NAME);	
							$command->bindValue(":WORKINGDEPTDESCRIPTION", $this->workingdeptdescription);	
							$command->bindValue(":SSOPERSONPOSITION", $this->ssopersonposition);	
							$command->bindValue(":PER_GENDER", $this->PER_GENDER);	
							$command->bindValue(":EMPLOYEETYPE", $this->employeeType);	
						//	$command->bindValue(":active", $this->PER_PERSONALUPDATE_DATE);	
							$command->bindValue(":PICPATH", $this->PICPATH);	
							$command->bindValue(":PIC_UPDATE", $this->PIC_UPDATE);
							$command->bindValue(":createby",'AUTO');
							$command->bindValue(":updateby",'AUTO');
							$command->bindValue(":UPDATE_DPIS",$this->UPDATE_DPIS);
							if($command->execute()) {
										
							
							} else {
							
								}
								return true;
					
}
public function dataflowdpisupdateday()
{
	
	/*
		$sql ="select * from db_dpis where PER_ID='" .$this->PER_ID."' and EMPLOYEETYPE='".$this->employeeType."' and (SSOFIRSTNAME !='".$this->ssofirstname."' or SSOSURNAME !='".$this->ssosurname."' or ACCOUNTACTIVE !='".$this->accountActive."'";
		$sql.=" or EMPLOYEETYPE !='".$this->employeeType."' or GIVENNAME !='".$this->givenName."' or SSOPERSONCLASS !='".$this->ssopersonclass."' ";
		$sql.="or WORKINGDEPTDESCRIPTION !='".$this->workingdeptdescription."' or TITLE !='".$this->title."' or SSOPERSONPOSITION !='".$this->ssopersonposition."' or SN !='".$this->sn."' )";
	//	$sql ="select * from db_dpis where PER_ID='" .$this->PER_ID."' and EMPLOYEETYPE='".$this->employeeType."'";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		
	
	
	//array list
					$sql ="select * from db_dpis where PER_ID='" .$this->PER_ID."' and EMPLOYEETYPE='".$this->employeeType."'";
					$rows =Yii::app()->db->createCommand($sql)->queryAll();
					var_dump($rows);
					exit;
		*/				
	
		
		
					$sql ="select PER_ID,update_dpis,EMPLOYEETYPE from db_dpis where PER_ID='" .$this->PER_ID."' and EMPLOYEETYPE='".$this->employeeType."'";
					$rows =Yii::app()->db->createCommand($sql)->queryAll();
					foreach($rows as $dataitem)
					{
						
						$UPDATEDPIS=$dataitem["update_dpis"];
						
					}
					
					if($rows == null)
					{
					
							$sql = "INSERT INTO db_dpis(PER_ID,SSOFIRSTNAME,SSOSURNAME,SSOPERSONCITIZENID,GIVENNAME,SSOPERSONBIRTHDATE,SSOPERSONEMPDATE,SN,ACCOUNTACTIVE,TITLE,INITIALS,WORKINGDEPTDESCRIPTION,SSOPERSONCLASS,SSOPERSONPOSITION,PICPATH,PIC_UPDATE,PER_GENDER,EMPLOYEETYPE,createby,createdate,updateby,updatedate,update_dpis)"; 
							$sql.= " VALUES(:PER_ID,:SSOFIRSTNAME,:SSOSURNAME,:SSOPERSONCITIZENID,:GIVENNAME,:SSOPERSONBIRTHDATE,:PER_STARTDATE,:SN,:ACCOUNTACTIVE,:TITLE,:INITIALS,:WORKINGDEPTDESCRIPTION,:SSOPERSONCLASS,:SSOPERSONPOSITION,:PICPATH,:PIC_UPDATE,:PER_GENDER,:EMPLOYEETYPE,:createby,now(),:updateby,now(),:UPDATE_DPIS)";			
							$command=yii::app()->db->createCommand($sql);			
							$command->bindValue(":PER_ID", $this->PER_ID);
							$command->bindValue(":SSOFIRSTNAME", $this->ssofirstname);
							$command->bindValue(":SSOSURNAME", $this->ssosurname);		
							$command->bindValue(":SSOPERSONCITIZENID", $this->ssopersoncitizenid);
							$command->bindValue(":GIVENNAME", $this->givenName);		
							$command->bindValue(":SSOPERSONBIRTHDATE", $this->ssopersonbirthdate);
							$command->bindValue(":PER_STARTDATE", $this->ssopersonempdate);		
							$command->bindValue(":SN", $this->sn);
							$command->bindValue(":ACCOUNTACTIVE", $this->accountActive);	
							$command->bindValue(":TITLE", $this->title);	
							$command->bindValue(":SSOPERSONCLASS", $this->ssopersonclass);	
							$command->bindValue(":INITIALS", $this->initials);	
						//	$command->bindValue(":PM_NAME", $this->PM_NAME);	
							$command->bindValue(":WORKINGDEPTDESCRIPTION", $this->workingdeptdescription);	
							$command->bindValue(":SSOPERSONPOSITION", $this->ssopersonposition);	
							$command->bindValue(":PER_GENDER", $this->PER_GENDER);	
							$command->bindValue(":EMPLOYEETYPE", $this->employeeType);	
						//	$command->bindValue(":active", $this->PER_PERSONALUPDATE_DATE);	
							$command->bindValue(":PICPATH", $this->PICPATH);	
							$command->bindValue(":PIC_UPDATE", $this->PIC_UPDATE);
							$command->bindValue(":createby",'AUTO');
							$command->bindValue(":updateby",'AUTO');
							$command->bindValue(":UPDATE_DPIS",$this->UPDATE_DPIS);
							if($command->execute()) {
										
							
							} else {
							
								}
								return true;
								
					}else{
						
						if($UPDATEDPIS !=$this->UPDATE_DPIS)
							{
							
								$sql = "update db_dpis set SSOFIRSTNAME=:SSOFIRSTNAME,SSOFIRSTNAME=:SSOFIRSTNAME,";
								$sql.= "SSOSURNAME=:SSOSURNAME,SSOPERSONCITIZENID=:SSOPERSONCITIZENID,";
								$sql.= "GIVENNAME=:GIVENNAME,SSOPERSONBIRTHDATE=:SSOPERSONBIRTHDATE,SSOPERSONEMPDATE=:PER_STARTDATE,SN=:SN,ACCOUNTACTIVE=:ACCOUNTACTIVE,TITLE=:TITLE,SSOPERSONCLASS=:SSOPERSONCLASS,INITIALS=:INITIALS,";
							//	$sql.= "SSOPERSONPOSITION=:SSOPERSONPOSITION,PER_GENDER=:PER_GENDER,PICPATH=:PICPATH ,PIC_UPDATE=:PIC_UPDATE,EMPLOYEETYPE=:EMPLOYEETYPE, updatedate=now() ";
								$sql.= "PICPATH=:PICPATH ,PIC_UPDATE=:PIC_UPDATE,EMPLOYEETYPE=:EMPLOYEETYPE,SSOPERSONPOSITION=:SSOPERSONPOSITION,PER_GENDER=:PER_GENDER,SSOPERSONPOSITION=:SSOPERSONPOSITION,updatedate=now(),updateby=:updateby,WORKINGDEPTDESCRIPTION=:WORKINGDEPTDESCRIPTION,update_dpis=:UPDATE_DPIS ";
								$sql.= "where PER_ID='$this->PER_ID' and EMPLOYEETYPE='$this->employeeType'";
								$command=yii::app()->db->createCommand($sql);			
								$command->bindValue(":PER_ID", $this->PER_ID);
								$command->bindValue(":SSOFIRSTNAME", $this->ssofirstname);
								$command->bindValue(":SSOSURNAME", $this->ssosurname);		
								$command->bindValue(":SSOPERSONCITIZENID", $this->ssopersoncitizenid);
								$command->bindValue(":GIVENNAME", $this->givenName);		
								$command->bindValue(":SSOPERSONBIRTHDATE", $this->ssopersonbirthdate);
								$command->bindValue(":PER_STARTDATE", $this->ssopersonempdate);		
								$command->bindValue(":SN", $this->sn);
								$command->bindValue(":ACCOUNTACTIVE", $this->accountActive);	
								$command->bindValue(":TITLE", $this->title);	
								$command->bindValue(":SSOPERSONCLASS", $this->ssopersonclass);	
								$command->bindValue(":INITIALS", $this->initials);	
							//	$command->bindValue(":PM_NAME", $this->PM_NAME);
								$command->bindValue(":SSOPERSONPOSITION", $this->ssopersonposition);	
								$command->bindValue(":WORKINGDEPTDESCRIPTION", $this->workingdeptdescription);	
								$command->bindValue(":PER_GENDER", $this->PER_GENDER);	
								$command->bindValue(":EMPLOYEETYPE", $this->employeeType);	
							//	$command->bindValue(":active", $this->PER_PERSONALUPDATE_DATE);	
								$command->bindValue(":PICPATH", $this->PICPATH);	
								$command->bindValue(":PIC_UPDATE", $this->PIC_UPDATE);
								$command->bindValue(":updateby",'AUTO');
								$command->bindValue(":UPDATE_DPIS",$this->UPDATE_DPIS);
									if($command->execute()) {
													
										
									} else {
										
											}
								return true;			
							} 
							return true;
					}
			
}
public function dataflowdpiseveryday()
{
	
		$sql ="select count(*) from db_dpis where PER_ID='" .$this->PER_ID."' and EMPLOYEETYPE='".$this->employeeType."' and (SSOFIRSTNAME !='".$this->ssofirstname."' or SSOSURNAME !='".$this->ssosurname."' or ACCOUNTACTIVE !='".$this->accountActive."'";
		$sql.=" or EMPLOYEETYPE !='".$this->employeeType."' or GIVENNAME !='".$this->givenName."' or SSOPERSONCLASS !='".$this->ssopersonclass."' ";
		$sql.="or WORKINGDEPTDESCRIPTION !='".$this->workingdeptdescription."' or TITLE !='".$this->title."' or SSOPERSONPOSITION !='".$this->ssopersonposition."' or SN !='".$this->sn."' )";
	//	$sql ="select * from db_dpis where PER_ID='" .$this->PER_ID."' and EMPLOYEETYPE='".$this->employeeType."'";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		
	if(count($rows))	
	{
		
					$sql ="select * from db_dpis where PER_ID='" .$this->PER_ID."' and EMPLOYEETYPE='".$this->employeeType."'";
					$rows =Yii::app()->db->createCommand($sql)->queryAll();
					
					if($rows == null)
					{
					
							$sql = "INSERT INTO db_dpis(PER_ID,SSOFIRSTNAME,SSOSURNAME,SSOPERSONCITIZENID,GIVENNAME,SSOPERSONBIRTHDATE,SSOPERSONEMPDATE,SN,ACCOUNTACTIVE,TITLE,INITIALS,WORKINGDEPTDESCRIPTION,SSOPERSONCLASS,SSOPERSONPOSITION,PICPATH,PIC_UPDATE,PER_GENDER,EMPLOYEETYPE,createby,createdate,updateby,updatedate)"; 
							$sql.= " VALUES(:PER_ID,:SSOFIRSTNAME,:SSOSURNAME,:SSOPERSONCITIZENID,:GIVENNAME,:SSOPERSONBIRTHDATE,:PER_STARTDATE,:SN,:ACCOUNTACTIVE,:TITLE,:INITIALS,:WORKINGDEPTDESCRIPTION,:SSOPERSONCLASS,:SSOPERSONPOSITION,:PICPATH,:PIC_UPDATE,:PER_GENDER,:EMPLOYEETYPE,:createby,now(),:updateby,now())";			
							$command=yii::app()->db->createCommand($sql);			
							$command->bindValue(":PER_ID", $this->PER_ID);
							$command->bindValue(":SSOFIRSTNAME", $this->ssofirstname);
							$command->bindValue(":SSOSURNAME", $this->ssosurname);		
							$command->bindValue(":SSOPERSONCITIZENID", $this->ssopersoncitizenid);
							$command->bindValue(":GIVENNAME", $this->givenName);		
							$command->bindValue(":SSOPERSONBIRTHDATE", $this->ssopersonbirthdate);
							$command->bindValue(":PER_STARTDATE", $this->ssopersonempdate);		
							$command->bindValue(":SN", $this->sn);
							$command->bindValue(":ACCOUNTACTIVE", $this->accountActive);	
							$command->bindValue(":TITLE", $this->title);	
							$command->bindValue(":SSOPERSONCLASS", $this->ssopersonclass);	
							$command->bindValue(":INITIALS", $this->initials);	
						//	$command->bindValue(":PM_NAME", $this->PM_NAME);	
							$command->bindValue(":WORKINGDEPTDESCRIPTION", $this->workingdeptdescription);	
							$command->bindValue(":SSOPERSONPOSITION", $this->ssopersonposition);	
							$command->bindValue(":PER_GENDER", $this->PER_GENDER);	
							$command->bindValue(":EMPLOYEETYPE", $this->employeeType);	
						//	$command->bindValue(":active", $this->PER_PERSONALUPDATE_DATE);	
							$command->bindValue(":PICPATH", $this->PICPATH);	
							$command->bindValue(":PIC_UPDATE", $this->PIC_UPDATE);
							$command->bindValue(":createby",'AUTO');
							$command->bindValue(":updateby",'AUTO');
							if($command->execute()) {
										
							
							} else {
							
								}
								return true;
					}else{
						
							$sql = "update db_dpis set SSOFIRSTNAME=:SSOFIRSTNAME,SSOFIRSTNAME=:SSOFIRSTNAME,";
							$sql.= "SSOSURNAME=:SSOSURNAME,SSOPERSONCITIZENID=:SSOPERSONCITIZENID,";
							$sql.= "GIVENNAME=:GIVENNAME,SSOPERSONBIRTHDATE=:SSOPERSONBIRTHDATE,SSOPERSONEMPDATE=:PER_STARTDATE,SN=:SN,ACCOUNTACTIVE=:ACCOUNTACTIVE,TITLE=:TITLE,SSOPERSONCLASS=:SSOPERSONCLASS,INITIALS=:INITIALS,";
						//	$sql.= "SSOPERSONPOSITION=:SSOPERSONPOSITION,PER_GENDER=:PER_GENDER,PICPATH=:PICPATH ,PIC_UPDATE=:PIC_UPDATE,EMPLOYEETYPE=:EMPLOYEETYPE, updatedate=now() ";
							$sql.= "PICPATH=:PICPATH ,PIC_UPDATE=:PIC_UPDATE,EMPLOYEETYPE=:EMPLOYEETYPE,SSOPERSONPOSITION=:SSOPERSONPOSITION,PER_GENDER=:PER_GENDER,SSOPERSONPOSITION=:SSOPERSONPOSITION,updatedate=now(),updateby=:updateby,WORKINGDEPTDESCRIPTION=:WORKINGDEPTDESCRIPTION ";
							$sql.= "where PER_ID='$this->PER_ID' and EMPLOYEETYPE='$this->employeeType'";
							$command=yii::app()->db->createCommand($sql);			
							$command->bindValue(":PER_ID", $this->PER_ID);
							$command->bindValue(":SSOFIRSTNAME", $this->ssofirstname);
							$command->bindValue(":SSOSURNAME", $this->ssosurname);		
							$command->bindValue(":SSOPERSONCITIZENID", $this->ssopersoncitizenid);
							$command->bindValue(":GIVENNAME", $this->givenName);		
							$command->bindValue(":SSOPERSONBIRTHDATE", $this->ssopersonbirthdate);
							$command->bindValue(":PER_STARTDATE", $this->ssopersonempdate);		
							$command->bindValue(":SN", $this->sn);
							$command->bindValue(":ACCOUNTACTIVE", $this->accountActive);	
							$command->bindValue(":TITLE", $this->title);	
							$command->bindValue(":SSOPERSONCLASS", $this->ssopersonclass);	
							$command->bindValue(":INITIALS", $this->initials);	
						//	$command->bindValue(":PM_NAME", $this->PM_NAME);
							$command->bindValue(":SSOPERSONPOSITION", $this->ssopersonposition);	
							$command->bindValue(":WORKINGDEPTDESCRIPTION", $this->workingdeptdescription);	
							$command->bindValue(":PER_GENDER", $this->PER_GENDER);	
							$command->bindValue(":EMPLOYEETYPE", $this->employeeType);	
						//	$command->bindValue(":active", $this->PER_PERSONALUPDATE_DATE);	
							$command->bindValue(":PICPATH", $this->PICPATH);	
							$command->bindValue(":PIC_UPDATE", $this->PIC_UPDATE);
							$command->bindValue(":updateby",'AUTO');
							
								if($command->execute()) {
												
									
								} else {
									
										}
							return true;			
						} 
		}else
		{
			
			return true;
		}
			
}		
public function dataprocessumday()
{
	
	
	
						$sql ="select DeptID  from mas_department  where StatusData!=0 and DeptNameTH='".$this->workingdeptdescription."'";
						$rows =Yii::app()->db->createCommand($sql)->queryAll();
						if($rows !=null)
						{
							$DeptID='';
							foreach ($rows as $dataitem)
									{
										$DeptID=$dataitem["DeptID"];
									}
							
												
									
								
						}else{
								
								$DeptID='';
								
								}	
						
						$sql ="select PositID  from mas_position  where StatusData!=0 and PositNameTH='".$this->ssopersonposition."'";
						$rows =Yii::app()->db->createCommand($sql)->queryAll();
						//var_dump($rows);
						//exit;
						if($rows !=null)
						{
							$PositID='';		
							foreach ($rows as $dataitem)
								{
									$PositID=$dataitem["PositID"];
								}
							
						}else
							{
							
								
								
								$PositID='';			
								
									
							}
							
						
						$sql ="select pf_id  from mas_prefix where pf_status!=0 and pf_description='".$this->initials."'";
						$rows1 =Yii::app()->db->createCommand($sql)->queryAll();
					
						if($rows1 !=null)	
						{
							$PrefixID='';
							foreach ($rows1 as $dataitem)
							{
								$PrefixID=$dataitem["pf_id"];
								
							}
							
						}else
							{
								
								$PrefixID='';				
										
				
							}
						$sql ="select ut_id  from mas_user_type where ut_status!=0 and ut_name='".$this->employeeType."'";
						$rows2 =Yii::app()->db->createCommand($sql)->queryAll();
						
						if($rows2 !=null)
						{
							$EmpTypeID='';
							foreach ($rows2 as $dataitem)
								{
									$EmpTypeID=$dataitem["ut_id"];
								//	var_dump($EmpTypeID);
								//	exit;
									
								}
						//	var_dump($EmpTypeID);
						//	exit;
							
						
						}
						else
						{
							
							$EmpTypeID='';				
									
						}
						
						$sql ="select PositLevelID  from mas_position_le  where StatusData!=0 and PositLevelNameTH='".$this->ssopersonclass."'";
						$rows =Yii::app()->db->createCommand($sql)->queryAll();
					//	var_dump($this->ssopersonclass);
					//	exit;
						if($rows !=null)
						{
							$PositLevelID='';	
							foreach ($rows as $dataitem)
								{
									$PositLevelID=$dataitem["PositLevelID"];
								}
						
						}else
							{
								$PositLevelID='';
									
									
							}
					
			$host=Yii::app()->params['prg_ctrl']['ipservice']['ipzonedev']; 
			
			if($this->ssopersoncitizenid !="")
			{
				$data_array = array("filter" => array("exp" => $this->ssopersoncitizenid),);	
				$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/ldapinfosearch.php', json_encode($data_array));
				$data = json_decode($make_call, true);
				foreach($data as $key => $val)
					{
						if($key=='code'){
							$code=$val["code"];
						}
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
		
			}
			else{
				
				$code=204;
			}
		
		
		if(Yii::app()->session['em_username']!='')
		{
			$addby=Yii::app()->session['em_username'];
		}else
		{
			$addby='systems';
			
		}
		$sql ="select em_per_id  from um_employee where em_status!=0  and  em_per_id='".$this->PER_ID."'and mas_user_type_id='".$EmpTypeID."' and em_citizen_id='".$this->ssopersoncitizenid."'";
		$userid1 =Yii::app()->db->createCommand($sql)->queryAll();
		if($this->givenName=='' || $this->sn=='' ||$this->workingdeptdescription==''|| $this->ssopersonposition =='' || $this->ssopersoncitizenid ==''|| $this->ssopersonclass=='' || $this->ssopersonbirthdate==''|| $this->ssopersonempdate== '' || $this->accountActive =='' || $this->initials=='' || $this->employeeType=='' || $this->accountActive ==2)
		{
					if($userid1 == null && $code==204) //ถ้าไม่มีใน employee ไม่มีในldap
					{  
					
							$sql = "INSERT INTO um_employee(em_per_id,em_name_th,em_surname_th,em_citizen_id,em_name_en,em_birthday,em_workactive_date,em_surname_en,em_work_status,createdate,mas_prefix_id,um_user_group_id,createby,um_data_complete_id,mas_position_le_id,mas_user_type_id,mas_department_id,um_position_id,em_image,em_password,em_status,em_description,em_in_phone,em_mobile,um_assign_id,um_user_module_id,updateby,updatedate)"; 
							$sql.= " VALUES(:em_per_id,:em_name_th,:em_surname_th,:em_citizen_id,:em_name_en,:em_birthday,:em_workactive_date,:em_surname_en,:em_work_status,now(),:mas_prefix_id,:um_user_group_id,:createby,:um_data_complete_id,:mas_position_le_id,:mas_user_type_id,:mas_department_id,:um_position_id,:em_image,:em_password,:em_status,:em_description,:em_in_phone,:em_mobile,:um_assign_id,:um_user_module_id,:updateby,now())";			
							$command=yii::app()->db->createCommand($sql);			
						//	$command->bindValue(":em_username",$uidname );
							$command->bindValue(":em_per_id", $this->PER_ID);
							$command->bindValue(":em_name_th", $this->ssofirstname);
							$command->bindValue(":em_surname_th", $this->ssosurname);		
							$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
							$command->bindValue(":em_name_en", $this->givenName);
							$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
							$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
							$command->bindValue(":em_surname_en", $this->sn);	
							$command->bindValue(":em_work_status", $this->accountActive);
							$command->bindValue(":mas_prefix_id", $PrefixID);
							$command->bindValue(":um_user_group_id", 3);
							$command->bindValue(":createby",$addby);
							$command->bindValue(":um_data_complete_id", 0);
							$command->bindValue(":mas_position_le_id", $PositLevelID);	
							$command->bindValue(":mas_user_type_id", $EmpTypeID);	
							$command->bindValue(":mas_department_id", $DeptID);	
							$command->bindValue(":um_position_id", $PositID);	
						//	$command->bindValue(":em_email", $mails);
							$command->bindValue(":em_image", $this->PICPATH);
							$command->bindValue(":em_password", 0);	
							$command->bindValue(":em_status", 1);		
							$command->bindValue(":em_description",0);
							$command->bindValue(":em_in_phone", 0);
							$command->bindValue(":em_mobile", 0);
							$command->bindValue(":um_assign_id", 0);
							$command->bindValue(":um_user_module_id", 0);
							$command->bindValue(":updateby", $addby);
							if($command->execute()) {
															
													
							} else {
														
														
								}
													
														
							return true;
					}
					else if ($userid1 == null && $code==200 )//ถ้าไม่มีใน employee แต่มีใน ldap	
					{
						
							foreach ($uid as $dataitem)
									{
										
										$userid=$dataitem["uid"];
										$mailldap=isset($dataitem['mail'])?addslashes(trim($dataitem['mail'])):'';
									
									}
						
						
							$sql = "INSERT INTO um_employee(em_username,em_per_id,em_name_th,em_surname_th,em_citizen_id,em_name_en,em_birthday,em_workactive_date,em_surname_en,em_work_status,createdate,mas_prefix_id,um_user_group_id,createby,um_data_complete_id,mas_position_le_id,mas_user_type_id,mas_department_id,um_position_id,em_image,em_password,em_status,em_description,em_in_phone,em_mobile,um_assign_id,um_user_module_id,updateby,updatedate,em_email)"; 
							$sql.= " VALUES(:em_username,:em_per_id,:em_name_th,:em_surname_th,:em_citizen_id,:em_name_en,:em_birthday,:em_workactive_date,:em_surname_en,:em_work_status,now(),:mas_prefix_id,:um_user_group_id,:createby,:um_data_complete_id,:mas_position_le_id,:mas_user_type_id,:mas_department_id,:um_position_id,:em_image,:em_password,:em_status,:em_description,:em_in_phone,:em_mobile,:um_assign_id,:um_user_module_id,:updateby,now(),:em_email)";			
							$command=yii::app()->db->createCommand($sql);
							$command->bindValue(":em_username",$userid );
							$command->bindValue(":em_per_id", $this->PER_ID);
							$command->bindValue(":em_name_th", $this->ssofirstname);
							$command->bindValue(":em_surname_th", $this->ssosurname);		
							$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
							$command->bindValue(":em_name_en", $this->givenName);
							$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
							$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
							$command->bindValue(":em_surname_en", $this->sn);	
							$command->bindValue(":em_work_status", $this->accountActive);
							$command->bindValue(":mas_prefix_id", $PrefixID);
							$command->bindValue(":um_user_group_id", 3);
							$command->bindValue(":createby",$addby);
							$command->bindValue(":um_data_complete_id", 0);
							$command->bindValue(":mas_position_le_id", $PositLevelID);	
							$command->bindValue(":mas_user_type_id", $EmpTypeID);	
							$command->bindValue(":mas_department_id", $DeptID);	
							$command->bindValue(":um_position_id", $PositID);	
							$command->bindValue(":em_email", $mailldap);
							$command->bindValue(":em_image", $this->PICPATH);
							$command->bindValue(":em_password", 0);	
							$command->bindValue(":em_status", 1);		
							$command->bindValue(":em_description",0);
							$command->bindValue(":em_in_phone", 0);
							$command->bindValue(":em_mobile", 0);
							$command->bindValue(":um_assign_id", 0);
							$command->bindValue(":um_user_module_id", 0);
							$command->bindValue(":updateby", $addby);
							if($command->execute()) {
															
													
							} else {
														
														
								}
													
														
							
						
							return true;
					}
					else
					{
						
							// $sql = "update um_employee set em_per_id=:em_per_id,em_name_th=:em_name_th,em_surname_th=:em_surname_th,em_citizen_id=:em_citizen_id,em_name_en=:em_name_en, ";
							// $sql.= "em_birthday=:em_birthday,em_workactive_date=:em_workactive_date,em_surname_en=:em_surname_en,em_work_status=:em_work_status,mas_prefix_id=:mas_prefix_id,";
							// $sql.= "updateby=:updateby,UpdateDate=now(),um_data_complete_id=:um_data_complete_id,mas_position_le_id=:mas_position_le_id,mas_user_type_id=:mas_user_type_id,mas_department_id=:mas_department_id, ";
							// $sql.= "um_position_id=:um_position_id,em_image=:em_image where em_citizen_id='".$this->ssopersoncitizenid."' and em_per_id='".$this->PER_ID."'";
							$sql = "update um_employee set em_per_id=:em_per_id,em_name_th=:em_name_th,em_surname_th=:em_surname_th,em_citizen_id=:em_citizen_id,em_name_en=:em_name_en, ";
							$sql.= "em_birthday=:em_birthday,em_workactive_date=:em_workactive_date,em_surname_en=:em_surname_en,em_work_status=:em_work_status,mas_prefix_id=:mas_prefix_id,";
							$sql.= "updateby=:updateby,UpdateDate=now(),um_data_complete_id=:um_data_complete_id,mas_position_le_id=:mas_position_le_id,mas_user_type_id=:mas_user_type_id, ";
							$sql.= "um_position_id=:um_position_id,em_image=:em_image where em_citizen_id='".$this->ssopersoncitizenid."' and em_per_id='".$this->PER_ID."'and mas_user_type_id='".$EmpTypeID."'";

							$command=yii::app()->db->createCommand($sql);
							$command->bindValue(":em_per_id", $this->PER_ID);
							$command->bindValue(":em_name_th", $this->ssofirstname);
							$command->bindValue(":em_surname_th", $this->ssosurname);		
							$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
							$command->bindValue(":em_name_en", $this->givenName);
									
							$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
							$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
							$command->bindValue(":em_surname_en", $this->sn);	
							$command->bindValue(":em_work_status", $this->accountActive);
							$command->bindValue(":mas_prefix_id", $PrefixID);
									
						//	$command->bindValue(":um_user_group_id", 3);
							$command->bindValue(":updateby",$addby);
							$command->bindValue(":um_data_complete_id", 0);
							$command->bindValue(":mas_position_le_id", $PositLevelID);	
							$command->bindValue(":mas_user_type_id", $EmpTypeID);	
							// $command->bindValue(":mas_department_id", $DeptID);	
									
							$command->bindValue(":um_position_id", $PositID);	
									//$command->bindValue(":em_email", $mails);	
							$command->bindValue(":em_image", $this->PICPATH);
							if($command->execute()) {
															
													
							} else {
														
														
								}
							return true;
					}
		}else //ถ้าข้อมูลครบตามกำหนด
		{
			
					if($userid1 == null && $code==204) //ถ้าไม่มีใน employee ให้ insert
					{ 
					
										$arr_char="";
										$username="";
										$arr_char = str_split($this->sn);
										$username=$arr_char[0].$this->givenName;
										$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
										$data_array = array("filter" => array("exp" => $username),);	
										$make_call = lkup_oracledpis::CallAPI('POST',  $host.'/umapi/ldapinfosearch.php', json_encode($data_array));
										$data = json_decode($make_call, true);
										foreach($data as $key => $val)
											{
												if($key=='code'){
													$datacode=$val["code"];
												}
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
								
											if($datacode==204)
												{
																			
																	
																
												}else{
														
														$arr_char = str_split($this->sn,2);
														$username=$arr_char[0].$this->givenName;
														$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
														$data_array = array("filter" => array("exp" => $username),);	
														$make_call = lkup_oracledpis::CallAPI('POST',  $host.'/umapi/ldapinfosearch.php', json_encode($data_array));
														$data = json_decode($make_call, true);
														foreach($data as $key => $val)
															{
																if($key=='code'){
																	$datacode=$val["code"];
																}
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
															
														if($datacode==204)
															{
																				
																		
															}else{
																	
																$arr_char = str_split($this->sn,3);
																$username=$arr_char[0].$this->givenName;
																$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
																		
																			
																		
																}
													}
											
							
									$sql = "INSERT INTO um_employee(em_per_id,em_username,em_name_th,em_surname_th,em_citizen_id,em_name_en,em_birthday,em_workactive_date,em_surname_en,em_work_status,createdate,mas_prefix_id,um_user_group_id,createby,um_data_complete_id,mas_position_le_id,mas_user_type_id,mas_department_id,um_position_id,em_email,em_image,em_password,em_status,em_description,em_in_phone,em_mobile,um_assign_id,um_user_module_id,updateby,updatedate)"; 
									$sql.= " VALUES(:em_per_id,:em_username,:em_name_th,:em_surname_th,:em_citizen_id,:em_name_en,:em_birthday,:em_workactive_date,:em_surname_en,:em_work_status,now(),:mas_prefix_id,:um_user_group_id,:createby,:um_data_complete_id,:mas_position_le_id,:mas_user_type_id,:mas_department_id,:um_position_id,:em_email,:em_image,:em_password,:em_status,:em_description,:em_in_phone,:em_mobile,:um_assign_id,:um_user_module_id,:updateby,now())";			
									$command=yii::app()->db->createCommand($sql);			
									$command->bindValue(":em_username",$username );
									$command->bindValue(":em_per_id", $this->PER_ID);
									$command->bindValue(":em_name_th", $this->ssofirstname);
									$command->bindValue(":em_surname_th", $this->ssosurname);		
									$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
									$command->bindValue(":em_name_en", $this->givenName);
									$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
									$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
									$command->bindValue(":em_surname_en", $this->sn);	
									$command->bindValue(":em_work_status", $this->accountActive);
									$command->bindValue(":mas_prefix_id", $PrefixID);
									$command->bindValue(":um_user_group_id", 3);
									$command->bindValue(":createby",$addby);
									$command->bindValue(":um_data_complete_id", 1);
									$command->bindValue(":mas_position_le_id", $PositLevelID);	
									$command->bindValue(":mas_user_type_id", $EmpTypeID);	
									$command->bindValue(":mas_department_id", $DeptID);	
									$command->bindValue(":um_position_id", $PositID);	
									$command->bindValue(":em_email", $mail);
									$command->bindValue(":em_image", $this->PICPATH);
									$command->bindValue(":em_password", 0);	
									$command->bindValue(":em_status", 1);		
									$command->bindValue(":em_description",0);
									$command->bindValue(":em_in_phone", 0);
									$command->bindValue(":em_mobile", 0);
									$command->bindValue(":um_assign_id", 0);
									$command->bindValue(":um_user_module_id", 0);
									$command->bindValue(":updateby", $addby);
									if($command->execute()) {						
													
									} else {
																
																
										}
							frm_profile::updateldap($username,$DeptID);						
														
							return true;
					}		
					else if ($userid1 == null && $code==200 )//ถ้าไม่มีใน employee แต่มีใน ldap	
					{
					
							foreach ($uid as $dataitem)
									{
										
										$userid=$dataitem["uid"];
										$mail1=isset($dataitem['mail'])?addslashes(trim($dataitem['mail'])):'';
																	
									}
																
							$sql = "INSERT INTO um_employee(em_username,em_per_id,em_name_th,em_surname_th,em_citizen_id,em_name_en,em_birthday,em_workactive_date,em_surname_en,em_work_status,createdate,mas_prefix_id,um_user_group_id,createby,um_data_complete_id,mas_position_le_id,mas_user_type_id,mas_department_id,um_position_id,em_image,em_password,em_status,em_description,em_in_phone,em_mobile,um_assign_id,um_user_module_id,updateby,updatedate,em_email)"; 
							$sql.= " VALUES(:em_username,:em_per_id,:em_name_th,:em_surname_th,:em_citizen_id,:em_name_en,:em_birthday,:em_workactive_date,:em_surname_en,:em_work_status,now(),:mas_prefix_id,:um_user_group_id,:createby,:um_data_complete_id,:mas_position_le_id,:mas_user_type_id,:mas_department_id,:um_position_id,:em_image,:em_password,:em_status,:em_description,:em_in_phone,:em_mobile,:um_assign_id,:um_user_module_id,:updateby,now(),:em_email)";			
							$command=yii::app()->db->createCommand($sql);
							$command->bindValue(":em_username",$userid );
							$command->bindValue(":em_per_id", $this->PER_ID);
							$command->bindValue(":em_name_th", $this->ssofirstname);
							$command->bindValue(":em_surname_th", $this->ssosurname);		
							$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
							$command->bindValue(":em_name_en", $this->givenName);
							$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
							$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
							$command->bindValue(":em_surname_en", $this->sn);	
							$command->bindValue(":em_work_status", $this->accountActive);
							$command->bindValue(":mas_prefix_id", $PrefixID);
							$command->bindValue(":um_user_group_id", 3);
							$command->bindValue(":createby",$addby);
							$command->bindValue(":um_data_complete_id", 1);
							$command->bindValue(":mas_position_le_id", $PositLevelID);	
							$command->bindValue(":mas_user_type_id", $EmpTypeID);	
							$command->bindValue(":mas_department_id", $DeptID);	
							$command->bindValue(":um_position_id", $PositID);	
							$command->bindValue(":em_email", $mail1);
							$command->bindValue(":em_image", $this->PICPATH);
							$command->bindValue(":em_password", 0);	
							$command->bindValue(":em_status", 1);		
							$command->bindValue(":em_description",0);
							$command->bindValue(":em_in_phone", 0);
							$command->bindValue(":em_mobile", 0);
							$command->bindValue(":um_assign_id", 0);
							$command->bindValue(":um_user_module_id", 0);
							$command->bindValue(":updateby", $addby);
							if($command->execute()) {
															
													
							} else {
														
														
								}
																				
							frm_profile::updateldap($userid,$DeptID);							
							return true;	
					}	

					if($userid1 != null && $code==204)
					{
										$arr_char="";
										$username="";
										$arr_char = str_split($this->sn);
										$username=$arr_char[0].$this->givenName;
										$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
										$data_array = array("filter" => array("exp" => $username),);	
										$make_call = lkup_oracledpis::CallAPI('POST',  $host.'/umapi/ldapinfosearch.php', json_encode($data_array));
										$data = json_decode($make_call, true);
										foreach($data as $key => $val)
											{
												if($key=='code'){
													$datacode=$val["code"];
												}
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
								
											if($datacode==204)
												{
																			
																	
																
												}else{
														
														$arr_char = str_split($this->sn,2);
														$username=$arr_char[0].$this->givenName;
														$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
														$data_array = array("filter" => array("exp" => $username),);	
														$make_call = lkup_oracledpis::CallAPI('POST',  $host.'/umapi/ldapinfosearch.php', json_encode($data_array));
														$data = json_decode($make_call, true);
														foreach($data as $key => $val)
															{
																if($key=='code'){
																	$datacode=$val["code"];
																}
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
															
														if($datacode==204)
															{
																				
																		
															}else{
																	
																$arr_char = str_split($this->sn,3);
																$username=$arr_char[0].$this->givenName;
																$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
																		
																			
																		
																}
													}
									// $sql = "update um_employee set em_username=:em_username,em_per_id=:em_per_id,em_name_th=:em_name_th,em_surname_th=:em_surname_th,em_citizen_id=:em_citizen_id,em_name_en=:em_name_en, ";
									// $sql.= "em_birthday=:em_birthday,em_workactive_date=:em_workactive_date,em_surname_en=:em_surname_en,em_work_status=:em_work_status,mas_prefix_id=:mas_prefix_id,";
									// $sql.= "um_user_group_id=:um_user_group_id,updateby=:updateby,UpdateDate=now(),um_data_complete_id=:um_data_complete_id,mas_position_le_id=:mas_position_le_id,mas_user_type_id=:mas_user_type_id,mas_department_id=:mas_department_id, ";
									// $sql.= "um_position_id=:um_position_id,em_email=:em_email,em_image=:em_image where em_username='".$username."'";

									$sql = "update um_employee set em_username=:em_username,em_per_id=:em_per_id,em_name_th=:em_name_th,em_surname_th=:em_surname_th,em_citizen_id=:em_citizen_id,em_name_en=:em_name_en, ";
									$sql.= "em_birthday=:em_birthday,em_workactive_date=:em_workactive_date,em_surname_en=:em_surname_en,em_work_status=:em_work_status,mas_prefix_id=:mas_prefix_id,";
									$sql.= "um_user_group_id=:um_user_group_id,updateby=:updateby,UpdateDate=now(),um_data_complete_id=:um_data_complete_id,mas_position_le_id=:mas_position_le_id,mas_user_type_id=:mas_user_type_id, ";
									$sql.= "um_position_id=:um_position_id,em_email=:em_email,em_image=:em_image where em_citizen_id='".$this->ssopersoncitizenid."' and em_per_id='".$this->PER_ID."'and mas_user_type_id='".$EmpTypeID."'";

									$command=yii::app()->db->createCommand($sql);
									$command->bindValue(":em_username",$username );
									$command->bindValue(":em_per_id", $this->PER_ID);
									$command->bindValue(":em_name_th", $this->ssofirstname);
									$command->bindValue(":em_surname_th", $this->ssosurname);		
									$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
									$command->bindValue(":em_name_en", $this->givenName);
									
									$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
									$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
									$command->bindValue(":em_surname_en", $this->sn);	
									$command->bindValue(":em_work_status", $this->accountActive);
									$command->bindValue(":mas_prefix_id", $PrefixID);
									
									$command->bindValue(":um_user_group_id", 3);
									$command->bindValue(":updateby",$addby);
									$command->bindValue(":um_data_complete_id", 1);
									$command->bindValue(":mas_position_le_id", $PositLevelID);	
									$command->bindValue(":mas_user_type_id", $EmpTypeID);	
									// $command->bindValue(":mas_department_id", $DeptID);	
									
									$command->bindValue(":um_position_id", $PositID);	
									$command->bindValue(":em_email", $mail);	
									$command->bindValue(":em_image", $this->PICPATH);
									if($command->execute()) {
															
													
									} else {
																
																
										}
							frm_profile::updateldap($username,$DeptID);
							return true;						
					}
					else
					{
					//	var_dump("eferfefer");
					//	exit;
							foreach ($uid as $dataitem)
										{
											
											$userid=$dataitem["uid"];
										//	$mail1=isset($dataitem['mail'])?addslashes(trim($dataitem['mail'])):'';
										
										}
									
									// $sql = "update um_employee set em_per_id=:em_per_id,em_name_th=:em_name_th,em_surname_th=:em_surname_th,em_citizen_id=:em_citizen_id,em_name_en=:em_name_en, ";
									// $sql.= "em_birthday=:em_birthday,em_workactive_date=:em_workactive_date,em_surname_en=:em_surname_en,em_work_status=:em_work_status,mas_prefix_id=:mas_prefix_id,";
									// $sql.= "updateby=:updateby,UpdateDate=now(),um_data_complete_id=:um_data_complete_id,mas_position_le_id=:mas_position_le_id,mas_user_type_id=:mas_user_type_id,mas_department_id=:mas_department_id, ";
									// $sql.= "um_position_id=:um_position_id,em_image=:em_image where em_username='".$userid."'";

									$sql = "update um_employee set em_per_id=:em_per_id,em_name_th=:em_name_th,em_surname_th=:em_surname_th,em_citizen_id=:em_citizen_id,em_name_en=:em_name_en, ";
									$sql.= "em_birthday=:em_birthday,em_workactive_date=:em_workactive_date,em_surname_en=:em_surname_en,em_work_status=:em_work_status,mas_prefix_id=:mas_prefix_id,";
									$sql.= "updateby=:updateby,UpdateDate=now(),um_data_complete_id=:um_data_complete_id,mas_position_le_id=:mas_position_le_id,mas_user_type_id=:mas_user_type_id, ";
									$sql.= "um_position_id=:um_position_id,em_image=:em_image where em_username='".$userid."'";

									$command=yii::app()->db->createCommand($sql);
									$command->bindValue(":em_per_id", $this->PER_ID);
									$command->bindValue(":em_name_th", $this->ssofirstname);
									$command->bindValue(":em_surname_th", $this->ssosurname);		
									$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
									$command->bindValue(":em_name_en", $this->givenName);
									
									$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
									$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
									$command->bindValue(":em_surname_en", $this->sn);	
									$command->bindValue(":em_work_status", $this->accountActive);
									$command->bindValue(":mas_prefix_id", $PrefixID);
									
								//	$command->bindValue(":um_user_group_id", 3);
									$command->bindValue(":updateby",$addby);
									$command->bindValue(":um_data_complete_id", 1);
									$command->bindValue(":mas_position_le_id", $PositLevelID);	
									$command->bindValue(":mas_user_type_id", $EmpTypeID);	
									// $command->bindValue(":mas_department_id", $DeptID);	
									
									$command->bindValue(":um_position_id", $PositID);	
							//		$command->bindValue(":em_email", $mail1);	
									$command->bindValue(":em_image", $this->PICPATH);
							if($command->execute()) {
															
													
							} else {
														
														
								}
							frm_profile::updateldap($userid,$DeptID);
							return true;
					}
		}
	
					
}	
public function dataprocessum()
{
	
	
	
						$sql ="select DeptID  from mas_department  where StatusData!=0 and DeptNameTH='".$this->workingdeptdescription."'";
						$rows =Yii::app()->db->createCommand($sql)->queryAll();
						if($rows !=null)
						{
							$DeptID='';
							foreach ($rows as $dataitem)
									{
										$DeptID=$dataitem["DeptID"];
									}
							
												
									
								
						}else{
								
								$DeptID='';
								
								}	
						
						$sql ="select PositID  from mas_position  where StatusData!=0 and PositNameTH='".$this->ssopersonposition."'";
						$rows =Yii::app()->db->createCommand($sql)->queryAll();
						//var_dump($rows);
						//exit;
						if($rows !=null)
						{
							$PositID='';		
							foreach ($rows as $dataitem)
								{
									$PositID=$dataitem["PositID"];
								}
							
						}else
							{
							
								
								
								$PositID='';			
								
									
							}
							
						
						$sql ="select pf_id  from mas_prefix where pf_status!=0 and pf_description='".$this->initials."'";
						$rows1 =Yii::app()->db->createCommand($sql)->queryAll();
					
						if($rows1 !=null)	
						{
							$PrefixID='';
							foreach ($rows1 as $dataitem)
							{
								$PrefixID=$dataitem["pf_id"];
								
							}
							
						}else
							{
								
								$PrefixID='';				
										
				
							}
						$sql ="select ut_id  from mas_user_type where ut_status!=0 and ut_name='".$this->employeeType."'";
						$rows2 =Yii::app()->db->createCommand($sql)->queryAll();
						
						if($rows2 !=null)
						{
							$EmpTypeID='';
							foreach ($rows2 as $dataitem)
								{
									$EmpTypeID=$dataitem["ut_id"];
								//	var_dump($EmpTypeID);
								//	exit;
									
								}
						//	var_dump($EmpTypeID);
						//	exit;
							
						
						}
						else
						{
							
							$EmpTypeID='';				
									
						}
						
						$sql ="select PositLevelID  from mas_position_le  where StatusData!=0 and PositLevelNameTH='".$this->ssopersonclass."'";
						$rows =Yii::app()->db->createCommand($sql)->queryAll();
					//	var_dump($this->ssopersonclass);
					//	exit;
						if($rows !=null)
						{
							$PositLevelID='';	
							foreach ($rows as $dataitem)
								{
									$PositLevelID=$dataitem["PositLevelID"];
								}
						
						}else
							{
								$PositLevelID='';
									
									
							}
					
			$host=Yii::app()->params['prg_ctrl']['ipservice']['ipzonedev']; 
			
			if($this->ssopersoncitizenid !="")
			{
				$data_array = array("filter" => array("exp" => $this->ssopersoncitizenid),);	
				$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/ldapinfosearch.php', json_encode($data_array));
				$data = json_decode($make_call, true);
				foreach($data as $key => $val)
					{
						if($key=='code'){
							$code=$val["code"];
						}
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
		
			}
			else{
				
				$code=204;
			}
		
		
		if(Yii::app()->session['em_username']!='')
		{
			$addby=Yii::app()->session['em_username'];
		}else
		{
			$addby='systems';
			
		}
		
		if($this->givenName=='' || $this->sn=='' ||$this->workingdeptdescription==''|| $this->ssopersonposition =='' || $this->ssopersoncitizenid ==''|| $this->ssopersonclass=='' || $this->ssopersonbirthdate==''|| $this->ssopersonempdate== '' || $this->accountActive =='' || $this->initials=='' || $this->employeeType=='' || $this->accountActive ==2)
		{	  
					if($code==204) //ถ้าไม่มีใน employee ไม่มีในldap
					{  
					
							$sql = "INSERT INTO um_employee(em_per_id,em_name_th,em_surname_th,em_citizen_id,em_name_en,em_birthday,em_workactive_date,em_surname_en,em_work_status,createdate,mas_prefix_id,um_user_group_id,createby,um_data_complete_id,mas_position_le_id,mas_user_type_id,mas_department_id,um_position_id,em_image,em_password,em_status,em_description,em_in_phone,em_mobile,um_assign_id,um_user_module_id,updateby,updatedate)"; 
							$sql.= " VALUES(:em_per_id,:em_name_th,:em_surname_th,:em_citizen_id,:em_name_en,:em_birthday,:em_workactive_date,:em_surname_en,:em_work_status,now(),:mas_prefix_id,:um_user_group_id,:createby,:um_data_complete_id,:mas_position_le_id,:mas_user_type_id,:mas_department_id,:um_position_id,:em_image,:em_password,:em_status,:em_description,:em_in_phone,:em_mobile,:um_assign_id,:um_user_module_id,:updateby,now())";			
							$command=yii::app()->db->createCommand($sql);			
						//	$command->bindValue(":em_username",$uidname );
							$command->bindValue(":em_per_id", $this->PER_ID);
							$command->bindValue(":em_name_th", $this->ssofirstname);
							$command->bindValue(":em_surname_th", $this->ssosurname);		
							$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
							$command->bindValue(":em_name_en", $this->givenName);
							$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
							$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
							$command->bindValue(":em_surname_en", $this->sn);	
							$command->bindValue(":em_work_status", $this->accountActive);
							$command->bindValue(":mas_prefix_id", $PrefixID);
							$command->bindValue(":um_user_group_id", 3);
							$command->bindValue(":createby",$addby);
							$command->bindValue(":um_data_complete_id", 0);
							$command->bindValue(":mas_position_le_id", $PositLevelID);	
							$command->bindValue(":mas_user_type_id", $EmpTypeID);	
							$command->bindValue(":mas_department_id", $DeptID);	
							$command->bindValue(":um_position_id", $PositID);	
						//	$command->bindValue(":em_email", $mails);
							$command->bindValue(":em_image", $this->PICPATH);
							$command->bindValue(":em_password", 0);	
							$command->bindValue(":em_status", 1);		
							$command->bindValue(":em_description",0);
							$command->bindValue(":em_in_phone", 0);
							$command->bindValue(":em_mobile", 0);
							$command->bindValue(":um_assign_id", 0);
							$command->bindValue(":um_user_module_id", 0);
							$command->bindValue(":updateby", $addby);
							if($command->execute()) {
															
													
							} else {
														
														
								}
													
						//	frm_profile::updateldap($username,$DeptID);							
							return true;
					}
					else if ($code==200 )//ถ้าไม่มีใน employee แต่มีใน ldap	
					{
						
							foreach ($uid as $dataitem)
									{
										
										$userid=$dataitem["uid"];
										$mailldap=isset($dataitem['mail'])?addslashes(trim($dataitem['mail'])):'';
									
									}
						
						
							$sql = "INSERT INTO um_employee(em_username,em_per_id,em_name_th,em_surname_th,em_citizen_id,em_name_en,em_birthday,em_workactive_date,em_surname_en,em_work_status,createdate,mas_prefix_id,um_user_group_id,createby,um_data_complete_id,mas_position_le_id,mas_user_type_id,mas_department_id,um_position_id,em_image,em_password,em_status,em_description,em_in_phone,em_mobile,um_assign_id,um_user_module_id,updateby,updatedate,em_email)"; 
							$sql.= " VALUES(:em_username,:em_per_id,:em_name_th,:em_surname_th,:em_citizen_id,:em_name_en,:em_birthday,:em_workactive_date,:em_surname_en,:em_work_status,now(),:mas_prefix_id,:um_user_group_id,:createby,:um_data_complete_id,:mas_position_le_id,:mas_user_type_id,:mas_department_id,:um_position_id,:em_image,:em_password,:em_status,:em_description,:em_in_phone,:em_mobile,:um_assign_id,:um_user_module_id,:updateby,now(),:em_email)";			
							$command=yii::app()->db->createCommand($sql);
							$command->bindValue(":em_username",$userid );
							$command->bindValue(":em_per_id", $this->PER_ID);
							$command->bindValue(":em_name_th", $this->ssofirstname);
							$command->bindValue(":em_surname_th", $this->ssosurname);		
							$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
							$command->bindValue(":em_name_en", $this->givenName);
							$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
							$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
							$command->bindValue(":em_surname_en", $this->sn);	
							$command->bindValue(":em_work_status", $this->accountActive);
							$command->bindValue(":mas_prefix_id", $PrefixID);
							$command->bindValue(":um_user_group_id", 3);
							$command->bindValue(":createby",$addby);
							$command->bindValue(":um_data_complete_id", 0);
							$command->bindValue(":mas_position_le_id", $PositLevelID);	
							$command->bindValue(":mas_user_type_id", $EmpTypeID);	
							$command->bindValue(":mas_department_id", $DeptID);	
							$command->bindValue(":um_position_id", $PositID);	
							$command->bindValue(":em_email", $mailldap);
							$command->bindValue(":em_image", $this->PICPATH);
							$command->bindValue(":em_password", 0);	
							$command->bindValue(":em_status", 1);		
							$command->bindValue(":em_description",0);
							$command->bindValue(":em_in_phone", 0);
							$command->bindValue(":em_mobile", 0);
							$command->bindValue(":um_assign_id", 0);
							$command->bindValue(":um_user_module_id", 0);
							$command->bindValue(":updateby", $addby);
							if($command->execute()) {
															
													
							} else {
														
														
								}
						//	frm_profile::updateldap($userid,$DeptID);	
														
							return true;
							
					}
		}else //ถ้าข้อมูลครบตามกำหนด
		{
			if($code==204) //ถ้าไม่มีใน employee ให้ insert
					{ 
					
										$arr_char="";
										$username="";
										$arr_char = str_split($this->sn);
										$username=$arr_char[0].$this->givenName;
										$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
										$data_array = array("filter" => array("exp" => $username),);	
										$make_call = lkup_oracledpis::CallAPI('POST',  $host.'/umapi/ldapinfosearch.php', json_encode($data_array));
										$data = json_decode($make_call, true);
										foreach($data as $key => $val)
											{
												if($key=='code'){
													$datacode=$val["code"];
												}
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
								
											if($datacode==204)
												{
																			
																	
																
												}else{
														
														$arr_char = str_split($this->sn,2);
														$username=$arr_char[0].$this->givenName;
														$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
														$data_array = array("filter" => array("exp" => $username),);	
														$make_call = lkup_oracledpis::CallAPI('POST',  $host.'/umapi/ldapinfosearch.php', json_encode($data_array));
														$data = json_decode($make_call, true);
														foreach($data as $key => $val)
															{
																if($key=='code'){
																	$datacode=$val["code"];
																}
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
															
														if($datacode==204)
															{
																				
																		
															}else{
																	
																$arr_char = str_split($this->sn,3);
																$username=$arr_char[0].$this->givenName;
																$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
																		
																			
																		
																}
													}
											
							
							$sql = "INSERT INTO um_employee(em_username,em_per_id,em_name_th,em_surname_th,em_citizen_id,em_name_en,em_birthday,em_workactive_date,em_surname_en,em_work_status,createdate,mas_prefix_id,um_user_group_id,createby,um_data_complete_id,mas_position_le_id,mas_user_type_id,mas_department_id,um_position_id,em_image,em_password,em_status,em_description,em_in_phone,em_mobile,um_assign_id,um_user_module_id,updateby,updatedate,em_email)"; 
							$sql.= " VALUES(:em_username,:em_per_id,:em_name_th,:em_surname_th,:em_citizen_id,:em_name_en,:em_birthday,:em_workactive_date,:em_surname_en,:em_work_status,now(),:mas_prefix_id,:um_user_group_id,:createby,:um_data_complete_id,:mas_position_le_id,:mas_user_type_id,:mas_department_id,:um_position_id,:em_image,:em_password,:em_status,:em_description,:em_in_phone,:em_mobile,:um_assign_id,:um_user_module_id,:updateby,now(),:em_email)";			
							$command=yii::app()->db->createCommand($sql);
							$command->bindValue(":em_username",$username );
							$command->bindValue(":em_per_id", $this->PER_ID);
							$command->bindValue(":em_name_th", $this->ssofirstname);
							$command->bindValue(":em_surname_th", $this->ssosurname);		
							$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
							$command->bindValue(":em_name_en", $this->givenName);
							$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
							$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
							$command->bindValue(":em_surname_en", $this->sn);	
							$command->bindValue(":em_work_status", $this->accountActive);
							$command->bindValue(":mas_prefix_id", $PrefixID);
							$command->bindValue(":um_user_group_id", 3);
							$command->bindValue(":createby",$addby);
							$command->bindValue(":um_data_complete_id", 1);
							$command->bindValue(":mas_position_le_id", $PositLevelID);	
							$command->bindValue(":mas_user_type_id", $EmpTypeID);	
							$command->bindValue(":mas_department_id", $DeptID);	
							$command->bindValue(":um_position_id", $PositID);	
							$command->bindValue(":em_email", $mail);
							$command->bindValue(":em_image", $this->PICPATH);
							$command->bindValue(":em_password", 0);	
							$command->bindValue(":em_status", 1);		
							$command->bindValue(":em_description",0);
							$command->bindValue(":em_in_phone", 0);
							$command->bindValue(":em_mobile", 0);
							$command->bindValue(":um_assign_id", 0);
							$command->bindValue(":um_user_module_id", 0);
							$command->bindValue(":updateby", $addby);
							if($command->execute()) {
															
													
							} else {
														
														
								}
							//var_dump($this->PER_ID);			
							frm_profile::updateldap($username,$DeptID);						
														
							return true;
					}else
					{
						foreach ($uid as $dataitem)
									{
										
										$userid=$dataitem["uid"];
										$mail1=isset($dataitem['mail'])?addslashes(trim($dataitem['mail'])):'';
																	
									}
							$sql = "INSERT INTO um_employee(em_username,em_per_id,em_name_th,em_surname_th,em_citizen_id,em_name_en,em_birthday,em_workactive_date,em_surname_en,em_work_status,createdate,mas_prefix_id,um_user_group_id,createby,um_data_complete_id,mas_position_le_id,mas_user_type_id,mas_department_id,um_position_id,em_image,em_password,em_status,em_description,em_in_phone,em_mobile,um_assign_id,um_user_module_id,updateby,updatedate,em_email)"; 
							$sql.= " VALUES(:em_username,:em_per_id,:em_name_th,:em_surname_th,:em_citizen_id,:em_name_en,:em_birthday,:em_workactive_date,:em_surname_en,:em_work_status,now(),:mas_prefix_id,:um_user_group_id,:createby,:um_data_complete_id,:mas_position_le_id,:mas_user_type_id,:mas_department_id,:um_position_id,:em_image,:em_password,:em_status,:em_description,:em_in_phone,:em_mobile,:um_assign_id,:um_user_module_id,:updateby,now(),:em_email)";			
							$command=yii::app()->db->createCommand($sql);
							$command->bindValue(":em_username",$userid );
							$command->bindValue(":em_per_id", $this->PER_ID);
							$command->bindValue(":em_name_th", $this->ssofirstname);
							$command->bindValue(":em_surname_th", $this->ssosurname);		
							$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
							$command->bindValue(":em_name_en", $this->givenName);
							$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
							$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
							$command->bindValue(":em_surname_en", $this->sn);	
							$command->bindValue(":em_work_status", $this->accountActive);
							$command->bindValue(":mas_prefix_id", $PrefixID);
							$command->bindValue(":um_user_group_id", 3);
							$command->bindValue(":createby",$addby);
							$command->bindValue(":um_data_complete_id", 1);
							$command->bindValue(":mas_position_le_id", $PositLevelID);	
							$command->bindValue(":mas_user_type_id", $EmpTypeID);	
							$command->bindValue(":mas_department_id", $DeptID);	
							$command->bindValue(":um_position_id", $PositID);	
							$command->bindValue(":em_email", $mail1);
							$command->bindValue(":em_image", $this->PICPATH);
							$command->bindValue(":em_password", 0);	
							$command->bindValue(":em_status", 1);		
							$command->bindValue(":em_description",0);
							$command->bindValue(":em_in_phone", 0);
							$command->bindValue(":em_mobile", 0);
							$command->bindValue(":um_assign_id", 0);
							$command->bindValue(":um_user_module_id", 0);
							$command->bindValue(":updateby", $addby);
							if($command->execute()) {
															
													
							} else {
														
														
								}
					frm_profile::updateldap($userid,$DeptID);				
					}					
			
		}
	
					
}	

public function dataprocessumtest()
{
	
	
	
						$sql ="select DeptID  from mas_department  where StatusData!=0 and DeptNameTH='".$this->workingdeptdescription."'";
						$rows =Yii::app()->db->createCommand($sql)->queryAll();
						if($rows !=null)
						{
							$DeptID='';
							foreach ($rows as $dataitem)
									{
										$DeptID=$dataitem["DeptID"];
									}
							
												
									
								
						}else{
								
								if($this->workingdeptdescription=="")
								{
									 $DeptID=null;
								}else{
										
										$sql = "INSERT INTO mas_department (DeptID,DeptNameTH,CreateDate,StatusData) ";
										$sql.= "VALUES(:DeptID,:DeptNameTH,now(),:StatusData) ";
										$command=yii::app()->db->createCommand($sql);
										$command->bindValue(":DeptNameTH", $this->workingdeptdescription);	
										$command->bindValue(":StatusData",1);
										$command->bindValue(":DeptID",0000);										
										if($command->execute()){
														
													}else { 
														Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก11'.$sql;
														return false;
													}
										$sql ="SELECT DeptID FROM mas_department order BY CreateDate DESC LIMIT 1";
										$rows =Yii::app()->db->createCommand($sql)->queryAll();
										foreach ($rows as $dataitem)
											{
												$DeptID=$dataitem["DeptID"];
											}
													
									}
									
								
								}	
						
						$sql ="select PositID  from mas_position  where StatusData!=0 and PositNameTH='".$this->ssopersonposition."'";
						$rows =Yii::app()->db->createCommand($sql)->queryAll();
						//var_dump($rows);
						//exit;
						if($rows !=null)
						{
							$PositID='';		
							foreach ($rows as $dataitem)
								{
									$PositID=$dataitem["PositID"];
								}
							
						}else
							{
							
								
								$PositID='';	
								$sql = "INSERT INTO mas_position (PositNameTH,StatusData) ";
								$sql.= "VALUES(:PositNameTH,1) ";
								$command=yii::app()->db->createCommand($sql);		
								$command->bindValue(":PositNameTH", $this->ssopersonposition);
											if($command->execute()){
												
											}else { 
												Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก11'.$sql;
												return false;
											}
								$sql ="SELECT PositID FROM mas_position where StatusData!=0 and PositNameTH='".$this->ssopersonposition."'";
								$rows =Yii::app()->db->createCommand($sql)->queryAll();
								foreach ($rows as $dataitem)
									{
										$PositID=$dataitem["PositID"];
									}
											
								
									
							}
							
						
						$sql ="select pf_id  from mas_prefix where pf_status!=0 and pf_description='".$this->initials."'";
						$rows1 =Yii::app()->db->createCommand($sql)->queryAll();
					
						if($rows1 !=null)	
						{
							$PrefixID='';
							foreach ($rows1 as $dataitem)
							{
								$PrefixID=$dataitem["pf_id"];
								
							}
							
						}else
							{
								
									$PrefixID='';
									$sql = "INSERT INTO mas_prefix (pf_description,pf_name,pf_status,createby,updateby,createdate,updatedate) ";
									$sql.= "VALUES(:pf_description,:pf_name,:pf_status,:createby,:updateby,now(),now()) ";
									$command=yii::app()->db->createCommand($sql);		
									$command->bindValue(":pf_description", $this->initials);
									$command->bindValue(":pf_name", $this->title);
									$command->bindValue(":pf_status",1);
									$command->bindValue(":createby","auto");
									$command->bindValue(":updateby","auto");
												if($command->execute()){
													
												}else { 
													Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก11'.$sql;
													return false;
												}
									$sql ="SELECT pf_id FROM mas_prefix";
									$rows =Yii::app()->db->createCommand($sql)->queryAll();
									foreach ($rows as $dataitem)
										{
											$PrefixID=$dataitem["pf_id"];
											
										}
												
										
				
							}
						$sql ="select ut_id  from mas_user_type where ut_status!=0 and ut_name='".$this->employeeType."'";
						$rows2 =Yii::app()->db->createCommand($sql)->queryAll();
						
						if($rows2 !=null)
						{
							$EmpTypeID='';
							foreach ($rows2 as $dataitem)
								{
									$EmpTypeID=$dataitem["ut_id"];
								//	var_dump($EmpTypeID);
								//	exit;
									
								}
						//	var_dump($EmpTypeID);
						//	exit;
							
						
						}
						else
						{
								$EmpTypeID='';
								$sql = "INSERT INTO mas_user_type (ut_name,ut_status,updateby,createby,ut_description,createdate,updatedate) ";
								$sql.= "VALUES(:ut_name,:ut_status,:updateby,:createby,:ut_description,now(),now()) ";
								$command=yii::app()->db->createCommand($sql);		
								$command->bindValue(":ut_name", $this->employeeType);
								$command->bindValue(":updateby","auto");
								$command->bindValue(":createby","auto");
								$command->bindValue(":ut_description","auto");
								$command->bindValue(":ut_status", 1);
											if($command->execute()){
												
											}else { 
												Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก11'.$sql;
												return false;
											}
								$sql ="SELECT ut_id FROM mas_user_type where ut_status!=0 and ut_name='".$this->employeeType."'";
								$rows =Yii::app()->db->createCommand($sql)->queryAll();
								foreach ($rows as $dataitem)
									{
										$EmpTypeID=$dataitem["ut_id"];
										//var_dump($EmpTypeID);
									//	exit;
										
									}
											
									
						}
						
						$sql ="select PositLevelID  from mas_position_le  where StatusData!=0 and PositLevelNameTH='".$this->ssopersonclass."'";
						$rows =Yii::app()->db->createCommand($sql)->queryAll();
					//	var_dump($this->ssopersonclass);
					//	exit;
						if($rows !=null)
						{
							$PositLevelID='';	
							foreach ($rows as $dataitem)
								{
									$PositLevelID=$dataitem["PositLevelID"];
								}
						
						}else
							{
								$PositLevelID='';
								$sql ="SELECT LPAD(MAX(PositLevelID)+1,2,'0') FROM mas_position_le";
								$rows =Yii::app()->db->createCommand($sql)->queryAll();
								
								foreach ($rows as $dataitem)
									{
										
										$PositLevelID=$dataitem["LPAD(MAX(PositLevelID)+1,2,'0')"];
									
									}
								
								$sql = "INSERT INTO mas_position_le (PositLevelID,PositLevelNameTH,StatusData) ";
								$sql.= "VALUES(:PositLevelID,:PositLevelNameTH,1) ";
								$command=yii::app()->db->createCommand($sql);		
								$command->bindValue(":PositLevelID", $PositLevelID);
								$command->bindValue(":PositLevelNameTH", $this->ssopersonclass);
											if($command->execute()){
												
											}else { 
												Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก11'.$sql;
												return false;
											}
								$sql ="SELECT LPAD(MAX(PositLevelID)+1,2,'0') FROM mas_position_le";
								$rows =Yii::app()->db->createCommand($sql)->queryAll();
								
								foreach ($rows as $dataitem)
									{
										$PositLevelID=$dataitem["LPAD(MAX(PositLevelID)+1,2,'0')"];
									}
											
									
									
							}
					
				/*			$sql ="select PositManageID  from mas_position_manage where StatusData!=0 and PositManageNameTH='".$this->PN_NAME."'";
							$rows3 =Yii::app()->db->createCommand($sql)->queryAll();
							
							
							if($rows3 !=null)
							{
								$PositManageID='';
								foreach ($rows3 as $dataitem)
									{
										$PositManageID=$dataitem["PositManageID"];
										
									}
								
								
							}else
							{
									$sql ="SELECT LPAD(MAX(PositManageID)+1,3,'0') from mas_position_manage ";
									$rows =Yii::app()->db->createCommand($sql)->queryAll();
									$PositManageID='';
									foreach ($rows as $dataitem)
										{
											$PositManageID=$dataitem["LPAD(MAX(PositManageID)+1,3,'0')"];
										}
										
									$sql = "INSERT INTO mas_position_manage (PositManageID,PositManageNameTH) ";
									$sql.= "VALUES(:PositManageID,:PositManageNameTH) ";
									$command=yii::app()->db->createCommand($sql);		
									$command->bindValue(":PositManageID", $PositManageID);
									$command->bindValue(":PositManageNameTH", $this->PER_POS_NAMEPN_NAME);
												if($command->execute()){
													
												}else { 
													Yii::app()->session['errmsg_import']='เกิดข้อผิดพลาดบันทึก11'.$sql;
													return false;
												}
									$sql ="SELECT LPAD(MAX(PositManageID)+1,3,'0') from mas_position_manage ";
									$rows =Yii::app()->db->createCommand($sql)->queryAll();
									$PositManageID='';
									foreach ($rows as $dataitem)
										{
											$PositManageID=$dataitem["PositManageID"];
										}
												
										
														
											
										
								}*/
			$host=Yii::app()->params['prg_ctrl']['ipservice']['ipzonedev']; 					
			$data_array = array("filter" => array("exp" => $this->ssopersoncitizenid),);	
			$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/dataldaptest.php', json_encode($data_array));
			$data = json_decode($make_call, true);
			foreach($data as $key => $val)
				{
					if($key=='code'){
						$code=$val["code"];
					}
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
		
		
		$sql ="select *  from um_employee where em_status!=0  and  em_per_id='".$this->PER_ID."'and mas_user_type_id='".$EmpTypeID."' and em_citizen_id='".$this->ssopersoncitizenid."'";
		$userid1 =Yii::app()->db->createCommand($sql)->queryAll();
			
		if($this->givenName=='' || $this->sn=='' ||$this->workingdeptdescription==''|| $this->ssopersonposition =='' || $this->ssopersoncitizenid ==''|| $this->ssopersonclass=='' || $this->ssopersonbirthdate==''|| $this->ssopersonempdate== '' || $this->accountActive =='' || $this->initials=='' || $this->employeeType=='' || $this->title =='')
		{
			
					if($userid1 == null && $code==204) //ถ้าไม่มีใน employee ไม่มีในldap
					{ 
					
							$sql = "INSERT INTO um_employee(em_per_id,em_name_th,em_surname_th,em_citizen_id,em_name_en,em_birthday,em_workactive_date,em_surname_en,em_work_status,createdate,mas_prefix_id,um_user_group_id,createby,um_data_complete_id,mas_position_le_id,mas_user_type_id,mas_department_id,um_position_id,em_image,em_password,em_status,em_description,em_in_phone,em_mobile,um_assign_id,um_user_module_id,updateby,updatedate)"; 
							$sql.= " VALUES(:em_per_id,:em_name_th,:em_surname_th,:em_citizen_id,:em_name_en,:em_birthday,:em_workactive_date,:em_surname_en,:em_work_status,now(),:mas_prefix_id,:um_user_group_id,:createby,:um_data_complete_id,:mas_position_le_id,:mas_user_type_id,:mas_department_id,:um_position_id,:em_image,:em_password,:em_status,:em_description,:em_in_phone,:em_mobile,:um_assign_id,:um_user_module_id,:updateby,now())";			
							$command=yii::app()->db->createCommand($sql);			
						//	$command->bindValue(":em_username",$uidname );
							$command->bindValue(":em_per_id", $this->PER_ID);
							$command->bindValue(":em_name_th", $this->ssofirstname);
							$command->bindValue(":em_surname_th", $this->ssosurname);		
							$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
							$command->bindValue(":em_name_en", $this->givenName);
							$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
							$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
							$command->bindValue(":em_surname_en", $this->sn);	
							$command->bindValue(":em_work_status", $this->accountActive);
							$command->bindValue(":mas_prefix_id", $PrefixID);
							$command->bindValue(":um_user_group_id", 3);
							$command->bindValue(":createby","AUTO");
							$command->bindValue(":um_data_complete_id", 0);
							$command->bindValue(":mas_position_le_id", $PositLevelID);	
							$command->bindValue(":mas_user_type_id", $EmpTypeID);	
							$command->bindValue(":mas_department_id", $DeptID);	
							$command->bindValue(":um_position_id", $PositID);	
						//	$command->bindValue(":em_email", $mails);
							$command->bindValue(":em_image", $this->PICPATH);
							$command->bindValue(":em_password", 0);	
							$command->bindValue(":em_status", 1);		
							$command->bindValue(":em_description",0);
							$command->bindValue(":em_in_phone", 0);
							$command->bindValue(":em_mobile", 0);
							$command->bindValue(":um_assign_id", 0);
							$command->bindValue(":um_user_module_id", 0);
							$command->bindValue(":updateby", "AUTO");
							if($command->execute()) {
															
													
							} else {
														
														
								}
													
														
							return true;
					}
					else if ($userid1 == null && $code==200 )//ถ้าไม่มีใน employee แต่มีใน ldap	
					{
						
							foreach ($uid as $dataitem)
									{
										
										$userid=$dataitem["UID"];
										$mail1=$dataitem["MAIL"];
									
									}
							$sql = "INSERT INTO um_employee(em_username,em_per_id,em_name_th,em_surname_th,em_citizen_id,em_name_en,em_birthday,em_workactive_date,em_surname_en,em_work_status,createdate,mas_prefix_id,um_user_group_id,createby,um_data_complete_id,mas_position_le_id,mas_user_type_id,mas_department_id,um_position_id,em_image,em_password,em_status,em_description,em_in_phone,em_mobile,um_assign_id,um_user_module_id,updateby,updatedate,em_email)"; 
							$sql.= " VALUES(:em_username,:em_per_id,:em_name_th,:em_surname_th,:em_citizen_id,:em_name_en,:em_birthday,:em_workactive_date,:em_surname_en,:em_work_status,now(),:mas_prefix_id,:um_user_group_id,:createby,:um_data_complete_id,:mas_position_le_id,:mas_user_type_id,:mas_department_id,:um_position_id,:em_image,:em_password,:em_status,:em_description,:em_in_phone,:em_mobile,:um_assign_id,:um_user_module_id,:updateby,now(),:em_email)";			
							$command=yii::app()->db->createCommand($sql);
							$command->bindValue(":em_username",$userid );
							$command->bindValue(":em_per_id", $this->PER_ID);
							$command->bindValue(":em_name_th", $this->ssofirstname);
							$command->bindValue(":em_surname_th", $this->ssosurname);		
							$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
							$command->bindValue(":em_name_en", $this->givenName);
							$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
							$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
							$command->bindValue(":em_surname_en", $this->sn);	
							$command->bindValue(":em_work_status", $this->accountActive);
							$command->bindValue(":mas_prefix_id", $PrefixID);
							$command->bindValue(":um_user_group_id", 3);
							$command->bindValue(":createby","AUTO");
							$command->bindValue(":um_data_complete_id", 0);
							$command->bindValue(":mas_position_le_id", $PositLevelID);	
							$command->bindValue(":mas_user_type_id", $EmpTypeID);	
							$command->bindValue(":mas_department_id", $DeptID);	
							$command->bindValue(":um_position_id", $PositID);	
							$command->bindValue(":em_email", $mail);
							$command->bindValue(":em_image", $this->PICPATH);
							$command->bindValue(":em_password", 0);	
							$command->bindValue(":em_status", 1);		
							$command->bindValue(":em_description",0);
							$command->bindValue(":em_in_phone", 0);
							$command->bindValue(":em_mobile", 0);
							$command->bindValue(":um_assign_id", 0);
							$command->bindValue(":um_user_module_id", 0);
							$command->bindValue(":updateby", "AUTO");
							if($command->execute()) {
															
													
							} else {
														
														
								}
													
														
							return true;
					}
					else
					{
						
							// $sql = "update um_employee set em_per_id=:em_per_id,em_name_th=:em_name_th,em_surname_th=:em_surname_th,em_citizen_id=:em_citizen_id,em_name_en=:em_name_en, ";
							// $sql.= "em_birthday=:em_birthday,em_workactive_date=:em_workactive_date,em_surname_en=:em_surname_en,em_work_status=:em_work_status,mas_prefix_id=:mas_prefix_id,";
							// $sql.= "um_user_group_id=:um_user_group_id,updateby=:updateby,UpdateDate=now(),um_data_complete_id=:um_data_complete_id,mas_position_le_id=:mas_position_le_id,mas_user_type_id=:mas_user_type_id,mas_department_id=:mas_department_id, ";
							// $sql.= "um_position_id=:um_position_id,em_image=:em_image where em_citizen_id='".$this->ssopersoncitizenid."' and em_per_id='".$this->PER_ID."'";

							$sql = "update um_employee set em_per_id=:em_per_id,em_name_th=:em_name_th,em_surname_th=:em_surname_th,em_citizen_id=:em_citizen_id,em_name_en=:em_name_en, ";
							$sql.= "em_birthday=:em_birthday,em_workactive_date=:em_workactive_date,em_surname_en=:em_surname_en,em_work_status=:em_work_status,mas_prefix_id=:mas_prefix_id,";
							$sql.= "um_user_group_id=:um_user_group_id,updateby=:updateby,UpdateDate=now(),um_data_complete_id=:um_data_complete_id,mas_position_le_id=:mas_position_le_id,mas_user_type_id=:mas_user_type_id, ";
							$sql.= "um_position_id=:um_position_id,em_image=:em_image where em_citizen_id='".$this->ssopersoncitizenid."' and em_per_id='".$this->PER_ID."'";

							$command=yii::app()->db->createCommand($sql);
							$command->bindValue(":em_per_id", $this->PER_ID);
							$command->bindValue(":em_name_th", $this->ssofirstname);
							$command->bindValue(":em_surname_th", $this->ssosurname);		
							$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
							$command->bindValue(":em_name_en", $this->givenName);
									
							$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
							$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
							$command->bindValue(":em_surname_en", $this->sn);	
							$command->bindValue(":em_work_status", $this->accountActive);
							$command->bindValue(":mas_prefix_id", $PrefixID);
									
							$command->bindValue(":um_user_group_id", 3);
							$command->bindValue(":updateby","AUTO");
							$command->bindValue(":um_data_complete_id", 0);
							$command->bindValue(":mas_position_le_id", $PositLevelID);	
							$command->bindValue(":mas_user_type_id", $EmpTypeID);	
							// $command->bindValue(":mas_department_id", $DeptID);	
									
							$command->bindValue(":um_position_id", $PositID);	
									//$command->bindValue(":em_email", $mails);	
							$command->bindValue(":em_image", $this->PICPATH);
							if($command->execute()) {
															
													
							} else {
														
														
								}
							return true;
					}
		}else //ถ้าข้อมูลครบตามกำหนด
		{
	
		//	var_dump($userid1);
		//	exit;
					if($userid1 == null && $code==204) //ถ้าไม่มีใน employee ให้ insert
					{ 
						
										$arr_char="";
										$username="";
										$arr_char = str_split($this->sn);
										$username=$arr_char[0].$this->givenName;
										$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
										$data_array = array("filter" => array("exp" => $username),);	
										$make_call = lkup_oracledpis::CallAPI('POST',  $host.'/umapi/dataldaptest.php', json_encode($data_array));
										$data = json_decode($make_call, true);
										foreach($data as $key => $val)
											{
												if($key=='code'){
													$datacode=$val["code"];
												}
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
								
											if($datacode==204)
												{
																			
																	
																
												}else{
														
														$arr_char = str_split($this->sn,2);
														$username=$arr_char[0].$this->givenName;
														$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
														$data_array = array("filter" => array("exp" => $username),);	
														$make_call = lkup_oracledpis::CallAPI('POST',  $host.'/umapi/dataldaptest.php', json_encode($data_array));
														$data = json_decode($make_call, true);
														foreach($data as $key => $val)
															{
																if($key=='code'){
																	$datacode=$val["code"];
																}
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
															
														if($datacode==204)
															{
																				
																		
															}else{
																	
																$arr_char = str_split($this->sn,3);
																$username=$arr_char[0].$this->givenName;
																$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
																		
																			
																		
																}
													}
											
							
									$sql = "INSERT INTO um_employee(em_per_id,em_username,em_name_th,em_surname_th,em_citizen_id,em_name_en,em_birthday,em_workactive_date,em_surname_en,em_work_status,createdate,mas_prefix_id,um_user_group_id,createby,um_data_complete_id,mas_position_le_id,mas_user_type_id,mas_department_id,um_position_id,em_email,em_image,em_password,em_status,em_description,em_in_phone,em_mobile,um_assign_id,um_user_module_id,updateby,updatedate)"; 
									$sql.= " VALUES(:em_per_id,:em_username,:em_name_th,:em_surname_th,:em_citizen_id,:em_name_en,:em_birthday,:em_workactive_date,:em_surname_en,:em_work_status,now(),:mas_prefix_id,:um_user_group_id,:createby,:um_data_complete_id,:mas_position_le_id,:mas_user_type_id,:mas_department_id,:um_position_id,:em_email,:em_image,:em_password,:em_status,:em_description,:em_in_phone,:em_mobile,:um_assign_id,:um_user_module_id,:updateby,now())";			
									$command=yii::app()->db->createCommand($sql);			
									$command->bindValue(":em_username",$username );
									$command->bindValue(":em_per_id", $this->PER_ID);
									$command->bindValue(":em_name_th", $this->ssofirstname);
									$command->bindValue(":em_surname_th", $this->ssosurname);		
									$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
									$command->bindValue(":em_name_en", $this->givenName);
									$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
									$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
									$command->bindValue(":em_surname_en", $this->sn);	
									$command->bindValue(":em_work_status", $this->accountActive);
									$command->bindValue(":mas_prefix_id", $PrefixID);
									$command->bindValue(":um_user_group_id", 3);
									$command->bindValue(":createby","AUTO");
									$command->bindValue(":um_data_complete_id", 1);
									$command->bindValue(":mas_position_le_id", $PositLevelID);	
									$command->bindValue(":mas_user_type_id", $EmpTypeID);	
									$command->bindValue(":mas_department_id", $DeptID);	
									$command->bindValue(":um_position_id", $PositID);	
									$command->bindValue(":em_email", $mail);
									$command->bindValue(":em_image", $this->PICPATH);
									$command->bindValue(":em_password", 0);	
									$command->bindValue(":em_status", 1);		
									$command->bindValue(":em_description",0);
									$command->bindValue(":em_in_phone", 0);
									$command->bindValue(":em_mobile", 0);
									$command->bindValue(":um_assign_id", 0);
									$command->bindValue(":um_user_module_id", 0);
									$command->bindValue(":updateby", "AUTO");
									if($command->execute()) {						
													
									} else {
																
																
										}
							frm_profile::insertldapdb($username,$mail,$DeptID);						
														
							return true;
					}		
					else if ($userid1 == null && $code==200 )//ถ้าไม่มีใน employee แต่มีใน ldap	
					{
						
							foreach ($uid as $dataitem)
									{
										
										$userid=$dataitem["UID"];
										$mail1=$dataitem["MAIL"];
									
									}
																
									
									$sql = "INSERT INTO um_employee(em_per_id,em_username,em_name_th,em_surname_th,em_citizen_id,em_name_en,em_birthday,em_workactive_date,em_surname_en,em_work_status,createdate,mas_prefix_id,um_user_group_id,createby,um_data_complete_id,mas_position_le_id,mas_user_type_id,mas_department_id,um_position_id,em_email,em_image,em_password,em_status,em_description,em_in_phone,em_mobile,um_assign_id,um_user_module_id,updateby,updatedate)"; 
									$sql.= " VALUES(:em_per_id,:em_username,:em_name_th,:em_surname_th,:em_citizen_id,:em_name_en,:em_birthday,:em_workactive_date,:em_surname_en,:em_work_status,now(),:mas_prefix_id,:um_user_group_id,:createby,:um_data_complete_id,:mas_position_le_id,:mas_user_type_id,:mas_department_id,:um_position_id,:em_email,:em_image,:em_password,:em_status,:em_description,:em_in_phone,:em_mobile,:um_assign_id,:um_user_module_id,:updateby,now())";			
									$command=yii::app()->db->createCommand($sql);			
									$command->bindValue(":em_username",$userid );
									$command->bindValue(":em_per_id", $this->PER_ID);
									$command->bindValue(":em_name_th", $this->ssofirstname);
									$command->bindValue(":em_surname_th", $this->ssosurname);		
									$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
									$command->bindValue(":em_name_en", $this->givenName);
									$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
									$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
									$command->bindValue(":em_surname_en", $this->sn);	
									$command->bindValue(":em_work_status", $this->accountActive);
									$command->bindValue(":mas_prefix_id", $PrefixID);
									$command->bindValue(":um_user_group_id", 3);
									$command->bindValue(":createby","AUTO");
									$command->bindValue(":um_data_complete_id", 1);
									$command->bindValue(":mas_position_le_id", $PositLevelID);	
									$command->bindValue(":mas_user_type_id", $EmpTypeID);	
									$command->bindValue(":mas_department_id", $DeptID);	
									$command->bindValue(":um_position_id", $PositID);	
									$command->bindValue(":em_email", $mail1);
									$command->bindValue(":em_image", $this->PICPATH);
									$command->bindValue(":em_password", 0);	
									$command->bindValue(":em_status", 1);		
									$command->bindValue(":em_description",0);
									$command->bindValue(":em_in_phone", 0);
									$command->bindValue(":em_mobile", 0);
									$command->bindValue(":um_assign_id", 0);
									$command->bindValue(":um_user_module_id", 0);
									$command->bindValue(":updateby", "AUTO");
									if($command->execute()) {
															
															
									} else {
																
																
										}
												
							frm_profile::insertldapdb($userid,$mail1,$DeptID);							
							return true;
					}	

					if($userid1 != null && $code==204)
					{
						
										$arr_char="";
										$username="";
										$arr_char = str_split($this->sn);
										$username=$arr_char[0].$this->givenName;
										$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
										$data_array = array("filter" => array("exp" => $username),);	
										$make_call = lkup_oracledpis::CallAPI('POST',  $host.'/umapi/dataldaptest.php', json_encode($data_array));
										$data = json_decode($make_call, true);
										foreach($data as $key => $val)
											{
												if($key=='code'){
													$datacode=$val["code"];
												}
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
								
											if($datacode==204)
												{
																			
																	
																
												}else{
														
														$arr_char = str_split($this->sn,2);
														$username=$arr_char[0].$this->givenName;
														$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
														$data_array = array("filter" => array("exp" => $username),);	
														$make_call = lkup_oracledpis::CallAPI('POST',  $host.'/umapi/dataldaptest.php', json_encode($data_array));
														$data = json_decode($make_call, true);
														foreach($data as $key => $val)
															{
																if($key=='code'){
																	$datacode=$val["code"];
																}
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
															
														if($datacode==204)
															{
																				
																		
															}else{
																	
																$arr_char = str_split($this->sn,3);
																$username=$arr_char[0].$this->givenName;
																$mail=$this->givenName.".".$arr_char[0]."@sso.go.th";
																		
																			
																		
																}
													}
									// $sql = "update um_employee set em_username=:em_username,em_per_id=:em_per_id,em_name_th=:em_name_th,em_surname_th=:em_surname_th,em_citizen_id=:em_citizen_id,em_name_en=:em_name_en, ";
									// $sql.= "em_birthday=:em_birthday,em_workactive_date=:em_workactive_date,em_surname_en=:em_surname_en,em_work_status=:em_work_status,mas_prefix_id=:mas_prefix_id,";
									// $sql.= "um_user_group_id=:um_user_group_id,updateby=:updateby,UpdateDate=now(),um_data_complete_id=:um_data_complete_id,mas_position_le_id=:mas_position_le_id,mas_user_type_id=:mas_user_type_id,mas_department_id=:mas_department_id, ";
									// $sql.= "um_position_id=:um_position_id,em_email=:em_email,em_image=:em_image where em_username='".$username."'";

									$sql = "update um_employee set em_username=:em_username,em_per_id=:em_per_id,em_name_th=:em_name_th,em_surname_th=:em_surname_th,em_citizen_id=:em_citizen_id,em_name_en=:em_name_en, ";
									$sql.= "em_birthday=:em_birthday,em_workactive_date=:em_workactive_date,em_surname_en=:em_surname_en,em_work_status=:em_work_status,mas_prefix_id=:mas_prefix_id,";
									$sql.= "um_user_group_id=:um_user_group_id,updateby=:updateby,UpdateDate=now(),um_data_complete_id=:um_data_complete_id,mas_position_le_id=:mas_position_le_id,mas_user_type_id=:mas_user_type_id, ";
									$sql.= "um_position_id=:um_position_id,em_email=:em_email,em_image=:em_image where em_username='".$username."'";

									$command=yii::app()->db->createCommand($sql);
									$command->bindValue(":em_username",$username );
									$command->bindValue(":em_per_id", $this->PER_ID);
									$command->bindValue(":em_name_th", $this->ssofirstname);
									$command->bindValue(":em_surname_th", $this->ssosurname);		
									$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
									$command->bindValue(":em_name_en", $this->givenName);
									
									$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
									$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
									$command->bindValue(":em_surname_en", $this->sn);	
									$command->bindValue(":em_work_status", $this->accountActive);
									$command->bindValue(":mas_prefix_id", $PrefixID);
									
									$command->bindValue(":um_user_group_id", 3);
									$command->bindValue(":updateby","AUTO");
									$command->bindValue(":um_data_complete_id", 1);
									$command->bindValue(":mas_position_le_id", $PositLevelID);	
									$command->bindValue(":mas_user_type_id", $EmpTypeID);	
									// $command->bindValue(":mas_department_id", $DeptID);	
									
									$command->bindValue(":um_position_id", $PositID);	
									$command->bindValue(":em_email", $mail);	
									$command->bindValue(":em_image", $this->PICPATH);
									if($command->execute()) {
															
													
									} else {
																
																
										}
							frm_profile::insertldapdb($username,$mail,$DeptID);
							return true;						
					}
					else
					{  
				//     var_dump($uid);
				//	 exit;
							foreach ($uid as $dataitem)
										{
											
											$userid=$dataitem["UID"];
											$mail1=$dataitem["MAIL"];
										
										}
							//	var_dump($userid);
				//	exit;	
									// $sql = "update um_employee set em_per_id=:em_per_id,em_name_th=:em_name_th,em_surname_th=:em_surname_th,em_citizen_id=:em_citizen_id,em_name_en=:em_name_en, ";
									// $sql.= "em_birthday=:em_birthday,em_workactive_date=:em_workactive_date,em_surname_en=:em_surname_en,em_work_status=:em_work_status,mas_prefix_id=:mas_prefix_id,";
									// $sql.= "updateby=:updateby,UpdateDate=now(),um_data_complete_id=:um_data_complete_id,mas_position_le_id=:mas_position_le_id,mas_user_type_id=:mas_user_type_id,mas_department_id=:mas_department_id, ";
									// $sql.= "um_position_id=:um_position_id,em_image=:em_image where em_username='".$userid."'";

									$sql = "update um_employee set em_per_id=:em_per_id,em_name_th=:em_name_th,em_surname_th=:em_surname_th,em_citizen_id=:em_citizen_id,em_name_en=:em_name_en, ";
									$sql.= "em_birthday=:em_birthday,em_workactive_date=:em_workactive_date,em_surname_en=:em_surname_en,em_work_status=:em_work_status,mas_prefix_id=:mas_prefix_id,";
									$sql.= "updateby=:updateby,UpdateDate=now(),um_data_complete_id=:um_data_complete_id,mas_position_le_id=:mas_position_le_id,mas_user_type_id=:mas_user_type_id, ";
									$sql.= "um_position_id=:um_position_id,em_image=:em_image where em_username='".$userid."'";


									$command=yii::app()->db->createCommand($sql);
									$command->bindValue(":em_per_id", $this->PER_ID);
									$command->bindValue(":em_name_th", $this->ssofirstname);
									$command->bindValue(":em_surname_th", $this->ssosurname);		
									$command->bindValue(":em_citizen_id", $this->ssopersoncitizenid);
									$command->bindValue(":em_name_en", $this->givenName);
									
									$command->bindValue(":em_birthday", $this->ssopersonbirthdate);	
									$command->bindValue(":em_workactive_date",$this->ssopersonempdate);
									$command->bindValue(":em_surname_en", $this->sn);	
									$command->bindValue(":em_work_status", $this->accountActive);
									$command->bindValue(":mas_prefix_id", $PrefixID);
									
								//	$command->bindValue(":um_user_group_id", 3);
									$command->bindValue(":updateby","AUTO");
									$command->bindValue(":um_data_complete_id", 1);
									$command->bindValue(":mas_position_le_id", $PositLevelID);	
									$command->bindValue(":mas_user_type_id", $EmpTypeID);	
									// $command->bindValue(":mas_department_id", $DeptID);	
									
									$command->bindValue(":um_position_id", $PositID);	
									//$command->bindValue(":em_email", $mails);	
									$command->bindValue(":em_image", $this->PICPATH);
							if($command->execute()) {
															
													
							} else {
														
														
								}

							frm_profile::insertldapdb($userid,$mail1,$DeptID);		
							return true;
					}
		}
			
			
}	
}
