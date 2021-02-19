<?php
    if(isset($_POST['ide'])){
      $header_m = 'แก้ไขข้อมูล Modal Application';

      //***********************************---------  Call Data MasApp BY ID

      $CallApp = AdminController::CallModalByID($_POST['ide']);

      //***********************************---------  END 

    }else{
      $header_m = 'เพิ่มข้อมูล Modal Application';
    }
?>
<div class="modal-header">
  <button class="close" aria-label="Close" type="button" data-dismiss="modal">
    <span class="font-01 font-w" aria-hidden="true"><i class="fa fa-close"></i></span>
  </button>
  <h2 class="modal-title font-01 font-w"> <?php echo $header_m; ?></h2>
</div>

<?php
    //---------------------------------------------------------------------------- UPDATE
    if(isset($_POST['ide'])){
?>

<div class="modal-body font-03">
  <div class="example-wrap">
    <div class="form-group">
      <p class="example-title font-03 font-w"> ชื่อ Modal Application </p>
      <input class="form-control form-control-lg font-03 ap_name_e" id="ap_name_e" type="text" value="<?php echo $CallApp['ma_name'];?>" placeholder="เช่น งานประโยชน์">
      <div class="invalid-feedback font-05 name_e_msg" style="display:none;"> กรอกข้อมูลให้ครบถ้วน</div>
    </div>
    <div class="form-group">
      <p class="example-title font-03 font-w"> รายละเอียด (ชื่อภาษาไทย)</p>
      <input class="form-control form-control-lg font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $CallApp['ma_description'];?>" placeholder="เช่น งานประโยชน์">
      <div class="invalid-feedback font-05 des_e_msg" style="display:none;"> กรอกข้อมูลให้ครบถ้วน</div>
    </div>
    <div class="form-group">
      <p class="example-title font-03 font-w"> Application</p>
      <select class="form-control form-control-lg font-03" id="ap_type_e" style="line-height:2rem;padding: .429rem 1rem;">
        <?php
          $qusg = new CDbCriteria( array(
                'condition' => "app_status like :app_status ",         
                'params'    => array(':app_status' => "1")  
          ));
          $modelusg = MasApp::model()->findAll($qusg);
          $countusg = count($modelusg);
          $rowno = 1;

          $i=0;$strApp='';
              foreach ($modelusg as $rows){
                $app_id = $rows->app_id; 
                $app_shortname = $rows->app_shortname;
                if(isset($_POST['ide'])){
                  if($CallApp['mas_app_id']==$app_id){$strCh='selected';}else{$strCh='';}
                }
                  $strApp.='<option value="'.$app_shortname.'" id="'.$app_id.'" '.$strCh.' >'.$app_shortname.'</option>';
              }
          ?>
        <?php echo $strApp;?>
      </select>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button class="btn btn-success font-03 font-w btn-submit-e" id="<?php echo $CallApp['ma_id'];?>" type="button">แก้ไขข้อมูล</button>
  <button class="btn btn-danger font-03 font-w" type="button" data-dismiss="modal">ยกเลิก</button>
</div>

<?php
    //---------------------------------------------------------------------------- CREATE
    }else{
?>

<div class="modal-body font-03">
  <div class="example-wrap">
    <div class="form-group">
      <p class="example-title font-03 font-w"> ชื่อ Modal Application </p>
      <input class="form-control form-control-lg font-03 ap_name" id="ap_name" type="text" placeholder="เช่น งานประโยชน์">
      <div class="invalid-feedback font-05 name_msg" style="display:none;"> กรอกข้อมูลให้ครบถ้วน</div>
    </div>
    <div class="form-group">
      <p class="example-title font-03 font-w"> รายละเอียด (ชื่อภาษาไทย)</p>
      <input class="form-control form-control-lg font-03 ap_des" id="ap_des" type="text" placeholder="เช่น งานประโยชน์">
      <div class="invalid-feedback font-05 des_msg" style="display:none;"> กรอกข้อมูลให้ครบถ้วน</div>
    </div>
    <div class="form-group">
      <p class="example-title font-03 font-w"> Application</p>
      <select class="form-control form-control-lg font-03" id="ap_type" style="line-height:2rem;padding: .429rem 1rem;">
        <?php
          $qusg = new CDbCriteria( array(
                'condition' => "app_status like :app_status ",         
                'params'    => array(':app_status' => "1")  
          ));
          $modelusg = MasApp::model()->findAll($qusg);
          $countusg = count($modelusg);
          $rowno = 1;

          $i=0;$strApp='';
              foreach ($modelusg as $rows){
                $app_id = $rows->app_id; 
                $app_shortname = $rows->app_shortname;
                  $strApp.='<option value="'.$app_shortname.'" id="'.$app_id.'" >'.$app_shortname.'</option>';
              }
          ?>
        <?php echo $strApp;?>
      </select>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button class="btn btn-success font-03 font-w btn-submit" type="button">บันทึกข้อมูล</button>
  <button class="btn btn-danger font-03 font-w" type="button" data-dismiss="modal">ยกเลิก</button>
</div>

<?php
    }
?>



<script type="text/javascript">
  $(document).ready(function() {
    var ap_name = false;
    var ap_des = false;
    var ap_name_e = false;
    var ap_des_e = false;

    //---------------------------------------------------------------------------- CHECK Validation

    $('#ap_name').focusout(function(){
        if(ap_namechk($(this).val())){
            ap_name = true;
        }else{
            ap_name = false;
        }
    });

    $('#ap_des').focusout(function(){
        if(ap_deschk($(this).val())){
            ap_des = true;
        }else{
            ap_des = false;
        }
       
    });

    $('#ap_shot').focusout(function(){
        if(ap_shotchk($(this).val())){
            ap_shot = true;
        }else{
            ap_shot = false;
        }
       
    });

    function ap_namechk(ap_name){
        $('.name_msg').show();
        if(ap_name==""){
              $('.ap_name').addClass('is-invalid');
              return false;
        }else{
              $('.ap_name').removeClass('is-invalid');
              $('.ap_name').addClass('is-valid');
              $('.name_msg').hide();
              return true;
        }
    }

    function ap_deschk(ap_des){
        $('.des_msg').show();
        if(ap_des==""){
              $('.ap_des').addClass('is-invalid');
              return false;
        }else{
              $('.ap_des').removeClass('is-invalid');
              $('.ap_des').addClass('is-valid');
              $('.des_msg').hide();
              return true;
        }
    }

     

    //---------------------------------------------------------------------------- SAVE() UPDATE

    $('.btn-submit-e').click(function(){
        var ide = $(this).attr('id');
        var ap_names_e = $('#ap_name_e').val();
        var ap_dess_e = $('#ap_des_e').val();
        var ap_types_e = $('#ap_type_e').children("option:selected").attr("id");

        if(ap_namechk($('#ap_name_e').val())){
            ap_name_e = true;
        }else{
            ap_name_e = false;
        }

        if(ap_deschk($('#ap_des_e').val())){
            ap_des_e = true;
        }else{
            ap_des_e = false;
        }

        //############------------ PACK DATA 


        packdata_e = {
            ap_names_e:ap_names_e,
            ap_dess_e:ap_dess_e,
            ap_types_e:ap_types_e,
            ap_id_e:ide,
        };

        //############------------ SEND DATA TO --> Controller = setting / fn = updatemodule

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/updatemodule"); ?>",
            data: {
              packdata : packdata_e,
              'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
                if(data=='success'){
                  $( ".load-md-modal" ).modal('hide');
                  $( ".load-md-content" ).empty();
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
                            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabmodal"); ?>",
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
                }else{
                    swal({
                        title: "ทำรายการไม่สำเร็จ",
                        text: "กรุณาตรวจสอบความถูกต้องอีกครั้ง",
                        type: "warning",
                        confirmButtonColor: "#00E5DA",
                        confirmButtonText: "ปิด"
                    });
                    $('.btn-submit').removeAttr('disabled');
                }
            },
            error: function (data){
                console.log(data);
            }
        });


    });

    //---------------------------------------------------------------------------- SAVE() INSERT

    $('.btn-submit').click(function(){

      $('.btn-submit').attr('disabled',true);

      var ap_names = $('#ap_name').val();
      var ap_dess = $('#ap_des').val();
      var ap_types = $('#ap_type').children("option:selected").attr("id");

      if(ap_namechk($('#ap_name').val())){
          ap_name = true;
      }else{
          ap_name = false;
      }

      if(ap_deschk($('#ap_des').val())){
          ap_des = true;
      }else{
          ap_des = false;
      }

      //############------------ PACK DATA 


      packdata = {
          ap_names:ap_names,
          ap_dess:ap_dess,
          ap_types:ap_types,
      };

      //############------------ SEND DATA TO --> Controller = setting / fn = insertmodule

      $.ajax({
          type: "POST",
          url: "<?php echo Yii::app()->createAbsoluteUrl("admin/insertmodule"); ?>",
          data: {
            packdata : packdata,
            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
          },
    
          success: function (data) {
               if(data=='success'){
                $( ".load-md-modal" ).modal('hide');
                $( ".load-md-content" ).empty();
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
                          url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabmodal"); ?>",
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
              }else if(data=='error'){
                  swal({
                      title: "ทำรายการไม่สำเร็จ",
                      text: "กรุณาตรวจสอบความถูกต้องอีกครั้ง",
                      type: "warning",
                      confirmButtonColor: "#00E5DA",
                      confirmButtonText: "ปิด"
                  });
                  $('.btn-submit').removeAttr('disabled');
              }else{
                  swal({
                      title: "ทำรายการไม่สำเร็จ",
                      text: "ข้อมูลซ้ำกับข้อมูลเดิมที่มีอยู่",
                      type: "warning",
                      confirmButtonColor: "#00E5DA",
                      confirmButtonText: "ปิด"
                  });
                  $('.btn-submit').removeAttr('disabled');
              }
          },
          error: function (data){
              console.log(data);
          }
      });

    });
      
  });
</script>