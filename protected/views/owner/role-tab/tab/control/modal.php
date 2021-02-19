<?php
$page = " Level Control";
if(isset($_POST['ide'])){
	$header_m = 'แก้ไขข้อมูล'.$page;
	$button_m = 'แก้ไขข้อมูล';
	$CallApp = OwnerController::CallConrolByID($_POST['ide']);
	$hdid = $CallApp['ct_id'];
	$type = $CallApp['ct_type'];
	$name = $CallApp['ct_name'];
	$check = $CallApp['ct_check'];
}else{
	$header_m = 'เพิ่มข้อมูล'.$page;
	$button_m = 'บันทึกข้อมูล';
	$CallApp = "";
	$hdid = "";
	$type = "";
	$name = "";
	$check = "0";
} ?>
<style>
	#ct_check {
		display:none;
	}
	
	#ct_check + label::before {
		width: 30px;
		height: 30px;
		border-radius: 10px;
		border: 2px solid #ffaf08;
		background-color: #fff;
		display: block;
		content: "";
		float: left;
		margin-right: 5px;
	}
	
	#ct_check:checked+label::before {
		box-shadow: inset 0px 0px 0px 3px #fff;
		background-color: #ffaf08;
	}
</style>
<div class="modal-header">
	<button class="close" aria-label="Close" type="button" data-dismiss="modal">
		<span class="font-01 font-w" aria-hidden="true"><i class="fa fa-close"></i></span>
	</button>
	<h2 class="modal-title font-01 font-w"> <?php echo $header_m; ?></h2>
</div>
<div class="modal-body font-03">
	<div class="example-wrap">
		<input type="hidden" id="hdpdid" value="<?php echo $hdid ?>"/>
		<div class="form-group">
			<p class="example-title font-03 font-w"> ประเภทของ Control</p> <?php
			$textbox = "";
			$textarea = "";
			$option = "";
			$label = "";
			if($type == "textbox"){
				$textbox = "selected";
			}else if($type == "textarea"){
				$textarea = "selected";
			}else if($type == "option"){
				$option = "selected";
			}else if($type == "label"){
				$label = "selected";
			}else{
				$textbox = "";
				$textarea = "";
				$option = "";
				$label = "";
			} ?>
			<select class="form-control form-control-lg font-03" id="ct_type" style="line-height:2rem;padding: .429rem 1rem;">
				<option value="textbox" <?php echo $textbox; ?>>textbox</option>
				<option value="textarea" <?php echo $textarea; ?>>textarea</option>
				<option value="option" <?php echo $option; ?>>option</option>
				<option value="label" <?php echo $label; ?>>label</option>
			</select>
		</div>
		<div class="form-group">
			<p class="example-title font-03 font-w"> ชื่อ Control</p>
			<input class="form-control form-control-lg font-03" id="ct_name" type="text" value="<?php echo $name; ?>" placeholder="ชื่อ Control">
		</div> <?php
			if($check == "1"){
				$ck = "checked";
			}else{
				$ck = "";
			} ?>
		<div class="form-group">
			<input class="form-control form-control-lg font-03" id="ct_check" type="checkbox" <?php echo $ck; ?>/>
			<label class="example-title font-03 font-w" for="ct_check">ข้อมูลจำเป็นต้องระบุ</label>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button class="btn btn-success font-03 font-w btn-submit" type="button"><?php echo $button_m; ?></button>
	<button class="btn btn-danger font-03 font-w" type="button" data-dismiss="modal">ยกเลิก</button>
</div>

<script type="text/javascript">
 $(document).ready(function() {
	$('.btn-submit').click(function(){
		$('.btn-submit').attr('disabled',true);
		var id = $('#hdpdid').val();
		var name = $('#ct_name').val();
		var type = $('#ct_type').val();
		var check = "";
		if ($('#ct_check').is(":checked")) {
			check = 1;
		}else{
			check = 0;
		}
		
		if (name == ""){
			swal({
				title: "ทำรายการไม่สำเร็จ",
				text: "กรุณาป้อนชื่อControl",
				type: "warning",
				confirmButtonColor: "#00E5DA",
				confirmButtonText: "ปิด"
			});
			$('.btn-submit').removeAttr('disabled');
			return;
		}
		
		$.ajax({
			type: "POST",
			url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savedataconrol"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'id' : id,
				'name' : name,
				'type' : type,
				'check': check,
				'order': '0',
				'rol_id':$("#hdrol").val(),
			},
			dataType: "json",
			success: function (data) {
				if (data.msg=='success') {
					$(".load-md-modal").modal('hide');
					$(".load-md-content").empty();
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
							url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadconrolsub"); ?>",
							data: {
								'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
								'rol':$("#hdrol").val(),
							},
							success: function (data) {
								$('.rolload-tab-con').empty();
								$('.rolload-tab-con').html(data);
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
					$('.btn-submit').removeAttr('disabled');
				}else{
					swal({
						title: "ทำรายการไม่สำเร็จ",
						text: "ข้อมูลซ้ำกับข้อมูลเดิมที่มีอยู่",
						type: "warning",
						confirmButtonColor: "#00E5DA",
						confirmButtonText: "ปิด"
					});
					$('.btn-submit').removeAttr('disabled');
				}
			}
		});
	});
});
</script>