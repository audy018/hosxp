<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB(); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - Risk Management Report Review Detail - - |</title>
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
	$aright=array("ADMIN","Risk_Review");$aright2=array("Risk_Review");
			//echo $online;
if($online){$right=access_right($ip_Log);}else{$right=$_SESSION["right"];}
if((check_right($right,$aright)!==2) and (check_right($right,$aright2)!==1)){ //check access
			//echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
			print"<br><br><center><h2>ท่านไม่สิทธ์ใช้งานหน้านี้....ครับ</h2></center><br>";
			print"<p align=center><input type='submit' value='ปิดหน้าต่าง'  id='Button' onClick='javascript:window.close();'><br><br>";
			print"Development By <b>Guprajag</b> CopyRight &copy; 04-2006 <b>IM Team Mayo Hospital.</b>All right reserved</p>";
			
}else{ //check access
	//if(isset($_SESSION['ip_Log'])){$ip_Log=$_SESSION["ip_Log"];}else{$_SESSION["ip_Log"]=$ip_Log;	}
	//protect by change user in program by online
//if (!$_SESSION["ip_Log"] and !Check_Online(get_ip()) and check_right(!$_SESSION['right'],"Risk_Review")==2){ //check  ->off line
if (!$ip_Log and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line
	//echo "online".$online;
	$risk_id=$_REQUEST['risk_id'];//echo $risk_id;
	$Theme=$_REQUEST['Theme'];//echo $Theme;
?>
<body>
<table width="620" border="0" align="left" cellpadding="0" cellspacing="0" class="bd-external">
  <tr align="center" bgcolor="#99CCFF">
    <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu">รายละเอียดของอุบัติการ</td>
  </tr>
  <tr>
    <td width="337" valign="top" bgcolor="#3399CC">&nbsp; คุณคือ <font color="red"><b><?php echo $ip_Log;  ?></b></font> :: - &gt; <strong>รายการอุบัติการ</strong> | <a href="#closeform">ปิดหน้าต่าง</a> | </td>
    <td width="282" bgcolor="#3399CC" align="left">&nbsp;
      id = <?php echo "<font color='red'><b>".$risk_id."</b></font>"; ?></td>
  </tr>
  <tr align="center" valign="top">
    <td colspan="2" class="td-left"><?php 
	$d=date("d");$m=date("n");$y=date("Y"); //date in the day ,month 05->m,5->n
	$date_current=$d." ".change_month_isThai($m)." ".($y+543); //date cuurent thai
	$time_current=date(" H:i:s");//time cuurent
	//sql form id
	//echo "risk_id=".$risk_id."subject=".$subject;
			$sql="select r.*,h.name as depart_name,rl.level_name as n_level,rc.name as n_cause,rt.typename,rcm.mname,rt1.list_name1,rt2.list_name2 ";
			$sql.="from risk_report_web r  ";
			$sql.="left outer join hospital_department h on h.id=r.department_id ";
			$sql.="left outer join risk_level rl on left(rl.level_name,1)=r.risk_level ";
			$sql.="left outer join risk_cause rc on rc.idc=r.idc ";
			$sql.="left outer join risk_type rt on rt.idt=r.type ";
			$sql.="left outer join risk_can_manage rcm on rcm.idm=r.idm ";
			$sql.="left outer join risk_typelist1 rt1 on rt1.idl1=r.type_list ";
			$sql.="left outer join risk_typelist2 rt2 on rt2.idl2=r.type_list ";
			$sql.="where risk_id='$risk_id' ";
			//$sql.="where risk_id='$risk_id' and subject like '%$subject%' ";
	$result=ResultDB($sql);//echo mysql_num_rows($result);
	$rs=mysql_fetch_array($result);
	?>
        <br>
        <table width="600" border="0" cellspacing="1" cellpadding="2">
          <tr align="center">
            <td colspan="4" bgcolor="#319ACE"><span class="headmenu">รายละเอียดของอุบัติการ</span></td>
          </tr>
          <tr>
            <td bgcolor="#319ACE">&nbsp;เรื่อง : </td>
            <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['subject']; ?></td>
          </tr>
          <tr>
            <td width="151" bgcolor="#319ACE">&nbsp;หน่วยงาน : </td>
            <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['depart_name']; ?></td>
          </tr>
          <tr>
            <td bgcolor="#319ACE">&nbsp;เชื่อมโยงโปรแกรม :</td>
            <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['relation_program']; ?></td>
          </tr>
          <tr>
            <td bgcolor="#319ACE">&nbsp;วันที่เกิด : </td>
            <td colspan="3" bgcolor="#FFFFCC">&nbsp;
                <?php //echo $rs['report_date_time']; 
				  $date_time_report=explode(" ",$rs['report_date_time']);$dreport=$date_time_report[0];$treport=$date_time_report[1];
				  $d_split=explode("-",$dreport);//if(strlen($d_split[1])==1){ $d_s="0".$d_split[1];}
				  echo $d_split[2]."-".$d_split[1]."-".($d_split[0]+543)."  เวลา".$treport;
				  ?></td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#319ACE">&nbsp;ระดับความรุนแรง :</td>
            <td colspan="3" valign="top" bgcolor="#FFFFCC">
                <?php  
			//$level=$rs['risk_level'];
			//$sqlLevel="select * from risk_level  where  level_name like '$level%' ";
			//$resultLevel=ResultDB($sqlLevel);$rsLevel=mysql_fetch_array($resultLevel);
			echo $rs['n_level'];
				  ?>            </td>
          </tr>
          <tr>
            <td bgcolor="#319ACE" valign="top">&nbsp;ความถี่ : </td>
            <td colspan="3" valign="top" bgcolor="#FFFFCC"><?php if(!$rs['freq']=="0"){echo $rs['freq']."  ครั้ง";}else{echo "-";} ?></td>
          </tr>
          <tr>
            <td bgcolor="#319ACE" valign="top">&nbsp;ประเภท : </td>
            <td colspan="3" valign="top" bgcolor="#FFFFCC">
			<?php  
			//$idc=$rs['idc'];//echo $idc;
			//$sql_Cause="select * from risk_cause  where  idc='$idc' ";
			//$result_Cause=ResultDB($sql_Cause);$rs_Cause=mysql_fetch_array($result_Cause);
			//if($rs_Cause['name']){echo $rs_Cause['name'];}else{echo "-";}
			if(!$rs['type']){echo "-";}else{
				echo $rs['typename']." --> ";
				if($rs['type']=="1"){echo $rs['list_name1'];}elseif($rs['type']=="2"){echo $rs['list_name2'];}else{echo "-";}
			}
			
			//if($rs['typename']){echo $rs['typename'];	}else{echo "-";}
			?></td>
          </tr>
          <tr>
            <td bgcolor="#319ACE" valign="top">&nbsp;สาเหตุ :</td>
            <td colspan="3" valign="top" bgcolor="#FFFFCC">
			<?php  
			//$idc=$rs['idc'];//echo $idc;
			//$sql_Cause="select * from risk_cause  where  idc='$idc' ";
			//$result_Cause=ResultDB($sql_Cause);$rs_Cause=mysql_fetch_array($result_Cause);
			if($rs['n_cause']){echo $rs['n_cause'];}else{echo "-";}
			?></td>
          </tr>
          <tr>
            <td bgcolor="#319ACE" valign="top">&nbsp;รายละเอียด : </td>
            <td colspan="3" valign="top" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['risk_detail']; ?></td>
          </tr>
          <tr>
            <td bgcolor="#319ACE">&nbsp;การแก้ไขเบื้องต้น : </td>
            <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['edit_basic']; ?></td>
          </tr>
          <tr>
            <td bgcolor="#319ACE">&nbsp;ข้อแนะนำเชิงระบบ(ผู้รายงาน) : </td>
            <td colspan="3" bgcolor="#FFFFCC">&nbsp;<?php echo $rs['info_system']; ?></td>
          </tr>
          <tr>
            <td bgcolor="#319ACE">&nbsp;การทบทวน :</td>
            <td colspan="3" bgcolor="#FFFFCC">&nbsp;
                <?php if($rs['review_status']=='Y'){echo "<font color='red'><b>ทบทวน</b></font>";}else{echo "<font color='red'><b>ยังไม่ทบทวน</b></font>";} ?>
              &nbsp;
                <?php 
				  if($rs['review_date_time']<>"" or $rs['review_date_time']=='N'){ 
				  print "วันที่ทบทวน :  ";
				  $date_time_review=explode(" ",$rs['review_date_time']);$dreview=$date_time_review[0];$treview=$date_time_review[1];
				  $d_split_review=explode("-",$dreview);//if(strlen($d_split[1])==1){ $d_s="0".$d_split[1];}
				  echo $d_split_review[2]."-".$d_split_review[1]."-".($d_split_review[0]+543)."  เวลา ".$treview;
				  }
				  ?>            </td>
          </tr>
          <tr>
            <td bgcolor="#319ACE">&nbsp;ผู้ทบทวน :</td>
            <td colspan="3" bgcolor="#FFFFCC"><?php if($rs['review_staff']){echo $rs['review_staff'];}else{ echo "-";} ?></td>
          </tr>
          <tr>
            <td bgcolor="#319ACE">&nbsp;การตอบสนองระดับฝ่าย :</td>
            <td colspan="3" bgcolor="#FFFFCC"><?php if($rs['respond_level_depart']){echo $rs['respond_level_depart'];}else{echo "-";} ?></td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#319ACE">&nbsp;ความสามารถในการจัดการ<br>
              &nbsp; แก้ไข(ระดับ) : </td>
            <td colspan="3" align="left" valign="middle" bgcolor="#FFFFCC">
			<?php
			if($rs['mname']){echo $rs['mname'];}else{echo "-";}
			?>
			</td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#319ACE">&nbsp;สรุปติดตาม :</td>
            <td colspan="3" align="left" valign="top" bgcolor="#FFFFCC">
			<?php 
			if($rs['result_follow']){
			echo $rs['result_follow']."<br>".$rs['all_date_review']; }else{ echo "-";}
			?></td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#319ACE">&nbsp;ข้อเสนอแนะจาก RM : </td>
            <td colspan="3" align="left" valign="top" bgcolor="#FFFFCC">
			<?php
			if($rs['form_rm']){echo $rs['form_rm'];}else{echo "-";}
			?>
			</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;
                <?php //echo $ip_Log; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td width="235"><form method="get">
                <?php
			$aright=array("ADMIN","Risk_Review");$aright2=array("Risk_Review");$right=access_right($ip_Log);//echo "Access".$right;
  			if((check_right($right,$aright)!==2) and (check_right($right,$aright2)!==1)){
				print"<input type='submit' value='ปิดหน้าต่าง'  id='Button' onClick='javascript:window.close();'>";
			}else{
				session_register("ip_Log","Theme");
				//echo "<h1>อยู่ระหว่างการแก้ไข ปิดการทบทวนก่อน ชั่วคราว</h1>";
				print"<input type='button' value='ทบทวน' onClick=\"parent.location='risk_review_form.php?risk_id=$rs[risk_id]'\"  id='Button'>&nbsp;&nbsp;";
				//print"<input type='button' value='ทบทวน' onClick=\"parent.location='risk_review_form.php?risk_id=$rs[risk_id]&subject=$rs[subject]'\"  id='Button'>&nbsp;&nbsp;";
				?>
                <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
if (window.print) {
document.write('<input type=button id=Button name=print value="พิมพ์ครับ" '
+ 'onClick="javascript:window.print()">');
}
// End -->
  </script>
                <?php
				print"&nbsp;&nbsp;<input type='submit' value='ปิดหน้าต่าง'  id='Button' onClick='javascript:window.close();'>";
				//print"&nbsp;&nbsp;<input type='button' VALUE='Back' onClick='goHist(-1)'  id='Button'>&nbsp;&nbsp;";
			}
			?>
            </form></td>
            <td width="72">&nbsp;</td>
            <td width="146">&nbsp;</td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2"><!-- end สร้างกรอบตาราง --></td>
  </tr>
  <tr align="center" valign="top">
    <td colspan="2"><p align="center">Development By <b>กูประจักษ์ ราเหม</b> CopyRight &copy; 04-2006  <b>IM Team Mayo Hospital.</b>All right reserved
      </p></td>
  </tr>
</table><br>
<?php 
  }//ch online
}//check access
CloseDB(); //close connect db ?>
</body>
</html>
