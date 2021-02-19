<?php 

        $host=Yii::app()->params['prg_ctrl']['ipservice']['ipzonedev'];
        $data_array = array("filter" => array("exp" => $_POST["depart"]),);
        $make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/datadpistest.php', json_encode($data_array));
        $data = json_decode($make_call, true);
        // var_dump($data);
        foreach($data as $key => $val){
          if($key=='data'){
            foreach($val as $key2 => $val2){
              $uid=$val2;
            }
          }
        }

?>
  <div class="modal-header">
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
      <span class="font-01 font-w" aria-hidden="true"><i class="fa fa-close"></i></span>
    </button>
    <h2 class="modal-title font-01">รายละเอียดข้อมูลการโยกย้ายของพนักงาน</h2>
  </div>
  <div class="modal-body font-03">
    <div class="row">
      <div class="col-md-12" style="padding-left:15px;">
        <div class="form-group row text-center" style="margin-bottom:5px;">
          <div class="form-group col-sm-12" style="margin-bottom:5px;">
          <div class="text-center">
            <img class="w-100" src="/um_old/images/ssol2.png">
          </div>
        </div>
         <h1 class="font-02" style="width:100%;">
            <p class="font-w" style="margin-bottom:5px;">รายละเอียดข้อมูลการโยกย้ายของพนักงาน</p>
            <p class="font-w" style="margin-bottom:5px;">สำนักงานประกันสังคม</p>
          </h1>
        </div>
        <div class="col-sm-12">
          <div class="row">
            <label class="col-sm-6 form-control-label text-left"><span style="color:#6610f2;"></span></label>
            <label class="col-sm-6 form-control-label text-right"><span style="color:#6610f2;">วันที่มีหมาย : </span> <?php echo Yii::app()->CommonFnc->DateThai(date("Y-m-d H:i:s"),false); ?></label>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <div class="panel-group" id="accordion">

                <?php
                  foreach($uid as  $valss){
                ?>

                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne1" aria-expanded="false" class="collapsed"> รายละเอียดพนักงาน : <?php echo $valss['SSOFIRSTNAME'].' '.$valss['SSOSURNAME']?></a>
                    </h4>
                  </div>
                  <div id="collapseOne1" class="panel-collapse collapse in" aria-expanded="true" >
                    <div class="panel-body" style="padding-left:15%;padding-bottom:15px;">
                        <div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
                          <label class="col-sm-4 form-control-label text-right">วัน/เดือน/ปี เกิด </label>
                          <div class="col-sm-8">
                            <input class="form-control form-control font-03" type="text" value="<?php echo Yii::app()->CommonFnc->DateThai($valss['SSOPERSONBIRTHDATE'],false); ?>" readonly="readonly">
                          </div>
                        </div>
                        <div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
                          <label class="col-sm-4 form-control-label text-right">เลขที่บัตรประชาชน </label>
                          <div class="col-sm-8">
                            <input class="form-control form-control font-03" type="text" value="<?php echo $valss['SSOPERSONCITIZENID']; ?>" readonly="readonly">
                          </div>
                        </div>
                        <div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
                          <label class="col-sm-4 form-control-label text-right">ชื่อ-นามสกุล ไทย</label>
                          <div class="col-sm-4">
                            <input class="form-control form-control font-03" type="text" value="<?php echo $valss['SSOFIRSTNAME']; ?>" readonly="readonly">
                          </div>
                          <div class="col-sm-4">
                            <input class="form-control form-control font-03" type="text" value="<?php echo $valss['SSOSURNAME']; ?>" readonly="readonly">
                          </div>
                        </div>
                        <div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
                          <label class="col-sm-4 form-control-label text-right">ชื่อ-นามสกุล อังกฤษ</label>
                          <div class="col-sm-4">
                            <input class="form-control form-control font-03"  type="text" value="<?php echo $valss['GIVENNAME']; ?>" readonly="readonly">
                          </div>
                          <div class="col-sm-4">
                            <input class="form-control form-control font-03"  type="text" value="<?php echo $valss['SN']; ?>" readonly="readonly">
                          </div>
                        </div>
                        <div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
                          <label class="col-sm-4 form-control-label text-right">ตำแหน่งงาน / ระดับ</label>
                          <div class="col-sm-4">
                            <input class="form-control form-control font-03" type="text" value="<?php echo $valss['SSOPERSONPOSITION']; ?>" readonly="readonly">
                          </div>
                          <div class="col-sm-4">
                            <input class="form-control form-control font-03" type="text" value="<?php echo $valss['SSOPERSONCLASS']; ?>" readonly="readonly">
                          </div>
                        </div>
                        <!-- <div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
                          <label class="col-sm-4 form-control-label text-right">สังกัดเก่า</label>
                          <div class="col-sm-8">
                            <input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="4200 | สำนักงานประกันสังคม จังหวัดเลย" readonly="readonly">
                          </div>
                        </div> -->
                        <div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
                          <label class="col-sm-4 form-control-label text-right" style="color:#dc3545;">สังกัดใหม่ ***</label>
                          <div class="col-sm-8">
                            <input class="form-control form-control font-03" type="text" value="<?php echo $valss['WORKINGDEPTDESCRIPTION']; ?>" readonly="readonly">
                          </div>
                        </div>
                      <!--   <div class="form-group" style="margin-bottom:5px;display: flex;width: 100%;">
                          <label class="col-sm-4 form-control-label text-right" style="color:#dc3545;">วันที่มีผล ***</label>
                          <div class="col-sm-8">
                            <input class="form-control form-control font-03 ap_des_e" id="ap_des_e" type="text" value="07/06/2563" readonly="readonly">
                          </div>
                        </div> -->
                      </div><!--  panel-body -->
                  </div>
                </div>
                <!--/ Panel 1 end-->

                <?php
                  }
                ?>

              </div>
            </div>
          </div>
          
        </div>
      </div><!-- col-md-12 -->
    </div><!-- row -->
  </div><!-- modal-body -->










 