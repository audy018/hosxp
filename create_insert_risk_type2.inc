<?php
$sqlc = "SELECT * FROM  risk_typelist2 "; //เช็คค่าข้อมูลที่ส่งมาจากฟอร์ม
				$result = mysql_db_query($DBName,$sqlc)
				or $chk='N';
				// หาจำนวนเรกคอร์ดข้อมูล
if($chk=='N'){
$sqlcrete ="CREATE TABLE `risk_typelist2` (
`idl2` INT default NULL AUTO_INCREMENT ,
`list_name2` TEXT NOT NULL ,
PRIMARY KEY ( `idl2` ) 
) TYPE = MYISAM CHARACTER SET = tis620; ";
		$result = mysql_db_query($DBName,$sqlcrete)
		or die("ไม่สามารถสร้างตาราง risk_typelist2 ได้".mysql_error());
//row1		
$sql1="INSERT INTO `risk_typelist2` ( `idl2` , `list_name2`)
VALUES ('' , 'พฤติกรรมบริการ') ";
		$result = mysql_db_query($DBName,$sql1)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error());
//row2		
$sql2="INSERT INTO `risk_typelist2` ( `idl2` , `list_name2`)
VALUES ('' , 'ระบบงาน') ";
		$result = mysql_db_query($DBName,$sql2)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error());
//row3		
$sql3="INSERT INTO `risk_typelist2` ( `idl2` , `list_name2`)
VALUES ('' , 'สิ่งแวดล้อม') ";
		$result = mysql_db_query($DBName,$sql3)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error());

//row4		
$sql4="INSERT INTO `risk_typelist2` ( `idl2` , `list_name2`)
VALUES ('' , 'อื่นๆ') ";
		$result = mysql_db_query($DBName,$sql4)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist2 ได้".mysql_error());
}//n

?>