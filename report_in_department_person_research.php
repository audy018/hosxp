<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - ค้นหาข้อมูลบุคคลในตาราง Person |</title>
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
                  <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> ค้นหาข้อมูลบุคคลในตาราง Person</td>
                </tr>
                <tr align="center">
           <td colspan="2" valign="top">

<form action="<?php $PHP_SELF ?>" method="get" name="f_select_dmy">
		  
		   <table width="360" border="1" cellspacing="2" cellpadding="1">
             <tr align="center">
               <td colspan="3"><font color="green"><b><u>เลือกช่วงเวลา</u></b></font></td>
               </tr>
             <tr>
               <td width="150" align='right'>
					เลือกหมู่บ้าน :&nbsp;
			   </td>

               <td width="135" colspan="2">
	
	<select name='village_moo'>
		<?
			$sql_village = "select village_id,address_id,village_moo,village_name from village ";

			$result_village=ResultDB($sql_village);//echo mysql_num_rows($result);


			if(mysql_num_rows($result_village)>0){
	
									for($i=0;$i<mysql_num_rows($result_village);$i++){
										
										$rs_vl=mysql_fetch_array($result_village);
										
						
			print "<option value='$rs_vl[village_moo]'>หมู่ที่ 
			
			$rs_vl[village_moo]
			$rs_vl[village_name]</option>";

						
									
										
										}										    
									}

						?>

					</select>		   </td>
               </tr>
         

			   <tr>
				
				<td>
					&nbsp;
				</td>

			   <td colspan='2'>

						<input type='submit'value='คลิกเพื่อเลือกบ้านเลขที่' />
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

				$sqlOpd_Socail="select h.house_id,h.address from house h,village v where h.village_id = v.village_id  
				and v.village_moo = '$village_moo' ";
				
				echo "<h2>ขณะนี้คุณอยู่ที่หมู่ <font color='yellow'>$village_moo </font></h2>";

				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){
					
						//create row
						?><br><br>

					<table width="300" border="1" cellspacing="0" cellpadding="0" class="bd-external">
                      <tr>
                        <td height="44" align="center"><table width="300" border="0" cellpadding="1" cellspacing="1">
                          <tr class="headtable">
                            <td height="21"  align="center" background="img_mian/bgcolor2.gif">ที่</td>
                            <td width="200"  align="center" background="img_mian/bgcolor2.gif">บ้านเลขที่</td>
                            
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
                            <td  align="center"><a href='report_in_department_person_research_result.php?village_moo=<?=$village_moo?>&house_id=<?=$rsOpd_Socail['house_id']?>&address=<?=$rsOpd_Socail['address']?>' target='_blank' title='คลิกเพื่อดูรายชื่อบุคคล'><u><?php echo $rsOpd_Socail['address']; ?></u></a></td>
                           
                      
                          </tr>
                          <?php
						$i++;
					}} //while 
					?>
                        </table></td>
                      </tr>
                    </table>
					
				
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
