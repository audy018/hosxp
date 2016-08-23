<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>

<?php

$hn = $_GET['hn'];
$vn = $_GET['vn'];
$vstdate = $_GET['vstdate'];

if($hn !='' and $vn !='' and $vstdate !=''){
	
	$sql = "update opitemrece set qty = 0,paidst='03' where hn='$hn' and vn='$vn' and vstdate='$vstdate' and icode in ('3001375','3007849') limit 2 ";
	$result=ResultDB($sql);

	$sql2 = "update opitemrece set paidst='02' where hn='$hn' and vn='$vn' and vstdate='$vstdate' and icode in ('1510003','1000011', '1570010')  limit 2 ";
	$result2=ResultDB($sql2) ;
	

	if(($result) or ($result2)) {
		echo "<center><h3>Update Data Complete</h3></center>";
	} else {
		echo "<center><h3>Error: Not Update Data</h3></center>";
	}


}


?>