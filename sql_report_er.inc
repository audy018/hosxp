<?php
 if(!$syear or $syear==$y){$syear=$y;}
$y_select1=($syear-1)."-10-01";
$y_select2=$syear."-09-31";
//echo "»Õ§º".$syear."<br>".$y_select1."<br>".$y_select2;

//admit àÇÃºèÒÂ
$sqlAll_Admit="select count(a.an) ";
$sqlAll_Admit.="from an_stat a ";
$sqlAll_Admit.="left outer join ovst o on o.vn=a.vn ";
$sqlAll_Admit.="where regdate between  '$y_select1' and '$y_select2'   and  vsttime between '16:00:00' and '24:00:00' ";


?>