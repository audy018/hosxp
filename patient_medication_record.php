<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ประวัติผู้ป่วยที่มารับบริการ - - |</title>
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
<script language="javascript">
function del(varUrl) {
if (window.confirm("คุณต้องการดูผล lab ควบคุมพิเศษ? ถ้าคุณเลือก OK ชื่อของคุณจะถูกบันทึกลงฐานข้อมูล")==true) {
window.open(varUrl,"_self")
}
}
</script>
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

<script type="text/javascript">

function getposOffset(overlay, offsettype){
var totaloffset=(offsettype=="left")? overlay.offsetLeft : overlay.offsetTop;
var parentEl=overlay.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}

function overlay(curobj, subobjstr, opt_position){
if (document.getElementById){
var subobj=document.getElementById(subobjstr)
subobj.style.display=(subobj.style.display!="block")? "block" : "none"
var xpos=getposOffset(curobj, "left")+((typeof opt_position!="undefined" && opt_position.indexOf("right")!=-1)? -(subobj.offsetWidth-curobj.offsetWidth) : 0) 
var ypos=getposOffset(curobj, "top")+((typeof opt_position!="undefined" && opt_position.indexOf("bottom")!=-1)? curobj.offsetHeight : 0)
subobj.style.left=xpos+"px"
subobj.style.top=ypos+"px"
return false
}
else
return true
}

function overlayclose(subobj){
document.getElementById(subobj).style.display="none"
}

</script>
</head>
<body>
<?php

  //if (!$_SESSION["ip_Log"] and  !Check_Online(get_ip())){ //check  ->on/off line
if (!$_SESSION["ip_Log"]){ //check  ->on/off line
	//if off line
	//session_unregister("ip_Log");
	$sendpage="$PHP_SELF?hn=$hn";
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php?sendpage=$sendpage'>";
}else{ //if on line
$aright=array("ADMIN","DOCTOR","SCREEN","View_EMR");
  if(check_right($_SESSION["right"],$aright)==0){echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=pttype_service.php?pt_search=$hn'>";}
	//show $_REQUEST['submit'];
		if($_REQUEST['submit']=="Approve"){$submit=$_REQUEST['submit'];
	}elseif($_REQUEST['submit']=="Edit"){$submit=$_REQUEST['submit'];
	}else{$submit="Review";}//end show

$key_word=$_GET['keyword']; //get key from page
//check hn code

if ($vn=="" and $year_come==""){
$sqlVn="select vn, vstdate,vsttime from ovst where hn='$hn' order by vn  desc limit 1 ";
			$result = mysql_db_query($DBName,$sqlVn)
			or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
			$rs=mysql_fetch_array($result);
			$vn=$rs["vn"];
			$datevst=$rs["vstdate"];$timevst=$rs["vsttime"];
}elseif($vn=="" and $year_come<>""){ 
$sqlVn="select vn, vstdate,vsttime from ovst where hn='$hn' and vstdate between '$year_come-01-01' and '$year_come-12-31' order by vn  desc limit 1 ";
			$result = mysql_db_query($DBName,$sqlVn)
			or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
			$rs=mysql_fetch_array($result);
			$vn=$rs["vn"];
			$datevst=$rs["vstdate"];$timevst=$rs["vsttime"];
}else{ 
$sqlVn="select  vstdate,vsttime from ovst where vn='$vn' ";
			$result = mysql_db_query($DBName,$sqlVn)
			or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
			$rs=mysql_fetch_array($result);
			$datevst=$rs["vstdate"];$timevst=$rs["vsttime"];
			}

if($vn=="" or $hn==""){// check VN 
echo "<center><h2><font color=red>ไม่มีประวัติผู้ป่วยในฐานข้อมูล<br>ภายหลังปรับปรุงระบบฐานข้อมูลผู้ป่วยอิเล็กทรอนิกส์</font></h2></center>";
echo "<meta  HTTP-EQUIV='REFRESH' CONTENT='2; URL=\"patient_search.php?keyword=$keyword&send_keyword=y\"'>";
} else {
if ($an==""){
$sqlAn="select an from an_stat  where hn='$vn' ";
			$result = mysql_db_query($DBName,$sqlAn)
			or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
			$rs=mysql_fetch_array($result);
			$an=$rs["an"];
} 
$get_Name_Addr=Serch_datafrom_hn($hn);
$pmr=explode("|",$get_Name_Addr); //แยกค่าตัวแปรที่รับมาจาก fuc ด้วย |
$p_name=$pmr[0]; // p[1] ชื่อ
$p_addr=$pmr[1]; // p[2] ที่อยู่ 
$get_Age=Age_hn($hn,$vn); //อายุ
$Card_No=Card_No($hn); //หมายเลขบัตรประชาชน
$get_pt_type=Pt_Type($vn); //สิทธิและเลขที่
$pttype=explode("|",$get_pt_type); //แยกค่าตัวแปรที่รับมาจาก func ด้วย |
$pt_no=$pttype[0]; // p[1] สิทธิ
$pt_type=$pttype[1]; // p[2] เลขที่
$get_opd_sc=His_Pmr($vn); //อาการและประวัติสำคัญ
$opd_cc_pe=explode("|",$get_opd_sc);
$opd_cc=$opd_cc_pe[0]; //cc
$opd_pe=$opd_cc_pe[1]; //pe
//$opd_pulse=$opd_cc_pe[2]; //pulse
$get_drug=Opd_Drug($hn); //แพ้ยา
$get_opd_his=Opd_History($hn);  //โรคประจำตัว
$get_Cc_oper=Cc_Oper($hn); //ผ่าตัด
$get_Vs=Vital_Sign($vn); //vital sign
$get_nDoctor=nDoctor($vn); //name doctor
$get_cmdD=cmdDoctor($vn); //command doctor

?>
<a name="top"></a>
<table width="800" border="0" cellspacing="0" cellpadding="0" id="table">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr> 
          <td colspan="3" valign="top">
<?php if (Check_Onlines() and $Header=="N") {} else {include("header.inc");}?>		  </td>
        </tr>
        <tr> 
          <td height="24" colspan="2" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC">
		  <?php include("manu.inc"); ?>		  </td>
          <td width="163" height="14" align="center" background="img_mian/bgcolor.gif" bgcolor="#3399CC">
		  >> <a href="#"  onClick="scrollit()">เลื่อนลง</a>          </td>
        </tr>
        <tr>
          <td height="16" colspan="2" valign="top" align="right">>> Refer Reply | <a href="#" onClick="return overlay(this, 'subcontent')">Quick Search</a> | <a href="#" onClick="return overlay(this, 'subcontent2', 'rightbottom')">Family Folder</a> <<</td>
          <td align="left" valign="top" class="td-right">&nbsp;</td>
        </tr>
        <tr> 
          <td height="187" colspan="2" valign="top"><div align="center"><br>
		  
<!--Do not remove outer most DIV tag with id="subcontent"-->
<DIV id="subcontent" style="position:absolute; border: 2px solid green; background-color: gold; width: 220px; padding: 5px; display:none">

<b>ค้นหาผู้ป่วย (HN) :</b>
<form method="get" action="patient_medication_record.php?hn=<?php echo $hn; ?>" id="topform">
<input type="HIDDEN" NAME="id" SIZE="-1" VALUE="6299074">
<input type="HIDDEN" NAME="pageid" SIZE="-1" VALUE="r">
<input type="HIDDEN" NAME="mode" SIZE="-1" VALUE="ALL">
<input type="HIDDEN" name="n" value="0">
<input name="hn" maxlength="255" style="width: 150px" id="Button" alt="Search"> 
<input value="ค้นหา" type="submit" id="Button">
</form><a href="#" onClick="overlayclose('subcontent'); return false">ปิดหน้าต่าง</a>
</DIV>
<!--Do not remove outer most DIV tag with id="subcontent2"-->
<DIV id="subcontent2"  style="position:absolute; display:none; border: 2px solid green; background-color: gold; width: 300px; height: 300px; padding: 8px">

<p align="left"><b><font color="blue">>> Show Family Folder :</font></b>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onClick="overlayclose('subcontent2'); return false">ปิดหน้าต่าง</a>
<br>
<?php
//คนที่อยู่ในบ้านทั้งหมด
echo "<b><u>คนที่อยู่ในบ้านทั้งหมด</u> :</b>";
$sqlPatient_address="select  * from patient p left outer join vn_stat  v on v.hn=p.hn where p.hn='$hn' and v.vn='$vn' ";//echo $hn;
$resultPatient_address=ResultDB($sqlPatient_address);
if(mysql_num_rows($resultPatient_address)>0){
		$rsPatient_address=mysql_fetch_array($resultPatient_address);
			$sqlPaddress="select distinct v.hn,v.vn,concat(p.pname,fname,'     ',lname) as pname,v.pdx from vn_stat v left outer join patient p on p.hn=v.hn ";
			$sqlPaddress.="where p.addrpart='".$rsPatient_address['addrpart']."' and p.moopart='".$rsPatient_address['moopart']."' and p.tmbpart='".$rsPatient_address['tmbpart']."' and p.amppart='".$rsPatient_address['amppart']."' and p.chwpart='".$rsPatient_address['chwpart']."' group by v.hn ";
						//echo $sqlPaddress;
						$resultPaddress=ResultDB($sqlPaddress);echo "<br>มีทั้งหมด  ".mysql_num_rows($resultPaddress)."   รายการ<br>";
						if(mysql_num_rows($resultPaddress)>0){
							for($i=0;$i<mysql_num_rows($resultPaddress);$i++){
							$rsPaddress=mysql_fetch_array($resultPaddress);
							echo "<a href=".$PHP_SELF."?hn=".$rsPaddress['hn']."&vn=".$rsPaddress['vn'].">".$rsPaddress['pname']."</a><br>";
							} //for
						}else{
							echo "ไม่มีรายการ";
						}
//จบส่วนคนที่อยู่ในบ้านทั้งหมด
//รายการคนที่อยู่ในบ้านที่มี ผลการวิฉัยเหมือนกัน
//echo $rsPatient_address['pdx'];
echo "<br><b><u>คนที่อยู่ในบ้าน ที่มีผลการวินิจฉัยเดียวกัน</u> :</b>  Pdx : ".$rsPatient_address['pdx'];
$sqlPpdx="select v.hn,v.vn,concat(p.pname,fname,'     ',lname) as pname,v.pdx from vn_stat v left outer join patient p on p.hn=v.hn ";
$sqlPpdx.="where p.addrpart='".$rsPatient_address['addrpart']."' and p.moopart='".$rsPatient_address['moopart']."' and p.tmbpart='".$rsPatient_address['tmbpart']."' and p.amppart='".$rsPatient_address['amppart']."' and p.chwpart='".$rsPatient_address['chwpart']."' and v.pdx='"
.$rsPatient_address['pdx']."' and v.hn<>'$hn' group by v.hn ";
//echo $sqlPpdx;
$resultPpdx=ResultDB($sqlPpdx);echo "<br>มีทั้งหมด  ".mysql_num_rows($resultPpdx)."   รายการ<br>";
						if(mysql_num_rows($resultPpdx)>0){
							for($i=0;$i<mysql_num_rows($resultPpdx);$i++){
							$rsPpdx=mysql_fetch_array($resultPpdx);
							echo "<a href=".$PHP_SELF."?hn=".$rsPpdx['hn']."&vn=".$rsPpdx['vn'].">".$rsPpdx['pname']."</a><br>";
							} //for
						}else{
							echo "ไม่มีรายการ";
						} 

echo "<br><b><u>คนที่อยู่ในตำบล ที่มีผลการวินิจฉัยเดียวกัน</u> :</b></b>  Pdx : ".$rsPatient_address['pdx'];
$sqlPpdx1="select v.hn,v.vn,concat(p.pname,fname,'     ',lname) as pname,v.pdx from vn_stat v left outer join patient p on p.hn=v.hn ";
$sqlPpdx1.="where  p.tmbpart='".$rsPatient_address['tmbpart']."' and p.amppart='".$rsPatient_address['amppart']."' and p.chwpart='".$rsPatient_address['chwpart']."' and v.pdx='"
.$rsPatient_address['pdx']."' and v.hn<>'$hn' group by v.hn ";
//echo $sqlPpdx;
$resultPpdx1=ResultDB($sqlPpdx1);echo "<br>มีทั้งหมด  ".mysql_num_rows($resultPpdx1)."  รายการ<br>";
						if(mysql_num_rows($resultPpdx1)>0){
							for($i=0;$i<mysql_num_rows($resultPpdx1);$i++){
							$rsPpdx1=mysql_fetch_array($resultPpdx1);
							echo "<a href=".$PHP_SELF."?hn=".$rsPpdx1['hn']."&vn=".$rsPpdx1['vn'].">".$rsPpdx1['pname']."</a><br>";
							} //for
						}else{
							echo "ไม่มีรายการ";
						} 

//จบรายการคนที่อยู่ในบ้านที่มี ผลการวิฉัยเหมือนกัน
}else{ //no row patient
			echo "ไม่มีรายการ ตาม HN=$hn ข้างต้น";
}  //no row patient

?>
</p>
<div align="right"><a href="#" onClick="overlayclose('subcontent2'); return false">ปิดหน้าต่าง</a></div>

</DIV>

              <table width="600" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="620" class="td-left2"><table width="620" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                      <tr> 
                        <td height="24" align="center" background="img_mian/bgcolor2.gif" class="headmenu"><b>Patient 
                            Medication Record (เวชระเบียนผู้ป่วย) <?php echo "&nbsp;".$Hospname."&nbsp;"; ?></b></td>
                        <td height="18" align="right" background="img_mian/bgcolor2.gif">&nbsp; <a href="#below"><img src="img_mian/arow_bl.gif" width="13" height="9" border="0"></a>&nbsp;ด้านล่าง&nbsp;&nbsp;&nbsp; </td>
                      </tr>
                      <tr> 
                        <td width="468" align="left" valign="top"> &nbsp;วันที่ :  <font color="#0066FF"><?php echo dateThai($datevst); ?></font>&nbsp;&nbsp; เวลา : <font color="#0066FF"><?php echo $timevst; ?></font>&nbsp; VN : <font color="red"><b><?php echo $vn; ?></b></font><br>
                          &nbsp;HN : <font color="red" size="3"><b><u><?php echo $hn; ?></u></b></font> 
                          ชื่อ-สกุล :&nbsp;<font color="#0066FF"><?php echo $p_name; ?></font>&nbsp;อายุ 
                          ณ การมาครั้งนี้ :&nbsp;<font color="#0066FF"><?php echo $get_Age ?></font>&nbsp;<br> 
                          &nbsp; ที่อยู่ :<font color="#0066FF"><?php echo $p_addr; ?></font><br> 
                          &nbsp;CID : <font color="#0066FF"><?php echo $Card_No; ?></font> 
                          สิทธิการรักษา :&nbsp;<font color="#0066FF"><?php echo $pt_no; ?></font>
						  <?php if ($pt_type <>"" ){echo "<br> &nbsp;เลขที่ :&nbsp;<font color=#0066FF>".$pt_type."</font> ";  } ?>                        </td>
                        <td width="152" rowspan="2" align="center" valign="top"><br> 
                          <?php 
						 $sqlPic="select count(*) as cc from patient_image where hn='$hn' ";
						 $result=mysql_db_query($DBName,$sqlPic)
				         or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
						$rs=mysql_fetch_array($result);
						if($rs["cc"]>0){
						print"<center>HN : <font color='red' size='3'><b>$hn</b></font>";
						echo "<a title=คลิ๊กเพื่อดูรูปขยาย href=javascript:popup(\"get_patient_image.php?hn=$hn\",260,340,0)><img src=\"get_patient_image.php?hn=$hn\"  width=\"120\" height=\"105\" vlign=\"middle\" border=\"1\"></a>";
						print"<br><font color='#0066FF'>$p_name</font></center>";
						 } 
						?>
                          <br>
						  <?php
						  $sqlNote="select  ptnote from ptnote where hn='$hn' ";
						 $resultNote=mysql_db_query($DBName,$sqlNote)
				         or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
						$rsNote=mysql_fetch_array($resultNote);
						$num_rows_note=mysql_num_rows($resultNote);
						//$xx=(($rsNote["ptnote"]);
						$width=(strlen($rsNote["ptnote"])+100)/2;
						if($num_rows_note>0){
						    echo "<center><a title=คลิ๊กเพื่อดูรูปขยาย href=javascript:popup(\"ptnote.php?hn=$hn\",".$width.",340,1)>ข้อมูลเฉพาะผู้ป่วย(note)</a>";}
							?></td>
                      </tr>
                      <tr> 
                        <td align="left" valign="top"> 
                          <!-- start admid -->
                          <?php
						   	$sqlOv="select count(*) as cc from clinicmember where hn='$hn' ";          //check special  clinic                   
                            $resultOv=mysql_db_query($DBName,$sqlOv)
				           	or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
							$rsOv=mysql_fetch_array($resultOv);
							if ($rsOv["cc"]>0){ //cc
											$sqlClin="select n.name from clinicmember c ,clinic n where c.hn='$hn' and c.clinic=n.clinic ";                              
                           					$resultClin=mysql_db_query($DBName,$sqlClin)
				           					or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
											$rsClin=mysql_fetch_array($resultClin);echo $rsClin["name"];
											$special_clinic=$rsClin["name"];
											     if ($special_clinic<>""){
											         echo "<br>เป็นผู้ป่วยในคลินิกพิเศษ <font color=blue>$special_clinic</font>";} 
								} //$rsOv
													//start admit
													$sql_ipt="select count(*) as cc_ipt from ipt where vn='$vn' ";                              
                           							$result_ipt=mysql_db_query($DBName,$sql_ipt)
													or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
													$rs_ipt=mysql_fetch_array($result_ipt);
													if ($rs_ipt["cc_ipt"]>0){ //cc_ipt
													echo "<hr align=left width=430>";
														$sql_ipt_w="select i.*,d.bedno, r.name as room_name, w.name as ward_name ,d1.name as admdoctor_name,s.name as spclty_name ";
														$sql_ipt_w.="from ipt i,ward w,iptadm d,doctor d1,bedno b,roomno r,spclty s ";
														$sql_ipt_w.="where i.vn='$vn' and i.ward=w.ward and i.an=d.an and i.spclty=s.spclty and d.bedno=b.bedno and r.roomno=b.roomno and i.admdoctor=d1.code ";                              
	                           							$result_ipt_w=mysql_db_query($DBName,$sql_ipt_w)
					           							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
														$n_rows_ipt_w=mysql_num_rows($result_ipt_w);
														$rs_ipt_w=mysql_fetch_array($result_ipt_w);$an=$rs_ipt_w["an"];
														
														echo"&nbsp;<b><font color=black>Admission Number :</font><font color=red>".$an."</font></b><br>";
														echo"&nbsp;<font color=blue >รับ Admit  วันที่ ".dateThai($rs_ipt_w["regdate"])."&nbsp;เวลา ".$rs_ipt_w["regtime"]." น.</font>";
														echo"&nbsp;<br><font color=green>&nbsp;ผู้ป่วย Admit ที่ <b><font color=blue>".$rs_ipt_w["ward_name"]." ";
														echo $rs_ipt_w["room_name"]." แผนก ".$rs_ipt_w["spclty_name"]."</b></font>";
														echo"<br>&nbsp;ด้วยอาการสำคัญ <font color=blue>".$rs_ipt_w["prediag"]."</font>";
														echo"<br>&nbsp;แพทย์ผู้สั่ง <font color=blue>".$rs_ipt_w["admdoctor_name"]."</font></font>";
													} //rs_optt>0
													
													$sql_pdxcode="select pdx from an_stat where vn='$vn'";                              
                           													$result_pdxcode=mysql_db_query($DBName,$sql_pdxcode)
																			or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
																			$rs_pdxcode=mysql_fetch_array($result_pdxcode); 
																			$pdx_code=$rs_pdxcode["pdx"];
													$sql_pdx="select  name from icd101 where code='$pdx_code' ";                              
                           													$result_pdx=mysql_db_query($DBName,$sql_pdx)
																			or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
																			$rs_pdx=mysql_fetch_array($result_pdx); 
																			$pdx_name=$rs_pdx["name"];

													$sql_ipt_n="select  i.*,d.name as dname,dt.name as dtname,concat(h.hosptype,h.name) as hospname  from ipt i left outer  join dchstts d on i.dchstts=d.dchstts  left outer  join dchtype dt on i.dchtype=dt.dchtype  left outer join hospcode h on  h.hospcode=i.rfrolct where i.vn='$vn'  and i.dchdate is not null";                              
                           							$result_ipt_n=mysql_db_query($DBName,$sql_ipt_n)
				           							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
													$rs_ipt_n=mysql_fetch_array($result_ipt_n);
													$num_rows_ipt=mysql_num_rows($result_ipt_n);
													if($num_rows_ipt>0){
				                                  		echo "<p><font color=red><b>&nbsp;ผู้ป่วยถูกจำหน่ายแล้ว&nbsp;<a href=\"patient_dcsummery.php?vn=$vn&hn=$hn\">ดูสรุปข้อมูลผู้ป่วย(Discharge Summery)</a></b></font>";
																		echo "<br><font color=blue>&nbsp;<font color=red><b>สถานะ</b></font> ".$rs_ipt_n["dname"]." <font color=red><b>ประเภทการจำหน่าย </b></font>".$rs_ipt_n["dtname"]." ".$rs_ipt_n["hospname"]."</font>";
																		echo "<br>&nbsp;<u>วินิจฉัยสุดท้าย(Finally Diagnosis)</u><br>";
																		echo "&nbsp;<font color=red>Pdx. </font><font color=blue>".$pdx_code." </font><font color=green>".$pdx_name."</font>";
																			$sql_dx="select dx0,dx1,dx2,dx3,dx4,dx5 from an_stat where vn='$vn'  ";                              
                           													$result_dx=mysql_db_query($DBName,$sql_dx);
																			if ($result_dx){
																			$rs_dx=mysql_fetch_array($result_dx); 
																			$code_dxall="'".$rs_dx["dx0"]."' ,'".$rs_dx["dx1"]."' ,'".$rs_dx["dx2"]."' ,'".$rs_dx["dx3"]."' ,'".$rs_dx["dx4"]."' ,'".$rs_dx["dx5"]."'";
																			 		$sql_dxn="select  code, name  from  icd101 where code in ($code_dxall) " ;
						   														    $result_dxn=mysql_db_query($DBName,$sql_dxn)
				           														     or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
																				$num_rows_max = mysql_num_rows($result_dxn);
																				$i=0;
																				while($i<$num_rows_max){  
																				$rs_dxn=mysql_fetch_array($result_dxn);
																				$adm_dx=$rs_dxn["name"];
																				$adm_code=$rs_dxn["code"];
																				echo  "<br>&nbsp;<font color=red>Dx.".($i+1)."</font> <font color=blue>".$adm_code."</font> <font color=green>".$adm_dx."</font>";
																				$i++;
																				}
															}//rs_ipt_n>0
														} 
						?>
                          <hr align="left" width="430"> 
                          <!-- end admid -->
						  <!-- วันนัด -->
						  <?php 
						  	$sql_d1="select count(*) as cc from oapp where vn='$vn' ";
							$result_d1=mysql_db_query($DBName,$sql_d1)
				           	or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$rs_d1=mysql_fetch_array($result_d1);
							if($rs_d1["cc"]>0){
									$sql_d2="select *  from oapp where vn='$vn' ";
									$result_d2=mysql_db_query($DBName,$sql_d2)
				           			or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
									$n_rows_d=mysql_num_rows($result_d2);
									if ($n_rows_d>0){
									$i_d=0;
									while($i_d<$n_rows_d){
									$rs_d2=mysql_fetch_array($result_d2);
									echo "&nbsp;<font color=red>วันนัดถัดไป</font> : <font color=#0066FF>".FormatDate($rs_d2["nextdate"])."</font>";$d_code=$rs_d2["doctor"]; 						 									//วันนัด
												  	$sql_d3="select name from doctor where code='$d_code' ";
													$result_d3=mysql_db_query($DBName,$sql_d3)
				           							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
													$rs_d3=mysql_fetch_array($result_d3);
													if  ($rs_d3["name"]<>"") {
													echo "&nbsp;ผู้นัด : <font color=#0066FF>".$rs_d3["name"]."</font>"; //ผู้นัด
													echo " เพื่อ<font color=#0066FF> ".$rs_d2["app_cause"]."</font>";
													$appclinic=$rs_d2["clinic"];
													$sql_d4="select name from clinic where clinic='$appclinic' ";
													$result_d4=mysql_db_query($DBName,$sql_d4)
				           							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
													$rs_d4=mysql_fetch_array($result_d4);
												    echo "<br>&nbsp;คลินิก<font color=#0066FF> ".$rs_d4["name"]."</font>";}
									$i_d++;
									} //while
								}// n_rows_d>0								
							} //rs_d>0
						
						?>
							<!-- end วันนัด-->                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="left">&nbsp;<u>อาการสำคัญและประวัติ</u> 
                          :<br> <font color="#0066FF">&nbsp;<?php echo $opd_cc;?></font> 
                          <br> </td>
                      </tr>
                      <tr> 
                        <td colspan="2"><hr></td>
                      </tr>
                      <tr> 
                        <td align="left">&nbsp;อาการแพ้ยา :&nbsp;<font color="#0066FF"><?php echo $get_drug; ?></font><br> 
                          &nbsp;โรคประจำตัว :&nbsp;<font color="#0066FF"><?php echo $get_opd_his; ?></font><br> 
                          &nbsp;ประวัติการผ่าตัด : <font color="#0066FF"><?php echo $get_Cc_oper; ?></font ></td>
                        <td rowspan="5" align="center" valign="middle">
						 <?php 
						 $sqlPe="select  *,length(image1) as img1,length(image2) as img2 ,length(image3) as img3,length(image4) as img4,length(image5) as img5  from pe_image where vn='$vn' ";
						$resultPe=mysql_db_query($DBName,$sqlPe)
						or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
						$rsPe=mysql_fetch_array($resultPe);						
						if(mysql_num_rows($resultPe)>0){
						$allimg=array($rsPe["img1"],$rsPe["img2"],$rsPe["img3"],$rsPe["img4"],$rsPe["img5"]);
						rsort($allimg);
						$allimg=reset($allimg);
						if ($allimg<10000){$ifmht="200";}elseif(10000<$allimg and $allimg<20000){$ifmht="250";}else{$ifmht="300";}
						 echo "<iframe frameborder='0' width='150'  height='$ifmht'   align='right'   src='pe_image_ifram.php?vn=$vn&imgnum=$imgnum'> </iframe>";		
						 }?></td>
                      </tr>
                      <tr> 
                        <td><hr></td>
                      </tr>
                      <tr> 
                        <td align="left" valign="top">&nbsp;<u>Vital Sign</u> :&nbsp;<BR><font color="#0066FF">&nbsp;<?php echo $get_Vs; ?></font></td>
                      </tr>
                      <tr> 
                        <td><hr></td>
                      </tr>
                      <tr> 
                        <td align="left" valign="top">&nbsp;ตรวจร่างกาย :&nbsp;<font color="#0066FF"><?php echo  $opd_pe; ?></font><br> 
                          <?php
							if($get_cmdD<>""){
                          echo "<br> &nbsp;ผู้ตรวจ :&nbsp;<font color=#0066FF>".$get_nDoctor."</font>";
						  echo "&nbsp;&nbsp;&nbsp;&nbsp;รับคำสั่ง :&nbsp;<font color=#0066FF>".$get_cmdD."</font>"; 
                          }else{ 
						 echo "<br> &nbsp;ผู้ตรวจ :&nbsp;<font color=#0066FF>".$get_nDoctor."</font>";
						 if ($rs_ipt_w["admdoctor_name"]<>"" and $rs_ipt_w["admdoctor_name"]<>$get_nDoctor) {
						 echo "&nbsp;&nbsp;&nbsp;&nbsp;รับคำสั่ง :&nbsp;<font color=#0066FF>".$rs_ipt_w["admdoctor_name"]."</font>";   }
						   }
                          ?>                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2"><hr></td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="left">&nbsp;<u>วินิจฉัยเบื้องต้น</u> 
                          :<br> 
                          <!-- dx -->
                          <?php //start diag
						  	$sqlOvst1="select * from ovstdiag where vn='$vn' order by icd10 desc,diagtype ";
							$result=mysql_db_query($DBName,$sqlOvst1)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$num_rows_max = mysql_num_rows($result);
							if($num_rows_max==0){
								echo "<font color=#0066FF>&nbsp;- ไม่มีข้อมูล Dx<br></font>";
							}else{ //n row
								$i=0;
								while($i<$num_rows_max){
								$rs=mysql_fetch_array($result);
								$dx_icd=$rs["icd10"];$dt_name=$rs["doctor"];
										if ($dx_icd<>""){
										$sqlDxn="select name from icd101 where code='$dx_icd' ";
							        	$result_dx=mysql_db_query($DBName,$sqlDxn)
										or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
										$rs_dx=mysql_fetch_array($result_dx);
										$dx_name=$rs_dx["name"];}
										if($dt_name<>""){
										$sqlDc_n="select name from doctor where code='$dt_name' ";
							        	$result_dcn=mysql_db_query($DBName,$sqlDc_n)
										or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
										$rs_dcn=mysql_fetch_array($result_dcn);
										$dcn_name=$rs_dcn["name"];}
							     	   echo "&nbsp;<font color=red>Dx.".($i+1)."</font><font color=#0066FF>&nbsp;$dx_icd&nbsp;</font><font color=green>$dx_name</font>
									&nbsp;[<font color=blue>$dcn_name</font>]<br>";
									$i++;
								} //while
							} //e n row 
							//end diag
						  ?>
                          <!-- end dx -->                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2"><hr></td>
                      </tr>
                      <tr align="center"> 
                        <td height="34" colspan="2"><table width="600" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td width="216"  height="34" align="center" valign="top"> 
                                <?php
							//บันทึกการพยาบาล
							$sqlOpd_help="select  *  from opdscreen where vn='$vn' and (  help1='Y'  or help2='Y'  or help3='Y'  or  help4='Y' )  ";
						   	$resultOpd_help=mysql_db_query($DBName,$sqlOpd_help)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$num_row_Opd_help = mysql_num_rows($resultOpd_help);
							$rsOpd_help=mysql_fetch_array($resultOpd_help);
									if($num_row_Opd_help==0){ //a
								echo"&nbsp;<u>บันทึกการพยาบาลเบื้องต้น</u><br>";
								echo "<br>&nbsp;<font color=#0066FF>- ไม่มีบันทึกการพยาบาลเบื้องต้น</font>";}else{
								echo"<table width=200 border=0 cellpadding=0 cellspacing=0 class=bd-external>";
								echo"<tr class=headtable><td align=left background=img_mian/bgcolor2.gif>&nbsp;&nbsp;::&nbsp;บันทึกการพยาบาลเบื้องต้น</td></tr>";								
								echo "<tr><td class=text-intable align=left valign=top>";
							 if ($rsOpd_help["help1"]=='Y') {//help1
							  	 $Help1="&nbsp;- นั่งพัก วัด BP ซ้ำ เวลา ".$rsOpd_help["help1_time"]." น. ".$rsOpd_help["help1_bps"]."/".$rsOpd_help["help1_bpd"]." mmHg";
								 echo $Help1;								 
								   } //help1
							 	if ($rsOpd_help["help2"]=='Y') {//help2
							  	 $Help2="<br>&nbsp;- ส่ง Tepid Sponge วัด BT ซ้ำ เวลา ".$rsOpd_help["help2_time"]." น. ".sprintf("%.1f",$rsOpd_help["help2_temp"])." &deg;C";
								 echo $Help2;								 
								   } //help2
								   if ($rsOpd_help["help3"]=='Y') {//help3
								  $Help3drug=substr($rsOpd_help["help3_icode"], 0, strpos($rsOpd_help["help3_icode"], "."));
								  $Help3drugform=substr($rsOpd_help["help3_icode"],  strpos($rsOpd_help["help3_icode"], ".") +1); 
							  	 $Help3="<br>&nbsp;- ให้ยา ".$Help3drug." เวลา ".$rsOpd_help["help3_time"]." น. จำนวน ".$rsOpd_help["help3_qty"]." ".$Help3drugform;
								 echo $Help3;								 
								   } //help3
								   if ($rsOpd_help["help4"]=='Y') {//help4
								  $Help4="<br>&nbsp;- การช่วยเหลืออื่นๆ : ".$rsOpd_help["help4_note"] ;
								 echo $Help4;								 
								   } //help4
								echo "</td></tr></table>";
								}//a
							?>
                                <br>
							<?php 
							$sqlStaff="select  staff  from pq_screen  where vn='$vn'  ";
						   	$resultStaff=mysql_db_query($DBName,$sqlStaff)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$rsStaff=mysql_fetch_array($resultStaff);
							$Staff=$rsStaff["staff"] ;
							$sqlScreen="select  name from opduser where loginname='$Staff' ";
						   	$resultScreen=mysql_db_query($DBName,$sqlScreen)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$rsScreen=mysql_fetch_array($resultScreen);
							if  ($rsScreen["name"]<>""){
							echo "ผู้ให้การพยาบาล : <font color=#0066FF>".$rsScreen["name"]."</font>";
							}
							?>                              </td>
                              <td width="9"  align="center" valign="top"></td>
                              <td width="202"  align="center" valign="top"> 
                                <?php
							$sqlOpd_adv="select  *  from opdscreen where vn='$vn' and (  advice1='Y'  or  advice2='Y'  or  advice3='Y'  or  advice4='Y'  or  advice5='Y'  or  advice6='Y' or  advice7='Y'  )  ";
						   	$resultOpd_adv=mysql_db_query($DBName,$sqlOpd_adv)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$num_row_Opd_adv = mysql_num_rows($resultOpd_adv);
							$rsOpd_adv=mysql_fetch_array($resultOpd_adv);
									if($num_row_Opd_adv==0){ //a
								echo "<u>คำแนะนำ</u><br>&nbsp;<font color=#0066FF><br>- ไม่มีบันทึกการให้คำแนะนำ</font>";}else{
								echo"<center><table width=190 border=0 cellpadding=0 cellspacing=0 class=bd-external>";
								echo"<tr class=headtable><td align=left background=img_mian/bgcolor2.gif>&nbsp;&nbsp;::&nbsp;คำแนะนำ</td></tr>";								
								echo "<tr><td class=text-intable align=left>";
							 if ($rsOpd_adv["advice1"]=='Y') {//advice1
								 echo "&nbsp;- การให้ยา<br>";								 
								   } //advice1
							 if ($rsOpd_adv["advice2"]=='Y') {//advice2
								 echo "&nbsp;- การปฏิบัติตัวให้เหมาะสมกับโรค<br>";								 
								   } //advice2
							if ($rsOpd_adv["advice3"]=='Y') {//advice3
								 echo "&nbsp;- การรับประทานอาหาร<br>";								 
								   } //advice3
						    if ($rsOpd_adv["advice4"]=='Y') {//advice4
								 echo "- การมาตรวจตามนัด<br>";								 
								   } //advice4
						    if ($rsOpd_adv["advice5"]=='Y') {//advice5
								 echo "&nbsp;- การออกกำลังกาย<br>";								 
								   } //advice5
							 if ($rsOpd_adv["advice6"]=='Y') {//advice6
								 echo "&nbsp;- การป้องกันภาวะแทรกซ้อน<br>";								 
								   } //advice6
							 if ($rsOpd_adv["advice7"]=='Y') {//advice7
								 echo "- คำแนะนำอื่นๆ : ".$rsOpd_adv["advice7_note"]."<br>";								 
								   } //advice7
								echo "</td></tr></table></center>";
								}//a
							?>                              </td>
                              <td width="10" valign="top">&nbsp;</td>
                              <td width="163" align="center" valign="top">
							  <?php 
						   	$sql_social="SELECT * FROM opdscreen_social ";
							$sql_social.="WHERE vn = '$vn' AND ";
							$sql_social.="(depress_problem = 'Y' OR courier_problem = 'Y' OR family_problem = 'Y' OR other_problem = 'Y' OR no_problem = 'Y' OR unknown = 'Y') ";
							$result_social=mysql_db_query($DBName,$sql_social)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$rs_social=mysql_fetch_array($result_social);
									if(mysql_num_rows($result_social)==0){ //a
								echo "<u>การประเมิน จิต/สังคม</u><br>&nbsp;<font color=#0066FF><br>- ไม่มีบันทึกการประเมิน</font>";}else{
								echo"<center><table width=190 border=0 cellpadding=0 cellspacing=0 class=bd-external>";
								echo"<tr class=headtable><td align=left background=img_mian/bgcolor2.gif>&nbsp;&nbsp;::&nbsp;การประเมิน จิต/สังคม</td></tr>";								
								echo "<tr><td class=text-intable align=left>";
							 if ($rs_social["depress_problem"]=='Y') {//advice1
								 echo "&nbsp;- เครียด / วิตกกังวล<br>";								 
								   } //advice1
							 if ($rs_social["courier_problem"]=='Y') {//advice2
								 echo "&nbsp;- ปัญหาการเงิน / อาชีพ<br>";								 
								   } //advice2
							if ($rs_social["family_problem"]=='Y') {//advice3
								 echo "&nbsp;- ปัญหาครอบครัว<br>";								 
								   } //advice3
						    if ($rs_social["other_problem"]=='Y') {//advice4
								 echo "- อื่นๆ<br>";								 
								   } //advice4
						    if ($rs_social["no_problem"]=='Y') {//advice5
								 echo "&nbsp;- ไม่มีปัญหา<br>";								 
								   } //advice5
							 if ($rs_social["unknown"]=='Y') {//advice6
								 echo "&nbsp;- ประเมินไม่ได้<br>";								 
								   } //advice6
								echo "</td></tr></table></center>";
								}//a
							?></td>
                            </tr>
                        </table>
                        <br><div align="left">
						<?php
						$sql_bird_flu_screen="select * from bird_flu_screen where vn='$vn' ";
						$resultBird=ResultDB($sql_bird_flu_screen);
						if(mysql_num_rows($resultBird)<>0){
						$rsBird=mysql_fetch_array($resultBird);
						echo "&nbsp;&nbsp;<b>-></b> ผู้ป่วยได้รับการคัดกรองไข้หวัดนก";
							if($rsBird['screen1']=="Y"){echo "<br>- สัมผัสสัตว์ปีกที่ป่วย/ตาย ในช่วง 7 วันที่ผ่านมา";}
							if($rsBird['screen2']=="Y"){echo "<br>- สัมผัสผู้ป่วยปอดบวม ในช่วง 10 วันที่ผ่านมา";}
							if($rsBird['screen3']=="Y"){echo "<br>- อาศัยในหมู่บ้านมี่มีไก่ป่วย/ตาย ในช่วง 14 วันที่ผ่านมา";}
							if($rsBird['screen4']=="Y"){echo "<br>- ไม่สัมผัสกับสัตว์ปีก";}
						}
						?>
						</div></td>
                      </tr>
                      <tr valign="top"> 
                        <td colspan="2" align="left"><hr></td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="left">&nbsp; 
                          <?php  
						  //start รายการหัตถการ
							$sqlEr1="select count(*) as cr from er_regist_oper where vn='$vn' ";
							$resultEr1=ResultDB($sqlEr1);
							$rsEr1=mysql_fetch_array($resultEr1);
							if ($rsEr1["cr"] >0){
									$sqlEr2="select e1.*,e2.* from er_regist_oper e1,er_oper_code e2 where e1.vn='$vn' and e1.er_oper_code=e2.er_oper_code ";
									$resultEr2=ResultDB($sqlEr2);
									if(mysql_num_rows($resultEr2)==0){
									echo "<font color=#0066FF>&nbsp;ไม่มีข้อมูล Er<br></font>";
									}else{ //n row
									$i=0;$er_list="";echo "<u>รายการหัตการที่ ER</u> :<br>";
									while($i<mysql_num_rows($resultEr2)){
									$rsEr2=mysql_fetch_array($resultEr2);
							   				if ($er_list=="") {
											$er_list=$rsEr2["name"]; }else{
							   				$er_list=$er_list." ".$rsEr2["name"];
											} //if
										echo "&nbsp;".($i+1).".&nbsp;"."<font color=#0066FF>$er_list</font><br>";
										$i++;
									} //while
								 } //n row
								} //cr>0 //end รายการหัตถการ
							//start หัตถการทันตกรรม
							//echo $vn;
							$sqlErT1="select count(*) as ct from dtmain where vn='$vn' ";
							$resultErT1=ResultDB($sqlErT1);
							$rst1=mysql_fetch_array($resultErT1);//echo $rst1["ct"];
							//echo "หัตถการทันตกรรม :<br>";
							if ($rst1["ct"] >0){
									$sqlErT2="select d1.*,d2.* from dtmain d1,dttm d2 where d1.vn='$vn' and d1.tmcode=d2.code ";
									$resultErT2=ResultDB($sqlErT2);//echo mysql_num_rows($resultErT2);
									if(mysql_num_rows($resultErT2)==0){
									echo "<font color=#0066FF>&nbsp;ไม่มีข้อมูลหัตถการทันตกรรม<br></font>";
									}else{ //n row
									echo "<u>หัตถการทันตกรรม</u> :<br>";
									$i=0;$dental_list="";
									while($i<mysql_num_rows($resultErT2)){
									$rst2=mysql_fetch_array($resultErT2);
							   				if ($dental_list=="" or $dental_list<>"") {
												$dental_list=$rst2["name"]." ".$rst2["ttcode"];
											//}else{
							   					//$dental_list=$rst2["name"]." ".$rst2["ttcode"]; 
							   					//$dental_list=$dental_list." ".$rst2["name"]." ".$rst2["ttcode"]; 
											} //if
										echo "&nbsp;&nbsp;<font color=#0066FF>".($i+1).".&nbsp;"."$dental_list</font><br>";
										$i++;
									} //while
								 } //n row
								} //cr>0 //รายการหัตการ
								echo "<br>";
			//start  รายละเอียดการทำทันตกรรม
							$sqlDlist="select  * from dtdetail where vn='$vn' ";
							$resultDlist=ResultDB($sqlDlist);//echo mysql_num_rows($resultDlist);
							if(mysql_num_rows($resultDlist)>0){ //row
							$i=0;echo "<br>รายละเอียดการทำทันตกรรม<br>";
							while($i<mysql_num_rows($resultDlist)){ 
							$rsDlist=mysql_fetch_array($resultDlist);
							$dt_code=$rsDlist["dtcode"];
							   $sqlDtn="select name from dtdetail_name where dtcode='$dt_code' ";
								$resultDtn=ResultDB($sqlDtn);echo mysql_num_rows($resultErT2);
									$rsDtn=mysql_fetch_array($resultDtn);
									echo $rsDtn["name"];
									$i++;
								}//while
							}//row
		//end รายละเอียดการทำทันตกรรม
						?>
                          <u>รายการเวชภัณฑ์ที่ได้รับ</u>&nbsp;:<br> &nbsp; 
                          <!-- รายการเวชภัณฑ์ -->
                          <?php 
						$sql="select count(*) as cc from opitemrece where vn='$vn' ";
						$result_sd=mysql_db_query($DBName,$sql)
						or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
						$rs=mysql_fetch_array($result_sd);
						if($rs["cc"]>0){ //a
						$sqlMedi="select o.*,concat(s.name,' ',s.strength,' ',s.units) as drugname ,SUM(o.qty) as sumqty, d.shortlist  , i.displaycolor ,sp.* , ";
						$sqlMedi.="concat(sp.name1,' ',sp.name2,' ', sp.name3) as spname ";
                         $sqlMedi.="from opitemrece o ";
                         $sqlMedi.="left outer join s_drugitems s on s.icode=o.icode  ";
                         $sqlMedi.="left outer join drugusage d on d.drugusage=o.drugusage ";
                         $sqlMedi.="left outer join sp_use sp on sp.sp_use = o.sp_use  ";
                         $sqlMedi.="left outer join drugitems i on i.icode=o.icode  where o.vn='$vn' ";
						 $sqlMedi.="and o.sub_type in ('1','3') "; 
						 $sqlMedi.="group by  drugname  order by o.order_no "; 
							$result_sd=mysql_db_query($DBName,$sqlMedi)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$num_rows_max= mysql_num_rows($result_sd);
							if($num_rows_max==0){ //a
								echo "<br>&nbsp;<font color=#0066FF>ไม่มีรายการเวชภัณฑ์</font>";}else{
							//row2 ?>
                          <!-- ตารางนอก -->
                          <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
                            <tr> 
                              <td> 
                                <!-- ตารางใน -->
                                <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr class="headtable"> 
                                    <td width="38" background="img_mian/bgcolor2.gif"><div align="center">ลำดับ</div></td>
                                    <td width="269" background="img_mian/bgcolor2.gif"><div align="center">ชื่อเวชภัณฑ์</div></td>
                                    <td width="166" background="img_mian/bgcolor2.gif"><div align="center">ราคาขายต่อหน่วย</div></td>
                                    <td width="41" background="img_mian/bgcolor2.gif"><div align="center">จำนวน</div></td>
                                    <td width="86" background="img_mian/bgcolor2.gif"><div align="center">รวมเงิน</div></td>
                                  </tr>
                                  <?php
									$i=0;
									while($i<$num_rows_max){  //while2
									$rs_sd=mysql_fetch_array($result_sd);
									?>
                                  <tr class="text-intable" > 
                                    <td width="38" align="center"><?php echo ($i+1); ?></td>
                                    <td width="269"  align="left">&nbsp;<?php echo $rs_sd["drugname"];  ?></td>
                                    <td width="166"  align="right"> 
                                       
										<?php echo $rs_sd["unitprice"];?>
										<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>
										<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>
										
										</td>
                                    <td width="41" align="center">
									<?php echo $rs_sd["qty"]; ?>
									
									
									</td>
                                    <td width="86" align="center">
									
									<?php $total = $rs_sd["unitprice"] * $rs_sd["qty"]?>
									<?php echo number_format($total)?>
									
									
									
									
									</td>
                                  </tr>
                                  <?php
											$i++;
										}//while2
									?>
                                </table>
                                <!-- ปิดตารางใน -->                              </td>
                            </tr>
                          </table>
                          <!-- ปิดตารางนอก -->
                          <?php
							}//row
						}else{ echo "<br><font color=#0066FF>&nbsp;ไม่มีรายการยา</font>";}
						?>
                          <!-- end รายการเวชภัณฑ์ -->                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2"><hr></td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="left">&nbsp;<u>รายการส่งตรวจทางห้องปฏิบัติการ</u>&nbsp;: 
                          &gt;&gt; <?php echo "<a href=patient_lab_history.php?hn=$hn&vn=$vn&keyword=$keyword>ประวัติการส่งตรวจทางห้องปฏิบัติการ</a>"; ?> 
                          <br> <br> 
                          <!-- start ส่งตรวจทางห้องปฏิบัิติการ -->
                          <?php 
							$lab_order_list="";
							$sqlLab1="select * from lab_head where vn='$vn' order by order_date desc,report_date desc ";
							$result_lab1=mysql_db_query($DBName,$sqlLab1)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							
							$rs_lab1=mysql_fetch_array($result);
							$num_rows_lab1 = mysql_num_rows($result_lab1);
									
									
									if($num_rows_lab1==0){ //row1
										echo "<font color=#0066FF>&nbsp;ไม่มีข้อมูลการส่งตรวจทางห้องปฏิบัติการ<br></font>";
									}else{ //n row
									
									$i=0;
									while($i<$num_rows_lab1){ //while1
									$rs_lab1=mysql_fetch_array($result_lab1);
											if ($lab_order_list==""){
											$lab_order_list=$rs_lab1["lab_order_number"];}else{
							  				$lab_order_list=$lab_order_list.",".$rs_lab1["lab_order_number"]; } //end $lab_order_list
										$i++;
									 }	//while1
										if ($lab_order_list==""){ $lab_order_list="0"; }
																$sqlLab2="select l.*,i.lab_items_name,i.lab_items_unit,i.lab_items_normal_value,i.lab_items_code,e.staff ";
																$sqlLab2.="from lab_order l ";
																$sqlLab2.="left outer join lab_items i on i.lab_items_code=l.lab_items_code ";
																$sqlLab2.="left outer join lab_entry_log e on e.lab_order_number=l.lab_order_number ";
																$sqlLab2.="where l.lab_order_number in  (\"$lab_order_list\") and l.lab_order_result <> \"\"  group by i.lab_items_code,l.lab_order_number ";
																$sqlLab2.="order by i.display_order,i.lab_items_name "; 
																	$result_lab2=mysql_db_query($DBName,$sqlLab2)
																	or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
																	$rs_lab2=mysql_fetch_array($result);
																	$num_rows_lab2=mysql_num_rows($result_lab2);
																		if($num_rows_lab2==0){ //a
																		echo "&nbsp;ไม่มีรายการ";}else{
																		 //row2 ?>
                          <!-- ตารางนอก -->
                          <center>
                            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
                              <tr> 
                                <td> 
                                  <!-- ตารางใน -->
                                  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr class="headtable"> 
                                      <td width="46" background="img_mian/bgcolor2.gif"><div align="center">ลำดับ</div></td>
                                      <td width="197" background="img_mian/bgcolor2.gif" align="left">&nbsp;&nbsp;ชื่อการส่งตรวจ</td>
                                      <td width="126" background="img_mian/bgcolor2.gif" align="left">&nbsp;&nbsp;ผล</td>
                                      <td width="111" background="img_mian/bgcolor2.gif" align="left">&nbsp;&nbsp;ค่าปกติ</td>
                                      <td width="118" background="img_mian/bgcolor2.gif"><div align="center">ผู้รายงาน</div></td>
                                    </tr>
                                    <?php
									$date_now=date("Y-m-d G:i:s");
									$i2=0;
									$lab_order_number=$_GET["lab_order"];
									if ((seen_lab('$ip_Log','$lab_order_number')==0) and $_GET["view_hiv"]=='Y' and  $lab_order_number<>"") {
																											
									$sql="INSERT INTO `lab_restict_log` (`hn`,`lab_order_number`, `log_date_time` , `staff` )  VALUES ('$hn','$lab_order','$date_now','$ip_Log');";
										$result=mysql_db_query($DBName,$sql)
										or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error()); }

									while($i2<$num_rows_lab2){  //while2
									$rs_lab2=mysql_fetch_array($result_lab2);
									$lab_order=$rs_lab2["lab_order_number"];
								    
								?>
                                    <tr class="text-intable" > 
                                      <td width="46" align="center"><?php echo ($i2+1); ?></td>
                                      <td width="197" align="left">&nbsp;<?php echo $rs_lab2["lab_items_name"];  ?></td>
                                      <td width="126" align="left"> &nbsp;
                                          <?php
										  	
											if ($rs_lab2["confirm"]=="Y"){
											if ($rs_lab2["lab_items_code"]=="69" or $rs_lab2["lab_items_code"]=="85" or $rs_lab2["lab_items_code"]=="185" or $rs_lab2["lab_items_code"]=="189" ) {if (seen_lab($ip_Log,$lab_order)<>0) {echo $rs_lab2["lab_order_result"]." ".$rs_lab2["lab_items_unit"];}
												 else{echo "<a  href=# onClick=del('$PHP_SELF?hn=$hn&vn=$vn&lab_order=$lab_order&keyword=$keyword&view_hiv=Y')>*********</a>";}
												 }else{echo $rs_lab2["lab_order_result"]." ".$rs_lab2["lab_items_unit"];}
												}else{
												 echo "- ยังไม่รายงาน";
												}//confirm
											?>                                    
										</td>
                                      <td width="111" align="left">&nbsp;<?php echo $rs_lab2["lab_items_normal_value"]; ?></td>
                                      <td width="118" align="center"> 
                                          <?php 
												if (!$rs_lab2["staff"]==NULL){
													echo $rs_lab2["staff"]; }else{echo "-";}
												?>                 
										</td>
                                    </tr>
                                    <?php
													$i2++;
													}//while2
									?>

                                  </table>
                                  <!-- ปิดตารางใน -->                                </td>
                              </tr>
                            </table>
                          </center>
                          <!-- ปิดตารางนอก -->
                          <?php }
							} //end row1
							?>
                          <!-- end ส่งตรวจทางห้องปฏิบัิติการ -->                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2"><hr></td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="left">&nbsp;<u>รายการสรุปค่าใช้จ่าย</u>&nbsp;:<br> 
                          <!-- start รายการค่าใช้จ่าย -->
                          <?php
							$rcpt_print_list="";
							$sqlRcpt="select rcpno from rcpt_print where vn='$vn' ";
							$result=mysql_db_query($DBName,$sqlRcpt)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$rs=mysql_fetch_array($result);
							$rcpt_print_list=$rs["rcpno"];
							
							if ($rcpt_print_list<>""){
							echo"<font color=green>&nbsp;ใบเสร็จรับเงินเลขที่&nbsp;</font><font color=blue>$rcpt_print_list</font><br>";
							}//end rcpt <> 0 
							//start qurey
							
									
									$sqlUse="select i.*,c.name as income_name,p.name as paidst_name ";
									 
									 $sqlUse.="from incoth i,income c,paidst p ";
									 $sqlUse.="where i.vn='$vn' and i.income=c.income and p.paidst=i.paidst ";
									
									$result=mysql_db_query($DBName,$sqlUse)
									or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
									
									$num_rows_max = mysql_num_rows($result);
									if($num_rows_max>0){ //row ?>
                         

						  <!-- ตารางนอก -->
                          <br> <center>
                           
							<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
                              <tr> 
                                <td> 
                                  <!-- ตารางใน -->
                                  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr class="headtable"> 
                                      <td width="46" background="img_mian/bgcolor2.gif"><div align="center">ลำดับ</div></td>
                                      <td width="224" background="img_mian/bgcolor2.gif"><div align="center">ชื่อค่าใช้จ่าย</div></td>
                                      <td width="76" background="img_mian/bgcolor2.gif"><div align="center">จำนวนเงิน</div></td>
                                      <td width="149" background="img_mian/bgcolor2.gif"><div align="center">ประเภทการชำระ</div></td>
                                      <td width="103" background="img_mian/bgcolor2.gif"><div align="center">ผู้ออก</div></td>
                                    </tr>
                                    <?php
									$i=0;
									while($i<$num_rows_max){ 
									$rs=mysql_fetch_array($result);
									?>
                                    <tr class="text-intable" > 
                                      <td width="46"  align="center"><?php echo ($i+1); ?></td>
                                      <td width="224"  align="left">&nbsp;<?php echo $rs["income_name"]; ?></td>
                                      <td width="76"  align="center"><?php echo number_format($rs["rcptamt"]); ?></td>
                                      <td width="149"  align="center"><?php echo $rs["paidst_name"]; ?></td>
                                      <td width="103" align="center"><?php echo $rs["user"]; ?></td>
                                    </tr>
                                    <?php
									$i++;
									}//while ?>
                                  </table>
                                  <!-- ปิดตารางใน -->                                </td>
                              </tr>
                            </table>
                          </center>
                          <!-- ปิดตารางนอก -->
                          <?php 	}//row
							?>
                          <!-- end รายการค่าใช้จ่าย -->                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2"><hr></td>
                      </tr>
                      <tr> 
                        <td align="left">&nbsp;<u>สถานภาพปัจจุบัน</u>:&nbsp; 
                          <!-- start สถานภาพปัจจุบัน -->
                          <?php 
							$status_name="";
							$dep_name="";
							$sqlSt1="select ovstost,cur_dep from ovst where vn='$vn' ";
							$resultSt1=mysql_db_query($DBName,$sqlSt1)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$rsSt1=mysql_fetch_array($resultSt1);
							$status_name=$rsSt1["ovstost"];$dep_name=$rsSt1["cur_dep"];//echo $dep_name;
										$sqlSt2="select name from ovstost where ovstost='$status_name' ";
										$resultSt2=mysql_db_query($DBName,$sqlSt2)
										or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
										$rsSt2=mysql_fetch_array($resultSt2);
										$status_name=$rsSt2["name"]; //use
											$sqlSt3="select department from kskdepartment where depcode='$dep_name' ";
											$resultSt3=mysql_db_query($DBName,$sqlSt3)
											or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
											$rsSt3=mysql_fetch_array($resultSt3);
											$dep_n=$rsSt3["department"];//echo $dep_n;
							if ($status_name<>"") {echo "<font color=#0066FF>".$status_name."</font>";}
							if ($dep_n<>"") {echo "&nbsp;แผนก :&nbsp;<font color=#0066FF>".$dep_n."</font>";}
											$sqlSt4="select count(*) as cc from ptdepart where vn='$vn' ";
											$resultSt4=mysql_db_query($DBName,$sqlSt4)
											or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
											$rsSt4=mysql_fetch_array($resultSt4);
												if ($rsSt4["cc"]>0){
													$sqlSt5="select outtime from ptdepart where vn='$vn' order by outtime desc limit 1 ";
													$resultSt5=mysql_db_query($DBName,$sqlSt5)
													or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
													$rsSt5=mysql_fetch_array($resultSt5);
													echo " เวลา : <font color=#0066FF>&nbsp;".$rsSt5["outtime"]."</font> น."; 
												}
							?>
                          <!-- end สถานภาพปัจจุบัน -->                        </td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="center">
						<?php
						//*****************************************************************//
						//--------------------Start Review and  Approe-----------------------//
						//*****************************************************************//
							$n_Approve=Serch_datafrom_hn($hn);
							$n_app=explode("|",$n_Approve); //แยกค่าตัวแปรที่รับมาจาก fuc ด้วย | เพื่อตัดเอาแค่ชื่อ
							//echo $n_app[0].$n_app[1];
							$Dcode=cmdDoctor_code($_SESSION['ip_Log']);
							//$sqlCommandDoc="select * from ovst where vn='$vn' and (Approve_Doctor ='' or Approve_Doctor is NULL)"; //sql Appove
							$sqlCommandDoc="select * from ovst where vn='$vn'  and command_doctor='$Dcode' and (vstdate >'2005-10-01') "; //sql Appove
							$sqlCommandDoc2="select * from approve_doctor where vn='$vn'  and (vstdate >'2005-10-01')  "; //sql Review and Edit
							
							$sqlDoctor_ovst="select * from ovst where vn='$vn' ";
							$resultDoctor_ovst=ResultDB($sqlDoctor_ovst);$rsDoctor_ovst =mysql_fetch_array($resultDoctor_ovst);
						//$permission="admin"
						//***********************start  Approve**************************//
					if($submit=="Approve" and cmdDoctor($vn)<>""){//permission 1
						//if ($vn and $hn and $keyword){//ch1
						if ($vn and $hn){//ch1
							$resultCommandDoc=ResultDB($sqlCommandDoc);$rsCommandDoc =mysql_fetch_array($resultCommandDoc);
							$vstdate=$rsCommandDoc['vstdate'];$cmd_doc=$rsCommandDoc['command_doctor'];
							//echo $vstdate.$cmd_doc;
								if(mysql_num_rows($resultCommandDoc)>0){//start 1
									echo"<b>Approve</b> ผู้ตรวจ : <font color=red>$get_nDoctor</font> รับคำสั่งจาก <font color=red>".cmdDoctor($vn)."</font>";
									print"<form name='f_SendApprove' action='$PHP_SELF?#below' method='get'>";
									print"<br><table width='360' border='0' cellpadding='0' cellspacing='3' bgcolor='#FFFF99' class='bd-external'>\n";
  									print"<tr bgcolor='#FFFF00'><td colspan='2'> &nbsp;<b>Approve ผู้ป่วยชื่อ <font color='#0066FF'>$n_app[0] [ HN: $hn ]</font></b></td></tr>\n";
  									print"<tr><td colspan='2'>&nbsp;<input type='radio' name='App_Choice' value='Y' checked>&nbsp;ยืนยัน&nbsp;&nbsp;<input type='radio' name='App_Choice' value='D'>&nbsp;ยืนยัน แต่ต้องปรับปรุง&nbsp;&nbsp;<input type='radio' name='App_Choice' value='N'>&nbsp;ไม่ยืนยันการักษา/ประเมินไม่ได้</td></tr>\n";
								    print"<tr><td colspan='2'><input name='chkcomment1' type='checkbox' id='chkcomment1' value='Y'>
    ไม่มีประวัติ/ไม่สมบูรณ์&nbsp;<input name='chkcomment2' type='checkbox' id='chkcomment2' value='Y'>
    ไม่มีตรวจร่างกาย&nbsp;<input name='chkcomment3' type='checkbox' id='chkcomment3' value='Y'>
    ไม่มีวินิจฉัย <br<input name='chkcomment4' type='checkbox' id='chkcomment4' value='Y'>
  ลงวินิจฉัยไม่ถูกต้อง&nbsp;<input name='chkcomment5' type='checkbox' id='chkcomment5' value='Y'>
   รายงานไม่ถูกต้อง&nbsp;<input name='chkcomment6' type='checkbox' id='chkcomment6' value='Y'>
   รับคำสั่งไม่ถูกต้อง<br><input name='chkcomment7' type='checkbox' id='chkcomment7' value='Y'>
   ให้การรักษาไม่ถูกต้อง</td></tr>\n";
  									print"<tr><td width='121' valign='top'>&nbsp;<b>Comment : เพิ่มเติม</b></td>\n";
    								print"<td width='222' align='center' valign='top'>\n";
									print"<textarea name='comment' rows='5' cols='30' id='Txt-Field'></textarea></td></tr>\n";
  									print"<tr><td>&nbsp;</td><td>&nbsp;&nbsp;&nbsp;<input type='submit' name='Send_Comment' value='Continue' id='Button'>\n";
									print"<input type='hidden' name='vn' value='$vn'><input type='hidden' name='hn' value='$hn'>\n";
									print"<input type='hidden' name='vstdate' value='$vstdate'><input type='hidden' name='cmd_doc' value='$cmd_doc'>\n";
									print"</td></tr></table></form>\n";
							}//start1
					}//ch 1
				}////permission 1
					//**************************end Approve**********************//
					//*********************Start Review  and show Edit button****************************//
					if($permission or ($rsDoctor_ovst['command_doctor']==cmdDoctor_code($ip_Log) or $rsDoctor_ovst['doctor']==cmdDoctor_code($ip_Log)) and ($submit=="Review" or ($submit=="Edit" and $action<>"Edit")) and $Send_Comment!=="Update"){//permission 2
						if ($vn and $hn){//ch1
						$resultCommandDoc2=ResultDB($sqlCommandDoc2);//echo mysql_num_rows($resultCommandDoc2);					
							if(mysql_num_rows($resultCommandDoc2)>0){ //start 2
							$rsCommandDoc2=mysql_fetch_array($resultCommandDoc2);
							echo"<b>Review</b> ผู้ตรวจ : <font color=red>$get_nDoctor</font> รับคำสั่งจาก <font color=red>".cmdDoctor($vn)."</font>";
										//print"Review Approve ผู้ป่วยชื่อ <font color='#0066FF'>$n_app[0] [ HN: $hn ]</font><br>";
										//print "Approve เมื่อ  ".dateThai($rs_chCom_doc['Date_Appr']);
									print"<form name='f_SendEdit' action='$PHP_SELF?#below' method='get'>";
										print"<br><table width='500' border='0' cellpadding='0' cellspacing='3' bgcolor='#FFFF99' class='bd-external'>\n";
  										print"<tr bgcolor='#FFFF00'><td colspan='2'> &nbsp;<b>Review Approve ผู้ป่วยชื่อ <font color='#0066FF'>$n_app[0] [ HN: $hn ]</font></b></td></tr>\n";
											if($rsCommandDoc2['approve_doctor']=='Y'){
  												print"<tr><td colspan='2'>&nbsp;&nbsp;<img src='img_mian/icon12.gif'>&nbsp;[ยืนยันการรักษา]</td></tr>\n";
											}elseif($rsCommandDoc2['approve_doctor']=='D'){
  												print"<tr><td colspan='2'>&nbsp;&nbsp;<img src='img_mian/icon12.gif'>&nbsp;[ยืนยันการรักษา แต่มีส่วนต้องปรับปรุง]</td></tr>\n";
											}else{print"<tr><td colspan='2'>&nbsp;&nbsp;<img src='img_mian/icon12.gif'>&nbsp;[ไม่ยืนยันการรักษา/ประเมินไม่ได้]</td></tr>\n";}
  										print"<tr><td width='30' valign='top'>&nbsp;<b>Comment :</b></td>\n";
    									print"<td width='80%' align='left' valign='top'>\n";
										if ($rsCommandDoc2['chkcomment1']=="Y"){echo "[- ไม่มีประวัติ/ประวัติไม่สมบูรณ์] ";}
										if ($rsCommandDoc2['chkcomment2']=="Y"){echo "[- ไม่มีผลตรวจร่างกาย] ";}
										if ($rsCommandDoc2['chkcomment3']=="Y"){echo "[- ไม่มีวินิจฉัย] ";}
										if ($rsCommandDoc2['chkcomment4']=="Y"){echo "[- ลงวินิจฉัยไม่ถูกต้อง] ";}
										if ($rsCommandDoc2['chkcomment5']=="Y"){echo "[- รายงานไม่ถูกต้อง] ";}
										if ($rsCommandDoc2['chkcomment6']=="Y"){echo "[- รับคำสั่งไม่ถูกต้อง] ";}
										if ($rsCommandDoc2['chkcomment7']=="Y"){echo "[- ให้การรักษาไม่ถูกต้อง] ";}
										if($rsCommandDoc2['comment_appr']<>""){echo"&nbsp;".$rsCommandDoc2['comment_appr'];}else{echo "[ ไม่มี Comment ] ";}
										print "</td></tr>\n";
										if($submit=="Edit"){
										$vstdate=$rsCommandDoc2['vstdate'];$cmd_doc=$rsCommandDoc2['command_doctor'];
										print"<tr><td>&nbsp;</td><td align=left><input type='submit' name='submit' value='Edit' id='Button'>"; //show edit button
										print"<input type='hidden' name='vn' value='$vn'><input type='hidden' name='hn' value='$hn'><input type='hidden' name='action' value='Edit'>\n";
										print"<input type='hidden' name='vstdate' value='$vstdate'><input type='hidden' name='cmd_doc' value='$cmd_doc'>\n";
										print"</td></tr>\n";}
										print"</table></form><br>\n";
							}//strat 2
						}//vn,hn,keyword //ch 1
					}//permission 2
						//*****************************************************************//
						//--------------------End Review and  Approe-----------------------//
						//*****************************************************************//
											//*********************Start Edit ****************************//
						if($permission or ($rsDoctor_ovst['command_doctor']==cmdDoctor_code($ip_Log) or $rsDoctor_ovst['doctor']==cmdDoctor_code($ip_Log)) and $action=="Edit"){//permission 3
						//echo $vn.$cmd_doc;
						//sql edit approve
						$sql="select * from approve_doctor where vn='$vn' and command_doctor='$cmd_doc' ";
						$result=ResultDB($sql);
								if(mysql_num_rows($result)>0){ //row
								$rs=mysql_fetch_array($result);//echo $rs['vn'].$rs['hn']
									$vstdate=$rs['vstdate'];$cmd_doc=$rs['command_doctor'];
									echo"<b>แก้ไขการ Approve</b> ผู้ตรวจ : <font color=red>$get_nDoctor</font> รับคำสั่งจาก <font color=red>".cmdDoctor($vn)."</font>";
									print"<form name='f_SendApprove' action='$PHP_SELF?#below' method='get'>";
									print"<br><table width='360' border='0' cellpadding='0' cellspacing='3' bgcolor='#FFFF99' class='bd-external'>\n";
  									print"<tr bgcolor='#FFFF00'><td colspan='2'> &nbsp;<b>Approve ผู้ป่วยชื่อ <font color='#0066FF'>$n_app[0] [ HN: $hn ]</font></b></td></tr>\n";
  									print"<tr><td colspan='2'>"; //start radio box
									if($rs['approve_doctor']=='Y'){
									print"&nbsp;<input type='radio' name='App_Choice' value='Y' checked>&nbsp;ยืนยัน";}else{print"&nbsp;<input type='radio' name='App_Choice' value='Y'>&nbsp;ยืนยัน";}
									if($rs['approve_doctor']=='D'){
									print"&nbsp;&nbsp;<input type='radio' name='App_Choice' value='D' checked>&nbsp;ยืนยัน แต่ต้องปรับปรุง";}else{print"&nbsp;&nbsp;<input type='radio' name='App_Choice' value='D'>&nbsp;ยืนยัน แต่ต้องปรับปรุง";}
									if($rs['approve_doctor']=='N'){
									print"&nbsp;&nbsp;<input type='radio' name='App_Choice' value='N' checked>&nbsp;ไม่ยืนยันการักษา/ประเมินไม่ได้";}else{print"&nbsp;&nbsp;<input type='radio' name='App_Choice' value='N'>&nbsp;ไม่ยืนยันการักษา/ประเมินไม่ได้";}
									print"</td></tr>\n"; //end radio box
								    print"<tr><td colspan='2'>"; //start check box
									if($rs['chkcomment1']=='Y'){
									print"<input name='chkcomment1' type='checkbox' id='chkcomment1' value='Y' checked>ไม่มีประวัติ/ไม่สมบูรณ์&nbsp;";}else{print"<input name='chkcomment1' type='checkbox' id='chkcomment1' value='Y'>ไม่มีประวัติ/ไม่สมบูรณ์&nbsp;";}
									if($rs['chkcomment2']=='Y'){
									print"<input name='chkcomment2' type='checkbox' id='chkcomment2' value='Y' checked>ไม่มีตรวจร่างกาย&nbsp;";}else{print"<input name='chkcomment2' type='checkbox' id='chkcomment2' value='Y' checked>ไม่มีตรวจร่างกาย&nbsp;";}
									if($rs['chkcomment3']=='Y'){
									print"<input name='chkcomment3' type='checkbox' id='chkcomment3' value='Y' checked>ไม่มีวินิจฉัย<br>";}else{print"<input name='chkcomment3' type='checkbox' id='chkcomment3' value='Y'>ไม่มีวินิจฉัย<br>";}
									if($rs['chkcomment4']=='Y'){
									print"<input name='chkcomment4' type='checkbox' id='chkcomment4' value='Y' checked>ลงวินิจฉัยไม่ถูกต้อง&nbsp;";}else{print"<input name='chkcomment4' type='checkbox' id='chkcomment4' value='Y' >ลงวินิจฉัยไม่ถูกต้อง&nbsp;";}
									if($rs['chkcomment5']=='Y'){
									print"<input name='chkcomment5' type='checkbox' id='chkcomment5' value='Y' checked>รายงานไม่ถูกต้อง&nbsp;";}else{print"<input name='chkcomment5' type='checkbox' id='chkcomment5' value='Y'>รายงานไม่ถูกต้อง&nbsp;";}
									if($rs['chkcomment6']=='Y'){
									print"<input name='chkcomment6' type='checkbox' id='chkcomment6' value='Y' checked>รับคำสั่งไม่ถูกต้อง<br>";}else{print"<input name='chkcomment6' type='checkbox' id='chkcomment6' value='Y'>รับคำสั่งไม่ถูกต้อง<br>";}
									if($rs['chkcomment7']=='Y'){
									print"<input name='chkcomment7' type='checkbox' id='chkcomment7' value='Y' checked>ให้การรักษาไม่ถูกต้อง";}else{print"<input name='chkcomment7' type='checkbox' id='chkcomment7' value='Y'>ให้การรักษาไม่ถูกต้อง";}
									print"</td></tr>\n";//end check box
  									
									print"<tr><td width='121' valign='top'>&nbsp;<b>Comment : เพิ่มเติม</b></td>\n";
    								print"<td width='222' align='center' valign='top'>\n";
									print"<textarea name='comment' rows='5' cols='30' id='Txt-Field'>".$rs['comment_appr']."</textarea></td></tr>\n";
  									print"<tr><td>&nbsp;</td><td>&nbsp;&nbsp;&nbsp;<input type='submit' name='Send_Comment' value='Update' id='Button'>\n";
									print"<input type='hidden' name='vn' value='$vn'><input type='hidden' name='hn' value='$hn'>\n";
									print"<input type='hidden' name='vstdate' value='$vstdate'><input type='hidden' name='cmd_doc' value='$cmd_doc'>\n";
									print"</td></tr></table></form>\n";
								} //row
						}//permission 3
						//*************************end edit****************************************/
						//--------------------End Review and  Approe-----------------------//
						//*****************************************************************// */

						?>						</td>
                      </tr>
   <?php 
					  print"<tr align='center' valign='middle' bgcolor='#FFFF00'><td colspan='2'>";
                        
				 //****************Call When Send_Comment from Approve Send variable want to save in approve table**************//
				//App_Choice=Y&comment=&Send_Comment=Continue
				if($Send_Comment=="Continue" or $Send_Comment=="Update"){ //send all approve
						if(!$vn and !$hn){ //ch vn hn
							print "<h2>ระบบไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้ เนื่องจากไม่มีค่า HN และ VN</h2>";
						}else{//ch vn hn
							//ตรวจสอบก่อนว่าข้อมูลที่ vn นี้ มีอยู่ในฐานข้อมูลแล้วหรือไม่ ป้องกันการกดลิ้งหรือปุ่ม back
							$sqlChAppr="select count(*) as ch from approve_doctor where vn='$vn' ";
							$resultChAppr=ResultDB($sqlChAppr);
							$rsChAppr=mysql_fetch_array($resultChAppr);
							if($rsChAppr['ch']==0 and $Send_Comment=="Continue"){ //ch vn aready
							$d_approve=date("Y-m-d");//date an approve
							//echo $vn.$hn.$vstdate.$cmd_doc;exit();
							//SQL Save Approve
							$sqlSaveApprove="INSERT INTO approve_doctor  ";
							$sqlSaveApprove.="(vn,hn,vstdate,command_doctor,approve_doctor ,chkcomment1,chkcomment2,chkcomment3,chkcomment4,chkcomment5,chkcomment6,chkcomment7 ";
							$sqlSaveApprove.=",comment_appr,date_appr) ";
							$sqlSaveApprove.="VALUES('$vn','$hn','$vstdate','$cmd_doc','$App_Choice','$chkcomment1','$chkcomment2','$chkcomment3','$chkcomment4','$chkcomment5','$chkcomment6','$chkcomment7','$comment','$d_approve') ";
							mysql_query($sqlSaveApprove,$conn)
							or die ("<center><h2>ไม่สามารถบันทึกข้อมูลได้</h2>".mysql_error()."<br><a href=\"javascript:history.back(-1)\">Back</a></center>");
							if($keyword==''){$keyword=$hn;}
										print "<br><h2><center><font color='#0066FF'>บันทึกข้อมูลเรียบร้อยแล้ว</font></h2></center><br><font color=red>ดูข้อความที่ approve ไว้ -><a href=\"$PHP_SELF?hn=$hn&vn=$vn&keyword=$keyword&submit=Review&vstdate=$vstdate\">คลิ๊กที่นี่</a>\n";
										print "<br>กลับไปที่รายชื่อผู้ป่วยที่ต้องการ approve ต่อ -><a href=\"javascript:history.go(-2)\">คลิ๊กที่นี่</a></font><br><br>\n";
							}//end SQL Save Approve
							//SQL Save Update
							elseif($rsChAppr['ch']>0 and $Send_Comment=="Update"){
							$sqlUpApprove="UPDATE approve_doctor  ";
							$sqlUpApprove.="SET vn='$vn',hn='$hn',vstdate='$vstdate',command_doctor='$cmd_doc',approve_doctor='$App_Choice' ";
							$sqlUpApprove.=",chkcomment1='$chkcomment1',chkcomment2='$chkcomment2',chkcomment3='$chkcomment3',chkcomment4='$chkcomment4',chkcomment5='$chkcomment5',chkcomment6='$chkcomment6',chkcomment7='$chkcomment7' ";
							$sqlUpApprove.=",comment_appr='$comment',date_appr='$d_approve' where vn='$vn' ";
							mysql_query($sqlUpApprove,$conn)
							or die ("<center><h2>ไม่สามารถบันทึกข้อมูลได้</h2>".mysql_error()."<br><a href=\"javascript:history.back(-1)\">Back</a></center>");
							if($keyword==''){$keyword=$hn;}
        								print "<br><h2><center><font color='#0066FF'>แก้ไขข้อมูลเรียบร้อยแล้ว</font></h2></center><br><font color=red>ดูข้อความที่แก้ไข -><a href=\"$PHP_SELF?hn=$hn&vn=$vn&keyword=$keyword&submit=Review&vstdate=$vstdate\">คลิ๊กที่นี่</a>\n";
										print "<br>กลับไปที่รายชื่อผู้ป่วยที่ต้องการแก้ไข -><a href=\"javascript:history.go(-2)\">คลิ๊กที่นี่</a></font><br><br>\n";
							 //end SQL Save Update
							}//ch vn aready
						}//ch vn hn
				}//send all approve */
				 //********End Call When Send_Comment from Approve Send variable want to save in ovst table***********//						
				print"</td></tr>";
				 ?>				
                      <tr>
                        <td>&nbsp;</td>
                        <td align="right"><a name="below"></a>&nbsp;&nbsp; </td>
                      </tr>
                    </table></td>
                </tr>
              </table>
          </div></td>
          <td align="left" valign="top" class="td-right"><table width="160" border="0" cellpadding="0" cellspacing="0" class="bd-internal">
              <tr> 
                <td align="left"> 
                  <!-- Start histiry vn -->
                  <?php
				  //แบ่งปี
				  $vstexp=explode("-",$datevst);
				  if(!isset($year_come)){
				$year_come=$vstexp[0];}
		$sqlyear="select  YEAR(vstdate) as year_come from ovst ";
		$sqlyear.="where hn='$hn' group by  year_come order by year_come desc  ";
		$resultyear=mysql_db_query($DBName,$sqlyear)
		or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
	$num_row_year = mysql_num_rows($resultyear);
	$select_year=$year_come."%";
				  //แบ่งหน้า
	$sqlmax="select o.* from ovst o ";
		$sqlmax.="left outer join ovstist i on i.ovstist=o.ovstist ";
		$sqlmax.="where o.vstdate between '$select_year-01-01' and '$select_year-12-31'  and o.hn='$hn'  order by o.vn desc  "; 
		$resultmax=mysql_db_query($DBName,$sqlmax)
		or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
			// หาจำนวนเรกคอร์ดข้อมูล
			$num_row_max = mysql_num_rows($resultmax);
				  $start=$_GET['start'];
				 if(!isset($start)){
				$start = 0;}
			 	$limit =20;
	 if (strlen(trim($hn))==7) { //7
	 echo "<center><table width=160 border=0 cellspacing=0 cellpadding=0>
  <tr bgcolor=#99CC00>
    <td align=center class=headmenu background=img_mian/bgcolor2.gif>:: ประวัติการมา ::</td>
  </tr>
</table>";
	 echo "<b> ปี ".($year_come+543)."</b>&nbsp;,&nbsp;&nbsp;จำนวน&nbsp;";
	 echo $num_row_max." ครั้ง </center>";
//เลือกปี
echo"<center>ระบุปี ::<form name='DD'>";
echo"<Select name='DDM'  id='Txt-Field' onChange='Linkup(this.form)'>";
echo"<option value=\"$PHP_SELF?hn=$hn&vn=$ovst_vn&keyword=$keyword&year_come=$year_come&submit=$submit\">เลือกปี";
			        $y=0 ;		
					while($y<$num_row_year ){
			 		$rsYear=mysql_fetch_array($resultyear);	
					$year_came=$rsYear["year_come"];

echo"<option value=\"$PHP_SELF?hn=$hn&vn=$ovst_vn&keyword=$keyword&year_come=$year_came&submit=$submit\">".($year_came+543)."";

$y++;
					}//while $y
echo"</select>";
echo"</form></center>";
	 $sqlHis="select o.*, v.*,o.rfrolct as opdrefer, t.rfrolct as ipdrefer, a.pdx as pdx ,d.* ,d.name as dxname, c.* , c.name as cname,s.* , s.name as sname, i.name as ist_name,y.name as pttype_name from ovst o ";
		$sqlHis.="left outer join ovstist i on i.ovstist=o.ovstist ";
		$sqlHis.="left outer join pttype y on y.pttype=o.pttype ";
		$sqlHis.="left outer join vn_stat  v on v.vn=o.vn ";
		$sqlHis.="left outer join an_stat  a on a.vn=o.vn ";
		$sqlHis.="left outer join  ipt  t on t.vn=o.vn ";
		$sqlHis.="left outer join icd101 d on d.code=v.pdx ";
		$sqlHis.="left outer join icd101 c on c.code=a.pdx ";
		$sqlHis.="left outer join icd101 s on s.code=a.dx0 ";
		$sqlHis.="where v.vstdate like '$select_year'  and o.hn='$hn'   order by o.vn desc  LIMIT $start, $limit "; 
		$result=mysql_db_query($DBName,$sqlHis)
		or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
			// หาจำนวนเรกคอร์ดข้อมูล
			$num_rows = mysql_num_rows($result);
			if($num_rows<>0){
			        $i=0 ;		
					while($i<$num_rows and $i<$limit ){
			 		$rs=mysql_fetch_array($result); 
					$ovst_vn=$rs["vn"];$ovst_date=$rs["vstdate"];$ovst_time=$rs["vsttime"];
					$ovst_dxname=$rs["dxname"];$ovst_cname=$rs["cname"];$ovst_sname=$rs["sname"];
				   if ($ovst_vn==""){break;}
					if ($vn<>$ovst_vn) {
						echo "&nbsp;&nbsp;<font color=gold>>&nbsp;</font>";//.($i+1); //no
		  				echo"<font color=#CCFF00><a href=\"$PHP_SELF?hn=$hn&vn=$ovst_vn&keyword=$keyword&submit=$submit\">".FormatDate($ovst_date)."&nbsp;,&nbsp;".$ovst_time."</a><br>";		  
		  				echo"&nbsp;&nbsp;$ovst_dxname</font><br>";		  
								   if ($ovst_cname<>""){
							   	   echo "<font color=blue><B>IPD</B>(F.Dx : $ovst_cname,$ovst_sname)<br>"; }
		   
				}else{
						echo"&nbsp;<font color=\"red\">>>></font>";  //yes
      				   echo"<font color=#CCFF00><a href=\"$PHP_SELF?hn=$hn&vn=$ovst_vn&keyword=$keyword&submit=$submit\">".FormatDate($ovst_date)."&nbsp;,&nbsp;".$ovst_time."</a><br>";		 
		  				echo"&nbsp;&nbsp;$ovst_dxname</font>";
								   if ($ovst_cname<>""){
							   	   echo "<font color=red><B>IPD</B>(F.Dx : $ovst_cname,$ovst_sname)</font><br>"; }
				}
				 if ($rs["opdrefer"]<>"" or $rs["ipdrefer"]<>""){
							   	   echo "<font color=yellow><B>Refer</B></font><br>"; }
				
	        		$i++;
				} //whlie
		}else{echo "<center><font color=red>&nbsp;-></font>&nbsp;ไม่มีประวัติการมาโรงพยาบาล</center>";}//n
	}//7

	  ?>
                  <!-- end histiry vn -->
                	<br></td>
              </tr>
            </table>
<?php
		/* ตัวแบ่งหน้า */
		$page = ceil($num_row_max/$limit ); // เอา record ทั้งหมด หารด้วย จำนวนที่จะแสดงของแต่ละหน้า
		if($num_rows<>0){
		
		echo "<br><center><font color=white>Page : </font>";
		for($p=1; $p<=$page; $p++){ //for
			if($_GET['page']==$p){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้
		//if (p
			echo "<font color=red>[<a href='?start=".$limit*($p-1)."&page=$p&hn=$hn&vn=$vn&keyword=$keyword&year_come=$year_come&submit=$submit'><B>$p</B></A>]</font>"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
	   		}else{
			echo "<font color=white>[<a href='?start=".$limit*($p-1)."&page=$p&hn=$hn&vn=$vn&keyword=$keyword&year_come=$year_come&submit=$submit'>$p</A>]</font>"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
    		}
			echo "";
	     }//for
		}
?>
<!--counter -->
            <p align="center"><br><b><font color="gold">คุณเข้ามาหน้านี้ คนที่ :: <br><marquee direction="up" height="18" width="50" scrolldelay="500"  bgcolor="#FF0000"><u>
			  <?php 
			  //check file
			  if(file_exists("c_patient_record.txt")==false){
			  	$fp=fopen("c_patient_record.txt","w");fputs($fp,0);
				fclose($fp);
			  }
				
			  $filename="c_patient_record.txt";
			  $fp=fopen($filename,"r");
			  $get_number=fread($fp,filesize($filename)); //open read
			  fclose($fp);
			  
			  $get_number=$get_number+1; //sum
			  
			  $fp=fopen($filename,"w"); //open write
			  fwrite($fp,$get_number);
			  fclose($fp);
			  
			  printf("%06d",$get_number); //show
			  ?>
			  </u></marquee></font></b><br>
			  <font color="#FFFFFF">เริ่มนับเมื่อ 15-08-49</font></p>		  </td>
        </tr>
        <tr>
          <td height="16" colspan="2" align="center" valign="top" class="td-left2">
		  <?php if ($an <>"" ){ ?>
		  &nbsp;HN : <font color="red"><b><u><?php echo $hn; ?></u></b></font>
		   ชื่อ-สกุล :&nbsp;<font color="#0066FF"><?php echo $p_name; ?></font>&nbsp;
		   อายุ :&nbsp;<font color="#0066FF"><?php echo $get_Age ?></font>&nbsp; 
		   สิทธิ :&nbsp;<font color="#0066FF"><?php echo $pt_no; ?></font>
            <?php 
			if ($pt_type <>"" ){echo "&nbsp;เลขที่ :&nbsp;<font color=#0066FF>".$pt_type."</font> ";  }
			echo "<br>AN:&nbsp;<font color=red><b><u>".$an."</u></b></font><br><br>";  }
			?>			</td>
          <td height="16" valign="top" class="td-right">&nbsp;</td>
        </tr>
        <tr> 
          <td width="557" height="16" valign="bottom" background="img_mian/bgcolor2.gif" bgcolor="#3399CC"><div align="center"> 
              <font color=white>| <a href="patient_search.php">ค้นหาใหม่</a>&nbsp;|&nbsp;<a href="javascript:history.back(-1)">ย้อนกลับ</a>&nbsp;|</font></div></td>
          <td width="78" align="center" valign="top" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;<a href="#top"><img src="img_mian/arow_t.gif" width="13" height="9" border="0"></a> &nbsp;ด้านบน</td>
          <td height="16" valign="top" background="img_mian/bgcolor2.gif" bgcolor="#3399CC"><div align="right"></div></td>
        </tr>
        <tr> 
          <td height="16" colspan="2" valign="top"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="16" valign="top">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23" align="center"><?php print"<br><center>Programming : <b>จีระยุทธ ปิ่นสุวรรณ,ไอที รพ.ละแม</b> CopyRight &copy; 03-2010 <b>Lamae Hospital.</b>All right reserved</center><br>"; ?>
</td>
  </tr>
</table>
</body>
</html>
<?php } //
} //online
//echo $keyword;
 CloseDB(); //close connect db 
?>

