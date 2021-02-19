<div class="col-sm-7 col-xs-12 contact-info-box" style="background-color: #f8f9fa;padding:10px;border:1px solid #eee;">
	<div class="sidebar sidebar-left">
		<div class="widget recent-posts">
			<input type="hidden" id="hdrol" value="<?php echo $rol; ?>"/>
			<h3 class="widget-title"><i class="fa fa-sitemap" aria-hidden="true"></i> จัดการข้อมูล : <?php echo $name; ?><h3>
		</div>
	</div>
	<ul class="nav nav-tabs" id="myTab2" role="tablist">
		<!--li class="nav-item btn-sub active in">
			<a class="nav-link btn-rol-posi" id="sub03-tab" data-toggle="tab" href="#rol03" role="tab" aria-controls="sub03" aria-selected="false">ตำแหน่ง</a>
		</li>
		<li class="nav-item btn-sub">
			<a class="nav-link btn-rol-level" id="sub04-tab" data-toggle="tab" href="#rol04" role="tab" aria-controls="sub04" aria-selected="false">ระดับ</a>
		</li>
		<li class="nav-item btn-sub">
			<a class="nav-link btn-rol-branch" id="sub05-tab" data-toggle="tab" href="#rol05" role="tab" aria-controls="sub05" aria-selected="false">สาขา</a>
		</li-->
		<li class="nav-item btn-sub active in">
			<a class="nav-link btn-rol-con" id="sub01-tab" data-toggle="tab" href="#rol01" role="tab" aria-controls="sub01" aria-selected="true">เงื่อนไขพิเศษ</a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent2">
		<div class="tab-pane fade active in" id="rol03" role="tabpanel" aria-labelledby="sub03-tab">
			<div class="row rolload-tab-posi">
			</div>
		</div>
		<div class="tab-pane fade" id="rol04" role="tabpanel" aria-labelledby="sub04-tab">
			<div class="row rolload-tab-lev">
			</div>
		</div>
		<div class="tab-pane fade" id="rol05" role="tabpanel" aria-labelledby="sub05-tab">
			<div class="row rolload-tab-bra">
			</div>
		</div>
		<div class="tab-pane fade" id="rol01" role="tabpanel" aria-labelledby="sub01-tab">
			<div class="row rolload-tab-con">
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	var lload = '<div id="load" style="text-align:center"><img style="width:450px; height:250px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading3.gif"></div>';
	$('.rolload-tab-con').html(lload);
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadconrolsub"); ?>",
		data: {
			'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
			'rol':$("#hdrol").val(),
		},
		success: function (data) {
			$('.rolload-tab-posi').empty();
			$('.rolload-tab-posi').html(data);
		},
		error: function (data){
			console.log(data);
		}
	}); 
//------------------------------------------------------------------------------------------------
	$('.btn-rol-con').click(function(event) {
		$('.rolload-tab-con').html(lload);
		$('.btn-rol').removeClass('active');
		$(this).addClass('active');
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadconrolsub"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'rol':$("#hdrol").val(),
			},
			success: function (data) {
				$('.rolload-tab-con').empty();
				$('.rolload-tab-con').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
//------------------------------------------------------------------------------------------------
	$('.btn-rol-posi').click(function(event) {
		$('.rolload-tab-posi').html(lload);
		$('.btn-rol').removeClass('active');
		$(this).addClass('active');
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadposirol"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'rol':$("#hdrol").val(),
			},
			success: function (data) {
				$('.rolload-tab-posi').empty();
				$('.rolload-tab-posi').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
//------------------------------------------------------------------------------------------------
	$('.btn-rol-level').click(function(event) {
		$('.rolload-tab-lev').html(lload);
		$('.btn-sub').removeClass('active');
		$(this).addClass('active');
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadlevrol"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'rol':$("#hdrol").val(),
			},
			success: function (data) {
				$('.rolload-tab-lev').empty();
				$('.rolload-tab-lev').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
//------------------------------------------------------------------------------------------------
	$('.btn-rol-branch').click(function(event) {
		$('.rolload-tab-bra').html(lload);
		$('.btn-rol').removeClass('active');
		$(this).addClass('active');
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loaddeprol"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'rol':$("#hdrol").val(),
			},
			success: function (data) {
				$('.rolload-tab-bra').empty();
				$('.rolload-tab-bra').html(data);
			},
			error: function (data){
				console.log(data);
			}
		}); 
	});
//------------------------------------------------------------------------------------------------
});
</script>