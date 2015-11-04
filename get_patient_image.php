<?php 
header("Content-type: image/jpeg"); // act as a jpg file to browser 

include("phpconf.php");
$conn=mysql_connect($Server,$User,$Pass);
if (!$conn)  //con false
die ("can't connect database".mysql_error());
mysql_select_db($DBName,$conn) or  die("connect  Database name $DBName error");
//con ture
if ($_GET['hn']<>""){
$query = "SELECT image as blob_img FROM patient_image where hn='$hn' "; 
$result = mysql_query($query); 
$row = mysql_fetch_array($result); 
$jpg = $row["blob_img"]; 
echo $jpg; 
}
CloseDB();
?>

