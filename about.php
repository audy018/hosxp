<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - เกี่ยวกับ HOSxP  Web Service - - |</title>
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
<body>
<table width="800" cellpadding="0" cellspacing="0"  class="table">
  <tr>
    <td colspan="2" valign="top">
      <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
  </td>
  </tr>
  <tr>
    <td height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp;<font color="#FFFFFF">| <a href="result_chlogin.php">หน้าหลัก</a> | <a href="patient_search.php">ค้นหาผู้ป่วย</a> | <a href="javascript:window.print()">พิมพ์</a> | <a href="#closeform">ปิดหน้าต่าง</a>| <a href="index.php">ออกจากระบบ</a> | <a onClick="mini()">ย่อหน้าจอ</a> | <a href="javascript:history.back(-1)">ย้อนกลับ</a> | </font>
        <Object id=miniobj type="application/x-oleobject" classid="clsid:adb880a6-d8ff-11cf-9377-00aa003b7a11" codebase="hhctrl.ocx#Version=4,72,8252,0">
          <param name="Command" value="minimize">
      </Object></td>
    <td width="108" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp;</td>
  </tr>
  <tr>
    <td width="692" height="16" align="center" valign="top" class="td-left"><br>
	<iframe align="middle" frameborder="1" scrolling="auto" id="Txt-Field" src="about_as.php" width="400" height="450"></iframe><br><br>
            </td>
    <td width="108" align="center" valign="top" class="td-right">&nbsp;</td>
  </tr>
  <tr>
    <td height="16" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"result_chlogin.php\">รายการหลัก</a>" ?>&nbsp;|</td>
    <td height="16" valign="top" class="td-right">&nbsp;</td>
  </tr>
  <tr>
    <td height="16" valign="top"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
    <td height="16" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
