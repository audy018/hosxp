<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ค้นหา OPD CARD - - |</title>
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
<script language="JavaScript">
<!--
function scrollit(){ 
	for (I=1; I<=2875; I++){ 	
		parent.scroll(0,I)  
	}
}                                                     
//-->
</SCRIPT>
<script language="JavaScript">

function popup(popupfile,winheight,winwidth,scrollbars)
{
open(popupfile,"PopupWindow","resizable=no,height=" + winheight + ",width=" + winwidth + ",scrollbars="+scrollbars+"");
}

</script>
<script language="javaScript">
function Linkup()
{
var number = document.DD.DDM.selectedIndex;
location.href = document.DD.DDM.options[number].value;
}
</script>
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
<body>
<?php
if (!$_SESSION["ip_Log"]){ //check  ->off line
	$sendpage="$PHP_SELF?pt_search=".$_GET['hn'];
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php?sendpage=$sendpage'>";
}else{ //on line
if  (($_SESSION["user_type"]=="online")  AND !Check_Onlines()){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";}
?>
<table width="800" border="0" cellspacing="0" cellpadding="0" id="table">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr valign="top"> 
          <td colspan="2">
		  <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
		  </td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif"><?php include("manu.inc"); ?> </td>
          <td width="148" align="left" valign="bottom" background="img_mian/bgcolor.gif">&nbsp; 
          </td>
        </tr>
        <tr> 
          <td width="650" height="610" valign="top" class="td-left"><div align="center"><br>
              <table width="635" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="650" valign="top"><table width="635" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                      <tr bgcolor="#99CCFF"> 
                        <td height="24" colspan="2" class="headmenu" align="center" background='img_mian/bgcolor2.gif'>ข้อมูลพื้นฐานของผู้ป่วย <?php echo "&nbsp;".$Hospname."&nbsp;"; ?></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center"><form name="f_ptSearch" action="<?php $PHP_SELF; ?>" method="get">
						&nbsp;ค้นหา :&nbsp;<input type="text" name="pt_search" id="Txt-Field">&nbsp;<input type="submit" name="ptbutton" value="Search" id="Button">
						</form></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center"><hr></td>
                      </tr>
                      <tr align="center" valign="top">
                        <td colspan="2">
						<?php
						if($_GET['pt_search'] or $_GET['hn']){ 
						//hn
						if($_GET['pt_search']){$hn=trim($_GET['pt_search']);}else{$hn=$_GET['hn'];}
						$Name_Addr=Serch_datafrom_hn($hn);
						$pmr=explode("|",$Name_Addr); //แยกค่าตัวแปรที่รับมาจาก fuc ด้วย |
						$p_name=$pmr[0]; // p[1] ชื่อ
						$p_addr=$pmr[1]; // p[2] ที่อยู่ 
						$Age=Age_hn($hn,$vn); //อายุ
						$cid_hn=Card_No($hn); //หมายเลขบัตรประชาชน	
						//vn
						$sqlVn="select * from ovst where hn='$hn' order by vn  desc limit 1 ";
						if ($vn==""){
						$resultVn = ResultDB($sqlVn);
						$rsVn=mysql_fetch_array($resultVn);
						$vn=$rsVn["vn"];
						//$sql_where="where p.hn='$hn' order by ov.vn desc limit 1 ";
						//$sql_where="where p.hn='$hn' and ov.vn='$vn' ";
						}else{
						$vn=$_GET['vn'];
						//$sql_where="where p.hn='$hn' and ov.vn='$vn' ";
						} //vn
						//echo "hn".$hn."vn".$vn;
						//sql Data  form hn and vn
						$sql="select ov.vn as vn_ovst,ov.vstdate as vst_date,p.*,o.name as job,n.name as n_nation1,n1.name as n_nation2,s.name as sex
						,c.contract_name as jobaddr,m.name as status,pt.name as pname,pn.pttypeno as pcardno,pn.expiredate,r.name as religionName,pn.expiredate as expiredate
						,concat(p.spsname,'  ',p.spslname) as nmarry,concat(p.fathername,' ',p.fatherlname) as fathername
						,concat(p.mathername,'  ',p.motherlname) as mathername,concat(h.hosptype,h.name) as hospmain
						,concat(h.hosptype,h.name) as hospsub
						from patient p
						left outer join occupation o on o.occupation=p.occupation
						left outer join nationality n on n.nationality=p.citizenship
						left outer join nationality n1 on n1.nationality=p.nationality
						left outer join pttypeno pn on pn.hn=p.hn
						left outer join pttype pt on pt.pttype=p.pttype
						left outer join marrystatus m on m.code=p.marrystatus
						left outer join ovst ov on ov.hn=p.hn
						left outer join contract_partner c on c.contract_id=ov.contract_id
						left outer join hospcode h on h.hospcode=ov.hospmain
						left outer join religion r on r.religion=p.religion
						left outer join sex s on s.code=p.sex 
						where p.hn='$hn' and ov.vn='$vn'  ";
						//$sql.=$sql_where;
						$result=ResultDB($sql);
						if(mysql_num_rows($result)==0){
						print"รหัส&nbsp;<b><font size=4 color=red>".$hn."</font></b>ไม่มีในฐานข้อมูล<br>\n";
						}else{
						 //$rs=mysql_fetch_array($result);
						?>
						<table width="500" border="0" cellspacing="0" cellpadding="0">
<tr align="center" class="tr">
  <td colspan="3" class="headtable"><?php print"ข้อมูลพื้นฐานทั่วไป ของ HN:<font color='red' size='4'><b><u>".$hn."</u></b></font>"; ?></td>
</tr>
<tr align="center" class="tr">
  <td colspan="3">
  <?php
  $rs=mysql_fetch_array($result);
  //echo $rs['vn_ovst'];
  if($rsVn['vn']==$vn){
  print"ข้อมูลของการมาโรงพยาบาลครั้งล่าสุด ณ วันที่ ".dateThai($rs['vst_date'])." [ VN: <font color='red'><b>".$rs['vn_ovst']."</b></font> ]";}else{
  print"ข้อมูลของการมาโรงพยาบาล ณ วันที่ ".dateThai($rs['vst_date'])." [ VN: ".$rs['vn_ovst']." ]";}
  ?>
  </td>
  </tr>
<tr class="tr">
  <td width="190" align="center">&nbsp;สิทธิการรักษาครั้งนี้</td>
  <td align="left">&nbsp;<?php if(!$rs['pname']){echo "ไม่ระบุ";}else{echo $rs['pname'];}?></td>
  <td align="left">เลขที่ :&nbsp;<?php if(!$rs['pcardno']){echo "ไม่ระบุ";}else{echo $rs['pcardno'];}?></td>
</tr>
                      <tr> 
                        <td colspan="3" align="left"> 
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center"><hr></td>
                        </tr>
                      <tr> 
                        <td>&nbsp;ชื่อ - สกุล</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><b><?php echo $p_name; ?></b></font></td>
                      </tr>
                      <tr> 
                        <td align="left"> &nbsp;ชื่อกลาง<!-- วันนัด-->
                        </td>
                        <td colspan="2" align="left"> &nbsp;<font color="#0066FF"><?php if(!$rs['midname']){echo "ไม่ระบุ";}else{echo $rs['midname'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;เพศ</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php echo $rs['sex']; ?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;วัน/เดือน/ปี เกิด
                          <!-- วันนัด--></td>
                        <td width="168" align="left">&nbsp;<font color="#0066FF"><?php echo dateThai($rs['birthday']); ?> </font></td>
                        <td width="142" align="left">เวลา : <font color="#0066FF"><?php  if($rs['birthtime']=="00:00:00" or !$rs['birthtime']){echo "ไม่ระบุ";}else{echo $rs['birthtime'];}?></font></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;อายุ</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php echo Age_hn($hn,$vn); //อายุ
 ?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;สถานภาพสมรส</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php echo $rs['status']; ?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;อาชีพ</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php echo $rs['job']; ?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;เชื้อชาติ/สัญชาติ</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php echo $rs['n_nation1']." / ".$rs['n_nation2']; ?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;ศาสนา</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php echo $rs['religionName']; ?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;หมู่เลือด</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['bloodgrp']){echo "ไม่ระบุ";}else{echo $rs['bloodgrp'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;แพ้ยา</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['drugallergy']){echo "ปฏิเสธการแพ้ยา";}else{echo $rs['drugallergy'];} ?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;เลขที่บัตรประชาชน</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['cid']){echo "ไม่ระบุ";}else{echo $rs['cid'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;เลขประจำตัวต่างด้าว</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['hid']){echo "-";}else{echo $rs['hid'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;บ้านเลขที่</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php echo $p_addr; ?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;รหัสไปรษณีย์</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['po_code']){echo "-";}else{echo $rs['po_code'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;เบอร์โทรศัพท์</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['hometel']){echo "-";}else{echo $rs['hometel'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;หมายเลขประจำตัวข้าราชการ</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php //echo $rs['pttypeno']; ?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;ข้อมูลนายจ้าง</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php //echo dateThai($rs['expiredate']); ?></font></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;หน่วยขึ้นทะเบียน</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php //echo $rs['marrystatus']; ?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;ผู้แจ้ง</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['informname']){echo "-";}else{echo $rs['informname'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;HN มารดา </td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['mother_hn']){echo "-";}else{echo $rs['mother_hn'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;ที่อยู่ผู้แจ้ง</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['informaddr']){echo "-";}else{echo $rs['informaddr'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;ความสัมคัญกับผู้ป่วย</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['informrelation']){echo "-";}else{echo $rs['informrelation'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;เบอร์โทรศัพท์ผู้แจ้ง</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['informtel']){echo "-";}else{echo $rs['informtel'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;ชื่อ-สกุล บิดา</td>
                        <td align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['fathername']){echo "-";}else{echo $rs['fathername'];} ?></font></td>
                        <td align="left">CID :&nbsp;<font color="#0066FF"><?php if(!$rs['father_cid']){echo "ไม่ระบุ";}else{echo $rs['father_cid'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;ชื่อ-สกุล มารดา</td>
                        <td align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['mathername']){echo "-";}else{echo $rs['mathername'];} ?></font></td>
                        <td align="left">CID :&nbsp;<font color="#0066FF"><?php if(!$rs['mother_cid']){echo "ไม่ระบุ";}else{echo $rs['mother_cid'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;ชื่อ-สกุล คู่สมรส</td>
                        <td align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['spsname'] and !$rs['spslname']){echo "-";}else{echo $rs['nmarry'];} ?></font></td>
                        <td align="left">CID :&nbsp;<font color="#0066FF"><?php if(!$rs['couple_cid']){echo "ไม่ระบุ";}else{echo $rs['couple_cid'];}?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;E-Mail</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['email']){echo "-";}else{echo $rs['email'];} ?>
                        </font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;ชื่อสถานที่ทำงาน</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['jobaddr']){echo "-";}else{echo $rs['jobaddr'];} ?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;เบอร์โทรศัพท์</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['worktel']){echo "-";}else{echo $rs['worktel'];} ?>
                        </font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;สถานพยาบาลหลักที่ระบุในบัตร</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['hospmain']){echo "-";}else{echo $rs['hospmain'];} ?></font></td>
                      </tr>
                      <tr>
                        <td>&nbsp;สถานพยาบาลรองที่ระบุในบัตร</td>
                        <td colspan="2" align="left">&nbsp;<font color="#0066FF"><?php if(!$rs['hospsub']){echo "-";}else{echo $rs['hospsub'];} ?>
                        </font></td>
                      </tr>
                      <tr align="center">
                        <td colspan="3">&nbsp;</td>
                      </tr>
                      <tr align="center" class="tr">
                        <td colspan="3" class="headtable">
						<?php 
  						print"ประวัติสิทธิการรักษา<br>ข้อมูลการมาโรงพยาบาล 10 ครั้งล่าสุด ของ HN:<font color='red' size='4'><b><u>".$hn."</u></b></font>";
						?>
						</td>
                        </tr>
                      <tr align="center">
                        <td colspan="3">
						<?php 
  						//print"ข้อมูลการมาโรงพยาบาล 10 ครั้งล่าสุด ของ HN:<font color='red' size='4'><b><u>".$hn."</u></b></font><br>";
  						//$sqlVn_All="select * from ovst where hn='$hn' order by vn  desc limit 10 ";
						$sqlVn_All="select o.hn,o.vn,o.vstdate,pt.name,o.pttypeno,pn.expiredate
						from ovst o
						left outer join pttype pt on pt.pttype=o.pttype
						left outer join ptcardno pn on pn.hn=o.hn
						where o.hn='$hn' order by o.vn desc limit 10 ";
						$resultVn_All = ResultDB($sqlVn_All);
						//start table 
						if(mysql_num_rows($resultVn_All)>0){
						print"<table border='0' cellpadding='0' cellspacing='0' class='bd-external' width='500'>";
						print"<tr class='headtable'><td align='center' background='img_mian/bgcolor2.gif'>ว/ด/ป [ VN ]</td><td align='center' background='img_mian/bgcolor2.gif'>สิทธิการรักษาครั้งนี้</td>\n";
						print"<td align='center' background='img_mian/bgcolor2.gif'>เลขที่</td><td align='center' background='img_mian/bgcolor2.gif'>บัตรหมดอายุ</td></tr>\n";
						$bg="#B1C3D9";
  							$i=0;
 						while($i<mysql_num_rows($resultVn_All)){
 							$rsVn_All=mysql_fetch_array($resultVn_All);
							if ($bg=="#B1C3D9") { $bg="#FFFFFF";}else{$bg="#B1C3D9";} //tr color
							print"<tr bgcolor='$bg' class='text-intable'>\n";
  							//echo " | <a href='$PHP_SELF?hn=".$rsVn_All['hn']."&vn=".$rsVn_All['vn']."&ptbutton=Search'>".dateThai($rsVn_All['vstdate'])."</a> | "; 
							print"<td>&nbsp;".dateThai($rsVn_All['vstdate'])."<br>&nbsp;VN :<font color='red'><b>".$rsVn_All['vn']."</b></font></td><td>&nbsp;".$rsVn_All['name']."</td><td>&nbsp;".$rsVn_All['pttypeno']."</td><td>&nbsp;".dateThai($rsVn_All['expiredate'])."</td>\n";
							print"</tr>\n"; 
  						$i++;
  						}//while
						print"</table>";}//row
						//end table 
  						?>
						
						</td>
                        </tr>
						</table>
					<?php 
						} //if 
					}else{echo"<b><font color=red size=4>กรอกรหัส HN ที่ต้องการด้วย ครับ</font></b>";} //search ?>
						</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <p>&nbsp;</p>
          </div></td>
          <td width="148" align="center" valign="top" class="td-right">
		  			<?php 
						 $sqlPic="select count(*) as cc from patient_image where hn='$hn' ";
						$resultPic=ResultDB($sqlPic);
						$rsPic=mysql_fetch_array($resultPic);
						if($rsPic["cc"]>0){
						print"<center>HN : <font color='red' size='4'><b>$hn</b></font>";
						echo "<a title=คลิ๊กเพื่อดูรูปขยาย href=javascript:popup(\"get_patient_image.php?hn=$hn\",260,340,0)><img src=\"get_patient_image.php?hn=$hn\"  width=\"120\" height=\"105\" vlign=\"middle\" border=\"1\"></a>";
						print"<br><font color='#FFFFFF'>".$rs['fullname']."</font></center>";
						 } 
						?></td>
        </tr>
        <tr valign="top"> 
          <td height="16" background="img_mian/bgcolor2.gif" align="center"><font color=white>| 
              <a href="pttype_service.php">ค้นหาใหม่</a>&nbsp;|&nbsp;<a href="javascript:history.back(-1)">ย้อนกลับ</a>&nbsp;|</font> 
          </td>
          <td height="16" background="img_mian/bgcolor2.gif">&nbsp;</td>
        </tr>
        <tr valign="top"> 
          <td height="16"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="16">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23">&nbsp;<br><br>
    </td>
  </tr>
</table>
<?php }//
CloseDB(); //close connect db ?>
</body>
</html>
