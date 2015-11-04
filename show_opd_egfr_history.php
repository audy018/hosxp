<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - ส่วนจัดการคำนวณค่า GFR - - |</title>
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

?>
<body>
<table width="1024" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="927" height="276" align="center">
	  
	  <table width="1010" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td colspan="2" valign="top">
            <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
          </td>
        </tr>
        <tr>
          <td width="850" height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC"><?php include("manu.inc"); ?>
          </td>
          <td width="139" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; </td>
        </tr>
        <tr>
          <td height="177" colspan="2" align="center" valign="top" class="td-left"><br>
              <table width="1019" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                <tr align="center" bgcolor="#99CCFF">
                  <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> <font size="3">ประวัติการคำนวณค่า GFR ของ</font> <font color='blue' size="3"><b><?=$_GET['ptname']?> <?=$_GET['hn']?></b></font></td>
                </tr>
                <tr align="center">
           <td colspan="2" valign="top">

		 	</td>
                </tr>
                <tr align="center">
                  <td colspan="2">
				  
				  
				  </td>
                </tr>
                <tr>
                  <td colspan="2"><!-- end สร้างกรอบตาราง --></td>
                </tr>
                <tr align="center" valign="top">
                  <td colspan="2"> </td>
                </tr>
                <tr align="center">
                  <td colspan="2">

				  </td>
                </tr>
                <tr align="center">
                  <td colspan="2">
				  
				
			<?php
			
					$hn = $_GET[hn];
					
			//include("sql_report_pharmacy.inc");


			?>
						
						<br><br>
					<table width="550" border="1" cellspacing="0" cellpadding="0" class="bd-external">
                      <tr>


                        <td height="44" align="center">
						
						<table width="550" border="1" cellpadding="1" cellspacing="1">

						 <tr>
							<td colspan="10" align="right">

							

								   <a href="frm_egfr_add.php?vn=<?=$_GET['vn']?>&hn=<?=$_GET['hn']?>&vstdate=<?=$_GET['vstdate'] ?>&ptname=<?=$_GET['ptname']?>"  title="เพิ่ม eGFR  สำหรับคนไข้รายนี้"><font size="3"><u><b>+เพิ่มข้อมูล GFR </b></u></font></a>
								&nbsp;
							</td>

							</tr>

<tr align="center">
	<td>วันที่รับบริการ</td>
	<td width="120">HN</td>
	<td>ค่าผลลัพธ์ GFR</td>

	<td>ดู/แก้ไข ประวัติ</td>
</tr>

<?

$hn=$_GET['hn'];


$sqlOpd_Socail="select * from lamae_egfr  where hn='$hn' order by vstdate desc";


$resultOpd_Socail=ResultDB($sqlOpd_Socail);
if(mysql_num_rows($resultOpd_Socail)>0){

$i=0;
while($i<mysql_num_rows($resultOpd_Socail)){//while
$rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);

?>
                       
<tr>
	<td align="center"><font size='4'><?=dateThai($rsOpd_Socail['vstdate']);?></font></td>
	<td align="center"><font size='4'><?=$rsOpd_Socail['hn']?></font></td>
		<td align="center"><font size='4' color='blue'><?=$rsOpd_Socail['eGFR_result']?></font></td>

	
	<td align="center">
			<a href="frm_egfr_edit.php?vn=<?=$rsOpd_Socail['vn']?>&hn=<?=$_GET['hn']?>&vstdate=<?=$rsOpd_Socail['vstdate'] ?>&ptname=<?=$_GET['ptname']?>"  title="แก้ไขข้อมูล GFR สำหรับผู้คนไข้รายนี้"><u>แก้ไขข้อมูล</u></a>
	
	</td>
</tr>
		<? 	$i++; ?>
	<?}?> <!--End While-->
<?}else{
	echo "<tr><td colspan='6'><center><font color='red' size='4'>! ยังไม่เคยมีการบันทึกข้อมูลค่า GFR สำหรับคนไข้รายนี้</font></center></td></tr>";	
 }?>
						
						
						
						
						</table></td>
                      </tr>
                    </table>
					
                  </td>
                </tr>
                <tr>
                  <td width="544">&nbsp;</td>
                  <td width="475">&nbsp;</td>
                </tr>
              </table>
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
	</td>
  </tr>
  <tr> 
    <td height="23">
	
	</td>
  </tr>
</table>
<?php 
}//ch online
CloseDB(); //close connect db ?>
</body>
</html>
