<style>
	div.dataTables_wrapper div.dataTables_filter input {
		width: 120px;
	}
	
	.btn-gor.odd:hover,.btn-gor.even:hover {
		cursor: pointer;
		color: #006eff;
		text-decoration: underline;
		background-color: #EEEEEE;
	}
	
	.btn-gor.odd.sel,.btn-gor.even.sel {
		background-color: #FFCD67;
	}
	
	.btn-gor.odd.sel:hover,.btn-gor.even.sel:hover {
		color: black;
	}
	
	::-webkit-scrollbar {
		width: 10px;
		overflow-x: hidden;
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
<div class="mod">
	<div class="bhoechie-tab-content active">
		<div class="col-sm-5 col-xs-12 contact-info-box" style="margin-top:20px;height:500px;overflow:auto;overflow-x: hidden;">
			<table id="table_gor" class="table table-bordered table-hover table-striped dataTable">
				<thead style="background-color:#AED6F1;">
					<tr>
						<th class="example-title" style="width:2%;">No.</th>
						<th class="example-title">ชื่อ Group Of Role</th>
					</tr>
				</thead>
				<tbody> <?php
					$masterdata = MasGOR::search();
					$rowno = 1;
					foreach ($masterdata as $dataitem) { ?>
						<tr class="btn-gor" data-id="<?php echo $dataitem['gr_id']; ?>" data-name="<?php echo $dataitem['gr_name']; ?>">
							<td class="example-title" style="text-align:center;"><?php echo $rowno; ?></td>
							<td class="example-title"><?php echo $dataitem['gr_name']; ?></td>
						</tr> <?php
						$rowno++;
					} ?>
				</tbody>
				<tfoot>
					<tr>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="load-right-gor">
		
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadgorright"); ?>",
			data: {
				'YII_CSRF_TOKEN' : '<?php echo Yii::app()->request->csrfToken; ?>',
				'app'            : '<?php echo $app; ?>',
				'gor_id'         : '',
				'name'           : '',
			},
			success: function (data) {
				$('.load-right-gor').empty();
				$('.load-right-gor').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
		
		$('.btn-gor').click(function(event) {
			$('.btn-gor').removeClass('sel');
			$(this).addClass("sel");
			
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadgorright"); ?>",
				data: {
					'YII_CSRF_TOKEN' : '<?php echo Yii::app()->request->csrfToken; ?>',
					'app'            : '<?php echo $app; ?>',
					'gor_id'         : $(this).attr('data-id'),
					'name'           : $(this).attr('data-name'),
				},
				success: function (data) {
					$('.load-right-gor').empty();
					$('.load-right-gor').html(data);
				},
				error: function (data){
					console.log(data);
				}
			}); 
		});
		
		$('#table_gor tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input class="form-control form-control-sm" type="text" placeholder="ค้นหา '+title+'" />' );
		} );
		
		var table = $('#table_gor').DataTable({
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
</script>