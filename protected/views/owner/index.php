<style>
	.example-title {
		font-size: 23px;
	}
	
	input[type="text"], .btn {
		font-size: 23px;
	}
</style>
<section id="project-area" class="project-area solid-bg">
	<div class="container">
		<div class="col-md-12">
			<h3 class="section-sub-title">การใช้งานระบบ App Owner</h3>
			<ol class="breadcrumb">
				<li>หน้าแรก</li>
				<li class="navigator"></li>
			</ol>
		</div>
		<div class="col-md-12">
			<div class="col-md-2 col-sm-12 load-app">
				
			</div>
			<div class="col-md-10 col-sm-12 load-content">
				
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadapp"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
			},
			success: function (data) {
				$('.load-app').empty();
				$('.load-app').html(data);
			},
			error: function (data){
				console.log(data);
			}
		});
	});
</script>