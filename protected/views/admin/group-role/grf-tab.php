<div class="row">
	<div class="col-md-12">
		<div class="form-group my-30">
			<div class="col-md-3 mb-15"> 
	           	<label class="txtlabel">เลือกประเภทบุคลากร <?php $_POST['ide']?></label>  
	              	<select class="form-control user_type" id="user_type">
	              		<option value=""  >เลือกประเภทบุคลากร</option>
						<?php
				          $qusg = new CDbCriteria( array(
				                'condition' => "ut_status like :ut_status ",         
				                'params'    => array(':ut_status' => "1")  
				          ));
				          $modelusg = MasUserType::model()->findAll($qusg);
				          $countusg = count($modelusg);
				          $rowno = 1;

				          $i=0;$strApp='';
				              foreach ($modelusg as $rows){
				                $ut_id = $rows->ut_id; 
				                $ut_name = $rows->ut_name;
				                
				                  $strApp.='<option value="'.$ut_name.'" id="'.$ut_id.'"  >'.$ut_name.'</option>';
				              }
				          ?>
				        <?php echo $strApp;?>        
		            </select>
	    	</div>
        	<div class="col-md-3 mb-15"> 
	           	<label class="txtlabel">เลือกประเภทตำแหน่ง </label>  
	           	<select class="form-control user_poman" id="user_poman">
	           		<option value=""  >เลือกประเภทตำแหน่ง</option>
					<?php
			          $qusg1 = new CDbCriteria( array(
			                'condition' => "pm_status like :pm_status ",         
			                'params'    => array(':pm_status' => "1")  
			          ));
			          $modelusg1 = MasPositionMan::model()->findAll($qusg1);
			          $countusg1 = count($modelusg1);
			          $rowno1 = 1;

			          $i=0;$strApp1='';
			              foreach ($modelusg1 as $rows1){
			                $pm_id = $rows1->pm_id; 
			                $pm_name_th = $rows1->pm_name_th;
			                $id_user_type = $rows1->id_user_type;
			                
			                  $strApp1.='<option value="'.$pm_name_th.'" id="'.$pm_id.'" id_usertype="'.$id_user_type.'" >'.$pm_name_th.'</option>';
			              }
			          ?>
			        <?php echo $strApp1;?>            
	            </select>
    		</div>
	    	<div class="col-md-3 mb-15"> 
	           	<label class="txtlabel">เลือกระดับตำแหน่ง </label>  
	           	<select class="form-control user_level" id="user_level">
	           		<option value=""  >เลือกระดับตำแหน่ง</option>
					<?php
			          $qusg2 = new CDbCriteria( array(
			                'condition' => "StatusData like :StatusData ",         
			                'params'    => array(':StatusData' => "1")  
			          ));
			          $modelusg2 = MasPositionLe::model()->findAll($qusg2);
			          $countusg2 = count($modelusg2);
			          $rowno2 = 1;

			          $i=0;$strApp2='';
			              foreach ($modelusg2 as $rows2){
			                $PositLevelID = $rows2->PositLevelID; 
			                $PositLevelNameTH = $rows2->PositLevelNameTH;
			                $id_user_type = $rows2->id_user_type;
			                
			                  $strApp2.='<option value="'.$PositLevelNameTH.'" id="'.$PositLevelID.'" id_usertype="'.$id_user_type.'" >'.$PositLevelNameTH.'</option>';
			              }
			          ?>
			        <?php echo $strApp2;?>           
	            </select>
    		</div>
    		<div class="col-md-3 mb-15">
    			<button type="button" class="btn btn-info btn-md btn-add-gdata" style="margin-top:26px;">
		          	<i class="fa fa-plus"></i> เพิ่มข้อมูล
		        </button>
    		</div>
        </div>
	</div>
</div>
<div class="row" style="padding:15px;">
	<div class="col-md-12" style="height:550px;border:1px solid #b8b8b8;overflow-x: auto;">
		<div>
			<table class="table table-striped table-level" >

				<?php
					$grouprole_id = $_POST['ide'];
					$qusg3 = new CDbCriteria( array(
				        'condition' => "id_group_of_role = :id_group_of_role and  tg_status = :tg_status",         
			            'params'    => array(':id_group_of_role' => $grouprole_id, ':tg_status' => '1') 
				    ));
				    $modelusg3 = TranGroupOfRole::model()->findAll($qusg3);
				    foreach ($modelusg3 as $rowss1){
				    	$CallApp['tg_id']=$rowss1->tg_id; 
				    	$CallApp['id_group_of_role']=$rowss1->id_group_of_role; 
				    	$CallApp['id_position_man']=$rowss1->id_position_man; 
				    	$CallApp['id_user_type']=$rowss1->id_user_type;
				    	$CallApp['id_position_level']=$rowss1->id_position_level;
				    	$CallApp['tg_status']=$rowss1->tg_status;

				    	$userType01 = $CallApp['id_user_type'];
				    	$userPoMan01 = $CallApp['id_position_man'];
				    	$userPoLe01 = $CallApp['id_position_level'];


				    	$CallAppssType = AdminController::CallUserType($userType01);
				    	$CallAppssMan = AdminController::CallPositionManByID($userPoMan01);
				    	$CallAppssLe = AdminController::CallPositionLeByID($userPoLe01);
				    	


				    	echo '<tr><td>'.$CallAppssType['ut_name'].'</td><td>'.$CallAppssMan['pm_name_th'].'</td><td>'.$CallAppssLe['PositLevelNameTH'].'</td><td><button class="btn btn-danger btn-sm btn-del-gfr" id="'.$CallApp['tg_id'].'" ><i class="fa fa-trash"></i></button></td></tr>';
				    }
				?>

			
			<table class="table table-striped table-level table-add-gdata" >
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" >
		<button type="button" class="btn btn-success btn-md btn-save-gdata" style="float:right;">
          	<i class="fa fa-plus"></i> บันทึกข้อมูล
        </button>
	</div>
</div>




<script type="text/javascript">
$(document).ready(function(){

	var count = 0;

	$(".btn-add-gdata").click(function(){
		count++;

		var user_type = $('#user_type').val();
		var id_user_type = $('#user_type option:selected').attr('id');

		var user_poman = $('#user_poman').val();
		var id_user_poman = $('#user_poman option:selected').attr('id');

		var user_level = $('#user_level').val();
		var id_user_level = $('#user_level option:selected').attr('id');

		if(user_poman!="" && user_level!="" && user_type!=""){

			$(".table-add-gdata").append('<tr class="idtrdata gfdata'+count+'" idtrdata="'+id_user_type+'/'+id_user_poman+'/'+id_user_level+'"><td id_user_type'+count+'="'+id_user_type+'">'+user_type+'</td><td id_user_poman'+count+'="'+id_user_poman+'">'+user_poman+'</td><td id_user_level'+count+'="'+id_user_level+'">'+user_level+'</td><td><button class="btn btn-danger btn-sm btn-del-gdata'+count+'" id="'+count+'"><i class="fa fa-trash"></i></button></td></tr>');


		    $('.btn-del-gdata'+count).click(function() {
			  	var data_id = $(this).attr('id');
			    $('.gfdata'+data_id).remove();
			    return false;พะ
			});

		}else{

			swal({
                title: "ทำรายการไม่สำเร็จ",
                text: "กรุณาใส่ข้อมูลให้ครบถ้วน",
                type: "warning",
                confirmButtonColor: "#00E5DA",
                confirmButtonText: "ปิด",
                closeOnConfirm: true
                },
            function(){
                
            });
		}

		

	    
	});



	//-------------------------------------------------------------------------------- CHECK


	$( ".user_type" ).change(function() {
		$( '.user_poman option' ).hide();
	  	var id_user_type = $('.user_type option:selected').attr('id');

	  	if(id_user_type){
	  		$( '.user_poman option[id_usertype=' + id_user_type + ']' ).show();
	  	}

	});

	$( ".user_type" ).change(function() {
		$( '.user_level option' ).hide();
	  	var id_user_type = $('.user_type option:selected').attr('id');

	  	if(id_user_type){
	  		$( '.user_level option[id_usertype=' + id_user_type + ']' ).show();
	  	}

	});

	//------------------------------------------------------------------------------CLICK SAVE

		$(".btn-save-gdata").click(function(){
			var packdata = [];
			var ides = "<?php echo $_POST['ide']?>";
			$( ".idtrdata" ).each(function( i ) {
				var idtrdata = $(this).attr('idtrdata');
				// alert(idtrdata);
				packdata.push(idtrdata);
	    
	  		});

	  		 $.ajax({
           	 	type: "POST",
	            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/insertgroupofroledata"); ?>",
	            data: {
	                datapack : packdata,
	                ides : ides,
	                'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
	            },
	      
	            success: function (data) {
	            	if(data=='success'){
	            		swal({
							title: "ทำรายการสำเร็จ",
							text: "บันทึกข้อมูลเรียบร้อย",
							type: "success",
							confirmButtonColor: "#00E5DA",
							confirmButtonText: "ปิด",
							closeOnConfirm: true
						},
						function(){
							return true;
						});
	            	}else{
	            		swal({
							title: "ทำรายการไม่สำเร็จ",
							text: "ข้อมูลที่บันทึกเป็นข้อมูลซ้ำ กรุณาเลือกใหม่",
							type: "warning",
							confirmButtonColor: "#00E5DA",
							confirmButtonText: "ปิด",
							closeOnConfirm: true
						},
						function(){
							return false;
						});
	            	}
	                
	            },
	            error: function (data){
	                console.log(data);
	            }
	        }); 
		});
	//----------------------------------------------------------------------------btn-del-gfr
		$(".btn-del-gfr").click(function(){
			var idtrdata = $(this).attr('id');
			swal({
				title: "คุณแน่ใจหรือไม่ ?",
				text: "คุณต้องการลบรายการนี้ใช่หรือไม่",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "btn-danger",
				confirmButtonColor: "#ff4c52",
				closeOnConfirm: false,
				confirmButtonText: "ตกลง, ลบรายการนี้ !"
			},
			function(){
				$.ajax({
					type: "POST",
					url: "<?php echo Yii::app()->createAbsoluteUrl("admin/deletedatagfrole"); ?>",
					data: {
						idd : idtrdata,
						'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
					},
					success: function (data) {
						swal({
							title: "ทำรายการสำเร็จ",
							text: "ลบรายการที่ต้องการเรียบร้อย",
							type: "success",
							confirmButtonColor: "#00E5DA",
							confirmButtonText: "ปิด",
							closeOnConfirm: true
						},
						function(){
							 $.ajax({
					            type: "POST",
					            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabrelale"); ?>",
					            data: {
					                ide : "<?php echo $_POST['ide']?>",
					                'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
					            },
					      
					            success: function (data) {
					                $('.load-rela-tab').empty();
					                $('.load-rela-tab').html(data);
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
			});
		});


	

  	
  
});
</script>