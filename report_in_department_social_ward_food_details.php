<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - รายละเอียด  ORDER อาหาร WARD ปัจจุบัน - - |</title>
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
              
                <tr align="center">
           <td colspan="2" valign="top">
<form action="<?php $PHP_SELF ?>" method="get" name="f_select_dmy">
		   <table width="360" border="0" cellspacing="2" cellpadding="1">
           
		     <tr align="center">
                  <td colspan="2">
						
						&nbsp;
				  
				  </td>
                </tr>

           <tr align="center">
                  <td colspan="2">
						
						<h3>
							AN : <? echo $_GET['an'];?> 
							
							คนไข้
							<font color='blue'>
								 <? echo $_GET['pt_name'];?>
							</font>
						</h3>
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
				
$an_number = $_GET['an'];

$sqlIpd_Socail="SELECT 
					ipt.an,
					ipt.icd10 as icd10,
					ic.name as icd_eng,
					ic.tname as icd_th
				FROM
					iptdiag ipt
				LEFT OUTER JOIN icd101 ic ON ic.code = ipt.icd10
				WHERE ipt.an=".$an_number;
				
	$resultIpd_Socail=ResultDB($sqlIpd_Socail);//echo mysql_num_rows($resultDenService);

				
	if(mysql_num_rows($resultIpd_Socail)>0){
		
						//create row
						?>
					
<table width="900" border="1" cellspacing="0" cellpadding="0" class="bd-external">
      <tr>
          <td height="44" align="center">
		  
		  <table width="900" border="0" cellpadding="1" cellspacing="1">

       <tr class="headtable">
			
		<td  height="21"  align="center" width="20" background="img_mian/bgcolor2.gif">ลำดับที่</td>
            
                            
		  <td  align="center" width="30" background="img_mian/bgcolor2.gif">icd10</td>

		   <td  align="center"  width="160" background="img_mian/bgcolor2.gif">ชื่อ ENG</td>

		    <td  align="center" width="120" background="img_mian/bgcolor2.gif">ชื่อ TH</td>
                            
		 

      </tr>
                          <?php
				$i=0;
			          while($i<mysql_num_rows($resultIpd_Socail)){//while
						 $rsIpd_Socail=mysql_fetch_array($resultIpd_Socail);
					if ($bg=="#FFFFFF") { //color
						$bg="#B1C3D9";
					//$bgm="";
						}else{
						$bg="#FFFFFF";
						//$bgm="img_mian/bgcolor.gif";
						} //color
						?>
    
	
	<tr bgcolor="<?php echo $bg;?>">
         <td  align="center">
			<?php echo ($i+1); ?>
		</td>
		
	

		<td align="center">
			<?php echo $rsIpd_Socail['icd10']; ?>
		</td>

		<td align="left">
			&nbsp;
			<?php echo $rsIpd_Socail['icd_eng']; ?>
		</td>

		<td align="left">
			&nbsp;
			<?php echo $rsIpd_Socail['icd_th']; ?>
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
					echo "<h2><font color='red'>!! ยังไม่มีการบันทึก ICD10 ในคนไข้รายนี้ </font></h2>";
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
