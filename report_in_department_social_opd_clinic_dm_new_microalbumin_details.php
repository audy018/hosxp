<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<HTML>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

 <HEAD>
  <TITLE> รายละเอียดการสั่งตรวจแลปของคนไข้ </TITLE>


 </HEAD>

 <BODY>



<br>


<center>
		

<?php


		$sqlOpd_Socail="select  o.vstdate,o.hn,concat(p.pname,p.fname,'  ',";
		$sqlOpd_Socail.="p.lname) as ptname ,c.clinic,cl.name, lo.lab_items_code,lo.lab_order_result,li.lab_items_name, lo.confirm  ";
		$sqlOpd_Socail.="from ovst o ";

		$sqlOpd_Socail.="left outer join clinicmember c ON c.hn=o.hn ";
		$sqlOpd_Socail.="left outer join clinic cl ON cl.clinic =  c.clinic ";
		$sqlOpd_Socail.="left outer join vn_stat v ON v.vn = o.vn ";
		$sqlOpd_Socail.="left outer join patient p ON p.hn = o.hn ";
		$sqlOpd_Socail.="left outer join lab_head lh ON lh.vn = v.vn ";
		$sqlOpd_Socail.="left outer join lab_order lo ON lo.lab_order_number = lh.lab_order_number ";
		$sqlOpd_Socail.="left outer join lab_items li ON li.lab_items_code = lo.lab_items_code ";


		$sqlOpd_Socail.="WHERE lo.lab_items_code in ('3209') AND lo.confirm='Y' ";
		$sqlOpd_Socail.="AND o.vstdate BETWEEN '$d1' AND '$d2' ";
		$sqlOpd_Socail.="AND o.vn = v.vn and c.clinic='001' and o.hn='$_GET[hn]' and c.new_case='Y'";
		$sqlOpd_Socail.="ORDER  BY o.vstdate ";
		
		

		$result=mysql_db_query($DBName,$sqlOpd_Socail) or
			die(mysql_error());

					
?>
						
						<table width="950" border="1" cellpadding="1" cellspacing="1">
                          <tr>
                           
                            <td width="110"  align="center" background="img_mian/bgcolor2.gif">
							&nbsp;&nbsp;
							วันที่ตรวจ</td>

                            <td width="44" align="center"  background="img_mian/bgcolor2.gif">HN</td>
                           

                            <td width="155" align="center"  background="img_mian/bgcolor2.gif">ชื่อ-สกุล</td>
                            
                            <td width="49" align="center"  background="img_mian/bgcolor2.gif">คลินิค</td>
                            <td width="110" align="center"  background="img_mian/bgcolor2.gif">ชื่อคลินิค</td>
                            <td width="141" align="center"  background="img_mian/bgcolor2.gif">รายการแล็ปที่สั่ง</td>
							 <td width="100" align="center"  background="img_mian/bgcolor2.gif">ผลแล็ป</td>
                           
                           
                          </tr>

					<?
							
							while($rs=mysql_fetch_array($result)){
								

					?>
			
								<tr>
									
									<td align="center"><?=$rs[vstdate]?></td>
									<td>&nbsp;<?=$rs[hn]?></td>
									<td>&nbsp;<?=$rs[ptname]?></td>
									<td align='center'><?=$rs[clinic]?></td>
									<td><?=$rs[name]?></td>
									<td>&nbsp;<?=$rs[lab_items_name]?></td>
									<td align='center'><?=$rs[lab_order_result]?></td>
								
								</tr>

		<?}?>

		<tr>
				<td colspan="7">&nbsp;</td>
		</tr>
	</table>


</center>
  
 </BODY>
</HTML>
