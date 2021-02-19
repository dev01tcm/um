<?php

class AdminController extends Controller
{/*
	function init() {
	 	parent::chkLogin(); 
	 }
	 */
	public function actionIndex()
	{
		$this->renderPartial('index');
	}

	//loadreport
	public function actionLoadreport(){
		$this->renderPartial('report');
	}

	//loadmaster
	public function actionLoadmaster(){
		$this->renderPartial('master');
	}

	//--------------------------------------------------------------------LOAD TAB CONTENT

	//tabemp
	public function actionTabemp(){
		$this->renderPartial('emp/index');
	}

	//tabempgroup
	public function actionTabempgroup(){
		$this->renderPartial('emp-group/index');
	}

	//tabemptype
	public function actionTabemptype(){
		$this->renderPartial('emp-type/index');
	}

	//tabeapp
	public function actionTabapp(){
		$this->renderPartial('app/index');
	}

	//tabapptype
	public function actionTabapptype(){
		$this->renderPartial('app-type/index');
	}

	//tabmodal
	public function actionTabmodal(){
		$this->renderPartial('module/index');
	}

	//tabrole
	public function actionTabrole(){
		$this->renderPartial('role/index');
	}

	//tabgrouprole
	public function actionTabgrouprole(){
		$this->renderPartial('group-role/index');
	}

	//tabdes
	public function actionTabdes(){
		$this->renderPartial('des/index');
	}

	//tabposition
	public function actionTabposition(){
		$this->renderPartial('position/index');
	}

	//tabmanage
	public function actionTabmanage(){
		$this->renderPartial('manage/index');
	}

	//tablevel
	//tablevel
	public function actionTablevel(){
		$this->renderPartial('level/index');
	}

	//tabbranch
	public function actionTabbranch(){
		$this->renderPartial('branch/index');
	}

	//tabbranchtype
	public function actionTabbranchtype(){
		$this->renderPartial('branch-type/index');
	}

	//tabprefix
	public function actionTabprefix(){
		$this->renderPartial('prefix/index');
	}

	//tabrelapo
	public function actionTabrelapo(){
		$this->renderPartial('group-role/position-tab');
	}

	//tabrelale
	public function actionTabrelale(){
		// $this->renderPartial('group-role/level-tab');
		$this->renderPartial('group-role/grf-tab');
	}

	//tabrelabr
	public function actionTabrelabr(){
		$this->renderPartial('group-role/branch-tab');
	}



	//-------------------------------------------------------------------LOAD MODAL CONTENT
	//loadmodalgroup
	public function actionLoadmodalgroup()
	{
		$this->renderPartial('emp-group/modal');
	}

	//loadmodaltype
	public function actionLoadmodaltype()
	{
		$this->renderPartial('emp-type/modal');
	}

	//loadmodalapp
	public function actionLoadmodalapp()
	{
		$this->renderPartial('app/modal');
	}

	//loadmodalapptype
	public function actionLoadmodalapptype()
	{
		$this->renderPartial('app-type/modal');
	}

	//loadmodalmodule
	public function actionLoadmodalmodule()
	{
		$this->renderPartial('module/modal');
	}

	//loadmodalrole
	public function actionLoadmodalrole()
	{
		$this->renderPartial('role/modal');
	}

	//loadmodalgrouprole
	public function actionLoadmodalgrouprole()
	{
		$this->renderPartial('group-role/modal');
	}

	//loadmodalposition
	public function actionLoadmodalposition()
	{
		$this->renderPartial('position/modal');
	}

	//loadmodalpositionman
	public function actionLoadmodalpositionman()
	{
		$this->renderPartial('manage/modal');
	}

	//loadmodalpositionle
	public function actionLoadmodalpositionle()
	{
		$this->renderPartial('level/modal');
	}

	//loadmodalbranch
	public function actionLoadmodalbranch()
	{
		$this->renderPartial('branch/modal');
	}

	//loadmodalbranchtype
	public function actionLoadmodalbranchtype(){
		$this->renderPartial('branch-type/modal');
	}

	//loadmodalprefix
	public function actionLoadmodalprefix(){
		$this->renderPartial('prefix/modal');
	}

	//loadmodalrelagrouprole
	public function actionLoadmodalrelagrouprole()
	{
		$this->renderPartial('group-role/rela-modal');
	}

	//loadmodalrelaapp
	public function actionLoadmodalrelaapp()
	{
		$this->renderPartial('app/rela-modal');
	}
	
	 //--------------------------------------------------------------------------------- Load Select 

	//loadselectrole
	public function actionLoadselectrole()
	{
		$this->renderPartial('role/select');
	}
	//loadselectrole2
	public function actionLoadselectrole2()
	{
		$this->renderPartial('role/select-e');
	}

	 //--------------------------------------------------------------------------------- Call BY ID


	 //CallGroupByID
    public function CallUserType($id){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "ut_id = :ut_id ",         
	        'params'    => array(':ut_id' => $id)  
	    ));
	    $modelusg2 = MasUserType::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['ut_id']=$rowss->ut_id; 
	    	$CallApp['ut_name']=$rowss->ut_name; 
	    	$CallApp['ut_description']=$rowss->ut_description;
	    }
	    if(empty($CallApp)){
	    	return '';
	    }else{
	    	return $CallApp;
	    }
    }

    //CallGroupByID
    public function CallGroupByID($id){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "ug_id = :ug_id ",         
	        'params'    => array(':ug_id' => $id)  
	    ));
	    $modelusg2 = MasUserGroup::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['ug_id']=$rowss->ug_id; 
	    	$CallApp['ug_name']=$rowss->ug_name; 
	    	$CallApp['ug_description']=$rowss->ug_description;
	    }
	    return $CallApp;
    }

     //CallTypeByID
    public function CallTypeByID($id){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "ut_id = :ut_id ",         
	        'params'    => array(':ut_id' => $id)  
	    ));
	    $modelusg2 = MasUserType::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['ut_id']=$rowss->ut_id; 
	    	$CallApp['ut_name']=$rowss->ut_name; 
	    	$CallApp['ut_description']=$rowss->ut_description;
	    }
	    return $CallApp;
    }

    //CallAppByID
    public function CallAppByID($id){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "app_id = :app_id ",         
	        'params'    => array(':app_id' => $id)  
	    ));
	    $modelusg2 = MasApp::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['app_id']=$rowss->app_id; 
	    	$CallApp['app_name_th']=$rowss->app_name_th; 
	    	$CallApp['app_name_en']=$rowss->app_name_en;
	    	$CallApp['app_type']=$rowss->app_type;
	    	$CallApp['app_shortname']=$rowss->app_shortname;
	    }
	    return $CallApp;
    }

    //CallAppTypeByID
    public function CallAppTypeByID($id){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "at_id = :at_id ",         
	        'params'    => array(':at_id' => $id)  
	    ));
	    $modelusg2 = MasAppType::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['at_id']=$rowss->at_id; 
	    	$CallApp['at_name']=$rowss->at_name; 
	    	$CallApp['at_description']=$rowss->at_description;
	    	$CallApp['at_status']=$rowss->at_status;
	    }
	    return $CallApp;
    }

    //CallModalByID
    public function CallModalByID($id){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "ma_id = :ma_id ",         
	        'params'    => array(':ma_id' => $id)  
	    ));
	    $modelusg2 = MasModuleApp::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['ma_id']=$rowss->ma_id; 
	    	$CallApp['ma_name']=$rowss->ma_name; 
	    	$CallApp['ma_description']=$rowss->ma_description;
	    	$CallApp['ma_status']=$rowss->ma_status;
	    	$CallApp['mas_app_id']=$rowss->mas_app_id;
	    }
	    return $CallApp;
    }

    //CallRoleByID
    public function CallRoleByID($id){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "ra_id = :ra_id ",         
	        'params'    => array(':ra_id' => $id)  
	    ));
	    $modelusg2 = MasRoleApp::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['ra_id']=$rowss->ra_id; 
	    	$CallApp['ra_name']=$rowss->ra_name; 
	    	$CallApp['ra_description']=$rowss->ra_description;
	    	$CallApp['ra_status']=$rowss->ra_status;
	    	$CallApp['mas_app_id']=$rowss->mas_app_id;
	    	$CallApp['mas_module_id']=$rowss->mas_module_id;
	    }
	    return $CallApp;
    }

    //CallGroupOfRoleByID
     public function CallGroupOfRoleByID($id){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "gr_id = :gr_id ",         
	        'params'    => array(':gr_id' => $id)  
	    ));
	    $modelusg2 = MasGroupOfRole::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['gr_id']=$rowss->gr_id; 
	    	$CallApp['gr_name']=$rowss->gr_name; 
	    	$CallApp['gr_description']=$rowss->gr_description;
	    	$CallApp['gr_status']=$rowss->gr_status;
	    }
	    return $CallApp;
    }

    //CallPositionByID
	public function CallPositionByID($id){
		$qusg2 = new CDbCriteria( array(
			'condition' => "PositID = :PositID ",         
			'params'    => array(':PositID' => $id)  
		));
		$modelusg2 = MasPosition::model()->findAll($qusg2);
		foreach ($modelusg2 as $rowss){
			$CallApp['PositID']=$rowss->PositID;
			$CallApp['PositNameTH']=$rowss->PositNameTH;
			$CallApp['PositNameEN']=$rowss->PositNameEN;
		}
		return $CallApp;
	}

	//CallPositionManByID
	public function CallPositionManByID($id){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "pm_id = :pm_id ",         
	        'params'    => array(':pm_id' => $id)  
	    ));
	    $modelusg2 = MasPositionMan::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['pm_id']=$rowss->pm_id; 
	    	$CallApp['pm_name_th']=$rowss->pm_name_th; 
	    	$CallApp['pm_name_en']=$rowss->pm_name_en;
	    	$CallApp['pm_status']=$rowss->pm_status;
	    }
	    return $CallApp;
    }

    //CallPositionLeByID
    public function CallPositionLeByID($id){
		$qusg2 = new CDbCriteria( array(
			'condition' => "PositLevelID = :PositLevelID ",         
			'params'    => array(':PositLevelID' => $id)  
		));
		$modelusg2 = MasPositionLe::model()->findAll($qusg2);
		foreach ($modelusg2 as $rowss){
			$CallApp['PositLevelID']=$rowss->PositLevelID;
			$CallApp['PositLevelNameTH']=$rowss->PositLevelNameTH;
			$CallApp['PositLevelNameEN']=$rowss->PositLevelNameEN;
		}
		return $CallApp;
	}

	//CallBranchByID
	public function CallBranchByID($id){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "dp_id = :dp_id ",         
	        'params'    => array(':dp_id' => $id)  
	    ));
	    $modelusg2 = MasDepartment::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['DeptID']=$rowss->DeptID; 
	    	$CallApp['DeptNameTH']=$rowss->DeptNameTH; 
	    	$CallApp['DeptNameDpisTH']=$rowss->DeptNameDpisTH;
	    	$CallApp['BranchTypeID']=$rowss->BranchTypeID;
	    	$CallApp['DeptShortName']=$rowss->DeptShortName;
	    	$CallApp['dp_id']=$rowss->dp_id; 
	    }
	    return $CallApp;
    }

    //CallBranchTypeByID
	public function CallBranchTypeByID($id){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "id = :id ",         
	        'params'    => array(':id' => $id)  
	    ));
	    $modelusg2 = MasSsobranchType::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['id']=$rowss->id; 
	    	$CallApp['name']=$rowss->name; 
	    	$CallApp['status']=$rowss->status;
	    }
	    return $CallApp;
    }

    //CallPrefixByID
	public function CallPrefixByID($id){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "pf_id = :pf_id ",         
	        'params'    => array(':pf_id' => $id)  
	    ));
	    $modelusg2 = MasPrefix::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['pf_id']=$rowss->pf_id; 
	    	$CallApp['pf_name']=$rowss->pf_name; 
	    	$CallApp['pf_description']=$rowss->pf_description; 
	    	$CallApp['pf_status']=$rowss->pf_status;
	    }
	    return $CallApp;
    }

    //CallRelation
    public function CallRelation($idg,$idp){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "id_grouprole = :id_grouprole and  id_position = :id_position",         
            'params'    => array(':id_grouprole' => $idg, ':id_position' => $idp) 
	    ));
	    $modelusg2 = RelaGrouprolePo::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['gp_id']=$rowss->gp_id; 
	    	$CallApp['id_grouprole']=$rowss->id_grouprole; 
	    	$CallApp['id_position']=$rowss->id_position; 
	    	$CallApp['gp_status']=$rowss->gp_status;
	    }

	    if(empty($CallApp)){
	    	return '';
	    }else{
	    	return $CallApp;
	    }
	    
    }

    //CallRelationle
    public function CallRelationle($idg,$idp){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "id_grouprole = :id_grouprole and  id_position = :id_position",         
            'params'    => array(':id_grouprole' => $idg, ':id_position' => $idp) 
	    ));
	    $modelusg2 = RelaGrouproleLe::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['gl_id']=$rowss->gl_id; 
	    	$CallApp['id_grouprole']=$rowss->id_grouprole; 
	    	$CallApp['id_position']=$rowss->id_position; 
	    	$CallApp['gl_status']=$rowss->gl_status;
	    }

	    if(empty($CallApp)){
	    	return '';
	    }else{
	    	return $CallApp;
	    }
	    
    }

    //CallRelationbr
    public function CallRelationbr($idg,$idp){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "id_grouprole = :id_grouprole and  id_position = :id_position",         
            'params'    => array(':id_grouprole' => $idg, ':id_position' => $idp) 
	    ));
	    $modelusg2 = RelaGrouproleBr::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['gb_id']=$rowss->gb_id; 
	    	$CallApp['id_grouprole']=$rowss->id_grouprole; 
	    	$CallApp['id_position']=$rowss->id_position; 
	    	$CallApp['gb_status']=$rowss->gb_status;
	    }

	    if(empty($CallApp)){
	    	return '';
	    }else{
	    	return $CallApp;
	    }
	    
    }

     //CallRelationemp
    public function CallRelationemp($idg,$idp){
    	$qusg2 = new CDbCriteria( array(
	        'condition' => "mas_app_id = :mas_app_id and  um_emp_id = :um_emp_id",         
            'params'    => array(':mas_app_id' => $idg, ':um_emp_id' => $idp) 
	    ));
	    $modelusg2 = RelaAppEmp::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	    	$CallApp['ae_id']=$rowss->ae_id; 
	    	$CallApp['mas_app_id']=$rowss->mas_app_id; 
	    	$CallApp['um_emp_id']=$rowss->um_emp_id; 
	    	$CallApp['ae_status']=$rowss->ae_status;
	    }

	    if(empty($CallApp)){
	    	return '';
	    }else{
	    	return $CallApp;
	    }
	    
    }




    //--------------------------------------------------------------------------------- Call DB  Insert

	//insertgroup
    public function actionInsertgroup(){


        $app_name_en = $_POST['packdata']['ap_names'];
		$app_name_th = $_POST['packdata']['ap_dess'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "ug_name = :ug_name and  ug_status = :ug_status",         
			'params'    => array(':ug_name' => $app_name_en, ':ug_status' => $app_status)  
		));
		$musg = MasUserGroup::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new MasUserGroup();
			$MasUserGroup->ug_name = $app_name_en;
			$MasUserGroup->ug_description = $app_name_th;
			$MasUserGroup->ug_status = $app_status;
 			$MasUserGroup->ud_createby = $createby;
			$MasUserGroup->ud_updateby = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}

	//inserttype
    public function actionInserttype(){


        $app_name_en = $_POST['packdata']['ap_names'];
		$app_name_th = $_POST['packdata']['ap_dess'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "ut_name = :ut_name and  ut_status = :ut_status",         
			'params'    => array(':ut_name' => $app_name_en, ':ut_status' => $app_status)  
		));
		$musg = MasUserType::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new MasUserType();
			$MasUserGroup->ut_name = $app_name_en;
			$MasUserGroup->ut_description = $app_name_th;
			$MasUserGroup->ut_status = $app_status;
 			$MasUserGroup->createby = $createby;
			$MasUserGroup->updateby = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}

	//insertapp
    public function actionInsertapp(){


        $app_name_en = $_POST['packdata']['ap_names'];
		$app_name_th = $_POST['packdata']['ap_dess'];
		$app_type = $_POST['packdata']['ap_types'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_short = $_POST['packdata']['ap_shots'];

		$q = new CDbCriteria( array(
			'condition' => "app_name_en = :app_name_en ",         
			'params'    => array(':app_name_en' => $app_name_en)  
		));
		$musg = MasApp::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasApp = new MasApp();
			$MasApp->app_name_en = $app_name_en;
			$MasApp->app_name_th = $app_name_th;
			$MasApp->app_shortname = $app_short;
			$MasApp->app_type = $app_type;
			$MasApp->app_status = $app_status;
 			$MasApp->createby = $createby;
			$MasApp->updateby = $updateby;
			$MasApp->app_img = '0';

			if($MasApp->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}

	//insertapptype
    public function actionInsertapptype(){


        $app_name_en = $_POST['packdata']['ap_names'];
		$app_name_th = $_POST['packdata']['ap_dess'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "at_name = :at_name and  at_status = :at_status",         
			'params'    => array(':at_name' => $app_name_en, ':at_status' => $app_status)  
		));
		$musg = MasAppType::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new MasAppType();
			$MasUserGroup->at_name = $app_name_en;
			$MasUserGroup->at_description = $app_name_th;
			$MasUserGroup->at_status = $app_status;
 			$MasUserGroup->createby = $createby;
			$MasUserGroup->updateby = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}

	//insertmodule
	public function actionInsertmodule(){


        $app_name_en = $_POST['packdata']['ap_names'];
		$app_name_th = $_POST['packdata']['ap_dess'];
		$app_app = $_POST['packdata']['ap_types'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "ma_name = :ma_name and  ma_status = :ma_status and  mas_app_id = :mas_app_id",         
			'params'    => array(':ma_name' => $app_name_en, ':ma_status' => $app_status, ':mas_app_id' => $app_app)  
		));
		$musg = MasModuleApp::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new MasModuleApp();
			$MasUserGroup->ma_name = $app_name_en;
			$MasUserGroup->ma_description = $app_name_th;
			$MasUserGroup->mas_app_id = $app_app;
			$MasUserGroup->ma_status = $app_status;
 			$MasUserGroup->createby = $createby;
			$MasUserGroup->updateby = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}


	//insertrole
	public function actionInsertrole(){


        $app_name_en = $_POST['packdata']['ap_names'];
		$app_name_th = $_POST['packdata']['ap_dess'];
		$app_app = $_POST['packdata']['ap_types'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$mas_module_id = $_POST['packdata']['ap_type2'];

		$q = new CDbCriteria( array(
			'condition' => "ra_name = :ra_name and  ra_status = :ra_status and  mas_app_id = :mas_app_id and  mas_module_id = :mas_module_id",         
			'params'    => array(':ra_name' => $app_name_en, ':ra_status' => $app_status, ':mas_app_id' => $app_app, ':mas_module_id' => $mas_module_id)  
		));
		$musg = MasRoleApp::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new MasRoleApp();
			$MasUserGroup->ra_name = $app_name_en;
			$MasUserGroup->ra_description = $app_name_th;
			$MasUserGroup->mas_app_id = $app_app;
			$MasUserGroup->mas_module_id = $mas_module_id;
			$MasUserGroup->ra_status = $app_status;
 			$MasUserGroup->createby = $createby;
			$MasUserGroup->updateby = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}

	//insertgrouprole
	public function actionInsertgrouprole(){


        $app_name_en = $_POST['packdata']['ap_names'];
		$app_name_th = $_POST['packdata']['ap_dess'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "gr_name = :gr_name and  gr_status = :gr_status",         
			'params'    => array(':gr_name' => $app_name_en, ':gr_status' => $app_status)  
		));
		$musg = MasGroupOfRole::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new MasGroupOfRole();
			$MasUserGroup->gr_name = $app_name_en;
			$MasUserGroup->gr_description = $app_name_th;
			$MasUserGroup->gr_status = $app_status;
 			$MasUserGroup->createby = $createby;
			$MasUserGroup->updateby = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}

	//insertposition
	public function actionInsertposition(){


        $app_name_en = $_POST['packdata']['ap_names'];
		$app_name_th = $_POST['packdata']['ap_dess'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "PositNameEN = :PositNameEN and  StatusData = :StatusData",         
			'params'    => array(':PositNameEN' => $app_name_en, ':StatusData' => $app_status)  
		));
		$musg = MasPosition::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new MasPosition();
			$MasUserGroup->PositNameEN = $app_name_en;
			$MasUserGroup->PositNameTH = $app_name_th;
			$MasUserGroup->StatusData = $app_status;
 			$MasUserGroup->CreateBy = $createby;
			$MasUserGroup->UpdateBy = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}

	//insertpositionman
	public function actionInsertpositionman(){


        $app_name_en = $_POST['packdata']['ap_names'];
		$app_name_th = $_POST['packdata']['ap_dess'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "pm_name_en = :pm_name_en and  pm_status = :pm_status",         
			'params'    => array(':pm_name_en' => $app_name_en, ':pm_status' => $app_status)  
		));
		$musg = MasPositionMan::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new MasPositionMan();
			$MasUserGroup->pm_name_en = $app_name_en;
			$MasUserGroup->pm_name_th = $app_name_th;
			$MasUserGroup->pm_status = $app_status;
 			$MasUserGroup->createby = $createby;
			$MasUserGroup->updateby = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}

	//insertpositionle
	public function actionInsertpositionle(){


        $app_name_en = $_POST['packdata']['ap_names'];
		$app_name_th = $_POST['packdata']['ap_dess'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "PositLevelNameEN = :PositLevelNameEN and  StatusData = :StatusData",         
			'params'    => array(':PositLevelNameEN' => $app_name_en, ':StatusData' => $app_status)  
		));
		$musg = MasPositionLe::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new MasPositionLe();
			$MasUserGroup->PositLevelNameEN = $app_name_en;
			$MasUserGroup->PositLevelNameTH = $app_name_th;
			$MasUserGroup->StatusData = $app_status;
 			$MasUserGroup->CreateBy = $createby;
			$MasUserGroup->UpdateBy = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}


	//insertbranch
    public function actionInsertbranch(){


        $app_name_en = $_POST['packdata']['ap_names'];
		$app_name_th = $_POST['packdata']['ap_dess'];
		$app_type = $_POST['packdata']['ap_types'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_short = $_POST['packdata']['ap_shots'];

		$q = new CDbCriteria( array(
			'condition' => "DeptNameTH = :DeptNameTH ",         
			'params'    => array(':DeptNameTH' => $app_name_en)  
		));
		$musg = MasDepartment::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasApp = new MasDepartment();
			$MasApp->DeptNameTH = $app_name_en;
			$MasApp->DeptID = $app_name_th;
			$MasApp->DeptShortName = $app_short;
			$MasApp->BranchTypeID = $app_type;
			$MasApp->StatusData = $app_status;
 			$MasApp->CreateBy = $createby;
			$MasApp->UpdateBy = $updateby;

			if($MasApp->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}

	//insertbranchtype
    public function actionInsertbranchtype(){


        $app_name_en = $_POST['packdata']['ap_names'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "name = :name and  status = :status",         
			'params'    => array(':name' => $app_name_en, ':status' => $app_status)  
		));
		$musg = MasSsobranchType::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new MasSsobranchType();
			$MasUserGroup->name = $app_name_en;
			$MasUserGroup->status = $app_status;
 			$MasUserGroup->create_by = $createby;
			$MasUserGroup->update_by = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}

	//insertprefix
    public function actionInsertprefix(){


        $app_name_en = $_POST['packdata']['ap_names'];
        $app_name_th = $_POST['packdata']['ap_dess'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "pf_name = :pf_name and  pf_status = :pf_status",         
			'params'    => array(':pf_name' => $app_name_en, ':pf_status' => $app_status)  
		));
		$musg = MasPrefix::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new MasPrefix();
			$MasUserGroup->pf_name = $app_name_en;
			$MasUserGroup->pf_description = $app_name_th;
			$MasUserGroup->pf_status = $app_status;
 			$MasUserGroup->createby = $createby;
			$MasUserGroup->updateby = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{//if($countusg==0)
			echo "errordup";
		}
	}

	//insertrelaposition
    public function actionInsertrelaposition(){


        $chkid = $_POST['packdata']['chkid'];
        $groleid = $_POST['packdata']['groleid'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "id_grouprole = :id_grouprole and  id_position = :id_position",         
			'params'    => array(':id_grouprole' => $groleid, ':id_position' => $chkid)  
		));
		$musg = RelaGrouprolePo::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new RelaGrouprolePo();
			$MasUserGroup->id_grouprole = $groleid;
			$MasUserGroup->id_position = $chkid;
			$MasUserGroup->gp_status = $app_status;
 			$MasUserGroup->createby = $createby;
			$MasUserGroup->updateby = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{

			$valid = $_POST['packdata']['valid'];

			if($valid != '0'){
				$MasUserGroup = RelaGrouprolePo::model()->findByPk(intval($valid));
				$MasUserGroup->id_grouprole = $groleid;
				$MasUserGroup->id_position = $chkid;
				$MasUserGroup->gp_status = $app_status;
				if($MasUserGroup->save()){
					echo "success";
				}else{
					echo "error";
				}
			}
			
		}
	}

	//insertrelalevel
    public function actionInsertrelalevel(){


        $chkid = $_POST['packdata']['chkid'];
        $groleid = $_POST['packdata']['groleid'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "id_grouprole = :id_grouprole and  id_position = :id_position",         
			'params'    => array(':id_grouprole' => $groleid, ':id_position' => $chkid)  
		));
		$musg = RelaGrouproleLe::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new RelaGrouproleLe();
			$MasUserGroup->id_grouprole = $groleid;
			$MasUserGroup->id_position = $chkid;
			$MasUserGroup->gl_status = $app_status;
 			$MasUserGroup->createby = $createby;
			$MasUserGroup->updateby = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{

			$valid = $_POST['packdata']['valid'];

			if($valid != '0'){
				$MasUserGroup = RelaGrouproleLe::model()->findByPk(intval($valid));
				$MasUserGroup->id_grouprole = $groleid;
				$MasUserGroup->id_position = $chkid;
				$MasUserGroup->gl_status = $app_status;
				if($MasUserGroup->save()){
					echo "success";
				}else{
					echo "error";
				}
			}
			
		}
	}

	//insertrelabranch
    public function actionInsertrelabranch(){


        $chkid = $_POST['packdata']['chkid'];
        $groleid = $_POST['packdata']['groleid'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "id_grouprole = :id_grouprole and  id_position = :id_position",         
			'params'    => array(':id_grouprole' => $groleid, ':id_position' => $chkid)  
		));
		$musg = RelaGrouproleBr::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new RelaGrouproleBr();
			$MasUserGroup->id_grouprole = $groleid;
			$MasUserGroup->id_position = $chkid;
			$MasUserGroup->gb_status = $app_status;
 			$MasUserGroup->createby = $createby;
			$MasUserGroup->updateby = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{

			$valid = $_POST['packdata']['valid'];

			if($valid != '0'){
				$MasUserGroup = RelaGrouproleBr::model()->findByPk(intval($valid));
				$MasUserGroup->id_grouprole = $groleid;
				$MasUserGroup->id_position = $chkid;
				$MasUserGroup->gb_status = $app_status;
				if($MasUserGroup->save()){
					echo "success";
				}else{
					echo "error";
				}
			}
			
		}
	}

	//insertrelapprela
    public function actionInsertrelapprela(){


        $chkid = $_POST['packdata']['chkid'];
        $groleid = $_POST['packdata']['groleid'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		$q = new CDbCriteria( array(
			'condition' => "mas_app_id = :mas_app_id and  um_emp_id = :um_emp_id",         
			'params'    => array(':mas_app_id' => $groleid, ':um_emp_id' => $chkid)  
		));
		$musg = RelaAppEmp::model()->findAll($q);
		$countusg = count($musg);
		if($countusg==0){
			$MasUserGroup = new RelaAppEmp();
			$MasUserGroup->mas_app_id = $groleid;
			$MasUserGroup->um_emp_id = $chkid;
			$MasUserGroup->ae_status = $app_status;
 			$MasUserGroup->createby = $createby;
			$MasUserGroup->updateby = $updateby;

			if($MasUserGroup->save()){
				echo "success";
			}else{
				echo "error";
			}
		}else{

			$valid = $_POST['packdata']['valid'];

			if($valid != '0'){
				$MasUserGroup = RelaAppEmp::model()->findByPk(intval($valid));
				$MasUserGroup->mas_app_id = $groleid;
				$MasUserGroup->um_emp_id = $chkid;
				$MasUserGroup->ae_status = $app_status;
				if($MasUserGroup->save()){
					echo "success";
				}else{
					echo "error";
				}
			}
			
		}
	}




	//insertgroupofroledata
    public function actionInsertgroupofroledata(){

    	$ide = $_POST['ides'];
        $datapack = $_POST['datapack'];
		
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';

		for ($i = 0; $i < count($datapack); $i++) {

			$datagrf = explode("/", $datapack[$i]);

			$q = new CDbCriteria( array(
				'condition' => "id_group_of_role = :id_group_of_role and id_user_type = :id_user_type and 
				id_position_man = :id_position_man and id_position_level = :id_position_level and tg_status = :tg_status",         
				'params'    => array(':id_group_of_role' => $ide, ':id_user_type' => $datagrf[0],
				 ':id_position_man' => $datagrf[1], ':id_position_level' => $datagrf[2], ':tg_status' => $app_status)  
			));
			$musg = TranGroupOfRole::model()->findAll($q);
			$countusg[$i] = count($musg);
			

			if($countusg[$i]==0){

				$MasUserGroup = new TranGroupOfRole();
				$MasUserGroup->id_group_of_role = $ide;
				$MasUserGroup->id_user_type = $datagrf[0];
				$MasUserGroup->id_position_man = $datagrf[1];
	 			$MasUserGroup->id_position_level = $datagrf[2];
				$MasUserGroup->tg_status = $app_status;
				$MasUserGroup->createby = $createby;
				$MasUserGroup->updateby = $updateby;

				if($MasUserGroup->save()){
					echo "success";
				}else{
					echo "error";
				}
			}else{//if($countusg==0)
				echo "errordup";
			}

		}

		
	}


	//--------------------------------------------------------------------------------- Call DB  Update

	//updaterelaposition
	public function actionUpdaterelaposition(){

		$chkid = $_POST['packdata']['chkid'];
        $groleid = $_POST['packdata']['groleid'];
        $valid = $_POST['packdata']['valid'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '0';

		$MasUserGroup = RelaGrouprolePo::model()->findByPk(intval($valid));
		$MasUserGroup->id_grouprole = $groleid;
		$MasUserGroup->id_position = $chkid;
		$MasUserGroup->gp_status = $app_status;
		$MasUserGroup->updateby = $updateby;
		
		if($MasUserGroup->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updaterelalevel
	public function actionUpdaterelalevel(){

		$chkid = $_POST['packdata']['chkid'];
        $groleid = $_POST['packdata']['groleid'];
        $valid = $_POST['packdata']['valid'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '0';

		$MasUserGroup = RelaGrouproleLe::model()->findByPk(intval($valid));
		$MasUserGroup->id_grouprole = $groleid;
		$MasUserGroup->id_position = $chkid;
		$MasUserGroup->gl_status = $app_status;
		$MasUserGroup->updateby = $updateby;
		if($MasUserGroup->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updaterelabranch
	public function actionUpdaterelabranch(){

		$chkid = $_POST['packdata']['chkid'];
        $groleid = $_POST['packdata']['groleid'];
        $valid = $_POST['packdata']['valid'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '0';

		$MasUserGroup = RelaGrouproleBr::model()->findByPk(intval($valid));
		$MasUserGroup->id_grouprole = $groleid;
		$MasUserGroup->id_position = $chkid;
		$MasUserGroup->gb_status = $app_status;
		$MasUserGroup->updateby = $updateby;
		if($MasUserGroup->save()){
			echo "success";
		}else{
			echo "error";
		}

	}


	//updategroup
	public function actionUpdategroup(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
		$app_name_th = $_POST['packdata']['ap_dess_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_id_e'];

		$MasUserGroup = MasUserGroup::model()->findByPk(intval($app_id));
		$MasUserGroup->ug_name = $app_name_en;
		$MasUserGroup->ug_description = $app_name_th;
		$MasUserGroup->ug_status = $app_status;
		$MasUserGroup->ud_updateby = $updateby;
		if($MasUserGroup->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updatetype
	public function actionUpdatetype(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
		$app_name_th = $_POST['packdata']['ap_dess_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_id_e'];

		$MasUserGroup = MasUserType::model()->findByPk(intval($app_id));
		$MasUserGroup->ut_name = $app_name_en;
		$MasUserGroup->ut_description = $app_name_th;
		$MasUserGroup->ut_status = $app_status;
		$MasUserGroup->updateby = $updateby;
		if($MasUserGroup->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updateapp
	public function actionUpdateapp(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
		$app_name_th = $_POST['packdata']['ap_dess_e'];
		$app_type = $_POST['packdata']['ap_types_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_id_e'];
		$app_short = $_POST['packdata']['ap_shots_e'];

		$MasApp = MasApp::model()->findByPk(intval($app_id));
		$MasApp->app_name_en = $app_name_en;
		$MasApp->app_name_th = $app_name_th;
		$MasApp->app_type = $app_type;
		$MasApp->app_status = $app_status;
		$MasApp->app_shortname = $app_short;
		$MasApp->updateby = $updateby;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updateapptype
	public function actionUpdateapptype(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
		$app_name_th = $_POST['packdata']['ap_dess_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_id_e'];

		$MasApp = MasAppType::model()->findByPk(intval($app_id));
		$MasApp->at_name = $app_name_en;
		$MasApp->at_description = $app_name_th;
		$MasApp->at_status = $app_status;
		$MasApp->updateby = $updateby;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updatemodule
	public function actionUpdatemodule(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
		$app_name_th = $_POST['packdata']['ap_dess_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_types_e'];
		$ap_id_e = $_POST['packdata']['ap_id_e'];

		$MasApp = MasModuleApp::model()->findByPk(intval($ap_id_e));
		$MasApp->ma_name = $app_name_en;
		$MasApp->ma_description = $app_name_th;
		$MasApp->ma_status = $app_status;
		$MasApp->mas_app_id = $app_id;
		$MasApp->update_by = $updateby;
		
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updaterole
	public function actionUpdaterole(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
		$app_name_th = $_POST['packdata']['ap_dess_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_type_e'];
		$module_id = $_POST['packdata']['ap_type2e'];
		$ap_id_e = $_POST['packdata']['ap_id_e'];

		$MasApp = MasRoleApp::model()->findByPk(intval($ap_id_e));
		$MasApp->ra_name = $app_name_en;
		$MasApp->ra_description = $app_name_th;
		$MasApp->ra_status = $app_status;
		$MasApp->mas_app_id = $app_id;
		$MasApp->mas_module_id = $module_id;
		$MasApp->update_by = $updateby;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updategrouprole
	public function actionUpdategrouprole(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
		$app_name_th = $_POST['packdata']['ap_dess_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_id_e'];

		$MasApp = MasGroupOfRole::model()->findByPk(intval($app_id));
		$MasApp->gr_name = $app_name_en;
		$MasApp->gr_description = $app_name_th;
		$MasApp->gr_status = $app_status;
		$MasApp->updateby = $updateby;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updateposition
	public function actionUpdateposition(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
		$app_name_th = $_POST['packdata']['ap_dess_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_id_e'];

		$MasApp = MasPosition::model()->findByPk(intval($app_id));
		$MasApp->PositNameTH = $app_name_th;
		$MasApp->PositNameEN = $app_name_en;
		$MasApp->StatusData = $app_status;
		$MasApp->UpdateBy = $updateby;
		
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updatepositionman
	public function actionUpdatepositionman(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
		$app_name_th = $_POST['packdata']['ap_dess_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_id_e'];

		$MasApp = MasPositionMan::model()->findByPk(intval($app_id));
		$MasApp->pm_name_en = $app_name_en;
		$MasApp->pm_name_th = $app_name_th;
		$MasApp->pm_status = $app_status;
		$MasApp->updateby = $updateby;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updatepositionle
	public function actionUpdatepositionle(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
		$app_name_th = $_POST['packdata']['ap_dess_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_id_e'];

		$MasApp = MasPositionLe::model()->findByPk(intval($app_id));
		$MasApp->PositLevelNameTH = $app_name_th;
		$MasApp->PositLevelNameEN = $app_name_en;
		$MasApp->StatusData = $app_status;
		$MasApp->UpdateBy = $updateby;
		
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updatebranch
	public function actionUpdatebranch(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
		$app_name_th = $_POST['packdata']['ap_dess_e'];
		$app_type = $_POST['packdata']['ap_types_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_id_e'];
		$app_short = $_POST['packdata']['ap_shots_e'];

		$MasApp = MasDepartment::model()->findByPk(intval($app_id));
		$MasApp->DeptNameTH = $app_name_en;
		$MasApp->DeptID = $app_name_th;
		$MasApp->BranchTypeID = $app_type;
		$MasApp->StatusData = $app_status;
		$MasApp->DeptShortName = $app_short;
		$MasApp->UpdateBy = $updateby;
		
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updatebranchtype
	public function actionUpdatebranchtype(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_id_e'];

		$MasApp = MasSsobranchType::model()->findByPk(intval($app_id));
		$MasApp->name = $app_name_en;
		$MasApp->status = $app_status;
		$MasApp->update_by = $updateby;

		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//updateprefix
	public function actionUpdateprefix(){

		$app_name_en = $_POST['packdata']['ap_names_e'];
		$app_name_th = $_POST['packdata']['ap_dess_e'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '1';
		$app_id = $_POST['packdata']['ap_id_e'];

		$MasUserGroup = MasPrefix::model()->findByPk(intval($app_id));
		$MasUserGroup->pf_name = $app_name_en;
		$MasUserGroup->pf_description = $app_name_th;
		$MasUserGroup->pf_status = $app_status;
		$MasUserGroup->updateby = $updateby;
		if($MasUserGroup->save()){
			echo "success";
		}else{
			echo "error";
		}

	}


	//updaterelaapp
	public function actionUpdaterelaapp(){

		$chkid = $_POST['packdata']['chkid'];
        $groleid = $_POST['packdata']['groleid'];
        $valid = $_POST['packdata']['valid'];
 		$createby = Yii::app()->session['em_username'];
		$updateby = Yii::app()->session['em_username'];
		$app_status = '0';

		$MasUserGroup = RelaAppEmp::model()->findByPk(intval($valid));
		$MasUserGroup->mas_app_id = $groleid;
		$MasUserGroup->um_emp_id = $chkid;
		$MasUserGroup->ae_status = $app_status;
		$MasUserGroup->updateby = $updateby;
		if($MasUserGroup->save()){
			echo "success";
		}else{
			echo "error";
		}

	}



	//--------------------------------------------------------------------------------- Call DB  Delete

	//Delgroup
	public function actionDelgroup(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = MasUserGroup::model()->findByPk(intval($app_id));
		$MasApp->ug_status = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//Deltype
	public function actionDeltype(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = MasUserType::model()->findByPk(intval($app_id));
		$MasApp->ut_status = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//delapp
	public function actionDelapp(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = MasApp::model()->findByPk(intval($app_id));
		$MasApp->app_status = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//delapptype
	public function actionDelapptype(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = MasAppType::model()->findByPk(intval($app_id));
		$MasApp->at_status = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//delmodule
	public function actionDelmodule(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = MasModuleApp::model()->findByPk(intval($app_id));
		$MasApp->ma_status = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//delgrouprole
	public function actionDelgrouprole(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = MasGroupOfRole::model()->findByPk(intval($app_id));
		$MasApp->gr_status = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//deletedatapos
	public function actionDeletedatapos(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = MasPosition::model()->findByPk(intval($app_id));
		$MasApp->StatusData = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//delpositionman
	public function actionDelpositionman(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = MasPositionMan::model()->findByPk(intval($app_id));
		$MasApp->pm_status = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//deletedataposle
	public function actionDeletedataposle(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = MasPositionLe::model()->findByPk(intval($app_id));
		$MasApp->StatusData = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//delbranch
	public function actionDelbranch(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = MasDepartment::model()->findByPk(intval($app_id));
		$MasApp->StatusData = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//delbranchtype
	public function actionDelbranchtype(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = MasSsobranchType::model()->findByPk(intval($app_id));
		$MasApp->status = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//delprefix
	public function actionDelprefix(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = MasPrefix::model()->findByPk(intval($app_id));
		$MasApp->pf_status = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	//deletedatagfrole
	public function actionDeletedatagfrole(){

		$app_status = '0';
		$app_id = $_POST['idd'];

		$MasApp = TranGroupOfRole::model()->findByPk(intval($app_id));
		$MasApp->tg_status = $app_status;
		if($MasApp->save()){
			echo "success";
		}else{
			echo "error";
		}

	}

	


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/





	//--------------------------------------------------------------------------------- Call DB

	public function CallNameApp($name){

        $qusg2 = new CDbCriteria( array(
	        'condition' => "app_id = :app_id ",         
	        'params'    => array(':app_id' => $name)  
	    ));
	    $modelusg2 = MasApp::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	        $app_id = $rowss->app_id; 
	        $app_name_th = $rowss->app_name_th; 
	    }
	    return $app_name_th;
    }

    public function CallNameModule($mas_module_id){

    	$qusg2 = new CDbCriteria( array(
	        'condition' => "ma_id = :ma_id ",         
	        'params'    => array(':ma_id' => $mas_module_id)  
	    ));
	    $modelusg2 = MasModuleApp::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	        $ma_id = $rowss->ma_id; 
	        $ma_name = $rowss->ma_name; 
	    }
	    return $ma_name;
    }

    public function CallNameOfficer($mas_officer_id){

    	$qusg2 = new CDbCriteria( array(
	        'condition' => "op_id = :op_id ",         
	        'params'    => array(':op_id' => $mas_officer_id)  
	    ));
	    $modelusg2 = MasOfficerPo::model()->findAll($qusg2);
	    foreach ($modelusg2 as $rowss){
	        $op_id = $rowss->op_id; 
	        $op_name = $rowss->op_name; 
	    }
	    return $op_name;
    }


	//--------------------------------------------------------------------------------------- P'oof controller

	public function actionSearchdpis(){
		$host=Yii::app()->params['prg_ctrl']['ipservice']['ipzonedev']; 
		
		try{
			$pid=isset($_POST['pid'])?addslashes(trim($_POST['pid'])):'';	
			
			if($pid=="1679900183277")
			{
				
				$PER_ID="1130";
				$ssofirstname="นัธพง";
				$ssopersoncitizenid="1679900183277";
				$givenName="nutapong";
				$ssosurname="ศรีปราช";
			//	$updatesucess->maildrop=$dataitem["maildrop"];
				$ssopersonempdate="2010-10-04";
			//	var_dump($updatesucess->ssopersonempdate);
				$title="Mr.";
				$initials="นาย";
				$employeeType="พนักงานประกันสังคม";
			//	$updatesucess->email=$dataitem["mail"];
				$workingdeptdescription="สำนักบริหารเทคโนโลยีสารสนเทศ";
				$sn="sreeprach";
				$ssopersonposition="พนักงานประกันสังคม";
				$ssopersonbirthdate="1990-10-04";
				$accountActive="1";
				$ssopersonclass="ชั้นสูง";
				$cn="nutapong sreeprach";
				$PICPATH="sso.co.th/pic";
			//	$PIC_UPDATE=$dataitem["PIC_UPDATE"];
				$PER_GENDER="1";
				$PER_DOCDATE="1990-10-04";
			}else{
					
					
					$data_array = array("filter" => array("exp" => $pid),);	
					$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/dpisinfosearch.php', json_encode($data_array));
					$data1 = json_decode($make_call, true);
					
					
					foreach($data1 as $dataitem)
					{
						$PER_ID=$dataitem["PER_ID"];
						$ssofirstname=$dataitem["ssofirstname"];
						$ssopersoncitizenid=$dataitem["ssopersoncitizenid"];
						$givenName=$dataitem["givenName"];
						$ssosurname=$dataitem["ssosurname"];
					//	$updatesucess->maildrop=$dataitem["maildrop"];
						$ssopersonempdate=isset($dataitem['ssopersonempdate'])?addslashes(trim($dataitem['ssopersonempdate'])):'';
					//	var_dump($updatesucess->ssopersonempdate);
						$title=$dataitem["title"];
						$initials=$dataitem["initials"];
						$employeeType=$dataitem["employeeType"];
					//	$updatesucess->email=$dataitem["mail"];
						$workingdeptdescription=$dataitem["workingdeptdescription"];
						$sn=$dataitem["sn"];
						$ssopersonposition=$dataitem["ssopersonposition"];
						$ssopersonbirthdate=$dataitem["ssopersonbirthdate"];
						$accountActive=$dataitem["accountActive"];
						$ssopersonclass=$dataitem["ssopersonclass"];
						$cn=$dataitem["cn"];
						$PICPATH=$dataitem["PICPATH"];
						$PIC_UPDATE=$dataitem["PIC_UPDATE"];
						$PER_GENDER=$dataitem["PER_GENDER"];
						$PER_GENDER=$dataitem["PER_DOCDATE"];
						
					}
			}
			
				
			$data_array = array("filter" => array("exp" => $pid),);	
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
				
				
			
			if($code=="204")
				{

					
					$arr_char="";
					$username="";
					$arr_char = str_split($sn);
					$username=$arr_char[0].$givenName;
					$mail=$givenName.".".$arr_char[0]."@sso.go.th";
					$data_array = array("filter" => array("exp" => $username),);	
					$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/dataldaptest.php', json_encode($data_array));
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
				
					if($datacode=="204")
							{
														
												
											
							}else{
										
									$arr_char = str_split($sn,2);
									$username=$arr_char[0].$givenName;
									$mail=$givenName.".".$arr_char[0]."@sso.go.th";
									$data_array = array("filter" => array("exp" => $username),);	
									$make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/dataldaptest.php', json_encode($data_array));
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
											
									if($datacode=="204")
											{
																
														
									}else{
												
											$arr_char = str_split($sn,3);
											$username=$arr_char[0].$givenName;
											$mail=$givenName.".".$arr_char[0]."@sso.go.th";
													
														
													
										}
							}
				}
				
		    else if($code=="200")
				{
					
					$username='';
					$mail='';
					foreach ($uid as $dataitem)
						{
							
							$username=isset($dataitem['UID'])?addslashes(trim($dataitem['UID'])):'';
							$mail=isset($dataitem['MAIL'])?addslashes(trim($dataitem['MAIL'])):'';
						
						}
				}	
			}catch (Exception $e) {
           //  var_dump("11111");
			  
			//$transaction->rollBack();
			echo CJSON::encode(array('status' => 'error','msg' => $e,));	
			
			

		}
		
			echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'PER_ID'=>$PER_ID,
			'ssopersoncitizenid'=>$ssopersoncitizenid,
			'ssofirstname'=>preg_replace('/\\\\/', '', $ssofirstname),
			'ssosurname'=>preg_replace('/\\\\/', '', $ssosurname),
			'givenName'=>preg_replace('/\\\\/', '', $givenName),
			'title'=>preg_replace('/\\\\/', '', $title),
			'initials'=>preg_replace('/\\\\/', '', $initials),
			'employeeType'=>preg_replace('/\\\\/', '', $employeeType),
			'ssopersonempdate'=>preg_replace('/\\\\/', '', $ssopersonempdate),
			'mail'=>preg_replace('/\\\\/', '', $mail),
			'workingdeptdescription'=>preg_replace('/\\\\/', '', $workingdeptdescription),
			'sn'=>preg_replace('/\\\\/', '', $sn),
			'ssopersonposition'=>preg_replace('/\\\\/', '', $ssopersonposition),
			'ssopersonbirthdate'=>preg_replace('/\\\\/', '', $ssopersonbirthdate),
			'ssopersonclass'=>preg_replace('/\\\\/', '', $ssopersonclass),
			//'cn'=>preg_replace('/\\\\/', '', $cn),
			'PICPATH'=>preg_replace('/\\\\/', '', $PICPATH),
			'username'=>preg_replace('/\\\\/', '', $username),
			'PER_GENDER'=>preg_replace('/\\\\/', '', $PER_GENDER),
			'accountActive'=>preg_replace('/\\\\/', '', $accountActive),
			));	
	}
	public function actionSavedatauser()
	{
		
		$model= new frm_profile;
		$model->PER_ID=isset($_POST['per_id'])?addslashes(trim($_POST['per_id'])):'';
		$model->ssofirstname=isset($_POST['fisrtname'])?addslashes(trim($_POST['fisrtname'])):'';
		$model->ssosurname=isset($_POST['ssosurname'])?addslashes(trim($_POST['ssosurname'])):'';
		$model->ssopersoncitizenid=isset($_POST['ssopersoncitizenid'])?addslashes(trim($_POST['ssopersoncitizenid'])):'';
		$model->givenName=isset($_POST['givenName'])?addslashes(trim($_POST['givenName'])):'';
	//	$model->maildrop=isset($_POST['maildrop'])?addslashes(trim($_POST['maildrop'])):'';
		$model->ssopersonempdate=isset($_POST['ssopersonempdate'])?addslashes(trim($_POST['ssopersonempdate'])):'';
		$model->title=isset($_POST['title'])?addslashes(trim($_POST['title'])):'';
		$model->initials=isset($_POST['initials'])?addslashes(trim($_POST['initials'])):'';
		$model->employeeType=isset($_POST['employeeType'])?addslashes(trim($_POST['employeeType'])):'';
		$model->email=isset($_POST['mail'])?addslashes(trim($_POST['mail'])):'';
		$model->workingdeptdescription=isset($_POST['workingdeptdescription'])?addslashes(trim($_POST['workingdeptdescription'])):'';
		$model->sn=isset($_POST['sn'])?addslashes(trim($_POST['sn'])):'';
		$model->ssopersonposition=isset($_POST['ssopersonposition'])?addslashes(trim($_POST['ssopersonposition'])):'';
		$model->ssopersonbirthdate=isset($_POST['ssopersonbirthdate'])?addslashes(trim($_POST['ssopersonbirthdate'])):'';
		$model->accountActive=isset($_POST['accountActive'])?addslashes(trim($_POST['accountActive'])):'';
		$model->ssopersonclass=isset($_POST['ssopersonclass'])?addslashes(trim($_POST['ssopersonclass'])):'';
	//	$model->userid=isset($_POST['username'])?addslashes(trim($_POST['username'])):'';
		$model->userlevel_id=isset($_POST['userlevel'])?addslashes(trim($_POST['userlevel'])):'';
		$model->PER_GENDER=isset($_POST['PER_GENDER'])?addslashes(trim($_POST['PER_GENDER'])):'';
	//	$model->PICPATH=isset($_POST['PICPATH'])?addslashes(trim($_POST['PICPATH'])):'';
		
		
	//	$model->dataflowdpis();
		$model->dataprocessumday();
		echo CJSON::encode(array('status' => 'success','msg' => '',));		
	}
	
	public function actionAlldatadpis()
	{
		ini_set('max_execution_time', 300);
		
					$count=1;
					
					$model1= new lkup_oracledpis;
					$model= new frm_profile;
					$data1=$model1->datadpisemflow($count);
					
		$sql ="select PER_ID  from db_dpis ";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		if($rows == null)
			{
					foreach($data1 as $dataitem)
					{
						
					
						
						$model->PER_ID=$dataitem["PER_ID"];
						$model->ssofirstname=$dataitem["ssofirstname"];
						$model->ssopersoncitizenid=$dataitem["ssopersoncitizenid"];
						$model->givenName=$dataitem["givenName"];
						$model->ssosurname=$dataitem["ssosurname"];
					//	$updatesucess->maildrop=$dataitem["maildrop"];
						$model->ssopersonempdate=isset($dataitem['ssopersonempdate'])?addslashes(trim($dataitem['ssopersonempdate'])):'';
					//	var_dump($updatesucess->ssopersonempdate);
						$model->title=$dataitem["title"];
						$model->initials=$dataitem["initials"];
						$model->employeeType=$dataitem["employeeType"];
					//	$updatesucess->email=$dataitem["mail"];
						$model->workingdeptdescription=$dataitem["workingdeptdescription"];
						$model->sn=$dataitem["sn"];
						$model->ssopersonposition=$dataitem["ssopersonposition"];
						$model->ssopersonbirthdate=$dataitem["ssopersonbirthdate"];
						$model->accountActive=$dataitem["accountActive"];
						$model->ssopersonclass=$dataitem["ssopersonclass"];
						$model->cn=$dataitem["cn"];
						$model->PICPATH=$dataitem["PICPATH"];
						$model->PIC_UPDATE=$dataitem["PIC_UPDATE"];
						$model->UPDATE_DPIS=$dataitem["UPDATE_DATE"];
						$model->PER_GENDER=$dataitem["PER_GENDER"];
						$model->PER_DOCDATE=$dataitem["PER_DOCDATE"];
						$model->dataflowdpis();
						
					}
				
		
			}else
			{
				foreach($data1 as $dataitem)
					{
						$model->PER_ID=$dataitem["PER_ID"];
						$model->ssofirstname=$dataitem["ssofirstname"];
						$model->ssopersoncitizenid=$dataitem["ssopersoncitizenid"];
						$model->givenName=$dataitem["givenName"];
						$model->ssosurname=$dataitem["ssosurname"];
					//	$updatesucess->maildrop=$dataitem["maildrop"];
						$model->ssopersonempdate=isset($dataitem['ssopersonempdate'])?addslashes(trim($dataitem['ssopersonempdate'])):'';
					//	var_dump($updatesucess->ssopersonempdate);
						$model->title=$dataitem["title"];
						$model->initials=$dataitem["initials"];
						$model->employeeType=$dataitem["employeeType"];
					//	$updatesucess->email=$dataitem["mail"];
						$model->workingdeptdescription=$dataitem["workingdeptdescription"];
						$model->sn=$dataitem["sn"];
						$model->ssopersonposition=$dataitem["ssopersonposition"];
						$model->ssopersonbirthdate=$dataitem["ssopersonbirthdate"];
						$model->accountActive=$dataitem["accountActive"];
						$model->ssopersonclass=$dataitem["ssopersonclass"];
						$model->cn=$dataitem["cn"];
						$model->PICPATH=$dataitem["PICPATH"];
						$model->PIC_UPDATE=$dataitem["PIC_UPDATE"];
						$model->UPDATE_DPIS=$dataitem["UPDATE_DATE"];
						$model->PER_GENDER=$dataitem["PER_GENDER"];
						$model->PER_DOCDATE=$dataitem["PER_DOCDATE"];
						$model->dataflowdpisupdateday();
					}
			}				
					echo CJSON::encode(array('status' => 'success','msg' => '','count'=>$count,));	
					
	}
	public function actiondatadpisprocess()
	{		
	
			ini_set('max_execution_time', 300);
			$count=0;
			$model1= new lkup_oracledpis;
			$data1=$model1->datadpisprocess($count);
			$model= new frm_profile;
			
				foreach($data1 as $dataitem)
					{
						
						$model->PER_ID=$dataitem["PER_ID"];
						$model->ssofirstname=$dataitem["SSOFIRSTNAME"];
						$model->ssopersoncitizenid=$dataitem["SSOPERSONCITIZENID"];
						$model->givenName=$dataitem["GIVENNAME"];
						$model->ssosurname=$dataitem["SSOSURNAME"];
					//	$updatesucess->maildrop=$dataitem["maildrop"];
						$model->ssopersonempdate=isset($dataitem['SSOPERSONEMPDATE'])?addslashes(trim($dataitem['SSOPERSONEMPDATE'])):'';
					//	var_dump($updatesucess->ssopersonempdate);
						$model->title=$dataitem["TITLE"];
						$model->initials=$dataitem["INITIALS"];
						$model->employeeType=$dataitem["EMPLOYEETYPE"];
					//	$updatesucess->email=$dataitem["mail"];
						$model->workingdeptdescription=$dataitem["WORKINGDEPTDESCRIPTION"];
						$model->sn=$dataitem["SN"];
						$model->ssopersonposition=$dataitem["SSOPERSONPOSITION"];
						$model->ssopersonbirthdate=$dataitem["SSOPERSONBIRTHDATE"];
						$model->accountActive=$dataitem["ACCOUNTACTIVE"];
						$model->ssopersonclass=$dataitem["SSOPERSONCLASS"];
					//	$model->cn=$dataitem["CN"];
						$model->PICPATH=$dataitem["PICPATH"];
					//	$model->PIC_UPDATE=$dataitem["PIC_UPDATE"];
						$model->PER_GENDER=$dataitem["PER_GENDER"];
					//	$model->PER_DOCDATE=$dataitem["PER_DOCDATE"];
						$model->dataprocessum();
						
					}
							
				//	$count+= 1;
						echo CJSON::encode(array('status' => 'success','msg' => '','count'=>$count,));	
			
	}
	public function actionDatadpisprocess11()
	{		
			ini_set('max_execution_time', 300);
			$count=isset($_POST['count'])?addslashes(trim($_POST['count'])):'';
			$count+= 1500;	
			$model1= new lkup_oracledpis;
			$data1=$model1->datadpisprocess($count);
			$countdata=$model1->datadpisprocesscount();
			$model= new frm_profile;
			foreach($data1 as $dataitem)
					{
						
					
						
						$model->PER_ID=$dataitem["PER_ID"];
						$model->ssofirstname=$dataitem["SSOFIRSTNAME"];
						$model->ssopersoncitizenid=$dataitem["SSOPERSONCITIZENID"];
						$model->givenName=$dataitem["GIVENNAME"];
						$model->ssosurname=$dataitem["SSOSURNAME"];
					//	$updatesucess->maildrop=$dataitem["maildrop"];
						$model->ssopersonempdate=isset($dataitem['SSOPERSONEMPDATE'])?addslashes(trim($dataitem['SSOPERSONEMPDATE'])):'';
					//	var_dump($updatesucess->ssopersonempdate);
						$model->title=$dataitem["TITLE"];
						$model->initials=$dataitem["INITIALS"];
						$model->employeeType=$dataitem["EMPLOYEETYPE"];
					//	$updatesucess->email=$dataitem["mail"];
						$model->workingdeptdescription=$dataitem["WORKINGDEPTDESCRIPTION"];
						$model->sn=$dataitem["SN"];
						$model->ssopersonposition=$dataitem["SSOPERSONPOSITION"];
						$model->ssopersonbirthdate=$dataitem["SSOPERSONBIRTHDATE"];
						$model->accountActive=$dataitem["ACCOUNTACTIVE"];
						$model->ssopersonclass=$dataitem["SSOPERSONCLASS"];
					//	$model->cn=$dataitem["CN"];
						$model->PICPATH=$dataitem["PICPATH"];
				//		$model->PIC_UPDATE=$dataitem["PIC_UPDATE"];
						$model->PER_GENDER=$dataitem["PER_GENDER"];
				//		$model->PER_DOCDATE=$dataitem["PER_DOCDATE"];
						$model->dataprocessum();
					}
		
	
					if(count($countdata) >= $count)
					{
											
						echo CJSON::encode(array('status' => 'unsuccess','msg' => '','count'=>$count,));	
					}
					else
					{
					echo CJSON::encode(array('status' => 'success','msg' => '',));	
					}		
			
	}
	public function actionDatadpisprocessday()
	{		
	
	
	
			ini_set('max_execution_time', 300);
			//$count=0;
			$model1= new lkup_oracledpis;
			$data1=$model1->datadpisprocessday();
			$model= new frm_profile;
			//var_dump($data1);
			
			if($data1 != null){
				
				foreach($data1 as $dataitem)
					{
						
						$model->PER_ID=$dataitem["PER_ID"];
						$model->ssofirstname=$dataitem["SSOFIRSTNAME"];
						$model->ssopersoncitizenid=$dataitem["SSOPERSONCITIZENID"];
						$model->givenName=$dataitem["GIVENNAME"];
						$model->ssosurname=$dataitem["SSOSURNAME"];
					//	$updatesucess->maildrop=$dataitem["maildrop"];
						$model->ssopersonempdate=isset($dataitem['SSOPERSONEMPDATE'])?addslashes(trim($dataitem['SSOPERSONEMPDATE'])):'';
					//	var_dump($updatesucess->ssopersonempdate);
						$model->title=$dataitem["TITLE"];
						$model->initials=$dataitem["INITIALS"];
						$model->employeeType=$dataitem["EMPLOYEETYPE"];
					//	$updatesucess->email=$dataitem["mail"];
						$model->workingdeptdescription=$dataitem["WORKINGDEPTDESCRIPTION"];
						$model->sn=$dataitem["SN"];
						$model->ssopersonposition=$dataitem["SSOPERSONPOSITION"];
						$model->ssopersonbirthdate=$dataitem["SSOPERSONBIRTHDATE"];
						$model->accountActive=$dataitem["ACCOUNTACTIVE"];
						$model->ssopersonclass=$dataitem["SSOPERSONCLASS"];
					//	$model->cn=$dataitem["CN"];
						$model->PICPATH=$dataitem["PICPATH"];
					//	$model->PIC_UPDATE=$dataitem["PIC_UPDATE"];
						$model->PER_GENDER=$dataitem["PER_GENDER"];
					//	$model->PER_DOCDATE=$dataitem["PER_DOCDATE"];
						$model->dataprocessumday();
						
					}
			}			
				//	$count+= 1;
						echo CJSON::encode(array('status' => 'success','msg' => '',));	
			
	}
	
	
	public function actionUpdateusergroup()
	{
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$drpdep=isset($_POST['drpdep'])?addslashes(trim($_POST['drpdep'])):'';
		$model1= new frm_user;
		if($model1->updatemas_user_group($id,$drpdep))
					{
											
						echo CJSON::encode(array('status' => 'success','msg' => '',));	
					}
					else
					{
					echo CJSON::encode(array('status' => 'error','msg' => '',));	
					}		
	}
	public function actionDeleteum_employee()
	{
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$userid=isset($_POST['userid'])?addslashes(trim($_POST['userid'])):'';
		//$drpdep=isset($_POST['drpdep'])?addslashes(trim($_POST['drpdep'])):'';
		$model1= new frm_user;
		if($model1->deleteum_employee($id,$userid))
					{
											
						echo CJSON::encode(array('status' => 'success','msg' => '',));	
					}
					else
					{
					echo CJSON::encode(array('status' => 'error','msg' => '',));	
					}		
	}
	public function actionEditdataemployee()
	{
		$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		//$drpdep=isset($_POST['drpdep'])?addslashes(trim($_POST['drpdep'])):'';
		$data = lkup_user::useredit($id);
		
		foreach($data as $dataitem)
		{
			$username=$dataitem["em_username"];
			$PER_ID=$dataitem["em_per_id"];
			$ssofirstname=$dataitem["em_name_th"];
			$ssopersoncitizenid=$dataitem["em_citizen_id"];
			$givenName=$dataitem["em_name_en"];
			$ssosurname=$dataitem["em_surname_th"];
		//	$updatesucess->maildrop=$dataitem["maildrop"];
			$ssopersonempdate=isset($dataitem['em_workactive_date'])?addslashes(trim($dataitem['em_workactive_date'])):'';
		//	var_dump($updatesucess->ssopersonempdate);
			$title=$dataitem["pf_description"];
			$initials=$dataitem["pf_name"];
			$employeeType=$dataitem["ut_name"];
			$email=$dataitem["em_email"];
			$workingdeptdescription=$dataitem["DeptNameTH"];
			$sn=$dataitem["em_surname_en"];
			$ssopersonposition=$dataitem["PositNameTH"];
			$ssopersonbirthdate=$dataitem["em_birthday"];
			$accountActive=$dataitem["em_work_status"];
			$ssopersonclass=$dataitem["PositLevelNameTH"];
			$cn=$dataitem["em_name_en"]." ".$dataitem["em_surname_en"] ;
			$PICPATH=$dataitem["em_image"];
			$PIC_UPDATE=$dataitem["em_image"];
			$um_user_group_id=$dataitem["um_user_group_id"];
			if($dataitem["pf_name"]=="MR.")
			{
			$PER_GENDER=1;
			}else{
			$PER_GENDER=2;	
			}
		//	$PER_DOCDATE=$dataitem["PER_DOCDATE"];
		}
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'PER_ID'=>$PER_ID,
			'ssopersoncitizenid'=>$ssopersoncitizenid,
			'ssofirstname'=>preg_replace('/\\\\/', '', $ssofirstname),
			'ssosurname'=>preg_replace('/\\\\/', '', $ssosurname),
			'givenName'=>preg_replace('/\\\\/', '', $givenName),
			'title'=>preg_replace('/\\\\/', '', $title),
			'initials'=>preg_replace('/\\\\/', '', $initials),
			'employeeType'=>preg_replace('/\\\\/', '', $employeeType),
			'ssopersonempdate'=>preg_replace('/\\\\/', '', $ssopersonempdate),
			'mail'=>preg_replace('/\\\\/', '', $email),
			'workingdeptdescription'=>preg_replace('/\\\\/', '', $workingdeptdescription),
			'sn'=>preg_replace('/\\\\/', '', $sn),
			'ssopersonposition'=>preg_replace('/\\\\/', '', $ssopersonposition),
			'ssopersonbirthdate'=>preg_replace('/\\\\/', '', $ssopersonbirthdate),
			'ssopersonclass'=>preg_replace('/\\\\/', '', $ssopersonclass),
			'cn'=>preg_replace('/\\\\/', '', $cn),
			'PICPATH'=>preg_replace('/\\\\/', '', $PICPATH),
			'um_user_group_id'=>preg_replace('/\\\\/', '', $um_user_group_id),
			'username'=>preg_replace('/\\\\/', '', $username),
			'PER_GENDER'=>preg_replace('/\\\\/', '', $PER_GENDER),
			'accountActive'=>preg_replace('/\\\\/', '', $accountActive),
			));		
					
	}
	public function actionListuser(){
		
		
		
			$page = 1;
			if(!empty($_POST['page'])) $page = (int)$_POST['page'];
			
			$recordsPerPage = 10;
			if(!empty($_POST['length'])) $recordsPerPage = (int)$_POST['length'];
			
			$start = 0;
			if(!empty($_POST['start'])) $start = (int)$_POST['start'];
			
			$masusertype=isset($_POST['masusertype'])?addslashes(trim($_POST['masusertype'])):'';
			$masusergroup=isset($_POST['masusergroup'])?addslashes(trim($_POST['masusergroup'])):'';
		//	$masapptype=isset($_POST['masapptype'])?addslashes(trim($_POST['masapptype'])):'';
			$masdepartment=isset($_POST['masdepartment'])?addslashes(trim($_POST['masdepartment'])):'';
			$noOfRecords = 0;
			
			//ค้นหาจาก LDAP แล้วเอามาใส่ ฐานข้อมูลของเรา
			
			$model=new frm_user;
			$model->page = $page;
			$model->recordsPerPage = $recordsPerPage;
			$model->start = $start;
			$model->noOfRecords = $noOfRecords;
		//	$model->FSearch = $FSearch;
			
			$model->Listuser($masusertype,$masusergroup,$masdepartment);
			
			/* header("Content-type: application/json; charset=UTF-8");
			echo CJSON::encode($model->Listuser());
			Yii::app()->end(); */
	
	}
	public function actionReport()
	{
		$StartDate=isset($_POST['StartDate'])?addslashes(trim($_POST['StartDate'])):'';
		$EndDate=isset($_POST['EndDate'])?addslashes(trim($_POST['EndDate'])):'';
		$page = 1;
			if(!empty($_POST['page'])) $page = (int)$_POST['page'];
			
			$recordsPerPage = 10;
			if(!empty($_POST['length'])) $recordsPerPage = (int)$_POST['length'];
			
			$start = 0;
			if(!empty($_POST['start'])) $start = (int)$_POST['start'];
		
			$noOfRecords = 0;
			
			//ค้นหาจาก LDAP แล้วเอามาใส่ ฐานข้อมูลของเรา
			
			$model=new frm_user;
			$model->page = $page;
			$model->recordsPerPage = $recordsPerPage;
			$model->start = $start;
			$model->noOfRecords = $noOfRecords;
		//	$model->FSearch = $FSearch;
			
			$model->reportuser($StartDate,$EndDate);
		
	}
	public function actionDatadpisupdate()
	{
	//	$id=isset($_POST['id'])?addslashes(trim($_POST['id'])):'';
		$userid=isset($_POST['userid'])?addslashes(trim($_POST['userid'])):'';
		//$drpdep=isset($_POST['drpdep'])?addslashes(trim($_POST['drpdep'])):'';
		   $model=new CommonAction;
		   $model->uid = $userid;
		//  var_dump($model->update_mas_user());
		 
		if($model->update_mas_user())
					{
											
						echo CJSON::encode(array('status' => 'success','msg' => '',));	
					}
					else
					{
					echo CJSON::encode(array('status' => 'error','msg' => '',));	
					}		
	}
	public function actionSearchuser(){
		
		
		
			
			
			$this->renderPartial('emp/tbuser');
			/* header("Content-type: application/json; charset=UTF-8");
			echo CJSON::encode($model->Listuser());
			Yii::app()->end(); */
	
	}
	public function actionDatainsertusernew(){
		
//	$model=new frm_user;
//	$data=$model->searchusernew();
			
			
			$this->renderPartial('emp/tbusernew');
			/* header("Content-type: application/json; charset=UTF-8");
			echo CJSON::encode($model->Listuser());
			Yii::app()->end(); */
	
	}
}