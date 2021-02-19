
  <div class="modal-header">
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
    	<span class="font-01 font-w" aria-hidden="true"><i class="fa fa-close"></i></span>
  	</button>
    <h2 class="modal-title font-01">เลือก Application</h2>
  </div>
  <div class="modal-body font-03">
    <div class="row">
        <div class="col-md-12">

        	<?php
        		$qusg2 = new CDbCriteria( array(
			        'condition' => " app_status = :app_status ",         
		            'params'    => array(':app_status' => '1')   
			    ));
			    $modelusg2 = MasApp::model()->findAll($qusg2);
			    foreach ($modelusg2 as $rowss){
			        $app_name_th = $rowss->app_name_th;
			        $app_shortname = $rowss->app_shortname; 
			        $app_id = $rowss->app_id; 

			        $user_shot_app = ApproverController::CallDataAppEmp($_POST["req_id"],$app_id);

			        if($user_shot_app=='false'){
			        	echo '<div class="col-md-6 form-group">
			        		<button type="button" class="btn btn-secondary btn-lg btn-block btn-modal-request" data-id="'.$app_id.'" id="'.$app_id.'">'.$app_shortname.'</button>
			        	</div>';
			        }

			        
			    }
        	?>
        </div>
    </div>
  </div><!-- modal-body -->


<script type="text/javascript">
$(document).ready(function() {
	$('.btn-modal-request').click(function(){
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
				$(".load-md-modal").modal('hide');
				$(".load-md-content").empty();

				$(".load-lg-content").empty();
				$(".load-lg-content").html(data);
				$(".load-lg-modal").modal('show');
			},
			error: function (data){
				console.log(data);
			}
		});
	});
});
</script>
