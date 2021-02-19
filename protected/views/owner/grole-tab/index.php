<style>
	div.dataTables_wrapper div.dataTables_filter input {
		width: 120px;
	}
	
	.btn-grole.odd:hover,.btn-grole.even:hover {
		cursor: pointer;
		color: #006eff;
		text-decoration: underline;
		background-color: #EEEEEE;
	}
	
	.btn-grole.odd.sel,.btn-grole.even.sel {
		background-color: #FFCD67;
	}
	
	.btn-grole.odd.sel:hover,.btn-grole.even.sel:hover {
		color: black;
	}
	
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
</style>
<div class="role">
	<div class="bhoechie-tab-content active">
		<div class="col-xs-12 contact-info-box" style="margin-top:20px;height:500px;overflow:auto;">
			<div class="row">
				<div class="col-sm-12 col-xs-12 text-right" style="padding-bottom: 10px;">
					<button class="btn btn-outline btn-success" type="button" id="btn_role">
						<i class="fa fa-plus" aria-hidden="true"></i> เพิ่ม Role
					</button>
				</div>
			</div>
			<table id="table_role" class="table table-bordered table-hover table-striped dataTable">
				<thead style="background-color:#AED6F1;">
					<tr>
						<th class="example-title" style="width:2%;">No.</th>
						<th class="example-title" style="width:2%;">Code</th>
						<th class="example-title">ชื่อ Role</th>
						<th class="example-title" style="width:5%;">จัดการ</th>
						<th class="example-title" style="width:5%;">แก้ไข</th>
						<th class="example-title" style="width:5%;">ลบ</th>
					</tr>
				</thead>
				<tbody> <?php
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
						$ra_name = $rows->ra_name; ?>
						<tr class="btn-grole" data-id="<?php echo $ra_id; ?>" data-name="<?php echo $ra_name; ?>" data-app="<?php echo $app; ?>">
							<td class="example-title"><?php echo $rowno; ?></td>
							<td class="example-title"><?php echo $ra_code; ?></td>
							<td class="example-title"><?php echo $ra_name; ?></td>
							<td class="example-title" style="text-align:center;">
								<button class="btn btn-floating btn-info btn-sm btn-rela-grole" id="<?php echo $ra_id; ?>" name="<?php echo $ra_name; ?>" app="<?php echo $app; ?>" type="button" title="จัดการ">
									<i class="fa fa-sitemap" aria-hidden="true"></i>
								</button>
							</td>
							<td class="example-title" style="text-align:center;"><button class="btn btn-warning btn-sm btn-edit-mod" id="<?php echo $ra_id; ?>"><i class="fa fa-edit"></i></button></td>
							<td class="example-title" style="text-align:center;"><button class="btn btn-danger btn-sm btn-del-mod" id="<?php echo $ra_id; ?>"><i class="fa fa-trash"></i></button></td>
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
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#btn_role').click(function(){
			$(".load-md-content").empty();
			$(".load-md-modal").modal('show');
			$('.load-md-content').load(
				"<?php echo Yii::app()->createAbsoluteUrl("owner/loadmodalgrole"); ?>", {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				}
			);
		});
		
		$('.btn-rela-grole').click(function(){
			var rol  = $(this).attr('id');
			var name = $(this).attr('name');
			var app  = $(this).attr('app');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/modalmodule"); ?>",
				data: {
					'rol'  : rol,
					'name' : name,
					'app'  : app,
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
				},
				success: function (data) {
					$(".load-lg-content").empty();
					$('.load-lg-content').html(data);
					$(".load-lg-modal").modal('show');
				},
				error: function (data){
					console.log(data);
				}
			});
		});
		
		$('.btn-edit-mod').click(function(){
			var ide = $(this).attr('id');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadmodalgrole"); ?>",
				data: {
					ide : ide,
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				},
				success: function (data) {
					$(".load-md-content").empty();
					$(".load-md-content").html(data);
					$(".load-md-modal").modal('show');
				},
				error: function (data){
					console.log(data);
				}
			});
		});
		
		$('.btn-del-mod').click(function(){
			var id = $(this).attr('id');
			swal({
				title: "คุณแน่ใจหรือไม่ ?",
				text: "คุณต้องการลบรายการนี้ใช่หรือไม่",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "btn-danger",
				confirmButtonColor: "#ff4c52",
				closeOnConfirm: false,
				confirmButtonText: "ตกลง, ลบรายการนี้ !"
			},
			function(){
				$.ajax({
					type: "POST",
					url: "<?php echo Yii::app()->createAbsoluteUrl("owner/deletedatagrole"); ?>",
					data: {
						id : id,
						'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
					},
					success: function (data) {
						swal({
							title: "ทำรายการสำเร็จ",
							text: "ลบรายการที่ต้องการเรียบร้อย",
							type: "success",
							confirmButtonColor: "#00E5DA",
							confirmButtonText: "ปิด",
							closeOnConfirm: true
						},
						function(){
							$.ajax({
								type: "POST",
								url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadgroletab"); ?>",
								data: {
									'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
									'app':$("#hdapp").val(),
								},
								success: function (data) {
									$('.role').empty();
									$('.role').html(data);
								},
								error: function (data){
									console.log(data);
								}
							});
						});
					},
					error: function (data){
						console.log(data);
					}
				});
			});
		});
		
		$('#table_role tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input class="form-control form-control-sm" type="text" placeholder="ค้นหา '+title+'" />' );
		} );
		
		var table = $('#table_role').DataTable({
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
</script>