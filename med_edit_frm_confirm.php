<?
session_start();
include("phpconf.php");
include("func.php");
conDB();



$err_id         = $_POST[err_id];
$secure_code    = $_POST[secure_code];


$secure_code =md5($secure_code);
$secure_confirm = 'f01378eb35c5c5fd781de40a9fbcdf10'; //������ʼ�ҹ
//password:edit01


if($secure_code==$secure_confirm){

	echo "<META http-equiv='refresh' content='0;URL=medicate_err_form_edit.php?err_id=$err_id'>";

}else{
	
	echo "<center><br><h2>��ҹ�к����ʤ�����ʹ��¼Դ ��س��к����١��ͧ���¤�Ѻ</h2></center>";

}



?>