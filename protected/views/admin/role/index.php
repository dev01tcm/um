<script type="text/javascript">
  $(document).ready(function() {

     //############------------ Click BTN ADD
    $('.btn-add-role').click(function(){
        $( ".load-md-content" ).empty();
        $( ".load-md-modal" ).modal('show');

        //############------------ LOAD MODAL PAGE CREATE --> Controller = setting / fn = loadmodalrole

        $('.load-md-content').load("<?php echo Yii::app()->createAbsoluteUrl("admin/loadmodalrole"); ?>");
    });

    //############------------ Click BTN EDIT
    $('.btn-edit-role').click(function(){
        var ide = $(this).attr('id');

        //############------------ LOAD MODAL PAGE EDIT --> Controller = setting / fn = loadmodalrole

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/loadmodalrole"); ?>",
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

    

    //--------------------------------------------------------------------------------------------TABLE
    $('.table tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input class="form-control form-control-sm"  type="text" placeholder="ค้นหา '+title+'" />' );
      } );
   
      // DataTable
      var table = $('.table').DataTable({
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
          <button type="button" class="btn btn-success btn-md btn-add-role">
              <i class="fa fa-plus"></i> เพิ่ม Role
          </button>
        </div>
    </div>
    <div class="row">
    	<table class="table table-striped" style="margin-top:20px;">
            <thead style="background-color:#AED6F1;">
              <tr>
                <th style="width:2%;">No.</th>
                <th>ชื่อ Role</th>
                <th>รายละเอียด</th>
                <th>Module</th>
                <th>Application</th>
                <th style="width:2%;">แก้ไข</th>
                <th style="width:2%;">ลบ</th>
              </tr>
            </thead>
            <tbody>
              <?php
                  $qusg = new CDbCriteria( array(
                        'condition' => "ra_status like :ra_status ",         
                        'params'    => array(':ra_status' => "1")  
                  ));
                  $modelusg = MasRoleApp::model()->findAll($qusg);
                  $countusg = count($modelusg);
                  $rowno = 1;
                  foreach ($modelusg as $rows){
                      $ra_id = $rows->ra_id; 
                      $ra_name = $rows->ra_name;
                      $ra_description = $rows->ra_description;
                      $mas_module_id = $rows->mas_module_id;
                      $mas_app_id = $rows->mas_app_id;
                      $ra_status = $rows->ra_status;
                      $createby = $rows->createby;
                      $createdate = $rows->createdate;
                      $updateby = $rows->updateby;
                      $updatedate = $rows->updatedate;


                  $qusg2 = new CDbCriteria( array(
                    'condition' => "ma_id = :ma_id ",         
                    'params'    => array(':ma_id' => $mas_module_id)  
                  ));
                  $modelusg2 = MasModuleApp::model()->findAll($qusg2);
                  foreach ($modelusg2 as $rowss){
                      $ma_id = $rowss->ma_id; 
                      $ma_name = $rowss->ma_name; 

                   //------------------------------------------------------   

                  $qusg3 = new CDbCriteria( array(
                    'condition' => "app_id = :app_id ",         
                    'params'    => array(':app_id' => $mas_app_id)  
                  ));
                  $modelusg3 = MasApp::model()->findAll($qusg3);
                  foreach ($modelusg3 as $rowsss){
                      $app_id = $rowsss->app_id; 
                      $app_shortname = $rowsss->app_shortname; 
                 
                      
                ?>
                    <tr>
                      <td style=" text-align:center; width:2%;"><?php echo $rowno?></td>
                      <td><?php echo $ra_name?></td>
                      <td><?php echo $ra_description?></td>
                      <td><?php echo $ma_name?></td>
                      <td><?php echo $app_shortname?></td>
                      <td style="text-align:center; width:5%;"><button class="btn btn-warning btn-sm btn-edit-role" id="<?php echo $ra_id?>" ><i class="fa fa-edit"></i></button></td>
                      <td style="text-align:center; width:5%;"><button class="btn btn-danger btn-sm btn-del-role" id="<?php echo $ra_id?>" ><i class="fa fa-trash"></i></button></td>
                    </tr>
                  <?php
                    $rowno += 1;
                      }
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