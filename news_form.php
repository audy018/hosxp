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

	<script language="javascript" src="Script/codethatcalendarstd.js"></script>
	<script language="javascript" src="Samples/iframe_ex.js"></script>
	<script language="javascript">
		var c1 = new CodeThatCalendar(caldef1);
</script>
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
              <td height="24" colspan="2" class="headmenu" background="img_mian/bgcolor2.gif">ระบบประกาศข่าว <?php echo "&nbsp;".$Hospname."&nbsp;"; ?></td>
            </tr>
            <tr align="center" valign="top">
              <td colspan="2"><br>
	<?php 
	$d=date("d");$m=date("n");$y=date("Y");$m2=date("m"); //date in the day ,month 05->m,5->n
	$date_current=$d." ".change_month_isThai($m)." ".($y+543); //date cuurent thai show
	$date_current2=$y."-".$m2."-".$d; //date cuurent add to db
	$time_current=date("H:i:s");//time cuurent
	if($submit_err==""){ //check botton submit?>
			 <form method="get" name="frisk_report"  action="<?php $PHP_SELF; ?>">
			   <table width="640" border="0" cellpadding="1" cellspacing="1"  class="bd-external">
                <tr align="center" bgcolor="#3399FF">
                  <td colspan="6" class="headmenu">แบบฟอร์มประกาศข่าว</td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE">Login : </td>
                  <td width="478" colspan="5">
                    <?php echo "<font color='red'><b>".$ip_Log."</b></font>"; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#319ACE">วัน/เวลาปัจจุบัน : </td>
                  <td colspan="5"><?php echo $date_current."  เวลา : ".$time_current; ?></td>
                </tr>
                <tr>
                  <td width="140" bgcolor="#319ACE">หัวเรื่อง : * </td>
                  <td colspan="5">				  <input type="text" name="cause_err20txt" size="80"></td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE">รายละเอียด : * </td>
                  <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="5" valign="top"><textarea name="detail_err" rows="5" cols="65"  id='Txt-Field'></textarea></td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE">URL : </td>
                  <td colspan="5"><input type="text" name="cause_err20txt2" size="40"> 
                    * หากไม่มี ไม่ต้องกรอกข้อมูล</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="5"><input type="submit" name="submit_err" value="Save"  id='submit_err2'>
                    &nbsp;
                    <input name="reset" type="reset"  id='submit_err2' value="Clear"></td>
                </tr>
              </table>
			 </form>
<?php
}elseif($submit_err=="Done"){   //check botton submit
		//echo "depart=".$department_id."date=".$date_current2."time=".$time_current;
		//echo "detail=".$detail_err."iplog=".$ip_Log;
		//echo "level=".$level_err;
 if(trim($detail_err)<>"" ){//data empty	
		$detail_error=trim($detail_err);
		if($prescribing_err7){ //prescribing choice
			if(!$prescribing_err7txt){$prescribing_err7txt="ไม่ระบุ";}
			$prescribing=$prescribing_err1.$prescribing_err2.$prescribing_err3.$prescribing_err4.$prescribing_err5.$prescribing_err6.$prescribing_err7.":".$prescribing_err7txt."]";
		}else{
			$prescribing=$prescribing_err1.$prescribing_err2.$prescribing_err3.$prescribing_err4.$prescribing_err5.$prescribing_err6;//.$prescribing_err7."]";
		}
		//echo $prescribing;
		if($order_process_err6){ //order_process choice
			if(!$order_process_err6txt){$order_process_err6txt="ไม่ระบุ";}
			$order_process=$order_process_err1.$order_process_err2.$order_process_err3.$order_process_err4.$order_process_err5.$order_process_err6.":".$order_process_err6txt."]";
		}else{
			$order_process=$order_process_err1.$order_process_err2.$order_process_err3.$order_process_err4.$order_process_err5;//.$order_process_err6."]";
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
			$sqlMed_insert ="INSERT INTO medication_err(user_err,depart_code,err_date,err_time,detail_err,prescrib_err,order_process_err,dispens_err, ";//table name in database
			$sqlMed_insert .="adminis_err,cause,level_code) ";
			$sqlMed_insert .="VALUE ('$ip_Log','$department_id','$date_current2','$time_current','$detail_error','$prescribing','$order_process','$despen_err','$admin_err','$cause_err','$level_err') ";
					mysql_query($sqlMed_insert)
					or die ("ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font><br><a href='result_login.php'>หน้าหลัก</a></center>".mysql_error());
					
					echo "<center><h2>บันทึกข้อมูลในฐานข้อมูล เรียบร้อยแล้ว....รอสักครู่</h2></center>";
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;  URL=$PHP_SELF'>";
 }else{ //data empty
		print"<script>
		alert(\"ยังไม่ระบุเรื่อง...กรุณากรอกข้อมูล!!...\");
		history.back(-1);
		</script>";
 }//data empty

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
              <td colspan="2">Development By <b>Programmer</b> CopyRight &copy; 06-2006<br>
                <b>IM Team Mayo Hospital.</b>All right reserved</td>
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
			  $aright=array("ADMIN");$right=access_right($ip_Log);//echo "Access".$right;
  				if(check_right($right,$aright)==0){
			  		print"&nbsp; - รายการอุบัติการณ์<br>";
			  	}else{
			  		//print"&nbsp; - รายการอุบัติการณ์<br>";
			  		print"&nbsp; - <a href=\"risk_report_review.php\">รายการอุบัติการณ์</a><br>";
			  	}
			  ?>			  
                &nbsp; - <a href="#closeform">ปิดหน้าต่าง</a> <br>
				</td>
            </tr>
          </table></td>
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
