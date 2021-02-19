<div class="col-sm-7 col-xs-12 contact-info-box" style="background-color: #f8f9fa;padding:10px;border:1px solid #eee;">
	<div class="sidebar sidebar-left">
		<div class="widget recent-posts">
			<input type="hidden" id="hdmod" value="<?php echo $mod; ?>"/>
			<h1 class="widget-title" style="font-size:25px"><i class="fa fa-sitemap" aria-hidden="true"></i> จัดการข้อมูล : <?php echo $name; ?><h1>
		</div>
	</div>
	<ul class="nav nav-tabs " id="myTab2" role="tablist">
		<li class="nav-item btn-sub active in">
			<a class="nav-link btn-sub-rol" id="sub02-tab" data-toggle="tab" href="#sub02" role="tab" aria-controls="sub02" aria-selected="false">Level</a>
		</li>
		<!--li class="nav-item btn-sub">
			<a class="nav-link btn-sub-posi" id="sub03-tab" data-toggle="tab" href="#sub03" role="tab" aria-controls="sub03" aria-selected="false">ตำแหน่ง</a>
		</li>
		<li class="nav-item btn-sub">
			<a class="nav-link btn-sub-level" id="sub04-tab" data-toggle="tab" href="#sub04" role="tab" aria-controls="sub04" aria-selected="false">ระดับ</a>
		</li>
		<li class="nav-item btn-sub">
			<a class="nav-link btn-sub-branch" id="sub05-tab" data-toggle="tab" href="#sub05" role="tab" aria-controls="sub05" aria-selected="false">สาขา</a>
		</li-->
		<li class="nav-item btn-sub">
			<a class="nav-link btn-sub-con" id="sub01-tab" data-toggle="tab" href="#sub01" role="tab" aria-controls="home" aria-selected="true">เงื่อนไขพิเศษ</a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent2">
		<div class="tab-pane fadd active in" id="sub02" role="tabpanel" aria-labelledby="sub02-tab">
			<div class="row subload-tab-rol">
			</div>
		</div>
		<div class="tab-pane fade" id="sub03" role="tabpanel" aria-labelledby="sub03-tab">
			<div class="row subload-tab-posi">
			</div>
		</div>
		<div class="tab-pane fade" id="sub04" role="tabpanel" aria-labelledby="sub04-tab">
			<div class="row subload-tab-lev">
			</div>
		</div>
		<div class="tab-pane fade" id="sub05" role="tabpanel" aria-labelledby="sub05-tab">
			<div class="row subload-tab-bra">
			</div>
		</div>
		<div class="tab-pane fade" id="sub01" role="tabpanel" aria-labelledby="sub01-tab">
			<div class="row subload-tab">
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	var lload = '<div id="load" style="text-align:center"><img style="width:450px; height:250px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading3.gif"></div>';
	$('.subload-tab').html(lload);
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadrolsub"); ?>",
		data: {
			'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
			'mod':$("#hdmod").val(),
			'app':'<?php echo $app; ?>',
		},
		success: function (data) {
			$('.subload-tab-rol').empty();
			$('.subload-tab-rol').html(data);
		},
		error: function (data){
			console.log(data);
		}
	}); 
	
	$('.btn-sub-con').click(function(event) {
		$('.subload-tab').html(lload);
		$('.btn-sub').removeClass('active');
		$(this).addClass('active');
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadconsub"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'mod':$("#hdmod").val(),
			},
			success: function (data) {
				$('.subload-tab').empty();
				$('.subload-tab').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
	
	$('.btn-sub-rol').click(function(event) {
		$('.subload-tab-rol').html(lload);
		$('.btn-sub').removeClass('active');
		$(this).addClass('active');
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadrolsub"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'mod':$("#hdmod").val(),
				'app':'<?php echo $app; ?>',
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
	
	$('.btn-sub-posi').click(function(event) {
		$('.subload-tab-posi').html(lload);
		$('.btn-sub').removeClass('active');
		$(this).addClass('active');
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadposisub"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'mod':$("#hdmod").val(),
			},
			success: function (data) {
				$('.subload-tab-posi').empty();
				$('.subload-tab-posi').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
	
	$('.btn-sub-level').click(function(event) {
		$('.subload-tab-lev').html(lload);
		$('.btn-sub').removeClass('active');
		$(this).addClass('active');
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadlevelsub"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'mod':$("#hdmod").val(),
			},
			success: function (data) {
				$('.subload-tab-lev').empty();
				$('.subload-tab-lev').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
	
	$('.btn-sub-branch').click(function(event) {
		$('.subload-tab-bra').html(lload);
		$('.btn-sub').removeClass('active');
		$(this).addClass('active');
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loaddepsub"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'mod':$("#hdmod").val(),
			},
			success: function (data) {
				$('.subload-tab-bra').empty();
				$('.subload-tab-bra').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
});
</script>