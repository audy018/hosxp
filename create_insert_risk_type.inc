<?php
$sqlc = "SELECT * FROM  risk_type "; //เช็คค่าข้อมูลที่ส่งมาจากฟอร์ม
				$result = mysql_db_query($DBName,$sqlc)
				or $chk='N';
				// หาจำนวนเรกคอร์ดข้อมูล
if($chk=='N'){
$sqlcrete ="CREATE TABLE `risk_type` (
`idt` INT default NULL AUTO_INCREMENT ,
`typename` TEXT NOT NULL ,
PRIMARY KEY ( `idt` )) CHARACTER SET = tis620; ";
		$result = mysql_db_query($DBName,$sqlcrete)
		or die("ไม่สามารถสร้างตาราง risk_type ได้".mysql_error());
//row1		
$sql1="INSERT INTO `risk_type` ( `idt` , `typename`)
VALUES ('' , 'อุบัติการณ์') ";
		$result = mysql_db_query($DBName,$sql1)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_type ได้".mysql_error());
//row2		
$sql2="INSERT INTO `risk_type` ( `idt` , `typename`)
VALUES ('' , 'ข้อร้องเรียน') ";
		$result = mysql_db_query($DBName,$sql2)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_type ได้".mysql_error());

 }//n

?>