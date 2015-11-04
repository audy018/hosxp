<?php 
session_start();
include("phpconf.php");
include("func.php");
include("sql_lr.inc");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - ข้อมูลผู้ป่วย ณ ห้องทันตกรรม ANC - - |</title>
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
<?php
if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line

if ($_GET['id1']<>""){
  $id1=$_GET['id1'];}else{
 $id1=date("d-m-Y");
 }
 //จำนวนผู้ป่วยในวันที่เลือก
$d_conv=explode("-",$id1);$d=$d_conv[0];$m=$d_conv[1];$y=$d_conv[2];
$d_conv_search="$y-$m-$d";
$key_word=$_GET['keyword'];
?>
<body>
<table width="1024" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="927">&nbsp;</td>
  </tr>
  <tr> 
    <td height="23"><div align="center">
      <table width="1024" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2" valign="top" align="center">
            <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
          </td>
        </tr>
        <tr>
          <td width="744" height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC"><?php include("manu.inc"); ?>
          </td>
          <td width="205" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; </td>
        </tr>
        <tr>
          <td height="177" colspan="2" align="center" valign="top"><br>
              <table width="1000" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                <tr align="center" bgcolor="#99CCFF">
                  <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> รายงานประกันสังคมทันตกรรม&nbsp;<?php echo ($y+543); ?></td>
                </tr>
                <tr>
                  <td width="338" valign="top">&nbsp;
                      <!--<form method="get" action="<?php //echo $PHP_SELF; ?>">
                            &nbsp;&nbsp;เลือกวันที่ .. 
                            <input name="id1" type="text" value="<?php //echo $id1; ?>" size="15"/>
                            <input type="button" onClick="c1.innerpopup('id1','calendar_frame');" value="..."/>
                            <input type="submit" value="Refresh">
                          </form>
						  -->
                  </td>
                  <td width="295">&nbsp; </td>
                </tr>
                <tr align="center">
                  <td colspan="2">&nbsp; เลือกปีงบประมาณ :&nbsp;
                      <?php
                  	  print"<form  name='fsYear' method='get' action='$PHP_SELF'>";
					  print"<select name='syear'  id='Txt-Field'>";
					  print"<option value='$y'>".($y+543)."</option>";
					  for($i=2545;$i<=2560;$i++){
					  print"<option value='($i-543)'>$i</option>";
					  }
					  print"</select>";
					  print"&nbsp;<input type='submit' name='Continue' value='Continue' id='Button'>";
					  print"</form>";
					  ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2"><!-- end สร้างกรอบตาราง -->
                  </td>
                </tr>
                <tr align="center" valign="top">
                  <td colspan="2"><br>
                      <table width="770" border="1" cellspacing="0" cellpadding="0">
                        <tr align="center" background="img_mian/bgcolor2.gif" class="headtable">
                          <td width="118">บัตรประจำตัวประชาชน</td>
                          <td width="64">HN</td>
                          <td width="131">ชื่อ-สกุล</td>
                          <td width="57">ว/ด/ป เกิด </td>
                          <td width="40">ม.ค.</td>
                          <td width="40">ก.พ.</td>
                          <td width="40">มี.ค.</td>
                          <td width="40">เม.ย.</td>
                          <td width="40">พ.ค.</td>
                          <td width="40">มิ.ย.</td>
                          <td width="40">ก.ค.</td>
                          <td width="40">ส.ค.</td>
                          <td width="52">ก.ย.</td>
                        </tr>
                        <tr>
                          <td>&nbsp;จำนวนคลอดทั้งหมด</td>
                          <td align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                        </tr>
                    </table></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              <br>
              <!-- form -->
              <!-- end form --></td>
        </tr>
        <tr>
          <td height="16" colspan="2" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"javascript:history.back(-1)\">ย้อนกลับ</a>" ?>&nbsp;|</td>
          </tr>
        <tr>
          <td height="16" valign="top"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="16" valign="top">&nbsp;</td>
        </tr>
      </table>
      <br>
        <br>
      </div></td>
  </tr>
</table>
<?php 
}//ch online
CloseDB(); //close connect db ?>
</body>
</html>
