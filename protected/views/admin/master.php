<div class="container">
	<div class="col-md-12">
		<h3 class="section-sub-title">จัดการข้อมูลหลัก</h3>
		<ol class="breadcrumb">
            <li>หน้าแรก</li>
            <li class="navigator">จัดการข้อมูลหลัก</li>
        </ol>
	</div>
	<!--/ Title row end -->

	<div class="col-md-12">
		
		<ul class="nav nav-tabs " id="myTab" role="tablist">
		  <li class="nav-item active">
		    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">ข้อมูลหลัก</a>
		  </li>
		  <!-- <li class="nav-item">
		    <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="two" aria-selected="true">ตั้งค่าข้อมูลหลัก</a>
		  </li> -->
		  
		</ul>
		<div class="tab-content" id="myTabContent">
		  	<div class="tab-pane fade  active in" id="home" role="tabpanel" aria-labelledby="home-tab">
		  	
				<div class="row bhoechie-tab-container">
			        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 bhoechie-tab-menu">
				        <div class="list-group list-menu">
			                <a href="javascript:void(0)" class="list-group-item active text-center btn-emp">
			                  <h4 class="glyphicon glyphicon-user"></h4><br/>บุคลากร
			                </a>
			                <a href="javascript:void(0)" class="list-group-item text-center btn-emp-g">
			                  <h4 class="glyphicon glyphicon-remove"></h4><br/>กลุ่มผู้ใช้งาน
			                </a>
			                <a href="javascript:void(0)" class="list-group-item text-center btn-emp-t">
			                  <h4 class="glyphicon glyphicon-download-alt"></h4><br/>ประเภทบุคลากร
			                </a>
			                <a href="javascript:void(0)" class="list-group-item text-center btn-app">
			                  <h4 class="glyphicon glyphicon-check"></h4><br/>ระบบงาน
			                </a>
			                <a href="javascript:void(0)" class="list-group-item text-center btn-app-type">
			                  <h4 class="glyphicon glyphicon-transfer"></h4><br/>ประเภทระบบงาน
			                </a>
			                <!-- <a href="javascript:void(0)" class="list-group-item text-center btn-modal">
			                  <h4 class="glyphicon glyphicon-random"></h4><br/>Module Application
			                </a>
			                <a href="javascript:void(0)" class="list-group-item text-center btn-role">
			                  <h4 class="glyphicon glyphicon-file"></h4><br/>Role Application
			                </a> -->
			                <a href="javascript:void(0)" class="list-group-item text-center btn-group-role">
			                  <h4 class="glyphicon glyphicon-file"></h4><br/>Group of Role
			                </a>
			                <!-- <a href="javascript:void(0)" class="list-group-item text-center btn-des">
			                  <h4 class="glyphicon glyphicon-file"></h4><br/>รายละเอียดสิทธิ
			                </a> -->
			                <a href="javascript:void(0)" class="list-group-item text-center btn-position">
			                  <h4 class="glyphicon glyphicon-file"></h4><br/>ตำแหน่งงาน
			                </a>
			                <a href="javascript:void(0)" class="list-group-item text-center btn-manage">
			                  <h4 class="glyphicon glyphicon-file"></h4><br/>ตำแหน่งบริหารงาน
			                </a>
			                <a href="javascript:void(0)" class="list-group-item text-center btn-level">
			                  <h4 class="glyphicon glyphicon-file"></h4><br/>ระดับตำแหน่งงาน
			                </a>
			                <a href="javascript:void(0)" class="list-group-item text-center btn-branch">
			                  <h4 class="glyphicon glyphicon-file"></h4><br/>หน่วยงาน
			                </a>
			                <a href="javascript:void(0)" class="list-group-item text-center btn-branch-type">
			                  <h4 class="glyphicon glyphicon-file"></h4><br/>ประเภทหน่วยงาน
			                </a>
			                <!-- <a href="javascript:void(0)" class="list-group-item text-center btn-prefix">
			                  <h4 class="glyphicon glyphicon-file"></h4><br/>คำนำหน้าชื่อ
			                </a> -->
			            </div>
			        </div>
		            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 bhoechie-tab load-content-tab">
		            </div>
				</div>
				
		  	</div>
		  	
		</div>

	</div><!-- Content col-md-12 end -->
</div>
<!--/ Container end -->


<script type="text/javascript">
	$(document).ready(function() {

		$('.menu-link').removeClass('active');
		$('.menu-link-ad').addClass('active');

		$("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
	        e.preventDefault();
	        $(this).siblings('a.active').removeClass("active");
	        $(this).addClass("active");
	        var index = $(this).index();
	        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
	        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
	    });

	    //btn-import
	    $('.btn-import').click(function(event) {
	    	/* Act on the event */
	    	$('#exampleModalPrimary2').modal('show');
	    });

	    $('.btn-groupr').click(function(event) {
	    	/* Act on the event */
	    	$('#exampleModalPrimary').modal('show');
	    });

	    //--------------------------------------------------------------------------Load Tab
    	$('.list-group-item').removeClass('active');
		$('.btn-emp').addClass('active');
		$.ajax({
	        type: "POST",
	        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabemp"); ?>",
	        data: {
	            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
	        },
	  
	        success: function (data) {
	            $('.load-content-tab').empty();
	            $('.load-content-tab').html(data);
	        },
	        error: function (data){
	            console.log(data);
	        }
	    }); 

	    //btn-emp
	    $('.btn-emp').click(function(event) {
	    	 
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabemp"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-emp-g
	    $('.btn-emp-g').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabempgroup"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-emp-t
	    $('.btn-emp-t').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabemptype"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-app
	    $('.btn-app').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabapp"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-app-type
	    $('.btn-app-type').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabapptype"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-modal
	    $('.btn-modal').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabmodal"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-role
	    $('.btn-role').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabrole"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-group-role
	    $('.btn-group-role').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabgrouprole"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-des
	    $('.btn-des').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabdes"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-position
	    $('.btn-position').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabposition"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-manage
	    $('.btn-manage').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabmanage"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-level
	    $('.btn-level').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tablevel"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-branch
	    $('.btn-branch').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabbranch"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-branch-type
	    $('.btn-branch-type').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabbranchtype"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });

	    //btn-prefix
	    $('.btn-prefix').click(function(event) {
	    	$('.list-group-item').removeClass('active');
			$(this).addClass('active');
			$.ajax({
		        type: "POST",
		        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabprefix"); ?>",
		        data: {
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		        },
		  
		        success: function (data) {
		            $('.load-content-tab').empty();
		            $('.load-content-tab').html(data);
		        },
		        error: function (data){
		            console.log(data);
		        }
		    }); 
	    });


    });
</script>