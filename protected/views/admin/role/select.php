<p class="example-title font-03 font-w">Module Application</p>
<select class="form-control form-control-lg font-03 ap_type2" id="ap_type2" style="line-height:2rem;padding: .429rem 1rem;">
  <option value="all" id="all" modulename="all" >เลือก Module </option>
  <?php
    $qusg2 = new CDbCriteria( array(
          'condition' => "ma_status like :ma_status ",         
          'params'    => array(':ma_status' => "1")  
    ));
    $modelusg2 = MasModuleApp::model()->findAll($qusg2);
    $countusg2 = count($modelusg2);
    $rowno2 = 1;

    $i2=0;$strApp2='';
        foreach ($modelusg2 as $rows2){
          $ma_id = $rows2->ma_id; 
          $ma_name = $rows2->ma_name;
          $mas_app_id = $rows2->mas_app_id;
          if(isset($_POST['idapp'])){
            $appid_data = $mas_app_id;
            if($_POST['idapp']==$mas_app_id){$strCh='style="display:block;"';}else{$strCh='style="display:none;"';}
          }
            $strApp2.='<option value="'.$mas_app_id.'" id="'.$ma_id.'" modulename="'.$ma_name.'" '.$strCh.'>'.$ma_name.'</option>';
        }
    ?>
  <?php 
    if($_POST['idapp']==$appid_data){

        echo $strApp2;

    }else{
      echo '<option value="all" id="all" modulename="all" >ไม่มี Module </option>';
    }

  ?>
</select>