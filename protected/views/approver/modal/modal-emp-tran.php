
      <div class="modal-header">
        <button class="close" aria-label="Close" type="button" data-dismiss="modal">
          <span class="font-01 font-w" aria-hidden="true"><i class="fa fa-close"></i></span>
        </button>
        <h2 class="modal-title font-01">จัดการข้อมูลการย้ายสาขา  <?php echo Yii::app()->session['mas_department_id'];?></h2>
      </div>
      <div class="modal-body font-04">
        <div class="row">
          <div class="col-sm-12">
            <ul class="nav nav-tabs nav-tabs-line" role="tablist" style="border-bottom:none;">
              
              <li class="dropdown nav-item" style="display: none;">
                <a class="dropdown-toggle nav-link" aria-expanded="false" aria-haspopup="true" href="#" data-toggle="dropdown">Dropdown </a>
                <div class="dropdown-menu" role="menu">
                  <a class="dropdown-item" role="tab" aria-controls="exampleTopHome" href="#exampleTopHome" data-toggle="tab"><i class="icon wb-plugin" aria-hidden="true"></i>โยกย้ายสาขา</a>
                  
                </div>
              </li>
            </ul>
            <div class="tab-content mr-t-25">
              <div class="tab-pane active show" id="exampleTopHome" role="tabpanel">
                <div class="form-group row" style="margin-bottom:5px;">
                <label class="col-sm-2 form-control-label text-right">เลือกสาขา</label>
                  <div class="col-md-10">
                      <select class="form-control modal-drpdep" id="modal-drpdep">
                        <option value="all">เลือกทั้งหมด</option>
                        <?php
                          $qusg = new CDbCriteria( array(
                            'condition' => "StatusData like :StatusData ",         
                            'params' => array(':StatusData' => "1")  
                          ));
                          $modelusg = MasDepartment::model()->findAll($qusg);
                          $countusg = count($modelusg);
                          $rowno = 1;
                          foreach ($modelusg as $rows){

                            $str = substr($rows->DeptID,0,2);
                            $str_depart = substr($_POST["depart_id"],0,2);

                            if($str_depart=='10'){
                              $str_val = $rows->DeptID;
                              $str_depart_val = $_POST["depart_id"];
                            }else{
                              $str_val = substr($rows->DeptID,0,2);
                              $str_depart_val = substr($_POST["depart_id"],0,2);
                            }

                            // if(Yii::app()->session['um_user_group_id']=='5' || Yii::app()->session['um_user_group_id']=='3'){
                            //     if($str_val==$str_depart_val){
                            //       $echstyle = 'style="display:block;"';
                            //     }else{
                            //       $echstyle = 'style="display:none;"';
                            //     }
                            // }else{
                            //     $echstyle = 'style="display:block;"';
                            // }

                             if($str_val==$str_depart_val){
                                $echstyle = 'style="display:block;"';
                              }else{
                                $echstyle = 'style="display:none;"';
                              }
                            

                            ?>
                              <option value="<?php echo $rows->DeptID; ?>" <?php echo $echstyle;?>  ><?php echo "[".$rows->DeptID."] ".$rows->DeptNameTH?></option>
                          <?php
                          }
                        ?>           
                    </select>
                  </div>
                </div>
                <div class="form-group row" style="margin-bottom:5px;">
                  <label class="col-sm-2 form-control-label text-right">หมายเหตุ</label>
                  <div class="col-md-10" data-select2-id="175">
                    <textarea class="form-control font-05 txtcontent" id="txtcontent" rows="4" style="width:100%;"></textarea>
                  </div>
                </div>
                <div class="form-group row " style="margin-bottom:5px;">
                  <div class="col-md-12 text-right">
                    <button class="btn btn-default font-03 btn-can" type="button" data-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-success font-03 btn-submit" id="<?php echo $_POST["emp_id"]?>" branch="<?php echo $_POST["branch"];?>" citizen="<?php echo $_POST["emp_citizen"] ?>" oldbr="<?php echo $_POST['olddepart']?>" type="button">ย้ายสาขา</button>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>



<script type="text/javascript">
$(document).ready(function() {

  $('.modal-drpdep').change(function() {
    var label_val = $( this ).val();
    var user_oldbr = $('.btn-submit').attr("oldbr");
    if(label_val == user_oldbr){
      var txtcontent = $( '.txtcontent' ).val('ปกติ');
      $('.txtcontent').attr('disabled',true);
    }else{
      $( '.txtcontent' ).val('');
      $('.txtcontent').removeAttr('disabled');
    }
  });

    //######################--------------Click BTN btn-submit
    $('.btn-submit').click(function(){

        $('.btn-submit').attr('disabled',true);

        var valdepchange = $(".modal-drpdep").val();
        var txtcontent = $(".txtcontent").val();
        var user_id = $(this).attr("id");
        var user_citizen = $(this).attr("citizen");
        var user_branch_name = $(this).attr("branch");
        var user_oldbr = $(this).attr("oldbr");

        // var

        // alert(valdepchange+"/"+txtcontent+"/"+user_citizen);

        if(valdepchange!='all' || txtcontent!=''){

          packdata = {
              valdepchange:valdepchange,
              txtcontent:txtcontent,
              user_id:user_id,
              user_citizen:user_citizen,
              user_branch_name:user_branch_name,
              user_oldbr:user_oldbr,
          };

          //############------------ SEND DATA TO --> Controller = setting / fn = insertusermove

          $.ajax({
              type: "POST",
              url: "<?php echo Yii::app()->createAbsoluteUrl("approver/insertusermove"); ?>",
              data: {
                packdata : packdata,
                'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
              },
        
              success: function (data) {
                // alert(data);
                  swal({
                      title: "ทำรายการสำเร็จ",
                      text: "บันทึกข้อมูลเรียบร้อย",
                      type: "success",
                      confirmButtonColor: "#0064b3",
                      confirmButtonText: "ปิด",
                      closeOnConfirm: true
                      },
                  function(){

                    // ############------------ RELOAD 
                      $.ajax({
                          type: "POST",
                          url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadtableemp"); ?>",
                          data: {
                            depart : 'my',
                            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
                          },
                    
                          success: function (data) {
                            $( ".load-md-modal" ).modal('hide');
                            $( ".load-md-content" ).empty();
                            
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
          swal({
              title: "ทำรายการไม่สำเร็จ",
              text: "กรุณากรอกข้อมูลให้ครบถ้วน",
              type: "warning",
              confirmButtonColor: "#0064b3",
              confirmButtonText: "ปิด"
          });
          $('.btn-submit').removeAttr('disabled');
      }



    });
});
</script>


        
