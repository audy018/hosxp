<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - ORDER อาหาร WARD ปัจจุบัน - - |</title>
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
						
						<input type="submit" value="คลิกเพื่อปรับปรุงข้อมูลปัจจุบัน" />
				  
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
				

$sqlIpd_Socail="SELECT
      w.name as ward_name ,
      p.hn,
      m.an,
      concat(p.pname,p.fname,'  ',p.lname) as ptname,
      d.bedno,
      l.name as meal_name,
      s.name as item_name,
	  m.comment as comments

FROM
      ipt_food_menu  m ,ipt i , meal l,ward w ,nutrition_items s ,patient p,iptadm d

WHERE
     m.an = i.an and i.ward = w.ward and m.meal = l.meal and i.hn = p.hn
     and d.an = i.an  and m.nutrition_items_id = s.nutrition_items_id
     and i.dchdate is null  and m.date_id = 3  and i.ward = '01'  and m.meal = 4 ";
				
	$resultIpd_Socail=ResultDB($sqlIpd_Socail);//echo mysql_num_rows($resultDenService);
				
	if(mysql_num_rows($resultIpd_Socail)>0){
		
					
	print"<h2>มีทั้งหมด ".mysql_num_rows($resultIpd_Socail)." รายการ</h2>";
						//create row
						?>
					
<table width="900" border="1" cellspacing="0" cellpadding="0" class="bd-external">
      <tr>
          <td height="44" align="center">
		  
		  <table width="900" border="0" cellpadding="1" cellspacing="1">

       <tr class="headtable">
			
		<td  height="21"  align="center" background="img_mian/bgcolor2.gif">ลำดับที่</td>
          
          <td  height="21"  align="center" background="img_mian/bgcolor2.gif">ผู้ป่วยใน</td>
           
		  <td  align="center"  background="img_mian/bgcolor2.gif">HN</td>
          
		  <td  align="center"  background="img_mian/bgcolor2.gif">AN</td>

          <td  align="left"  background="img_mian/bgcolor2.gif">ชื่อ-สกุล</td>
                            
		  <td  align="center"  background="img_mian/bgcolor2.gif">เตียง</td>
                            
		  <td  align="center"  background="img_mian/bgcolor2.gif">มื้อ</td>

          <td  align="left"  background="img_mian/bgcolor2.gif">อาหาร</td>

       
		   <td  align="center"  background="img_mian/bgcolor2.gif">
					<a href="#">รายละเอียด</a></td>

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
		 <td  align="center">
			<?php echo $rsIpd_Socail['ward_name']; ?>
		</td>
        <td align="center">
			<?php echo $rsIpd_Socail['hn']; ?>
		</td>
        
		<td align="center">
			<?php echo $rsIpd_Socail['an']; ?>
		</td>
		<td align="left">
			&nbsp;
			<?php echo $rsIpd_Socail['ptname']; ?>
		</td>

		<td align="center">
			<?php echo $rsIpd_Socail['bedno']; ?>
		</td>

		<td align="center">
			<?php echo $rsIpd_Socail['meal_name']; ?>
		</td>
       
	   <td align="left">
			&nbsp;
			<?php echo $rsIpd_Socail['item_name']; ?>
		</td>
		
		<td align="center">
		 <a href="report_in_department_social_ward_food_details.php?an=<?php echo $rsIpd_Socail['an']; ?>&pt_name=<?php echo $rsIpd_Socail['ptname']; ?>" target="_blank">เพิ่มเติม</a>
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
