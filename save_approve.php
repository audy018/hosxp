<?php
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>�к��Թ����� | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - �ѡ�֡��¡�ä����ᾷ�� - - |</title>
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

						if(!$vn and !$hn){ //ch vn hn
							print "<h2>�к��������ö�ѹ�֡������㹰ҹ�������� ���ͧ�ҡ����դ�� HN ��� VN</h2>";
						}else{//ch vn hn
							$d_approve=date("Y-m-d");//date an approve
							//SQL Save Approve
							$sqlSaveApprove="UPDATE ovst  SET Approve_Doctor = '$App_Choice',Comment_Appr ='$comment', Date_Appr='$d_approve' where vn='$vn' ";
							//$sqlSaveApprove="UPDATE ovst  SET Approve_Doctor = '$App_Choice',Comment_Appr ='$comment', Date_Appr='$d_approve' ";
							//$sqlSaveApprov.="WHERE vn = '$vn' and hn='$hn' ";
							mysql_query($sqlSaveApprove,$conn)
							 //$success="Y";
							or die ("<center><h2>�������ö�ѹ�֡��������</h2>".mysql_error()."<br><a href=\"javascript:history.back(-1)\">Back</a>");
        					//print "<h2>�ѹ�֡���������º��������</h2><br><a href='$PHP_SELF'>����¡���ա����</a>\n";
							//if ($success=='Y'){
							//print "<html><body bgcolor=red>\n";
        					print "<h2><center>�ѹ�֡���������º��������</h2></center><br><font color=red>�٢�ͤ������ approve ��� -><a href=\"javascript:history.back(-1)\">���꡷����</a>\n";
							print "<br>��Ѻ价����ª��ͼ����·���ͧ��� approve ��� -><a href=\"command_doc.php?Dcode=".cmdDoctor_code($ip_Log)."\">���꡷����</a></font>\n";
							//print"<META HTTP-EQUIV='REFRESH' CONTENT='20;  URL=$PHP_SELF?hn=$hn&vn=$vn&keyword=$hn'>";
						    //print "</body></html>/n";
							//}
							//print"<META HTTP-EQUIV='REFRESH' CONTENT='2;  URL=$PHP_SELF?hn=$hn&vn=$ovst_vn&keyword=$keyword&submit=HisSearch'>";
						}//ch vn hn
						?>
</body>
</html>