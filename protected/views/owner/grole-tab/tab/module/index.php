<style>
	.switch_lev {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
	}
	
	.switch_lev input { 
		opacity: 0;
		width: 0;
		height: 0;
	}
	
	.slider_lev {
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
	
	.slider_lev:before {
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
	
	input:checked + .slider_lev {
		background-color: #228B22;
	}
	
	input:focus + .slider_lev {
		box-shadow: 0 0 1px #228B22;
	}
	
	input:checked + .slider_lev:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
	}
	
	.slider_lev.round {
		border-radius: 34px;
	}
	
	.slider_lev.round:before {
		border-radius: 50%;
	}
	
	tr.collapse.hide_lev {
		animation: fadeIn ease 0.5s;
		-webkit-animation: fadeIn ease 0.5s;
		-moz-animation: fadeIn ease 0.5s;
		-o-animation: fadeIn ease 0.5s;
		-ms-animation: fadeIn ease 0.5s;
		display: none;
	}
	
	tr.collapse.show_lev {
		display: table-row;
		animation: fadeIn ease 0.5s;
		-webkit-animation: fadeIn ease 0.5s;
		-moz-animation: fadeIn ease 0.5s;
		-o-animation: fadeIn ease 0.5s;
		-ms-animation: fadeIn ease 0.5s;
	}
</style>
<div class="pos-rol">
	<div class="col-sm-12 col-xs-12 contact-info-box" style="margin-top:20px;height:500px;overflow:auto;">
		<div class="col-sm-9 col-xs-9" style="padding-bottom: 10px;">
			<div class="sidebar sidebar-left">
				<div class="widget recent-posts">
					<h3 class="widget-title" style="font-size:25px">เวอร์ชั่นปัจจุบัน : 
						<a id="txtnowver"><?php echo $ver; ?></a>
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
						<th class="example-title" id="ca" style="width:60px;"></th>
						<th class="example-title" id="ca" style="width:60px;">เปิด/ปิด <?php
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
								<!--i id="show_lev" class="btn btn-floating btn-info btn-sm fa fa-list-ul" style="color:white" data-toggle="collapse" data-target=".collapsed<?php echo $rowno; ?>"></i-->
								<button class="btn btn-floating btn-info btn-sm btn-show-level" id="<?php echo $dataitem['id']; ?>" name="<?php echo $dataitem['ma_name']; ?>" data-mod="<?php echo $dataitem['mod_id']; ?>" type="button" title="จัดการ">
									<i class="fa fa-list-ul" aria-hidden="true"></i>
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
						</tr><?php
						$chkmas = MasGroleModLev::check_gor($dataitem['id'],$app,$ver);
						$masterdata = MasGroleModLev::search($dataitem['id']);
						$oid = "";
						foreach ($masterdata as $dataitem2) { ?>
							<tr class="collapse collapsed<?php echo $dataitem['id']; ?>" style="background-color:#E5E8E8"> 
								<td class="example-title" style="text-align:center;"></td>
								<td class="example-title"><?php echo $dataitem2['ra_code']; ?></td>
								<td class="example-title"><?php echo $dataitem2['ra_name']; ?></td>
								<td class="example-title" style="text-align:center;"> <?php
									if($dataitem2['status'] == 1){
										$ch = "checked"; 
									}elseif($dataitem2['status'] == 0){
										$ch = "";
									} ?>
									<label class="switch_lev">
										<input type="checkbox" <?php echo $ch; ?> id="btnsubmitrmlev<?php echo $dataitem['id']; ?>-<?php echo $dataitem2['id']; ?>" data-rol="<?php echo $dataitem2['rol_id']; ?>" data-id="<?php echo $dataitem2['id']; ?>" data-mod="<?php echo $dataitem['mod_id']; ?>" onclick="changelevel(<?php echo $dataitem['id']; ?>,<?php echo $dataitem2['id']; ?>)">
										<span class="slider_lev round"></span>
									</label>
								</td>
								<td></td>
							</tr> <?php
						}
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
	$('.btn-show-level').click(function(){
		var id = $(this).attr('id');
		
		if ($('.collapsed'+id).hasClass("show_lev")) {
			$('.collapse').addClass('hide_lev');
			$('.collapsed'+id).removeClass('show_lev');
		}else{
			$('.collapse').addClass('hide_lev');
			$('.collapse').removeClass('show_lev');
			$('.collapsed'+id).addClass('show_lev');
		}
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#table_gmod tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input class="form-control form-control-sm" type="text" placeholder="ค้นหา '+title+'" />' );
		} );
		
		var table = $('#table_gmod').DataTable({
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
			"ordering": false,
			//"order": [[ 0, "asc" ]],
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

	/*$('.btn-rela-grole').click(function(){
		var id = $(this).attr('id');
		var name = $(this).attr('name');
		var mod = $(this).attr('data-mod');
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadmodalrolemodule"); ?>",
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
	});*/

	function changestat(id) {
		var status = '';
		var btn = '#btnsubmitrmod';
		
		if ($(btn+id).is(":checked")){
			status = 1;
		}else{
			status = 0;
		}
	}
	
	function changelevel(mid,id) {
		var strbtn = 'btnsubmitrmlev'+mid;
		var status = '';
		var btn = "input[id^="+strbtn+"]";
		if($("#"+strbtn+"-"+id).is(":checked")){
			$(btn).prop("checked", false);
			$("#"+strbtn+"-"+id).prop("checked", true);
		}
		
		var id_array = new Array();
		$.each($("input[id^="+strbtn+"]"), function(){
			id_array.push($(this).attr("data-id"));
		});
		
		if(!$("#"+strbtn+"-"+id).is(":checked")){
			$("#"+strbtn+"-"+id_array[0]).prop("checked", true);
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
			console.log(rol_id);  console.log(mod_array);  console.log(status_array);
			
			var rol_array = new Array();
			var mod_array2 = new Array();
			var status_array2 = new Array();
			$.each($("#e-form input[id^='btnsubmitrmlev']"), function(){
				rol_array.push($(this).attr("data-rol"));
				mod_array2.push($(this).attr("data-mod"));
				if($(this).is(":checked")){
					status_array2.push("1");
				}else{
					status_array2.push("0");
				}
			});
			console.log(rol_array);  console.log(mod_array2);  console.log(status_array2);
			
			$.ajax({
				url:"<?php echo Yii::app()->createAbsoluteUrl("owner/savedatagmod"); ?>",
				method:"POST",
				data:{
					app           : '<?php echo $app; ?>',
					ver_now       : $("#txtnowver").html(),
					rol_id        : rol_id,
					mod_array     : mod_array,
					status_array  : status_array,
					rol_array     : rol_array,
					mod_array2    : mod_array2,
					status_array2 : status_array2,
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
					$(".load-ld-modal" ).modal('hide');
				}
			});
		});
	}
</script>