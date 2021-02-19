<?php
if($gor_id==""){ ?>
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
			<div id="e-form">
				<table id="table_gorrole" class="table table-bordered table-hover table-striped dataTable">
					<thead style="background-color:#AED6F1;">
						<tr>
							<th class="example-title" style="width:2%;">No.</th>
							<th class="example-title" style="width:2%;">Code</th>
							<th class="example-title">ชื่อ Role</th>
							<th class="example-title" style="width:5%;"></th>
						</tr>
					</thead>
					<tbody> <?php
						$chkmas = MasGOR::check_data($gor_id,$app);
						$masterdata = MasGOR::searchrol($gor_id);
						
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
										<input type="checkbox" <?php echo $ch; ?> id="btngorrolstatus<?php echo $dataitem['id_gor_role']; ?>" data-id="<?php echo $dataitem['id_gor_role']; ?>" onclick="changestat(<?php echo $dataitem['id_gor_role']; ?>)">
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
			$('#table_gorrole tfoot th').each( function () {
				var title = $(this).text();
				$(this).html( '<input class="form-control form-control-sm" type="text" placeholder="ค้นหา '+title+'" />' );
			} );
			
			var table = $('#table_gorrole').DataTable({ 
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
			var btn = "input[id^='btngorrolstatus']";
			
			if($("#btngorrolstatus"+id).is(":checked")){
				$(btn).prop("checked", false);
				$("#btngorrolstatus"+id).prop("checked", true);
			}
			
			var id_array = new Array();
			$.each($("#e-form input[id^='btngorrolstatus']"), function(){
				id_array.push($(this).attr("data-id"));
			});
			
			if(!$("#btngorrolstatus"+id).is(":checked")){
				$("#btngorrolstatus"+id_array[0]).prop("checked", true);
			}
		}
		
		function savedata() {
			var sw_array = new Array();
			var sw_status_array = new Array();
			$.each($("#e-form input[id^='btngorrolstatus']"), function(){
				sw_array.push($(this).attr("data-id"));
				if($(this).is(":checked")){
					sw_status_array.push("1");
				}else{
					sw_status_array.push("0");
				}
			});
			//console.log(sw_array);  console.log(sw_status_array);
			//------------------------------------------------------------------------------------------------
			$.ajax({
				url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savedatagorrole"); ?>",
				method:"POST",
				data:{
					YII_CSRF_TOKEN  : '<?php echo Yii::app()->request->csrfToken; ?>',
					sw_array        : sw_array,
					sw_status_array : sw_status_array,
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
	</script> <?php
} ?>