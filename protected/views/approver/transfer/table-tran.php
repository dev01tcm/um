<?php 

        $host=Yii::app()->params['prg_ctrl']['ipservice']['ipzonedev'];
        $data_array = array("filter" => array("exp" => $_POST["depart"]),);
        $make_call = lkup_oracledpis::CallAPI('POST', $host.'/umapi/datadpistest.php', json_encode($data_array));
        $data = json_decode($make_call, true);
        // var_dump($data);
       foreach($data as $key => $val){
        // var_dump($val['status']);
          if($val['status']=='Success'){
            foreach($val as $key2 => $val2){
              $uid=$val2;
            }
          }else{
              $uid='';
          }
       }

?>

<input id="submit-tran" class="submit-tran" value="<?php print_r($uid) ?>"  style="display:none;"/>
<table class="table table-bordered table-hover table-striped table-approver-tran" cellspacing="0" id="exampleAddRow12">
    <thead>
      <tr>
        <th style="width:50px;">Image</th>
        <th>ชื่อ-นามสกุล</th>
        <th>ตำแหน่ง</th>
        <th>ระดับ</th>
        <th>สาขา</th>
        <th class="text-center">
          <span>สถานะ</span>
          <!-- <a href="#" class="btn btn-sm btn-info btn-round btn-submit-all" title="รับเข้าทั้งหมด" >
            <i class="fa fa-chevron-down" aria-hidden="true"></i> รับทั้งหมด
          </a> -->
        </th>
        <th class="text-center">
          <span class="span-detail">ดูรายละเอียด</span>
        </th>
      </tr>
    </thead>
    <tbody>

      <?php

      if(!empty($uid)){
        foreach($uid as  $valss){



          // echo '<pre>';

          // var_dump($valss);

          // echo '</pre>';

          if($valss['PER_ID']!='' && $valss['SSOFIRSTNAME']!='' && $valss['SSOSURNAME']!='' && $valss['SSOPERSONEMPDATE']!='' && $valss['TITLE']!=''  && $valss['INITIALS']!='' && $valss['EMPLOYEETYPE']!='' && $valss['GIVENNAME']!='' && $valss['SN']!='' && $valss['WORKINGDEPTDESCRIPTION']!='' && $valss['SSOPERSONCLASS']!='' && $valss['SSOPERSONPOSITION']!='' && $valss['SSOPERSONCITIZENID']!='' && $valss['SSOPERSONBIRTHDATE']!='' && $valss['PER_GENDER']!=''  ){

              $echoss = '<a href="#" class="btn btn-sm btn-info btn-round btn-sumit-tran" title="รับเข้า" id="'.$_POST["depart"].'">
                      <i class="fa fa-chevron-down" aria-hidden="true"></i> รับเข้า
                    </a>';
          }else{
              $echoss = '<span style="color:red;font-size:20px;font-weight:700;">ข้อมูลไม่สมบูรณ์ กรุณาตรวจสอบข้อมูลจากทาง DPIS อีกครั้ง</span>';
          } 

            if(file_exists("https://dpisuat.sso.go.th/attachment/pic_personal/".$valss['SSOPERSONCITIZENID']."-001.jpg")){
              $pic_data = "https://dpisuat.sso.go.th/attachment/pic_personal/".$valss['SSOPERSONCITIZENID']."-001.jpg";
            }else{
              $pic_data = "https://dpisempuat.sso.go.th/attachment/pic_personal/".$valss['SSOPERSONCITIZENID']."-001.jpg";
            }


            echo'<tr class="gradeA">
                  <td class="text-center">
                    <a class="avatar avatar-lg" target="_blank" href="#">
                      <img alt="'.$valss['SSOFIRSTNAME'].' '.$valss['SSOSURNAME'].'"  class="img-fluid img-60" src="'.$pic_data.'">
                    </a>

                  </td>
                  <td>'.$valss['SSOFIRSTNAME'].' '.$valss['SSOSURNAME'].'</td>

                  <td>'.$valss['SSOPERSONPOSITION'].'</td>
                  <td>'.$valss['SSOPERSONCLASS'].'</td>
                  <td>'.$valss['WORKINGDEPTDESCRIPTION'].'</td>
                  <td class="text-center">
                    '.$echoss.'
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-outline-primary btn-modal-tran" title="รายละเอียด" id="'.$_POST["depart"].'">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>

                <input id="PER_ID" class="datasubmit" value="'.$valss['PER_ID'].'"  style="display:none;"/>
                <input id="SSOFIRSTNAME" class="datasubmit" value="'.$valss['SSOFIRSTNAME'].'"  style="display:none;"/>
                <input id="SSOSURNAME" class="datasubmit" value="'.$valss['SSOSURNAME'].'"  style="display:none;"/>
                <input id="SSOPERSONEMPDATE" class="datasubmit" value="'.$valss['SSOPERSONEMPDATE'].'"  style="display:none;"/>
                <input id="TITLE" class="datasubmit" value="'.$valss['TITLE'].'"  style="display:none;"/>
                <input id="INITIALS" class="datasubmit" value="'.$valss['INITIALS'].'"  style="display:none;"/>
                <input id="EMPLOYEETYPE" class="datasubmit" value="'.$valss['EMPLOYEETYPE'].'"  style="display:none;"/>
                <input id="GIVENNAME" class="datasubmit" value="'.$valss['GIVENNAME'].'"  style="display:none;"/>
                <input id="SN" class="datasubmit" value="'.$valss['SN'].'"  style="display:none;"/>
                <input id="WORKINGDEPTDESCRIPTION" class="datasubmit" value="'.$valss['WORKINGDEPTDESCRIPTION'].'"  style="display:none;"/>
                <input id="SSOPERSONCLASS" class="datasubmit" value="'.$valss['SSOPERSONCLASS'].'"  style="display:none;"/>
                <input id="SSOPERSONPOSITION" class="datasubmit" value="'.$valss['SSOPERSONPOSITION'].'"  style="display:none;"/>
                <input id="SSOPERSONCITIZENID" class="datasubmit" value="'.$valss['SSOPERSONCITIZENID'].'"  style="display:none;"/>
                <input id="ACCOUNTACTIVE" class="datasubmit" value="'.$valss['ACCOUNTACTIVE'].'"  style="display:none;"/>
                <input id="SSOPERSONBIRTHDATE" class="datasubmit" value="'.$valss['SSOPERSONBIRTHDATE'].'"  style="display:none;"/>
                <input id="PER_GENDER" class="datasubmit" value="'.$valss['PER_GENDER'].'"  style="display:none;"/>';




          }
        }else{
          echo '<tr class="gradeA"><td class="text-center" colspan="7"> ไม่พบข้อมูลที่คุณต้องการค้นหา </td></tr>';
        }
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


<script type="text/javascript">
  $(document).ready(function() {


    //######################--------------Click BTN btn-modal-tran
    $('.btn-modal-tran').click(function(){

      var citizen_id = $( this ).attr('id');

        //############------------ LOAD MODAL PAGE EDIT --> Controller = setting / fn = loadmodaltran

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadmodaltran"); ?>",
            data: {
              depart : citizen_id,
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

      //######################--------------Click BTN btn-sumit-tran
    $('.btn-sumit-tran').click(function(){

      var packdata = [];

      $( ".datasubmit" ).each(function() {
          // $( this ).val();
          packdata.push($( this ).val());
      });

        //############------------ LOAD MODAL PAGE EDIT --> Controller = setting / fn = loadsubmittran

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadsubmittran"); ?>",
            data: {
              packdata : packdata,
              'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
              // alert(JSON.stringify(data));
              alert(data);
              // $( ".load-table-tran" ).empty();
            },
            error: function (data){
                console.log(data);
            }
        });
    });



     // Setup - add a text input to each footer cell
    $('.table-approver-tran tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input class="form-control form-control-sm"  type="text" placeholder="ค้นหา '+title+'" />' );
    } );
 
    // DataTable
    var table = $('.table-approver-tran').DataTable({
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