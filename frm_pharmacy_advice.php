<?php

	session_start();
	include("phpconf.php");
	include("func.php");
	conDB();

	$vstdate=$_GET['vstdate'];

?>

<script LANGUAGE="JavaScript">
<!--
// 
function confirmSubmit()
{
var agree=confirm("�׹�ѹ������������š�������йӻ�֡���褹����¹��?");
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
 <meta http-equiv="Content-Type" content="text/html; charset=tis-620">

  <title>Ẻ�������������йӻ�֡������ͧ�� </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">


 </head>

 <body>

 <br/>


 <form method="POST" action="pharmacy_advice_insert.php">

			<table width="800" align="center" border="1">
				<tr>
					<td colspan="3" width="400">
							&nbsp;
							<b>Ẻ�������������йӻ�֡������ͧ��</b>
							
					</td>

					<td>
						&nbsp;
						<b>�ѹ ��͹ �� </b>
						<b>
						<font color='red'><?=$_GET['vstdate'];?></font>
						</b>
					</td>
				</tr>

					<tr>
					<td colspan="3" width="70%">
							&nbsp;
							<b>����-ʡ�� ������</b>
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
						<b>���Ѵ��ͧ</b>
					</td>
				</tr>
				
				<tr>
					<td colspan="4">

							<table border="1">
								<tr>
									<td width="200">
										<input type="radio" name="screen_type" value='1'>
										<b>ᾷ��</b>
									</td>
									<td width="200">
										<input type="radio" name="screen_type" value='2' checked>
										<b>���Ѫ��</b>
									</td>
									<td width="200">
										<input type="radio" name="screen_type" value='3'>
										<b>��Һ��</b>
									</td>
									<td width="200">
										<input type="radio" name="screen_type" value='4'>
										<b>�����¢��Ѻ��ԡ���ͧ</b>
									</td>
								</tr>
							</table>

					</td>
				</tr>

				<tr>
					<td align="center" colspan="4">
						
							<table border="0" width="800">
								
								<tr bgcolor='yellow'>
									<td><b>�ӴѺ</td>
									<td width="350">&nbsp;<b>��¡����</b></td>
									<td width="150">&nbsp;<b>strength</b></td>
									<td width="150">&nbsp;<b>units</b></td>
									<td width="150">&nbsp;<b>����ҳ��è���</b></td>

								
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
										
										<b>��ҷҧ��ͧ��Ժѵԡ��</b>
										
								</td>

								<td align="center">
										
										<b>��������´�ѭ��/������</b>
										
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
									<input type='checkbox' name='checkboxm1' value='1'/>
									1. �ѭ�ҡ������������������㹡������
									<input type='textbox' name='tbxm1' />
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
									<input type='checkbox' name='checkboxs11' value='1'/>
									1.1 �����ç�Ѵ
									<input type='textbox' name='tbxs11' size='45' />
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
									<input type='checkbox' name='checkboxs12' value='1'/>
									1.2 ���ҼԴ�Ը�
									<input type='textbox' name='tbxs12' size='47' />
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
									<input type='checkbox' name='checkboxs13' value='1'/>
									1.3 ���ҷ��ᾷ����������
									<input type='textbox' name='tbxs13' size='35' />
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
									<input type='checkbox' name='checkboxs14' value='1'/>
									1.4 ���Ң�Ҵ���١��ͧ
									<input type='textbox' name='tbxs14' size='36'/>
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
									<input type='checkbox' name='checkboxs15' value='1' />
									1.5 ���ҼԴ����
									<input type='textbox' name='tbxs15' size='44' />
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
									<input type='checkbox' name='checkboxs16' value='1'/>
									1.6 ���ҼԴ Route
									<input type='textbox' name='tbxs16' size='42'/>
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
									<input type='checkbox' name='checkboxs17' value='1'/>
									1.7 ��ش���ҡ�͹��˹�
									<input type='textbox' name='tbxs17' size='35' />
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
									<input type='checkbox' name='checkboxs18' value='1'/>
									1.8 ����Ѻ��зҹ�ҡ���� 1 ���͢���
									<input type='textbox' name='tbxs18' size='22' />
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
									<input type='checkbox' name='checkboxs19' value='1' />
									1.9 ������蹷��ᾷ������������
									<input type='textbox' name='tbxs19' size='29' />
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
									<input type='checkbox' name='checkboxs110' value='1'/>
									1.10 ����
									<input type='textbox' name='tbxs110' size='52' />
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
									
									<input type='checkbox' name='checkboxm2' value='1'/>
									2. ������ѡ����
									<input type='textbox' name='tbxm2' size='45'/>
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
									
									<input type='checkbox' name='checkboxm3' value='1' />
									3. �Դ�ҡ�����֧���ʧ��ҡ�������
									<input type='textbox' name='tbxm3' size='23'/>
								</td>
							

							</tr>


							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									<b>Cr.Clearance</b>
								</td>
								<td align="right">
									&nbsp;		
									<input type="text" size="14" name="add_cr_clearance"/>
										
								</td>

								<td>
									
									<input type='checkbox' name='checkboxm4' value='1'/>
									4. �Դ Drug Interaction
									<input type='textbox' name='tbxm4' size='38'/>
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
									
									<input type='checkbox' name='checkboxm5' value='1' />
									5. ��äǺ����ĵԡ�����ҧ�
									<input type='textbox' name='tbxm5' size='35' />
								</td>
							
							
							</tr>

						

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									<b>EKG</b>
								</td>
								<td align="right">
									&nbsp;		
									<input type="text" size="14" name="add_ekg" />
										
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs51' value='1' />
									5.1 �ٺ������
									<input type='textbox' name='tbxs51' size='51' />
								</td>
							
							</tr>


							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									<b>Chest X-ray</b>
								</td>
								<td align="right">
									&nbsp;		
									<input type="text" size="14" name="add_chest_xray" />
										
							</td>

							<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs52' value='1' />
									5.2 ����͡���ѧ���
									<input type='textbox' name='tbxs52' size='40' />
								</td>
								
							</tr>

							<tr bgcolor="#B1C3D9">
								<td>
									&nbsp;
									<b>Retinal Examination</b>
								</td>
								<td align="right">
									&nbsp;		
									<input type="text" size="14" name="add_retinal_examination" />
										
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs53' value='1' />
									5.3 ��äǺ��������
									<input type='textbox' name='tbxs53' size='40' />
								</td>
							

							</tr>

							<tr bgcolor='yellow'>
								<td>
									&nbsp;
									<b>Neuro Examination</b>
								</td>
								<td align="right">
									&nbsp;		
									<input type="text" size="14" name="add_neuro_examination" />
										
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs54' value='1' />
									5.4 ����ͧ������š�����
									<input type='textbox' name='tbxs54' size='35'/>
								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs55' value='1' />
									5.5 ����
									<input type='textbox' name='tbxs55' size='54' />
								</td>
								

							</tr>

							
							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm6' value='1' />
									6. ���������������ǡѺ�����ä
									<input type='textbox' name='tbxm6' size='30' />
								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm7' value='1' />
									7. ���������������ǡѺ��
									<input type='textbox' name='tbxm7' size='36'/>
								</td>
								

							</tr>

							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm8' value='1'/>
									8. ���������������ǡѺ�����á��͹
									<input type='textbox' name='tbxm8' size='23'/>
								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm9' value='1' />
									9. ���������������ǡѺ��û�ԺѵԵ��
									<input type='textbox' name='tbxm9' size='26'/>
								</td>
								

							</tr>

							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm10' value='1' />
									10. Medication error
									<input type='textbox' name='tbxm10' size='43' />
								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm11' value='1' />
									11. ��û����Թ�ä HbA1C
									<input type='textbox' name='tbxm11' size='37'/>
								</td>
								

							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs111' value='1' />
									11.1 Poor Control (>8%) 
									<input type='textbox' name='tbxs111' size='38'/>
								</td>
								
							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs112' value='1' />
									11.2 Moderate Control (7-8%)
									<input type='textbox' name='tbxs112' size='32'/>
								</td>
								
							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs113' value='1' />
									11.3 Good Control (<7%)
									<input type='textbox' name='tbxs113' size='38'/>
								</td>
								
							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs114' value='1' />
									11.4 ����Һ�дѺ HbA1C ����ʹ
									<input type='textbox' name='tbxs114' size='25'/>
								</td>
								
							</tr>




							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm12' value='1' />
									12. ��û����Թ�ä��� FBS
									<input type='textbox' name='tbxm12' size='36' />
								</td>
								
							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs121' value='1' />
									12.1 Poor Control (>180mg%) 
									<input type='textbox' name='tbxs121' size='32'/>
								</td>
								
							</tr>
							
							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs122' value='1' />
									12.2 Moderate Control (126-180 mg%) 
									<input type='textbox' name='tbxs122' size='23'/>
								</td>
								
							</tr>


							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs123' value='1' />
									12.3 Good Control (<126 mg%) 
									<input type='textbox' name='tbxs123' size='30'/>
								</td>
								
							</tr>

							<tr bgcolor='#B1C3D9'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
									&nbsp;&nbsp;
									<input type='checkbox' name='checkboxs124' value='1' />
									12.4 ����Һ�дѺ FBS ����ʹ 
									<input type='textbox' name='tbxs124' size='29'/>
								</td>
								
							</tr>


							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm13' value='1' />
									13. BMI �ҡ���� 23kg/m(2)
									<input type='textbox' name='tbxm13' size='36' />
								</td>
								
							</tr>


							<tr bgcolor='yellow'>
								<td colspan='2'>
									&nbsp;
								</td>

								<td>
								
									<input type='checkbox' name='checkboxm14' value='1' />
									14. ����
									<input type='textbox' name='tbxm14' size='57' />
								</td>
								
							</tr>



						</table>

					</td>


				</tr>

								

				<tr>
					<td colspan="4" align="left">
						&nbsp;&nbsp;
						<b>���Ѫ�ü�������йӻ�֡��</b>
						&nbsp;
					<input type="text" name="screen_name" size="30" value="�ҧ����ѹʹ�  ˹ٷͧ���"/>

					</td>
				</tr>
				
				<tr bgcolor='yellow'>
					<td colspan="4" align="center">
							
<input type="hidden" name="vn" value="<?=$_GET['vn']?>" />
<input type="hidden" name="hn" value="<?=$_GET['hn']?>" />
<input type="hidden" name="vstdate" value="<?=$_GET['vstdate']?>" />

						<input type="submit" value="���������š�������й�" onClick="return confirmSubmit()"/>
						<input type="reset" value="¡��ԡ" />
					</td>
				</tr>

			
			</table>

</form>

<br/>
<br/>
 </body>
</html>
