<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/icheck-material.min.css">
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
		$otype = $odata["req_type"];
		$otype_val = $odata["req_type_val"];
	}else{
		$obj = "";
		$req_code = "";
		$otype = "";
		$otype_val = "";
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
						<img class="img-app" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-image/noimg.png" alt=""> <?php
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
										<!--div class="form-group" style="margin-bottom:10px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">วัน/เดือน/ปี เกิด</label>
											<div class="col-sm-8">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo Yii::app()->CommonFnc->DateThai($dataitem["em_birthday"],false); ?>" readonly="readonly">
											</div>
										</div>
										<div class="form-group" style="margin-bottom:10px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">เลขที่บัตรประชาชน</label>
											<div class="col-sm-8">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem["em_citizen_id"]; ?>" readonly="readonly">
											</div>
										</div-->
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
														<div class="icheck-material-indigo">
															<input name="radioobj" id="radobj<?php echo $ob_id; ?>" type="radio" data-id="<?php echo $ob_id; ?>" value="<?php echo $ob_id; ?>" <?php echo $ck; ?>>
															<label for="radobj<?php echo $ob_id; ?>"><?php echo $ob_name; ?></label>
														</div>
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
									<div class="panel-body" style="background-color:#F2F3F4;">
										<div class="tab-content" id="myTabContent">
											<div class="tab-pane active" id="test" role="tabpanel" aria-labelledby="test-tab">
												<div class="load-mr-tab">
													<div class="icheck-material-indigo">
														<input name="radiotype" id="ratype1" type="radio" value="1" checked>
														<label for="ratype1" class="col-sm-3 form-control-label text-left font-w">ระดับ</label>
														<div class="col-sm-9" style="padding-top: -30px;">
															<select class="form-control form-control-lg font-03" id="txtlevel">
																<option value="0" data-ra_id="0">-- กรุณาเลือกระดับ --</option> <?php
																$qusg = new CDbCriteria( array(
																	  'condition' => "StatusData like :StatusData ",         
																	  'params'    => array(':StatusData' => "1")  
																));
																$modelusg = MasPositionLe::model()->findAll($qusg);
																$countusg = count($modelusg);
																$rowno = 1;
																foreach ($modelusg as $rows){
																	$PositLevelID = $rows->PositLevelID; 
																	$PositLevelNameTH = $rows->PositLevelNameTH;
																	$CreateBy = $rows->CreateBy;
																	$CreateDate = $rows->CreateDate;
																	$UpdateBy = $rows->UpdateBy;
																	$UpdateDate = $rows->UpdateDate;
																	$PositLevelNameEN = $rows->PositLevelNameEN;
																	$StatusData = $rows->StatusData;
																	
																	if($req_code!=""){
																		if($otype == 1){ 
																			if($PositLevelID == $otype_val){ 
																				$ck2 = "selected";
																			}else{ 
																				$ck2 = ""; 
																			} 
																		}else{
																			$ck2 = ""; 
																		}
																	}else{ 
																		if($PositLevelID == Yii::app()->session['mas_position_le_id']){ 
																			$ck2 = "selected"; 
																		}else{ 
																			$ck2 = ""; 
																		}
																	} ?>
																	<option value="<?php echo $PositLevelID; ?>" data-le_id="<?php echo $PositLevelID; ?>" <?php echo $ck2; ?>><?php echo $PositLevelNameTH; ?></option> <?php
																	$rowno += 1;
																} ?>
															</select>
														</div>
														</div><div style="padding-top:10px"></div>
														<hr style='margin: 20px 0;'>
														<div class="icheck-material-indigo">
															<input name="radiotype" id="ratype2" type="radio" value="2">
															<label for="ratype2" class="col-sm-3 form-control-label text-left font-w">Role</label>
															<div class="col-sm-9" style="padding-top: -30px;">
																<select class="form-control form-control-lg font-03" id="txtrole">
																	<option value="0" data-ra_id="0">-- กรุณาเลือก Role --</option><?php
																	$qusg = new CDbCriteria( array(
																		'condition' => "app_id = :app_id and status like :status ",         
																		'params' => array(':status' => "1",':app_id' => $app)
																	));
																	$modelusg = MasGRole::model()->findAll($qusg);
																	$countusg = count($modelusg);
																	$rowno = 1;
																	foreach ($modelusg as $rows){
																		$ra_id = $rows->ra_id;
																		$ra_code = $rows->ra_code;
																		$ra_name = $rows->ra_name;
																		
																		if($req_code!=""){
																			if($otype == 2){ 
																				if($ra_id == $otype_val){ 
																					$ck2 = "selected";
																				}else{ 
																					$ck2 = ""; 
																				} 
																			}else{
																				$ck2 = ""; 
																			}
																		}else{ 
																			$ck2 = "";
																		} ?>
																		<option value="<?php echo $ra_id; ?>" data-ra_id="<?php echo $ra_id; ?>" <?php echo $ck2; ?>><?php echo $ra_name; ?></option> <?php
																		$rowno++;
																	} ?>
																</select>
															</div>
														</div><div style="padding-top:10px"></div>
														<hr style='margin: 20px 0;'>
														<div class="icheck-material-indigo">
															<input name="radiotype" id="ratype3" type="radio" value="3">
															<label for="ratype3">Custom</label>
														</div>
														<div style="padding-top:10px"></div>
														<div class="custom-panel">
														</div>
													</div>
													<script type="text/javascript">
														$(document).ready(function() {
															var type = '<?php echo $otype; ?>';
															if(type == 1){
																$("input:radio[name='radiotype']").filter("[value='1']").attr("checked", true);
																$("#txtlevel").removeAttr("disabled");
																$("#txtrole").attr("disabled", "true");
																$(".custom-select").attr("disabled", "true");
															}else if(type == 2){
																$("input:radio[name='radiotype']").filter("[value='2']").attr("checked", true);
																$("#txtlevel").attr("disabled", "true");
																$("#txtrole").removeAttr("disabled");
																$(".custom-select").attr("disabled", "true");
															}else if(type == 3){
																$("input:radio[name='radiotype']").filter("[value='3']").attr("checked", true);
																$("#txtlevel").attr("disabled", "true");
																$("#txtrole").attr("disabled", "true");
																$(".custom-select").removeAttr("disabled");
															}else{
																$("input:radio[name='radiotype']").filter("[value='1']").attr("checked", true);
																$("#txtlevel").removeAttr("disabled");
																$("#txtrole").attr("disabled", "true");
																$(".custom-select").attr("disabled", "true");
															}
														});
														$('#ratype1').click(function(){
															$("#txtlevel").removeAttr("disabled");
															$("#txtrole").attr("disabled", "true");
															$(".custom-select").attr("disabled", "true");
															
															$.ajax({
																type: "POST",
																url: "<?php echo Yii::app()->createAbsoluteUrl("requester/getrelaposition"); ?>",
																data: {
																	'YII_CSRF_TOKEN' : '<?php echo Yii::app()->request->csrfToken; ?>',
																	'posi'           : $('#txtlevel').val(),
																},
																success: function (data) {
																	var obj = JSON.parse(data);
																	
																	if(obj["rol_id"]!=""){
																		$.ajax({
																			type: "POST",
																			url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadcustom"); ?>",
																			data: {
																				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
																				'rol'      : obj["rol_id"],
																				'req_code' : '<?php echo $req_code; ?>',
																			},
																			success: function (data) {
																				$('.custom-panel').empty();
																				$('.custom-panel').html(data);
																				
																				$("#txtlevel").removeAttr("disabled");
																				$("#txtrole").attr("disabled", "true");
																				$(".custom-select").attr("disabled", "true");
																			},
																			error: function (data){
																				console.log(data);
																			}
																		});
																	}else{
																		$('.custom-panel').empty();
																	}
																},
																error: function (data){
																	console.log(data);
																}
															});
														});
														$('#ratype2').click(function(){
															$("#txtlevel").attr("disabled", "true");
															$("#txtrole").removeAttr("disabled");
															$(".custom-select").attr("disabled", "true");
															
															$.ajax({
																type: "POST",
																url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadcustom"); ?>",
																data: {
																	'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
																	'rol'      : $("#txtrole").val(),
																	'req_code' : '<?php echo $req_code; ?>',
																},
																success: function (data) {
																	$('.custom-panel').empty();
																	$('.custom-panel').html(data);
																	
																	$("#txtposition").attr("disabled", "true");
																	$("#txtrole").removeAttr("disabled");
																	$(".custom-select").attr("disabled", "true");
																},
																error: function (data){
																	console.log(data);
																}
															});
														});
														$('#ratype3').click(function(){
															$("#txtlevel").attr("disabled", "true");
															$("#txtrole").attr("disabled", "true");
															$(".custom-select").removeAttr("disabled");
														});
													</script>
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
				url: "<?php echo Yii::app()->createAbsoluteUrl("requester/getrelaposition"); ?>",
				data: {
					'YII_CSRF_TOKEN' : '<?php echo Yii::app()->request->csrfToken; ?>',
					'posi'           : '<?php echo Yii::app()->session['mas_position_le_id']; ?>',
				},
				success: function (data) {
					var obj = JSON.parse(data);
					$.ajax({
						type: "POST",
						url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadcustom"); ?>",
						data: {
							'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
							'rol'      : obj["rol_id"],
							'req_code' : '<?php echo $req_code; ?>',
						},
						success: function (data) {
							$('.custom-panel').empty();
							$('.custom-panel').html(data);
							
							var type = '<?php echo $otype; ?>';
							if(type == 1){
								$("input:radio[name='radiotype']").filter("[value='1']").attr("checked", true);
								$("#txtlevel").removeAttr("disabled");
								$("#txtrole").attr("disabled", "true");
								$(".custom-select").attr("disabled", "true");
							}else if(type == 2){
								$("input:radio[name='radiotype']").filter("[value='2']").attr("checked", true);
								$("#txtlevel").attr("disabled", "true");
								$("#txtrole").removeAttr("disabled");
								$(".custom-select").attr("disabled", "true");
							}else if(type == 3){
								$("input:radio[name='radiotype']").filter("[value='3']").attr("checked", true);
								$("#txtlevel").attr("disabled", "true");
								$("#txtrole").attr("disabled", "true");
								$(".custom-select").removeAttr("disabled");
							}else{
								$("input:radio[name='radiotype']").filter("[value='1']").attr("checked", true);
								$("#txtlevel").removeAttr("disabled");
								$("#txtrole").attr("disabled", "true");
								$(".custom-select").attr("disabled", "true");
							}
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
		
		$(function() {
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadcustom"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'rol'      : $("#txtrole").val(),
					'req_code' : '<?php echo $req_code; ?>',
				},
				success: function (data) {
					$('.custom-panel').empty();
					$('.custom-panel').html(data);
				},
				error: function (data){
					console.log(data);
				}
			});
		});
		
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
	
	$('#txtlevel').change(function(){
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("requester/getrelaposition"); ?>",
			data: {
				'YII_CSRF_TOKEN' : '<?php echo Yii::app()->request->csrfToken; ?>',
				'posi'           : $('#txtlevel').val(),
			},
			success: function (data) {
				var obj = JSON.parse(data);
				
				if(obj["rol_id"]!=""){
					$.ajax({
						type: "POST",
						url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadcustom"); ?>",
						data: {
							'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
							'rol'      : obj["rol_id"],
							'req_code' : '<?php echo $req_code; ?>',
						},
						success: function (data) {
							$('.custom-panel').empty();
							$('.custom-panel').html(data);
							
							$("#txtlevel").removeAttr("disabled");
							$("#txtrole").attr("disabled", "true");
							$(".custom-select").attr("disabled", "true");
						},
						error: function (data){
							console.log(data);
						}
					});
				}else{
					$('.custom-panel').empty();
				}
			},
			error: function (data){
				console.log(data);
			}
		});
	});
	
	$('#txtrole').change(function(){
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadcustom"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'rol'      : $("#txtrole").val(),
				'req_code' : '<?php echo $req_code; ?>',
			},
			success: function (data) {
				$('.custom-panel').empty();
				$('.custom-panel').html(data);
				
				$("#txtposition").attr("disabled", "true");
				$("#txtrole").removeAttr("disabled");
				$(".custom-select").attr("disabled", "true");
			},
			error: function (data){
				console.log(data);
			}
		});
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
		var req_type = $('input[name=radiotype]:checked').val();
		var req_type_val = "";
		if(req_type == 1){
			req_type_val = $('#txtlevel').val();
		}else if(req_type == 2){
			req_type_val = $('#txtrole').val();
		}else if(req_type == 3){
			req_type_val = "Custom";
			
		}
		
		var mod_array = new Array();
		var level_array = new Array();
		
		$.each($("#mod-rol select"), function(){
			mod_array.push($(this).attr("data-mod"));
			level_array.push($(this).children("option:selected").attr("data-ra_id"));
		});
		/*console.log(mod_array);
		console.log(level_array);
		console.log(req_type_val);*/
		$.ajax({
			url:"<?php echo Yii::app()->createAbsoluteUrl("requester/saveform"); ?>",
			method:"POST",
			data:{
				oreq_code    : oreq_code,
				req_code     : req_code,
				app          : app,
				obj          : obj,
				req_type     : req_type,
				req_type_val : req_type_val,
				mod_array    : mod_array,
				level_array  : level_array,
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
</script>