<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - Risk Management Report Review - - |</title>
<style type="text/css">
<!--
body {  margin: 0px  0px; padding: 0px  0px}
body{font-family:MS Sans Serif;font-size:10pt}
table,td{font-family:MS Sans Serif;font-size:10pt}
form{font-family:MS Sans Serif;font-size:10pt}
.style1 {
	color: #FFFFFF;
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

<script language="JavaScript">

function popup(popupfile,winheight,winwidth,scrollbars)
{
open(popupfile,"PopupWindow","resizable=no,height=" + winheight + ",width=" + winwidth + ",scrollbars="+scrollbars+"");
}

</script>
 <script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);
}
//-->
</script>
<SCRIPT language=JavaScript src="js/calendar.js"></SCRIPT>
<LINK href="css/calendar-mos.css" type="text/css" rel="stylesheet">
<LINK href="css/style_sheet.css" type="text/css" rel="stylesheet">

</head>
<?php
	$ip=get_ip();
	$online=Check_Online($ip); //func check online
if($online){$ip_Log=user_change($ip);}else{$ip_Log=$_SESSION['ip_Log'];}
	$aright=array("ADMIN","Risk_Review");$aright2=array("Risk_Review");
			//echo $online;
if($online){$right=access_right($ip_Log);}else{$right=$_SESSION["right"];}
/*if((check_right($right,$aright)!==2) and (check_right($right,$aright2)!==1)){ //check access
			print"<br><br><center><h2>ท่านไม่สิทธ์ใช้งานหน้านี้....ครับ</h2></center><br>";
			print"<p align=center><input type='submit' value='ปิดหน้าต่าง'  id='Button' onClick='javascript:window.close();'><br><br>";
			print"Development By <b>Guprajag</b> CopyRight &copy; 04-2006 <b>IM Team Mayo Hospital.</b>All right reserved</p>";
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>"; 
}else{ //check access */

//if (!$_SESSION["ip_Log"] and !Check_Online(get_ip()) and check_right(!$_SESSION['right'],"Risk_Review")==2){ //check  ->off line
if (!$ip_Log and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line
		//if(isset($_SESSION['ip_Log'])){$ip_Log=$_SESSION["ip_Log"];}else{$_SESSION["ip_Log"]=$ip_Log;	}
		//if($online){$ip_Log=user_change($ip);}else{$ip_Log=$_SESSION['ip_Log'];}
		$d=date("d");$m=date("n");$y=date("Y"); //date in the day ,month 05->m,5->n
		$m_zero=date("m");
		$date_current=$d." ".change_month_isThai($m)." ".($y+543); //date cuurent thai no zero monh
		$med_type_err=$_GET['med_type_err'];$select_date=$_GET['select_date']; //press enter button
?>
<body>
<table width="1021" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1021" align="center"><table width="990" cellpadding="0" cellspacing="0">
        <tr> 
          <td colspan="2" valign="top">
<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
		  </td>
        </tr>
        <tr> 
          <td height="24" colspan="2" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC"><?php include("manu.inc"); ?>
          </td>
        </tr>
        <tr> 
          <td height="177" colspan="2" align="center" valign="top" class="td-left"><br>
		  <table width="978" border="0" cellpadding="0" cellspacing="0" class="bd-external">
            <tr align="center" bgcolor="#99CCFF">
              <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> Medication Error Report 
<!--counter -->
       

			  </td>
            </tr>
            <tr>
              <td width="337" valign="top" bgcolor="#3399CC">&nbsp; คุณคือ <font color="red"><b><?php echo $ip_Log;  ?></b></font> :: -&gt; <strong>รายการอุบัติการ</strong> | <a href="medicate_err_form.php">รายงานอุบัติการทางยา</a> | </td>
              <td width="282" bgcolor="#3399CC">&nbsp;<?php echo "<b>วันที่ปัจจุบัน</b> : ".$date_current; ?></td> 
            </tr>
            <tr align="center">
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><!-- end สร้างกรอบตาราง --></td>
            </tr>
            <tr align="center" valign="top">
              <td colspan="2">
			</td>
            </tr>
            <tr align="center">
              <td colspan="2">
<form action="<?php $PHP_SELF ?>" method="get" name="f_select_dmy">
			  <table width="400" border="0" cellspacing="2" cellpadding="1" class="bd-external">
                <tr align="center" bgcolor="#319ACE">
                  <td colspan="3"><u>เลือกช่วงเวลา</u></td>
                </tr>
                <tr>
                  <td colspan="3" align="center">
                    <input type="text" name="carlender1" readonly="true" size="14"  id='Txt-Field' value='<?php if($_GET['carlender1']){echo $_GET['carlender1'];} ?>'>
                <input type="button" name="Submit" value="ปฏิทิน" onClick="showCalendar('carlender1','DD-MM-YYYY')" id='Button'>
                    &nbsp;ถึง &nbsp;
                <input type="text" name="carlender2" readonly="true" size="14"  id='Txt-Field' value='<?php if($_GET['carlender2']){echo $_GET['carlender2'];} ?>'>
                 <input type="button" name="Submit" value="ปฏิทิน" onClick="showCalendar('carlender2','DD-MM-YYYY')"  id='Button'>
				 </td>
                  </tr>
                
                <tr>
                  <td valign="top" bgcolor="#319ACE">&nbsp;เลือกดูรายการ</td>
                  <td colspan="2" bgcolor="#319ACE">
				  <?php if($med_type_err=="all_err" or $select_date!=="Continue"){ ?>
				  &nbsp;
				  <input name="med_type_err" type="radio"  value="all_err" checked="checked">&nbsp;All Error<br>
				  <?php }else{ ?>				  
				  &nbsp;<input name="med_type_err" type="radio"  value="all_err">&nbsp;All Error<br>
				 <?php }  ?>
				 
				  <?php if($med_type_err=="pre_err"){ ?>
				  &nbsp;<input name="med_type_err" type="radio" value="pre_err" checked="checked">&nbsp;Prescribing Error<br>
				  <?php }else{ ?>		
				  &nbsp;<input name="med_type_err" type="radio" value="pre_err">&nbsp;Prescribing Error<br>
				 <?php }  ?>

				  <?php if($med_type_err=="order_err"){ ?>
				  &nbsp;<input name="med_type_err" type="radio" value="order_err" checked="checked">&nbsp;Order Processing Error<br>
				  <?php }else{ ?>		
				  &nbsp;<input name="med_type_err" type="radio" value="order_err">&nbsp;Order Processing Error<br>
				 <?php }  ?>

				  <?php if($med_type_err=="disp_err"){ ?>
				  &nbsp;<input name="med_type_err" type="radio" value="disp_err" checked="checked">&nbsp;Dispensing Error<br>
				  <?php }else{ ?>		
				  &nbsp;<input name="med_type_err" type="radio" value="disp_err">&nbsp;Dispensing Error<br>
				 <?php }  ?>

				  <?php if($med_type_err=="admin_err"){ ?>
				  &nbsp;<input name="med_type_err" type="radio" value="admin_err" checked="checked">&nbsp;Administration Error<br>
				  <?php }else{ ?>		
				  &nbsp;<input name="med_type_err" type="radio" value="admin_err">&nbsp;Administration Error<br>
				 <?php }  ?>                  </td>
                <tr>
                  <td>&nbsp;</td>
                  <td align="left">&nbsp;<input name='select_date' type='submit' value='Continue' id='Button'></td>
                  <td>&nbsp;</td>
                </tr>
              </table>
</form></td>
            </tr>
            <tr>
              <td>&nbsp;<?php //echo "login".$_SESSION['ip_Log']; ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr align="center" valign="top">
              <td colspan="2">
			  <?php
				//if(strlen($sd1)==1){$sd1="0".$sd1;}
				//if(strlen($sd2)==1){$sd2="0".$sd2;}
				//if(strlen($sm1)==1){$sm1="0".$sm1;}
				//if(strlen($sm2)==1){$sm2="0".$sm2;}

			//$d1=$sy1."-".$sm1."-".$sd1;
			//$d2=$sy2."-".$sm2."-".$sd2;//echo $d1."dd".$d2;
			
			$d_calen1=explode("-",$_GET['carlender1']);//echo $d_calen1[2];
			$d1=($d_calen1[2]-543)."-".$d_calen1[1]."-".$d_calen1[0];
			//calenda2
			$d_calen2=explode("-",$_GET['carlender2']);//echo $d_calen2[2];
			$d2=($d_calen2[2]-543)."-".$d_calen2[1]."-".$d_calen2[0];


if($select_date=="Continue" and $med_type_err=="all_err") { //ch med and select date
//sql select review date select
$sqlMedAll="SELECT err_id,err_date_report,err_date,err_time,detail_err,prescrib_err ";
//$sqlMedAll.=",order_process_err,dispens_err,adminis_err,cause,left(r.level_name,1) as level_err ";
$sqlMedAll.=",order_process_err,dispens_err,adminis_err,cause,level_code ";
$sqlMedAll.="FROM medication_err m ";
//$sqlMedAll.="left outer join risk_level r on left(r.level_name,1)=m.level_code ";
$sqlMedAll.="where err_date between '$d1' and  '$d2' order by err_date,err_time desc ";
		 //create tr in table
			//sql select review date select
				$result=ResultDB($sqlMedAll);
					
					 
					 if(mysql_num_rows($result)>0){ //r sql1
						
						print"<p align='center'><u><font color='#319ACE'><b>แสดงข้อมูลของวันที่ $d_calen1[0] เดือน ".change_month_isThai($d_calen1[1])." ปี ".$d_calen1[2]." ถึงวันที่ $d_calen2[0] เดือน ".change_month_isThai($d_calen1[1])." ปี ".$d_calen1[2];
						print" มีทั้งหมด <font color='red'>".mysql_num_rows($result)."</font> รายการ</b></font></u></p>";
		?>
				<table width="970" border="0" cellspacing="1" cellpadding="1" class="bd-external">
                <tr align="center" bgcolor="#319ACE">
                  <td width="35">ลำดับ</td>
				  <td width="35">แก้ไข</td>
                  <td width="72">ว/ด/ป</td>
                  <td width="242" bgcolor="#319ACE">รายละเอียด</td>
                  <td width="101" bgcolor="#319ACE">Prescribing</td>
                  <td width="134">Order Processing </td>
                  <td width="98">Dispensing</td>
                  <td width="99">Administration</td>
                  <td width="75">สาเหตุ</td>
                  <td width="51">ระดับ</td>
                </tr>
		<?php
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						if($bg=='#FFFFFF'){
						$bg="#FFFFCC";}else{$bg='#FFFFFF';}
						print"<tr bgcolor='$bg'>";
                   		print"<td align='center' valign='top'>".($i+1)."</td>";
						print"<td align='center' valign='top'><a href='med_edit_frm.php?err_id=$rs[err_id]' title='แก้ไขรายการนี้'><font color='blue'>แก้ไข</font></a></td>";

                   		print"<td align='center' valign='top'>&nbsp;<a href='med_delete_frm.php?err_id=$rs[err_id]' title='ลบรายการนี้' target='_blank'>".FormatDate($rs['err_date'])."</a></td>";
						print"<td align='left' valign='top'>&nbsp;<a title='$rs[detail_err]' href='#' onclick=\"MM_openBrWindow('med_show_detail.php?err_id=$rs[err_id]&Theme=$Theme&ip_Log=$ip_Log','','resizable=no,width=850,height=500,scrollbars=yes')\">".$rs['detail_err']."</a></td>";
                   		print"<td align='left' valign='top'>&nbsp;".$rs['prescrib_err']."</td>";
						print"<td align='left' valign='top'>&nbsp;".$rs['order_process_err']."</td>";
                   		print"<td align='left' valign='top'>&nbsp;".$rs['dispens_err']."</td>";
                   		print"<td align='left' valign='top'>&nbsp;".$rs['adminis_err']."</td>";
                   		print"<td align='left' valign='top'>&nbsp;".$rs['cause']."</td>";
                   		print"<td align='center' valign='top'>&nbsp;".$rs['level_code']."</td>";
                   		print"</tr>";}//for
			?>
              </table>
			  <br><br>
	<?php
			$exp_file="med";
		//print"<br><br><img src='img_mian/excel_icon.gif' align='middle'>&nbsp;<a href='excel_export.php?sy1=$sy1&sm1=$sm1&sd1=$sd1&sy2=$sy2&sm2=$sm2&sd2=$sd2&exp_file=$exp_file&med_type_err=$med_type_err'>Excel Export File</a><br><br>";
			print"<br><br><img src='img_mian/excel_icon.gif' align='middle'>&nbsp;<a href='excel_export.php?sy1=$d_calen1[2]&sm1=$d_calen1[1]&sd1=$d_calen1[0]&sy2=$d_calen2[2]&sm2=$d_calen2[1]&sd2=$d_calen2[0]&exp_file=$exp_file&med_type_err=$med_type_err'>Excel Export File</a><br><br>";
		print"<form><input type=button value='Refresh' onClick='javascript:location.reload();' id='Button'></form>";
	  }else{ //r sql1
			print "<center><font color='#319ACE'><h2>ไม่มีรายการ</h2></font></center>";
	 }//r sql1
 }elseif($select_date="Continue" and $med_type_err!=="all_err"){ //ch med and select date
//select type med	
$sqlMedType="SELECT err_id,err_date_report,err_date,err_time,detail_err,prescrib_err
,order_process_err,dispens_err,adminis_err,cause,left(r.level_name,1) as level_err
FROM medication_err m
left outer join risk_level r on left(r.level_name,1)=m.level_code
where err_date between '$d1' and  '$d2' ";
if($med_type_err=="pre_err"){
$sqlMedType.="and prescrib_err <>'' order by err_date,err_time desc ";
$title_err="Prescribing";
}elseif($med_type_err=="order_err"){
$sqlMedType.="and order_process_err <>'' order by err_date,err_time desc ";
$title_err="Order Processing";
}elseif($med_type_err=="disp_err"){
$sqlMedType.="and dispens_err <>'' order by err_date,err_time desc ";
$title_err="Dispensing";
}elseif($med_type_err=="admin_err"){
$sqlMedType.="and adminis_err <>'' order by err_date desc ";
$title_err="Administration";
}	
       //create tr in table
				$result=ResultDB($sqlMedType);
					 if(mysql_num_rows($result)>0){ //r sql2
						print"<p align='center'><u><font color='#319ACE'><b>แสดงข้อมูลของวันที่ $d_calen1[0] เดือน ".change_month_isThai($d_calen1[1])." ปี ".$d_calen1[2]." ถึงวันที่ $d_calen2[0] เดือน ".change_month_isThai($d_calen1[1])." ปี ".$d_calen1[2];
						print" มีทั้งหมด <font color='red'>".mysql_num_rows($result)."</font>รายการ</b></font></u></p>";
					?>
			<table width="750" border="0" cellspacing="1" cellpadding="1" class="bd-external">
			  <tr align="center" bgcolor="#319ACE">
				<td width="41">ลำดับ</td>
				<td width="83">ว/ด/ป</td>
				<td width="339" bgcolor="#319ACE">รายละเอียด</td>
				<td width="117" bgcolor="#319ACE"><?php echo $title_err; ?></td>
				<td width="88">สาเหตุ</td>
				<td width="63">ระดับ</td>
			  </tr>
		<?php
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						if($bg=='#FFFFFF'){
						$bg="#FFFFCC";}else{$bg='#FFFFFF';}
						print"<tr bgcolor='$bg'>";
                   		print"<td align='center' valign='top'>".($i+1)."</td>";
                   		print"<td align='center' valign='top'>&nbsp;".FormatDate($rs['err_date'])."</td>";
						print"<td align='left' valign='top'>&nbsp;<a title='$rs[detail_err]' href='#' onclick=\"MM_openBrWindow('med_show_detail.php?err_id=$rs[err_id]&Theme=$Theme&ip_Log=$ip_Log','','resizable=no,width=850,height=500,scrollbars=yes')\">".$rs['detail_err']."</a></td>";

						if($med_type_err=="pre_err"){
                   		print"<td align='left' valign='top'>&nbsp;".$rs['prescrib_err']."</td>";
						}elseif($med_type_err=="order_err"){
						print"<td align='left' valign='top'>&nbsp;".$rs['order_process_err']."</td>";
						}elseif($med_type_err=="disp_err"){
                   		print"<td align='left' valign='top'>&nbsp;".$rs['dispens_err']."</td>";
						}elseif($med_type_err=="admin_err"){
                   		print"<td align='left' valign='top'>&nbsp;".$rs['adminis_err']."</td>";
						}	
                   		print"<td align='left' valign='top'>&nbsp;".$rs['cause']."</td>";
                   		print"<td align='center' valign='top'>&nbsp;".$rs['level_err']."</td>";
                   		print"</tr>";}//for
			?>
              </table>
			  <br><br>
	 <?php
				$exp_file="med";
			print"<br><br><img src='img_mian/excel_icon.gif' align='middle'>&nbsp;<a href='excel_export.php?sy1=$d_calen1[2]&sm1=$d_calen1[1]&sd1=$d_calen1[0]&sy2=$d_calen2[2]&sm2=$d_calen2[1]&sd2=$d_calen2[0]&exp_file=$exp_file&med_type_err=$med_type_err'>Excel Export File</a><br><br>";
			print"<form><input type=button value='Refresh' onClick='javascript:location.reload();' id='Button'></form>";
		   }else{ //r sql1
				print "<center><font color='#319ACE'><h2>ไม่มีรายการ</h2></font></center>";
		  }//r sql1
	} //ch med and select date
	?>
			  </td>
              </tr>
            <tr>
              <td height="59" colspan="2"  align="center">&nbsp;</td>
              </tr>
          </table>            
          <!-- form -->
              <!-- end form --></td>
        </tr>
        <tr>
          <td height="16" colspan="2" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"javascript:history.back(-1)\">ย้อนกลับ</a>" ?>&nbsp;|</td>
        </tr>
        <tr> 
          <td width="659" height="16" valign="top"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td width="140" height="16" valign="top">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23"><div align="center">Development By <b>ไอที ละแม </b> CopyRight &copy; 03-2010 
        <b>IT Team Lamae Hospital.</b>All right reserved
        <br>
      </div></td>
  </tr>
</table>
<?php 
  }//ch online
//}//check access
CloseDB(); //close connect db ?>
</body>
</html>
