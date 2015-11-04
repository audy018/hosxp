<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();

if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";
}else{ //on line
if  (($_SESSION["user_type"]=="online")  AND !Check_Online(get_ip())){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";}
		
if ($_GET['id1']<>""){
  $id1=$_GET['id1'];}else{
 $id1=date("d-m-Y");
 }
$d_conv=explode("-",$id1);$d=$d_conv[0];$m=$d_conv[1];$y=$d_conv[2];
$d_conv_search="$y-$m-$d";
$m_conv_search="$y-$m";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - สรุปข้อมูลประจำวัน - - |</title>
<style type="text/css">
<!--
body {  margin: 0px  0px; padding: 0px  0px}
body{font-family:MS Sans Serif;font-size:10pt}
table,td{font-family:MS Sans Serif;font-size:10pt}
form{font-family:MS Sans Serif;font-size:10pt}
.style1 {color: #FF0000}
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
<a name="top"></a> 
<div id="Layer1" style="position:absolute; left:666px; top:179px; width:187px; height:171px; z-index:1"> 
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
<table width="800" border="0" cellspacing="0" cellpadding="0" id="table"><a name="top"></a>
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr valign="top"> 
          <td colspan="2">
		  <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
	</td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif"><?php include("manu.inc"); ?></td>
          <td width="166" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp;</td>
        </tr>
        <tr> 
          <td width="634" height="187" valign="top" class="td-left2"><div align="center"><br> 
            <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="620" valign="top"><table width="620" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                  <tr bgcolor="#99CCFF">
                    <td height="24" colspan="2" class="headmenu" background="img_mian/bgcolor2.gif" align="center">กราฟสรุปข้อมูลประจำวัน  <?php echo "&nbsp;".$Hospname."&nbsp;"; ?></td>
                  </tr>
                  <tr>
                    <td width="339" valign="top">
					<!--<form method="get" action="<?php echo $PHP_SELF; ?>">
                            &nbsp;&nbsp;เลือกวันที่ .. 
                            <input name="id1" type="text" value="<?php echo $id1; ?>" size="15"/>
                            <input type="button" onClick="c1.innerpopup('id1','calendar_frame');" value="..."/>
                            <input type="submit" value="Refresh">
                          </form>
						  -->                    </td>
                    <td width="281" align="right">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><?php 
							echo "&nbsp;<b>ข้อมูล ณ วันที่</b>&nbsp;<font color=red><u>".dateThai($d_conv_search)."</u></font>";
						?>                    </td>
                  </tr>
                  <tr>
                    <td><?php
						//จำนวนผู้ป่วยในวันที่เลือก
//จำนวนคน
						$sql_c_ovst1="select count(distinct hn) as cc1 from ovst where vstdate='$d_conv_search' "; 
						$result_c_ovst1=mysql_db_query($DBName,$sql_c_ovst1)
						or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
						$rs_c_ovst1=mysql_fetch_array($result_c_ovst1);
//จำนวนครั้ง
						$sql_c_ovst2="select count(*) as cc2 from ovst where vstdate='$d_conv_search' "; //จำนวนครั้ง
						$result_c_ovst2=mysql_db_query($DBName,$sql_c_ovst2)
						or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
						$rs_c_ovst2=mysql_fetch_array($result_c_ovst2);
						echo "<b>&nbsp;จำนวนผู้มารับบริการทั้งหมด :".$rs_c_ovst1["cc1"]."&nbsp;คน&nbsp;".$rs_c_ovst2["cc2"]."&nbsp;ครั้ง</b>"; //แสดงจำนวนผู้มารับบริการ
						?>                    </td>
                    <td><div align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                  </tr>
                  <?php if ($rs_c_ovst1["cc1"]>0){ ?>
                  
                  <tr valign="top">
                    <td colspan="2"><div align="center"><br>
                        <table width="536" border="1" cellpadding="0" cellspacing="0" class="bd-external">
                          <tr  class="headtable">
                            <td width="48" align="center" background="img_mian/bgcolor2.gif">ลำดับ</td>
                            <td width="328" background="img_mian/bgcolor2.gif">ข้อมูลอื่นๆ</td>
                            <td width="69" align="center" valign="baseline" background="img_mian/bgcolor2.gif">ประจำวัน</td>
                            <td width="81" align="center" valign="baseline" background="img_mian/bgcolor2.gif">ประจำเดือน</td>
                          </tr>
                          <tr class="text-intable">
                            <td align="center">1</td>
                            <td align="left">&nbsp; สรุปข้อมูลผู้มารับบริการตามเพศ</td>
                            <td align="center"><?php echo "<a href=\"chart.php?vstdate=$d_conv_search&grpid=1\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                            <td align="center"><?php echo "<a href=\"chart.php?vstdate=$m_conv_search&grpid=1\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          </tr>
                          <tr class="text-intable">
                            <td align="center">2</td>
                            <td align="left">&nbsp; สรุปข้อมูลผู้มารับบริการตามกลุ่มอายุ</td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=2\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=2\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          </tr>
                          <tr class="text-intable">
                            <td align="center">3</td>
                            <td align="left">&nbsp; สรุปข้อมูลผู้มารับบริการตามสิทธิการรักษา</td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=3\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=3\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          </tr>
                          <tr class="text-intable">
                            <td align="center">4</td>
                            <td align="left">&nbsp;&nbsp;สรุปข้อมูลจำนวนผู้ป่วยตามแผนก</td>
                            <td align="center"><?php echo "<a href=\"chart.php?vstdate=$d_conv_search&grpid=4\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                            <td align="center"><?php echo "<a href=\"chart.php?vstdate=$m_conv_search&grpid=4\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          </tr>
                          <tr class="text-intable">
                            <td align="center">5</td>
                            <td align="left">&nbsp; สรุปข้อมูลผู้มารับบริการตามผลการวินิจฉัย</td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=5\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=5\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          </tr>
                          <tr class="text-intable">
                            <td align="center">6</td>
                            <td align="left">&nbsp; สรุปข้อมูลผู้มารับบริการตามที่อยู่ แยกตามตำบล </td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=6\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=6\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          </tr>
                          <tr class="text-intable">
                            <td align="center">7</td>
                            <td align="left">&nbsp;&nbsp;สรุปข้อมูลผู้มารับบริการตามที่อยู่ แยกตามอำเภอ</td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=7\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=7\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          </tr>
                          <tr class="text-intable">
                            <td align="center">8</td>
                            <td align="left">&nbsp;&nbsp;สรุปข้อมูลผู้มารับบริการตามที่อยู่ แยกตามจังหวัด</td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=8\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=8\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          </tr>
                          <tr class="text-intable">
                            <td align="center">9</td>
                            <td align="left">&nbsp; สรุปข้อมูลผู้มารับบริการตามช่วงเวลาที่มา</td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=9\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=9\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          </tr>
                          <tr class="text-intable">
                            <td align="center">10</td>
                            <td align="left">&nbsp;&nbsp;สรุปข้อมูลผู้รับบริการตามแพทย์ผู้ตรวจ</td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=10\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=10\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          </tr>
                          <tr class="text-intable">
                            <td align="center">11</td>
                            <td align="left">&nbsp; สรุปข้อมูลค่าใช้จ่ายแยกตามประเภท</td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=11\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=11\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          </tr>
                          <tr class="text-intable">
                            <td align="center">12</td>
                            <td align="left">&nbsp; สรุปข้อมูลผู้ป่วยเฝ้าระวังทางระบาดวิทยา</td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=12\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                            <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=12\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          </tr>
                          <!-- จบการสร้างแถว table5 -->
                        </table>
                        <br>
                        <br>
                        <br>
                    </div></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><br></td>
                  </tr>
                  
                  <tr>
                    <td>&nbsp;</td>
                    <td align="right"><span class="style1">&nbsp;</span>&nbsp;&nbsp;</td>
                  </tr>
                  
                  <?php } ?>
                </table></td>
              </tr>
            </table>
            <br> <center>
              </center></td>
          <td align="center" valign="top" class="td-right"><form method="get" action="<?php echo $PHP_SELF; ?>">
            <table width="160" border="0" cellpadding="0" cellspacing="2" class="bd-internal">
              <tr>
                <td bgcolor="#99CCFF" background="img_mian/bgcolor2.gif" class="headmenu"><div align="center"> :: <b>เลือกวันที่</b> ::</div></td>
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
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><a href="patient_in_department_count.php"><span class="headmenu">สรุปข้อมูลประจำวัน</span></a></td>
              </tr>
            </table>
          </form> </td>
        </tr>
        <tr valign="top">
          <td height="16" align="center" background="img_mian/bgcolor2.gif">|&nbsp;<?php echo"<a href=\"result_chlogin.php\">ย้อนกลับ</a>" ?>&nbsp;|</td>
          <td height="16" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
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
<?php 
}//ch online
CloseDB(); //close connect db ?>
</body>
</html>
