<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();


		
			$hn=$_GET[hn];
			$begin_date=$_GET[begin_date];
			
			$cmd ="DELETE  FROM clinic_cormobidity_list WHERE hn='$hn' and begin_date='$begin_date' and clinic='001'";


			$result = mysql_query($cmd) or 
				die(mysql_error());
			
			
			if($result){
				echo "<br><br><center><h2>�ӡ��ź��¡�÷�����͡ ���º��������</h2></center>";
			}
	

	 echo "<br><br><br>";

	 echo "<center><b><a href=\"javascript:window.close()\">��ԡ���ͻԴ˹�ҵ�ҧ���</a></b></center>";
 

 ?>