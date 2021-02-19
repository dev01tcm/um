<div class="row">
	<div class="sidebar sidebar-left">
		<div class="widget recent-posts"> <?php
			$qusg = new CDbCriteria( array(
				'condition' => "app_id = :app_id",         
				'params' => array(':app_id' => $app)
			));
			$modelusg = MasApp::model()->findAll($qusg);
			$countusg = count($modelusg);
			$rowno = 1;
			foreach ($modelusg as $rows){ ?>
				<h1 class="widget-title" style="font-size:25px"><?php echo $rows->app_name_th; ?></h1><?php
			} ?>
		</div>
	</div>
	<div class="cont-wrapper">
		<div class=" row col-md-12 col-sm-12">
			<ul class="nav nav-tabs " id="myTab" role="tablist">
				<li class="nav-item btn-nav-f active">
					<a class="nav-link btn-des-tab" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">รายละเอียด</a>
				</li>
				<!--li class="nav-item btn-nav-f">
					<a class="nav-link btn-obj-tab" id="obj-tab" data-toggle="tab" href="#obj" role="tab" aria-controls="obj" aria-selected="false">วัตถุประสงค์</a>
				</li-->
				<li class="nav-item btn-nav-f">
					<a class="nav-link btn-rol-tab" id="role-tab" data-toggle="tab" href="#rol" role="tab" aria-controls="rol" aria-selected="false">Level</a>
				</li>
				<li class="nav-item btn-nav-f">
					<a class="nav-link btn-mod-tab" id="mod-tab" data-toggle="tab" href="#mod" role="tab" aria-controls="mod" aria-selected="false">Module</a>
				</li>
				<li class="nav-item btn-nav-f">
					<a class="nav-link btn-grol-tab" id="grol-tab" data-toggle="tab" href="#grol" role="tab" aria-controls="grol" aria-selected="false">Role</a>
				</li>
				<li class="nav-item btn-nav-f">
					<a class="nav-link btn-gor-tab" id="gor-tab" data-toggle="tab" href="#gor" role="tab" aria-controls="gor" aria-selected="false">Group Of Role</a>
				</li>
				<!--li class="nav-item btn-nav-f">
					<a class="nav-link btn-pos-tab" id="pos-tab" data-toggle="tab" href="#pos" role="tab" aria-controls="pos" aria-selected="false">ตำแหน่ง</a>
				</li>
				<li class="nav-item btn-nav-f">
					<a class="nav-link btn-lev-tab" id="contact-tab" data-toggle="tab" href="#lev" role="tab" aria-controls="lev" aria-selected="false">ระดับ</a>
				</li>
				<li class="nav-item btn-nav-f">
					<a class="nav-link btn-dep-tab" id="contact-tab" data-toggle="tab" href="#dep" role="tab" aria-controls="dep" aria-selected="false">สาขา</a>
				</li-->
				<li class="nav-item btn-nav-f">
					<a class="nav-link btn-con-tab" id="con-tab" data-toggle="tab" href="#con" role="tab" aria-controls="con" aria-selected="false">เงื่อนไขพิเศษ</a>
				</li>
				<li class="nav-item btn-nav-f">
					<a class="nav-link btn-report-tab" id="report-tab" data-toggle="tab" href="#report" role="tab" aria-controls="report" aria-selected="false">ออกรายงาน</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
					<div class="row ownload-tab">
					</div>
				</div>
				<div class="tab-pane fade" id="obj" role="tabpanel" aria-labelledby="obj-tab">
					<div class="row objload-tab">
					</div>
				</div>
				<div class="tab-pane fade" id="con" role="tabpanel" aria-labelledby="con-tab">
					<div class="row conload-tab">
					</div>
				</div>
				<div class="tab-pane fade" id="mod" role="tabpanel" aria-labelledby="mod-tab">
					<div class="row modload-tab">
					</div>
				</div>
				<div class="tab-pane fade" id="rol" role="tabpanel" aria-labelledby="rol-tab">
					<div class="row rolload-tab">
					</div>
				</div>
				<div class="tab-pane fade" id="grol" role="tabpanel" aria-labelledby="grol-tab">
					<div class="row grolload-tab">
					</div>
				</div>
				<div class="tab-pane fade" id="pos" role="tabpanel" aria-labelledby="pos-tab">
					<div class="row posload-tab">
					</div>
				</div>
				<div class="tab-pane fade" id="lev" role="tabpanel" aria-labelledby="lev-tab">
					<div class="row levload-tab">
					</div>
				</div>
				<div class="tab-pane fade" id="dep" role="tabpanel" aria-labelledby="dep-tab">
					<div class="row depload-tab">
					</div>
				</div>
				<div class="tab-pane fade" id="gor" role="tabpanel" aria-labelledby="gor-tab">
					<div class="row gorload-tab">
					</div>
				</div>
				<div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
					<div class="row reportload-tab">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var lload = '<div id="load" style="text-align:center"><img style="width:450px; height:250px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading3.gif"></div>';
		$('.ownload-tab').html(lload);
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loaddestab"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'app':$("#hdapp").val(),
			},
			success: function (data) {
				$('.ownload-tab').empty();
				$('.ownload-tab').html(data);
			},
				error: function (data){
				console.log(data);
			}
		}); 
		
		$('.btn-des-tab').click(function(event) {
			$('.ownload-tab').html(lload);
			$('.btn-nav-f').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loaddestab"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				},
				success: function (data) {
					$('.ownload-tab').empty();
					$('.ownload-tab').html(data);
				},
				error: function (data){
					console.log(data);
				}
			});
		});
		
		$('.btn-obj-tab').click(function(event) {
			$('.objload-tab').html(lload);
			$('.btn-nav-f').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadobjtab"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				},
				success: function (data) {
					$('.objload-tab').empty();
					$('.objload-tab').html(data);
				},
				error: function (data){
					console.log(data);
				}
			}); 
		});
		
		$('.btn-con-tab').click(function(event) {
			$('.conload-tab').html(lload);
			$('.btn-nav-f').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadcontab"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				},
				success: function (data) {
					$('.conload-tab').empty();
					$('.conload-tab').html(data);
				},
				error: function (data){
					console.log(data);
				}
			}); 
		});
		
		$('.btn-pos-tab').click(function(event) {
			$('.posload-tab').html(lload);
			$('.btn-nav-f').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadpostab"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				},
				success: function (data) {
					$('.posload-tab').empty();
					$('.posload-tab').html(data);
				},
				error: function (data){
					console.log(data);
				}
			}); 
		});
		
		$('.btn-lev-tab').click(function(event) {
			$('.levload-tab').html(lload);
			$('.btn-nav-f').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadlevtab"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				},
				success: function (data) {
					$('.levload-tab').empty();
					$('.levload-tab').html(data);
				},
				error: function (data){
					console.log(data);
				}
			}); 
		});
		
		$('.btn-dep-tab').click(function(event) {
			$('.depload-tab').html(lload);
			$('.btn-nav-f').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loaddeptab"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				},
				success: function (data) {
					$('.depload-tab').empty();
					$('.depload-tab').html(data);
				},
				error: function (data){
					console.log(data);
				}
			});
		});
		
		$('.btn-mod-tab').click(function(event) {
			$('.modload-tab').html(lload);
			$('.btn-nav-f').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadmodtab"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				},
				success: function (data) {
					$('.modload-tab').empty();
					$('.modload-tab').html(data);
				},
				error: function (data){
					console.log(data);
				}
			}); 
		});
		
		$('.btn-rol-tab').click(function(event) {
			$('.rolload-tab').html(lload);
			$('.btn-nav-f').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadroletab"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				},
				success: function (data) {
					$('.rolload-tab').empty();
					$('.rolload-tab').html(data);
				},
				error: function (data){
					console.log(data);
				}
			});
		});
		
		$('.btn-grol-tab').click(function(event) {
			$('.rolload-tab').html(lload);
			$('.btn-nav-f').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadgroletab"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				},
				success: function (data) {
					$('.grolload-tab').empty();
					$('.grolload-tab').html(data);
				},
				error: function (data){
					console.log(data);
				}
			});
		});
		
		$('.btn-gor-tab').click(function(event) {
			$('.gorload-tab').html(lload);
			$('.btn-nav-f').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadgortab"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				},
				success: function (data) {
					$('.gorload-tab').empty();
					$('.gorload-tab').html(data);
				},
				error: function (data){
					console.log(data);
				}
			}); 
		});
		
		$('.btn-report-tab').click(function(event) {
			$('.reportload-tab').html(lload);
			$('.btn-nav-f').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadreporttab"); ?>",
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'app':$("#hdapp").val(),
				},
				success: function (data) {
					$('.reportload-tab').empty();
					$('.reportload-tab').html(data);
				},
				error: function (data){
					console.log(data);
				}
			}); 
		});
	});
</script>