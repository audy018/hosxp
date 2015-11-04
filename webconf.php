<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();

if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";
}else{ //on line
if  (($_SESSION["user_type"]=="online")  AND !Check_Onlines()){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>| - - - :: Setting Intranet System :: - - - |</title>
<?php
if(!$Theme){ //theme empty
?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
body {  margin: 0px  0px; padding: 0px  0px}
a:link { color: #005CA2; text-decoration: none}
a:visited { color: #005CA2; text-decoration: none}
a:active { color: #0099FF; text-decoration: none}
a:hover { color: #0099FF; text-decoration: underline}
body{font-family:MS Sans Serif;font-size:10pt}
table,td{font-family:MS Sans Serif;font-size:10pt}
form{font-family:MS Sans Serif;font-size:10pt}
-->
</style>
<?php
}else{ //theme?> 
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
} //theme
?>
<script language="javaScript">

function Linkup2()
{
var number = document.DD.chauditor.selectedIndex;
location.href = document.DD.chauditor.options[number].value;
}
function Linkup3()
{
var number = document.DD.chicdedit.selectedIndex;
location.href = document.DD.chicdedit.options[number].value;
}
function Linkup4()
{
var number = document.DD.chauditor.selectedIndex;
location.href = document.DD.chauditor.options[number].value;
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
<?php 
$icdedit=$_POST["icdedit"];
$auditor=$_POST["auditor"];
$startrev=$_POST["startrev"];
$theme=$_POST["theme"];



if(isset($HTTP_POST_VARS['Save'])=="บันทึก"){
if($opt=="main" ){
$sql_upd="update web_conf set  icdedit='$icdedit' , auditor='$auditor' ,startrev='$startrev'  ,header='$header' , theme='$theme' ";
$result_upd=mysql_db_query($DBName,$sql_upd)
and $show="บันทึกข้อมูลในตั้งค่าหลัก"; }
}//ifisset
?>
<body>

<table width="800" border="0" cellspacing="0" cellpadding="0"><a name="top"></a>
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr valign="top"> 
          <td colspan="2">
		  <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
	</td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif"><?php include("manu.inc"); ?></td>
          <td width="166" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp;</td>
        </tr>
        <tr> 
          <td width="634" height="187" valign="top" bgcolor="#B1C3D9"><div align="center"><br> 
            <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="620" valign="top"><table width="620" border="0" cellpadding="0" cellspacing="0" class="bd-external">
				<?php
				$sql_set="select  *  from web_conf";
													$result_set=mysql_db_query($DBName,$sql_set)
				           							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
												$rsSet=mysql_fetch_array($result_set);
																 ?>
                  <tr bgcolor="#99CCFF">
                    <td width="620" height="24" colspan="2" align="center" background="img_mian/bgcolor2.gif" class="headmenu"><strong>การตั้งค่าระบบ</strong></td>
                  </tr>
                  <tr valign="top">
                    <td colspan="2"><div align="center"><?php echo "<font color=red><b>$show</b></font>"; ?>   
                      <br>
										<form name='DD' action="webconf.php" method="post">
                            <table width="550" border="1" cellpadding="0" cellspacing="0">
                              <tr align="center" bgcolor="#FFFFFF" class="headmenu">
                                <td colspan="4" background="img_mian/bgcolor2.gif"></td>
                              </tr>
                              <tr align="center" bgcolor="#FFFFFF" class="headmenu">
                                <td colspan="4" background="img_mian/bgcolor2.gif"></td>
                              </tr>
                              
                              
                              
                              <tr>
                                <td colspan="2"><div align="left">&nbsp;จนท เวชสถิติ </div></td>
                                <td width="420" colspan="2">								
								&nbsp;
								<?php 
								if($_GET["icdedit"]<>""){$rsicdedit=$_GET["icdedit"];}elseif($_POST["hidicdedit"]<>""){$rsicdedit=$_POST["hidicdedit"];}else{$rsicdedit=$rsSet["icdedit"];}
								//echo "GET".$_GET["icdedit"];
								//echo "HID".$_POST["hidicdedit"];
								 if(isset($HTTP_POST_VARS["delicdedit"])){
								 $rsauditor=$_POST["auditor"];
								 $delicdedit=$_POST["icdedit"].",";
								//$rsicdedit=$_GET["icdedit"];
								 $rsicdedit=str_replace($delicdedit,"",$rsicdedit);}
								 if(isset($HTTP_POST_VARS["addicdedit"])){
								 $rsauditor=$_POST["auditor"];
								 $addicdedit=$_POST["icdedit"].",";
								
								$rsicdedit=$addicdedit.$rsicdedit;
																
								}//ifisset				
								//echo "rsicdedit".$_GET["icdedit"];
								if($_GET["auditor"]<>""){$rsauditor=$_GET["auditor"];}elseif($_POST["hidauditor"]<>""){$rsauditor=$_POST["hidauditor"];}else{$rsauditor=$rsSet["auditor"];}
								
								 if(isset($HTTP_POST_VARS["delauditor"])){
								 $rsrest_lab=$_POST["rest_lab"];
								 $rsicdedit=$_POST["icdedit"];

								 $delauditor=$_POST["auditor"].",";
								 $rsauditor=str_replace($delauditor,"",$rsauditor);}
								 if(isset($HTTP_POST_VARS["addauditor"])){
								 $rsrest_lab=$_POST["rest_lab"];
								 $rsicdedit=$_POST["icdedit"];
								$addauditor=$_POST["auditor"].",";
								$rsauditor=$addauditor.$rsauditor;
								}//ifisset				
								
								if($_GET["rest_lab"]<>""){$rsrest_lab=$_GET["rest_lab"];}elseif($_POST["hidrest_lab"]<>""){$rsrest_lab=$_POST["hidrest_lab"];}else{$rsrest_lab=$rsSet["rest_lab"];}

								 if(isset($HTTP_POST_VARS["delrest_lab"])){
								 $rsauditor=$_POST["auditor"];
								 $rsicdedit=$_POST["icdedit"];
								 
								 $delrest_lab=$_POST["rest_lab"].",";
								 $rsrest_lab=str_replace($delrest_lab,"",$rsrest_lab);}
								 if(isset($HTTP_POST_VARS["addrest_lab"])){
								 $rsauditor=$_POST["auditor"];
								 $rsicdedit=$_POST["icdedit"];
								$addrest_lab=$_POST["rest_lab"].",";
								$rsrest_lab=$addrest_lab.$rsrest_lab;
								}//ifisset				
								?> 
								<?php
													
								  $rs_icdedit=explode(",",$rsicdedit); 
								  $get_chicdedit=$_GET["chicdedit"];
																
								echo "<select name='chicdedit'  id='Txt-Field' onChange='Linkup3(this.form)'>";
								if($get_chicdedit==""){ 
								echo "<option value=''>เปลี่ยนแปลงรายชื่อ</option>";}else{
								echo "<option value='$get_chicdedit'>";
								if($get_chicdedit=="delname"){echo "ลบชื่อ";}else{echo "เพิ่มชื่อ";}
								 echo "</option>";
								}//else
								 echo "<option value='$PHP_SELF?chicdedit=addname&auditor=$rsauditor&icdedit=$rsicdedit&rest_lab=$rsrest_lab'>เพิ่มชื่อ</option>";
							  	echo "<option value='$PHP_SELF?chicdedit=delname&auditor=$rsauditor&icdedit=$rsicdedit&rest_lab=$rsrest_lab'>ลบชื่อ</option>"; 
								echo "<input type='hidden' name='hidicdedit' value='$rsicdedit'>";
								echo "<select name='icdedit' id='Txt-Field'>";
								if($get_chicdedit<>"addname"){
									
									$i=1;
									while (($icdeditval=each($rs_icdedit))  and $i< count($rs_icdedit)) {
								 $showicdedit=$icdeditval["value"];
								
								echo "<option ";
								if($get_chicdedit<>""){
								
								echo "value='$showicdedit'"; }elseif(isset($HTTP_POST_VARS["delicdedit"]) or isset($HTTP_POST_VARS["addicdedit"])){echo "value='$rsicdedit'";}else{echo "value='$rsicdedit'";}
								echo ">$showicdedit</option>";
								$i++;
								 }//while
								  }
								elseif($chicdedit=="addname"){//
								 $usersearch="'".str_replace(",","','",substr($rsicdedit, 0,-1))."'";
								 $sql_user="select  loginname  from opduser where loginname not in ($usersearch) ";
													$result_user=mysql_db_query($DBName,$sql_user)
				           							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
													$num_user=mysql_num_rows($result_user);
																													
								$i=0;
								while ($i<$num_user){
								$rsUser=mysql_fetch_array($result_user);
								$rsuser=$rsUser["loginname"];
								echo "<option>$rsuser</option>";
								$i++;
								}//while
																}//elseif
								
								 if($get_chicdedit=="delname"){echo "<input name='delicdedit' type='submit' id='Button' value='ลบชื่อ'>"; }
								   elseif($get_chicdedit=="addname"){echo "<input name='addicdedit' type='submit' id='Button' value='เพิ่มชื่อ'>"; }
								   ?>								</td>
                              </tr>
                              <tr>
                                <td colspan="2"><div align="left">&nbsp;ผู้ตรวจสอบเวชระเบียน</div></td><td colspan="2">
                                  &nbsp;
                                  <?php 
								  $rs_auditor=explode(",",$rsauditor); 
								  $get_chauditor=$_GET["chauditor"];
																
								echo "<select name='chauditor'  id='Txt-Field' onChange='Linkup4(this.form)'>";
								if($get_chauditor==""){ 
								echo "<option value=''>เปลี่ยนแปลงรายชื่อ</option>";}else{
								echo "<option value='$get_chauditor'>";
								if($get_chauditor=="delname"){echo "ลบชื่อ";}else{echo "เพิ่มชื่อ";}
								 echo "</option>";
								}//else
								 echo "<option value='$PHP_SELF?chauditor=addname&icdedit=$rsicdedit&auditor=$rsauditor&rest_lab=$rsrest_lab'>เพิ่มชื่อ</option>";
							  	echo "<option value='$PHP_SELF?chauditor=delname&icdedit=$rsicdedit&auditor=$rsauditor&rest_lab=$rsrest_lab'>ลบชื่อ</option>"; 
								echo "<input type='hidden' name='hidauditor' value='$rsauditor'>";
								echo "<select name='auditor' id='Txt-Field'>";
								if($get_chauditor<>"addname"){
									$i=1;
									while (($auditorval=each($rs_auditor))  and $i< count($rs_auditor)) {
								 $showauditor=$auditorval["value"];
								
								echo "<option ";
								if($get_chauditor<>""){
								
								echo "value='$showauditor'";}elseif(isset($HTTP_POST_VARS["delauditor"]) or isset($HTTP_POST_VARS["addauditor"])){echo "value='$rsauditor'";}else{echo "value='$rsauditor'";}
								echo ">$showauditor</option>";
								$i++;
								 }//while
								  }
								elseif($chauditor=="addname"){//
								 $usersearch="'".str_replace(",","','",substr($rsSet["auditor"], 0,-1))."'";
								 $sql_user="select  loginname  from opduser where loginname not in ($usersearch) ";
													$result_user=mysql_db_query($DBName,$sql_user)
				           							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
													$num_user=mysql_num_rows($result_user);
																													
								$i=0;
								while ($i<$num_user){
								$rsUser=mysql_fetch_array($result_user);
								$rsuser=$rsUser["loginname"];
								echo "<option>$rsuser</option>";
								$i++;
								}//while
																}//elseif
								
								 if($get_chauditor=="delname"){echo "<input name='delauditor' type='submit' id='Button' value='ลบชื่อ'>"; }
								   elseif($get_chauditor=="addname"){echo "<input name='addauditor' type='submit' id='Button' value='เพิ่มชื่อ'>"; }
								   ?>
</td>
							  </tr>
                              
                              
                              <tr>
                                <td colspan="2"><div align="left">&nbsp;วันที่เริ่ม review </div></td>
                                <td colspan="2">&nbsp;                                  <input name="startrev" type="text" id="Txt-Field" size="12" maxlength="10" 
								<?php if($rsSet["startrev"]<>"0000-00-00"){echo "value=".$rsSet['startrev'];}else{echo "value='YYYY-MM-DD'"; }?>
								> &nbsp;เช่น 2006-01-01</td>
                              </tr>
                               <tr>
							   <td colspan="2"><div align="left">&nbsp;แสดง header</div></td>
                                <td colspan="2">&nbsp;                                  <select name="header" id="Txt-Field">
								<?php if($rsSet["header"]=="" or $rsSet["header"]=="N" ){
								echo "<option value='N'>ไม่แสดง</option>";}else{
								echo "<option value='Y'>แสดง</option>";} ?>
								<option value='N'>ไม่แสดง</option>
								<option value='Y'>แสดง</option>
                                </select></td>
                              </tr>
                              <tr>
                                <td colspan="2"><div align="left">&nbsp;ธีมที่ใช้</div></td>
                                <td colspan="2">&nbsp;                                  <select name="theme" id="Txt-Field">
								<?php if($rsSet["theme"]<>""){echo "<option value='".$rsSet['theme']."'>".$rsSet['theme']."</option>";}
								//select theme from in .../hosxp1/css folder
								$path_theme="css/";
	if (file_exists("$path_theme")) {//file exis
			$dir = opendir($path_theme);
			if($dir != false){//dir
				while($file = readdir($dir)){ //while
					if(is_file($path_theme.$file))  //isfile 
					$nfile=explode(".",$file);//echo $nfile[0];
						if($nfile[0]<>""){ //file "." , ".."
            				print "<option value='$nfile[0]'>$nfile[0]</option>";
						}  //file
				} //while
			}//dir
		}//file exis
	closedir($dir);  ?>"></option>
								</select>                                </td>
								<?php } ?>
                              </tr>
                            </table>
							<br>
							<input type="submit" name="Save" value="บันทึก" id="Button">
                                        <input name="Reset" type="reset" value="ล้าง" id="Button">
						  </form>
                            <br>
                    </div></td>
					
                  </tr>
                           </table></td>
              </tr>
            </table>
            <br> <center>
              </center></td>
          <td align="center" valign="top" bgcolor="#3399CC">&nbsp;</td>
        </tr>
        <tr valign="top">
          <td height="16" align="center" background="img_mian/bgcolor2.gif">&nbsp;</td>
          <td height="16" bgcolor="#3399CC">&nbsp;</td>
        </tr>
        <tr valign="top"> 
          <td height="16"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="16">&nbsp;</td>
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
CloseDB(); //close connect db ?>
</body>
</html>
