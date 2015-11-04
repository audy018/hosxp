<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - ภาวะโภชนาการ บัญชี 3และ4 - - |</title>
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
                  <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> ภาวะโภชนาการ บัญชี 3และ4</td>
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

			   <tr>
					<td align="center" colspan="3">
					ที่อยู่ : 
					<input type="radio" name="opt" value="all" checked >ทั้งหมด
					<input type="radio" name="opt" value="0">นอกเขต
					<input type="radio" name="opt" value="1">ในเขต

						
												
					</td>
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

if($opt=="all"){

$sql1="SELECT
	
	 (select count(nutrition_level) from person_wbc_nutrition where     
	   nutrition_date BETWEEN '$d1' AND '$d2' )  as level_all ,
      
	  (select count(nutrition_level) from person_wbc_nutrition where nutrition_level=0 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level0 ,
      (select count(nutrition_level) from person_wbc_nutrition where nutrition_level=1 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level1 ,
      (select count(nutrition_level) from person_wbc_nutrition where nutrition_level=2 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level2 ,
      (select count(nutrition_level) from person_wbc_nutrition where nutrition_level=3 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level3 ,
      (select count(nutrition_level) from person_wbc_nutrition where nutrition_level=4 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level4 ,
      (select count(nutrition_level) from person_wbc_nutrition where nutrition_level=5 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level5

FROM
       person_wbc_nutrition

LIMIT 1";

}else if($opt=="0"){

$sql1="SELECT
  
   (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id =1)  as level_all ,

   (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.nutrition_level=0)  as level0 ,

   (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.nutrition_level=1)  as level1 ,

   (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.nutrition_level=2)  as level2 ,


   (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.nutrition_level=3)  as level3 ,


  (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.nutrition_level=4)  as level4 ,

   (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.nutrition_level=5)  as level5

FROM
       person_wbc_nutrition

LIMIT 1 ";


}else if($opt=="1"){

$sql1="SELECT
  
   (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id !=1)  as level_all ,

   (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.nutrition_level=0)  as level0 ,

   (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.nutrition_level=1)  as level1 ,

   (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.nutrition_level=2)  as level2 ,


   (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.nutrition_level=3)  as level3 ,


  (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.nutrition_level=4)  as level4 ,

   (select count(pw.nutrition_level) from person_wbc_nutrition    pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.nutrition_level=5)  as level5

FROM
       person_wbc_nutrition

LIMIT 1 ";

}


					
				$result1=ResultDB($sql1);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($result1)>0){
					print"<u><font color='green'><b>แสดงข้อมูลของวันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font>";
					
					
					print"";
						//create row
						?><br><br>
					
					
<table width="900" border="1" cellspacing="0" cellpadding="0" class="bd-external" >
       
	<tr>
       <td height="44" align="center">


<table width="900" border="0" cellpadding="1" cellspacing="1">
   
   <tr bgcolor='yellow'><td colspan="8"><b>เกณฑ์ อายุ/น้ำหนัก บัญชี 3</b></td></tr>
   
    <tr class="headtable">
      <td width="20" height="21"  align="center" background="img_mian/bgcolor2.gif">ที่</td>
      <td width="50"  align="center" background="img_mian/bgcolor2.gif">ทั้งหมด</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">error</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">น้ำหนักน้อยกว่าเกณฑ์</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">น้ำหนักค่อนข้างน้อย</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">น้ำหนักตามเกณฑ์</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">น้ำหนักค่อนข้างมาก</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">น้ำหนักมากเกินเกณฑ์</td>                   
   </tr>
      
	  
	  <?php
		$i=0;
		while($i<mysql_num_rows($result1)){//while
			$rs1=mysql_fetch_array($result1);
		if ($bg=="#FFFFFF") { //color
			$bg="#B1C3D9";
			//$bgm="";
		}else{
			$bg="#FFFFFF";
						//$bgm="img_mian/bgcolor.gif";
		} //color
		?>
        
		<tr bgcolor="<?php echo $bg;?>">
            <td align="center"><?php echo ($i+1); ?></td>
            <td align="center"><?php echo $rs1['level_all']; ?></td>
            <td align="center"><?php echo $rs1['level0']; ?></td>
            <td align="center"><?php echo $rs1['level1']; ?></td>
			<td align="center"><?php echo $rs1['level2']; ?></td>
			<td align="center"><?php echo $rs1['level3']; ?></td>
			<td align="center"><?php echo $rs1['level4']; ?></td>
			<td align="center"><?php echo $rs1['level5']; ?></td>
        </tr>
                          
			<?php
				$i++;
			} //while 
		?>
     </table>
	 


	



<?

if($opt=="all"){

		$sql2="SELECT
		
	  (select count(nutrition_level) from person_epi_nutrition where nutrition_date BETWEEN '$d1' AND '$d2' )  as level_all,

      (select count(nutrition_level) from person_epi_nutrition where nutrition_level=0 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level0 ,

      (select count(nutrition_level) from person_epi_nutrition where nutrition_level=1 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level1 ,

      (select count(nutrition_level) from person_epi_nutrition where nutrition_level=2 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level2 ,

      (select count(nutrition_level) from person_epi_nutrition where nutrition_level=3 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level3 ,

      (select count(nutrition_level) from person_epi_nutrition where nutrition_level=4 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level4 ,

      (select count(nutrition_level) from person_epi_nutrition where nutrition_level=5 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level5

FROM
       person_epi_nutrition

LIMIT 1 ";

}else if($opt=="0"){

$sql2="SELECT
		
	  (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id =1)  as level_all,


      (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.nutrition_level=0 and p.village_id =1)  as level0 ,

      (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.nutrition_level=1 and p.village_id =1)  as level1 ,


      (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.nutrition_level=2 and p.village_id =1) as level2 ,

      (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.nutrition_level=3 and p.village_id =1)  as level3 ,

      (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.nutrition_level=4 and p.village_id =1) as level4 ,

      (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.nutrition_level=5 and p.village_id =1) as level5

FROM
       person_epi_nutrition

LIMIT 1";

}else if($opt=="1"){

$sql2="SELECT
		
	  (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id !=1)  as level_all,


      (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.nutrition_level=0 and p.village_id !=1)  as level0 ,

      (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.nutrition_level=1 and p.village_id !=1)  as level1 ,


      (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.nutrition_level=2 and p.village_id !=1) as level2 ,

      (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.nutrition_level=3 and p.village_id !=1)  as level3 ,

      (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.nutrition_level=4 and p.village_id !=1) as level4 ,

      (select count(pw.nutrition_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.nutrition_level=5 and p.village_id !=1) as level5

FROM
       person_epi_nutrition

LIMIT 1";


}


$result2=ResultDB($sql2);//echo 

?>


<table width="900" border="0" cellpadding="1" cellspacing="1">
   
   <tr bgcolor='yellow'><td colspan="8"><b>เกณฑ์ อายุ/น้ำหนัก บัญชี 4</b></td></tr>
   
   <tr class="headtable">
      <td width="20" height="21"  align="center" background="img_mian/bgcolor2.gif">ที่</td>
      <td width="50"  align="center" background="img_mian/bgcolor2.gif">ทั้งหมด</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">error</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">น้ำหนักน้อยกว่าเกณฑ์</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">น้ำหนักค่อนข้างน้อย</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">น้ำหนักตามเกณฑ์</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">น้ำหนักค่อนข้างมาก</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">น้ำหนักมากเกินเกณฑ์</td>                   
   </tr>
   


    <?php
		$i=0;
		while($i<mysql_num_rows($result2)){//while
			$rs2=mysql_fetch_array($result2);
	?>
        
		<tr bgcolor="#FFFFFF">
            <td align="center"><?php echo ($i+1); ?></td>
            <td align="center"><?php echo $rs2['level_all']; ?></td>
            <td align="center"><?php echo $rs2['level0']; ?></td>
            <td align="center"><?php echo $rs2['level1']; ?></td>
			<td align="center"><?php echo $rs2['level2']; ?></td>
			<td align="center"><?php echo $rs2['level3']; ?></td>
			<td align="center"><?php echo $rs2['level4']; ?></td>
			<td align="center"><?php echo $rs2['level5']; ?></td>
        </tr>
                          
			<?php
				$i++;
			} //while 
		?>



</table>



<hr />




<?




if($opt=="all"){

	$sql3="SELECT
		
	(select count(height_level) from person_wbc_nutrition where  nutrition_date BETWEEN '$d1' AND '$d2' )  as level_all,

    (select count(height_level) from person_wbc_nutrition where height_level=0 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level0 ,

    (select count(height_level) from person_wbc_nutrition where height_level=1 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level1 ,

     (select count(height_level) from person_wbc_nutrition where height_level=2 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level2 ,

     (select count(height_level) from person_wbc_nutrition where height_level=3 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level3 ,

     (select count(height_level) from person_wbc_nutrition where height_level=4 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level4 ,

     (select count(height_level) from person_wbc_nutrition where height_level=5 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level5

FROM
       person_wbc_nutrition

LIMIT 1";

}else if($opt=="0"){


$sql3="SELECT
		
	(select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id =1)  as level_all,

    (select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.height_level=0)  as level0 ,

    (select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.height_level=1)  as level1 ,

    (select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.height_level=2)  as level2 ,

    (select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.height_level=3)  as level3 ,

    (select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.height_level=4)  as level4 ,

     (select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.height_level=5)  as level5

FROM
       person_wbc_nutrition

LIMIT 1";


}else if($opt=="1"){

$sql3="SELECT
		
	(select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id !=1)  as level_all,

    (select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.height_level=0)  as level0 ,

    (select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.height_level=1)  as level1 ,

   (select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.height_level=2)  as level2 ,

   (select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.height_level=3)  as level3 ,

   (select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.height_level=4)  as level4 ,

   (select count(height_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.height_level=5)  as level5

FROM
       person_wbc_nutrition

LIMIT 1";

}



$result3=ResultDB($sql3);//echo 

?>


<table width="900" border="0" cellpadding="1" cellspacing="1">
   
   <tr bgcolor='yellow'><td colspan="8"><b>เกณฑ์ อายุ/ส่วนสูง บัญชี 3</b></td></tr>
   
   <tr class="headtable">
      <td width="20" height="21"  align="center" background="img_mian/bgcolor2.gif">ที่</td>
      <td width="50"  align="center" background="img_mian/bgcolor2.gif">ทั้งหมด</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">error</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">เตี้ย</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">ค่อนข้างเตี้ย</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">สูงตามเกณฑ์</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">ค่อนข้างสูง</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">สูง</td>                   
   </tr>
   


    <?php
		$i=0;
		while($i<mysql_num_rows($result3)){//while
			$rs3=mysql_fetch_array($result3);
	?>
        
		<tr bgcolor="#FFFFFF">
            <td align="center"><?php echo ($i+1); ?></td>
            <td align="center"><?php echo $rs3['level_all']; ?></td>
            <td align="center"><?php echo $rs3['level0']; ?></td>
            <td align="center"><?php echo $rs3['level1']; ?></td>
			<td align="center"><?php echo $rs3['level2']; ?></td>
			<td align="center"><?php echo $rs3['level3']; ?></td>
			<td align="center"><?php echo $rs3['level4']; ?></td>
			<td align="center"><?php echo $rs3['level5']; ?></td>
        </tr>
                          
			<?php
				$i++;
			} //while 
		?>



</table>






<?

if($opt=="all"){


	$sql4="SELECT
		
	 (select count(height_level) from person_epi_nutrition where  nutrition_date BETWEEN '$d1' AND '$d2' )  as level_all,

      (select count(height_level) from person_epi_nutrition where height_level=0 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level0 ,

      (select count(height_level) from person_epi_nutrition where height_level=1 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level1 ,

      (select count(height_level) from person_epi_nutrition where height_level=2 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level2 ,

      (select count(height_level) from person_epi_nutrition where height_level=3 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level3 ,

      (select count(height_level) from person_epi_nutrition where height_level=4 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level4 ,

      (select count(height_level) from person_epi_nutrition where height_level=5 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level5

FROM
       person_epi_nutrition

LIMIT 1";

}else if($opt=="0"){


	$sql4="SELECT
		
	 (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id =1)  as level_all,

      (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.height_level=0 and p.village_id =1)  as level0,

      (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.height_level=1 and p.village_id =1)  as  level1 ,

      (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.height_level=2 and p.village_id =1)  as  level2 ,

      (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.height_level=3 and p.village_id =1)  as  level3 ,

      (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.height_level=4 and p.village_id =1)  as  level4 ,

      (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.height_level=5 and p.village_id =1)  as level5

FROM
       person_epi_nutrition

LIMIT 1";


}else if($opt=="1"){

	$sql4="SELECT
		
	 (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id !=1)  as level_all,

      (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.height_level=0 and p.village_id !=1)  as level0,

      (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.height_level=1 and p.village_id !=1)  as  level1 ,

      (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.height_level=2 and p.village_id !=1)  as  level2 ,

      (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.height_level=3 and p.village_id !=1)  as  level3 ,

      (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.height_level=4 and p.village_id !=1)  as  level4 ,

      (select count(pw.height_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.height_level=5 and p.village_id !=1)  as level5

FROM
       person_epi_nutrition

LIMIT 1";


}



$result4=ResultDB($sql4);//echo 

?>


<table width="900" border="0" cellpadding="1" cellspacing="1">
   
   <tr bgcolor='yellow'><td colspan="8"><b>เกณฑ์ อายุ/ส่วนสูง บัญชี 4</b></td></tr>
   
   <tr class="headtable">
      <td width="20" height="21"  align="center" background="img_mian/bgcolor2.gif">ที่</td>
      <td width="50"  align="center" background="img_mian/bgcolor2.gif">ทั้งหมด</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">error</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">เตี้ย</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">ค่อนข้างเตี้ย</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">สูงตามเกณฑ์</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">ค่อนข้างสูง</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">สูง</td>                   
   </tr>
   


    <?php
		$i=0;
		while($i<mysql_num_rows($result4)){//while
			$rs4=mysql_fetch_array($result4);
	?>
        
		<tr bgcolor="#FFFFFF">
            <td align="center"><?php echo ($i+1); ?></td>
            <td align="center"><?php echo $rs4['level_all']; ?></td>
            <td align="center"><?php echo $rs4['level0']; ?></td>
            <td align="center"><?php echo $rs4['level1']; ?></td>
			<td align="center"><?php echo $rs4['level2']; ?></td>
			<td align="center"><?php echo $rs4['level3']; ?></td>
			<td align="center"><?php echo $rs4['level4']; ?></td>
			<td align="center"><?php echo $rs4['level5']; ?></td>
        </tr>
                          
			<?php
				$i++;
			} //while 
		?>



</table>





<?


if($opt=="all"){


	$sql5="SELECT
		
	 (select count(bmi_level) from person_wbc_nutrition where  nutrition_date BETWEEN '$d1' AND '$d2' )  as level_all ,

      (select count(bmi_level) from person_wbc_nutrition where bmi_level=0 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level0 ,

      (select count(bmi_level) from person_wbc_nutrition where bmi_level=1 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level1 ,

      (select count(bmi_level) from person_wbc_nutrition where bmi_level=2 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level2 ,

      (select count(bmi_level) from person_wbc_nutrition where bmi_level=3 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level3 ,

      (select count(bmi_level) from person_wbc_nutrition where bmi_level=4 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level4 ,

      (select count(bmi_level) from person_wbc_nutrition where bmi_level=5 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level5,

	  (select count(bmi_level) from person_wbc_nutrition where bmi_level=6 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level6


FROM
       person_wbc_nutrition

LIMIT 1
";

} else if($opt=="0") {


$sql5="SELECT
		
	 (select count(pw.bmi_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id =1)  as level_all ,

   (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.bmi_level=0)  as level0 ,


      (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.bmi_level=1)  as level1 ,

      (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.bmi_level=2)  as level2 ,

      (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.bmi_level=3)  as level3 ,

      (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.bmi_level=4)  as level4 ,

      (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.bmi_level=5)  as level5,

	  (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id=1 and pw.bmi_level=6)  as level6


FROM
       person_wbc_nutrition

LIMIT 1
";



} else if($opt=="1") {


$sql5="SELECT
		
   (select count(pw.bmi_level) from person_wbc_nutrition  pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id !=1)  as level_all ,

   (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.bmi_level=0)  as level0 ,


   (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.bmi_level=1)  as level1 ,

   (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.bmi_level=2)  as level2 ,

   (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.bmi_level=3)  as level3 ,

      (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.bmi_level=4)  as level4 ,

      (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.bmi_level=5)  as level5,

	  (select count(pw.bmi_level) from person_wbc_nutrition pw
   left outer join person_wbc pbc on pbc.person_wbc_id = pw.person_wbc_id
   left outer join person p on p.person_id = pbc.person_id
   where
   pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id!=1 and pw.bmi_level=6)  as level6


FROM
       person_wbc_nutrition

LIMIT 1
";


}



$result5=ResultDB($sql5);//echo 

?>

<hr />

<table width="900" border="0" cellpadding="1" cellspacing="1">
   
   <tr bgcolor='yellow'><td colspan="9"><b>เกณฑ์ น้ำหนัก/ส่วนสูง บัญชี 3</b></td></tr>
   
   <tr class="headtable">
      <td width="20" height="21"  align="center" background="img_mian/bgcolor2.gif">ที่</td>
      <td width="50"  align="center" background="img_mian/bgcolor2.gif">ทั้งหมด</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">error</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">ผอม</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">ค่อนข้างผอม</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">สมส่วน</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">ท้วม</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">เริ่มอ้วน</td>
	   <td width="50" align="center"  background="img_mian/bgcolor2.gif">อ้วน</td> 
   </tr>
   


    <?php
		$i=0;
		while($i<mysql_num_rows($result5)){//while
			$rs5=mysql_fetch_array($result5);
	?>
        
		<tr bgcolor="#FFFFFF">
            <td align="center"><?php echo ($i+1); ?></td>
            <td align="center"><?php echo $rs5['level_all']; ?></td>
            <td align="center"><?php echo $rs5['level0']; ?></td>
            <td align="center"><?php echo $rs5['level1']; ?></td>
			<td align="center"><?php echo $rs5['level2']; ?></td>
			<td align="center"><?php echo $rs5['level3']; ?></td>
			<td align="center"><?php echo $rs5['level4']; ?></td>
			<td align="center"><?php echo $rs5['level5']; ?></td>
			<td align="center"><?php echo $rs5['level6']; ?></td>
        </tr>
                          
			<?php
				$i++;
			} //while 
		?>



</table>





<?


if($opt=="all"){

	$sql6="SELECT
		
	(select count(bmi_level) from person_epi_nutrition where  
	 nutrition_date BETWEEN '$d1' AND '$d2' )  as level_all ,

      (select count(bmi_level) from person_epi_nutrition where bmi_level=0 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level0 ,

      (select count(bmi_level) from person_epi_nutrition where bmi_level=1 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level1 ,

      (select count(bmi_level) from person_epi_nutrition where bmi_level=2 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level2 ,

      (select count(bmi_level) from person_epi_nutrition where bmi_level=3 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level3 ,

      (select count(bmi_level) from person_epi_nutrition where bmi_level=4 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level4 ,

      (select count(bmi_level) from person_epi_nutrition where bmi_level=5 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level5 ,

      (select count(bmi_level) from person_epi_nutrition where bmi_level=6 and nutrition_date BETWEEN '$d1' AND '$d2' )  as level6


FROM
       person_epi_nutrition

LIMIT 1";

}else if($opt=="0"){

	
	$sql6="SELECT
		
	(select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id =1)  as level_all ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=0 and p.village_id =1)  as level0 ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=1 and p.village_id =1)  as level1 ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=2 and p.village_id =1)  as level2 ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=3 and p.village_id =1)  as level3 ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=4 and p.village_id =1)  as level4 ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=5 and p.village_id =1)  as level5 ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=6 and p.village_id =1)  as level6


FROM
       person_epi_nutrition

LIMIT 1";


}else if($opt=="1"){

$sql6="SELECT
		
	(select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and p.village_id !=1)  as level_all ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=0 and p.village_id !=1)  as level0 ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=1 and p.village_id !=1)  as level1 ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=2 and p.village_id !=1)  as level2 ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=3 and p.village_id !=1)  as level3 ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=4 and p.village_id !=1)  as level4 ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=5 and p.village_id !=1)  as level5 ,

      (select count(pw.bmi_level) from person_epi_nutrition pw
	   left outer join person_epi epi on epi.person_epi_id = pw.person_epi_id
	   left outer join person p on p.person_id = epi.person_id
	  where pw.nutrition_date BETWEEN '$d1' AND '$d2' and pw.bmi_level=6 and p.village_id !=1)  as level6


FROM
       person_epi_nutrition

LIMIT 1";

}



$result6=ResultDB($sql6);//echo 

?>


<table width="900" border="0" cellpadding="1" cellspacing="1">
   
   <tr bgcolor='yellow'><td colspan="9"><b>เกณฑ์ น้ำหนัก/ส่วนสูง บัญชี 4</b></td></tr>
   
   <tr class="headtable">
      <td width="20" height="21"  align="center" background="img_mian/bgcolor2.gif">ที่</td>
      <td width="50"  align="center" background="img_mian/bgcolor2.gif">ทั้งหมด</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">error</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">ผอม</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">ค่อนข้างผอม</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">สมส่วน</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">ท้วม</td>
      <td width="50" align="center"  background="img_mian/bgcolor2.gif">เริ่มอ้วน</td>
	   <td width="50" align="center"  background="img_mian/bgcolor2.gif">อ้วน</td> 
   </tr>
   


    <?php
		$i=0;
		while($i<mysql_num_rows($result6)){//while
			$rs6=mysql_fetch_array($result6);
	?>
        
		<tr bgcolor="#FFFFFF">
            <td align="center"><?php echo ($i+1); ?></td>
            <td align="center"><?php echo $rs6['level_all']; ?></td>
            <td align="center"><?php echo $rs6['level0']; ?></td>
            <td align="center"><?php echo $rs6['level1']; ?></td>
			<td align="center"><?php echo $rs6['level2']; ?></td>
			<td align="center"><?php echo $rs6['level3']; ?></td>
			<td align="center"><?php echo $rs6['level4']; ?></td>
			<td align="center"><?php echo $rs6['level5']; ?></td>
			<td align="center"><?php echo $rs6['level6']; ?></td>
        </tr>
                          
			<?php
				$i++;
			} //while 
		?>



</table>

	 </td>
     </tr>
     </table>
	<?php 
					
	}else{
						
	}
	?>


                  </td>
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
