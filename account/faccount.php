<?php 
session_start();
include("../phpconf.php");
include("../func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>�к��Թ����� | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - �к��Թ��͹ - -|</title>
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
	//echo "�س ��� ".$ip_Log;
	$sqlSelectUser="select * from opduser ";$resultSelectUser=ResultDB($sqlSelectUser);$rsSelectUser=mysql_fetch_array($resultSelectUser);
//menu
$sqlMenu="select * from users_account where Status_Access='1' and UserID='$ip_Log' ";
$resultMenu=ResultDB($sqlMenu);$r=mysql_num_rows($resultMenu);

?>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="651" height="25" background="../img_mian/bgcolor.gif">&nbsp;��¡�� | <a href="../result_chlogin.php">˹����ѡ</a> | <a href="#closeform">�Դ˹�ҵ�ҧ</a>
	 | <a href="javascript:history.back(-1)">��͹��Ѻ</a> | 
	 <?php 
	 if($r>0){
	 print"<a href=\"faccount.php?link_menu=edit_user\">����/��������Ţ�ѭ��</a> | <a href=\"faccount.php?link_menu=salary\">����¡���Թ��͹</a> | ";
	 }
	 ?>
	 </td>
    <td width="143">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><p>&nbsp;</p>
<?php
if($link_menu=="edit_user"){ //��ԡ link
	$sqlEdit_no="select * from opduser order by name ";
	$resultEdit_no=ResultDB($sqlEdit_no);
	//echo "d".mysql_num_rows($resultEdit_no);
?>
<form action="<?php $PHP_SELF ?>" method="get" name="fs_account">
<table width="300" border="0" cellspacing="0" cellpadding="0" class="bd-external"><tr><td>
	<table width="300" border="0" cellspacing="0" cellpadding="3">
      <tr align="center" bgcolor="#FFFF66">
        <td colspan="2"><b>�к��Թ��͹</b></td>
        </tr>
      <tr>
        <td width="78">���͡��¡��</td>
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
        <td>&nbsp;<input type="submit" name="s_Submit_edit" value="��ŧ" id="Button">&nbsp;<input type="button" VALUE="��͹��Ѻ" onClick="goHist(-1)"  id="Button">
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
    <td colspan="2">��¡���Թ��͹</td>
    </tr>
  <tr align="left">
    <td colspan="2">
	��¡�û�Ш���͹ : &nbsp;
	<select name="s_month">
	<?php
	$m=$s_month+1;
	print"<option value='$m'>".change_month_isThai($m)."</option>";
	for($i=1;$i<=12;$i++){
	print"<option value='$i'>".change_month_isThai($i)."</option>";
	}
	?>
	</select>&nbsp; �� :&nbsp;<input type="text" name="s_year" value="<?php echo $s_year; ?> " size="6">
	</td>
    </tr>
  <tr>
    <td width="55">����-ʡ��</td>
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
    <td><input type="submit" name="SAdd_Detail" value="��ŧ" id=Button>&nbsp;<input type="button" VALUE="��͹��Ѻ" onClick="goHist(-1)"  id="Button"></td>
    </tr>
</table></td></tr></table>
</form>	

<?php
} //click link 

//s_Submit_edit==��ŧ
if($s_Submit_edit=='��ŧ'){ //$s_Submit_edit=='��ŧ'
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
        print"<td colspan=\"2\"><b>�к��Թ��͹</b></td></tr>";
      	print"<tr><td width=\"170\">��¡�âͧ</td>";
		print"<td><input type='text' name='t_login' value='".$rsSelect_User_bank['userid']."' disabled></td></tr>";
      	print"<tr><td width=\"170\">&nbsp;����-ʡ�� :</td>";
		print"<td>&nbsp;<font color='green'><b>".$rsSelect_User_bank['name']."</b></font></td></tr>";
      	print"<tr><td width=\"170\">&nbsp;�Ţ�ѭ�� :</td>";
		print"<td><input type='text' name='t_no_bank' size='20' value='".$rsSelect_User_bank['bank']."'></td></tr>";
		print"<tr><td>&nbsp;�Է�Ի�Сѹ�ѧ��</td>";
		print"<td><input type='text' name='t_social' size='2' value='".$rsSelect_User_bank['social']."'> <font color='red'>** ����� = 0 , �� =1</font></td></tr>";
		print"<tr><td>&nbsp;</td>";
        print"<td>&nbsp;<input type=\"submit\" name=\"s_Submit_edit\" value=\"���\" id=\"Button\">&nbsp;<input type=\"hidden\" name=\"s_name\" value=\"$s_name\">&nbsp;<input type=\"button\" VALUE=\"��͹��Ѻ\" onClick=\"goHist(-1)\"  id=\"Button\"></td></tr>";
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
        print"<td colspan=\"2\"><b>�к��Թ��͹</b></td></tr>";
      	print"<tr><td width=\"78\">��¡�âͧ</td>";
		print"<td><input type='text' name='t_login' value='".$rsSelect_User['loginname']."' disabled></td></tr>";
      	print"<tr><td width=\"78\">&nbsp;����-ʡ�� :</td>";
		print"<td>&nbsp;<font color='green'><b>".$rsSelect_User['name']."</b></font></td></tr>";
      	print"<tr><td width=\"78\">&nbsp;�Ţ�ѭ�� :</td>";
		print"<td><input type='text' name='t_no_bank' size='20'><font color='red'></font></td></tr>";
		print"<tr><td>&nbsp;�Է�Ի�Сѹ�ѧ��</td>";
		print"<td><input type='text' name='t_social' size='2'> <font color='red'>** ����� = 0 , �� =1</font></td></tr>";
		print"<tr><td>&nbsp;</td>";
        print"<td>&nbsp;<input type=\"submit\" name=\"s_Submit_add\" value=\"����\" id=\"Button\">&nbsp;<input type=\"reset\" value=\"¡��ԡ\" id=\"Button\"><input type=\"hidden\" name=\"s_name\" value=\"$s_name\">&nbsp;<input type=\"button\" VALUE=\"��͹��Ѻ\" onClick=\"goHist(-1)\"  id=\"Button\"></td></tr>";
		print"</table></td></tr></table></form>";
	} //row
} //$s_Submit_edit=='��ŧ'

//start SAdd_Detail =��ŧ
if($SAdd_Detail =="��ŧ"){
 $resultDetail_User=ResultDB($sqlSelect_User_bank);
 $rsDetail_User=mysql_fetch_array($resultDetail_User);
?>
<form action="action.php" name="f_account_svae" method="get">
<table width="700" border="0" cellspacing="0" cellpadding="0" class="bd-external"><tr><td>
 <table width="700" border="0" cellspacing="2" cellpadding="2">
  <tr align="center" bgcolor="#FFFF66">
    <td colspan="6">��¡���Թ��͹</td>
  </tr>
  <tr align="center">
    <td colspan="6">
	��¡�û�Ш���͹ :&nbsp;&nbsp;
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
//old_detail ����ҹ��
	$sqlDetail_Old="select * from detail_account where UserID='$s_name' order by syear,mouth desc  limit 1 ";$resultDetail_Old=ResultDB($sqlDetail_Old);$rsDetail_Old=mysql_fetch_array($resultDetail_Old);
?>
      &nbsp;�� :&nbsp;
      <input name="t_year" type="text" size="10" value="<?php echo $s_year; ?>" disabled>
&nbsp; 
      ���� :&nbsp;
      <input name="t_UserID" type="text" size="10" value="<?php echo $code_log; ?>" disabled> 
     &nbsp; �ѭ���Ţ��� : 
      <input name="t_NoBank_Account" type="text"  size="20" value="<?php echo $bank_no; ?>" disabled> </td>
  </tr>
  <tr>
    <td width="100">����-ʡ��</td>
    <td width="144" align="left" valign="middle">
      <input name="s_Fullname" type="text" size="20" value="<?php echo $name; ?>" disabled></td>
    <td width="102">���</td>
    <td width="144" align="left" valign="middle">
      <input name="t_class" type="text" size="20" value="<?php if($rsDetail_Old['class']>0){echo $rsDetail_Old['class'];} ?>"></td>
    <td width="78">����Ϻص�</td>
    <td width="146"><input name="t_help_child" type="text" size="20" value="<?php if($rsDetail_Old['help_child']>0){echo $rsDetail_Old['help_child'];} ?>"></td>
  </tr>
  <tr>
    <td>��ҵͺ᷹</td>
    <td align="left"><input name="t_to_retaliate" type="text" size="20" value="<?php if($rsDetail_Old['to_retaliate']>0){echo $rsDetail_Old['to_retaliate'];} ?>"></td>
    <td>�������§���</td>
    <td><input name="t_to_risk" type="text"  size="20" value="<?php if($rsDetail_Old['to_risk']>0){echo $rsDetail_Old['to_risk'];} ?>"></td>
    <td>����֡�Һص�</td>
    <td><input name="t_child_education" type="text" size="20" value="<?php if($rsDetail_Old['child_educated']>0){echo $rsDetail_Old['child_educated'];} ?>"></td>
  </tr>
  <tr>
    <td>����ѡ�Ҿ�Һ��</td>
    <td align="left"><input name="t_to_treat" type="text"  size="20" value="<?php if($rsDetail_Old['to_treat']>0){echo $rsDetail_Old['to_treat'];} ?>"></td>
    <td>��Һ�ҹ</td>
    <td><input name="t_rent_home" type="text"  size="20" value="<?php if($rsDetail_Old['rent_home']>0){echo $rsDetail_Old['rent_home'];} ?>"></td>
    <td>����</td>
    <td><input name="t_tax" type="text"  size="20" value="<?php if($rsDetail_Old['tax']>0){echo $rsDetail_Old['tax'];} ?>"></td>
  </tr>
  <tr>
    <td>�Թ��Шӵ��˹�</td>
    <td align="left"><input name="t_money_position" type="text"  size="20" value="<?php if($rsDetail_Old['money_position']>0){echo $rsDetail_Old['money_position'];} ?>"></td>
    <td>�.�Ҥ��ʧ������</td>
    <td><input name="t_goverment_bank" type="text"  size="20" value="<?php if($rsDetail_Old['goverment_bank']>0){echo $rsDetail_Old['goverment_bank'];} ?>"></td>
    <td>�Թ�������</td>
    <td><input name="t_credit_saving_bank" type="text"  size="20" value="<?php if($rsDetail_Old['credit_saving_bank']>0){echo $rsDetail_Old['credit_saving_bank'];} ?>"></td>
  </tr>
  <tr>
    <td>���.</td>
    <td align="left"><input name="t_gpf_gratuity" type="text"  size="20" value="<?php if($rsDetail_Old['gpf_gratuity']>0){echo $rsDetail_Old['gpf_gratuity'];} ?>"></td>
    <td>���.</td>
    <td><input name="t_to_help_die" type="text"  size="20" value="<?php if($rsDetail_Old['to_help_die']>0){echo $rsDetail_Old['to_help_die'];} ?>"></td>
    <td>��Сѹ�ѧ��</td>
    <td><input name="t_social_secure" type="text"  size="20" value="�ӹǳ�ѵ��ѵ�" disabled></td>
  </tr>
  <tr>
    <td>��Сѹ���Ե</td>
    <td align="left"><input name="t_life_insurance" type="text" size="20" value="<?php if($rsDetail_Old['life_insurance']>0){echo $rsDetail_Old['life_insurance'];} ?>"></td>
    <td>��������</td>
    <td><input name="t_insurance" type="text"  size="20" value="<?php if($rsDetail_Old['insurance']>0){echo $rsDetail_Old['insurance'];} ?>"></td>
    <td>���ԡ���</td>
    <td><input name="t_valve_all" type="text"  size="20" value="<?php if($rsDetail_Old['valve_all']>0){echo $rsDetail_Old['valve_all'];} ?>"></td>
  </tr>
  <tr>
    <td>�ѹ���,�����Ǫ</td>
    <td align="left"><input name="t_off_country" type="text"  size="20" value="<?php if($rsDetail_Old['off_country']>0){echo $rsDetail_Old['off_country'];} ?>"></td>
    <td>�Թ����ö</td>
    <td><input name="t_credit_car" type="text"  size="20" value="<?php if($rsDetail_Old['credit_car']>0){echo $rsDetail_Old['credit_car'];} ?>"></td>
    <td>�Ѻ��ԧ</td>
    <td><input name="t_total" type="text"  size="20" value="�ӹǳ�ѵ��ѵ�" disabled></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><input type="submit" name="s_Save" value="�ѹ�֡" id=Button>&nbsp;<input type="reset" value="¡��ԡ" id=Button>&nbsp;
	<input type="button" VALUE="��͹��Ѻ" onClick="goHist(-1)"  id="Button"><input type="hidden" name="s_name" value="<?php echo $s_name; ?>" id=Button>
	<input type="hidden" name="s_month" value="<?php echo $s_month; ?>" id=Button>	<input type="hidden" name="s_year" value="<?php echo $s_year; ?>" id=Button>
	<input type="hidden" name="s_Fullname" value="<?php echo $name; ?>" id=Button><input type="hidden" name="t_UserID" value="<?php echo $code_log; ?>" id=Button>
	<input type="hidden" name="t_NoBank_Account" value="<?php echo $bank_no; ?>" id=Button>
	</td>
    </tr>
</table></td></tr></table>
</form>	
<?php
}//End SAdd_Detail =��ŧ
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
