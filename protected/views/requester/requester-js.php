<script type="text/javascript">
	$(document).ready(function() {
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadapp"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
			},
			success: function (data) {
				$('.loadapp').empty();
				$('.loadapp').html(data);
			},
			error: function (data){
				console.log(data);
			}
		});
//---------------------------------------------------------------------------------------------------------------------
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadrequesterindex"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
			},
			success: function (data) {
				$('.loadrequest').empty();
				$('.loadrequest').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
//---------------------------------------------------------------------------------------------------------------------
		// $('.table tfoot th').each( function () {
		// 	var title = $(this).text();
		// 	$(this).html( '<input class="form-control form-control-sm "  type="text" placeholder="ค้นหา '+title+'" />' );
		// } );

		// var table = $('.table').DataTable({
		// 	"oLanguage": {
		// 		"sEmptyTable":     "ไม่มีข้อมูลในระบบ",
		// 		"sInfo": "แสดงรายการที่ _START_ ถึง _END_ ของ _TOTAL_ รายการทั้งหมด",
		// 		"sInfoEmpty": "แสดงรายการที่ 0 ถึง 0 ของ 0 รายการทั้งหมด",
		// 		"sInfoFiltered":   "(กรองข้อมูลทั้งหมด _MAX_ ทุกรายการ)",
		// 		"sInfoPostFix":    "",
		// 		"sInfoThousands":  ",",
		// 		"sLengthMenu":     "แสดงรายการทั้งหมด _MENU_ รายการ ต่อหน้า",
		// 		"sLoadingRecords": "กำลังโหลดข้อมูล...",
		// 		"sProcessing":     "กำลังดำเนินการ...",
		// 		"sSearch":         "ค้นหา: ",
		// 		"sZeroRecords":    "ไม่พบข้อมูล",
		// 		"oPaginate": {
		// 			"sFirst":    "หน้าแรก",
		// 			"sPrevious": "ก่อนหน้า",
		// 			"sNext":     "ถัดไป",
		// 			"sLast":     "หน้าสุดท้าย"
		// 		},
		// 		"oAria": {
		// 			"sSortAscending":  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
		// 		"sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
		// 		}
		// 	},
		// 	"order": [[ 0, "asc" ]],
		// 	initComplete: function () {
		// 		this.api().columns().every( function () {
		// 			var that = this;
		// 			$( 'input', this.footer() ).on( 'keyup change clear', function () {
		// 				if ( that.search() !== this.value ) {
		// 					that
		// 						.search( this.value )
		// 						.draw();
		// 				}
		// 			} );
		// 		} );
		// 	}
		// });
	});
</script>