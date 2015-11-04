<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();




?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE>ผลการค้นหาประชากร ตามหมู่และบ้านเลขที่ ที่เลือก </TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
 </HEAD>

 <BODY>
  
  <?

$sqlOpd_Socail= "select p.* ,concat(p.pname,' ',p.fname,'  ',p.lname) as person_name,pc.name as pttype_name,x.name as sex_name  ,n.name as nationality_name,  e.name as education_name ,
o.name as occupation_name,r.name as religion_name,  y.name as marrystatus_name ,t.house_regist_type_name ,p.birthdate as birthday

from person  p  

left outer join pcode pc on pc.code = p.pcode  
left outer join sex x on x.code = p.sex  
left outer join nationality n on n.nationality = p.nationality  
left outer join education e on e.education = p.education  
left outer join occupation o on o.occupation = p.occupation  
left outer join religion r on r.religion = p.religion  
left outer join marrystatus y on y.code = p.marrystatus  
left outer join house_regist_type t on t.house_regist_type_id = p.house_regist_type_id  

where p.house_id =$_GET[house_id] and p.death='N' ";


$resultOpd_Socail=ResultDB($sqlOpd_Socail);

		
		if(mysql_num_rows($resultOpd_Socail)>0){
			
			echo "<br/>";
			echo "<center>";
			echo "<h3>ผลการค้นหา บุคคลที่อยู่ในหมู่ที่  :<font color='blue'> $_GET[village_moo]</font>";

	
			//$_GET[house_id]";

			echo "<br/>";

			echo "บ้านเลขที่ :<font color='blue'> $_GET[address]</font>";
			echo "</h3></center>";


		}

  ?>


  <table width ='1100' border='1' align='center'>
		<tr align='center' bgcolor='red'>
			<td width='30'>
					ที่
			</td>

			<td width='100'> 
					HN

			</td>

			<td width='130'>
					รหัสบัตรประชาชน
			</td>
			
			<td width='160'>
					ชื่อ สกุล
			</td>

			<td>
					วัน เดือน ปี เกิด
			</td>

			<td>
					สถานะภาพสมรส
			</td>


			<td>
					สัญชาติ
			</td>

			<td>
					ศาสนา
			</td>

			<td>
					อาชีพ
			</td>


		</tr>
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
                            
							
							<td  align="center">
							<?php echo $rsOpd_Socail['patient_hn']; ?>	
							</td>

							<td>
								<?php echo $rsOpd_Socail['cid'];?>
							</td>

							<td>
							<?php echo $rsOpd_Socail['person_name'];?>
							</td>
							<td align='center'>
							<?php echo FormatDate($rsOpd_Socail['birthday']);?>
							</td>

							<td align='center'>
							<?php echo $rsOpd_Socail['marrystatus_name'];?>
						
							</td>

							<td align='center'>
							<?php echo $rsOpd_Socail['nationality_name'];?>
						
							</td>

							<td align='center'>
						<?php echo $rsOpd_Socail['religion_name'];?>
						
							</td>

							
							<td>
						<?php echo $rsOpd_Socail['occupation_name'];?>
						
							</td>
                           
                        
                          </tr>

						 
                          <?php
						$i++;
					} //while 
					?>
                        </table></td>
                      </tr>
                    </table>






 </BODY>
</HTML>
