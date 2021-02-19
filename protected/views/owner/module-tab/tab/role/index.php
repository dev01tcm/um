<?php
if($mod==""){ ?>
	<div class="col-sm-12 col-xs-12 contact-info-box">
		<div class="example-title">ไม่พบข้อมูล</div>
	</div> <?php
}else{ ?>
	<style>
		.switch2 {
			position: relative;
			display: inline-block;
			width: 60px;
			height: 34px;
		}
		
		.switch2 input { 
			opacity: 0;
			width: 0;
			height: 0;
		}
		
		.slider2 {
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
		
		.slider2:before {
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
		
		input:checked + .slider2 {
			background-color: red;
		}
		
		input:focus + .slider2 {
			box-shadow: 0 0 1px #2196F3;
		}
		
		input:checked + .slider2:before {
			-webkit-transform: translateX(26px);
			-ms-transform: translateX(26px);
			transform: translateX(26px);
		}
		
		.slider2.round {
			border-radius: 34px;
		}
		
		.slider2.round:before {
			border-radius: 50%;
		}
	</style>
	<div class="role-mod">
		<div class="col-sm-12 col-xs-12 contact-info-box" style="margin-top:20px;height:500px;overflow:auto;">
			<div class="col-sm-9 col-xs-9" style="padding-bottom: 10px;">
			</div>
			<div class="col-sm-3 col-xs-3 text-right" style="padding-bottom: 10px;">
				<button class="btn btn-outline btn-success" type="button" id="btn_role" onclick="savedata()">
					<i class="fa fa-plus" aria-hidden="true"></i> บันทึก
				</button>
			</div>
			<input type="hidden" id="modid" value="<?php echo $mod; ?>">
			<div id="e-form">
				<table id="table_role-mod" class="table table-bordered table-hover table-striped dataTable">
					<thead style="background-color:#AED6F1;">
						<tr>
							<th class="example-title" style="width:2%;">No.</th>
							<th class="example-title">Code</th>
							<th class="example-title">ชื่อระดับ (Level)</th>
							<th class="example-title" style="width:70px;">เปิด/ปิด <?php
								$chkmas0 = MasRoleMod::check_stat_all($mod);
								
								foreach ($chkmas0 as $dataitem0) { }
								if($dataitem0['cnt'] == 0){
									$ch = ""; 
								}else{
									$ch = "checked";
								} ?>
								<label class="switch">
									<input type="checkbox" id="change_mrole" <?php echo $ch; ?> onclick="changeall()">
									<span class="slider round"></span>
								</label>
							</th>
							<th class="example-title" style="width:5%;">Default</th>
						</tr>
					</thead>
					<tbody> <?php
						$chkmas = MasRoleMod::check_role_mod($app,$mod);
						$masterdata = MasRoleMod::search($mod);
						
						$rowno = 1;
						foreach ($masterdata as $dataitem) { ?>
							<tr>
								<td class="example-title" style=" text-align:center;"><?php echo $rowno; ?></td>
								<td class="example-title"><?php echo $dataitem['ra_code']; ?></td>
								<td class="example-title"><?php echo $dataitem['ra_name']; ?></td>
								<td class="example-title" style="text-align:center;"> <?php
									if($dataitem['status'] == 1){
										$ch = "checked"; 
									}elseif($dataitem['status'] == 0){
										$ch = "";
									} ?>
									<label class="switch">
										<input type="checkbox" <?php echo $ch; ?> id="btnrolmodstatus<?php echo $dataitem['id']; ?>" data-id="<?php echo $dataitem['id']; ?>" onclick="changestat(<?php echo $dataitem['id']; ?>)">
										<span class="slider round"></span>
									</label>
								</td>
								<td class="example-title" style="text-align:center;"> <?php
									if($dataitem['ra_default'] == 1){
										$ch = "checked"; 
									}elseif($dataitem['ra_default'] == 0){
										$ch = "";
									} ?>
									<label class="switch2">
										<input type="checkbox" <?php echo $ch; ?> id="btnrolmoddef<?php echo $dataitem['id']; ?>" data-id="<?php echo $dataitem['id']; ?>" onclick="changedef(<?php echo $dataitem['id']; ?>)">
										<span class="slider2 round"></span>
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
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#table_role-mod tfoot th').each( function () {
				var title = $(this).text();
				$(this).html( '<input class="form-control form-control-sm" type="text" placeholder="ค้นหา '+title+'" />' );
			} );
			
			var table = $('#table_role-mod').DataTable({ 
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
			var btn = '#btnrolmodstatus';
			
			if ($(btn+id).is(":checked")){
				status = 1;
			}else{
				status = 0;
			}
		}
		
		function changeall() {
			var status = '';
			var btn = "input[id^='btnrolmodstatus']";
			
			if($("#change_mrole").is(":checked")){
				status = 1;
				$(btn).prop("checked", true);
			}else{
				status = 0;
				$(btn).prop("checked", false);
			}
		}
		
		function changedef(id) {
			var sid = "";
			var status = '';
			var btn = "input[id^='btnrolmoddef']";
			
			if($("#btnrolmoddef"+id).is(":checked")){
				$(btn).prop("checked", false);
				$("#btnrolmoddef"+id).prop("checked", true);
				sid = id;
			}
			
			var id_array = new Array();
			$.each($("input[id^='btnrolmoddef']"), function(){
				id_array.push($(this).attr("data-id"));
			});
			
			if(!$("#btnrolmoddef"+id).is(":checked")){
				$("#btnrolmoddef"+id_array[0]).prop("checked", true);
				sid = id_array[0];
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
				var sw_array = new Array();
				var sw_status_array = new Array();
				$.each($("#e-form input[id^='btnrolmodstatus']"), function(){
					sw_array.push($(this).attr("data-id"));
					if($(this).is(":checked")){
						sw_status_array.push("1");
					}else{
						sw_status_array.push("0");
					}
				});
				//console.log(sw_array);  console.log(sw_status_array);
				//------------------------------------------------------------------------------------------------
				var df_id = "";
				$.each($("#e-form input[id^='btnrolmoddef']"), function(){
					if($(this).is(":checked")){
						df_id = $(this).attr("data-id");
					}
				});

				if(df_id.length == 0){
					swal({
						title: "ทำรายการไม่สำเร็จ",
						text: "กรุณาเลือกค่าตั้งต้น (Default)",
						type: "warning",
						confirmButtonColor: "#0064b3",
						confirmButtonText: "ปิด",
						closeOnConfirm: true
					});
				}else{
					$.ajax({
						url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savedatamodulelevel"); ?>",
						method:"POST",
						data:{
							YII_CSRF_TOKEN  : '<?php echo Yii::app()->request->csrfToken; ?>',
							modid             : $("#modid").val(),
							sw_array        : sw_array,
							sw_status_array : sw_status_array,
							df_id           : df_id,
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
						}
					});
				}
				//console.log($("#modid").val());
				//------------------------------------------------------------------------------------------------
				
			});
		}
	</script> <?php
} ?>