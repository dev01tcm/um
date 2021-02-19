<style>
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
	
	.btn-modal-request {
		border-radius: 3px;
		background-color: #f8f9fa;
		border: 1px solid #ddd;
		color: #6c757d;
		font-size: 12px;
		height: 170px;
		width: 130px;
		margin: 0 0 10px 10px;
		min-width: 80px;
		padding: 15px 5px;
		position: relative;
		text-align: center;
		cursor: pointer;
	}
	
	.app-warning {
		color: #eb6709;
		border: solid #eb6709;
	}
	
	.app-success {
		color: #11c26d;
		border: solid #11c26d;
		
	}
	
	.app-danger {
		color: #ff4c52;
		border: solid #ff4c52;
		
	}
	
	.app-default {
		color: #797D7F;
		border: solid #797D7F;
		
	}
	
	.app-warning:hover {
		background: #eb6709;
		color: white;
	}
	
	.app-success:hover {
		background: #11c26d;
		color: white;
	}
	
	.app-danger:hover {
		background: #ff4c52;
		color: white;
	}
	
	.app-default:hover {
		background: #797D7F;
		color: white;
	}
</style>
<div class="row">
	<div class="sidebar sidebar-left">
		<div class="widget recent-posts">
			<h3 class="widget-title">Application</h3>
		</div>
	</div>
	<div class="facts-wrapper">
		<div class="row">
			<input type="hidden" id="st" value="0">
			<div class="col-md-12 text-center">
				<a data-st="0" class="btn btn-a btnst dark sel">ทั้งหมด</a>
				<a data-st="1" class="btn btn-a btnst warning">รออนุมัติ</a>
				<a data-st="2" class="btn btn-a btnst success">Approve</a>
				<a data-st="3" class="btn btn-a btnst danger">Reject</a>
				<a data-st="5" class="btn btn-a btnst default">ยังไม่มีสิทธิ์</a>
			</div>
		</div>
		<hr style='margin: 20px 0;'>
		<div class="row all-clients showapp">
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadapplist"); ?>",
		data: {
			'YII_CSRF_TOKEN' : '<?php echo Yii::app()->request->csrfToken; ?>',
			'st' : 0,
		},
		success: function (data) {
			$('.showapp').empty();
			$('.showapp').html(data);
		},
		error: function (data){
			console.log(data);
		}
	});
	
	$('.btnst').click(function(){
		$('.btnst').removeClass('sel');
		$(this).addClass("sel");
		
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("requester/loadapplist"); ?>",
			data: {
				'YII_CSRF_TOKEN' : '<?php echo Yii::app()->request->csrfToken; ?>',
				'st' : $(this).attr('data-st'),
			},
			success: function (data) {
				$('.showapp').empty();
				$('.showapp').html(data);
				$("#st").val($(this).attr('data-st'));
			},
			error: function (data){
				console.log(data);
			}
		});
	});
});
</script>