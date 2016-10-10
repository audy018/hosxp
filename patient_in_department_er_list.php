<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - ข้อมูลผู้ป่วย ณ ห้องทันตกรรม ANC - - |</title>
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

	<script language="javascript" src="Script/codethatcalendarstd.js"></script>
	<script language="javascript" src="Samples/iframe_ex.js"></script>
	<script language="javascript">
		var c1 = new CodeThatCalendar(caldef1);
		var c2 = new CodeThatCalendar(caldef1);
</script>
</head>
<?php
if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line

if ($_GET['id1']<>""){
  $id1=$_GET['id1'];}else{
 $id1=date("d-m-Y");
 }

 if ($_GET['id2']<>""){
  $id2=$_GET['id2'];}else{
 $id2=date("d-m-Y");
 }

 //จำนวนผู้ป่วยในวันที่เลือก
$d_conv=explode("-",$id1);$d=$d_conv[0];$m=$d_conv[1];$y=$d_conv[2];
$d_conv_search="$y-$m-$d";

$d_conv2=explode("-",$id2);$d2=$d_conv2[0];$m2=$d_conv2[1];$y2=$d_conv2[2];
$d_conv_search2="$y2-$m2-$d2";

$key_word=$_GET['keyword'];
?>
<body>
<div id="Layer1" style="position:absolute; left:645px; top:197px; width:187px; height:171px; z-index:1"> 
  <script>
			// Create iframe
	                if(ua.oldOpera)document.write("<div id=\"calendar_div\">");
			document.write("<iframe id=\"calendar_frame\" name=\"calendar_frame\"");
			document.write(" frameborder=\"0\""); 
			document.write(" scrolling=\"no\""); 
			document.write(" style=\"visibility:hidden;\"");
			if(ua.oldOpera) 
   				document.write(" src=\"Samples/codethatcalendar.html\">");
			else document.write(">");
			document.write("</iframe>");
			if(ua.oldOpera)document.write("</div>");
		</script>
</div>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr> 
          <td colspan="2" valign="top">
<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
		  </td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC"><?php include("manu.inc"); ?>
		  
		  </td>
          <td width="166" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; 
          </td>
        </tr>
        <tr> 
          <td width="634" height="177" valign="top" bgcolor="#B1C3D9"><div align="center"><br> 
            <table width="620" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="620" valign="top"><table width="621" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                    <tr align="center" bgcolor="#99CCFF"> 
                      <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu">
                      <b>รายชื่อผู้ป่วยที่รับบริการที่ห้องฉุกเฉิน</b>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td width="337" valign="top"> 
                        <!--<form method="get" action="<?php //echo $PHP_SELF; ?>">
                            &nbsp;&nbsp;เลือกวันที่ .. 
                            <input name="id1" type="text" value="<?php //echo $id1; ?>" size="15"/>
                            <input type="button" onClick="c1.innerpopup('id1','calendar_frame');" value="..."/>
                            <input type="submit" value="Refresh">
                          </form>
						  -->
                      </td>
                      <td width="282">&nbsp; </td>
                    </tr>
                    <tr> 
                      <td colspan="2"> &nbsp; 
                        <?php 
							echo "<center><b>ข้อมูล ณ วันที่</b>&nbsp;<font color=red><u>".$d." - ".$m." - ".($y+543). " </u></font> ถึงวันที่  <font color=red><u>".$d2." - ".$m2." - ".($y2+543). " </u></font></center>";
						?>
                      </td>
                    </tr>
                    <tr> 
                      <td colspan="2">&nbsp; 
                        <?php 
						//นำข้อมูลมาแสดงในตาราง


$sqlErlist="select vs.vn as vn,vs.item_money as item_money,e.*,ert.name as emergency_name,erc.name as dch_name,o.icd10 as icd10,v.hn,v.vsttime,v.spclty as spclty,concat(p.pname,p.fname,'  ',p.lname) as pt_name,ep.name as period_name,d.name as doctor_name,k.department as name_department ";
					
					
$sqlErlist.="from er_regist  e ";
											
											
$sqlErlist.="left outer join ovst v on v.vn=e.vn ";


$sqlErlist.="left outer join er_emergency_type ert on ert.er_emergency_type=e.er_emergency_type ";

$sqlErlist.="left outer join er_dch_type erc on erc.er_dch_type=e.er_dch_type ";

$sqlErlist.="left outer join ovstdiag o on o.vn = e.vn and o.diagtype='1'";




$sqlErlist.="left outer join kskdepartment k on k.depcode =v.main_dep ";

											

$sqlErlist.="left outer join patient p on p.hn=v.hn ";

$sqlErlist.="left outer join er_period ep on ep.er_period=e.er_period ";
											
											
$sqlErlist.="left outer join  doctor d on d.code= e.er_doctor ";


$sqlErlist.="left outer join  vn_stat vs on vs.vn= e.vn ";


$sqlErlist.="where e.vstdate between '$d_conv_search' and  '$d_conv_search2' order by e.vn ";
	

$resultEr=mysql_db_query($DBName,$sqlErlist)
	or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
											
											
$num_rows_er = mysql_num_rows($resultEr);

if ($num_rows_er<>0){
	
	$bg="#B1C3D9";
?>
                        
						
<table width="605" border="0" align="center" cellpadding="0" cellspacing="0">
                          <!-- สร้างกรอบตาราง -->            
	
	<tr> 


	<tr bgcolor="blue"> 

      <td width="42" align="center" >ลำดับ</td>
     <td width="60" align="center" >&nbsp;HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     
	 
	 <td width="146" align="center" >ชื่อผู้ป่วย</td>
                                  
	
	<td width="83" align="center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เวลาที่มา</td>
                                 
														  
	 <td width="81" align="center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สถานะ</td>

  <td width="101" align="right" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สถานะภาพ</td>
	 
  <td width="138" align="left" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diag type  </td>

  <td width="100" align="left" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ค่าบริการ</td>

</tr>





                            <td height="16" colspan="8" align="center"> 
                              <!-- สร้างตารางกรอบใน เพื่อแสดงข้อมูล -->
                             
							  
			<table width="605" border="1" cellpadding="0" cellspacing="0" class="bd-external">
                              
								<?php
					$i=0;
			 		
					while($i<$num_rows_er){
					
					$rsEr=mysql_fetch_array($resultEr); 
					$er_hn=$rsEr["hn"];
					if ($bg=="#B1C3D9") { //color
					$bg="#FFFFFF";
					//$bgm="";
					}else{
						$bg="#B1C3D9";
					//$bgm="img_mian/bgcolor.gif";
					} //color
					?>
                                
								
	




								
	<tr bgcolor="<?php echo $bg; ?>" class="text-intable"> 

      <td width="42" align="center" ><?php echo $i+1; ?></td>
     <td width="60" align="center" >&nbsp;<?php echo $er_hn;?></td>
     
	 
	 <td width="146" align="left" >&nbsp;<?php echo "<a href=\"patient_medication_record.php?hn=$er_hn\">".change_misis($rsEr["pt_name"])."</a>" ; ?></td>
                                  
		<td width="83" align="center" >
		
		&nbsp;
		
		
		<?php echo $rsEr["vsttime"]; ?></td>
                                 							  
								  
	 <td width="81" align="center" >&nbsp;
	 
	 
	 <?php echo $rsEr["emergency_name"]; ?> 
 </td>

  <td width="101" align="center" >

	 <?php echo $rsEr["dch_name"];?>

 </td>
	 
	
      
	  
	  <td width="138" align="left" ><?php echo change_misis($rsEr["icd10"]) ; ?> </td>


	    <td  width="50" align="left" >

			 <?php echo number_format($rsEr["item_money"]) ;?>

		</td>



                                </tr>
                                <?php
	        	$i++;//$a++;
		    	}//while  ?>
                              </table>
                              <!-- end table show data -->
                            </td>
                          </tr>
   
                        </table>
                        <!-- end สร้างกรอบตาราง -->

				
				<?php 
					
			
	$exp_file="er_list_export";
	
	print"<br><br><center><img src='img_mian/excel_icon.gif' align='middle'>&nbsp;<a href='excel_export2.php?id1=$d_conv_search&id2=$d_conv_search2&exp_file=$exp_file'>Excel Export File</a></center><br><br>";
				
				?>



                        <?php
						  			if ($num_rows_T<10){ echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";}
			}else{  //row=0
			$row="n";
			echo"<center>ผลการค้นหา : ไม่มีข้อมูลของวันที่&nbsp;<font color=red><u>".$d." - ".$m." - ".($y+543)."</u></font>&nbsp;ในฐานข้อมูล<center>";
			echo "<br><br><br><br><br><br><br><br><br><br>";
		}//row=0
		?>
                      </td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </td>
          <td width="166" align="center" valign="top" bgcolor="#3399CC"> 
            <!-- form -->
            <form method="get" action="<?php echo $PHP_SELF; ?>">
              <table width="160" border="0" cellpadding="0" cellspacing="2" class="bd-internal">
                <tr> 
                  <td background="img_mian/bgcolor2.gif" class="headmenu"><div align="center"> 
                      :: <b>เลือกช่วงวันที่</b> ::</div></td>
                </tr>
                <tr> 
                  <td><div align="left">&nbsp; 
                      <input name="id1" type="text" id="Txt-Field" value="<?php echo $id1; ?>" size="18"/>
                      &nbsp;   <input name="button" id="Button" type="button" onClick="c1.innerpopup('id1','calendar_frame');" value="...&gt;"/> ถึง </div></td>
                </tr>

				<tr> 
                  <td><div align="left">&nbsp; 
                      <input name="id2" type="text" id="Txt-Field" value="<?php echo $id2; ?>" size="18"/>
                      &nbsp;   

<input name="button" id="Button" type="button" onClick="c2.innerpopup('id2','calendar_frame');" value="...&gt;"/></div></td>
                </tr>

                <tr> 
                  <td align="center"><div align="left">&nbsp; 
                  
                      &nbsp; 


					  &nbsp;
                      <input name="submit" type="submit" value="REFRESH" id="Button">
                    </div></td>
                </tr>

			

              </table>
            </form>
            <!-- end form -->
          </td>
        </tr>
        <tr>
          <td height="16" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"javascript:history.back(-1)\">ย้อนกลับ</a>" ?>&nbsp;|</td>
          <td height="16" valign="top" bgcolor="#3399CC">&nbsp;</td>
        </tr>
        <tr> 
          <td height="16" valign="top"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="16" valign="top">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23"><div align="center"><br>
        <br>
      </div></td>
  </tr>
</table>
<?php 
}//ch online
CloseDB(); //close connect db ?>
</body>
</html>
