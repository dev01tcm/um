
  <table class="table table-bordered table-hover table-striped table-approver-emp" cellspacing="0" id="exampleAddRow14">
        <thead>
          <tr>
            <th style="width:50px;">Images
            </th>
            <th>ชื่อ-นามสกุล</th>
            <th>Username</th>
            <th>ตำแหน่ง</th>
            <th>ระดับ</th>
            <th>สาขา</th>
            <th>APP</th>
            <!-- <th>กำหนดสิทธิ์</th> -->
            <th>ผู้แทนสิทธิ์</th>
            <th>โยกย้าย</th>
          </tr>
        </thead>
        <tbody>
          <?php

          if(isset($_POST["typesearch"])){ //--------have

            if($_POST["typesearch"]=='1'){

              if($_POST["depart"]=="all"){

                  if(Yii::app()->session['um_user_group_id']=='5' || Yii::app()->session['um_user_group_id']=='3' || Yii::app()->session['um_user_group_id']=='4'){

                    $str_depart = substr(Yii::app()->session['mas_department_id'],0,2);

                    if($str_depart=='10'){
                        $str_depart_val = Yii::app()->session['mas_department_id'];
                        $qusg = new CDbCriteria( array(
                              'condition' => "em_status like :em_status and  mas_department_id like :mas_department_id",         
                              'params'    => array(':em_status' => "1", ':mas_department_id' => $str_depart_val)  
                        ));
                    }else{
                        $str_depart = substr(Yii::app()->session['mas_department_id'],0,2);
                        $qusg = new CDbCriteria( array(
                              'condition' => "em_status like :em_status and  mas_department_id like :mas_department_id",         
                              'params'    => array(':em_status' => "1", ':mas_department_id' => $str_depart.'%')  
                        ));
                    }

                  }else{
                    $qusg = new CDbCriteria( array(
                        'condition' => "em_status like :em_status ",         
                        'params'    => array(':em_status' => "1")  
                    ));
                  }
                  
              }else{
                  $str_depart = $_POST["depart"];
                  $qusg = new CDbCriteria( array(
                        'condition' => "em_status like :em_status and  mas_department_id like :mas_department_id ",         
                        'params'    => array(':em_status' => "1", ':mas_department_id' => $str_depart)  
                  ));
              }

            }else if($_POST["typesearch"]=='2'){

              if(Yii::app()->session['um_user_group_id']=='5' || Yii::app()->session['um_user_group_id']=='3' || Yii::app()->session['um_user_group_id']=='4'){

                $str_depart = substr(Yii::app()->session['mas_department_id'],0,2);
                $str_depart2 = substr(Yii::app()->session['mas_department_id'],0,2);

                if($str_depart=='10'){
                    $str_depart_val = Yii::app()->session['mas_department_id'];
                    $str_citizen = $_POST["depart"];
                    $qusg = new CDbCriteria( array(
                          'condition' => "em_status like :em_status and  em_citizen_id like :em_citizen_id and  mas_department_id like :mas_department_id",         
                          'params'    => array(':em_status' => "1", ':em_citizen_id' => $str_citizen, ':mas_department_id' => $str_depart_val)  
                    ));
                }else{
                    $str_citizen = $_POST["depart"];
                    $str_depart_val = substr(Yii::app()->session['mas_department_id'],0,2);
                    $qusg = new CDbCriteria( array(
                          'condition' => "em_status like :em_status and  em_citizen_id like :em_citizen_id and  mas_department_id like :mas_department_id",         
                          'params'    => array(':em_status' => "1", ':em_citizen_id' => $str_citizen, ':mas_department_id' => $str_depart_val.'%')  
                    ));
                }

              }else{

                $str_depart = $_POST["depart"];
                $qusg = new CDbCriteria( array(
                      'condition' => "em_status like :em_status and  em_citizen_id like :em_citizen_id",         
                      'params'    => array(':em_status' => "1", ':em_citizen_id' => $str_depart)  
                ));

              }
            }else if($_POST["typesearch"]=='3'){

              if(Yii::app()->session['um_user_group_id']=='5' || Yii::app()->session['um_user_group_id']=='3' || Yii::app()->session['um_user_group_id']=='4'){

                 $str_depart2 = substr(Yii::app()->session['mas_department_id'],0,2);

                  if($str_depart2=='10'){
                      $str_depart = $_POST["depart"];
                      $str_depart_val = Yii::app()->session['mas_department_id'];
                      $qusg = new CDbCriteria( array(
                          'condition' => "em_status like :em_status and  mas_department_id like :mas_department_id and  (em_name_th like :em_name_th or em_surname_th like :em_surname_th) ",         
                          'params'    => array(':em_status' => "1", ':em_name_th' => $str_depart.'%', ':em_surname_th' => $str_depart.'%', ':mas_department_id' => $str_depart_val)  
                      ));
                  }else{
                      $str_depart = $_POST["depart"];
                      $str_depart_val = substr(Yii::app()->session['mas_department_id'],0,2);
                      $qusg = new CDbCriteria( array(
                            'condition' => "em_status like :em_status and  mas_department_id like :mas_department_id and  (em_name_th like :em_name_th or em_surname_th like :em_surname_th) ",         
                            'params'    => array(':em_status' => "1", ':em_name_th' => $str_depart.'%', ':em_surname_th' => $str_depart.'%', ':mas_department_id' => $str_depart_val.'%')  
                      ));
                  }

              }else{

                $str_depart = $_POST["depart"];
                $qusg = new CDbCriteria( array(
                      'condition' => "em_status like :em_status and  em_name_th like :em_name_th or em_surname_th like :em_surname_th",         
                      'params'    => array(':em_status' => "1", ':em_name_th' => $str_depart.'%', ':em_surname_th' => $str_depart.'%')  
                ));

              }
                
            }else{

                $str_depart = substr(Yii::app()->session['mas_department_id'],0,2);

                if($str_depart=='10'){
                    $str_depart_val = Yii::app()->session['mas_department_id'];
                    $qusg = new CDbCriteria( array(
                          'condition' => "em_status like :em_status and  mas_department_id like :mas_department_id",         
                          'params'    => array(':em_status' => "1", ':mas_department_id' => $str_depart_val)  
                    ));
                }else{
                    $str_depart = substr(Yii::app()->session['mas_department_id'],0,2);
                    $qusg = new CDbCriteria( array(
                          'condition' => "em_status like :em_status and  mas_department_id like :mas_department_id",         
                          'params'    => array(':em_status' => "1", ':mas_department_id' => $str_depart.'%')  
                    ));
                }
            }

          }else{

            if($_POST["depart"]=="my"){
                
                $str_depart = substr(Yii::app()->session['mas_department_id'],0,2);

                if($str_depart=='10'){
                    $str_depart_val = Yii::app()->session['mas_department_id'];
                    $qusg = new CDbCriteria( array(
                          'condition' => "em_status like :em_status and  mas_department_id like :mas_department_id",         
                          'params'    => array(':em_status' => "1", ':mas_department_id' => $str_depart_val)  
                    ));
                }else{
                    $str_depart = substr(Yii::app()->session['mas_department_id'],0,2);
                    $qusg = new CDbCriteria( array(
                          'condition' => "em_status like :em_status and  mas_department_id like :mas_department_id",         
                          'params'    => array(':em_status' => "1", ':mas_department_id' => $str_depart.'%')  
                    ));
                }
            }

          }

                $modelusg = UmEmployee::model()->findAll($qusg);
                $countusg = count($modelusg);
                $rowno = 1;
                foreach ($modelusg as $rows){
                    $em_id = $rows->em_id; 
                    $em_per_id = $rows->em_per_id; 
                    $em_username = $rows->em_username; 
                    $em_citizen_id = $rows->em_citizen_id; 
                    $em_name_th = $rows->em_name_th; 
                    $em_surname_th = $rows->em_surname_th; 
                    $em_name_en = $rows->em_name_en; 
                    $em_surname_en = $rows->em_surname_en; 
                    $em_email = $rows->em_email; 
                    $em_workactive_date = $rows->em_workactive_date;
                    $um_assign_id = $rows->um_assign_id;
                    $um_user_group_id = $rows->um_user_group_id;
                    $mas_user_type_id = $rows->mas_user_type_id;
                    $mas_department_id = $rows->mas_department_id;
                    $em_status = $rows->em_status;
                    $em_description = $rows->em_description;

                    $mas_position_le_id = $rows->mas_position_le_id;
                    $um_position_id = $rows->um_position_id;
                    $um_data_complete_id = $rows->um_data_complete_id;
                    $um_user_module_id = $rows->um_user_module_id;
                    $createby = $rows->createby;
                    $createdate = $rows->createdate;
                    $updateby = $rows->updateby;
                    $updatedate = $rows->updatedate;

                    $user_move = ApproverController::CallDataMove($em_description);

                    $user_data_app = ApproverController::CallDataApp($em_id);


                    //-----------------------------------------------------------------------MasDepartment

                    $qusg2 = new CDbCriteria( array(
                      'condition' => "DeptID = :DeptID ",         
                      'params'    => array(':DeptID' => $mas_department_id)  
                    ));
                    $modelusg2 = MasDepartment::model()->findAll($qusg2);
                    foreach ($modelusg2 as $rowss){
                        $dp_id = $rowss->dp_id; 
                        $DeptID = $rowss->DeptID; 
                        $DeptNameTH = $rowss->DeptNameTH; 

                    $user_department = $DeptID.' | '.$DeptNameTH;

                    //-----------------------------------------------------------------------MasPosition

                    $qusgg = new CDbCriteria( array(
                      'condition' => "PositID = :PositID ",         
                      'params'    => array(':PositID' => $um_position_id)  
                    ));
                    $modelusgg = MasPosition::model()->findAll($qusgg);
                    foreach ($modelusgg as $rowssg){
                      $PositID=$rowssg->PositID;
                      $PositNameTH=$rowssg->PositNameTH;
                      $PositNameEN=$rowssg->PositNameEN;

                      $user_position = $PositNameTH;
                    

                  
                    //-----------------------------------------------------------------------MasPositionLe


                    $qusgge = new CDbCriteria( array(
                      'condition' => "PositLevelID = :PositLevelID ",         
                      'params'    => array(':PositLevelID' => $mas_position_le_id)  
                    ));
                    $modelusgge = MasPositionLe::model()->findAll($qusgge);
                    foreach ($modelusgge as $rowssge){
                      $PositLevelID=$rowssge->PositLevelID;
                      $PositLevelNameTH=$rowssge->PositLevelNameTH;
                      $PositLevelNameEN=$rowssge->PositLevelNameEN;

                      $user_positionle = $PositLevelNameTH;

                  //-----------------------------------------------------CHK ASSIGN

                    if($um_assign_id!='0'){
                      $Strh = 'checked';
                    }else{
                      $Strh = '';
                    }

                    
              ?>

              <tr class="gradeA">
                <td class="text-center">
                  <a class="avatar avatar-lg" target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/images/unnamed.png">
                    <?php 
                      if(file_exists("https://dpisuat.sso.go.th/attachment/pic_personal/".$em_citizen_id."-001.jpg")){
                        $pic_data = "https://dpisuat.sso.go.th/attachment/pic_personal/".$em_citizen_id."-001.jpg";
                      }else{
                        $pic_data = "https://dpisempuat.sso.go.th/attachment/pic_personal/".$em_citizen_id."-001.jpg";
                      }
                    ?>
                    <img alt="<?php echo $em_name_th.' '.$em_surname_th;?>"  class="img-fluid img-60" src="<?php echo $pic_data?>">
                  </a>

                </td>
                <td><?php echo $em_name_th.' '.$em_surname_th;?></td>
                <td><?php echo $em_username;?></td>
                <td><?php echo $user_position;?></td>
                <td><?php echo $user_positionle;?></td>
                <td><?php echo $user_department;?></td>
                <td>

                  <?php 

                    $user_data_app = ApproverController::CallDataApp($em_id);
                    if(!empty($user_data_app)){
                        foreach ($user_data_app as $dataitemapp) { 

                          $user_shot_app = ApproverController::CallDataAppShotname($dataitemapp);

                          echo '<code class="">'.$user_shot_app.'</code> ';
                        }
                    }
                      
                  ?>
                  <button class="btn btn-success btn-xs add-app-man" id="<?php echo $em_id;?>"><i class="fa fa-plus"></i></button>

                  <?php
                      if(!empty($user_data_app)){
                        echo '<button class="btn btn-danger btn-xs del-app-man" id="'.$em_id.'"><i class="fa fa-close"></i></button>';
                      }
                  ?>
                  
                </td>
                <!-- <td class="text-center">
                  <a href="javascript:void(0)" class="btn-showdiv btn-modal-emp">
                    <span class="badge badge-round badge-primary font-03">กำหนดสิทธิ</span>
                  </a>
                  <p class="mr-t-15"><span class="badge badge-sm badge-outline badge-default" style="color:#343a40;">
                    <?php

                    // if(isset($_POST["typesearch"])){

                    //   if($_POST["typesearch"]=='2'){

                    //     $user_data_app = ApproverController::CallDataApp($em_id);
                    //     $user_emp = ApproverController::actionInsertgrouproleemp($em_id,$um_position_id,$mas_position_le_id,$mas_department_id);

                        
                    //     echo $user_emp;
                    //   }
                    // }

                    ?>
                  </span></p>
                </td> -->
                <td class="text-center">
                  <?php
                  if(Yii::app()->session['um_assign_id'] == '0' ){
                    if(Yii::app()->session['um_user_group_id']!='3' || Yii::app()->session['um_user_group_id']!='4'){
                    if($em_id != Yii::app()->session['em_id']){
                  ?>
                  <label class="switch">
                    <input type="checkbox" id="<?php echo $em_id;?>" value="<?php echo $um_assign_id;?>" <?php echo $Strh;?> class="inputswitch" title="แทนสิทธิ">
                    <span class="slider round"></span>
                  </label>
                  <?php
                    }}}
                  ?>
                </td>
                <td class="text-center">
                  <?php 
                    $chk_depart = substr(Yii::app()->session['mas_department_id'],0,2);
                    if(Yii::app()->session['um_user_group_id']!='4' || Yii::app()->session['um_user_group_id']!='3'){
                      if($em_id != Yii::app()->session['em_id']){
                        if($chk_depart!='10'){

                          if($um_user_module_id!='0'){
                              $oldbr = $um_user_module_id;
                          }else{
                              $oldbr = $DeptID;
                          }
                  ?>
                  <?php echo $user_move;?> <button class="btn btn-pure btn-warning fa fa-edit br-radius btn-modal-emp-tran" branch="<?php echo $DeptNameTH;?>" citizen="<?php echo $em_username;?>" id="<?php echo $em_id;?>" depart="<?php echo $DeptID;?>" olddepart="<?php echo $oldbr;?>"  type="button" ></button>
                  <?php
                    }}}
                  ?>
                </td>
              </tr>



              
            <?php
                $rowno += 1;
                    }
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
              <!-- <th></th> -->
              <th></th>
              <th></th>
          </tr>
        </tfoot>
  </table>

<script type="text/javascript">
$(document).ready(function() {
  //######################--------------Click BTN btn-modal-emp
    $('.btn-modal-emp').click(function(){
        
        //############------------ LOAD MODAL PAGE EDIT --> Controller = setting / fn = loadmodalemptran

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadmodalemptran"); ?>",
            data: {
              'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
              $( ".load-lg-content" ).empty();
              $('.load-lg-content').html(data);
              $( ".load-lg-modal" ).modal('show');
            },
            error: function (data){
                console.log(data);
            }
        });
    });


    //######################--------------Click BTN btn-rela-app-tran
    $('.btn-modal-emp-tran').click(function(){

      var depart_id =  $(this).attr('depart');
      var emp_id =  $(this).attr('id');
      var emp_citizen =  $(this).attr('citizen');
      var branch =  $(this).attr('branch');
      var olddepart = $(this).attr('olddepart');

      // alert(olddepart);
        
        //############------------ LOAD MODAL PAGE EDIT --> Controller = setting / fn = loadmodalemptranre

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadmodalemptranre"); ?>",
            data: {
              depart_id: depart_id,
              emp_id: emp_id,
              emp_citizen: emp_citizen,
              branch: branch,
              olddepart: olddepart,
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


    //------------------------------------------------------------------------------------------------------Add App

    // add-app-man
    $('.add-app-man').click(function(){
      var add_id = $(this).attr('id');
      $.ajax({
          type: "POST",
          url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadmodalapp"); ?>",
          data: {
            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
            'req_id':add_id,
          },
          success: function (data) {
            $(".load-md-content").empty();
            $(".load-md-content").html(data);
            $(".load-md-modal").modal('show');
          },
          error: function (data){
            console.log(data);
          }
        });
    });




    //------------------------------------------------------------------------------switch 
    $('input[type="checkbox"]').click(function(){
        var emp_id = $(this).attr('id');
        var assign_id = $(this).val();
        if($(this).prop("checked") == true){

          packdata = {
              chkid:emp_id,
              valdata:'1',

              // alert(emp_id);
          };

          //############------------ SEND DATA TO --> Controller = setting / fn = insertassign

          $.ajax({
              type: "POST",
              url: "<?php echo Yii::app()->createAbsoluteUrl("approver/insertassign"); ?>",
              data: {
                packdata : packdata,
                'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
              },
        
              success: function (data) {
                
                  swal({
                      title: "ทำรายการสำเร็จ",
                      text: "บันทึกข้อมูลเรียบร้อย",
                      type: "success",
                      confirmButtonColor: "#0064b3",
                      confirmButtonText: "ปิด",
                      closeOnConfirm: true
                      },
                  function(){

                    //############------------ RELOAD 
                      $.ajax({
                          type: "POST",
                          url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadtableemp"); ?>",
                          data: {
                            depart : 'my',
                            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
                          },
                    
                          success: function (data) {
                            $( ".load-table-emp" ).empty();
                            $('.load-table-emp').html(data);
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

        }else{

          packdata = {
              chkid:emp_id,
              valdata:'0',
              assignid:assign_id,
          };
          // alert(emp_id+'/'+assign_id);

          //############------------ SEND DATA TO --> Controller = setting / fn = updateassign

          $.ajax({
              type: "POST",
              url: "<?php echo Yii::app()->createAbsoluteUrl("approver/updateassign"); ?>",
              data: {
                packdata : packdata,
                'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
              },
        
              success: function (data) {
                  swal({
                      title: "ทำรายการสำเร็จ",
                      text: "บันทึกข้อมูลเรียบร้อย",
                      type: "success",
                      confirmButtonColor: "#0064b3",
                      confirmButtonText: "ปิด",
                      closeOnConfirm: true
                      },
                  function(){

                    //############------------ RELOAD 
                      $.ajax({
                          type: "POST",
                          url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadtableemp"); ?>",
                          data: {
                            depart : 'my',
                            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
                          },
                    
                          success: function (data) {
                            $( ".load-table-emp" ).empty();
                            $('.load-table-emp').html(data);
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
        }
    });


      // Setup - add a text input to each footer cell
    $('.table-approver-emp tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input class="form-control form-control-sm"  type="text" placeholder="ค้นหา '+title+'" />' );
    });
 
    // DataTable
    var table = $('.table-approver-emp').DataTable({
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
        "order": [[ 1, "asc" ]],
        "lengthMenu": [ [10, 20, 30, 40, 50, -1], [10, 20, 30, 40, 50, "All"] ],
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