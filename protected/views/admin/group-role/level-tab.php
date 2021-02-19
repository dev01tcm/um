<div class="row">
	<div class="col-md-12" style="margin-top:20px;height:500px;overflow:auto;">
		<table class="table table-striped table-level" >
	        <thead style="background-color:#AED6F1;">
	          <tr>
	            <th style="width:2%;">No.</th>
	            <th>ชื่อระดับตำแหน่งงาน</th>
	            <th>จัดการ เปิด/ปิด</th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php
	          	$grouprole_id = $_POST['ide'];

	            $qusg = new CDbCriteria( array(
	                  'condition' => "StatusData like :StatusData ",         
	                  'params'    => array(':StatusData' => "1")  
	            ));
	            $modelusg = MasPositionLe::model()->findAll($qusg);
	            $countusg = count($modelusg);
	            $rowno = 1;
	            foreach ($modelusg as $rows){
	                $PositLevelID = $rows->PositLevelID; 
	                $PositLevelNameTH = $rows->PositLevelNameTH;
	                $CreateBy = $rows->CreateBy;
	                $CreateDate = $rows->CreateDate;
	                $UpdateBy = $rows->UpdateBy;
	                $UpdateDate = $rows->UpdateDate;
	                $PositLevelNameEN = $rows->PositLevelNameEN;
	                $StatusData = $rows->StatusData;
	                

	                $CallAppss = AdminController::CallRelationle($grouprole_id,$PositLevelID);

	                $CallAppssCHK = AdminController::CallRelationleCHK($PositLevelID);

	                if(isset($CallAppss['gl_id'])){
	                	if($CallAppss['gl_status']=='1'){
	                		$Strh = 'checked';
	                		$valid = $CallAppss['gl_id'];
	                		
	                	}else{
	                		$Strh = '';
	                		$valid = $CallAppss['gl_id'];
	                		
	                	}
	                	
	                }else{
	                	$Strh = '';
	                	$valid = '0';
	                	
	                }

	                if(isset($CallAppssCHK['gl_id'])){
	                	if($CallAppssCHK['id_grouprole']!=$_POST['ide']){
	                		$ddisplay="none";
	                	}else{
	                		$ddisplay="";
	                	}

	                }else{
	                	$ddisplay="";
	                }



	                
	          ?>
	          <tr style="display: <?php echo $ddisplay?>">
	            <td style=" text-align:center; width:2%;"><?php echo $rowno?></td>
	            <td><?php echo $PositLevelNameTH?></td>
	            <td style="text-align:center;">
	            	<label class="switch">
					  <input type="checkbox" id="<?php echo $PositLevelID?>" value="<?php echo $_POST['ide']?>" valid="<?php echo $valid?>" <?php echo $Strh?> >
					  <span class="slider round"></span>
					</label>
				</td>
	          </tr>
	        <?php


	            $rowno += 1;
	          }//foreach ($model as $rows){
	        ?>  
	          
	        </tbody>
	        <tfoot>
	            <tr>
	                <th></th>
	                <th></th>
	                <th></th>
	            </tr>
	        </tfoot>
	  	</table>
	</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {

  	$('input[type="checkbox"]').click(function(){

  		// alert('2');
  		var chkid = $(this).attr('id');
        var groleid = $(this).val();
        var valid = $(this).attr('valid');

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabrelale"); ?>",
            data: {
                ide : "<?php echo $_POST['ide']?>",
                'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
                $('.load-rela-tab').empty();
                $('.load-rela-tab').html(data);
            },
            error: function (data){
                console.log(data);
            }
        }); 
        
        packdata = {
	        chkid:chkid,
	        groleid:groleid,
	        valid:valid,
	    };

        if($(this).prop("checked") == true){

          //############------------ SEND DATA TO --> Controller = setting / fn = insertrelalevel

	      $.ajax({
	          type: "POST",
	          url: "<?php echo Yii::app()->createAbsoluteUrl("admin/insertrelalevel"); ?>",
	          data: {
	            packdata : packdata,
	            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
	          },
	    
	          success: function (data) {
	               return true;
	          },
	          error: function (data){
	              console.log(data);
	          }
	      });
        }
        else if($(this).prop("checked") == false){

            //############------------ SEND DATA TO --> Controller = setting / fn = updaterelalevel

		      $.ajax({
		          type: "POST",
		          url: "<?php echo Yii::app()->createAbsoluteUrl("admin/updaterelalevel"); ?>",
		          data: {
		            packdata : packdata,
		            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
		          },
		    
		          success: function (data) {
		               return true;
		          },
		          error: function (data){
		              console.log(data);
		          }
		      });
        }
    });

    //--------------------------------------------------------------------------------------------TABLE
    $('.table-level tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input class="form-control form-control-sm"  type="text" placeholder="ค้นหา '+title+'" />' );
      } );
   
      // DataTable
      var table = $('.table-level').DataTable({
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
          "order": [[ 0, "asc" ]],
          "lengthMenu": [[-1], [ "All"]],
          initComplete: function () {
              // Apply the search
              this.api().columns().every( function () {
                  var that = this;
   
                  $( 'input', this.footer() ).on( 'keyup change clear', function () {
                      if ( that.search() !== this.value ) {
                          that
                              .search( this.value )
                              .draw();
                      }
                  } );
              } );
          }
      });

  });
</script>