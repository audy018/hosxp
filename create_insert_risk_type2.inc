<?php
$sqlc = "SELECT * FROM  risk_typelist2 "; //�礤�Ң����ŷ�����Ҩҡ�����
				$result = mysql_db_query($DBName,$sqlc)
				or $chk='N';
				// �Ҩӹǹ�á���촢�����
if($chk=='N'){
$sqlcrete ="CREATE TABLE `risk_typelist2` (
`idl2` INT default NULL AUTO_INCREMENT ,
`list_name2` TEXT NOT NULL ,
PRIMARY KEY ( `idl2` ) 
) TYPE = MYISAM CHARACTER SET = tis620; ";
		$result = mysql_db_query($DBName,$sqlcrete)
		or die("�������ö���ҧ���ҧ risk_typelist2 ��".mysql_error());
//row1		
$sql1="INSERT INTO `risk_typelist2` ( `idl2` , `list_name2`)
VALUES ('' , '�ĵԡ�����ԡ��') ";
		$result = mysql_db_query($DBName,$sql1)
		or die("�������ö����������㹵��ҧ risk_typelist1 ��".mysql_error());
//row2		
$sql2="INSERT INTO `risk_typelist2` ( `idl2` , `list_name2`)
VALUES ('' , '�к��ҹ') ";
		$result = mysql_db_query($DBName,$sql2)
		or die("�������ö����������㹵��ҧ risk_typelist1 ��".mysql_error());
//row3		
$sql3="INSERT INTO `risk_typelist2` ( `idl2` , `list_name2`)
VALUES ('' , '����Ǵ����') ";
		$result = mysql_db_query($DBName,$sql3)
		or die("�������ö����������㹵��ҧ risk_typelist1 ��".mysql_error());

//row4		
$sql4="INSERT INTO `risk_typelist2` ( `idl2` , `list_name2`)
VALUES ('' , '����') ";
		$result = mysql_db_query($DBName,$sql4)
		or die("�������ö����������㹵��ҧ risk_typelist2 ��".mysql_error());
}//n

?>