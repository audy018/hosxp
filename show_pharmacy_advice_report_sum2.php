<?php 
	session_start();
	include("phpconf.php");
	include("func.php");
	conDB();
	
?>

<script LANGUAGE="JavaScript">
<!--
// 
function confirmSubmit()
{
var agree=confirm("ยืนยันการเพิ่มข้อมูลการให้คำแนะนำปรึกษาแก่คนไข้รายนี้?");
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title>แบบฟอร์มการให้คำแนะนำปรึกษาเรื่องยา </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">

 </head>

 <body>

<center>
<br/>
<form action="<?php $PHP_SELF ?>" method="get" name="f_select_dmy">
		   <table width="400" border="0" cellspacing="2" cellpadding="1" bgcolor='yellow' >
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
</center>



 <br/>


 <form method="POST" action="pharmacy_advice_insert.php">

			<table width="800" align="center" border="1">
				
			<?
				 include("sql_report_pharmacy.inc");
			?>
				
				<tr>
					<td colspan="4" valign="top">
						
						
						<table border="0" width="800" cellspacing='2'>

							<tr bgcolor="#837f7f">

								<td align="center" colspan="2">
										
										<b>รายงานสรุปค่าทางห้องปฏิบัติการ</b>
										
								</td>

								<td align="center">
										
										<b>รายงานสรุปปัญหา / การแก้ไข</b>
										
								</td>


							</tr>

							<tr bgcolor='yellow'>
								<td width="180">
									&nbsp;
									FBS <120 
<?

			$d1=$sy1."-".$sm1."-".$sd1;$d2=$sy2."-".$sm2."-".$sd2;
			include("sql_report_pharmacy.inc");
?>
				: <b><?=sql_pharmacy_array($sql_count_fbs120)?></b>
									

								</td>
							

								<td align="left" width="130">
								&nbsp;FBS 120-180 : 	
				<b><?=sql_pharmacy_array($sql_count_fbs120180)?></b>
										
								</td>
								
								
								<td>
								
									1. ปัญหาการไม่ให้ความร่วมมือในการใช้ยา
				
				<b><?=pharmacy_advice_array($checkboxm1)?></b>

								</td>
							
							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									FBS>180 :

				<b><?=sql_pharmacy_array($sql_count_fbs180)?></b>

								</td>
								<td align="right">
									&nbsp;		
			    
					
										
								</td>

									
								<td>
									&nbsp;&nbsp;
									
									1.1 มาไม่ตรงนัด

				<?=pharmacy_advice_array($checkboxs11)?>

								
								</td>

						
							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									HbA1c<6 :
				<b><?=sql_pharmacy_array($sql_count_hba1c6)?></b>

								</td>
								<td align="left">
									&nbsp;		
								    HbA1c 6-8 :
				<b><?=sql_pharmacy_array($sql_count_hba1c68)?></b>

								</td>

								<td>
									&nbsp;&nbsp;
									
									1.2 ใช้ยาผิดวิธี
			<?=pharmacy_advice_array($checkboxs12)?>
					

								</td>

						
							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									HbA1c>8 : 
		<b><?=sql_pharmacy_array($sql_count_hba1c8)?></b>


								</td>
								<td align="right">
									&nbsp;		
									
										
								</td>

								<td>
									&nbsp;&nbsp;
									
									1.3 ใช้ยาที่แพทย์ไม่ได้สั่ง
									
			<?=pharmacy_advice_array($checkboxs13)?>


								</td>
							

							</tr>

							
							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									BP <130/180 : 
		<b><?=sql_pharmacy_array($sql_count_bpsbpd1)?></b>

								</td>
								<td align="left">
									&nbsp;
									BP >130/180 : 		
		<b><?=sql_pharmacy_array($sql_count_bpsbpd2)?></b>
							
								</td>

								<td>
									&nbsp;&nbsp;
									
									1.4 ใช้ยาขนาดไม่ถูกต้อง
		
				<?=pharmacy_advice_array($checkboxs14)?>

			
								</td>


							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									BMI(Kg/m2)>23 : 
		
		<b><?=sql_pharmacy_array($sql_count_bmi23)?></b>

								</td>
								<td align="right">
									&nbsp;		
									
								</td>
								
								<td>
									&nbsp;&nbsp;
								
									1.5 ใช้ยาผิดเวลา													
						<?=pharmacy_advice_array($checkboxs15)?>

								</td>

			
							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									LDL-C>100 : 
				<b><?=sql_pharmacy_array($sql_count_ldlc1)?></b>

								</td>
								<td align="left">
									&nbsp;
									LDL-C<100 : 
				<b><?=sql_pharmacy_array($sql_count_ldlc2)?></b>
									
								</td>
								
									
								<td>
									&nbsp;&nbsp;
									
									1.6 ใช้ยาผิด Route
			<?=pharmacy_advice_array($checkboxs16)?>
											
		
								</td>

							
							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									
								</td>
								<td align="right">
									&nbsp;		
									
										
								</td>

								<td>
									&nbsp;&nbsp;
									
									1.7 หยุดใช้ยาก่อนกำหนด
		
		<?=pharmacy_advice_array($checkboxs17)?>
												
		
								</td>
							

							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									
								</td>
								<td align="right">
									&nbsp;		
									
								</td>

								<td>
									&nbsp;&nbsp;
									
									1.8 ลืมรับประทานมากกว่า 1 มื้อขึ้นไป
									
			<?=pharmacy_advice_array($checkboxs18)?>
		

								</td>
							


							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									
								</td>
								<td align="right">
									&nbsp;		
							
										
								</td>
								
								<td>
									&nbsp;&nbsp;
									
									1.9 ใช้ยาอื่นที่แพทย์ไม่ได้สั่งใช้
		
		<?=pharmacy_advice_array($checkboxs19)?>
						

								</td>
							


							</tr>

						
							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									
								</td>
								<td align="right">
									&nbsp;		
									
										
								</td>

								
								<td>
									&nbsp;&nbsp;
									
									1.10 อื่นๆ
									
			<?=pharmacy_advice_array($checkboxs110)?>

											
		
								</td>
							

							

							</tr>
							
							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									
								</td>
								<td align="right">
									&nbsp;		
							
										
								</td>
								
									
								<td>
									
									
									2. การเก็บรักษายา
									
			<?=pharmacy_advice_array($checkboxm2)?>
			
		

								</td>
							


							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									
								</td>
								<td align="right">
									&nbsp;		
						
										
								</td>

								<td>
									
									
									3. เกิดอาการไม่พึงประสงค์จากการใช้ยา
									
		<?=pharmacy_advice_array($checkboxm3)?>
													
		

								</td>
							

							</tr>


							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									
								</td>
								<td align="right">
									&nbsp;		
								
										
								</td>

								<td>
									
									
									4. เกิด Drug Interaction
	
	<?=pharmacy_advice_array($checkboxm4)?>
														
		

								</td>
							
							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									
								</td>
								<td align="right">
									&nbsp;		
									
										
								</td>

								<td>
									
									
									5. การควบคุมพฤติกรรมต่างๆ
				<?=pharmacy_advice_array($checkboxm5)?>
													
		
								</td>
							
							
							</tr>

						

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
								
								</td>
								<td align="right">
									&nbsp;		
									
										
								</td>

								<td>
									&nbsp;&nbsp;
									
									5.1 สูบบุหรี่
							
		<?=pharmacy_advice_array($checkboxs51)?>
						
		

								</td>
							
							</tr>


							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									
								</td>
								<td align="right">
									&nbsp;		
									
										
							</td>

							<td>
									&nbsp;&nbsp;
									
									5.2 การออกกำลังกาย
																
			<?=pharmacy_advice_array($checkboxs52)?>
								
			
								</td>
								
							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									
								</td>
								<td align="right">
									&nbsp;		
									
										
								</td>

								<td>
									&nbsp;&nbsp;
									
									5.3 การควบคุมอาหาร
					<?=pharmacy_advice_array($checkboxs53)?>
														
		
								</td>
							

							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									
								</td>
								<td align="right">
									&nbsp;		
									
										
								</td>

								<td>
									&nbsp;&nbsp;
									
									5.4 เครื่องดื่มแอลกอฮอล์
		
		<?=pharmacy_advice_array($checkboxs54)?>
																
		
								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									
									5.5 อื่นๆ
			<?=pharmacy_advice_array($checkboxs55)?>
															

								</td>
								

							</tr>

							
							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									
									6. ความไม่เข้าใจเกี่ยวกับภาวะโรค
				<?=pharmacy_advice_array($checkboxm6)?>
															
		
		

								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									
									7. ความไม่เข้าใจเกี่ยวกับยา
							
							<?=pharmacy_advice_array($checkboxm7)?>
													
			
								</td>
								

							</tr>

							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									
									8. ความไม่เข้าใจเกี่ยวกับภาวะแทรกซ้อน
		<?=pharmacy_advice_array($checkboxm8)?>
															
		
								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									
									9. ความไม่เข้าใจเกี่ยวกับการปฏิบัติตัว
			
		<?=pharmacy_advice_array($checkboxm9)?>

								</td>
								

							</tr>

							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									
									10. Medication error
			<?=pharmacy_advice_array($checkboxm10)?>
															
		
								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									
									11. โรคประเมิน
			<?=pharmacy_advice_array($checkboxm11)?>
													
		
								</td>
								

							</tr>


							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									
									12. อื่่นๆ
					<?=pharmacy_advice_array($checkboxm12)?>
														
		
								</td>
								

							</tr>





						</table>

					</td>


				</tr>

								

	
			
			</table>

</form>

<br/>
<br/>
 </body>
</html>
