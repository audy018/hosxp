<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - Risk Management Report Form - - |</title>
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

<!-- <SCRIPT language=JavaScript src="js/calendar.js"></SCRIPT>
<LINK href="css/calendar-mos.css" type="text/css" rel="stylesheet">
<LINK href="css/style_sheet.css" type="text/css" rel="stylesheet"> -->

</head>
<?php
if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line

?>
<body>
 <table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr> 
          <td colspan="2" valign="top">
<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
		  </td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC"><?php include("manu.inc"); ?>
		  
		  </td>
          <td width="139" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; 
          </td>
        </tr>
        <tr> 
          <td width="659" height="177" align="center" valign="top" class="td-left"><br>
		  <table width="650" border="0" cellpadding="0" cellspacing="0" class="bd-external">
            <tr align="center" bgcolor="#99CCFF">
              <td height="24" colspan="2" class="headmenu" background="img_mian/bgcolor2.gif">Medication Error <?php echo "&nbsp;".$Hospname."&nbsp;"; ?></td>
            </tr>
            <tr align="center" valign="top">
              <td colspan="2"><br>
	<?php 
	$d=date("d");$m=date("n");$y=date("Y");$m2=date("m"); //date in the day ,month 05->m,5->n
	$date_current=$d." ".change_month_isThai($m)." ".($y+543); //date cuurent thai show
	$date_current2=$y."-".$m2."-".$d; //date cuurent add to db
	$time_current=date("H:i:s");$h=date("H");$mm=date("i");$s=date("s");//time cuurent
	if($submit_err==""){ //check botton submit?>
			 <form method="get" name="frisk_report"  action="<?php $PHP_SELF; ?>">
			   <table width="625" border="0" cellpadding="1" cellspacing="1"  class="bd-external">
                <tr align="center" bgcolor="#3399FF">
                  <td colspan="6" bgcolor="#CCFF00" class="headmenu">แบบรายงานความคลาดเคลื่อนทางยา</td>
                  </tr>
                <tr>
                  <td>คุณคือ : </td>
                  <td colspan="5">
                    <?php echo "<font color='blue'><b>".$ip_Log."</b></font>"; ?></td>
                </tr>
                <tr>
                  <td>วัน/เวลาปัจจุบัน</td>
                  <td colspan="5"><?php echo $date_current."  เวลา : ".$time_current; ?></td>
                </tr>
                <tr>
                  <td width="149">หน่วยงาน : </td>
                  <td colspan="5">
				  <?php
				 
				
				$sqlS_Department="SELECT * FROM hospital_department ";$resultS_Department=ResultDB($sqlS_Department);
				 if(mysql_num_rows($resultS_Department)>0){
					print"<select name='department_id'  id='Txt-Field'>";
					print"<option>- - เลือกหน่วยงาน - - </option>";
						for($i=0;$i<mysql_num_rows($resultS_Department);$i++){
						$rsS_Department=mysql_fetch_array($resultS_Department);
						print "<option value='".$rsS_Department['id']."'>".$rsS_Department['name']."</option>";
						}										    
					print"</select>";
				  }else{
				  	print"<input type='text' name='department_id' size='25' value='013'>";
					print"013 = รหัสห้องจ่ายยา";
				
				  }
				

				 
				  ?></td>
                  </tr>
                <tr>
                  <td>วันที่เกิดเหตุ</td>
                  <td colspan="5">
			<!-- <input type="text" name="carlender" readonly="true" size="14"  id='Txt-Field'>
          	<input type="button" name="Submit" value="ปฏิทิน" onClick="showCalendar('carlender','DD-MM-YYYY')"  id='Button'> -->
				  <?php
					print"<select name='sdate' id='Txt-Field'>";
					if($d<>""){print"<option value='$d'>$d</option>";}
					for($i=1;$i<=31;$i++){
						print"<option value='$i'>$i</option>";
					}
					print"</select>&nbsp;&nbsp;เดือน : "; 
				
					print"<select name='smonth' id='Txt-Field'>";
					if($m<>""){print"<option value='$m'>".change_month_isThai($m)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>&nbsp;&nbsp;ปี : "; 
				
				$sqlSyear="select   DISTINCT YEAR(err_date_report) as s_year  from medication_err group by  err_date_report desc  ";
				$result=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				print"<select name='syear'  id='Txt-Field'>";
				if($y<>""){print"<option value='$y'>".($y+543)."</option>";}
					 if(mysql_num_rows($result)>0){
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						print "<option value='".$rs['s_year']."'>".($rs['s_year']+543)."</option>";
						}										    
					}
					print"</select>"; 
					print"&nbsp;&nbsp;เวลา :&nbsp;&nbsp;"; 
					print"<input name='s_hour' type='text' id='Txt-Field' size='2' value='$h' onkeyup=\"this.value=this.value.replace(/\D/g,'')\" onchange=\"this.value=this.value.replace(/\D/g,'')\">:";
					//print"&nbsp;&nbsp;"; 
					print"<input name='s_minute' type='text' id='Txt-Field' size='2' value='$mm' onkeyup=\"this.value=this.value.replace(/\D/g,'')\" onchange=\"this.value=this.value.replace(/\D/g,'')\">:";
					//print"&nbsp;&nbsp;"; 
					print"<input name='s_second' type='text' id='Txt-Field' size='2' value='$s' onkeyup=\"this.value=this.value.replace(/\D/g,'')\" onchange=\"this.value=this.value.replace(/\D/g,'')\">";
					print"&nbsp;&nbsp; * ชั่วโมง:นาที:วินาที";
				?>
				</td>
                </tr>
                <tr>
                  <td>เกิดกับผู้ป่วย</td>
                  <td colspan="5">
				  <input name="patient_type" type="radio" value="OPD" checked>ผู้ป่วยนอก (OPD)
				  <input name="patient_type" type="radio" value="IPD">ผู้ป่วยใน (IPD)
				  </td>
                </tr>
                <tr>
                  <td>รายละเอียดความคลาดเคลื่อน : </td>
                  <td colspan="5"><font color="blue">* กรุณาระบุรายละเอียดความคลาดเคลื่อน</font></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="5" valign="top"><textarea name="detail_err" rows="5" cols="65"  id='Txt-Field'></textarea></td>
                  </tr>
                <tr>
                  <td colspan="3" valign="top" bgcolor="#CCFF00">&nbsp;&nbsp;ความคลาดเคลื่อนในการสั่งใช้ยา<br>
                   &nbsp; (OPD/IPD) Prescribing Error</td>
                  <td width="3" bgcolor="#CCFF00">&nbsp;</td>
                  <td colspan="2" valign="top" bgcolor="#CCFF00">&nbsp; ความคลาดเคลื่อนจากการจัดยา<br>
                    &nbsp; (OPD/IPD) Order Processing Error</td>
                </tr>
                <tr>
                  <td colspan="3" valign="top">&nbsp;
                    <input type="checkbox" name="prescribing_err1" value="[p1]">1.การสั่งใช้ยาโดยไม่มีข้อบ่งชี้หรือข้อห้ามใช้<br>&nbsp;
                    <input type="checkbox" name="prescribing_err2" value="[p2]">2.การสั่งใช้ยาที่ผู้ป่วยมีประวัติแพ้ยา<br>&nbsp;
					<input type="checkbox" name="prescribing_err3" value="[p3]">3.การสั่งใช้ยาในขนาด มาก/น้อยเกินไป <br>&nbsp;
					<input type="checkbox" name="prescribing_err4" value="[p4]">4.สั่งใช้ยาที่มีปฏิกิริยาต่อกันหรือกับยาเดิมของผู้ป่วย<br>&nbsp;
					<input type="checkbox" name="prescribing_err5" value="[p5]">5.สั่งใช้ยาซ้ำซ้อน<br>&nbsp;
					<input type="checkbox" name="prescribing_err6" value="[p6]">6.สั่งใช้ยาไม่ตรงกับผู้ป่วย<br>&nbsp;
					<input type="checkbox" name="prescribing_err7" value="[p7">7.อื่นๆ (ระบุ) <br>&nbsp; &nbsp;
					<input type="text" name="prescribing_err7txt" size="40"><br><br>
					</td>
                  <td>&nbsp;</td>
                  <td colspan="2" valign="top">&nbsp;
                    <input type="checkbox" name="order_process_err1" value="[op1]">1.จัดยาไม่ถูกต้องตามใบสั่งยา(ชนิด/ขนาด/รูปแบบ<br>/ปริมาณ)<br>&nbsp;
					<input type="checkbox" name="order_process_err2" value="[op2]">2.ติดฉลากยาผิด/สลับยา<br>&nbsp;
					<input type="checkbox" name="order_process_err3" value="[op3]">3.จัดยาหมดอายุหรือเสื่อมสภาพ<br>&nbsp;
					<input type="checkbox" name="order_process_err4" value="[op4]">4.คัดลอกคำสั่งใช้ยาผิด(ชื่อ/ขนาด/รูปแบบ/วิธีใช้/ปริมาณ)<br>&nbsp;
					<input type="checkbox" name="order_process_err5" value="[op5]">5.ไม่ได้คัดลอกรายการยา<br>&nbsp;
					
					<input type="checkbox" name="order_process_err6" value="[op6]">6.พิมพ์ฉลากยาไม่ถูกต้องตามใบสั่งยา (ชนิดขนาดรูปแบบ/ปริมาณ)<br>&nbsp;
					
					<input type="checkbox" name="order_process_err7" value="[op7">7.อื่นๆ (ระบุ) <br>&nbsp;&nbsp;
					
					<input type="text" name="order_process_err7txt" size="40"><br><br>
					</td>
                </tr>
                <tr>
                  <td colspan="3" valign="top" bgcolor="#CCFF00">&nbsp;&nbsp;ความคลาดเคลื่อนในการจ่ายยา<br>
&nbsp; (OPD) Dispensing Error</td>
                  <td bgcolor="#CCFF00">&nbsp;</td>
                  <td colspan="2" valign="top" bgcolor="#CCFF00">&nbsp;&nbsp;ความคลาดเคลื่อนในการบริหารยา<br>
&nbsp; Administration Error (IPD)</td>
                </tr>
                <tr>
                  <td colspan="3" valign="top">&nbsp;
                    <input type="checkbox" name="despen_err1" value="[d1]">1.จ่ายยาไม่ตรงกับผู้ป่วย<br>&nbsp;
					<input type="checkbox" name="despen_err2" value="[d2]">2.จ่ายยาผิด(ชื่อ/ขนาด/รูปแบบ/วิธีใช้/ปริมาณ)<br>&nbsp;
					<input type="checkbox" name="despen_err3" value="[d3]">3.จ่ายยาที่ไม่มีคำสั่งแพทย์<br>&nbsp;
					<input type="checkbox" name="despen_err4" value="[d4]">4.จ่ายยาหมดอายุหรือเสื่อมสภาพ<br>&nbsp;
					<input type="checkbox" name="despen_err5" value="[d5">5.อื่นๆ (ระบุ) <br>&nbsp; &nbsp;
					<input type="text" name="despen_err5txt" size="40">
					</td>
                  <td>&nbsp;</td>
                  <td colspan="2" valign="top">&nbsp;
                    <input type="checkbox" name="admin_err1" value="[a1]">1.ให้ยาไม่ครบ<br>&nbsp;
					<input type="checkbox" name="admin_err2" value="[a2]">2.ให้ยาผิดชนิด<br>&nbsp;
					<input type="checkbox" name="admin_err3" value="[a3]">3.ให้ยาผิดรูปแบบ<br>&nbsp;
					<input type="checkbox" name="admin_err4" value="[a4]">4.ให้ยาผิดขนาด<br>&nbsp;
					<input type="checkbox" name="admin_err5" value="[a5]">5.ให้ยาผิดวิถีทาง/ตำแหน่ง<br>&nbsp;
					<input type="checkbox" name="admin_err6" value="[a6]">6.ให้ยาในอัตราเร็วที่ผิด<br>&nbsp;
					<input type="checkbox" name="admin_err7" value="[a7]">7.ให้ยาที่ผู้สั่งใช้ยาไม่ได้สั่ง<br>&nbsp;
					<input type="checkbox" name="admin_err8" value="[a8]">8.ให้ยามากกว่าจำนวนครั้งที่สั่ง<br>&nbsp;
					<input type="checkbox" name="admin_err9" value="[a9]">9.การให้ยาผิดเทคนิค<br>&nbsp;
					<input type="checkbox" name="admin_err10" value="[a10]">10.ให้ยาผิดเวลา<br>&nbsp;
					<input type="checkbox" name="admin_err11" value="[a11]">11.ให้ยาผู้ป่วยผิดคน<br>&nbsp;
					<input type="checkbox" name="admin_err12" value="[a12">12.อื่นๆ (ระบุ) <br>
					&nbsp; &nbsp;<input type="text" name="admin_err12txt" size="40"><br><br>
					</td>
                  </tr>
                <tr>
                  <td bgcolor="#CCFF00">&nbsp;สาเหตุ(ระบุได้มากกว่า 1 ข้อ) : </td>
                  <td colspan="5" bgcolor="#CCFF00">&nbsp;</td>
                </tr>
              <tr>
                  <td colspan="3" valign="top">&nbsp;
                    <input type="checkbox" name="cause_err1" value="[c1]">1.ขาดความรู้เกี่ยวกับยา<br>&nbsp;
					<input type="checkbox" name="cause_err2" value="[c2]">2.ขาดข้อมูลจำเพาะของผู้ป่วย<br>&nbsp;
					<input type="checkbox" name="cause_err3" value="[c3]">3.คำนวณขนาดยาผิด<br>&nbsp;
					<input type="checkbox" name="cause_err4" value="[c4]">4.ขาดกาสื่อสารระหว่างวิชาชีพ<br>&nbsp;
					<input type="checkbox" name="cause_err5" value="[c5]">5.ผู้ปฏิบัติงานขาดการฝึกฝนเพียงพอ<br>&nbsp;
					<input type="checkbox" name="cause_err6" value="[c6]">6.การรบกวนสมาธิระหว่างการทำงาน<br>&nbsp;
					<input type="checkbox" name="cause_err7" value="[c7]">7.การใช้อักษรย่อที่ไม่ใช่สากล<br>&nbsp;
					<input type="checkbox" name="cause_err8" value="[c8]">8.การคัดลอกคำสั่งผิดพลาด<br>&nbsp;
					<input type="checkbox" name="cause_err9" value="[c9]">9.ความไม่รอบคอบเลินล่อ<br>&nbsp;
					<input type="checkbox" name="cause_err10" value="[c10]">10.Refill Order<br>
				</td>
                  <td>&nbsp;</td>
                  <td colspan="2" valign="top">&nbsp;
                    <input type="checkbox" name="cause_err11" value="[c11]">11.ลายมืออ่านยาก Copy ไม่ชัด<br>&nbsp;
					<input type="checkbox" name="cause_err12" value="[c12]">12.ชื่อยา/สียา/ลักษณะยาคล้ายคลึงกัน<br>&nbsp;
					<input type="checkbox" name="cause_err13" value="[c13]">13.ไม่ระบุตัวผู้ป่วย<br>&nbsp;
					<input type="checkbox" name="cause_err14" value="[c14]">14.ไม่มียาที่ต้องการในหอผู้ป่วย<br>&nbsp;
					<input type="checkbox" name="cause_err15" value="[c15]">15.งานมากเกินคน<br>&nbsp;
					<input type="checkbox" name="cause_err16" value="[c16]">16.มียา(ค้างยา)<br>&nbsp;
					<input type="checkbox" name="cause_err17" value="[c17]">17.ลืมให้ยา<br>&nbsp;
					<input type="checkbox" name="cause_err18" value="[c18]">18.ไม่มีการตรวจสอบซ้ำ<br>&nbsp;
					<input type="checkbox" name="cause_err19" value="[c19]">19.Telephone Order<br>&nbsp;
					<input type="checkbox" name="cause_err20" value="[c20">20.อื่นๆ (ระบุ) <br>
					&nbsp; &nbsp;<input type="text" name="cause_err20txt" size="40"><br><br>					
					</td>
                </tr>
                <tr>
                  <td bgcolor="#CCFF00">ระดับความรุนแรง :</td>
                  <td colspan="5" bgcolor="#CCFF00">&nbsp;</td>
                </tr>
                <tr align="left" valign="top">
                  <td colspan="6"> -&gt;&gt;
				 	
					<select name='level_err'  id='Txt-Field' >
						<option value=''>เืลือกระดับความรุนแรง</option>
						<option value='A'>A</option>					
						<option value='B'>B</option>
						<option value='C'>C</option>					
						<option value='D'>D</option>
						<option value='E'>E</option>					
						<option value='F'>F</option>
						<option value='G'>G</option>					
						<option value='H'>H</option>
						<option value='I'>I</option>					
					</select>
					
					<a href='lamae_risk_type_details.php' target='_blank' title='คลิกเพื่อดูคำอธิบายรายละเอียดระดับความรุนแรง'>คลิกที่นี่ เพื่อดูรายละเอียดระดับความรุนแรง</a>

				 </td>
                </tr>
                <tr align="center">
                  <td colspan="6"><hr></td>
                  </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                  <td width="123">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td width="150">&nbsp;</td>
                  <td width="153">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="2"><input type="submit" name="submit_err" value="Done"  id='Button'>&nbsp;<input type="reset" value="Clear"  id='Button'></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
			 </form>
<?php
}elseif($submit_err=="Done"){   //check botton submit
		//echo "depart=".$department_id."date=".$date_current2."time=".$time_current;
		//echo "detail=".$detail_err."iplog=".$ip_Log;
		//echo "level=".$level_err;
if(($s_hour>23 or  $s_hour<0) or  ($s_minute>59 or  $s_minute<0) or ($s_second>59 or  $s_second<0)){ //time
					echo "<center><h2>ท่านกรอกข้อมูลเกี่ยวกับเวลาไม่ถูกต้อง....รอสักครู่</h2></center>";
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;  URL=$PHP_SELF'>";
}else{
		$time_current=date("H:i:s");$h=date("H");$mm=date("i");$s=date("s");//time cuurent

		if(strlen($smonth)==1){$s_m="0".$smonth;}else{$s_m=$smonth;}		
		if(strlen($sdate)==1){$s_d="0".$sdate;}else{$s_d=$sdate;}
		//$d_calen=explode("-",$_GET['carlender']);//echo $d_calen[2];
		//$date_report=($d_calen[2]-543)."-".$d_calen[1]."-".$d_calen[0];//echo $date_time_current;exit();
	 	if($s_hour){ //hour
				if(strlen($s_hour)==1){$s_h="0".$s_hour;}else{$s_h=$s_hour;}		
		}else{
				$s_h=$h;
		}
		
	 if($s_minute){ //minute
		if(strlen($s_minute)==1){$s_min="0".$s_minute;}else{$s_min=$s_minute;}	
	 }else{
				$s_min=$mm;
	 }

	 if($s_second){ //second
		if(strlen($s_second)==1){$s_se="0".$s_second;}else{$s_se=$s_second;}		
	 }else{
				$s_se=$s;
	 }

		$date_report=$syear."-".$s_m."-".$s_d;
		$time_report=$s_h.":".$s_min.":".$s_se;//echo $time_report;exit();
 if(trim($detail_err)<>"" ){//data empty	
		$detail_error=trim($detail_err);
		if($prescribing_err7){ //prescribing choice
			if(!$prescribing_err7txt){$prescribing_err7txt="ไม่ระบุ";}
			$prescribing=$prescribing_err1.$prescribing_err2.$prescribing_err3.$prescribing_err4.$prescribing_err5.$prescribing_err6.$prescribing_err7.":".$prescribing_err7txt."]";
		}else{
			$prescribing=$prescribing_err1.$prescribing_err2.$prescribing_err3.$prescribing_err4.$prescribing_err5.$prescribing_err6;//.$prescribing_err7."]";
		}
		//echo $prescribing;
		if($order_process_err7){ //order_process choice
			if(!$order_process_err7txt){$order_process_err7txt="ไม่ระบุ";}
			
			$order_process=$order_process_err1.$order_process_err2.$order_process_err3.$order_process_err4.$order_process_err5.$order_process_err6.$order_process_err7.":".$order_process_err7txt."]";
		
		}else{

			$order_process=$order_process_err1.$order_process_err2.$order_process_err3.$order_process_err4.$order_process_err5.$order_process_err6;//.$order_process_err6."]";
		}


		//echo $order_process;
		if($despen_err5){ //despen choice
			if(!$despen_err5txt){$despen_err5txt="ไม่ระบุ";}
			$despen_err=$despen_err1.$despen_err2.$despen_err3.$despen_err4.$despen_err5.":".$despen_err5txt."]";
		}else{
			$despen_err=$despen_err1.$despen_err2.$despen_err3.$despen_err4;//$despen_err5."]";
		}
		//echo $despen_err;
		if($admin_err12){ //admin err choice
			if(!$admin_err12txt){$admin_err12txt="ไม่ระบุ";}
			$admin_err=$admin_err1.$admin_err2.$admin_err3.$admin_err4.$admin_err5.$admin_err6.$admin_err7.$admin_err8.$admin_err9.$admin_err10.$admin_err11.$admin_err12.":".$admin_err12txt."]";
		}else{
			$admin_err=$admin_err1.$admin_err2.$admin_err3.$admin_err4.$admin_err5.$admin_err6.$admin_err7.$admin_err8.$admin_err9.$admin_err10.$admin_err11;//.$admin_err12txt."]";
		}
		//echo $admin_err;
		if($cause_err20){ //admin err choice
			if(!$cause_err20txt){$cause_err20txt="ไม่ระบุ";}
			$cause_err=$cause_err1.$cause_err2.$cause_err3.$cause_err4.$cause_err5.$cause_err6.$cause_err7.$cause_err8.$cause_err9.$cause_err10
			.$cause_err11.$cause_err12.$cause_err13.$cause_err14.$cause_err15.$cause_err16.$cause_err17.$cause_err18.$cause_err19.$cause_err20.":".$cause_err20txt."]";
		}else{
			$cause_err=$cause_err1.$cause_err2.$cause_err3.$cause_err4.$cause_err5.$cause_err6.$cause_err7.$cause_err8.$cause_err9.$cause_err10
			.$cause_err11.$cause_err12.$cause_err13.$cause_err14.$cause_err15.$cause_err16.$cause_err17.$cause_err18.$cause_err19;//.$cause_err20."]";
		}
		//echo $cause_err;
//sql insert med err
			
$sqlMed_insert ="INSERT INTO medication_err(user_err,depart_code,err_date_report,err_time_report,err_date,err_time,patient_type,detail_err,prescrib_err,order_process_err,dispens_err, ";//table name in database


			
$sqlMed_insert .="adminis_err,cause,level_code) ";
$sqlMed_insert .="VALUE ('$ip_Log','$department_id','$date_current2','$time_current','$date_report','$time_report','$patient_type','$detail_error','$prescribing','$order_process','$despen_err','$admin_err','$cause_err','$level_err') ";


					mysql_query($sqlMed_insert)
					or die ("ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font><br><a href='result_chlogin.php'>หน้าหลัก</a></center>".mysql_error());
					
					echo "<center><h2>บันทึกข้อมูลในฐานข้อมูล เรียบร้อยแล้ว....รอสักครู่</h2></center>";
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;  URL=$PHP_SELF'>";
 }else{ //data empty
		print"<script>
		alert(\"ยังไม่ระบุเรื่อง...กรุณากรอกข้อมูล!!...\");
		history.back(-1);
		</script>";
 }//data empty
}//time
} //check botton submit
?>			  </td>
            </tr>
            <tr>
              <td colspan="2"><!-- end สร้างกรอบตาราง --></td>
            </tr>
            <tr align="center" valign="top">
              <td colspan="2">
			</td>
            </tr>
            <tr align="center">
              <td colspan="2">Development By <b>ฝ่ายงานไอที โรงพยาบาลละแม </b> CopyRight &copy; 02-2010<br>
                <b>Lamae Hospital.</b> All right reserved</td>
            </tr>
            <tr>
              <td width="337">&nbsp;</td>
              <td width="282">&nbsp;</td>
            </tr>
          </table>            
          </td>
          <td width="139" align="center" valign="top" class="td-right"><table width="140" border="1" cellspacing="0" cellpadding="0">
            <tr>
              <th width="129" background="img_mian/bgcolor2.gif" scope="col">รายงาน</th>
            </tr>
            <tr>
              <td class="td-left">
			  
					&nbsp; - <a href="med_report.php" title="รายงานความผิดพลาดทางยา">ความผิดพลาดทางยา</a><br>

					&nbsp; - <a href="med_report_level.php" title="รายงานสรุประดับความผิดพลาดทางยา">ระดับความผิดพลาดทางยา</a><br>
			  
                &nbsp; - <a href="#closeform">ปิดหน้าต่าง</a> <br>
				</td>
            </tr>
          </table><br>
<!--counter -->
           
</td>
        </tr>
        <tr>
          <td height="16" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"javascript:history.back(-1)\">ย้อนกลับ</a>" ?>&nbsp;|</td>
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
<?php 
}//ch online
CloseDB(); //close connect db ?>
</body>
</html>
