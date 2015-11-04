<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ยืนยันคำสั่งแพทย์ - - |</title>
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
                        <b>Approve Command Doctor</b></td>
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
										$resultDcode=ResultDB($sqlDcode);
										//$resultDcode=mysql_db_query($DBName,$sqlDcode)
										//or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
										$rsDcode=mysql_fetch_array($resultDcode);

					  				echo $_SESSION['ip_Log']."&nbsp;<b><font color=red>>></b>&nbsp;".$rsDcode["name"]. "</font><br>";
						?></td>
                      <td align="right">&nbsp;</td>
                    </tr>
                    <tr align="center" valign="bottom">
                      <td colspan="2">
					  <?php  //#---------------start
		if(!$submit and $Send_Comment!=="Continue"){ //submit done button
						 $sqlList_commandDoc="select *,MONTH(vstdate) as Month,MONTHNAME(vstdate) as month, (YEAR(vstdate)+543) as year,YEAR(vstdate) as Year,count(*) as total ";
						 $sqlList_commandDoc.="from ovst where (vstdate >'2005-10-01') and command_doctor='$Dcode'  and (Approve_Doctor  is not null ) ";
						 $sqlList_commandDoc.="group by month,year order by year,MONTH(vstdate) DESC ";
										$resultList_commandDoc=mysql_db_query($DBName,$sqlList_commandDoc)
										or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
										$nList_commandDoc=mysql_num_rows($resultList_commandDoc);//echo $nList_commandDoc;
										echo "&nbsp;&nbsp;<b>ยังไม่ยืนยัน&nbsp;รายการคำสั่งแพทย์&nbsp;ดังรายการต่อไปนี้</b>"; 
										//$rsDcode=mysql_fetch_array($resultList_commandDoc);
						?>
						<br>
							<table width="355" border="0" align="center" cellpadding="0" cellspacing="0" class="flist">
 							 <tr bgcolor="#3399CC" background="img_mian/bgcolor2.gif">
    						<td width="35" height="20" align="center">ลำดับ</td>
    						<td width="82" height="20" align="center">เดือน</td>
    						<td width="46" height="20" align="center">ปี</td>
    						<td width="86" height="20" align="center">จำนวนรายการ</td>
    						<td width="94" height="20" align="center">ทำรายการ</td>
							</tr>
  						<?php
									$i=0;
									while($i< mysql_num_rows($resultList_commandDoc)){  //while
									$rsList_commandDoc=mysql_fetch_array($resultList_commandDoc);
						?>
  						<tr>
    					<td width="35" height="20" align="center" valign="middle"><?php echo ($i+1); ?></td>
    					<td width="82" align="left" valign="middle">&nbsp;
						<?php 
						//echo $rsList_commandDoc["Month"];  number of month //echo $rsList_commandDoc["nonth"];  name of month
						//call function number of month change is name month
						echo change_month_isThai($rsList_commandDoc["Month"]);
						$month_year=$rsList_commandDoc["Year"]."-".$rsList_commandDoc["Month"]."#".$rsList_commandDoc["Year"]."-0".$rsList_commandDoc["Month"];//echo $month_year;
						?></td>
    					<td width="46" align="center" valign="middle"><?php echo $rsList_commandDoc["year"]; ?></td>
    					<td width="86" align="center" valign="middle"><?php echo $rsList_commandDoc["total"]; ?></td>
    					<td width="94" align="center">
						<?php
						print"<br><form method='get' action='$PHP_SELF'>";
						print"<input type='submit' name='submit'  id='Button' value='Done'>";
                        print"<input type='hidden' name='submit_hidden' value='$month_year'>";
						print"</form>";
						?>
						</td>
  						</tr>
						<?php		$i++;
								}//while
							?>
					</table>
				<?php 
				}elseif($submit=="Done" and $submit_hidden and $Send_Comment!=="Continue"){//else submit
					//echo "Enter Done";
					$month_year=$_REQUEST['submit_hidden'];//echo $month_year;
					$M_Y=explode("#",$month_year);
					$n_y1=$M_Y[0];$n_y2=$M_Y[1];//echo $n_y1.$n_y2;
					//if($submit_hidden){ //1//submit->done and $submit_hidden->$month_year
					$sqlM_Y="select * from ovst where  command_doctor='$Dcode' and (Approve_Doctor is not null) ";
					$sqlM_Y.="and (vstdate like '$n_y1%' or vstdate like '$n_y2%' ) order by vn";
								$resultM_Y=mysql_db_query($DBName,$sqlM_Y)
								or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
					?>
					<br>
							<table width="550" border="0" align="center" cellpadding="0" cellspacing="0" class="flist">
 							 <tr bgcolor="#3399CC" background="img_mian/bgcolor2.gif">
    						<td width="45" height="20" align="center">ลำดับ</td>
    						<td width="119" height="20" align="center">VN >></td>
    						<td width="71" height="20" align="center">HN >></td>
    						<td width="172" height="20" align="center">ชื่อ-สกุล</td>
							<td width="131" height="20" align="center">Approve</td>
    						<td width="131" height="20" align="center">วัน/เดือน/ปี</td>
							</tr>
						<?php
						//show list name
								$i=0;
								while($i< mysql_num_rows($resultM_Y)){//while list
								$rsM_Y=mysql_fetch_array($resultM_Y); ?>
								    <td width="45" align="center" valign="middle"><?php echo ($i+1); ?></td>
    								<td width="119" align="center" valign="middle"><?php echo $rsM_Y["vn"];$vn=$rsM_Y["vn"]; ?></td>
    								<td width="71" align="center" valign="middle"><?php echo $rsM_Y["hn"];$hn=$rsM_Y["hn"]; ?></td>
    								<td width="172" align="left" valign="middle"> &nbsp;
									<?php 
									//echo $rsM_Y["hn"]; 
									$get_Name_Addr=Serch_datafrom_hn($rsM_Y['hn']);
									$pmr=explode("|",$get_Name_Addr);$keyword=$pmr[0]; //แยกค่าตัวแปรที่รับมาจาก fuc ด้วย | เพื่อตัดเอาแค่ชื่อ
									print "<a href='patient_medication_record.php?vn=$vn&hn=$hn&keyword=$keyword&submit=Approve'>$keyword</a>";
									?>
									</td>
									<td width="131" align="center"><?php  if ($rsM_Y['Approve_Doctor']=='Y'){echo "<font color=green>".$rsM_Y['Approve_Doctor']."</font>";}else{echo "<font color=red>".$rsM_Y['Approve_Doctor']."</font>";} ?></td>
    								<td width="131" align="center"><?php echo dateThai($rsM_Y['vstdate']); ?></td>
  									</tr>
									<?php
											$i++;
										}//while list
									?>
					</table>
				<?php
						//}//1//
	} //end
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
