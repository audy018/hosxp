<?
session_start();
include("phpconf.php");
include("func.php");
conDB();
$max_file_size = 10000000;


$hn =$_POST['hn'];
$vstdate= $sy1."-".$sm1."-".$sd1;



	$fileupload1		=$_FILES['fileupload_eye_right1']['tmp_name'];
	$fileupload_name1	=$_FILES['fileupload_eye_right1']['name'];
	$fileupload_size1	=$_FILES['fileupload_eye_right1']['size'];
	$fileupload_type1	=$_FILES['fileupload_eye_right1']['type'];


	$fileupload2		=$_FILES['fileupload_eye_left1']['tmp_name'];
	$fileupload_name2	=$_FILES['fileupload_eye_left1']['name'];
	$fileupload_size2	=$_FILES['fileupload_eye_left1']['size'];
	$fileupload_type2	=$_FILES['fileupload_eye_left1']['type'];



if(($fileupload1) and ($fileupload2)){

	$fsize1  = filesize($fileupload1);
	$handle1 = fopen($fileupload1,"r") or die;
	$contents1 = fread($handle1,$fsize1);
	$contents1 = addslashes($contents1);
	fclose($handle1);


	$fsize2  = filesize($fileupload2);
	$handle2 = fopen($fileupload2,"r") or die;
	$contents2 = fread($handle2,$fsize2);
	$contents2 = addslashes($contents2);
	fclose($handle2);
	



}



$sql = "INSERT INTO lamae_pt_dm_screen_eye(hn,age_year,dm_year,hospital,first_screen,year_screen,infinity_screen,va_re,va_le,va_ph1,va_ph2,dilate_be,dilate_re,dilate_le,no_dilate,no_dilate_comment,no_dr_right_eye,mild_npdr_right_eye,moderlate_npdr_right_eye,serve_npdr_right_eye,pdr_right_eye,dme_right_eye,other_right_eye,comment_right_eye,no_dr_left_eye,mild_npdr_left_eye,moderlate_npdr_left_eye,serve_npdr_left_eye,pdr_left_eye,dme_left_eye,other_left_eye,comment_left_eye,screen_dx,doctor_screen,fu_one_year,fu_six_month,fu_three_month,fu_refer,fileupload_eye_right1,fileupload_eye_left1,vstdate)values('$hn','$_POST[age_year]','$_POST[dm_year]','$_POST[hospital]','$_POST[first_screen]','$_POST[year_screen]','$_POST[infinity_screen]','$_POST[va_re]','$_POST[va_le]','$_POST[va_ph1]','$_POST[va_ph2]','$_POST[dilate_be]','$_POST[dilate_re]','$_POST[dilate_le]','$_POST[no_dilate]','$_POST[no_dilate_comment]','$_POST[no_dr_right_eye]','$_POST[mild_npdr_right_eye]','$_POST[moderlate_npdr_right_eye]','$_POST[serve_npdr_right_eye]','$_POST[pdr_right_eye]','$_POST[dme_right_eye]','$_POST[other_right_eye]','$_POST[comment_right_eye]','$_POST[no_dr_left_eye]','$_POST[mild_npdr_left_eye]','$_POST[moderlate_npdr_left_eye]','$_POST[serve_npdr_left_eye]','$_POST[pdr_left_eye]','$_POST[dme_left_eye]','$_POST[other_left_eye]','$_POST[comment_left_eye]','$_POST[screen_dx]','$_POST[doctor_screen]','$_POST[fu_one_year]','$_POST[fu_six_month]','$_POST[fu_three_month]','$_POST[fu_refer]','$contents1','$contents2','$vstdate')";



	mysql_query($sql)
	or die ("ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font><br><a href='result_chlogin.php'>หน้าหลัก</a></center>".mysql_error());
		

		echo "<br /><br />";
		echo "<center><h2>บันทึกข้อมูลในฐานข้อมูล เรียบร้อยแล้ว กรุณารอซักครู่.....</h2></center>";
		echo "<br /><br />";

		echo"<meta http-equiv=refresh content=3;URL=frm-dm-eye-screen.php>";




?>