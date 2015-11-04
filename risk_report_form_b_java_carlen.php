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


<SCRIPT language=JavaScript src="js/calendar.js"></SCRIPT>
<LINK href="css/calendar-mos.css" type="text/css" rel="stylesheet">
<LINK href="css/style_sheet.css" type="text/css" rel="stylesheet">

<?php
	//protect by change user in program by online
	$ip=get_ip();
	$online=Check_Online($ip); //func check online
if(!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line
				if($online){$ip_Log=user_change($ip);}else{$ip_Log=$_SESSION['ip_Log'];}
?>
<body>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="800"><table width="800" cellpadding="0" cellspacing="0">
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
              <td height="24" colspan="2" class="headmenu" background="img_mian/bgcolor2.gif">แบบฟอร์มรายงานอุบัติการณ์ / ข้อร้องเรียน</td>
            </tr>
            <tr>
              <td colspan="2" valign="top" bgcolor="#3399CC">&nbsp;<strong>รายการ</strong> - &gt; <strong>รายงานอุบัติการ / ข้อร้องเรียน</strong> | 
			    <?php
			$aright=array("ADMIN","Risk_Review");$aright2=array("Risk_Review");
			//echo $online;
			if($online){$right=access_right($ip_Log);}else{$right=$_SESSION["right"];}
			//if(isset($_SESSION["right"])){$right=$_SESSION["right"];}else{$right=access_right($ip_Log);}
			//echo "Access".$right;
  			/*if(check_right($right,"Risk_Review")==1 or check_right($right,"Risk_Review")==2){
			  			print"<a href=\"risk_report_review.php?ip_Log=$_SESSION[ip_Log]\">รายการอุบัติการณ์</a>";
			  	}else{
			  			print"รายการอุบัติการณ์";
			  	} */
  			if((check_right($right,$aright)!==2) and (check_right($right,$aright2)!==1)){
			  		print"&nbsp;อุบัติการ / ข้อร้องเรียน";
			  	}else{
			  			print"&nbsp;<a href=\"risk_report_review.php?ip_Log=$_SESSION[ip_Log]\">อุบัติการ / ข้อร้องเรียน</a>";
			  	}
			  ?> 
			    | </td>
              </tr>
            <tr align="center">
              <td colspan="2"><br>
	<?php 
	$d=date("d");$m=date("n");$y=date("Y"); //date in the day ,month 05->m,5->n
	$date_current=$d." ".change_month_isThai($m)." ".($y+543); //date cuurent thai
	$time_current=date("H:i:s");//time cuurent
	if($submit_risk==""){ //check botton submit?>
			 <form method="get" name="frisk_report"  action="<?php $PHP_SELF; ?>">
			   <table width="625" border="0" cellpadding="2" cellspacing="0"  class="bd-external">
                <tr align="center" bgcolor="#3399CC">
                  <td colspan="6" class="headmenu">รายงานอุบัติการณ์ / ข้อร้องเรียน</td>
                  </tr>
                <tr>
                  <td bgcolor="#FFFFFF">คุณคือ : </td>
                  <td colspan="2" bgcolor="#FFFFFF"><?php echo "<font color='red'><b>".$ip_Log."</b></font>"; ?></td>
                  <td align="right" bgcolor="#FFFFFF">วันที่ปัจจุบัน : </td>
                  <td colspan="2" bgcolor="#FFFFFF"><?php echo  "<font color='red'><b>".$date_current."</b></font>"; ?></td>
                  </tr>
                
                <tr>
                  <td colspan="6"><hr></td>
                  </tr>
                <tr>
                  <td>เรื่อง : </td>
                  <td colspan="5"><input type="text" name="subject" size="80"   id='Txt-Field'></td>
                </tr>
                <tr>
                  <td width="91">หน่วยงาน : </td>
                  <td colspan="5">
				  <?php
				  $sqlS_Department="SELECT * FROM hospital_department ";$resultS_Department=ResultDB($sqlS_Department);
				 if(mysql_num_rows($resultS_Department)>0){
					print"<select name='department_id'  style='color:blue;background:gold' id='Txt-Field'>";
						print "<option>- - เลือกหน่วยงานที่เกิดอุบัติการณ์ - -</option>";
						for($i=0;$i<mysql_num_rows($resultS_Department);$i++){
						$rsS_Department=mysql_fetch_array($resultS_Department);
						print "<option value='".$rsS_Department['id']."'>".$rsS_Department['name']."</option>";
						}										    
					print"</select>";
				  }else{
				  	print"<input type='text' name='department_id' size='25'>";
				  }
				  ?></td>
                  </tr>
                <tr>
                  <td> เชื่อมโยงโปรแกรม :</td>
                  <td colspan="5"><?php
				 $sqlS_relation="SELECT * FROM risk_relation_program ";$resultS_relation=ResultDB($sqlS_relation);
				 if(mysql_num_rows($resultS_relation)>0){
					print"<select name='relation_program'  id='Txt-Field' style='color:blue;background:gold' id='Txt-Field'>";
						print "<option>- -เลือกการเชื่อมโยงกับโปรแกรม - -</option>";
						for($i=0;$i<mysql_num_rows($resultS_relation);$i++){
						$rsS_relation=mysql_fetch_array($resultS_relation);
						print "<option value='".$rsS_relation['name']."'>".$rsS_relation['name']."</option>";
						}										    
					print"</select>";
				  }else{
				  	print"<input type='text' name='relation_program' size='25'>";
				  }
				  ?></td>
                  </tr>
                <tr>
                  <td bgcolor="#FFFFFF">ประเภท :</td>
                  <td colspan="5" bgcolor="#FFFFFF">
				<?php
				  $sqlS_type="SELECT * FROM risk_type ";$resultS_type=ResultDB($sqlS_type);
				 if(mysql_num_rows($resultS_type)>0){
					print"<select name='type'  style='color:blue;background:gold' id='Txt-Field'>";
						print "<option>- - เลือกประเภท - -</option>";
						for($i=0;$i<mysql_num_rows($resultS_type);$i++){
						$rsS_type=mysql_fetch_array($resultS_type);
						print "<option value='".$rsS_type['idt']."'>".$rsS_type['typename']."</option>";
						}										    
					print"</select>";
				  }
			?> <font color="blue"><b>*เป็น อุบัติการณ์หรือข้อร้องเรียน</b></font></td>
                </tr>
                <tr>
                  <td>วันที่เกิด : </td>
                  <td colspan="5">
				<?php
				/*	print"<select name='sdate' id='Txt-Field'>";
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
				
				$sqlSyear="select   DISTINCT YEAR(report_date_time) as s_year  from risk_report group by  report_date_time desc  ";
				$result=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				print"<select name='syear'  id='Txt-Field'>";
				if($y<>""){print"<option value='$y'>".($y+543)."</option>";}
					 if(mysql_num_rows($result)>0){
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						print "<option value='".$rs['s_year']."'>".($rs['s_year']+543)."</option>";
						}										    
					}
					print"</select>"; */
				?>				   
		  <input type="text" name="carlender" readonly="true" size="14"  id='Txt-Field'>
          <input type="button" name="Submit" value="ปฏิทิน" onClick="showCalendar('carlender','DD-MM-YYYY')"  id='Button'></td>
                  </tr>
                <tr>
                  <td>ระดับความรุนแรง :</td>
                  <td colspan="5"><?php
				 $sqlS_Level="SELECT * FROM risk_level ";$resultS_Level=ResultDB($sqlS_Level);
				 if(mysql_num_rows($resultS_Level)>0){ //row
					print"<select name='risk_level'  style='color:blue;background:gold' id='Txt-Field'>";
						print "<option>- - เลือกระดับความรุนแรงของอุบัติการณ์ - -</option>";
						for($i=0;$i<mysql_num_rows($resultS_Level);$i++){ //for
						$rsS_Level=mysql_fetch_array($resultS_Level);
						$sub_str=explode(":",$rsS_Level['level_name']);$level_en=$sub_str['0'];$level_text=$sub_str['1'];
								if(strlen($level_text)>75){$text_len75=substr($level_text,0,75)."......";}else{$text_len75=substr($level_text,0,75);}
								print "<option onmouseover=\"this.value='onmouseover fired'\"   onmouseout=\"this.value=''\" value='".$level_en."' title='".$level_text."'>".$level_en."->".$text_len75."</option>";
								//print "<option onmouseover=\"this.value='onmouseover fired'\"   onmouseout=\"this.value=''\" value='".$level_en."' title='".$level_text."'>".$level_en."</option>";
						} //for										    
					print"</select>";
				  }else{ //row
				  	print"<input type='text' name='risk_level' size='30'>";
				  } //row
				  ?></td>
                  </tr>
                
                <tr>
                  <td colspan="2">รายละเอียด : </td>
                  <td width="98">&nbsp;</td>
                  <td width="121">&nbsp;</td>
                  <td width="74">&nbsp;</td>
                  <td width="148">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="5" valign="top"><textarea name="risk_detail" rows="7" cols="60"  id='Txt-Field'>
				  </textarea></td>
                  </tr>
                <tr>
                  <td colspan="2">การแก้ไขเบื้องต้น : </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="5"><textarea name="risk_edit_basic" rows="7" cols="60"  id='Txt-Field'>
				  </textarea></td>
                  </tr>
                <tr>
                  <td colspan="3">ข้อแนะนำเชิงระบบ(ผู้รายงาน) : </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="5"><textarea name="risk_Info_system" rows="7" cols="60"  id='Txt-Field'>
				  </textarea></td>
                  </tr>
                <tr>
                  <td colspan="6">&nbsp;</td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="4" align="center"><input type="submit" name="submit_risk" value="Done"  id='Button'><input type="hidden" name="risk_level_text" value="<?php echo $level_text; ?>">
                    &nbsp;<input type="reset" value="Clear"  id='Button'></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="4" align="center">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
			 </form>
<?php
}elseif($submit_risk=="Done"){   //check botton submit
//echo "Done->department_id:$department_id ,relation_program :$relation_program วันที่ $sdate $smonth $syear<br>";
//echo ",subject :$subject ,detail :$risk_detail ,risk_edit_basic :$risk_edit_basic ,risk_Info_system=$risk_Info_system";
//echo "Login : ".$ip_Log;
//echo "risk_level_text=$risk_level_text ,risk_level :$risk_level ";
//echo $time_current;
//$date_time_current=$syear."-".$smonth."-".$sdate." ".$time_current;//echo $date_time_current;  //original line
if(!$_GET['carlender']){
$date_current=$y."-".$m."-".$d; //date cuurent thai
$time_current=date("H:i:s");//time cuurent
$date_time_current=$date_current." ".$time_current;}else{
$d_calen=explode("-",$_GET['carlender']);//echo $d_calen[2];
$date_time_current=($d_calen[2]-543)."-".$d_calen[1]."-".$d_calen[0]." ".$time_current;
}
echo $date_time_current;exit();
//$risk_level_all=$risk_level." : ".$risk_level_text;//echo $risk_level_all;

//check ready
	//sql check
	$sqlReadyData="SELECT * FROM risk_report_web where subject='$subject' and risk_detail='$risk_detail' and report_user='$ip_Log' ";
	$resultReadyData=ResultDB($sqlReadyData);
		if(mysql_num_rows($resultReadyData)>0){ //row ready
					echo "<center><h2>ข้อมูลดังกล่าวมีการรายงานทางอุบัติการณ์เรียบร้อยแล้ว....รอสักครู่</h2></center>";
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=$PHP_SELF'>";
			}else{ //row ready
//sql insert risk
			$sql_Risk_insert ="INSERT INTO risk_report_web(report_date_time,department_id,subject,risk_level,relation_program,risk_detail,report_user, ";//table name in database
			$sql_Risk_insert.="review_status,review_date_time,review_staff,review_detail,edit_basic,info_system,respond_level_depart,result_follow,all_date_review,type) ";
			$sql_Risk_insert.="VALUE ('$date_time_current','$department_id','$subject','$risk_level','$relation_program','$risk_detail','$ip_Log','N',NULL,NULL,NULL,'$risk_edit_basic','$risk_Info_system',NULL,NULL,NULL,'$type') ";//echo $type;exit();
				if($subject<>"" and trim($risk_detail)<>"" ){//data empty	
				
					mysql_query($sql_Risk_insert)
					or die ("ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font><br><a href='result_login.php'>หน้าหลัก</a></center>".mysql_error());
					
					echo "<center><h2>บันทึกข้อมูลในฐานข้อมูล เรียบร้อยแล้ว....รอสักครู่</h2></center>";
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=$PHP_SELF'>";
					}else{ //data empty
						print"<script>
						alert(\"ยังไม่ระบุเรื่อง...กรุณากรอกข้อมูล!!...\");
						history.back(-1);
						</script>";
					}//data empty

		}//row ready
} //check botton submit
?>			  </td>
            </tr>
            <tr>
              <td colspan="2"><!-- end สร้างกรอบตาราง --></td>
            </tr>
            <tr align="center" valign="top">
              <td colspan="2">			</td>
            </tr>
            <tr align="center">
              <td colspan="2" align="center">Development By <b>กูประจักษ์ ราเหม</b> CopyRight &copy; 04-2006 <b>IM Team Mayo Hospital.</b>All right reserved</td>
            </tr>
            <tr>
              <td width="337">&nbsp;</td>
              <td width="282">&nbsp;</td>
            </tr>
          </table>            
          </td>
          <td width="139" align="center" valign="top" class="td-right"><table width="140" border="1" cellspacing="0" cellpadding="0">
            <tr>
              <th width="129" background="img_mian/bgcolor2.gif" scope="col">รายการ</th>
            </tr>
            <tr>
              <td class="td-left">
			  <?php
			$aright=array("ADMIN","Risk_Review");$aright2=array("Risk_Review");//$right=access_right($ip_Log);//echo "Access".$right;
			if($online){$right=access_right($ip_Log);}else{$right=$_SESSION["right"];}
  			if((check_right($right,$aright)!==2) and (check_right($right,$aright2)!==1)){
			  		print"&nbsp; - อุบัติการ / ข้อร้องเรียน<br>";
			  	}else{
			  			print"&nbsp; - <a href=\"risk_report_review.php?ip_Log=$_SESSION[ip_Log]\">อุบัติการ / ข้อร้องเรียน</a><br>";
			  	}
			  ?>			  
                &nbsp; - <a href="#closeform">ปิดหน้าต่าง</a> <br>
				</td>
            </tr>
          </table>
          <br>
<!--counter -->
            <p align="center"><b><font color="gold">คุณเข้ามาหน้านี้ คนที่ :: <br><marquee direction="up" height="18" width="50" scrolldelay="500"  bgcolor="#FF0000"><u>
			  <?php 
			  //check file
			  if(file_exists("c_risk_from.txt")==false){
			  	$fp=fopen("c_risk_from.txt","w");fputs($fp,0);
				fclose($fp);
			  }
				
			  $filename="c_risk_from.txt";
			  $fp=fopen($filename,"r");
			  $get_number=fread($fp,filesize($filename)); //open read
			  fclose($fp);
			  
			  $get_number=$get_number+1; //sum
			  
			  $fp=fopen($filename,"w"); //open write
			  fwrite($fp,$get_number);
			  fclose($fp);
			  
			  printf("%06d",$get_number); //show
			  ?>
			  </u></marquee></font></b><br>
			  <font color="#FFFFFF">&nbsp;เริ่มนับเมื่อ 25-04-49</font></p></td>
		<!--  </td>--></tr> 
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
    <td height="23">&nbsp;</td>
  </tr>
</table>
<?php 
}//ch online
CloseDB(); //close connect db ?>
</body>
</html>
