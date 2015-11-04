<?php 
if ($_GET['id1']<>""){
  $id1=$_GET['id1'];}else{
 $id1=date("d-m-Y");
 }
 //echo $id1;
 //จำนวนผู้ป่วยในวันที่เลือก
$d_conv=explode("-",$id1);$d=$d_conv[0];$m=$d_conv[1];$y=$d_conv[2];
$d_conv_search="$y-$m-$d";//}else{ $d_conv_search=$d_conv_search; }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - สรุปรายการผู้ป่วยความดันโลหิตสูง - - |</title>
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
session_start();
include("phpconf.php");
include("func.php");
conDB();
$key_word=$_GET['keyword'];
?>
<div id="Layer1" style="position:absolute; left:647px; top:244px; width:187px; height:171px; z-index:1"> 
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
        <tr> 
          <td colspan="2" valign="top" class="flist">&nbsp;</td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp;| 
            รายการ | </td>
          <td width="160" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; 
          </td>
        </tr>
        <tr> 
          <td width="643" height="187" valign="top" bgcolor="#B1C3D9"><div align="center"><br> 
            <table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="620" valign="top"><table width="630" border="0" align="center" cellpadding="0" cellspacing="0" class="bdmain">
                    <tr align="center" bgcolor="#99CCFF"> 
                      <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="flist">
                      <b>สรุปรายการ</b>ผู้ป่วยความดันโลหิตสูง</td>
                    </tr>
                    <tr> 
                      <td width="339" valign="top"> 
                        <!--<form method="get" action="<?php //echo $PHP_SELF; ?>">
                            &nbsp;&nbsp;เลือกวันที่ .. 
                            <input name="id1" type="text" value="<?php //echo $id1; ?>" size="15"/>
                            <input type="button" onClick="c1.innerpopup('id1','calendar_frame');" value="..."/>
                            <input type="submit" value="Refresh">
                          </form>
						  -->
                      </td>
                      <td width="281">&nbsp; </td>
                    </tr>
                    <tr align="center" valign="top"> 
                      <td colspan="2"> <table width="500" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="394"> &nbsp;&nbsp;กิจกรรม</td>
                          <td width="106" align="center">จำนวน</td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;&nbsp;1.ผู้ป่วยความดันโลหิตสูงที่ได้รับการขึ้นทะเบียนที่มีชีวิตทั้งหมด</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.1 ขึ้นทะเบียนที่ PCU โรงพยาบาล (ที่ยังมีชีวิต)  ทั้งหมด</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.2 ขึ้นทะเบียนที่ PCU นอก โรงพยาบาล</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;&nbsp;2.ผู้ป่วยความดันโลหิตสูงที่มารับบริการในสถานบริการสาธารณสุข</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.1 รับบริการที่โรงพยาบาล</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2.1.1 ผู้ป่วยนอก</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2.1.2 ผู้ป่วยใน</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.2 รับบริการที่ PCU</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      </td>
                    </tr>
                    <tr> 
                      <td colspan="2">&nbsp; 
                        <!-- end สร้างกรอบตาราง -->                        </td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;
					  </td>
                    </tr>
                  </table></td>
              </tr>
            </table>
        </td>
          <td width="160" align="center" valign="top" bgcolor="#3399CC"> 
            <!-- form -->
            <form method="get" action="<?php echo $PHP_SELF; ?>">
              <table width="160" border="0" cellpadding="0" cellspacing="2" class="bdmain">
                <tr> 
                  <td background="img_mian/bgcolor2.gif" bgcolor="#99CCFF"><div align="center"> 
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
          <td height="16" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"result_chlogin.php\">ย้อนกลับ</a>" ?>&nbsp;|</td>
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
<?php CloseDB(); //close connect db ?>
</body>
</html>
