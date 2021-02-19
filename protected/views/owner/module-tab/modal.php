<?php
$page = "Module";
if(isset($_POST['ide'])){
	$header_m = 'แก้ไขข้อมูล'.$page;
	$button_m = 'แก้ไขข้อมูล';
	$CallApp = OwnerController::CallModByID($_POST['ide']);
	$hdid = $CallApp['ma_id'];
	$ma_code = $CallApp['ma_code'];
	$ma_name = $CallApp['ma_name'];
	$ma_description = $CallApp['ma_description'];
}else{
	$header_m = 'เพิ่มข้อมูล'.$page;
	$button_m = 'บันทึกข้อมูล';
	$CallApp = "";
	$hdid = "";
	$ma_code = "";
	$ma_name = "";
	$ma_description = "";
}
?>
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
			<p class="example-title font-03 font-w"> Code</p>
			<input class="form-control form-control-lg font-03 modname" id="modcode" type="text" value="<?php echo $ma_code; ?>" placeholder="Code">
		</div>
		<div class="form-group">
			<p class="example-title font-03 font-w"> ชื่อModule</p>
			<input class="form-control form-control-lg font-03 modname" id="modname" type="text" value="<?php echo $ma_name; ?>" placeholder="ชื่อModule">
		</div>
		<div class="form-group">
			<p class="example-title font-03 font-w"> รายละเอียด</p>
			<input class="form-control form-control-lg font-03 moddescri" id="moddescri" type="text" value="<?php echo $ma_description; ?>" placeholder="รายละเอียด">
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
		//$('.btn-submit').removeAttr('disabled');
		var id = $('#hdpdid').val();
		var code = $('#modcode').val();
		var name = $('#modname').val();
		var descri = $('#moddescri').val();
		
		if (code == ""){
			swal({
				title: "กรุณาป้อน Code",
				text: "กรุณาตรวจสอบความถูกต้องอีกครั้ง",
				type: "warning",
				confirmButtonColor: "#00E5DA",
				confirmButtonText: "ปิด"
			});
			$('.btn-submit').removeAttr('disabled');
			return;
		}
		
		if (name == ""){
			swal({
				title: "กรุณาป้อนชื่อ Module",
				text: "กรุณาตรวจสอบความถูกต้องอีกครั้ง",
				type: "warning",
				confirmButtonColor: "#00E5DA",
				confirmButtonText: "ปิด"
			});
			$('.btn-submit').removeAttr('disabled');
			return;
		}
		
		if (descri == ""){
			swal({
				title: "กรุณาป้อนรายละเอียด",
				text: "กรุณาตรวจสอบความถูกต้องอีกครั้ง",
				type: "warning",
				confirmButtonColor: "#00E5DA",
				confirmButtonText: "ปิด"
			});
			$('.btn-submit').removeAttr('disabled');
			return;
		}
		
		$.ajax({
			type: "POST",
			url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savedatamod"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'id'     : id,
				'code'   : code,
				'name'   : name,
				'descri' : descri,
				'app'    :$("#hdapp").val(),
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
							url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadmodtab"); ?>",
							data: {
								'YII_CSRF_TOKEN' : '<?php echo Yii::app()->request->csrfToken; ?>',
								'app'            : $("#hdapp").val(),
							},
							success: function (data) {
								$('.modload-tab').empty();
								$('.modload-tab').html(data);
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