<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - โรคที่พบบ่อยในห้องอุบัติเหตุฉุกเฉิืน โรงพยาบาลละแม ->  - - |</title>
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
<table width="804" height="816" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="787" height="788" align="center" valign="top"><div align="left"></div>      <table width="778" height="780" align="center" cellpadding="0" cellspacing="0">
	    <!--DWLayoutTable-->
        <tr>
          <td width="774" height="18" valign="top">
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
                  <td height="24" colspan="3" valign="top" background="img_mian/bgcolor2.gif" class="headmenu"> โรคที่พบบ่อยเฉพาะคนไข้ที่ห้องอุบัติเหตุฉุกเฉิน (ER)</td>
                </tr>
                <tr align="center">
                  <td width="650" height="122" valign="top">
                    <form action="<?php $PHP_SELF ?>" method="get" name="f_select_dmy">
		           <table width="478" border="0" cellpadding="1" cellspacing="2" bordercolor="#3300FF" class="bd-external">
                     <tr align="center" bgcolor="#0066FF">
                       <td colspan="2"><span class="style1"><u>เลือกช่วงเวลา</u></span></td>
                      </tr>
                   
                     <tr>
                       <td>จำนวนโรคที่สนใจ</td>
                       <td>&nbsp;
			             <select name="hot_num">
                            <option value="5" selected>5</option>
                            <option value="10">10</option>
                            <option value="15">15 </option>
				            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30 </option>
                          </select>
                        </td>
                      </tr>
                     <tr bordercolor="#3333CC">
                       <td>
			        เลือกวันที่</td>
                       <td>
			         &nbsp; <?php
				
				print"<select name='sd1' id='Txt-Field'>";
				if($sd1<>""){print"<option value='$sd1'>$sd1</option>";}
					for($i=1;$i<=31;$i++){
						print"<option value='$i'>$i</option>";
					}
				print"</select>"; 
				?> 
			        <?php
				print"&nbsp;เดือน&nbsp;";
				print"<select name='sm1' id='Txt-Field'>";
				if($sm1<>""){print"<option value='$sm1'>".change_month_isThai($sm1)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>"; 
				?>
				        <?php
				print"&nbsp;ปี&nbsp;";
				$sqlSyear="select   DISTINCT YEAR(vstdate) as s_year  from vn_stat group by  vstdate desc  ";
				$result=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				print"<select name='sy1'  id='Txt-Field'>";
				if($sy1<>""){print"<option value='$sy1'>".($sy1+543)."</option>";}
					 if(mysql_num_rows($result)>0){
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						print "<option value='".$rs['s_year']."'>".($rs['s_year']+543)."</option>";
						}										    
					}
					print"</select>";
	   		?>
                    
&nbsp;				&nbsp;&nbsp;&nbsp; ถึง </td>
                      </tr>
                     <tr>
                       <td>&nbsp;</td>
                       <td> &nbsp; <?php
				
				print"<select name='sd2' id='Txt-Field'>";
				if($sd2<>""){print"<option value='$sd2'>$sd2</option>";}
					for($i=1;$i<=31;$i++){
						print"<option value='$i'>$i</option>";
					}
				print"</select>"; 
				?>
                         <?php
				print"&nbsp;เดือน&nbsp;";
				print"<select name='sm2' id='Txt-Field'>";
				if($sm2<>""){print"<option value='$sm2'>".change_month_isThai($sm2)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>"; 
				?>
                       <?php
				print"&nbsp;ปี&nbsp;";
				$sqlSyear="select   DISTINCT YEAR(vstdate) as s_year  from vn_stat group by  vstdate desc  ";
				$result=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				print"<select name='sy2'  id='Txt-Field'>";
				if($sy2<>""){print"<option value='$sy2'>".($sy2+543)."</option>";}
					 if(mysql_num_rows($result)>0){
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						print "<option value='".$rs['s_year']."'>".($rs['s_year']+543)."</option>";
						}										    
					}
				
				
	
					
				print"</select>&nbsp;&nbsp;&nbsp;<br><br><input  name = 'select_date' type='submit' value='Continue' id='Button'>";
	   		?></td>
                     </tr>
                   </table>
                    </form></td>
                <td width="3">&nbsp;</td>
                  <td width="64"></td>
                </tr>
                <tr>
                  <td colspan="2"><!-- end สร้างกรอบตาราง --></td>
                  <td></td>
                </tr>
                <tr align="center" valign="top">
                  <td height="96" valign="top"> 
				  
				
			<?php
if($select_date=="Continue"){
$select_date=$_GET['select_date']; //button
$hot_num=$_GET['hot_num']; //num
$type=$_GET['type'];//type
				//sql create table show
				//if(strlen($sd1)==1){$sd1="0".$sd1;}
				//if(strlen($sm1)==1){$sm1="0".$sm1;}
				//if(strlen($sd2)==1){$sd2="0".$sd2;}
				//if(strlen($sm2)==1){$sm2="0".$sm2;}
				
				$d1=$sy1."-".$sm1."-".$sd1;
				$d2=$sy2."-".$sm2."-".$sd2;//echo $d1."dd".$d2;
//if($type=="ALL"){




$sqlOpd_Socail="select o.icd10 as icd10,ic.name,ic.tname,count(o.icd10) as count_all,o.vn as "; $sqlOpd_Socail.="ovstdiag_vn,e.* ";
$sqlOpd_Socail.="from er_regist e ";
$sqlOpd_Socail.="left outer join ovstdiag o on o.vn = e.vn and o.diagtype='1'";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code = o.icd10 ";

$sqlOpd_Socail.="where e.vstdate between '$d1' and  '$d2' ";

$sqlOpd_Socail.="group by o.icd10    order by count_all desc ";

$sqlOpd_Socail.="limit $hot_num";



				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				
				if(mysql_num_rows($resultOpd_Socail)>0){
					
					print"<u><font color='green'><b>แสดงข้อมูลของวันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font>";
					print"<br>มีทั้งหมด ".mysql_num_rows($resultOpd_Socail)." รายการ</b></font></u>";
						//create row
						?>			<br>			<br>
					<table width="574" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
                      <tr>
                        <td height="44" align="center"><table width="597" border="0" cellpadding="1" cellspacing="1">
                          <tr class="headtable">
                            <td width="45" height="21"  align="center" background="img_mian/bgcolor2.gif">ลำดับที่</td>
                            <td width="100"  align="center" background="img_mian/bgcolor2.gif">รหัส</td>
                            <td width="185" align="center"  background="img_mian/bgcolor2.gif">ชื่อโรค</td>
                            <td width="153" align="center"  background="img_mian/bgcolor2.gif">โรค</td>
                            <td width="66" align="center"  background="img_mian/bgcolor2.gif">จำนวน</td>
						
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
                            <td  align="center"><?php echo $rsOpd_Socail['icd10']; ?></td>
                            <td align="left"><?php echo $rsOpd_Socail['name']; ?></td>
                            <td align="left"><?php echo $rsOpd_Socail['tname']; ?></td>
							
		                    <td align="left">&nbsp;  

							<?php 	//echo "<a href='icd_show_form_1.php?pdx=".$rsOpd_Socail['pdx']."&sd1=$sd1&sm1=$sm1&sy1=$sy1&sd2=$sd2&sm2=$sm2&sy2=$sy2'>".change_misis($rsOpd_Socail['count_all'])."</a>"; ?> <!--</td> -->
							<?php 	echo "<a href='icd_show_form_2.php?icd10=".$rsOpd_Socail['icd10']."&d1=$d1&d2=$d2'>".change_misis($rsOpd_Socail['count_all'])."</a>"; ?> </td>
             
                          </tr>
                          <?php
						$i++;
						
						
					} //while 
					?>
                        </table></td>
                      </tr>
                    </table>					<?php 
					$exp_file="opd";
					//print"<br><br><img src='img_mian/excel_icon.gif' align='middle'>&nbsp;<a href='excel_export.php?sy1=$sy1&sm1=$sm1&sd1=$sd1&sy2=$sy2&sm2=$sm2&sd2=$sd2&exp_file=$exp_file'>Excel Export File</a><br><br>";
				}else{
						if($sy1<>""){print"<font color='green'><b>ไม่มีข้อมูลของ<br>วันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font></b></font>";
						}else{print"<font color='green'><b>กรุณาเลือกช่วงเวลา สำหรับรายงาน</b></font><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";}
				} //select _date
				}
				?>                  </td>
                <td>&nbsp;</td>
                  <td></td>
                </tr>
                <tr>
                  <td height="59" colspan="3" valign="top">                     <form>
                    <center><input type=button value="Refresh" onClick="javascript:location.reload();" id="Button"></center>
                  </form></td>
                </tr>
              </table>              <!-- form -->
            <!-- end form --></td>
        </tr>
        <tr>
		   
          <td height="18" align="center" valign="top" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"javascript:history.back(-1)\">ย้อนกลับ</a>" ?>&nbsp;|</td>
        </tr>
        <tr>
          <td height="50" valign="top"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
        </tr>
        <tr>
          <td height="9"></td>
        </tr>
      </table></td>
  <td width="17">&nbsp;</td>
  </tr>
  <tr>
    <td height="28">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php 
}//ch online
CloseDB(); //close connect db ?>
</body>
</html>

