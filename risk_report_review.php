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
</head>
<?php
	$ip=get_ip();
	$online=Check_Online($ip); //func check online
if($online){$ip_Log=user_change($ip);}else{$ip_Log=$_SESSION['ip_Log'];}
	$aright=array("ADMIN","Risk_Review");$aright2=array("Risk_Review");
			//echo $online;
if($online){$right=access_right($ip_Log);}else{$right=$_SESSION["right"];}
if((check_right($right,$aright)!==2) and (check_right($right,$aright2)!==1)){ //check access
			print"<br><br><center><h2>ท่านไม่สิทธ์ใช้งานหน้านี้....ครับ</h2></center><br>";
			print"<p align=center><input type='submit' value='ปิดหน้าต่าง'  id='Button' onClick='javascript:window.close();'><br><br>";
			print"Development By <b>IT LAMAE</b> CopyRight &copy; 04-2006 <b>IT LAMAE Hospital.</b>All right reserved</p>";
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //check access

//if (!$_SESSION["ip_Log"] and !Check_Online(get_ip()) and check_right(!$_SESSION['right'],"Risk_Review")==2){ //check  ->off line
if (!$ip_Log and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line
		//if(isset($_SESSION['ip_Log'])){$ip_Log=$_SESSION["ip_Log"];}else{$_SESSION["ip_Log"]=$ip_Log;	}
		//if($online){$ip_Log=user_change($ip);}else{$ip_Log=$_SESSION['ip_Log'];}
		$d=date("d");$m=date("n");$y=date("Y"); //date in the day ,month 05->m,5->n
		$m_zero=date("m");
		$date_current=$d." ".change_month_isThai($m)." ".($y+543); //date cuurent thai no zero monh
?>
<body class="body">
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
              <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> Risk Management Report Review 
<!--counter -->
            </td>
            </tr>
            <tr>
              <td width="337" valign="top" bgcolor="#3399CC">&nbsp; คุณคือ <font color="red"><b><?php echo $ip_Log;  ?></b></font> :: -&gt; <strong>รายการอุบัติการ</strong> | <a href="risk_report_form.php">เขียนรายงานอุบัติการ</a> | </td>
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
			<table width="370" border="0" cellspacing="2" cellpadding="1" class="bd-external">
                <tr align="center" bgcolor="#319ACE">
                  <td colspan="3"><u>เลือกช่วงเวลา</u></td>
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
				?>                  </td>
                  <td width="129">
                    <?php
				print"&nbsp;เดือน&nbsp;";
				print"<select name='sm1' id='Txt-Field'>";
				if($sm1<>""){print"<option value='$sm1'>".change_month_isThai($sm1)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>"; 
				?>                  </td>
                  <td width="135">
                    <?php
				print"&nbsp;ปี&nbsp;";
				
				/*$sqlSyear="select   DISTINCT YEAR(report_date_time) as s_year  from risk_report group by  report_date_time desc  ";*/

				$sqlSyear="select DISTINCT YEAR(report_date_time) as s_year  from risk_report_web group by  report_date_time desc ";

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
              &nbsp;&nbsp;&nbsp;&nbsp; ถึง </td>
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
				
				/*$sqlSyear="select   DISTINCT YEAR(report_date_time) as s_year  from risk_report group by  report_date_time desc  ";*/

				$sqlSyear="select DISTINCT YEAR(report_date_time) as s_year  from risk_report_web group by  report_date_time desc ";

				$result=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				print"<select name='sy2'  id='Txt-Field'>";
				if($sy2<>""){print"<option value='$sy2'>".($sy2+543)."</option>";}
					 if(mysql_num_rows($result)>0){
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						print "<option value='".$rs['s_year']."'>".($rs['s_year']+543)."</option>";
						}										    
					}
				print"</select>"; 
	   		?> </td>
                </tr>
                <tr>
                  <td valign="top" bgcolor="#00CCFF">&nbsp;เลือกรายการ :</td>
                  <td colspan="2" valign="top" bgcolor="#00CCFF">
  					<?php
				  if($_GET['stype']=="all" or $_GET['stype']==""){ ?>
                    <input name="stype" type="radio" value="all" checked="checked">ทั้งหมด
				 <?php }else{ ?>	
				 	<input name="stype" type="radio" value="all">ทั้งหมด
				<?php } 
				  if($_GET['stype']=="1"){ ?>
                    <input name="stype" type="radio" value="1" checked="checked">อุบัติการณ์
				 <?php }else{ ?>	
				 	<input name="stype" type="radio" value="1">อุบัติการณ์
				<?php } 
				  if($_GET['stype']=="2"){ ?>
                    <input name="stype" type="radio" value="2" checked="checked">ข้อร้องเรียน
				 <?php }else{ ?>	
				 	<input name="stype" type="radio" value="2">ข้อร้องเรียน
				<?php } ?>				  </td>
                  </tr>
                <tr>
                  <td colspan="3" align="center" bgcolor="#319ACE"><input name='select_date' type='submit' value='Continue' id='Button'></td>
                  </tr>
              </table> 
</form></td>
            </tr>
            <tr>
              <td>&nbsp;<?php //echo "login".$_SESSION['ip_Log']; ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr align="center" valign="top">
              <td colspan="2" align="center">
			  <?php
				if(strlen($sd1)==1){$sd1="0".$sd1;}
				if(strlen($sd2)==1){$sd2="0".$sd2;}
				if(strlen($sm1)==1){$sm1="0".$sm1;}
				if(strlen($sm2)==1){$sm2="0".$sm2;}

			$d1=$sy1."-".$sm1."-".$sd1;
			$d2=$sy2."-".$sm2."-".$sd2;//echo $d1."dd".$d2;
			  
			  ?>
			  <table width="970" border="0" cellspacing="1" cellpadding="1" class="bd-external">
                <tr align="center" bgcolor="#319ACE" class="headtable">
                  <td width="40">ลำดับ</td>
                  <td width="127">วันที่/เวลา รายงาน</td>
				  <td width="147" bgcolor="#319ACE">หน่วยงานที่พบอุบัติการณ์</td>
                  <td width="147" bgcolor="#319ACE">หน่วยงานที่ต้องการสื่อสาร</td>
                  <td width="250" bgcolor="#319ACE">เรื่อง</td>
                  
                  <td width="100">อุบัติการณ์ทั่วไป</td>

				  <td width="115">อุบัติการณ์ทางคลินิก</td>

				  <td width="36">ระดับ</td>

                  <td width="46">ทบทวน</td>
                  <td width="109">ผู้ทบทวน</td>
                  </tr>
		<?php 				//echo "dd".$_GET['stype'];
					
					$sql_access_risk="select * from risk_user_access where loginname='$ip_Log' ";
					$result_access_risk=ResultDB($sql_access_risk);
					if(mysql_num_rows($result_access_risk)>0){//row user access
							$_access_risk=true; 
							$rs_access_user=mysql_fetch_array($result_access_risk);
								if($rs_access_user["UserAccess"]!=="ALL"){//all
										$_access_ch_all=false;
										//echo "ddddddd";
							    		if(ereg("x",$rs_access_user["UserAccess"])){ // return true,false
								  			$_access=str_replace("x","'",$rs_access_user["UserAccess"]); //แทนที่คำ 
								       }
								}else{//no all
								  			$_access_ch_all=true; 
								}  //all
						}else{//no row user access
							$_access_risk=false;
							echo "<br><h2>ท่านไม่สามารถทำรายการนี้ได้</h2><br>";
						}//row user access
		//echo "dd".$_access;exit();
		//if($_access_risk=true and $_access_ch_all=true)	{		
			//echo $_access;
			//sql select review date current
			
			$sql1="select r.*,h2.name as department_risk,h1.name as depart_name from risk_report_web r        
			       left outer join hospital_department h1 on     
			       h1.id=r.department_id 
			       left outer join hospital_department h2 on
			       h2.id=r.department_risk ";
		
	    if($_access_risk and $_access_ch_all){		
		$sql1.="where date(report_date_time)='$y-$m_zero-$d' order by date(report_date_time) desc ";
		}else{
		$sql1.="where date(report_date_time)='$y-$m_zero-$d' and  r.department_id in(".$_access.")  order by date(report_date_time) desc ";

		
		}
		
		//echo  $sql1;
			//sql select review date select
				
		$sql2="select r.*,h2.name as department_risk,h1.name as depart_name from risk_report_web r        
			       left outer join hospital_department h1 on     
			       h1.id=r.department_id 
			       left outer join hospital_department h2 on
			       h2.id=r.department_risk ";
		
		
		
		if($_access_risk and $_access_ch_all){	
			if($_GET['stype']=="all"){
				
				$sql2.="where date(report_date_time) between '$d1' and  '$d2' order by date(report_date_time) desc ";
				
				
			
			}else{
				
				$sql2.="where date(report_date_time) between '$d1' and  '$d2' and type='$stype' order by date(report_date_time) desc ";

				
			
			}
		}else{
			if($_GET['stype']=="all"){$sql2.="where date(report_date_time) between '$d1' and  '$d2' and r.department_id in(".$_access.") order by date(report_date_time) desc ";}else{$sql2.="where date(report_date_time) between '$d1' and  '$d2' and r.department_id in(".$_access.") and type='$stype' order by date(report_date_time) desc ";}
		}
			//echo $d1.$d2 ;
			//click button
			if($select_date==""){ //click button
			//echo "sql1".$sql1;
				$result=ResultDB($sql1);
					 if(mysql_num_rows($result)>0){ //r sql1
						print"<p ailgn='center'><u><font color='#319ACE'><b>แสดงข้อมูลของวันที่ ".$date_current;
						print" มีทั้งหมด <font color='red'>".mysql_num_rows($result)."</font> รายการ</b></font></u></p>";
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						if($bg=='#FFFFFF'){
						$bg="#FFFFCC";}else{$bg='#FFFFFF';}
                   		print"<tr bgcolor='$bg'>";
                   		print"<td align='center'>".($i+1)."</td>";
                   		
						
						print"<td align='center'>&nbsp;".$rs['report_date_time']."</td>";

						


                   		print"<td align='left'>&nbsp;".$rs['depart_name']."</td>";
                   		//print"<td align='left'>&nbsp;<a title='$rs[subject]' href=javascript:popup('risk_review_show_detail.php?risk_id=$rs[risk_id]&subject=$rs[subject]&Theme=$Theme',500,850,1)>".$rs['subject']."</a></td>";
                   		//print"<td align='left'>&nbsp;<a title='$rs[subject]' href='risk_review_show_detail.php?risk_id=$rs[risk_id]&subject=$rs[subject]&Theme=$Theme'>".$rs['subject']."</a></td>";

						print"<td align='center'>&nbsp;".$rs['department_risk']."</td>";

						print"<td align='left'>&nbsp;<a title='$rs[subject]' href='#' onclick=\"MM_openBrWindow('risk_review_show_detail.php?risk_id=$rs[risk_id]&Theme=$Theme&ip_Log=$ip_Log','','resizable=no,width=850,height=500,scrollbars=yes')\">".$rs['subject']."</a></td>";
						
						
                   		
						print"<td align='left'>&nbsp;".$rs['relation_general_program']."</td>";

						print"<td align='left'>&nbsp;".$rs['relation_program']."</td>";

						print"<td align='center'>&nbsp;".$rs['risk_level']."</td>";
						
						if($rs['review_status']=="Y"){print"<td align='center' bgcolor='green'>&nbsp;".$rs['review_status']."</td>";}else{print"<td align='center' bgcolor='red'>&nbsp;".$rs['review_status']."</td>";}
                   		print"<td align='left'>&nbsp;".$rs['review_staff']."</td>";
                   		print"</tr>"; }//for
					}else{ //r sql1
						print"<p ailgn='center'><font color='#319ACE'><b>แสดงรายการของวันที่ ".$date_current;
				   		print "<h2>ไม่มีรายการ</h2></font></p>";
					}//r sql1
			}elseif($select_date="Continue"){ //click button
			//echo "sql2".$sql2;
				$result=ResultDB($sql2);
					 if(mysql_num_rows($result)>0){ //r sql1

						
						print"<p align='center'><u><font color='#319ACE'><b>แสดงข้อมูลของวันที่ $d_calen1[0] เดือน ".change_month_isThai($d_calen1[1])." ปี ".$d_calen1[2]." ถึงวันที่ $d_calen2[0] เดือน ".change_month_isThai($d_calen1[1])." ปี ".$d_calen1[2];
						print" มีทั้งหมด <font color='red'>".mysql_num_rows($result)."</font> รายการ</b></font></u></p>";
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						if($bg=='#FFFFFF'){
						$bg="#FFFFCC";}else{$bg='#FFFFFF';}
						//$subject_send=$rs['subject'];
						print"<tr bgcolor='$bg'>";
                   		print"<td align='center'>".($i+1)."</td>";
                   		print"<td align='center'>&nbsp;".$rs['report_date_time']."</td>";



						print"<td align='left'>&nbsp;".$rs['depart_name']."</td>";
                   		
						print"<td align='center'>&nbsp;".$rs['department_risk']."</td>";
                   		
						
						
						
						//print"<td align='left'>&nbsp;<a title='$subject_send' href=javascript:popup('risk_review_show_detail.php?risk_id=$rs[risk_id]&subject=$subject_send&Theme=$Theme',500,850,1)>".$rs['subject']."</a></td>";
						//echo "r".$rs[risk_id]."sub".$rs[subject]."th".$Theme."ip".$_SESSION[ip_Log];
						//print"<td align='left'>&nbsp;<a title='$rs[subject]' href='#' onclick=\"MM_openBrWindow('about.php','','resizable=no,width=850,height=500,scrollbars=yes')\">".$rs['subject']."</a></td>";
						print"<td align='left'>&nbsp;<a title='$rs[subject]' href='#' onclick=\"MM_openBrWindow('risk_review_show_detail.php?risk_id=$rs[risk_id]&Theme=$Theme&ip_Log=$ip_Log','','resizable=no,width=850,height=500,scrollbars=yes')\">".$rs['subject']."</a></td>";

						//print"<td align='left'>&nbsp;<a title='$rs[subject]' href='#' onclick=\"MM_openBrWindow('risk_review_show_detail?risk_id=$rs[risk_id]&subject=$rs[subject]&Theme=$Theme&ip_Log=$_SESSION[ip_Log]','','resizable=no,width=850,height=500,scrollbars=yes')\">".$rs['subject']."</a></td>";
						
						
						print"<td align='left'>&nbsp;".$rs['relation_general_program']."</td>";

                   		print"<td align='left'>&nbsp;".$rs['relation_program']."</td>";


						print"<td align='center'>&nbsp;".$rs['risk_level']."</td>";

                   		//print"<td align='center'>&nbsp;".$rs['review_status']."</td>";
						if($rs['review_status']=="Y"){print"<td align='center' bgcolor='green'>&nbsp;".$rs['review_status']."</td>";}else{print"<td align='center' bgcolor='red'>&nbsp;".$rs['review_status']."</td>";}
                   		print"<td align='left'>&nbsp;".$rs['review_staff']."</td>";
                   		print"</tr>"; }//for
					}else{ //r sql1
				   		print "<center><font color='#319ACE'><h2>ไม่มีรายการ</h2></font></center>";
					}//r sql1
			}//click button
			?>
              </table></td>
              </tr>
            <tr>
              <td height="59" colspan="2"  align="center"><form><input type=button value="Refresh" onClick="javascript:location.reload();" id="Button"></form></td>
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
    <td height="23"><div align="center">Development By <b>ไอที ละแม</b> CopyRight &copy; 03-2010 
        <b>IT Lamae Hospital.</b>All right reserved
        <br>
      </div></td>
  </tr>
</table>
<?php 
 }//ch online
}//check access
CloseDB(); //close connect db ?>
</body>
</html>
