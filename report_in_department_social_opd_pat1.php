<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - 
	รายงานการใช้ยาสมุนไพร ที่อยู่ในบัญชียาหลักแห่งชาติ (นับรายการยาสมุนไพรที่มีการสั่งใช้)- - |</title>
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
          <td width="659" height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC"><?php include("manu.inc"); ?>
          </td>
          <td width="139" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; </td>
        </tr>
        <tr>
          <td height="177" colspan="2" align="center" valign="top" class="td-left"><br>
              <table width="1019" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                <tr align="center" bgcolor="#99CCFF">
                  <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> รายงานการใช้ยาสมุนไพร ที่อยู่ในบัญชียาหลักแห่งชาติ (นับรายการยาสมุนไพรที่มีการสั่งใช้)</td>
                </tr>
                <tr align="center">
           <td colspan="2" valign="top">
<form action="<?php $PHP_SELF ?>" method="get" name="f_select_dmy">
		   <table width="360" border="0" cellspacing="2" cellpadding="1">
             <tr align="center">
               <td colspan="3"><font color="green"><b><u>เลือกช่วงเวลา ไตรมาสปัจจุบัน</u></b></font></td>
               </tr>
             <tr>
               <td width="78">
			<?php
				print"วันที่&nbsp;";
				print"<select name='sd1' id='Txt-Field'>";
				if($sd1<>""){print"<option value='$sd1'>$sd1</option>";}
					for($i=1;$i<=31;$i++){
						print"<option value='$i'>$i</option>";
					}
				print"</select>"; 
				?>
				 </td>
               <td width="129">
			<?php
				print"&nbsp;เดือน&nbsp;";
				print"<select name='sm1' id='Txt-Field'>";
				if($sm1<>""){print"<option value='$sm1'>".change_month_isThai($sm1)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>"; 
				?>
			   </td>
               <td width="135">
				<?php
				print"&nbsp;ปี&nbsp;";
				$sqlSyear="select   DISTINCT YEAR(vstdate) as s_year  from dtmain group by  vstdate desc  ";
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
	   		?>&nbsp;&nbsp;&nbsp;&nbsp;	ถึง		   </td>
               </tr>
             <tr>
               <td><?php
				print"วันที่&nbsp;";
				print"<select name='sd2' id='Txt-Field'>";
				if($sd2<>""){print"<option value='$sd2'>$sd2</option>";}
					for($i=1;$i<=31;$i++){
						print"<option value='$i'>$i</option>";
					}
				print"</select>"; 
				?></td>
               <td><?php
				print"&nbsp;เดือน&nbsp;";
				print"<select name='sm2' id='Txt-Field'>";
				if($sm2<>""){print"<option value='$sm2'>".change_month_isThai($sm2)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>"; 
				?></td>
               <td>
			   <?php
				print"&nbsp;ปี&nbsp;";
				$sqlSyear="select   DISTINCT YEAR(vstdate) as s_year  from dtmain group by  vstdate desc  ";
				$result=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				print"<select name='sy2'  id='Txt-Field'>";
				if($sy2<>""){print"<option value='$sy2'>".($sy2+543)."</option>";}
					 if(mysql_num_rows($result)>0){
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						print "<option value='".$rs['s_year']."'>".($rs['s_year']+543)."</option>";
						}										    
					}
				
			
	   		?>				</td>
               </tr>

			    <tr align="center">
               <td colspan="3"><font color="green"><b><u>เลือกช่วงเวลา ไตรมาสย้อนหลัง</u></b></font></td>
               </tr>
             <tr>
               <td width="78">
			<?php
				print"วันที่&nbsp;";
				print"<select name='sd3' id='Txt-Field'>";
				if($sd3<>""){print"<option value='$sd3'>$sd3</option>";}
					for($i=1;$i<=31;$i++){
						print"<option value='$i'>$i</option>";
					}
				print"</select>"; 
				?>
				 </td>
               <td width="129">
			<?php
				print"&nbsp;เดือน&nbsp;";
				print"<select name='sm3' id='Txt-Field'>";
				if($sm3<>""){print"<option value='$sm3'>".change_month_isThai($sm3)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>"; 
				?>
			   </td>
               <td width="135">
				<?php
				print"&nbsp;ปี&nbsp;";
				$sqlSyear="select   DISTINCT YEAR(vstdate) as s_year  from dtmain group by  vstdate desc  ";
				$result=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				print"<select name='sy3'  id='Txt-Field'>";
				if($sy3<>""){print"<option value='$sy3'>".($sy3+543)."</option>";}
					 if(mysql_num_rows($result)>0){
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						print "<option value='".$rs['s_year']."'>".($rs['s_year']+543)."</option>";
						}										    
					}
					print"</select>";
	   		?>&nbsp;&nbsp;&nbsp;&nbsp;	ถึง		   </td>
               </tr>
             <tr>
               <td><?php
				print"วันที่&nbsp;";
				print"<select name='sd4' id='Txt-Field'>";
				if($sd4<>""){print"<option value='$sd4'>$sd4</option>";}
					for($i=1;$i<=31;$i++){
						print"<option value='$i'>$i</option>";
					}
				print"</select>"; 
				?></td>
               <td><?php
				print"&nbsp;เดือน&nbsp;";
				print"<select name='sm4' id='Txt-Field'>";
				if($sm4<>""){print"<option value='$sm4'>".change_month_isThai($sm4)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>"; 
				?></td>
               <td>
			   <?php
				print"&nbsp;ปี&nbsp;";
				$sqlSyear="select   DISTINCT YEAR(vstdate) as s_year  from dtmain group by  vstdate desc  ";
				$result=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				print"<select name='sy4'  id='Txt-Field'>";
				if($sy4<>""){print"<option value='$sy4'>".($sy4+543)."</option>";}
					 if(mysql_num_rows($result)>0){
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						print "<option value='".$rs['s_year']."'>".($rs['s_year']+543)."</option>";
						}										    
					}
				
				print"</select>&nbsp;&nbsp;&nbsp;<input type='submit' value='Continue' id='Button'>";
	   		?>				</td>
               </tr>
           </table>
</form>

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
				//sql create table show
				$d1=$sy1."-".$sm1."-".$sd1;
				$d2=$sy2."-".$sm2."-".$sd2;
				$d3=$sy3."-".$sm3."-".$sd3;
				$d4=$sy4."-".$sm4."-".$sd4;

$sqlOpd_Socail="
				SELECT
						icode,did,name,
						(
							SELECT COUNT(icode)
							FROM opitemrece
							WHERE opitemrece.icode=drugitems.icode
							AND opitemrece.vstdate
							BETWEEN '$d3' AND '$d4'
						)AS drug_before,
						(
							SELECT COUNT(icode)
							FROM opitemrece
							WHERE opitemrece.icode=drugitems.icode
							AND opitemrece.vstdate
							BETWEEN '$d1' AND '$d2'
						)AS drug_thistime
				
				FROM drugitems
					WHERE did!='' LIMIT 20
";
				
			

				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){
					print"<u><font color='green'><b>แสดงข้อมูลของวันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font>";
					print"<br>มีทั้งหมด ".mysql_num_rows($resultOpd_Socail)." รายการ</b></font></u>";
						//create row
						?><br><br>
					<table  border="1" cellspacing="0" cellpadding="0" class="bd-external">
                      <tr>
                        <td height="44" align="center"><table width='700px' border="0" cellpadding="1" cellspacing="1">
                          <tr class="headtable">
                            <td width="20" height="21"  align="center" background="img_mian/bgcolor2.gif">ลำดับ</td>
                            <td width='200px' align="center" background="img_mian/bgcolor2.gif">รหัสยาสมุนไพร</td>
                            <td align="center"  background="img_mian/bgcolor2.gif">ชื่อยาสมุนไพร</td>
                            <td colspan='2' align="center"  background="img_mian/bgcolor2.gif">จำนวนรายการที่สั่งใช้</td>
							</tr>
							<tr>
							  <td>&nbsp</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td align='center'> ไตรมาสที่ &nbsp;&nbsp;&nbsp;&nbsp;/</td>
							  <td align='center'> ไตรมาสที่ &nbsp;&nbsp;&nbsp;&nbsp;/ </td>
							</tr>
							<tr  bgcolor='yellow'>
							  <td>&nbsp</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							 
							   <td align='center'>
							  (
									<?=change_month_isThai($sm3)?>
									<?=$sy3+543?>
										-
									<?=change_month_isThai($sm4)?>
									<?=$sy4+543?>
									
								)
							  							  
							  </td>
							  <td align='center'>
								(
									<?=change_month_isThai($sm1)?>
									<?=$sy1+543?>
										-
									<?=change_month_isThai($sm2)?>
									<?=$sy2+543?>
									
								)</td>
							
							</tr>

                          <?php
				$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
					if ($bg=="#FFFFFF") { //color
						$bg="#B1C3D9";
					//$bgm="";
						}else{
						$bg="#FFFFFF";
						//$bgm="img_mian/bgcolor.gif";
						} //color
						?>
                          <tr bgcolor="<?php echo $bg;?>">
                            <td  align="center"><?php echo ($i+1); ?></td>
                            <td  align="center"><?php echo "'".$rsOpd_Socail['did']; ?></td>
                            <td align="left">&nbsp;&nbsp;<?php echo $rsOpd_Socail['name']; ?></td>
                            <td align="left"><?php echo $rsOpd_Socail['drug_before']; ?></td>
                            <td align="left">&nbsp;<?php echo $rsOpd_Socail['drug_thistime']; ?></td>
                         
                        
                          </tr>
                          <?php
						$i++;
					} //while 
					?>
                        </table></td>
                      </tr>
                    </table>
					<?php 
					$exp_file="opd";
					/*
					print"<br><br>
					<img src='img_mian/excel_icon.gif' align='middle'>&nbsp;<a href='#excel_export.php?sy1=$sy1&sm1=$sm1&sd1=$sd1&sy2=$sy2&sm2=$sm2&sd2=$sd2&exp_file=$exp_file'>Excel Export File</a><br><br>";
					*/
				}else{
						if($sy1<>""){print"<font color='green'><b>ไม่มีข้อมูลของ<br>วันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font></b></font>";
						}else{print"<font color='green'><b>กรุณาเลือกช่วงเวลา สำหรับรายงาน</b></font><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";}
				}
				?>
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
