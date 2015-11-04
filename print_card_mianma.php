<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title></title>

<style type="text/css" >
table.coll 
{
border-collapse: collapse
}
table.sep
{
border-collapse: separate
}
.sep {
	height: 80px;
	width: 20px;
}
.apDiv1 {
	position:absolute;
	left:755px;
	top:83px;
	width:84px;
	height:78px;
	z-index:1;
	border:solid;
	background-color: #FFFFFF;
}
body {
	margin-top: 0px;
	margin-bottom:0px;
}

.css-font{

font-family:sans-serif;
font-size:10pt;

}

</style>

</head>

<body>

<center>

<table border='1' width='620' align='center' class="coll">

  <?

$data = ($_POST);	

Foreach($data as $k =>$v){
			if($v=='on'){

$sqlOpd_Socail="SELECT  v.vn,v.hn,v.vstdate ,v.hospmain
,v.pttype_begin,v.pttype_expire
,p.cid,p.pname,p.fname as fname,p.lname as lname,p.birthday ,p.nationality ,
        n.name as nation_name ,s.name as sex_name,p.informaddr  ,p.informname,p.informname ,p.hometel,p.addrpart,p.moopart,
		t.name as th_name,t.full_name,t2.name as amppart,t3.name as chwpart


FROM vn_stat v
left outer join patient p on p.hn = v.hn
left outer join nationality n on n.nationality = p.nationality
left outer join sex s on s.code = p.sex

left outer join thaiaddress t on  
 t.addressid=concat(p.chwpart,p.amppart,p.tmbpart)

left outer join thaiaddress t2 on t2.codetype='2' and t2.chwpart=p.chwpart 
and t2.amppart=p.amppart

left outer join thaiaddress t3 on t3.codetype='1' and t3.chwpart=p.chwpart



 WHERE   v.vn ='$k'";

$resultOpd_Socail=ResultDB($sqlOpd_Socail);

$i=0;
while($i<mysql_num_rows($resultOpd_Socail)){//while
	$rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);	


	echo "<tr>

<td valign='top' width='313'>
			<table  cellspacing='0' cellpadding='2'>


				<tr>
					<td>
							&nbsp;
							<b>ใบรับรองแพทย์
							&nbsp;&nbsp;
							&nbsp;&nbsp;
							&nbsp;&nbsp;
							/ 56</b>
					</td>
				</tr>
				
				<tr><td>&nbsp;</td></tr>
			
				<tr>
					<td align='center'>
							<font size='3'><b>คำแนะนำการใช้บัตร</b></font>
					</td>
				</tr>

				<tr>
					<td>
							<font class='css-font'>
							&nbsp;
							1. นำบัตรติดตัวตลอดเวลา</font>
					</td>
				</tr>

				<tr>
					<td>
							<font class='css-font'> 
							&nbsp;
							2. ให้ไปรับบริการที่สถานพยาบาลที่ระบุในบัตรเท่านั้น</font>
					</td>
				</tr>

				<tr>
					<td>
							<font class='css-font'>
							&nbsp;
							 3. เมื่อเข้ารับการรักษาพยาบาลให้ยื่นบัตรประจำตัว
							</font>
					</td>
				</tr>

				<tr>
					<td>
							<font class='css-font'>
							&nbsp;
							 คนไม่มีสัญชาติไทยและบัตรประกันสุขภาพด้วย
							</font>
					</td>
				</tr>

				<tr>
					<td>
							<font class='css-font'>
							&nbsp;
							 4. ถ้ามีปัญหาติดต่อTel 077-559115-6 ต่อ 102
							</font>
					</td>
				</tr>



			</table>


	
	
	
	</td>
	
	
	<td  valign='top' width='307'>
		
		<table cellspacing='0' cellpadding='0' border='0'>
			
			<tr>
			
			<td colspan='2'>
				<font size='2'>บัตรสุขภาพแรงงานต่างด้าว/ผู้ติดตามที่ไม่มีสัญชาติไทย</font>
			</td>
			
			</tr>

			<tr><td colspan='2'>
				<font size='2'>เลขที่ประจำตัวคนไม่มีสัญชาติ <u>";
?>				
  <?php// echo $rsOpd_Socail[cid]?><?php echo "<b>";?><?php echo substr($rsOpd_Socail[cid],0,2)?><?echo "-";?><?php echo substr($rsOpd_Socail[cid],2,4)?><?echo "-";?><?php echo substr($rsOpd_Socail[cid],6,6)?><?echo "-";?><?php echo substr($rsOpd_Socail[cid],12,1)?><?php echo "</b>";?>
  
  <?
	echo "</u></font>
			</td></tr>

			<tr><td >
				<font size='2'>สถานพยาบาลที่ประกันตนโรงพยาบาลละแม</font>
				</td>
				
				<td rowspan='4' width='63' align='left' valign='bottom'>
				";
				
?>
				
<table  width='65' height='75' border='1' class='coll' align='center'>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
				
<? echo "
		

			</td></tr>
			
			<tr>
				<td>&nbsp;
				</td>
			</tr>

			<tr><td>
				<font size='2'>ชื่อ </font>
				<font size='2'>
				$rsOpd_Socail[pname]$rsOpd_Socail[fname]
				$rsOpd_Socail[lname]
				
				</font>
				  
				  <font size='3'><b>HN $rsOpd_Socail[hn]</b></font>
			</td></tr>

			<tr><td>
				<font size='2'>
				ที่อยู่  <u>$rsOpd_Socail[addrpart] หมู่ $rsOpd_Socail[moopart] ตำบล <u>$rsOpd_Socail[th_name]</u>
				</font>
			</td></tr>

			<tr><td colspan='2'>
				
				<table border='0' width='300px' cellpadding='0' cellspacing='0'>
					<tr>
						<td>

				&nbsp;
				<font size='2'>
				อำเภอ$rsOpd_Socail[amppart]
				จังหวัด$rsOpd_Socail[chwpart]
				</font>
						</td>

				<td width='90px'><img src='img_mian/nattapat_signature.jpg' width='45px'></img>
					</td></tr>
				</table>


			</td></tr>

			<tr><td colspan='2'>";
	?>
  
  <?echo "&nbsp;";?>
  <?echo "<font size='1'>"?>
  <?echo dateThai($rsOpd_Socail[pttype_begin])?>
  
  
  <?echo "&nbsp;";?>
  <?echo dateThai($rsOpd_Socail[pttype_expire])?>
  
  <?echo "&nbsp;";?>
  <?echo "&nbsp;&nbsp;(นพ.ณัฐภัทร &nbsp; สรรเพชร)";?>
  <?echo "</font>";?>
  
  
  <?echo "</td></tr>";?>
  
  <?echo "
			<tr><td colspan='2'>
				&nbsp;
				<font size='1'><b>วันออกบัตร</b></font>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<font size='1'><b>วันหมดอายุ</b></font>
				&nbsp;
				
				<font size='1'>
				รก.ผู้อำนวยการโรงพยาบาลละแม
				</font>
			</td></tr>




			
			
		</table>

	
	
	</td>
			
		

	
	</tr>";


$i++;

}}}

?>

  </center>
</body>

</html>
