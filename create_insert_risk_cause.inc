<?php
$sqlc = "SELECT * FROM  risk_cause "; //�礤�Ң����ŷ�����Ҩҡ�����
				$result = mysql_db_query($DBName,$sqlc)
				or $chk='N';
				// �Ҩӹǹ�á���촢�����
if($chk=='N'){
$sqlcrete ="CREATE TABLE `risk_cause` (
`idc` INT default NULL AUTO_INCREMENT ,
`name` TEXT,
PRIMARY KEY ( `idc` ) 
) TYPE = MYISAM CHARACTER SET = tis620; ";
		$result = mysql_db_query($DBName,$sqlcrete)
		or die("�������ö���ҧ���ҧ risk_cause ��".mysql_error());
//row1		
$sql1="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , '�繤�������§����ͧ������ѧ') ";
		$result = mysql_db_query($DBName,$sql1)
		or die("�������ö����������㹵��ҧ risk_cause ��".mysql_error());
//row2		
$sql2="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , 'Competency') ";
		$result = mysql_db_query($DBName,$sql2)
		or die("�������ö����������㹵��ҧ risk_cause ��".mysql_error());
//row3		
$sql3="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , '��û���ҹ�ҹ�����ҧ˹��§ҹ') ";
		$result = mysql_db_query($DBName,$sql3)
		or die("�������ö����������㹵��ҧ risk_cause ��".mysql_error());
//row4		
$sql4="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , '��äѴ��ͧ') ";
		$result = mysql_db_query($DBName,$sql4)
		or die("�������ö����������㹵��ҧ risk_cause ��".mysql_error());
//row5		
$sql5="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , '�ѡ�С���������') ";
		$result = mysql_db_query($DBName,$sql5)
		or die("�������ö����������㹵��ҧ risk_cause ��".mysql_error());
//row6		
$sql6="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , '�к��ҹ') ";
		$result = mysql_db_query($DBName,$sql6)
		or die("�������ö����������㹵��ҧ risk_cause ��".mysql_error());
//row7		
$sql7="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , '������к���ͧ�ѹ') ";
		$result = mysql_db_query($DBName,$sql7)
		or die("�������ö����������㹵��ҧ risk_cause ��".mysql_error());
//row8		
$sql8="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , 'Human error') ";
		$result = mysql_db_query($DBName,$sql8)
		or die("�������ö����������㹵��ҧ risk_cause ��".mysql_error());
//row9		
$sql9="INSERT INTO `risk_cause` ( `idc` , `name`)
VALUES ('' , '����Һ���˵�') ";
		$result = mysql_db_query($DBName,$sql9)
		or die("�������ö����������㹵��ҧ risk_cause ��".mysql_error());

 }//n

?>