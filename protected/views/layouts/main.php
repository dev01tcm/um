<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php require_once("css.php"); ?>

	
</head>

<body>

	<div class="body-inner">

		<?php require_once("header.php"); ?>

		<?php echo $content; ?>

		<?php require_once("footer.php"); ?>

		<?php require_once("modal.php"); ?>

		<?php require_once("js.php"); ?>


	<script type="text/javascript">
		$(document).ready(function() {

			$('.menu-link-ap').click( function () {
				$('.menu-link').removeClass('active');
				$(this).addClass('active');
				$.ajax({
			        type: "POST",
			        url: "<?php echo Yii::app()->createAbsoluteUrl("approver/index"); ?>",
			        data: {
			            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
			        },
			  
			        success: function (data) {
			            $('.page-app').empty();
			            $('.page-app').html(data);
			        },
			        error: function (data){
			            console.log(data);
			        }
			    }); 
			});

			$('.menu-link-ow').click( function () {
				$('.menu-link').removeClass('active');
				$(this).addClass('active');
				$.ajax({
			        type: "GET",
			        url: "<?php echo Yii::app()->createAbsoluteUrl("owner/index"); ?>",
			        data: {
			            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
			            page : 'home'
			        },
			  
			        success: function (data) {
			            $('.page-app').empty();
			            $('.page-app').html(data);
			        },
			        error: function (data){
			            console.log(data);
			        }
			    }); 
			});

			//menu-link-re
			$('.menu-link-re').click( function () {
				$('.menu-link').removeClass('active');
				$(this).addClass('active');
				$.ajax({
			        type: "POST",
			        url: "<?php echo Yii::app()->createAbsoluteUrl("requester/index"); ?>",
			        data: {
			            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
			        },
			  
			        success: function (data) {
			            $('.page-app').empty();
			            $('.page-app').html(data);
			        },
			        error: function (data){
			            console.log(data);
			        }
			    }); 
			});

			//menu-link-re
			$('.menu-link-ad').click( function () {
				$('.menu-link').removeClass('active');
				$(this).addClass('active');
				$.ajax({
			        type: "POST",
			        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/index"); ?>",
			        data: {
			            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
			        },
			  
			        success: function (data) {
			            $('.page-app').empty();
			            $('.page-app').html(data);
			        },
			        error: function (data){
			            console.log(data);
			        }
			    }); 
			});

			//menu-link-pro
			$('.menu-link-pro').click( function () {
				$('.menu-link').removeClass('active');
				$(this).addClass('active');
				$.ajax({
			        type: "POST",
			        url: "<?php echo Yii::app()->createAbsoluteUrl("profile/index"); ?>",
			        data: {
			            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
			        },
			  
			        success: function (data) {
			            $('.page-app').empty();
			            $('.page-app').html(data);
			        },
			        error: function (data){
			            console.log(data);
			        }
			    }); 
			});



			////////////////////////////////-----------------------------------------------LOAD ADMIN

			$('.menu-link').removeClass('active');
			$('.menu-link-pro').addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("profile/index"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.page-app').empty();
		            $('.page-app').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
			
		});
	</script>

	</div>

</body>
</html>
