<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - โรคที่พบบ่อยในโรงพยาบาลมายอ ->  - - |</title>
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
<table width="802" border="0" cellspacing="0" cellpadding="0" align="center">
  <!--DWLayoutTable-->
  <tr>
    <td width="802" height="750" align="center" valign="top">
	  <table width="785" cellpadding="0" cellspacing="0" align="center">
	    <!--DWLayoutTable-->
        <tr>
          <td height="18" colspan="2" valign="top">
            <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>          </td>
        </tr>
        <tr>
          <td height="24" colspan="2" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC"><?php include("manu.inc"); ?>          </td>
        </tr>
        <tr>
          <td height="303" colspan="2" align="center" valign="top" class="td-left"><br>
              <table width="727" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                <!--DWLayoutTable-->
                <tr align="center" bgcolor="#99CCFF">
                  <td width="695" height="24" valign="top" background="img_mian/bgcolor2.gif" class="headmenu"> รายงานผลการใช้ยา</td>
                <td width="1">&nbsp;</td>
                </tr>
                <tr align="center">
           <td height="88" valign="top">
             <form action="<?php $PHP_SELF ?>" method="get" name="f_select_dmy">
			        <table width="543" border="1" cellspacing="0" cellpadding="1" class="bd-external">
                      <tr align="center" bgcolor="#319ACE">
                        <td colspan="2"><u>เลือกช่วงเวลา</u></td>
                      </tr>
                      
                <tr>
                        <td width="107">รายการยา</td>
                        <td width="426"> 
				       <?php 
					$sqlUser="select  icode,concat(name,' ',strength) as drugname  from drugitems order by name  ";
					$resultUser=ResultDB($sqlUser);//echo mysql_num_rows($result);
				 	if(mysql_num_rows($resultUser)>0){
					print"<select name='slogin'  id='Txt-Field'>";
						for($i=0;$i<mysql_num_rows($resultUser);$i++){
						$rsUser=mysql_fetch_array($resultUser);
						print "<option value='".$rsUser['icode']."'>".$rsUser['drugname']."</option>";
						}										    
					print"</select>";
					}
				  ?>
           </td>
                      </tr>
                      <tr>
                        <td>เลือกวันที่</td>
                        <td>
			      <?php
				
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
				$sqlSyear="select   DISTINCT YEAR(vstdate) as s_year  from opitemrece group by  vstdate desc  ";
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
                     <td><?php
				
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
				$sqlSyear="select   DISTINCT YEAR(vstdate) as s_year  from opitemrece group by  vstdate desc  ";
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
                <td>&nbsp;</td>
                </tr>
                <tr>
                  <td height="36" colspan="2"><!-- end สร้างกรอบตาราง --></td>
                </tr>
                <tr align="center" valign="top">
                  <td height="80" valign="top"> <?php
if($select_date=="Continue"){
$select_date=$_GET['select_date']; //button
$hot_num=$_GET['hot_num']; //num
$type=$_GET['type'];//type
				//sql create table show
				$d1=$sy1."-".$sm1."-".$sd1;$d2=$sy2."-".$sm2."-".$sd2;//echo $d1."dd".$d2;

			//sql select review date select
			
$sqlOpd_Socail="select  o.hn,o.vn,d.name as drugname ,sum(o.qty) as count_all,concat(DAY(o.vstdate),'/',MONTH(o.vstdate),'/',(YEAR(o.vstdate)+543)) as vst_date  from opitemrece o  ";
$sqlOpd_Socail.="left outer join  drugitems d on d.icode=o.icode ";
$sqlOpd_Socail.=" where d.icode ='$slogin' and  o.vstdate between '$d1' and  '$d2'  ";
//$sqlOpd_Socail.="where  v.pcode='A7' and v.vstdate between '$d1' and  '$d2'  and pdx not like 'k%' and pdx not like 'z35%' and pdx not like 'z36%' ";
//$sqlOpd_Socail.="and pdx  not in('z32','z320','z321','z33','z34','z340','z348','z349') and pdx <>'' and pdx not like '%xx%' and pdx is not null ";
$sqlOpd_Socail.="group by o.hn  order by vn,count_all  asc ";
    
				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){
					print"<u><font color='green'><b>แสดงข้อมูลของวันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font>";
					print"<br>มีทั้งหมด ".mysql_num_rows($resultOpd_Socail)." รายการ</b></font></u>";
						//create row
						
						?>
                    
                 
                    <table width="495" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
                      <tr>
                        <td height="44" align="center">
                          <div align="center">
                            <table width="477" border="0" cellpadding="1" cellspacing="1">
                              <tr class="headtable">
                                <td width="57" height="21"  align="center" background="img_mian/bgcolor2.gif">ลำดับที่</td>
								<td width="166"  align="center" background="img_mian/bgcolor2.gif">รายการยา</td>
							    <td width="92"  align="center" background="img_mian/bgcolor2.gif">วันที่</td>
                            <td width="77"  align="center" background="img_mian/bgcolor2.gif">รหัส</td>    
                            <td width="69" align="center"  background="img_mian/bgcolor2.gif">จำนวน</td>
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
								<td  align="center"><?php echo $rsOpd_Socail['drugname']; ?></td>
								<td  align="center"><?php echo $rsOpd_Socail['vst_date']; ?></td>
							  <td align="left">&nbsp;<?php echo "<a href='patient_medication_record.php?hn=".$rsOpd_Socail['hn']."&vn=".$rsOpd_Socail['vn']."'>".change_misis($rsOpd_Socail['hn'])."</a>"; ?></td>
							    <td  align="center"><?php echo $rsOpd_Socail['count_all']; ?></td>
								
                              </tr>
                              <?php
						$i++;
						
						
					} //while 
					?>
                            </table>
                        </div></td>
                      </tr>
                    </table>                      <?php 
					$exp_file="opd";
					//print"<br><br><img src='img_mian/excel_icon.gif' align='middle'>&nbsp;<a href='excel_export.php?sy1=$sy1&sm1=$sm1&sd1=$sd1&sy2=$sy2&sm2=$sm2&sd2=$sd2&exp_file=$exp_file'>Excel Export File</a><br><br>";
				}else{
						if($sy1<>""){print"<font color='green'><b>ไม่มีข้อมูลของ<br>วันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font></b></font>";
						}else{print"<font color='green'><b>กรุณาเลือกช่วงเวลา สำหรับรายงาน</b></font><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";}
				} //select _date
				}
				?>                  </td>
                <td>&nbsp;</td>
                </tr>
                <tr>
                  <td height="59" valign="top">&nbsp;  <form>
                    <center><input type=button value="Refresh" onClick="javascript:location.reload();" id="Button"></center>
                  </form></td>
                <td>&nbsp;</td>
                </tr>
              </table>              <!-- form -->
            <!-- end form --></td>
        </tr>
        <tr>
		   
          <td width="778" height="18" align="center" valign="top" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"javascript:history.back(-1)\">ย้อนกลับ</a>" ?>&nbsp;|</td>
        <td width="1"></td>
        </tr>
        <tr>
          <td height="36" valign="top"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td></td>
        </tr>
        </table></td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
  </tr>
</table>
<?php 
}//ch online
CloseDB(); //close connect db ?>
</body>
</html>

