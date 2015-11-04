<?php 
	session_start();
	include("phpconf.php");
	include("func.php");
	conDB();

	$vstdate=$_GET['vstdate'];

?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=tis-620">

  <title>แบบฟอร์มการให้คำแนะนำปรึกษาเรื่องยา </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
 </head>

 <body>

 <br/>
 <br/>

 <?

				 $sql_select ="SELECT * FROM lamae_pharmacy_advice WHERE vn=$_GET[vn] AND hn=$_GET[hn] ";


				$result_select=ResultDB($sql_select)

				or die("Notconnect database error".mysql_error());
				
				$count_down = mysql_num_rows($result_select);


				$rs_select=mysql_fetch_array($result_select);
						


?>
		
		
		
 <form method="POST" action="pharmacy_advice_update.php">

			<table width="800" align="center" border="1">
				<tr>
					<td colspan="3" width="400">
							&nbsp;
							<b>ส่วนที่ 5 แบบฟอร์มการให้คำแนะนำปรึกษาเรื่องยา</b>
							
					</td>

					<td>
						&nbsp;
						<b>วัน เดือน ปี </b>
						<b>
						<font color='red'><?=$_GET['vstdate'];?></font>
						</b>
					</td>
				</tr>

					<tr>
					<td colspan="3" width="70%">
							&nbsp;
							<b>ชื่อ-สกุล ผู้ป่วย</b>
							<b>
							<font color='red'><?=$_GET['ptname'];?></font>
							</b>
							
					</td>

					<td>
							&nbsp;
							<b>HN</b>
							<b>
							<font color='red'><?=$_GET['hn'];?></font>
							</b>
					</td>
				</tr>
				
				<tr>
					<td colspan="4" align="center" bgcolor="#837f7f">
						<b>ผู้คัดกรอง</b>
					</td>
				</tr>
				
				<tr>
					<td colspan="4">

							<table border="1">
								<tr>
									<td width="200">

<input type="radio" name="screen_type" value='1' <? if($rs_select['screen_type']=="1"){echo "checked";} ?>>
										
										<b>แพทย์</b>
									</td>
									<td width="200">

<input type="radio" name="screen_type" value='2' <? if($rs_select['screen_type']=="2"){echo "checked";} ?>>
										
										<b>เภสัชกร</b>
									</td>
									<td width="200">
										
<input type="radio" name="screen_type" value='3' <? if($rs_select['screen_type']=="3"){echo "checked";} ?>>
										
										<b>พยาบาล</b>
									</td>
									<td width="200">
										
<input type="radio" name="screen_type" value='4' <? if($rs_select['screen_type']=="4"){echo "checked";} ?>>
										
										<b>ผู้ป่วยขอรับบริการเอง</b>
									</td>
								</tr>
							</table>

					</td>
				</tr>

				<tr>
					<td align="center" colspan="4">
						
							<table border="0" width="800">
								
								<tr bgcolor='yellow'>
									<td><b>ลำดับ</td>
									<td width="350">&nbsp;<b>รายการยา</b></td>
									<td width="150">&nbsp;<b>strength</b></td>
									<td width="150">&nbsp;<b>units</b></td>
									<td width="150">&nbsp;<b>ปริมาณการจ่าย</b></td>

								
						<?
							$sql_select="select o.vn,o.hn,s.name,s.strength,s.units,o.qty as qty,dru.shortlist
							 from opitemrece  o
							left outer join s_drugitems s on s.icode =o.icode
							left outer join drugusage dru on dru.drugusage= o.drugusage
							where vstdate='$_GET[vstdate]' and o.hn='$_GET[hn]' and o.vn='$_GET[vn]'"; 
							
							$result_Socail=ResultDB($sql_select);//echo mysql_num_rows($resultDenService);
							if(mysql_num_rows($result_Socail)>0){
								
							$i=0;
							while($i<mysql_num_rows($result_Socail)){//while
								$rs_Socail=mysql_fetch_array($result_Socail);

								if ($bg=="#FFFFFF") { //color
									$bg="#B1C3D9";
								//$bgm="";
									}else{
									$bg="#FFFFFF";
									//$bgm="img_mian/bgcolor.gif";
								} //
						?>
					
					<tr bgcolor="<?php echo $bg;?>">
						<td  align="center"><?php echo ($i+1); ?></td>
						<td align="left">&nbsp;<?= $rs_Socail['name'];?>
						<br/>
							<u><?=$rs_Socail['shortlist'];?></u>
						</td>
						<td>&nbsp;<?= $rs_Socail['strength'];?></td>
						<td>&nbsp;<?= $rs_Socail['units'];?></td>
						<td>&nbsp;<?= $rs_Socail['qty'];?></td>

								
								
					</tr>

						<?
							
						$i++;
						}
						
					}	


							

						?>

										

							<tr bgcolor="<?php echo $bg;?>">
                            <td  align="center"><?php echo ($i+1); ?>
							</td>

						 </tr>


						
						</table>


					</td>
				</tr>

				
				


				<tr>
					<td colspan="4" valign="top">
						
						<?
							 include("sql_report_pharmacy.inc");
						?>

						<table border="0" width="800" cellspacing='2'>

							<tr bgcolor="#837f7f">

								<td align="center" colspan="2">
										
										<b>ค่าทางห้องปฏิบัติการ</b>
										
								</td>

								<td align="center">
										
										<b>รายละเอียดปัญหา/การแก้ไข</b>
										
								</td>


							</tr>

							<tr bgcolor='yellow'>
								<td width="180">
									&nbsp;
									<b>FBS</b>
								</td>
								<td align="right" width="130">
								&nbsp;		
								<?=sql_pharmacy_array($sql_fbs)?>
										
								</td>
								
								
								<td>
<input type='checkbox' name='checkboxm1' value='1' <?php if($rs_select[checkboxm1]=='1'){echo 'checked';}?> />
	1. ปัญหาการไม่ให้ความร่วมมือในการใช้ยา
<input type='textbox' name='tbxm1'  value='<?=$rs_select[tbxm1]?>'/>
								</td>
							
							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									<b>HbA1c</b>
								</td>
								<td align="right">
									&nbsp;		
									<?=sql_pharmacy_array($sql_hba1c)?>
										
								</td>

									
								<td>
									&nbsp;&nbsp;
<input type='checkbox' name='checkboxs11' value='1'  <?php if($rs_select[checkboxs11]=='1'){echo 'checked';}?> />
	1.1 มาไม่ตรงนัด
<input type='textbox' name='tbxs11' size='45' value='<?=$rs_select[tbxs11]?>'/>
								</td>

						
							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									<b>BP</b>
								</td>
								<td align="right">
									&nbsp;		
									<?=sql_pharmacy_array($sql_bps)?>/
									<?=sql_pharmacy_array($sql_bpd)?>
										
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs12' value='1' <?php if($rs_select[checkboxs12]=='1'){echo 'checked';}?> />
									1.2 ใช้ยาผิดวิธี
									<input type='textbox' name='tbxs12' size='47' value='<?=$rs_select[tbxs12]?>'/>
								</td>

						
							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									<b>BW(KG)</b>
								</td>
								<td align="right">
									&nbsp;		
									<?=sql_pharmacy_array($sql_bwkg)?>
										
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs13' value='1' <?php if($rs_select[checkboxs13]=='1'){echo 'checked';}?> />
									1.3 ใช้ยาที่แพทย์ไม่ได้สั่ง
									<input type='textbox' name='tbxs13' size='35' value='<?=$rs_select[tbxs13]?>' />
								</td>
							

							</tr>

							
							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									<b>Ht(cm)</b>
								</td>
								<td align="right">
									&nbsp;		
									<?=sql_pharmacy_array($sql_htcm)?>
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs14' value='1'  <?php if($rs_select[checkboxs14]=='1'){echo 'checked';}?> />
									1.4 ใช้ยาขนาดไม่ถูกต้อง
									<input type='textbox' name='tbxs14' size='36' value='<?=$rs_select[tbxs14]?>' />
								</td>


							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									<b>BMI(Kg/m2)</b>
								</td>
								<td align="right">
									&nbsp;		
									<?=sql_pharmacy_array($sql_bmi)?>
								</td>
								
								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs15' value='1'  <?php if($rs_select[checkboxs15]=='1'){echo 'checked';}?> />
									1.5 ใช้ยาผิดเวลา
									<input type='textbox' name='tbxs15' size='44' value='<?=$rs_select[tbxs15]?>'  />
								</td>


							
							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									<b>HDL-C</b>
								</td>
								<td align="right">
									&nbsp;		
									<?=sql_pharmacy_array($sql_hdlc)?>
								</td>
								
									
								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs16' value='1' <?php if($rs_select[checkboxs16]=='1'){echo 'checked';}?> />
									1.6 ใช้ยาผิด Route
									<input type='textbox' name='tbxs16' size='42' value='<?=$rs_select[tbxs16]?>'  />
								</td>

							
							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									<b>LDL-C</b>
								</td>
								<td align="right">
									&nbsp;		
									<?=sql_pharmacy_array($sql_ldlc)?>
										
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs17' value='1' <?php if($rs_select[checkboxs17]=='1'){echo 'checked';}?> />
									1.7 หยุดใช้ยาก่อนกำหนด
									<input type='textbox' name='tbxs17' size='35' value='<?=$rs_select[tbxs17]?>' />
								</td>
							

							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									<b>Triglyceride</b>
								</td>
								<td align="right">
									&nbsp;		
									<?=sql_pharmacy_array($sql_trigly)?>
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs18' value='1'  <?php if($rs_select[checkboxs18]=='1'){echo 'checked';}?> />
									1.8 ลืมรับประทานมากกว่า 1 มื้อขึ้นไป
									<input type='textbox' name='tbxs18' size='22' value='<?=$rs_select[tbxs18]?>' />
								</td>
							


							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									<b>Cholesterol</b>
								</td>
								<td align="right">
									&nbsp;		
							<?=sql_pharmacy_array($sql_cholesterol)?>
										
								</td>
								
								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs19' value='1' <?php if($rs_select[checkboxs19]=='1'){echo 'checked';}?> />
									1.9 ใช้ยาอื่นที่แพทย์ไม่ได้สั่งใช้
									<input type='textbox' name='tbxs19' size='29' value='<?=$rs_select[tbxs19]?>' />
								</td>
							


							</tr>

						
							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									<b>Protassium</b>
								</td>
								<td align="right">
									&nbsp;		
									<?=sql_pharmacy_array($sql_potassium)?>
										
								</td>

								
								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs110' value='1'  <?php if($rs_select[checkboxs110]=='1'){echo 'checked';}?>  />
									1.10 อื่นๆ
									<input type='textbox' name='tbxs110' size='52' value='<?=$rs_select[tbxs110]?>' />
								</td>
							

							

							</tr>
							
							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									<b>Uric Acid</b>
								</td>
								<td align="right">
									&nbsp;		
							<?=sql_pharmacy_array($sql_uric)?>
										
								</td>
								
									
								<td>
									
									<input type='checkbox' name='checkboxm2' value='1'  <?php if($rs_select[checkboxm2]=='1'){echo 'checked';}?> />
									2. การเก็บรักษายา
									<input type='textbox' name='tbxm2' size='45' value='<?=$rs_select[tbxm2]?>' />
								</td>
							


							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									<b>Creatinine/BUN</b>
								</td>
								<td align="right">
									&nbsp;		
							<?=sql_pharmacy_array($sql_creatinine)?>
									/
							<?=sql_pharmacy_array($sql_bun)?>
										
								</td>

								<td>
									
									<input type='checkbox' name='checkboxm3' value='1' <?php if($rs_select[checkboxm3]=='1'){echo 'checked';}?> />
									3. เกิดอาการไม่พึงประสงค์จากการใช้ยา
									<input type='textbox' name='tbxm3' size='23' value='<?=$rs_select[tbxm3]?>'  />
								</td>
							

							</tr>


							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									<b>Cr.Clearance</b>
								</td>
								<td align="right">
									&nbsp;		
									<input type="text" size="14" name="add_cr_clearance" value='<?=$rs_select[add_cr_clearance]?>' />
										
								</td>

								<td>
									
									<input type='checkbox' name='checkboxm4' value='1' <?php if($rs_select[checkboxm4]=='1'){echo 'checked';}?> />
									4. เกิด Drug Interaction
									<input type='textbox' name='tbxm4' size='38' value='<?=$rs_select[tbxm4]?>'  />
								</td>
							
							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									<b>Urine Protein</b>
								</td>
								<td align="right">
									&nbsp;		
									<?=sql_pharmacy_array($sql_urine_protein)?>
										
								</td>

								<td>
									
									<input type='checkbox' name='checkboxm5' value='1' <?php if($rs_select[checkboxm5]=='1'){echo 'checked';}?> />
									5. การควบคุมพฤติกรรมต่างๆ
									<input type='textbox' name='tbxm5' size='35' value='<?=$rs_select[tbxm5]?>'   />
								</td>
							
							
							</tr>

						

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									<b>EKG</b>
								</td>
								<td align="right">
									&nbsp;		
									<input type="text" size="14" name="add_ekg" value='<?=$rs_select[add_ekg]?>' />
										
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs51' value='1' <?php if($rs_select[checkboxs51]=='1'){echo 'checked';}?> />
									5.1 สูบบุหรี่
									<input type='textbox' name='tbxs51' size='51' value='<?=$rs_select[tbxs51]?>'  />
								</td>
							
							</tr>


							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									<b>Chest X-ray</b>
								</td>
								<td align="right">
									&nbsp;		
									<input type="text" size="14" name="add_chest_xray" value='<?=$rs_select[add_chest_xray]?>' />
										
							</td>

							<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs52' value='1' <?php if($rs_select[checkboxs52]=='1'){echo 'checked';}?> />
									5.2 การออกกำลังกาย
									<input type='textbox' name='tbxs52' size='40' value='<?=$rs_select[tbxs52]?>' />
								</td>
								
							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									<b>Retinal Examination</b>
								</td>
								<td align="right">
									&nbsp;		
									<input type="text" size="14" name="add_retinal_examination" value='<?=$rs_select[add_retinal_examination]?>' />
										
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs53' value='1'  <?php if($rs_select[checkboxs53]=='1'){echo 'checked';}?> />
									5.3 การควบคุมอาหาร
									<input type='textbox' name='tbxs53' size='40' value='<?=$rs_select[tbxs53]?>' />
								</td>
							

							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									<b>Neuro Examination</b>
								</td>
								<td align="right">
									&nbsp;		
									<input type="text" size="14" name="add_neuro_examination" value='<?=$rs_select[add_neuro_examination]?>' />
										
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs54' value='1' <?php if($rs_select[checkboxs54]=='1'){echo 'checked';}?> />
									5.4 เครื่องดื่มแอลกอฮอล์
									<input type='textbox' name='tbxs54' size='35' value='<?=$rs_select[tbxs54]?>' />
								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs55' value='1' <?php if($rs_select[checkboxs55]=='1'){echo 'checked';}?> />
									5.5 อื่นๆ
									<input type='textbox' name='tbxs55' size='54' value='<?=$rs_select[tbxs55]?>' />
								</td>
								

							</tr>

							
							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm6' value='1' <?php if($rs_select[checkboxm6]=='1'){echo 'checked';}?>  />
									6. ความไม่เข้าใจเกี่ยวกับภาวะโรค
									<input type='textbox' name='tbxm6' size='30' value='<?=$rs_select[tbxm6]?>' />
								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm7' value='1' <?php if($rs_select[checkboxm7]=='1'){echo 'checked';}?>  />
									7. ความไม่เข้าใจเกี่ยวกับยา
									<input type='textbox' name='tbxm7' size='36' value='<?=$rs_select[tbxm7]?>' />
								</td>
								

							</tr>

							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm8' value='1' <?php if($rs_select[checkboxm8]=='1'){echo 'checked';}?>  />
									8. ความไม่เข้าใจเกี่ยวกับภาวะแทรกซ้อน
									<input type='textbox' name='tbxm8' size='23' value='<?=$rs_select[tbxm8]?>' />
								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm9' value='1' <?php if($rs_select[checkboxm9]=='1'){echo 'checked';}?> />
									9. ความไม่เข้าใจเกี่ยวกับการปฏิบัติตัว
									<input type='textbox' name='tbxm9' size='26' value='<?=$rs_select[tbxm9]?>'  />
								</td>
								

							</tr>

							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm10' value='1' <?php if($rs_select[checkboxm10]=='1'){echo 'checked';}?> />
									10. Medication error
									<input type='textbox' name='tbxm10' size='43' value='<?=$rs_select[tbxm10]?>' />
								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm11' value='1' <?php if($rs_select[checkboxm11]=='1'){echo 'checked';}?> />
									11. การประเมินโรค HbA1C
									<input type='textbox' name='tbxm11' size='37' value='<?=$rs_select[tbxm11]?>' />
								</td>
								
							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs111' value='1' <?php if($rs_select[checkboxs111]=='1'){echo 'checked';}?> />
									11.1 Poor Control (>8%)
									<input type='textbox' name='tbxs111' size='38'  
									 value='<?=$rs_select[tbxs111]?>'/>
								</td>
								
							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs112' value='1' <?php if($rs_select[checkboxs112]=='1'){echo 'checked';}?> />
									11.2 Moderate Control (7-8%)
									<input type='textbox' name='tbxs112' size='32' value='<?=$rs_select[tbxs112]?>'/>
								</td>
								
							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs113' value='1' <?php if($rs_select[checkboxs113]=='1'){echo 'checked';}?> />
									11.3 Good Control (<7%)
									<input type='textbox' name='tbxs113' size='38' value='<?=$rs_select[tbxs113]?>' />
								</td>
								
							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs114' value='1'  <?php if($rs_select[checkboxs114]=='1'){echo 'checked';}?> />
									11.4 ไม่ทราบระดับ HbA1C ในเลือด
									<input type='textbox' name='tbxs114' size='25' value='<?=$rs_select[tbxs114]?>' />
								</td>
								
							</tr>


							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm12' value='1' <?php if($rs_select[checkboxm12]=='1'){echo 'checked';}?> />
									12. การประเมินโรคตาม FBS
									<input type='textbox' name='tbxm12' size='35' value='<?=$rs_select[tbxm12]?>' />
								</td>
								

							</tr>
							
							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs121' value='1' <?php if($rs_select[checkboxs121]=='1'){echo 'checked';}?> />
									12.1 Poor Control (>180mg%) 
									<input type='textbox' name='tbxs121' size='32'  
									 value='<?=$rs_select[tbxs121]?>'/>
								</td>
								
							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs122' value='1' <?php if($rs_select[checkboxs122]=='1'){echo 'checked';}?> />
									12.2 Moderate Control (126-180 mg%) 
									<input type='textbox' name='tbxs122' size='23'  
									 value='<?=$rs_select[tbxs122]?>'/>
								</td>
								
							</tr>


							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs123' value='1' <?php if($rs_select[checkboxs123]=='1'){echo 'checked';}?> />
									12.3 Good Control (<126 mg%) 
									<input type='textbox' name='tbxs123' size='30'  
									 value='<?=$rs_select[tbxs123]?>'/>
								</td>
								
							</tr>


							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs124' value='1' <?php if($rs_select[checkboxs124]=='1'){echo 'checked';}?> />
									12.4 ไม่ทราบระดับ FBS ในเลือด 
									<input type='textbox' name='tbxs124' size='28'  
									 value='<?=$rs_select[tbxs124]?>'/>
								</td>
								
							</tr>


							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm13' value='1' <?php if($rs_select[checkboxm13]=='1'){echo 'checked';}?> />
									13. BMI มากกว่า 23kg/m(2)
									<input type='textbox' name='tbxm13' size='35' value='<?=$rs_select[tbxm13]?>' />
								</td>
								

							</tr>


							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm14' value='1' <?php if($rs_select[checkboxm14]=='1'){echo 'checked';}?> />
									14. อื่นๆ 
									<input type='textbox' name='tbxm14' size='35' value='<?=$rs_select[tbxm14]?>' />
								</td>
								
							</tr>



						</table>

					</td>


				</tr>

								

				<tr>
					<td colspan="2" align="center">
						<b>เภสัชกรผู้ให้คำแนะนำปรึกษา</b>
					</td>

					<td colspan="2">
						
						<input type="text" name="screen_name" size="65" value="<?=$rs_select['screen_name']?>" />
					</td>

				</tr>
				
				<tr bgcolor='yellow'>
					<td colspan="4" align="center">
							
<input type="hidden" name="vn" value="<?=$_GET['vn']?>" />
<input type="hidden" name="hn" value="<?=$_GET['hn']?>" />
<input type="hidden" name="vstdate" value="<?=$_GET['vstdate']?>" />

						<input type="submit" value="แก้ไขข้อมูลการให้คำแนะนำ" />
						<input type="reset" value="ยกเลิก" />
					</td>
				</tr>

			
			</table>

</form>



<br/>
<br/>
 </body>
</html>
