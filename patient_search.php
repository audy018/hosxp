<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ค้นหาผู้ป่วย - - |</title>
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
</head>
<body>
<?php
if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	session_unregister("ip_Log");
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line
//create patient_search table
$sqlPt="select count(*) as cc from patient";          //check patent row                 
                          $resultPt=mysql_db_query($DBName,$sqlPt)
				       	or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
$rsPt=mysql_fetch_array($resultPt);
							
		$ccPt=$rsPt["cc"] ;
		

$sqlPts="select count(*) as cc from patient_search";          //check patient row                 
                            $resultPts=mysql_db_query($DBName,$sqlPts)
				           	or ($Pts="N");
if ($Pts <>"N") { $rsPts=mysql_fetch_array($resultPts);
							
		$ccPts=$rsPts["cc"] ;
		$ccDiff=($ccPt-$ccPts);
}//if $Pts<>"N"
if ($Pts=="N" or $ccDiff<>0) { 
$sqlDr="Drop table  patient_search";
$resultDr= mysql_db_query($DBName,$sqlDr) ;
 
	
		$sqlCr="Create table  patient_search SELECT hn,concat(p.fname,p.lname,p.addrpart ,p.moopart ,t3.name,'m',substring_index(p.mathername,' ',1),'f',substring_index(p.fathername,' ',1)) as ptkey ";
			$sqlCr.="FROM patient p ";
			$sqlCr.="left outer join thaiaddress t1 on t1.addressid=concat(p.chwpart,'0000') ";
			$sqlCr.="left outer join thaiaddress t2 on t2.addressid=concat(p.chwpart,p.amppart,'00') ";
			$sqlCr.="left outer join thaiaddress t3 on t3.addressid=concat(p.chwpart,p.amppart,p.tmbpart) ";
$resultCr= mysql_db_query($DBName,$sqlCr)
or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
}//if ($Pts=="N" or $ccDiff<>0)
//end create patient_search table
?>

<table width="800" height="94" border="0" cellpadding="0" cellspacing="0" id="table">
  <tr>
    <td height="18" colspan="2">
      <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?></td>
  </tr>
  <tr>
    <td width="500" height="24" background="img_mian/bgcolor.gif"><font color="#FFFFFF">
      <?php
			include('manu.inc');
			$msg_search="ค้นหาข้อมูลใหม่";
			session_register("msg_search");
		?></font></td>
    <td width="20" colspan="-1" valign="top" background="img_mian/bgcolor.gif">&nbsp;</td>
  </tr>
  <tr>
    <td height="16" align="center" valign="top" class="td-left"><?php 
		if ($send_keyword==null or $keyword==null){ ?>
      <br>
      <table width="500" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td class="headtable" align="left">&nbsp;ระบบค้นหาผู้ป่วย</td>
        </tr>
        <tr>
          <td class="headtable" align="left">&nbsp;ระบุ HN หรือ ชื่อ หรือ สกุล หรือ ที่อยู่ หรือ ชื่อมารดา/บิดา ของผู้ป่วยที่ต้องการค้นหา<br>
              <br></td>
        </tr>
        <tr>
          <td><form method="post" action="<?php echo $PHP_SELF ?>" name="SearchForm">
              <table width="396" border="0" align="center" cellspacing="1" id="table">
                <tr>
                  <td width="109" class="detail-text1">&nbsp;ระบุคำที่ใช้ค้นหา</td>
                  <td width="163"><input type="text" name="keyword" size="25"  id="Txt-Field"></td>
                  <td width="114"><input type="submit" value="ค้นหา"  id="Button" name="send_keyword">
                      <input  type="reset" value="ยกเลิก" id="Button"></td>
                </tr>
              </table>
          </form></td>
        </tr>
        <tr>
          <td align="center" class="headmenu">&nbsp;<?php echo "<br>".$msg_search."<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>"; ?> </td>
        </tr>
      </table>
      <?php
			  }else{
			  $keywords=explode(" ",$keyword);
			  $keyword1=$keywords[0];
			  $keyword2=$keywords[1];
			  $keyword3=$keywords[2];
			  $keyword4=$keywords[3];
			  $keyword5=$keywords[4];
			  $keyword6=$keywords[5];
			  $keyword7=$keywords[6];

			  $keyall="%".$keyword1."%".$keyword2."%".$keyword3."%".$keyword4."%".$keyword5."%".$keyword6."%".$keyword7."%";
			  
			  if (is_numeric($keyword1)) {
			  $keylong=strlen($keyword1);
			  $hnlong=(7-$keylong);
				if  ($keylong<7 ){
				$i=0;
				while($i < $hnlong){
				$keyword1="0".$keyword1;
				$i++;
				}//while
				}//if ($keylong<7 )
								
			  		if(!isset($start)){
					$start = 0;}
			 $limit ="30";
			 // แสดงผลหน้าละกี่หัวข้อ
			 //* หาจำนวน record ทั้งหมด
			$sqlMax="SELECT * FROM patient ";
			$sqlMax.="where hn='$keyword1'";
			
			}// is_numeric
			else {
			if(!isset($start)){
					$start = 0;}
			 $limit ="30";
			 // แสดงผลหน้าละกี่หัวข้อ
			 //* หาจำนวน record ทั้งหมด
			$sqlMax="SELECT hn FROM patient_search ";
			$sqlMax.="where ptkey like '$keyall'";
			}// else
			$resultMax= mysql_db_query($DBName,$sqlMax)
			or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
			
			// หาจำนวนเรกคอร์ดข้อมูล
			$num_rows_max = mysql_num_rows($resultMax);
			if($num_rows_max==0){
			$row="n";
			$msg_search="ผลการค้นหา : ไม่มีข้อมูล<font color=red> <u>$keyword</u>  </font>ในฐานข้อมูล";
			session_register("msg_search");
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;  URL=patient_search.php'>";
			}else{ //n row
			$c=0;
			$hnall="";
			while($c<$num_rows_max){ 
									$rsMax=mysql_fetch_array($resultMax);
											if ($hnall==""){
											$hnall=$rsMax["hn"];}else{
							  				$hnall=$hnall.",".$rsMax["hn"]; } 
										$c++;
			} // while
		/* คิวรี่ข้อมูลออกมาเพื่อแสดงผล */
			$row="y";
			$sql.="SELECT (curdate()-(last_visit)) as last_date,hn,concat(p.pname,p.fname,'  ',p.lname),concat(p.addrpart,' ม.',p.moopart,' ต. ',t3.name,' อ.',t2.name,' จ. ',t1.name),mathername,fathername,last_visit ";
			$sql.="FROM patient p ";
			$sql.="left outer join thaiaddress t1 on t1.addressid=concat(p.chwpart,'0000') ";
			$sql.="left outer join thaiaddress t2 on t2.addressid=concat(p.chwpart,p.amppart,'00') ";
			$sql.="left outer join thaiaddress t3 on t3.addressid=concat(p.chwpart,p.amppart,p.tmbpart) ";
			$sql.="where p.hn='$keyword1'  or  p.hn in ($hnall) ";
			$sql.="order by p.fname,p.lname,p.hn,t3.name LIMIT $start, $limit ";
			$result = mysql_db_query($DBName,$sql)
			or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());

			echo "<br><b>ค้นหาจาก <font color=red><u>$keyword</u></font> ผลลัพธ์ มีจำนวน <font color=red><u>$num_rows_max</u></font> เรคคอร์ด</b><br><br>"; 
			$bg="#B1C3D9";
			?>
      <table width="750" border="0" cellspacing="0" cellpadding="0">
        <!-- สร้างกรอบตาราง -->
        <tr class="headtable">
          <td width="9" align="right"><img src="img_mian/c_t_left.gif" width="8" height="16"></td>
          <td width="29" background="img_mian/bgcolor2.gif" bgcolor="#3399CC" align="center">ลำดับ</td>
          <td width="67" align="center" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">HN</td>
          <td width="150"  align="center" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;ชื่อ</td>
          <td width="254" align="left" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp; ที่อยู่</td>
          <td width="142" align="left" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;มารดา/บิดา</td>
          <td width="90" align="center" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">รับบริการล่าสุด</td>
          <td width="9" align="left" valign="middle"><img src="img_mian/c_t_r.gif" width="8" height="16"></td>
        </tr>
        <tr>
          <td height="16" colspan="8" align="center"><!-- สร้างตารางกรอบใน เพื่อแสดงข้อมูล -->
              <table width="750" height="18" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                <?php
					$a=$start;
			 		if(!isset($i)){ //start i
					$i=0;
					}else{
					$i=($start+1);
			 		} //end $i
			 		while($i<$limit and  $a<$num_rows_max){
			 		$rs=mysql_fetch_array($result); 
					$hn_patient=$rs["hn"];
					$name_patient=$rs["concat(p.pname,p.fname,'  ',p.lname)"];
					$addr_patient=$rs["concat(p.addrpart,' ม.',p.moopart,' ต. ',t3.name,' อ.',t2.name,' จ. ',t1.name)"];
					
					$mathername=explode(" ",$rs["mathername"]);
					$fathername=explode(" ",$rs["fathername"]);
					if  ($rs["last_visit"]<>"") {
					$last_visit=FormatDate($rs["last_visit"]);
										
					if ($rs["last_date"]<7) {
					$last_visit="<font color=red>".FormatDate($rs["last_visit"])."</font>";
					}
					} else { $last_visit="-";}
					if ($bg=="#B1C3D9") { //color
					$bg="#FFFFFF";
					//$bgm="";
					}else{
					$bg="#B1C3D9";
					//$bgm="img_mian/bgcolor.gif";
					} //color
					?>
                <tr bgcolor="<?php echo $bg; ?>" class="text-intable">
                  <td width="37" background="<?php //echo $bgm;?>"><div align="center"><?php echo $a+1; ?></div></td>
                  <td width="67" background="<?php //echo $bgm;?>"><div align="center"><?php echo $hn_patient;?></div></td>
                  <td width="152" background="<?php //echo $bgm;?>" align="left">&nbsp;&nbsp;
                      <?php 
				  		if ($vn==""){
						$sqlVn="select * from ovst where hn='$hn_patient' order by vn  desc limit 1 ";
						$resultVn=ResultDB($sqlVn);
						//$result = mysql_db_query($DBName,$sqlVn)
						//or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
						$rsVn=mysql_fetch_array($resultVn);
						$vn=$rsVn["vn"];
				  			echo "<a href=\"patient_medication_record.php?hn=$hn_patient&vn=$vn&keyword=$keyword\">$name_patient</a>"; 
						}else{
				  			echo "<a href=\"patient_medication_record.php?hn=$hn_patient&vn=$vn&keyword=$keyword\">$name_patient</a>"; 
				  		}
				  ?></td>
                  <td width="254" background="<?php //echo $bgm;?>" align="left">&nbsp;&nbsp;<?php echo $addr_patient; ?></td>
                  <td width="139" background="<?php //echo $bgm;?>" align="left"><?php echo $mathername[0]."/".$fathername[0]; ?></td>
                  <td width="100" background="<?php //echo $bgm;?>" align="center"><?php echo $last_visit; ?></td>
                </tr>
                <?php
	        	$i++;$a++;
		    	}//while  ?>
              </table>
              <!-- end table show data -->
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle"><img src="img_mian/c_l_left.gif" width="8" height="16"></td>
          <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
          <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
          <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
          <td colspan="3" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
          <td align="left" valign="middle"><img src="img_mian/c_l_r.gif" width="8" height="16"></td>
        </tr>
      </table>
      <!-- end สร้างกรอบตาราง -->
      <?php
			}//n row
		/* ตัวแบ่งหน้า */
		$page = ceil($num_rows_max/$limit); // เอา record ทั้งหมด หารด้วย จำนวนที่จะแสดงของแต่ละหน้า
		/* เอาผลหาร มาวน เป็นตัวเลข เรียงกัน เช่น สมมุติว่าหารได้ 3 เอามาวลก็จะได้ 1 2 3 */
		if($row<>"n"){
		echo "<br>Page:";
		for($p=1;$p<=$page;$p++){ //for
			if ($p>25){ echo "<h3><font color=red><br>ข้อมูลที่ค้นมีจำนวนเรคคอร์ดมากเกินไป<br>โปรแกรมจะแสดงผลให้ทั้งหมด 25 หน้า<br>ควรระบุคำค้นให้รัดกุมมากกว่านี้</font></h3>"; break;}
			if($_GET['page']==$p){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้
			echo "[<a href='?start=".$limit*($p-1)."&page=$p&send_keyword=y&keyword=$keyword'><B>$p</B></A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
	   		}else{
			echo "[<a href='?start=".$limit*($p-1)."&page=$p&send_keyword=y&keyword=$keyword'>$p</A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
    		}
	    }//for
			}else{  //row=n
			echo"<h3>ผลการค้นหา : ไม่มีข้อมูล<font color=red> <u>$keyword</u></font> ในฐานข้อมูล</h3>";
			echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
			}//row=n
    		
		}//send_key
		?></td>
    <td colspan="-1" class="td-left">&nbsp;</td>
  </tr>
  <tr> 
    <td height="16" align="left" valign="top" bgcolor="#FFFFFF"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
    <td colspan="-1">&nbsp;</td>
  </tr>
</table>
<?php }//ch online ?>
</body>
</html>

