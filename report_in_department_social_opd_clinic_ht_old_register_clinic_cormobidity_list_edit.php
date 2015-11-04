<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE>แก้ไขโรคแทรกซ้อน </TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
 
 <script language="javascript">
	
	function confirm_delete(hn,begin_date)
	{
		var ouput;

		output=confirm('คุณต้องการลบภาวะแทรกซ้อนที่เลือกใช่ไหม?');

		if(output==true){
			
			window.location="report_in_department_social_opd_clinic_ht_new_register_clinic_cormobidity_list_delete.php?hn="+hn+"&begin_date=" + begin_date;
			

		}


	}



</script>

 
 
 
 </HEAD>

 <BODY>
 <br/>
 <br/>
 <br/>



	<?

	$sqlOpd_Socail="select cml.* ,cbd.name
					from clinic_cormobidity_list  cml
					left outer join clinic_cormobidity cbd on cbd.cormobidity = cml.cormobidity and cbd.clinic='002'
					 where cml.hn='$_GET[hn]' and cml.clinic=002";

					$resultOpd_Socail=ResultDB($sqlOpd_Socail);


if(mysql_num_rows($resultOpd_Socail)>0){?>



<table width="600" border="1" cellspacing="0" cellpadding="0" align="center">
	<tr bgcolor='red'>
		<td>
				<b>&nbsp;HN</b>
		</td>

		<td>
				<b>&nbsp;ชื่อโรคแทรกซ้อน</b>
		</td>

		<td>
				<b>&nbsp;ลบ</b>
		</td>


	</tr>

	 <?php
			$i=0;
			        while($i<mysql_num_rows($resultOpd_Socail)){//while
		
					$rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
					
					Print "<tr><td>";
					print "&nbsp;";
					Print $rsOpd_Socail['hn'];
					print "</td>";
					print "<td>";
					print "&nbsp;";
					Print $rsOpd_Socail['name'];
					print "</td>";
					print "<td>";
					print "&nbsp;";
					?>
	<a href="javascript:confirm_delete('<?=$rsOpd_Socail[hn]?>','<?=$rsOpd_Socail[begin_date]?>')">ลบ</a>
					
					<?
					print "</td>";

					Print "</tr>";
		$i++;	
}}else{
					print "<center>";
					print "<h2><font color='red'>ไม่มีการลงภาวะแทรกซ้อนในคนไข้รายนี้</font></h2>";
					print "</center>";
}


?>

</table>

	

 </BODY>
</HTML>
