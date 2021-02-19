<div class="container">
	<div class="col-md-12">
		<h3 class="section-sub-title">รายงาน</h3>
		<ol class="breadcrumb">
            <li>หน้าแรก</li>
            <li class="navigator">รายงาน</li>
        </ol>
	</div>
	<!--/ Title row end -->

	<div class="col-md-12">
		
		<ul class="nav nav-tabs " id="myTab" role="tablist">
		  <li class="nav-item active">
		    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">รายงานของระบบ</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="two" aria-selected="true">รายงาน Log</a>
		  </li>
		  
		</ul>
		<div class="tab-content" id="myTabContent">
		  	<div class="tab-pane fade  active in" id="home" role="tabpanel" aria-labelledby="home-tab">
		  	
				<div class="row bhoechie-tab-container">
	            	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 bhoechie-tab-menu">
		              <div class="list-group  list-menu">
		                <a href="#" class="list-group-item text-center">
		                  <h4 class="glyphicon glyphicon-remove"></h4><br/>ความผิดพลาดของข้อมูล
		                </a>
		                <a href="#" class="list-group-item text-center">
		                  <h4 class="glyphicon glyphicon-download-alt"></h4><br/>การขอสิทธิ
		                </a>
		                <a href="#" class="list-group-item text-center">
		                  <h4 class="glyphicon glyphicon-check"></h4><br/>การอนุมัติสิทธิ
		                </a>
		                <a href="#" class="list-group-item text-center">
		                  <h4 class="glyphicon glyphicon-transfer"></h4><br/>การโยกย้ายสาขา
		                </a>
		                <a href="#" class="list-group-item text-center">
		                  <h4 class="glyphicon glyphicon-random"></h4><br/>การโยกย้ายหน่วยงาน
		                </a>
		                <a href="#" class="list-group-item text-center">
		                  <h4 class="glyphicon glyphicon-file"></h4><br/>ข้อมูล DPIS
		                </a>
		                <a href="#" class="list-group-item text-center">
		                  <h4 class="glyphicon glyphicon-file"></h4><br/>ข้อมูล LDAP
		                </a>
		                <a href="#" class="list-group-item text-center">
		                  <h4 class="glyphicon glyphicon-file"></h4><br/>ข้อมูล Service
		                </a>
		              </div>
		            </div>
		            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 bhoechie-tab">
		                <!-- flight section -->
		                <div class="bhoechie-tab-content active">
		                	<div class="row">
		                		<div class="form-group my-30">
							        <div class="col-md-4 mb-15"> 
							          <input type="text" class="form-control" readonly  placeholder="เริ่มวันที่" name="txtStartDate" id="txtStartDate">
							        </div>
							        <div class="col-md-4 mb-15">
							          <input type="text" class="form-control" readonly  placeholder="ถึงวันที่" name="txtEndDate" id="txtEndDate">
									   <div class="input-group-append">
							        </div>
							        <div class="col-md-4 mb-15">
							          <button type="button" class="btn btn-info btn-md" onclick="fn_SearchData()">
							          	<i class="fa fa-search"></i> ค้นหา
							          </button>
							        </div> 
						       	</div>
		                	</div>
		                    <div class="row">
		                    	<table id="Tablereport11" class="table table-striped" style="margin-top:20px; width:100%"  >
			                        <thead style="background-color:#AED6F1;">
			                          <tr>
			                             <th style="width:2%;">No.</th>
										 <th>userid</th>
										 <th>ชื่อ</th>
										 <th>นามสกุล</th>
										 <th>ตำแหน่ง</th>
										 <th>ระดับตำแหน่ง</th>
										 <th>สาขา</th>
						
									 </tr>
								   </thead>
									<tbody>
									</tbody>
									<tfoot>
									  <tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
									  </tr>
									</tfoot>
		                      	</table>
		                    </div>
		                </div>
		                <!-- train section -->
		                <div class="bhoechie-tab-content">
		                    <center>
		                      <h1 class="glyphicon glyphicon-road" style="font-size:12em;color:#55518a"></h1>
		                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
		                      <h3 style="margin-top: 0;color:#55518a">Train Reservation</h3>
		                    </center>
		                </div>
		    
		                <!-- hotel search -->
		                <div class="bhoechie-tab-content">
		                    <center>
		                      <h1 class="glyphicon glyphicon-home" style="font-size:12em;color:#55518a"></h1>
		                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
		                      <h3 style="margin-top: 0;color:#55518a">Hotel Directory</h3>
		                    </center>
		                </div>
		                <div class="bhoechie-tab-content">
		                    <center>
		                      <h1 class="glyphicon glyphicon-cutlery" style="font-size:12em;color:#55518a"></h1>
		                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
		                      <h3 style="margin-top: 0;color:#55518a">Restaurant Diirectory</h3>
		                    </center>
		                </div>
		                <div class="bhoechie-tab-content">
		                    <center>
		                      <h1 class="glyphicon glyphicon-credit-card" style="font-size:12em;color:#55518a"></h1>
		                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
		                      <h3 style="margin-top: 0;color:#55518a">Credit Card</h3>
		                    </center>
		                </div>
		                <!-- hotel search -->
		                <div class="bhoechie-tab-content">
		                    <center>
		                      <h1 class="glyphicon glyphicon-home" style="font-size:12em;color:#55518a"></h1>
		                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon1</h2>
		                      <h3 style="margin-top: 0;color:#55518a">Hotel Directory</h3>
		                    </center>
		                </div>
		                <div class="bhoechie-tab-content">
		                    <center>
		                      <h1 class="glyphicon glyphicon-cutlery" style="font-size:12em;color:#55518a"></h1>
		                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon2</h2>
		                      <h3 style="margin-top: 0;color:#55518a">Restaurant Diirectory</h3>
		                    </center>
		                </div>
		                <div class="bhoechie-tab-content">
		                    <center>
		                      <h1 class="glyphicon glyphicon-credit-card" style="font-size:12em;color:#55518a"></h1>
		                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon3</h2>
		                      <h3 style="margin-top: 0;color:#55518a">Credit Card</h3>
		                    </center>
		                </div>
		                <div class="bhoechie-tab-content">
		                    <center>
		                      <h1 class="glyphicon glyphicon-credit-card" style="font-size:12em;color:#55518a"></h1>
		                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon4</h2>
		                      <h3 style="margin-top: 0;color:#55518a">Credit Card</h3>
		                    </center>
		                </div>
		            </div>
				</div>
				
		  	</div>
		  	<div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">
		  		111111111111111111111111111111
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
		
		
	$('#txtStartDate').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		widgetPositioning: {
			horizontal: 'left',
			vertical: 'bottom'
		},
		language: 'th-TH'
	});

	$('#txtEndDate').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		widgetPositioning: {
			horizontal: 'left',
			vertical: 'bottom'
		},
		language: 'th-TH'
	});

	//$("#ddDeptID").select2();

	//fn_Reset();


//	$('#Tablereport').DataTable({});


	// Date Now //
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = (today.getFullYear()+543);

	today = dd + '/' + mm + '/' + yyyy;
		

	$('#txtStartDate').val(today);
	$('#txtEndDate').val(today);


    });
var dataTable;
function fn_SearchData() 
{
	var StartDate = $('#txtStartDate').val();
	var EndDate = $('#txtEndDate').val();
	
	
	  $.fn.dataTable.ext.legacy.ajax = false;
          $(".employee-grid-error").html("");
          if (typeof dataTable != 'undefined') {
              dataTable.destroy();
          }
         dataTable = $('#Tablereport11').DataTable({
			    "oLanguage": {
          "sEmptyTable":     "ไม่มีข้อมูลในระบบ",
          "sInfo": "แสดงรายการที่ _START_ ถึง _END_ ของ _TOTAL_ รายการทั้งหมด",
              "sInfoEmpty": "แสดงรายการที่ 0 ถึง 0 ของ 0 รายการทั้งหมด",
          "sInfoFiltered":   "(กรองข้อมูลทั้งหมด _MAX_ ทุกรายการ)",
          "sInfoPostFix":    "",
          "sInfoThousands":  ",",
          "sLengthMenu":     "แสดงรายการทั้งหมด _MENU_ รายการ ต่อหน้า",
          "sLoadingRecords": "กำลังโหลดข้อมูล...",
          "sProcessing":     "กำลังดำเนินการ...",
          "sSearch":         "ค้นหา: ",
          "sZeroRecords":    "ไม่พบข้อมูล",
          "oPaginate": {
              "sFirst":    "หน้าแรก",
          "sPrevious": "ก่อนหน้า",
              "sNext":     "ถัดไป",
          "sLast":     "หน้าสุดท้าย"
          },
          "oAria": {
              "sSortAscending":  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
          "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
          }
          },
            responsive: true,
            "processing": true,
            "serverSide": true,
            "ajax": {
				type: "post",
                url:"<?php echo Yii::app()->createAbsoluteUrl("admin/report"); ?>",
                data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','StartDate':StartDate,'EndDate':EndDate,},
				dataType: "json",   
                 // method  , by default get
                dataType: "json",
                error: function () {  // error handling

                    $(".employee-grid-error").html("");
                    $("#Table1").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                 //   $("#Table1_processing").css("display", "none");
                }
            },
		  //  "scrollY": 200,
		//	"scrollX": true
            searching: false,
            ordering: false,
		  });	
	
}
</script>