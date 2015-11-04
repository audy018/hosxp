<?php
 if(!$syear or $syear==$y){$syear=$y;}
$y_select1=($syear-1)."-10-01";
$y_select2=$syear."-09-31";
//echo "ปีงบ".$syear."<br>".$y_select1."<br>".$y_select2;

//จำนวนคลอดทั้งหมด 
$sqlAllBorn="select DISTINCT MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlAllBorn.="from ipt i ";
$sqlAllBorn.="left outer join an_stat a on a.an=i.an "; 
$sqlAllBorn.="where (a.pdx in('o800','o814','o830','o840','o841','o848','o849','o801','o831') or a.dx0 in('o800','o814','o830','o840','o841','o848','o849','o801','o831') or a.dx1 in('o800','o814','o830','o840','o841','o848','o849','o801','o831') or a.dx2 in('o800','o814','o830','o840','o841','o848','o849','o801','o831') or a.dx3 in('o800','o814','o830','o840','o841','o848','o849','o801','o831')) and i.regdate between '$y_select1' and '$y_select2' ";
$sqlAllBorn.="group by month,year order by year,MONTH(i.regdate) ";

//คลอดปกติ
$sqlMormalBorn="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlMormalBorn.="from ipt i ";
$sqlMormalBorn.="left outer join an_stat a on a.an=i.an "; 
$sqlMormalBorn.="where a.pdx ='o800' and i.regdate between '$y_select1' and '$y_select2' ";
$sqlMormalBorn.="group by month,year order by year,MONTH(i.regdate) ";

//คลอดผิดปกติ
$sqlNoNormal="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlNoNormal.="from ipt i ";
$sqlNoNormal.="left outer join an_stat a on a.an=i.an "; 
$sqlNoNormal.="where a.pdx in('o814','o830','o840','o841','o848','o849') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlNoNormal.="group by month,year order by year,MONTH(i.regdate) ";

//คลอดผิดปกติ  V/E
$sqlVE="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlVE.="from ipt i ";
$sqlVE.="left outer join an_stat a on a.an=i.an "; 
$sqlVE.="where a.pdx ='o814' and i.regdate between '$y_select1' and '$y_select2' ";
$sqlVE.="group by month,year order by year,MONTH(i.regdate) ";

// ท่าก้น
$sqlBE="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlBE.="from ipt i ";
$sqlBE.="left outer join an_stat a on a.an=i.an "; 
$sqlBE.="where a.pdx='o830' and i.regdate between '$y_select1' and '$y_select2' ";
$sqlBE.="group by month,year order by year,MONTH(i.regdate) ";

// แฝด
$sqlTwin="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlTwin.="from ipt i ";
$sqlTwin.="left outer join an_stat a on a.an=i.an "; 
$sqlTwin.="where a.pdx in('o840','o841','o848','o849') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlTwin.="group by month,year order by year,MONTH(i.regdate) ";

// จำนวนมารดามีชีวิต
$sqlMother="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlMother.="from ipt i ";
$sqlMother.="left outer join an_stat a on a.an=i.an "; 
$sqlMother.="where a.pdx in('o800','o814','o830','o840','o841','o848','o849') and i.dchstts<>'09' and i.regdate between '$y_select1' and '$y_select2' ";
$sqlMother.="group by month,year order by year,MONTH(i.regdate) ";

// จำนวนมารดาเสียชีวิต
$sqlMotherDead="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlMotherDead.="from ipt i ";
$sqlMotherDead.="left outer join an_stat a on a.an=i.an "; 
$sqlMotherDead.="where a.pdx in('o800','o814','o830','o840','o841','o848','o849') and i.dchstts='09' and i.regdate between '$y_select1' and '$y_select2' ";
$sqlMotherDead.="group by month,year order by year,MONTH(i.regdate) ";

//จำนวนทารกทั้งหมด 
$sqlAllNewBorn="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlAllNewBorn.="from ipt i ";
$sqlAllNewBorn.="left outer join an_stat a on a.an=i.an "; 
$sqlAllNewBorn.="where a.pdx in('z380','z371') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlAllNewBorn.="group by month,year order by year,MONTH(i.regdate) ";

//จำนวนทารกเกิดมีชีพ
$sqlNor_child="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total  ";
$sqlNor_child.="from ipt i ";
$sqlNor_child.="left outer join an_stat a on a.an=i.an ";
$sqlNor_child.="where a.pdx='z380' and i.regdate between '$y_select1' and '$y_select2' ";
$sqlNor_child.="group by month,year order by year,MONTH(i.regdate) ";

//จำนวนทารกเกิดไร้ชีพ
$sqlDead_Still="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total  ";
$sqlDead_Still.="from ipt i  ";
$sqlDead_Still.="left outer join an_stat a on a.an=i.an ";
$sqlDead_Still.="where a.pdx='z371'  and i.regdate between '$y_select1' and '$y_select2' ";
$sqlDead_Still.="group by month,year order by year,MONTH(i.regdate) ";

//Apgar Score 1 นาที
$sqlApgar1="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlApgar1.="from ipt i ";
$sqlApgar1.="left outer join ipt_newborn ip on ip.an=i.an ";
$sqlApgar1.="where  i.regdate between '$y_select1' and '$y_select2' and ip.apgar1 between '1' and '7' ";
$sqlApgar1.="group by month,year order by year,MONTH(i.regdate) ";

//Apgar Score 1 นาที score 0-3 

$sqlApgar1_03="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlApgar1_03.="from ipt i ";
$sqlApgar1_03.="left outer join ipt_newborn ip on ip.an=i.an ";
$sqlApgar1_03.="where  i.regdate between '$y_select1' and '$y_select2' and ip.apgar1 between '0' and '3' ";
$sqlApgar1_03.="group by month,year order by year,MONTH(i.regdate) ";

//Apgar Score 1 นาที score 4-7 
$sqlApgar1_47="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlApgar1_47.="from ipt i ";
$sqlApgar1_47.="left outer join ipt_newborn ip on ip.an=i.an ";
$sqlApgar1_47.="where  i.regdate between  '$y_select1' and '$y_select2' and ip.apgar1 between '4' and '7' ";
$sqlApgar1_47.="group by month,year order by year,MONTH(i.regdate) ";

//Apgar Score 5 นาที
$sqlApgar5="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlApgar5.="from ipt i ";
$sqlApgar5.="left outer join ipt_newborn ip on ip.an=i.an ";
$sqlApgar5.="where  i.regdate between '$y_select1' and '$y_select2' and ip.apgar2 between '1' and '7'  ";
$sqlApgar5.="group by month,year order by year,MONTH(i.regdate) ";

//Apgar Score 5 นาที score 0-3
$sqlApgar5_03="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlApgar5_03.="from ipt i ";
$sqlApgar5_03.="left outer join ipt_newborn ip on ip.an=i.an ";
$sqlApgar5_03.="where  i.regdate between '$y_select1' and '$y_select2' and ip.apgar2 between '0' and '3' ";
$sqlApgar5_03.="group by month,year order by year,MONTH(i.regdate) ";

//Apgar Score 5 นาที score 4-7
$sqlApgar5_47="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlApgar5_47.="from ipt i ";
$sqlApgar5_47.="left outer join ipt_newborn ip on ip.an=i.an ";
$sqlApgar5_47.="where  i.regdate between '$y_select1' and '$y_select2' and ip.apgar2 between '4' and '7' ";
$sqlApgar5_47.="group by month,year order by year,MONTH(i.regdate) ";

//น้ำหนักแรกเกิดต่ำกว่า 2500
$sqlbirth_w2500="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlbirth_w2500.="from ipt i ";
$sqlbirth_w2500.="left outer join ipt_newborn ip on ip.an=i.an ";
$sqlbirth_w2500.="where  i.regdate between '$y_select1' and '$y_select2' and ip.birth_weight <='2500' ";
$sqlbirth_w2500.="group by month,year order by year,MONTH(i.regdate) ";

//น้ำหนักแรกเกิดต่ำกว่า 2000-2499
$sqlbirth_w2k2499="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlbirth_w2k2499.="from ipt i ";
$sqlbirth_w2k2499.="left outer join ipt_newborn ip on ip.an=i.an ";
$sqlbirth_w2k2499.="where  i.regdate between '$y_select1' and '$y_select2' and ip.birth_weight between '2000' and '2499' ";
$sqlbirth_w2k2499.="group by month,year order by year,MONTH(i.regdate) ";

//น้ำหนักแรกเกิดต่ำกว่า 2000
$sqlbirth_w2k="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlbirth_w2k.="from ipt i ";
$sqlbirth_w2k.="left outer join ipt_newborn ip on ip.an=i.an ";
$sqlbirth_w2k.="where  i.regdate between '$y_select1' and '$y_select2' and ip.birth_weight <= '2000' ";
$sqlbirth_w2k.="group by month,year order by year,MONTH(i.regdate) ";

//น้ำหนักแฝดต่ำกว่า 2000-2499
$sqlTwin_w2k2499="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlTwin_w2k2499.="from ipt i ";
$sqlTwin_w2k2499.="left outer join ipt_newborn ip on ip.an=i.an ";
$sqlTwin_w2k2499.="left outer join an_stat a on a.an=i.an ";
$sqlTwin_w2k2499.="where a.pdx in('o840','o841','o848','o849') and i.regdate between '$y_select1' and '$y_select2' and  ip.birth_weight between '2000' and '2499' ";
$sqlTwin_w2k2499.="group by month,year order by year,MONTH(i.regdate) ";

//น้ำหนักแฝดต่ำกว่า 2000
$sqlTwin_w2k="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlTwin_w2k.="from ipt i ";
$sqlTwin_w2k.="left outer join ipt_newborn ip on ip.an=i.an ";
$sqlTwin_w2k.="left outer join an_stat a on a.an=i.an ";
$sqlTwin_w2k.="where a.pdx in('o840','o841','o848','o849') and i.regdate between '$y_select1' and '$y_select2' and  ip.birth_weight <= '2000' ";
$sqlTwin_w2k.="group by month,year order by year,MONTH(i.regdate) ";

// จำนวนมารดาไม่ฝากครรภ์
$sqlAnc="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlAnc.="from ipt i ";
$sqlAnc.="left outer join an_stat a on a.an=i.an "; 
$sqlAnc.="left outer join ipt_newborn ip on ip.an=i.an ";
$sqlAnc.="where a.pdx in('o800','o814','o830','o840','o841','o848','o849') and ip.anc_complete <>'Y' and i.regdate between '$y_select1' and '$y_select2' ";
$sqlAnc.="group by month,year order by year,MONTH(i.regdate) ";

// จำนวนมารดาอายุน้อยกว่า20 ปี
$sqlMother_20="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlMother_20.="from ipt i ";
$sqlMother_20.="left outer join an_stat a on a.an=i.an "; 
$sqlMother_20.="left outer join vn_stat v on v.hn=i.hn ";
$sqlMother_20.="where v.age_y < '20' and a.pdx in('o800','o814','o830','o840','o841','o848','o849') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlMother_20.="group by month,year order by year,MONTH(i.regdate) ";

//ภาวะแทรกซ้อน
$sqlComplecation="";

//ภาวะแทรกซ้อน ->PIH
$sqlPIH="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlPIH.="from ipt i ";
$sqlPIH.="left outer join an_stat a on a.an=i.an "; 
$sqlPIH.="where a.pdx in('o13','o14') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlPIH.="group by month,year order by year,MONTH(i.regdate) ";

//ภาวะแทรกซ้อน ->Eclampsia
$sqlEclampsia="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlEclampsia.="from ipt i ";
$sqlEclampsia.="left outer join an_stat a on a.an=i.an "; 
//$sqlEclampsia.="where a.pdx in('o140','o141','o149','o840','o841','o15','o150','o151','o152','o159') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlEclampsia.="where a.pdx='o150' and i.regdate between '$y_select1' and '$y_select2' ";
$sqlEclampsia.="group by month,year order by year,MONTH(i.regdate) ";

//ภาวะแทรกซ้อน ->PROM
$sqlProm="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlProm.="from ipt i ";
$sqlProm.="left outer join an_stat a on a.an=i.an "; 
$sqlProm.="where a.pdx in('o420','o421','o422','o429') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlProm.="group by month,year order by year,MONTH(i.regdate) ";

//ภาวะแทรกซ้อน ->PROM
$sqlProm="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlProm.="from ipt i ";
$sqlProm.="left outer join an_stat a on a.an=i.an "; 
$sqlProm.="where a.pdx in('o420','o421','o422','o429') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlProm.="group by month,year order by year,MONTH(i.regdate) ";

//ภาวะแทรกซ้อน ->Porolong 1 Stage
$sqlPorolong1="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlPorolong1.="from ipt i ";
$sqlPorolong1.="left outer join an_stat a on a.an=i.an "; 
$sqlPorolong1.="where a.pdx ='o630' and i.regdate between '$y_select1' and '$y_select2' ";
$sqlPorolong1.="group by month,year order by year,MONTH(i.regdate) ";

//ภาวะแทรกซ้อน ->Porolong 2 Stage
$sqlPorolong2="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlPorolong2.="from ipt i ";
$sqlPorolong2.="left outer join an_stat a on a.an=i.an "; 
$sqlPorolong2.="where a.pdx ='o631' and i.regdate between '$y_select1' and '$y_select2' ";
$sqlPorolong2.="group by month,year order by year,MONTH(i.regdate) ";

//ภาวะแทรกซ้อน ->Premature contraction
$sqlPremature="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlPremature.="from ipt i ";
$sqlPremature.="left outer join an_stat a on a.an=i.an "; 
$sqlPremature.="where a.pdx ='o470' and i.regdate between '$y_select1' and '$y_select2' ";
$sqlPremature.="group by month,year order by year,MONTH(i.regdate) ";

//ภาวะแทรกซ้อน ->CPD
$sqlCpd="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlCpd.="from ipt i ";
$sqlCpd.="left outer join an_stat a on a.an=i.an "; 
$sqlCpd.="where a.pdx in('o650','o651','o652','o653','o654','o655','o658','o659') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlCpd.="group by month,year order by year,MONTH(i.regdate) ";

//ภาวะแทรกซ้อน ->PPH
$sqlPPH="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlPPH.="from ipt i ";
$sqlPPH.="left outer join an_stat a on a.an=i.an "; 
$sqlPPH.="where a.pdx in('o720','o723') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlPPH.="group by month,year order by year,MONTH(i.regdate) ";

//ภาวะแทรกซ้อน ->Retained Placenta
$sqlRetained="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlRetained.="from ipt i ";
$sqlRetained.="left outer join an_stat a on a.an=i.an "; 
$sqlRetained.="where a.pdx in('o730','o731') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlRetained.="group by month,year order by year,MONTH(i.regdate) ";

//ภาวะแทรกซ้อน ->Uterine rupture
$sqlUterine="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlUterine.="from ipt i ";
$sqlUterine.="left outer join an_stat a on a.an=i.an "; 
$sqlUterine.="where a.pdx in('o710','o711') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlUterine.="group by month,year order by year,MONTH(i.regdate) ";

//ภาวะแทรกซ้อน ->คลอดติดไหล่
$sqlShoulder="select MONTH(i.regdate) as Month,MONTHNAME(i.regdate) as month, (YEAR(i.regdate)+543) as year,YEAR(i.regdate) as Year,count(i.an) as total ";
$sqlShoulder.="from ipt i ";
$sqlShoulder.="left outer join an_stat a on a.an=i.an "; 
$sqlShoulder.="where a.pdx in('o660') and i.regdate between '$y_select1' and '$y_select2' ";
$sqlShoulder.="group by month,year order by year,MONTH(i.regdate) ";
?>