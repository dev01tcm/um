<?php
if($rol==""){ ?>
	<div class="col-sm-12 col-xs-12 contact-info-box">
		<div class="example-title">ไม่พบข้อมูล</div>
	</div> <?php
}else{ ?>
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
	</style>
	<div class="dep_rol">
		<div class="col-sm-12 col-xs-12 contact-info-box" style="margin-top:20px;height:500px;overflow:auto;">
			<table id="table_dep_rol" class="table table-bordered table-hover table-striped dataTable">
				<thead style="background-color:#AED6F1;">
					<tr>
						<th class="example-title" style="width:2%;">ลำดับ</th>
						<th class="example-title">ตำแหน่ง</th>
						<th class="example-title" id="ca" style="width:70px;">
							<div class="swi" onclick="changeall();">
								<input type="hidden" id="hdval" value="1"/>
								<a id="swtitle">เปิดทั้งหมด</a>
							</div>
						</th>
					</tr>
				</thead>
				<tbody> <?php
					$chkmas = MasDepartmentRol::check_department_rol($rol);
					$masterdata = MasDepartmentRol::search($rol);

					$rowno = 1;
					foreach ($masterdata as $dataitem) { ?>
						<tr>
							<td class="example-title" style="text-align:center;"><?php echo $rowno; ?></td>
							<td class="example-title"><?php echo $dataitem['DeptNameTH']; ?></td>
							<td class="example-title" style="text-align:center;"> <?php
							if($dataitem['status'] == 1){ ?>
								<button id="btnsubmitdepmod<?php echo $dataitem['id']; ?>" class="btn btn-floating btn-success btn-sm" style="width: 36px; height: 26px;" type="button" title="online" data-id="<?php echo $dataitem['id']; ?>" onclick="changestat(<?php echo $dataitem['id']; ?>)">
									<i class="fa fa-check" aria-hidden="true"></i>
								</button> <?php
							}elseif($dataitem['status'] == 0){ ?>
								<button id="btnsubmitdepmod<?php echo $dataitem['id']; ?>" class="btn btn-floating btn-danger btn-sm" style="width: 36px; height: 26px;" type="button" title="offline" data-id="<?php echo $dataitem['id']; ?>" onclick="changestat(<?php echo $dataitem['id']; ?>)">
									<i class="fa fa-close" aria-hidden="true"></i>
								</button> <?php
							} ?>
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
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#table_dep_rol tfoot th').each( function () {
				var title = $(this).text();
				$(this).html( '<input class="form-control form-control-sm" type="text" placeholder="ค้นหา '+title+'" />' );
			} );
	//------------------------------------------------------------------------------------------------
			var table = $('#table_dep_rol').DataTable({
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
	//------------------------------------------------------------------------------------------------
		function changestat(id) {
			var status = '';
			var btn = '#btnsubmitdepmod';
			if($(btn+id).hasClass('btn-success')){
				$(btn+id).find("i").removeClass('fa-check');
				$(btn+id).find("i").addClass('fa-close');
				$(btn+id).removeClass('btn-success');
				$(btn+id).addClass('btn-danger');
				status = 0;
			}else if($(btn+id).hasClass('btn-danger')){
				$(btn+id).find("i").removeClass('fa-close');
				$(btn+id).find("i").addClass('fa-check');
				$(btn+id).removeClass('btn-danger');
				$(btn+id).addClass('btn-success');
				status = 1;
			}
			
			$.ajax({
				type: "POST",
				url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savechangedeprol"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'id' : $(btn+id).attr('data-id'),
					'status' : status,
				},
				dataType: "json",
				success: function (data) { }
			});
		}
	//------------------------------------------------------------------------------------------------
		function changeall() {
			var chkstatus = $('#hdval').val();
			var status = '';
			var btn = "button[id^='btnsubmitdepmod']";
			if(chkstatus == 1){
				$(btn).find("i").removeClass('fa-check');
				$(btn).find("i").addClass('fa-close');
				$(btn).removeClass('btn-success');
				$(btn).addClass('btn-danger');
				$("#swtitle").html('เปิดทั้งหมด');
				status = 0;
			}else if(chkstatus == 0){
				$(btn).find("i").removeClass('fa-close');
				$(btn).find("i").addClass('fa-check');
				$(btn).removeClass('btn-danger');
				$(btn).addClass('btn-success');
				$("#swtitle").html('ปิดทั้งหมด');
				status = 1;
			}
			$("#hdval").val(status);
			
			$.ajax({
				type: "POST",
				url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savedeprolall"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'rol' : '<?php echo $rol; ?>',
					'status' : status,
				},
				dataType: "json",
				success: function (data) { }
			});
		}
	</script> <?php
} ?>