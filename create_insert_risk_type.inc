<?php
$sqlc = "SELECT * FROM  risk_type "; //�礤�Ң����ŷ�����Ҩҡ�����
				$result = mysql_db_query($DBName,$sqlc)
				or $chk='N';
				// �Ҩӹǹ�á���촢�����
if($chk=='N'){
$sqlcrete ="CREATE TABLE `risk_type` (
`idt` INT default NULL AUTO_INCREMENT ,
`typename` TEXT NOT NULL ,
PRIMARY KEY ( `idt` )) CHARACTER SET = tis620; ";
		$result = mysql_db_query($DBName,$sqlcrete)
		or die("�������ö���ҧ���ҧ risk_type ��".mysql_error());
//row1		
$sql1="INSERT INTO `risk_type` ( `idt` , `typename`)
VALUES ('' , '�غѵԡ�ó�') ";
		$result = mysql_db_query($DBName,$sql1)
		or die("�������ö����������㹵��ҧ risk_type ��".mysql_error());
//row2		
$sql2="INSERT INTO `risk_type` ( `idt` , `typename`)
VALUES ('' , '�����ͧ���¹') ";
		$result = mysql_db_query($DBName,$sql2)
		or die("�������ö����������㹵��ҧ risk_type ��".mysql_error());

 }//n

?>