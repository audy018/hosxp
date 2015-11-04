<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<HTML>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

 <HEAD>
  <TITLE> รายละเอียดการตรวจ BP </TITLE>


 </HEAD>

 <BODY>



<br>


<center>
		

<?php



$sqlOpd_Socail ="select concat(pt.pname,pt.fname,'  ',pt.lname) as full_name,c.name as clinic_name,cl.clinic,oc.bps,oc.bpd,oc.bw,o.*
from ovst o
left outer join clinicmember cl on cl.hn = o.hn
left outer join clinic c on c.clinic =cl.clinic
left outer join opdscreen oc on oc.vn = o.vn
left outer join patient pt on pt.hn = o.hn
where cl.clinic = '002'  and oc.bps!=''   and (oc.bps<140 and oc.bpd<90) and o.hn='$hn'
and o.vstdate between '$d1' and '$d2' ORDER by o.hn";




		$result=mysql_db_query($DBName,$sqlOpd_Socail) or
			die(mysql_error());

					
?>
						
						<table width="900" border="1" cellpadding="1" cellspacing="1">
                          <tr>
                           
                            <td width="110"  align="center" background="img_mian/bgcolor2.gif">
							&nbsp;&nbsp;
							วันที่ตรวจ</td>

                            <td width="44" align="center"  background="img_mian/bgcolor2.gif">HN</td>
                           

                            <td width="155" align="center"  background="img_mian/bgcolor2.gif">ชื่อ-สกุล</td>
                            
                            <td width="49" align="center"  background="img_mian/bgcolor2.gif">คลินิค</td>
                            <td width="110" align="center"  background="img_mian/bgcolor2.gif">ชื่อคลินิค</td>
                            <td width="191" align="center"  background="img_mian/bgcolor2.gif">ค่า BP</td>
                           
                           
                          </tr>

					<?
							
							while($rs=mysql_fetch_array($result)){
								

					?>
			
								<tr>
									
									<td align="center"><?=$rs[vstdate]?></td>
									<td>&nbsp;<?=$rs[hn]?></td>
									<td>&nbsp;<?=$rs[full_name]?></td>
									<td align='center'><?=$rs[clinic]?></td>
									<td><?=$rs[clinic_name]?></td>
									<td>&nbsp;<?=$rs[bps]?>/<?=$rs[bpd]?></td>
								
								</tr>

		<?}?>

		<tr>
				<td colspan="7">&nbsp;</td>
		</tr>
	</table>


</center>
  
 </BODY>
</HTML>
