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
	
	input[type="text"], .btn, label, select, option, i {
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
<div class="modal-header"> <?php
	$data=MasRequest::getdata($req_id);
	foreach($data as $dataitem) {
		$ob_id = $dataitem["ob_id"];
	}
	
	$qusg = new CDbCriteria( array(
		'condition' => "app_status like :app_status AND app_id = ".$dataitem["app_id"],     
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
	<button class="close" aria-label="Close" type="button" data-dismiss="modal">
		<span class="font-01 font-w" aria-hidden="true"><i class="fa fa-close"></i></span>
	</button>
	<h2 class="modal-title font-01">รายละเอียดสิทธิการใช้งานระบบสารสนเทศ : <?php echo $app_shortname." ".$app_name_th; ?></h2>
</div>
<div class="modal-body font-03">
	<div class="row">
		<div class="col-md-12" style="padding-left:15px;">
			<div class="form-group row text-center" style="margin-bottom:5px;">
				<div class="form-group col-sm-12" style="margin-bottom:5px;">
					<div class="text-center"> <?php
						if($rows->app_img == ""){ ?>
							<img class="img-app" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-image/noimg.png" alt=""> <?php
						}else{ ?>
							<img class="img-app" src="<?php echo Yii::app()->params['prg_ctrl']['url']['upload']."/thumbnail/".$app_img; ?>" alt=""> <?php
						} ?>
					</div>
				</div>
				<h1 class="font-02" style="width:100%;">
					<p class="font-w" style="margin-bottom:5px;">แบบขอลงทะเบียนผู้ขอใช้บริการระบบสารสนเทศ</p>
					<p class="font-w" style="margin-bottom:5px;"><?php echo $app_shortname." ".$app_name_th; ?></p>
				</h1>
			</div>
			<div class="col-sm-12">
				<div class="row">
					<label class="col-sm-6 form-control-label text-left"><span style="color:#6610f2;">เลขที่ขอ : </span><?php echo $dataitem["req_code"]; ?></label>
					<label class="col-sm-6 form-control-label text-right"><span style="color:#6610f2;">วันที่ขอสิทธิ : </span><?php echo Yii::app()->CommonFnc->DateThai($dataitem["create_date"],false); ?></label>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="row"> <?php
					if($dataitem["req_approve_by"] != ""){ ?>
						<label class="col-sm-6 form-control-label text-left"><span style="color:#6610f2;">อนุมัติโดย : </span><?php echo $dataitem["req_approve_by"]; ?></label>
						<label class="col-sm-6 form-control-label text-right"><span style="color:#6610f2;">วันที่อนุมัติ : </span><?php echo Yii::app()->CommonFnc->DateThai($dataitem["req_approve_date"],false); ?></label><?php
					}else{ ?>
						<label class="col-sm-6 form-control-label text-left"><span style="color:#6610f2;">อนุมัติโดย : </span></label>
						<label class="col-sm-6 form-control-label text-right"><span style="color:#6610f2;">วันที่อนุมัติ : </span></label><?php
					} ?>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne1" aria-expanded="false" class="collapsed">
											<label class="font-w">รายละเอียดผู้ขอ</label>
										</a>
									</h4>
								</div>
								<div id="collapseOne1" class="panel-collapse collapse" aria-expanded="false" >
									<div class="panel-body"> <?php
										$data1=MasRequest::getUserid($dataitem["create_by"]);
										foreach($data1 as $dataitem1) { } ?>
										<div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">วัน/เดือน/ปี เกิด </label>
											<div class="col-sm-8">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo Yii::app()->CommonFnc->DateThai($dataitem1["em_birthday"],false); ?>" readonly="readonly">
											</div>
										</div>
										<div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">เลขที่บัตรประชาชน </label>
											<div class="col-sm-8">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem1["em_citizen_id"]; ?>" readonly="readonly">
											</div>
										</div>
										<div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">ชื่อ-นามสกุล ไทย</label>
											<div class="col-sm-4">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem1["em_name_th"]; ?>" readonly="readonly">
											</div>
											<div class="col-sm-4">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem1["em_surname_th"]; ?>" readonly="readonly">
											</div>
										</div>
										<div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">ชื่อ-นามสกุล อังกฤษ</label>
											<div class="col-sm-4">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem1["em_name_en"]; ?>" readonly="readonly">
											</div>
											<div class="col-sm-4">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem1["em_surname_en"] ;?>" readonly="readonly">
											</div>
										</div>
										<div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">ตำแหน่งงาน / ระดับ</label>
											<div class="col-sm-4">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem1["PositNameTH"]; ?>" readonly="readonly">
											</div>
											<div class="col-sm-4">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem1["PositLevelNameTH"]; ?>" readonly="readonly">
											</div>
										</div>
										<div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
											<label class="col-sm-4 form-control-label text-right">สังกัด</label>
											<div class="col-sm-8">
												<input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $dataitem1["DeptID"] ;?> / <?php echo $dataitem1["DeptNameTH"] ;?>" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"> <?php
										$qusg = new CDbCriteria( array(
											'condition' => "ob_id = :ob_id and ob_status like :ob_status",         
											'params' => array(':ob_status' => "1",':ob_id' => $dataitem["ob_id"],)  
										));
										$modelusg = MasObjective::model()->findAll($qusg);
										$countusg = count($modelusg);
										$rowno = 0;
										foreach ($modelusg as $rows){ ?>
											<label class="font-w" style="color:#6610f2;">วัตถุประสงค์ : <i class="fa fa-check-circle" aria-hidden="true" style="margin-right:5px;color:#28a745;"></i><?php echo $rows->ob_name; ?></label> <?php
											$rowno++;
										} ?>
									</h4>
								</div>
							</div> <?php
							if($ob_id != "3"){ ?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseThree3" aria-expanded="true">
												<label class="font-w">สิทธิการใช้งาน</label>
											</a>
										</h4>
									</div>
									<div id="collapseThree" class="panel-collapse collapse in" aria-expanded="true" style="">
										<div class="panel-body" style="background-color:#F2F3F4;"><?php
											$type_label = "";
											if($dataitem["req_type"] == 1){
												$type_label = "ระดับ : ".$dataitem["PositLevelNameTH"];
											} else if($dataitem["req_type"] == 2){
												$type_label = "Role : ".$dataitem["ra_name"];
											} else if($dataitem["req_type"] == 3){
												$type_label = "Custom";
											} 
											?>
											<h4 class="panel-title">
												<label class="font-w" style="color:#6610f2;">
													<i class="fa fa-check-circle" aria-hidden="true" style="margin-right:5px;color:#28a745;"></i> <?php echo $type_label; ?>
												</label>
											</h4> <?php
											$data2=MasRequest::getdatamod($dataitem["req_code"],"");
											foreach($data2 as $dataitem2) { ?>
												<div class="form-group row" style="background-color: white; margin-bottom:10px;width:100%; border:.5px solid #ddd; padding-bottom:10px">
													<div class="col-sm-9" style="padding-top: 10px;"></div>
													<div class="form-group row" style="margin-bottom:10px;width:100%;padding-left:10px">
														<label class="col-sm-6 form-control-label text-left"><?php echo $dataitem2["ma_name"]; ?></label>
														<div class="col-sm-6">
															<input class="form-control font-03" id="" type="text" value="<?php echo $dataitem2["ra_name"]; ?>" readonly="readonly">
														</div>
													</div>
												</div> <?php
											} ?>
										</div>
									</div>
								</div> <?php
							} ?>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row target" style="margin-bottom:5px;margin-top:5px;width:100%;display:none;">
				<label class="col-sm-4 form-control-label text-left" style="color:red;">กรณียกเลิกสิทธิ * หมายเหตุ </label>
				<div class="col-sm-8">
					<textarea class="form-control font-05" id="textareaDefault" rows="4" style="width:90%;"></textarea>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button class="btn btn-danger font-03 font-w" type="button" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> ปิด</button>
	<?php
	if($req_status == 1){ ?>
		<button class="btn btn-warning font-03 btn-modal-edit" type="button" data-id="<?php echo $app_id; ?>">
			<i class="fa fa-edit" aria-hidden="true"></i> ขอเปลี่ยนแปลงสิทธิ
		</button><?php
	} ?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.btn-modal-edit').click(function(){
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadmodalapp"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app': $(this).attr('data-id'),
					'req_id':'<?php echo $req_id; ?>',
					'req_status':'<?php echo $req_status; ?>',
				},
				success: function (data) {
					$(".load-lg-content").empty();
					$(".load-lg-content").html(data);
    				$(".load-lg-modal").scrollTop(0);
				},
				error: function (data){
					console.log(data);
				}
			});
		});
	});
</script>