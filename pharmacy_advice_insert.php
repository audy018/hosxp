<?php 
	session_start();
	include("phpconf.php");
	include("func.php");
	conDB();

	
	$sql_insert ="INSERT INTO lamae_pharmacy_advice(vn,hn,vstdate,screen_name,screen_type,add_cr_clearance,add_ekg,add_chest_xray,add_retinal_examination,add_neuro_examination,checkboxm1,tbxm1,checkboxs11,tbxs11,checkboxs12,tbxs12,checkboxs13,tbxs13,checkboxs14,tbxs14,checkboxs15,tbxs15,checkboxs16,tbxs16,checkboxs17,tbxs17,checkboxs18,tbxs18,checkboxs19,tbxs19,checkboxs110,tbxs110,checkboxm2,tbxm2,checkboxm3,tbxm3,checkboxm4,tbxm4,checkboxm5,tbxm5,checkboxs51,tbxs51,checkboxs52,tbxs52,checkboxs53,tbxs53,checkboxs54,tbxs54,checkboxs55,tbxs55,checkboxm6,tbxm6,checkboxm7,tbxm7,checkboxm8,tbxm8,checkboxm9,tbxm9,checkboxm10,tbxm10,checkboxm11,tbxm11,checkboxs111,tbxs111,checkboxs112,tbxs112,checkboxs113,tbxs113,checkboxs114,tbxs114,checkboxm12,tbxm12,checkboxs121,tbxs121,checkboxs122,tbxs122,checkboxs123,tbxs123,checkboxs124,tbxs124,checkboxm13,tbxm13,checkboxm14,tbxm14)
	
	VALUE('$_POST[vn]','$_POST[hn]','$_POST[vstdate]','$_POST[screen_name]','$_POST[screen_type]','$_POST[add_cr_clearance]','$_POST[add_ekg]','$_POST[add_chest_xray]','$_POST[add_retinal_examination]','$_POST[add_neuro_examination]','$_POST[checkboxm1]','$_POST[tbxm1]','$_POST[checkboxs11]','$_POST[tbxs11]','$_POST[checkboxs12]','$_POST[tbxs12]','$_POST[checkboxs13]','$_POST[tbxs13]','$_POST[checkboxs14]','$_POST[tbxs14]','$_POST[checkboxs15]','$_POST[tbxs15]','$_POST[checkboxs16]','$_POST[tbxs16]','$_POST[checkboxs17]','$_POST[tbxs17]','$_POST[checkboxs18]','$_POST[tbxs18]','$_POST[checkboxs19]','$_POST[tbxs19]','$_POST[checkboxs110]','$_POST[tbxs110]','$_POST[checkboxm2]','$_POST[tbxm2]','$_POST[checkboxm3]','$_POST[tbxm3]','$_POST[checkboxm4]','$_POST[tbxm4]','$_POST[checkboxm5]','$_POST[tbxm5]','$_POST[checkboxs51]','$_POST[tbxs51]','$_POST[checkboxs52]','$_POST[tbxs52]','$_POST[checkboxs53]','$_POST[tbxs53]','$_POST[checkboxs54]','$_POST[tbxs54]','$_POST[checkboxs55]','$_POST[tbxs55]','$_POST[checkboxm6]','$_POST[tbxm6]','$_POST[checkboxm7]','$_POST[tbxm7]','$_POST[checkboxm8]','$_POST[tbxm8]','$_POST[checkboxm9]','$_POST[tbxm9]','$_POST[checkboxm10]','$_POST[tbxm10]','$_POST[checkboxm11]','$_POST[tbxm11]','$_POST[checkboxs111]','$_POST[tbxs111]','$_POST[checkboxs112]','$_POST[tbxs112]','$_POST[checkboxs113]','$_POST[tbxs113]','$_POST[checkboxs114]','$_POST[tbxs114]','$_POST[checkboxm12]','$_POST[tbxm12]','$_POST[checkboxs121]','$_POST[tbxs121]','$_POST[checkboxs122]','$_POST[tbxs122]','$_POST[checkboxs123]','$_POST[tbxs123]','$_POST[checkboxs124]','$_POST[tbxs124]','$_POST[checkboxm13]','$_POST[tbxm13]','$_POST[checkboxm14]','$_POST[tbxm14]') ";




	mysql_query($sql_insert)
		or die ("ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font><br><a href='result_chlogin.php'>หน้าหลัก</a></center>".mysql_error());
		
		echo "<br /><br />";
		echo "<center><h2>บันทึกข้อมูลในฐานข้อมูล เรียบร้อยแล้ว</h2></center>";
		echo "<br /><br />";
		echo "<center><input type='button' value='ปิดหน้าต่างนี้' onclick='window.close();'></center>";


?>


