<?php

class LogoutController extends Controller {
	
	// function init() {
	// 	parent::chkLogin(); 
	// }
	
	public function actionIndex() {
		$idtoken =Yii::app()->session['idtoken'];
		
	//	CommonAction::AddLoginLog("Logout","");
	//	Yii::app()->user->logout();
	
		if($idtoken){
			foreach($idtoken as  $key=>$value){
				if($key==='payload'){
					$idtoken2 = $value[0] . "." . $value[1] . "." . $value[2];
				}
			}
			Yii::app()->user->logout();
			$urllogout = Yii::app()->params['prg_ctrl']['url']['idplogout'] . $idtoken2 . Yii::app()->params['prg_ctrl']['url']['idplogoutparam'];
			$this->redirect($urllogout);
		}else{
			Yii::app()->user->logout();
			
			$this->redirect(Yii::app()->createUrl(''));
		}
		
	}
	
	public function actionError() {
		if($error=Yii::app()->errorHandler->error) {
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}