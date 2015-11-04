<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - กำหนดรหัสผ่านสำหรับ Web Servive - - | </title>
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
print "<link href='css/$Theme.css' rel='stylesheet' type='text/css'>";
?>
</head>
<body><br>
<?php
$ip=get_ip();//func get ip from computer
$online=Check_Online($ip); //func check online
if (!$online){ //ch login
		if (!$_SESSION['ip_Log'] or $_SESSION['ip_Log']){
		echo "<center><h2><font color=red>ท่านไม่มีสิทธิใช้งานหน้านี้</font></h2></center>";
		session_unregister("ip_Log");
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";}
}else{
if ($submit==""){
?>
<form action="<?php $PHP_SELF; ?>" method="post" name="fsetpwd">
<table width="300" height="89" border="0" align="center" cellpadding="0" cellspacing="0" class="bdmain2">
  <tr>
    <td><table width="300" border="0" align="center" cellpadding="1" cellspacing="3">
          <tr align="center" bgcolor="#FFFFCC"> 
            <td colspan="3" class="fmenu2">กำหนดรหัสผ่านสำหรับ Web Service</td>
          </tr>
          <tr> 
            <td width="101" align="left" class="fmenu2"> &nbsp;คุณคือ</td>
            <td colspan="2">&nbsp;<?php echo $_SESSION['ip_Log'];?></td>
          </tr>
          <tr> 
            <td align="left" class="fmenu2">&nbsp;รหัสผ่าน</td>
            <td colspan="2" align="left">&nbsp; <input name="spwd" type="password" maxlength="20"  id="Txt-Field"></td>
          </tr>
          <tr> 
            <td align="left" class="fmenu2">&nbsp;ยืนยันรหัสผ่าน</td>
            <td colspan="2" align="left">&nbsp; <input name="spwd2" type="password" maxlength="20"  id="Txt-Field"></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td width="75" align="left">&nbsp; <input type="submit" name="submit"  id="Button" value="Save >>"></td>
            <td width="122" align="left">&nbsp; <input type="reset" name="reset"  id="Button" value="Cancel"></td>
          </tr>
          <tr align="left"> 
            <td colspan="3">* กำหนดรหัสผ่านให้เหมือนกับ HosXp ก็ได้</td>
          </tr>
        </table></td>
  </tr>
</table>
</form>
<?php
}else{//submit
	if ($spwd=="" or  $spwd2==""){//spwd and spwd2 empty
		print"<script>
		alert(\"กรุณากรอกข้อมูลให้ครบทุกช่อง\");
		history.go(-1);
		</script>";}else{//spwd and spwd2 empty
					if ($spwd==$spwd2){
					//call func enc passw and call function insert  pass set
					$e_user=enc_create_u(trim($_SESSION['ip_Log']));
					$e_pwd=enc_create_p(trim($spwd));$sum_u_p=$e_user."".$e_pwd;
					$link=mysql_connect($Server,$User,$Pass);
					if (!$link) //not complete
					die ("can't connect database".mysql_error());
					//connect complete
					mysql_select_db($DBName,$link) or  die("connect  Database name $DBName error");

					/*$strUp ="UPDATE opduser ";//table name in database
					$strUp.="SET passweb='$sum_u_p' ";
					$strUp.="WHERE loginname='$ip_Log' "; */
					$strUp ="INSERT INTO web_pwd(loginname,passweb) ";//table name in database
					$strUp.="VALUE ('$ip_Log','$sum_u_p') ";
					mysql_query($strUp)
					or die ("ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font></center>".mysql_error());
					echo "<center><h2>- - บันทึกข้อมูลในฐานข้อมูล เรียบร้อยแล้ว - -</h2></center>";
					session_register("ip_Log");
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=result_chlogin.php'>";
					}else{
					print"<script>
					alert(\"กรุณากรอกข้อมูลให้เหมือนกันทั้งสองช่อง\");
					history.go(-1);
					</script>";
					}//$spwd==$spwd2
		}//spwd and spwd2 empty
  }//submit
echo"<center><a href='javascript:history.back(-1)'>ย้อนกลับ</a></center>";
}//!$_SESSION['ip_Log'])
//mysql_close($link);
?>
</body>
</html>
