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
		//get mount present
		if ($_GET['s_month']<>""){
  			$s_month=$_GET['s_month'];}else{
 			$s_month=date("n")-1;
 		}
		//echo $s_month;
		//get year present
		if ($_GET['s_year']<>""){
  			$s_year=$_GET['s_year'];}else{
 			$s_year=date("Y")+543;
 		}
		//echo $s_year;
//select userid,name,bank
 $sqlSelect_User_bank="select u.UserID as userid,o.name as name,u.NoBank_account  as bank,u.Status_social_secure as social ";
 $sqlSelect_User_bank.="from opduser o ";
 $sqlSelect_User_bank.="left outer join users_account u on u.UserID=o.loginname ";
 $sqlSelect_User_bank.="where u.UserID='$s_name' ";
//end select
	//echo "คุณ คือ ".$ip_Log;
	$sqlSelectUser="select * from opduser ";$resultSelectUser=ResultDB($sqlSelectUser);$rsSelectUser=mysql_fetch_array($resultSelectUser);
//menu
$sqlMenu="select * from users_account where Status_Access='1' and UserID='$ip_Log' ";
$resultMenu=ResultDB($sqlMenu);$r=mysql_num_rows($resultMenu);

?>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="651" height="25" background="../img_mian/bgcolor.gif">&nbsp;รายการ | <a href="../result_chlogin.php">หน้าหลัก</a> | <a href="#closeform">ปิดหน้าต่าง</a>
	 | <a href="javascript:history.back(-1)">ย้อนกลับ</a> | 
	 <?php 
	 if($r>0){
	 print"<a href=\"faccount.php?link_menu=edit_user\">เพิ่ม/แก้ไขหมายเลขบัญชี</a> | <a href=\"faccount.php?link_menu=salary\">ทำรายการเงินเดือน</a> | ";
	 }
	 ?>
	 </td>
    <td width="143">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><p>&nbsp;</p>
<?php
if($link_menu=="edit_user"){ //คลิก link
	$sqlEdit_no="select * from opduser order by name ";
	$resultEdit_no=ResultDB($sqlEdit_no);
	//echo "d".mysql_num_rows($resultEdit_no);
?>
<form action="<?php $PHP_SELF ?>" method="get" name="fs_account">
<table width="300" border="0" cellspacing="0" cellpadding="0" class="bd-external"><tr><td>
	<table width="300" border="0" cellspacing="0" cellpadding="3">
      <tr align="center" bgcolor="#FFFF66">
        <td colspan="2"><b>ระบบเงินเดือน</b></td>
        </tr>
      <tr>
        <td width="78">เลือกรายการ</td>
        <td>
	<select name="s_name">
	<?php
	//print"<option value='$s_month'>".change_month_isThai($s_month)."</option>";
	$i=0;
	while($i<mysql_num_rows($resultEdit_no)){ 
	$rsEdit_no=mysql_fetch_array($resultEdit_no);
		print"<option value='".$rsEdit_no['loginname']."'>".$rsEdit_no['name']."</option>";
	$i++;
	}
	?>
	</select>
	 </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;<input type="submit" name="s_Submit_edit" value="ตกลง" id="Button">&nbsp;<input type="button" VALUE="ย้อนกลับ" onClick="goHist(-1)"  id="Button">
		</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="260">&nbsp;</td>
        </tr>
    </table></td></tr></table>
	</form>
<?php
}elseif($link_menu=="salary"){ //link
	$sqlEdit_no="select * from opduser order by name ";
	$resultEdit_no=ResultDB($sqlEdit_no);

?>

<form action="<?php $PHP_SELF; ?>" name="f_account_s_add" method="get">
<table width="300" border="0" cellspacing="0" cellpadding="0" class="bd-external"><tr><td>
 <table width="300" border="0" cellspacing="2" cellpadding="2">
  <tr align="center" bgcolor="#FFFF66">
    <td colspan="2">รายการเงินเดือน</td>
    </tr>
  <tr align="left">
    <td colspan="2">
	รายการประจำเดือน : &nbsp;
	<select name="s_month">
	<?php
	$m=$s_month+1;
	print"<option value='$m'>".change_month_isThai($m)."</option>";
	for($i=1;$i<=12;$i++){
	print"<option value='$i'>".change_month_isThai($i)."</option>";
	}
	?>
	</select>&nbsp; ปี :&nbsp;<input type="text" name="s_year" value="<?php echo $s_year; ?> " size="6">
	</td>
    </tr>
  <tr>
    <td width="55">ชื่อ-สกุล</td>
    <td width="188" align="left" valign="middle">
      <select name="s_name">
	<?php
	//print"<option value='$s_month'>".change_month_isThai($s_month)."</option>";
	$i=0;
	while($i<mysql_num_rows($resultEdit_no)){ 
	$rsEdit_no=mysql_fetch_array($resultEdit_no);
		print"<option value='".$rsEdit_no['loginname']."'>".$rsEdit_no['name']."</option>";
	$i++;
	}
	?>
	</select> 
      </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="SAdd_Detail" value="ตกลง" id=Button>&nbsp;<input type="button" VALUE="ย้อนกลับ" onClick="goHist(-1)"  id="Button"></td>
    </tr>
</table></td></tr></table>
</form>	

<?php
} //click link 

//s_Submit_edit==ตกลง
if($s_Submit_edit=='ตกลง'){ //$s_Submit_edit=='ตกลง'
 //check in database user_account
 /*$sqlSelect_User_bank="select u.UserID as userid,o.name as name,u.NoBank_account  as bank ";
 $sqlSelect_User_bank.="from opduser o ";
 $sqlSelect_User_bank.="left outer join users_account u on u.UserID=o.loginname ";
 $sqlSelect_User_bank.="where u.UserID='$s_name' "; */
 $resultSelect_User_bank=ResultDB($sqlSelect_User_bank);
 	if(mysql_num_rows($resultSelect_User_bank)>0){ //row
 	$rsSelect_User_bank=mysql_fetch_array($resultSelect_User_bank);
	 //create form ->update
	 	print"<form action=\"action.php\" method=\"get\" name=\"fs_account_edit\">";
		print"<table width=\"300\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bd-external\"><tr><td>";
		print"<table width=\"300\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
        print"<tr align=\"center\" bgcolor=\"#FFFF66\">";
        print"<td colspan=\"2\"><b>ระบบเงินเดือน</b></td></tr>";
      	print"<tr><td width=\"170\">รายการของ</td>";
		print"<td><input type='text' name='t_login' value='".$rsSelect_User_bank['userid']."' disabled></td></tr>";
      	print"<tr><td width=\"170\">&nbsp;ชื่อ-สกุล :</td>";
		print"<td>&nbsp;<font color='green'><b>".$rsSelect_User_bank['name']."</b></font></td></tr>";
      	print"<tr><td width=\"170\">&nbsp;เลขบัญชี :</td>";
		print"<td><input type='text' name='t_no_bank' size='20' value='".$rsSelect_User_bank['bank']."'></td></tr>";
		print"<tr><td>&nbsp;สิทธิประกันสังคม</td>";
		print"<td><input type='text' name='t_social' size='2' value='".$rsSelect_User_bank['social']."'> <font color='red'>** ไม่ใช่ = 0 , ใช่ =1</font></td></tr>";
		print"<tr><td>&nbsp;</td>";
        print"<td>&nbsp;<input type=\"submit\" name=\"s_Submit_edit\" value=\"แก้ไข\" id=\"Button\">&nbsp;<input type=\"hidden\" name=\"s_name\" value=\"$s_name\">&nbsp;<input type=\"button\" VALUE=\"ย้อนกลับ\" onClick=\"goHist(-1)\"  id=\"Button\"></td></tr>";
      	print"<tr><td>&nbsp;</td><td width=\"260\">&nbsp;</td></tr>";
		print"</table></td></tr></table></form>";
	}else{ // no row
	 //crete form ->add
	  	$sqlSelect_User="select * from opduser where loginname='$s_name' ";
	 	$resultSelect_User=ResultDB($sqlSelect_User);$rsSelect_User=mysql_fetch_array($resultSelect_User);
	 	print"<form action=\"action.php\" method=\"get\" name=\"fs_account_edit\">";
		print"<table width=\"300\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bd-external\"><tr><td>";
		print"<table width=\"300\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
        print"<tr align=\"center\" bgcolor=\"#FFFF66\">";
        print"<td colspan=\"2\"><b>ระบบเงินเดือน</b></td></tr>";
      	print"<tr><td width=\"78\">รายการของ</td>";
		print"<td><input type='text' name='t_login' value='".$rsSelect_User['loginname']."' disabled></td></tr>";
      	print"<tr><td width=\"78\">&nbsp;ชื่อ-สกุล :</td>";
		print"<td>&nbsp;<font color='green'><b>".$rsSelect_User['name']."</b></font></td></tr>";
      	print"<tr><td width=\"78\">&nbsp;เลขบัญชี :</td>";
		print"<td><input type='text' name='t_no_bank' size='20'><font color='red'></font></td></tr>";
		print"<tr><td>&nbsp;สิทธิประกันสังคม</td>";
		print"<td><input type='text' name='t_social' size='2'> <font color='red'>** ไม่ใช่ = 0 , ใช่ =1</font></td></tr>";
		print"<tr><td>&nbsp;</td>";
        print"<td>&nbsp;<input type=\"submit\" name=\"s_Submit_add\" value=\"เพิ่ม\" id=\"Button\">&nbsp;<input type=\"reset\" value=\"ยกเลิก\" id=\"Button\"><input type=\"hidden\" name=\"s_name\" value=\"$s_name\">&nbsp;<input type=\"button\" VALUE=\"ย้อนกลับ\" onClick=\"goHist(-1)\"  id=\"Button\"></td></tr>";
		print"</table></td></tr></table></form>";
	} //row
} //$s_Submit_edit=='ตกลง'

//start SAdd_Detail =ตกลง
if($SAdd_Detail =="ตกลง"){
 $resultDetail_User=ResultDB($sqlSelect_User_bank);
 $rsDetail_User=mysql_fetch_array($resultDetail_User);
?>
<form action="action.php" name="f_account_svae" method="get">
<table width="700" border="0" cellspacing="0" cellpadding="0" class="bd-external"><tr><td>
 <table width="700" border="0" cellspacing="2" cellpadding="2">
  <tr align="center" bgcolor="#FFFF66">
    <td colspan="6">รายการเงินเดือน</td>
  </tr>
  <tr align="center">
    <td colspan="6">
	รายการประจำเดือน :&nbsp;&nbsp;
<?php
if($s_month==""){
print"<select name='s_mount'>";
	for($i=1;$i<=12;$i++){
	print"<option value='$i'>".change_month_isThai($i)."</option>";
	}
print"</select>";
}else{
print"<input name=\"s_mount\" type=\"text\"  size=\"12\" value='".change_month_isThai($s_month)."' disabled>";
}
//name
	$sqlName="select * from opduser where loginname='$s_name' ";$resultName=ResultDB($sqlName);$rsName=mysql_fetch_array($resultName);
	$code_log=$rsName['doctorcode'];$name=$rsName['name'];
//bank
 	$result_Bank=ResultDB($sqlSelect_User_bank);$rs_Bank=mysql_fetch_array($result_Bank);
	$bank_no=$rs_Bank['bank'];
//old_detail ที่ผ่านมา
	$sqlDetail_Old="select * from detail_account where UserID='$s_name' order by syear,mouth desc  limit 1 ";$resultDetail_Old=ResultDB($sqlDetail_Old);$rsDetail_Old=mysql_fetch_array($resultDetail_Old);
?>
      &nbsp;ปี :&nbsp;
      <input name="t_year" type="text" size="10" value="<?php echo $s_year; ?>" disabled>
&nbsp; 
      รหัส :&nbsp;
      <input name="t_UserID" type="text" size="10" value="<?php echo $code_log; ?>" disabled> 
     &nbsp; บัญชีเลขที่ : 
      <input name="t_NoBank_Account" type="text"  size="20" value="<?php echo $bank_no; ?>" disabled> </td>
  </tr>
  <tr>
    <td width="100">ชื่อ-สกุล</td>
    <td width="144" align="left" valign="middle">
      <input name="s_Fullname" type="text" size="20" value="<?php echo $name; ?>" disabled></td>
    <td width="102">ขั้น</td>
    <td width="144" align="left" valign="middle">
      <input name="t_class" type="text" size="20" value="<?php if($rsDetail_Old['class']>0){echo $rsDetail_Old['class'];} ?>"></td>
    <td width="78">ช่วยฯบุตร</td>
    <td width="146"><input name="t_help_child" type="text" size="20" value="<?php if($rsDetail_Old['help_child']>0){echo $rsDetail_Old['help_child'];} ?>"></td>
  </tr>
  <tr>
    <td>ค่าตอบแทน</td>
    <td align="left"><input name="t_to_retaliate" type="text" size="20" value="<?php if($rsDetail_Old['to_retaliate']>0){echo $rsDetail_Old['to_retaliate'];} ?>"></td>
    <td>ค่าเสี่ยงภัย</td>
    <td><input name="t_to_risk" type="text"  size="20" value="<?php if($rsDetail_Old['to_risk']>0){echo $rsDetail_Old['to_risk'];} ?>"></td>
    <td>ค่าศึกษาบุตร</td>
    <td><input name="t_child_education" type="text" size="20" value="<?php if($rsDetail_Old['child_educated']>0){echo $rsDetail_Old['child_educated'];} ?>"></td>
  </tr>
  <tr>
    <td>ค่ารักษาพยาบาล</td>
    <td align="left"><input name="t_to_treat" type="text"  size="20" value="<?php if($rsDetail_Old['to_treat']>0){echo $rsDetail_Old['to_treat'];} ?>"></td>
    <td>เช่าบ้าน</td>
    <td><input name="t_rent_home" type="text"  size="20" value="<?php if($rsDetail_Old['rent_home']>0){echo $rsDetail_Old['rent_home'];} ?>"></td>
    <td>ภาษี</td>
    <td><input name="t_tax" type="text"  size="20" value="<?php if($rsDetail_Old['tax']>0){echo $rsDetail_Old['tax'];} ?>"></td>
  </tr>
  <tr>
    <td>เงินประจำตำแหน่ง</td>
    <td align="left"><input name="t_money_position" type="text"  size="20" value="<?php if($rsDetail_Old['money_position']>0){echo $rsDetail_Old['money_position'];} ?>"></td>
    <td>ธ.อาคารสงเคราะห์</td>
    <td><input name="t_goverment_bank" type="text"  size="20" value="<?php if($rsDetail_Old['goverment_bank']>0){echo $rsDetail_Old['goverment_bank'];} ?>"></td>
    <td>สินเชื่อออม</td>
    <td><input name="t_credit_saving_bank" type="text"  size="20" value="<?php if($rsDetail_Old['credit_saving_bank']>0){echo $rsDetail_Old['credit_saving_bank'];} ?>"></td>
  </tr>
  <tr>
    <td>กบข.</td>
    <td align="left"><input name="t_gpf_gratuity" type="text"  size="20" value="<?php if($rsDetail_Old['gpf_gratuity']>0){echo $rsDetail_Old['gpf_gratuity'];} ?>"></td>
    <td>ฌกส.</td>
    <td><input name="t_to_help_die" type="text"  size="20" value="<?php if($rsDetail_Old['to_help_die']>0){echo $rsDetail_Old['to_help_die'];} ?>"></td>
    <td>ประกันสังคม</td>
    <td><input name="t_social_secure" type="text"  size="20" value="คำนวณอัตโนมัติ" disabled></td>
  </tr>
  <tr>
    <td>ประกันชีวิต</td>
    <td align="left"><input name="t_life_insurance" type="text" size="20" value="<?php if($rsDetail_Old['life_insurance']>0){echo $rsDetail_Old['life_insurance'];} ?>"></td>
    <td>กรมธรรม์</td>
    <td><input name="t_insurance" type="text"  size="20" value="<?php if($rsDetail_Old['insurance']>0){echo $rsDetail_Old['insurance'];} ?>"></td>
    <td>ตกเบิกรวม</td>
    <td><input name="t_valve_all" type="text"  size="20" value="<?php if($rsDetail_Old['valve_all']>0){echo $rsDetail_Old['valve_all'];} ?>"></td>
  </tr>
  <tr>
    <td>กันดาร,ไม่ทำเวช</td>
    <td align="left"><input name="t_off_country" type="text"  size="20" value="<?php if($rsDetail_Old['off_country']>0){echo $rsDetail_Old['off_country'];} ?>"></td>
    <td>สินเชื่อรถ</td>
    <td><input name="t_credit_car" type="text"  size="20" value="<?php if($rsDetail_Old['credit_car']>0){echo $rsDetail_Old['credit_car'];} ?>"></td>
    <td>รับจริง</td>
    <td><input name="t_total" type="text"  size="20" value="คำนวณอัตโนมัติ" disabled></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><input type="submit" name="s_Save" value="บันทึก" id=Button>&nbsp;<input type="reset" value="ยกเลิก" id=Button>&nbsp;
	<input type="button" VALUE="ย้อนกลับ" onClick="goHist(-1)"  id="Button"><input type="hidden" name="s_name" value="<?php echo $s_name; ?>" id=Button>
	<input type="hidden" name="s_month" value="<?php echo $s_month; ?>" id=Button>	<input type="hidden" name="s_year" value="<?php echo $s_year; ?>" id=Button>
	<input type="hidden" name="s_Fullname" value="<?php echo $name; ?>" id=Button><input type="hidden" name="t_UserID" value="<?php echo $code_log; ?>" id=Button>
	<input type="hidden" name="t_NoBank_Account" value="<?php echo $bank_no; ?>" id=Button>
	</td>
    </tr>
</table></td></tr></table>
</form>	
<?php
}//End SAdd_Detail =ตกลง
?>
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
} //online
 CloseDB(); //close connect db 
?>
</body>
</html>
