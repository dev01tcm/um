<?php

class OwnerController extends Controller {
	
	public function actionIndex() {
		$this->renderPartial('index');
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionLoadapp(){
		$this->renderPartial('app');
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionLoadContent(){
		$app = $_POST["app"];
		Yii::app()->session['report_app'] = $app;
		$this->renderPartial('content',array('app'=>$app));
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionLoaddestab(){
		$app = $_POST["app"];
		$this->renderPartial('des-tab/index',array('app'=>$app));
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionSavedatades() {
		if(Yii::app()->request->isPostRequest){
			if($_FILES['app-img']['size']!=0){
				$app_id = $_POST['app_id'];
				$app_name_th = $_POST['app_name_th'];
				$app_shortname = $_POST['app_shortname'];
				$app_name_en = $_POST['app_name_en'];
				$app_contact = $_POST['ap_contact_e'];
				$app_phone = $_POST['ap_phone_e'];
				
				$model=new FroalaAction;
				$model->directoryName = Yii::app()->params['prg_ctrl']['path']['upload']."/thumbnail/";
				$model->urlupload = Yii::app()->params['prg_ctrl']['url']['upload']."/thumbnail/";
				$model->allowedExts = array("gif", "jpeg", "jpg", "png");
				$model->allowedMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/x-png", "image/png");
				$model->fieldname = "app-img";
				$model->genfiename = true;
				
				if($model->upload_file()){
					$model2=new MasDes;
					$model2->app_id = $app_id;
					$model2->app_name_th = $app_name_th;
					$model2->app_shortname = $app_shortname;
					$model2->app_name_en = $app_name_en;
					$model2->app_contact = $app_contact;
					$model2->app_phone = $app_phone;
					$model->directoryName = Yii::app()->params['prg_ctrl']['path']['upload']."/thumbnail/";
					$obj = json_decode( Yii::app()->session['successmsg_upload'], true);
					$model2->app_img = $obj['name'];
					
					if($model2->save_update_im()){
						echo json_encode(array('msg' => 'success')); 
					}else{
						$msg = Yii::app()->session['errmsg_content'];
						echo json_encode(array('msg' => $msg));
						Yii::app()->session->remove('errmsg_content');
					}
				}else{
					$msg = Yii::app()->session['errmsg_upload'];
					echo json_encode(array('msg' => $msg));
					Yii::app()->session->remove('errmsg_upload');
				}
			}else{
				$app_id = $_POST['app_id'];
				$app_name_th = $_POST['app_name_th'];
				$app_shortname = $_POST['app_shortname'];
				$app_name_en = $_POST['app_name_en'];
				$app_contact = $_POST['ap_contact_e'];
				$app_phone = $_POST['ap_phone_e'];
				
				$model2=new MasDes;
				$model2->app_id = $app_id;
				$model2->app_name_th = $app_name_th;
				$model2->app_shortname = $app_shortname;
				$model2->app_name_en = $app_name_en;
				$model2->app_contact = $app_contact;
				$model2->app_phone = $app_phone;
				
				if($model2->save_update_noim()){
					echo json_encode(array('msg' => 'success')); 
				}else{
					$msg = Yii::app()->session['errmsg_content'];
					echo json_encode(array('msg' => $msg));
					Yii::app()->session->remove('errmsg_content');
				}
			}
		}
	}
//------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------
//Control-----------------------------------------------------------------------------------------------------------------------
	public function actionLoadcontab(){
		$app = $_POST["app"];
		$this->renderPartial('con-tab/index',array('app'=>$app));
	}
//------------------
	public function actionLoadmodalcon(){
		$app = $_POST["app"];
		$this->renderPartial('con-tab/modal',array('app'=>$app));
	}
//------------------
	public function actionSavedatacon() {
		if(Yii::app()->request->isPostRequest){
			$id = $_POST['id'];
			$type = $_POST['type'];
			$name = $_POST['name'];
			$check = $_POST['check'];
			$order = $_POST['order'];
			$app_id = $_POST["app"];
			
			$model=new MasControl;
			$model->id = $id;
			$model->type = $type;
			$model->name = $name;
			$model->check = $check;
			$model->order = $order;
			$model->app_id = $app_id;
			
			if($model->id==='') {
				if($model->save_insert()) {
					echo json_encode(array('msg'=>'success')); 
				}else{
					$msg = Yii::app()->session['errmsg'];
					echo json_encode(array('msg' => $msg));
					Yii::app()->session->remove('errmsg');
				}
			}else{
				if($model->save_update()) {
					echo json_encode(array('msg'=>'success')); 
				}else{
					$msg = Yii::app()->session['errmsg'];
					echo json_encode(array('msg' => $msg));
					Yii::app()->session->remove('errmsg');
				}
			}
		}
	}
//------------------
	public function CallConByID($id){
		$qusg2 = new CDbCriteria( array(
			'condition' => "ct_id = :ct_id ",         
			'params'    => array(':ct_id' => $id)  
		));
		$modelusg2 = MasControl::model()->findAll($qusg2);
		foreach ($modelusg2 as $rowss){
			$CallOb['ct_id']=$rowss->ct_id; 
			$CallOb['ct_type']=$rowss->ct_type;
			$CallOb['ct_name']=$rowss->ct_name;
			$CallOb['ct_check']=$rowss->ct_check;
		}
		return $CallOb;
	}
//------------------
	public function actionDeletedatacon() {
		$model = new MasControl;
		$model->id = $_POST["id"];
		
		if($model->save_delete()) {
			echo json_encode(array('status'=>'success')); 
		}else{
			$msg = Yii::app()->session['errmsg'];
			echo json_encode(array('status' => $msg));
			Yii::app()->session->remove('errmsg');
		}
	}
//------------------------------------------------------------------------------------------------------------------------------
//Module------------------------------------------------------------------------------------------------------------------------
	public function actionLoadmodtab(){
		$app = $_POST["app"];
		$this->renderPartial('module-tab/index',array('app'=>$app));
	}
	//------------------
	public function actionLoadmodalmod(){
		$app = $_POST["app"];
		$this->renderPartial('module-tab/modal',array('app'=>$app));
	}
	//------------------
	public function actionSavedatamod() {
		if(Yii::app()->request->isPostRequest){
			$id = $_POST['id'];
			$code = $_POST['code'];
			$name = $_POST['name'];
			$descri = $_POST['descri'];
			$app_id = $_POST["app"];
			
			$model=new MasModuleApp;
			$model->id = $id;
			$model->code = $code;
			$model->name = $name;
			$model->descri = $descri;
			$model->app_id = $app_id;
			
			if($model->id==='') {
				if($model->save_insert()) {
					
					echo json_encode(array('msg'=>'success')); 
				}else{
					$msg = Yii::app()->session['errmsg'];
					echo json_encode(array('msg' => $msg));
					Yii::app()->session->remove('errmsg');
				}
			}else{
				if($model->save_update()) {
					echo json_encode(array('msg'=>'success')); 
				}else{
					$msg = Yii::app()->session['errmsg'];
					echo json_encode(array('msg' => $msg));
					Yii::app()->session->remove('errmsg');
				}
			}
		}
	}
	//------------------
	public function CallModByID($id){
		$qusg2 = new CDbCriteria( array(
			'condition' => "ma_id = :id ",         
			'params'    => array(':id' => $id)  
		));
		$modelusg2 = MasModuleApp::model()->findAll($qusg2);
		foreach ($modelusg2 as $rowss){
			$CallOb['ma_id']=$rowss->ma_id;
			$CallOb['ma_code']=$rowss->ma_code;
			$CallOb['ma_name']=$rowss->ma_name;
			$CallOb['ma_description']=$rowss->ma_description;
		}
		return $CallOb;
	}
	//------------------
	public function actionDeletedatamod() {
		$model = new MasModuleApp;
		$model->id = $_POST["id"];
		
		if($model->save_delete()) {
			echo json_encode(array('msg'=>'success')); 
		}else{
			$msg = Yii::app()->session['errmsg'];
			echo json_encode(array('msg' => $msg));
			Yii::app()->session->remove('errmsg');
		}
	}
//------------------------------------------------------------------------------------------------------------------------------
//Tab Module--------------------------------------------------------------------------------------------------------------------
	public function actionLoadmodright(){
		$app = $_POST["app"];
		$mod = $_POST["mod"];
		$name = $_POST["name"];
		$this->renderPartial('module-tab/tab/index',array('app'=>$app,'mod'=>$mod,'name'=>$name));
	}
//------------------------------------------------------------------------------------------------------------------------------
//Module Control----------------------------------------------------------------------------------------------------------------
	public function actionLoadconsub(){
		$mod = $_POST["mod"];
		$this->renderPartial('module-tab/tab/control/index',array('mod'=>$mod));
	}
	//------------------
	public function actionLoadmodalconsub(){
		$mod = $_POST["mod"];
		$this->renderPartial('module-tab/tab/control/modal',array('mod'=>$mod));
	}
	//------------------
	public function actionSavedatamodcon() {
		if(Yii::app()->request->isPostRequest){
			$id = $_POST['id'];
			$type = $_POST['type'];
			$name = $_POST['name'];
			$check = $_POST['check'];
			$order = $_POST['order'];
			$mod_id = $_POST["mod_id"];
			
			$model=new MasControlMod;
			$model->id = $id;
			$model->type = $type;
			$model->name = $name;
			$model->check = $check;
			$model->order = $order;
			$model->mod_id = $mod_id;
			
			if($model->id==='') {
				if($model->save_insert()) {
					echo json_encode(array('msg'=>'success')); 
				}else{
					$msg = Yii::app()->session['errmsg'];
					echo json_encode(array('msg' => $msg));
					Yii::app()->session->remove('errmsg');
				}
			}else{
				if($model->save_update()) {
					echo json_encode(array('msg'=>'success')); 
				}else{
					$msg = Yii::app()->session['errmsg'];
					echo json_encode(array('msg' => $msg));
					Yii::app()->session->remove('errmsg');
				}
			}
		}
	}
	//------------------
	public function CallConmodByID($id){
		$qusg2 = new CDbCriteria( array(
			'condition' => "ct_id = :ct_id ",         
			'params'    => array(':ct_id' => $id)  
		));
		$modelusg2 = MasControlMod::model()->findAll($qusg2);
		foreach ($modelusg2 as $rowss){
			$CallOb['ct_id']=$rowss->ct_id; 
			$CallOb['ct_type']=$rowss->ct_type;
			$CallOb['ct_name']=$rowss->ct_name;
			$CallOb['ct_check']=$rowss->ct_check;
		}
		return $CallOb;
	}
	//------------------
	public function actionDeletedataconmod() {
		$model = new MasControlMod;
		$model->id = $_POST["id"];
		
		if($model->save_delete()) {
			echo json_encode(array('msg'=>'success')); 
		}else{
			$msg = Yii::app()->session['errmsg'];
			echo json_encode(array('msg' => $msg));
			Yii::app()->session->remove('errmsg');
		}
	}
//------------------------------------------------------------------------------------------------------------------------------
//Module Role-------------------------------------------------------------------------------------------------------------------
	public function actionLoadrolsub(){
		$mod = $_POST["mod"];
		$app = $_POST["app"];
		$this->renderPartial('module-tab/tab/role/index',array('app'=>$app,'mod'=>$mod));
	}
//------------------------------------------------------------------------------------------------------------------------------
//Level-------------------------------------------------------------------------------------------------------------------------
	public function actionLoadroletab(){
		$app = $_POST["app"];
		$this->renderPartial('role-tab/index',array('app'=>$app));
	}
	//------------------
	public function actionLoadmodalrole(){
		$app = $_POST["app"];
		$this->renderPartial('role-tab/modal',array('app'=>$app));
	}
	//------------------
	public function actionSavedatarole() {
		if(Yii::app()->request->isPostRequest){
			$id = $_POST['id'];
			$code = $_POST['code'];
			$name = $_POST['name'];
			$descri = $_POST['descri'];
			$app_id = $_POST["app"];
			
			$model=new MasRoleApp;
			$model->id = $id;
			$model->code = $code;
			$model->name = $name;
			$model->descri = $descri;
			$model->app_id = $app_id;
			
			if($model->id==='') {
				if($model->save_insert()) {
					echo json_encode(array('msg'=>'success')); 
				}else{
					$msg = Yii::app()->session['errmsg'];
					echo json_encode(array('msg' => $msg));
					Yii::app()->session->remove('errmsg');
				}
			}else{
				if($model->save_update()) {
					echo json_encode(array('msg'=>'success')); 
				}else{
					$msg = Yii::app()->session['errmsg'];
					echo json_encode(array('msg' => $msg));
					Yii::app()->session->remove('errmsg');
				}
			}
		}
	}
	//------------------
	public function CallRoleByID($id){
		$qusg2 = new CDbCriteria( array(
			'condition' => "ra_id = :id ",         
			'params'    => array(':id' => $id)  
		));
		$modelusg2 = MasRoleApp::model()->findAll($qusg2);
		foreach ($modelusg2 as $rowss){
			$CallOb['ra_id']=$rowss->ra_id;
			$CallOb['ra_code']=$rowss->ra_code;
			$CallOb['ra_name']=$rowss->ra_name;
			$CallOb['ra_description']=$rowss->ra_description;
		}
		return $CallOb;
	}
	//------------------
	public function actionDeletedatarole() {
		$model = new MasRoleApp;
		$model->id = $_POST["id"];
		
		if($model->save_delete()) {
			echo json_encode(array('msg'=>'success')); 
		}else{
			$msg = Yii::app()->session['errmsg'];
			echo json_encode(array('msg' => $msg));
			Yii::app()->session->remove('errmsg');
		}
	}
//------------------------------------------------------------------------------------------------------------------------------
//Role--------------------------------------------------------------------------------------------------------------------------
	public function actionLoadgroletab(){
		$app = $_POST["app"];
		$this->renderPartial('grole-tab/index',array('app'=>$app));
	}
	//------------------
	public function actionLoadmodalgrole(){
		$app = $_POST["app"];
		$this->renderPartial('grole-tab/modal',array('app'=>$app));
	}
	//------------------
	public function actionSavedatagrole() {
		if(Yii::app()->request->isPostRequest){
			$id = $_POST['id'];
			$code = $_POST['code'];
			$name = $_POST['name'];
			$descri = $_POST['descri'];
			$app_id = $_POST["app"];
			
			$model=new MasGRole;
			$model->id = $id;
			$model->code = $code;
			$model->name = $name;
			$model->descri = $descri;
			$model->app_id = $app_id;
			
			if($model->id==='') {
				if($model->save_insert()) {
					echo json_encode(array('msg'=>'success')); 
				}else{
					$msg = Yii::app()->session['errmsg'];
					echo json_encode(array('msg' => $msg));
					Yii::app()->session->remove('errmsg');
				}
			}else{
				if($model->save_update()) {
					echo json_encode(array('msg'=>'success')); 
				}else{
					$msg = Yii::app()->session['errmsg'];
					echo json_encode(array('msg' => $msg));
					Yii::app()->session->remove('errmsg');
				}
			}
		}
	}
	//------------------
	public function CallGRoleByID($id){
		$qusg2 = new CDbCriteria( array(
			'condition' => "ra_id = :id ",         
			'params'    => array(':id' => $id)  
		));
		$modelusg2 = MasGRole::model()->findAll($qusg2);
		foreach ($modelusg2 as $rowss){
			$CallOb['ra_id']=$rowss->ra_id;
			$CallOb['ra_code']=$rowss->ra_code;
			$CallOb['ra_name']=$rowss->ra_name;
			$CallOb['ra_description']=$rowss->ra_description;
		}
		return $CallOb;
	}
	//------------------
	public function actionDeletedatagrole() {
		$model = new MasGRole;
		$model->id = $_POST["id"];
		
		if($model->save_delete()) {
			echo json_encode(array('msg'=>'success')); 
		}else{
			$msg = Yii::app()->session['errmsg'];
			echo json_encode(array('msg' => $msg));
			Yii::app()->session->remove('errmsg');
		}
	}
//----------------------------------------------------------------------------------------------------------------------------
//Tab Role--------------------------------------------------------------------------------------------------------------------
	public function actionLoadgrolright(){
		$rol = $_POST["rol"];
		$name = $_POST["name"];
		$app = $_POST["app"];
		$this->renderPartial('grole-tab/tab/index',array('rol'=>$rol,'name'=>$name,'app'=>$app));
	}
	//Role Position-----------------------------------------------------------------------------------------------------------
	public function actionLoadrolemodule(){
		$rol = $_POST["rol"];
		$app = $_POST["app"];
		$ver = $_POST["ver"];
		$this->renderPartial('grole-tab/tab/module/index',array('rol'=>$rol,'app'=>$app,'ver'=>$ver));
	}
	//------------------
	public function actionLoadmodalrolemodule() {
		$id = $_POST["id"];
		$name = $_POST["name"];
		$mod = $_POST["mod"];
		$this->renderPartial('grole-tab/tab/module/modal/modal',array('id'=>$id,'name'=>$name,'mod'=>$mod));
	}
	//------------------
	public function actionModuletab(){
		$id = $_POST["id"];
		$app = $_POST["app"];
		$ver = $_POST["ver"];
		$mod = $_POST["mod"];
		$this->renderPartial('grole-tab/tab/module/modal/glevel-tab',array('id'=>$id, 'app'=>$app, 'ver'=>$ver, 'mod'=>$mod));
	}
	//------------------
	public function actionVersiontab(){
		$id = $_POST["id"];
		$this->renderPartial('grole-tab/tab/version/version-tab',array('id'=>$id));
	}
	//------------------
	public function actionLoadmodalversion() {
		$rol = $_POST["rol"];
		$ver = $_POST["ver"];
		$date = $_POST["date"];
		
		$this->renderPartial('grole-tab/tab/version/modal-checkver',array('rol'=>$rol,'ver'=>$ver,'date'=>$date));
	}
//----------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------
	public function actionGetnowver() {
		$grm_id = $_POST["grm_id"];
		$data = MasGroleModLev::getnowver($grm_id);
		foreach($data as $dataitem){
			$runid = $dataitem['ver_no'];
		}
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'runid'=>$runid,
		));
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionSavedatagmod() {
		if(Yii::app()->request->isPostRequest){
			$app = $_POST['app'];
			$ver_now = $_POST['ver_now'];
			$rol_id = $_POST['rol_id'];
			$mod_array = $_POST['mod_array'];
			$status_array = $_POST['status_array'];
			$rol_array = $_POST['rol_array'];
			$mod_array2 = $_POST['mod_array2'];
			$status_array2 = $_POST['status_array2'];
			
			$model=new MasGroleMod;
			$model->app = $app;
			$model->ver_now = $ver_now;
			$model->rol_id = $rol_id;
			$model->mod_array = $mod_array;
			$model->status_array = $status_array;
			$model->rol_array = $rol_array;
			$model->mod_array2 = $mod_array2;
			$model->status_array2 = $status_array2;
			
			if($model->savedata()){
				echo json_encode(array('msg' => 'success')); 
			}else{
				$msg = Yii::app()->session['errmsg_content'];
				echo json_encode(array('msg' => $msg));
				Yii::app()->session->remove('errmsg_content');
			}
		}
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionSavedata() {
		if(Yii::app()->request->isPostRequest){
			$grm_id = $_POST['grm_id'];
			$mod = $_POST['mod'];
			$ver = $_POST['ver'];
			$rol_id = $_POST['rol_id'];
			$rol_array = $_POST['rol_array'];
			$status_array = $_POST['status_array'];
			$mod_array = $_POST['mod_array'];
			$status_mo_array = $_POST['status_mo_array'];
			
			$model=new MasGroleModLev;
			$model->grm_id = $grm_id;
			$model->mod = $mod;
			$model->ver = $ver;
			$model->rol_id = $rol_id;
			$model->rol_array = $rol_array;
			$model->status_array = $status_array;
			$model->mod_array = $mod_array;
			$model->status_mo_array = $status_mo_array;
			
			if($model->savedata()){
				echo json_encode(array('msg' => 'success')); 
			}else{
				$msg = Yii::app()->session['errmsg_content'];
				echo json_encode(array('msg' => $msg));
				Yii::app()->session->remove('errmsg_content');
			}
		}
	}
	//------------------
	public function actionSavechangever() {
		$model = new MasGroleModLev;
		$model->id = $_POST["id"];
		$model->grm_id = $_POST["grm_id"];
		
		if($model->save_ver()) {
			echo json_encode(array('msg'=>'success')); 
		}else{
			$msg = Yii::app()->session['errmsg'];
			echo json_encode(array('msg' => $msg));
			Yii::app()->session->remove('errmsg');
		}
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionSavedatamodulelevel() {
		if(Yii::app()->request->isPostRequest){
			$modid = $_POST['modid'];
			$sw_array = $_POST['sw_array'];
			$sw_status_array = $_POST['sw_status_array'];
			$df_id = $_POST['df_id'];
			
			$model=new MasRoleMod;
			$model->modid = $modid;
			$model->sw_array = $sw_array;
			$model->sw_status_array = $sw_status_array;
			$model->df_id = $df_id;
			
			if($model->savedata()){
				echo json_encode(array('msg' => 'success')); 
			}else{
				$msg = Yii::app()->session['errmsg_content'];
				echo json_encode(array('msg' => $msg));
				Yii::app()->session->remove('errmsg_content');
			}
		}
	}
//GOR--------------------------------------------------------------------------------------------------------------------------
	public function actionLoadgortab(){
		$app = $_POST["app"];
		$this->renderPartial('gor-tab/index',array('app'=>$app));
	}
	//Tab GOR--------------------------------------------------------------------------------------------------------------------
	public function actionLoadgorright(){
		$gor_id = $_POST["gor_id"];
		$app = $_POST["app"];
		$name = $_POST["name"];
		
		$this->renderPartial('gor-tab/tab/index',array('gor_id'=>$gor_id, 'app'=>$app, 'name'=>$name));
	}
	//Module Role-------------------------------------------------------------------------------------------------------------------
	public function actionLoadgorrolsub(){
		$gor_id = $_POST["gor_id"];
		$app = $_POST["app"];
		
		$this->renderPartial('gor-tab/tab/role/index',array('gor_id'=>$gor_id, 'app'=>$app));
	}
	//------------------------------------------------------------------------------------------------------------------------------
	public function actionSavedatagorrole() {
		if(Yii::app()->request->isPostRequest){
			$sw_array = $_POST['sw_array'];
			$sw_status_array = $_POST['sw_status_array'];
			
			$model=new MasGOR;
			$model->sw_array = $sw_array;
			$model->sw_status_array = $sw_status_array;
			
			if($model->savedata()){
				echo json_encode(array('msg' => 'success')); 
			}else{
				$msg = Yii::app()->session['errmsg_content'];
				echo json_encode(array('msg' => $msg));
				Yii::app()->session->remove('errmsg_content');
			}
		}
	}
//GOR--------------------------------------------------------------------------------------------------------------------------
	public function actionLoadreporttab() {
		$this->renderPartial('report-tab/index');
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionReportpermission() {
		$appid = 3;
		$StartDate=isset($_POST['StartDate'])?addslashes(trim($_POST['StartDate'])):'';
		$EndDate=isset($_POST['EndDate'])?addslashes(trim($_POST['EndDate'])):'';
		$Startdate1 = date("Y-m-d", strtotime(str_replace('/', '-',$StartDate))) ;
		$EndDate1 = date("Y-m-d", strtotime(str_replace('/', '-',$EndDate))) ;
		
		$sql="select a.id,a.ob_id,a.role_code,a.role_name,a.app_id,a.userid,a.request_by,a.appove_by,a.reg_code,a.app_name_th,a.request_date,a.create_date,b.ma_code,b.ma_name,b.le_code,b.le_name from trans_service_app a inner join role_level b on a.id=b.tran_service_app_id  where a.status_service_app =0  and a.app_id='".$appid."' and (DATE_FORMAT(a.create_date,'%Y-%m-%d') >= '$Startdate1' and DATE_FORMAT(a.create_date,'%Y-%m-%d') <= '$EndDate1' )";
		$Data1 =Yii::app()->db->createCommand($sql)->queryAll();
		
		$this->renderPartial('report-tab/tabletranservice',array('Data1' => $Data1,'Startdate1' => $Startdate1,'EndDate1' => $EndDate1));
	}
//------------------------------------------------------------------------------------------------------------------------------
//Module Role-------------------------------------------------------------------------------------------------------------------
	public function actionModalmodule(){
		$rol = $_POST["rol"];
		$name = $_POST["name"];
		$app = $_POST["app"];
		
		$runid = "";
		$data = MasGroleModLev::getnowver($rol);
		foreach($data as $dataitem){
			$runid = $dataitem['ver_no'];
		}
		if($runid == ""){
			$runid = 0;
		}else{
			$runid = $dataitem['ver_no'];
		}
		$this->renderPartial('grole-tab/modal-module',array('rol'=>$rol,'name'=>$name,'app'=>$app,'ver'=>$runid));
	}
}