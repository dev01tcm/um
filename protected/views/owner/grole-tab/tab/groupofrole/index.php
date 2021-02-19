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
	<div class="pos-rol">
		<div class="col-sm-12 col-xs-12 contact-info-box" style="margin-top:20px;height:500px;overflow:auto;">
			<div class="col-sm-9 col-xs-9" style="padding-bottom: 10px;">
				<div class="sidebar sidebar-left">
					<div class="widget recent-posts">
						<h3 class="widget-title" style="font-size:25px">เวอร์ชั่นปัจจุบัน : 
							<a id="txtnowver"></a>
							<input type="hidden" id="txtver" value="<?php echo $rol; ?>">
						</h3>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-3 text-right" style="padding-bottom: 10px;">
				<button class="btn btn-outline btn-success" type="button" id="btn_role" onclick="savedatamod()">
					<i class="fa fa-plus" aria-hidden="true"></i> บันทึก
				</button>
			</div>
			<div id="e-form">
				<table id="table_gmod" class="table table-bordered table-hover table-striped dataTable">
					<thead style="background-color:#AED6F1;">
						<tr>
							<th class="example-title" style="width:2%;">ลำดับ</th>
							<th class="example-title">Code</th>
							<th class="example-title">ชื่อ Module</th>
							<th class="example-title" id="ca" style="width:70px;"></th>
							<th class="example-title" id="ca" style="width:70px;">เปิด/ปิด <?php
								$chkmas0 = MasGroleMod::check_stat_all($rol);
								
								foreach ($chkmas0 as $dataitem0) { }
								if($dataitem0['cnt'] == 0){
									$ch = ""; 
								}else{
									$ch = "checked";
								} ?>
								<label class="switch">
									<input type="checkbox" id="change_rmod" <?php echo $ch; ?> onclick="changeall()">
									<span class="slider round"></span>
								</label>
							</th>
						</tr>
					</thead>
					<tbody> <?php
						$chkmas = MasGroleMod::check_gor($rol,$app);
						$masterdata = MasGroleMod::search($rol);
						
						$rowno = 1;
						foreach ($masterdata as $dataitem) { ?>
							<tr>
								<td class="example-title" style="text-align:center;"><?php echo $rowno; ?></td>
								<td class="example-title"><?php echo $dataitem['ma_code']; ?></td>
								<td class="example-title"><?php echo $dataitem['ma_name']; ?></td>
								<td class="example-title" style="text-align:center;">
									<button class="btn btn-floating btn-info btn-sm btn-rela-grole" id="<?php echo $dataitem['id']; ?>" name="<?php echo $dataitem['ma_name']; ?>" data-mod="<?php echo $dataitem['mod_id']; ?>" type="button" title="จัดการ">
										<i class="fa fa-sitemap" aria-hidden="true"></i>
									</button>
								</td>
								<td class="example-title" style="text-align:center;"> <?php
									if($dataitem['status'] == 1){
										$ch = "checked"; 
									}elseif($dataitem['status'] == 0){
										$ch = "";
									} ?>
									<label class="switch">
										<input type="checkbox" <?php echo $ch; ?> id="btnsubmitrmod<?php echo $dataitem['id']; ?>" data-mod="<?php echo $dataitem['mod_id']; ?>" data-id="<?php echo $dataitem['id']; ?>" onclick="changestat(<?php echo $dataitem['id']; ?>)">
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
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$(function() {
				$.ajax({
					type: "POST",
					url:"<?php echo Yii::app()->createAbsoluteUrl("owner/Getnowver"); ?>",
					data: {
						'YII_CSRF_TOKEN' : '<?php echo Yii::app()->request->csrfToken; ?>',
						'grm_id'         : <?php echo $rol; ?>,
					},
					dataType: "json",
					success: function (data) {
						var rid = data.runid;
						$("#txtnowver").empty();
						$("#txtnowver").html(rid);
					}
				});
			});
			
			$('#table_gmod tfoot th').each( function () {
				var title = $(this).text();
				$(this).html( '<input class="form-control form-control-sm" type="text" placeholder="ค้นหา '+title+'" />' );
			} );
			
			var table = $('#table_gmod').DataTable({
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
		
		$('.btn-rela-grole').click(function(){
			var id = $(this).attr('id');
			var name = $(this).attr('name');
			var mod = $(this).attr('data-mod');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadmodalgroupofrole"); ?>",
				data: {
					'id'   : id,
					'name' : name,
					'mod'  : mod,
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
				},
				success: function (data) {
					$(".load-md-content" ).empty();
					$('.load-md-content').html(data);
					$(".load-md-modal").modal('show');
					$(function() {
						$.ajax({
							type: "POST",
							url:"<?php echo Yii::app()->createAbsoluteUrl("owner/Getnowver"); ?>",
							data: {
								'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
								'grm_id':<?php echo $rol; ?>,
							},
							dataType: "json",
							success: function (data) {
								var rid = data.runid;
								$("#txtnowver").empty();
								$("#txtnowver").html(rid);
							}
						});
					});
				},
				error: function (data){
					console.log(data);
				}
			});
		});
		
		function changestat(id) {
			var status = '';
			var btn = '#btnsubmitrmod';
			
			if ($(btn+id).is(":checked")){
				status = 1;
			}else{
				status = 0;
			}
		}
		
		function changeall() {
			var status = '';
			var btn = "input[id^='btnsubmitrmod']";
			
			if($("#change_rmod").is(":checked")){
				status = 1;
				$(btn).prop("checked", true);
			}else{
				status = 0;
				$(btn).prop("checked", false);
			}
		}
		
		function savedatamod() {
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
				var rol_id = "<?php echo $rol; ?>";
				var mod_array = new Array();
				var status_array = new Array();
				$.each($("#e-form input[id^='btnsubmitrmod']"), function(){
					mod_array.push($(this).attr("data-mod"));
					if($(this).is(":checked")){
						status_array.push("1");
					}else{
						status_array.push("0");
					}
				});
				/*console.log(rol_id);  console.log(mod_array);  console.log(status_array);*/
				
				$.ajax({
					url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savedatagmod"); ?>",
					method:"POST",
					data:{
						app          : '<?php echo $app; ?>',
						ver_now      : $("#txtnowver").html(),
						rol_id       : rol_id,
						mod_array    : mod_array,
						status_array : status_array,
						YII_CSRF_TOKEN:'<?php echo Yii::app()->request->csrfToken; ?>',
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
						$(function() {
							$.ajax({
								type: "POST",
								url:"<?php echo Yii::app()->createAbsoluteUrl("owner/Getnowver"); ?>",
								data: {
									'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
									'grm_id':<?php echo $rol; ?>,
								},
								dataType: "json",
								success: function (data) {
									var rid = data.runid;
									$("#txtnowver").empty();
									$("#txtnowver").html(rid);
								}
							});
						});
					}
				});
			});
		}
	</script> <?php
} ?>