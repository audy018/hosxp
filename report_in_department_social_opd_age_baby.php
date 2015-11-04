<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - รายงานจำนวนเด็ก ตามช่วงอายุ - - |</title>
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
                  <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> รายงานเด็ก ตามช่วงอายุ เฉพาะในเขต ต.ละแม หมู่ 1,2,3,4,5,6,7,9,10,12,14</td>
                </tr>
                <tr align="center">
           <td colspan="2" valign="top">
<form action="<?php $PHP_SELF ?>" method="get" name="f_select_dmy">
		   
<br/>
		   <table width="450" border="1" cellspacing="2" cellpadding="1">
             <tr align="center">
               <td colspan="3"><font color="green"><b><u>เลือกช่วงอายุ</u></b></font></td>
               </tr>

			<tr bgcolor="orange">
				<td colspan="3" align='center'>
					
			<input type="radio" name="age" value="0" checked>0 ปี
			&nbsp;&nbsp;&nbsp;			
			<input type="radio" name="age" value="1">1 ปี
			&nbsp;&nbsp;&nbsp;			
			<input type="radio" name="age" value="2">2 ปี
			&nbsp;&nbsp;&nbsp;			
			<input type="radio" name="age" value="3">3 ปี
			&nbsp;&nbsp;&nbsp;			
			<input type="radio" name="age" value="4">4 ปี
			&nbsp;&nbsp;&nbsp;
			<input type="radio" name="age" value="5">5 ปี
			&nbsp;&nbsp;&nbsp;
			<input type="radio" name="age" value="6">6 ปี


				</td>
			</tr>

			<tr>
				<td colspan='3' align='center'>
				<?
				print"</select>&nbsp;&nbsp;&nbsp;<input type='submit' value='คลิกปุ่มนี้เพื่อค้นหาข้อมูล' id='Button'>";
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
		


if($age==0){
	$sqlOpd_Socail="select ps.cid,pt.hn,ps.pname,concat(ps.fname,
	'   ',ps.lname) as ptname,ps.sex,ps.birthdate,ps.age_y,ps.age_m,pt.addrpart,pt.moopart ,th.full_name  as address ,pt.chwpart,pt.tmbpart
	from person  ps ,patient   pt
	left outer join thaiaddress th on th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
	where ps.fname = pt.fname and ps.lname=pt.lname   and pt.chwpart='86'  and pt.amppart='05'
	
	and pt.tmbpart='01' and pt.moopart in ('1','2','3','4','5','6','7','9','10','12','14')   and age_y ='0'";

}else if($age==1){
	$sqlOpd_Socail="select ps.cid,pt.hn,ps.pname,concat(ps.fname,
	'   ',ps.lname) as ptname,ps.sex,ps.birthdate,ps.age_y,ps.age_m,pt.addrpart,pt.moopart ,th.full_name  as address ,pt.chwpart,pt.tmbpart
	from person  ps ,patient   pt
	left outer join thaiaddress th on th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
	where ps.fname = pt.fname and ps.lname=pt.lname   and pt.chwpart='86'  and pt.amppart='05'
	
	and pt.tmbpart='01' and pt.moopart in ('1','2','3','4','5','6','7','9','10','12','14')   and age_y ='1' ";

}else if($age==2){
	
	$sqlOpd_Socail="select ps.cid,pt.hn,ps.pname,concat(ps.fname,
	'   ',ps.lname) as ptname,ps.sex,ps.birthdate,ps.age_y,ps.age_m,pt.addrpart,pt.moopart ,th.full_name  as address ,pt.chwpart,pt.tmbpart
	from person  ps ,patient   pt
	left outer join thaiaddress th on th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
	where ps.fname = pt.fname and ps.lname=pt.lname   and pt.chwpart='86'  and pt.amppart='05'
	
	and pt.tmbpart='01' and pt.moopart in ('1','2','3','4','5','6','7','9','10','12','14')   and age_y ='2' ";

}else if($age==3){
	
	$sqlOpd_Socail="select ps.cid,pt.hn,ps.pname,concat(ps.fname,
	'   ',ps.lname) as ptname,ps.sex,ps.birthdate,ps.age_y,ps.age_m,pt.addrpart,pt.moopart ,th.full_name  as address ,pt.chwpart,pt.tmbpart
	from person  ps ,patient   pt
	left outer join thaiaddress th on th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
	where ps.fname = pt.fname and ps.lname=pt.lname   and pt.chwpart='86'  and pt.amppart='05'
	
	and pt.tmbpart='01' and pt.moopart in ('1','2','3','4','5','6','7','9','10','12','14')   and age_y ='3'";

}else if($age==4){
	
	$sqlOpd_Socail="select ps.cid,pt.hn,ps.pname,concat(ps.fname,
	'   ',ps.lname) as ptname,ps.sex,ps.birthdate,ps.age_y,ps.age_m,pt.addrpart,pt.moopart ,th.full_name  as address ,pt.chwpart,pt.tmbpart
	from person  ps ,patient   pt
	left outer join thaiaddress th on th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
	where ps.fname = pt.fname and ps.lname=pt.lname   and pt.chwpart='86'  and pt.amppart='05'
	
	and pt.tmbpart='01' and pt.moopart in ('1','2','3','4','5','6','7','9','10','12','14')   and age_y ='4'";

}else if($age==5){
	
	$sqlOpd_Socail="select ps.cid,pt.hn,ps.pname,concat(ps.fname,
	'   ',ps.lname) as ptname,ps.sex,ps.birthdate,ps.age_y,ps.age_m,pt.addrpart,pt.moopart ,th.full_name  as address ,pt.chwpart,pt.tmbpart
	from person  ps ,patient   pt
	left outer join thaiaddress th on th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
	where ps.fname = pt.fname and ps.lname=pt.lname   and pt.chwpart='86'  and pt.amppart='05'
	
	and pt.tmbpart='01' and pt.moopart in ('1','2','3','4','5','6','7','9','10','12','14')   and age_y ='5'";

}else if($age==6){
	
	$sqlOpd_Socail="select ps.cid,pt.hn,ps.pname,concat(ps.fname,
	'   ',ps.lname) as ptname,ps.sex,ps.birthdate,ps.age_y,ps.age_m,pt.addrpart,pt.moopart ,th.full_name  as address ,pt.chwpart,pt.tmbpart
	from person  ps ,patient   pt
	left outer join thaiaddress th on th.addressid = concat(pt.chwpart,pt.amppart,pt.tmbpart)
	where ps.fname = pt.fname and ps.lname=pt.lname   and pt.chwpart='86'  and pt.amppart='05'
	
	and pt.tmbpart='01' and pt.moopart in ('1','2','3','4','5','6','7','9','10','12','14')   and age_y ='6'";

}

echo "<br/>";

				
				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				
				if(mysql_num_rows($resultOpd_Socail)>0){
					
					print"<br><b>มีทั้งหมด ".mysql_num_rows($resultOpd_Socail)." รายการ</b></b></font></u>";
						//create row
						?><br><br>
					<table width="900" border="1" cellspacing="0" cellpadding="0" class="bd-external">
                      <tr>
                        <td height="44" align="center"><table width="900" border="0" cellpadding="1" cellspacing="1">
                          <tr class="headtable">
                            <td width="20" height="21"  align="center" background="img_mian/bgcolor2.gif">ที่</td>
                            <td width="90"  align="center" background="img_mian/bgcolor2.gif">บัตรประชาชน</td>
                            <td width="54" align="center"  background="img_mian/bgcolor2.gif">HN</td>
                            <td width="80" align="center"  background="img_mian/bgcolor2.gif">คำนำหน้า</td>
                            <td width="100" align="center"  background="img_mian/bgcolor2.gif">ชื่อ-สกุล</td>
                            <td width="25" align="center"  background="img_mian/bgcolor2.gif">เพศ</td>
                            <td width='50'>ว/ด/ป เกิด </td>
							<td width="80" align="center"  background="img_mian/bgcolor2.gif">อายุ(ปี)</td>
                            <td width="120" align="center"  background="img_mian/bgcolor2.gif">บ้านเลขที่</td>
                            <td width="91" align="center"  background="img_mian/bgcolor2.gif">หมู่ที่</td>
                           
                            <td width="74" align="center"  background="img_mian/bgcolor2.gif">ที่อยู่</td>
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
                            <td  align="center"><?php echo $rsOpd_Socail['cid']; ?></td>
                            <td align="center"><?php echo $rsOpd_Socail['hn']; ?></td>
                            <td align="right"><?php echo $rsOpd_Socail['pname']; ?></td>
                            <td align="left">&nbsp;<?php echo $rsOpd_Socail['ptname']?></td>
                            <td align="center">
							<?php //echo $rsOpd_Socail['sex']; 
							if($rsOpd_Socail['sex']=="1"){echo "ช";}else{echo "ญ";}
							?>
							</td>
							<td>
							<?php echo $rsOpd_Socail['birthdate'];?>
							</td>

                            <td align="center"><?php echo $rsOpd_Socail['age_y']; ?>ปี <?php echo $rsOpd_Socail['age_m']; ?>เดือน</td>
                           
								
							<td align="left">&nbsp;<?php echo $rsOpd_Socail['addrpart']?></td>

							</td>
                            <td align="right"><?php echo $rsOpd_Socail['moopart']; ?></td>
                          
							
                            <td align="center">
							<?php 
							echo $rsOpd_Socail['address'];
							?>
							</td>
                          </tr>
                          <?php
						$i++;
					} //while 
					?>
                        </table></td>
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
