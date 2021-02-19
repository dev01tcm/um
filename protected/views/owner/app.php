<style>
	.boxapp:hover .col-sm-12{
		cursor: pointer;
		background-color: #ffe3a8;
		padding-left: 5px;
		padding-right: 5px;
		border-radius: 10px;
	}
	
	a#boxapp.boxapp.boxactive .col-sm-12{
		background-color: #ffe3a8;
		padding-left: 5px;
		padding-right: 5px;
		border-radius: 10px;
	}
	
	.icon-app {
		object-fit: contain;
		height: 60px;
		width: 60px;
	}
</style>
<div class="row">
	<div class="sidebar sidebar-left">
		<div class="widget recent-posts">
			<h3 class="widget-title" style="font-size:25px">Application</h3>
		</div>
	</div>
	<input type="hidden" id="hdapp" value=""/>
	<div class="facts-wrapper"> <?php
		$vall = "";
		if(Yii::app()->session['um_user_group_id'] == 1 || Yii::app()->session['um_user_group_id'] == 2) {
			$vall = "";
		}else{
			$masterdata = MasRela::check_app_emp(Yii::app()->session['em_id']);
			$rowno = 0;
			$e_id = "";
			foreach ($masterdata as $dataitem) {
				$e_id.= $dataitem['mas_app_id'];
				$rowno++;
				if(sizeof($masterdata) != $rowno){
					$e_id.=',';
				}
			}
			$vall = " AND app_id IN (".$e_id.")";
		}
		
		$qusg = new CDbCriteria( array(
			'condition' => "app_status like :app_status".$vall,         
			'params' => array(':app_status' => "1")  
		));
		$modelusg = MasApp::model()->findAll($qusg);
		$countusg = count($modelusg);
		$rowno = 0;
		foreach ($modelusg as $rows){
			$active = "";
			$app_id = $rows->app_id;
			$app_img = $rows->app_img;
			if($rowno == 0){
				$active = "boxactive";
			}
			$app_shortname = $rows->app_shortname; ?>
			<a class="boxapp <?php echo $active; ?>" id="boxapp" data-id="<?php echo $app_id; ?>">
				<div class="col-sm-12 ts-facts">
					<div class="ts-facts-img"> <?php
						if($rows->app_img == ""){ ?>
							<img class="icon-app" id="ico<?php echo $app_id; ?>" src="images/icon-image/fact1.png" alt=""> <?php
						}else{ ?>
							<img class="icon-app" id="ico<?php echo $app_id; ?>" src="<?php echo Yii::app()->params['prg_ctrl']['url']['upload']."/thumbnail/".$app_img; ?>" alt=""> <?php
						} ?>
					</div>
					<div class="ts-facts-content">
						<h4 class="ts-facts-title" id="shn<?php echo $app_id; ?>"><?php echo $app_shortname; ?></h4>
					</div>
				</div>
			</a> <?php
			$rowno++;
		} ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() { <?php
		$qusg = new CDbCriteria( array(
			'condition' => "app_status like :app_status",         
			'params' => array(':app_status' => "1")
		));
		$modelusg = MasApp::model()->findAll($qusg);
		$countusg = count($modelusg);
		$rowno = 1;
		foreach ($modelusg as $rows){
			$app = $rows->app_id;
			break;
		} ?>
		var app = '<?php echo $app; ?>';
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadcontent"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'app':app,
			},
			success: function (data) {
				$("#hdapp").val(app);
				$('.load-content').empty();
				$('.load-content').html(data);
			},
			error: function (data){
				console.log(data);
			}
		});
	});
		
	$('.boxapp').click(function(event) {
		$('.boxapp').removeClass('boxactive');
		$(this).addClass('boxactive');
		var app = $(this).attr('data-id');
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("owner/loadcontent"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'app':app,
			},
			success: function (data) {
				$("#hdapp").val(app);
				$('.load-content').empty();
				$('.load-content').html(data);
			},
			error: function (data){
				console.log(data);
			}
		});
	});
</script>