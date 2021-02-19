 <?php
$vall = "";
if(Yii::app()->session['um_user_group_id'] == 1 || Yii::app()->session['um_user_group_id'] == 2) {
	$vall = "";
}else{
	$data=MasRequest::getUserid(Yii::app()->user->id);
	foreach($data as $dataitem) { }
	
	$masterdata = MasRequest::check_appprove($dataitem["um_position_id"],$dataitem["mas_position_le_id"],$dataitem["DeptID"]);
	$rowno = 0;
	$e_id = "";
	foreach ($masterdata as $dataitem) {
		$e_id.= $dataitem['app_id'];
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
	$app_id = $rows->app_id;
	$rq = MasRequest::check_app($app_id);
	$rw = 0;
	$ccl = "success";
	if(sizeof($rq) != 0){
		foreach ($rq as $dataitem) {
			$req_status = $dataitem['req_status'];
			$req_code = $dataitem['req_code'];
			$req_id = $dataitem['req_id'];
			if($req_status == "1"){
				$ccl = "app-warning";
			}
			if($req_status == "2"){
				$ccl = "app-success";
			}
			if($req_status == "3"){
				$ccl = "app-danger";
			}
			if($req_status == "4"){
				$ccl = "app-default";
			}
			$rw++;
		}
	}else{
		$ccl = "app-default";
		$req_status = "5";
		$req_code = "";
		$req_id = "";
	}
	$app_img = $rows->app_img;
	$app_shortname = $rows->app_shortname;
	if($st == 0){ ?>
		<div class="col-sm-4 btn-modal-request <?php echo $ccl; ?>" data-id="<?php echo $app_id; ?>" data-reqid="<?php echo $req_id; ?>" data-code="<?php echo $req_code; ?>" data-status="<?php echo $req_status; ?>"> <?php
			if($rows->app_img == ""){ ?>
				<img class="img-app" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-image/noimg.png" alt=""> <?php
			}else{ ?>
				<img class="img-app" src="<?php echo Yii::app()->params['prg_ctrl']['url']['upload']."/thumbnail/".$app_img; ?>" alt=""> <?php
			} ?>
			<p class="shn"><?php echo $app_shortname; ?></p>
		</div> <?php
	}else{
		if($st == $req_status){ ?>
			<div class="col-sm-4 btn-modal-request <?php echo $ccl; ?>" data-id="<?php echo $app_id; ?>" data-reqid="<?php echo $req_id; ?>" data-code="<?php echo $req_code; ?>" data-status="<?php echo $req_status; ?>"> <?php
				if($rows->app_img == ""){ ?>
					<img class="img-app" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-image/noimg.png" alt=""> <?php
				}else{ ?>
					<img class="img-app" src="<?php echo Yii::app()->params['prg_ctrl']['url']['upload']."/thumbnail/".$app_img; ?>" alt=""> <?php
				} ?>
				<p class="shn"><?php echo $app_shortname; ?></p>
			</div> <?php
		}
	}
} ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.btn-modal-request').click(function(){
			if($(this).attr('data-status') == 5){
				$.ajax({
					type: "POST",
					url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadmodalapp"); ?>",
					data: {
						'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
						'app': $(this).attr('data-id'),
						'req_id':"",
						'req_status':"",
					},
					success: function (data) {
						$(".load-lg-content").empty();
						$(".load-lg-content").html(data);
						$(".load-lg-modal").modal('show');
					},
					error: function (data){
						console.log(data);
					}
				});
			}else{
				$.ajax({
					type: "POST",
					url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadmodalrequested"); ?>",
					data: {
						'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
						'req_id':$(this).attr("data-reqid"),
						'req_status':"1",
					},
					success: function (data) {
						$(".load-lg-content").empty();
						$(".load-lg-content").html(data);
						$(".load-lg-modal").modal('show');
					},
					error: function (data){
						console.log(data);
					}
				});
			}
		});
	});
</script>