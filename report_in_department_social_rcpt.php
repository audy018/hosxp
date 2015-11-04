<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - ยอดผู้รับบริการ ->รายงาน ทะเบียนผู้ป่วยค้างชำระ - - |</title>
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

<script language="javascript">
	
	function confirm_sent_mail(visit_number,hn)
	{
		var ouput;

		output=confirm('คุณต้องการเปลี่ยนสถานะการส่งจดหมายใช่ไหม?');

		if(output==true){
			
			window.location="report_in_department_social_rcpt_mail_confirm.php?vn="+visit_number+"&hn="+hn;
			

		}


	}


	function cancel_sent_mail(visit_number,hn)
	{
		var ouput;

		output=confirm('คุณต้องการเปลี่ยนสถานะการส่งจดหมายใช่ไหม?');

		if(output==true){
			
			window.location="report_in_department_social_rcpt_mail_cancel.php?vn="+visit_number+"&hn="+hn;
			

		}


	}


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
                  <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu">รายงาน ทะเบียนผู้ป่วยค้างชำระ</td>
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



$sqlOpd_Socail="select r.hn,(select sum(amount) from rcpt_arrear r2 where r2.hn=r.hn and r2.paid='N' group by r2.hn)  as total_money,concat(p.pname,p.fname,'  ',p.lname) as full_patient_name,concat(p.fname,'  ',p.lname) as patient_name,p.cid as cid, concat(p.addrpart,' หมู่',p.moopart,' ',th.full_name) as thai_address,

r.check_mail_status, r.vn as visit_number, ";  
$sqlOpd_Socail.="r.*,o.vstdate,o.vsttime,t.name as pttype_name  ";
$sqlOpd_Socail.="from rcpt_arrear r  ";

$sqlOpd_Socail.="left outer join ovst o on o.vn=r.vn  ";
$sqlOpd_Socail.="left outer join patient p on p.hn=r.hn  ";
$sqlOpd_Socail.="left outer join pttype t on t.pttype = o.pttype  ";

$sqlOpd_Socail.="left outer join rcpt_arrear r2 on r2.hn= r.hn ";

$sqlOpd_Socail.="left outer join thaiaddress th  on th.addressid = concat(p.chwpart,p.amppart,p.tmbpart) ";

$sqlOpd_Socail.="where r.arrear_date between '$d1' and '$d2'  ";  

$sqlOpd_Socail.="and r.paid in ('N') group by r.hn order by r.hn";





				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				
				if(mysql_num_rows($resultOpd_Socail)>0){
					print"<u><font color='green'><b>แสดงข้อมูลของวันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font>";
					print"<br>มีทั้งหมด ".mysql_num_rows($resultOpd_Socail)." รายการ</b></font></u>";
						//create row
						?><br><br>
					<table width="900" border="1" cellspacing="0" cellpadding="0" class="bd-external">
                      <tr>
                        <td height="44" align="center"><table width="900" border="0" cellpadding="1" cellspacing="1">
                          <tr class="headtable">
                            <td width="20" height="21"  align="center" background="img_mian/bgcolor2.gif">ที่</td>
                            <td width="80"  align="center" background="img_mian/bgcolor2.gif">บัตรประชาชน</td>
                            <td width="64" align="center"  background="img_mian/bgcolor2.gif">HN</td>
                          
                            <td width="183" align="center"  background="img_mian/bgcolor2.gif">ชื่อ-สกุล</td>
                           
                          
                         
                          
                            <td width="117" align="center"  background="img_mian/bgcolor2.gif">สถานะการจ่ายเงิน</td>
                            <td width="141" align="center"  background="img_mian/bgcolor2.gif">ไฟแนนซ์นัมเบอร์</td>
					
							<td background="img_mian/bgcolor2.gif" align="center">จำนวนเงิน</td>
							<td width="141" align="center"  background="img_mian/bgcolor2.gif">สถานะส่งจดหมาย</td>

                            <td width="84" align="center"  background="img_mian/bgcolor2.gif">พิมพ์</td>
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
                            <td  align="center"><?php echo $rsOpd_Socail['cid']; ?></td>
                            <td align="center"><?php echo $rsOpd_Socail['hn']; ?></td>
                           


                            <td align="left">&nbsp;<?php echo "<a target=_blank href='patient_medication_record.php?hn=".$rsOpd_Socail['hn']."&vn=".$rsOpd_Socail['vn']."'>".change_misis($rsOpd_Socail['full_patient_name'])."</a>"; ?>
                          
                   <br/>
                   <?echo $rsOpd_Socail['thai_address'];?>
				</td>
                            <td align="center">&nbsp;
							<?
								echo $rsOpd_Socail['paid'];
							?>
							</td>

                            <td align="center">
							
							<?php echo $rsOpd_Socail['finance_number']; ?>	
							

							</td>

					
							<td align="right">
							
							<?php echo number_format(floor($rsOpd_Socail['total_money'])); ?>	
							

							</td>


							<td align="center">
							
						

							<?php

								$check_mail_status=$rsOpd_Socail['check_mail_status'];

								$visit_number = $rsOpd_Socail['visit_number'];

								
								if($check_mail_status=='YES'){
								?>
									
									<a href=javascript:cancel_sent_mail('<?=$visit_number?>','<?=$rsOpd_Socail[hn]?>') title='เปลี่ยนสถานะการส่งจดหมาย'>แจ้งหนี้แล้ว</a>


								<?
								}


								if($check_mail_status==''){

								?>

								<a href=javascript:confirm_sent_mail('<?=$visit_number?>','<?=$rsOpd_Socail[hn]?>') title='เปลี่ยนสถานะการส่งจดหมาย'>ยังไม่แจ้งหนี้</a>

								<?}

								
								if($check_mail_status=='CANCE'){

								?>

								<a href=javascript:confirm_sent_mail('<?=$visit_number?>','<?=$rsOpd_Socail[hn]?>') title='เปลี่ยนสถานะการส่งจดหมาย'>ยังไม่แจ้งหนี้</a>

								<?}


								
												
							
							?>	
						

							
							</td>


                            <td align="center">
							<?php 
							
echo "<a href='frm_rcpt_print.php?hn=$rsOpd_Socail[hn]&full_name=$rsOpd_Socail[patient_name]' target='_blank' title='คลิกเพื่อพิมพ์แบบฟอร์ม'>พิมพ์แบบฟอร์ม</a>";
							
							?>
							</td>
                          </tr>
                          <?php
						$i++;
					} //while 
					?>
                        </table></td>
                      </tr>
                    </table>
					<?php 
					
					
				}else{

					
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
