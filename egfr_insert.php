<?php session_start();
	include("phpconf.php");
	include("func.php");
	conDB();
?>

<meta name="Descriptrion" content="" charset="tis-620" />

<?

		$vn = $_POST['vn'];
		$hn = $_POST['hn'];
		$ptname = $_POST['ptname'];
		$vstdate= $_POST['vstdate'];
		$creatinine= $_POST['creatinine'];
		$age= $_POST['age'];
		$sex= $_POST['sex'];
		$pt_status=$_POST['pt_black'];

		

		
		if($pt_status==1){
			$pt_call=1.212;
		}else{
			$pt_call=1;
		}
	

	

if($sex=="f"){
						
		$eGFR= 186 * (0.742) * ($pt_call) * pow($creatinine,-1.153)* pow($age,-0.203);

}else if($sex=="m"){

		$eGFR= 186 * ($pt_call) * pow($creatinine,-1.153)* pow($age,-0.203);

}else{
			
}
			
			$result = number_format($eGFR, 2, '.', '');
			

			$sql_insert ="INSERT INTO lamae_egfr(vn,hn,ptname,creatinine,age,sex,black_status,eGFR_result,vstdate,status,loginname) value('$vn','$hn','$ptname','$creatinine','$age','$sex','$pt_status','$result','$vstdate','i','$ip_Log')";


		
			
		if(mysql_query($sql_insert)){
			
			echo "<br/><br/>";
			echo "<h2><center>บันทึกข้อมูลเรียบร้อยแล้ว ค่า GFR ของ  <font color='red'>$ptname</font> คือ   <font color='blue'>$result</center></h2>";
?>
				
			<meta http-equiv="refresh" content="3;url=http://192.168.1.252/hosxp/show_opd_egfr_history.php?vn=<?=$vn?>&hn=<?=$hn?>&vstdate=<?=$vstdate?>&ptname=<?=$ptname?>">
		
			<center><h2>กรุณารอซักครู่ ระบบกำลังจะพาท่านกลับไปยังหน้าเริ่มต้น</h2></center>

<?
		}else{
			
			echo "ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้<br><center><font 
			color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font><br><a href='result_chlogin.php'>หน้าหลัก</a></center>";
		}



		
?>

	