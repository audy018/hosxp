<?php 
	session_start();
	include("phpconf.php");
	include("func.php");
	conDB();

	
	$sql_delete ="DELETE FROM lamae_pharmacy_advice WHERE vn='$_GET[vn]' and hn='$_GET[hn]' ";
	
	

	mysql_query($sql_delete)
		or die ("�������öź�����š�����ӻ�֡��㹰ҹ��������<br><center><font color=red><h2>�Դ��ͼ������к�</h2></font><br><a href='result_chlogin.php'>˹����ѡ</a></center>".mysql_error());
		
		echo "<br /><br />";
		echo "<center><h2>ź������㹰ҹ������ ���º��������</h2></center>";
		echo "<br /><br />";
		echo "<center><input type='button' value='�Դ˹�ҵ�ҧ���' onclick='window.close();'></center>";

?>


