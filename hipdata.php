<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ค้นหาสิทธิ - -</title>
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
print "<link href='css/$Theme.css' rel='stylesheet' type='text/css'>\n";
?>
<?php 
$hcid=trim($_GET['cid_search']);
$hcid=str_replace("-","",$hcid);
if($_GET["act"]){$act=$_GET["act"];}
//session_unregister("act");
if (!session_is_registered("act")) session_register("act"); 
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
<script language="javascript">
function del(varUrl) {
if (window.confirm("คุณต้องการข้อมูลจากฐานข้อมูล Hipdata?")==true) {
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
</head>
<body>
<?php
if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";
}else{ //on line
if  (($_SESSION["user_type"]=="online")  AND !Check_Onlines()){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";}
?>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr> 
          <td colspan="2" valign="top">
<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
		  </td>
        </tr>
        <tr> 
          <td width="635" height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC"><?php include("manu.inc"); ?></td>
          <td width="163" align="left" valign="bottom" background="img_mian/bgcolor.gif">
          </td>
        </tr>
        <tr> 
          <td height="610" colspan="2" valign="top" class="td-left"><div align="center">
<?php if($_SESSION["act"]=="connect"){print "<iframe src='http://ucsearch.nhso.go.th/mainpage.jsp' frameborder='0' scrolling='no' width='100%' height='50' name='nhso'></iframe>";}elseif($_SESSION["act"]=="disconnect"){print "<iframe frameborder='0' scrolling='no' name='nhso' width='100%' height='1'></iframe>";}else{print "<iframe src='nhso.php' frameborder='0' scrolling='no' width='100%' height='50' name='nhso'></iframe>";}?>		
  <br>

              <table width="544" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                <tr bgcolor="#99CCFF">
                  <td height="18" colspan="3" align="center" background='img_mian/bgcolor2.gif' class="headmenu">ข้อมูล HIP DATA</td>
			    </tr>
				<?php //if($_SESSION["act"]){
								$sql="select  *  from hipdata where cid='$hcid' ";
								$result=ResultDB($sql);
								$hipnum=mysql_num_rows($result);
								
								/*//check moi_status
								$sqlSelectMs="select moi_status from hipdata group by moi_status ";
								$resultSelectMs=ResultDB($sqlSelectMs);
								for($i=0; $i<mysql_num_rows($resultSelectMs);$i++){
								$rsMs=mysql_fetch_array($resultSelectMs);
								$moi_st=$rsMs['moi_status'];
									if(!isset($dropms)){
								$dropms="<option value=$moi_st>$moi_st</option>";}else{
								$dropms=$dropms."<option value=$moi_st>$moi_st</option>";
									}//else
									 //$dropms="<select name='msstatus'>".$dropms."</select>";
									}//for
									*/
				?>
				<tr><td height="18" colspan="3" align="center" background='img_mian/bgcolor2.gif' class="headmenu">STATUS : <?php echo $_SESSION["act"];?> <a title=คลิ๊กเพื่อเชื่อมต่อเวบไซด์์็NHSOใหม่ href="hipdata.php?act=reconnect">เชื่อมต่อกับเวบไซด์ NHSO ใหม่</a> </td>
			    </tr>
				<?php //}?>
                <tr>
                  <td align="center "></td>
                  <td align="center "></td>
                  <td align="center "></td>
                </tr>
                <tr>
                  <td height="59" colspan="3" align="center"><br>
                      <form name="f_ptSearch" action="<?php $PHP_SELF; ?>" method="get">
&nbsp;
<div align="left">เลขประจำตัวบัตรประชาชน(CID) 13 หลัก:&nbsp;
    <input type="text" name="cid_search" id="Txt-Field">
&nbsp;
            <input type="submit" name="cidbutton" value="Search" id="Button">
&nbsp;
            <input type="submit" name="cidbutton_add" value="ADD" id="Button">
                    </div>
                    </form></td>
                </tr>
                <tr>
                  <td align="center"><hr></td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                </tr>
                <tr align="center" valign="top">
                  <td><?php 
				  $cid_del=$_GET["cid_del"];
				  if($_GET['del']=="Y"){
				  $sql="delete  from hipdata where cid='$cid_del' ";
				  $result=ResultDB($sql);
				  if($result){echo "<b><font color=green size=4>ได้ทำการลบข้อมูลของ $hcid ออกจากฐานข้อมูล Hipdata เรียบร้อยแล้ว</font></b>";}
				  }
					elseif($_GET['cidbutton']=="Search" and $_GET['cid_search'] and $_GET['up_buttom']<>"Update"){ //check buttom and text
						//$hcid=trim($_GET['cid_search']);
						if(!is_numeric($hcid) or strlen($hcid)<> 13){ //create table
								echo"<b><font color=red size=4>CID ที่กรอกไม่ใช่ตัวเลข หรือ รหัส CID ไม่เท่ากับ 13 หลัก</font></b>";
						}else{//create
						//sql
								$sql="select  *  from hipdata where cid='$hcid' ";
								$result=ResultDB($sql);
								$hipnum=mysql_num_rows($result);
								if($hipnum==0){//n row
									echo"<b><font color=red size=4>CID : $hcid ไม่มีในฐานข้อมูล HIP DATA</font></b>";
									echo"<br><a href='$PHP_SELF?cid_search=$hcid&cidbutton_add=ADD'><b><font color=green size=4>ต้องการเพิ่ม CID นี้ลงในฐานข้อมูล HIP DATA</font></b></a>";
									}else{ //n row
									$rs=mysql_fetch_array($result);
									//echo strlen($rs['birthdate']);
				?>
                      <form name="f_UpHip" action="<?php $PHP_SELF; ?>" method="get">
                        <table width="418" border="0" cellspacing="3" cellpadding="2" id="table">
                          <tr align="center">
                            <td colspan="2" class="headtable">สิทธิจาก HIP DATA [ CID: <font color="red"><b><?php echo $rs['cid']; ?></b></font> ]</td>
                          </tr>
                          <tr>
                            <td>&nbsp;ชื่อ-สกุล</td>
                            <td>&nbsp;
                                <input name="fname" type="text" disabled   id="Txt-Field" value="<?php echo $rs['fname']; ?>" size="20">
                                <input name="lname" type="text" disabled   id="Txt-Field" value="<?php echo $rs['lname']; ?>" size="20"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;วัน/เดือน/ปี เกิด </td>
                            <td>&nbsp;
                                <input name="birthdate" type="text"  id="Txt-Field"  value="<?php if(strlen($rs['birthdate'])==10){echo FormatDate($rs['birthdate']);} ?>" size="10">
&nbsp; ตย. 05-09-2549 </td>
                          </tr>
                          <tr>
                            <td>&nbsp;ที่อยู่</td>
                            <td>ที่
                                <input name="addr" type="text"  id="Txt-Field"  value="<?php echo $rs['address']; ?>" size="5">
&nbsp; หมู่
              <input name="moo" type="text"  id="Txt-Field"  value="<?php echo $rs['moo']; ?>" size="5">
&nbsp; ตำบล              
<select name="select">
  <?php if($rs['tambon']<>""){echo list_tambon($rs['tambon']);}else{echo list_tambon1($Province,$Ampor);}?>
</select></td>
                          </tr>
                          <tr>
                            <td width="126">&nbsp;รหัสสิทธิ</td>
                            <td width="275">&nbsp;
								<select name="mstatus"><?php echo list_moi($rs['moi_status']);?></select>
&nbsp; <font color="#FF0000">*</font> </td>
                          </tr>
                          <tr>
                            <td>&nbsp;เลขที่</td>
                            <td>&nbsp;
                                <input name="cardid" type="text"  id="Txt-Field"  value="<?php echo $rs['cardid']; ?>" size="20">
                                <font color="#FF0000">*</font></td>
                          </tr>
                          <tr>
                            <td>&nbsp;วันที่เริ่มใช้</td>
                            <td>&nbsp;
                                <input name="date_in" type="text"  id="Txt-Field"  value="<?php if(strlen($rs['datein'])==10){echo FormatDate($rs['datein']);} ?>" size="10">
                                <font color="#FF0000">* </font>ตย. 05-09-2549</td>
                          </tr>
                          <tr>
                            <td>&nbsp;วันหมดอายุ</td>
                            <td>&nbsp;
                                <input name="dateexp" type="text"  id="Txt-Field" value="<?php if(strlen($rs['dateexp'])==10){echo FormatDate($rs['dateexp']);} ?>" size="10">
&nbsp;<font color="#FF0000">*</font>ตย. 05-09-2549</td>
                          </tr>
                          <tr>
                            <td>&nbsp;รหัสสถานพยาบาลหลัก</td>
                            <td>&nbsp;
                                <input name="hospmain" type="text"  id="Txt-Field"  value="<?php echo $rs['hospmain']; ?>" size="10">
                                <font color="#FF0000">*</font></td>
                          </tr>
                          <tr>
                            <td>&nbsp;รหัสสถานพยาบาลสำรอง</td>
                            <td>&nbsp;
                                <input name="hospsub" type="text"  id="Txt-Field"  value="<?php echo $rs['hospsub']; ?>" size="10">
                                <font color="#FF0000">*</font></td>
                          </tr>
                          <tr>
                            <td>&nbsp;รหัสสถานพยาบาล (off id) </td>
                            <td>&nbsp;
                                <input name="off_hosp" type="text"  id="Txt-Field"  value="<?php echo $rs['off_id']; ?>" size="10"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;
                                <input type="submit" name="up_button" value="Update" id="Button">
                                <INPUT TYPE="button" VALUE="Delete" onClick=del('<?php $PHP_SELF?>?del=Y&cid_del=<?php echo $rs['cid']; ?>') id="Button">
                                <input type="hidden" name="cid_hid" value="<?php echo $rs['cid']; ?>" id="Button">
                            </td>
                          </tr>
                        </table>
                      </form>
                      <?php
								}//n row
							} //end create table
					}else{ //check buttom and text
							//check buttom update
							if($_GET['up_button']=="Update"){
								//echo $fname,$lname.$birthdate.$addr,$moo,$tambon.$cid_hid.$mstatus.$cardid.$date_in.$dateexp.$hospmain.$hospsub.$off_hosp;
								if(strlen($birthdate)<>10){die("<b><font color=red size=4>รูปแบบวันเกิด ไม่ถูกต้องครับ</font></b><br><a href='javascript:history.back(-1)'>ย้อนกลับ</a>");}
								if(strlen($date_in)<>10){die("<b><font color=red size=4>รูปแบบวันที่เริ่มใช้ ไม่ถูกต้องครับ</font></b><br><a href='javascript:history.back(-1)'>ย้อนกลับ</a>");}
								if(strlen($dateexp)<>10){die("<b><font color=red size=4>รูปแบบวันหมดอายุ ไม่ถูกต้องครับ</font></b><br><a href='javascript:history.back(-1)'>ย้อนกลับ</a>");}
								if(!$mstatus || !$date_in || !$dateexp || !$hospmain || !$hospsub || !$off_hosp){ //ch variable empty
									echo"<b><font color=red size=4>กรอกข้อมูลไม่ครบทุกช่อง ครับ</font></b><br><a href='javascript:history.back(-1)'>ย้อนกลับ</a>";}else{ //ch variable empty
								$b_date=FormatDate2($birthdate);$in_date=FormatDate2($date_in);$exp_date=FormatDate2($dateexp);
								//echo "<br>".$b_date.$in_date.$exp_date;
								//exit();
								$sqlUpHip="UPDATE hipdata SET ";
								$sqlUpHip.="cardid='$cardid',birthdate='$b_date',datein='$in_date',dateexp='$exp_date',hospmain='$hospmain',hospsub='$hospsub',  ";
								$sqlUpHip.="address='$addr',moo='$moo',tambon='$tambon',off_id='$off_hosp',moi_status='$mstatus' ";
								$sqlUpHip.="WHERE cid='$cid_hid' ";
								mysql_query($sqlUpHip)
									and $addsuccess="Y";
								echo "<font color=red><h2>บันทึกข้อมูลเรียบร้อยแล้ว</h2></font><br><a href=".$PHP_SELF."?cid_search=$cid_hid&cidbutton=Search>ดูข้อมูลที่บันทึก</a>&nbsp;<a href=".$PHP_SELF.">ทำรายการใหม่</a>";
								} //ch variable empty
							}else{ //check buttom update
								//echo"<b><font color=red size=4>กรอกรหัส CID ที่ต้องการด้วย ครับ</font></b>";
								if($_GET['cidbutton_add']=="ADD" or $_GET['save_button']=="Save"){}else{echo"<b><font color=red size=4>กรอกรหัส CID ที่ต้องการค้นหาหรือแก้ไขใน HIP DATA และกด search</font></b>";}
							}//check buttom update
					} //check buttom and text
					?>
                  </td>
                  <td>&nbsp;</td>
                  <td rowspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><?php 
					  $sqlSelectPt="select * from patient  where cid='$hcid' ";
								$resultSelectPt=ResultDB($sqlSelectPt);
								$rsPt=mysql_fetch_array($resultSelectPt);
								$Ptnum=mysql_num_rows($resultSelectPt);
		if(($_GET['cidbutton']=="Search" or $_GET['cidbutton_add']=="ADD") and $_SESSION["act"]=="connect" ){echo "<iframe src='http://ucsearch.nhso.go.th/pid_search.jsp?pid=$hcid&data_location=30' width='925'   frameborder='0'  vspace='-120' hspace='-199' height='625' scrolling='yes' ></iframe>";} ?></td>
                    </tr>
                  </table></td>
                </tr>
                <tr align="center">
                  <td></td>
                  <td></td>
                </tr>
                <tr align="center">
                  <td><?php
						//ADD
						if($_GET['cidbutton_add']=="ADD" and $_GET['cid_search']){//add
							//ch text box when click button add cid_search=&cidbutton=ADD
							$hcid=str_replace("-","",$hcid);
							$hcid=trim($_GET['cid_search']);
							if(!is_numeric($hcid) or strlen($hcid)<> 13){ //ch cid
								echo"<b><font color=red size=4>CID ที่กรอกไม่ใช่ตัวเลข หรือ รหัส CID ไม่เท่ากับ 13 หลัก</font></b>";
							}else{//start create ch cid
								//ch cid in database
								if($hipnum>0){
									echo"<b><font color=red size=4>รหัส CID นี้มีอยู่แล้วในฐานข้อมูล กรุณาระบุรหัส CID ใหม่อีกครั้ง</font></b>";
								}else{//ch cid in database
								//create table
								//check in patient
								//if($Ptnum>0){
									?>
                      <form name="f_SaveHip" action="<?php $PHP_SELF; ?>" method="get">
                        <table width="427" border="0" cellspacing="3" cellpadding="2" id="table">
                          <tr align="center">
                            <td colspan="2" class="headtable">สิทธิของ HIP DATA [ CID: <font color="red"><b><?php echo $hcid; ?></b></font> ]</td>
                          </tr>
                          <tr>
                            <td>&nbsp;ชื่อ-สกุล</td>
                            <td>&nbsp;
                                <input name="fname" type="text" id="Txt-Field" size="20" value="<?php echo $rsPt["fname"]; ?>">
                                <input name="lname" type="text" id="Txt-Field" size="20" value="<?php echo $rsPt["lname"]; ?>"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;วัน/เดือน/ปี เกิด </td>
                            <td>&nbsp;
                                <input name="birthdate" type="text"  id="Txt-Field"  size="10" value="<?php if($rsPt["birthday"]){echo FormatDate($rsPt["birthday"]);}else{echo "00-00-0000";} ?>">
&nbsp; <font color="#FF0000">*</font>ตย. 05-09-2549 </td>
                          </tr>
                          <tr>
                            <td>&nbsp;ที่อยู่</td>
                            <td>ที่
                                <input name="addr" type="text"  id="Txt-Field"  size="14" value="<?php echo $rsPt["addrpart"]; ?>">
&nbsp; ม.                                <input name="moo" type="text"  id="Txt-Field"  size="5" value="<?php if($rsPt["moopart"]){echo $rsPt["moopart"];}else{echo "-";} ?>">
 ตำบล.
 <select name="tambon">
   <?php echo list_tambon1($Province,$Ampor);?>
 </select></td>
                          </tr>
                          <tr>
                            <td width="127">&nbsp;รหัสสิทธิ</td>
                            <td width="336">&nbsp;

&nbsp;
<select name="mstatus">
  <?php echo list_moi($mstatus);?>
</select> </td>
                          </tr>
                          <tr>
                            <td>&nbsp;เลขที่</td>
                            <td>&nbsp;
                                <input name="cardid" type="text"  id="Txt-Field"  size="20" value="<?php echo $cardid; ?>">
                            </td>
                          </tr>
                          <tr>
                            <td>&nbsp;วันที่เริ่มใช้</td>
                            <td>&nbsp;
                                <input name="date_in" type="text"  id="Txt-Field"  size="10" value="<?php if($date_in){echo $date_in;}else{echo "00-00-0000";} ?>">
                                <font color="#FF0000">*</font>ตย. 05-09-2549</td>
                          </tr>
                          <tr>
                            <td>&nbsp;วันหมดอายุ</td>
                            <td>&nbsp;
                                <input name="dateexp" type="text"  id="Txt-Field" size="10" value="<?php if($dateexp){echo $dateexp;}else{echo "00-00-0000";} ?>">
&nbsp;<font color="#FF0000">*</font>ตย. 05-09-2549</td>
                          </tr>
                          <tr>
                            <td>&nbsp;รหัสสถานพยาบาลหลัก</td>
                            <td>&nbsp;
                                <input name="hospmain" type="text"  id="Txt-Field"  size="10" value="<?php echo $hospmain; ?>">
                            </td>
                          </tr>
                          <tr>
                            <td>&nbsp;รหัสสถานพยาบาลสำรอง</td>
                            <td>&nbsp;
                                <input name="hospsub" type="text"  id="Txt-Field" size="10" value="<?php echo $hospsub; ?>">
                            </td>
                          </tr>
                          <tr>
                            <td>&nbsp;รหัสสถานพยาบาล (off id) </td>
                            <td>&nbsp;
                                <input name="off_hosp" type="text"  id="Txt-Field"  size="10" value="<?php echo $off_hosp; ?>"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;
                                <input type="submit" name="save_button" value="Save" id="Button">
                                <input type="hidden" name="cid_hid" value="<?php echo $hcid; ?>" id="Button">
                            </td>
                          </tr>
                        </table>
                      </form>
                      <?php
					//  }//if pt
					  //else{echo"<b><font color=red size=4>โปรดตรวจสอบว่า CID นี้มีการลงทะเบียนผู้ป่วยแล้ว หรือผู้ป่วยได้บันทึก CID แล้ว</font></b>";}
								//end create  table
								}//ch cid in database
							}//ch cid
						}else{//add
								//echo"<b><font color=red size=4>กรอกรหัส CID ที่ต้องการเพิ่มใน HIP DATA ด้วยครับ</font></b>";
								if($_GET['cidbutton']=="Search" or $_GET['save_button']=="Save"){}else{echo"<b><font color=red size=4>กรอกรหัส CID ที่ต้องการเพิ่มใน HIP DATA และกด ADD</font></b>";}
						}//add end
						
				//Start Save 
				if($_GET['save_button']=="Save"){//button save
								//echo $fname,$lname.$birthdate.$addr,$moo,$tambon.$cid_hid.$mstatus.$cardid.$date_in.$dateexp.$hospmain.$hospsub.$off_hosp;
								if(!$cid_hid || !$fname || !$lname || !$birthdate || !$cardid || !$date_in || !$dateexp || !$hospmain || !$hospsub || !$off_hosp || !$mstatus || !$addr || !$moo || !$tambon){ //ch variable empty
								$nhsoinfo=array("เลขประจำตัวประชาชน"=>$cid_hid, "ชื่อ"=>$fname, "นามสกุล"=>$lname, "วันเกิด"=>$birthdate, "เลขที่บัตร"=>$cardid, "วันออกบัตร"=>$date_in, "วันหมดอายุ"=>$dateexp, "สถานพยาบาลหลัก"=>$hospmain, "สถานพยาบาลรอง"=>$hospsub, "สถานพยาบาลที่ลงทะเบียน"=>$off_hosp, "ประเภทสิทธิ"=>$mstatus, "ที่อยู่"=>$addr, "หมู่"=>$moo, "ตำบล"=>$tambon);
									echo"<b><font color=red size=4>".msg_chk_complete($nhsoinfo)."</font></b><br>";
									echo"<a href='$PHP_SELF?cid_search=$cid_hid&fname=$fname&lname=$lname&birthdate=$birthdate&addr=$addr&moo=$moo&tambon=$tambon&cid_hid=$cid_hid&mstatus=$mstatus";
									echo"&cardid=$cardid&date_in=$date_in&dateexp=$dateexp&hospmain=$hospmain&hospsub=$hospsub&off_hosp=$off_hosp&cidbutton_add=ADD'>ย้อนกลับ</a>";
								}else{ //ch variable empty
								$b_date=FormatDate2($birthdate);$in_date=FormatDate2($date_in);$exp_date=FormatDate2($dateexp);
								//echo "<br>".$b_date.$in_date.$exp_date;
								//exit();
								//next complete ทำต่อ บันทึกข้อมูล แก้ sql
								
								$sqlInsHip="INSERT INTO `hipdata` ( `cid` , `cardid` , `fname` , `lname` , `birthdate` , `datein` , `dateexp` , `hospmain` , `hospsub` , `address` , ";
								$sqlInsHip.=" `moo` , `tambon` , `off_id` , `moi_status` , `pname` , `sex` , `typecode` , `pttype` , `mtext` , `subtype` , `nation` , `occupa` , `road` , ";
								$sqlInsHip.=" `zipcode` , `homeid` ) VALUES ( '$cid_hid' , '$cardid' , '$fname' , '$lname' , '$b_date' , '$in_date' , '$exp_date' , '$hospmain' , '$hospsub' , ";
								$sqlInsHip.=" '$addr' , '$moo' , '$tambon' , '$off_hosp' , '$mstatus' , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL) " ;
								
								/*$sqlUpHip="UPDATE hipdata SET ";
								$sqlUpHip.="fname='$fname',lname='$lname', ";
								$sqlUpHip.="cardid='$cardid',birthdate='$b_date',datein='$in_date',dateexp='$exp_date',hospmain='$hospmain',hospsub='$hospsub',  ";
								$sqlUpHip.="address='$addr',moo='$moo',tambon='$tambon',off_id='$off_hosp',moi_status='$mstatus' ";
								$sqlUpHip.="WHERE cid='$cid_hid' ";
								mysql_query($sqlUpHip)
								*/
								mysql_query($sqlInsHip)
									or die("Don't Update Database".mysql_error());
								echo "<font color=red><h2>บันทึกข้อมูลเรียบร้อยแล้ว</h2></font><br><a href=".$PHP_SELF."?cid_search=$cid_hid&cidbutton=Search>ดูข้อมูลที่บันทึก</a>&nbsp;<a href=".$PHP_SELF.">ทำรายการใหม่</a>";
								} //ch variable empty
						}//button save
				//end Save
						?>
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
          </div>            <br>
            <br></td>
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
//close connection
CloseDB(); //close connect db ?>
</body>
</html>
