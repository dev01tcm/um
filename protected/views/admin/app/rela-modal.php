
<div class="modal-header">
  <button class="close" aria-label="Close" type="button" data-dismiss="modal">
    <span class="font-01 font-w" aria-hidden="true"><i class="fa fa-close"></i></span>
  </button>
  <h2 class="modal-title font-01 font-w"> จัดการ APP : <?php echo $_POST['name'];?></h2>
</div>


<div class="modal-body font-03">
  <div class="example-wrap">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-branch" style="height:500px;overflow:auto;">
              <thead style="background-color:#AED6F1;">
                <tr>
                  <th style="width:2%;">No.</th>
                  <th>ชื่อ-นามสกุล</th>
                  <th>จัดการ เปิด/ปิด</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $grouprole_id = $_POST['ide'];

                  $qusg = new CDbCriteria( array(
                        'condition' => "em_status like :em_status and  um_user_group_id = :um_user_group_id",         
                        'params'    => array(':em_status' => "1", ':um_user_group_id' => '4')  
                  ));
                  $modelusg = UmEmployee::model()->findAll($qusg);
                  $countusg = count($modelusg);
                  $rowno = 1;
                  foreach ($modelusg as $rows){
                      $em_id = $rows->em_id; 
                      $em_per_id = $rows->em_per_id;
                      $em_username = $rows->em_username;
                      $em_name_th = $rows->em_name_th;
                      $em_surname_th = $rows->em_surname_th;
                      $createdate = $rows->createdate;
                      $createby = $rows->createby;
                      $updatedate = $rows->updatedate;
                      $updateby = $rows->updateby;

                      

                      $CallAppss = AdminController::CallRelationemp($grouprole_id,$em_id);

                      if(isset($CallAppss['ae_id'])){
                        if($CallAppss['ae_status']=='1'){
                          $Strh = 'checked';
                          $valid = $CallAppss['ae_id'];
                        }else{
                          $Strh = '';
                          $valid = $CallAppss['ae_id'];
                        }
                        
                      }else{
                        $Strh = '';
                        $valid = '0';
                        
                      }
                ?>
                <tr>
                  <td style=" text-align:center; width:2%;"><?php echo $rowno?></td>
                  <td><?php echo '['.$em_username.'] '.$em_name_th.' '.$em_surname_th?></td>
                  <td style="text-align:center;">
                    <label class="switch">
                <input type="checkbox" id="<?php echo $em_id?>" value="<?php echo $_POST['ide']?>" valid="<?php echo $valid?>" <?php echo $Strh?> >
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
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {

    $('input[type="checkbox"]').click(function(){
      var chkid = $(this).attr('id');
        var groleid = $(this).val();
        var valid = $(this).attr('valid');

        
        

      $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/loadmodalrelaapp"); ?>",
            data: {
              ide : "<?php echo $_POST['ide'];?>",
              name : "<?php echo $_POST['name'];?>",
              'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
              $( ".load-md-content" ).empty();
              $('.load-md-content').html(data);
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


          //############------------ SEND DATA TO --> Controller = setting / fn = insertrelapprela

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/insertrelapprela"); ?>",
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

            //############------------ SEND DATA TO --> Controller = setting / fn = updaterelaapp

          $.ajax({
              type: "POST",
              url: "<?php echo Yii::app()->createAbsoluteUrl("admin/updaterelaapp"); ?>",
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
    $('.table-branch tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input class="form-control form-control-sm"  type="text" placeholder="ค้นหา '+title+'" />' );
      } );
   
      // DataTable
      var table = $('.table-branch').DataTable({
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
