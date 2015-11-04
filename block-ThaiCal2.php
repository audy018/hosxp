<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2005 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/* Thai Calendar  Version 2.0    */
/* ThaiNuke :: PHP-Nuke Thailand                       */
/* http://www.thainuke.net/                       */
/************************************************************************/

if (eregi("block-ThaiCal2.php", $_SERVER['SCRIPT_NAME'])) {
   Header("Location: index.php");
   die();
}

//global $currentlang;
$currentlang="thai";
include("ThaiCal2/lang-$currentlang.php");
/************************************************************************/
/*  กำหนดค่าติดตั้งปฏิทิน                                                          */
/************************************************************************/
$clocktype = 2; // 1-แบบตายตัว(Fixed) , 2-แบบสุ่ม(Random) , 3-แบบเลือกเอง(Changed)
$fontstyle = "MS Sans Serif,Verdana,sans-serif"; // เลือกแบบตัวอัษรของปฏิทิน
$fontcolor = "Black"; // เลือกสีตัวอักษรของปฏิทิน 
$bgcolor = ""; // เลือกสีพื้นของปฏิทิน 
$fontcolornow = "White"; // เลือกสีตัวอักษรสำหรับวันนี้
$bgcolornow = "Red"; // เลือกสีพื้นสำหรับวันนี้
$mcolor = "Black"; // เลือกสีตัวอักษรในส่วนของเดือนและปี
$fontsize1 = "1"; // เลือกขนาดตัวอักษรในส่วนของเดือนและปี
$fontsize2 = "7pt"; // เลือกขนาดตัวอักษรของปฏิทิน

// คุณสามารถเช็คเวลาบนเซิร์ฟเวอร์ได้โดยปลด remark (//) ในบรรทัดถัดไปออก(ในกรณีที่วันในปฏิทินไม่ตรง)
// echo date("d/m/Y H:i:s", time()); 
$offset = 0; // +n ถ้าเวลาของเซิร์ฟเวอร์ช้าไป n ชม., -n ถ้าเวลาของเซิร์ฟเวอร์เร็วไป n ชม. 
/************************************************************************/

$fontfamily = isset($fontfamily) ? $fontfamily : $fontstyle; 
$defaultfontcolor = isset($defaultfontcolor) ? $defaultfontcolor : $fontcolor; 
$defaultbgcolor = isset($defaultbgcolor) ? $defaultbgcolor : $bgcolor; 
$todayfontcolor = isset($todayfontcolor) ? $todayfontcolor : $fontcolornow; 
$todaybgcolor = isset($todaybgcolor) ? $todaybgcolor : $bgcolornow; 
$monthcolor = isset($monthcolor) ? $monthcolor : $mcolor; 
$relfontsize = isset($relfontsize) ? $relfontsize : $fontsize1; 
$cssfontsize = isset($cssfontsize) ? $cssfontsize : $fontsize2; 

if ($clocktype == 1) {
// 1-แบบตายตัว(Fixed)
$watch = 5; // เลือกแบบของนาฬิกา(1 หรือ 2 หรือ 3 หรือ 4 หรือ 5,...)

} elseif ($clocktype == 2) {
// 2-แบบสุ่ม(Random)
mt_srand((double)microtime()*1000000);
$watch = mt_rand(1, 20);

} elseif ($clocktype == 3) {
// 3-แบบเลือกเอง(Changed)
$setclock = 1; // default watch

if (!$_POST[clock]){
	$_POST[clock] = $setclock;
} 

$content .= "<font color=\"$monthcolor\" face=\"$fontstyle\" size=\"$fontsize1\"><center><B>"._tcplease."</B><form method=\"post\" action=\"$PHP_SELF\">";
$content .= "<select name=\"clock\">";
if ($_POST[clock]=="1"){$selected1="selected";}
elseif ($_POST[clock]=="2"){$selected2="selected";}
elseif ($_POST[clock]=="3"){$selected3="selected";}
elseif ($_POST[clock]=="4"){$selected4="selected";}
elseif ($_POST[clock]=="5"){$selected5="selected";}
elseif ($_POST[clock]=="6"){$selected6="selected";}
elseif ($_POST[clock]=="7"){$selected7="selected";}
elseif ($_POST[clock]=="8"){$selected8="selected";}
elseif ($_POST[clock]=="9"){$selected9="selected";}
elseif ($_POST[clock]=="10"){$selected10="selected";}
elseif ($_POST[clock]=="11"){$selected11="selected";}
elseif ($_POST[clock]=="12"){$selected12="selected";}
elseif ($_POST[clock]=="13"){$selected13="selected";}
elseif ($_POST[clock]=="14"){$selected14="selected";}
elseif ($_POST[clock]=="15"){$selected15="selected";}
elseif ($_POST[clock]=="16"){$selected16="selected";}
elseif ($_POST[clock]=="17"){$selected17="selected";}
elseif ($_POST[clock]=="18"){$selected18="selected";}
elseif ($_POST[clock]=="19"){$selected19="selected";}
elseif ($_POST[clock]=="20"){$selected20="selected";}
$content .= "<option value=1 $selected1>"._tctype." 1</opition>";
$content .= "<option value=2 $selected2>"._tctype." 2</option>";
$content .= "<option value=3 $selected3>"._tctype." 3</option>";
$content .= "<option value=4 $selected4>"._tctype." 4</option>";
$content .= "<option value=5 $selected5>"._tctype." 5</option>";
$content .= "<option value=6 $selected6>"._tctype." 6</option>";
$content .= "<option value=7 $selected7>"._tctype." 7</option>";
$content .= "<option value=8 $selected8>"._tctype." 8</option>";
$content .= "<option value=9 $selected9>"._tctype." 9</option>";
$content .= "<option value=10 $selected10>"._tctype." 10</option>";
$content .= "<option value=11 $selected11>"._tctype." 11</opition>";
$content .= "<option value=12 $selected12>"._tctype." 12</option>";
$content .= "<option value=13 $selected13>"._tctype." 13</option>";
$content .= "<option value=14 $selected14>"._tctype." 14</option>";
$content .= "<option value=15 $selected15>"._tctype." 15</option>";
$content .= "<option value=16 $selected16>"._tctype." 16</option>";
$content .= "<option value=17 $selected17>"._tctype." 17</option>";
$content .= "<option value=18 $selected18>"._tctype." 18</option>";
$content .= "<option value=19 $selected19>"._tctype." 19</option>";
$content .= "<option value=20 $selected20>"._tctype." 20</option>";
$content .= "</select>";
$content .= "<input type=\"submit\" name=\"submit\" value=\""._tcok."\">";
$content .= "</form></center></font>";
$watch = $_POST[clock];
}

// Flash Clock
$content .= "<TABLE width=\"100%\" border=0 cellPadding=0 cellSpacing=0>
<TBODY><TR><TD align=left><center>
<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"
 codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\"
 WIDTH=\"130\" HEIGHT=\"130\" id=\"relog\" ALIGN=\"\">
  <PARAM NAME=movie VALUE=\"images/watch$watch.swf\">
  <PARAM NAME=quality VALUE=high> 
  <PARAM NAME=bgcolor VALUE=#FFFFFF>
  <param name=\"wmode\" value=\"transparent\">
  <param name=\"menu\" value=\"false\">
  <EMBED src=\"images/watch$watch.swf\" quality=high bgcolor=#FFFFFF  WIDTH=\"130\" HEIGHT=\"130\" wmode=\"transparent\" ALIGN=\"\" TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\" menu=\"false\">
  </EMBED></OBJECT></center></TD></TR></TBODY></TABLE>";
  
?>