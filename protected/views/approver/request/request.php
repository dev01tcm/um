<table class="table table-bordered table-hover table-striped table-approver-request" cellspacing="0" id="exampleAddRow">
	<thead style="background-color:#AED6F1;">
		<tr>
			<th class="example-title text-center" style="width:2%;">No.</th>
			<th class="example-title text-center">เลขที่คำขอ</th>
			<th class="example-title text-center">ชื่อ-นามสกุล</th>
			<th class="example-title text-center">วันที่ขอ</th>
			<th class="example-title text-center">วันที่อนุมัติ</th>
			<th class="example-title text-center">App</th>
			<th class="example-title text-center" style="width:100px;">สถานะ</th>
			<th class="example-title text-center">Action</th>
			<th class="example-title text-center">รายละเอียด</th>
		</tr>
	</thead>
	<tbody><?php
			$masterdata = MasRequest::searchapprove(Yii::app()->session['em_id'],$status);
			$rowno = 1;
			foreach ($masterdata as $dataitem) {
				$req_id = $dataitem["req_id"]; 
				$req_code = $dataitem["req_code"];
				$app_shortname = $dataitem["app_shortname"];
				$ob_name = $dataitem["ob_name"];
				$req_date = $dataitem["req_date"];
				$req_day = $dataitem["req_day"];
				$req_status = $dataitem["req_status"];
				$req_approve_by = $dataitem["req_approve_by"];
				$req_approve_date = $dataitem["req_approve_date"];
				$em_name_th = $dataitem["em_name_th"];
				$em_surname_th = $dataitem["em_surname_th"];?>
				<tr class="gradeA">
					<td class="example-title text-center" style="text-align:center;"><?php echo $rowno; ?></td>
					<td class="example-title text-center"><?php echo $req_code; ?></td>
					<td class="example-title text-center"><?php echo $em_name_th." ".$em_surname_th; ?></td>
					<td class="example-title text-center"><?php echo Yii::app()->CommonFnc->DateThai($req_date,false); 
						if($req_status == "1"){ ?>
							&nbsp;<span class="badge badge-pill badge-warning"><?php echo $req_day; ?></span> <?php
						} ?>
					</td>
					<td class="example-title text-center"> <?php
						if($req_approve_by != ""){
							echo Yii::app()->CommonFnc->DateThai($req_approve_date,false); ?> | <?php echo $req_approve_by;
						} ?>
					</td>
					<td class="example-title text-center"><?php echo $app_shortname; ?></td> <?php
					if($req_status == "1"){
						$ccl = "warning";
						$lb = "รออนุมัติ";
					}
					if($req_status == "2"){
						$ccl = "success";
						$lb = "Approve";
					}
					if($req_status == "3"){
						$ccl = "danger";
						$lb = "Reject";
					} ?>
					<td class="example-title text-center">
						<span class="badge badge-round badge-<?php echo $ccl; ?>"><?php echo $lb; ?></span>
					</td>
					<td class="example-title text-center"> <?php
						if($req_status == 1){ ?>
							<a href="#" class="btn btn-sm btn-success btn-round btn-approve" title="Approve" data-id="<?php echo $req_id; ?>">
								<i class="fa fa-check" aria-hidden="true"></i> A
							</a>
							<a href="#" class="btn btn-sm btn-danger btn-round btn-reject" title="Reject" data-id="<?php echo $req_id; ?>">
								<i class="fa fa-close" aria-hidden="true"></i> R
							</a> <?php
						} ?>
					</td>
					<td class="example-title text-center">
						<button class="btn btn-outline-primary btn-sm btn-modal-requested" style="width:45px;height:35px" type="button" title="รายละเอียด" data-id="<?php echo $req_id; ?>" data-status="<?php echo $req_status; ?>">
							<i class="fa fa-eye" aria-hidden="true" style="font-size:23px;"></i>
						</button>
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
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</tfoot>
</table>
<script type="text/javascript">
	$('.btn-approve').click(function(){
		var req_id = $(this).attr('data-id');
		swal({
			title: "คุณแน่ใจหรือไม่ ?",
			text: "คุณต้องการ Approve รายการนี้ใช่หรือไม่",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "btn-danger",
			confirmButtonColor: "#5cb85c",
			closeOnConfirm: false,
			confirmButtonText: "ตกลง Approve รายการนี้ !",
			showLoaderOnConfirm: true,
			disableButtons: "confirm",
		},
		function(){
			$.ajax({
				url:"<?php echo Yii::app()->createAbsoluteUrl("requester/switchform"); ?>",
				method:"POST",
				data:{
					'req_id' : req_id,
					'status' : "2",
					'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->csrfToken; ?>',
				},
				success: function (data) {
					$(".load-lg-modal").modal('hide');
					$(".load-lg-content").empty();
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
							url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadrequesttap"); ?>",
							data: {
								'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
							},
							success: function (data) {
								$('.load-request-tab').empty();
								$('.load-request-tab').html(data);
							},
							error: function (data){
								console.log(data);
							}
						}); 
					});
				}
			});
		});
	});
	
	$('.btn-reject').click(function(){
		var req_id = $(this).attr('data-id');
		swal({
			title: "คุณแน่ใจหรือไม่ ?",
			text: "คุณต้องการ Reject รายการนี้ใช่หรือไม่",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "btn-danger",
			confirmButtonColor: "#ff4c52",
			closeOnConfirm: false,
			confirmButtonText: "ตกลง Reject รายการนี้ !",
			showLoaderOnConfirm: true,
			disableButtons: "confirm",
		},
		function(){
			$.ajax({
				url:"<?php echo Yii::app()->createAbsoluteUrl("requester/switchform"); ?>",
				method:"POST",
				data:{
					'req_id' : req_id,
					'status' : "3",
					'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->csrfToken; ?>',
				},
				success: function (data) {
					$(".load-lg-modal").modal('hide');
					$(".load-lg-content").empty();
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
							url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadrequesttap"); ?>",
							data: {
								'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
							},
							success: function (data) {
								$('.load-request-tab').empty();
								$('.load-request-tab').html(data);
							},
							error: function (data){
								console.log(data);
							}
						});
					});
				}
			});
		});
	});
</script>
<script type="text/javascript">
$(document).ready(function() {
	
	$('.btn-modal-requested').click(function(){
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadmodalrequested"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'req_id':$(this).attr("data-id"),
				'req_status':"0",
			},
			success: function (data) {
				$(".load-lg-content").empty();
				$(".load-lg-content").html(data);
				$(".load-lg-modal").modal('show');
			},
			error: function (data){
				console.log(data);
			}
		});
	});
	
	$('.table-approver-request tfoot th').each(function (){
		var title = $(this).text();
		$(this).html('<input class="form-control form-control-sm"  type="text" placeholder="ค้นหา '+title+'"/>');
	});
	
	var table = $('.table-approver-request').DataTable({
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
				$( 'input', this.footer() ).on( 'keyup change clear', function () {
				if ( that.search() !== this.value ) {
					that
					.search( this.value )
					.draw();
				}
				});
			});
		}
	});
});
</script>