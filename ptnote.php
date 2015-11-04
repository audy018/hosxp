<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ข้อมูลเฉพาะผู้ป่วย - - |</title>
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
<table width="325" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="14"><?php
if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";
}else{ //on line
if  (($_SESSION["user_type"]=="online")  AND !Check_Onlines()){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";}
		?></td>
    <td width="298">&nbsp;</td>
    <td width="13">&nbsp;</td>
  </tr>
  <tr>
  <?php 
  $sql="select  n.ptnote as ptnote,n.vstdate as notedate, concat(p.pname,p.fname,'  ',p.lname) as ptname from  patient p left outer join ptnote n on p.hn=n.hn where p.hn='$hn' ";          //check special  clinic                   
  $result=mysql_db_query($DBName,$sql)
  or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
  $rs=mysql_fetch_array($result);
 
  ?>
    <td>&nbsp;</td>
    <td align="center"><font color="red"><b>ข้อมูลเฉพาะผู้ป่วย</b></font> <font color="#0000FF"><?php echo $rs["ptname"]." ".$hn."</font>" ?> </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo $rs["ptnote"];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><?php echo "บันทึกเมื่อ <font color=blue>".FormatDate($rs["notedate"])."</font>";?></td>
    <td><?php }//
CloseDB(); //close connect db ?></td>
  </tr>
</table>
</body>
</html>
