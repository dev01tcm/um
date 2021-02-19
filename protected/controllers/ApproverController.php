 <?php

class ApproverController extends Controller
{
	public function actionIndex()
	{
		$this->renderPartial('index');
	}


	//loadrequesttap
	//loadrequesttap
	public function actionLoadrequesttap(){
		$this->renderPartial('request/index');
	}

	//loadtrantap
	public function actionLoadtrantap(){
		$this->renderPartial('transfer/index');
	}
	
	public function actionLoadrequest(){
		$status = $_POST['status'];
		$this->renderPartial('request/request',array('status'=>$status));
	}

	//loademptap
	public function actionLoademptap(){
		$this->renderPartial('employee/index');
	}

	//loadmodalrequested
	public function actionLoadmodalrequested(){
		$this->renderPartial('modal/modal-requested');
	}

	//loadmodaltran
	public function actionLoadmodaltran(){
		$this->renderPartial('modal/modal-tran');
	}

	//loadmodalemptran
	public function actionLoadmodalemptran(){
		$this->renderPartial('modal/modal-emp-request');
	}

	//loadmodalemptranre
	public function actionLoadmodalemptranre(){
		$this->renderPartial('modal/modal-emp-tran');
	}

	//loadtableemp
	public function actionLoadtableemp(){
		$this->renderPartial('employee/table-emp');
	}

	//loadtabletran
	public function actionLoadtabletran(){
		$this->renderPartial('transfer/table-tran');
	}

	//loadmodalapp
	public function actionLoadmodalapp(){
		$this->renderPartial('modal/modal-app');
	}


	public function CallDataMove($name){

        $qusg2 = new CDbCriteria( array(
	        'condition' => "mo_id = :mo_id and  mo_status = :mo_status LIMIT 1",         
            'params'    => array(':mo_id' => $name, ':mo_status' => '1')   
	    ));
	    $modelusg2 = UmMove::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	        $mo_id = $rowss->mo_id; 
	        $mo_content = $rowss->mo_content; 
	    }

	    if(isset($mo_content)){
	    	return $mo_content;
	    }else{
	    	return 'ปกติ';
	    }
	    
    }

    //CallDataApp
    public function CallDataApp($name){

    	$appss=array();

        $qusg2 = new CDbCriteria( array(
	        'condition' => "user_id = :user_id and status = :status ",         
            'params'    => array(':user_id' => $name, ':status' => '1')   
	    ));
	    $modelusg2 = MasAppEmp::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	        $mae_id = $rowss->mae_id; 
	        $app_id = $rowss->app_id; 

				array_push($appss,$app_id);
	    }

	    if(!empty($appss)){
	    	return $appss;
	    }else{
	    	return '';
	    } 
	    
    }

    //CallDataAppEmp
    public function CallDataAppEmp($name,$app){


        $qusg2 = new CDbCriteria( array(
	        'condition' => "user_id = :user_id and status = :status and app_id = :app_id ",         
            'params'    => array(':user_id' => $name, ':status' => '1',':app_id' => $app)   
	    ));
	    $modelusg2 = MasAppEmp::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	        $mae_id = $rowss->mae_id; 
	        $app_id = $rowss->app_id; 

	    }

	    if(isset($app_id)){
	    	return 'true';
	    }else{
	    	return 'false';
	    } 
	    
    }

    //CallDataAppShotname
    public function CallDataAppShotname($name){

        $qusg2 = new CDbCriteria( array(
	        'condition' => "app_id = :app_id and app_status = :app_status ",         
            'params'    => array(':app_id' => $name, ':app_status' => '1')   
	    ));
	    $modelusg2 = MasApp::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	        $app_name_th = $rowss->app_name_th;
	        $app_shortname = $rowss->app_shortname; 
	    }

	    if(isset($app_shortname)){
	    	return $app_shortname;
	    }else{
	    	return '';
	    }
	    
    }

     //----------------------------------------------------------------------------------SEND API

     //loadsubmittran
    public function actionLoadsubmittran(){

    	$packdata = $_POST['packdata'];
/*
    	$person  = [
	    	"PER_ID" => $packdata[0],
			"ssofirstname" => $packdata[1],
			"ssopersoncitizenid" =>$$packdata[12],
			"givenName" => $packdata[7],
			"ssosurname" => $packdata[2],
			"ssopersonempdate" => $packdata[3],
			"title" => $packdata[4],
			"initials" => $packdata[5],
			"employeeType" => $packdata[6],
			"workingdeptdescription" => $packdata[9],
			"sn" => $packdata[8],
			"ssopersonposition" => $packdata[11],
			"ssopersonbirthdate" => $packdata[14],
			"accountActive" => $packdata[13],
			"ssopersonclass" => $packdata[10],
			"cn" => $packdata[7].' '.$packdata[8],
			"PER_EFFECTIVEDATE" => "",
			"PM_NAME" =>"",
			"PICPATH" =>"../attachment/pic_personal/",
			"PIC_UPDATE" => date("Y-m-d H:i:s"),
			"PER_GENDER" => $packdata[15],
			"PER_DOCDATE" => ""

		];
		*/
		
		$data_array = array(array(
			"PER_ID" => $packdata[0],
			"ssofirstname" => $packdata[1],
			"ssopersoncitizenid" =>$packdata[12],
			"givenName" => $packdata[7],
			"ssosurname" => $packdata[2],
			"ssopersonempdate" => $packdata[3],
			"title" => $packdata[4],
			"initials" => $packdata[5],
			"employeeType" => $packdata[6],
			"workingdeptdescription" => $packdata[9],
			"sn" => $packdata[8],
			"ssopersonposition" => $packdata[11],
			"ssopersonbirthdate" => $packdata[14],
			"accountActive" => $packdata[13],
			"ssopersonclass" => $packdata[10],
			"cn" => $packdata[7].' '.$packdata[8],
			"PER_EFFECTIVEDATE" => "",
			"PM_NAME" =>"",
			"PICPATH" =>"../attachment/pic_personal/",
			"PIC_UPDATE" => date("Y-m-d H:i:s"),
			"PER_GENDER" => $packdata[15],
			"PER_DOCDATE" => ""
		));	

		// echo json_encode($person);

    // 	$data_array = array(

    //             "PER_ID" => $packdata[0],
				// "ssofirstname" => $packdata[1],
				// "ssopersoncitizenid" =>$$packdata[12],
				// "givenName" => $packdata[7],
				// "ssosurname" => $packdata[2],
				// "ssopersonempdate" => $packdata[3],
				// "title" => $packdata[4],
				// "initials" => $packdata[5],
				// "employeeType" => $packdata[6],
				// "workingdeptdescription" => $packdata[9],
				// "sn" => $packdata[8],
				// "ssopersonposition" => $packdata[11],
				// "ssopersonbirthdate" => $packdata[14],
				// "accountActive" => $packdata[13],
				// "ssopersonclass" => $packdata[10],
				// "cn" => $packdata[7].' '.$packdata[8],
				// "PER_EFFECTIVEDATE" => "",
				// "PM_NAME" =>"",
				// "PICPATH" =>"../attachment/pic_personal/",
				// "PIC_UPDATE" => date("Y-m-d H:i:s"),
				// "PER_GENDER" => $packdata[15],
				// "PER_DOCDATE" => ""
    //         );


    	$host=Yii::app()->params['prg_ctrl']['ipservice']['ipzonedev'];
    	$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/searchemployeelocalhost.php', json_encode($data_array));

		$data = json_decode($make_call, true);

		var_dump ($data);
		exit;


    } 


	//----------------------------------------------------------------------------------INSERT

	//insertassign
    public function actionInsertassign(){


        $user_id = $_POST['packdata']['chkid'];
		$assign_status = $_POST['packdata']['valdata'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$assign_des = Yii::app()->session['em_id'].'แทนสิทธิ์ให้'.$_POST['packdata']['chkid'];
		$user_level = '5';

		$MasUserGroup = new UmAssign();
		$MasUserGroup->as_description = $assign_des;
		$MasUserGroup->as_status = $assign_status;
		$MasUserGroup->as_level = $user_level;
		$MasUserGroup->createby = $createby;
		$MasUserGroup->updateby = $updateby;

		if($MasUserGroup->save()){
			$assignid = $MasUserGroup->as_id;

			$MasApp = UmEmployee::model()->findByPk(intval($user_id));
			$MasApp->um_assign_id = $assignid;
			$MasApp->updateby = $updateby;
			if($MasApp->save()){
				echo "success";
			}else{
				echo "error";
			}
			
			
		}else{
			echo "error";
		}
	}


	public function actionInsertgrouproleemp($userid,$um_position_id,$mas_position_le_id,$mas_department_id){

		$datas=MasGroupOfRole::getdatagroupofrole($um_position_id,$mas_position_le_id,$mas_department_id);

	    foreach ($datas as $dataitem) { 
	        if(isset($dataitem["gr_name"])){

	        	$grouprole_id = $dataitem["gr_id"];
		        $grouprole_name = $dataitem["gr_name"];
		        $user_id = $userid;
		        $createby = Yii::app()->session['em_username'];
		        $updateby = Yii::app()->session['em_username'];
		        $app_status = '1';

		        $q = new CDbCriteria( array(
		          'condition' => "grouprole_id = :grouprole_id and  user_id = :user_id and  status = :status",         
		          'params'    => array(':grouprole_id' => $grouprole_id, ':user_id' => $userid, ':status' => $app_status)  
		        ));
		        $musg = MasGrouproleEmp::model()->findAll($q);
		        $countusg = count($musg);
		        if($countusg==0){
		          $MasUserGroup = new MasGrouproleEmp();
		          $MasUserGroup->grouprole_id = $grouprole_id;
		          $MasUserGroup->grouprole_name = $grouprole_name;
		          $MasUserGroup->user_id = $userid;
		          $MasUserGroup->status = $status  ;
		          $MasUserGroup->createby = $createby;
		          $MasUserGroup->updateby = $updateby;

		          if($MasUserGroup->save()){
		            echo $dataitem["gr_name"];
		            $user_app = ApproverController::actionInsertappemp($userid,$um_position_id,$mas_position_le_id,$mas_department_id);
		            // return $user_app;
		          }else{
		            echo "error grouproleemp";
		          }
		        }else{//if($countusg==0)
		          	$qusg2 = new CDbCriteria( array(
				        'condition' => "user_id = :user_id and  status = :status",         
				        'params'    => array(':user_id' => $userid, ':status' => $app_status)  
				    ));
				    $modelusg2 = MasGrouproleEmp::model()->findAll($qusg2);
				    foreach ($modelusg2 as $rowss){
				    	$CallApp['mge_id']=$rowss->mge_id; 
				    	$CallApp['grouprole_id']=$rowss->grouprole_id; 
				    	$CallApp['grouprole_name']=$rowss->grouprole_name;
				    	$CallApp['user_id']=$rowss->user_id;
				    }
				    
				    $user_app = ApproverController::actionInsertappemp($userid,$um_position_id,$mas_position_le_id,$mas_department_id);
				    return $CallApp['grouprole_name'];
				    // return $user_app;
		        }
	            
	          
	        }
	    }

		
	}

	public function actionInsertappemp($userid,$um_position_id,$mas_position_le_id,$mas_department_id){

		$datas=MasApp::getdataapp($um_position_id,$mas_position_le_id,$mas_department_id);

		foreach ($datas as $dataitem) { 
			if(isset($dataitem["app_id"])){

				$grouprole_id = $dataitem["app_id"];
		        $grouprole_name = $dataitem["app_name_th"];
		        $user_id = $userid;
		        $createby = Yii::app()->session['em_username'];
		        $updateby = Yii::app()->session['em_username'];
		        $app_status = '1';

		        $q = new CDbCriteria( array(
		          'condition' => "app_id = :app_id and  user_id = :user_id and  status = :status",         
		          'params'    => array(':app_id' => $grouprole_id, ':user_id' => $userid, ':status' => $app_status)  
		        ));
		        $musg = MasAppEmp::model()->findAll($q);
		        $countusg = count($musg);
		        if($countusg==0){
		          $MasUserGroup = new MasAppEmp();
		          $MasUserGroup->app_id = $grouprole_id;
		          $MasUserGroup->app_name = $grouprole_name;
		          $MasUserGroup->user_id = $user_id;
		          $MasUserGroup->status = $app_status;
		          $MasUserGroup->createby = $createby;
		          $MasUserGroup->updateby = $updateby;

		          if($MasUserGroup->save()){
		            
		            $user_app = ApproverController::actionInsertmoduleemp($userid,$um_position_id,$mas_position_le_id,$mas_department_id,$dataitem["app_id"]);
		            // return true;
		            // echo $dataitem["app_id"];
		            // echo $user_app;
		          }else{
		            echo "error appemp";
		          }
		        }else{//if($countusg==0)

		        	$qusg2 = new CDbCriteria( array(
				        'condition' => "user_id = :user_id and  status = :status",         
				        'params'    => array(':user_id' => $userid, ':status' => $app_status)  
				    ));
				    $modelusg2 = MasAppEmp::model()->findAll($qusg2);
				    foreach ($modelusg2 as $rowss){
				    	$CallApp['mae_id']=$rowss->mae_id; 
				    	$CallApp['app_id']=$rowss->app_id; 
				    	$CallApp['app_name']=$rowss->app_name;
				    	$CallApp['user_id']=$rowss->user_id;
				    }
				    
				    $user_app = ApproverController::actionInsertmoduleemp($userid,$um_position_id,$mas_position_le_id,$mas_department_id,$dataitem["app_id"]);
				    // return $CallApp['app_id'];
				    // echo $user_app;
				    // return true;
		        }

			}
		}

	}

	public function actionInsertmoduleemp($userid,$um_position_id,$mas_position_le_id,$mas_department_id,$appid){

		$datas=MasApp::getdatamodule($um_position_id,$mas_position_le_id,$mas_department_id,$appid);
		foreach ($datas as $dataitem) { 
			if(isset($dataitem["app_id"])){

				// echo $dataitem["app_id"].'/';

				$app_id = $dataitem["app_id"];
		        $module_id = $dataitem["ma_id"];
		        $module_code = $dataitem["ma_code"];
		        $module_name = $dataitem["ma_name"];
		        $user_id = $userid;
		        $createby = Yii::app()->session['em_username'];
		        $updateby = Yii::app()->session['em_username'];
		        $app_status = '1';

		        $q = new CDbCriteria( array(
		          'condition' => "app_id = :app_id and  user_id = :user_id and  module_id = :module_id and  status = :status",         
		          'params'    => array(':app_id' => $app_id, ':user_id' => $userid, ':module_id' => $module_id, ':status' => $app_status)  
		        ));
		        $musg = MasModuleEmp::model()->findAll($q);
		        $countusg = count($musg);
		        if($countusg==0){
		          $MasUserGroup = new MasModuleEmp();
		          $MasUserGroup->app_id = $app_id;
		          $MasUserGroup->module_id = $module_id;
		          $MasUserGroup->module_name = $module_name;
		          $MasUserGroup->module_code = $module_code;
		          $MasUserGroup->user_id = $userid;
		          $MasUserGroup->status = $app_status;
		          $MasUserGroup->createby = $createby;
		          $MasUserGroup->updateby = $updateby;

		          if($MasUserGroup->save()){

		          	$user_app = ApproverController::actionInsertroleemp($userid,$um_position_id,$mas_position_le_id,$mas_department_id,$module_id);
		            // echo $module_id;
		            // echo $user_app;
		            
		          }else{
		            echo "error moduleemp";
		          }
		        }else{//if($countusg==0)

		        	$qusg2 = new CDbCriteria( array(
				        'condition' => "user_id = :user_id and  status = :status and app_id = :app_id",         
				        'params'    => array(':user_id' => $userid, ':status' => $app_status, ':app_id' => $app_id)  
				    ));
				    $modelusg2 = MasModuleEmp::model()->findAll($qusg2);
				    foreach ($modelusg2 as $rowss){
				    	$CallApp['mme_id']=$rowss->mme_id; 
				    	$CallApp['app_id']=$rowss->app_id; 
				    	$CallApp['module_id']=$rowss->module_id; 
				    	$CallApp['module_name']=$rowss->module_name;
				    	$CallApp['module_code']=$rowss->module_code;
				    	$CallApp['user_id']=$rowss->user_id;
				    	$CallApp['status']=$rowss->status;
				    }
				    $user_app = ApproverController::actionInsertroleemp($userid,$um_position_id,$mas_position_le_id,$mas_department_id,$CallApp['module_id']);
				    // return $CallApp['module_id'];
				    // echo $user_app;

		        }

			}

		}

	}

	public function actionInsertroleemp($userid,$um_position_id,$mas_position_le_id,$mas_department_id,$moduleid){

		$datas=MasModuleApp::getdatarole($um_position_id,$mas_position_le_id,$mas_department_id,$moduleid);

		foreach ($datas as $dataitem) { 
			if(isset($dataitem["ma_id"])){

		        $module_id = $dataitem["ma_id"];
		        $role_id = $dataitem["ra_id"];
		        $role_code = $dataitem["ra_code"];
		        $role_name = $dataitem["ra_name"];
		        $role_default = $dataitem["ra_default"];
		        $user_id = $userid;
		        $createby = Yii::app()->session['em_username'];
		        $updateby = Yii::app()->session['em_username'];
		        $app_status = '1';

		        $q = new CDbCriteria( array(
		          'condition' => "module_id = :module_id and  user_id = :user_id and  role_id = :role_id and  status = :status",         
		          'params'    => array(':module_id' => $module_id, ':user_id' => $userid, ':role_id' => $role_id, ':status' => $app_status)  
		        ));
		        $musg = MasRoleEmp::model()->findAll($q);
		        $countusg = count($musg);
		        if($countusg==0){
		          $MasUserGroup = new MasRoleEmp();
		          $MasUserGroup->module_id = $module_id;
		          $MasUserGroup->role_id = $role_id;
		          $MasUserGroup->role_name = $role_name;
		          $MasUserGroup->role_code = $role_code;
		          $MasUserGroup->role_default = $role_default;
		          $MasUserGroup->user_id = $userid;
		          $MasUserGroup->status = $app_status;
		          $MasUserGroup->createby = $createby;
		          $MasUserGroup->updateby = $updateby;

		          if($MasUserGroup->save()){
		          	
		          	return true;
		            // echo $module_id.'/';
		            
		          }else{
		            echo "error moduleemp";
		          }
		        }else{//if($countusg==0)

		        	$qusg2 = new CDbCriteria( array(
				        'condition' => "user_id = :user_id and  status = :status and module_id = :module_id",         
				        'params'    => array(':user_id' => $userid, ':status' => $app_status, ':module_id' => $module_id)  
				    ));
				    $modelusg2 = MasRoleEmp::model()->findAll($qusg2);
				    foreach ($modelusg2 as $rowss){
				    	$CallApp['mre_id']=$rowss->mre_id; 
				    	$CallApp['module_id']=$rowss->module_id; 
				    	$CallApp['role_id']=$rowss->role_id; 
				    	$CallApp['role_name']=$rowss->role_name;
				    	$CallApp['role_code']=$rowss->role_code;
				    	$CallApp['role_default']=$rowss->role_default;
				    	$CallApp['user_id']=$rowss->user_id;
				    }
				    // return $CallApp['module_id'];
				    // echo $module_id.'/';
				    return true;
		        }

			}
		}


	}


	//insertusermove
    public function actionInsertusermove(){


        $valdepchange = $_POST['packdata']['valdepchange'];
		$txtcontent = $_POST['packdata']['txtcontent'];
		$user_id = $_POST['packdata']['user_id'];
		$user_citizen = $_POST['packdata']['user_citizen'];
		$user_branch_name = $_POST['packdata']['user_branch_name'];
		$user_oldbr = $_POST['packdata']['user_oldbr'];

 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$apprever_id = Yii::app()->session['em_id'];

		$move_des = Yii::app()->session['em_id'].'ย้ายสาขาให้'.$_POST['packdata']['user_id'];
		$app_status = '1';

		//เริ่มกำหนด transection
		$transaction = Yii::app()->db->beginTransaction();

		try {

			$MasUserGroup = new UmMove();
			$MasUserGroup->mo_content = $txtcontent;
			$MasUserGroup->mo_description = $move_des;
			$MasUserGroup->mo_status = $app_status;
			$MasUserGroup->mo_branch = $valdepchange;
			$MasUserGroup->createby = $createby;
			$MasUserGroup->updateby = $updateby;

			if($MasUserGroup->save()){
				
				$moveid = $MasUserGroup->mo_id;
				$MasApp = UmEmployee::model()->findByPk(intval($user_id));
				$MasApp->em_description = $moveid;
				$MasApp->mas_department_id = $valdepchange;
				$MasApp->updateby = $updateby;
				$MasApp->um_user_module_id = $user_oldbr;
				if($MasApp->save()){

					echo "success";
					$transaction->commit();

					// $anb=DbLdap::model()->findByAttributes(array('UID'=>$user_citizen));
					// $anb->SSOBRANCHCODE = $valdepchange;
					// $anb->WORKINGDEPTDESCRIPTION = $user_branch_name;
					// $anb->updateby = $updateby;
					// if($anb->save()){
					// 	echo "success";
					// 	$transaction->commit();
					// }else{
					// 	echo "error";
					// }
				}else{
					echo "error";
				}

			}else{
				echo "error";
			}

		} catch (\Exception $e) {
			$transaction->rollBack();
			throw $e;
			echo "error";
		}//try
	}



	//-----------------------------------------------------------------------------------UPDATE


	//updateassign
    public function actionUpdateassign(){


        $user_id = $_POST['packdata']['chkid'];
		$assign_status = '0';
		$updateby = Yii::app()->session['em_username'];
		$assign_id = $_POST['packdata']['assignid'];

		$MasUserGroup = UmAssign::model()->findByPk(intval($assign_id));
		$MasUserGroup->as_status = $assign_status;
		$MasUserGroup->updateby = $updateby;
		if($MasUserGroup->save()){
			$MasApp = UmEmployee::model()->findByPk(intval($user_id));
			$MasApp->um_assign_id = $assign_status;
			$MasApp->updateby = $updateby;
			if($MasApp->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{
			echo "error";
		}
	}

	

}