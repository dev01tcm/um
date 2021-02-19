<?php
if($id==""){ ?>
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
	<div class="ver">
		<div class="col-sm-12 col-xs-12 contact-info-box" style="margin-top:20px;height:500px;overflow:auto;">
			<div id="e-form">
				<table id="table_ver" class="table table-bordered table-hover table-striped dataTable">
					<thead style="background-color:#AED6F1;">
						<tr>
							<th class="example-title" style="width:2%;">Version</th>
							<th class="example-title">วันที่บันทึก</th>
							<th class="example-title">บันทึกโดย</th>
							<th class="example-title" id="ca" style="width:70px;">ตรวจสอบ</th>
						</tr>
					</thead>
					<tbody> <?php
						$masterdata = MasGroleModLev::searchversion($id);
						$rowno = 1;
						foreach ($masterdata as $dataitem) { ?>
							<tr>
								<td class="example-title" style="text-align:center;"><?php echo $dataitem['ver_no']; ?></td>
								<td class="example-title"><?php echo Yii::app()->CommonFnc->DateThai($dataitem["update_date"],false); ?></td>
								<td class="example-title"><?php echo $dataitem['em_name_th']." ".$dataitem['em_surname_th']; ?></td>
								<td class="example-title" style="text-align:center;"> <?php
									if($dataitem['status'] == 1){
										$ch = "checked"; 
									}elseif($dataitem['status'] == 0){
										$ch = "";
									} ?>
									<!--label class="switch">
										<input type="checkbox" <?php echo $ch; ?> id="btnsubmitvers<?php echo $dataitem['ver_id']; ?>" data-id="<?php echo $dataitem['ver_id']; ?>" onclick="changestat(<?php echo $dataitem['ver_id']; ?>)">
										<span class="slider round"></span>
									</label-->
									<button class="btn btn-outline-primary btn-sm btn-modal-ver" type="button" title="รายละเอียด" data-rol="<?php echo $id; ?>" data-ver="<?php echo $dataitem['ver_no']; ?>" data-date="<?php echo Yii::app()->CommonFnc->DateThai($dataitem["update_date"],false); ?>">
										<i class="fa fa-eye" aria-hidden="true"></i>
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
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.btn-modal-ver').click(function(){
				$.ajax({
					type: "POST",
					url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadmodalversion"); ?>",
					data: {
						'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
						'rol' : $(this).attr("data-rol"),
						'ver' : $(this).attr("data-ver"),
						'date' : $(this).attr("data-date"),
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
			
			$('#table_ver tfoot th').each( function () {
				var title = $(this).text();
				$(this).html('<input class="form-control form-control-sm" type="text" placeholder="ค้นหา '+title+'" />');
			} );
			
			var table = $('#table_ver').DataTable({
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
			var sid = "";
			var status = '';
			var btn = "input[id^='btnsubmitvers']";
			
			if($("#btnsubmitvers"+id).is(":checked")){
				$(btn).prop("checked", false);
				$("#btnsubmitvers"+id).prop("checked", true);
				sid = id;
			}
			
			var id_array = new Array();
			$.each($("#e-form input[id^='btnsubmitvers']"), function(){
				id_array.push($(this).attr("data-id"));
			});
			
			if(!$("#btnsubmitvers"+id).is(":checked")){
				$("#btnsubmitvers"+id_array[0]).prop("checked", true);
				sid = id_array[0];
			}
			
			$.ajax({
				type: "POST",
				url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savechangever"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'id'     : sid,
					'grm_id' : "<?php echo $id; ?>",
				},
				dataType: "json",
				success: function (data) { }
			});
		}
	</script> <?php
} ?>