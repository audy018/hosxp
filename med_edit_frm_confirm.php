<?
session_start();
include("phpconf.php");
include("func.php");
conDB();



$err_id         = $_POST[err_id];
$secure_code    = $_POST[secure_code];


$secure_code =md5($secure_code);
$secure_confirm = 'f01378eb35c5c5fd781de40a9fbcdf10'; //เข้ารหัสผ่าน
//password:edit01


if($secure_code==$secure_confirm){

	echo "<META http-equiv='refresh' content='0;URL=medicate_err_form_edit.php?err_id=$err_id'>";

}else{
	
	echo "<center><br><h2>ท่านระบุรหัสความปลอดภัยผิด กรุณาระบุให้ถูกต้องด้วยครับ</h2></center>";

}



?>