<?php
$sqlc = "SELECT * FROM  risk_can_manage "; //เช็คค่าข้อมูลที่ส่งมาจากฟอร์ม
				$result = mysql_db_query($DBName,$sqlc)
				or $chk='N';
				// หาจำนวนเรกคอร์ดข้อมูล
if($chk=='N'){
$sqlcrete ="CREATE TABLE `risk_can_manage` (
`idm` INT default NULL AUTO_INCREMENT ,
`mname` TEXT NOT NULL ,
PRIMARY KEY ( `idm` )) CHARACTER SET = tis620; ";
		$result = mysql_db_query($DBName,$sqlcrete)
		or die("ไม่สามารถสร้างตาราง risk_can_manage ได้".mysql_error());
//row1		
$sql1="INSERT INTO `risk_can_manage` ( `idm` , `mname`)
VALUES ('' , 'ไม่มีการจัดการ') ";
		$result = mysql_db_query($DBName,$sql1)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_can_manage ได้".mysql_error());
//row2		
$sql2="INSERT INTO `risk_can_manage` ( `idm` , `mname`)
VALUES ('' , 'จัดการโดยการประชุมชี้แจง') ";
		$result = mysql_db_query($DBName,$sql2)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_can_manage ได้".mysql_error());

//row3		
$sql3="INSERT INTO `risk_can_manage` ( `idm` , `mname`)
VALUES ('' , 'จัดการโดยการมีกิจกรรมพัฒนา') ";
		$result = mysql_db_query($DBName,$sql3)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_can_manage ได้".mysql_error());

//row4		
$sql4="INSERT INTO `risk_can_manage` ( `idm` , `mname`)
VALUES ('' , 'จัดการโดยการประสานงานของทีมสหวิชาชีพหรือการประสานงานของคณะกรรมการบริหารความเสี่ยง') ";
		$result = mysql_db_query($DBName,$sql4)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_can_manage ได้".mysql_error());

 }//n

?>