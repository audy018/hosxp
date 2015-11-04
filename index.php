<?php
session_start();
session_unregister("ip_Log");
session_unregister("user_type");session_unregister("permission");
session_unregister("Hospname");session_unregister("Hospcode");
session_unregister("Header");
session_unregister("Theme");session_unregister("Nhsouser");
session_unregister("Nhsopass");session_unregister("act");
session_unregister("Right");
session_unregister("pass_verify"); //ทำลาย session เข้าระบบห้องยา

include("phpconf.php");
include("func.php");
conDB(); //connect db
//call function check  crete table  table in db

webconf(); //config web
tb_approve();//web approve doctor
tb_webpwd();//web passpord
tb_user_account();//create table account user
tb_detail_account(); //create table account user detail
create_riskreport_web();//create  table risk_report_web
create_level_err();//create  table level_error
create_medication_err();//create  table medication_error
create_risk_access();//create  table risk _user_Access
addField_riskcause();//add filed in risk table web
risk_cause(); //risk cause
risk_type(); //risk type
risk_cmanage();//risk_manage 
risk_typelist1();risk_typelist2();//risk type list

//call function web_conf table
$info_set_session=webconfig_session();
list($Hospname,$Hospcode,$Header,$Theme,$Nhsouser,$Nhsopass)=$info_set_session; //list session
//session web_conf  table

if (!session_is_registered("Hospname")) session_register("Hospname");
if (!session_is_registered("Hospcode")) session_register("Hospcode");  
if (!session_is_registered("Header")) session_register("Header"); 
if (!session_is_registered("Theme")) session_register("Theme"); 
if (!session_is_registered("Nhsouser")) session_register("Nhsouser"); 
if (!session_is_registered("Nhsopass")) session_register("Nhsopass"); 

$sendpage=$_GET["sendpage"];
//end call function web_con table
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  |</title>
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
<?php
//call function check  web_pwd table and approve_doctor table
//if(ch_f() and ChFieldApprove()){	//call function check table and create

$ip=get_ip();//func get ip from computer
$online=Check_Online($ip); //func check online


if ($online){ //online or offline
$user_type="online";
//echo "On line";
	//if online and check passweb for empty?y/n
		$ip_online=sys_detail($ip); //call function find ip/login/com name/depart
	//ตัดค่าที่รับมาจากฟังก์ชัน
		$ip_name=explode("#",$ip_online);
		$ip_Add=$ip_name[0];$ip_Log=$ip_name[1];$ip_comname=$ip_name[2];$ip_Depart=$ip_name[3];
		$right=access_right($ip_Log);
		session_register("ip_Log","user_type","right");
		if($sendpage<>""){echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=$sendpage'>";}else{
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=result_chlogin.php'>";}
}else{ //off line
//echo "Off-Line";
//แสดงฟอร์มข้างล่าง
?>
<table width="800" border="0" cellspacing="0" cellpadding="0" id="table">
  <tr>
    <td width="813" height="434" valign="top"><table width="800" cellpadding="0" cellspacing="0" class="bd-external">
        <tr valign="top"> 
          <td colspan="3"><table width="800" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="250" valign="top"><img src="img_mian/b_left3.jpg" width="250" height="91"></td>
                <td width="550" align="center"><img src="img_mian/b_right.jpg" width="550" height="91"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="28" colspan="2" valign="middle" background="img_mian/bgcolor2.gif" class="menu-status">&nbsp; 
            <?php
			$n_online=num_online();
			 echo "User online HOSxP : <u>".$n_online."</u> คน "; 
            echo ",IP Address is : <u>".$ip."</u> ";
			echo "สถานะ <font color=white>[ OFF Line ]</font> ในระบบ HOSxP"; 
			?>
          </td>
          <td width="161" align="center" valign="middle" background="img_mian/bgcolor2.gif" bgcolor="#009AFF" class="headmenu"> &nbsp;<img src="img_mian/blank.gif" width="14" height="18" align="absmiddle"> ประกาศ </td>
        </tr>
        <tr> 
          <td width="112" height="187" align="right" valign="top">&nbsp;</td>
          <td width="527" align="center" valign="top"><br>
            <br>
            <br>
              <?php 
			  flogin($sendpage); 
			  ?>
            <br>
            <br>
            <br><center>| <a href="#closeform">ปิดหน้าต่าง</a> | <a href="about.php">About</a> |</center>
            <br>
            <br>
          </td>
          <td width="155" align="center" valign="top" class="td-right">
		  <table border="0" align="center" cellpadding="0" cellspacing="0" class="bd-internal">
            <tr>
              <td width="145" align="left" valign="top"><font color="#FFFFFF"><marquee width="150" behavior="scroll" direction="up" onMouseOut="this.start()" onMouseOver="this.stop()" height="237" scrolldelay="150">
&nbsp;&nbsp;&nbsp; ....ผู้ใช้โปรแกรมท่านใด ยังไม่ได้ ้กำหนด รหัสผ่านสำหรับการใช้งาน Web Service ให้ท่าน Login เข้าสู่โปรแกรม HOSxP ท่านจึงจะสามารถกำหนดรหัสผ่านได้ด้วยตัวเอง
              </marquee></font></td>
            </tr>
          </table></td>
        </tr>
        <tr valign="top"> 
          <td height="48" colspan="2" align="center" class="detail-text2"><hr>
            Copyright &reg; 2010 HOSxP Web Service Version 1.0beta By PHP Development 
            All rights reserved<br>
            ติดต่อเรา : <span class="detail-text1">ศูนย์สารสนเทศ โรงพยาบาลละแม  อ.ละแม จ.ชุมพร</span><br>
            TEL : 077-559116 ต่อ 115<br>
          e-mail : <a href="mailto:man_guitarsolo@hotmail.com">man_guitarsolo@hotmail.com</a>
          <br></td>
          <td height="48" class="td-right" valign="top"><br><div align="center"><img src="img_mian/logo.gif" width="150" height="42"></div></td>
        </tr>
        <tr valign="top"> 
          <td height="37" colspan="2">&nbsp;</td>
          <td height="37" class="td-right">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr> 
    <td height="23"><div align="center"><br>
        <br>
      </div></td>
  </tr>
</table>
<?php } //$online 
 CloseDB();  
?>
</body>
</html>
