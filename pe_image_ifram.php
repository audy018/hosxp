<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ภาพขยาย - - |</title>
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

function popup(popupfile,winheight,winwidth,scrollbars)
{
open(popupfile,"PopupWindow","resizable=no,height=" + winheight + ",width=" + winwidth + ",scrollbars="+scrollbars+"");
}

</script>
</head>
<body>
<div align="center">
<?php 
$vn=$_GET["vn"];
$imgnum=$_GET["imgnum"];
if ($imgnum==''){$imgnum="1";}else{$imgnum=$imgnum;}
						  $sqlPe="select  *  from pe_image where vn='$vn' ";
						$resultPe=ResultDB($sqlPe);
						$rsPe=mysql_fetch_array($resultPe);//echo $rsPe['cc'];
						if(mysql_num_rows($resultPe)>0){
						if ($rsPe["image5"]<>"") {$imgall="5";}
						elseif($rsPe["image4"]<>"") {$imgall="4";}
						elseif($rsPe["image3"]<>"") {$imgall="3";}
						elseif($rsPe["image2"]<>"") {$imgall="2";}
						elseif($rsPe["image1"]<>"") {$imgall="1";}
						if (($imgnum-1)<>"0"){ echo "<a href='$PHP_SELF?vn=$vn&imgnum=".($imgnum-1)."'><<</a>";}
							if ($imgall>1){echo " $imgnum/$imgall ";}
							if ($imgnum<$imgall){ echo "<a href='$PHP_SELF?vn=$vn&imgnum=".($imgnum+1)."'>>></a>";}
						echo "<a title=คลิ๊กเพื่อดูรูปขยาย href=javascript:popup(\"get_pe_image.php?vn=$vn&imgnum=$imgnum\",260,340,1)>
						<img align='absmiddle' src=\"get_pe_image.php?vn=$vn&imgnum=$imgnum\"  width=\"120\"  vlign=\"middle\" border=\"1\"></a><br>";
						 } //if
						?>
</div>
</body>
</html>
