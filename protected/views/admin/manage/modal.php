<?php
    if(isset($_POST['ide'])){
      $header_m = 'แก้ไขข้อมูล ตำแหน่งบริหารงาน';

      //***********************************---------  Call Data MasApp BY ID

      $CallApp = AdminController::CallPositionManByID($_POST['ide']);

      //***********************************---------  END 

    }else{
      $header_m = 'เพิ่มข้อมูล ตำแหน่งบริหารงาน';
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
      <p class="example-title font-03 font-w"> ชื่อ ตำแหน่งบริหารงาน </p>
      <input class="form-control form-control-lg font-03 ap_name_e" id="ap_name_e" type="text" value="<?php echo $CallApp['pm_name_en'];?>" placeholder="เช่น ประกันสังคมจังหวัด">
      <div class="invalid-feedback font-05 name_e_msg" style="display:none;"> กรอกข้อมูลให้ครบถ้วน</div>
    </div>
    <div class="form-group">
      <p class="example-title font-03 font-w"> รายละเอียด (ชื่อภาษาไทย)</p>
      <input class="form-control form-control-lg font-03 ap_des_e" id="ap_des_e" type="text" value="<?php echo $CallApp['pm_name_th'];?>" placeholder="เช่น ประกันสังคมจังหวัด">
      <div class="invalid-feedback font-05 des_e_msg" style="display:none;"> กรอกข้อมูลให้ครบถ้วน</div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button class="btn btn-success font-03 font-w btn-submit-e" id="<?php echo $CallApp['pm_id'];?>" type="button">แก้ไขข้อมูล</button>
  <button class="btn btn-danger font-03 font-w" type="button" data-dismiss="modal">ยกเลิก</button>
</div>

<?php
    //---------------------------------------------------------------------------- CREATE
    }else{
?>

<div class="modal-body font-03">
  <div class="example-wrap">
    <div class="form-group">
      <p class="example-title font-03 font-w"> ชื่อ ตำแหน่งบริหารงาน </p>
      <input class="form-control form-control-lg font-03 ap_name" id="ap_name" type="text" placeholder="เช่น ประกันสังคมจังหวัด">
      <div class="invalid-feedback font-05 name_msg" style="display:none;"> กรอกข้อมูลให้ครบถ้วน</div>
    </div>
    <div class="form-group">
      <p class="example-title font-03 font-w"> รายละเอียด (ชื่อภาษาไทย)</p>
      <input class="form-control form-control-lg font-03 ap_des" id="ap_des" type="text" placeholder="เช่น ประกันสังคมจังหวัด">
      <div class="invalid-feedback font-05 des_msg" style="display:none;"> กรอกข้อมูลให้ครบถ้วน</div>
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

    function ap_namechk(ap_name_e){
        $('.name_e_msg').show();
        if(ap_name_e==""){
              $('.ap_name_e').addClass('is-invalid');
              return false;
        }else{
              $('.ap_name_e').removeClass('is-invalid');
              $('.ap_name_e').addClass('is-valid');
              $('.name_e_msg').hide();
              return true;
        }
    }

    function ap_deschk(ap_des_e){
        $('.des_e_msg').show();
        if(ap_des_e==""){
              $('.ap_des_e').addClass('is-invalid');
              return false;
        }else{
              $('.ap_des_e').removeClass('is-invalid');
              $('.ap_des_e').addClass('is-valid');
              $('.des_e_msg').hide();
              return true;
        }
    }

    //---------------------------------------------------------------------------- SAVE() UPDATE

    $('.btn-submit-e').click(function(){

      $('.btn-submit-e').attr('disabled',true);

        var ide = $(this).attr('id');
        var ap_names_e = $('#ap_name_e').val();
        var ap_dess_e = $('#ap_des_e').val();

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
            ap_id_e:ide,
        };

        //############------------ SEND DATA TO --> Controller = setting / fn = updatepositionman

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/updatepositionman"); ?>",
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
                            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabmanage"); ?>",
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
      };

      //############------------ SEND DATA TO --> Controller = setting / fn = insertpositionman

      $.ajax({
          type: "POST",
          url: "<?php echo Yii::app()->createAbsoluteUrl("admin/insertpositionman"); ?>",
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
                          url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabmanage"); ?>",
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