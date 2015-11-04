<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - หน้าหลักสำหรับผู้ใช้งาน - -|</title>
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
//Flash and html call this function to minimize window
function mini() {
miniobj.Click();
}
</script>
</head>
<?php
$ip=get_ip();
$online=Check_Online($ip); //func check online
if (!$_SESSION["ip_Log"]){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";
}else{ //on line
		if  (($_SESSION["user_type"]=="online")  AND !Check_Onlines()){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";}
		if($online){
		$ip_online=sys_detail($ip); //call function find ip/login/com name/depart
		$ip_name=explode("#",$ip_online);
		$ip_Add=$ip_name[0];$ip_Log=$ip_name[1];$ip_comname=$ip_name[2];$ip_Depart=$ip_name[3];
		//not online but pass word complete
				}else{ //login come to system user and passweb complete
						$ip_Log=$_SESSION["ip_Log"];
						$sql="select  * from opduser  where  loginname='$ip_Log' ";
						$result=mysql_db_query($DBName,$sql)
						or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
	   					$rs=mysql_fetch_array($result); 
				}//online
?>
<body>
<table width="800" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <td height="736" valign="top"><table width="800" cellpadding="0" cellspacing="0">
        <tr valign="top"> 
          <td colspan="2">
<?php if (Check_Onlines() and $Header=="N") {} else {include("header.inc");} ?>
		  </td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif" class="menu-status">&nbsp;
		  <?php
			$n_online=num_online();
			 echo "User online in HOSxP :&nbsp; <font color=white>".$n_online."</font>&nbsp;คน"; 
			echo "&nbsp;สถานะ&nbsp;<font color=white>[ ";
			if($online){
			echo "ON Line";
			}else{
			echo "OFF Line";}
			echo " ]</font>&nbsp;ในระบบ HOSxP"; 
						?>
		  </td>
          <td width="163" align="center" valign="middle" background="img_mian/bgcolor.gif"><font color="#FFFFFF">| &nbsp;<a href="#closeform">ปิดหน้าต่าง</a>&nbsp;|&nbsp;<a href="index.php">ออกจากระบบ</a>&nbsp;|</font>
			  <Object id=miniobj type="application/x-oleobject" classid="clsid:adb880a6-d8ff-11cf-9377-00aa003b7a11" codebase="hhctrl.ocx#Version=4,72,8252,0">
<param name="Command" value="minimize">
</Object> </td>
        </tr>
        <tr> 
          <td width="637" height="187" valign="top" class="td-left"><div align="center"> 
              <p>&nbsp;</p>
              <table width="600" height="656" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                <tr>
                  <td height="16" align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td height="16" align="left"><table cellpadding="0" cellspacing="0">
                    <tbody>
                      <tr>
                        <td width="10"></td>
                        <td style="padding-top: 12px;" onmouseover="this.style.cursor = 'hand'" title="Windows" align="center" background="img_mian/bg_menu_on.gif" height="33" valign="top" width="117"> <strong><font color="#000000">เมนูหลัก</font></strong></td>
                        <td width="10"></td>
                        <td style="padding-top: 12px;" onmouseover="this.style.cursor = 'hand'" title="Mac" align="center" background="img_mian/bg_menu_off.gif" height="33" valign="top" width="120"> สอบถามข้อมูล </td>
                        <td width="10"></td>
                        <td style="padding-top: 12px;" onmouseover="this.style.cursor = 'hand'" title="Linux" align="center" background="img_mian/bg_menu_off.gif" height="33" valign="top" width="120"> รายงานต่างๆ</td>
                        <td width="10"></td>
                        <td style="padding-top: 12px;" onmouseover="this.style.cursor = 'hand'" title="PDA/Mobile" align="center" background="img_mian/bg_menu_off.gif" height="33" valign="top" width="120">System</td>
                      </tr>
                      <tr>
                        <td width="10"></td>
                        <td bgcolor="#ffbb03" height="1"></td>
                        <td width="10"></td>
                        <td bgcolor="#ffffff" height="1"></td>
                        <td width="10"></td>
                        <td bgcolor="#ffffff" height="1"></td>
                        <td width="10"></td>
                        <td bgcolor="#ffffff" height="1"></td>
                      </tr>
                    </tbody>
                  </table></td>
                </tr>
                <tr>
                  <td height="498" align="right"><table width="590" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="18" colspan="2" align="left" bgcolor="#FFBE00"><strong> &nbsp;<font color="#FFFFFF"> ยินดีต้อนรับ คุณ</font><font color="#FFFFFF">&nbsp;</font><font color="red"> <?php echo $ip_Log;?></font></strong>                        </td>
                      </tr>
                    <tr>
                      <td width="192" height="58" align="left" background="img_mian/login.jpeg" class="headtable">&nbsp;<img src="img_mian/icon12.gif" width="22" height="16" align="absmiddle">สอบถามข้อมูล</td>
                      <td width="398" align="left">&nbsp;
                        </td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> <a href="patient_search.php">ค้นหาผู้ป่วย</a></td>
                      <td class="headtable">&nbsp; <img src="img_mian/blank.gif" width="14" height="18" align="absmiddle"> News </td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> <a href="patient_in_department_count.php">สรุปข้อมูลประจำวัน</a></td>
                      <td rowspan="8" align="left" valign="top">
					  <?php
				  	//call check login for  passweb empty
					$empty_pass=empty_passweb2($ip_Log);
					if (!$empty_pass){ //ยังไม่กำหนด check passweb empty 
					echo "&nbsp;<font color=red>ยังไม่กำหนดรหัสผ่านสำหรับการเข้าใช้งาน Web Service</font>";
					}
				  		//call check login for  passweb empty
					if (!$empty_pass and !$online){ //ยังไม่กำหนด check passweb empty 
					echo "&nbsp;<font color=red>ท่านจะต้อง Login เข้าสู่ระบบ HoSxP กำหนดรหัสผ่าน ครับ</font>";
					}
				  		//call check login for  passweb empty
					if (!$empty_pass and $online){ //ยังไม่กำหนด check passweb empty 
					echo "&nbsp;>>&nbsp;<font color=red><a href=set_pweb.php>กำหนดรหัสผ่าน</a></font>";
					}
				  	//call check login for  command_doctor
						//$sql="select  doctorcode from opduser  where loginname='$ip_Log' ";
						$Dcode=cmdDoctor_code($ip_Log);//echo $Dcode;
						//find command_doctor='$Dcode' and Approve=''  from code in command_doctor in ovst table
						//$sql_chCom_doc="select * from ovst where  (vstdate >'2005-10-01') and command_doctor='$Dcode'  and (Approve_Doctor ='' or Approve_Doctor is null) ";
						$sql_chCom_doc="select count(*) as total from ovst where  (vstdate >'2005-10-01') and command_doctor='$Dcode' ";
						$result_chCom_doc=ResultDB($sql_chCom_doc);
	   					$rs_chCom_doc=mysql_fetch_array($result_chCom_doc); 
						if($rs_chCom_doc['total']>0){
								$sqlApprComplete="select count(*) as total2 from approve_doctor where  command_doctor='$Dcode' and (vstdate >'2005-10-01') ";
								$resultApprComplete=ResultDB($sqlApprComplete);
	   							$rsApprComplete=mysql_fetch_array($resultApprComplete);//echo $rsApprComplete['total2'];
								
							echo "&nbsp;<b><font color=red>>></b>&nbsp;<u>ยังไม่ยืนยัน&nbsp;<font color=red>รายการคำสั่งแพทย์</u>&nbsp;จำนวน ".($rs_chCom_doc['total']-$rsApprComplete['total2'])." รายการ</font>";
							session_register('Dcode');
							echo "&nbsp;->&nbsp;<b><font color=red><a href=command_doc.php?Dcode=$Dcode>ทำรายการ</a></font>";
						} 
						 //end  check login for  command_doctor
						 print "&nbsp;&nbsp;<font size='2' color='green'><b>ระบบสารสนเทศของโรงพยาบาล (ระบบอินทราเน็ต)</b></font>&nbsp;&nbsp;<a href='http://192.168.3.222/cpg/index.php' target='_blank'>คลิกที่นี่</a><br>&nbsp;&nbsp;<font  color='yellow'>มีบทความมาใหม่น่าสนใจ เช่น <b><u>ทำเมลล์ 2 MB ของ Hotmail ให้เป็น 250 MB</u></b> ครับ</font>";
				  ?></td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> สอบถามผลตรวจทางห้องปฏิบัติการ</td>
                      </tr>
                    <tr>
                      <td align="left" bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> สรุปข้อมูลในฐานข้อมูล</td>
                      </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> <a href="pttype_service.php">ค้นหา OPD Card</a> </td>
                      </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"><a href="icdsearch.php"> ค้นหารหัส icd10</a> </td>
                      </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"><a href="hipdata.php"> HIP DATA</a> </td>
                      </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFFFFF"></td>
                      </tr>
                    <tr>
                      <td height="58" align="left" background="img_mian/login.jpeg" class="headtable">&nbsp;<img src="img_mian/icon12.gif" width="22" height="16" align="absmiddle">ระบบงาน Online</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> ระบบจองห้องพิเศษ                        </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> สรุปข้อมูลในฐานข้อมูล                        </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#FFBE00">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="58" align="left" background="img_mian/login.jpeg" class="headtable">&nbsp;<img src="img_mian/icon12.gif" width="22" height="16" align="absmiddle">&nbsp;อื่นๆ</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> HOSxP Roadmap</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp; &nbsp;<img src="img_mian/collapsed.gif" width="5" height="5">&nbsp;<a href="account/account_main.php">ระบบเงินเดือน</a></td>
                      <td>&nbsp;</td>
                    </tr>
					<tr>
                      <td bgcolor="#FFBE00">&nbsp; &nbsp;<img src="img_mian/collapsed.gif" width="5" height="5">&nbsp;<a href="risk_report_form.php">Risk Management Report </a></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="58" align="left" background="img_mian/login.jpeg" class="headtable">&nbsp;<img src="img_mian/icon12.gif" width="22" height="16" align="absmiddle">รายงาน</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> ผู้ป่วยความดันโลหิตสูง </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> <a href="report_in_department_lr.php">ยอดผู้รับบริการคลอด</a></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> <a href="report_in_department_social_opd.php">ประกันสังคมผู้ป่วยนอก</a></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> <a href="report_in_department_social_ipd.php">ประกันสังคมผู้ป่วยใน</a></td>
                      <td>&nbsp;</td>
                    </tr>
				    <tr>
                      <td bgcolor="#FFBE00"> &nbsp; &nbsp;<img src="img_mian/collapsed.gif" width="5" height="5">&nbsp;<a href="report_in_department_den.php">ประกันสังคมทันตกรรม</a></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp; &nbsp;<img src="img_mian/collapsed.gif" width="5" height="5">&nbsp;<a href="report_in_department_social_anc_out.php">ประกันสังคม ANC ผู้ป่วยนอก</a></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp; &nbsp;<img src="img_mian/collapsed.gif" width="5" height="5">&nbsp;<a href="report_in_department_social_anc_in.php">ประกันสังคม ANC ผู้ป่วยใน</a></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="58" align="left" background="img_mian/login.jpeg" class="headtable">&nbsp;<img src="img_mian/icon12.gif" width="22" height="16" align="absmiddle">System</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#FFBE00">
				<?php
					if(check_right($_SESSION["right"],"ADMIN")){
				  		echo "&nbsp;&nbsp;&nbsp;<img src=\"img_mian/collapsed.gif\" width=5 height=5>&nbsp;<a href=\"webconf.php\">Setting</a>";
					 }//cc
				  ?>
					  </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> Current Activity</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#FFBE00">&nbsp;&nbsp;&nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> <a href="system_onlineuser.php">Current Online User</a></td>
                      <td>&nbsp;</td>
                    </tr>
                    <?php 
					if(check_right($_SESSION["right"],"ADMIN")){
					//$permission="admin";
					//session_register("permission");
					echo"<tr><td align='left' bgcolor='#FFBE00'>\n";
				  		echo "&nbsp;&nbsp;&nbsp;<img src=\"img_mian/collapsed.gif\" width=5 height=5>&nbsp;<a href=\"managment_user.php\">Management User</a>";
                    echo"</td><td>&nbsp;</td></tr>\n";
					 }//cc
				  ?>
                    <tr>
                      <td bgcolor="#FFBE00" align="left">&nbsp; &nbsp;<img src="img_mian/collapsed.gif" width="5" height="5"> <a href="user_command_view.php">Review Command Doctor</a></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFBE00">
				<?php 
				//sql check user loginname and password in web_ table
				$sql="select count(*) as cc from web_pwd where loginname='$ip_Log' ";
				$result=ResultDB($sql);$rs=mysql_fetch_array($result);
				if($rs['cc']<>0){
				  		echo "&nbsp;&nbsp;&nbsp;<img src=\"img_mian/collapsed.gif\" width=5 height=5>&nbsp;<a href=\"fchange_pwd.php\">Change Password</a>";
				}else{echo "&nbsp;&nbsp;&nbsp;<img src=\"img_mian/collapsed.gif\" width=5 height=5>&nbsp;Change Password";}//cc
				  ?>
					  </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFBE00">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="29" background="img_mian/c3.jpeg"><span class="headtable"><img src="img_mian/icon12.gif" width="22" height="16" align="absmiddle"><a href="about.php">About As </a></span></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr align="center">
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr align="center" background="img_mian/orizontal.jpeg">
                      <td colspan="2">&nbsp;</td>
                      </tr>
                  </table></td>
                </tr>
              </table>
              
			  <?php print"<p><b><font color='green'>Programming &amp; Development &amp; Design By ::<br>นพ.อรัญ&nbsp; รอกา<br>นายกูประจักษ์&nbsp; ราเหม</font></b></p>"; ?><br>
          </div></td>
          <td width="163" valign="top" class="td-right" align="left"> 
            <?php
		  echo "&nbsp;<center><b>HOS<font color=#FF6600>xP</font>&nbsp;Web Service</b><br>";
		  echo "&nbsp;<b>::&nbsp;<u>ข้อมูลของคุณ</u>&nbsp;::</b></center>";
		  //select full name
  						$sql2="select  * from opduser  where  loginname='$ip_Log' ";
						$result2=mysql_db_query($DBName,$sql2)
						or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
	   					$rs2=mysql_fetch_array($result2); 
		  echo "&nbsp;<b>User :</b>&nbsp;<font color=#FFFFFF>&nbsp;&nbsp;".$ip_Log."</font><br>"."&nbsp;<b>Full Name :</b><br>&nbsp;<font color=#FFFFFF>&nbsp;&nbsp;".$rs2["name"]."</font>";
		  echo "<br>&nbsp;<b>IP Address :</b><br>&nbsp;";
		  echo "<font color=#FFFFFF>&nbsp;&nbsp;";
		  if (!$ip_Add){
		  echo $ip."</font>";
		  }else{echo $ip_Add."</font>";}
		  echo "<br>&nbsp;<b>Computer Name :</b><br>&nbsp;";
		  echo "<font color=#FFFFFF>";
		  if (!$ip_comname){  
		  echo"&nbsp;&nbsp;-"."</font>";
		  }else{echo $ip_comname."</font>";}
		  if (!$ip_Depart){ 
		  echo "<br>&nbsp;<b>Position :</b><br>&nbsp;<font color=#FFFFFF>&nbsp;&nbsp;".$rs["entryposition"]."</font><hr>";
		  }else{
		  echo "<br>&nbsp;<b>Department :</b><br>&nbsp;<font color=#FFFFFF>".$ip_Depart."</font><hr>";
		  }
			?>
          </td>
        </tr>
        <tr> 
          <td height="16" align="center" background="img_mian/bgcolor.gif" bgcolor="#B1C3D9"> 
		  <font color="#FFFFFF">| &nbsp;<a href="#closeform">ปิดหน้าต่าง</a>&nbsp;|&nbsp;<a href="index.php">ออกจากระบบ</a>&nbsp;|</font>
		  </td>
          <td height="16" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp;</td>
        </tr>
        <tr valign="top"> 
          <td height="36"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="36">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23"><div align="center"><br>
        <br>
      </div></td>
  </tr>
</table>
</body>
<?php 
 } //check
?>
</html>