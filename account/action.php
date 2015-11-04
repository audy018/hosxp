<?php 
session_start();
include("../phpconf.php");
include("../func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ระบบเงินเดือน - -|</title>
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
print "<link href='../css/$Theme.css' rel='stylesheet' type='text/css'>";
?>
<SCRIPT LANGUAGE="JavaScript">
<!-- hide this script tag's contents from old browsers
function goHist(a) 
{
   history.go(a);      // Go back one.
}
//<!-- done hiding from old browsers -->
</script>

</head>
<body>
<?php
if (!$_SESSION["ip_Log"]){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";
}else{ //on line
	//echo"คุณ คือ ".$s_name;echo"- > ".$t_no_bank;echo"-> ".$s_Submit_add;
	
	//start call add
	if($s_Submit_add=="เพิ่ม"){ //เพิ่ม
			//ch user id ready
			if($s_name and $t_no_bank and $t_social){//ch login and no_bank for account
						$sqlSUserAccount="select * from users_account where UserID='$s_name' ";$resultSUserAccount=ResultDB($sqlSUserAccount);
 						if(mysql_num_rows($resultSUserAccount)>0){ //row ready
 						//$rsSUserAccount=mysql_fetch_array($resultSUserAccount);
									echo "<center><font color='green'><h2>- - ข้อมูลดังกล่าวมีอยู่ในฐานข้อมูลแล้ว ท่านสามารถรายการเดิมได้ โดยไปที่เมนูแก้ไข รายการครับ - -<br>รอสักครู่...เพื่อไปยังหน้าที่ผ่านมา</h2></font></center>";
									echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;  URL=faccount.php?link_menu=edit_user'>";
								}else{ //row
									$sqlUserUpdate="INSERT INTO users_account(UserID,NoBank_Account,Status_Access) VALUE('$s_name','$t_no_bank','0') ";
									mysql_query($sqlUserUpdate)
									or die ("ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font></center>".mysql_error());
									echo "<center><font color='green'><h2>- - บันทึกข้อมูลในฐานข้อมูล เรียบร้อยแล้ว - -<br>รอสักครู่...เพื่อไปยังหน้าที่ผ่านมา</h2></font></center>";
								//complete
									echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;  URL=faccount.php?link_menu=edit_user'>";
								} //row
			}else{ //ch login and no_bank for account empty
					print"<script>
					alert(\"กรุณาตรวจสอบการกรอกข้อมูลให้ครบ....\");
					history.go(-1);
					</script>";
					}//end ch login and no_bank for account empty
		}//เพิ่ม
	//end call add

//start edit bank
// command
if($s_Submit_edit=="แก้ไข"){ //s_Submit_edit=="แก้ไข"
//echo $s_Submit_edit.$t_no_bank.$s_name.$t_social;
$sqlEdit_Bank="UPDATE users_account SET NoBank_Account='$t_no_bank',Status_social_secure='$t_social' WHERE UserID='$s_name' ";
	mysql_query($sqlEdit_Bank)
	or die ("ไม่สามารถแก้ไขข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font></center>".mysql_error());
	echo "<center><font color='green'><h2>- - แก้ไขข้อมูลในฐานข้อมูล เรียบร้อยแล้ว - -<br>รอสักครู่...เพื่อไปยังหน้าที่ผ่านมา</h2></font></center>";
	//complete
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;  URL=faccount.php?link_menu=edit_user'>";
} //s_Submit_edit=="แก้ไข"
//end edit bank


//start save
if($s_Save=="บันทึก"){ //s_Save=="บันทึก"
//echo "ขั้น=".$t_class."<br>";echo "ช่วยเหลือบุตร=".$t_help_child."<br>";echo "ค่าตอบแทน=".$t_to_retaliate."<br>";echo "เสี่ยงภัย=".$t_to_risk."<br>";echo "ค่าศึกษาบุตร=".$t_child_education."<br>";
//echo "ช่วยรักษา=".$t_to_treat."<br>";echo "ค่าเช่าบ้าน=".$t_rent_home."<br>";echo "ภาษี=".$t_tax."<br>";echo "เงิน ปจต=".$t_money_position."<br>";echo "ธ.อาคาร=".$t_goverment_bank."<br>";
//echo "สินเชื่อ ออม=".$t_credit_saving_bank."<br>";echo "กบข=".$t_gpf_gratuity."<br>";echo "ฌกส=".$t_to_help_die."<br>";echo "ประกันสังคม=".$t_social_secure."<br>";echo "ประกันชีวิต=".$t_life_insurance."<br>";
//echo "กรมธรรณ์=".$t_insurance."<br>";echo "ตกเบิกรวม=".$t_valve_all."<br>";echo "ค่ากันดาร=".$t_off_country."<br>";echo "สินเชื่อรถ=".$t_credit_car."<br>";echo "รับจริง=".$t_total."<br>";
	if(!$t_class){	//t class	
		print"<script>
		alert(\"กรุณาตรวจสอบการกรอกข้อมูลให้ครบ....โดยเฉพาะช่อง ขั้น ครับ...\");
		history.go(-1);
		</script>";
	}else{//class

//echo $s_name;
//ตรวจสอบ user ที่เป็นลูกจ้าง ใช้บัตรประกันสังคม
$sql_Employee="select * from users_account where UserID='$s_name' and Status_social_secure='1' ";
$resultEmployee=ResultDB($sql_Employee);//$rsEmployee=mysql_fetch_array($resultEmployee);
	if(mysql_num_rows($resultEmployee)>0){
	$statusEmployee=true;
	}else{$statusEmployee=false;}

	if($statusEmployee==true){//true
	$social_status=round((5*$t_class)/100); //ค่าประกันสังคม
	//echo $social_status;
	}//end true

	//check empty
	if($social_status==""){$social_status=0;}
	if($t_help_child==""){$t_help_child=0;}
	if($t_to_retaliate==""){$t_to_retaliate=0;}
	if($t_to_risk==""){$t_to_risk=0;}
	if($t_child_education==""){$t_child_education=0;}
	if($t_to_treat==""){$t_to_treat=0;}
	if($t_rent_home==""){$t_rent_home=0;}
	if($t_tax==""){$t_tax=0;}
	if($t_money_position==""){$t_money_position=0;}
	if($t_goverment_bank==""){$t_goverment_bank=0;}
	if($t_credit_saving_bank==""){$t_credit_saving_bank=0;}
	if($t_gpf_gratuity==""){$t_gpf_gratuity=0;}
	if($t_to_help_die==""){$t_to_help_die=0;}
	if($t_life_insurance==""){$t_life_insurance=0;}
	if($t_insurance==""){$t_insurance=0;}
	if($t_valve_all==""){$t_valve_all=0;}
	if($t_off_country==""){$t_off_country=0;}
	if($t_credit_car==""){$t_credit_car=0;}

//calculater
	$Total_Add=($t_class+$t_to_retaliate+$t_to_risk+$t_help_child+$t_to_treat+$t_rent_home+$t_child_education+$t_money_position+$t_off_country+$t_valve_all);
	$Total=($Total_Add-$t_goverment_bank-$t_tax-$t_gpf_gratuity-$t_to_help_die-$t_credit_saving_bank-$t_life_insurance-$t_insurance-$social_status-$t_credit_car);
 	//$Total_All=number_format($Total);
//show
//echo "ขั้น=".$t_class."<br>";echo "ช่วยเหลือบุตร=".$t_help_child."<br>";echo "ค่าตอบแทน=".$t_to_retaliate."<br>";echo "เสี่ยงภัย=".$t_to_risk."<br>";echo "ค่าศึกษาบุตร=".$t_child_education."<br>";
//echo "ช่วยรักษา=".$t_to_treat."<br>";echo "ค่าเช่าบ้าน=".$t_rent_home."<br>";echo "ภาษี=".$t_tax."<br>";echo "เงิน ปจต=".$t_money_position."<br>";echo "ธ.อาคาร=".$t_goverment_bank."<br>";
//echo "สินเชื่อ ออม=".$t_credit_saving_bank."<br>";echo "กบข=".$t_gpf_gratuity."<br>";echo "ฌกส=".$t_to_help_die."<br>";echo "ประกันสังคม=".$social_status."<br>";echo "ประกันชีวิต=".$t_life_insurance."<br>";
//echo "กรมธรรณ์=".$t_insurance."<br>";echo "ตกเบิกรวม=".$t_valve_all."<br>";echo "ค่ากันดาร=".$t_off_country."<br>";echo "สินเชื่อรถ=".$t_credit_car."<br>";echo "รับจริง=".$Total_All."<br>";

//show form conform
?>
<form action="insert_action.php" name="f_account_conf_svae" method="get">
<table width="700" border="0" cellspacing="2" cellpadding="2">
  <tr align="center" bgcolor="#FFFF66">
    <td colspan="6"><font color="green"><b>ยืนยัน/แก้ไข รายการเงินเดือน</b></font></td>
  </tr>
  <tr align="center">
    <td colspan="6">
	รายการประจำเดือน :&nbsp;&nbsp;
<?php
print"<input name=\"s_month\" type=\"text\"  size=\"12\" value='".change_month_isThai($s_month)."' disabled>";
?>
      &nbsp;ปี :&nbsp;
      <input name="t_year" type="text" size="10" value="<?php echo $s_year; ?>" disabled>
&nbsp; 
      รหัส :&nbsp;
      <input name="t_UserID" type="text" size="10" value="<?php echo $t_UserID; ?>" disabled> 
     &nbsp; บัญชีเลขที่ : 
      <input name="t_NoBank_Account " type="text"  size="20" value="<?php echo $t_NoBank_Account; ?>" disabled> </td>
  </tr>
  <tr>
    <td width="100">ชื่อ-สกุล</td>
    <td width="144" align="left" valign="middle">
      <input name="s_Fullname" type="text" size="20" value="<?php echo $s_Fullname; ?>" disabled></td>
    <td width="102">ขั้น</td>
    <td width="144" align="left" valign="middle">
      <input name="t_class" type="text" size="20" value="<?php echo $t_class; ?>"></td>
    <td width="78">ช่วยฯบุตร</td>
    <td width="146"><input name="t_help_child" type="text" size="20" value="<?php echo $t_help_child; ?>"></td>
  </tr>
  <tr>
    <td>ค่าตอบแทน</td>
    <td align="left"><input name="t_to_retaliate" type="text" size="20" value="<?php echo $t_to_retaliate; ?>"></td>
    <td>ค่าเสี่ยงภัย</td>
    <td><input name="t_to_risk" type="text"  size="20"  value="<?php echo $t_to_risk; ?>"></td>
    <td>ค่าศึกษาบุตร</td>
    <td><input name="t_child_education" type="text" size="20" value="<?php echo $t_child_education; ?>"></td>
  </tr>
  <tr>
    <td>ค่ารักษาพยาบาล</td>
    <td align="left"><input name="t_to_treat" type="text"  size="20" value="<?php echo $t_to_treat; ?>"></td>
    <td>เช่าบ้าน</td>
    <td><input name="t_rent_home" type="text"  size="20" value="<?php echo $t_rent_home; ?>"></td>
    <td>ภาษี</td>
    <td><input name="t_tax" type="text"  size="20" value="<?php echo $t_tax; ?>"></td>
  </tr>
  <tr>
    <td>เงินประจำตำแหน่ง</td>
    <td align="left"><input name="t_money_position" type="text"  size="20" value="<?php echo $t_money_position; ?>"></td>
    <td>ธ.อาคารสงเคราะห์</td>
    <td><input name="t_goverment_bank" type="text"  size="20" value="<?php echo $t_goverment_bank; ?>"></td>
    <td>สินเชื่อออม</td>
    <td><input name="t_credit_saving_bank" type="text"  size="20" value="<?php echo $t_credit_saving_bank; ?>"></td>
  </tr>
  <tr>
    <td>กบข.</td>
    <td align="left"><input name="t_gpf_gratuity" type="text"  size="20" value="<?php echo $t_gpf_gratuity; ?>"></td>
    <td>ฌกส.</td>
    <td><input name="t_to_help_die" type="text"  size="20" value="<?php echo $t_to_help_die; ?>"></td>
    <td>ประกันสังคม</td>
    <td><input name="t_social_secure" type="text"  size="20" value="<?php echo $social_status; ?>"></td>
  </tr>
  <tr>
    <td>ประกันชีวิต</td>
    <td align="left"><input name="t_life_insurance" type="text" size="20" value="<?php echo $t_life_insurance; ?>"></td>
    <td>กรมธรรม์</td>
    <td><input name="t_insurance" type="text"  size="20" value="<?php echo $t_insurance; ?>"></td>
    <td>ตกเบิกรวม</td>
    <td><input name="t_valve_all" type="text"  size="20" value="<?php echo $t_valve_all; ?>"></td>
  </tr>
  <tr>
    <td>กันดาร,ไม่ทำเวช</td>
    <td align="left"><input name="t_off_country" type="text"  size="20" value="<?php echo $t_off_country; ?>"></td>
    <td>สินเชื่อรถ</td>
    <td><input name="t_credit_car" type="text"  size="20" value="<?php echo $t_credit_car; ?>"></td>
    <td>รับจริง</td>
    <td><input name="total" type="text"  size="20" value="<?php echo $Total; ?>"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><input type="submit" name="s_ConSave_ADD" value="ยืนยันข้อมูล" id=Button>&nbsp;<input type="reset" value="ยกเลิก" id=Button>&nbsp;
	<input type="hidden" name="s_name" value="<?php echo $s_name; ?>" id=Button>
	<input type="hidden" name="s_month" value="<?php echo $s_month; ?>" id=Button>	<input type="hidden" name="s_year" value="<?php echo $s_year; ?>" id=Button></td>
    </tr>
</table>
</form>
<?php
//end show form conform
  }//class
} //s_Save=="บันทึก"
//end save

//save conform
/*if($s_ConSave_ADD="ยืนยันข้อมูล"){
//save in database
//echo $s_ConSave.$s_name.$s_month.$s_year;
//check ข้อมูลซ้ำ
$sql_ch_data="select * from detail_account where UserID='$s_name' and mouth='$s_month' and syear='$s_year' ";
$resultch_data=ResultDB($sql_ch_data);
	 if(mysql_num_rows($resultch_data)>0){ //row ready
		print"ข้อมูล ในเดือนนี้ของคุณ $s_Fullname ในเดือน $s_month ปี $s_year คุณได้บันทึกลงแล้ว";
		
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;  URL=faccount.php?link_menu=salary'>";
	}else{ //row
	//sql save-insert
	echo $t_social_secure.$t_total;
	//exit();
		$sqlSave_DataUser="INSERT INTO detail_account(UserID,class,to_retaliate,to_risk,help_child,to_treat,rent_home,child_educated,money_position ";
		$sqlSave_DataUser.=",goverment_bank,tax,gpf_gratuity,to_help_die,credit_saving_bank,life_insurance,insurance,off_country,credit_car,valve_all,social_secure,total,mouth,syear) ";
		$sqlSave_DataUser.="VALUES ('$s_name','$t_class','$t_to_retaliate','$t_to_risk','$t_help_child','$t_to_treat','$t_rent_home','$t_child_education','$t_money_position' ";
		$sqlSave_DataUser.=",'$t_goverment_bank','$t_tax','$t_gpf_gratuity','$t_to_help_die','$t_credit_saving_bank','$t_life_insurance','$t_insurance','$t_off_country','$t_credit_car','$t_valve_all','$t_social_secure','$t_total','$s_month','$s_year') ";
		echo 	$sqlSave_DataUser;
		exit();
		mysql_query($sqlSave_DataUser)
			or die ("ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font></center>".mysql_error());
			echo "<center><font color='green'><h2>- - บันทึกข้อมูลในฐานข้อมูล เรียบร้อยแล้ว - -<br>รอสักครู่...เพื่อทำรายการใหม่</h2></font></center>";
	//complete
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;  URL=faccount.php?link_menu=salary'>";
	}//row
} */
//end save conform
} //online
//close db
 CloseDB(); //close connect db 
?>
</body>
</html>
