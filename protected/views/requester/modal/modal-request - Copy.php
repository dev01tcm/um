<style>
	.modal-body {
		background-color: #FDFEFE;
	}
	
	.form-control {
		background-color: white;
	}
	
	.example-title {
		font-size: 23px;
	}
	
	input[type="text"], .btn, label, select, option {
		font-size: 23px;
	}
	
	.form-control[readonly] {
		background-color: #F8F9F9;
		color: black;
	}
	
	input[type="radio"] {
		display: none;
	}
	
	input[type="radio"] + *::before {
		content: "";
		display: inline-block;
		vertical-align: bottom;
		width: 25px;
		height: 25px;
		margin-right: 0.3rem;
		border-radius: 50%;
		border-style: solid;
		border-width: 0.1rem;
		border-color: black;
	}
	
	input[type="radio"]:checked + * {
		color: black;
	}
	
	input[type="radio"]:checked + *::before {
		background: radial-gradient(black 0%, black 40%, transparent 50%, transparent);
		border-color: black;
	}
	
	fieldset {
		margin: 20px;
		max-width: 400px;
	}
	
	input[type="radio"] + * {
		display: inline-block;
		padding: 0.5rem 1rem;
	}
	
	.img-app {
		object-fit: contain;
		height: 112px;
		width: 112px;
		cursor: pointer;
	}
</style>
<div class="modal-header">
	<button class="close" aria-label="Close" type="button" data-dismiss="modal">
		<span class="font-01 font-w" aria-hidden="true"><i class="fa fa-close"></i></span>
	</button> <?php
	if($req_id!=""){
		$datam1 = MasRequest::getdata($req_id);
		foreach($datam1 as $odata) { }
		$obj = $odata["ob_id"];
		$req_code = $odata["req_code"];
	}else{
		$obj = "";
		$req_code = "";
	}
		
	$qusg = new CDbCriteria( array(
		'condition' => "app_status like :app_status AND app_id = ".$app,     
		'params' => array(':app_status' => "1")  
	));
	$modelusg = MasApp::model()->findAll($qusg);
	$countusg = count($modelusg);
	$rowno = 0;
	foreach ($modelusg as $rows){
		$app_id = $rows->app_id;
		$app_img = $rows->app_img;
		$app_name_th = $rows->app_name_th;
		$app_shortname = $rows->app_shortname;
	} ?>
	<h2 class="modal-title font-01">ขอสิทธิระบบสารสนเทศ : <?php echo $app_shortname." ".$app_name_th; ?></h2>
</div>
<div class="modal-body font-03">
	<div class="row">
		<div class="col-md-12" style="padding-left:15px;">
			<div class="form-group col-sm-12" style="margin-bottom:10px;">
				<div class="text-center"> <?php
					if($rows->app_img == ""){ ?>
						<img class="img-app" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-image/menu2.png" alt=""> <?php
					}else{ ?>
						<img class="img-app" src="<?php echo Yii::app()->params['prg_ctrl']['url']['upload']."/thumbnail/".$app_img; ?>" alt=""> <?php
					} ?>
				</div>
			</div>
			<div class="form-group row text-center" style="margin-bottom:10px;">
				<h1 class="font-02" style="width:100%;margin-top:5px;">
					<label class="font-w" style="margin-bottom:10px;">แบบขอลงทะเบียนผู้ขอใช้บริการระบบสารสนเทศ</label></br>
					<label class="font-w" style="margin-bottom:10px;"><?php echo $app_name_th; ?></label>
				</h1>
			</div>
			<div class="form-group col-sm-12">
				<div class="row">
					<label class="col-sm-6 form-control-label text-left">
						<span style="color:#6610f2;">เลขที่ขอ : </span><a id="txtreq_code"><?php echo $app_shortname; ?>-<a id="txtid"></a></a>
					</label>
					<label class="col-sm-6 form-control-label text-right">
						<span style="color:#6610f2;">วันที่ขอสิทธิ : </span><?php echo Yii::app()->CommonFnc->DateThai(date("Y-m-d H:i:s"),false); ?>
					</label>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
											<label class="font-w">รายละเอียดผู้ขอ</label>
										</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" >
									<div class="panel-body"> <?php
										$data=MasRequest::getUserid(Yii::app()->user->id);
										foreach($data as $dataitem) { } ?>
										<div class="form-group" style="margin-bottom:10px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">วัน/เดือน/ปี เกิด </label>
											<div class="col-sm-8">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo Yii::app()->CommonFnc->DateThai($dataitem["em_birthday"],false); ?>" readonly="readonly">
											</div>
										</div>
										<div class="form-group" style="margin-bottom:10px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">เลขที่บัตรประชาชน </label>
											<div class="col-sm-8">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem["em_citizen_id"]; ?>" readonly="readonly">
											</div>
										</div>
										<div class="form-group" style="margin-bottom:10px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">ชื่อ-นามสกุล ไทย</label>
											<div class="col-sm-4">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem["em_name_th"]; ?>" readonly="readonly">
											</div>
											<div class="col-sm-4">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem["em_surname_th"] ;?>" readonly="readonly">
											</div>
										</div>
										<div class="form-group" style="margin-bottom:10px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">ชื่อ-นามสกุล อังกฤษ</label>
											<div class="col-sm-4">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem["em_name_en"]; ?>" readonly="readonly">
											</div>
											<div class="col-sm-4">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem["em_surname_en"] ;?>" readonly="readonly">
											</div>
										</div>
										<div class="form-group" style="margin-bottom:10px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">ตำแหน่งงาน / ระดับ</label>
											<div class="col-sm-4">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem["PositNameTH"] ;?>" readonly="readonly">
											</div>
											<div class="col-sm-4">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem["PositLevelNameTH"] ;?>" readonly="readonly">
											</div>
										</div>
										<div class="form-group" style="margin-bottom:10px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">สังกัด</label>
											<div class="col-sm-8">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem["DeptID"] ;?> / <?php echo $dataitem["DeptNameTH"] ;?>" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseTwo" aria-expanded="false">
											<label class="font-w">วัตถุประสงค์</label>
										</a>
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse in" aria-expanded="false">
									<div class="panel-body" style="background-color:#F2F3F4;">
										<div class="form-group" style="margin-bottom:10px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">วัตถุประสงค์ </label>
											<div class="col-sm-8"> <?php
												$qusg = new CDbCriteria( array(
													'condition' => "ob_status like :ob_status",         
													'params' => array(':ob_status' => "1",)  
												));
												$modelusg = MasObjective::model()->findAll($qusg);
												$countusg = count($modelusg);
												$rowno = 0;
												$ck = "";
												foreach ($modelusg as $rows){
													$ob_id = $rows->ob_id; 
													$ob_name = $rows->ob_name;
													$createby = $rows->createby;
													$createdate = $rows->createdate;
													$updateby = $rows->updateby;
													$updatedate = $rows->updatedate;
													if($obj == ""){
														if($rowno == 0){ $ck = "checked"; }else{ $ck = ""; }
													}else{
														if($obj == $ob_id){ $ck = "checked"; }else{ $ck = ""; }
													} ?>
													<div class="col-sm-10">
														<input name="radioobj" id="radobj<?php echo $ob_id; ?>" type="radio" data-id="<?php echo $ob_id; ?>" value="<?php echo $ob_id; ?>" <?php echo $ck; ?>>
														<label for="radobj<?php echo $ob_id; ?>"><?php echo $ob_name; ?></label>
													</div> <?php
													$rowno++;
												} ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default" id="e-form">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree" aria-expanded="true">
											<label class="font-w">โปรดเลือกสิทธิการใช้งาน</label>
										</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse" aria-expanded="true" style="">
									<div class="panel-body" style="background-color:#F2F3F4;"> <?php
										$masterdata = MasRequest::getmodule($app,$dataitem["um_position_id"],$dataitem["mas_position_le_id"],$dataitem["DeptID"]);
										foreach ($masterdata as $dataitem1) {
											$datam2 = MasRequest::getdatamod($req_code,$dataitem1["ma_id"]);
											$i2 = 0;
											$ck2 = "";
											$oconrol_id = "";
											foreach($datam2 as $odata2) { $oconrol_id = $odata2["ra_id"]; } ?>
											<div class="form-group row" style="background-color: white; margin-bottom:10px;width:100%; border:.5px solid #ddd; padding-bottom:10px">
												<label class="col-sm-3 form-control-label text-left font-w"><?php echo $dataitem1["ma_name"]; ?></label>
												<div class="col-sm-9" style="padding-top: 10px;">
													<select class="form-control form-control-lg font-03" id="rol<?php echo $dataitem1["ma_id"]; ?>" onchange="_showconrole(<?php echo $dataitem1["ma_id"]; ?>)" data-id="<?php echo $dataitem1["ma_id"]; ?>" data-type="select" data-field="ra_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-lab="<?php echo $dataitem1["ma_name"]; ?>">
														<option value="0" data-ra_id="0">-- กรุณาเลือกสิทธิ --</option> <?php
														$datarole = MasRequest::getrole($dataitem1["ma_id"],$dataitem["um_position_id"],$dataitem["mas_position_le_id"],$dataitem["DeptID"]);
														foreach ($datarole as $dataitem2) {
															if($dataitem2["ra_default"] == 1){ $ck2 = "selected"; }else{ $ck2 = ""; }
															if($req_code!=""){ if($dataitem2["ra_id"] == $oconrol_id){ $ck2 = "selected"; }else{ $ck2 = ""; } } ?>
															<option value="<?php echo $dataitem2["id"]; ?>" data-ra_id="<?php echo $dataitem2["ra_id"]; ?>" <?php echo $ck2; ?>><?php echo $dataitem2["ra_name"]; ?></option> <?php
														} ?>
													</select>
													<div class="rolecontrol<?php echo $dataitem1["ma_id"]; ?>" style="background-color:#F2F3F4; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
													</div> <?php
													$conmoddata = MasRequest::getcontrolmod($dataitem1["ma_id"]);
													$i = 0;
													$m = 0;
													foreach ($conmoddata as $dataitem4) {
														$datam3 = MasRequest::getconmod($req_code,$dataitem1["ma_id"],$dataitem4["ct_id"]);
														$omodform_value = "";
														foreach($datam3 as $odata3) { $omodform_value = $odata3["form_value"]; }
														if($i==0){ echo "<hr style='margin: 20px 0;'>"; } ?>
														<div class="form-group row" style="margin-bottom:10px;width:100%;"><?php
															if($dataitem4["ct_type"] == "textbox"){ ?>
																<label class="col-sm-4 form-control-label text-left" style="padding-left:10px"><?php echo $dataitem4["ct_name"]; ?><span style="color: red; font-weight:10px"><?php if($dataitem4["ct_check"]==1){ echo " ***"; } ?></span></label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" id="tmodcon<?php echo $dataitem4["ct_id"]; ?>" data-id="<?php echo $dataitem4["ct_id"]; ?>" data-type="text" data-field="m_ct_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-check="<?php echo $dataitem4["ct_check"]; ?>" data-lab="<?php echo $dataitem4["ct_name"]; ?>" value="<?php echo $omodform_value; ?>"></input>
																</div> <?php
															}else if($dataitem4["ct_type"] == "textarea"){ ?>
																<label class="col-sm-4 form-control-label text-left" style="padding-left:10px"><?php echo $dataitem4["ct_name"]; ?><span style="color: red; font-weight:10px"><?php if($dataitem4["ct_check"]==1){ echo " ***"; } ?></span></label>
																<div class="col-sm-8">
																	<textarea class="form-control" id="tamodcon<?php echo $dataitem4["ct_id"]; ?>" rows="3" data-id="<?php echo $dataitem4["ct_id"]; ?>" data-type="textarea" data-field="m_ct_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-check="<?php echo $dataitem4["ct_check"]; ?>" data-lab="<?php echo $dataitem4["ct_name"]; ?>"><?php echo $omodform_value; ?></textarea>
																</div> <?php
															}else if($dataitem4["ct_type"] == "option"){ ?>
																<label class="col-sm-4 form-control-label text-left" style="padding-left:10px"></label> 
																<div class="col-sm-8"> <?php
																	if($m == 0){ $ck3 = "checked"; }else{ $ck3 = ""; }
																	if($omodform_value != ""){ if($omodform_value == "true"){ $ck3 = "checked"; }else{ $ck3 = ""; } } ?>
																	<input name="radiomodcon<?php echo $dataitem1["ma_id"]; ?>" id="radmodcon<?php echo $dataitem4["ct_id"]; ?>" type="radio" name="radappcon<?php echo $dataitem4["ct_id"]; ?>" data-id="<?php echo $dataitem4["ct_id"]; ?>" <?php echo $ck3; ?> data-type="option" data-field="m_ct_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-check="<?php echo $dataitem4["ct_check"]; ?>" data-lab="<?php echo $dataitem4["ct_name"]; ?>">
																	<label for="radmodcon<?php echo $dataitem4["ct_id"]; ?>">&nbsp;<?php echo $dataitem4["ct_name"]; ?></label>
																</div> <?php
																$m++;
															}else if($dataitem4["ct_type"] == "label"){ ?>
																<input type="hidden" id="tmodcon<?php echo $dataitem4["ct_id"]; ?>" data-id="<?php echo $dataitem4["ct_id"]; ?>" data-type="label" data-field="m_ct_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-check="<?php echo $dataitem4["ct_check"]; ?>" data-lab="<?php echo $dataitem4["ct_name"]; ?>" value="<?php echo $dataitem4["ct_name"]; ?>"></input>
																<label class="col-sm-8 form-control-label text-left"><?php echo $dataitem4["ct_name"]; ?></label> <?php
															} ?>
														</div> <?php
														$i++;
													} ?>
												</div>
											</div> 
											<script type="text/javascript">
												$(function() {
													var req_code = '<?php echo $req_code; ?>';
													if( req_code == ""){
														var rol_id = $("#rol"+<?php echo $dataitem1["ma_id"]; ?>+" option:selected").attr('data-ra_id');
														$.ajax({
															type: "POST",
															url:"<?php echo Yii::app()->createAbsoluteUrl("requester/getconrole"); ?>",
															data: {
																'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
																'rol_id':rol_id,
															},
															dataType: "json",
															success: function (data) {
																var cinput = "";
																var i;
																var j=0;
																for (i = 0; i < data.datarol.length; i++) {
																	if(i==0){ cinput += "<div style='background-color:#F2F3F4; padding:5px'></div>"; }
																	var mk = "";
																	if(data.datarol[i].ct_check==1){ mk = " ***"; }
																	if(data.datarol[i].ct_type == "textbox"){
																		cinput += '<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px"><label class="col-sm-4 form-control-label text-left">'+data.datarol[i].ct_name+'<span style="color: red; font-weight:10px">'+mk+'</span></label>';
																		cinput += '<div class="col-sm-8"><input type="text" class="form-control" id="trolcon'+<?php echo $dataitem1["ma_id"]; ?>+data.datarol[i].ct_id+'" data-id="'+data.datarol[i].ct_id+'" data-type="text" data-field="r_ct_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-check="'+data.datarol[i].ct_check+'" data-lab="'+data.datarol[i].ct_name+'"></input></div>';
																	}else if(data.datarol[i].ct_type == "textarea"){
																		cinput += '<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px"><label class="col-sm-4 form-control-label text-left">'+data.datarol[i].ct_name+'<span style="color: red; font-weight:10px">'+mk+'</span></label>';
																		cinput += '<div class="col-sm-8"><textarea class="form-control" id="tarolcon'+<?php echo $dataitem1["ma_id"]; ?>+data.datarol[i].ct_id+'" rows="3" data-id="'+data.datarol[i].ct_id+'" data-type="textarea" data-field="r_ct_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-check="'+data.datarol[i].ct_check+'" data-lab="'+data.datarol[i].ct_name+'"></textarea></div>';
																	}else if(data.datarol[i].ct_type == "option"){
																		var ch = "";
																		if(j == 0){ ch = "checked"; }
																		cinput += '<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px"><label class="col-sm-4 form-control-label text-left"></label>';
																		cinput += '<div class="col-sm-8"><input name="radiorolcon'+<?php echo $dataitem1["ma_id"]; ?>+'" id="radrolcon'+<?php echo $dataitem1["ma_id"]; ?>+data.datarol[i].ct_id+'" type="radio" name="radappcon'+data.datarol[i].ct_id+'" data-id="'+data.datarol[i].ct_id+'" '+ch+' data-type="option" data-field="r_ct_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-check="'+data.datarol[i].ct_check+'" data-lab="'+data.datarol[i].ct_name+'">';
																		cinput += '<label for="radrolcon'+<?php echo $dataitem1["ma_id"]; ?>+data.datarol[i].ct_id+'">&nbsp;'+data.datarol[i].ct_name+'</label></div>';
																		j++;
																	}else if(data.datarol[i].ct_type == "label"){
																		cinput += '<input type="hidden" id="trolcon'+<?php echo $dataitem1["ma_id"]; ?>+data.datarol[i].ct_id+'" data-id="'+data.datarol[i].ct_id+'" data-type="label" data-field="r_ct_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-check="'+data.datarol[i].ct_check+'" data-lab="'+data.datarol[i].ct_name+'" value="'+data.datarol[i].ct_name+'"></input>';
																		cinput += '<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px"><label class="col-sm-8 form-control-label text-left">'+data.datarol[i].ct_name+'</label>';
																	}
																	cinput += '</div>';
																	$('.rolecontrol<?php echo $dataitem1["ma_id"]; ?>').empty();
																	$('.rolecontrol<?php echo $dataitem1["ma_id"]; ?>').html(cinput);
																}
															}
														});
													}else{
														var rol_id = $("#rol"+<?php echo $dataitem1["ma_id"]; ?>+" option:selected").attr('data-ra_id');
														$.ajax({
															type: "POST",
															url:"<?php echo Yii::app()->createAbsoluteUrl("requester/getoconrole"); ?>",
															data: {
																'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
																'req_code':req_code,
																'mod_id':'<?php echo $dataitem1["ma_id"]; ?>',
															},
															dataType: "json",
															success: function (data) {
																var cinput2 = "";
																var i2;
																for (i2 = 0; i2 < data.datarol2.length; i2++) {
																	if(i2==0){ cinput2 += "<div style='background-color:#F2F3F4; padding:5px'></div>"; }
																	var mk = "";
																	if(data.datarol2[i2].ct_check==1){ mk = " ***"; }
																	if(data.datarol2[i2].form_type == "text"){
																		cinput2 += '<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px"><label class="col-sm-4 form-control-label text-left">'+data.datarol2[i2].ct_name+'<span style="color: red; font-weight:10px">'+mk+'</span></label>';
																		cinput2 += '<div class="col-sm-8"><input type="text" class="form-control" id="trolcon'+<?php echo $dataitem1["ma_id"]; ?>+data.datarol2[i2].r_ct_id+'" data-id="'+data.datarol2[i2].r_ct_id+'" data-type="text" data-field="r_ct_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-check="'+data.datarol2[i2].ct_check+'" data-lab="'+data.datarol2[i2].ct_name+'" value="'+data.datarol2[i2].form_value+'"></input></div>';
																	}else if(data.datarol2[i2].form_type == "textarea"){
																		cinput2 += '<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px"><label class="col-sm-4 form-control-label text-left">'+data.datarol2[i2].ct_name+'<span style="color: red; font-weight:10px">'+mk+'</span></label>';
																		cinput2 += '<div class="col-sm-8"><textarea class="form-control" id="tarolcon'+<?php echo $dataitem1["ma_id"]; ?>+data.datarol2[i2].r_ct_id+'" rows="3" data-id="'+data.datarol2[i2].r_ct_id+'" data-type="textarea" data-field="r_ct_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-check="'+data.datarol2[i2].ct_check+'" data-lab="'+data.datarol2[i2].ct_name+'">'+data.datarol2[i2].form_value+'</textarea></div>';
																	}else if(data.datarol2[i2].form_type == "option"){
																		var ch = "";
																		if(data.datarol2[i2].form_value == "true"){ ch = "checked"; }else{ ch = ""; }
																		cinput2 += '<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px"><label class="col-sm-4 form-control-label text-left"></label>';
																		cinput2 += '<div class="col-sm-8"><input name="radiorolcon'+<?php echo $dataitem1["ma_id"]; ?>+'" id="radrolcon'+<?php echo $dataitem1["ma_id"]; ?>+data.datarol2[i2].r_ct_id+'" type="radio" name="radappcon'+data.datarol2[i2].r_ct_id+'" data-id="'+data.datarol2[i2].r_ct_id+'" '+ch+' data-type="option" data-field="r_ct_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-check="'+data.datarol2[i2].ct_check+'" data-lab="'+data.datarol2[i2].ct_name+'">';
																		cinput2 += '<label for="radrolcon'+<?php echo $dataitem1["ma_id"]; ?>+data.datarol2[i2].r_ct_id+'">&nbsp;'+data.datarol2[i2].ct_name+'</label></div>';
																	}else if(data.datarol2[i2].ct_type == "label"){
																		cinput2 += '<input type="hidden" id="trolcon'+<?php echo $dataitem1["ma_id"]; ?>+data.datarol2[i2].r_ct_id+'" data-id="'+data.datarol2[i2].r_ct_id+'" data-type="label" data-field="r_ct_id" data-mod="<?php echo $dataitem1["ma_id"]; ?>" data-check="'+data.datarol2[i2].ct_check+'" data-lab="'+data.datarol2[i2].ct_name+'" value="'+data.datarol2[i2].ct_name+'"></input>';
																		cinput2 += '<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px"><label class="col-sm-8 form-control-label text-left">'+data.datarol2[i2].ct_name+'</label>';
																	}
																	cinput2 += '</div>';
																	$('.rolecontrol<?php echo $dataitem1["ma_id"]; ?>').empty();
																	$('.rolecontrol<?php echo $dataitem1["ma_id"]; ?>').html(cinput2);
																}
															}
														});
													}
												});
											</script> <?php
										}
										$controldata = MasRequest::getcontrol($app);
										$a = 0;
										foreach ($controldata as $dataitem3) {
											$datam4 = MasRequest::getconapp($req_code,$dataitem3["ct_id"]);
											$oappform_value = "";
											foreach($datam4 as $odata4) { $oappform_value = $odata4["form_value"]; } ?>
											<div class="form-group row" style="margin-bottom:10px;width:100%;"> <?php
												if($dataitem3["ct_type"] == "textbox"){ ?>
													<label class="col-sm-4 form-control-label text-left"><?php echo $dataitem3["ct_name"]; ?><span style="color: red; font-weight:10px"><?php if($dataitem3["ct_check"]==1){ echo " ***"; } ?></span></label> 
													<div class="col-sm-8">
														<input type="text" class="form-control" id="tappcon<?php echo $dataitem3["ct_id"]; ?>" data-id="<?php echo $dataitem3["ct_id"]; ?>" data-type="text" data-field="a_ct_id" data-mod="0" data-check="<?php echo $dataitem3["ct_check"]; ?>" data-lab="<?php echo $dataitem3["ct_name"]; ?>" value="<?php echo $oappform_value; ?>"></input>
													</div> <?php
												}else if($dataitem3["ct_type"] == "textarea"){ ?>
													<label class="col-sm-4 form-control-label text-left"><?php echo $dataitem3["ct_name"]; ?><span style="color: red; font-weight:10px"><?php if($dataitem3["ct_check"]==1){ echo " ***"; } ?></span></label> 
													<div class="col-sm-8">
														<textarea class="form-control" id="taappcon<?php echo $dataitem3["ct_id"]; ?>" rows="3" data-id="<?php echo $dataitem3["ct_id"]; ?>" data-type="textarea" data-field="a_ct_id" data-mod="0" data-check="<?php echo $dataitem3["ct_check"]; ?>" data-lab="<?php echo $dataitem3["ct_name"]; ?>"><?php echo $oappform_value; ?></textarea>
													</div> <?php
												}else if($dataitem3["ct_type"] == "option"){ ?>
													<label class="col-sm-4 form-control-label text-left"></label> 
													<div class="col-sm-8"> <?php
														if($a == 0){ $ck4 = "checked"; }else{ $ck4 = ""; }
														if($oappform_value != ""){ if($oappform_value == "true"){ $ck4 = "checked"; }else{ $ck4 = ""; } } ?>
														<input name="radioappcon" id="radappcon<?php echo $dataitem3["ct_id"]; ?>" type="radio" name="radappcon<?php echo $dataitem3["ct_id"]; ?>" data-id="<?php echo $dataitem3["ct_id"]; ?>" <?php echo $ck4; ?> data-type="option" data-field="a_ct_id" data-mod="0" data-check="<?php echo $dataitem3["ct_check"]; ?>" data-lab="<?php echo $dataitem3["ct_name"]; ?>">
														<label for="radappcon<?php echo $dataitem3["ct_id"]; ?>">&nbsp;<?php echo $dataitem3["ct_name"]; ?></label>
													</div> <?php
													$a++;
												}else if($dataitem3["ct_type"] == "label"){ ?>
													<input type="hidden" id="tappcon<?php echo $dataitem3["ct_id"]; ?>" data-id="<?php echo $dataitem3["ct_id"]; ?>" data-type="label" data-field="a_ct_id" data-mod="0" data-check="<?php echo $dataitem3["ct_check"]; ?>" data-lab="<?php echo $dataitem3["ct_name"]; ?>" value="<?php echo $dataitem3["ct_name"]; ?>"></input>
													<label class="col-sm-8 form-control-label text-left"><?php echo $dataitem3["ct_name"]; ?></label> <?php
												} ?>
											</div> <?php
										} ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button class="btn btn-danger font-03 font-w" type="button" data-dismiss="modal">ยกเลิก</button>
	<button class="btn btn-primary font-03 btn-submit" type="button" onClick="savedata()"><i class="fa fa-save" aria-hidden="true"></i> บันทึก</button>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(function() {
			$.ajax({
				type: "POST",
				url:"<?php echo Yii::app()->createAbsoluteUrl("requester/getrunid"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':<?php echo $app_id; ?>,
				},
				dataType: "json",
				success: function (data) {
					data.runid++;
					var rid = <?php echo date("Y"); ?>+"-"+padLeft(data.runid,5);
					$("#txtid").empty();
					$("#txtid").html(rid);
				}
			});
		});
		
		$(function() {
			var obj = $('input[name=radioobj]:checked').val();
			if(obj != "3"){
				$("#e-form").removeAttr('style');
			}else{
				$("#e-form").css("display","none");
			}
		});
	});
	
	$('input[name=radioobj]').click(function(){
		var obj = $('input[name=radioobj]:checked').val();
		if(obj != "3"){
			$("#e-form").removeAttr('style');
		}else{
			$("#e-form").css("display","none");
		}
	});

	function savedata(){
		$('.btn-submit').attr('disabled',true);
		var oreq_status = '<?php echo $req_status; ?>';
		if(oreq_status == 1){
			var oreq_code = '<?php echo $req_code; ?>';
		}else{
			var oreq_code = "";
		}
		var req_code = $("#txtreq_code").html()+$("#txtid").html();
		var app = <?php echo $app; ?>;
		var obj = $('input[name=radioobj]:checked').val();
		
		if(obj){
		}else{
			swal({
				title: "ไม่พบข้อมูลวัตถุประสงค์",
				text: "กรุณาตรวจสอบความถูกต้องอีกครั้ง",
				type: "warning",
				confirmButtonColor: "#00E5DA",
				confirmButtonText: "ปิด"
			});
			return;
		}
		
		var id_array = new Array();
		var mod_array = new Array();
		var type_array = new Array();
		var lab_array = new Array();
		var check_array = new Array();
		var value_array = new Array();
		var field_array = new Array();
		
		$.each($("#e-form input,#e-form select,#e-form textarea"), function(){
			id_array.push($(this).attr("data-id"));
			mod_array.push($(this).attr("data-mod"));
			type_array.push($(this).attr("data-type"));
			field_array.push($(this).attr("data-field"));
			lab_array.push($(this).attr("data-lab"));
			check_array.push($(this).attr("data-check"));
			if($(this).attr("data-type") == "text"){
				value_array.push($(this).val());
			}else if($(this).attr("data-type") == "textarea"){
				value_array.push($(this).val());
			}else if($(this).attr("data-type") == "select"){
				value_array.push($(this).children("option:selected").val());
			}else if($(this).attr("data-type") == "option"){
				value_array.push($(this).is(":checked"));
			}else{
				value_array.push($(this).val());
			}
		});
		console.log(id_array.length);
		console.log(mod_array.length);
		console.log(type_array.length);
		console.log(lab_array.length);
		console.log(check_array);
		console.log(value_array);
		console.log(field_array.length);
		var ii;
		for (ii = 0; ii < id_array.length; ii++) {
			if(obj != "3"){
				if(type_array[ii] == "text" || type_array[ii] == "textarea"){
					if(check_array[ii] == "1"){
						if(value_array[ii] == ""){
							swal({
								title: "ทำรายการไม่สำเร็จ",
								text: "กรุณาระบุ "+lab_array[ii],
								type: "warning",
								confirmButtonColor: "#00E5DA",
								confirmButtonText: "ปิด"
							});
							$('.btn-submit').removeAttr('disabled');
							return;
						}
					}
				}
			}
			ii++;
		}
		
		
		$.ajax({
			url:"<?php echo Yii::app()->createAbsoluteUrl("requester/saveform"); ?>",
			method:"POST",
			data:{
				oreq_code   : oreq_code,
				req_code    : req_code,
				app         : app,
				obj         : obj,
				id_array    : id_array,
				mod_array   : mod_array,
				type_array  : type_array,
				value_array : value_array,
				field_array : field_array,
				YII_CSRF_TOKEN:'<?php echo Yii::app()->request->csrfToken; ?>',
			},
			success: function (data) {
				$(".load-lg-modal").modal('hide');
				$(".load-lg-content").empty();
				swal({
					title: "ทำรายการสำเร็จ",
					text: "บันทึกข้อมูลเรียบร้อย",
					type: "success",
					confirmButtonColor: "#0064b3",
					confirmButtonText: "ปิด",
					closeOnConfirm: true
				},
				function(){
					$.ajax({
						type: "POST",
						url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadrequester"); ?>",
						data: {
							'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
							'status':"1",
						},
						success: function (data) {
							$('.btnrq').removeClass('sel');
							$('#showreq').empty();
							$('#showreq').html(data);
							$.ajax({
								type: "POST",
								url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadapplist"); ?>",
								data: {
									'YII_CSRF_TOKEN' : '<?php echo Yii::app()->request->csrfToken; ?>',
									'st' : 1,
								},
								success: function (data) {
									$('.showapp').empty();
									$('.showapp').html(data);
									$('.btnst').removeClass('sel');
									$('.warning').addClass("sel");
								},
								error: function (data){
									console.log(data);
								}
							});
						},
						error: function (data){
							console.log(data);
						}
					}); 
				});
			}
		});
	}
	
	function padLeft(nr, n, str){
		return Array(n-String(nr).length+1).join(str||'0')+nr;
	}
	
	function _showconrole(id) {
		var rol_id = $("#rol"+id+" option:selected").attr('data-ra_id');
		$.ajax({
			type: "POST",
			url:"<?php echo Yii::app()->createAbsoluteUrl("requester/getconrole"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'rol_id':rol_id,
			},
			dataType: "json",
			success: function (data) {
				var cinput = "";
				var i;
				var j = 0;
				for (i = 0; i < data.datarol.length; i++) {
					if(i==0){ cinput += "<div style='background-color:#F2F3F4; padding:5px'></div>" }
					var mk = "";
					if(data.datarol[i].ct_check==1){ mk = " ***"; }
					if(data.datarol[i].ct_type == "textbox"){
						cinput += '<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px"><label class="col-sm-4 form-control-label text-left">'+data.datarol[i].ct_name+'<span style="color: red; font-weight:10px">'+mk+'</span></label>';
						cinput += '<div class="col-sm-8"><input type="text" class="form-control" id="trolcon'+id+data.datarol[i].ct_id+'" data-id="'+data.datarol[i].ct_id+'" data-type="text" data-field="r_ct_id" data-mod="'+id+'" data-check="'+data.datarol[i].ct_check+'"></input></div>';
					}else if(data.datarol[i].ct_type == "textarea"){
						cinput += '<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px"><label class="col-sm-4 form-control-label text-left">'+data.datarol[i].ct_name+'<span style="color: red; font-weight:10px">'+mk+'</span></label>';
						cinput += '<div class="col-sm-8"><textarea class="form-control" id="tarolcon'+id+data.datarol[i].ct_id+'" rows="3" data-id="'+data.datarol[i].ct_id+'" data-type="textarea" data-field="r_ct_id" data-mod="'+id+'" data-check="'+data.datarol[i].ct_check+'"></textarea></div>';
					}else if(data.datarol[i].ct_type == "option"){
						var ch = "";
						if(j == 0){ ch = "checked"; }
						cinput += '<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px"><label class="col-sm-4 form-control-label text-left"></label>';
						cinput += '<div class="col-sm-8"><input name="radiorolcon'+id+'" id="radrolcon'+id+data.datarol[i].ct_id+'" type="radio" name="radappcon'+data.datarol[i].ct_id+'" data-id="'+data.datarol[i].ct_id+'" '+ch+' data-type="option" data-field="r_ct_id" data-mod="'+id+'" data-check="'+data.datarol[i].ct_check+'">';
						cinput += '<label for="radrolcon'+id+data.datarol[i].ct_id+'">'+data.datarol[i].ct_name+'</label></div>';
						j++;
					}else if(data.datarol[i].ct_type == "label"){
						cinput += '<input type="hidden" id="trolcon'+id+data.datarol[i].ct_id+'" data-id="'+data.datarol[i].ct_id+'" data-type="label" data-field="r_ct_id" data-mod="'+id+'" data-check="'+data.datarol[i].ct_check+'" value="'+data.datarol[i].ct_name+'"></input>';
						cinput += '<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px"><label class="col-sm-8 form-control-label text-left">'+data.datarol[i].ct_name+'</label>';
					}
					cinput += '</div>';
				}
				$('.rolecontrol'+id).empty();
				$('.rolecontrol'+id).html(cinput);
			}
		});
	}
</script>