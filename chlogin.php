<?php
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>�к��Թ����� | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - :: ��Ǩ�ͺ Login/Password :: - -</title>
<style type="text/css">
<!--
body {  margin: 0px  0px; padding: 0px  0px}
body{font-family:MS Sans Serif;font-size:10pt}
table,td{font-family:MS Sans Serif;font-size:10pt}
form{font-family:MS Sans Serif;font-size:10pt}
-->
</style>
<?php
$sendpage=$_POST["sendpage"];
//set theme
print "<link href='css/$Theme.css' rel='stylesheet' type='text/css'>";
?>
</head>
<body>
<?php
if(!$_POST['user']){
//if (!$user)  { //��Ǩ�ͺ��á�͡������ ��ҡ�͡���ͼ�����������
//�������͡������ �����͹��Ѻ�˹�ҡ�͡����������
?>
<script>
alert("��س��кت��ͼ����");
history.go(-1);
</script>
<?php
}elseif(!$_POST['pwd']){
//} elseif (!$pwd)  {//��Ǩ�ͺ��á�͡������ ��ҡ�͡����ʼ�ҹ�������
//�������͡������ �����͹��Ѻ�˹�ҡ�͡����������
?>
<script>
alert("��س��к����ʼ�ҹ�ͧ�����");
history.go(-1);
</script>
<?php
} else { //��͡�ء��ͧ
$ip_Log=$_POST['user']; //get user is session
$pwd=$_POST['pwd'];//get password is session
$n_sys=name_onsys($ip_Log); //ch user in system
		if(!$n_sys){ //not sys
			echo "<center><h2>���ͼ���� :&nbsp;<font color=red>".$ip_Log."</font>&nbsp;�����������к�<br>�Դ��� �������к� ��Ѻ</h2></center>";
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;  URL=index.php'>";
		}else{//user on sys ok
					$empty_upass=empty_passweb2($ip_Log);
					if (!$empty_upass){ //�ѧ����˹� check passweb empty and user is admin for permission set pass
					echo "<center><h2><font color=blue>".$ip_Log."</font><font color=red> �ѧ����˹����ʼ�ҹ����Ѻ��������ҹ Web Service<br>��س�
					�Դ��ͼ������к�<br><u>����</u>��ҹ��ͧ����к� HOSxP ��͹ �֧������ö����ҡ�˹����ʼ�ҹ��  ��Ѻ</font></h2></center>";
					//	session_register("ip_Log");
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;  URL=index.php'>"; //redirect go to  set password page
					}else{ //not empty ��˹�����
								//echo $empty_upass."<br>";
								$u_p=explode("#",$empty_upass); //user and pass by return from function
								$ip_Log=$u_p[0];
								$p=$u_p[1];
								   				$u_enc=enc_create_u(trim($ip_Log)); //user encode from login
				 								$p_enc=enc_create_p(trim($pwd)); //pwd encode from login
				 								$sum_enc="$u_enc"."$p_enc"; //sum
								   if($sum_enc==$p){
								   $user_type="offline";//echo  $user_type;exit();
								   $right=access_right($ip_Log);
								  	session_register("ip_Log","user_type","right");
									if($sendpage<>""){echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=$sendpage'>";}else{
									echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=result_chlogin.php'>";}
									}else{
									echo "<center><h2><font color=red>���ʼ�ҹ����Ѻ��������ҹ - - Web Service - - ���١��ͧ</font></h2></center>";
									echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
									}//$sum_enc==$rs["passweb"]
					} 		//call check login for  passweb empty
		} //$n_sys
}  //��͡�ء��ͧ
CloseDB();
 ?>
</body>
</html>
