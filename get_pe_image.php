<?php
header("Content-type: image/jpeg"); // act as a jpg file to browser 

include("phpconf.php");
$conn=mysql_connect($Server,$User,$Pass);
if (!$conn)  //con false
die ("can't connect database".mysql_error());
mysql_select_db($DBName,$conn) or  die("connect  Database name $DBName error");
//con ture
if ($_GET['vn']<>'' ){ //get vn variable from patient_medication_record
$sqlPic="select image$imgnum as blobfield from pe_image where vn='$vn' ";
	$result = mysql_db_query($DBName,$sqlPic)
	or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
	$rs=mysql_fetch_array($result);
	echo $rs["blobfield"];
}
CloseDB();//close db connection
?>
