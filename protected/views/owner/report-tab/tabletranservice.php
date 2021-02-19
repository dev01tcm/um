<div>
<table id="Tabledata3"  style="margin-top:20px; width:100%"  >
            <thead style="background-color:#AED6F1;">
              <tr>
                <th style="width:2%;">No.</th>
                <th>id</th>
                <th>ob_id</th>
                <th>role_code</th>
				<th>role_name</th>
                <th>app_id</th>
                <th>userid</th>
				<th>request_by</th>
                <th>appove_by</th>
                <th>reg_code</th>
				<th>app_name_th</th>
                <th>request_date</th>
                <th>create_date</th>
                <th>ma_code</th>
                <th>ma_name</th>
                <th>le_code</th>
				<th>le_name</th>
              </tr>
            </thead>
            <tbody>
			<?php
							$i=1;
								    
			
			
			//ค้นหาจาก LDAP แล้วเอามาใส่ ฐานข้อมูลของเรา
			
		//	$model=new frm_user;
			

		//	$data=$model->searchusernew();
						
						
								foreach ($Data1 as $dataitem5)
							{
								
							//	$id=$dataitem1["em_id"];
								
							   // $surnameth=$dataitem1["em_username"];
							?>
			                          <tr>
									   <td><?php echo $i; ?></td>
			                            <td><?php echo $dataitem5["id"]; ?></td>
			                            <td><?php echo $dataitem5["ob_id"]; ?></td>
			                            <td><?php echo $dataitem5["role_code"]; ?></td>
										<td><?php echo $dataitem5["role_name"]; ?></td>
			                            <td><?php echo $dataitem5["app_id"]; ?></td>
			                            <td><?php echo $dataitem5["userid"]; ?></td>
										<td><?php echo $dataitem5["request_by"]; ?></td>
			                            <td><?php echo $dataitem5["appove_by"]; ?></td>
			                            <td><?php echo $dataitem5["reg_code"]; ?></td>
										<td><?php echo $dataitem5["app_name_th"]; ?></td>
			                            <td><?php echo $dataitem5["request_date"]; ?></td>
			                            <td><?php echo $dataitem5["create_date"]; ?></td>
			                            <td><?php echo $dataitem5["ma_code"]; ?></td>
			                            <td><?php echo $dataitem5["ma_name"]; ?></td>
			                            <td><?php echo $dataitem5["le_code"]; ?></td>
										<td><?php echo $dataitem5["le_name"]; ?></td>
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
</div>	
<div>
	<div>
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
				//.	$this->Cell(0,0,iconv( 'UTF-8','TIS-620','ประกันสังคม'),0,1,"L");
					$this->Cell(0,0,iconv( 'UTF-8','TIS-620','หน้าที่  '.$this->PageNo()),0,3,"R");
					
				}
		function ImprovedTable($header,$resultData)
		{
			//Column widths
			$w=array(30,55,15,55);
			//Header
			for($i=0;$i<count($header);$i++)
				//var_dump($header[$i]);
			
				$this->Cell($w[$i],7,$header[$i],1,0,'C');
			$this->Ln();
			//Data


			foreach ($resultData as $eachResult) 
			{
				
				$this->Cell(30,6,$eachResult["ma_code"],1);
				$this->Cell(55,6,iconv( 'UTF-8','TIS-620',$eachResult["ma_name"]),1);
				$this->Cell(15,6,$eachResult["le_code"],1);
				$this->Cell(55,6,iconv( 'UTF-8','TIS-620',$eachResult["le_name"]),1);
				
				
				$this->Ln();
				
			}





			//Closure line
		//	$this->Cell(array_sum($w),0,'','T');
		}
			 
			}
		//$sql = "SELECT a.request_by,b.ma_code,b.ma_name ,b.le_code,b.le_name from trans_service_app a  inner join role_level b on a.id=b.tran_service_app_id where app_id=3";
		//$resultData =Yii::app()->db->createCommand($sql)->queryAll();
		$appid=3;

			$pdf=new PDF();
			
			
			
			$header=array('ModuleID','ModuleName','LevelID','LevelName');
		//	$pdf->Header();
			
			$sql="select id,ob_id,role_code,role_name,app_id,userid,request_by,appove_by,reg_code,app_name_th,request_date,create_date from trans_service_app where (status_service_app=0 or status_service_app=1)  and app_id='".$appid."' and (DATE_FORMAT(create_date,'%Y-%m-%d') >= '$Startdate1' and DATE_FORMAT(create_date,'%Y-%m-%d') <= '$EndDate1' )";
	
			$Data =Yii::app()->db->createCommand($sql)->queryAll();
			foreach ($Data as $row) 
			{
			$pdf->SetMargins( 25,5,5 );
			$pdf->AddPage();
			$pdf->AddFont('angsa','','angsa.php');
			$pdf->SetFont('angsa','',20);
			//$pdf->Image('fpdf181/thaicreate-logo.jpg',80,8,33);
		//	$pdf->Cell(0,20,iconv( 'UTF-8','TIS-620',$row['app_id']),0,1,"L");
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
		//	$pdf->footer();

			$pdf->Output("fpdf181/MyPDF/MyPDF.pdf","F");
		//	$sql1 ="update trans_service_app set remark='ok',status_service_app='200',update_by='app owner',updatestatus_date=now() where (status_service_app=0 or status_service_app=0) and app_id='".$appid."'";
		//	$command=yii::app()->db->createCommand($sql1);
		//	$command->execute();
				
		?>
			PDF Created Click <a href="fpdf181/MyPDF/MyPDF.pdf">here</a> to Download
	</div>
	<div>
	<?php
	 //   header("content-type:application/csv;charset=UTF-8");
    //    header("Content-Disposition:attachment;filename=\"CHS.csv\"");
		$filName = "customer.csv";
		$objWrite = fopen("customer.csv", "w");
		fwrite($objWrite, "\xEF\xBB\xBF");
		fwrite($objWrite, "\"tran_service_app_id\",\"Oject_id\",\"Role_code\",");
		fwrite($objWrite, "\"role_name\",\"app_id\",\"userid\",");
		fwrite($objWrite, "\"request_by\",\"appove_by\",\"reg_code\",");
		fwrite($objWrite, "\"app_name_th\",\"request_date\",\"create_date\",");
		fwrite($objWrite, "\"ma_code\",\"ma_name\",\"le_code\",\"le_name\" \n");
		$sql="select a.id,a.ob_id,a.role_code,a.role_name,a.app_id,a.userid,a.request_by,a.appove_by,a.reg_code,a.app_name_th,a.request_date,a.create_date,b.ma_code,b.ma_name,b.le_code,b.le_name from trans_service_app a inner join role_level b on a.id=b.tran_service_app_id  where a.status_service_app =0  and a.app_id='".$appid."'and (DATE_FORMAT(a.create_date,'%Y-%m-%d') >= '$Startdate1' and DATE_FORMAT(a.create_date,'%Y-%m-%d') <= '$EndDate1' )";
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
			echo "<br>Generate CSV Done.<br><a href=$filName>Download</a>";
			
		?>	
	</div>
</div>	
		<script type="text/javascript">
		
   $(document).ready( function () {
    $('#Tabledata3').DataTable();
} );
		</script>