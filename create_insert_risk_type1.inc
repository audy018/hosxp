<?php
$sqlc = "SELECT * FROM  risk_typelist1 "; //เช็คค่าข้อมูลที่ส่งมาจากฟอร์ม
				$result = mysql_db_query($DBName,$sqlc)
				or $chk='N';
				// หาจำนวนเรกคอร์ดข้อมูล
if($chk=='N'){
$sqlcrete ="CREATE TABLE `risk_typelist1` (
`idl1` INT default NULL AUTO_INCREMENT ,
`list_name1` TEXT NOT NULL ,
PRIMARY KEY ( `idl1` ) 
) TYPE = MYISAM CHARACTER SET = tis620; ";
		$result = mysql_db_query($DBName,$sqlcrete)
		or die("ไม่สามารถสร้างตาราง risk_typelist1 ได้".mysql_error());
//row1		
$sql1="INSERT INTO `risk_typelist1` ( `idl1` , `list_name1`)
VALUES ('' , 'กระบวนการรักษาพยาบาล') ";
		$result = mysql_db_query($DBName,$sql1)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error());
//row2		
$sql2="INSERT INTO `risk_typelist1` ( `idl1` , `list_name1`)
VALUES ('' , 'พฤติกรรมบริการ') ";
		$result = mysql_db_query($DBName,$sql2)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error());
//row3		
$sql3="INSERT INTO `risk_typelist1` ( `idl1` , `list_name1`)
VALUES ('' , 'อาคารสถานที่,สิ่งแวดล้อมและความปลอดภัย') ";
		$result = mysql_db_query($DBName,$sql3)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error());
//row4		
$sql4="INSERT INTO `risk_typelist1` ( `idl1` , `list_name1`)
VALUES ('' , 'ระบบไฟฟ้า,อัคคีภัย') ";
		$result = mysql_db_query($DBName,$sql4)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error());

//row5		
$sql5="INSERT INTO `risk_typelist1` ( `idl1` , `list_name1`)
VALUES ('' , 'การป้องกันและควบคุมการติดเชื้อในโรงพยาบาล') ";
		$result = mysql_db_query($DBName,$sql5)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error());

//row6		
$sql6="INSERT INTO `risk_typelist1` ( `idl1` , `list_name1`)
VALUES ('' , 'ความปลอดภัยในการใช้ยา') ";
		$result = mysql_db_query($DBName,$sql6)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error());

//row7		
$sql7="INSERT INTO `risk_typelist1` ( `idl1` , `list_name1`)
VALUES ('' , 'การบริหารและพัฒนาทรัพยากรบุคคล') ";
		$result = mysql_db_query($DBName,$sql7)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error());

//row8		
$sql8="INSERT INTO `risk_typelist1` ( `idl1` , `list_name1`)
VALUES ('' , 'การดูแลระบบเครื่องมือ') ";
		$result = mysql_db_query($DBName,$sql8)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error());

//row9		
$sql9="INSERT INTO `risk_typelist1` ( `idl1` , `list_name1`)
VALUES ('' , 'สิทธิผู้ป่วย') ";
		$result = mysql_db_query($DBName,$sql9)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error()); 

//row10		
$sql10="INSERT INTO `risk_typelist1` ( `idl1` , `list_name1`)
VALUES ('' , 'อื่นๆ') ";
		$result = mysql_db_query($DBName,$sql10)
		or die("ไม่สามารถเพิ่มข้อมูลในตาราง risk_typelist1 ได้".mysql_error());
}//n

?>