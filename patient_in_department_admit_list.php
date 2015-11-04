<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - สรุปผลการให้บริการผู้ป่วยในที่ถูกรับเข้าแผนกผู้ป่วยใน - -</title>
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
<?
if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";
}else{ //on line
if  (($_SESSION["user_type"]=="online")  and !Check_Onlines()){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";}
		
if ($_GET['id1']<>""){
  $id1=$_GET['id1'];}else{
 $id1=date("d-m-Y");
 }
 //echo $id1;
 //จำนวนผู้ป่วยในวันที่เลือก
$d_conv=explode("-",$id1);$d=$d_conv[0];$m=$d_conv[1];$y=$d_conv[2];
$d_conv_search="$y-$m-$d";//}else{ $d_conv_search=$d_conv_search; }
$key_word=$_GET['keyword'];
?>
<body>
<div id="Layer1" style="position:absolute; left:669px; top:184px; width:187px; height:171px; z-index:1"> 
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
<table width="800" border="0" cellspacing="0" cellpadding="0" id="table">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr> 
          <td colspan="2" valign="top">
<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
		  </td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC"><?php include("manu.inc"); ?></td>
          <td width="160" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; 
          </td>
        </tr>
        <tr> 
          <td width="643" height="187" align="center" valign="top" class="td-left"><br> 
            <table width="630" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
            <tr align="center" bgcolor="#99CCFF">
              <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"><b>รายชื่อผู้ป่วยในที่ถูกรับเข้าแผนกผู้ป่วยใน</b>&nbsp;<?php echo "&nbsp;".$Hospname."&nbsp;"; ?></td>
            </tr>
            <tr>
              <td width="339" valign="top"></td>
              <td width="281"><a name="top"></a> </td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;
                  <?php 
							echo "<center><b>ข้อมูล ณ วันที่</b>&nbsp;<font color=red><u>".dateThai($d_conv_search)."</u></font></center>";
						?>
              </td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;
                  <?php 
						//นำข้อมูลมาแสดงในตาราง
											$sqlAdmit="select e.*,concat(p.pname,p.fname,'  ',p.lname) as pt_name,d.name as doctor_name ";
											$sqlAdmit.="from ipt e ";
											$sqlAdmit.="left outer join patient p on p.hn=e.hn ";
											$sqlAdmit.="left outer join  doctor d on d.code= e.admdoctor ";
											$sqlAdmit.="where e.regdate between '$d_conv_search' and '$d_conv_search' order by e.regtime ";
											$resultAdmit=mysql_db_query($DBName,$sqlAdmit)
											or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
											$num_rows_Admit = mysql_num_rows($resultAdmit);
											echo "<center>";
										if ($num_rows_Admit<>0){
											echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนทั้งหมด : <font color=red><b>".$num_rows_Admit."</b></font>&nbsp;ราย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
											if ($num_rows_Admit>20){ //ลูกศรเลื่อนลง
											echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
											echo "<a href=#below><img src=\"img_mian/arow_bl.gif\" width=13 height=9 border=0></a>&nbsp;ด้านล่าง";
											}//ลูกศร
											echo "</center>";
										$bg="#B1C3D9";
										?>
                  <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
                    <!-- สร้างกรอบตาราง -->
                    <tr bgcolor="#3399CC" class="headtable">
                      <td width="9" height="16" bgcolor="#3399CC"><div align="left"><img src="img_mian/c_t_left.gif" width="8" height="16"></div></td>
                      <td width="39" background="img_mian/bgcolor2.gif" bgcolor="#3399CC"><div align="center">ลำดับ</div></td>
                      <td width="50" background="img_mian/bgcolor2.gif"><div align="center">HN</div></td>
                      <td width="126" background="img_mian/bgcolor2.gif" ><div align="left">&nbsp;&nbsp;ชื่อผู้ป่วย</div></td>
                      <td width="58" background="img_mian/bgcolor2.gif"><div align="center">เวลาที่รับ</div></td>
                      <td width="125" background="img_mian/bgcolor2.gif">&nbsp;&nbsp;แพทย์ผู้สั่ง Admit </td>
                      <td width="204" background="img_mian/bgcolor2.gif"><div align="left">&nbsp;&nbsp;อาการสำคัญ</div></td>
                      <td width="9"><div align="right"><img src="img_mian/c_t_r.gif" width="8" height="16"></div></td>
                    </tr>
                    <tr>
                      <td height="16" colspan="8" align="center"><!-- สร้างตารางกรอบใน เพื่อแสดงข้อมูล -->
                          <table width="620" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                            <?php
					$i=0;
			 		while($i<$num_rows_Admit){
					$rsAdmit=mysql_fetch_array($resultAdmit); 
					$admit_hn=$rsAdmit["hn"];
					if ($bg=="#B1C3D9") { //color
					$bg="#FFFFFF";
					//$bgm="";
					}else{
					$bg="#B1C3D9";
					//$bgm="img_mian/bgcolor.gif";
					} //color
					?>
                            <tr bgcolor="<?php echo $bg; ?>" height="16" class="text-intable">
                              <td width="39" align="center" ><?php echo $i+1; ?></td>
                              <td width="56" align="center" >&nbsp;<?php echo $admit_hn;?></td>
                              <td width="128" align="left"  bgcolor="<?php echo $bg; ?>">&nbsp;<?php echo "<a href=\"patient_medication_record.php?hn=$admit_hn\">".change_misis($rsAdmit["pt_name"])."</a>"; ?></td>
                              <td width="57" align="center" ><?php echo $rsAdmit["regtime"]; ?></td>
                              <td width="126" align="left" >&nbsp;
                                  <?php 
								  if (ereg("นายแพทย์",$rsAdmit["doctor_name"])){ // return true,false
								  echo str_replace("นายแพทย์","พ.",$rsAdmit["doctor_name"]); //แทนที่คำ นายแพทย์ เป็น พ. 
								  }else{ //false
  								  echo str_replace("แพทย์หญิง","พญ.",$rsAdmit["doctor_name"]); //แทนที่คำ แพทย์หญิง เป็น พญ. 
								  }
								  ?></td>
                              <td width="212" align="left" >&nbsp;<?php echo $rsAdmit["prediag"]; ?></td>
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
                      <td colspan="4" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                      <td valign="bottom" bgcolor="#3399CC"><div align="right"><img src="img_mian/c_l_r.gif" width="8" height="16"></div></td>
                    </tr>
                  </table>
                  <!-- end สร้างกรอบตาราง -->
                  <?php
						  			if ($num_rows_Admit<10){ echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";}
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
					  						if ($num_rows_Admit>20){ //ลูกศรเลื่อนลง
											echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
											echo "<a href=#top><img src=\"img_mian/arow_t.gif\" width=13 height=9 border=0></a>&nbsp;ด้านบน";
											}//ลูกศร
					  ?>
              </td>
            </tr>
          </table>
        </td>
          <td width="160" align="center" valign="top" class="td-right"> 
            <!-- form -->
            <form method="get" action="<?php echo $PHP_SELF; ?>">
              <table width="155" border="0" cellpadding="0" cellspacing="2" class="bd-internal">
                <tr> 
                  <td background="img_mian/bgcolor2.gif" class="headmenu"><div align="center"> 
                      :: <b>เลือกวันที่</b> ::</div></td>
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
            </form>
            <!-- end form -->
          </td>
        </tr>
        <tr>
          <td height="16" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9"><font color="white">| <?php echo"<a href=\"result_chlogin.php\">รายการหลัก</a>" ?>&nbsp;|</font></td>
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
<?php }//ch online
CloseDB(); //close connect db ?>
</body>
</html>
