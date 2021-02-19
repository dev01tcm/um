<table id="Tabledatausernew" class="table table-striped" style="margin-top:20px; width:100%"  >
            <thead style="background-color:#AED6F1;">
              <tr>
                <th style="width:2%;">No.</th>
                <th>ชื่อ-นามสกุล</th>
                <th>รหัสเข้าใช้งาน</th>
                <th>ตำแหน่ง</th>
                <th>ระดับ</th>
                <th>สาขา</th>
                <th>จัดกลุ่มบุคลากร</th>
                <th style="width:2%;">แสดงข้อมูล</th>
                <th style="width:2%;">ดึกข้อมูลจากDpis</th>
              </tr>
            </thead>
            <tbody>
			<?php
							$i=1;
								    
			
			
			//ค้นหาจาก LDAP แล้วเอามาใส่ ฐานข้อมูลของเรา
			
			$model=new frm_user;
			
			
			$data=$model->searchusernew();
						
						
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
												echo'<td><button class="btn btn-floating btn-warning btn-sm" type="button" data-id="'.$id.'" onclick="editdata(this)" title="ดูข้อมูล"><i class="fa fa-user" aria-hidden="true"></i></button></td>';
										if($dataitem1["em_per_id"] !=''){		
										
										echo'<td><button class="btn btn-floating btn-success btn-sm" type="button" data-id="'.$id.'" data-user="'.$dataitem1["em_username"].'" onclick="datadpisupdate(this)" title="อัฟเดทdpis"><i class="fa fa-refresh" aria-hidden="true" ></i></button></td>';
										
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
		
   
      // DataTable
      var table = $('#Tabledatausernew').DataTable({
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
		</script>