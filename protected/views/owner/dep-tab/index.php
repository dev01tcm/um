<style>
	::-webkit-scrollbar {
		width: 10px;
	}
	
	::-webkit-scrollbar-track {
		background: #f1f1f1; 
	}
	
	::-webkit-scrollbar-thumb {
		background: orange; 
	}
	
	::-webkit-scrollbar-thumb:hover {
		background: orange; 
	}
	
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
<div class="dep">
	<div class="bhoechie-tab-content active">
		<div class="col-sm-12 col-xs-12 contact-info-box" style="margin-top:20px;height:500px;overflow:auto;">
			<table id="table_dep-app" class="table table-bordered table-hover table-striped dataTable">
				<thead style="background-color:#AED6F1;">
					<tr>
						<th class="example-title" style="width:2%;">ลำดับ</th>
						<th class="example-title">ตำแหน่ง</th>
						<th class="example-title" id="ca" style="width:70px;"> <?php
							$chkmas0 = MasDepartmentApp::check_stat_all($app);
							
							foreach ($chkmas0 as $dataitem0) { }
							if($dataitem0['cnt'] == 0){
								$ch = ""; 
							}else{
								$ch = "checked";
							} ?>
							<label class="switch">
								<input type="checkbox" id="change_dep" <?php echo $ch; ?> onclick="changeall()">
								<span class="slider round"></span>
							</label>
						</th>
					</tr>
				</thead>
				<tbody> <?php
					$chkmas = MasDepartmentApp::check_department_app($app);
					$masterdata = MasDepartmentApp::search($app);
					
					$rowno = 1;
					foreach ($masterdata as $dataitem) { ?>
						<tr>
							<td class="example-title" style="text-align:center;"><?php echo $rowno; ?></td>
							<td class="example-title"><?php echo $dataitem['DeptNameTH']; ?></td>
							<td class="example-title" style="text-align:center;"> <?php
								if($dataitem['status'] == 1){
									$ch = "checked"; 
								}elseif($dataitem['status'] == 0){
									$ch = "";
								} ?>
								<label class="switch">
									<input type="checkbox" <?php echo $ch; ?> id="btnsubmitdep<?php echo $dataitem['id']; ?>" data-id="<?php echo $dataitem['id']; ?>" onclick="changestat(<?php echo $dataitem['id']; ?>)">
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
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#table_dep-app tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input class="form-control form-control-sm" type="text" placeholder="ค้นหา '+title+'"/>');
		} );
		
		var table = $('#table_dep-app').DataTable({
			"paging":         false,
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
				},
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
		var btn = '#btnsubmitdep';
		
		if ($(btn+id).is(":checked")){
			status = 1;
		}else{
			status = 0;
		}
		
		$.ajax({
			type: "POST",
			url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savechangedep"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'id' : $(btn+id).attr('data-id'),
				'status' : status,
			},
			dataType: "json",
			success: function (data) { }
		});
	}
	
	function changeall(id) {
		var chkstatus = $('#hdval').val();
		var status = '';
		var btn = "input[id^='btnsubmitdep']";
		
		if($("#change_dep").is(":checked")){
			status = 1;
			$(btn).prop("checked", true);
		}else{
			status = 0;
			$(btn).prop("checked", false);
		}
		
		$.ajax({
			type: "POST",
			url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savedepappall"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'app' : '<?php echo $app; ?>',
				'status' : status,
			},
			dataType: "json",
			success: function (data) { }
		});
	}
</script>