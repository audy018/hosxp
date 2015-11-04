<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - ยอดผู้รับบริการ -> ทันตกรรม (ประกันสังคม) - - |</title>
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
                  <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> ประกันสังคมทันตกรรม</td>
                </tr>
                <tr align="center">
           <td colspan="2" valign="top">
<form action="<?php $PHP_SELF ?>" method="get" name="f_select_dmy">
		   <table width="360" border="0" cellspacing="2" cellpadding="1">
             <tr align="center">
               <td colspan="3"><font color="green"><b><u>เลือกช่วงเวลา</u></b></font></td>
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
				$d1=$sy1."-".$sm1."-".$sd1;$d2=$sy2."-".$sm2."-".$sd2;//echo $d1."dd".$d2;
				$sqlDenService="select p.cid,d.hn,d.vn,concat(DAY(d.vstdate),'/',MONTH(d.vstdate),'/',(YEAR(d.vstdate)+543)) as vst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name,p.fname as FName,p.lname as LName, ";
				$sqlDenService.="concat(DAY(p.birthday),'/',MONTH(p.birthday),'/',(YEAR(p.birthday)+543)) as Birth_date, ";
				$sqlDenService.="i.code as icd10,i.name as icd_name,d.ttcode,dr.name as doctor,v.income,dm.name as tmcode_name ";
				$sqlDenService.="from dtmain d ";
				$sqlDenService.="left outer join doctor dr on dr.code=d.doctor ";
				$sqlDenService.="left outer join patient p on p.hn=d.hn ";
				$sqlDenService.="left outer join icd101 i on i.code=d.icd ";
				$sqlDenService.="left outer join vn_stat v on v.vn=d.vn ";
				$sqlDenService.="left outer join dttm dm on dm.code=d.tmcode ";
				$sqlDenService.="where  v.pcode='A7' and d.vstdate between '$d1' and  '$d2' ";
				$sqlDenService.="group by d.vn order by d.vstdate ";
				$resultDenService=ResultDB($sqlDenService);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultDenService)>0){
					print"<u><font color='green'><b>แสดงข้อมูลของวันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font>";
					print"<br>มีทั้งหมด ".mysql_num_rows($resultDenService)." รายการ</b></font></u>";
						//create row
						?><br><br>
					<table width="970" border="1" cellspacing="0" cellpadding="0" class="bd-external">
                      <tr>
                        <td height="44" align="center"><table width="970" border="0" cellpadding="1" cellspacing="1">
                          <tr class="headtable">
                            <td width="23"  align="center" background="img_mian/bgcolor2.gif">ที่</td>
                            <td width="94"  align="center" background="img_mian/bgcolor2.gif">บัตรประชาชน</td>
                            <td width="62" align="center"  background="img_mian/bgcolor2.gif">HN</td>
                            <td width="61" align="center"  background="img_mian/bgcolor2.gif">รับบริการ</td>
                            <td width="124" align="center"  background="img_mian/bgcolor2.gif">ชื่อ-สกุล</td>
                            <td width="56" align="center"  background="img_mian/bgcolor2.gif">วันเกิด</td>
                            <td width="47" align="center"  background="img_mian/bgcolor2.gif">icd10</td>
                            <td width="140" align="center"  background="img_mian/bgcolor2.gif">ชื่อโรค</td>
                            <td width="54" align="center"  background="img_mian/bgcolor2.gif">ซี่ฟัน</td>
                            <td width="113" align="center"  background="img_mian/bgcolor2.gif">การรักษา</td>
                            <td width="106" align="center"  background="img_mian/bgcolor2.gif">แพทย์</td>
                            <td width="53" align="center"  background="img_mian/bgcolor2.gif">ค่าบริการ</td>
                          </tr>
                          <?php
				$i=0;
			          while($i<mysql_num_rows($resultDenService)){//while
						 $rsDenService=mysql_fetch_array($resultDenService);
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
                            <td  align="center">
							<?php 
							if($rsDenService['cid']=="" or $rsDenService['cid'] == NULL or !$rsDenService['cid']){
								$sqlDenCidEmpty="SELECT cid FROM hipdata h WHERE fname LIKE '".$rsDenService['FName']."' and lname LIKE '".$rsDenService['LName']."' ";
								$resultDenCidEmpty=ResultDB($sqlDenCidEmpty);$rsDenCidEmpty=mysql_fetch_array($resultDenCidEmpty);
								echo $rsDenCidEmpty['cid'];
							}else{
								echo $rsDenService['cid']; 
							}
							?>
							</td>
                            <td align="center"><?php echo $rsDenService['hn']; ?></td>
                            <td align="right"><?php echo $rsDenService['vst_date']; ?></td>
                            <td align="left">&nbsp;<?php echo "<a href='patient_medication_record.php?hn=".$rsDenService['hn']."&vn=".$rsDenService['vn']."'>".change_misis($rsDenService['patient_name'])."</a>"; ?></td>
                            <td align="right"><?php echo $rsDenService['Birth_date']; ?></td>
                            <td align="center"><?php echo $rsDenService['icd10']; ?></td>
                            <td align="left"><?php echo $rsDenService['icd_name']; ?></td>
                            <td align="right"><?php echo $rsDenService['ttcode']; ?></td>
                            <td align="left">&nbsp;<?php echo $rsDenService['tmcode_name']; ?></td>
                            <td align="left">
							<?php //echo $rsDenService['doctor']; 
								  if (ereg("ทันตแพทย์",$rsDenService['doctor'])){ // return true,false
								  echo str_replace("ทันตแพทย์","ทพ.",$rsDenService['doctor']); //แทนที่คำ ทันตแพทย์ เป็น ทพ. 
								  }else{ //false
  								  echo change_misis($rsDenService['doctor']); 
								  }
								  ?>							
							</td>
                            <td align="right"><?php echo number_format($rsDenService['income'])." บ."; ?></td>
                          </tr>
                          <?php
						$i++;
					} //while 
					?>
                        </table></td>
                      </tr>
                    </table><br><br><br><br>
					<?php
						$exp_file="den";
					   print"<br><br><img src='img_mian/excel_icon.gif' align='middle'>&nbsp;<a href='excel_export.php?sy1=$sy1&sm1=$sm1&sd1=$sd1&sy2=$sy2&sm2=$sm2&sd2=$sd2&exp_file=$exp_file'>Excel Export File</a><br><br>";
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
