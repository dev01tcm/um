<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		// $users=array(
		// 	// username => password
		// 	'demo'=>'demo',
		// 	'admin'=>'admin',
		// );
		// if(!isset($users[$this->username]))
		// 	$this->errorCode=self::ERROR_USERNAME_INVALID;
		// else if($users[$this->username]!==$this->password)
		// 	$this->errorCode=self::ERROR_PASSWORD_INVALID;
		// else
		// 	$this->errorCode=self::ERROR_NONE;
		// return !$this->errorCode;
		//*****************************************************************************************
	
		$user = UmEmployee::model()->findByAttributes(array('em_username'=>$this->username));
			
		if($user===null){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		//else if($user->password!==$this->password) //else if($user->password!==md5($this->password))
		}//$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
		//	$this->setState('em_id', $user->em_id);
			Yii::app()->session['em_id'] = $user->em_id;
			
		//	$this->setState('em_name_th', $user->em_name_th);
			Yii::app()->session['em_name_th'] = $user->em_name_th;
			
		//	$this->setState('em_surname_th', $user->em_surname_th);
			Yii::app()->session['em_surname_th'] =  $user->em_surname_th;
			
		//	$this->setState('em_email', $user->em_email);
			Yii::app()->session['em_email'] =  $user->em_email;
			
		//	$this->setState('em_username', $user->em_username);
			Yii::app()->session['em_username'] =  $user->em_username;
			
		//	$this->setState('mas_position_le_id', $user->mas_position_le_id);
			Yii::app()->session['mas_position_le_id'] =  $user->mas_position_le_id;
			
		//	$this->setState('um_position_id', $user->um_position_id); 
			Yii::app()->session['um_position_id'] =  $user->um_position_id;

		//	$this->setState('mas_department_id', $user->mas_department_id);
			Yii::app()->session['mas_department_id'] =  $user->mas_department_id;
			Yii::app()->session['um_user_group_id'] =  $user->um_user_group_id;
			Yii::app()->session['um_assign_id'] =  $user->um_assign_id;
			

			
			$this->errorCode=self::ERROR_NONE;	
		}
		return !$this->errorCode;
		
		//********************************************************************************************
	}

	
}