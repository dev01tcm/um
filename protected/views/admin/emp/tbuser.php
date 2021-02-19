<table id="Tabledatauser" class="table table-striped" style="margin-top:20px; width:100%"  >
            <thead style="background-color:#AED6F1;">
              <tr>
                <th style="width:2%;">No.</th>
                <th>ชื่อ-นามสกุล</th>
                <th>รหัสผู้ใช้</th>
                <th>ตำแหน่ง</th>
                <th>ระดับ</th>
                <th>หน่วยงาน</th>
                <th>กลุ่มผู้ใช้งาน</th>
                <th style="width:2%;">แสดงข้อมูล</th>
                <th style="width:2%;">Update ข้อมูล</th>
              </tr>
            </thead>
            <tbody>
			<?php
							$i=1;
								    $masdepartment=isset($_POST['masdepartment'])?addslashes(trim($_POST['masdepartment'])):'';
							    	$masusertype=isset($_POST['masusertype'])?addslashes(trim($_POST['masusertype'])):'';
									$masusergroup=isset($_POST['masusergroup'])?addslashes(trim($_POST['masusergroup'])):'';
									$idsearch=isset($_POST['idsearch'])?addslashes(trim($_POST['idsearch'])):'';
									$typesearch=isset($_POST['typesearch'])?addslashes(trim($_POST['typesearch'])):'';
			
			
			//ค้นหาจาก LDAP แล้วเอามาใส่ ฐานข้อมูลของเรา
			
			$model=new frm_user;
			
			
			$data=$model->searchuser($masusertype,$masusergroup,$masdepartment,$typesearch,$idsearch);
								
								foreach ($data as $dataitem1)
							{
								
								$id=$dataitem1["em_id"];
								
							   // $surnameth=$dataitem1["em_username"];
							?>
			                          <tr>
									   <td><?php echo $i; ?></td>
			                            <td><?php echo  $dataitem1["em_name_th"]." ".$dataitem1["em_surname_th"]; ?></td>
			                            <td><?php echo $dataitem1["em_username"]; ?></td>
			                            <td><?php echo $dataitem1["PositNameTH"]; ?></td>
			                            <td><?php echo $dataitem1["PositLevelNameTH"]; ?></td>
			                            <td><?php echo $dataitem1["DeptNameTH"]; ?></td>
			                            <td>
										 <?php
			                            echo'<select class="form-control drpdep11111" id="drpdep11111'.$dataitem1['em_id'].'" data-id="'.$dataitem1['em_id'].'" onchange="changedata(this)" >';
											
												$datausergroup = lkup_user::group_user();
												 echo'<option value="'.$dataitem1['ug_id'].'">'.$dataitem1['ug_name'].'</option>';
								             	foreach($datausergroup as $dataitem) 
												{
													
												echo "<option value=".$dataitem['ug_id'].">".$dataitem['ug_name']."</option>";
												
												} 
											?>                     
								            </select>
										</td>
										 <?php
												echo'<td><button class="btn btn-floating btn-info btn-sm" type="button" data-id="'.$id.'" onclick="editdata(this)" title="ดูข้อมูล"><i class="fa fa-user" aria-hidden="true"></i></button></td>';
										if($dataitem1["em_per_id"] !=''){		
										
										echo'<td><button class="btn btn-floating btn-success btn-sm" type="button" data-id="'.$id.'" data-user="'.$dataitem1["em_username"].'" onclick="datadpisupdate(this)" title="อัฟเดทdpis"><i class="fa fa-refresh" aria-hidden="true" ></i></button></td>';
										
										}else{
											echo' <td></td>';
										}
										?> 
			                          </tr>
									 
			                <?php
							$i++;
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
                    <th></th>
                    <th></th>
                </tr>
          	</tfoot>
      	</table>
		<script type="text/javascript">
		$(document).ready(function() {
   
   
    $('#Tabledatauser').DataTable();

	    }); 
		</script>