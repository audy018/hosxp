<?php 
	session_start();
	include("phpconf.php");
	include("func.php");
	conDB();

	
	$sql_update ="UPDATE lamae_pharmacy_advice SET screen_name='$_POST[screen_name]',screen_type='$_POST[screen_type]',
	add_cr_clearance='$_POST[add_cr_clearance]',add_ekg='$_POST[add_ekg]',add_chest_xray='$_POST[add_chest_xray]',add_retinal_examination='$_POST[add_retinal_examination]',add_neuro_examination='$_POST[add_neuro_examination]',checkboxm1='$_POST[checkboxm1]',checkboxs11='$_POST[checkboxs11]',checkboxs12='$_POST[checkboxs12]',checkboxs13='$_POST[checkboxs13]',checkboxs14='$_POST[checkboxs14]',checkboxs15='$_POST[checkboxs15]',checkboxs16='$_POST[checkboxs16]',checkboxs17='$_POST[checkboxs17]',checkboxs18='$_POST[checkboxs18]',checkboxs19='$_POST[checkboxs19]',checkboxs110='$_POST[checkboxs110]',checkboxm2='$_POST[checkboxm2]',checkboxm3='$_POST[checkboxm3]',checkboxm4='$_POST[checkboxm4]',checkboxm5='$_POST[checkboxm5]',checkboxs51='$_POST[checkboxs51]',
	checkboxs52='$_POST[checkboxs52]',checkboxs53='$_POST[checkboxs53]',
	checkboxs54='$_POST[checkboxs54]',checkboxs55='$_POST[checkboxs55]',
	checkboxm6='$_POST[checkboxm6]',checkboxm7='$_POST[checkboxm7]',
	checkboxm8='$_POST[checkboxm8]',checkboxm9='$_POST[checkboxm9]',
	checkboxm10='$_POST[checkboxm10]',checkboxm11='$_POST[checkboxm11]',
	checkboxs111='$_POST[checkboxs111]',checkboxs112='$_POST[checkboxs112]',checkboxs113='$_POST[checkboxs113]',checkboxs114='$_POST[checkboxs114]',checkboxm12='$_POST[checkboxm12]',
	checkboxs121='$_POST[checkboxs121]',
	checkboxs122='$_POST[checkboxs122]',
	checkboxs123='$_POST[checkboxs123]',
	checkboxs124='$_POST[checkboxs124]',
	checkboxm13='$_POST[checkboxm13]',
	checkboxm14='$_POST[checkboxm14]',


	tbxm1='$_POST[tbxm1]',
	tbxs11='$_POST[tbxs11]',
	tbxs12='$_POST[tbxs12]',
	tbxs13='$_POST[tbxs13]',
	tbxs14='$_POST[tbxs14]',
	tbxs15='$_POST[tbxs15]',
	tbxs16='$_POST[tbxs16]',
	tbxs17='$_POST[tbxs17]',
	tbxs18='$_POST[tbxs18]',
	tbxs19='$_POST[tbxs19]',
	tbxs110='$_POST[tbxs110]',
	tbxm2='$_POST[tbxm2]',
	tbxm3='$_POST[tbxm3]',
	tbxm4='$_POST[tbxm4]',
	tbxm5='$_POST[tbxm5]',
	tbxs51='$_POST[tbxs51]',
	tbxs52='$_POST[tbxs52]',
	tbxs53='$_POST[tbxs53]',
	tbxs54='$_POST[tbxs54]',
	tbxs55='$_POST[tbxs55]',
	tbxm6='$_POST[tbxm6]',
	tbxm7='$_POST[tbxm7]',
	tbxm8='$_POST[tbxm8]',
	tbxm9='$_POST[tbxm9]',
	tbxm10='$_POST[tbxm10]',
	tbxm11='$_POST[tbxm11]',
	tbxs111='$_POST[tbxs111]',
	tbxs112='$_POST[tbxs112]',
	tbxs113='$_POST[tbxs113]',
	tbxs114='$_POST[tbxs114]',
	tbxm12='$_POST[tbxm12]',
	tbxs121='$_POST[tbxs121]',
	tbxs122='$_POST[tbxs122]',
	tbxs123='$_POST[tbxs123]',
	tbxs124='$_POST[tbxs124]',
	tbxm13='$_POST[tbxm13]',
	tbxm14='$_POST[tbxm14]',

	screen_name = '$_POST[screen_name]'
	 
	WHERE vn='$_POST[vn]'";
	

	mysql_query($sql_update)
		or die ("ไม่สามารถแก้ไขข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font><br><a href='result_chlogin.php'>หน้าหลัก</a></center>".mysql_error());
		
		echo "<br /><br />";
		echo "<center><h2>ปรับปรุงข้อมูลในฐานข้อมูล เรียบร้อยแล้ว</h2></center>";
		echo "<br /><br />";
		echo "<center><input type='button' value='ปิดหน้าต่างนี้' onclick='window.close();'></center>";


?>


