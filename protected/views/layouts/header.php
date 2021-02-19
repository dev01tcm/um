<!-- Header start -->

<header id="header" class="header-one">
	<div class="container">
		<div class="row">
			<div class="logo-area clearfix">
				<div class="logo col-xs-12 col-md-3">
					<a href="index.html">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="">
					</a>
				</div><!-- logo end -->
		<?php
		$data="";
		$name="";
		$surname="";
		$depname="";
		$depid="";
//	$data=Yii::app()->user->id;
////	var_dump($data);
//	exit;
			$data=lkup_user::getUserid(Yii::app()->user->id);
			// var_dump($data);
		if($data!=""){
			foreach($data as $dataitem)
			{
				$name=$dataitem["em_name_th"];
				$surname=$dataitem["em_surname_th"];
				$depname=$dataitem["DeptNameTH"];
				$depid=$dataitem["DeptID"];
			}
		}
			//exit;
		?>
				<div class="col-xs-12 col-md-9 header-right">
					<ul class="top-info-box">
						<li>
							<div class="info-box">
								<div class="info-box-content">
									<p class="info-box-title">ชื่อ-นามสกุล</p>
									<p class="info-box-subtitle"><?php echo $name." ".$surname	;?></p>
								</div>
							</div>
						</li>
						<li class="last">
							<div class="info-box last">
								<div class="info-box-content">
									<p class="info-box-title">สังกัด / หน่วยงาน</p>
									<p class="info-box-subtitle">: <?php echo $depname."(".$depid.")"	;?></p>
								</div>
							</div>
						</li>
					</ul><!-- Ul end -->
				</div><!-- header right end -->
			</div><!-- logo area end -->

		</div><!-- Row end -->
	</div><!-- Container end -->

	<nav class="site-navigation navigation navdown">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="site-nav-inner pull-left">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<div class=" navbar-collapse navbar-responsive-collapse">
							<ul class="nav navbar-nav">

								<li  class="menu-link menu-link-pro">
									<a href="#" class="menu-link-pro">
										<span class="txt-menu"><i class="fa fa-user"></i> : หน้าแรก</span>
									</a>
								</li>
						<?php  if(Yii::app()->session['um_user_group_id']==1 || Yii::app()->session['um_user_group_id']==2)
								{
						?>
								<li  class="menu-link menu-link-ad">
									<a href="#" class="menu-link-ad">
										<span class="txt-menu"><i class="fa fa-user"></i> : จัดการระบบ UM</span>
									</a>
								</li>
						<?php
								}
								if(Yii::app()->session['um_user_group_id']==1 || Yii::app()->session['um_user_group_id']==2 || Yii::app()->session['um_user_group_id']==4 || Yii::app()->session['um_user_group_id']==3 )
								{
						?>
								<li  class="menu-link menu-link-re">
									<a href="#" class="menu-link-re">
										<span class="txt-menu"><i class="fa fa-user"></i> : ข้อมูลขอสิทธิ์ระบบงาน</span>
									</a>
								</li>
						<?php
								}
								if(Yii::app()->session['um_user_group_id']==4|| Yii::app()->session['um_user_group_id']==1 || Yii::app()->session['um_user_group_id']==2)
								{
						?>		
								<li  class="menu-link menu-link-ow">
									<a href="#" class="menu-link-ow">
										<span class="txt-menu"><i class="fa fa-user"></i> : จัดการระบบงาน</span>
									</a>
								</li>
						<?php
								}
								if(Yii::app()->session['um_user_group_id']==5 || Yii::app()->session['um_user_group_id']==1 || Yii::app()->session['um_user_group_id']==2 || Yii::app()->session['um_assign_id'] != '0')
								{
						?>
								<li  class="menu-link menu-link-ap">
									<a href="#" class="menu-link-ap">
										<span class="txt-menu"><i class="fa fa-user"></i> : จัดการข้อมูลสิทธิ์ผู้ใช้งาน</span>
									</a>
								</li>
						<?php
								}
						?>		

							</ul>
							<!--/ Nav ul end -->
							
						</div>
						<!--/ Collapse end -->


					</div><!-- Site Navbar inner end -->

				</div>
				<!--/ Col end -->
			</div>
			<!--/ Row end -->

			<div class="nav-search" title="verstion"  style="right:195px;top:15px;">
				<a id="search" style="line-height:18px;" > Verstion UM : 0.0.1 <br> Verstion JS : 0.0.1 </a>
			</div><!-- Search end -->

			<div class="nav-search" title="ออกจากระบบ" href="<?php echo Yii::app()->createUrl('logout'); ?>" >
				<a id="search" href="<?php echo Yii::app()->createUrl('logout'); ?>"><i class="fa fa-sign-out"></i> ออกจากระบบ </a>
			</div><!-- Search end -->
		</div>
		<!--/ Container end -->

	</nav>
	<!--/ Navigation end -->
</header>
<!--/ Header end -->
