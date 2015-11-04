<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - ค้นหา  ข้อมูลการฉีดวัคซีนเด็กแต่ละราย - - |</title>
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
                  <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> ค้นหา  ข้อมูลการฉีดวัคซีนเด็กแต่ละราย</td>
                </tr>
                <tr align="center">
           <td colspan="2" valign="top">

<br />

<form action="<?php $PHP_SELF ?>" method="get" name="f_select_dmy">
	ระบุเลขบัตรประจำตัวประชาชนเด็ก
	<input type="text" name="cid" size="25" />
	<input type="submit" value="ค้นหา" />
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
			
$sql="SELECT

        p.person_id,p.cid,concat(p.pname,p.fname,'  ',p.lname) as ptname,p.birthdate

        ,w.vaccine_bcg_date,w.vaccine_hbv1_date,w.vaccine_hbv2_date,w.vaccine_hbv3_date,w.vaccine_dtphb1_date,w.vaccine_opv1_date,w.vaccine_dtphb2_date
        ,w.vaccine_opv2_date,w.vaccine_dtphb3_date,w.vaccine_opv3_date,w.vaccine_mmr_date

         ,e.vaccine_dtp4_date,e.vaccine_opv4_date,e.vaccine_je1_date,e.vaccine_je2_date,e.vaccine_je3_date,e.vaccine_dtp5_date,e.vaccine_opv5_date

FROM

        person p


LEFT OUTER JOIN person_wbc w  on w.person_id = p.person_id
LEFT OUTER JOIN person_epi e on e.person_id = p.person_id


WHERE p.cid='$cid' ";
				
				$result=ResultDB($sql);//echo 
				
				mysql_num_rows($result);
				
				if(mysql_num_rows($result)>0){
					
//create row
?>
						
<br><br>

<table width="995" border="1" cellspacing="0" cellpadding="0" class="bd-external">
                      <tr>
                        <td height="44" align="center"><table width="995" border="1" cellpadding="1" cellspacing="1">
                          <tr class="headtable">
                           
                          
                            <td  align="center"  background="img_mian/bgcolor2.gif">ชื่อสกุล</td>
                            <td  align="center"  background="img_mian/bgcolor2.gif">BCG</td>
                            <td  align="center"  background="img_mian/bgcolor2.gif">HBV1</td>
                            <td  align="center"  background="img_mian/bgcolor2.gif">HBV2</td>
                            <td  align="center"  background="img_mian/bgcolor2.gif">HBV3</td>
                            <td  align="center"  background="img_mian/bgcolor2.gif">DTPHB1</td>
                            <td  align="center"  background="img_mian/bgcolor2.gif">OPV1</td>
                            <td  align="center"  background="img_mian/bgcolor2.gif">DTPHB2</td>
                            <td  align="center"  background="img_mian/bgcolor2.gif">OPV2</td>
                            <td  align="center"  background="img_mian/bgcolor2.gif">DTPHB3</td>
							 <td  align="center"  background="img_mian/bgcolor2.gif">OPV3</td>
							<td  align="center"  background="img_mian/bgcolor2.gif">Measle/MMR</td>


							<td  align="center"  background="img_mian/bgcolor2.gif">DTP4</td>
							
							<td  align="center"  background="img_mian/bgcolor2.gif">OPV4</td>
							
							<td  align="center"  background="img_mian/bgcolor2.gif">JE1</td>
							
							<td  align="center"  background="img_mian/bgcolor2.gif">JE2</td>
							
							<td  align="center"  background="img_mian/bgcolor2.gif">JE3</td>
							
							<td  align="center"  background="img_mian/bgcolor2.gif">DTP5</td>
							
							<td  align="center"  background="img_mian/bgcolor2.gif">OPV5</td>
							
             </tr>
   
   <?php
					
 $i=0;
 while($i<mysql_num_rows($result)){//while
	
	$rs=mysql_fetch_array($result);

		if ($bg=="#FFFFFF") { //color
			$bg="#B1C3D9";
			//$bgm="";
		}else{
			$bg="#FFFFFF";
			//$bgm="img_mian/bgcolor.gif";
		} //color
?>

     <tr bgcolor="<?php echo $bg;?>"> 

          <td  align="center"><?php echo $rs['ptname']; ?></td>

<td  align="center"><?php echo dateThai2($rs['vaccine_bcg_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_hbv1_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_hbv2_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_hbv3_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_dtphb1_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_opv1_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_dtphb2_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_opv2_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_dtphb3_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_opv3_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_mmr_date']); ?></td>

<td  align="center"><?php echo dateThai2($rs['vaccine_dtp4_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_opv4_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_je1_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_je2_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_je3_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_dtp5_date']); ?></td>
<td  align="center"><?php echo dateThai2($rs['vaccine_opv5_date']); ?></td>
		 
		  
                            
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
						if($sy1<>""){print"<font color='green'><b>ไม่มีข้อมูลของ<br>วันที่ <font color='red'>$sd1</font> เดือน <font color='red'>".change_month_isThai($sm1)."</font> ปี <font color='red'>".($sy1+543)."</font> ถึงวันที่ <font color='red'>$sd2</font> เดือน <font color='red'>".change_month_isThai($sm2)."</font> ปี <font color='red'>".($sy2+543)."</font></b></font>";
						}else{print"<font color='green'><b>ระบบค้นหาข้อมูลเด็กฉีดวัคซีน</b></font><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";}
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
