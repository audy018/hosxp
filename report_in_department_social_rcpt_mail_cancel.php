<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();



			$vn=$_GET[vn];
			$hn=$_GET[hn];


			
			$cmd ="UPDATE  rcpt_arrear SET check_mail_status='CANCEL' WHERE hn='$hn'";


			$result = mysql_query($cmd) or 
				die(mysql_error());
			
			
			if($result){
				echo "<br><br><center><h2>�ӡ�û�Ѻ��ا����ͧ����觨����� ���º��������</h2></center>";
			}
	

	 echo "<br><br><br>";

	 echo "<center><b><a href=\"javascript:history.back(-1)\">��͹��Ѻ</a></b></center>";
 

 ?>