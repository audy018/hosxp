<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<HTML>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

 <HEAD>
  <TITLE> รายละเอียดประวัติการตรวจ LDL < 100 </TITLE>


 </HEAD>

 <BODY>



<br>


<center>
		

<?php



$sqlOpd_Socail ="SELECT o.vstdate,o.hn,concat(p.pname, p.fname,'  ',p.lname) as full_name,
c.clinic, cl.name as clinic_name,lo.lab_items_code,li.lab_items_name,lo.confirm,lo.lab_order_result as lab_result

FROM ovst o

left outer join clinicmember c ON c.hn=o.hn
left outer join clinic cl      ON cl.clinic =  c.clinic
left outer join vn_stat v      ON v.vn = o.vn
left outer join patient p      ON p.hn = o.hn
left outer join lab_head lh    ON lh.vn = v.vn
left outer join lab_order lo   ON lo.lab_order_number = lh.lab_order_number
left outer join lab_items li   ON li.lab_items_code = lo.lab_items_code


WHERE lo.lab_items_code in ('3008')

AND lo.confirm='Y'

AND o.vstdate BETWEEN '$d1' AND '$d2'

AND o.vn = v.vn and c.clinic='001'  AND lo.lab_order_result<100  AND lo.lab_order_result!=''
 AND o.hn='$hn'

ORDER  BY o.hn ";



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
                            <td width="191" align="center"  background="img_mian/bgcolor2.gif">ค่า LDL</td>
                           
                           
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
									<td>&nbsp;<?=$rs[lab_result]?></td>
								
								</tr>

		<?}?>

		<tr>
				<td colspan="7">&nbsp;</td>
		</tr>
	</table>


</center>
  
 </BODY>
</HTML>
