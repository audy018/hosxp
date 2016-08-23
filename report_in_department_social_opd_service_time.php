<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - รายงานระยะเวลารอคอยเฉลี่ย ->ผู้มารับบริการ OPD - - |</title>
<style type="text/css">
<!--
body {  margin: 0px  0px; padding: 0px  0px}
body{font-family:MS Sans Serif;font-size:10pt}
table,td{font-family:MS Sans Serif;font-size:10pt}
form{font-family:MS Sans Serif;font-size:10pt}
-->
</style>
<?php
//set theme
print "<link href='css/$Theme.css' rel='stylesheet' type='text/css'>";
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
</head>
<?php
if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line

?>
<body>
<table width="1024" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="927" height="276" align="center">
	  <table width="1010" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td colspan="2" valign="top">
            <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
          </td>
        </tr>
        <tr>
          <td width="659" height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC"><?php include("manu.inc"); ?>
          </td>
          <td width="139" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; </td>
        </tr>
        <tr>
          <td height="177" colspan="2" align="center" valign="top" class="td-left"><br>
              <table width="1019" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                <tr align="center" bgcolor="#99CCFF">
                  <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> รายงานระยะเวลารอคอยเฉลี่ยการมารับบริการของคนไข้</td>
                </tr>
                <tr align="center">
           <td colspan="2" valign="top">
<form action="<?php $PHP_SELF ?>" method="get" name="f_select_dmy">
		   <table width="360" border="0" cellspacing="2" cellpadding="1">
             <tr align="center">
               <td colspan="3"><font color="green"><b><u>เลือกช่วงเวลา</u></b></font></td>
               </tr>
             <tr>
               <td width="78">
			<?php
				print"วันที่&nbsp;";
				print"<select name='sd1' id='Txt-Field'>";
				if($sd1<>""){print"<option value='$sd1'>$sd1</option>";}
					for($i=1;$i<=31;$i++){
						print"<option value='$i'>$i</option>";
					}
				print"</select>"; 
				?>
				 </td>
               <td width="129">
			<?php
				print"&nbsp;เดือน&nbsp;";
				print"<select name='sm1' id='Txt-Field'>";
				if($sm1<>""){print"<option value='$sm1'>".change_month_isThai($sm1)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>"; 
				?>
			   </td>
               <td width="135">
				<?php
				print"&nbsp;ปี&nbsp;";
				$sqlSyear="select   DISTINCT YEAR(vstdate) as s_year  from dtmain group by  vstdate desc  ";
				$result=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				print"<select name='sy1'  id='Txt-Field'>";
				if($sy1<>""){print"<option value='$sy1'>".($sy1+543)."</option>";}
					 if(mysql_num_rows($result)>0){
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						print "<option value='".$rs['s_year']."'>".($rs['s_year']+543)."</option>";
						}										    
					}
					print"</select>";
	   		?>&nbsp;&nbsp;&nbsp;&nbsp;	ถึง		   </td>
               </tr>
             <tr>
               <td><?php
				print"วันที่&nbsp;";
				print"<select name='sd2' id='Txt-Field'>";
				if($sd2<>""){print"<option value='$sd2'>$sd2</option>";}
					for($i=1;$i<=31;$i++){
						print"<option value='$i'>$i</option>";
					}
				print"</select>"; 
				?></td>
               <td><?php
				print"&nbsp;เดือน&nbsp;";
				print"<select name='sm2' id='Txt-Field'>";
				if($sm2<>""){print"<option value='$sm2'>".change_month_isThai($sm2)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>"; 
				?></td>
               <td>
			   <?php
				print"&nbsp;ปี&nbsp;";
				$sqlSyear="select   DISTINCT YEAR(vstdate) as s_year  from dtmain group by  vstdate desc  ";
				$result=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				print"<select name='sy2'  id='Txt-Field'>";
				if($sy2<>""){print"<option value='$sy2'>".($sy2+543)."</option>";}
					 if(mysql_num_rows($result)>0){
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						print "<option value='".$rs['s_year']."'>".($rs['s_year']+543)."</option>";
						}										    
					}
				
				print"</select>&nbsp;&nbsp;&nbsp;<input type='submit' value='Continue' id='Button'>";
	   		?>				</td>
               </tr>
           </table>
</form>

		 	</td>
                </tr>
                <tr align="center">
                  <td colspan="2">
				  
				  
				  </td>
                </tr>
                <tr>
                  <td colspan="2"><!-- end สร้างกรอบตาราง --></td>
                </tr>
                <tr align="center" valign="top">
                  <td colspan="2"> </td>
                </tr>
                <tr align="center">
                  <td colspan="2">

				  </td>
                </tr>
                <tr align="center">
                  <td colspan="2">
				  
				
			<?php
				//sql create table show
				$d1=$sy1."-".$sm1."-".$sd1;$d2=$sy2."-".$sm2."-".$sd2;//echo $d1."dd".$d2;


/*
$sqlOpd_Socail="select concat(pt.pname,pt.fname,'  ',pt.lname)as pt_name,s.vn,s.hn, s.vstdate, s.vsttime,s.service16 as pharmacy_confirm, s.service3 as sendpt2screen, s.service4 as startscreen ,
s.service11 as send2doctor, s.service5 as startexam,s.service12 as finishexam,
sec_to_time(time_to_sec(service4)-time_to_sec(service3)) as  waitforscreen,
time_to_sec(service4)-time_to_sec(service3) as waitforscreen2,
sec_to_time(time_to_sec(service11)-time_to_sec(service4)) as timetoscreen,
time_to_sec(service11)-time_to_sec(service4) as timetoscreen2,
sec_to_time(time_to_sec(service5)-time_to_sec(service11)) as waitforexamine,
time_to_sec(service5)-time_to_sec(service11) as waitforexamine2,
sec_to_time(time_to_sec(service12)-time_to_sec(service5)) as timetoexamine,
time_to_sec(service12)-time_to_sec(service5) as timetoexamine2,

sec_to_time(time_to_sec(service12)-time_to_sec(service3)) as timefromvsttime2finishexam,
time_to_sec(service12)-time_to_sec(service3) as timefromvsttime2finishexam2,

sec_to_time(time_to_sec(service16)-time_to_sec(service12)) as timefromvsttime2finishpharmacy,
time_to_sec(service16)-time_to_sec(service12) as timefromvsttime2finishpharmacy2


from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'


and s.vstdate not in (select holiday_date from holiday)

";
*/


$sqlOpd_Socail="select s.service6,s.service16,concat(pt.pname,pt.fname,'  ',pt.lname)as pt_name,s.vn,s.hn, s.vstdate, s.vsttime,s.service16 as pharmacy_confirm, s.service3 as sendpt2screen, s.service4 as startscreen ,
s.service11 as send2doctor, s.service5 as startexam,s.service12 as finishexam,
sec_to_time(time_to_sec(service4)-time_to_sec(service3)) as  waitforscreen,
time_to_sec(service4)-time_to_sec(service3) as waitforscreen2,

sec_to_time(time_to_sec(service11)-time_to_sec(service4)) as timetoscreen,
time_to_sec(service11)-time_to_sec(service4) as timetoscreen2,


sec_to_time(time_to_sec(service5)-time_to_sec(service11)) as waitforexamine,
time_to_sec(service5)-time_to_sec(service11) as waitforexamine2,


sec_to_time(time_to_sec(service12)-time_to_sec(service5)) as timetoexamine,
time_to_sec(service12)-time_to_sec(service5) as timetoexamine2,

sec_to_time(time_to_sec(service16)-time_to_sec(service3)) as timefromvsttime2finis,
time_to_sec(service16)-time_to_sec(service3) as timefromvsttime2finish2,

sec_to_time(time_to_sec(service6)-time_to_sec(service12)) as timefromvsttime2finishpharmacy,
time_to_sec(service6)-time_to_sec(service12) as timefromvsttime2finishpharmacy2,


sec_to_time(time_to_sec(service16)-time_to_sec(service6)) as timefromvsttime2finishpharmacyconfirm,

time_to_sec(service16)-time_to_sec(service6) as timefromvsttime2finishpharmacyconfirm2

from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:00:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)

and s.hn not in (

      select  oa.hn from oapp oa where oa.hn = s.hn and oa.nextdate  = s.vstdate
) 


and s.service3 != '00:00:00'
and s.service4 != '00:00:00'
and s.service5 != '00:00:00'
and s.service6 != '00:00:00'
and s.service7 != '00:00:00'
and s.service16 != '00:00:00'

";





				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){
					print"<u><font color='green'><b>แสดงข้อมูลของวันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font>";
					print"<br>มีทั้งหมด ".mysql_num_rows($resultOpd_Socail)." รายการ</b></font></u>";
						//create row
						?><br><br>
					
<table width="970" border="0" align='left'>
	<tr>
		<td width="15">
			&nbsp;
		</td>
		<td>
			<b>ในการออกรายงานระยะเวลารอคอยของผู้มารับบริการ จะมีเงื่อนไขและข้อจำกัดดังต่อไปนี้ คือ</b>
		</td>
		</tr>

		<tr>
		<td width="15">
			&nbsp;
		</td>
		<td>
			1.เลือกเฉพาะคนไข้ที่มารับบริการในเวลาราชการ คือ 08.00-16.00 น.
		</td>
		</tr>

		<tr>
		<td width="15">
			&nbsp;
		</td>
		<td>
			2.ตัดคนไข้ที่มารับบริการในวันหยุดราชการออก
		</td>
		</tr>

		<tr>
		<td width="15">
			&nbsp;
		</td>
		<td>
			3.ตัดคนไข้นัดออก
		</td>
		</tr>

		<tr>
		<td width="15">
			&nbsp;
		</td>
		<td>
			4.ตัดคนไข้ที่ไม่ได้ผ่านห้องยาเป็นจุดสุดท้าย
		</td>
		</tr>

		<tr>
		<td width="15">
			&nbsp;
		</td>
		<td>
			5.ตัดคนไข้ที่ห้องยาไม่ได้มีการยืนยันการจ่ายยา (เนื่องจากระบบจะไม่มีการบันทึกเวลาจ่ายยา)<br/>
			ทำให้มีความผิดพลาดในการคำนวณหาค่าเฉลี่ยเวลาในการมารับบริการของคนไข้
		</td>
		</tr>



</table>

<br/><br/><br/><br/><br/><br/><br/><br/><br/>

					<table width="1250" border="1" cellspacing="1"
					cellpadding="0">
						<tr>

<td width="125">
	<b>&nbsp;1.เวลาเฉลี่ยรอสกรีน:</b>
</td>

<td width="125" bgcolor='yellow'>
<?
						
$sqlOpd_Socail_1="SELECT  s.*,  


sec_to_time(avg(time_to_sec(service4)-time_to_sec(service3))) as  waitforscreen_sum

from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:00:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)


and s.hn not in (

      select  oa.hn from oapp oa where oa.hn = s.hn and oa.nextdate  = s.vstdate
) 


and s.service3 != '00:00:00'
and s.service4 != '00:00:00'
and s.service5 != '00:00:00'
and s.service6 != '00:00:00'
and s.service7 != '00:00:00'
and s.service16 != '00:00:00'



";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo "<b>".$rsOpd_Socail1['waitforscreen_sum']."</b>";

echo "<b>&nbsp;นาที</b>";
?>
</td>


<td width="125">
	<b>&nbsp;2.เวลาเฉลี่ยสกรีน:</b>
</td>

<td width="125" bgcolor='yellow'>
<?
						
$sqlOpd_Socail_1="SELECT  s.*,  

sec_to_time(avg(time_to_sec(service11)-time_to_sec(service4))) as timetoscreen2_sum


from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:00:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)


and s.hn not in (

      select  oa.hn from oapp oa where oa.hn = s.hn and oa.nextdate  = s.vstdate
) 


and s.service3 != '00:00:00'
and s.service4 != '00:00:00'
and s.service5 != '00:00:00'
and s.service6 != '00:00:00'
and s.service7 != '00:00:00'
and s.service16 != '00:00:00'

";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo "<b>".$rsOpd_Socail1['timetoscreen2_sum']."</b>";

echo "<b>&nbsp;นาที</b>";
?>
</td>











<td width="125">
	<b>&nbsp;3.เวลาเฉลี่ยรอตรวจ:</b>
</td>

<td width="125" bgcolor='yellow'>
<?
						
$sqlOpd_Socail_1="SELECT  s.*,  

sec_to_time(avg(time_to_sec(service5)-time_to_sec(service11))) as waitforexamine_sum

from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:00:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)


and s.hn not in (

      select  oa.hn from oapp oa where oa.hn = s.hn and oa.nextdate  = s.vstdate
) 


and s.service3 != '00:00:00'
and s.service4 != '00:00:00'
and s.service5 != '00:00:00'
and s.service6 != '00:00:00'
and s.service7 != '00:00:00'
and s.service16 != '00:00:00'



";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo "<b>".$rsOpd_Socail1['waitforexamine_sum']."</b>";

echo "<b>&nbsp;นาที</b>";
?>
</td>



<td width="135">
	<b>&nbsp;4.เวลาเฉลี่ยแพทย์ตรวจ:</b>
</td>

<td width="125" bgcolor='yellow'>
<?
						
$sqlOpd_Socail_1="SELECT  s.*,  


sec_to_time(avg(time_to_sec(service12)-time_to_sec(service5))) as timetoexamine2_sum


from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:00:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)


and s.hn not in (

      select  oa.hn from oapp oa where oa.hn = s.hn and oa.nextdate  = s.vstdate
) 


and s.service3 != '00:00:00'
and s.service4 != '00:00:00'
and s.service5 != '00:00:00'
and s.service6 != '00:00:00'
and s.service7 != '00:00:00'
and s.service16 != '00:00:00'

";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo "<b>".$rsOpd_Socail1['timetoexamine2_sum']."</b>";

echo "<b>&nbsp;นาที</b>";
?>
</td>





</tr>

<tr>





<td width="150">
	<b>&nbsp;5.เวลาเฉลี่ยให้สุขศึกษา:</b>
</td>

<td width="125" bgcolor='yellow'>
<?
						
$sqlOpd_Socail_1="SELECT  s.*,  


sec_to_time(avg(time_to_sec(service6)-time_to_sec(service12))) as timefromvsttime2finishpharmacy_sum

from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:00:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)

and s.hn not in (

      select  oa.hn from oapp oa where oa.hn = s.hn and oa.nextdate  = s.vstdate
) 


and s.service3 != '00:00:00'
and s.service4 != '00:00:00'
and s.service5 != '00:00:00'
and s.service6 != '00:00:00'
and s.service7 != '00:00:00'
and s.service16 != '00:00:00'


";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo "<b>".$rsOpd_Socail1['timefromvsttime2finishpharmacy_sum']."</b>";

echo "<b>&nbsp;นาที</b>";
?>
							</td>







<td width="125">
	<b>&nbsp;6.เวลาเฉลี่ยที่ห้องยา:</b>
</td>

<td width="125" bgcolor='yellow'>
<?
						
$sqlOpd_Socail_1="SELECT  s.*,  


sec_to_time(avg(time_to_sec(service16)-time_to_sec(service6))) as timefromvsttime2finishpharmacyconfirm2_sum


from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:00:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)


and s.hn not in (

      select  oa.hn from oapp oa where oa.hn = s.hn and oa.nextdate  = s.vstdate
) 


and s.service3 != '00:00:00'
and s.service4 != '00:00:00'
and s.service5 != '00:00:00'
and s.service6 != '00:00:00'
and s.service7 != '00:00:00'
and s.service16 != '00:00:00'

";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo "<b>".$rsOpd_Socail1['timefromvsttime2finishpharmacyconfirm2_sum']."</b>";

echo "<b>&nbsp;นาที</b>";
?>
</td>



<td colspan="3" width="300">
		<b>&nbsp;7.เวลาเฉลี่ยตั้งแต่เริ่มต้นพิมพ์ใบสั่งยาจนสิ้นสุดการรับยา:</b>
</td>

<td width="200" bgcolor='yellow'>
<?
						
$sqlOpd_Socail_1="SELECT  s.*,  

 sec_to_time(avg(time_to_sec(service16)-time_to_sec(service3))) as timefromvsttime2finish2_sum


from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:00:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5

and s.vstdate not in (select holiday_date from holiday)

and s.hn not in (
      select  oa.hn from oapp oa where oa.hn = s.hn 
	  and oa.nextdate  = s.vstdate
) 

and s.service3 != '00:00:00'
and s.service4 != '00:00:00'
and s.service5 != '00:00:00'
and s.service6 != '00:00:00'
and s.service7 != '00:00:00'
and s.service16 != '00:00:00'


";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo "<b>".$rsOpd_Socail1['timefromvsttime2finish2_sum']."</b>";

echo "<b>&nbsp;นาที</b>";
?>
							</td>



<td width="50" colspan="7">
	&nbsp;----->>	
</td>


						</tr>
						
					
					<table width="920" border="1" cellspacing="0" cellpadding="0" class="bd-external">
                      <tr>
                        <td height="44" align="center">
						
				<table width="1270" border="0" cellpadding="1" cellspacing="1">
                          <tr class="headtable">
                            <td height="21"  align="center" background="img_mian/bgcolor2.gif">ที่</td>
                           
                            <td  align="center"  background="img_mian/bgcolor2.gif">HN</td>
                            <td  align="center"  background="img_mian/bgcolor2.gif">วันที่</td>
                            
							<td  align="center"  background="img_mian/bgcolor2.gif">เวลา</td>
							
		

                            <td  align="center"  background="img_mian/bgcolor2.gif">พิมพ์ใบสั่งยา</td>

							   <td  align="center"  background="img_mian/bgcolor2.gif">เวลารอสกรีน</td>

                            <td  align="center"  background="img_mian/bgcolor2.gif">เริ่มสกรีน</td>
                            
							<td  align="center"  background="img_mian/bgcolor2.gif">สกรีนเสร็จ</td>

							 <td  align="center"  background="img_mian/bgcolor2.gif">เวลาในการสกรีน</td>

							<td  align="center"  background="img_mian/bgcolor2.gif" >เวลารอตรวจ</td>
							
                            <td  align="center"  background="img_mian/bgcolor2.gif">เริ่มตรวจ</td>

							<td  align="center"  background="img_mian/bgcolor2.gif">ตรวจเสร็จ</td>

							  <td  align="center"  background="img_mian/bgcolor2.gif">เวลาในการตรวจ</td>

							   <td  align="center"  background="img_mian/bgcolor2.gif" width='100'>เวลาให้สุขศึกษา</td>


							 <td  align="center"  background="img_mian/bgcolor2.gif">พิมพ์สติ๊กเกอร์ยา</td>

							<td  align="center"  background="img_mian/bgcolor2.gif">จ่ายยาเสร็จ</td>
							
							
							<td  align="center"  background="img_mian/bgcolor2.gif">รวมเวลาที่ห้องยา</td>
                         
											

							    <td  align="center"  background="img_mian/bgcolor2.gif">เวลาVisitถึงรับยา</td>

								
								
                           
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
                           

                            <td align="center"><?php echo $rsOpd_Socail['hn']; ?></td>
                            <td align="center"><?php echo $rsOpd_Socail['vstdate']; ?></td>
                           
						   <td align="center"><?php echo $rsOpd_Socail['vsttime']; ?></td>
                           

                            <td align="center"><?php echo $rsOpd_Socail['sendpt2screen']; ?></td>

							<td align="center" bgcolor='red'><b><?php echo $rsOpd_Socail['waitforscreen']; ?></b></td>

							
                            <td align="left">&nbsp;<?php echo $rsOpd_Socail['startscreen']; ?></td>

							 <td align="center"><?php echo $rsOpd_Socail['send2doctor']; ?></td>

                         <td align="center" bgcolor='red'><b><?php echo $rsOpd_Socail['timetoscreen']; ?></b></td>

		

						  <td align="center" bgcolor='red'><b><?php echo $rsOpd_Socail['waitforexamine']; ?></b></td>
                           
                           
							<td align="center"><?php echo $rsOpd_Socail['startexam']; ?></td>

							<td align="center"><?php echo $rsOpd_Socail['finishexam']; ?></td>

							 <td align="center" bgcolor='red'><b><?php echo $rsOpd_Socail['timetoexamine']; ?></b></td></td>

	
						  <td align="center" bgcolor='red'><b><?php echo $rsOpd_Socail['timefromvsttime2finishpharmacy']; ?></b></td>

							
							 <td align="center"><?php echo $rsOpd_Socail['service6']; ?></td>

							<td align="center"><?php echo $rsOpd_Socail['pharmacy_confirm']; ?></td>


						<td align="center" bgcolor='red'><b><?php echo $rsOpd_Socail['timefromvsttime2finishpharmacyconfirm']; ?></b></td>

	

						  <td align="center" bgcolor='yellow'><b><?php echo $rsOpd_Socail['timefromvsttime2finis']; ?></b></td>

					
                         
                          </tr>
						
			

                          <?php
						$i++;
					} //while 
					?>
                        </table></td>
                      </tr>
                    </table>
					<?php 
					$exp_file="opd_average_service";
					print"<br><br><img src='img_mian/excel_icon.gif' align='middle'>&nbsp;<a href='excel_export.php?sy1=$sy1&sm1=$sm1&sd1=$sd1&sy2=$sy2&sm2=$sm2&sd2=$sd2&exp_file=$exp_file'>Excel Export File</a><br><br>";
				}else{
						if($sy1<>""){print"<font color='green'><b>ไม่มีข้อมูลของ<br>วันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font></b></font>";
						}else{print"<font color='green'><b>กรุณาเลือกช่วงเวลา สำหรับรายงาน</b></font><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";}
				}
				?>
                  </td>
                </tr>

				<tr>
					<td>
					<?
					/*sec_to_time(time_to_sec(service16)-time_to_sec(service3)) as timefromvsttime2finis,
time_to_sec(service16)-time_to_sec(service3) as timefromvsttime2finish2
					*/



					?>
					
				</td>
					<td>&nbsp;</td>
				</tr>

                <tr>
                  <td width="544">&nbsp;</td>
                  <td width="475">&nbsp;</td>
                </tr>
              </table>
              <!-- form -->
              <!-- end form --></td>
        </tr>
        <tr>
          <td height="16" colspan="2" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"javascript:history.back(-1)\">ย้อนกลับ</a>" ?>&nbsp;|</td>
        </tr>
        <tr>
          <td height="16" valign="top"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="16" valign="top">&nbsp;</td>
        </tr>
      </table>
	</td>
  </tr>
  <tr> 
    <td height="23">
	
	</td>
  </tr>
</table>
<?php 
}//ch online
CloseDB(); //close connect db ?>
</body>
</html>
