<?
session_start();
include("phpconf.php");
include("func.php");
conDB();



$err_id         = $_POST[err_id];
$secure_code    = $_POST[secure_code];

$secure_code =md5($secure_code);
$secure_confirm = 'af90e6350c941cda3e491cb5e10c26c1'; //������ʼ�ҹ




if($secure_code==$secure_confirm){

$cmd ="DELETE FROM medication_err WHERE err_id=$err_id";

$result=ResultDB($cmd);

echo "<center><br /><br /><h2>ź���������������</h2></center>";
echo "<br />";
echo "<center><input type='button' value='�Դ˹�ҵ�ҧ���' onclick='javascript:window.close()'></center>";

}else{
	
	echo "<center><br><h2>��ҹ�к����ʤ�����ʹ��¼Դ ��س��к����١��ͧ���¤�Ѻ</h2></center>";

}



?>