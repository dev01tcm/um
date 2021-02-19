<?php
	
class CustomWebUser extends CWebUser
{
	private $_usermodel;
	
	public function getUser()
	{
		$this->_usermodel=lkup_user::getUserid(Yii::app()->user->id);
		return true;
	}	
	
	public function getInfo($fieldcode)
	{	
		if($this->_usermodel===null) {$this->getUser();}
		$user = $this->_usermodel;
		//var_dump($user);
		//exit;
		if($fieldcode=='FirstNameTH'){ $returnval = trim(stripslashes($user[0]['FirstNameTH'])); }		
		else if($fieldcode=='UserName'){ $returnval = $user[0]['UserName']; }
		else if($fieldcode=='LastNameTH'){ $returnval = $user[0]['LastNameTH']; }
		else if($fieldcode=='FirstNameEN'){ $returnval = $user[0]['FirstNameEN']; }
		else if($fieldcode=='LastNameEN'){ $returnval = $user[0]['LastNameEN']; }
		else if($fieldcode=='UMLevelID'){ $returnval = $user[0]['UMLevelID']; }
		else if($fieldcode=='PositNameTH'){ $returnval = $user[0]['PositNameTH']; }
		else if($fieldcode=='DeptNameTH'){ $returnval = $user[0]['DeptNameTH']; }
		else if($fieldcode=='EmailReserve'){ $returnval = $user[0]['EmailReserve']; }
		else if($fieldcode=='DeptID'){ $returnval = $user[0]['DeptID']; }
		else if($fieldcode=='Email'){ $returnval = $user[0]['Email']; }
		else if($fieldcode=='BirthDate'){ $returnval = $user[0]['BirthDate']; }
		else if($fieldcode=='WorkActiveStatus'){ $returnval = $user[0]['WorkActiveStatus']; }
		else if($fieldcode=='CaptionNote'){ $returnval = $user[0]['CaptionNote']; }
		else if($fieldcode=='CitizenID'){ $returnval = $user[0]['CitizenID']; }
		else if($fieldcode=='ImagePath'){ $returnval = $user[0]['ImagePath']; }
		else if($fieldcode=='MobliePhone'){ $returnval = $user[0]['MobilePhone']; }
		else if($fieldcode=='LevelNameEN'){ $returnval = $user[0]['LevelNameEN']; }
		else if($fieldcode=='PositManageNameTH'){ $returnval = $user[0]['PositManageNameTH']; }
		else if($fieldcode=='EmpTypeNameTH'){ $returnval = $user[0]['EmpTypeNameTH']; }
		else if($fieldcode=='AssignLevelID'){ $returnval = $user[0]['AssignLevelID']; }
		
		return $returnval;
	}

	public function clearInfo()
	{	
		unset($this->_usermodel);
		return true;
	}

}