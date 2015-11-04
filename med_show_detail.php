<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB(); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - Medication Error Detail - - |</title>
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
<SCRIPT LANGUAGE="JavaScript">
<!-- hide this script tag's contents from old browsers
function goHist(a) 
{
   history.go(a);      // Go back one.
}
//<!-- done hiding from old browsers -->
</script>

</head>
<?php
	$ip=get_ip();
	$online=Check_Online($ip); //func check online
if($online){$ip_Log=user_change($ip);}else{$ip_Log=$_SESSION['ip_Log'];}
//	$aright=array("ADMIN","Risk_Review");$aright2=array("Risk_Review");
			////echo $online;
//if($online){$right=access_right($ip_Log);}else{$right=$_SESSION["right"];}
//if((check_right($right,$aright)!==2) and (check_right($right,$aright2)!==1)){ //check access
			////echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
//			print"<br><br><center><h2>ท่านไม่สิทธ์ใช้งานหน้านี้....ครับ</h2></center><br>";
//			print"<p align=center><input type='submit' value='ปิดหน้าต่าง'  id='Button' onClick='javascript:window.close();'><br><br>";
//			print"Development By <b>Guprajag</b> CopyRight &copy; 04-2006 <b>IM Team Mayo Hospital.</b>All right reserved</p>";
			
//}else{ //check access
	////if(isset($_SESSION['ip_Log'])){$ip_Log=$_SESSION["ip_Log"];}else{$_SESSION["ip_Log"]=$ip_Log;	}
	////protect by change user in program by online
//if (!$_SESSION["ip_Log"] and !Check_Online(get_ip()) and check_right(!$_SESSION['right'],"Risk_Review")==2){ //check  ->off line
if (!$ip_Log and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line
	//echo "online".$online;
	$err_id=$_GET['err_id'];//echo $risk_id;
	$Theme=$_GET['Theme'];//echo $Theme;
	$_SESSION['Theme']=$Theme;
?>
<body>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr> 
          <td valign="top">
<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
		  </td>
        </tr>
        <tr> 
          <td height="177" align="center" valign="top" class="td-left"><?php //echo $_SERVER['REQUEST_URI']; ?><br>
		  <table width="600" border="0" cellpadding="0" cellspacing="0" class="bd-external">
            <tr align="center" bgcolor="#99CCFF">
              <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu">รายละเอียดของ Medication Error </td>
            </tr>
            <tr>
              <td width="337" valign="top" bgcolor="#3399CC">&nbsp; คุณคือ <font color="red"><b><?php echo $ip_Log;  ?></b></font> :: - &gt; <a href="#closeform">ปิดหน้าต่าง</a></td>
              <td width="282" bgcolor="#3399CC" align="left">&nbsp;</td> 
            </tr>
            <tr align="center" valign="top">
              <td colspan="2">
	<?php 
	$d=date("d");$m=date("n");$y=date("Y"); //date in the day ,month 05->m,5->n
	$date_current=$d." ".change_month_isThai($m)." ".($y+543); //date cuurent thai
	$time_current=date(" H:i:s");//time cuurent
	//sql form id
	//echo "risk_id=".$risk_id."subject=".$subject;
	$sqlDetail="SELECT m.*,right(r.level_name,length(r.level_name)-2) as n_level,h.name as depart_name,o.name as user_name ";
	$sqlDetail.="FROM medication_err m ";
	$sqlDetail.="left outer join risk_level r on left(r.level_name,1)=m.level_code ";
	$sqlDetail.="left outer join hospital_department h on h.id=m.depart_code ";
	$sqlDetail.="left outer join opduser o on o.loginname=m.user_err ";
	$sqlDetail.="where m.err_id='$err_id' ";

	$result=ResultDB($sqlDetail);//echo mysql_num_rows($result);
	$rs=mysql_fetch_array($result);
	?>
	<br>
			  <table width="550" border="0" cellspacing="1" cellpadding="2">
                <tr align="center">
                  <td colspan="4" bgcolor="#319ACE"><span class="headmenu">รายละเอียดทั้งหมด</span></td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp;id : </td>
                  <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['err_id'];  ?></td>
                </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp;ผู้รายงาน : </td>
                  <td colspan="3" bgcolor="#FFFFCC">&nbsp;<font color="red"><b><?php echo $rs['user_err']."(".$rs['user_name']." )";  ?></b></font></td>
                </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp;วัน/เวลา ที่รายงาน : </td>
                  <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo dateThai($rs['err_date_report'])." เวลา : ".$rs['err_time_report']; ?></td>
                </tr>
                <tr>
                  <td width="151" bgcolor="#319ACE">&nbsp;วัน/เวลา ที่เกิดเหตุ : </td>
                  <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo dateThai($rs['err_date'])." เวลา : ".$rs['err_time']; ?></td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE"> &nbsp;หน่วยงาน :</td>
                  <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['depart_name']; ?></td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp;เกิดกับผู้ป่วย : </td>
                  <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php if($rs['patient_type']=="OPD"){echo "ผู้ป่วยนอก";}elseif($rs['patient_type']=="IPD"){echo "ผู้ป่วยใน";} ?></td>
                  </tr>
                <tr>
                  <td valign="top" bgcolor="#319ACE">&nbsp;รายละเอียด :</td>
                  <td colspan="3" valign="top" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['detail_err']; ?></td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE" valign="top">&nbsp;Prescribing Error : </td>
                  <td colspan="3" valign="top" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['prescrib_err']; ?></td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp;Order Processing Error : </td>
                  <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['order_process_err']; ?></td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp;Dispensing Error : </td>
                  <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['dispens_err']; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp;Administration Error :</td>
                  <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['adminis_err']; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp;สาเหตุ :</td>
                  <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['cause']; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp;ระดับความรุนแรง :</td>
                  <td colspan="3" bgcolor="#FFFFCC">&nbsp;<font color="red"><b><?php echo $rs['level_code']." ( ".$rs['n_level']." ) "; ?></b></font></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;<?php //echo $ip_Log; ?></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td width="217">
			<form method="get">
			<input type='submit' value='ปิดหน้าต่าง'  id='Button' onClick='javascript:window.close();'>
			<SCRIPT LANGUAGE="JavaScript">
			<!-- Begin print
			if (window.print) {
			document.write('<input type=button id=Button name=print value="พิมพ์ครับ" '
			+ 'onClick="javascript:window.print()">');
			}
			// End -->
			</script>
			<?php
			/*$aright=array("ADMIN","Risk_Review");$aright2=array("Risk_Review");$right=access_right($ip_Log);//echo "Access".$right;
  			if((check_right($right,$aright)!==2) and (check_right($right,$aright2)!==1)){
				print"<input type='submit' value='ปิดหน้าต่าง'  id='Button' onClick='javascript:window.close();'>";
			}else{
				session_register("ip_Log","Theme");
				print"<input type='button' value='ทบทวน' onClick=\"parent.location='risk_review_form.php?risk_id=$rs[risk_id]'\"  id='Button'>&nbsp;&nbsp;";
				////print"<input type='button' value='ทบทวน' onClick=\"parent.location='risk_review_form.php?risk_id=$rs[risk_id]&subject=$rs[subject]'\"  id='Button'>&nbsp;&nbsp;";
				print"<input type='submit' value='ปิดหน้าต่าง'  id='Button' onClick='javascript:window.close();'>";
				////print"&nbsp;&nbsp;<input type='button' VALUE='Back' onClick='goHist(-1)'  id='Button'>&nbsp;&nbsp;";
			} */
			?>
			</form></td>
                  <td width="69">&nbsp;</td>
                  <td width="142">&nbsp;</td>
                </tr>
              </table>
			  </td>
            </tr>
            <tr>
              <td colspan="2"><!-- end สร้างกรอบตาราง --></td>
            </tr>
            <tr align="center" valign="top">
              <td colspan="2">
			</td>
            </tr>
            <tr align="center">
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>            
          <!-- form -->
          <!-- end form --></td>
        </tr>
        <tr>
          <td height="16" align="center" background="img_mian/orizontal.jpeg">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23"><p align="center">Development By <b>IT LAMAE</b> CopyRight &copy; 03-2010 
        <b>IM Team Lamae Hospital.</b>All right reserved
      </p></td>
  </tr>
</table>
<?php 
  }//ch online
//}//check access
CloseDB(); //close connect db ?>
</body>
</html>
