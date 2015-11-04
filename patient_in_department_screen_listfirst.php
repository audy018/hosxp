<?php
session_start();
include("phpconf.php");
include("func.php");
conDB();
if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line
 
if ($_GET['id1']<>""){
  $id1=$_GET['id1'];}else{
 $id1=date("d-m-Y");
 }
$d_conv=explode("-",$id1);$d=$d_conv[0];$m=$d_conv[1];$y=$d_conv[2];
$d_conv_search="$y-$m-$d";//}else{ $d_conv_search=$d_conv_search; }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - รายชื่อผู้ป่วย ณ จุดซักประวัติ - - |</title>
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

	<script language="javascript" src="Script/codethatcalendarstd.js"></script>
	<script language="javascript" src="Samples/iframe_ex.js"></script>
	<script language="javascript">
		var c1 = new CodeThatCalendar(caldef1);
</script>
</head>
<body>
<?php
//header("content-type:image/gif");
$key_word=$_GET['keyword'];
?>
<div id="Layer1" style="position:absolute; left:635px; top:150px; width:187px; height:171px; z-index:1"> 
  <script>
			// Create iframe
	                if(ua.oldOpera)document.write("<div id=\"calendar_div\">");
			document.write("<iframe id=\"calendar_frame\" name=\"calendar_frame\"");
			document.write(" frameborder=\"0\""); 
			document.write(" scrolling=\"no\""); 
			document.write(" style=\"visibility:hidden;\"");
			if(ua.oldOpera) 
   				document.write(" src=\"Samples/codethatcalendar.html\">");
			else document.write(">");
			document.write("</iframe>");
			if(ua.oldOpera)document.write("</div>");
		</script>
</div>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr valign="top"> 
          <td colspan="2" class="flist">
<?php include("header.inc"); ?>
		  </td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif"><?php include("manu.inc"); ?></td>
          <td width="160" align="center" valign="top" bgcolor="#3399CC" background="img_mian/bgcolor.gif"> 
		  <!-- form -->  <!-- end form -->
			
		  </td>
        </tr>
        <tr> 
          <td width="640" height="187" valign="top" bgcolor="#B1C3D9"><div align="center"><br>
              <table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="620" valign="top"><table width="630" border="0" align="center" cellpadding="0" cellspacing="0" class="bdmain">
                    <tr bgcolor="#CCCCCC"> 
                      <td height="24" colspan="2" class="flist" background="img_mian/bgcolor2.gif"><div align="center">&nbsp;<b>รายชื่อผู้ป่วยที่รับบริการที่จุดซักประวัติ</b>&nbsp;</div></td>
                    </tr>
                    <tr> 
                      <td width="292" valign="top"> 
                        <!--<form method="get" action="<?php //echo $PHP_SELF; ?>">
                            &nbsp;&nbsp;เลือกวันที่ .. 
                            <input name="id1" type="text" value="<?php //echo $id1; ?>" size="15"/>
                            <input type="button" onClick="c1.innerpopup('id1','calendar_frame');" value="..."/>
                            <input type="submit" value="Refresh">
                          </form>
						  -->
                      </td>
                      <td width="327">&nbsp; </td>
                    </tr>
                    <tr> 
                      <td colspan="2"> &nbsp; 
                        <?php 
							echo "<center><b>ข้อมูล ณ วันที่</b>&nbsp;<font color=red><u>".$d." - ".$m." - ".($y+543)."</u></font></center>";
						?>
                      </td>
                    </tr>
                    <tr> 
                      <td colspan="2">&nbsp; 
                        <?php 
						//จำนวนผู้ป่วยซักประวัติแล้ว 
						$sqlP_all="select count(*) as cc from pq_screen where screen_date='$d_conv_search' ";
						$resultP_all=mysql_db_query($DBName,$sqlP_all)
						or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
						$rsP_all=mysql_fetch_array($resultP_all);
						if($rsP_all["cc"]<>0){$p_num=$rsP_all["cc"];}else{ $p_num="-";} //จำนวนผู้ป่วยซักประวัติแล้ว 
						//จากผู้ป่วยทั้งสิ้น
						$sqlP_all2="select count(*) as pttotal from ovst  ";
						$sqlP_all2.="where vstdate='$d_conv_search' and (main_dep='007' or main_dep='004') "; 
						$resultP_all2=mysql_db_query($DBName,$sqlP_all2)
						or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
						// หาจำนวนเรกคอร์ดข้อมูล
						$rsP_all2=mysql_fetch_array($resultP_all2);
						//echo "แถว".$rsP_all["cc"];
						if($rsP_all2["pttotal"]<>0){$p_all=$rsP_all2["pttotal"];}else{ $p_all="-";} //จำนวนผู้ป่วยซักประวัติแล้ว 
						echo "<center>&nbsp;จำนวนผู้ป่วยซักประวัติแล้ว :&nbsp;<font color=red>".$p_num."</font>&nbsp;จากผู้ป่วยทั้งสิ้น :&nbsp;<font color=red>".$p_all."<font><br></center>";
						//นำข้อมูลมาแสดงในตาราง
							     	if(!isset($start)){
								    $start = 0;}
									$limit ="10";

										$sqlP_all3="select v.*, o.* , k.department as fdepartment ,m.department as cdepartment , o.help4_note as helpnote, d.code , d.shortname as doctorname ";
										$sqlP_all3.=", s.screen_time as screen_time,s.vn , concat(p.pname,p.fname,'  ',p.lname) as pt_name ";
										$sqlP_all3.="from ovst v  ";
										$sqlP_all3.="left outer join patient p on p.hn=v.hn ";
										$sqlP_all3.="left outer join pq_screen s on s.vn=v.vn ";
										$sqlP_all3.="left outer join opdscreen o on o.vn=v.vn ";
										$sqlP_all3.="left outer join kskdepartment k  on k.depcode=v.main_dep ";
										$sqlP_all3.="left outer join kskdepartment m  on m.depcode=v.cur_dep ";
										$sqlP_all3.="left outer join doctor d on d.code=v.doctor ";
										$sqlP_all3.="where v.vstdate='$d_conv_search' and (v.main_dep='007' or v.main_dep='004') order by v.vn "; 
											$resultP_all3=mysql_db_query($DBName,$sqlP_all3)
											or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
											$num_rows_p3 = mysql_num_rows($resultP_all3);
										if ($num_rows_p3<>0){
										$bg="#B1C3D9";
										?>
                        <table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
                          <!-- สร้างกรอบตาราง -->
                          <tr bgcolor="#3399CC" class="flist"> 
                            <td width="9" height="16" bgcolor="#3399CC"><div align="left"><img src="img_mian/c_t_left.gif" width="8" height="16"></div></td>
                            <td width="25" background="img_mian/bgcolor2.gif" bgcolor="#3399CC" class="flist"><div align="center">ลำดับ</div></td>
                            <td width="26" background="img_mian/bgcolor2.gif" class="flist"><div align="center">Q</div></td>
                            <td width="124" background="img_mian/bgcolor2.gif" class="flist"><div align="center">ชื่อผู้ป่วย</div></td>
                            <td width="59" background="img_mian/bgcolor2.gif" class="flist"><div align="center">เวลายื่นบัตร</div></td>
                            <td width="79" background="img_mian/bgcolor2.gif" class="flist"><div align="center">เวลาซักประวัติ</div></td>
                            <td width="119" background="img_mian/bgcolor2.gif" class="flist"><div align="center">แผนกที่ส่งตรวจ</div></td>
                            <td width="66" background="img_mian/bgcolor2.gif" class="flist"><div align="center">แผนกปัจจุบัน</div></td>
                            <td width="64" background="img_mian/bgcolor2.gif" class="flist"><div align="center">แพทย์ที่ตรวจ</div></td>
                            <td width="50" background="img_mian/bgcolor2.gif" class="flist"><div align="center">คิวพิเศษ</div></td>
                            <td width="9"><div align="right"><img src="img_mian/c_t_r.gif" width="8" height="16"></div></td>
                          </tr>
                          <tr class="flist"> 
                            <td height="16" colspan="11" align="center"> 
                              <!-- สร้างตารางกรอบใน เพื่อแสดงข้อมูล -->
                              <table width="630" border="0" cellpadding="0" cellspacing="0">
                                <?php
			 		while($i<$num_rows_p3){
					$rsP_all3=mysql_fetch_array($resultP_all3); 
					$s_hn=$rsP_all3["hn"];
					if ($bg=="#B1C3D9") { //color
					$bg="#FFFFFF";
					$bgm="";
					}else{
					$bg="#B1C3D9";
					$bgm="img_mian/bgcolor.gif";
					} //color
					?>
                                <tr bgcolor="<?php echo $bg; ?>"> 
                                  <td width="28" height="21" background="<?php echo $bgm;?>"><div align="center"><?php echo $i+1; ?></div></td>
                                  <td width="27" background="<?php echo $bgm;?>"><div align="center"><?php echo $rsP_all3["oqueue"];?></div></td>
                                  <td width="123" align="left" background="<?php echo $bgm;?>">&nbsp;<?php echo "<a href=\"patient_medication_record.php?hn=$s_hn\" target=_blank>".$rsP_all3["pt_name"]."</a>"; ?></td>
                                  <td width="57" background="<?php echo $bgm;?>"><div align="center"><?php echo $rsP_all3["vsttime"]; ?></div></td>
                                  <td width="75" background="<?php echo $bgm;?>"><div align="center"><?php echo $rsP_all3["screen_time"]."".date("A"); ?></div></td>
                                  <td width="115" align="left" background="<?php echo $bgm;?>">&nbsp;<?php echo $rsP_all3["fdepartment"]; ?></td>
                                  <td width="66" align="left" background="<?php echo $bgm;?>">&nbsp;<?php echo $rsP_all3["cdepartment"]; ?></td>
                                  <td width="63" background="<?php echo $bgm;?>"><div align="center"><?php echo $rsP_all3["doctorname"]; ?></div></td>
                                  <td width="54" background="<?php echo $bgm;?>"><div align="center"><?php echo $rsP_all3["helpnote"]; ?></div></td>
                                </tr>
                                <?php
	        	$i++;//$a++;
		    	}//while  ?>
                              </table>
                              <!-- end table show data -->
                            </td>
                          </tr>
                          <tr> 
                            <td valign="bottom" bgcolor="#3399CC"><div align="left"><img src="img_mian/c_l_left.gif" width="8" height="16"></div></td>
                            <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                            <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                            <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                            <td colspan="6" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                            <td valign="bottom" bgcolor="#3399CC"><div align="right"><img src="img_mian/c_l_r.gif" width="8" height="16"></div></td>
                          </tr>
                        </table>
                        <!-- end สร้างกรอบตาราง -->
                        <?php
						//echo $num_rows_p3;
						    if ($num_rows_p3<10){ echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>";}
			}else{  //row=0
			$row="n";
			echo"<center>ผลการค้นหา : ไม่มีข้อมูลของวันที่&nbsp;<font color=red> <u>".$d." - ".$m." - ".($y+543)."</u></font>&nbsp;ในฐานข้อมูล<center>";
			echo "<br><br><br><br><br><br><br><br><br><br>";
		}//row=0
		?>
                      </td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
                </tr>
              </table>
            </td>
          <td width="160" align="center" valign="top" bgcolor="#3399CC"><form method="get" action="<?php echo $PHP_SELF; ?>">
            <table width="150" border="0" cellpadding="0" cellspacing="2" class="bdmain">
              <tr>
                <td background="img_mian/bgcolor2.gif" bgcolor="#99CCFF"><div align="center"> :: <b>เลือกวันที่</b> ::</div></td>
              </tr>
              <tr>
                <td><div align="left">&nbsp;
                        <input name="id1" type="text" id="Txt-Field" value="<?php echo $id1; ?>" size="18"/>
&nbsp; </div></td>
              </tr>
              <tr>
                <td align="center"><div align="left">&nbsp;
                        <input name="button" id="Button" type="button" onClick="c1.innerpopup('id1','calendar_frame');" value="...&gt;"/>
&nbsp;
          <input name="submit" type="submit" value="REFRESH" id="Button">
                </div></td>
              </tr>
            </table>
          </form></td>
        </tr>
        <tr valign="top">
          <td height="16" align="center" background="img_mian/bgcolor2.gif">|&nbsp;<?php echo"<a href=\"result_chlogin.php\">ย้อนกลับ</a>" ?>&nbsp;|</td>
          <td height="16" valign="top" bgcolor="#3399CC">&nbsp;</td>
        </tr>
        <tr valign="top"> 
          <td height="16"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="16">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23"><div align="center"><br>
        <br>
      </div></td>
  </tr>
</table>
<?php }//ch online
CloseDB(); //close connect db ?>
</body>
</html>
