<style>
	.example-title {
		font-size: 23px;
	}
	
	input[type="text"], .btn {
		font-size: 23px;
	}
</style>
<section id="project-area" class="project-area solid-bg">
	<div class="container">
		<div class="col-md-12">
			<h3 class="section-sub-title">การใช้งานระบบ Approver</h3>
			<ol class="breadcrumb">
				<li>หน้าแรก</li>
				<li class="navigator"></li>
			</ol>
		</div>
		<div class="col-md-12"> <?php
			$masterdata = MasRequest::getCountreq();
			$rowno = 1;
			foreach ($masterdata as $dataitem) {
				$cnt_req = $dataitem["cnt_req"];
			} ?>
			<ul class="nav nav-tabs " id="myTab" role="tablist">
				<li class="nav-item active btn-nav-f">
					<a class="nav-link btn-request" id="profile-tab" data-toggle="tab" role="tab" href="#profile" aria-controls="profile" aria-selected="false">รายการคำขอ <span class="badge badge-danger req-notifi"><?php echo $cnt_req; ?></span></a>
				</li>
				<li class="nav-item btn-nav-f">
					<a class="nav-link btn-tran" id="contact-tab" data-toggle="tab" href="#contact" role="tab" href="#contact" aria-controls="contact" aria-selected="false">บุคลากรเข้าใหม่ / ย้าย <span class="badge badge-danger">4</span></a>
				</li>
				<li class="nav-item btn-nav-f">
					<a class="nav-link btn-emp" id="contact2-tab" data-toggle="tab" href="#contact2" role="tab" href="#contact2" aria-controls="contact2" aria-selected="false">ข้อมูลบุคลากร</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade active in" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="row load-request-tab">
					</div>
				</div>
				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					<div class="row load-tran-tab">
					</div>
				</div>
				<div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact2-tab">
					<div class="row load-emp-tab">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php require_once("approver-js.php"); ?>