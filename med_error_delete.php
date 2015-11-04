<?
session_start();
include("phpconf.php");
include("func.php");
conDB();



$err_id         = $_POST[err_id];
$secure_code    = $_POST[secure_code];

$secure_code =md5($secure_code);
$secure_confirm = 'af90e6350c941cda3e491cb5e10c26c1'; //เข้ารหัสผ่าน




if($secure_code==$secure_confirm){

$cmd ="DELETE FROM medication_err WHERE err_id=$err_id";

$result=ResultDB($cmd);

echo "<center><br /><br /><h2>ลบข้อมูลสำเร็จแล้ว</h2></center>";
echo "<br />";
echo "<center><input type='button' value='ปิดหน้าต่างนี้' onclick='javascript:window.close()'></center>";

}else{
	
	echo "<center><br><h2>ท่านระบุรหัสความปลอดภัยผิด กรุณาระบุให้ถูกต้องด้วยครับ</h2></center>";

}



?>