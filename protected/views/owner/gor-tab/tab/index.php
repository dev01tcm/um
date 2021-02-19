<div class="col-sm-7 col-xs-12 contact-info-box" style="background-color: #f8f9fa;padding:10px;border:1px solid #eee;">
	<div class="sidebar sidebar-left">
		<div class="widget recent-posts">
			<input type="hidden" id="hdgor_id" value="<?php echo $gor_id; ?>"/>
			<h1 class="widget-title" style="font-size:25px"><i class="fa fa-sitemap" aria-hidden="true"></i> จัดการข้อมูล : <?php echo $name; ?><h1>
		</div>
	</div>
	<ul class="nav nav-tabs " id="myTab2" role="tablist">
		<li class="nav-item btn-sub active in">
			<a class="nav-link btn-sub-rol" id="sub02-tab" data-toggle="tab" href="#sub02" role="tab" aria-controls="sub02" aria-selected="false">Role</a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent2">
		<div class="tab-pane fadd active in" id="sub02" role="tabpanel" aria-labelledby="sub02-tab">
			<div class="row subload-tab-rol">
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	var lload = '<div id="load" style="text-align:center"><img style="width:450px; height:250px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading3.gif"></div>';
	$('.subload-tab-rol').html(lload);
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadgorrolsub"); ?>",
		data: {
			'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
			'gor_id' : '<?php echo $gor_id; ?>',
			'app'    : '<?php echo $app; ?>',
		},
		success: function (data) {
			$('.subload-tab-rol').empty();
			$('.subload-tab-rol').html(data);
		},
		error: function (data){
			console.log(data);
		}
	}); 
	
	$('.btn-sub-rol').click(function(event) {
		$('.subload-tab-rol').html(lload);
		$('.btn-sub').removeClass('active');
		$(this).addClass('active');
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadgorrolsub"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'gor_id' : '<?php echo $gor_id; ?>',
				'app'    : '<?php echo $app; ?>',
			},
			success: function (data) {
				$('.subload-tab-rol').empty();
				$('.subload-tab-rol').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
});
</script>