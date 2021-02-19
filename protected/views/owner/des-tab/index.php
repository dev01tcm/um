<style>
	input[type="file"] {
		display: none;
	}
	
	.img-pre {
		object-fit: contain;
		height: 200px;
		width: 80%;
		min-height: 200px;
		min-width: 80%;
	}
	
	.rounded {
		border-radius: .215rem!important;
	}
	
	.img-bordered {
		padding: 3px;
		border: 1px solid #e4eaec;
		border-color: #eb6709!important;
	}
</style>
<style>
	.switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
	}
	
	.switch input { 
		opacity: 0;
		width: 0;
		height: 0;
	}
	
	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
	}
	
	.slider:before {
		position: absolute;
		content: "";
		height: 26px;
		width: 26px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}
	
	input:checked + .slider {
		background-color: #2196F3;
	}
	
	input:focus + .slider {
		box-shadow: 0 0 1px #2196F3;
	}
	
	input:checked + .slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
	}
	
	.slider.round {
		border-radius: 34px;
	}
	
	.slider.round:before {
		border-radius: 50%;
	}
</style>
<div class="col-sm-12 col-xs-12 contact-info-box"> <?php
	$qusg = new CDbCriteria( array(
		'condition' => "app_id = :app_id",         
		'params' => array(':app_id' => $app)
	));
	$modelusg = MasApp::model()->findAll($qusg);
	$countusg = count($modelusg);
	$rowno = 1;
	foreach ($modelusg as $rows){ ?>
		<form method="post" class="frmSave" name="frmSave" id="frmSave" enctype="multipart/form-data">
			<div class="col-sm-6">
				<div class="form-group">
					<p class="example-title">ชื่อเต็มภาษาไทย</p>
					<input class="form-control form-control-lg" id="app_name_th" type="text" value="<?php echo $rows->app_name_th; ?>" placeholder="ชื่อเต็มภาษาไทย">
				</div>
				<div class="form-group">
					<p class="example-title"> ชื่อย่อ</p>
					<input class="form-control form-control-lg" id="app_shortname" type="text" value="<?php echo $rows->app_shortname; ?>" placeholder="ชื่อย่อ">
				</div>
				<div class="form-group">
					<p class="example-title font-03 font-w"> ชื่อผู้ติดต่อ</p>
					<input class="form-control form-control-lg" id="ap_contact_e" type="text" value="<?php echo $rows->app_contact; ?>" placeholder="เช่น admin ระบบ">
					<div class="invalid-feedback font-05 ap_contact_e_msg" style="display:none;color:red;"> กรอกข้อมูลให้ครบถ้วน</div>
				</div>
				<div class="form-group">
					<p class="example-title">โลโก้ปัจจุบัน</p> <?php
					if($rows->app_img == ""){ ?>
						<img class="img-pre rounded img-bordered" id="img-old" src="images/icon-image/noimg.png"> <?php
					}else{ ?>
						<img class="img-pre rounded img-bordered" id="img-old" src="<?php echo Yii::app()->params['prg_ctrl']['url']['upload']."/thumbnail/".$rows->app_img; ?>"> <?php
					} ?>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<p class="example-title"> ชื่อเต็มภาษาอังกฤษ</p>
					<input class="form-control form-control-lg" id="app_name_en" type="text" value="<?php echo $rows->app_name_en; ?>" placeholder="ชื่อเต็มภาษาอังกฤษ">
				</div>
				<div class="form-group">
					<p class="example-title font-03 font-w"> เบอร์ติดต่อ</p>
					<input class="form-control form-control-lg" id="ap_phone_e" type="text" value="<?php echo $rows->app_phone; ?>" placeholder="เช่น 021234567">
					<div class="invalid-feedback font-05 ap_phone_e_msg" style="display:none;color:red;"> กรอกข้อมูลให้ครบถ้วน</div>
				</div>
				<div class="form-group">
					<p class="example-title"> ไฟล์ โลโก้</p>
					<label class="btn btn-warning btn-sm">
						<span class="example-title">อัพโหลดไฟล์รูปภาพ</span>
						<input type="file" id="app-img" name="app-img">
					</label>
					<div class="form-group">
						<p class="example-title">โลโก้ใหม่</p>
						<img class="img-pre rounded img-bordered" id="img-pre" src="images/icon-image/noimg.png" alt="">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-warning btn-sm" id="btnEdit">บันทึก</button>
					</div>
				</div>
			</div>
		</form> <?php
		$rowno++;
	} ?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#ico<?php echo $app; ?>').attr('src', $('#img-old').attr('src'));
		$('#shn<?php echo $app; ?>').html($('#app_shortname').val());
		
		function readURL(input) {
			if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#img-pre').attr('src', e.target.result);
			}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#app-img").change(function() {
			readURL(this);
		});
//-------------------------------------------------------------------------------------------------------------------
		var elems = Array.prototype.slice.call(document.querySelectorAll('.frmSave'));
		elems.forEach(function(el) {
			el.onsubmit= function(e) {
				var data = new FormData(this);
				data.append('YII_CSRF_TOKEN', '<?php echo Yii::app()->request->csrfToken; ?>');
				data.append('app_id',<?php echo $app; ?>);
				data.append('app_img',$('#app-img').val());
				data.append('app_name_th',$('#app_name_th').val());
				data.append('app_shortname',$('#app_shortname').val());
				data.append('app_name_en',$('#app_name_en').val());
				data.append('ap_contact_e',$('#ap_contact_e').val());
				data.append('ap_phone_e',$('#ap_phone_e').val());
				
				$.ajax({
					url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savedatades"); ?>",
					method:"POST",
					enctype: 'multipart/form-data',
					contentType: false,
					cache: false,
					processData:false,
					data: data,
					dataType:"json",
					success: function (data){
						if (data.msg=='success') {
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
									url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loaddestab"); ?>",
									data: {
										'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
										'app':$("#hdapp").val(),
									},
									success: function (data) {
										$('.ownload-tab').empty();
										$('.ownload-tab').html(data);
									},
									error: function (data){
										console.log(data);
									}
								});
							});
						}else if(data=='error'){
							swal({
								title: "ทำรายการไม่สำเร็จ",
								text: "กรุณาตรวจสอบความถูกต้องอีกครั้ง",
								type: "warning",
								confirmButtonColor: "#00E5DA",
								confirmButtonText: "ปิด"
							});
						}else{
							swal({
								title: "ทำรายการไม่สำเร็จ",
								text: "ข้อมูลซ้ำกับข้อมูลเดิมที่มีอยู่",
								type: "warning",
								confirmButtonColor: "#00E5DA",
								confirmButtonText: "ปิด"
							});
						}
					}
				});
				e.preventDefault();
			};
		});
	})
</script>