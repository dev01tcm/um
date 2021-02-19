<div class="modal-header">
	<button class="close" aria-label="Close" type="button" data-dismiss="modal">
		<span class="font-01 font-w" aria-hidden="true"><i class="fa fa-close"></i></span>
	</button>
	<input type="hidden" id="hdrol" value="<?php echo $rol; ?>"/>
	<input type="hidden" id="hdapp" value="<?php echo $app; ?>"/>
	<input type="hidden" id="hdver_no" value="<?php echo $ver; ?>"/>
	<h2 class="modal-title font-01 font-w"><?php echo $name; ?></h2>
</div>
<div class="modal-body font-03">
	<ul class="nav nav-tabs" id="myTab2" role="tablist">
		<li class="nav-item btn-sub active in">
			<a class="nav-link btn-rol-posi" id="sub03-tab" data-toggle="tab" href="#rol03" role="tab" aria-controls="sub03" aria-selected="false">Module</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active btn-ver-tab" id="ver-tab" data-toggle="tab" role="tab" href="javascript:void(0)" aria-controls="test" aria-selected="true">Version</a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent2">
		<div class="tab-pane fade active in" id="rol03" role="tabpanel" aria-labelledby="sub03-tab">
			<div class="row grolload-tab-mod2">
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	var lload = '<div id="load" style="text-align:center"><img style="width:450px; height:250px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading3.gif"></div>';
	$('.grolload-tab-mod2').html(lload);
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadrolemodule"); ?>",
		data: {
			'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
			'rol' : $("#hdrol").val(),
			'app' : $("#hdapp").val(),
			'ver' : $("#hdver_no").val(),
		},
		success: function (data) {
			$('.grolload-tab-mod2').empty();
			$('.grolload-tab-mod2').html(data);
		},
		error: function (data){
			console.log(data);
		}
	});
//------------------------------------------------------------------------------------------------
	$('.btn-rol-posi').click(function(event) {
		$('.grolload-tab-mod2').html(lload);
		$('.btn-rol').removeClass('active');
		$(this).addClass('active');
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadrolemodule"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'rol' :$("#hdrol").val(),
				'app' :$("#hdapp").val(),
				'ver' : $("#hdver_no").val(),
			},
			success: function (data) {
				$('.grolload-tab-mod2').empty();
				$('.grolload-tab-mod2').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
//------------------------------------------------------------------------------------------------
	$('.btn-ver-tab').click(function(event) {
		$('.grolload-tab-mod2').html(lload);
		$('.btn-rol').removeClass('active');
		$(this).addClass('active');
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/versiontab"); ?>",
			data: {
				'id' : $("#hdrol").val(),
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
			},
			success: function (data) {
				$('.grolload-tab-mod2').empty();
				$('.grolload-tab-mod2').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
});
</script>