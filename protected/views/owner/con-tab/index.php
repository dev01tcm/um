<div class="con">
	<div class="bhoechie-tab-content active">
		<div class="col-sm-12 col-xs-12 contact-info-box">
			<div class="row">
				<div class="col-sm-12 col-xs-12 text-right" style="padding-bottom: 10px;">
					<button class="btn btn-outline btn-success" type="button" id="btn_con">
						<i class="fa fa-plus" aria-hidden="true"></i> เพิ่ม Control
					</button>
				</div>
			</div>
			<table id="table_con" class="table table-bordered table-hover table-striped dataTable">
				<thead style="background-color:#AED6F1;">
					<tr>
						<th class="example-title" style="width:2%;">No.</th>
						<th class="example-title">ประเภท Control</th>
						<th class="example-title">Label ของ Control</th>
						<th class="example-title" style="width:5%;">แก้ไข</th>
						<th class="example-title" style="width:5%;">ลบ</th>
					</tr>
				</thead>
				<tbody> <?php
					$qusg = new CDbCriteria( array(
						'condition' => "app_id = :app_id and ct_status like :ct_status ",         
						'params' => array(':ct_status' => "1",':app_id' => $app)
					));
					$modelusg = MasControl::model()->findAll($qusg);
					$countusg = count($modelusg);
					$rowno = 1;
					foreach ($modelusg as $rows){
						$ct_id = $rows->ct_id;
						$ct_type = $rows->ct_type;
						$ct_name = $rows->ct_name;
						$createby = $rows->createby;
						$createdate = $rows->createdate;
						$updateby = $rows->updateby;
						$updatedate = $rows->updatedate; ?>
						<tr>
							<td class="example-title" style="text-align:center;"><?php echo $rowno; ?></td>
							<td class="example-title"><?php echo $ct_type; ?></td>
							<td class="example-title"><?php echo $ct_name; ?></td>
							<td class="example-title" style="text-align:center;"><button class="btn btn-warning btn-sm btn-edit-app" id="<?php echo $ct_id; ?>" ><i class="fa fa-edit"></i></button></td>
							<td class="example-title" style="text-align:center;"><button class="btn btn-danger btn-sm btn-del-app" id="<?php echo $ct_id; ?>" ><i class="fa fa-trash"></i></button></td>
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
		$('#btn_con').click(function(){
			$(".load-md-content").empty();
			$(".load-md-modal").modal('show');
			$('.load-md-content').load(
				"<?php echo Yii::app()->createAbsoluteUrl("owner/loadmodalcon"); ?>", {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				}
			);
		});
		
		$('.btn-edit-app').click(function(){
			var ide = $(this).attr('id');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadmodalcon"); ?>",
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
		
		$('.btn-del-app').click(function(){
			var id = $(this).attr('id');
			swal({
				title: "คุณแน่ใจหรือไม่ ?",
				text: "คุณต้องการลบรายการนี้ใช่หรือไม่",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "btn-danger",
				confirmButtonColor: "#ff4c52",
				closeOnConfirm: false,
				confirmButtonText: "ตกลง, ลบรายการนี้ !",
				showLoaderOnConfirm: true,
				disableButtons: "confirm",
			},
			function(){
				$.ajax({
					type: "POST",
					url: "<?php echo Yii::app()->createAbsoluteUrl("owner/deletedatacon"); ?>",
					data: {
						id : id,
						'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
					},
					success: function (data) {
						$(".load-md-modal").modal('hide');
						$(".load-md-content").empty();
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
								url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadcontab"); ?>",
								data: {
									'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
									'app':$("#hdapp").val(),
								},
								success: function (data) {
									$('.con').empty();
									$('.con').html(data);
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
		
		$('#table_con tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input class="form-control form-control-sm" type="text" placeholder="ค้นหา '+title+'" />' );
		} );
		
		var table = $('#table_con').DataTable({
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