<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();

if (!$_SESSION["ip_Log"]  and !Check_Online(get_ip())) { //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";
}else{ //on line
if  (($_SESSION["user_type"]=="online")  and !Check_Onlines()){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";}
 ?>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - รูปแสดงสรุปข้อมูล - -</title>
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
<?php
$vstdate=$_GET['vstdate'];
$grpid=$_GET['grpid'];
$grp_dsc=$_GET['grp_dsc'];
$grptime=time();

//exmple
include("grpsql.php");
//example

//qeury for table
  $result = mysql_db_query($DBName,$sql)
or die("sorry,can't show any information".mysql_error());
$numfield=mysql_num_fields($result);
$num_rows_max=mysql_num_rows($result);
//end qeury
 if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} 
echo "
<HTML>
<BODY bgcolor='#FFFFFF'>
"
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bdmain">
<tr align="center" bgcolor="#B1C3D9">
  <td height="16" colspan="3"><?php include("manu.inc"); ?>  </td>
  <td height="16" align="center" valign="top"></td>
</tr>
<tr align="center" bgcolor="#B1C3D9">
  <td height="16" colspan="3">&nbsp;</td>
  <td height="16" align="center" valign="top"></td>
</tr>
<tr bgcolor="#B1C3D9"><td width="1%">&nbsp;</td>
    <td width="77%" align="center"><a name="top" id="top"></a>      <?php
	
		//table
		if ($c==""){$c="1";}
$table="<table border='1'  cellspacing='0' cellpadding='0'>";
$table= $table."<tr>";
foreach ($tablehead  as $headtable) {
$table=$table."<th bgcolor=#0099FF><font size='2' color=white>&nbsp;".$headtable."&nbsp;</font>";
}
$ct="";
while ($rs=mysql_fetch_array($result)) {
$maxlen[ ]=$rs["maxlen"];
$table=$table."<tr>";
for ($i=$c;$i<$numfield;$i++) {
if ($rs[$i]==$rs["dy"]) { $rs[$i]=number_format($rs[$i]);}
if ($rs[$i]==$rs["percent"]) { $rs[$i]=number_format($rs[$i],2);}
$table=$table."<td><font size='2'><div align='center'>".$rs[$i]."</div></font></td>";
if ($ct=="") {$ct=$rs["dy"];}else
{$ct=($ct+$rs["dy"]);}
}
}

$sum=$ct/($numfield-$c);
$table=$table."<tr>";
for ($i=($c+3);$i<$numfield;$i++) {$table=$table."<td></td>";}
$table=$table."<td><div align=center><font color=red><b>รวม</b></font></div></td><td><div align=center><font color=red><b>".number_format($sum)."</td>" ;
$table=$table."<td><div align=center><font color=red><b>".number_format(($sum/$total)*100)."</td>";
$table=$table."</table>";

$maxlen=max($maxlen);
//for column
if ($chart_type=="column" or $chart_type=="line") {//b
$lc=($maxlen*$num_rows_max);
//echo "lC".$lc;
if ( $lc<=70) {//c
$chart_font=floor(19-(0.12*$lc));
$chart_width="500";
}//c
else{//d
$chart_width=ceil(7.4*$lc);
$chart_font="12";
}//d
}//b
else{
$chart_width="500";
$chart_font="16";
}
$flash_width=($chart_width+100);
$vstdate=str_replace('%','%25',$vstdate);

$tablename="<font size=3><b>รูปแสดง".$grp_dsc."</b></font><br>";
if  ($vstdate<>"" and (strlen($vstdate)==10)  ) { $tablename=$tablename."วันที่ ".dateThai($vstdate);}else{
$tablename=$tablename."เดือน" .dateThai($vstdate);} 
if ($flash_width>=680){echo "<div align='center'>".$tablename."<a href='#graph'>(ดูตาราง)</a></div>";}

echo "<OBJECT classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'
	codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' 
	WIDTH='$flash_width' 
	HEIGHT='450' 
	id='charts' 
	ALIGN=''>
<PARAM NAME=movie VALUE='charts.swf?library_path=charts_library&xml_source=sample.php%3Ftime%3D$grptime%26vstdate%3D$vstdate%26grpid%3D$grpid%26chart_width%3D$chart_width%26chart_font%3D$chart_font'>
<PARAM NAME=quality VALUE=high>
<PARAM NAME=bgcolor VALUE=#666666>

<EMBED src='charts.swf?library_path=charts_library&xml_source=sample.php%3Ftime%3D$grptime%26vstdate%3D$vstdate%26grpid%3D$grpid%26chart_width%3D$chart_width%26chart_font%3D$chart_font'
       quality=high 
       bgcolor=#666666  
       WIDTH='$flash_width' 
       HEIGHT='450' 
       NAME='charts' 
       ALIGN='' 
       TYPE='application/x-shockwave-flash' 
       PLUGINSPAGE='http://www.macromedia.com/go/getflashplayer'>
</EMBED>
</OBJECT>";
?>    </td>
    <td width="1%" align="left">&nbsp;	</td>
    <td width="21%" align="center" valign="top"><?php 


if ($flash_width <680) {echo "<div align='Center'>".$tablename."</div><br>";
echo $table;}


//$maxlen="4";

//end table
	?></td>
</tr>
<tr bgcolor="#B1C3D9">
  <td colspan="2">&nbsp;</td>
  <td align="left">&nbsp;</td>
  <td align="left">&nbsp;</td>
</tr>
<tr bgcolor="#B1C3D9">
  <td colspan="2" align="center"><a name="graph" id="graph"></a>    <?php if ($flash_width >=650) {echo $table."&nbsp;<a href='#top'><img src='img_mian/arow_t.gif' width='13' height='9' border='0'></a>&nbsp;ด้านบน";}?></td>
  <td colspan="2" align="left">&nbsp;</td>
</tr>
</table>
<?php 
echo "
</BODY>
</HTML>";
}//online
CloseDB(); 

?>
</html>