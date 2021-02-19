<div class="container">
		<div class="col-md-12">
			<?php
				require('fpdf181/fpdf.php');

				define('FPDF_FONTPATH','font/');

				class PDF extends FPDF
				{
				function Header(){
				$this->Image('fpdf181/ssol3.png',5,5,20);
				$this->AddFont('angsa','','angsa.php');
				$this->SetFont('angsa','',13);
				$this->Cell(0,0,iconv( 'UTF-8','TIS-620','วันที่  '.date("Y-m-d")),0,1,"R");
				$this->Ln(20);
				}

				function Footer(){
				$this->AddFont('angsa','','angsa.php');
				$this->SetFont('angsa','',13);
				$this->SetY(-15);
				$this->Cell(0,0,iconv( 'UTF-8','TIS-620','หน้าที่  '.$this->PageNo()),0,3,"R");

				}
				function ImprovedTable($header,$resultData)
				{
				$w=array(30,55,15,55);
				for($i=0;$i<count($header);$i++)
				$this->Cell($w[$i],7,$header[$i],1,0,'C');
				$this->Ln();
				foreach ($resultData as $eachResult) 
				{
				$this->Cell(30,6,$eachResult["ma_code"],1);
				$this->Cell(55,6,iconv( 'UTF-8','TIS-620',$eachResult["ma_name"]),1);
				$this->Cell(15,6,$eachResult["le_code"],1);
				$this->Cell(55,6,iconv( 'UTF-8','TIS-620',$eachResult["le_name"]),1);
				$this->Ln();
				}
				}
				}
				$appid=3;
				$pdf=new PDF();
				$header=array('ModuleID','ModuleName','LevelID','LevelName');
				$sql="select id,ob_id,role_code,role_name,app_id,userid,request_by,appove_by,reg_code,app_name_th,request_date,create_date from trans_service_app where status_service_app=0  and app_id='".$appid."'";
				$Data =Yii::app()->db->createCommand($sql)->queryAll();
				foreach ($Data as $row) 
				{
				$pdf->SetMargins( 25,5,5 );
				$pdf->AddPage();
				$pdf->AddFont('angsa','','angsa.php');
				$pdf->SetFont('angsa','',20);
				$pdf->Cell(0,20,iconv( 'UTF-8','TIS-620','รายการขอสิทธิ์ของ'.$row['app_name_th']),0,1,"C");
				$pdf->Cell(0,10,iconv( 'UTF-8','TIS-620',''),0,1,"C");
				$pdf->SetFont('angsa','',16);
				$pdf->Cell(0,8,iconv( 'UTF-8','TIS-620','USERIDผู้ได้รับสิทธิ์::'.$row['userid']),0,1,"L");
				$pdf->Cell(0,8,iconv( 'UTF-8','TIS-620','คนขอสิทธิ์::'.$row['request_by']),0,1,"L");
				$pdf->Cell(0,8,iconv( 'UTF-8','TIS-620','คนให้สิทธิ์::'.$row['appove_by']),0,1,"L");
				$pdf->Cell(0,8,iconv( 'UTF-8','TIS-620','ขอสิทธิ์วันที่::'.$row['request_date']),0,1,"L");
				$pdf->Cell(0,8,iconv( 'UTF-8','TIS-620','อนุมัติสิทธิ์วันที่::'.$row['create_date']),0,1,"L");
				$pdf->Cell(0,5,iconv( 'UTF-8','TIS-620',''),0,1,"C");
				$sql="select ma_code,ma_name,le_code,le_name from role_level where  tran_service_app_id='".$row['id']."'";
				$resultData =Yii::app()->db->createCommand($sql)->queryAll();
				$pdf->ImprovedTable($header,$resultData);

				}
				$pdf->Output("fpdf181/MyPDF/MyPDF.pdf","F");
				$sql1 ="update trans_service_app set remark='ok',status_service_app='200',update_by='app owner',updatestatus_date=now() where (status_service_app=0 or status_service_app=0) and app_id='".$appid."'";
				$command=yii::app()->db->createCommand($sql1);
				$command->execute();
			?>
				
				<div class="col-sm-6 col-xs-6" style="padding-top: 10px;">
					<div class="form-group">
						<p class="example-title">Download PDF file : </p>
						<a href="fpdf181/MyPDF/MyPDF.pdf">
							<button class="btn btn-outline btn-info" type="button" id="btn_mod">
								<i class="fa fa-download" aria-hidden="true"></i> PDF Download
							</button>
						</a>
					</div>
				</div>
			<?php
				$filName = "customer.csv";
				$objWrite = fopen("customer.csv", "w");
				fwrite($objWrite, "\xEF\xBB\xBF");
				fwrite($objWrite, "\"tran_service_app_id\",\"Oject_id\",\"Role_code\",");
				fwrite($objWrite, "\"role_name\",\"app_id\",\"userid\",");
				fwrite($objWrite, "\"request_by\",\"appove_by\",\"reg_code\",");
				fwrite($objWrite, "\"app_name_th\",\"request_date\",\"create_date\",");
				fwrite($objWrite, "\"ma_code\",\"ma_name\",\"le_code\",\"le_name\" \n");
				$sql="select a.id,a.ob_id,a.role_code,a.role_name,a.app_id,a.userid,a.request_by,a.appove_by,a.reg_code,a.app_name_th,a.request_date,a.create_date,b.ma_code,b.ma_name,b.le_code,b.le_name from trans_service_app a inner join role_level b on a.id=b.tran_service_app_id  where a.status_service_app =0  and a.app_id='".$appid."'";
				$Data1 =Yii::app()->db->createCommand($sql)->queryAll();
				foreach ($Data1 as $objResult) 
				{

				fwrite($objWrite, "\"$objResult[id]\",\"$objResult[ob_id]\",\"$objResult[role_code]\",");
				fwrite($objWrite, "\"$objResult[role_name]\",\"$objResult[app_id]\",\"$objResult[userid]\",");
				fwrite($objWrite, "\"$objResult[request_by]\",\"$objResult[appove_by]\",\"$objResult[reg_code]\",");
				fwrite($objWrite, "\"$objResult[app_name_th]\",\"$objResult[request_date]\",\"$objResult[create_date]\",");
				fwrite($objWrite, "\"$objResult[ma_code]\",\"$objResult[ma_name]\",\"$objResult[le_code]\",\"$objResult[le_name]\" \n");
				}
				fclose($objWrite);
				// echo "<br>Generate CSV Done.<br><a href=$filName>Download</a>";


			?>

			<div class="col-sm-6 col-xs-6" style="padding-top: 10px;">
				<div class="form-group">
					<p class="example-title">Download CSV file : </p>
					<a href="<?php echo $filName;?>">
						<button class="btn btn-outline btn-info" type="button" id="btn_mod">
							<i class="fa fa-download" aria-hidden="true"></i> CSV Download
						</button>
					</a>
				</div>
			</div>
	</div>
</div>
<script type="text/javascript">
	function datapremiss() {
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl("site/datapermission"); ?>",
			data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
			
			success: function (data) {
				$('#tbuser').html(data);
			}
		}); 
	}
</script>