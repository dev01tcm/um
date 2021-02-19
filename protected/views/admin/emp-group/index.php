<script>
  $(document).ready(function() {

     //############------------ Click BTN ADD
    $('.btn-add-group').click(function(){
        $( ".load-md-content" ).empty();
        $( ".load-md-modal" ).modal('show');

        //############------------ LOAD MODAL PAGE CREATE --> Controller = setting / fn = loadmodalgroup

        $('.load-md-content').load("<?php echo Yii::app()->createAbsoluteUrl("admin/loadmodalgroup"); ?>");
    });

    //############------------ Click BTN EDIT
    $('.btn-edit-group').click(function(){
        var ide = $(this).attr('id');

        //############------------ LOAD MODAL PAGE EDIT --> Controller = setting / fn = loadmodalgroup

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/loadmodalgroup"); ?>",
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
    $('.btn-del-group').click(function(){

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

          //############------------ SEND DATA TO UPDATE --> Controller = setting / fn = delgroup

          $.ajax({
              type: "POST",
              url: "<?php echo Yii::app()->createAbsoluteUrl("admin/delgroup"); ?>",
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
                        url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabempgroup"); ?>",
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
    $('.table-emp-group tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input class="form-control form-control-sm"  type="text" placeholder="ค้นหา '+title+'" />' );
      } );
   
      // DataTable
      var table = $('.table-emp-group').DataTable({
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
	        <button type="button" class="btn btn-success btn-md btn-add-group">
	          	<i class="fa fa-plus"></i> เพิ่มกลุ่มผู้ใช้งาน
	        </button>
       	</div>
	</div>
    <div class="row">
    	<table class="table table-striped table-emp-group" style="margin-top:20px;">
            <thead style="background-color:#AED6F1;">
              <tr>
                <th style="width:2%;">No.</th>
                <th>ชื่อกลุ่มผู้ใช้งาน</th>
                <th>รายละเอียด</th>
                <th style="width:5%;">แก้ไข</th>
                <th style="width:5%;">ลบ</th>
              </tr>
            </thead>
            <tbody>
        <?php
          $qusg = new CDbCriteria( array(
                'condition' => "ug_status like :ug_status ",         
                'params'    => array(':ug_status' => "1")  
          ));
          $modelusg = MasUserGroup::model()->findAll($qusg);
          $countusg = count($modelusg);
          $rowno = 1;
          foreach ($modelusg as $rows){
              $ug_id = $rows->ug_id; 
              $ug_name = $rows->ug_name;
              $ud_createby = $rows->ud_createby;
              $ud_createdate = $rows->ud_createdate;
              $ud_updateby = $rows->ud_updateby;
              $ud_updatedate = $rows->ud_updatedate;
              $ug_description = $rows->ug_description;
              $ug_status = $rows->ug_status;
        ?>
        <tr>
          <td style=" text-align:center; width:2%;"><?php echo $rowno?></td>
          <td><?php echo $ug_name?></td>
          <td><?php echo $ug_description?></td>
          <td style="text-align:center; width:5%;"><button class="btn btn-warning btn-sm btn-edit-group" id="<?php echo $ug_id?>"><i class="fa fa-edit"></i></button></td>
          <td style="text-align:center; width:5%;"><button class="btn btn-danger btn-sm btn-del-group" id="<?php echo $ug_id?>"><i class="fa fa-trash"></i></button></td>
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
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
      	</table>
    </div>
</div>