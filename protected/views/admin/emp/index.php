<div class="bhoechie-tab-content active">
	<div class="row">
		<div class="sidebar sidebar-left">
			<div class="widget recent-posts" style="margin:0;">
				<h3 class="widget-title" style="margin:0;">ค้นหาข้อมูล</h3>
			</div>
		</div>
		<div class="form-group my-30">
          	<div class="col-md-3 mb-15">			
	           	<label class="txtlabel">หน่อยงานที่ปฏิบัติงาน </label>  
				 
	            <select class="form-control" id="drpdep">
						<option value="">เลือกทั้งหมด</option>
				<?php
					$qusg = new CDbCriteria( array(
						'condition' => "StatusData like :StatusData ",         
						'params' => array(':StatusData' => "1")  
					));
					$modelusg = MasDepartment::model()->findAll($qusg);
					$countusg = count($modelusg);
					$rowno = 1;
					foreach ($modelusg as $rows)
					{
						?>
					<option value="<?php echo $rows->DeptID; ?>"><?php echo "[".$rows->DeptID."] ".$rows->DeptNameTH; ?></option>
					<?php
					}
						?>           
	            </select>
                
        	</div>
        	<div class="col-md-3 mb-15"> 
           	<label class="txtlabel">เลือกกลุ่มผู้ใช้งาน </label>  
           <select class="form-control" id="drpgrouplv">
						<option value="">เลือกทั้งหมด</option>
				<?php
					$qusg = new CDbCriteria( array(
						'condition' => "ug_status like :StatusData ",         
						'params' => array(':StatusData' => "1")  
					));
					$modelusg = MasUserGroup::model()->findAll($qusg);
					$countusg = count($modelusg);
					$rowno = 1;
					foreach ($modelusg as $rows)
					{
						?>
					<option value="<?php echo $rows->ug_id; ?>"><?php echo $rows->ug_description; ?></option>
					<?php
					}
						?>           
	            </select>
    	</div>
    	<div class="col-md-3 mb-15"> 
           	<label class="txtlabel">เลือกประเภทบุคลากร </label>  
              <select class="form-control" id="drpgroupuser">
						<option value="">เลือกทั้งหมด</option>
				<?php
					$qusg = new CDbCriteria( array(
						'condition' => "ut_status like :StatusData ",         
						'params' => array(':StatusData' => "1")  
					));
					$modelusg = MasUserType::model()->findAll($qusg);
					$countusg = count($modelusg);
					$rowno = 1;
					foreach ($modelusg as $rows)
					{
						?>
					<option value="<?php echo $rows->ut_id; ?>"><?php echo $rows->ut_name; ?></option>
					<?php
					}
						?>           
	            </select>
    	</div>
        	
        </div>
	</div>
	<div class="row">
		
		<div class="col-md-5 mb-15"> 
           	<label class="txtlabel">ค้นหาข้อมูล </label>  
             <input type="text" id="idsearch" class="form-control" placeholder="ชื่อ-นามสกุล เลขบัตรประชาชน">  
    	</div>
		<div class="col-md-3 mb-15"> 
           	<label class="txtlabel">ประเภทการค้นหา </label>  
              <select class="form-control" id="typesearch">
						             	<option value="">เลือกทั้งหมด</option>
						                <option value="1">เลขบัตร</option>
						                <option value="2">รหัสผู้ใช้งาน</option>  
						                <option value="3">ชื่อ-นามสกุล</option>  
						                                    
						            </select>
    	</div>
    	<div class="col-md-4 mb-15" style="padding: 25px 20px;"> 
            <label class="txtlabel"> </label>  
            <button class="btn btn-info btn-md" onclick="searchuser()">
                <i class="fa fa-search"></i> ค้นหา
            </button>
            <button class="btn btn-success btn-md btn-import">
                <i class="fa fa-plus"></i> เพิ่มบุคลากร
            </button>
			 <button class="btn btn-info btn-md " onclick="datadpisprocess()">
                <i class="fa fa-plus"></i> processum
            </button> 
             <button class="btn btn-success btn-md " onclick="dataalldpis()">
                <i class="fa fa-plus"></i> ดึกข้อมูลจากDpis
            </button>
<button class="btn btn-success btn-md " onclick="datadpisprocessday()">
                <i class="fa fa-plus"></i> processumday
            </button> 
            </button> 			
        </div>
	</div>
	<div class="row ownload-tab">

</div>
    <div class="row " id="tbuser" >
    	
    </div>
	
</div>

    

<div tabindex="-1" class="modal fade pleaseWaitDialog" id="pleaseWaitDialog" role="dialog" aria-labelledby="pleaseWaitDialog" >
	<div class="modal-dialog modal-lg" align="center" style="margin-top:150px;">
		<div class="modal-content">
			<img src="<?php echo Yii::app()->params['prg_ctrl']['url']['upload']."/thumbnail/loading3.gif" ?>">
		</div>
	</div>
</div>


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
		
		
	$('#ssopersonempdate').datepicker({
		autoclose: true,
		format: 'yyyy/mm/dd',
		todayHighlight: true,
		widgetPositioning: {
			horizontal: 'left',
			vertical: 'bottom'
		},
		language: 'th-TH'
	});

	$('#ssopersonbirthdate').datepicker({
		autoclose: true,
		format: 'yyyy/mm/dd',
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


    });$(document).ready(function() {
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
 jQuery(document).ready(function ($) {	



   //     checkFields();


      });
     
 /*     var dataTable;
function checkFields() {
     
	  var masusertype=$('#drpgroupuser').val();
	  
	  var masusergroup=$('#drpgrouplv').val();
	//  var masapptype=$('#drpgroup').val();
	  var masdepartment=$('#drpdep').val();
	  $.fn.dataTable.ext.legacy.ajax = false;
          $(".employee-grid-error").html("");
          if (typeof dataTable != 'undefined') {
              dataTable.destroy();
          }
         dataTable = $('#Table1').DataTable({
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
                url:"<?php echo Yii::app()->createAbsoluteUrl("admin/Listuser"); ?>",
                data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','masusertype':masusertype,'masusergroup':masusergroup,'masdepartment':masdepartment,},
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
          //  searching: true,
            ordering: true,
           
           

          });
    
        //$("#Table1_length").after("<div class='dataTables_length'><input type='text' name='FSearch1' id='Search1' value='' class='form-control' placeholder='ชื่อ หรือ นามสกุล' maxlength='20' /></div>");


    }
	*/
    $(document).ready(function() {

		
        //btn-import
        $('.btn-import').click(function(event) {
            /* Act on the event */
			$(".form-control").css("border-color", "");
				
				$('#buttonok').show();
				$('#buttonclose').show();
			//	$('#Addemployeemodal')empty();
                $('#Addemployeemodal').modal('show');
				$('#searchdips').show();
                $('#inputSearch').val('');
                $('#username').val('');
                $('#fisrtname').val('');
                $('#surrname').val('');
                $('#title').val('');
                $('#initials').val(''); 
                $('#employeeType').val('');
                $('#ssopersoncitizenid').val('');
                $('#sn').val('');
				$('#maildrop').val('');
                $('#ssopersonposition').val('');
                $('#ssopersonbirthdate').val('');
                $('#ssopersonclass').val('');
                $('#givenName').val('');
            //    $('#maildrop').val('');
                $('#username').val('');
            //  $('#userpassword').val(data.userpassword);
                $('#mail').val('');
                $('#accountActive').val('');
                $('#workingdeptdescription').val('');
                $('#ssopersonempdate').val('');
                $('#PER_GENDER').val('');
                $('#PICPATH').val('');
			//	$('#searchdips').hide();
				$('#iduserper').hide();
				$('#divmail').hide();
				$('#divmaildrop').hide();
				$('#username').attr('disabled', false);
				$('#per_id').attr('disabled', true);
				$('#fisrtname').attr('disabled', false);
				$('#surrname').attr('disabled', false);
				$('#title').attr('disabled', false);
				$('#initials').attr('disabled', false);
				$('#employeeType').attr('disabled', false);
				$('#ssopersoncitizenid').attr('disabled', false);
				$('#sn').attr('disabled', false);
				$('#ssopersonposition').attr('disabled', false);
				$('#ssopersonbirthdate').attr('disabled', false);
				$('#ssopersonclass').attr('disabled', false);
				$('#givenName').attr('disabled', false);
				$('#maildrop').attr('disabled', false);
				$('#mail').attr('disabled', false);
				$('#accountActive').attr('disabled', false);
				$('#workingdeptdescription').attr('disabled', false);
				$('#ssopersonempdate').attr('disabled', false);
				$('#PICPATH').attr('disabled', false);
				$('#PER_GENDER').attr('disabled', false);
				$('#drpdep111').attr('disabled', false);
				$('#PM_NAME').attr('disabled', false);
        });

        $('.btn-groupr').click(function(event) {
            /* Act on the event */
            $('#exampleModalPrimary').modal('show');
        });
		
		//--------------------------------------------------------------------------------------------TABLE
  
    });
function searchdpis() 
{
	
    var pid=$('#inputSearch').val();
   
    $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/searchdpis"); ?>",
            data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','pid':pid},
            dataType: "json",
			
            success: function (data) {
                 if (data.status=='success') {
                    
                $('#username').val(data.username);
                $('#per_id').val(data.PER_ID);
                $('#fisrtname').val(data.ssofirstname);
                $('#surrname').val(data.ssosurname);
                $('#title').val(data.title);
                $('#initials').val(data.initials);  
                $('#employeeType').val(data.employeeType);
                $('#ssopersoncitizenid').val(data.ssopersoncitizenid);
                $('#sn').val(data.sn);
                $('#ssopersonposition').val(data.ssopersonposition);
                $('#ssopersonbirthdate').val(data.ssopersonbirthdate);
                $('#ssopersonclass').val(data.ssopersonclass);
                $('#givenName').val(data.givenName);
                $('#maildrop').val(data.mail);
            //  $('#userpassword').val(data.userpassword);
                $('#mail').val(data.mail);
                $('#accountActive').val(data.accountActive);
                $('#workingdeptdescription').val(data.workingdeptdescription);
                $('#ssopersonempdate').val(data.ssopersonempdate);
                $('#PER_GENDER').val(data.PER_GENDER);
                $('#PICPATH').val(data.PICPATH);
        //$("#exampleModalInfo").modal('hide');
        //      alert("update สำเร็จ");
            //  location.reload();
			 }else{
                alert(data.msg);
            }
            }
        });
}
function savedatauser()
{   

	if($('#fisrtname').val()==''){
		 var inputVal = document.getElementById("fisrtname");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
		}
	}else{
			 var inputVal = document.getElementById("fisrtname");
			inputVal.style.borderColor  = "";
		}
	if($('#surrname').val()==''){
		 var inputVal = document.getElementById("surrname");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
	}else{
			 var inputVal = document.getElementById("surrname");
			inputVal.style.borderColor  = "";
		}
	if($('#title').val()==''){
		 var inputVal = document.getElementById("title");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
		
	}else{
			 var inputVal = document.getElementById("title");
			inputVal.style.borderColor  = "";
		}
	if($('#initials').val()==''){
		 var inputVal = document.getElementById("initials");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
		
	}else{
			 var inputVal = document.getElementById("initials");
			inputVal.style.borderColor  = "";
		}
	if($('#employeeType').val()==''){
		 var inputVal = document.getElementById("employeeType");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
		
	}else{
			 var inputVal = document.getElementById("employeeType");
			inputVal.style.borderColor  = "";
		}
	if($('#ssopersoncitizenid').val()==''){
		 var inputVal = document.getElementById("ssopersoncitizenid");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
		
	}else{
			 var inputVal = document.getElementById("ssopersoncitizenid");
			inputVal.style.borderColor  = "";
		}
	if($('#sn').val()==''){
		 var inputVal = document.getElementById("sn");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
		
	}else{
			 var inputVal = document.getElementById("sn");
			inputVal.style.borderColor  = "";
		}
	if($('#ssopersonposition').val()==''){
		 var inputVal = document.getElementById("ssopersonposition");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
		
	}else{
			 var inputVal = document.getElementById("ssopersonposition");
			inputVal.style.borderColor  = "";
		}
	if($('#ssopersonbirthdate').val()==''){
		 var inputVal = document.getElementById("ssopersonbirthdate");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
		
	}else{
			 var inputVal = document.getElementById("ssopersonbirthdate");
			inputVal.style.borderColor  = "";
		}
	if($('#ssopersonclass').val()==''){
		 var inputVal = document.getElementById("ssopersonclass");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
		
	}else{
			 var inputVal = document.getElementById("ssopersonclass");
			inputVal.style.borderColor  = "";
		}
	if($('#givenName').val()==''){
		var inputVal = document.getElementById("givenName");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
		
	}else{
			 var inputVal = document.getElementById("givenName");
			inputVal.style.borderColor  = "";
		}
	if($('#accountActive').val()==''){
		var inputVal = document.getElementById("accountActive");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
	}else{
			 var inputVal = document.getElementById("accountActive");
			inputVal.style.borderColor  = "";
		}
	if($('#workingdeptdescription').val()==''){
		var inputVal = document.getElementById("workingdeptdescription");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
	}else{
			 var inputVal = document.getElementById("workingdeptdescription");
			inputVal.style.borderColor  = "";
		}
	if($('#drpdep111').val()==''){
		var inputVal = document.getElementById("drpdep111");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
	}else{
			 var inputVal = document.getElementById("drpdep111");
			inputVal.style.borderColor  = "";
		}
	if($('#ssopersonempdate').val()==''){
		var inputVal = document.getElementById("ssopersonempdate");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
	}else{
			 var inputVal = document.getElementById("ssopersonempdate");
			inputVal.style.borderColor  = "";
		}
	if($('#PER_GENDER').val()==''){
		var inputVal = document.getElementById("PER_GENDER");
		if (inputVal.value == "") {
			inputVal.style.borderColor  = "red";
	//	document.getElementById("fisrtname").value = "Question contract";
		
			}
	}else{
			 var inputVal = document.getElementById("PER_GENDER");
			inputVal.style.borderColor  = "";
		}
	
	 
	
	
if($('#workingdeptdescription').val()==''||$('#fisrtname').val()=='' ||  $('#surrname').val()==''|| $('#title').val()==''|| $('#initials').val()=='' ||$('#employeeType').val()=='' || $('#ssopersoncitizenid').val()=='' 
	||$('#sn').val()==''||$('#ssopersonposition').val()==''|| $('#ssopersonbirthdate').val()=='' || $('#ssopersonclass').val()==''|| $('#givenName').val()==''
	||$('#accountActive').val()=='' || $('#drpdep111').val()=='' || $('#ssopersonempdate').val()=='' || $('#PER_GENDER').val()=='' )
	 {
		swal({
							title: "คำเตือน",
							text: "กรุณากรอกข้อมูลให้ครบ",
							type: "warning",
							confirmButtonColor: "#00E5DA",
							confirmButtonText: "ปิด",
							closeOnConfirm: true
							},
						); 
			return;			
	 }
var personcitizenid=$('#ssopersoncitizenid').val();
var citizenid=personcitizenid.length;	 
if(citizenid != 13){
		swal({
							title: "คำเตือน",
							text: "กรุณากรอกเลขให้ครบ13หลัก",
							type: "warning",
							confirmButtonColor: "#00E5DA",
							confirmButtonText: "ปิด",
							closeOnConfirm: true
							},
						); 
		return;
	}	
    var per_id=$('#per_id').val();
    var fisrtname=$('#fisrtname').val();
    var ssosurname=$('#surrname').val();
    var title=$('#title').val();
    var initials=$('#initials').val();
    var employeeType=$('#employeeType').val();
    var ssopersoncitizenid=$('#ssopersoncitizenid').val();
    var sn=$('#sn').val();
    var ssopersonposition=$('#ssopersonposition').val();
    var ssopersonbirthdate=$('#ssopersonbirthdate').val();
    var ssopersonclass=$('#ssopersonclass').val();
    var givenName=$('#givenName').val();
    var maildrop=$('#maildrop').val();
    var username=$('#username').val();
    var mail=$('#mail').val();
    var accountActive=$('#accountActive').val();
    var workingdeptdescription=$('#workingdeptdescription').val();
    var drpdep=$('#drpdep111').val();
    var ssopersonempdate=$('#ssopersonempdate').val();
    var PER_GENDER=$('#PER_GENDER').val();
	
    $.ajax({
            
                type: "POST",
                url: "<?php echo Yii::app()->createAbsoluteUrl("admin/savedatauser"); ?>",
                data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','per_id':per_id,'fisrtname':fisrtname,'ssosurname':ssosurname,'title':title,'initials':initials,'employeeType':employeeType,'ssopersoncitizenid':ssopersoncitizenid,'ssopersonbirthdate':ssopersonbirthdate,'ssopersonclass':ssopersonclass,
                'givenName':givenName,'maildrop':maildrop,'username':username,'mail':mail,'accountActive':accountActive,'workingdeptdescription':workingdeptdescription,'drpdep':drpdep,'ssopersonempdate':ssopersonempdate,'sn':sn,'ssopersonposition':ssopersonposition,'PER_GENDER':PER_GENDER},
                dataType: "json",
                success: function (data) {
            if (data.status=='success') { 
			
						swal({
							title: "ทำรายการสำเร็จ",
							text: "บันทึกสำเร็จ",
							type: "success",
							confirmButtonColor: "#00E5DA",
							confirmButtonText: "ปิด",
							closeOnConfirm: true
							},
						);
				datainsertnew();	
				$('#Addemployeemodal').modal('hide');
				
            }else{
                alert(data.msg);
            }
        }
    }); 
}
function datainsertnew()
{ 
     $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/datainsertusernew"); ?>",
        data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
     //   dataType: "json",               
        success: function (data) {
        
            $('#tbuser').html(data);
        }
    }); 
}
function dataalldpis()
{ 
$('.pleaseWaitDialog').modal('show');
     $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/alldatadpis"); ?>",
        data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
        dataType: "json",               
        success: function (data) {
        if (data.status=='success') { 

$('.pleaseWaitDialog').modal('hide');		
               swal({
							title: "ทำรายการสำเร็จ",
							text: "ดึงข้อมูลสำเร็จ",
							type: "success",
							confirmButtonColor: "#00E5DA",
							confirmButtonText: "ปิด",
							closeOnConfirm: true
							},
						);
            
			}
		}
    }); 
}
function datadpisprocessday()
{
	
$('.pleaseWaitDialog').modal('show');	
	
     $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/datadpisprocessday"); ?>",
        data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
        dataType: "json",               
        success: function (data) {
			$('.pleaseWaitDialog').modal('hide');
            if (data.status=='success') {   
               swal({
							title: "ทำรายการสำเร็จ",
							text: "ดึงข้อมูลสำเร็จ",
							type: "success",
							confirmButtonColor: "#00E5DA",
							confirmButtonText: "ปิด",
							closeOnConfirm: true
							},
						);
            
			}
        }
    });


}
function datadpisprocess()
{
	$('.pleaseWaitDialog').modal('show');
	
     $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/datadpisprocess"); ?>",
        data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
        dataType: "json",               
        success: function (data) {
           var count=data.count;
          datadpisprocess11(count);
             
        }
    }); 
	
}
function datadpisprocess11(count)
{
    
     $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/datadpisprocess11"); ?>",
        data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','count':count,},
        dataType: "json",               
        success: function (data) {
        if (data.status=='success') {
	
	$('.pleaseWaitDialog').modal('hide');
			
               swal({
							title: "ทำรายการสำเร็จ",
							text: "ดึงข้อมูลสำเร็จ",
							type: "success",
							confirmButtonColor: "#00E5DA",
							confirmButtonText: "ปิด",
							closeOnConfirm: true
							},
						);
            //  location.reload();
            }else{
                var count=data.count;
                datadpisprocess11(count);
            }
            
        }
    }); 
}


function changedata(elem)
{
	
	//var drpdep=$(this).val();
	var id = $(elem).attr("data-id");
	var drpdep=$('#drpdep11111'+id).val();
	
	
	
	 $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("admin/updateusergroup"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','drpdep':drpdep,'id':id,},
		dataType: "json",				
		success: function (data) {
		if (data.status=='success') {	
				  swal({
							title: "ทำรายการสำเร็จ",
							text: "เปลี่ยนสิทธิ์สำเร็จ",
							type: "success",
							confirmButtonColor: "#00E5DA",
							confirmButtonText: "ปิด",
							closeOnConfirm: true
							},
						);	
			//	location.reload();
			}else{
				
			}
			
		}
	});
	
}
function editdata(elem)
{
	var id = $(elem).attr("data-id");

	 $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("admin/editdataemployee"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id,},
		dataType: "json",				
		success: function (data) {
		  if (data.status=='success') {
                    
                $('#username').val(data.username);
             //   $('#per_id').val(data.PER_ID);
                $('#fisrtname').val(data.ssofirstname);
                $('#surrname').val(data.ssosurname);
                $('#title').val(data.title);
                $('#initials').val(data.initials);  
                $('#employeeType').val(data.employeeType);
                $('#ssopersoncitizenid').val(data.ssopersoncitizenid);
                $('#sn').val(data.sn);
                $('#ssopersonposition').val(data.ssopersonposition);
                $('#ssopersonbirthdate').val(data.ssopersonbirthdate);
                $('#ssopersonclass').val(data.ssopersonclass);
                $('#givenName').val(data.givenName);
                $('#maildrop').val(data.mail);
            //  $('#userpassword').val(data.userpassword);
                $('#mail').val(data.mail);
                $('#accountActive').val(data.accountActive);
                $('#workingdeptdescription').val(data.workingdeptdescription);
                $('#ssopersonempdate').val(data.ssopersonempdate);
                $('#PER_GENDER').val(data.PER_GENDER);
			//	$('#PICPATH').val(data.PICPATH);
				$('#drpdep111').val(data.um_user_group_id);
			    $('#searchdips').hide();
				$('#buttonok').hide();
				$('#buttonclose').hide();
			    $('#username').attr('disabled', true);
				$('#per_id').attr('disabled', true);
				$('#fisrtname').attr('disabled', true);
				$('#surrname').attr('disabled', true);
				$('#title').attr('disabled', true);
				$('#initials').attr('disabled', true);
				$('#employeeType').attr('disabled', true);
				$('#ssopersoncitizenid').attr('disabled', true);
				$('#sn').attr('disabled', true);
				$('#ssopersonposition').attr('disabled', true);
				$('#ssopersonbirthdate').attr('disabled', true);
				$('#ssopersonclass').attr('disabled', true);
				$('#givenName').attr('disabled', true);
				$('#maildrop').attr('disabled', true);
				$('#mail').attr('disabled', true);
				$('#accountActive').attr('disabled', true);
				$('#workingdeptdescription').attr('disabled', true);
				$('#ssopersonempdate').attr('disabled', true);
				$('#PICPATH').attr('disabled', true);
				$('#PER_GENDER').attr('disabled', true);
				$('#drpdep111').attr('disabled', true);
				$('#PM_NAME').attr('disabled', true);
				$("#modaldetailLabel").html("ดูข้อมูล");   
			    $('#Addemployeemodal').modal('show');
        //$("#exampleModalInfo").modal('hide');
        //      alert("update สำเร็จ");
            //  location.reload();
			 }else{
                alert(data.msg);
            }
            }
	});	
}
function deletedata(elem)
{
	
	var id = $(elem).attr("data-id");
	var userid = $(elem).attr("data-user");
	
	var r = confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่ !");	
    if (r == true) {
	 $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("admin/deleteum_employee"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','id':id,'userid':userid,},
		dataType: "json",				
		success: function (data) {
		if (data.status=='success') {	
				alert("ลบข้อมูลสำเร็จ");
				checkFields();				
			//	location.reload();
			}else{
				//checkFields();
				alert("ลบข้อมูลไม่สำเร็จ");
				//checkFields();
			}
			
			}
		});
	}	
}
function datadpisupdate(elem)
{
var lload = '<div id="load" style="text-align:center"><img style="width:450px; height:250px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading3.gif"></div>';
		$('.ownload-tab').html(lload);	
//alert(lload);

	
	var id = $(elem).attr("data-id");
	var userid = $(elem).attr("data-user");
	
	
	 $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl("admin/datadpisupdate"); ?>",
		data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','userid':userid,},
		dataType: "json",				
		success: function (data) {
		if (data.status=='success') {
			$('.ownload-tab').empty();
				swal({
					title: "ทำรายการสำเร็จ",
					text: "ดึงข้อมูลสำเร็จ",
					type: "success",
					confirmButtonColor: "#00E5DA",
					confirmButtonText: "ปิด",
					closeOnConfirm: true
					},
				);
				 searchuser();	
			}else{
				swal({
					title: "ทำรายการสำเร็จ",
					text: "ดึงข้อมูลไม่สำเร็จ",
					type: "success",
					confirmButtonColor: "#00E5DA",
					confirmButtonText: "ปิด",
					closeOnConfirm: true
					},
				);
			}
			
			}
		});
		
}
function searchuser()
{
	
	
	
	  var typesearch=$('#typesearch').val();
	  var masusertype=$('#drpgroupuser').val();
	  var masusergroup=$('#drpgrouplv').val();
	  var idsearch=$('#idsearch').val();
	  var masdepartment=$('#drpdep').val();
    if(typesearch=='' && masusertype=='' &&  masusergroup=='' &&  idsearch==''&& masdepartment=='')
	{
		swal({
							title: "คำเตือน",
							text: "กรุณาเเลือกข้อมูลที่ค้นหา",
							type: "warning",
							confirmButtonColor: "#00E5DA",
							confirmButtonText: "ปิด",
							closeOnConfirm: true
							},
						);
						return;
	}

	$.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/Searchuser"); ?>",
        data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>','masusertype':masusertype,'masusergroup':masusergroup,'masdepartment':masdepartment,'typesearch':typesearch,'idsearch':idsearch,},
     //   dataType: "json",               
        success: function (data) {
        

				$('#tbuser').empty();
			  $('#tbuser').html(data);
			 // console.log(data);
            //  location.reload();

            
        }
    }); 
}
</script>