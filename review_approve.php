<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
require('class_permis.inc');
$Access_right = new permiss_access();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - -  แสดงรายการคำสั่งแพทย์ - - |</title>
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
<script language="JavaScript">
<!--
function scrollit(){ 
	for (I=1; I<=2875; I++){ 	
		parent.scroll(1,I)  
	}
}                                                     
//-->
</SCRIPT>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>

</head>
<body>
<?php
if (!$_SESSION['ip_Log'] and !Check_Online(get_ip())){ //ch login
		echo "<center><h2><font color=red>ท่านไม่มีสิทธิใช้งานหน้านี้</font></h2></center>";
		session_unregister("ip_Log");
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{

$key_word=$_GET['keyword'];
 //จำนวนผู้ป่วยในวันที่เลือก
?>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr> 
          <td colspan="2" valign="top">
<span class="flist">
<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
</span>
<?php //include("header.inc"); ?>
		  </td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp;<font color="#FFFFFF">| <a href="result_chlogin.php">หน้าหลัก</a>
		   | <a href="patient_search.php">ค้นหาผู้ป่วย</a> | <a href="javascript:window.print()">พิมพ์</a> | <a href="#closeform">ปิดหน้าต่าง</a>| <a href="index.php">ออกจากระบบ</a> | <a onClick="mini()">ย่อหน้าจอ</a> | <a href="javascript:history.back(-1)">ย้อนกลับ</a> | </font>
            <Object id=miniobj type="application/x-oleobject" classid="clsid:adb880a6-d8ff-11cf-9377-00aa003b7a11" codebase="hhctrl.ocx#Version=4,72,8252,0">
              <param name="Command" value="minimize">
            </Object></td>
          <td width="108" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; 
          </td>
        </tr>
        <tr> 
          <td width="692" height="187" align="center" valign="top" bgcolor="#B1C3D9"><br> 
            <table width="680" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="620" align="center" valign="top">
				<table width="680" border="0" align="center" cellpadding="0" cellspacing="0" class="bdmain">
                    <tr bgcolor="#99CCFF"> 
                      <td height="24" colspan="2" align="center" background="img_mian/bgcolor2.gif" class="flist"> 
                        <b>Review Approve Command Doctor</b></td>
                    </tr>
                    <tr> 
                      <td width="286" valign="top"> 
                      </td>
                      <td width="332">&nbsp; </td>
                    </tr>
                    <tr>
                      <td>&nbsp; คุณคือ 
					  <?php 
					  				$Dcode=$_SESSION['Dcode'];
										$sqlDcode="select name from doctor where code='$Dcode' ";
										$resultDcode=mysql_db_query($DBName,$sqlDcode)
										or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
										$rsDcode=mysql_fetch_array($resultDcode);
									if(mysql_num_rows($resultDcode)>0){ //show name
					  				echo $_SESSION['ip_Log']."&nbsp;<b><font color=red>>></b>&nbsp;".$rsDcode["name"]. "</font><br>";}else{
					  				//echo "&nbsp;<u>ยังไม่ยืนยัน&nbsp;<font color=red>รายการคำสั่งแพทย์</u>&nbsp;จำนวน ".$no_list." รายการ</font> ดังนี้";
									echo $_SESSION['ip_Log']."<br>";}//end show name login
						?></td>
                      <td align="right">&nbsp;</td>
                    </tr>
                    <tr align="center" valign="top">
                      <td colspan="2"><?php						//review
						if(!$submit){
							print"<br><center><form mame='f_SelectReview' action='$PHP_SELF' method='get'>\n";
							print"<table width='550' border='0' cellpadding='0' cellspacing='3' bgcolor='#FFFF99'>\n";
  							print"<tr bgcolor='#FFFF00'><td colspan='7'>&nbsp;<font color='#0066FF'><b>Review approve command doctor,Press select </b></font></td></tr>\n";
  							print"<tr><td width='39' height='24'>HN:</td>\n";
							print"<td width='84'>&nbsp;<input type='text' name='hn' id='Button' size='10'></td>\n";
							print"<td width='54'>&nbsp;เดือน : </td>\n";
							print "<td width='119'>&nbsp;<select name='m_select'  id='Button'>";
							print"<option value=''>- - เลือกเดือน- -</option>";
							print"<option value='01'>->มกราคม</option><option value='02'>->กุมภาพันธ์</option><option value='03'>->มีนาคม</option>";
							print"<option value='04'>->เมษายน</option><option value='05'>->พฤษภาคม</option><option value='06'>->มิถุนายน</option>";
							print"<option value='07'>->กรกฏาคม</option><option value='08'>->สิงหาคม</option><option value='09'>->กันยายน</option>";
							print"<option value='10'>->ตุลาคม</option><option value='11'>->พฤศจิกายน</option><option value='12'>->ธันวาคม</option>";
							print"</select></td>\n";
						    print"<td width='36'>ปี :</td>\n";
						    print"<td width='94'>&nbsp;<input type='text' name='year_approve' id='Button' size='10'></td>\n";
							print"<td width='78' align='center'>&nbsp;<input type='submit' name='Send_Comment' value='Continue' id='Button'></td>\n";
  							print"</tr></table>\n";
							print"</form></center><br><br><br><br><br><br><br><br><br>";
						}
						//end review</td>
                    ?></tr>
                    <tr align="left">
                      <td colspan="2">
					  <?php 
					  echo "LoginName=".$ip_Log."<br>";
					  //$str_access="ADMIN";
					   $str_access=array("ADMIN","XML","ANC1","ABC");
					  $u_Access=$Access_right->AccessStr_User($ip_Log,$str_access,$Access_right ->Access_ForUser("$ip_Log"));
					  echo "<br>Sesult=".$u_Access;
					 if($u_Access){
					  		echo "<br>Yes";
					  }else{
					  		echo "<br>No";
					 } 
					  ?>
					  </td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp; 
                      </td>
                    </tr>
                  </table>
				</td>
              </tr>
            </table>
        </td>
          <td width="108" align="center" valign="top" bgcolor="#3399CC">&nbsp; 
          </td>
        </tr>
        <tr>
          <td height="16" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"result_chlogin.php\">รายการหลัก</a>" ?>&nbsp;|</td>
          <td height="16" valign="top" bgcolor="#3399CC">&nbsp;</td>
        </tr>
        <tr> 
          <td height="16" valign="top"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="16" valign="top">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23"><div align="center"><br>
        <br>
      </div></td>
  </tr>
</table>
<?php }//online
CloseDB(); //close connect db ?>
</body>
</html>
