<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
); ?>
<title>Login : User Management</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/images/icons/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/vendor/animate/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/vendor/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/vendor/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/css/util.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/css/main.css">

<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
		
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/img-01.jpg');">
			<div class="wrap-login100 p-b-30">
				<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
					<?php echo $form->textField($model,'username',array("class"=>"input100")); ?>
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-user"></i>
					</span>
				</div>
				<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
					<?php echo $form->passwordField($model,'password',array("class"=>"input100")); ?>
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock"></i>
					</span>
				</div>
				<div class="container-login100-form-btn p-t-10">
					<button class="login100-form-btn">
						Login
					</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$("input").addClass("input100");
		});
	</script>
	<?php $this->endWidget(); ?>
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/vendor/bootstrap/js/popper.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/vendor/select2/select2.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/Login_v12/js/main.js"></script>