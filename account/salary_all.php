<?php 
session_start();
//echo $_sgetLogin;
?>
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
</HEAD>
<?php
	//protect by change user in program by online
	$ip=get_ip();
	$online=Check_Online($ip); //func check online
if(!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line
				if($online){$ip_Log=user_change($ip);}else{$ip_Log=$_SESSION['ip_Log'];}

?>
<BODY><br>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000000">
 <tr>
   <td width="100%" height="20" colspan="2" bgcolor="#FFCC00"> 
<font color="#000000">&nbsp;รายการ | <a href="../result_chlogin.php">หน้าหลัก</a> | <a href="#closeform">ปิดหน้าต่าง</a>
	 | <a href="javascript:history.back(-1)">ย้อนกลับ</a> | <a href="account_main.php">หน้าแรกระบบเงินเดือน</a> |</font></td>
 </tr>
 <tr bgcolor="#F8F8F8">
   <td height="100%" colspan="2" align="center" valign="top"><br>
   <?php 
 //echo $_GET['s_year'];
  
$sqlSalary_month="select * from detail_account  where UserID='$ip_Log' and syear='".$_GET['s_year']."' ";//salary select all
  
$sqlSalary="select sum(d.class) as class,sum(d.to_retaliate) as retaliate,sum(d.to_risk) as risk,sum(d.help_child) as hchild,
sum(d.to_treat) as treat,sum(d.rent_home) as rhome,sum(d.child_educated) as ceducate,sum(d.money_position) as mposition,
sum(d.goverment_bank) as gbank,sum(d.tax) as tax,sum(d.gpf_gratuity) as gpf_grat,sum(d.to_help_die) as hdie,sum(d.credit_saving_bank) as savebank,sum(d.life_insurance) as s_insurance,
sum(d.insurance) as insurance,sum(d.off_country) as country,sum(d.credit_car) as ccar,sum(d.valve_all) as v_all,sum(d.social_secure) as ssecure,sum(d.total) as total
from detail_account d
left outer join opduser o on o.loginname=d.UserID
where d.UserID='$ip_Log' and d.syear='".$_GET['s_year']."' group by d.syear ";//salary select sum all
//echo $_GET['s_year'];
$sqlSyear="select   distinct syear from detail_account group by  syear desc  ";//group year

?>
<form action="<?php $PHP_SELF; ?>"><table width="25%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000000">
     <tr valign="middle">
       <td width="34%" height="16" align="center" bgcolor="#CCCCCC">เลือกปี</td>
       <td width="66%" align="center" bgcolor="#FFFFFF">
         <select name='s_year' id='Txt-Field' style='color:red;background:gold'>";
	<?php
				$y=date('Y');
				$result_gyear=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				if($s_year==""){print"<option value='$y'>".($y+543)."</option>";}
					 if(mysql_num_rows($result_gyear)>0){
						for($i=0;$i<mysql_num_rows($result_gyear);$i++){
						$rs_gyear=mysql_fetch_array($result_gyear);
						print "<option value='".$rs_gyear['syear']."'>".$rs_gyear['syear']."</option>";
						}										    
					}
     ?>
	</select> 
&nbsp;
&nbsp;
<input type="submit" name="s_Submit" value="ตกลง" id="Button"></td>
      </tr></table>
	 </form><br>
<?php
 if($_GET['s_Submit']=="ตกลง"){
 		$result_msalary=ResultDB($sqlSalary_month);//echo mysql_num_rows($result);
	    $row_msalary=mysql_num_rows($result_msalary);
			 if($row_msalary==0){ //row month
			 print"<h2>ไม่มีข้อมูล</h2>";
			 }else{
			 		$result_salary=ResultDB($sqlSalary);//echo mysql_num_rows($result);
					$rs_salary=mysql_fetch_array($result_salary);
 ?>
<b>รายการของท่านในปี<?php echo "<font color='red'>".$_GET['s_year']."</font> มีจำนวน <font color='red'>".$row_msalary. "</font> รายการ"; ?></b>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000000">
  <tr valign="middle">
    <td width="4%" height="16" align="center" bgcolor="#CCCCCC">ด/ป</td>
    <td width="2%" align="center" bgcolor="#CCCCCC">ขั้น</td>
    <td width="2%" align="center" bgcolor="#CCCCCC">ช่วยฯบุตร</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">ตอบแทน</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">เสี่ยงภัย</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">ศึกษาฯบุตร</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">รักษาพยาบาล</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">&nbsp;เช่าบ้าน</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">ภาษี</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">เงินฯตำแหน่ง</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">ธ.อาคารสงเคราะห์</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">สินเชื่อออม</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">&nbsp;กบข.</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">ฌกส.</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">ประกันสังคม</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">ประกันชีวิต</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">กรรมธรรม์</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">&nbsp;ตกเบิกรวม</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">กันดาร,ไม่ทำเวช</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">สินเชื่อรถ</td>
    <td width="7%" align="center" bgcolor="#CCCCCC">รับจริง/ต่อเดือน</td>
  </tr>
  <?php
	for($i=0;$i<$row_msalary;$i++){//for
			$rs_msalary=mysql_fetch_array($result_msalary);
  ?>
  <tr bgcolor="#F8F8F8">
    <td align="center">&nbsp;<?php echo $rs_msalary['mouth']."/".$rs_msalary['syear']; ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['class']!=="0.00"){echo $rs_msalary['class'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['help_child']!=="0.00"){echo $rs_msalary['help_child'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['to_retaliate']!=="0.00"){echo $rs_msalary['to_retaliate'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['to_risk']!=="0.00"){echo $rs_msalary['to_risk'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['child_educated']!=="0.00"){echo $rs_msalary['child_educated'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['to_treat']!=="0.00"){echo $rs_msalary['to_treat'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['rent_home']!=="0.00"){echo $rs_msalary['rent_home'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['tax']!=="0.00"){echo $rs_msalary['tax'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['money_position']!=="0.00"){echo $rs_msalary['money_position'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['goverment_bank']!=="0.00"){echo $rs_msalary['goverment_bank'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['credit_saving_bank']!=="0.00"){echo $rs_msalary['credit_saving_bank'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['gpf_gratuity']!=="0.00"){echo $rs_msalary['gpf_gratuity'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['to_help_die']!=="0.00"){echo $rs_msalary['to_help_die'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['social_secure']!=="0.00"){echo $rs_msalary['social_secure'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['life_insurance']!=="0.00"){echo $rs_msalary['life_insurance'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['insurance']!=="0.00"){echo $rs_msalary['insurance'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['valve_all']!=="0.00"){echo $rs_msalary['valve_all'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['off_country']!=="0.00"){echo $rs_msalary['off_country'];}else{echo "-";} ?></td>
    <td align="center">&nbsp;<?php if($rs_msalary['credit_car']!=="0.00"){echo $rs_msalary['credit_car'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php echo $rs_msalary['total']; ?></td>
  </tr>
  <?php }//for ?>
 <tr bgcolor="#F8F8F8">
    <td align="center" bgcolor="#CCCCCC">รวม</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['class']!=="0.00"){echo $rs_salary['class'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['hchild']!=="0.00"){echo $rs_salary['hchild'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['retaliate']!=="0.00"){echo $rs_salary['retaliate'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['risk']!=="0.00"){echo $rs_salary['risk'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['ceducate']!=="0.00"){echo $rs_salary['ceducate'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['treat']!=="0.00"){echo $rs_salary['treat'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['rhome']!=="0.00"){echo $rs_salary['rhome'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['tax']!=="0.00"){echo $rs_salary['tax'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['mposition']!=="0.00"){echo $rs_salary['mposition'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['gbank']!=="0.00"){echo $rs_salary['gbank'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['savebank']!=="0.00"){echo $rs_salary['savebank'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['gpf_grat']!=="0.00"){echo $rs_salary['gpf_grat'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['hdie']!=="0.00"){echo $rs_salary['hdie'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['ssecure']!=="0.00"){echo $rs_salary['ssecure'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['s_insurance']!=="0.00"){echo $rs_salary['s_insurance'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['insurance']!=="0.00"){echo $rs_salary['insurance'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['v_all']!=="0.00"){echo $rs_salary['v_all'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['country']!=="0.00"){echo $rs_salary['country'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;<?php if($rs_salary['ccar']!=="0.00"){echo $rs_salary['ccar'];}else{echo "-";} ?></td>
    <td align="center" bgcolor="#FF3300">&nbsp;<?php if($rs_salary['total']!=="0.00"){echo $rs_salary['total'];}else{echo "-";} ?></td>
  </tr>
</table><br>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
if (window.print) {
document.write('<input type=button id=Button name=print value="พิมพ์ครับ" '
+ 'onClick="javascript:window.print()">');
}
// End -->
</script>    
 <?php	
	 }//row										    
}//submit
?>
</p>
<p>&nbsp;</p></td>
   </tr>
 <tr bgcolor="#F8F8F8">
  <td height="100%" colspan="2" valign="top">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="40" bgcolor="#FFCF00"><div align="center">
<br>ศูนย์สารสนเทศ โรงพยาบาลมายอ อ.มายอ จ.ปัตตานี <br>โทรศัพท์ : 029883655 ต่อ 168 โทรสาร : 029884027<br>PHP Programming By : กูประจักษ์  ราเหม<br>
</div><br></td>
    </tr>
</table>  </td>
  </tr>
</table>
</BODY>
<?php } ?>
</HTML>
