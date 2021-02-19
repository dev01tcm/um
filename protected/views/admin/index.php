<section id="project-area" class="project-area solid-bg">
	<div class="container">
		<div class="col-md-12">
			<h3 class="section-sub-title">การใช้งานระบบ Admin</h3>
			<ol class="breadcrumb">
                <li>หน้าแรก</li>
                <li class="navigator"></li>
            </ol>
		</div>
		<!--/ Title row end -->

		<div class="col-md-12">
			
			<div class="row">
				<div class="facts-wrapper1">
					<!-- <a href="#">
						<div class="col-sm-3 ts-facts">
							<div class="ts-facts-img">
								<img class="img-fluid img-icon" src="images/icon-image/menu1.png" alt="">
							</div>
							<div class="ts-facts-content">
								<h2 class="ts-facts-num"></h2>
								<h3 class="ts-facts-title">จัดการระบบ UM</h3>
							</div>
						</div>
					</a> -->
					<div class="col-sm-1 ts-facts"></div>
					<a class="btn-link-menu1" href="#">
						<div class="col-sm-3 ts-facts">
							<div class="ts-facts-img">
								<img class="img-fluid img-icon" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-image/menu2.png" alt="">
							</div>
							<div class="ts-facts-content">
								<h2 class="ts-facts-num"></h2>
								<h3 class="ts-facts-title">รายงาน</h3>
							</div>
						</div><!-- Col end -->
					</a>
					<a class="btn-link-menu2" href="#">
						<div class="col-sm-3 ts-facts">
							<div class="ts-facts-img">
								<img class="img-fluid img-icon" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-image/menu3.png" alt="">
							</div>
							<div class="ts-facts-content">
								<h2 class="ts-facts-num"></h2>
								<h3 class="ts-facts-title">ตั้งค่าระบบ</h3>
							</div>
						</div><!-- Col end -->
					</a>
					<a class="btn-link-menu3" href="#">
						<div class="col-sm-3 ts-facts">
							<div class="ts-facts-img">
								<img class="img-fluid img-icon" src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-image/menu4.png" alt="">
							</div>
							<div class="ts-facts-content">
								<h2 class="ts-facts-num"></h2>
								<h3 class="ts-facts-title">SQL QUERY</h3>
							</div>
						</div><!-- Col end -->
					</a>
					<div class="col-sm-1 ts-facts"></div>

				</div> <!-- Facts end -->
			</div>

		</div><!-- Content col-md-12 end -->
	</div>
	<!--/ Container end -->
</section><!-- Project area end -->

<div tabindex="-1" class="modal fade modal-primary" id="Addemployeemodal" role="dialog" aria-labelledby="exampleModalPrimary2" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" aria-label="Close" type="button" data-dismiss="modal">
          <span class="font-01" aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="modaldetailLabel"><i class="fa fa-download"></i> การนำเข้าข้อมูลจากระบบ</h4>
      </div>
      <div class="modal-body font-03">
            <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group my-30" id="searchdips">
                            <div class="col-md-2 col-sm-2 col-xs-2 mb-15">
                              <label id="textdpis" class="txtlabel">DPIS </label>  
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-8 mb-15">
                              <input type="text" id="inputSearch" class="form-control" placeholder="ค้นหาโดยการใช้เลขบัตรประชาชน">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2 mb-15">
                              <button type="button" id="buttomdpis" class="btn btn-info btn-md" onclick="searchdpis()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="form-group my-30" id="iduserper">
                            <div class="col-md-6 mb-15">
                                <label class="txtlabel">ชื่อผู้ใช้ </label>  
                                <input type="text" id="username" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6 mb-15">
                              <label class="txtlabel">เลขลำดับในdpis</label>  
                              <input type="text" id="per_id" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group my-30">
                            <div class="col-md-4 mb-15">
                                <label class="txtlabel">คำนำหน้าชื่อ(ภาษาไทย) </label>
								<input type="text" id="initials" class="form-control" placeholder="">								
                            </div>
                            <div class="col-md-4 mb-15">
                              <label class="txtlabel">ชื่อภาษาไทย </label>  
                              <input type="text" id="fisrtname" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-4 mb-15">
                              <label class="txtlabel">นามสกุลภาษาไทย </label>  		
                              <input type="text" id="surrname" class="form-control" placeholder="">
                            </div>
                       </div>
                        <div class="form-group my-30">
                    
                            <div class="col-md-4 mb-15">
                                <label class="txtlabel">คำนำหน้าชื่อ(ภาษาอังกฤษ)</label>
									<input type="text" id="title" class="form-control" placeholder="">		
                            </div>
                            <div class="col-md-4 mb-15">
                                <label class="txtlabel">ชื่อภาษาอังกฤษ </label>  
                              <input type="text" class="form-control" id="givenName" placeholder="">
                            </div>
                            <div class="col-md-4 mb-15">
                              <label class="txtlabel">นามสกุลภาษาอังกฤษ </label>  
                              <input type="text" class="form-control" id="sn" placeholder="">
                            </div>
                        </div>
                        <div class="form-group my-30">
                            <div class="col-md-6 mb-15">
                                <label class="txtlabel">เลขบัตรประชาชน </label>								
                              <input type="text" class="form-control" id="ssopersoncitizenid" placeholder="หมายเลขบัตรประชาชน">
                            </div>
                            <div class="col-md-6 mb-15">
                              <label class="txtlabel">วันเดือนปีเกิด </label> 
							  <input type="text" class="form-control" readonly  placeholder="เริ่มวันที่" name="ssopersonbirthdate" id="ssopersonbirthdate">
                            </div>
                        </div>
                        <div class="form-group my-30">
                            <div class="col-md-6 mb-15">
                                <label class="txtlabel">ประเภทของพนักงาน </label>  
								<select class="form-control" id="employeeType">
								<option value="">เลือกทั้งหมด</option>
								<?php
											$qusg = new CDbCriteria( array(
												'condition' => "ut_status like :StatusData ",         
												'params' => array(':StatusData' => "1")  
											));
											$modelusg = MasUserType::model()->findAll($qusg);
											$countusg = count($modelusg);
											$rowno = 1;
											foreach ($modelusg as $rows)
											{
												?>
											<option value="<?php echo $rows->ut_name; ?>"><?php echo $rows->ut_name; ?></option>
											<?php
											}
												?>           
								</select>
                            </div>
                            <div class="col-md-6 mb-15">
                              <label class="txtlabel">วันเวลาที่บรรจุ </label> 
							  <input type="text" class="form-control" readonly  placeholder="เริ่มวันที่" name="ssopersonempdate" id="ssopersonempdate">							  
							</div>
                        <div class="form-group my-30">
                            <div class="col-md-6 mb-15">
                                <label class="txtlabel">ชื่อตำแหน่งงาน </label>
								<select class="form-control" id="ssopersonposition">
								<option value="">เลือกทั้งหมด</option>
									<?php
										$qusg = new CDbCriteria( array(
											'condition' => "StatusData like :StatusData ",         
											'params' => array(':StatusData' => "1")  
										));
										$modelusg = MasPosition::model()->findAll($qusg);
										$countusg = count($modelusg);
										$rowno = 1;
										foreach ($modelusg as $rows)
										{
											?>
										<option value="<?php echo $rows->PositNameTH; ?>"><?php echo $rows->PositNameTH; ?></option>
										<?php
										}
											?>           
									</select>								
                            
                            </div>
                            <div class="col-md-6 mb-15">
                              <label class="txtlabel">ตำแหน่งในการบริหารงาน </label>  
                              <input type="text" id="PM_NAME" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group my-30">
                            <div class="col-md-6 mb-15">
                                <label class="txtlabel">ระดับชั้นของพนักงาน </label>
								<select class="form-control" id="ssopersonclass">
								<option value="">เลือกทั้งหมด</option>
									<?php
										$qusg = new CDbCriteria( array(
											'condition' => "StatusData like :StatusData ",         
											'params' => array(':StatusData' => "1")  
										));
										$modelusg = MasPositionLe::model()->findAll($qusg);
										$countusg = count($modelusg);
										$rowno = 1;
										foreach ($modelusg as $rows)
										{
											?>
										<option value="<?php echo $rows->PositLevelNameTH; ?>"><?php echo $rows->PositLevelNameTH; ?></option>
										<?php
										}
											?>           
									</select>								
                             
                            </div> 
                           
                            <div class="col-md-6 mb-15"> 
                                <label class="txtlabel">หน่วยงาน </label>
								<select class="form-control" id="workingdeptdescription">
								<option value="">เลือกทั้งหมด</option>
									<?php
										$qusg = new CDbCriteria( array(
											'condition' => "StatusData like :StatusData ",         
											'params' => array(':StatusData' => "1")  
										));
										$modelusg = MasDepartment::model()->findAll($qusg);
										$countusg = count($modelusg);
										$rowno = 1;
										foreach ($modelusg as $rows)
										{
											?>
										<option value="<?php echo $rows->DeptNameTH; ?>"><?php echo $rows->DeptNameTH." ".$rows->DeptID; ?></option>
										<?php
										}
											?>           
									</select>
                            </div>
                         
                        </div>
                        <div class="form-group my-30">
                            <div class="col-md-6 mb-15" id="divmail"> 
                                <label class="txtlabel">อีเมล์</label>  
                              <input type="text" id="mail" class="form-control" placeholder="ใช้  ชื่อ.อักษรตัวแรกของนามสกุล@sso.co.th ตัวอย่าง kanoktip.p@sso.go.th">
                            </div>
                            <div class="col-md-6 mb-15" id="divmaildrop"> 
                              <label class="txtlabel">อีเมล์สำรอง </label>  
                              <input type="text" id="maildrop" class="form-control" placeholder="ใช้  ชื่อ.อักษรตัวแรกของนามสกุล@sso.co.th ตัวอย่าง kanoktip.p@sso.go.th">
                            </div>
                        </div>
                        <div class="form-group my-30">
                            <div class="col-md-6 mb-15"> 
									
								<div class="col-md-6 mb-15"> 
								  <label class="txtlabel">เพศ </label>
									<select class="form-control" id="PER_GENDER">
										 <option value="">เลือกทั้งหมด</option>
										 <option value="1">ชาย</option>
										 <option value="2">หญิง</option>
									</select>							 
								</div>
							</div>
                        <div class="form-group my-30">
                            <div class="col-md-6 mb-15"> 
                                <label class="txtlabel">เลือกกลุ่มผู้ใช้งานระบบ </label>  
                                 <select class="form-control" id="drpdep111">
								 <option value="">เลือกทั้งหมด</option>
									<?php
										$qusg = new CDbCriteria( array(
											'condition' => "ug_status like :StatusData ",         
											'params' => array(':StatusData' => "1")  
										));
										$modelusg = MasUserGroup::model()->findAll($qusg);
										$countusg = count($modelusg);
										$rowno = 1;
										foreach ($modelusg as $rows)
										{
											?>
										<option value="<?php echo $rows->ug_id; ?>"><?php echo $rows->ug_description; ?></option>
										<?php
										}
											?>           
								  </select>
                            </div>
                            <div class="col-md-6 mb-15"> 
                                <label class="txtlabel">สถานะการทำงาน </label>  
                                <select class="form-control" id="accountActive">
								     <option value="">เลือกทั้งหมด</option>
                                     <option value="1">Active</option>
                                     <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                  
                       
                </div><!-- row -->
            </div>
      </div><!-- modal-body -->
      <div class="modal-footer">
        <button class="btn btn-default font-03" aria-label="Close" type="button" data-dismiss="modal"><i class="fa fa-close" ></i> ยกเลิก</button>
         <button class="btn btn-info font-03" id="buttonok" type="button" onclick="savedatauser()"><i class="fa fa-edit" aria-hidden="true"></i> บันทึกอัพเดทข้อมูล</button>
      </div>
    </div>
  </div>
</div>


<?php require_once("admin-js.php"); ?>





