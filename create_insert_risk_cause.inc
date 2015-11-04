<?php
$sqlc = "SELECT * FROM  risk_cause "; //เช็คค่าข้อมูลที่ส่งมาจากฟอร์ม
				$result = mysql_db_query($DBName,$sqlc)
				or $chk='N';
				// หาจำนวนเรกคอร์ดข้อมูล
if($chk=='N'){
$sqlcrete ="CREATE TABLE `risk_cause` (
`idc` INT default NULL AUTO_INCREMENT ,
`name` TEXT,
PRIMARY KEY ( `idc` ) 
) TYPE = MYISAM CHARACTER SET = tis620; ";
		$result = mysql_db_query($DBName,$sqlcrete)
		or die("ไม่สามารถสร้างตาราง risk_cause ได้".mysql_error());
//row1		
$sql1="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , 'เป็นความเสี่ยงที่ต้องเฝ้าระวัง') ";
		$result = mysql_db_query($DBName,$sql1)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_cause ได้".mysql_error());
//row2		
$sql2="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , 'Competency') ";
		$result = mysql_db_query($DBName,$sql2)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_cause ได้".mysql_error());
//row3		
$sql3="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , 'การประสานงานระหว่างหน่วยงาน') ";
		$result = mysql_db_query($DBName,$sql3)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_cause ได้".mysql_error());
//row4		
$sql4="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , 'การคัดกรอง') ";
		$result = mysql_db_query($DBName,$sql4)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_cause ได้".mysql_error());
//row5		
$sql5="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , 'ทักษะการสื่อสาร') ";
		$result = mysql_db_query($DBName,$sql5)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_cause ได้".mysql_error());
//row6		
$sql6="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , 'ระบบงาน') ";
		$result = mysql_db_query($DBName,$sql6)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_cause ได้".mysql_error());
//row7		
$sql7="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , 'ไม่มีระบบป้องกัน') ";
		$result = mysql_db_query($DBName,$sql7)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_cause ได้".mysql_error());
//row8		
$sql8="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , 'Human error') ";
		$result = mysql_db_query($DBName,$sql8)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_cause ได้".mysql_error());
//row9		
$sql9="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , 'ไม่ทราบสาเหตุ') ";
		$result = mysql_db_query($DBName,$sql9)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_cause ได้".mysql_error());

 }//n

?>