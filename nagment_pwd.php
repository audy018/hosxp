<?php
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>�к��Թ����� | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - Magnement User - - |</title>
<style type="text/css">
<!--
body {  margin: 0px  0px; padding: 0px  0px}
body{font-family:MS Sans Serif;font-size:10pt}
table,td{font-family:MS Sans Serif;font-size:10pt}
form{font-family:MS Sans Serif;font-size:10pt}
-->
</style>
<?php
//set theme
print "<link href='css/$Theme.css' rel='stylesheet' type='text/css'>";
?>
</head>
<body>
<?php
$ip=get_ip();//func get ip from computer
$online=Check_Online($ip); //func check online
if (!$online){ //ch login
		if (!$_SESSION['ip_Log'] or $_SESSION['ip_Log']){
		echo "<center><h2><font color=red>��ҹ������Է����ҹ˹�ҹ��</font></h2></center>";
		session_unregister("ip_Log");
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";}
}else{
$user=$_POST['s_user']; //user at select
$s_user=$_SESSION['ip_Log']; //self user
$sql1="DELETE FROM web_pwd  WHERE loginname ='$user' ";
$sql2="DELETE FROM web_pwd  WHERE loginname ='$s_user' ";
		if($_POST['s_clear']=="user"){
		//select  "user";
			mysql_query($sql2)
			or die("��õԴ��Ͱҹ�����żԴ��Ҵ".mysql_error());
			echo "<center><font color=red><h2>¡��ԡ���ʼ�ҹ ����º��������</h2></font><br><a href=result_chlogin.php>��͹��Ѻ</a>
			&nbsp;<a href=".$PHP_SELF.">����¡������</a></center>";
		}elseif($_POST['s_clear']=="self"){
			//select user is admin on self
			mysql_query($sql2)
			or die("��õԴ��Ͱҹ�����żԴ��Ҵ".mysql_error());
			echo "<center><font color=red><h2>¡��ԡ���ʼ�ҹ ����º��������</h2></font><br><a href=result_chlogin.php>��͹��Ѻ</a>
			&nbsp;<a href=managment_user.php>����¡������</a></center>";
		}//if
}//ch login
closeDB;
?>
</body>
</html>
