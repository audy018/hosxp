<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - ยอดผู้รับบริการคลอด - - |</title>
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
 //จำนวนผู้ป่วยในวันที่เลือก
$d_conv=explode("-",$id1);$d=$d_conv[0];$m=$d_conv[1];$y=$d_conv[2];
$d_conv_search="$y-$m-$d";
$key_word=$_GET['keyword'];
?>
<body>
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
          <td width="139" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; 
          </td>
        </tr>
        <tr> 
          <td width="659" height="177" align="center" valign="top" class="td-left"><br>
		  <table width="621" border="0" cellpadding="0" cellspacing="0" class="bd-external">
            <tr align="center" bgcolor="#99CCFF">
              <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> ยอดผู้รับบริการคลอด ปีงบประมาณ&nbsp;<?php  if(!$syear or $syear==$y){echo ($y+543);}else{echo ($syear+543);} ?></td>
            </tr>
            <tr>
              <td width="337" valign="top">&nbsp;
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
            <tr align="center">
              <td colspan="2">&nbsp; เลือกปีงบประมาณ :&nbsp;
				  <?php
				  		$sqlyear="select  YEAR(regdate) as year_come from ipt ";
						$sqlyear.="where an<>'' group by  year_come order by year_come desc  ";
						$result=ResultDB($sqlyear);//echo mysql_num_rows($result);
                  	  print"<form  name='fsYear' method='get' action='$PHP_SELF'>";
					  print"<select name='syear'  id='Txt-Field'>";
				 		if(!$syear or $syear==$y){
					    print"<option value='$y'>".($y+543)."</option>";}else{
					  	print"<option value='$syear-543'>".($syear+543)."</option>";}
					 if(mysql_num_rows($result)>0){
					  $i=0;
					  while($i<mysql_num_rows($result)){
					  $rs=mysql_fetch_array($result);
					  if($rs['year_come']){$y1=$rs['year_come']+543;$y2=$rs['year_come'];}
					  	print"<option value='$y2'>$y1</option>";
					  $i++;  
					    }
					  }
					  print"</select>"; 
					  print"&nbsp;<input type='submit' value='Continue' id='Button'>";
					  print"</form>";
					  ?>
              </td>
            </tr>
            <tr>
              <td colspan="2"><!-- end สร้างกรอบตาราง --></td>
            </tr>
            <tr align="center" valign="top">
              <td colspan="2">
			</td>
            </tr>
            <tr align="center">
              <td colspan="2"><table width="600" border="1" cellspacing="0" cellpadding="0">
                <tr class="headtable">
                  <th width="150" scope="col" align="center" background="img_mian/bgcolor2.gif">ข้อมูล</th>
                  <th width="30" align="center" scope="col" background="img_mian/bgcolor2.gif">ต.ค.</th>
                  <th width="30" align="center" scope="col" background="img_mian/bgcolor2.gif">พ.ย.</th>
                  <th width="30" align="center" scope="col" background="img_mian/bgcolor2.gif">ธ.ค.</th>
                  <th width="30" align="center" scope="col" background="img_mian/bgcolor2.gif">ม.ค.</th>
                  <th width="30" align="center" scope="col" background="img_mian/bgcolor2.gif">ก.พ.</th>
                  <th width="30" align="center" scope="col" background="img_mian/bgcolor2.gif">มี.ค.</th>
                  <th width="30" align="center" scope="col" background="img_mian/bgcolor2.gif">เม.ษ.</th>
                  <th width="30" align="center" scope="col" background="img_mian/bgcolor2.gif">พ.ค.</th>
                  <th width="30" align="center" scope="col" background="img_mian/bgcolor2.gif">มิ.ย.</th>
                  <th width="30" align="center" scope="col" background="img_mian/bgcolor2.gif">ก.ค.</th>
                  <th width="30" align="center" scope="col" background="img_mian/bgcolor2.gif">ส.ค.</th>
                  <th width="30" align="center" scope="col" background="img_mian/bgcolor2.gif">ก.ย.</th>
                </tr>
				  <?php	
				 include("sql_report_lr.inc");
				  // tr จำนวนคลอดทั้งหมด			  
				 print"<tr>".sql_array($sqlAllBorn,'จำนวนคลอดทั้งหมด')."</tr>";
				 //tr คลอดปกติ
				  print"<tr>".sql_array($sqlMormalBorn,'คลอดปกติ')."</tr>"; 
				 //tr คลอดผิดปกติ
				  print"<tr>".sql_array($sqlNoNormal,'คลอดผิดปกติ')."</tr>"; 
				 //tr V/E
				  print"<tr>".sql_array($sqlVE,'V/E')."</tr>"; 
				 //tr ท่าก้น
				  print"<tr>".sql_array($sqlBE,'ท่าก้น')."</tr>"; 
				 //tr แฝด
				  print"<tr>".sql_array($sqlTwin,'แฝด')."</tr>"; 
				  // tr จำนวนมารดามีชีวิต  
				 print"<tr>".sql_array($sqlMother,'จำนวนมารดามีชีวิต')."</tr>";
				  // tr จำนวนมารดาเสียชีวิต			  
				 print"<tr>".sql_array($sqlMotherDead,'จำนวนมารดาเสียชีวิต')."</tr>";
				  // tr จำนวนทารกเกิดมีชีพ  
				 print"<tr>".sql_array($sqlNor_child,'จำนวนทารกเกิดมีชีพ')."</tr>";
				  // tr จำนวนทารกเกิดไร้ชีพ  
				 print"<tr>".sql_array($sqlDead_Still,'จำนวนทารกเกิดไร้ชีพ')."</tr>";
				 // tr Apgar Score 1 นาทีิ  
				 print"<tr>".sql_array($sqlApgar1,'Apgar Score 1 นาที')."</tr>";
				  // tr Apgar Score 1 นาทีิ  0-3 คะแนน
				 print"<tr>".sql_array($sqlApgar1_03,'0 - 3 คะแนน')."</tr>";
				  // tr Apgar Score 1 นาทีิ  4-7 คะแนน
				 print"<tr>".sql_array($sqlApgar1_47,'4 - 7 คะแนน')."</tr>";
				  // tr Apgar Score 5 นาทีิ  
				 print"<tr>".sql_array($sqlApgar5,'Apgar Score 5 นาที')."</tr>";
				  // tr Apgar Score 5 นาทีิ  0-3 คะแนน
				 print"<tr>".sql_array($sqlApgar5_03,'0 - 3 คะแนน')."</tr>";
				  // tr Apgar Score 5 นาทีิ  0-3 คะแนน
				 print"<tr>".sql_array($sqlApgar5_47,'4 - 7 คะแนน')."</tr>";
				  // tr น้ำหนักแรกเกิดต่ำกว่า 2500
				 print"<tr>".sql_array($sqlbirth_w2500,'น้ำหนักแรกเกิดต่ำกว่า 2500')."</tr>";
				  // tr น้ำหนักแรกเกิดต่ำกว่า 2000 -2499
				 print"<tr>".sql_array($sqlbirth_w2k2499,'น้ำหนักแรกเกิดต่ำกว่า 2000-2499')."</tr>";
				  // tr น้ำหนักแรกเกิดต่ำกว่า 2000
				 print"<tr>".sql_array($sqlbirth_w2k,'น้ำหนักแรกเกิดต่ำกว่า 2000')."</tr>";
				 // tr น้ำหนักแฝดต่ำกว่า 2000-2499
				 print"<tr>".sql_array($sqlTwin_w2k2499,'น้ำหนักแฝดต่ำกว่า 2000-2499')."</tr>";
				 // tr น้ำหนักแฝดต่ำกว่า 2000
				 print"<tr>".sql_array($sqlTwin_w2k,'น้ำหนักแฝดต่ำกว่า 2000')."</tr>";
				 // tr มารดาไม่ฝากครรภ์
				 print"<tr>".sql_array($sqlAnc,'มารดาไม่ฝากครรภ์')."</tr>";
				 // tr มารดาอายุน้อยกว่า 20 ปี
				// print"<tr>".sql_array($sqlMother_20,'มารดาอายุน้อยกว่า 20 ปี')."</tr>";
				 //tr ภาวะแทรกซ้อน
				 print"<tr>".sql_array($sqlComplecation,'ภาวะแทรกซ้อน')."</tr>";
				 // tr ภาวะแทรกซ้อน ->PIH
				 print"<tr>".sql_array($sqlPIH,'-> PIH')."</tr>";
				 // tr ภาวะแทรกซ้อน ->Eclampsia
				 print"<tr>".sql_array($sqlEclampsia,'->Eclampsia')."</tr>";
				 // tr ภาวะแทรกซ้อน ->PROM
				 print"<tr>".sql_array($sqlProm,'->PROM')."</tr>";
				 // tr ภาวะแทรกซ้อน ->Porolong 1 Stage
				 print"<tr>".sql_array($sqlPorolong1,'->Porolong 1 Stage')."</tr>";
				 // tr ภาวะแทรกซ้อน ->Porolong 2 Stage
				 print"<tr>".sql_array($sqlPorolong2,'->Porolong 2 Stage')."</tr>";
				//ภาวะแทรกซ้อน ->Premature contraction
				 print"<tr>".sql_array($sqlPremature,'->Premature contraction')."</tr>";
				//ภาวะแทรกซ้อน ->CPD
				 print"<tr>".sql_array($sqlCpd,'->CPD')."</tr>";
				//ภาวะแทรกซ้อน ->PPH
				 print"<tr>".sql_array($sqlPPH,'->PPH')."</tr>";
				//ภาวะแทรกซ้อน ->Retained Placenta
				 print"<tr>".sql_array($sqlRetained,'->Retained Placenta')."</tr>";
				//ภาวะแทรกซ้อน ->Uterine rupture
				 print"<tr>".sql_array($sqlUterine,'->Uterine rupture')."</tr>";
				//ภาวะแทรกซ้อน ->คลอดติดไหล่
				 print"<tr>".sql_array($sqlShoulder,'->คลอดติดไหล่')."</tr>";

				?>
				<tr class="headtable">
                  <th colspan="13" align="center" background="img_mian/bgcolor2.gif" scope="col">&nbsp;</th>
                  </tr>
              </table></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>            
          </td>
          <td width="139" align="center" valign="top" class="td-right"><table width="140" border="1" cellspacing="0" cellpadding="0">
            <tr>
              <th width="129" background="img_mian/bgcolor2.gif" scope="col">รายงาน</th>
            </tr>
            <tr>
              <td class="td-left">&nbsp; - <a href="report_in_department_lr.php">ผู้รับบริการห้องคลอด</a><br>
                &nbsp; - <a href="report_in_department_den.php">ประกันสังคมทันตกรรม</a><br>
                &nbsp; - <a href="report_in_department_er.php">ER</a><br></td>
            </tr>
          </table>            <!-- form -->
            <!-- end form --></td>
        </tr>
        <tr>
          <td height="16" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"javascript:history.back(-1)\">ย้อนกลับ</a>" ?>&nbsp;|</td>
          <td height="16" valign="top" class="td-right">&nbsp;</td>
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
