<script type="text/javascript">
  $(document).ready(function() {

     //############------------ Click BTN ADD
    $('.btn-add-branch').click(function(){
        $( ".load-md-content" ).empty();
        $( ".load-md-modal" ).modal('show');

        //############------------ LOAD MODAL PAGE CREATE --> Controller = setting / fn = loadmodalbranch

        $('.load-md-content').load("<?php echo Yii::app()->createAbsoluteUrl("admin/loadmodalbranch"); ?>");
    });

     //############------------ Click BTN EDIT
    $('.btn-edit-branch').click(function(){
        var ide = $(this).attr('id');

        //############------------ LOAD MODAL PAGE EDIT --> Controller = setting / fn = loadmodalbranch

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/loadmodalbranch"); ?>",
            data: {
              ide : ide,
              'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
              $( ".load-md-content" ).empty();
              $('.load-md-content').html(data);
              $( ".load-md-modal" ).modal('show');
            },
            error: function (data){
                console.log(data);
            }
        });
    });

    //############------------ Click BTN DELETE
    $('.btn-del-branch').click(function(){

      var idd = $(this).attr('id');

      //############------------ CHECK Confirm
      swal({
        title: "คุณแน่ใจหรือไม่ ?",
        text: "คุณต้องการลบรายการนี้ใช่หรือไม่",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "btn-danger",
        confirmButtonColor: "#ff4c52",
        closeOnConfirm: false,
        confirmButtonText: "ตกลง, ลบรายการนี้ !"

      },
      function(){

          //############------------ SEND DATA TO UPDATE --> Controller = setting / fn = delbranch

          $.ajax({
              type: "POST",
              url: "<?php echo Yii::app()->createAbsoluteUrl("admin/delbranch"); ?>",
              data: {
                idd : idd,
                'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
              },
        
              success: function (data) {
                swal({
                    title: "ทำรายการสำเร็จ",
                    text: "ลบรายการที่ต้องการเรียบร้อย",
                    type: "success",
                    confirmButtonColor: "#00E5DA",
                    confirmButtonText: "ปิด",
                    closeOnConfirm: true
                    },
                function(){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabbranch"); ?>",
                        data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
                  
                        success: function (data) {
                          $('.load-content-tab').empty();
                          $('.load-content-tab').html(data);
                        },
                        error: function (data){
                          console.log(data);
                        }
                    });
                });
              },
              error: function (data){
                  console.log(data);
              }
          });
          
      });

    });

    

    //--------------------------------------------------------------------------------------------TABLE
    $('.table-branch-main tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input class="form-control form-control-sm"  type="text" placeholder="ค้นหา '+title+'" />' );
      } );
   
      // DataTable
      var table = $('.table-branch-main').DataTable({
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
<div class="bhoechie-tab-content active">
    <div class="row">
		<div class="form-group ft-right">
	        <button type="button" class="btn btn-success btn-md btn-add-branch">
	          	<i class="fa fa-plus"></i> เพิ่มสังกัด/สาขา
	        </button>
       	</div>
	</div>
    <div class="row">
    	<table class="table table-striped table-branch-main" style="margin-top:20px;">
            <thead style="background-color:#AED6F1;">
              <tr>
                <th style="width:2%;">No.</th>
                <th>รหัส</th>
                <th>ชื่อสังกัด/สาขา</th>
                <th>ชื่อสังกัด/สาขา ย่อ</th>
                <th>ประเภทสาขา</th>
                <th style="width:2%;">แก้ไข</th>
                <th style="width:2%;">ลบ</th>
              </tr>
            </thead>
            <tbody>

              <?php
                  $qusg = new CDbCriteria( array(
                        'condition' => "StatusData like :StatusData ",         
                        'params'    => array(':StatusData' => "1")  
                  ));
                  $modelusg = MasDepartment::model()->findAll($qusg);
                  $countusg = count($modelusg);
                  $rowno = 1;
                  foreach ($modelusg as $rows){
                      $dp_id = $rows->dp_id; 
                      $DeptID = $rows->DeptID; 
                      $DeptNameEN = $rows->DeptNameEN;
                      $CreateBy = $rows->CreateBy;
                      $CreateDate = $rows->CreateDate;
                      $UpdateBy = $rows->UpdateBy;
                      $UpdateDate = $rows->UpdateDate;
                      $DeptNameTH = $rows->DeptNameTH;
                      $StatusData = $rows->StatusData;
                      $BranchTypeID = $rows->BranchTypeID;
                      $DeptNameDpisTH = $rows->DeptNameDpisTH;
                      $DeptNameDpisEN = $rows->DeptNameDpisEN;
                      $DeptShortName = $rows->DeptShortName;


                  $qusg2 = new CDbCriteria( array(
                    'condition' => "id = :id ",         
                    'params'    => array(':id' => $BranchTypeID)  
                  ));
                  $modelusg2 = MasSsobranchType::model()->findAll($qusg2);
                  foreach ($modelusg2 as $rowss){
                      $id = $rowss->id; 
                      $name = $rowss->name; 
                 
                      
                ?>
                    <tr>
                      <td style=" text-align:center; width:2%;"><?php echo $rowno?></td>
                      <td><?php echo $DeptID?></td>
                      <td><?php echo $DeptNameTH?></td>
                      <td><?php echo $DeptShortName?></td>
                      <td><?php echo $name?></td>
                      <td style="text-align:center; width:5%;"><button class="btn btn-warning btn-sm btn-edit-branch" id="<?php echo $dp_id?>" ><i class="fa fa-edit"></i></button></td>
                      <td style="text-align:center; width:5%;"><button class="btn btn-danger btn-sm btn-del-branch" id="<?php echo $dp_id?>" ><i class="fa fa-trash"></i></button></td>
                    </tr>
                  <?php
                    $rowno += 1;
                    }
                  }//foreach ($model as $rows){
                ?>  
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