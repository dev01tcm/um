<script type="text/javascript">
  $(document).ready(function() {

    

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
	        <button type="button" class="btn btn-success btn-md btn-add-gfrole">
	          	<i class="fa fa-plus"></i> เพิ่ม รายละเอียดสิทธิ์
	        </button>
       	</div>
	</div>
    <div class="row">
    	<table class="table table-striped" style="margin-top:20px;">
            <thead style="background-color:#AED6F1;">
              <tr>
                <th style="width:2%;">No.</th>
                <th>Application</th>
                <th>Module</th>
                <th>ระดับตำแหน่ง</th>
                <th>รายละเอียด</th>
                <th style="width:2%;">แก้ไข</th>
                <th style="width:2%;">ลบ</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $qusg = new CDbCriteria( array(
                      'condition' => "dp_status like :dp_status ",         
                      'params'    => array(':dp_status' => "1")  
                ));
                $modelusg = MasDesPermission::model()->findAll($qusg);
                $countusg = count($modelusg);
                $rowno = 1;
                foreach ($modelusg as $rows){
                    $dp_id = $rows->dp_id; 
                    $mas_app_id = $rows->mas_app_id;
                    $createby = $rows->createby;
                    $createdate = $rows->createdate;
                    $updateby = $rows->updateby;
                    $updatedate = $rows->updatedate;
                    $dp_description = $rows->dp_description;
                    $dp_status = $rows->dp_status;

                    $mas_module_id = $rows->mas_module_id;
                    $mas_officer_id = $rows->mas_officer_id;

                    $nameApp = AdminController::CallNameApp($mas_app_id);
                    $nameModule = AdminController::CallNameModule($mas_module_id);
                    $nameOfficer = AdminController::CallNameOfficer($mas_officer_id);

                    
              ?>
                  <tr>
                    <td style=" text-align:center; width:5%;"><?php echo $dp_id?></td>
                    <td style="width:15%;"><?php echo $nameApp?></td>
                    <td style="width:10%;"><?php echo $nameModule?></td>
                    <td style="width:10%;"><?php echo $nameOfficer?></td>
                    <td style="width:50%;"><?php echo $dp_description?></td>
                    <td style="text-align:center; width:5%;"><button class="btn btn-warning btn-sm btn-edit-gfrole"><i class="fa fa-edit"></i></button></td>
                    <td style="text-align:center; width:5%;"><button class="btn btn-danger btn-sm btn-del-gfrole" ><i class="fa fa-trash"></i></button></td>
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
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
      	</table>
    </div>
</div>