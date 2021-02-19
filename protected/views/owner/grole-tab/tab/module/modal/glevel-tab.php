<style>
	.swi {
		background-color: #3497DB;
		border: none;
		color: black;
		padding: 2px 2px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 22px;
		cursor: pointer;
		border-radius: 10px;
	}
	
	.swi:hover{
		background-color: #6DB4E5;
	}
	
	#return_ver {
		color : #ffaf08;
	}
	
	#return_ver:hover {
		cursor: pointer;
		color : #966500;
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
<div class="row">
	<div class="col-md-12" style="margin-top:20px;height:500px;overflow:auto;">
		<div class="col-sm-9 col-xs-9" style="padding-bottom: 10px;">
		</div>
		<div class="col-sm-3 col-xs-3 text-right" style="padding-bottom: 10px;">
			<button class="btn btn-outline btn-success" type="button" id="btn_role" onclick="savedata()">
				<i class="fa fa-plus" aria-hidden="true"></i> บันทึก
			</button>
		</div>
		<div id="e-form">
			<table id="table_glevel" class="table table-bordered table-hover table-striped dataTable">
				<thead style="background-color:#AED6F1;">
					<tr>
						<th class="example-title" style="width:2%;">No.</th>
						<th class="example-title" style="width:2%;">Code</th>
						<th class="example-title">ชื่อระดับ (Level)</th>
						<th class="example-title" id="ca" style="width:70px;">เปิด/ปิด</th>
					</tr>
				</thead>
				<tbody> <?php
					$chkmas = MasGroleModLev::check_gor($id,$app,$ver);
					$masterdata = MasGroleModLev::search($id);
					$oid = "";
					$rowno = 1;
					foreach ($masterdata as $dataitem) { ?>
						<tr>
							<td class="example-title" style="text-align:center;"><?php echo $rowno; ?></td>
							<td class="example-title"><?php echo $dataitem['ra_code']; ?></td>
							<td class="example-title"><?php echo $dataitem['ra_name']; ?></td>
							<td class="example-title" style="text-align:center;"> <?php
								if($dataitem['status'] == 1){
									$ch = "checked"; 
								}elseif($dataitem['status'] == 0){
									$ch = "";
								} ?>
								<label class="switch">
									<input type="checkbox" <?php echo $ch; ?> id="btnsubmitrmlev<?php echo $dataitem['id']; ?>" data-rol="<?php echo $dataitem['rol_id']; ?>" data-id="<?php echo $dataitem['id']; ?>" onclick="changestat(<?php echo $dataitem['id']; ?>)">
									<span class="slider round"></span>
								</label>
							</td> 
						</tr> <?php
						$rowno++;
					} ?>
				</tbody>
				<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#table_glevel tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input class="form-control form-control-sm" type="text" placeholder="ค้นหา '+title+'" />' );
		} );
		
		var table = $('#table_glevel').DataTable({
			"paging" : false,
			"paging" : false,
			"oLanguage": {
				"sEmptyTable":     "ไม่มีข้อมูลในระบบ",
				"sInfo": "แสดงรายการที่ _START_ ถึง _END_ ของ _TOTAL_ รายการทั้งหมด",
				"sInfoEmpty": "แสดงรายการที่ 0 ถึง 0 ของ 0 รายการทั้งหมด",
				"sInfoFiltered":   "(กรองข้อมูลทั้งหมด _MAX_ ทุกรายการ)",
				"sInfoPostFix":    "",
				"sInfoThousands":  ",",
				"sLengthMenu":     "แสดงรายการทั้งหมด _MENU_ รายการ ต่อหน้า",
				"sLoadingRecords": "กำลังโหลดข้อมูล...",
				"sProcessing":     "กำลังดำเนินการ...",
				"sSearch":         "ค้นหา: ",
				"sZeroRecords":    "ไม่พบข้อมูล",
				"oPaginate": {
					"sFirst":    "หน้าแรก",
					"sPrevious": "ก่อนหน้า",
					"sNext":     "ถัดไป",
					"sLast":     "หน้าสุดท้าย"
				},
				"oAria": {
					"sSortAscending":  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
					"sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
				}
			},
			"order": [[ 0, "asc" ]],
			initComplete: function () {
				this.api().columns().every( function () {
					var that = this;
					$('input', this.footer() ).on('keyup change clear', function () {
						if (that.search() !== this.value) {
							that
							.search(this.value)
							.draw();
						}
					});
				} );
			}
		});
	});
	
	function changestat(id) {
		var status = '';
		var btn = "input[id^='btnsubmitrmlev']";
		
		if($("#btnsubmitrmlev"+id).is(":checked")){
			$(btn).prop("checked", false);
			$("#btnsubmitrmlev"+id).prop("checked", true);
		}
		
		var id_array = new Array();
		$.each($("#e-form input[id^='btnsubmitrmlev']"), function(){
			id_array.push($(this).attr("data-id"));
		});
		
		if(!$("#btnsubmitrmlev"+id).is(":checked")){
			$("#btnsubmitrmlev"+id_array[0]).prop("checked", true);
		}
	}
	
	function changeall() {
		var status = '';
		var btn = "input[id^='btnsubmitrmlev']";
		
		if($("#change_grole").is(":checked")){
			status = 1;
			$(btn).prop("checked", true);
		}else{
			status = 0;
			$(btn).prop("checked", false);
		}
	}
	
	function savedata() {
		swal({
			title: "คุณแน่ใจหรือไม่ ?",
			text: "คุณต้องการบันทึกรายการนี้ใช่หรือไม่",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "btn-danger",
			confirmButtonColor: "#ff4c52",
			closeOnConfirm: false,
			confirmButtonText: "ตกลง, บันทึกรายการนี้ !",
			cancelButtonText: "ยกเลิก",
		},
		function(){
			var rol_array = new Array();
			var status_array = new Array();
			$.each($("#e-form input[id^='btnsubmitrmlev']"), function(){
				rol_array.push($(this).attr("data-rol"));
				if($(this).is(":checked")){
					status_array.push("1");
				}else{
					status_array.push("0");
				}
			});
			console.log(rol_array);  console.log(status_array);
			//------------------------------------------------------------------------------------------------
			var mod_array = new Array();
			var status_mo_array = new Array();
			$.each($("#e-form input[id^='btnsubmitrmod']"), function(){
				mod_array.push($(this).attr("data-mod"));
				if($(this).is(":checked")){
					status_mo_array.push("1");
				}else{
					status_mo_array.push("0");
				}
			});
			/*console.log(mod_array);  console.log(status_mo_array);*/
			//------------------------------------------------------------------------------------------------
			$.ajax({
				url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savedata"); ?>",
				method:"POST",
				data:{
					grm_id          : "<?php echo $id; ?>",
					mod             : "<?php echo $mod; ?>",
					ver             : "<?php echo $ver; ?>",
					rol_id          : $("#txtver").val(),
					rol_array       : rol_array,
					status_array    : status_array,
					mod_array       : mod_array,
					status_mo_array : status_mo_array,
					YII_CSRF_TOKEN  :'<?php echo Yii::app()->request->csrfToken; ?>',
				},
				success: function (data) {
					swal({
						title: "ทำรายการสำเร็จ",
						text: "บันทึกข้อมูลเรียบร้อย",
						type: "success",
						confirmButtonColor: "#0064b3",
						confirmButtonText: "ปิด",
						closeOnConfirm: true
					});
					$(".load-md-modal" ).modal('hide');
					$.ajax({
						type: "POST",
						url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadgroupofrole"); ?>",
						data: {
							'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
							'rol' : $("#hdrol").val(),
							'app' : $("#hdapp").val(),
						},
						success: function (data) {
							$('.grolload-tab-mod').empty();
							$('.grolload-tab-mod').html(data);
						},
						error: function (data){
							console.log(data);
						}
					});
				}
			});
		});
	}
</script>