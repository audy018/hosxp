<?php

	session_start();
	include("phpconf.php");
	include("func.php");
	conDB();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title> โปรแกรมบันทึกข้อมูล GFR </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Descriptrion" content="" charset="tis-620" />

 <script LANGUAGE="JavaScript">
<!--
// 
function confirmSubmit()
{
var agree=confirm("ยืนยันการบันทึกข้อมูล GFR?");
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>




 </head>

 <body bgcolor="#6666FF">

<br/>
<br/>
<br/>
<?
	
	$vn=$_GET['vn'];
	$hn=$_GET['hn'];
	$ptname=$_GET['ptname'];
	$vstdate=$_GET['vstdate'];


?>

 <form method="POST" action="egfr_insert.php">

	<table width="800" align="center" border="0" bgcolor="#3399FF">

		<tr>
			<td width="200px" align="center" colspan="2">&nbsp</td>
			
		</tr>

		
		<tr>
			<td width="200px" align="center" colspan="2"><h2>โปรแกรมบันทึกข้อมูล GFR</h2></td>
			
		</tr>
	
		
		<tr>
			<td width="200px" align="right"><b>HN :<b/></td>
			<td><b><?=$hn;?></b></td>
		</tr>

		<tr>
			<td width="200px" align="right"><b>ชื่อ-สกุล :</b></td>
			<td><b><?=$ptname;?></b></td>
		</tr>
		
		<tr>
			<td width="200px" align="right"><b>Creatinine :</b></td>
			<td><input type="text" name="creatinine" style="height: 30px; width: 100px"  /> mg/dl</td>
		</tr>

		<tr>
			<td width="200px" align="right"><b>อายุ :</b></td>
			<td><input type="text" name="age" style="height: 30px; width: 100px" /> ปี</td>
		</tr>

		<tr>
			<td width="200px" align="right"><b>เพศ :</b></td>
			<td><input type="text" name="sex" style="height: 30px; width: 100px" /> (<b>f</b>=ผู้หญิง, <b>m</b>=ผู้ชาย)</td>
		</tr>


		<tr>
			<td width="200px"></td>
			<td>
				<input type="checkbox" name="pt_black" value="1" /> <b>Patient Black</b> (ไม่ต้องติ๊กถูกถ้า Patient non Black)
			</td>
		</tr>

	
		<tr>
			<td width="200px"></td>
			<td>
				&nbsp;
			
			</td>
		</tr>

		<tr>
			<td width="200px"></td>
			<td>
				<input type="submit" value="บันทึกข้อมูล" style="height: 40px; width: 100px" onClick="return confirmSubmit()" />
				<INPUT type=button value="ย้อนกลับ" onClick="history.back();" style="height: 40px; width: 100px" />
			</td>
		</tr>

		<tr>
			<td width="200px"></td>
			<td>
				&nbsp;
			</td>
		</tr>



	</table>



	<input type="hidden" name="vn" value="<?=$vn;?>" />
	<input type="hidden" name="hn" value="<?=$hn;?>" />
	<input type="hidden" name="ptname" value="<?=$ptname;?>" />
	<input type="hidden" name="vstdate" value="<?=$vstdate;?>" />


</form>


 </body>
</html>
