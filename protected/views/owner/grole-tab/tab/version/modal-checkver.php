<div class="modal-header">
	<button class="close" aria-label="Close" type="button" data-dismiss="modal">
		<span class="font-01 font-w" aria-hidden="true"><i class="fa fa-close"></i></span>
	</button>
</div>
<div class="modal-body font-03">
	<div class="example-wrap">
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane active" id="test" role="tabpanel" aria-labelledby="test-tab">
				<div class="load-rela-tab">
					<div class="col-sm-9 col-xs-9" style="padding-bottom: 10px;">
						<div class="sidebar sidebar-left">
							<h3 class="widget-title" style="font-size:25px">เวอร์ชั่น : <?php echo $ver; ?></h3>
							<h3 class="widget-title" style="font-size:25px">วันที่บันทึก : <?php echo $date; ?></h3>
						</div>
					</div>
					<table id="table_check" class="table table-bordered table-hover table-striped dataTable">
						<thead style="background-color:#AED6F1;">
							<tr>
								<th class="example-title" style="width:2%;">ลำดับ</th>
								<th class="example-title" style="width:7%;">Code Module</th>
								<th class="example-title">Module</th>
								<th class="example-title" style="width:7%;">Code Level</th>
								<th class="example-title">Level</th>
							</tr>
						</thead>
						<tbody> <?php
							$masterdata = MasGroleModLev::checkversion($rol,$ver);
							$rowno = 1;
							foreach ($masterdata as $dataitem) { ?>
								<tr>
									<td class="example-title" style="text-align:center;"><?php echo $rowno; ?></td>
									<td class="example-title" style="text-align:center;"><?php echo $dataitem['ma_code']; ?></td>
									<td class="example-title"><?php echo $dataitem['ma_name']; ?></td>
									<td class="example-title" style="text-align:center;"><?php echo $dataitem['ra_code']; ?></td>
									<td class="example-title"><?php echo $dataitem['ra_name']; ?></td>
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
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#table_check tfoot th').each( function () {
			var title = $(this).text();
			$(this).html('<input class="form-control form-control-sm" type="text" placeholder="ค้นหา '+title+'" />');
		} );
		
		var table = $('#table_check').DataTable({
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
</script>