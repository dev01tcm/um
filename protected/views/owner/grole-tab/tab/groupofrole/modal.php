<div class="modal-header">
	<button class="close" aria-label="Close" type="button" data-dismiss="modal">
		<span class="font-01 font-w" aria-hidden="true"><i class="fa fa-close"></i></span>
	</button>
	<h2 class="modal-title font-01 font-w">จัดการ <?php echo $_POST['name'];?></h2>
</div>
<div class="modal-body font-03">
	<div class="example-wrap">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item active">
				<a class="nav-link active btn-po-tab" id="test-tab" data-toggle="tab" role="tab" href="javascript:void(0)" aria-controls="test" aria-selected="true">Level</a>
			</li>
			<!--li class="nav-item">
				<a class="nav-link active btn-ver-tab" id="ver-tab" data-toggle="tab" role="tab" href="javascript:void(0)" aria-controls="test" aria-selected="true">Version</a>
			</li-->
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane active" id="test" role="tabpanel" aria-labelledby="test-tab">
				<div class="load-rela-tab"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("owner/moduletab"); ?>",
		data: {
			'id' : "<?php echo $_POST['id']; ?>",
			'app': $("#hdapp").val(),
			'ver': $("#txtnowver").html(),
			'mod': "<?php echo $_POST['mod']; ?>",
			'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		},
		success: function (data) {
			$('.load-rela-tab').empty();
			$('.load-rela-tab').html(data);
		},
		error: function (data){
			console.log(data);
		}
	});
	
	$('.btn-po-tab').click(function(event) {
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/moduletab"); ?>",
			data: {
				'id' : "<?php echo $_POST['id']; ?>",
				'app': $("#hdapp").val(),
				'ver': $("#txtnowver").html(),
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
			},
			success: function (data) {
				$('.load-rela-tab').empty();
				$('.load-rela-tab').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
	
	$('.btn-ver-tab').click(function(event) {
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/versiontab"); ?>",
			data: {
				'id' : "<?php echo $_POST['id']; ?>",
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
			},
			success: function (data) {
				$('.load-rela-tab').empty();
				$('.load-rela-tab').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
});
</script>