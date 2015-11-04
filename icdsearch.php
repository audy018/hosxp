<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
$keyword=$_POST["keyword"];
$searchby=$_POST["searchby"];
$selecttype=$_POST["selecttype"];
$search_key=$_POST["keyword"];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ค้นหา ICD10 - - |</title>
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
if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";
}else{ //on line
if  (($_SESSION["user_type"]=="online")  AND !Check_Onlines()){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";}
}
?>
<table width="800" cellpadding="0" cellspacing="0" border="0">
  <tr valign="top">
    <td>
	<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
    </td>
  </tr>
  <tr>
    <td height="24" valign="middle" background="img_mian/bgcolor.gif"><?php include("manu.inc"); ?>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top" class="td-left">
	<br>
            <table width="780" border="0" cellpadding="0" cellspacing="0" class="bd-external" id="table">
              <tr  background="img_mian/bgcolor2.gif">
                <td width="759" height="24" colspan="2" align="center" class="headmenu">ระบบค้นหาข้อมูล ICD</td>
              </tr>
              <tr>
           	<?php 
		  if($keyword==""){ //keyword
 			?>
			<td colspan="2" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="center">


				<table width="637" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="637" align="left" class="headtable">&nbsp;ระบบค้นหา ICD </td>
                    </tr>
                    <tr>
                      <td class="headtable" align="left">&nbsp;ระบรหัส ICD หรือข้อความที่ใช้ค้นหา(สามารถค้นโดยใช้ภาษาไทยได้)</td>
                    </tr>
                    <tr>
                      <td><center>
                          <form method="post" action="<?php echo $PHP_SELF ?>" name="SearchForm">
                            <table width="396" border="0" align="center" cellspacing="1" id="table">
                              <tr>
                                <td width="109" class="headtable">&nbsp;ระบุคำที่ใช้ค้นหา</td>
                                <td width="163"><input type="text" name="keyword" size="25"  id="Txt-Field"></td>
                                <td width="114"><input type="submit" value="ค้นหา"  id="Button" name="send_keyword">
                                    <input  type="reset" value="ยกเลิก" id="Button"></td>
                              </tr>
                            </table>
                            <br>
                        <span class="headtable">รูปแบบการค้นหา :</span>&nbsp;
                        <select name="searchby" id="Txt-Field">
                          <option value="whole">ค้นจากทั้งหมด</option>
                          <option value="all">ค้นจากทุกคำ</option>
                        </select>
                        การเชื่อมโยงคำค้น :&nbsp;
                        <input name="selecttype" type="radio" value="or" checked>
                        หรือ
                        <input name="selecttype" type="radio" value="and">
                        และ
                          </form>
                      </center></td>
                    </tr>
                    <tr>
                      <td align="center" class="flist"></td>
                    </tr>
                </table>
				
				
				</td>
              </tr>
			<?php 
			}else{ //keyword
			?>  
              <tr align="center" valign="top">
                <td height="16" colspan="2" class="td-left">
				<br>
<?php
if($searchby=="all"){
$keyword=explode(" ",$keyword);
$sqlicd="";
while ($val = each($keyword)){
$key=$val["value"];
if($sqlicd==""){
$sqlicd="select code,name,tname from icd101 where (code like '%".$key."%' or name like '%".$key."%' or tname like '%".$key."%')";}else{
$sqlicd=$sqlicd." ".$selecttype." (code like '%".$key."%' or name like '%".$key."%' or tname like '%".$key."%')";}
}//while
}//if searchby
else{ $sqlicd="select code,name,tname from icd101 where code like '%$keyword%' $selecttype name like '%$keyword%' $selecttype tname like '%$keyword%' "; }
//echo $sqlicd;
						$resulticd=mysql_db_query($DBName,$sqlicd)
						or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
						
						$num_icd=mysql_num_rows($resulticd);
if ($num_icd == 0){//if num
echo "<span class='headtable'>ไม่พบรหัส ICD จากคำค้นที่ระบุ</span><br><br>";
echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;  URL=icdsearch.php'>";
}else{//num
echo "<font color=white><b>คำค้น : </b></font>".show_search($keyword,$search_key);
	?>
                    <table width="740" border="0" cellspacing="0" cellpadding="0">
                      <!-- สร้างกรอบตาราง -->
                      <tr class="headtable">
                        <td width="9" align="right"><img src="img_mian/c_t_left.gif" width="8" height="16"></td>
                        <td width="38" background="img_mian/bgcolor2.gif" align="center">ลำดับ</td>
                        <td width="120" background="img_mian/bgcolor2.gif" align="center">ICD</td>
                        <td width="316" background="img_mian/bgcolor2.gif"  align="left">&nbsp;&nbsp;ชื่อ</td>
                        <td width="258" align="left" background="img_mian/bgcolor2.gif">&nbsp; ชื่อไทย </td>
                        <td width="9" align="left"><div align="right"><img src="img_mian/c_t_r.gif" width="8" height="16"></div></td>
                      </tr>
                      <tr class="flist">
                        <td height="16" colspan="6" align="center"><!-- สร้างตารางกรอบใน เพื่อแสดงข้อมูล -->
                            <table width="740" height="18" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                              <?php
					$i=0;
					while($i<$num_icd){
			 		$rsIcd=mysql_fetch_array($resulticd);
					$icdcode=$rsIcd["code"];
					$icdname=$rsIcd["name"];
					$icdtname=$rsIcd["tname"];
					if ($bg=="#FFFFFF") { //color
					$bg="#B1C3D9";
					//$bgm="";
					}else{
					$bg="#FFFFFF";
					//$bgm="img_mian/bgcolor.gif";
					} //color
					?>
                              <tr bgcolor="<?php echo $bg; ?>">
                                <td width="46" align="center"><?php echo $i+1; ?></td>
                                <td width="120" align="center"><?php echo $icdcode; ?></td>
                                <td width="309" align="left"> &nbsp;<?php echo show_search($keyword,$icdname); ?></td>
                                <td width="265" align="left" ><?php echo show_search($keyword,$icdtname); ?></td>
                              </tr>
                              <?php
	        	$i++;
		    	}//while  ?>
                            </table>
                            <!-- end table show data -->
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="bottom" bgcolor="#3399CC"><div align="left"><img src="img_mian/c_l_left.gif" width="8" height="16"></div></td>
                        <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                        <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                        <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                        <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                        <td align="left" valign="bottom" bgcolor="#3399CC"><div align="right"><img src="img_mian/c_l_r.gif" width="8" height="16"></div></td>
                      </tr>
                    </table><br>
<?php } ?>
				
				</td>
              </tr>
            <?php }//keyword?>
			</table>
	
	<br>
	</td>
  </tr>
  <tr>
    <td align="center" valign="middle" background="img_mian/bgcolor2.gif"><font color=white>| <a href="icdsearch.php">ค้นหาใหม่</a>&nbsp;|&nbsp;<a href="javascript:history.back(-1)">ย้อนกลับ</a>&nbsp;|</font> </td>
  </tr>
  <tr>
    <td align="left" valign="middle"><img src="img_mian/bn_03_2.gif" width="600" height="35"></td>
  </tr>
</table>
<?php 
CloseDB(); //close connect db 
?>
</body>
</html>
