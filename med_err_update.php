<?
session_start();
include("phpconf.php");
include("func.php");
conDB();



$err_id         = $_GET[err_id];

$detail_err		= $_GET[detail_err];



	$cmd ="UPDATE  medication_err SET detail_err ='$detail_err' WHERE err_id='$err_id'";


	$result=ResultDB($cmd);

	echo "<center><br /><br /><h2>แก้ไขข้อมูลสำเร็จแล้ว</h2></center>";

	echo "<META http-equiv='refresh' content='1;URL= medicate_err_form_edit.php?err_id=$err_id'>";


?>