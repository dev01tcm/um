<style>
	::-webkit-scrollbar {
	  width: 10px;
	}
	
	::-webkit-scrollbar-track {
	  background: #f1f1f1; 
	}
	
	::-webkit-scrollbar-thumb {
	  background: orange; 
	}
	
	::-webkit-scrollbar-thumb:hover {
	  background: orange; 
	}
	
	.example-title {
		font-size: 23px;
	}
	
	input[type="text"], .btn, i {
		font-size: 23px;
	}
	
	.btn-a {
		border-width: 2px;
		border-style: solid;
		border-radius: 10px;
		background-color: white;
		padding: 5px 10px;
		font-size: 20px;
		cursor: pointer;
	}
	
	.dark {
		border-color: black;
		color: black;
	}
	
	.dark:hover {
		background: black;
		color: white;
	}
	
	.dark.sel {
		background: black;
		border-color: black;
		color: white;
	}
	
	.success {
		border-color: #4CAF50;
		color: green;
	}
	
	.success:hover {
		background-color: #4CAF50;
		color: white;
	}
	
	.success.sel {
		background-color: #4CAF50;
		border-color: #4CAF50;
		color: white;
	}
	
	.warning {
		border-color: #ff9800;
		color: orange;
	}
	
	.warning:hover {
		background: #ff9800;
		color: white;
	}
	
	.warning.sel {
		background: #ff9800;
		border-color: #ff9800;
		color: white;
	}
	
	.danger {
		border-color: #f44336;
		color: red;
	}
	
	.danger:hover {
		background: #f44336;
		color: white;
	}
	
	.danger.sel {
		background: #f44336;
		border-color: #f44336;
		color: white;
	}
	
	.default {
		border-color: #e7e7e7;
		color: black;
	}
	
	.default:hover {
		background: #e7e7e7;
	}
	
	.default.sel {
		background: #e7e7e7;
		border-color: #e7e7e7;
	}
	
	.img-app {
		object-fit: contain;
		height: 112px;
		width: 112px;
		cursor: pointer;
	}
	
	p.shn {
		font-size: 24px;
	}
</style> <?php
	$masterdata = MasRequest::getCountreq();
	$rowno = 1;
	foreach ($masterdata as $dataitem) {
		$cnt_req = $dataitem["cnt_req"];
	} ?>
<div class="row">
	<div  class="col-sm-12 col-xs-12 contact-info-box">
		<div class="sidebar sidebar-left">
			<div class="widget recent-posts">
				<h1 class="widget-title" style="font-size: 23px">รายการคำขอสิทธิ์</h1>
			</div>
		</div>
		<div class="col-sm-10">
			<input type="hidden" id="rq" value="0">
			<div class="col-md-12" style="margin:10px">
				<a data-rq="1" class="btn btn-a btnrq warning sel">รออนุมัติ</a>
				<a data-rq="2" class="btn btn-a btnrq success">Approve</a>
				<a data-rq="3" class="btn btn-a btnrq danger">Reject</a>
				<a data-rq="0" class="btn btn-a btnrq dark">ทั้งหมด</a>
			</div>
		</div>
		<div id="showreq">
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".req-notifi").text('<?php echo $cnt_req; ?>');
		
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadrequest"); ?>",
			data: {
				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
				'status':"1"
			},
			success: function (data) {
				$('#showreq').empty();
				$('#showreq').html(data);
			},
			error: function (data){
				console.log(data);
			}
		});
	});
	
	$('.btnrq').click(function(){
		$('.btnrq').removeClass('sel');
		$(this).addClass("sel");
		
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadrequest"); ?>",
			data: {
				'YII_CSRF_TOKEN' : '<?php echo Yii::app()->request->csrfToken; ?>',
				'status' : $(this).attr('data-rq')
			},
			success: function (data) {
				$('#showreq').empty();
				$('#showreq').html(data);
				$("#rq").val($(this).attr('data-rq'));
			},
			error: function (data){
				console.log(data);
			}
		});
	});
</script>