<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB(); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - Risk Management Report Review Detail - - |</title>
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
<SCRIPT LANGUAGE="JavaScript">
<!-- hide this script tag's contents from old browsers
function goHist(a) 
{
   history.go(a);      // Go back one.
}
//<!-- done hiding from old browsers -->
</script>

</head>
<?php
	$ip=get_ip();
	$online=Check_Online($ip); //func check online
if($online){$ip_Log=user_change($ip);}else{$ip_Log=$_SESSION['ip_Log'];}
	$aright=array("ADMIN","Risk_Review");$aright2=array("Risk_Review");
			//echo $online;
if($online){$right=access_right($ip_Log);}else{$right=$_SESSION["right"];}
if((check_right($right,$aright)!==2) and (check_right($right,$aright2)!==1)){ //check access
			//echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
			print"<br><br><center><h2>ท่านไม่สิทธ์ใช้งานหน้านี้....ครับ</h2></center><br>";
			print"<p align=center><input type='submit' value='ปิดหน้าต่าง'  id='Button' onClick='javascript:window.close();'><br><br>";
			print"Development By <b>Guprajag</b> CopyRight &copy; 04-2006 <b>IM Team Mayo Hospital.</b>All right reserved</p>";
			
}else{ //check access
if (!$ip_Log and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line
	//echo "online".$online;
?>
<body>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr> 
          <td valign="top">
<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>		  </td>
        </tr>
        <tr>
          <td height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC" class="td-left"><?php include("manu.inc"); ?></td>
        </tr>
        <tr> 
          <td height="177" align="center" valign="top" class="td-left"><br>
            <table width="700" border="0" cellpadding="0" cellspacing="0" class="bd-external">
            <tr align="center" bgcolor="#99CCFF">
              <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu">กำหนดสิทธิสำหรับการเข้าถึงระบบอุบัติการ</td>
            </tr>
            <tr>
              <td width="337" valign="top" bgcolor="#3399CC">&nbsp; คุณคือ <font color="red"><b><?php echo $ip_Log;  ?></b></font></td>
              <td width="282" bgcolor="#3399CC" align="left"></td> 
            </tr>
            <tr align="center" valign="top">
              <td colspan="2"><br>
			 <form action="<?php $PHP_SELF; ?>" method="get" name="fUserRisk">
			  <table width="400" border="0" cellspacing="1" cellpadding="2" class="bd-external">
                <tr align="center">
                  <td colspan="2" bgcolor="#319ACE"><span class="headmenu">รายละเอียดของอุบัติการ</span></td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp;รายชื่อ : </td>
                  <td bgcolor="#FFCC00">&nbsp;</td>
                </tr>
                <tr>
                  <td width="150" valign="top" bgcolor="#319ACE">&nbsp;หน่วยงานที่อนุญาติให้เข้าถึง : </td>
                  <td>&nbsp;</td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp; </td>
                  <td valign="middle" bgcolor="#FFCC00">&nbsp;</td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  </tr>
              </table></form></td>
            </tr>
            <tr>
              <td colspan="2"><!-- end สร้างกรอบตาราง --></td>
            </tr>
            <tr align="center" valign="top">
              <td colspan="2">			</td>
            </tr>
            <tr align="center">
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table><br><br><br><br></td>
        </tr>
        <tr>
          <td height="16" align="center" background="img_mian/orizontal.jpeg">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23"><p align="center">Development By <b>Guprajag</b> CopyRight &copy; 04-2006 
        <b>IM Team Mayo Hospital.</b>All right reserved
      </p></td>
  </tr>
</table>
<?php 
  }//ch online
}//check access
CloseDB(); //close connect db ?>
</body>
</html>
