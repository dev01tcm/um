<?php

class lkup_oracledpis extends CFormModel
{
		public $userdatabase ;
		public $userdatabaseem ;
		public $username  ;             // Use your username
		public $password  ;          // and your password
		public $connectdatabase ;
		public $connectdatabaseem 	;	
		public $pid ;
	
	public function rules()
	{
		return array(
			array('userdatabase','username','database','password','pid'),				
		);
	}

	public function attributeLabels()
	{
		return array(

		);
	}
	public function getsearhoracle() 

	{ 

			$this->username=Yii::app()->params['prg_ctrl']['dboracle']['username'];
			$this->password=Yii::app()->params['prg_ctrl']['dboracle']['password'];
			$this->connectdatabase=Yii::app()->params['prg_ctrl']['dboracle']['connectdatabase'];
			$this->connectdatabaseem=Yii::app()->params['prg_ctrl']['dboracle']['connectdatabaseem'];
			
		$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
		$strSQL = 'SELECT * FROM DPIS.V_UM_DPIS where ssopersoncitizenid='.$this->pid;// where ssofirstname ='สุกฤต' ';
		$objParse1 = oci_parse($objConnect, $strSQL);
		
		$objParse = oci_parse($objConnect, $strSQL);
		oci_execute($objParse1,OCI_DEFAULT);
		oci_execute($objParse,OCI_DEFAULT);
		$objResult1 = oci_fetch_array($objParse1);
	
		
		
		$i=0;
	//	
		if($objResult1 !=null){
		
		while($objResult = oci_fetch_array($objParse))
		{
					$data[$i]["ssofirstname"]=isset($objResult['SSOFIRSTNAME'])?addslashes(trim($objResult['SSOFIRSTNAME'])):'';
					$data[$i]["ssopersoncitizenid"]=isset($objResult['SSOPERSONCITIZENID'])?addslashes(trim($objResult['SSOPERSONCITIZENID'])):'';
					$data[$i]["givenName"]=isset($objResult['GIVENNAME'])?addslashes(trim($objResult['GIVENNAME'])):'';
					$data[$i]["ssosurname"]=isset($objResult['SSOSURNAME'])?addslashes(trim($objResult['SSOSURNAME'])):'';
				//	$data[$i]["maildrop"]=isset($objResult['MAILDROP'])?addslashes(trim($objResult['MAILDROP'])):'';
					$data[$i]["ssopersonempdate"]=isset($objResult['SSOPERSONEMPDATE'])?addslashes(trim($objResult['SSOPERSONEMPDATE'])):'';
					if($data[$i]["ssopersonempdate"]=="-")
					{
						$data[$i]["ssopersonempdate"]="";
					}
					$data[$i]["title"]=isset($objResult['TITLE'])?addslashes(trim($objResult['TITLE'])):'';
					$data[$i]["initials"]=isset($objResult['INITIALS'])?addslashes(trim($objResult['INITIALS'])):'';
					$data[$i]["employeeType"]=isset($objResult['EMPLOYEETYPE'])?addslashes(trim($objResult['EMPLOYEETYPE'])):'';
				//	$data[$i]["mail"]=isset($objResult['MAIL'])?addslashes(trim($objResult['MAIL'])):'';
					$data[$i]["workingdeptdescription"]=isset($objResult['WORKINGDEPTDESCRIPTION'])?addslashes(trim($objResult['WORKINGDEPTDESCRIPTION'])):'';
					$data[$i]["sn"]=isset($objResult['SN'])?addslashes(trim($objResult['SN'])):'';
					$data[$i]["ssopersonposition"]=isset($objResult['SSOPERSONPOSITION'])?addslashes(trim($objResult['SSOPERSONPOSITION'])):'';
					$data[$i]["ssopersonbirthdate"]=isset($objResult['SSOPERSONBIRTHDATE'])?addslashes(trim($objResult['SSOPERSONBIRTHDATE'])):'';
					$data[$i]["accountActive"]=isset($objResult['ACCOUNTACTIVE'])?addslashes(trim($objResult['ACCOUNTACTIVE'])):'';
					$data[$i]["ssopersonclass"]=isset($objResult['SSOPERSONCLASS'])?addslashes(trim($objResult['SSOPERSONCLASS'])):'';
					$data[$i]["cn"]=isset($objResult['CN'])?addslashes(trim($objResult['CN'])):'';
					$data[$i]["PER_EFFECTIVEDATE"]=isset($objResult['PER_EFFECTIVEDATE'])?addslashes(trim($objResult['PER_EFFECTIVEDATE'])):'';
					$data[$i]["PM_NAME"]=isset($objResult['PM_NAME'])?addslashes(trim($objResult['PM_NAME'])):'';
					$data[$i]["PER_DOCDATE"]=isset($objResult['PER_DOCDATE'])?addslashes(trim($objResult['PER_DOCDATE'])):'';
					if($data[$i]["PER_DOCDATE"]==" ")
					{
						$data[$i]["PER_DOCDATE"]=null;
					}
			$i++;
		}
		
			oci_close($objConnect);
			//var_dump($data);
		//	exit;
			return $data;
			
		}else
			{
				
				
				//oci_close($objConnect);
				//$objConnect = oci_connect($this->username,$this->password,$this->connectdatabaseem,"AL32UTF8");
					
				$strSQL = 'SELECT * FROM DPISEMP1.V_UM_DPISEMP1 where ssopersoncitizenid='.$this->pid;// where ssofirstname ='สุกฤต' ';
			
				$objParse = oci_parse($objConnect, $strSQL);
				//oci_execute($objParse1,OCI_DEFAULT);
				oci_execute($objParse,OCI_DEFAULT);
				$objResult = oci_fetch_array($objParse);
				
				$i=0;
				while($objResult = oci_fetch_array($objParse))
					{
						
						$data[$i]["ssofirstname"]=isset($objResult['SSOFIRSTNAME'])?addslashes(trim($objResult['SSOFIRSTNAME'])):'';
					$data[$i]["ssopersoncitizenid"]=isset($objResult['SSOPERSONCITIZENID'])?addslashes(trim($objResult['SSOPERSONCITIZENID'])):'';
					$data[$i]["givenName"]=isset($objResult['GIVENNAME'])?addslashes(trim($objResult['GIVENNAME'])):'';
					$data[$i]["ssosurname"]=isset($objResult['SSOSURNAME'])?addslashes(trim($objResult['SSOSURNAME'])):'';
				//	$data[$i]["maildrop"]=isset($objResult['MAILDROP'])?addslashes(trim($objResult['MAILDROP'])):'';
					$data[$i]["ssopersonempdate"]=isset($objResult['SSOPERSONEMPDATE'])?addslashes(trim($objResult['SSOPERSONEMPDATE'])):'';
					if($data[$i]["ssopersonempdate"]=="-")
					{
						$data[$i]["ssopersonempdate"]="";
					}
					$data[$i]["title"]=isset($objResult['TITLE'])?addslashes(trim($objResult['TITLE'])):'';
					$data[$i]["initials"]=isset($objResult['INITIALS'])?addslashes(trim($objResult['INITIALS'])):'';
					$data[$i]["employeeType"]=isset($objResult['EMPLOYEETYPE'])?addslashes(trim($objResult['EMPLOYEETYPE'])):'';
				//	$data[$i]["mail"]=isset($objResult['MAIL'])?addslashes(trim($objResult['MAIL'])):'';
					$data[$i]["workingdeptdescription"]=isset($objResult['WORKINGDEPTDESCRIPTION'])?addslashes(trim($objResult['WORKINGDEPTDESCRIPTION'])):'';
					$data[$i]["sn"]=isset($objResult['SN'])?addslashes(trim($objResult['SN'])):'';
					$data[$i]["ssopersonposition"]=isset($objResult['SSOPERSONPOSITION'])?addslashes(trim($objResult['SSOPERSONPOSITION'])):'';
					$data[$i]["ssopersonbirthdate"]=isset($objResult['SSOPERSONBIRTHDATE'])?addslashes(trim($objResult['SSOPERSONBIRTHDATE'])):'';
					$data[$i]["accountActive"]=isset($objResult['ACCOUNTACTIVE'])?addslashes(trim($objResult['ACCOUNTACTIVE'])):'';
					$data[$i]["ssopersonclass"]=isset($objResult['SSOPERSONCLASS'])?addslashes(trim($objResult['SSOPERSONCLASS'])):'';
					$data[$i]["cn"]=isset($objResult['CN'])?addslashes(trim($objResult['CN'])):'';
					$data[$i]["PER_EFFECTIVEDATE"]=isset($objResult['PER_EFFECTIVEDATE'])?addslashes(trim($objResult['PER_EFFECTIVEDATE'])):'';
					$data[$i]["PM_NAME"]=isset($objResult['PM_NAME'])?addslashes(trim($objResult['PM_NAME'])):'';
					$data[$i]["PER_DOCDATE"]=isset($objResult['PER_DOCDATE'])?addslashes(trim($objResult['PER_DOCDATE'])):'';
					if($data[$i]["PER_DOCDATE"]==" ")
					{
						$data[$i]["PER_DOCDATE"]=null;
					}
					//	$data[$i]["PER_MGT.PM_NAME"]=$objResult["PER_MGT.PM_NAME"];
					//	$data[$i]["PER_PERSONAL.UPDATE_DATE"]=$objResult["PER_PERSONAL.UPDATE_DATE"];
					//	$data[$i]["PER_PERSONAL.PER_EFFECTIVEDATE"]=$objResult["PER_PERSONAL.PER_EFFECTIVEDATE"];
					//	$data[$i][" PER_POS_NAME.PN_NAME"]=$objResult[" PER_POS_NAME.PN_NAME"];
						
						$i++;
					}
					
					oci_close($objConnect);
				//	var_dump($data);
				//	exit;
					return $data;
			
			}
			
		
	}
	
public function getsearhdpis() 

	{ 
		
		$this->username =Yii::app()->params['prg_ctrl']['dboracle']['username'];		
		$this->password =Yii::app()->params['prg_ctrl']['dboracle']['password'];
		$this->connectdatabase=Yii::app()->params['prg_ctrl']['dboracle']['connectdatabase'];
	
		$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
	
		$strSQL = 'SELECT * FROM DPIS.V_UM_DPIS where ssopersoncitizenid='.$this->pid;// where ssofirstname ='สุกฤต' ';
		$objParse1 = oci_parse($objConnect, $strSQL);
		
		$objParse = oci_parse($objConnect, $strSQL);
		oci_execute($objParse1,OCI_DEFAULT);
		oci_execute($objParse,OCI_DEFAULT);
		$objResult1 = oci_fetch_array($objParse1);
		//var_dump($objResult1);
		//exit;
		
		
		$i=0;
	//	
		if($objResult1 !=null){
		
				while($objResult = oci_fetch_array($objParse))
				{
					$data[$i]["ssofirstname"]=isset($objResult['SSOFIRSTNAME'])?addslashes(trim($objResult['SSOFIRSTNAME'])):'';
					$data[$i]["ssopersoncitizenid"]=isset($objResult['SSOPERSONCITIZENID'])?addslashes(trim($objResult['SSOPERSONCITIZENID'])):'';
					$data[$i]["givenName"]=isset($objResult['GIVENNAME'])?addslashes(trim($objResult['GIVENNAME'])):'';
					$data[$i]["ssosurname"]=isset($objResult['SSOSURNAME'])?addslashes(trim($objResult['SSOSURNAME'])):'';
				//	$data[$i]["maildrop"]=isset($objResult['MAILDROP'])?addslashes(trim($objResult['MAILDROP'])):'';
					$data[$i]["ssopersonempdate"]=isset($objResult['SSOPERSONEMPDATE'])?addslashes(trim($objResult['SSOPERSONEMPDATE'])):'';
					if($data[$i]["ssopersonempdate"]=="-")
					{
						$data[$i]["ssopersonempdate"]="";
					}
					$data[$i]["title"]=isset($objResult['TITLE'])?addslashes(trim($objResult['TITLE'])):'';
					$data[$i]["initials"]=isset($objResult['INITIALS'])?addslashes(trim($objResult['INITIALS'])):'';
					$data[$i]["employeeType"]=isset($objResult['EMPLOYEETYPE'])?addslashes(trim($objResult['EMPLOYEETYPE'])):'';
				//	$data[$i]["mail"]=isset($objResult['MAIL'])?addslashes(trim($objResult['MAIL'])):'';
					$data[$i]["workingdeptdescription"]=isset($objResult['WORKINGDEPTDESCRIPTION'])?addslashes(trim($objResult['WORKINGDEPTDESCRIPTION'])):'';
					$data[$i]["sn"]=isset($objResult['SN'])?addslashes(trim($objResult['SN'])):'';
					$data[$i]["ssopersonposition"]=isset($objResult['SSOPERSONPOSITION'])?addslashes(trim($objResult['SSOPERSONPOSITION'])):'';
					$data[$i]["ssopersonbirthdate"]=isset($objResult['SSOPERSONBIRTHDATE'])?addslashes(trim($objResult['SSOPERSONBIRTHDATE'])):'';
					$data[$i]["accountActive"]=isset($objResult['ACCOUNTACTIVE'])?addslashes(trim($objResult['ACCOUNTACTIVE'])):'';
					$data[$i]["ssopersonclass"]=isset($objResult['SSOPERSONCLASS'])?addslashes(trim($objResult['SSOPERSONCLASS'])):'';
					$data[$i]["cn"]=isset($objResult['CN'])?addslashes(trim($objResult['CN'])):'';
					$data[$i]["PER_EFFECTIVEDATE"]=isset($objResult['PER_EFFECTIVEDATE'])?addslashes(trim($objResult['PER_EFFECTIVEDATE'])):'';
					$data[$i]["PM_NAME"]=isset($objResult['PM_NAME'])?addslashes(trim($objResult['PM_NAME'])):'';
					$data[$i]["PER_DOCDATE"]=isset($objResult['PER_DOCDATE'])?addslashes(trim($objResult['PER_DOCDATE'])):'';
					if($data[$i]["PER_DOCDATE"]==" ")
					{
						$data[$i]["PER_DOCDATE"]=null;
					}
					//$i++;
				}
				
					oci_close($objConnect);
					
					
							$data[$i]["givenName"];
							$data[$i]["sn"];
							$arr_char = str_split($data[$i]["sn"]);
							$username=$arr_char[0].$data[$i]["givenName"];
							$mail=$data[$i]["givenName"].".".$arr_char[0]."sso.go.th";

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
				$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=".$username, array_values($arr_search_attr))  ;
				$entry = @ldap_get_entries($ldapcon, $ldapsr);
					if($entry["count"]==0)
					{
								
						
					
					}else{
							$data[$i]["givenName"];
							$data[$i]["sn"];
							$arr_char = str_split($data[$i]["sn"],2);
							$username=$arr_char[0].$data[$i]["givenName"];
							$mail=$data[$i]["givenName"].".".$arr_char[0]."sso.go.th";
							$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=".$username, array_values($arr_search_attr))  ;
							$entry = @ldap_get_entries($ldapcon, $ldapsr);
							if($entry["count"]==0)
							{
										
								
							}else{
								$data[$i]["givenName"];
								$data[$i]["sn"];
								$arr_char = str_split($data[$i]["sn"],3);
								$username=$arr_char[0].$data[$i]["givenName"];
								$mail=$data[$i]["givenName"].".".$arr_char[0]."@sso.go.th";
								
								
							
						}
					}	
					$passworduser='{MD5}'.base64_encode(pack('H*', md5($arr_char[0])));
					$data[$i]["username"]=$username;
					$data[$i]["userpassword"]=$passworduser;
					$data[$i]["maildrop"]=$mail;
					$data[$i]["mail"]=$mail;
					$data[$i]["quota"]="521000000";
				//var_dump($data);
			//	exit;				
				return $data;
					                 
		}else
			{
				
				
				//oci_close($objConnect);
				//$objConnect = oci_connect($this->username,$this->password,$this->connectdatabaseem,"AL32UTF8");
					
				$strSQL = 'SELECT * FROM DPISEMP1.V_UM_DPISEMP1 where ssopersoncitizenid='.$this->pid;// where ssofirstname ='สุกฤต' ';
			
				$objParse = oci_parse($objConnect, $strSQL);
				//oci_execute($objParse1,OCI_DEFAULT);
				oci_execute($objParse,OCI_DEFAULT);
				//$objResult = oci_fetch_array($objParse);
				//var_dump($objResult);
				//exit;
				$i=0;
					while($objResult = oci_fetch_array($objParse))
				{
					$data[$i]["ssofirstname"]=isset($objResult['SSOFIRSTNAME'])?addslashes(trim($objResult['SSOFIRSTNAME'])):'';
					$data[$i]["ssopersoncitizenid"]=isset($objResult['SSOPERSONCITIZENID'])?addslashes(trim($objResult['SSOPERSONCITIZENID'])):'';
					$data[$i]["givenName"]=isset($objResult['GIVENNAME'])?addslashes(trim($objResult['GIVENNAME'])):'';
					$data[$i]["ssosurname"]=isset($objResult['SSOSURNAME'])?addslashes(trim($objResult['SSOSURNAME'])):'';
				//	$data[$i]["maildrop"]=isset($objResult['MAILDROP'])?addslashes(trim($objResult['MAILDROP'])):'';
					$data[$i]["ssopersonempdate"]=isset($objResult['SSOPERSONEMPDATE'])?addslashes(trim($objResult['SSOPERSONEMPDATE'])):'';
					if($data[$i]["ssopersonempdate"]=="-")
					{
						$data[$i]["ssopersonempdate"]="";
					}
					$data[$i]["title"]=isset($objResult['TITLE'])?addslashes(trim($objResult['TITLE'])):'';
					$data[$i]["initials"]=isset($objResult['INITIALS'])?addslashes(trim($objResult['INITIALS'])):'';
					$data[$i]["employeeType"]=isset($objResult['EMPLOYEETYPE'])?addslashes(trim($objResult['EMPLOYEETYPE'])):'';
				//	$data[$i]["mail"]=isset($objResult['MAIL'])?addslashes(trim($objResult['MAIL'])):'';
					$data[$i]["workingdeptdescription"]=isset($objResult['WORKINGDEPTDESCRIPTION'])?addslashes(trim($objResult['WORKINGDEPTDESCRIPTION'])):'';
					$data[$i]["sn"]=isset($objResult['SN'])?addslashes(trim($objResult['SN'])):'';
					$data[$i]["ssopersonposition"]=isset($objResult['SSOPERSONPOSITION'])?addslashes(trim($objResult['SSOPERSONPOSITION'])):'';
					$data[$i]["ssopersonbirthdate"]=isset($objResult['SSOPERSONBIRTHDATE'])?addslashes(trim($objResult['SSOPERSONBIRTHDATE'])):'';
					$data[$i]["accountActive"]=isset($objResult['ACCOUNTACTIVE'])?addslashes(trim($objResult['ACCOUNTACTIVE'])):'';
					$data[$i]["ssopersonclass"]=isset($objResult['SSOPERSONCLASS'])?addslashes(trim($objResult['SSOPERSONCLASS'])):'';
					$data[$i]["cn"]=isset($objResult['CN'])?addslashes(trim($objResult['CN'])):'';
					$data[$i]["PER_EFFECTIVEDATE"]=isset($objResult['PER_EFFECTIVEDATE'])?addslashes(trim($objResult['PER_EFFECTIVEDATE'])):'';
					$data[$i]["PM_NAME"]=isset($objResult['PM_NAME'])?addslashes(trim($objResult['PM_NAME'])):'';
					$data[$i]["PER_DOCDATE"]=isset($objResult['PER_DOCDATE'])?addslashes(trim($objResult['PER_DOCDATE'])):'';
					if($data[$i]["PER_DOCDATE"]==" ")
					{
						$data[$i]["PER_DOCDATE"]=null;
					}
					//$i++;
				}
				
					oci_close($objConnect);
					
					
							$data[$i]["givenName"];
							$data[$i]["sn"];
							$arr_char = str_split($data[$i]["sn"]);
							$username=$arr_char[0].$data[$i]["givenName"];
							$mail=$data[$i]["givenName"].".".$arr_char[0]."sso.go.th";

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
				$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=".$username, array_values($arr_search_attr))  ;
				$entry = @ldap_get_entries($ldapcon, $ldapsr);
					if($entry["count"]==0)
					{
								
						
					
					}else{
							$data[$i]["givenName"];
							$data[$i]["sn"];
							$arr_char = str_split($data[$i]["sn"],2);
							$username=$arr_char[0].$data[$i]["givenName"];
							$mail=$data[$i]["givenName"].".".$arr_char[0]."sso.go.th";
							$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=".$username, array_values($arr_search_attr))  ;
							$entry = @ldap_get_entries($ldapcon, $ldapsr);
							if($entry["count"]==0)
							{
										
								
							}else{
								$data[$i]["givenName"];
								$data[$i]["sn"];
								$arr_char = str_split($data[$i]["sn"],3);
								$username=$arr_char[0].$data[$i]["givenName"];
								$mail=$data[$i]["givenName"].".".$arr_char[0]."@sso.go.th";
								
								
							
						}
					}	
					$passworduser='{MD5}'.base64_encode(pack('H*', md5($username)));
					$data[$i]["username"]=$username;
					$data[$i]["userpassword"]=$passworduser;
					$data[$i]["maildrop"]=$mail;
					$data[$i]["mail"]=$mail;
					$data[$i]["quota"]="521000000";
				return $data;
			}
			/*
				
						$data[0]["ssofirstname"]="สุกฤต";
						$data[0]["ssopersoncitizenid"]="3539900052242";
						$data[0]["givenName"]="SUKRIT";
						$data[0]["ssosurname"]="กมลวัฒนา";
						$data[0]["maildrop"]="sukrit.k@sso.go.th";
						$data[0]["ssopersonempdate"]="2545/10/01";
						$data[0]["title"]="นาย";
						$data[0]["initials"]="Mr.";
						$data[0]["employeeType"]="ข้าราชการ";
						$data[0]["mail"]="sukrit.k@sso.go.th";
						$data[0]["workingdeptdescription"]="สำนักบริหารเทคโนโลยีสารสนเทศ";
						$data[0]["sn"]='KAMOLWATTANA';
						$data[0]["ssopersonposition"]="นักวิชาการประกันสังคม";
						$data[0]["ssopersonbirthdate"]="2517/10/04";
						$data[0]["accountActive"]="True";
						$data[0]["ssopersonclass"]="ชั้นสูง";
						$data[0]["cn"]="SUKRIT KAMOLWATTANA";
						//$data[0]["PER_MGT.PM_NAME"]="";
						//$data[0]["PER_PERSONAL.UPDATE_DATE"]="";
						//$data[0]["PER_PERSONAL.PER_EFFECTIVEDATE"]="";
						$data[0][" PER_POS_NAME.PN_NAME"]="นักวิชการคอมพิวเตอร์";
						return $data;
						*/
		
	
	
	
	
}
public function datadpis($count)
{
		$this->username =Yii::app()->params['prg_ctrl']['dboracle']['username'];		
		$this->password =Yii::app()->params['prg_ctrl']['dboracle']['password'];
		$this->connectdatabase=Yii::app()->params['prg_ctrl']['dboracle']['connectdatabase'];
		$this->connectdatabaseem=Yii::app()->params['prg_ctrl']['dboracle']['connectdatabaseem'];		
	
		$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
	$sqlCon="";
	//var_dump($count);
	//exit;
		
	//	$count1=759;
	$i=0;	
		
		if(Yii::app()->user->getInfo('UMLevelID')==1||Yii::app()->user->getInfo('UMLevelID')==2)
		{
				$strSQL = 'SELECT * FROM DPIS.V_UM_DPIS OFFSET :test ROWS FETCH NEXT 200 ROWS ONLY';
				$objParse = oci_parse($objConnect, $strSQL);
			    oci_bind_by_name($objParse, ':test', $count);
				
				
			
				oci_execute($objParse,OCI_DEFAULT);
		
				while($objResult = oci_fetch_array($objParse))
				{
					$data[$i]["ssofirstname"]=isset($objResult['SSOFIRSTNAME'])?addslashes(trim($objResult['SSOFIRSTNAME'])):'';
					$data[$i]["ssopersoncitizenid"]=isset($objResult['SSOPERSONCITIZENID'])?addslashes(trim($objResult['SSOPERSONCITIZENID'])):'';
					$data[$i]["givenName"]=isset($objResult['GIVENNAME'])?addslashes(trim($objResult['GIVENNAME'])):'';
					$data[$i]["givenName"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["givenName"]);
					$data[$i]["ssosurname"]=isset($objResult['SSOSURNAME'])?addslashes(trim($objResult['SSOSURNAME'])):'';
				//	$data[$i]["maildrop"]=isset($objResult['MAILDROP'])?addslashes(trim($objResult['MAILDROP'])):'';
					$data[$i]["ssopersonempdate"]=isset($objResult['SSOPERSONEMPDATE'])?addslashes(trim($objResult['SSOPERSONEMPDATE'])):'';
					if($data[$i]["ssopersonempdate"]=="-")
					{
						$data[$i]["ssopersonempdate"]="";
					}
					$data[$i]["title"]=isset($objResult['TITLE'])?addslashes(trim($objResult['TITLE'])):'';
					$data[$i]["initials"]=isset($objResult['INITIALS'])?addslashes(trim($objResult['INITIALS'])):'';
					$data[$i]["employeeType"]=isset($objResult['EMPLOYEETYPE'])?addslashes(trim($objResult['EMPLOYEETYPE'])):'';
				//	$data[$i]["mail"]=isset($objResult['MAIL'])?addslashes(trim($objResult['MAIL'])):'';
					$data[$i]["workingdeptdescription"]=isset($objResult['WORKINGDEPTDESCRIPTION'])?addslashes(trim($objResult['WORKINGDEPTDESCRIPTION'])):'';
					$data[$i]["sn"]=isset($objResult['SN'])?addslashes(trim($objResult['SN'])):'';
					$data[$i]["sn"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["sn"]);
					$data[$i]["ssopersonposition"]=isset($objResult['SSOPERSONPOSITION'])?addslashes(trim($objResult['SSOPERSONPOSITION'])):'';
					$data[$i]["ssopersonbirthdate"]=isset($objResult['SSOPERSONBIRTHDATE'])?addslashes(trim($objResult['SSOPERSONBIRTHDATE'])):'';
					$data[$i]["accountActive"]=isset($objResult['ACCOUNTACTIVE'])?addslashes(trim($objResult['ACCOUNTACTIVE'])):'';
					$data[$i]["ssopersonclass"]=isset($objResult['SSOPERSONCLASS'])?addslashes(trim($objResult['SSOPERSONCLASS'])):'';
					$data[$i]["cn"]=isset($objResult['CN'])?addslashes(trim($objResult['CN'])):'';
					$data[$i]["PER_EFFECTIVEDATE"]=isset($objResult['PER_EFFECTIVEDATE'])?addslashes(trim($objResult['PER_EFFECTIVEDATE'])):'';
					$data[$i]["PM_NAME"]=isset($objResult['PM_NAME'])?addslashes(trim($objResult['PM_NAME'])):'';
					$data[$i]["PER_DOCDATE"]=isset($objResult['PER_DOCDATE'])?addslashes(trim($objResult['PER_DOCDATE'])):'';
					if($data[$i]["PER_DOCDATE"]==" ")
					{
						$data[$i]["PER_DOCDATE"]=null;
					}
							$data[$i]["givenName"];
							$data[$i]["sn"];
							$arr_char = str_split($data[$i]["sn"]);
							$username=$arr_char[0].$data[$i]["givenName"];
							$mail=$data[$i]["givenName"].".".$arr_char[0]."sso.go.th";

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
					$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=".$username, array_values($arr_search_attr))  ;
					$entry = @ldap_get_entries($ldapcon, $ldapsr);
						if($entry["count"]==0)
						{
									
							
						
						}else{
								$data[$i]["givenName"];
								$data[$i]["sn"];
								$arr_char = str_split($data[$i]["sn"],2);
								$username=$arr_char[0].$data[$i]["givenName"];
								$mail=$data[$i]["givenName"].".".$arr_char[0]."sso.go.th";
								$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=".$username, array_values($arr_search_attr))  ;
								$entry = @ldap_get_entries($ldapcon, $ldapsr);
								if($entry["count"]==0)
								{
											
									
								}else{
									$data[$i]["givenName"];
									$data[$i]["sn"];
									$arr_char = str_split($data[$i]["sn"],3);
									$username=$arr_char[0].$data[$i]["givenName"];
									$mail=$data[$i]["givenName"].".".$arr_char[0]."@sso.go.th";
									
									
								
							}
						}	
						$passworduser='{MD5}'.base64_encode(pack('H*', md5($arr_char[0])));
						$data[$i]["username"]=$username;
						$data[$i]["userpassword"]=$passworduser;
						$data[$i]["maildrop"]=$mail;
						$data[$i]["mail"]=$mail;
						$data[$i]["quota"]="521000000";
					//	var_dump($data[$i]["ssopersonposition"]);
						$i++;
				
				}
			//	exit;
				
		}
		
		
		

		
				oci_close($objConnect);
	//	
		
		
			
					
				//var_dump($data);
				return $data;
				
			                 
		}	
	public function datadpisem($countdata)
			{
				
				$this->username ="appum";				
				$this->password ="APP@um";
				$this->userdatabase="DPIS";
				$this->userdatabaseem="DPISEMP1";
				$this->connectdatabase="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 172.20.91.17)(PORT = 1521)) 
										(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DPIS) ))";
				$this->connectdatabaseem="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 172.20.91.17)(PORT = 1521)) 
										(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DPISEMP1) ))";		
				//$count1=3751;
				$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
				//oci_close($objConnect);
				//$objConnect = oci_connect($this->username,$this->password,$this->connectdatabaseem,"AL32UTF8");
				$i=0;
				if(Yii::app()->user->getInfo('UMLevelID')==1||Yii::app()->user->getInfo('UMLevelID')==2)
				{
					$strSQL = 'SELECT * FROM DPISEMP1.V_UM_DPISEMP1 OFFSET :test ROWS FETCH NEXT 200 ROWS ONLY';
					$objParse = oci_parse($objConnect, $strSQL);
					oci_bind_by_name($objParse, ':test', $countdata);
					oci_execute($objParse,OCI_DEFAULT);
					while($objResult = oci_fetch_array($objParse))
								{
									$data[$i]["ssofirstname"]=isset($objResult['SSOFIRSTNAME'])?addslashes(trim($objResult['SSOFIRSTNAME'])):'';
									$data[$i]["ssopersoncitizenid"]=isset($objResult['SSOPERSONCITIZENID'])?addslashes(trim($objResult['SSOPERSONCITIZENID'])):'';
									$data[$i]["givenName"]=isset($objResult['GIVENNAME'])?addslashes(trim($objResult['GIVENNAME'])):'';
									$data[$i]["givenName"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["givenName"]);
									$data[$i]["ssosurname"]=isset($objResult['SSOSURNAME'])?addslashes(trim($objResult['SSOSURNAME'])):'';
								//	$data[$i]["maildrop"]=isset($objResult['MAILDROP'])?addslashes(trim($objResult['MAILDROP'])):'';
									$data[$i]["ssopersonempdate"]=isset($objResult['SSOPERSONEMPDATE'])?addslashes(trim($objResult['SSOPERSONEMPDATE'])):'';
									if($data[$i]["ssopersonempdate"]=="-")
									{
										$data[$i]["ssopersonempdate"]="";
									}
									$data[$i]["title"]=isset($objResult['TITLE'])?addslashes(trim($objResult['TITLE'])):'';
									$data[$i]["initials"]=isset($objResult['INITIALS'])?addslashes(trim($objResult['INITIALS'])):'';
									$data[$i]["employeeType"]=isset($objResult['EMPLOYEETYPE'])?addslashes(trim($objResult['EMPLOYEETYPE'])):'';
								//	$data[$i]["mail"]=isset($objResult['MAIL'])?addslashes(trim($objResult['MAIL'])):'';
									$data[$i]["workingdeptdescription"]=isset($objResult['WORKINGDEPTDESCRIPTION'])?addslashes(trim($objResult['WORKINGDEPTDESCRIPTION'])):'';
									$data[$i]["sn"]=isset($objResult['SN'])?addslashes(trim($objResult['SN'])):'';
									$data[$i]["sn"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["sn"]);
									$data[$i]["ssopersonposition"]=isset($objResult['SSOPERSONPOSITION'])?addslashes(trim($objResult['SSOPERSONPOSITION'])):'';
									$data[$i]["ssopersonbirthdate"]=isset($objResult['SSOPERSONBIRTHDATE'])?addslashes(trim($objResult['SSOPERSONBIRTHDATE'])):'';
									$data[$i]["accountActive"]=isset($objResult['ACCOUNTACTIVE'])?addslashes(trim($objResult['ACCOUNTACTIVE'])):'';
									$data[$i]["ssopersonclass"]=isset($objResult['SSOPERSONCLASS'])?addslashes(trim($objResult['SSOPERSONCLASS'])):'';
									$data[$i]["cn"]=isset($objResult['CN'])?addslashes(trim($objResult['CN'])):'';
									$data[$i]["PER_EFFECTIVEDATE"]=isset($objResult['PER_EFFECTIVEDATE'])?addslashes(trim($objResult['PER_EFFECTIVEDATE'])):'';
									$data[$i]["PM_NAME"]=isset($objResult['PM_NAME'])?addslashes(trim($objResult['PM_NAME'])):'';
									$data[$i]["PER_DOCDATE"]=isset($objResult['PER_DOCDATE'])?addslashes(trim($objResult['PER_DOCDATE'])):'';
									if($data[$i]["PER_DOCDATE"]==" ")
										{
											$data[$i]["PER_DOCDATE"]=null;
										}
									$data[$i]["givenName"];
									$data[$i]["sn"];
									$arr_char = str_split($data[$i]["sn"]);
									$username=$arr_char[0].$data[$i]["givenName"];
									$mail=$data[$i]["givenName"].".".$arr_char[0]."sso.go.th";

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
									$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=".$username, array_values($arr_search_attr))  ;
									$entry = @ldap_get_entries($ldapcon, $ldapsr);
										if($entry["count"]==0)
										{
													
											
										
										}else{
												$data[$i]["givenName"];
												$data[$i]["sn"];
												$arr_char = str_split($data[$i]["sn"],2);
												$username=$arr_char[0].$data[$i]["givenName"];
												$mail=$data[$i]["givenName"].".".$arr_char[0]."sso.go.th";
												$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=".$username, array_values($arr_search_attr))  ;
												$entry = @ldap_get_entries($ldapcon, $ldapsr);
												if($entry["count"]==0)
												{
															
													
												}else{
													$data[$i]["givenName"];
													$data[$i]["sn"];
													$arr_char = str_split($data[$i]["sn"],3);
													$username=$arr_char[0].$data[$i]["givenName"];
													$mail=$data[$i]["givenName"].".".$arr_char[0]."@sso.go.th";
													
													
												
											}
										}	
										$passworduser='{MD5}'.base64_encode(pack('H*', md5($username)));
										$data[$i]["username"]=$username;
										$data[$i]["userpassword"]=$passworduser;
										$data[$i]["maildrop"]=$mail;
										$data[$i]["mail"]=$mail;
										$data[$i]["quota"]="521000000";
							//	var_dump($data[$i]["username"]);
								
									$i++;
						}
				
				}
				
						
					
						
							oci_close($objConnect);
							
							
			
				return $data;
			
}
public function countdata()
{
	$this->username ="appum";				
		$this->password ="APP@um";
		$this->userdatabase="DPIS";
		$this->userdatabaseem="DPISEMP1";
		$this->connectdatabase="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 172.20.91.17)(PORT = 1521)) 
								(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DPIS) ))";
		$this->connectdatabaseem="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 172.20.91.17)(PORT = 1521)) 
								(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DPISEMP1) ))";		
	
	$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
	
	$strSQL = 'SELECT count(*) FROM DPIS.V_UM_DPIS';
	$objParse = oci_parse($objConnect, $strSQL);
				//oci_execute($objParse1,OCI_DEFAULT);
				oci_execute($objParse,OCI_DEFAULT);
				$objResult = oci_fetch_array($objParse);
				
				//var_dump($objResult);
				//exit;
				oci_close($objConnect);
				return $objResult;
}
public function countdataem1()
{
	$this->username ="appum";				
		$this->password ="APP@um";
		$this->userdatabase="DPIS";
		$this->userdatabaseem="DPISEMP1";
		$this->connectdatabase="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 172.20.91.17)(PORT = 1521)) 
								(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DPIS) ))";
		$this->connectdatabaseem="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 172.20.91.17)(PORT = 1521)) 
								(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DPISEMP1) ))";		
	
	$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
	
	$strSQL = 'SELECT count(*) FROM DPISEMP1.V_UM_DPISEMP1';
	$objParse = oci_parse($objConnect, $strSQL);
				//oci_execute($objParse1,OCI_DEFAULT);
				oci_execute($objParse,OCI_DEFAULT);
				$objResult = oci_fetch_array($objParse);
				
				//var_dump($objResult);
				//exit;
				oci_close($objConnect);
				return $objResult;
}
public function dpisdatalevel3()
	{
				$this->username ="appum";				
				$this->password ="APP@um";
				$this->userdatabase="DPIS";
				$this->userdatabaseem="DPISEMP1";
				$this->connectdatabase="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 172.20.91.17)(PORT = 1521)) 
										(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DPIS) ))";
				$this->connectdatabaseem="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 172.20.91.17)(PORT = 1521)) 
										(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DPISEMP1) ))";		
				//$count1=3751;
				$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
				//oci_close($objConnect);
				//$objConnect = oci_connect($this->username,$this->password,$this->connectdatabaseem,"AL32UTF8");
				$i=0;
				
				$DeptID=Yii::app()->user->getInfo('DeptID');
				$depid=substr($DeptID,0,2);
				if($depid==10)
					{
						$sql ="select DeptID,DeptNameTH  from mas_department where DeptID=".$DeptID;
						$rows =Yii::app()->db->createCommand($sql)->queryAll();	
					}
				else
					{
						$sql ="select DeptID,DeptNameTH  from mas_department where left(DeptID,2)=".$depid;
						$rows =Yii::app()->db->createCommand($sql)->queryAll();
					}
			
				foreach($rows as $dataitem)
				{
					$DeptNameTH=$dataitem['DeptNameTH'];
						$strSQL = 'SELECT * FROM DPIS.V_UM_DPIS where workingdeptdescription = :test'  ;
					$objParse = oci_parse($objConnect, $strSQL);
					oci_bind_by_name($objParse, ':test', $DeptNameTH);
				
				//$objParse = oci_parse($objConnect, $strSQL);
					oci_execute($objParse);
							while($objResult = oci_fetch_array($objParse))
								{
									$data[$i]["ssofirstname"]=isset($objResult['SSOFIRSTNAME'])?addslashes(trim($objResult['SSOFIRSTNAME'])):'';
									$data[$i]["ssopersoncitizenid"]=isset($objResult['SSOPERSONCITIZENID'])?addslashes(trim($objResult['SSOPERSONCITIZENID'])):'';
									$data[$i]["givenName"]=isset($objResult['GIVENNAME'])?addslashes(trim($objResult['GIVENNAME'])):'';
									$data[$i]["givenName"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["givenName"]);
									$data[$i]["ssosurname"]=isset($objResult['SSOSURNAME'])?addslashes(trim($objResult['SSOSURNAME'])):'';
								//	$data[$i]["maildrop"]=isset($objResult['MAILDROP'])?addslashes(trim($objResult['MAILDROP'])):'';
									$data[$i]["ssopersonempdate"]=isset($objResult['SSOPERSONEMPDATE'])?addslashes(trim($objResult['SSOPERSONEMPDATE'])):'';
									if($data[$i]["ssopersonempdate"]=="-")
									{
										$data[$i]["ssopersonempdate"]="";
									}
									$data[$i]["title"]=isset($objResult['TITLE'])?addslashes(trim($objResult['TITLE'])):'';
									$data[$i]["initials"]=isset($objResult['INITIALS'])?addslashes(trim($objResult['INITIALS'])):'';
									$data[$i]["employeeType"]=isset($objResult['EMPLOYEETYPE'])?addslashes(trim($objResult['EMPLOYEETYPE'])):'';
								//	$data[$i]["mail"]=isset($objResult['MAIL'])?addslashes(trim($objResult['MAIL'])):'';
									$data[$i]["workingdeptdescription"]=isset($objResult['WORKINGDEPTDESCRIPTION'])?addslashes(trim($objResult['WORKINGDEPTDESCRIPTION'])):'';
									$data[$i]["sn"]=isset($objResult['SN'])?addslashes(trim($objResult['SN'])):'';
									$data[$i]["sn"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["sn"]);
									$data[$i]["ssopersonposition"]=isset($objResult['SSOPERSONPOSITION'])?addslashes(trim($objResult['SSOPERSONPOSITION'])):'';
									$data[$i]["ssopersonbirthdate"]=isset($objResult['SSOPERSONBIRTHDATE'])?addslashes(trim($objResult['SSOPERSONBIRTHDATE'])):'';
									$data[$i]["accountActive"]=isset($objResult['ACCOUNTACTIVE'])?addslashes(trim($objResult['ACCOUNTACTIVE'])):'';
									$data[$i]["ssopersonclass"]=isset($objResult['SSOPERSONCLASS'])?addslashes(trim($objResult['SSOPERSONCLASS'])):'';
									$data[$i]["cn"]=isset($objResult['CN'])?addslashes(trim($objResult['CN'])):'';
									$data[$i]["PER_EFFECTIVEDATE"]=isset($objResult['PER_EFFECTIVEDATE'])?addslashes(trim($objResult['PER_EFFECTIVEDATE'])):'';
									$data[$i]["PM_NAME"]=isset($objResult['PM_NAME'])?addslashes(trim($objResult['PM_NAME'])):'';
									$data[$i]["PER_DOCDATE"]=isset($objResult['PER_DOCDATE'])?addslashes(trim($objResult['PER_DOCDATE'])):'';
									if($data[$i]["PER_DOCDATE"]==" ")
										{
											$data[$i]["PER_DOCDATE"]=null;
										}
											$data[$i]["givenName"];
											$data[$i]["sn"];
											$arr_char = str_split($data[$i]["sn"]);
											$username=$arr_char[0].$data[$i]["givenName"];
											$mail=$data[$i]["givenName"].".".$arr_char[0]."sso.go.th";

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
									$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=".$username, array_values($arr_search_attr))  ;
									$entry = @ldap_get_entries($ldapcon, $ldapsr);
										if($entry["count"]==0)
										{
													
											
										
										}else{
												$data[$i]["givenName"];
												$data[$i]["sn"];
												$arr_char = str_split($data[$i]["sn"],2);
												$username=$arr_char[0].$data[$i]["givenName"];
												$mail=$data[$i]["givenName"].".".$arr_char[0]."sso.go.th";
												$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=".$username, array_values($arr_search_attr))  ;
												$entry = @ldap_get_entries($ldapcon, $ldapsr);
												if($entry["count"]==0)
												{
															
													
												}else{
													$data[$i]["givenName"];
													$data[$i]["sn"];
													$arr_char = str_split($data[$i]["sn"],3);
													$username=$arr_char[0].$data[$i]["givenName"];
													$mail=$data[$i]["givenName"].".".$arr_char[0]."@sso.go.th";
													
													
												
											}
										}	
										$passworduser='{MD5}'.base64_encode(pack('H*', md5($arr_char[0])));
										$data[$i]["username"]=$username;
										$data[$i]["userpassword"]=$passworduser;
										$data[$i]["maildrop"]=$mail;
										$data[$i]["mail"]=$mail;
										$data[$i]["quota"]="521000000";
									//	var_dump($data[$i]["ssopersonposition"]);
										$i++;
						
								}
				}
			
			
		
		
		
		

		
				oci_close($objConnect);
	//	
	
					
				
				return $data;
	}
public function dpisemdatalevel3()
	{
		
						$this->username ="appum";				
						$this->password ="APP@um";
						$this->userdatabase="DPIS";
						$this->userdatabaseem="DPISEMP1";
						$this->connectdatabase="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 172.20.91.17)(PORT = 1521)) 
												(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DPIS) ))";
						$this->connectdatabaseem="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 172.20.91.17)(PORT = 1521)) 
												(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DPISEMP1) ))";		
						//$count1=3751;
						$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
						$i=0;
						$DeptID=Yii::app()->user->getInfo('DeptID');
						$depid=substr($DeptID,0,2);
						if($depid==10)
							{
								$sql ="select DeptID,DeptNameTH  from mas_department where DeptID=".$DeptID;
								$rows =Yii::app()->db->createCommand($sql)->queryAll();	
							}
						else
							{
								$sql ="select DeptID,DeptNameTH  from mas_department where left(DeptID,2)=".$depid;
								$rows =Yii::app()->db->createCommand($sql)->queryAll();
							}
							
						foreach($rows as $dataitem)
						{
							$DeptNameTH=$dataitem['DeptNameTH'];
							
							$strSQL = 'SELECT * FROM  DPISEMP1.V_UM_DPISEMP1 where workingdeptdescription = :test'  ;
							$objParse = oci_parse($objConnect, $strSQL);
							oci_bind_by_name($objParse, ':test', $DeptNameTH);
							oci_execute($objParse);
							while($objResult = oci_fetch_array($objParse))
								{
									$data[$i]["ssofirstname"]=isset($objResult['SSOFIRSTNAME'])?addslashes(trim($objResult['SSOFIRSTNAME'])):'';
									$data[$i]["ssopersoncitizenid"]=isset($objResult['SSOPERSONCITIZENID'])?addslashes(trim($objResult['SSOPERSONCITIZENID'])):'';
									$data[$i]["givenName"]=isset($objResult['GIVENNAME'])?addslashes(trim($objResult['GIVENNAME'])):'';
									$data[$i]["givenName"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["givenName"]);
									$data[$i]["ssosurname"]=isset($objResult['SSOSURNAME'])?addslashes(trim($objResult['SSOSURNAME'])):'';
								//	$data[$i]["maildrop"]=isset($objResult['MAILDROP'])?addslashes(trim($objResult['MAILDROP'])):'';
									$data[$i]["ssopersonempdate"]=isset($objResult['SSOPERSONEMPDATE'])?addslashes(trim($objResult['SSOPERSONEMPDATE'])):'';
									$data[$i]["initials"]=isset($objResult['INITIALS'])?addslashes(trim($objResult['INITIALS'])):'';
									if($data[$i]["ssopersonempdate"]=="-")
										{
											$data[$i]["ssopersonempdate"]="";
										}
									$data[$i]["title"]=isset($objResult['TITLE'])?addslashes(trim($objResult['TITLE'])):'';
									if($data[$i]["title"]=="")
										{
											
												
										}
									$data[$i]["employeeType"]=isset($objResult['EMPLOYEETYPE'])?addslashes(trim($objResult['EMPLOYEETYPE'])):'';
								//	$data[$i]["mail"]=isset($objResult['MAIL'])?addslashes(trim($objResult['MAIL'])):'';
									$data[$i]["workingdeptdescription"]=isset($objResult['WORKINGDEPTDESCRIPTION'])?addslashes(trim($objResult['WORKINGDEPTDESCRIPTION'])):'';
									$data[$i]["sn"]=isset($objResult['SN'])?addslashes(trim($objResult['SN'])):'';
									$data[$i]["sn"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["sn"]);
									$data[$i]["ssopersonposition"]=isset($objResult['SSOPERSONPOSITION'])?addslashes(trim($objResult['SSOPERSONPOSITION'])):'';
									$data[$i]["ssopersonbirthdate"]=isset($objResult['SSOPERSONBIRTHDATE'])?addslashes(trim($objResult['SSOPERSONBIRTHDATE'])):'';
									$data[$i]["accountActive"]=isset($objResult['ACCOUNTACTIVE'])?addslashes(trim($objResult['ACCOUNTACTIVE'])):'';
									$data[$i]["ssopersonclass"]=isset($objResult['SSOPERSONCLASS'])?addslashes(trim($objResult['SSOPERSONCLASS'])):'';
									$data[$i]["cn"]=isset($objResult['CN'])?addslashes(trim($objResult['CN'])):'';
									$data[$i]["PER_EFFECTIVEDATE"]=isset($objResult['PER_EFFECTIVEDATE'])?addslashes(trim($objResult['PER_EFFECTIVEDATE'])):'';
									$data[$i]["PM_NAME"]=isset($objResult['PM_NAME'])?addslashes(trim($objResult['PM_NAME'])):'';
									$data[$i]["PER_DOCDATE"]=isset($objResult['PER_DOCDATE'])?addslashes(trim($objResult['PER_DOCDATE'])):'';
									if($data[$i]["PER_DOCDATE"]==" ")
										{
											$data[$i]["PER_DOCDATE"]=null;
										}
									$data[$i]["givenName"];
									$data[$i]["sn"];
									$arr_char = str_split($data[$i]["sn"]);
									$username=$arr_char[0].$data[$i]["givenName"];
									$mail=$data[$i]["givenName"].".".$arr_char[0]."sso.go.th";

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
									$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=".$username, array_values($arr_search_attr))  ;
									$entry = @ldap_get_entries($ldapcon, $ldapsr);
										if($entry["count"]==0)
										{
													
											
										
										}else{
												$data[$i]["givenName"];
												$data[$i]["sn"];
												$arr_char = str_split($data[$i]["sn"],2);
												$username=$arr_char[0].$data[$i]["givenName"];
												$mail=$data[$i]["givenName"].".".$arr_char[0]."sso.go.th";
												$ldapsr = ldap_search($ldapcon, $arr_basedn, $filter_attr."=".$username, array_values($arr_search_attr))  ;
												$entry = @ldap_get_entries($ldapcon, $ldapsr);
												if($entry["count"]==0)
												{
															
													
												}else{
													$data[$i]["givenName"];
													$data[$i]["sn"];
													$arr_char = str_split($data[$i]["sn"],3);
													$username=$arr_char[0].$data[$i]["givenName"];
													$mail=$data[$i]["givenName"].".".$arr_char[0]."@sso.go.th";
													
													
												
											}
										}	
										$passworduser='{MD5}'.base64_encode(pack('H*', md5($username)));
										$data[$i]["username"]=$username;
										$data[$i]["userpassword"]=$passworduser;
										$data[$i]["maildrop"]=$mail;
										$data[$i]["mail"]=$mail;
										$data[$i]["quota"]="521000000";
							
								
									$i++;
							}
						}
						
						
					
						
							oci_close($objConnect);
							
							
			
				return $data;
	}
public function datadpisflow( $count)
{
	
		$this->username =Yii::app()->params['prg_ctrl']['dboracle']['username'];		
		$this->password =Yii::app()->params['prg_ctrl']['dboracle']['password'];
		$this->connectdatabase=Yii::app()->params['prg_ctrl']['dboracle']['connectdatabase'];
	
		$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
	
		$i=0;
	
				$strSQL = 'SELECT * FROM DPIS.V_UM_DPIS OFFSET :test ROWS FETCH NEXT 5000 ROWS ONLY';
				$objParse = oci_parse($objConnect, $strSQL);
			    oci_bind_by_name($objParse, ':test', $count);
				oci_execute($objParse,OCI_DEFAULT);
				while($objResult = oci_fetch_array($objParse))
								{
									
									$data[$i]["PER_ID"]=isset($objResult['PER_ID'])?addslashes(trim($objResult['PER_ID'])):'';
									$data[$i]["ssofirstname"]=isset($objResult['SSOFIRSTNAME'])?addslashes(trim($objResult['SSOFIRSTNAME'])):'';
									$data[$i]["ssopersoncitizenid"]=isset($objResult['SSOPERSONCITIZENID'])?addslashes(trim($objResult['SSOPERSONCITIZENID'])):'';
									$data[$i]["givenName"]=isset($objResult['GIVENNAME'])?addslashes(trim($objResult['GIVENNAME'])):'';
									$data[$i]["givenName"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["givenName"]);
									$data[$i]["ssosurname"]=isset($objResult['SSOSURNAME'])?addslashes(trim($objResult['SSOSURNAME'])):'';
								//	$data[$i]["maildrop"]=isset($objResult['MAILDROP'])?addslashes(trim($objResult['MAILDROP'])):'';
									$data[$i]["ssopersonempdate"]=isset($objResult['SSOPERSONEMPDATE'])?addslashes(trim($objResult['SSOPERSONEMPDATE'])):'';
									if($data[$i]["ssopersonempdate"]=="-")
									{
										$data[$i]["ssopersonempdate"]="";
									}
									$data[$i]["title"]=isset($objResult['TITLE'])?addslashes(trim($objResult['TITLE'])):'';
									$data[$i]["initials"]=isset($objResult['INITIALS'])?addslashes(trim($objResult['INITIALS'])):'';
									$data[$i]["employeeType"]=isset($objResult['EMPLOYEETYPE'])?addslashes(trim($objResult['EMPLOYEETYPE'])):'';
								//	$data[$i]["mail"]=isset($objResult['MAIL'])?addslashes(trim($objResult['MAIL'])):'';
									$data[$i]["workingdeptdescription"]=isset($objResult['WORKINGDEPTDESCRIPTION'])?addslashes(trim($objResult['WORKINGDEPTDESCRIPTION'])):'';
									$data[$i]["sn"]=isset($objResult['SN'])?addslashes(trim($objResult['SN'])):'';
									$data[$i]["sn"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["sn"]);
									$data[$i]["ssopersonposition"]=isset($objResult['SSOPERSONPOSITION'])?addslashes(trim($objResult['SSOPERSONPOSITION'])):'';
									$data[$i]["ssopersonbirthdate"]=isset($objResult['SSOPERSONBIRTHDATE'])?addslashes(trim($objResult['SSOPERSONBIRTHDATE'])):'';
									$data[$i]["accountActive"]=isset($objResult['ACCOUNTACTIVE'])?addslashes(trim($objResult['ACCOUNTACTIVE'])):'';
									$data[$i]["ssopersonclass"]=isset($objResult['SSOPERSONCLASS'])?addslashes(trim($objResult['SSOPERSONCLASS'])):'';
									$data[$i]["cn"]=isset($objResult['CN'])?addslashes(trim($objResult['CN'])):'';
									$data[$i]["PER_EFFECTIVEDATE"]=isset($objResult['PER_EFFECTIVEDATE'])?addslashes(trim($objResult['PER_EFFECTIVEDATE'])):'';
									$data[$i]["PM_NAME"]=isset($objResult['PM_NAME'])?addslashes(trim($objResult['PM_NAME'])):'';
									$data[$i]["PICPATH"]=isset($objResult['PICPATH'])?addslashes(trim($objResult['PICPATH'])):'';
									$data[$i]["PIC_UPDATE"]=isset($objResult['PIC_UPDATE'])?addslashes(trim($objResult['PIC_UPDATE'])):'';
									$data[$i]["PER_GENDER"]=isset($objResult['GENDER'])?addslashes(trim($objResult['GENDER'])):''; 
									$data[$i]["PER_DOCDATE"]=isset($objResult['PER_DOCDATE'])?addslashes(trim($objResult['PER_DOCDATE'])):'';
									if($data[$i]["PER_DOCDATE"]==" ")
										{
											$data[$i]["PER_DOCDATE"]=null;
										}
										$i++;
								}
			/*	$strSQL = 'SELECT * FROM DPISEMP1.V_UM_DPISEMP1' ;
				$objParse = oci_parse($objConnect, $strSQL);
				oci_execute($objParse,OCI_DEFAULT);
				while($objResult = oci_fetch_array($objParse))
								{
									$data[$i]["PER_ID"]=isset($objResult['PER_ID'])?addslashes(trim($objResult['PER_ID'])):'';
									$data[$i]["ssofirstname"]=isset($objResult['SSOFIRSTNAME'])?addslashes(trim($objResult['SSOFIRSTNAME'])):'';
									$data[$i]["ssopersoncitizenid"]=isset($objResult['SSOPERSONCITIZENID'])?addslashes(trim($objResult['SSOPERSONCITIZENID'])):'';
									$data[$i]["givenName"]=isset($objResult['GIVENNAME'])?addslashes(trim($objResult['GIVENNAME'])):'';
									$data[$i]["givenName"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["givenName"]);
									$data[$i]["ssosurname"]=isset($objResult['SSOSURNAME'])?addslashes(trim($objResult['SSOSURNAME'])):'';
								//	$data[$i]["maildrop"]=isset($objResult['MAILDROP'])?addslashes(trim($objResult['MAILDROP'])):'';
									$data[$i]["ssopersonempdate"]=isset($objResult['SSOPERSONEMPDATE'])?addslashes(trim($objResult['SSOPERSONEMPDATE'])):'';
									if($data[$i]["ssopersonempdate"]=="-")
									{
										$data[$i]["ssopersonempdate"]="";
									}
									$data[$i]["title"]=isset($objResult['TITLE'])?addslashes(trim($objResult['TITLE'])):'';
									$data[$i]["initials"]=isset($objResult['INITIALS'])?addslashes(trim($objResult['INITIALS'])):'';
									$data[$i]["employeeType"]=isset($objResult['EMPLOYEETYPE'])?addslashes(trim($objResult['EMPLOYEETYPE'])):'';
								//	$data[$i]["mail"]=isset($objResult['MAIL'])?addslashes(trim($objResult['MAIL'])):'';
									$data[$i]["workingdeptdescription"]=isset($objResult['WORKINGDEPTDESCRIPTION'])?addslashes(trim($objResult['WORKINGDEPTDESCRIPTION'])):'';
									$data[$i]["sn"]=isset($objResult['SN'])?addslashes(trim($objResult['SN'])):'';
									$data[$i]["sn"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["sn"]);
									$data[$i]["ssopersonposition"]=isset($objResult['SSOPERSONPOSITION'])?addslashes(trim($objResult['SSOPERSONPOSITION'])):'';
									$data[$i]["ssopersonbirthdate"]=isset($objResult['SSOPERSONBIRTHDATE'])?addslashes(trim($objResult['SSOPERSONBIRTHDATE'])):'';
									$data[$i]["accountActive"]=isset($objResult['ACCOUNTACTIVE'])?addslashes(trim($objResult['ACCOUNTACTIVE'])):'';
									$data[$i]["ssopersonclass"]=isset($objResult['SSOPERSONCLASS'])?addslashes(trim($objResult['SSOPERSONCLASS'])):'';
									$data[$i]["cn"]=isset($objResult['CN'])?addslashes(trim($objResult['CN'])):'';
									$data[$i]["PER_EFFECTIVEDATE"]=isset($objResult['PER_EFFECTIVEDATE'])?addslashes(trim($objResult['PER_EFFECTIVEDATE'])):'';
									$data[$i]["PM_NAME"]=isset($objResult['PM_NAME'])?addslashes(trim($objResult['PM_NAME'])):'';
									$data[$i]["PICPATH"]=isset($objResult['PICPATH'])?addslashes(trim($objResult['PICPATH'])):'';
									$data[$i]["PIC_UPDATE"]=isset($objResult['PIC_UPDATE'])?addslashes(trim($objResult['PIC_UPDATE'])):'';
									$data[$i]["PER_GENDER"]=isset($objResult['PER_GENDER'])?addslashes(trim($objResult['PER_GENDER'])):''; 
									$data[$i]["PER_DOCDATE"]=isset($objResult['PER_DOCDATE'])?addslashes(trim($objResult['PER_DOCDATE'])):'';
									if($data[$i]["PER_DOCDATE"]==" ")
										{
											$data[$i]["PER_DOCDATE"]=null;
										}
										$i++;
								}	*/
								oci_close($objConnect);
								return $data;
								
}	
public function callAPI($method, $url, $data){
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'APIKEY: 111111111111111111111',
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}
public function datadpisemflow($count)
{

				$this->username =Yii::app()->params['prg_ctrl']['dboracle']['username'];		
				$this->password =Yii::app()->params['prg_ctrl']['dboracle']['password'];
				$this->connectdatabase=Yii::app()->params['prg_ctrl']['dboracle']['connectdatabase'];
			
				$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
				$i=0;
				$strSQL = 'SELECT * FROM DPIS.V_UM_DPIS';
				$objParse = oci_parse($objConnect, $strSQL);
			   // oci_bind_by_name($objParse, ':test', $count);
				oci_execute($objParse,OCI_DEFAULT);
				while($objResult = oci_fetch_array($objParse))
								{
									
									$data[$i]["PER_ID"]=isset($objResult['PER_ID'])?addslashes(trim($objResult['PER_ID'])):'';
									$data[$i]["ssofirstname"]=isset($objResult['SSOFIRSTNAME'])?addslashes(trim($objResult['SSOFIRSTNAME'])):'';
									$data[$i]["ssopersoncitizenid"]=isset($objResult['SSOPERSONCITIZENID'])?addslashes(trim($objResult['SSOPERSONCITIZENID'])):'';
									$data[$i]["givenName"]=isset($objResult['GIVENNAME'])?addslashes(trim($objResult['GIVENNAME'])):'';
									$data[$i]["givenName"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["givenName"]);
									$data[$i]["ssosurname"]=isset($objResult['SSOSURNAME'])?addslashes(trim($objResult['SSOSURNAME'])):'';
								//	$data[$i]["maildrop"]=isset($objResult['MAILDROP'])?addslashes(trim($objResult['MAILDROP'])):'';
									$data[$i]["ssopersonempdate"]=isset($objResult['SSOPERSONEMPDATE'])?addslashes(trim($objResult['SSOPERSONEMPDATE'])):'';
									if($data[$i]["ssopersonempdate"]=="-")
									{
										$data[$i]["ssopersonempdate"]="";
									}
									$data[$i]["title"]=isset($objResult['TITLE'])?addslashes(trim($objResult['TITLE'])):'';
									$data[$i]["initials"]=isset($objResult['INITIALS'])?addslashes(trim($objResult['INITIALS'])):'';
									$data[$i]["employeeType"]=isset($objResult['EMPLOYEETYPE'])?addslashes(trim($objResult['EMPLOYEETYPE'])):'';
								//	$data[$i]["mail"]=isset($objResult['MAIL'])?addslashes(trim($objResult['MAIL'])):'';
									$data[$i]["workingdeptdescription"]=isset($objResult['WORKINGDEPTDESCRIPTION'])?addslashes(trim($objResult['WORKINGDEPTDESCRIPTION'])):'';
									$data[$i]["sn"]=isset($objResult['SN'])?addslashes(trim($objResult['SN'])):'';
									$data[$i]["sn"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["sn"]);
									$data[$i]["ssopersonposition"]=isset($objResult['SSOPERSONPOSITION'])?addslashes(trim($objResult['SSOPERSONPOSITION'])):'';
									$data[$i]["ssopersonbirthdate"]=isset($objResult['SSOPERSONBIRTHDATE'])?addslashes(trim($objResult['SSOPERSONBIRTHDATE'])):'';
									$data[$i]["accountActive"]=isset($objResult['ACCOUNTACTIVE'])?addslashes(trim($objResult['ACCOUNTACTIVE'])):'';
									$data[$i]["ssopersonclass"]=isset($objResult['SSOPERSONCLASS'])?addslashes(trim($objResult['SSOPERSONCLASS'])):'';
									$data[$i]["cn"]=isset($objResult['CN'])?addslashes(trim($objResult['CN'])):'';
									$data[$i]["PER_EFFECTIVEDATE"]=isset($objResult['PER_EFFECTIVEDATE'])?addslashes(trim($objResult['PER_EFFECTIVEDATE'])):'';
									$data[$i]["PM_NAME"]=isset($objResult['PM_NAME'])?addslashes(trim($objResult['PM_NAME'])):'';
									$data[$i]["PICPATH"]=isset($objResult['PICPATH'])?addslashes(trim($objResult['PICPATH'])):'';
									$data[$i]["UPDATE_DATE"]=isset($objResult['UPDATE_DATE'])?addslashes(trim($objResult['UPDATE_DATE'])):'';
									$data[$i]["PIC_UPDATE"]=isset($objResult['PIC_UPDATE'])?addslashes(trim($objResult['PIC_UPDATE'])):'';
									$data[$i]["PER_GENDER"]=isset($objResult['GENDER'])?addslashes(trim($objResult['GENDER'])):''; 
									$data[$i]["PER_DOCDATE"]=isset($objResult['PER_DOCDATE'])?addslashes(trim($objResult['PER_DOCDATE'])):'';
									if($data[$i]["PER_DOCDATE"]==" ")
										{
											$data[$i]["PER_DOCDATE"]=null;
										}
										$i++;
								}
			
				
				$strSQL = 'SELECT * FROM DPISEMP1.V_UM_DPISEMP1 ';
				$objParse = oci_parse($objConnect, $strSQL);
			 //   oci_bind_by_name($objParse, ':test', $count);
			//	 oci_bind_by_name($objParse, ':test1', $aaa);
				oci_execute($objParse,OCI_DEFAULT);
				while($objResult = oci_fetch_array($objParse))
								{
									
									$data[$i]["PER_ID"]=isset($objResult['PER_ID'])?addslashes(trim($objResult['PER_ID'])):'';
									$data[$i]["ssofirstname"]=isset($objResult['SSOFIRSTNAME'])?addslashes(trim($objResult['SSOFIRSTNAME'])):'';
									$data[$i]["ssopersoncitizenid"]=isset($objResult['SSOPERSONCITIZENID'])?addslashes(trim($objResult['SSOPERSONCITIZENID'])):'';
									$data[$i]["givenName"]=isset($objResult['GIVENNAME'])?addslashes(trim($objResult['GIVENNAME'])):'';
									$data[$i]["givenName"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["givenName"]);
									$data[$i]["ssosurname"]=isset($objResult['SSOSURNAME'])?addslashes(trim($objResult['SSOSURNAME'])):'';
								//	$data[$i]["maildrop"]=isset($objResult['MAILDROP'])?addslashes(trim($objResult['MAILDROP'])):'';
									$data[$i]["ssopersonempdate"]=isset($objResult['SSOPERSONEMPDATE'])?addslashes(trim($objResult['SSOPERSONEMPDATE'])):'';
									if($data[$i]["ssopersonempdate"]=="-")
									{
										$data[$i]["ssopersonempdate"]="";
									}
									$data[$i]["title"]=isset($objResult['TITLE'])?addslashes(trim($objResult['TITLE'])):'';
									$data[$i]["initials"]=isset($objResult['INITIALS'])?addslashes(trim($objResult['INITIALS'])):'';
									$data[$i]["employeeType"]=isset($objResult['EMPLOYEETYPE'])?addslashes(trim($objResult['EMPLOYEETYPE'])):'';
								//	$data[$i]["mail"]=isset($objResult['MAIL'])?addslashes(trim($objResult['MAIL'])):'';
									$data[$i]["workingdeptdescription"]=isset($objResult['WORKINGDEPTDESCRIPTION'])?addslashes(trim($objResult['WORKINGDEPTDESCRIPTION'])):'';
									$data[$i]["sn"]=isset($objResult['SN'])?addslashes(trim($objResult['SN'])):'';
									$data[$i]["sn"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["sn"]);
									$data[$i]["ssopersonposition"]=isset($objResult['SSOPERSONPOSITION'])?addslashes(trim($objResult['SSOPERSONPOSITION'])):'';
									$data[$i]["ssopersonbirthdate"]=isset($objResult['SSOPERSONBIRTHDATE'])?addslashes(trim($objResult['SSOPERSONBIRTHDATE'])):'';
									$data[$i]["accountActive"]=isset($objResult['ACCOUNTACTIVE'])?addslashes(trim($objResult['ACCOUNTACTIVE'])):'';
									$data[$i]["ssopersonclass"]=isset($objResult['SSOPERSONCLASS'])?addslashes(trim($objResult['SSOPERSONCLASS'])):'';
									$data[$i]["cn"]=isset($objResult['CN'])?addslashes(trim($objResult['CN'])):'';
									$data[$i]["PER_EFFECTIVEDATE"]=isset($objResult['PER_EFFECTIVEDATE'])?addslashes(trim($objResult['PER_EFFECTIVEDATE'])):'';
									$data[$i]["PM_NAME"]=isset($objResult['PM_NAME'])?addslashes(trim($objResult['PM_NAME'])):'';
									$data[$i]["PICPATH"]=isset($objResult['PICPATH'])?addslashes(trim($objResult['PICPATH'])):'';
									$data[$i]["UPDATE_DATE"]=isset($objResult['UPDATE_DATE'])?addslashes(trim($objResult['UPDATE_DATE'])):'';
									$data[$i]["PIC_UPDATE"]=isset($objResult['PIC_UPDATE'])?addslashes(trim($objResult['PIC_UPDATE'])):'';
									$data[$i]["PER_GENDER"]=isset($objResult['GENDER'])?addslashes(trim($objResult['GENDER'])):''; 
									$data[$i]["PER_DOCDATE"]=isset($objResult['PER_DOCDATE'])?addslashes(trim($objResult['PER_DOCDATE'])):'';
									if($data[$i]["PER_DOCDATE"]==" ")
										{
											$data[$i]["PER_DOCDATE"]=null;
										}
										$i++;
								}
							
								oci_close($objConnect);
							//	var_dump($data);
							//	exit;
								return $data;
								
}
public function datadpisprocess($count)
{
	$sql ="SELECT * from db_dpis  order by PER_ID asc limit $count,1500";
	//$command->bindValue(":test",$count);
	
	$row =Yii::app()->db->createCommand($sql)->queryAll();
	return $row;
}
public function datadpisprocessday()
{
	$sql ="SELECT * from db_dpis where DATE_FORMAT(update_dpis, '%Y-%m-%d') = DATE_FORMAT(DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY), '%Y-%m-%d') order by PER_ID asc ";
	//$command->bindValue(":test",$count);
	
	$row =Yii::app()->db->createCommand($sql)->queryAll();
	return $row;
}
public function datadpisprocesscount()
{
	$sql ="SELECT * from db_dpis ";
//	$command->bindValue(":test",$count);

	$row =Yii::app()->db->createCommand($sql)->queryAll();
	return $row;
}
public function dataprocessldap()
{
	$sql ="SELECT a.CitizenID,a.FirstNameTH,a.LastNameTH,a.FirstNameEN,a.
	,a.LastNameEN,a.BirthDate,a.Email,a.DeptID,b.DeptNameTH,c.EmpTypeNameTH,d.PositNameTH,e.PrefixNameTH,e.PrefixNameEN,f.PositLevelNameTH from tran_employee a ";
	$sql.="inner join mas_department b on a.DeptID=b.DeptID  inner join mas_employeetype c on c.EmpTypeID=a.EmplTypeID inner ";
	$sql.="join mas_position d on d.PositID=a.PositID inner join mas_prefix e on e.PrefixID=a.PrefixID inner join mas_position_level f on f.PositLevelID=a.PositLevelID where StatusComplete=1 limit 1";
	$row =Yii::app()->db->createCommand($sql)->queryAll();
	
	return $row;
}
public function dataldap($uid)
{
	$host=Yii::app()->params['prg_ctrl']['ipservice']['ipzonedev']; 
	$data_array = array("filter" => array("exp" => $uid),);	
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
		$data_array = array("filter" => array("exp" => $personcitizenid),);	
		$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/dpisinfosearch.php', json_encode($data_array));
		$data1 = json_decode($make_call, true);
		
		return 	$data1;	
		
}
public function dataldaptest($uid)
{
			$host=Yii::app()->params['prg_ctrl']['ipservice']['ipzonedev']; 
			$data_array = array("filter" => array("exp" => $uid),);	
			
			$make_call = lkup_oracledpis::CallAPI('POST',$host.'/umapi/ldapinfosearch.php', json_encode($data_array));
			$data = json_decode($make_call, true);
			
			foreach($data as $key => $val)
					{
						if($key=='code'){
						$code=$val["code"];
							}	//echo "$key,";
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
					
			$sql="select * from db_dpis where SSOPERSONCITIZENID='".$personcitizenid."'";	
			$row =Yii::app()->db->createCommand($sql)->queryAll();	
			return $row;
}
public function dataactinghis()
{
				$this->username =Yii::app()->params['prg_ctrl']['dboracle']['username'];		
				$this->password =Yii::app()->params['prg_ctrl']['dboracle']['password'];
				$this->connectdatabase=Yii::app()->params['prg_ctrl']['dboracle']['connectdatabase'];
			
				$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
				
				
			$i=0;
				$strSQL = 'SELECT * FROM DPIS.V_UM_DPIS_ACTINGHIS ';//where ACTH_ID=15'; //OFFSET :test ROWS FETCH NEXT 1000 ROWS ONLY';
				$objParse = oci_parse($objConnect, $strSQL);
			//    oci_bind_by_name($objParse, ':test', $count);
			//	oci_execute($objParse,OCI_DEFAULT);
			//	$objParse = oci_parse($objConnect, $strSQL);
			//    oci_bind_by_name($objParse, ':test', $count);
			
			
			
				oci_execute($objParse,OCI_DEFAULT);
				while($objResult = oci_fetch_array($objParse))
								{
									
									
									$data[$i]["ACTH_ID"]=isset($objResult['ACTH_ID'])?addslashes(trim($objResult['ACTH_ID'])):'';
									$data[$i]["PER_ID"]=isset($objResult['PER_ID'])?addslashes(trim($objResult['PER_ID'])):'';
									$data[$i]["PER_CARDNO"]=isset($objResult['PER_CARDNO'])?addslashes(trim($objResult['PER_CARDNO'])):'';
									$data[$i]["ACTH_EFFECTIVEDATE"]=isset($objResult['ACTH_EFFECTIVEDATE'])?addslashes(trim($objResult['ACTH_EFFECTIVEDATE'])):'';
								//	$data[$i]["givenName"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["givenName"]);
									$data[$i]["MOV_CODE"]=isset($objResult['MOV_CODE'])?addslashes(trim($objResult['MOV_CODE'])):'';
									$data[$i]["ACTH_ENDDATE"]=isset($objResult['ACTH_ENDDATE'])?addslashes(trim($objResult['ACTH_ENDDATE'])):'';
									$data[$i]["ACTH_DOCNO"]=isset($objResult['ACTH_DOCNO'])?addslashes(trim($objResult['ACTH_DOCNO'])):'';
									$data[$i]["ACTH_DOCDATE"]=isset($objResult['ACTH_DOCDATE'])?addslashes(trim($objResult['ACTH_DOCDATE'])):'';
									$data[$i]["ACTH_POS_NO"]=isset($objResult['ACTH_POS_NO'])?addslashes(trim($objResult['ACTH_POS_NO'])):'';
									$data[$i]["PM_CODE"]=isset($objResult['PM_CODE'])?addslashes(trim($objResult['PM_CODE'])):'';
									$data[$i]["ACTH_PM_NAME"]=isset($objResult['ACTH_PM_NAME'])?addslashes(trim($objResult['ACTH_PM_NAME'])):'';
									$data[$i]["LEVEL_NO"]=isset($objResult['LEVEL_NO'])?addslashes(trim($objResult['LEVEL_NO'])):'';
									$data[$i]["PL_CODE"]=isset($objResult['PL_CODE'])?addslashes(trim($objResult['PL_CODE'])):'';
									$data[$i]["ACTH_PL_NAME"]=isset($objResult['ACTH_PL_NAME'])?addslashes(trim($objResult['ACTH_PL_NAME'])):'';
									$data[$i]["ACTH_ORG1"]=isset($objResult['ACTH_ORG1'])?addslashes(trim($objResult['ACTH_ORG1'])):'';
									$data[$i]["ACTH_ORG2"]=isset($objResult['ACTH_ORG2'])?addslashes(trim($objResult['ACTH_ORG2'])):'';
									$data[$i]["ACTH_ORG3"]=isset($objResult['ACTH_ORG3'])?addslashes(trim($objResult['ACTH_ORG3'])):'';
									$data[$i]["ACTH_ORG4"]=isset($objResult['ACTH_ORG4'])?addslashes(trim($objResult['ACTH_ORG4'])):'';
									$data[$i]["ACTH_ORG5"]=isset($objResult['ACTH_ORG5'])?addslashes(trim($objResult['ACTH_ORG5'])):'';
									$data[$i]["ACTH_POS_NO_ASSIGN"]=isset($objResult['ACTH_POS_NO_ASSIGN'])?addslashes(trim($objResult['ACTH_POS_NO_ASSIGN'])):'';
									$data[$i]["PM_CODE_ASSIGN"]=isset($objResult['PM_CODE_ASSIGN'])?addslashes(trim($objResult['PM_CODE_ASSIGN'])):'';
									$data[$i]["ACTH_PM_NAME_ASSIGN"]=isset($objResult['ACTH_PM_NAME_ASSIGN'])?addslashes(trim($objResult['ACTH_PM_NAME_ASSIGN'])):'';
									$data[$i]["LEVEL_NO_ASSIGN"]=isset($objResult['LEVEL_NO_ASSIGN'])?addslashes(trim($objResult['LEVEL_NO_ASSIGN'])):''; 
									$data[$i]["PL_CODE_ASSIGN"]=isset($objResult['PL_CODE_ASSIGN'])?addslashes(trim($objResult['PL_CODE_ASSIGN'])):'';
									$data[$i]["ACTH_PL_NAME_ASSIGN"]=isset($objResult['ACTH_PL_NAME_ASSIGN'])?addslashes(trim($objResult['ACTH_PL_NAME_ASSIGN'])):'';
									$data[$i]["ACTH_ORG1_ASSIGN"]=isset($objResult['ACTH_ORG1_ASSIGN'])?addslashes(trim($objResult['ACTH_ORG1_ASSIGN'])):'';
									$data[$i]["ACTH_ORG2_ASSIGN"]=isset($objResult['ACTH_ORG2_ASSIGN'])?addslashes(trim($objResult['ACTH_ORG2_ASSIGN'])):'';
									$data[$i]["ACTH_ORG3_ASSIGN"]=isset($objResult['ACTH_ORG3_ASSIGN'])?addslashes(trim($objResult['ACTH_ORG3_ASSIGN'])):'';
									$data[$i]["ACTH_ORG4_ASSIGN"]=isset($objResult['ACTH_ORG4_ASSIGN'])?addslashes(trim($objResult['ACTH_ORG4_ASSIGN'])):'';
									$data[$i]["ACTH_ORG5_ASSIGN"]=isset($objResult['ACTH_ORG5_ASSIGN'])?addslashes(trim($objResult['ACTH_ORG5_ASSIGN'])):'';
									$data[$i]["ACTH_ASSIGN"]=isset($objResult['ACTH_ASSIGN'])?addslashes(trim($objResult['ACTH_ASSIGN'])):'';
									$data[$i]["ACTH_REMARK"]=isset($objResult['ACTH_REMARK'])?addslashes(trim($objResult['ACTH_REMARK'])):'';
									$data[$i]["ACTH_SEQ_NO"]=isset($objResult['ACTH_SEQ_NO'])?addslashes(trim($objResult['ACTH_SEQ_NO'])):'';
									$data[$i]["UPDATE_USER"]=isset($objResult['UPDATE_USER'])?addslashes(trim($objResult['UPDATE_USER'])):'';
									$data[$i]["UPDATE_DATE"]=isset($objResult['UPDATE_DATE'])?addslashes(trim($objResult['UPDATE_DATE'])):'';
									$data[$i]["ACTH_POS_NO_NAME"]=isset($objResult['ACTH_POS_NO_NAME'])?addslashes(trim($objResult['ACTH_POS_NO_NAME'])):'';
									$data[$i]["ACTH_POS_NO_NAME_ASSIGN"]=isset($objResult['ACTH_POS_NO_NAME_ASSIGN'])?addslashes(trim($objResult['ACTH_POS_NO_NAME_ASSIGN'])):'';
									$data[$i]["TYPE_STATUS"]=1;	
										$i++;
								}
								oci_close($objConnect);
								return $data;
}
public function dataemactinghis()
{
				$this->username =Yii::app()->params['prg_ctrl']['dboracle']['username'];		
				$this->password =Yii::app()->params['prg_ctrl']['dboracle']['password'];
				$this->connectdatabase=Yii::app()->params['prg_ctrl']['dboracle']['connectdatabase'];
			
				$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
				
				
			$i=0;
				$strSQL = 'SELECT * FROM DPISEMP1.V_UM_DPISEMP1_ACTINGHIS';
				$objParse = oci_parse($objConnect, $strSQL);
			//    oci_bind_by_name($objParse, ':test', $count);
			//	oci_execute($objParse,OCI_DEFAULT);
			//	$objParse = oci_parse($objConnect, $strSQL);
			//    oci_bind_by_name($objParse, ':test', $count);
				oci_execute($objParse,OCI_DEFAULT);
				while($objResult = oci_fetch_array($objParse))
								{
									
									$data[$i]["ACTH_ID"]=isset($objResult['ACTH_ID'])?addslashes(trim($objResult['ACTH_ID'])):'';
									$data[$i]["PER_ID"]=isset($objResult['PER_ID'])?addslashes(trim($objResult['PER_ID'])):'';
									$data[$i]["PER_CARDNO"]=isset($objResult['PER_CARDNO'])?addslashes(trim($objResult['PER_CARDNO'])):'';
									$data[$i]["ACTH_EFFECTIVEDATE"]=isset($objResult['ACTH_EFFECTIVEDATE'])?addslashes(trim($objResult['ACTH_EFFECTIVEDATE'])):'';
								//	$data[$i]["givenName"] = preg_replace("/[^a-z\d]/i", '',$data[$i]["givenName"]);
									$data[$i]["MOV_CODE"]=isset($objResult['MOV_CODE'])?addslashes(trim($objResult['MOV_CODE'])):'';
									$data[$i]["ACTH_ENDDATE"]=isset($objResult['ACTH_ENDDATE'])?addslashes(trim($objResult['ACTH_ENDDATE'])):'';
									$data[$i]["ACTH_DOCNO"]=isset($objResult['ACTH_DOCNO'])?addslashes(trim($objResult['ACTH_DOCNO'])):'';
									$data[$i]["ACTH_DOCDATE"]=isset($objResult['ACTH_DOCDATE'])?addslashes(trim($objResult['ACTH_DOCDATE'])):'';
									$data[$i]["ACTH_POS_NO"]=isset($objResult['ACTH_POS_NO'])?addslashes(trim($objResult['ACTH_POS_NO'])):'';
									$data[$i]["PM_CODE"]=isset($objResult['PM_CODE'])?addslashes(trim($objResult['PM_CODE'])):'';
									$data[$i]["ACTH_PM_NAME"]=isset($objResult['ACTH_PM_NAME'])?addslashes(trim($objResult['ACTH_PM_NAME'])):'';
									$data[$i]["LEVEL_NO"]=isset($objResult['LEVEL_NO'])?addslashes(trim($objResult['LEVEL_NO'])):'';
									$data[$i]["PL_CODE"]=isset($objResult['PL_CODE'])?addslashes(trim($objResult['PL_CODE'])):'';
									$data[$i]["ACTH_PL_NAME"]=isset($objResult['ACTH_PL_NAME'])?addslashes(trim($objResult['ACTH_PL_NAME'])):'';
									$data[$i]["ACTH_ORG1"]=isset($objResult['ACTH_ORG1'])?addslashes(trim($objResult['ACTH_ORG1'])):'';
									$data[$i]["ACTH_ORG2"]=isset($objResult['ACTH_ORG2'])?addslashes(trim($objResult['ACTH_ORG2'])):'';
									$data[$i]["ACTH_ORG3"]=isset($objResult['ACTH_ORG3'])?addslashes(trim($objResult['ACTH_ORG3'])):'';
									$data[$i]["ACTH_ORG4"]=isset($objResult['ACTH_ORG4'])?addslashes(trim($objResult['ACTH_ORG4'])):'';
									$data[$i]["ACTH_ORG5"]=isset($objResult['ACTH_ORG5'])?addslashes(trim($objResult['ACTH_ORG5'])):'';
									$data[$i]["ACTH_POS_NO_ASSIGN"]=isset($objResult['ACTH_POS_NO_ASSIGN'])?addslashes(trim($objResult['ACTH_POS_NO_ASSIGN'])):'';
									$data[$i]["PM_CODE_ASSIGN"]=isset($objResult['PM_CODE_ASSIGN'])?addslashes(trim($objResult['PM_CODE_ASSIGN'])):'';
									$data[$i]["ACTH_PM_NAME_ASSIGN"]=isset($objResult['ACTH_PM_NAME_ASSIGN'])?addslashes(trim($objResult['ACTH_PM_NAME_ASSIGN'])):'';
									$data[$i]["LEVEL_NO_ASSIGN"]=isset($objResult['LEVEL_NO_ASSIGN'])?addslashes(trim($objResult['LEVEL_NO_ASSIGN'])):''; 
									$data[$i]["PL_CODE_ASSIGN"]=isset($objResult['PL_CODE_ASSIGN'])?addslashes(trim($objResult['PL_CODE_ASSIGN'])):'';
									$data[$i]["ACTH_PL_NAME_ASSIGN"]=isset($objResult['ACTH_PL_NAME_ASSIGN'])?addslashes(trim($objResult['ACTH_PL_NAME_ASSIGN'])):'';
									$data[$i]["ACTH_ORG1_ASSIGN"]=isset($objResult['ACTH_ORG1_ASSIGN'])?addslashes(trim($objResult['ACTH_ORG1_ASSIGN'])):'';
									$data[$i]["ACTH_ORG2_ASSIGN"]=isset($objResult['ACTH_ORG2_ASSIGN'])?addslashes(trim($objResult['ACTH_ORG2_ASSIGN'])):'';
									$data[$i]["ACTH_ORG3_ASSIGN"]=isset($objResult['ACTH_ORG3_ASSIGN'])?addslashes(trim($objResult['ACTH_ORG3_ASSIGN'])):'';
									$data[$i]["ACTH_ORG4_ASSIGN"]=isset($objResult['ACTH_ORG4_ASSIGN'])?addslashes(trim($objResult['ACTH_ORG4_ASSIGN'])):'';
									$data[$i]["ACTH_ORG5_ASSIGN"]=isset($objResult['ACTH_ORG5_ASSIGN'])?addslashes(trim($objResult['ACTH_ORG5_ASSIGN'])):'';
									$data[$i]["ACTH_ASSIGN"]=isset($objResult['ACTH_ASSIGN'])?addslashes(trim($objResult['ACTH_ASSIGN'])):'';
									$data[$i]["ACTH_REMARK"]=isset($objResult['ACTH_REMARK'])?addslashes(trim($objResult['ACTH_REMARK'])):'';
									$data[$i]["ACTH_SEQ_NO"]=isset($objResult['ACTH_SEQ_NO'])?addslashes(trim($objResult['ACTH_SEQ_NO'])):'';
									$data[$i]["UPDATE_USER"]=isset($objResult['UPDATE_USER'])?addslashes(trim($objResult['UPDATE_USER'])):'';
									$data[$i]["UPDATE_DATE"]=isset($objResult['UPDATE_DATE'])?addslashes(trim($objResult['UPDATE_DATE'])):'';
									$data[$i]["ACTH_POS_NO_NAME"]=isset($objResult['ACTH_POS_NO_NAME'])?addslashes(trim($objResult['ACTH_POS_NO_NAME'])):'';
									$data[$i]["ACTH_POS_NO_NAME_ASSIGN"]=isset($objResult['ACTH_POS_NO_NAME_ASSIGN'])?addslashes(trim($objResult['ACTH_POS_NO_NAME_ASSIGN'])):'';
									$data[$i]["TYPE_STATUS"]=2;		
										$i++;
								}
								oci_close($objConnect);
								return $data;
}
public function countdataacting()
{
	$this->username =Yii::app()->params['prg_ctrl']['dboracle']['username'];		
	$this->password =Yii::app()->params['prg_ctrl']['dboracle']['password'];
	$this->connectdatabase=Yii::app()->params['prg_ctrl']['dboracle']['connectdatabase'];
			
	$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
	
	$strSQL = 'SELECT count(*) from DPIS.V_UM_DPIS_ACTINGHIS';
	$objParse = oci_parse($objConnect, $strSQL);
				//oci_execute($objParse1,OCI_DEFAULT);
				oci_execute($objParse,OCI_DEFAULT);
				$objResult = oci_fetch_array($objParse);
				
				//var_dump($objResult);
				//exit;
				oci_close($objConnect);
				return $objResult;
}
public function countdataemacting()
{
	$this->username =Yii::app()->params['prg_ctrl']['dboracle']['username'];		
	$this->password =Yii::app()->params['prg_ctrl']['dboracle']['password'];
	$this->connectdatabase=Yii::app()->params['prg_ctrl']['dboracle']['connectdatabase'];
			
	$objConnect = oci_connect($this->username,$this->password,$this->connectdatabase,"AL32UTF8");
	
	$strSQL = 'SELECT count(*) from DPISEMP1.V_UM_DPISEMP1_ACTINGHIS';
	$objParse = oci_parse($objConnect, $strSQL);
				//oci_execute($objParse1,OCI_DEFAULT);
				oci_execute($objParse,OCI_DEFAULT);
				$objResult = oci_fetch_array($objParse);
				
				//var_dump($objResult);
				//exit;
				oci_close($objConnect);
				return $objResult;
}
}
