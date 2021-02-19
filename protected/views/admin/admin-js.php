<script type="text/javascript">
	$(document).ready(function() {

		// $('.menu-link').removeClass('active');
		// $('.menu-link-ad').addClass('active');

		// $('.btn-link-menu1').click( function () {
		// 	$('.menu-link').removeClass('active');
		// 	$(this).addClass('active');
		// 	$.ajax({
		//         type: "POST",
		//         url: "<?php echo Yii::app()->createAbsoluteUrl("admin/loadreport"); ?>",
		//         data: {
		//             'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		//         },
		  
		//         success: function (data) {
		//             $('#project-area').empty();
		//             $('#project-area').html(data);
		//         },
		//         error: function (data){
		//             console.log(data);
		//         }
		//     }); 
		// });

		// $('.btn-link-menu2').click( function () {
		// 	$('.menu-link').removeClass('active');
		// 	$(this).addClass('active');
		// 	$.ajax({
		//         type: "POST",
		//         url: "<?php echo Yii::app()->createAbsoluteUrl("admin/loadmaster"); ?>",
		//         data: {
		//             'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		//         },
		  
		//         success: function (data) {
		//             $('#project-area').empty();
		//             $('#project-area').html(data);


		//         },
		//         error: function (data){
		//             console.log(data);
		//         }
		//     }); 
		// });

		$('.menu-link').removeClass('active');
		$(this).addClass('active');
		$.ajax({
	        type: "POST",
	        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/loadmaster"); ?>",
	        data: {
	            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
	        },
	  
	        success: function (data) {
	            $('#project-area').empty();
	            $('#project-area').html(data);


	        },
	        error: function (data){
	            console.log(data);
	        }
	    }); 
		
	});
</script>