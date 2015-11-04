<?php 

session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - โรคที่พบบ่อยในโรงพยาบาลละแม ->  - - |</title>
<style type="text/css">
<!--
body {  margin: 0px  0px; padding: 0px  0px}
body{font-family:MS Sans Serif;font-size:10pt}
table,td{font-family:MS Sans Serif;font-size:10pt}
form{font-family:MS Sans Serif;font-size:10pt}
.style1 {
	color: #000033;
	font-weight: bold;
}
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
<table width="804" height="864" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="787" height="816" align="center" valign="top"><div align="left"></div>      <table width="778" cellpadding="0" cellspacing="0" align="center">
	    <!--DWLayoutTable-->
        <tr>
          <td width="750" height="18" valign="top">
            <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>          </td>
        </tr>
        <tr>
          <td height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC"> <?php include("manu.inc"); ?>          </td>
        </tr>
        <tr>
          <td height="317" align="center" valign="top" class="td-left"><br>
              <table width="717" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                <!--DWLayoutTable-->
                <tr align="center" bgcolor="#99CCFF">
                  <td height="24" colspan="3" valign="top" background="img_mian/bgcolor2.gif" class="headmenu"> โรคที่พบบ่อย</td>
                </tr>
                <tr>
                  <td colspan="2"><!-- end สร้างกรอบตาราง --></td>
                  <td width="64"></td>
                </tr>
                <tr align="center" valign="top">
                  <td width="650" height="96" valign="top">
				  <?php
			
$pdx = $_GET ['pdx'];
$d1 = $_GET ['d1'];
$d2 = $_GET ['d2'];

				//$d1=$sy1."-".$sm1."-".$sd1;
				//$d2=$sy2."-".$sm2."-".$sd2;//echo $d1."dd".$d2;
if($type=="ALL"){
$sqlOpd_Socail="select  v.vn,v.hn,v.pdx,ic.name as icd10,ic.tname as icd9 ";
$sqlOpd_Socail.=",concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
//$sqlOpd_Socail.="left outer join an_stat a on a.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
//$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
//$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="where   v.pdx = '$pdx'   and (v.vstdate between '$d1' and '$d2') and  v.pdx<>'' and  v.pdx is not null  ";
$sqlOpd_Socail.=" order by  v.vn  ";
}
elseif($type=="IPD"){
$sqlOpd_Socail="select   a.vn,a.hn,a.pdx,ic.name as icd10,ic.tname as icd9 ";
$sqlOpd_Socail.=",concat(DAY(a.regdate),'/',MONTH(a.regdate),'/',(YEAR(a.regdate)+543)) as vst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.="from an_stat a ";
$sqlOpd_Socail.="left outer join patient p on p.hn=a.hn ";
$sql_ipd_Socail.="left outer join ovst ov on ov.vn=a.vn ";
//$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=a.pdx ";
$sqlOpd_Socail.="where   a.pdx = '$pdx'   and (a.regdate between '$d1' and  '$d2')  and a.pdx<>'' and a.pdx is not null  ";
$sqlOpd_Socail.="order by  a.vn";
}
elseif($type=="OPD"){
$sqlOpd_Socail="select  v.vn,v.hn,v.pdx,ic.name as icd10,ic.tname as icd9 ";
$sqlOpd_Socail.=",concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="where   v.pdx = '$pdx'   and (v.vstdate between '$d1' and  '$d2') and v.pdx<>'' and v.pdx is not null   ";
$sqlOpd_Socail.="order by  v.vn";
 } 


				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				//if(mysql_num_rows($resultOpd_Socail)>0){
				//print"<u><font color='green'><b>แสดงข้อมูลของวันที่ <font color='red'>$vst_date</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font>";
					print"<u><font color='green'><b>แสดงข้อมูลของวันที่ <font color='red'>$d1</font>  ถึงวันที่ <font color='red'>$d2</font> ";
					print"<br>มีทั้งหมด ".mysql_num_rows($resultOpd_Socail)." รายการ</b></font></u>";
						//create row
						?>
                    <table width="574" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
                      <tr>
                        <td height="44" align="center"><table width="581" border="0" cellpadding="1" cellspacing="1">
                          <tr class="headtable">
                            <td width="49" height="21"  align="center" background="img_mian/bgcolor2.gif">ลำดับที่</td>
							 <td width="109"  align="center" background="img_mian/bgcolor2.gif">pdx</td>
						 <td width="109"  align="center" background="img_mian/bgcolor2.gif">VN</td>
							<td width="109"  align="center" background="img_mian/bgcolor2.gif">HN</td>
							<td width="193"  align="center" background="img_mian/bgcolor2.gif">ชื่อ-นามสกุล</td>
							   
                          </tr>
                          <?php
				$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						 

						// if($bg=='#FFFFFF'){$bg="#FFFFCC";}else{$bg='#FFFFFF';}
						 
					if ($bg=="#FFFFFF") { //color
						$bg="#FFFFCC";
					//$bgm="";
						}else{
						$bg="#FFFFFF";
						//$bgm="img_mian/bgcolor.gif";
						} //color
						?>
                          <tr bgcolor="<?php echo $bg;?>">
                            <td  align="center"><?php echo ($i+1); ?></td>
                           <td  align="center"><?php echo $rsOpd_Socail['pdx']; ?></td>
						     <td  align="center"><?php echo $rsOpd_Socail['vn']; ?></td>
							  <td  align="center"><?php echo $rsOpd_Socail['hn']; ?></td>
							  <td align="left">&nbsp;<?php echo "<a href='patient_medication_record.php?hn=".$rsOpd_Socail['hn']."&vn=".$rsOpd_Socail['vn']."'>".change_misis($rsOpd_Socail['patient_name'])."</a>"; ?></td>

                          </tr>
                          <?php
						$i++;
						
						
					} //while 
					?>
                        </table></td>
                      </tr>
                  </table>					<?php 
					//$exp_file="opd";
					//print"<br><br><img src='img_mian/excel_icon.gif' align='middle'>&nbsp;<a href='excel_export.php?sy1=$sy1&sm1=$sm1&sd1=$sd1&sy2=$sy2&sm2=$sm2&sd2=$sd2&exp_file=$exp_file'>Excel Export File</a><br><br>";
				//}else{
						//if($sy1<>""){print"<font color='green'><b>ไม่มีข้อมูลของ<br>วันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font></b></font>";
						//}else{print"<font color='green'><b>กรุณาเลือกช่วงเวลา สำหรับรายงาน</b></font><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";}
				//} //select _date
				}
				?></td>
                <td width="3">&nbsp;</td>
                  <td></td>
                </tr>
                <tr>
                  <td height="59" colspan="3" valign="top">&nbsp;  <form>
                    <center><input type=button value="Refresh" onClick="javascript:location.reload();" id="Button"></center>
                  </form></td>
                </tr>
              </table>              
              <!-- form -->
            <!-- end form --></td>
        </tr>
        <tr>
		   
          <td height="18" align="center" valign="top" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"javascript:history.back(-1)\">ย้อนกลับ</a>" ?>&nbsp;|</td>
        </tr>
        <tr>
          <td height="36" valign="top"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
        </tr>
                                        </table></td>
  <td width="17">&nbsp;</td>
  </tr>
  <tr>
    <td height="48">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php 
//}//ch online
CloseDB(); //close connect db ?>
</body>
</html>

