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
	if($s_month==0){$s_month=$s_month+12;$s_year=$s_year-1;} //㹡óշ����͹�� 0 �������鹻�

 //sql select name from login
	$sqlSelectUser="select * from opduser where loginname='$ip_Log' ";
	$resultSelectUser=ResultDB($sqlSelectUser);$rsSelectUser=mysql_fetch_array($resultSelectUser);
//online
if($_REQUEST['s_Submit']<>"��ŧ"){//��衴������ŧ �ʴ� form ���͡��¡��
//sql check menu
$sqlMenu="select * from users_account where Status_Access='1' and UserID='$ip_Log' ";
$resultMenu=ResultDB($sqlMenu);$r=mysql_num_rows($resultMenu);
?>

<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="27" colspan="2" background="../img_mian/bgcolor.gif">&nbsp;��¡�� | <a href="../result_chlogin.php">˹����ѡ</a> | <a href="#closeform">�Դ˹�ҵ�ҧ</a>
	 | <a href="javascript:history.back(-1)">��͹��Ѻ</a> | 
	 <?php 
	 if($r>0){
	 print"<a href=\"faccount.php?link_menu=edit_user\">����/��������Ţ�ѭ��</a> | <a href=\"faccount.php?link_menu=salary\">����¡���Թ��͹</a> | ";
	 }
	 ?>
	<a href="salary_all.php">�ʹ����Թ��͹</a> |
	 </td>
  </tr>
  <tr>
    <td width="674" align="center"><br>
	<form action="<?php $PHP_SELF ?>" method="get" name="fs_account"><center>
<table width="500" border="0" cellspacing="0" cellpadding="0" class="bd-external"><tr><td>
	<table width="500" border="0" cellspacing="0" cellpadding="3">
      <tr align="center" bgcolor="#FFFF66">
        <td colspan="4"><b>�к��Թ��͹</b></td>
        </tr>
      <tr>
        <td>����</td>
        <td>&nbsp;<?php echo "<font color='green'><b>".$rsSelectUser['doctorcode']."</b></font>"; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="109">����к����� Login :</td>
        <td width="139">&nbsp;<?php echo "<font color='green'><b>".$ip_Log."</b></font>"; ?></td>
        <td width="54">����-ʡ�� : </td>
        <td width="174">&nbsp;<?php echo "<font color='green'><b>".$rsSelectUser['name']."</b></font>"; ?></td>
      </tr>
      <tr>
        <td>���͡��¡��</td>
        <td colspan="3">��͹ : &nbsp;
	<select name="s_month">
	<?php
	print"<option value='$s_month'>".change_month_isThai($s_month)."</option>";
	for($i=1;$i<=12;$i++){
	print"<option value='$i'>".change_month_isThai($i)."</option>";
	}
	?>
	</select>&nbsp; �� :&nbsp;<input type="text" name="s_year" size="6" value="<?php echo $s_year; ?>">
	</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;<input type="submit" name="s_Submit" value="��ŧ" id="Button">&nbsp;<input type="button" VALUE="��͹��Ѻ" onClick="goHist(-1)"  id="Button">
		<input type="hidden" name="code_login" value="<?php echo $rsSelectUser['doctorcode']; ?>"><input type="hidden" name="name_login" value="<?php echo $rsSelectUser['name']; ?>">
		<input type="hidden" name="s_name" value="<?php echo $rsSelectUser['loginname']; ?>"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td></tr></table>
	</form>
    <p>&nbsp;</p>
	
<?php }else{ //��ԡ������ŧ �ʴ� form ��������¡�÷�������͡
//echo $s_Submit.$s_month.$s_year.$s_name;
$sql_Nbank="select * from users_account where UserID='$s_name' "; // no bank account
$result_Nbank=ResultDB($sql_Nbank);$rs_Nbank=mysql_fetch_array($result_Nbank);

$sql_DetailAccount="select * from detail_account where UserID='$s_name' and mouth='$s_month' and syear='$s_year' "; // no detail account
$resultDetailAccount=ResultDB($sql_DetailAccount);$rsDetailAccount=mysql_fetch_array($resultDetailAccount);

?>
<br><p align="center">
<table width="650" border="0" cellspacing="0" cellpadding="0" class="bd-external" align="center"><tr><td>
<table width="650" border="0" cellspacing="2" cellpadding="2" align="center">
  <tr align="center" bgcolor="#FFFF66">
    <td colspan="6"><b>��¡���Թ��͹</b></td>
  </tr>
  <tr align="left">
    <td colspan="6">
	��¡�û�Ш���͹ :&nbsp;&nbsp;
      <input name="t_month" type="text" value="<?php echo change_month_isThai($s_month);?>" size="10" disabled>
      &nbsp; <font size="2">�� :&nbsp;
      <input name="s_year" type="text" value="<?php echo $s_year;?>" size="5" disabled> 
&nbsp; 
      </font>���� :&nbsp;
      <input name="t_UserID" type="text" size="5" value="<?php echo $code_login;?>" disabled> 
     &nbsp; �ѭ���Ţ��� : 
      <input name="t_NoBank_Account " type="text"  size="13"  value="<?php echo $rs_Nbank['NoBank_Account']; ?>" disabled></td>
  </tr>
  <tr>
    <td width="100">����-ʡ��</td>
    <td width="144" align="left" valign="middle"> 
      <input name="s_Fullname" type="text" value="<?php echo $name_login;?>" size="20" disabled></td>
    <td width="102">���</td>
    <td width="144" align="left" valign="middle">
      <input name="t_class" type="text" size="10" value="<?php echo number_format($rsDetailAccount['class']); ?>" disabled></td>
    <td width="78">����Ϻص�</td>
    <td width="146"><input name="t_help_child" type="text" size="10" value="<?php echo number_format($rsDetailAccount['help_child']); ?>" disabled></td>
  </tr>
  <tr>
    <td>��ҵͺ᷹</td>
    <td align="left"><input name="t_to_retaliate" type="text" size="10" value="<?php echo number_format($rsDetailAccount['to_retaliate']); ?>" disabled></td>
    <td>�������§���</td>
    <td><input name="t_to_risk" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['to_risk']); ?>" disabled></td>
    <td>����֡�Һص�</td>
    <td><input name="t_child_education" type="text" size="10" value="<?php echo number_format($rsDetailAccount['child_education']); ?>" disabled></td>
  </tr>
  <tr>
    <td>����ѡ�Ҿ�Һ��</td>
    <td align="left"><input name="t_to_treat" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['to_treat']); ?>" disabled></td>
    <td>��Һ�ҹ</td>
    <td><input name="t_rent_home" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['rent_home']); ?>" disabled></td>
    <td>����</td>
    <td><input name="t_tax" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['tax']); ?>" disabled></td>
  </tr>
  <tr>
    <td>�Թ��Шӵ��˹�</td>
    <td align="left"><input name="t_money_position" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['money_position']); ?>" disabled></td>
    <td>�.�Ҥ��ʧ������</td>
    <td><input name="t_goverment_bank" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['goverment_bank']); ?>" disabled></td>
    <td>�Թ�������</td>
    <td><input name="t_credit_saving_bank" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['credit_saving_bank']); ?>" disabled></td>
  </tr>
  <tr>
    <td>���.</td>
    <td align="left"><input name="t_gpf_gratuity" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['gpf_gratuity']); ?>" disabled></td>
    <td>���.</td>
    <td><input name="t_to_help_die" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['to_help_die']); ?>" disabled></td>
    <td>��Сѹ�ѧ��</td>
    <td><input name="t_social_secure" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['social_secure']); ?>" disabled></td>
  </tr>
  <tr>
    <td>��Сѹ���Ե</td>
    <td align="left"><input name="t_life_insurance" type="text" size="10" value="<?php echo number_format($rsDetailAccount['life_insurance']); ?>" disabled></td>
    <td>��������</td>
    <td><input name="t_insurance" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['insurance']); ?>" disabled></td>
    <td>���ԡ���</td>
    <td><input name="t_valve_all" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['valve_all']); ?>" disabled></td>
  </tr>
  <tr>
    <td>�ѹ���,�����Ǫ</td>
    <td align="left"><input name="t_off_country" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['off_country']); ?>" disabled></td>
    <td>�Թ����ö</td>
    <td><input name="t_credit_car" type="text"  size="10" value="<?php echo number_format($rsDetailAccount['credit_car']); ?>" disabled></td>
    <td>�Ѻ��ԧ</td>
    <td><input name="t_total" type="text"  size="10"  value="<?php echo number_format($rsDetailAccount['total']); ?>" disabled></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><input type="submit" name="submit" value="��ŧ" id=Button>&nbsp;<input type="button" VALUE="��͹��Ѻ" onClick="goHist(-1)"  id="Button"> 
	<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
if (window.print) {
document.write('<input type=button id=Button name=print value="������Ѻ" '
+ 'onClick="javascript:window.print()">');
}
// End -->
</script></td>
    </tr>
</table></td></tr></table>
<br>
<a href="salary_all.php">�ʹ���������</a><br>
<br>
Development By <b>Guprajag</b> CopyRight &copy; 04-2006 <b>IM Team Mayo Hospital.</b>All right reserved<br><br>
<font size="2"><a href="#closeform">�Դ˹�ҵ�ҧ</a></font></p>
<?php
  }//��ԡ������ŧ  ?>	
	</td>
    <td width="126">&nbsp;</td>
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
