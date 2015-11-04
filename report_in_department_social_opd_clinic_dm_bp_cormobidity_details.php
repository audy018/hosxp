<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<HTML>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

 <HEAD>
  <TITLE> รายละเอียดภาวะแทรกซ้อน </TITLE>


 </HEAD>

 <BODY>



<br>


<center>
		

<?php


$sqlOpd_Socail ="select ccm.hn,concat(pt.pname,pt.fname,'  ',pt.lname) as ptname ,

ccm.cormobidity,ccb.name as cormobidity_name

from clinic_cormobidity_list ccm

left outer join patient pt on pt.hn = ccm.hn

left outer join clinic_cormobidity ccb on ccb.cormobidity = ccm.cormobidity  and ccb.clinic='001'

where ccm.hn='$hn' and ccm.clinic='001' and ccm.cormobidity in('2','4','5','6')";





		$result=mysql_db_query($DBName,$sqlOpd_Socail) or
			die(mysql_error());

					
?>
						
						<table width="720" border="1" cellpadding="1" cellspacing="1">
                          <tr>
                           
                     

                            <td width="44" align="center"  background="img_mian/bgcolor2.gif">HN</td>
                           

                            <td width="180" align="center"  background="img_mian/bgcolor2.gif">ชื่อ-สกุล</td>
                            
                            <td width="150" align="center"  background="img_mian/bgcolor2.gif">รหัสโรคแทรกซ้อน</td>
                            <td width="250" align="center"  background="img_mian/bgcolor2.gif">ชื่อโรคแทรกซ้อน</td>
                        
                          </tr>

					<?
							
							while($rs=mysql_fetch_array($result)){
								

					?>
			
								<tr>
									
								
									<td>&nbsp;<?=$rs[hn]?></td>
									<td>&nbsp;<?=$rs[ptname]?></td>
									<td align='center'><?=$rs[cormobidity]?></td>
									<td><?=$rs[cormobidity_name]?></td>
									
								
								</tr>

		<?}?>

		<tr>
				<td colspan="7">&nbsp;</td>
		</tr>
	</table>


</center>
  
 </BODY>
</HTML>
