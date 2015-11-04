<?php
session_start();
if (strlen($vstdate)==10) {$querydate="='".$vstdate."'";}
else{$querydate="between '".$vstdate."-01' and '".$vstdate."-31'";}

if ($grpid=='10') {
$sql_dpt="select  count(vn) as dpt  from pq_doctor  v 	left outer join doctor k on k.code=v.doctor  where v.doctor_date $querydate and k.name like '%แพทย์%'  and k.name  not like '%ทันต%' ";
 $result_dpt= mysql_db_query($DBName,$sql_dpt)
or die("sorry,can't show any information".mysql_error());
$rsDpt=mysql_fetch_array($result_dpt);
$total=$rsDpt["dpt"];}
elseif  ($grpid=='11') {
$sql_mn="select  substring_index(sum(sum_price),'.',1) as  mn from opitemrece  where vstdate  $querydate";
 $result_mn= mysql_db_query($DBName,$sql_mn)
or die("sorry,can't show any information".mysql_error());
$rsPt=mysql_fetch_array($result_mn);
$total=$rsPt["mn"]; }
else {
$sql_pt="select  count(vn) as pt  from vn_stat where vstdate $querydate";
 $result_pt= mysql_db_query($DBName,$sql_pt)
or die("sorry,can't show any information".mysql_error());
$rsPt=mysql_fetch_array($result_pt);
$total=$rsPt["pt"]; }

$sql_hosp="select  * from hospcode where hospcode='$Hospcode'";
 $result_hosp= mysql_db_query($DBName,$sql_hosp)
or die("sorry,can't show any information".mysql_error());
$rsHosp=mysql_fetch_array($result_hosp);
$hospchw=$rsHosp["chwpart"]; $hospamp=$rsHosp["amppart"]; $hosptmb=$rsHosp["tmbpart"]; 

switch($grpid)
	{
	case 1:  $reportname="Patient/Sex"; $namex="เพศ";  $namey="จำนวนผู้ป่วย"; $sql=" select v.sex, s.name as dx,count(v.vn) as dy, (count(v.vn)/$total)*100 as percent  from vn_stat v  left outer join sex s on s.code=v.sex where v.vstdate $querydate group by v.sex,s.name"; $chart_type="3D pie"; $value_percent="true"; $value_pos="inside";$tablehead=array("เพศ","ผู้ป่วย(คน)","ร้อยละ");$grp_dsc='จำนวนผู้ป่วยจำแนกตามเพศ';
	break;
    case 2:  $reportname="Patient/Age"; $namex="อายุ";  $namey="จำนวนผู้ป่วย"; $sql="select LENGTH(concat((floor(age_y/6)*6),'-',((floor(age_y/6)*6)+5))) as maxlen, (floor(age_y/6)*6) as cc, concat((floor(age_y/6)*6),'-',((floor(age_y/6)*6)+5)) as dx, count( vn ) as dy , (count(vn)/$total)*100 as percent   from vn_stat  where vstdate $querydate  group by cc "; $chart_type="column"; $value_percent="true"; $value_pos="Cursor"; $tablehead=array("อายุ(ปี)","ผู้ป่วย(คน)","ร้อยละ");$c="2";$grp_dsc="จำนวนผู้ป่วยจำแนกตามอายุ";
 	break;
	    case 3:  $reportname="Patient/Type"; $namex="สิทธิ";  $namey="จำนวนผู้ป่วย"; $sql="select  LENGTH(v.pttype) as maxlen,v.pttype as dx,s.name ,count(v.vn)  AS dy , (count(v.vn)/$total)*100 as percent  FROM vn_stat v  left outer join pttype s on s.pttype=v.pttype  WHERE vstdate $querydate GROUP BY v.pttype "; $chart_type="column"; $value_percent="false"; $value_pos="cursor";$tablehead=array("รหัส","สิทธิ","ผู้ป่วย(คน)","ร้อยละ");$grp_dsc="จำนวนผู้ป่วยจำแนกตามสิทธิการรักษา";
 	break;
	
 case 4:  $reportname="Patient/Department"; $namex="แผนก";  $namey="จำนวนผู้ป่วย"; $sql="SELECT LENGTH(v.main_dep) as maxlen,v.main_dep  as dx, k.department   , count( v.vn ) AS dy, (count(v.vn)/$total)*100 as percent  FROM ovst v LEFT OUTER JOIN kskdepartment k ON k.depcode = v.main_dep WHERE v.vstdate $querydate  GROUP BY v.main_dep, k.department"; $chart_type="column"; $value_percent="true"; $value_pos="cursor";$tablehead=array("รหัส","แผนก","ผู้ป่วย(คน)","ร้อยละ");$grp_dsc="จำนวนผู้ป่วยจำแนกตามแผนก";
	break;
	
	case 5:  $reportname="Patient/Diagnosis"; $namex="วินิจฉัย";  $namey="จำนวนผู้ป่วย"; $sql="select  LENGTH(pdx) as maxlen,pdx as dx,count(vn) as dy , (count(v.vn)/$total)*100 as percent  from vn_stat v WHERE vstdate $querydate  and pdx <>'' group by pdx order by dy desc Limit 10"; $chart_type="Bar"; $value_percent="false"; $value_pos="cursor";$tablehead=array("วินิจฉัย","ผู้ป่วย(คน)","ร้อยละ");$grp_dsc="จำนวนผู้ป่วยจำแนกตามวินิจฉัย 10 อันดับแรก";
 	break;
	case 6:  $reportname="Patient/Address"; $namex="ที่อยู่";  $namey="จำนวนผู้ป่วย"; $sql="select LENGTH(IF((t.amppart<>'$hospamp' or t.chwpart<>'$hospchw'),'นอกเขต',t.name)) as maxlen,
IF((t.amppart<>'$hospamp' or t.chwpart<>'$hospchw'),'นอกเขต',t.name) as dx, count(v.vn) as dy , (count(v.vn)/$total)*100 as percent  from vn_stat v  left outer join patient p on p.hn=v.hn
left outer join thaiaddress t on t.addressid=concat(p.chwpart,p.amppart,p.tmbpart) where v.vstdate $querydate group by dx order by t.amppart,dx"; $chart_type="column"; $value_percent="false"; $value_pos="cursor";$tablehead=array("ที่อยู่","ผู้ป่วย(คน)","ร้อยละ");$grp_dsc="จำนวนผู้ป่วยจำแนกตามที่อยู่(ตำบล)";
 	break;
		case 7:  $reportname="Patient/Address"; $namex="ที่อยู่";  $namey="จำนวนผู้ป่วย"; $sql="select LENGTH(IF( t.chwpart<>'$hospchw','นอกจังหวัด',t.name)) as maxlen,
IF( t.chwpart<>'$hospchw','นอกจังหวัด',t.name) as dx, count(v.vn) as dy , (count(v.vn)/$total)*100 as percent  from vn_stat v  left outer join patient p on p.hn=v.hn
left outer join thaiaddress t on t.addressid=concat(p.chwpart,p.amppart,'00') where v.vstdate $querydate group by dx order by t.chwpart,dx"; $chart_type="column"; $value_percent="false"; $value_pos="cursor";$tablehead=array("ที่อยู่","ผู้ป่วย(คน)","ร้อยละ");$grp_dsc="จำนวนผู้ป่วยจำแนกตามที่อยู่(อำเภอ)";

 	break;
	case 8:  $reportname="Patient/Address"; $namex="ที่อยู่";  $namey="จำนวนผู้ป่วย"; $sql="select LENGTH(t.name) as maxlen,
t.name as dx, count(v.vn) as dy , (count(v.vn)/$total)*100 as percent  from vn_stat v  left outer join patient p on p.hn=v.hn
left outer join thaiaddress t on t.addressid=concat(p.chwpart,'0000') where v.vstdate $querydate group by dx order by dx"; $chart_type="column"; $value_percent="false"; $value_pos="cursor";$tablehead=array("ที่อยู่","ผู้ป่วย(คน)","ร้อยละ");$grp_dsc="จำนวนผู้ป่วยจำแนกตามที่อยู่(จังหวัด)";

 	break;
	case 9:  $reportname="Patient/Times"; $namex="เวลา";  $namey="จำนวนผู้ป่วย"; $sql="select LENGTH(concat(floor(((hour(vsttime)*3600)+(minute(vsttime)*60)+second(vsttime))/3600)*2,'-',(floor(((hour(vsttime)*3600)+(minute(vsttime)*60)+second(vsttime))/7200)*2+2))) as maxlen,concat(floor(((hour(vsttime)*3600)+(minute(vsttime)*60)+second(vsttime))/7200)*2,'-',(floor(((hour(vsttime)*3600)+(minute(vsttime)*60)+second(vsttime))/7200)*2+2)) as dx ,count(vn)  as dy , (count(vn)/$total)*100 as percent  from ovst where vstdate $querydate group by dx order by vsttime "; $chart_type="column"; $value_percent="true"; $value_pos="inside";$tablehead=array("เวลา","ผู้ป่วย(คน)","ร้อยละ");$grp_dsc="จำนวนผู้ป่วยจำแนกตามเวลาที่มารับบริการ";
	break;
	
						
		case 10:  $reportname="Patient/Doctors"; $namex="แพทย์";  $namey="จำนวนผู้ป่วย"; $sql="select LENGTH(substring_index(k.name,' ',1)) as maxlen,v.doctor  ,substring_index(k.name,' ',1) as dx,count(v.vn) as dy , (count(v.vn)/$total)*100 as percent from pq_doctor  v 	left outer join doctor k on k.code=v.doctor  where v.doctor_date $querydate and k.name like '%แพทย์%'  and k.name  not like '%ทันต%'group by v.doctor  , k.name "; $chart_type="3D pie"; $value_percent="true"; $value_pos="inside";$tablehead=array("รหัส","แพทย์","ผู้ป่วย(คน)","ร้อยละ");$grp_dsc="จำนวนผู้ป่วยจำแนกตามแพทย์ผู้ตรวจ";
	break;
	
	case 11:  $reportname="Income/Bath"; $namex="ค่าใช้จ่าย";  $namey="บาท"; $sql="select  LENGTH(o.income) as maxlen,o.income as dx, i.name ,substring_index(sum(o.sum_price),'.',1) as dy, (substring_index(sum(o.sum_price),'.',1)/$total)*100 as percent from opitemrece o left outer join  income i on i.income=o.income where o.vstdate $querydate group by i.name order by o.income"; $chart_type="column"; $value_percent="true"; $value_pos="cursor";$tablehead=array("รหัส","ค่าใช้จ่าย","จำนวนเงิน(บาท)","ร้อยละ");$grp_dsc="ค่าใช้จ่ายแยกตามประเภท";
	break;

case 12:  $reportname="Patient/Diagnosis"; $namex="วินิจฉัย";  $namey="จำนวนผู้ป่วย";  
$sql="select  LENGTH(pdx) as maxlen,pdx as dx,count(vn) as dy , (count(v.vn)/$total)*100 as percent  from vn_stat v "; 
$sql.="WHERE vstdate $querydate  and pdx in ('A37','A09','T62','A00',
'A009','A000','A001','T620','T621','629','T622','T628','A03',
'A06','A01','B17','B171','B170','B172','B178','B19','B190',
'B199','B15','B150','B159','B16','B16','B160','B169','B162',
'B18','B180','B181','B182','B188','B189','B303','J10','J108',
'J101','J100','J11','J118','J111','J110','B06','B060','B068',
'B069','B01','R509','A80','A800','A801','A802','A803','A804',
'A809','B05','B050','B051','B052','B053','B054','B058','B059',
'A36','A363','A369','A362','A361','A368','A360','A35','A33',
'A90','A91','A86','A830','B50','B500','B508','B509','B51','B518',
'B510','B519','B52','B520','B528','B529','B53','B531','B538',
'B530','B54','J18','J180','j182','J181','J188','J189','A17','A171',
'A178','A179','A170','A30','A304','A303','A302','A300','A305',
'A309','A308','A301','B92','A50','A75','A750','A751','A753','A752',
'A759','A22','A227','A229','A220','A222','A228','A221','B26',
'B262','B261','B260','B263','B268','B269','A50','A509','A501',
'A500','A502','A504','A506','A507','A503','A52','A522','A520',
'A528','A529','A523','A527','A521','A53','A530','A539','A534',
'A546','A543','A541','A540','A544','A549','A542','A545','A548',
'A57','A58','A56','A563','A562','A560','A561','A568','A564','A64',
'A82','A829','A820','A821','A27','A270','A279','A278','A059') ";
$sql.="group by pdx order by dy desc ";
$chart_type="Bar"; $value_percent="false"; $value_pos="cursor";$tablehead=array("วินิจฉัย","ผู้ป่วย(คน)","ร้อยละ");$grp_dsc="จำนวนผู้ป่วยเฝ้าระวังทางระบาดวิทยา";
 	break;
		}	

?>


