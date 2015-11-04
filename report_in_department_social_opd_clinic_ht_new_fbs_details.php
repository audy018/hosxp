<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<HTML>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

 <HEAD>
  <TITLE> ประวัติการตรวจ FBS ของคนไข้ </TITLE>


 </HEAD>

 <BODY>



<br>


<center>
		

<?php

$sqlOpd_Socail ="select  o.vstdate,o.hn,concat(p.pname, p.fname,'  ',p.lname) as full_name, ";
$sqlOpd_Socail.="c.clinic,cl.name,oc.fbs ";
$sqlOpd_Socail.="from ovst o ";

$sqlOpd_Socail.="left outer join clinicmember c ON c.hn=o.hn   and c.new_case='Y' ";
$sqlOpd_Socail.="left outer join clinic cl ON cl.clinic =  c.clinic ";
$sqlOpd_Socail.="left outer join vn_stat v ON v.vn = o.vn ";
$sqlOpd_Socail.="left outer join patient p ON p.hn = o.hn ";
$sqlOpd_Socail.="left outer join opdscreen oc ON oc.vn = o.vn ";

$sqlOpd_Socail.="WHERE o.vstdate BETWEEN '$d1' AND '$d2' ";
$sqlOpd_Socail.="AND o.vn = v.vn and c.clinic='002'  and oc.fbs !=0 and o.hn='$_GET[hn]'";
$sqlOpd_Socail.="ORDER  BY o.hn ";




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
                            <td width="191" align="center"  background="img_mian/bgcolor2.gif">ค่า FBS</td>
                           
                           
                          </tr>

					<?
							
							while($rs=mysql_fetch_array($result)){
								

					?>
			
								<tr>
									
									<td align="center"><?=$rs[vstdate]?></td>
									<td>&nbsp;<?=$rs[hn]?></td>
									<td>&nbsp;<?=$rs[full_name]?></td>
									<td align='center'><?=$rs[clinic]?></td>
									<td><?=$rs[name]?></td>
									<td>&nbsp;<?=$rs[fbs]?></td>
								
								</tr>

		<?}?>

		<tr>
				<td colspan="7">&nbsp;</td>
		</tr>
	</table>


</center>
  
 </BODY>
</HTML>
