<?php


//ผล FBS
$sql_fbs  =" SELECT lo.lab_order_result as lab_result";
$sql_fbs .=" FROM  vn_stat v";
$sql_fbs .=" left outer join lab_head lh on lh.vn = v.vn";
$sql_fbs .=" left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number";
$sql_fbs .=" left outer join lab_items  li on li.lab_items_code = lo.lab_items_code";
$sql_fbs .=" WHERE  v.vstdate = '$vstdate' and v.vn='$vn'and v.hn='$hn'";
$sql_fbs .=" AND lo.lab_items_code in ('3001','2057') and lo.confirm='Y' ";


//ผล HbA1c
$sql_hba1c ="select lo.lab_order_result,lh.lab_order_number,lh.vn,lh.hn,lh.order_date,lh.confirm_report ,lo.lab_items_code ";
$sql_hba1c.="from lab_head  lh ";
$sql_hba1c.="left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_hba1c.="where lh.vn ='$vn' and lh.hn='$hn' and lh.order_date='$vstdate' and lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_items_code='48' ";



//BPS
$sql_bps ="SELECT opd.bps,opd.fbs,vns.vn as vn,vns.hn,vns.vstdate";
$sql_bps.=" FROM vn_stat vns ";
$sql_bps.=" LEFT OUTER JOIN opdscreen opd on opd.vn = vns.vn";
$sql_bps.=" WHERE vns.vn='$vn' and vns.hn='$hn' and vns.vstdate ='$vstdate' ";


//BPD
$sql_bpd ="SELECT opd.bpd,opd.fbs,vns.vn as vn,vns.hn,vns.vstdate";
$sql_bpd.=" FROM vn_stat vns ";
$sql_bpd.=" LEFT OUTER JOIN opdscreen opd on opd.vn = vns.vn";
$sql_bpd.=" WHERE vns.vn='$vn' and vns.hn='$hn' and vns.vstdate ='$vstdate' ";


//BW(KG)
$sql_bwkg ="SELECT opd.bw,opd.fbs,vns.vn as vn,vns.hn,vns.vstdate";
$sql_bwkg.=" FROM vn_stat vns ";
$sql_bwkg.=" LEFT OUTER JOIN opdscreen opd on opd.vn = vns.vn";
$sql_bwkg.=" WHERE vns.vn='$vn' and vns.hn='$hn' and vns.vstdate ='$vstdate' ";


// Ht(cm)
$sql_htcm ="SELECT opd.height,opd.fbs,vns.vn as vn,vns.hn,vns.vstdate";
$sql_htcm.=" FROM vn_stat vns ";
$sql_htcm.=" LEFT OUTER JOIN opdscreen opd on opd.vn = vns.vn";
$sql_htcm.=" WHERE vns.vn='$vn' and vns.hn='$hn' and vns.vstdate ='$vstdate' ";



// BMI
$sql_bmi ="SELECT opd.bmi,opd.fbs,vns.vn as vn,vns.hn,vns.vstdate";
$sql_bmi.=" FROM vn_stat vns ";
$sql_bmi.=" LEFT OUTER JOIN opdscreen opd on opd.vn = vns.vn";
$sql_bmi.=" WHERE vns.vn='$vn' and vns.hn='$hn' and vns.vstdate ='$vstdate' ";



//ผล HDL-C
$sql_hdlc ="SELECT lo.lab_order_result,lh.lab_order_number,lh.vn,lh.hn,lh.order_date,lh.confirm_report ,lo.lab_items_code ";
$sql_hdlc.="FROM lab_head  lh ";
$sql_hdlc.="LEFT OUTER JOIN lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_hdlc.="WHERE lh.vn ='$vn' and lh.hn='$hn' and lh.order_date='$vstdate' and lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_items_code='3007' ";



//ผล LDL-C
$sql_ldlc ="SELECT lo.lab_order_result,lh.lab_order_number,lh.vn,lh.hn,lh.order_date,lh.confirm_report ,lo.lab_items_code ";
$sql_ldlc.="FROM lab_head  lh ";
$sql_ldlc.="LEFT OUTER JOIN lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_ldlc.="WHERE lh.vn ='$vn' and lh.hn='$hn' and lh.order_date='$vstdate' and lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_items_code='3008' ";


//ผล Trigly Ceride
$sql_trigly ="SELECT lo.lab_order_result,lh.lab_order_number,lh.vn,lh.hn,lh.order_date,lh.confirm_report ,lo.lab_items_code ";
$sql_trigly.="FROM lab_head  lh ";
$sql_trigly.="LEFT OUTER JOIN lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_trigly.="WHERE lh.vn ='$vn' and lh.hn='$hn' and lh.order_date='$vstdate' and lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_items_code='3006' ";


//ผล Cholesterol
$sql_cholesterol ="SELECT lo.lab_order_result,lh.lab_order_number,lh.vn,lh.hn,lh.order_date,lh.confirm_report ,lo.lab_items_code ";
$sql_cholesterol.="FROM lab_head  lh ";
$sql_cholesterol.="LEFT OUTER JOIN lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_cholesterol.="WHERE lh.vn ='$vn' and lh.hn='$hn' and lh.order_date='$vstdate' and lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_items_code='3005' ";



//ผล Potassium
$sql_potassium ="SELECT lo.lab_order_result,lh.lab_order_number,lh.vn,lh.hn,lh.order_date,lh.confirm_report ,lo.lab_items_code ";
$sql_potassium.="FROM lab_head  lh ";
$sql_potassium.="LEFT OUTER JOIN lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_potassium.="WHERE lh.vn ='$vn' and lh.hn='$hn' and lh.order_date='$vstdate' and lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_items_code='3018' ";





//ผล Uric Acid
$sql_uric ="SELECT lo.lab_order_result,lh.lab_order_number,lh.vn,lh.hn,lh.order_date,lh.confirm_report ,lo.lab_items_code ";
$sql_uric.="FROM lab_head  lh ";
$sql_uric.="LEFT OUTER JOIN lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_uric.="WHERE lh.vn ='$vn' and lh.hn='$hn' and lh.order_date='$vstdate' and lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_items_code='3004' ";


//ผล Creatinine
$sql_creatinine ="SELECT lo.lab_order_result,lh.lab_order_number,lh.vn,lh.hn,lh.order_date,lh.confirm_report ,lo.lab_items_code ";
$sql_creatinine.="FROM lab_head  lh ";
$sql_creatinine.="LEFT OUTER JOIN lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_creatinine.="WHERE lh.vn ='$vn' and lh.hn='$hn' and lh.order_date='$vstdate' and lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_items_code='3003' ";


//ผล BUN
$sql_bun ="SELECT lo.lab_order_result,lh.lab_order_number,lh.vn,lh.hn,lh.order_date,lh.confirm_report ,lo.lab_items_code ";
$sql_bun.="FROM lab_head  lh ";
$sql_bun.="LEFT OUTER JOIN lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_bun.="WHERE lh.vn ='$vn' and lh.hn='$hn' and lh.order_date='$vstdate' and lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_items_code='69' ";



//ผล Urine Protein
$sql_urine_protein ="SELECT lo.lab_order_result,lh.lab_order_number,lh.vn,lh.hn,lh.order_date,lh.confirm_report ,lo.lab_items_code ";
$sql_urine_protein.="FROM lab_head  lh ";
$sql_urine_protein.="LEFT OUTER JOIN lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_urine_protein.="WHERE lh.vn ='$vn' and lh.hn='$hn' and lh.order_date='$vstdate' and lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_items_code='3009' ";



//รายงานในไฟล์ show_pharmacy_advice_report_sum2.php

//1. ปัญหาการไม่ให้ความร่วมมือในการใช้ยา
$checkboxm1 =" SELECT  COUNT(checkboxm1) AS count_checkboxm1";
$checkboxm1.=" FROM  lamae_pharmacy_advice";
$checkboxm1.=" WHERE checkboxm1 ='1' AND vstdate between '$d1' and '$d2' ";

//1.1 มาไม่ตรงนัด
$checkboxs11 =" SELECT  COUNT(checkboxs11) AS count_checkboxs11";
$checkboxs11.=" FROM  lamae_pharmacy_advice";
$checkboxs11.=" WHERE checkboxs11 ='1' AND vstdate between '$d1' and '$d2' ";

//1.2 ใช้ยาผิดวิธี
$checkboxs12 =" SELECT  COUNT(checkboxs12) AS count_checkboxs12";
$checkboxs12.=" FROM  lamae_pharmacy_advice";
$checkboxs12.=" WHERE checkboxs12 ='1' AND vstdate between '$d1' and '$d2' ";

//1.3 ใช้ยาที่แพทย์ไม่ได้สั่ง
$checkboxs13 =" SELECT  COUNT(checkboxs13) AS count_checkboxs13";
$checkboxs13.=" FROM  lamae_pharmacy_advice";
$checkboxs13.=" WHERE checkboxs13 ='1' AND vstdate between '$d1' and '$d2' ";



// 1.4 ใช้ยาขนาดไม่ถูกต้องี
$checkboxs14 =" SELECT  COUNT(checkboxs14) AS count_checkboxs14";
$checkboxs14.=" FROM  lamae_pharmacy_advice";
$checkboxs14.=" WHERE checkboxs14 ='1' AND vstdate between '$d1' and '$d2' ";


// 1.5 ใช้ยาผิดเวลาี
$checkboxs15 =" SELECT  COUNT(checkboxs15) AS count_checkboxs15";
$checkboxs15.=" FROM  lamae_pharmacy_advice";
$checkboxs15.=" WHERE checkboxs15 ='1' AND vstdate between '$d1' and '$d2' ";


//1.6 ใช้ยาผิด Routeี
$checkboxs16 =" SELECT  COUNT(checkboxs16) AS count_checkboxs16";
$checkboxs16.=" FROM  lamae_pharmacy_advice";
$checkboxs16.=" WHERE checkboxs16 ='1' AND vstdate between '$d1' and '$d2' ";


//1.7 หยุดใช้ยาก่อนกำหนด
$checkboxs17 =" SELECT  COUNT(checkboxs17) AS count_checkboxs17";
$checkboxs17.=" FROM  lamae_pharmacy_advice";
$checkboxs17.=" WHERE checkboxs17 ='1' AND vstdate between '$d1' and '$d2' ";


//1.8 ลืมรับประทานมากกว่า 1 มื้อขึ้นไป
$checkboxs18 =" SELECT  COUNT(checkboxs18) AS count_checkboxs18";
$checkboxs18.=" FROM  lamae_pharmacy_advice";
$checkboxs18.=" WHERE checkboxs18 ='1' AND vstdate between '$d1' and '$d2' ";


//1.9 ใช้ยาอื่นที่แพทย์ไม่ได้สั่งใช้ี
$checkboxs19 =" SELECT  COUNT(checkboxs19) AS count_checkboxs19";
$checkboxs19.=" FROM  lamae_pharmacy_advice";
$checkboxs19.=" WHERE checkboxs19 ='1' AND vstdate between '$d1' and '$d2' ";


//1.10 อื่นๆี
$checkboxs110 =" SELECT  COUNT(checkboxs110) AS count_checkboxs110";
$checkboxs110.=" FROM  lamae_pharmacy_advice";
$checkboxs110.=" WHERE checkboxs110 ='1' AND vstdate between '$d1' and '$d2' ";


//2. การเก็บรักษายาี
$checkboxm2 =" SELECT  COUNT(checkboxm2) AS count_checkboxm2";
$checkboxm2.=" FROM  lamae_pharmacy_advice";
$checkboxm2.=" WHERE checkboxm2 ='1' AND vstdate between '$d1' and '$d2' ";


//3. เกิดอาการไม่พึงประสงค์จากการใช้ยาี
$checkboxm3 =" SELECT  COUNT(checkboxm3) AS count_checkboxm3";
$checkboxm3.=" FROM  lamae_pharmacy_advice";
$checkboxm3.=" WHERE checkboxm3 ='1' AND vstdate between '$d1' and '$d2' ";


//4. เกิด Drug Interactionี
$checkboxm4 =" SELECT  COUNT(checkboxm4) AS count_checkboxm4";
$checkboxm4.=" FROM  lamae_pharmacy_advice";
$checkboxm4.=" WHERE checkboxm4 ='1' AND vstdate between '$d1' and '$d2' ";


//5. การควบคุมพฤติกรรมต่างๆี
$checkboxm5 =" SELECT  COUNT(checkboxm5) AS count_checkboxm5";
$checkboxm5.=" FROM  lamae_pharmacy_advice";
$checkboxm5.=" WHERE checkboxm5 ='1' AND vstdate between '$d1' and '$d2' ";


//5.1 สูบบุหรี่ี
$checkboxs51 =" SELECT  COUNT(checkboxs51) AS count_checkboxs51";
$checkboxs51.=" FROM  lamae_pharmacy_advice";
$checkboxs51.=" WHERE checkboxs51 ='1' AND vstdate between '$d1' and '$d2' ";

//5.2 การออกกำลังกาย
$checkboxs52 =" SELECT  COUNT(checkboxs52) AS count_checkboxs52";
$checkboxs52.=" FROM  lamae_pharmacy_advice";
$checkboxs52.=" WHERE checkboxs52 ='1' AND vstdate between '$d1' and '$d2' ";

//5.3 การควบคุมอาหารี
$checkboxs53 =" SELECT  COUNT(checkboxs53) AS count_checkboxs53";
$checkboxs53.=" FROM  lamae_pharmacy_advice";
$checkboxs53.=" WHERE checkboxs53 ='1' AND vstdate between '$d1' and '$d2' ";


//5.4 เครื่องดื่มแอลกอฮอล์ี
$checkboxs54 =" SELECT  COUNT(checkboxs54) AS count_checkboxs54";
$checkboxs54.=" FROM  lamae_pharmacy_advice";
$checkboxs54.=" WHERE checkboxs54 ='1' AND vstdate between '$d1' and '$d2' ";


//5.5 อื่นๆ
$checkboxs55 =" SELECT  COUNT(checkboxs55) AS count_checkboxs55";
$checkboxs55.=" FROM  lamae_pharmacy_advice";
$checkboxs55.=" WHERE checkboxs55 ='1' AND vstdate between '$d1' and '$d2' ";


//6. ความไม่เข้าใจเกี่ยวกับภาวะโรคี
$checkboxm6 =" SELECT  COUNT(checkboxm6) AS count_checkboxm6";
$checkboxm6.=" FROM  lamae_pharmacy_advice";
$checkboxm6.=" WHERE checkboxm6 ='1' AND vstdate between '$d1' and '$d2' ";



//7. ความไม่เข้าใจเกี่ยวกับยาี
$checkboxm7 =" SELECT  COUNT(checkboxm7) AS count_checkboxm7";
$checkboxm7.=" FROM  lamae_pharmacy_advice";
$checkboxm7.=" WHERE checkboxm7 ='1' AND vstdate between '$d1' and '$d2' ";


//8. ความไม่เข้าใจเกี่ยวกับภาวะแทรกซ้อน
$checkboxm8 =" SELECT  COUNT(checkboxm8) AS count_checkboxm8";
$checkboxm8.=" FROM  lamae_pharmacy_advice";
$checkboxm8.=" WHERE checkboxm8 ='1' AND vstdate between '$d1' and '$d2' ";


//9. ความไม่เข้าใจเกี่ยวกับการปฏิบัติตัว
$checkboxm9 =" SELECT  COUNT(checkboxm9) AS count_checkboxm9";
$checkboxm9.=" FROM  lamae_pharmacy_advice";
$checkboxm9.=" WHERE checkboxm9 ='1' AND vstdate between '$d1' and '$d2' ";


//10. Medication error
$checkboxm10 =" SELECT  COUNT(checkboxm10) AS count_checkboxm10";
$checkboxm10.=" FROM  lamae_pharmacy_advice";
$checkboxm10.=" WHERE checkboxm10 ='1' AND vstdate between '$d1' and '$d2' ";


//11. โรคประเมิน
$checkboxm11 =" SELECT  COUNT(checkboxm11) AS count_checkboxm11";
$checkboxm11.=" FROM  lamae_pharmacy_advice";
$checkboxm11.=" WHERE checkboxm11 ='1' AND vstdate between '$d1' and '$d2' ";


//12. อื่่นๆ
$checkboxm12 =" SELECT  COUNT(checkboxm12) AS count_checkboxm12";
$checkboxm12.=" FROM  lamae_pharmacy_advice";
$checkboxm12.=" WHERE checkboxm12 ='1' AND vstdate between '$d1' and '$d2' ";



//หา FBS น้อยกว่า 120 เฉพาะที่ให้คำปรึกษา
$sql_count_fbs120 =" SELECT COUNT(v.vn) AS fbs_count";
$sql_count_fbs120.=" FROM  vn_stat v";
$sql_count_fbs120.=" left outer join lab_head lh on lh.vn = v.vn";
$sql_count_fbs120.=" left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number";
$sql_count_fbs120.=" left outer join lab_items  li on li.lab_items_code = lo.lab_items_code";
$sql_count_fbs120.=" WHERE  v.vstdate between '$d1'  and '$d2'";
$sql_count_fbs120.=" AND lo.lab_items_code in ('3001','2057') and lo.confirm='Y' and lo.lab_order_result <120";
$sql_count_fbs120.=" AND (v.hn in (select hn from lamae_pharmacy_advice))";


//หา FBS มากกว่า 120 - 180 เฉพาะที่ให้คำปรึกษา
$sql_count_fbs120180 =" SELECT COUNT(v.vn) AS fbs_count";
$sql_count_fbs120180.=" FROM  vn_stat v";
$sql_count_fbs120180.=" left outer join lab_head lh on lh.vn = v.vn";
$sql_count_fbs120180.=" left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number";
$sql_count_fbs120180.=" left outer join lab_items  li on li.lab_items_code = lo.lab_items_code";
$sql_count_fbs120180.=" WHERE  v.vstdate between '$d1'  and '$d2'";
$sql_count_fbs120180.=" AND lo.lab_items_code in ('3001','2057') and lo.confirm='Y' and lo.lab_order_result >=120 and lo.lab_order_result <=180";
$sql_count_fbs120180.=" AND (v.hn in (select hn from lamae_pharmacy_advice))";


//หา FBS>180 เฉพาะที่ให้คำปรึกษา
$sql_count_fbs180 =" SELECT COUNT(v.vn) AS lab_count180";
$sql_count_fbs180.=" FROM  vn_stat v";
$sql_count_fbs180.=" left outer join lab_head lh on lh.vn = v.vn";
$sql_count_fbs180.=" left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number";
$sql_count_fbs180.=" left outer join lab_items  li on li.lab_items_code = lo.lab_items_code";
$sql_count_fbs180.=" WHERE  v.vstdate between '$d1'  and '$d2'";
$sql_count_fbs180.=" AND lo.lab_items_code in ('3001','2057') and lo.confirm='Y' and lo.lab_order_result >180";
$sql_count_fbs180.=" AND (v.hn in (select hn from lamae_pharmacy_advice))";


//หา HbA1c<6 เฉพาะที่ให้คำปรึกษา
$sql_count_hba1c6 =" SELECT COUNT(v.vn) AS lab_count_hba1c6";
$sql_count_hba1c6.=" FROM  vn_stat v";
$sql_count_hba1c6.=" left outer join lab_head lh on lh.vn = v.vn";
$sql_count_hba1c6.=" left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number";
$sql_count_hba1c6.=" left outer join lab_items  li on li.lab_items_code = lo.lab_items_code";
$sql_count_hba1c6.=" WHERE  v.vstdate between '$d1'  and '$d2' ";
$sql_count_hba1c6.=" AND lo.lab_items_code in ('48') and lo.confirm='Y' and lo.lab_order_result <6";
$sql_count_hba1c6.=" AND (v.hn in (select hn from lamae_pharmacy_advice))";

//หา HbA1c>6 and <8 เฉพาะที่ให้คำปรึกษา
$sql_count_hba1c68 =" SELECT COUNT(v.vn) AS lab_count_hba1c68";
$sql_count_hba1c68.=" FROM  vn_stat v";
$sql_count_hba1c68.=" left outer join lab_head lh on lh.vn = v.vn";
$sql_count_hba1c68.=" left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number";
$sql_count_hba1c68.=" left outer join lab_items  li on li.lab_items_code = lo.lab_items_code";
$sql_count_hba1c68.=" WHERE  v.vstdate between '$d1'  and '$d2' ";
$sql_count_hba1c68.=" AND lo.lab_items_code in ('48') and lo.confirm='Y' and lo.lab_order_result >=6 and lo.lab_order_result <=8";
$sql_count_hba1c68.=" AND (v.hn in (select hn from lamae_pharmacy_advice))";

//หา HbA1c>8 เฉพาะที่ให้คำปรึกษา
$sql_count_hba1c8 =" SELECT COUNT(v.vn) AS lab_count_hba1c8";
$sql_count_hba1c8.=" FROM  vn_stat v";
$sql_count_hba1c8.=" left outer join lab_head lh on lh.vn = v.vn";
$sql_count_hba1c8.=" left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number";
$sql_count_hba1c8.=" left outer join lab_items  li on li.lab_items_code = lo.lab_items_code";
$sql_count_hba1c8.=" WHERE  v.vstdate between '$d1'  and '$d2' ";
$sql_count_hba1c8.=" AND lo.lab_items_code in ('48') and lo.confirm='Y' and lo.lab_order_result >8";
$sql_count_hba1c8.=" AND (v.hn in (select hn from lamae_pharmacy_advice))";


//หาคนไข้้ที่ตรวจ BPS/BPD <130 AND BPD <180 เฉพาะที่ให้คำปรึกษา
$sql_count_bpsbpd1  =" SELECT  COUNT(DISTINCT(v.vn)) AS count_bpd1801 ";
$sql_count_bpsbpd1 .=" FROM  vn_stat v ";
$sql_count_bpsbpd1 .=" left outer join opdscreen oc on oc.hn = v.hn ";
$sql_count_bpsbpd1 .=" WHERE  v.vstdate between '$d1'  AND '$d2' AND oc.bps is not null and oc.bps !='' and oc.bps<130 and oc.bpd<180";
$sql_count_bpsbpd1 .=" AND (v.hn in (SELECT hn FROM lamae_pharmacy_advice)) ";


//หาคนไข้้ที่ตรวจ BPS/BPD >130 AND BPD >180 เฉพาะที่ให้คำปรึกษา
$sql_count_bpsbpd2  =" SELECT  COUNT(DISTINCT(v.vn)) AS count_bpd1802 ";
$sql_count_bpsbpd2 .=" FROM  vn_stat v ";
$sql_count_bpsbpd2 .=" left outer join opdscreen oc on oc.hn = v.hn ";
$sql_count_bpsbpd2 .=" WHERE  v.vstdate between '$d1'  AND '$d2' AND oc.bpd is not null and oc.bpd !='' and oc.bps>130 and oc.bpd>180";
$sql_count_bpsbpd2 .=" AND (v.hn in (SELECT hn FROM lamae_pharmacy_advice)) ";

//หาคนไข้ที่ตรวจ BMI >23 เฉพาะที่ให้คำปรึกษา
$sql_count_bmi23 =" SELECT  COUNT(DISTINCT(v.vn)) AS count_bmi23 ";
$sql_count_bmi23 .=" FROM  vn_stat v ";
$sql_count_bmi23 .=" LEFT OUTER JOIN opdscreen oc on oc.hn = v.hn ";
$sql_count_bmi23 .=" WHERE  v.vstdate between '$d1'  AND '$d2' AND oc.bmi!='' AND oc.bmi is not null ";
$sql_count_bmi23 .=" AND oc.bmi>23 ";
$sql_count_bmi23 .=" AND (v.hn in (SELECT hn FROM lamae_pharmacy_advice)) ";


//หา LDL-C>100 เฉพาะที่ให้คำปรึกษา
$sql_count_ldlc1 =" SELECT COUNT(v.vn) AS ldlc100";
$sql_count_ldlc1.=" FROM  vn_stat v";
$sql_count_ldlc1.=" left outer join lab_head lh on lh.vn = v.vn";
$sql_count_ldlc1.=" left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number";
$sql_count_ldlc1.=" left outer join lab_items  li on li.lab_items_code = lo.lab_items_code";
$sql_count_ldlc1.=" WHERE  v.vstdate between '$d1'  and '$d2'";
$sql_count_ldlc1.=" AND lo.lab_items_code in ('3008') and lo.confirm='Y' and lo.lab_order_result >100";
$sql_count_ldlc1.=" AND (v.hn in (select hn from lamae_pharmacy_advice))";


//หา LDL-C<100 เฉพาะที่ให้คำปรึกษา
$sql_count_ldlc2 =" SELECT COUNT(v.vn) AS ldlc100";
$sql_count_ldlc2.=" FROM  vn_stat v";
$sql_count_ldlc2.=" left outer join lab_head lh on lh.vn = v.vn";
$sql_count_ldlc2.=" left outer join lab_order lo on lo.lab_order_number = lh.lab_order_number";
$sql_count_ldlc2.=" left outer join lab_items  li on li.lab_items_code = lo.lab_items_code";
$sql_count_ldlc2.=" WHERE  v.vstdate between '$d1'  and '$d2'";
$sql_count_ldlc2.=" AND lo.lab_items_code in ('3008') and lo.confirm='Y' and lo.lab_order_result <100";
$sql_count_ldlc2.=" AND (v.hn in (select hn from lamae_pharmacy_advice))";



//show_pharmacy_advice_hostory.php โชว์ประวัติเปรียบเทียบผลต่างๆ เป็นรายบุคคล

//FBS < 120 เฉพาะคนไข้ที่เลือก และ เฉพาะที่ให้คำปรึกษา
$sql_count_cols_fbs120 =" SELECT  lh.vn,lo.lab_order_result  as FBS ";
$sql_count_cols_fbs120 .=" FROM  lamae_pharmacy_advice    lp ";
$sql_count_cols_fbs120 .=" LEFT OUTER JOIN lab_head lh on lh.vn = lp.vn ";
$sql_count_cols_fbs120 .=" LEFT OUTER JOIN  lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_count_cols_fbs120 .=" LEFT OUTER JOIN lab_items  li on li.lab_items_code = lo.lab_items_code ";
$sql_count_cols_fbs120 .=" WHERE  lp.hn='$hn' ";
$sql_count_cols_fbs120 .=" AND (lo.lab_items_code in ('3001')) ";
$sql_count_cols_fbs120 .=" AND lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_order_result <100  order by lp.vstdate desc";



//หาวันที่ล่าสุด ที่มาัรับบริการเฉพาะคนไข้ที่เลือก และ เฉพาะที่ให้คำปรึกษา
$sql_count_cols_vstdate =" SELECT  lp.vn,lp.vstdate ";
$sql_count_cols_vstdate .=" FROM  lamae_pharmacy_advice  lp ";
$sql_count_cols_vstdate .=" WHERE  lp.hn='$hn' ";


//FBS 120-180 เฉพาะคนไข้ที่เลือก และ เฉพาะที่ให้คำปรึกษา
$sql_count_cols_fbs120180  =" SELECT  lh.vn,lo.lab_order_result  as FBS ";
$sql_count_cols_fbs120180 .=" FROM  lamae_pharmacy_advice    lp ";
$sql_count_cols_fbs120180 .=" LEFT OUTER JOIN lab_head lh on lh.vn = lp.vn ";
$sql_count_cols_fbs120180 .=" LEFT OUTER JOIN  lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_count_cols_fbs120180 .=" LEFT OUTER JOIN lab_items  li on li.lab_items_code = lo.lab_items_code ";
$sql_count_cols_fbs120180 .=" WHERE  lp.hn='$hn' ";
$sql_count_cols_fbs120180 .=" AND (lo.lab_items_code in ('3001')) ";
$sql_count_cols_fbs120180 .=" AND lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_order_result >=120 and lo.lab_order_result <=180  order by lp.vstdate desc";



//FBS > 180 เฉพาะคนไข้ที่เลือก และ เฉพาะที่ให้คำปรึกษา
$sql_count_cols_fbs180 ="  SELECT  lh.vn,lo.lab_order_result  as FBS ";
$sql_count_cols_fbs180 .=" FROM  lamae_pharmacy_advice    lp ";
$sql_count_cols_fbs180 .=" LEFT OUTER JOIN lab_head lh on lh.vn = lp.vn ";
$sql_count_cols_fbs180 .=" LEFT OUTER JOIN  lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_count_cols_fbs180 .=" LEFT OUTER JOIN lab_items  li on li.lab_items_code = lo.lab_items_code ";
$sql_count_cols_fbs180 .=" WHERE  lp.hn='$hn' ";
$sql_count_cols_fbs180 .=" AND (lo.lab_items_code in ('3001')) ";
$sql_count_cols_fbs180 .=" AND lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_order_result >180  order by lp.vstdate desc";


//HbA1c <6 เฉพาะคนไข้ที่เลือก และ เฉพาะที่ให้คำปรึกษา
$sql_count_cols_hba1cmin6 ="  SELECT  lh.vn,lo.lab_order_result  as hba1cmin6 ";
$sql_count_cols_hba1cmin6 .=" FROM  lamae_pharmacy_advice    lp ";
$sql_count_cols_hba1cmin6 .=" LEFT OUTER JOIN lab_head lh on lh.vn = lp.vn ";
$sql_count_cols_hba1cmin6 .=" LEFT OUTER JOIN  lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_count_cols_hba1cmin6 .=" LEFT OUTER JOIN lab_items  li on li.lab_items_code = lo.lab_items_code ";
$sql_count_cols_hba1cmin6 .=" WHERE  lp.hn='$hn' ";
$sql_count_cols_hba1cmin6 .=" AND (lo.lab_items_code in ('48')) ";
$sql_count_cols_hba1cmin6 .=" AND lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_order_result <6  order by lp.vstdate desc";


//HbA1c between 6-8 เฉพาะคนไข้ที่เลือก และ เฉพาะที่ให้คำปรึกษา
$sql_count_cols_hba1cbet68 ="  SELECT  lh.vn,lo.lab_order_result  as hba1cmin6 ";
$sql_count_cols_hba1cbet68 .=" FROM  lamae_pharmacy_advice    lp ";
$sql_count_cols_hba1cbet68 .=" LEFT OUTER JOIN lab_head lh on lh.vn = lp.vn ";
$sql_count_cols_hba1cbet68 .=" LEFT OUTER JOIN  lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_count_cols_hba1cbet68 .=" LEFT OUTER JOIN lab_items  li on li.lab_items_code = lo.lab_items_code ";
$sql_count_cols_hba1cbet68 .=" WHERE  lp.hn='$hn' ";
$sql_count_cols_hba1cbet68 .=" AND (lo.lab_items_code in ('48')) ";
$sql_count_cols_hba1cbet68 .=" AND lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_order_result between '6' and '8'  order by lp.vstdate desc";


//HbA1c >8 เฉพาะคนไข้ที่เลือก และ เฉพาะที่ให้คำปรึกษา
$sql_count_cols_hba1cmax8 ="  SELECT  lh.vn,lo.lab_order_result  as hba1cmax8 ";
$sql_count_cols_hba1cmax8 .=" FROM  lamae_pharmacy_advice    lp ";
$sql_count_cols_hba1cmax8 .=" LEFT OUTER JOIN lab_head lh on lh.vn = lp.vn ";
$sql_count_cols_hba1cmax8 .=" LEFT OUTER JOIN  lab_order lo on lo.lab_order_number = lh.lab_order_number ";
$sql_count_cols_hba1cmax8 .=" LEFT OUTER JOIN lab_items  li on li.lab_items_code = lo.lab_items_code ";
$sql_count_cols_hba1cmax8 .=" WHERE  lp.hn='$hn' ";
$sql_count_cols_hba1cmax8 .=" AND (lo.lab_items_code in ('48')) ";
$sql_count_cols_hba1cmax8 .=" AND lh.confirm_report='Y' and lo.confirm='Y' and lo.lab_order_result >8  order by lp.vstdate desc";



//BP<130/180mg  เฉพาะคนไข้ที่เลือก และ เฉพาะที่ให้คำปรึกษา

$sql_count_cols_bp_min_130180 =" SELECT  COUNT(DISTINCT(v.vn)) AS count_bpd1801 ";
$sql_count_cols_bp_min_130180 .=" FROM  vn_stat v ";
$sql_count_cols_bp_min_130180 .=" left outer join opdscreen oc on oc.hn = v.hn ";
$sql_count_cols_bp_min_130180 .=" WHERE  v.vstdate between '$d1'  AND '$d2' ";
$sql_count_cols_bp_min_130180 .=" AND oc.bps is not null and oc.bps !='' ";
$sql_count_cols_bp_min_130180 .=" and oc.bps>130 and oc.bpd<180 ";
$sql_count_cols_bp_min_130180 .=" AND (v.hn in (SELECT hn FROM lamae_pharmacy_advice))  and v.hn='$hn' ";


?>