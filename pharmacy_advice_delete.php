<?php 
	session_start();
	include("phpconf.php");
	include("func.php");
	conDB();

	
	$sql_delete ="DELETE FROM lamae_pharmacy_advice WHERE vn='$_GET[vn]' and hn='$_GET[hn]' ";
	
	

	mysql_query($sql_delete)
		or die ("ไม่สามารถลบข้อมูลการให้คำปรึกษาในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font><br><a href='result_chlogin.php'>หน้าหลัก</a></center>".mysql_error());
		
		echo "<br /><br />";
		echo "<center><h2>ลบข้อมูลในฐานข้อมูล เรียบร้อยแล้ว</h2></center>";
		echo "<br /><br />";
		echo "<center><input type='button' value='ปิดหน้าต่างนี้' onclick='window.close();'></center>";

?>


