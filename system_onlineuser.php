<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - User Online in System - - |</title>
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
if ($_GET['id1']<>""){
  $id1=$_GET['id1'];}else{
 $id1=date("d-m-Y");
 }
 //จำนวนผู้ป่วยในวันที่เลือก
$d_conv=explode("-",$id1);$d=$d_conv[0];$m=$d_conv[1];$y=$d_conv[2];
$d_conv_search="$y-$m-$d";//}else{ $d_conv_search=$d_conv_search; }
?>
<table width="800" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr> 
          <td colspan="2" valign="top">
<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
		  </td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp;<font color="#FFFFFF">| <a href="result_chlogin.php">หน้าหลัก</a> | <a href="patient_search.php">ค้นหาผู้ป่วย</a> | <a href="javascript:window.print()">พิมพ์</a> | <a href="#closeform">ปิดหน้าต่าง</a>| <a href="index.php">ออกจากระบบ</a> | <a onClick="mini()">ย่อหน้าจอ</a> | <a href="javascript:history.back(-1)">ย้อนกลับ</a> | </font>
            </td>
          <td width="76" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; 
          </td>
        </tr>
        <tr> 
          <td width="722" height="187" align="center" valign="top" class="td-left2"><br>
            <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
            <tr bgcolor="#99CCFF">
              <td height="24" colspan="2" align="center" background="img_mian/bgcolor2.gif" class="headmenu"> Current Online User&nbsp;</td>
            </tr>
            <tr>
              <td width="339" valign="top"><!--<form method="get" action="<?php //echo $PHP_SELF; ?>">
                            &nbsp;&nbsp;เลือกวันที่ .. 
                            <input name="id1" type="text" value="<?php //echo $id1; ?>" size="15"/>
                            <input type="button" onClick="c1.innerpopup('id1','calendar_frame');" value="..."/>
                            <input type="submit" value="Refresh">
                          </form>
						  -->
              </td>
              <td width="281"><a name="top"></a> </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="top">&nbsp;&nbsp;<b>List of current online user&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> </td>
              <td valign="top"><form method="post" action="<?php echo $PHP_SELF; ?>">
                  <input name="submit" type="submit" value="REFRESH" id="Button">
              </form></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;
                  <?php 
						//นำข้อมูลมาแสดงในตาราง
											$sql_online="select * from onlineuser order by ksklogintime ";
											$result_online=mysql_db_query($DBName,$sql_online)
											or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
											$num_rows_online= mysql_num_rows($result_online);
											echo "<center>";
										if ($num_rows_online<>0){
											echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนผู้ Online ในระบบ : <font color=red><b>".$num_rows_online."</b></font>&nbsp;คน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
											if ($num_rows_online>20){ //ลูกศรเลื่อนลง
											echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
											echo "<a href=#below><img src=\"img_mian/arow_bl.gif\" width=13 height=9 border=0></a>&nbsp;ด้านล่าง";
											}//ลูกศร
											echo "</center>";
										$bg="#B1C3D9";
										?>
                  <table width="680" border="0" align="center" cellpadding="0" cellspacing="0">
                    <!-- สร้างกรอบตาราง -->
                    <tr class="headtable">
                      <td width="9" height="16" align="right" valign="top"><img src="img_mian/c_t_left.gif" width="8" height="16"></td>
                      <td width="39" background="img_mian/bgcolor2.gif" bgcolor="#3399CC" align="center">ลำดับ</td>
                      <td width="127" background="img_mian/bgcolor2.gif" align="left">&nbsp;&nbsp;USER</td>
                      <td width="95" background="img_mian/bgcolor2.gif"  align="left">&nbsp;&nbsp;HOST</td>
                      <td width="86" background="img_mian/bgcolor2.gif" align="left">&nbsp;&nbsp;Computer </td>
                      <td width="122" background="img_mian/bgcolor2.gif" align="left">&nbsp;&nbsp;&nbsp;แผนก</td>
                      <td width="68" background="img_mian/bgcolor2.gif" align="center">Version</td>
                      <td width="126" background="img_mian/bgcolor2.gif" align="center">เวลาเข้าระบบ</td>
                      <td width="8" align="left" bgcolor="#3399CC"><img src="img_mian/c_t_r.gif" width="8" height="16"></td>
                    </tr>
                    <tr class="text-intable">
                      <td height="16" colspan="9" align="center"><!-- สร้างตารางกรอบใน เพื่อแสดงข้อมูล -->
                          <table width="680" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                            <?php
					$i=0;
			 		while($i<$num_rows_online){
					$rs_online=mysql_fetch_array($result_online); 
					$n_online=$rs_online["kskloginname"];//ชื่อผู้ใช้ที่ login
											$sql_online_n="select name from opduser where loginname='$n_online' "; //ค้นจากชื่อผู้ใช้ที่ login
											$result_online_n=mysql_db_query($DBName,$sql_online_n)
											or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
											$rs_online_n=mysql_fetch_array($result_online_n); 
											//end sql string sql_online_n
					if ($bg=="#B1C3D9") { //color
					$bg="#FFFFFF";
					//$bgm="";
					}else{
					$bg="#B1C3D9";
					//$bgm="img_mian/bgcolor.gif";
					} //color
					?>
                            <tr bgcolor="<?php echo $bg; ?>" height="16">
                              <td width="47" align="center" background="<?php //echo $bgm;?>"><?php echo $i+1; ?></td>
                              <td width="127" align="left" background="<?php //echo $bgm;?>">&nbsp;<?php echo $rs_online_n["name"];?></td>
                              <td width="94" align="left" background="<?php //echo $bgm;?>">&nbsp;<?php echo $rs_online["computername"]; ?></td>
                              <td width="86" align="left" background="<?php //echo $bgm;?>">&nbsp;&nbsp;<?php echo $rs_online["servername"]; ?></td>
                              <td width="126" align="left" background="<?php //echo $bgm;?>">&nbsp; <?php echo $rs_online["department"];  ?></td>
                              <td width="66" align="center" background="<?php //echo $bgm;?>"><?php echo $rs_online["client_version"]; ?></td>
                              <td width="134" align="left" background="<?php //echo $bgm;?>">&nbsp;
                                  <?php 
								  echo FormatDate(substr($rs_online["ksklogintime"],0,10))." ".substr($rs_online["ksklogintime"],11,10); 
 								 ?>
                              </td>
                            </tr>
                            <?php
	        	$i++;//$a++;
		    	}//while  ?>
                          </table>
                          <!-- end table show data -->
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="bottom"><img src="img_mian/c_l_left.gif" width="8" height="16"></td>
                      <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                      <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                      <td colspan="3" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                      <td valign="bottom" background="img_mian/bgcolor2.gif" bgcolor="#3399CC"><div align="right"></div></td>
                      <td valign="bottom" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                      <td align="left" valign="bottom" bgcolor="#3399CC"><img src="img_mian/c_l_r.gif" width="8" height="16"></td>
                    </tr>
                  </table>
                  <!-- end สร้างกรอบตาราง -->
                  <?php
						  			if ($num_rows_online<10){ echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";}
			}else{  //row=0
			$row="n";
			echo"<center>ผลการค้นหา : ไม่มีข้อมูลของวันที่&nbsp;<font color=red><u>".dateThai($d_conv_search)."</u></font>&nbsp;ในฐานข้อมูล<center>";
			echo "<br><br><br><br><br><br><br><br><br><br>";
		}//row=0
		?>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><a name="below"></a>
                  <?php
					  						if ($num_rows_online>20){ //ลูกศรเลื่อนลง
											echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
											echo "<a href=#top><img src=\"img_mian/arow_t.gif\" width=13 height=9 border=0></a>&nbsp;ด้านบน";
											}//ลูกศร
					  ?>
              </td>
            </tr>
          </table>
            <div align="center"><br> 
          </td>
          <td width="76" align="center" valign="top" class="td-right">&nbsp; 
          </td>
        </tr>
        <tr>
          <td height="16" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"result_chlogin.php\">รายการหลัก</a>" ?>&nbsp;|</td>
          <td height="16" valign="top" class="td-right">&nbsp;</td>
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
