<section id="project-area" class="project-area solid-bg">
	<div class="container">
		<div class="col-md-12">
			<h3 class="section-sub-title">Profile : ข้อมูลส่วนตัว</h3>
			<ol class="breadcrumb">
                <li>หน้าแรก</li>
                <li class="navigator">ข้อมูลส่วนตัว</li>
            </ol>
		</div>
		<?php
		
			$data=lkup_user::getUserid(Yii::app()->user->id);
			//var_dump($data);
			foreach($data as $dataitem)
			{
				
			}
			//exit;
		?>
		<div class="col-md-12">
			<div class="row">
		  		<div  class="col-sm-12 col-xs-12 contact-info-box">
		  			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pd-15" style="background-color:#eee;">

						<div class="sidebar sidebar-left">

							<div class="widget recent-posts">
								<h3 class="widget-title">โปรไฟล์</h3>
								<div class="quote-item-footer text-center">
									<?php 
										if(file_exists("https://dpisuat.sso.go.th/".Yii::app()->session['em_image'].Yii::app()->session['em_citizen_id']."-001.jpg")){
											$pic_data = "https://dpisuat.sso.go.th/".Yii::app()->session['em_image'].Yii::app()->session['em_citizen_id']."-001.jpg";
										}else{
											$pic_data = "https://dpisempuat.sso.go.th/".Yii::app()->session['em_image'].Yii::app()->session['em_citizen_id']."-001.jpg";
										}
									?>
			                     	<img class="testimonial-thumb" src="<?php echo $pic_data;?>" alt="testimonial">
			                     	<p>
			                     		<div class="quote-item-info">
				                        	<h3 class="quote-author"> <?php echo $dataitem["em_name_th"]." ".$dataitem["em_surname_th"]	;?></h3>
				                     	</div>
			                     	</p>
			                  	</div>
			                  	<div class="widget">
									<ul class="arrow nav nav-tabs nav-stacked">
					              			<li><i class="fa fa-user" aria-hidden="true"> </i>รหัสเข้าใช้งาน:  <?php echo $dataitem["em_username"];	?></li>
								           	<li><i class="fa fa-bookmark" aria-hidden="true"> </i> เลขบัตรประชาชน: <?php echo $dataitem["em_citizen_id"];	?></li>
								            <li><i class="fa fa-calendar" aria-hidden="true"> </i> วันเดือนปีเกิด: <?php echo $dataitem["em_birthday"];	?></li>
								            <li><i class="fa fa-map" aria-hidden="true"> </i> หน่วยงาน: <?php echo $dataitem["DeptNameTH"]	;?></li>
								            <li><i class="fa fa-envelope" aria-hidden="true"> </i> อีเมล์: <?php echo $dataitem["em_email"];	?></li>
								            <li><i class="icon fa-check" aria-hidden="true"> </i> สถานะในการทำงาน:<?php if( $dataitem["em_work_status"]==1){echo "TRUE";}else{echo "FALSE";}	?></li>
								            <li><i class="fa fa-flag" aria-hidden="true"> </i> ระดับในการเข้าใช้งานระบบ: <?php echo $dataitem["ug_name"];	?></li>
								            <li><i class="fa fa-desktop" aria-hidden="true"> </i> เบอร์ภายใน: 458</li>
								            <li><i class="fa fa-mobile" aria-hidden="true"> </i>   เบอร์มือถือ: 081-2345678</li>
					            	</ul>
								</div>
								
							</div><!-- Recent post end -->
						</div><!-- Sidebar end -->
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pd-15">
						<div class="sidebar sidebar-left">

							<div class="widget recent-posts">
								<h3 class="widget-title">ประกาศข่าวสาร</h3>
								<div class="post">
									<div class="post-body">
										<div class="entry-header">
											<h2 class="entry-title">
								 				<a href="news-single.html">We Just Completes $17.6 million Medical Clinic in Mid-Missouri</a>
								 			</h2>
										</div><!-- header end -->

										<div class="entry-content" style="padding-bottom:80px;">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur  ...</p>
										</div>

										<div class="post-footer">
											<div class="post-meta">
												<span class="post-author">
													<i class="fa fa-user"></i><a href="#"> Admin</a>
			   									</span>
												<span class="post-cat">
													<i class="fa fa-folder-open"></i><a href="#"> ประกาศข่าวสาร</a>
			   									</span>
			   									<span class="post-meta-date"><i class="fa fa-calendar"></i> June 14, 2016</span>
											</div>
										</div>

									</div><!-- post-body end -->
								</div>
								
							</div><!-- Recent post end -->
						</div><!-- Sidebar end -->
					</div>
		  		</div>
			  		
		  	</div>
		</div>
	</div>
</section>