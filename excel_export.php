<?php
header('Content-type: application/csv');
if($exp_file=="opd"){ //choice
//echo "opd";
header('Content-Disposition: attachment; filename="opd_report.csv"'); 
}elseif($exp_file=="opd_suradthani"){ //choice
header('Content-Disposition: attachment; filename="opd_suradthani_report.csv"'); 
}
	
		
elseif($exp_file=="opd_nodiag"){ //choice
header('Content-Disposition: attachment; filename="opd_nodiag_report.csv"'); 
}
				
					
elseif($exp_file=="opd_chumphon"){ //choice
header('Content-Disposition: attachment; filename="opd_chumphon_report.csv"'); 
}elseif($exp_file=="refer_out"){ //choice
//echo "refer_point";
header('Content-Disposition: attachment; filename="refer_out_report.csv"'); 
}elseif($exp_file=="refer_in"){ //choice
//echo "refer_point";
header('Content-Disposition: attachment; filename="refer_in_report.csv"'); 
}elseif($exp_file=="drug_usage"){
//echo "den";
header('Content-Disposition: attachment; filename="drug_usage.csv"'); 
}elseif($exp_file=="drug_antibiotics"){
//echo "den";
header('Content-Disposition: attachment; filename="drug_antibiotics.csv"'); 
}elseif($exp_file=="den"){
//echo "den";
header('Content-Disposition: attachment; filename="den_report.csv"'); 
}elseif($exp_file=="ipd"){
//echo "den";
header('Content-Disposition: attachment; filename="ipd_report.csv"'); 
}elseif($exp_file=="ipd_1"){//�ç��è��µç �������
//echo "den";
header('Content-Disposition: attachment; filename="ipd_report_1.csv"'); 
}elseif($exp_file=="anc_opd"){
//echo "den";
header('Content-Disposition: attachment; filename="opd_anc_report.csv"'); 
}elseif($exp_file=="med"){
//echo "med";
header('Content-Disposition: attachment; filename="med_report.csv"'); 
}elseif($exp_file=="opd_uc1"){
//end choice
header('Content-Disposition: attachment; filename="opd_uc1_report.csv"');
}


elseif($exp_file=="opd_uc1_no_pdx"){
//end choice
header('Content-Disposition: attachment; filename="opd_uc1_no_pdx_report.csv"');
}


elseif($exp_file=="opd_uc2"){
//end choice
header('Content-Disposition: attachment; filename="opd_uc2_report.csv"');

}elseif($exp_file=="diag_between"){
//end choice
header('Content-Disposition: attachment; filename="diag_between_report.csv"');

}elseif($exp_file=="opd_uc3"){
//end choice
header('Content-Disposition: attachment; filename="opd_uc3_report.csv"');
}elseif($exp_file=="A2_11"){
//end choice
header('Content-Disposition: attachment; filename="A2_11_report.csv"');
}elseif($exp_file=="A2_14"){
//end choice
header('Content-Disposition: attachment; filename="A2_14_report.csv"');
}elseif($exp_file=="A1_5657"){
//end choice
header('Content-Disposition: attachment; filename="A1_5657_report.csv"');
}elseif($exp_file=="anc_wbc_list"){
//end choice
header('Content-Disposition: attachment; filename="anc_wbc_list_report.csv"');
}elseif($exp_file=="not_anc_wbc_er_list"){
//end choice
header('Content-Disposition: attachment; filename="not_anc_wbc_list_report.csv"');
}elseif($exp_file=="refer_export"){
//end choice
header('Content-Disposition: attachment; filename="refer_list_report.csv"');
}elseif($exp_file=="pharmacy_advice"){
//end choice
header('Content-Disposition: attachment; filename="pharmacy_advice_list_report.csv"');
}elseif($exp_file=="opd_baby"){
//end choice
header('Content-Disposition: attachment; filename="report_opd_baby_list_report.csv"');
}elseif($exp_file=="opd_average_service"){
//end choice
header('Content-Disposition: attachment; filename="report_opd_average_service_list_report.csv"');
}elseif($exp_file=="rcpt2"){
//end choice
header('Content-Disposition: attachment; filename="report_opd_rcpt2_report.csv"');
}elseif($exp_file=="rcpt_opd"){
//end choice
header('Content-Disposition: attachment; filename="report_opd_rcpt_report.csv"');
}elseif($exp_file=="rcpt_ipd"){
//end choice
header('Content-Disposition: attachment; filename="report_ipd_rcpt_report.csv"');
}



session_start();
include("phpconf.php");
include("func.php");
conDB();
	
	$ip=get_ip();
	$online=Check_Online($ip); //func check online
if($online){$ip_Log=user_change($ip);}else{$ip_Log=$_SESSION['ip_Log'];}

if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line
		//sql create table show
$med_type_err=$_REQUEST['med_type_err'];
$exp_file=$_REQUEST['exp_file'];

if($exp_file=="med"){
$d1=($sy1-543)."-".$sm1."-".$sd1;
$d2=($sy2-543)."-".$sm2."-".$sd2;//echo $d1."dd".$d2;
}else{
$d1=$sy1."-".$sm1."-".$sd1;
$d2=$sy2."-".$sm2."-".$sd2;//echo $d1."dd".$d2;
} 
//echo $d1."dd".$d2;






if($exp_file=="opd"){ //choice exp_file
//opd

$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'  ',v.dx4,'  ',v.dx5) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,ov.vsttime as vst_time,v.income,v.paid_money,remain_money,uc_money,item_money,
v.inc12 as v_drug,v.inc04 as v_xray,v.inc01 as v_lab,(v.inc06+v.inc07+v.inc13) as v_icd9 ,(v.inc05+v.inc09+v.inc02+v.inc03+v.inc08+v.inc11+v.inc14+v.inc15+v.inc16+v.inc17) as v_other ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="where  v.pcode='A7' and v.vstdate between '$d1' and  '$d2'  and pdx not like 'z35%' and pdx not like 'z36%' ";
$sqlOpd_Socail.="and pdx  not in('z32','z320','z321','z33','z34','z340','z348','z349') and pdx <>'' and pdx not like '%xx%' and pdx is not null ";

$sqlOpd_Socail.=" and v.hn not in (select distinct(d.hn) from dtmain d where d.vn = v.vn) ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";
				
				
				
				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����,����-ʡ��,����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,����¹,�����,x-ray,Lab,�ѵ����,����,���������\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$rsOpd_Socail['vst_time'].",".$th_date.",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("���ᾷ��",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rsOpd_Socail['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rsOpd_Socail['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  print change_misis($rsOpd_Socail['doc_name']).","; 
								  } 

							print $rsOpd_Socail['licenseno']; 
							print ",";
							print $rsOpd_Socail['v_drug']; 
							print ",";
							print $rsOpd_Socail['v_xray']; 
							print ",";
							print $rsOpd_Socail['v_lab']; 
							print ",";
							print $rsOpd_Socail['v_icd9']; 
							print ",";
							print $rsOpd_Socail['v_other']; 
							print ",";
							print $rsOpd_Socail['item_money']."\n"; 
						
						$i++;
					} //while 
			} //row opd
//end opd
}






if($exp_file=="opd_nodiag"){ //choice exp_file
//opd

$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'  ',v.dx4,'  ',v.dx5) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,ov.vsttime as vst_time,v.income,v.paid_money,remain_money,uc_money,item_money,
v.inc12 as v_drug,v.inc04 as v_xray,v.inc01 as v_lab,(v.inc06+v.inc07+v.inc13) as v_icd9 ,(v.inc05+v.inc09+v.inc02+v.inc03+v.inc08+v.inc11+v.inc14+v.inc15+v.inc16+v.inc17) as v_other ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="where  v.pcode='A7' and v.vstdate between '$d1' and  '$d2'  ";
$sqlOpd_Socail.=" and (pdx ='' or pdx is  null) ";

$sqlOpd_Socail.=" and v.hn not in (select distinct(d.hn) from dtmain d where d.vn = v.vn) ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";
				
				
				
				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����,����-ʡ��,����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,����¹,�����,x-ray,Lab,�ѵ����,����,���������\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$rsOpd_Socail['vst_time'].",".$th_date.",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("���ᾷ��",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rsOpd_Socail['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rsOpd_Socail['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  print change_misis($rsOpd_Socail['doc_name']).","; 
								  } 

							print $rsOpd_Socail['licenseno']; 
							print ",";
							print $rsOpd_Socail['v_drug']; 
							print ",";
							print $rsOpd_Socail['v_xray']; 
							print ",";
							print $rsOpd_Socail['v_lab']; 
							print ",";
							print $rsOpd_Socail['v_icd9']; 
							print ",";
							print $rsOpd_Socail['v_other']; 
							print ",";
							print $rsOpd_Socail['item_money']."\n"; 
						
						$i++;
					} //while 
			} //row opd
//end opd
}














else if($exp_file=="opd_suradthani"){ //choice exp_file
//opd

$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'  ',v.dx4,'  ',v.dx5) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,ov.vsttime as vst_time,v.income,v.paid_money,remain_money,uc_money,item_money,
v.inc12 as v_drug,v.inc04 as v_xray,v.inc01 as v_lab,(v.inc06+v.inc07+v.inc13) as v_icd9 ,(v.inc05+v.inc09+v.inc02+v.inc03+v.inc08+v.inc11+v.inc14+v.inc15+v.inc16+v.inc17) as v_other ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="where  v.pttype='32' and v.vstdate between '$d1' and  '$d2'  and pdx not like 'z35%' and pdx not like 'z36%' ";
$sqlOpd_Socail.="and pdx  not in('z32','z320','z321','z33','z34','z340','z348','z349') and pdx <>'' and pdx not like '%xx%' and pdx is not null ";

$sqlOpd_Socail.=" and v.hn not in (select distinct(d.hn) from dtmain d where d.vn = v.vn and icd !='Z012') ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";
				
				
				
				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����,����-ʡ��,����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,�����,x-ray,Lab,�ѵ����,����,���������\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$rsOpd_Socail['vst_time'].",".$th_date.",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("���ᾷ��",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rsOpd_Socail['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rsOpd_Socail['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  print change_misis($rsOpd_Socail['doc_name']).","; 
								  } 
						
							print $rsOpd_Socail['v_drug']; 
							print ",";
							print $rsOpd_Socail['v_xray']; 
							print ",";
							print $rsOpd_Socail['v_lab']; 
							print ",";
							print $rsOpd_Socail['v_icd9']; 
							print ",";
							print $rsOpd_Socail['v_other']; 
							print ",";
							print $rsOpd_Socail['item_money']."\n"; 
						
						$i++;
					} //while 
			} //row opd
//end opd
}




else if($exp_file=="opd_chumphon"){ //��Сѹ�ѧ�������
//opd

$sqlOpd_Socail="

select

concat(pt.pname,pt.fname,'   ',pt.lname) as ptname,pt.cid,pt.hn,ov.vstdate,ov.pdx,ov.dx0,ov.dx1,ov.dx2,ov.dx3,ov.dx4,ov.dx5,ov.inc_drug,ov.inc03,
ov.inc04,ov.dx_doctor, d.licenseno, d.name as doctor_name , ov.income,

ov.inc12,

(ov.inc02+ov.inc03+ov.inc04+ov.inc05+ov.inc06+
ov.inc07+ov.inc08+ov.inc09+ov.inc10+ov.inc11+
ov.inc13+ov.inc14+ov.inc15+ov.inc16) as other_income ,

ov.inc01, ov.income

from vn_stat ov ,patient pt ,ovst ovst, doctor d

where  ov.vn=ovst.vn and pt.hn=ov.hn and ov.vstdate between '$d1' and  '$d2'

and  dx_doctor = d.code

and ov.pttype='31'

 and ((ov.pdx like 'b2%')
 or (ov.dx0 like 'b2%') 
 or (ov.dx1 like 'b2%') 
 or (ov.dx2 like 'b2%') 
 or (ov.dx3 like 'b2%') 
 or (ov.dx4 like 'b2%') 
 or (ov.dx5 like 'b2%') 
 or (ov.pdx like 'e1%') 
 or (ov.dx0 like 'e1%') 
 or (ov.dx1 like 'e1%') 
 or (ov.dx2 like 'e1%') 
 or (ov.dx3 like 'e1%') 
 or (ov.dx4 like 'e1%') 
 or (ov.dx5 like 'e1%') 
 or (ov.pdx like 'e78%')
 or (ov.dx0 like 'e78%')
 or (ov.dx1 like 'e78%')
 or (ov.dx2 like 'e78%')
 or (ov.dx3 like 'e78%')
 or (ov.dx4 like 'e78%')
 or (ov.dx5 like 'e78%')
 or (ov.pdx like 'e78%')
 or (ov.dx0 like 'e05%')
 or (ov.dx1 like 'e05%')
 or (ov.dx2 like 'e05%')
 or (ov.dx3 like 'e05%')
 or (ov.dx4 like 'e05%')
 or (ov.dx5 like 'e05%')
 or (ov.pdx like 'i1%') 
 or (ov.dx0 like 'i1%') 
 or (ov.dx1 like 'i1%') 
 or (ov.dx2 like 'i1%') 
 or (ov.dx3 like 'i1%') 
 or (ov.dx4 like 'i1%') 
 or (ov.dx5 like 'i1%')


 or (ov.pdx like 'i64')
 or (ov.dx0 like 'i64')
 or (ov.dx1 like 'i64')
 or (ov.dx2 like 'i64')
 or (ov.dx3 like 'i64')
 or (ov.dx4 like 'i64')
 or (ov.dx5 like 'i64')

 or (ov.pdx like 'i698')
 or (ov.dx0 like 'i698')
 or (ov.dx1 like 'i698')
 or (ov.dx2 like 'i698')
 or (ov.dx3 like 'i698')
 or (ov.dx4 like 'i698')
 or (ov.dx5 like 'i698')

 or (ov.pdx like 'n18%') 
 or (ov.dx0 like 'n18%') 
 or (ov.dx1 like 'n18%') 
 or (ov.dx2 like 'n18%') 
 or (ov.dx3 like 'n18%') 
 or (ov.dx4 like 'n18%') 
 or (ov.dx5 like 'n18%') 
 or (ov.pdx like 'c0%') 
 or (ov.dx0 like 'c0%') 
 or (ov.dx1 like 'c0%') 
 or (ov.dx2 like 'c0%') 
 or (ov.dx3 like 'c0%') 
 or (ov.dx4 like 'c0%') 
 or (ov.dx5 like 'c0%') 
 or (ov.pdx like 'c1%') 
 or (ov.dx0 like 'c1%') 
 or (ov.dx1 like 'c1%') 
 or (ov.dx2 like 'c1%') 
 or (ov.dx3 like 'c1%') 
 or (ov.dx4 like 'c1%') 
 or (ov.dx5 like 'c1%') 
 or (ov.pdx like 'c2%') 
 or (ov.dx0 like 'c2%') 
 or (ov.dx1 like 'c2%') 
 or (ov.dx2 like 'c2%') 
 or (ov.dx3 like 'c2%') 
 or (ov.dx4 like 'c2%') 
 or (ov.dx5 like 'c2%') 
 or (ov.pdx like 'c3%') 
 or (ov.dx0 like 'c3%') 
 or (ov.dx1 like 'c3%') 
 or (ov.dx2 like 'c3%') 
 or (ov.dx3 like 'c3%') 
 or (ov.dx4 like 'c3%') 
 or (ov.dx5 like 'c3%') 
 or (ov.pdx like 'c4%') 
 or (ov.dx0 like 'c4%') 
 or (ov.dx1 like 'c4%') 
 or (ov.dx2 like 'c4%') 
 or (ov.dx3 like 'c4%') 
 or (ov.dx4 like 'c4%') 
 or (ov.dx5 like 'c4%') 
 or (ov.pdx like 'c5%') 
 or (ov.dx0 like 'c5%') 
 or (ov.dx1 like 'c5%') 
 or (ov.dx2 like 'c5%') 
 or (ov.dx3 like 'c5%') 
 or (ov.dx4 like 'c5%') 
 or (ov.dx5 like 'c5%') 
 or (ov.pdx like 'c6%') 
 or (ov.dx0 like 'c6%') 
 or (ov.dx1 like 'c6%') 
 or (ov.dx2 like 'c6%') 
 or (ov.dx3 like 'c6%') 
 or (ov.dx4 like 'c6%') 
 or (ov.dx5 like 'c6%') 
 or (ov.pdx like 'c7%') 
 or (ov.dx0 like 'c7%') 
 or (ov.dx1 like 'c7%') 
 or (ov.dx2 like 'c7%') 
 or (ov.dx3 like 'c7%') 
 or (ov.dx4 like 'c7%') 
 or (ov.dx5 like 'c7%') 
 or (ov.pdx like 'c8%') 
 or (ov.dx0 like 'c8%') 
 or (ov.dx1 like 'c8%') 
 or (ov.dx2 like 'c8%') 
 or (ov.dx3 like 'c8%') 
 or (ov.dx4 like 'c8%') 
 or (ov.dx5 like 'c8%') 
 or (ov.pdx like 'c9%') 
 or (ov.dx0 like 'c9%') 
 or (ov.dx1 like 'c9%') 
 or (ov.dx2 like 'c9%') 
 or (ov.dx3 like 'c9%') 
 or (ov.dx4 like 'c9%') 
 or (ov.dx5 like 'c9%'))
order by ov.vstdate



";
				
				
				
				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd

					print "��§ҹ�������ԡ�÷ҧ���ᾷ��ͧ�����¹͡�ä������ѧ���ࡳ���ӹѡ�ҹ��Сѹ�ѧ��  ��Ш���͹ \n";
					print "ʶҹ��Һ�����͢��� �ç��Һ������ \n";
					print"���,����-ʡ��,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,ᾷ��,����¹,diag1,diag2,diag3,diag4,diag5,diag6,diag7,�����,��Һ�ԡ��,�������,���\n";

					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);

						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
							
							print ($i+1);
							print ",";
							print $rsOpd_Socail['ptname'];
							print ",";
							print $cid;
							print ",";
							print $rsOpd_Socail['hn'];
							print ",";
							print $rsOpd_Socail['vstdate'];
							print ",";
							print $rsOpd_Socail['doctor_name'];
							print ",";
							print $rsOpd_Socail['licenseno'];
							print ",";
							print $rsOpd_Socail['pdx'];
							print ",";
							print $rsOpd_Socail['dx0'];
							print ",";
							print $rsOpd_Socail['dx1'];
							print ",";
							print $rsOpd_Socail['dx2'];
							print ",";
							print $rsOpd_Socail['dx3'];
							print ",";
							print $rsOpd_Socail['dx4'];
							print ",";
							print $rsOpd_Socail['dx5'];
							print ",";
							print $rsOpd_Socail['inc12']; 
							print ",";
							print $rsOpd_Socail['other_income'];
							print ",";
							print $rsOpd_Socail['inc01']; 
							print ",";
							print $rsOpd_Socail['income']."\n"; 
						
						$i++;
					} //while 
			} //row opd
//end opd
}

















elseif($exp_file=="drug_usage"){

$sqlOpd_Socail="SELECT
        px.icode as icode,d.name as drug_name,d.units as drug_unit,px.unitprice as unit_price,
        sum(px.qty) as total_use,
        sum(px.unitprice*px.qty) as sum_price
FROM
        opitemrece px

LEFT OUTER JOIN drugitems d ON px.icode=d.icode

WHERE 
	px.vstdate BETWEEN '$d1' AND '$d2'
AND
	px.icode like '1%'

GROUP BY  px.icode
ORDER BY  d.name";

$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				
if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
	
	print "������,�����Ǫ�ѳ��,˹���,�Ҥ�/˹���,�ӹǹ���,��Ť�ҡ������";
	print "\n";			

	$i=0;
	
	while($i<mysql_num_rows($resultOpd_Socail)){//while
		
		$rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     				 
        print $rsOpd_Socail['icode'];
		print ",";
		print $rsOpd_Socail['drug_name'];
		print ",";
		print str_replace(","," ",$rsOpd_Socail['drug_unit']);
		print ",";
		print $rsOpd_Socail['unit_price'];
		print ",";
		print $rsOpd_Socail['total_use'];
		print ",";
		print $rsOpd_Socail['sum_price'];
		print "\n";
											
		$i++;
		} //while 			
	}
}//end drug_antibiotics




elseif($exp_file=="refer_out"){


if($department!=null){
	if($department=='All'){
		
$sqlSocail_refer_opd="

SELECT ro.department,ro.pdx as icd,ic.name as icd_name,count(ro.pdx) AS total_group 

FROM referout  ro

LEFT OUTER JOIN icd101 ic on ic.code = ro.pdx

WHERE 
	ro.refer_date BETWEEN '$d1' AND '$d2'  
	
GROUP BY ro.pdx 

ORDER BY ro.department";
	
	
	}else{

$sqlSocail_refer_opd="

SELECT ro.department,ro.pdx as icd,ic.name as icd_name,count(ro.pdx) AS total_group 

FROM referout  ro

LEFT OUTER JOIN icd101 ic on ic.code = ro.pdx

WHERE
	ro.department ='$department' AND
	ro.refer_date BETWEEN '$d1' AND '$d2' 
	
GROUP BY ro.pdx 

ORDER BY ro.pdx";
	}
}



$resultOpd_Socail=ResultDB($sqlSocail_refer_opd);//echo mysql_num_rows($resultDenService);
				
if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
	
	print "���,Ἱ�,ICD10,���� ICD10,�ӹǹ����";
	print "\n";			

	$i=0;
	
	while($i<mysql_num_rows($resultOpd_Socail)){//while
		
		$rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     				 
        print $i+1;
		print ",";
		print $rsOpd_Socail['department'];
		print ",";
		print $rsOpd_Socail['icd'];
		print ",";
		print str_replace(","," ",$rsOpd_Socail['icd_name']);
		print ",";
		print $rsOpd_Socail['total_group'];
		print "\n";
											
		$i++;
		} //while 			
	}
}//end drug_antibiotics





elseif($exp_file=="refer_in"){


if($refer_point!=null){
	if($refer_point=='All'){
		
$sqlSocail_refer_opd="

SELECT ri.refer_point,ri.icd10,ic.name as icd_name,count(ri.icd10) AS total_group 

FROM referin  ri

LEFT OUTER JOIN icd101 ic on ic.code = ri.icd10

WHERE 
	ri.refer_date BETWEEN '$d1' AND '$d2'  
	
GROUP BY ri.icd10 

ORDER BY ri.refer_point";
	
	
	}else{

$sqlSocail_refer_opd="

SELECT ri.refer_point,ri.icd10,ic.name as icd_name,count(ri.icd10) AS total_group 

FROM referin  ri

LEFT OUTER JOIN icd101 ic on ic.code = ri.icd10

WHERE 
	ri.refer_point='$refer_point' AND
	ri.refer_date BETWEEN '$d1' AND '$d2'
		
GROUP BY ri.icd10 

ORDER BY ri.refer_point";
	}
}



$resultOpd_Socail=ResultDB($sqlSocail_refer_opd);//echo mysql_num_rows($resultDenService);
				
if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
	
	print "���,Ἱ�,ICD10,���� ICD10,�ӹǹ����";
	print "\n";			

	$i=0;
	
	while($i<mysql_num_rows($resultOpd_Socail)){//while
		
		$rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     				 
        print $i+1;
		print ",";
		print $rsOpd_Socail['refer_point'];
		print ",";
		print $rsOpd_Socail['icd10'];
		print ",";
		print str_replace(","," ",$rsOpd_Socail['icd_name']);
		print ",";
		print $rsOpd_Socail['total_group'];
		print "\n";
											
		$i++;
		} //while 			
	}
}//end drug_antibiotics








elseif($exp_file=="drug_antibiotics"){

$sqlOpd_Socail="SELECT
        px.icode as icode,d.name as drug_name,d.units as drug_unit,px.unitprice as unit_price,
        sum(px.qty) as total_use,
        sum(px.unitprice*px.qty) as sum_price
FROM
        opitemrece px

LEFT OUTER JOIN drugitems d ON px.icode=d.icode

WHERE px.icode IN ('1000028','1000030','1460566','1510007','1000034',
'1460057','1460071','1430502','1460570','1000060','1520919','1520908',
'1510026','1000082','1510027','1000084','1000085','1480609','1000140',
'1520034','1000188','1460235','1440207','1000221','1000231','1000235',
'1000233','1510065','1000267')

AND px.vstdate BETWEEN '$d1' AND '$d2'

GROUP BY  px.icode
ORDER BY  d.name";

$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				
if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
	
	print "������,�����Ǫ�ѳ��,˹���,�Ҥ�/˹���,�ӹǹ���,��Ť�ҡ������";
	print "\n";			

	$i=0;
	
	while($i<mysql_num_rows($resultOpd_Socail)){//while
		
		$rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     				 
        print $rsOpd_Socail['icode'];
		print ",";
		print $rsOpd_Socail['drug_name'];
		print ",";
		print $rsOpd_Socail['drug_unit'];
		print ",";
		print str_replace(","," ",$rsOpd_Socail['drug_unit']);
		print ",";
		print $rsOpd_Socail['total_use'];
		print ",";
		print $rsOpd_Socail['sum_price'];
		print "\n";
											
		$i++;
		} //while 			
	}
}//end drug_antibiotics





elseif($exp_file=="not_anc_wbc_er_list"){ //choice exp_file
//opd

$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,ov.main_dep as main_dep,ks.department as department_name,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,v.pttypeno as pttypeno,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money,pt.pttype as pttype_code,pt.name as pttype_name, concat(hc.hosptype,'',hc.name) as hospmain ";

$sqlOpd_Socail.="from vn_stat v ";

$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="left outer join pttype pt on pt.pttype=v.pttype ";
$sqlOpd_Socail.="left outer join hospcode hc on hc.hospcode = v.hospmain ";
$sqlOpd_Socail.="left outer join kskdepartment ks on ks.depcode=ov.main_dep ";


$sqlOpd_Socail.="where v.vstdate between '$d1' and  '$d2' and ov.main_dep not in('008','009','010','012') ";

//$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";

$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";

	

				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,Ἱ�,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,�Ţ���ѵ�,ʶҹ��ԡ��,�����Է���,�����Է������ѡ��,��Һ�ԡ��\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$rsOpd_Socail['department_name'].",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",". $th_date.",".$rsOpd_Socail['pttypeno'].",".$rsOpd_Socail['hospmain'].",".$rsOpd_Socail['pttype_code'].",".$rsOpd_Socail['pttype_name'].",".$rsOpd_Socail['item_money']."\n";

					
						
						$i++;
					} //while 
			} //row opd
//end opd

}





elseif($exp_file=="opd_average_service"){ //�����������㹡�����Ѻ��ԡ��
//opd

$sqlOpd_Socail="select s.service6,s.service16,concat(pt.pname,pt.fname,'  ',pt.lname)as pt_name,s.vn,s.hn, s.vstdate, s.vsttime,s.service16 as pharmacy_confirm, s.service3 as sendpt2screen, s.service4 as startscreen ,
s.service11 as send2doctor, s.service5 as startexam,s.service12 as finishexam,
sec_to_time(time_to_sec(service4)-time_to_sec(service3)) as  waitforscreen,
time_to_sec(service4)-time_to_sec(service3) as waitforscreen2,
sec_to_time(time_to_sec(service11)-time_to_sec(service4)) as timetoscreen,
time_to_sec(service11)-time_to_sec(service4) as timetoscreen2,
sec_to_time(time_to_sec(service5)-time_to_sec(service11)) as waitforexamine,
time_to_sec(service5)-time_to_sec(service11) as waitforexamine2,
sec_to_time(time_to_sec(service12)-time_to_sec(service5)) as timetoexamine,
time_to_sec(service12)-time_to_sec(service5) as timetoexamine2,

sec_to_time(time_to_sec(service16)-time_to_sec(service3)) as timefromvsttime2finis,
time_to_sec(service16)-time_to_sec(service3) as timefromvsttime2finish2,

sec_to_time(time_to_sec(service6)-time_to_sec(service12)) as timefromvsttime2finishpharmacy,
time_to_sec(service6)-time_to_sec(service12) as timefromvsttime2finishpharmacy2,


sec_to_time(time_to_sec(service16)-time_to_sec(service6)) as timefromvsttime2finishpharmacyconfirm,
time_to_sec(service16)-time_to_sec(service6) as timefromvsttime2finishpharmacyconfirm2

from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:00:00' and s.service12 <='15:30:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday) ";
	

$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				
if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
	
	print",,,��§ҹ���������ͤ������¡�����Ѻ��ԡ�âͧ����\n";
	print",,,�����ҧ�ѹ��� $d1 �֧ $d2\n\n";
	
	print",,,�����������ʡ�չ ";
	
	$sqlOpd_Socail_1="SELECT  s.*,  


sec_to_time(avg(time_to_sec(service4)-time_to_sec(service3))) as  waitforscreen_sum

from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:30:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo $rsOpd_Socail1['waitforscreen_sum'];

echo "�ҷ�";


echo ",,,,���������ʡ�չ ";
$sqlOpd_Socail_1="SELECT  s.*,  

sec_to_time(avg(time_to_sec(service11)-time_to_sec(service4))) as timetoscreen2_sum


from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:30:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo $rsOpd_Socail1['timetoscreen2_sum'];

echo "�ҷ�";


echo ",,,,����������͵�Ǩ ";
$sqlOpd_Socail_1="SELECT  s.*,  

sec_to_time(avg(time_to_sec(service5)-time_to_sec(service11))) as waitforexamine_sum

from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:30:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo $rsOpd_Socail1['waitforexamine_sum'];

echo "�ҷ�";



print"\n";


echo ",,,���������ᾷ���Ǩ ";
$sqlOpd_Socail_1="SELECT  s.*,  

sec_to_time(avg(time_to_sec(service12)-time_to_sec(service5))) as timetoexamine2_sum


from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:30:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo $rsOpd_Socail1['timetoexamine2_sum'];

echo "�ҷ�";




print",,,,�������������آ�֡�� ";

$sqlOpd_Socail_1="SELECT  s.*,  


sec_to_time(avg(time_to_sec(service6)-time_to_sec(service12))) as timefromvsttime2finishpharmacy_sum

from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:30:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo $rsOpd_Socail1['timefromvsttime2finishpharmacy_sum'];

echo "�ҷ�";




print",,,,��������·����ͧ�� ";

$sqlOpd_Socail_1="SELECT  s.*,  


sec_to_time(avg(time_to_sec(service16)-time_to_sec(service6))) as timefromvsttime2finishpharmacyconfirm2_sum


from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:30:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo $rsOpd_Socail1['timefromvsttime2finishpharmacyconfirm2_sum'];

echo "�ҷ�";


print "\n";
print ",,,��������µ����������鹾���������Ҩ�����ش����Ѻ�� ";

$sqlOpd_Socail_1="SELECT  s.*,  

 sec_to_time(avg(time_to_sec(service16)-time_to_sec(service3))) as timefromvsttime2finish2_sum


from service_time s

left outer join patient pt on pt.hn = s.hn

where s.vstdate between '$d1' and '$d2'

and s.service3 is not null and s.service4 is not null and

s.service5 is not null and s.service11 is not null and s.service12 is not null and s.service6 is not null and s.service16 is not null and

s.service3 >= '08:30:00' and s.service12 <='16:00:00' and

s.service11>=s.service4 and s.service5>=s.service11 and 

s.service12>=s.service5


and s.vstdate not in (select holiday_date from holiday)";

$resultOpd_Socail_1=ResultDB($sqlOpd_Socail_1);//echo

$count_record=mysql_num_rows($resultOpd_Socail_1);

$rsOpd_Socail1=mysql_fetch_array($resultOpd_Socail_1);
	
echo $rsOpd_Socail1['timefromvsttime2finish2_sum'];

echo "�ҷ�";



	print"\n\n";

	print"���,HN,�ѹ���,����,�����������,������ʡ�չ,�����ʡ�չ,ʡ�չ����,����㹡��ʡ�չ,�����͵�Ǩ,�������Ǩ,��Ǩ����,����㹡�õ�Ǩ,��������آ�֡��,�����ʵ��������,����������,������ҷ����ͧ��,����Visit�֧�Ѻ��\n";
	
	$i=0;
	
	while($i<mysql_num_rows($resultOpd_Socail)){//while

	   $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
       print ($i+1).",".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vstdate'].",".$rsOpd_Socail['vsttime'].",".$rsOpd_Socail['sendpt2screen'].",". $rsOpd_Socail['waitforscreen'].",".$rsOpd_Socail['startscreen'].",".$rsOpd_Socail['send2doctor'].",".$rsOpd_Socail['timetoscreen'].",".$rsOpd_Socail['waitforexamine'].",".$rsOpd_Socail['startexam'].",".$rsOpd_Socail['finishexam'].",".$rsOpd_Socail['timetoexamine'].",".$rsOpd_Socail['timefromvsttime2finishpharmacy'].",".$rsOpd_Socail['service6'].",".$rsOpd_Socail['pharmacy_confirm'].",".$rsOpd_Socail['timefromvsttime2finishpharmacyconfirm'].",".$rsOpd_Socail['timefromvsttime2finis']."\n";

					
						
						$i++;
					} //while 
			} //row opd
//end opd


}








elseif($exp_file=="pharmacy_advice"){ //��§ҹ������ӻ�֡������ͧ��
//opd

$sql_pharmacy_advice="SELECT * FROM lamae_pharmacy_advice WHERE vstdate between '$d1' and  '$d2' ";


	$result_pharmacy=ResultDB($sql_pharmacy_advice);//echo mysql_num_rows($resultDenService);
	
	if(mysql_num_rows($result_pharmacy)>0){ //row opd
		
		print"�����������йӻ�֡������ͧ�� �����ҧ�ѹ��� $d1 �֧ $d2 \n";
		print"���,HN,VSTDATE,SCREEN_TYPE\n";
					
			$i=0;
			while($i<mysql_num_rows($result_pharmacy)){//while
						
				$rs_pharmacy=mysql_fetch_array($result_pharmacy);
				
					
                 print ($i+1).",".$rs_pharmacy['hn'].",".$rs_pharmacy['vstdate'].",".$rs_pharmacy['screen_type']."\n";

					
						
						$i++;
					} //while 
			} //row opd
//end opd

echo "\n\n\n";
echo ",,,Screen Type\n";
echo ",,,1.ᾷ��\n";
echo ",,,2.���Ѫ��\n";
echo ",,,3.��Һ��\n";
echo ",,,4.�����¢��Ѻ��ԡ���ͧ\n";

}








elseif($exp_file=="anc_wbc_list"){ //choice exp_file
//opd

$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,ov.main_dep as main_dep,ks.department as department_name,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,v.pttypeno as pttypeno,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money,pt.pttype as pttype_code,pt.name as pttype_name ";

$sqlOpd_Socail.="from vn_stat v ";

$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="left outer join pttype pt on pt.pttype=v.pttype ";

$sqlOpd_Socail.="left outer join kskdepartment ks on ks.depcode=ov.main_dep ";


$sqlOpd_Socail.="where v.vstdate between '$d1' and  '$d2' and ov.main_dep in('008','010','012')";

//$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";

$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";


				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,Ἱ�,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,�Ţ���ѵ�,�����Է���,�����Է������ѡ��,��Һ�ԡ��\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$rsOpd_Socail['department_name'].",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",". $th_date.",".$rsOpd_Socail['pttypeno'].",".$rsOpd_Socail['pttype_code'].",".$rsOpd_Socail['pttype_name'].",".$rsOpd_Socail['item_money']."\n";

					
						
						$i++;
					} //while 
			} //row opd
//end opd

}








elseif($exp_file=="refer_export"){ //choice exp_file
//opd
				




$sql_Socail="select
ro.confirm_text,
ro.refer_hospcode, concat(hp.hosptype,' ',hp.name) as refer_hospname,
rp.refer_response_type_name,rt.refer_type_name,ro.department,ro.vn,ro.refer_number,ro.rfrcs,ro.refer_response_type_id,ro.hn,rfp.name as refer_point_name,ro.pre_diagnosis,d.name as doctor_name,ro.refer_number,ks.department as department_name,ro.other_text,ro.refer_date,o.vstdate,ro.refer_time,o.vsttime,

concat(p.pname,p.fname,'  ',p.lname) as ptname,  concat(h.hosptype,' ',h.name) as hospname,pe.name as pttype_name,

 r.name as refername, ro.refer_point,ro.pre_diagnosis,ro.pdx as icd,ic.name as icd_name ,o.vstdate

   from referout ro


   left outer join ovst o on o.vn = ro.vn
   left outer join patient p on p.hn=ro.hn
   left outer join hospcode h on h.hospcode = ro.hospcode
   left outer join rfrcs r on r.rfrcs = ro.rfrcs
   left outer join refer_point_list rfp on rfp.name = ro.refer_point 
   left outer join kskdepartment ks on ks.depcode = ro.depcode
   left outer join doctor d on d.code = ro.doctor
   left outer join pttype pe on pe.pttype = o.pttype
   left outer join icd101 ic on ic.code = ro.pdx
   left outer join refer_type rt on rt.refer_type = ro.refer_type
   left outer join refer_response_type rp on rp.refer_response_type_id = ro.refer_response_type_id
   
   left outer join hospcode hp on hp.hospcode = ro.refer_hospcode

   where   ro.department = 'OPD' and ro.refer_date between '$d1' and '$d2' and ro.refer_type='$refer_type' and ro.depcode='$department_type'


   union  
   
   select 
   ro.confirm_text,
   ro.refer_hospcode, concat(hp.hosptype,' ',hp.name) as refer_hospname,
   rp.refer_response_type_name,rt.refer_type_name,ro.department,ro.vn,ro.refer_number,ro.rfrcs,ro.refer_response_type_id,ro.hn,rfp.name as refer_point_name,ro.pre_diagnosis,d.name as doctor_name,ro.refer_number,ks.department as department_name,ro.other_text,ro.refer_date,o.regdate as vstdate,

   ro.refer_time,o.regtime as vsttime,concat(p.pname,p.fname,'  ',p.lname) as ptname,
   concat(h.hosptype,' ',h.name) as hospname,pe.name as pttype_name,  r.name as refername,
   ro.refer_point,ro.pre_diagnosis,ro.pdx as icd,ic.name as icd_name,o.regdate as vstdate

   from referout ro

   left outer join ipt o on o.an = ro.vn
   left outer join patient p on p.hn=ro.hn
   left outer join hospcode h on h.hospcode = ro.hospcode
   left outer join rfrcs r on r.rfrcs = ro.rfrcs

   left outer join refer_point_list rfp on rfp.name = ro.refer_point 

   left outer join kskdepartment ks on ks.depcode = ro.depcode


   left outer join doctor d on d.code = ro.doctor
   left outer join pttype pe on pe.pttype = o.pttype
   left outer join icd101 ic on ic.code = ro.pdx
   left outer join refer_type rt on rt.refer_type = ro.refer_type
   left outer join refer_response_type rp on rp.refer_response_type_id = ro.refer_response_type_id
   left outer join hospcode hp on hp.hospcode = ro.refer_hospcode

   where   ro.department = 'IPD' and ro.refer_date between '$d1' and '$d2'  and ro.refer_type='$refer_type' and ro.depcode='$department_type' ";



				$result_Socail=ResultDB($sql_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($result_Socail)>0){ //row opd

					echo ",,,,Ẻ��§ҹ����觵�� (�����ҧ�ѹ��� $d1 �֧ $d2)";
					echo "\n,,,,   O ���㹨ѧ��Ѵ";
					echo "\n,,,,   O ��¹͡�ѧ��Ѵ";
					echo "\n\n";



					print"No,��ͧ,�-�-� �����,HN,����-ʡ�ż�����,�Ţ���Refer,�ԹԨ����ä��鹵�,����ԹԨ�����ѡ,˹��»��·ҧ,�˵ؼŷ��١����ʸ,���˵ط���觵��,���駷��1,���駷��2,���駷��3,�š���ѡ��\n";
					$i=0;
			          while($i<mysql_num_rows($result_Socail)){//while
						 $rs_Socail=mysql_fetch_array($result_Socail);
						     
						  $th_date=change_misis($rs_Socail['ptname']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						/*  if($rs_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x */


                           print ($i+1).",".$rs_Socail['department_name'].",".$rs_Socail['refer_date'].",".$rs_Socail['hn'].",".$rs_Socail['ptname'].",".$rs_Socail['refer_number'].",".$rs_Socail['pre_diagnosis'].",".$rs_Socail['pdx']. ",".$rs_Socail['refer_hospname'].",".$rs_Socail['refer_response_type_id'].",".$rs_Socail['rfrcs'].",".$rs_Socail['other_text'].",".''.",".''.",".$rs_Socail['confirm_text']."\n";

						  

					
						
						$i++;
					} //while 
					
							
echo "\n,,*���˵ط���觵��,,,,,,*�˵ؼŷ��١����ʸ";
echo "\n,,1 ���¶֧ �ԹԨ��� �ѳ�ٵ�/�觵�� ,,,,,,1 ���¶֧ ����ʸ����觵�� (��§���)";
echo "\n,,2 ���¶֧ �մ��������ö�����§�� ��ҹ�ؤ�ҡ�,,,,,,2 ���¶֧  ����ʸ����觵�� (�Ҵᾷ��੾�зҧ)";
echo "\n,,3 ���¶֧ �մ��������ö�����§�� ��ҹ����ͧ��� /ʶҹ���,,,,,,3 ���¶֧ ����ʸ����觵�� (�Ҵ����ͧ��ͷҧ���ᾷ��)";
echo "\n,,4 ���¶֧ �մ��������ö�����§�� ��ҹ�ؤ�ҡ� ����ͧ��� ���ʶҹ���,,,,,,4 ���¶֧ ����ʸ����觵�� (�˵ؼ�����)";
echo "\n,,5 ���¶֧ �մ��������ö�����§�� ��ҹ�Ԫҡ��";
echo "\n,,6 ���¶֧ �մ��������ö��§�� �����(�蹼�ҵѴ)";
echo "\n,,7 ���¶֧ �մ��������ö��§�� �������/�ҵԵ�ͧ���";
echo "\n,,8 ���¶֧ �մ��������ö��§�� ���ͧ������Է���,,,,,,*���駷��(1 2 3) ���¶֧ �š�û���ҹ�ҹ����Ф���";
echo "\n,,9 ���¶֧ ���ͧ�ҡ�繼����»�Сѹ�ѧ��";
echo "\n,,A ���¶֧ ��������㨢ͧ����Ѻ��ԡ��";
echo "\n,,B ���¶֧ ����������������ç��Һ��";
echo "\n,,C ���¶֧ �ç��Һ��������ѡ��Ҿ���д���";
echo "\n,,D ���¶֧ þ.���ѡ��Ҿ����������������˵����";
			

			} //row opd
//end opd

}







elseif($exp_file=="opd_uc1"){ //choice exp_file
//opd
$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'   ',v.dx4,'  ',v.dx5) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="where  v.pcode='UC' and v.vstdate between '$d1' and  '$d2'";
$sqlOpd_Socail.="and v.pttype in('52','54')";

/*
$sqlOpd_Socail.="and ((pdx not between 'E100' and 'E119' and pdx !='I10')";
$sqlOpd_Socail.="and  (dx0 not between 'E100' and 'E119' and dx0 !='I10')";
$sqlOpd_Socail.="and  (dx1 not between 'E100' and 'E119' and dx1 !='I10')";
$sqlOpd_Socail.="and  (dx2 not between 'E100' and 'E119' and dx2 !='I10')";
$sqlOpd_Socail.="and  (dx3 not between 'E100' and 'E119' and dx3 !='I10')";
$sqlOpd_Socail.="and  (dx4 not between 'E100' and 'E119' and dx4 !='I10')";
$sqlOpd_Socail.="and  (dx5 not between 'E100' and 'E119' and dx5 !='I10'))";
*/

$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";


				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,��,����(��),����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,����¹,��Һ�ԡ��\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("���ᾷ��",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rsOpd_Socail['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rsOpd_Socail['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  print change_misis($rsOpd_Socail['doc_name']).","; 
								  } 
  							print $rsOpd_Socail['licenseno'].",";
							
							//if($rsOpd_Socail['item_money']>700){
							//$item_money=700;print number_format($item_money)."\n"; }else{
							print $rsOpd_Socail['item_money']."\n"; 
							//}
							
						$i++;
					} //while 
			} //row opd
//end opd










}elseif($exp_file=="opd_uc1_no_pdx"){ //choice exp_file
//opd
$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'   ',v.dx4,'  ',v.dx5) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="where  v.pcode='UC' and v.vstdate between '$d1' and  '$d2'";
$sqlOpd_Socail.="and v.pttype in('52','54')";

/*
$sqlOpd_Socail.="and ((pdx not between 'E100' and 'E119' and pdx !='I10')";
$sqlOpd_Socail.="and  (dx0 not between 'E100' and 'E119' and dx0 !='I10')";
$sqlOpd_Socail.="and  (dx1 not between 'E100' and 'E119' and dx1 !='I10')";
$sqlOpd_Socail.="and  (dx2 not between 'E100' and 'E119' and dx2 !='I10')";
$sqlOpd_Socail.="and  (dx3 not between 'E100' and 'E119' and dx3 !='I10')";
$sqlOpd_Socail.="and  (dx4 not between 'E100' and 'E119' and dx4 !='I10')";
$sqlOpd_Socail.="and  (dx5 not between 'E100' and 'E119' and dx5 !='I10'))";
*/

$sqlOpd_Socail.=" and (pdx =''  or pdx is null)  ";
$sqlOpd_Socail.=" group by v.vn order by v.vstdate,v.hn ";


				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,��,����(��),����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,����¹,��Һ�ԡ��\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("���ᾷ��",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rsOpd_Socail['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rsOpd_Socail['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  print change_misis($rsOpd_Socail['doc_name']).","; 
								  } 
  							print $rsOpd_Socail['licenseno'].",";
							
							//if($rsOpd_Socail['item_money']>700){
							//$item_money=700;print number_format($item_money)."\n"; }else{
							print $rsOpd_Socail['item_money']."\n"; 
							//}
							
						$i++;
					} //while 
			} //row opd
//end opd























}elseif($exp_file=="opd_uc2"){ //choice exp_file
//opd

$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'  ',v.dx4,'  ',v.dx5) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money ";

$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="where  v.pcode='UC' and v.vstdate between '$d1' and  '$d2'";
$sqlOpd_Socail.="and v.pttype in('52','54')";


$sqlOpd_Socail.="and((pdx between 'E100' and 'E119' )or(pdx='I10')";
$sqlOpd_Socail.="or ( dx0 between 'E100' and 'E119' )or(dx0='I10')";
$sqlOpd_Socail.="or ( dx1 between 'E100' and 'E119' )or(dx1='I10')";
$sqlOpd_Socail.="or ( dx2 between 'E100' and 'E119' )or(dx2='I10')";
$sqlOpd_Socail.="or ( dx3 between 'E100' and 'E119' )or(dx3='I10')";
$sqlOpd_Socail.="or ( dx4 between 'E100' and 'E119' )or(dx4='I10')";
$sqlOpd_Socail.="or ( dx5 between 'E100' and 'E119' )or(dx5='I10'))";


$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";



				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,��,����(��),����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,����¹,��Һ�ԡ��\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("���ᾷ��",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rsOpd_Socail['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rsOpd_Socail['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  print change_misis($rsOpd_Socail['doc_name']).","; 
								  } 
  							print $rsOpd_Socail['licenseno'].",";
							//if($rsOpd_Socail['item_money']>700){
							//$item_money=700;print number_format($item_money)."\n"; }else{
							print $rsOpd_Socail['item_money']."\n"; 
							//} 
						$i++;
					} //while 
			} //row opd
//end opd



}elseif($exp_file=="diag_between"){ //choice exp_file
//opd

$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money ";

$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="where v.vstdate between '$d1' and  '$d2'";

$sqlOpd_Socail.="and((pdx between '$diag1' and '$diag2' )";
$sqlOpd_Socail.="or ( dx0 between '$diag1' and '$diag2' )";
$sqlOpd_Socail.="or ( dx1 between '$diag1' and '$diag2' )";
$sqlOpd_Socail.="or ( dx2 between '$diag1' and '$diag2' )";
$sqlOpd_Socail.="or ( dx3 between '$diag1' and '$diag2' )";
$sqlOpd_Socail.="or ( dx4 between '$diag1' and '$diag2' )";
$sqlOpd_Socail.="or ( dx5 between '$diag1' and '$diag2' ))";


$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";


				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,��,����(��),����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,����¹,��Һ�ԡ��\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("���ᾷ��",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rsOpd_Socail['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rsOpd_Socail['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  print change_misis($rsOpd_Socail['doc_name']).","; 
								  } 
  							print $rsOpd_Socail['licenseno'].",";
							//if($rsOpd_Socail['item_money']>700){
							//$item_money=700;print number_format($item_money)."\n"; }else{
							print $rsOpd_Socail['item_money']."\n"; 
							//} 
						$i++;
					} //while 
		
			
			} //row opd	


//end opd


}elseif($exp_file=="opd_uc3"){ //choice exp_file
//opd
$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="where  v.pcode='UC' and v.vstdate between '$d1' and  '$d2'";
$sqlOpd_Socail.="and v.pttype in('52','54')";

$sqlOpd_Socail.="and ((pdx='I10')";
$sqlOpd_Socail.="or  ( dx0='I10')";
$sqlOpd_Socail.="or  ( dx1='I10')";
$sqlOpd_Socail.="or  ( dx2='I10')";
$sqlOpd_Socail.="or  ( dx3='I10')";
$sqlOpd_Socail.="or  ( dx4='I10')";
$sqlOpd_Socail.="or  ( dx5='I10'))";

$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";



				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,��,����(��),����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,����¹,��Һ�ԡ��\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("���ᾷ��",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rsOpd_Socail['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rsOpd_Socail['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  print change_misis($rsOpd_Socail['doc_name']).","; 
								  } 
  							print $rsOpd_Socail['licenseno'].",";
							
							//if($rsOpd_Socail['item_money']>700){
							//$item_money=700;print number_format($item_money)."\n"; }else{
							print $rsOpd_Socail['item_money']."\n"; 
							//} 
						
						$i++;
					} //while 
			} //row opd
//end opd

}elseif($exp_file=="A2_11"){ //choice exp_file //�ç��è��µç
//opd
$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";

$sqlOpd_Socail.="where  v.pcode='A2' and v.vstdate between '$d1' and  '$d2'";
$sqlOpd_Socail.="and v.pttype in('11')";

//$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";



				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,��,����(��),����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,����¹,��Һ�ԡ��\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("���ᾷ��",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rsOpd_Socail['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rsOpd_Socail['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  print change_misis($rsOpd_Socail['doc_name']).","; 
								  } 
  							print $rsOpd_Socail['licenseno'].",";
							
							//if($rsOpd_Socail['item_money']>700){
							//$item_money=700;print number_format($item_money)."\n"; }else{
							print $rsOpd_Socail['item_money']."\n"; 
							//} 
						
						$i++;
					} //while 
			} //row opd
//end opd


} elseif($exp_file=="A2_14"){ //choice exp_file //�ç��è��µç
//opd
$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";

$sqlOpd_Socail.="where  v.pcode = 'A2' and v.vstdate between '$d1' and  '$d2'";
$sqlOpd_Socail.="and v.pttype in('14')";

//$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";

				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,��,����(��),����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,����¹,��Һ�ԡ��\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("���ᾷ��",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rsOpd_Socail['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rsOpd_Socail['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  print change_misis($rsOpd_Socail['doc_name']).","; 
								  } 
  							print $rsOpd_Socail['licenseno'].",";
							
							//if($rsOpd_Socail['item_money']>700){
							//$item_money=700;print number_format($item_money)."\n"; }else{
							print $rsOpd_Socail['item_money']."\n"; 
							//} 
						
						$i++;
					} //while 
			} //row opd
//end opd

} elseif($exp_file=="A1_5657"){ //choice exp_file //�ç��è��µç
//opd
$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1,'  ',v.dx2,'  ',v.dx3,'  ',v.dx4,'  ',v.dx5) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";

$sqlOpd_Socail.="where  v.vstdate between '$d1' and  '$d2'";
$sqlOpd_Socail.="and v.pttype in('56','57')";

//$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";



				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,��,����(��),����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,����¹,��Һ�ԡ��\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name �ҧ��� -> �ҧ,���ᾷ�� -> ᾷ��
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("���ᾷ��",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rsOpd_Socail['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rsOpd_Socail['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  print change_misis($rsOpd_Socail['doc_name']).","; 
								  } 
  							print $rsOpd_Socail['licenseno'].",";
							
							//if($rsOpd_Socail['item_money']>700){
							//$item_money=700;print number_format($item_money)."\n"; }else{
							print $rsOpd_Socail['item_money']."\n"; 
							//} 
						
						$i++;
					} //while 
			} //row opd
//end opd

}


elseif($exp_file=="den"){ //den
				$sqlDenService="select p.cid,d.hn,d.vn,concat(DAY(d.vstdate),'/',MONTH(d.vstdate),'/',(YEAR(d.vstdate)+543)) as vst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name,p.fname as FName,p.lname as LName, ";
				$sqlDenService.="concat(DAY(p.birthday),'/',MONTH(p.birthday),'/',(YEAR(p.birthday)+543)) as Birth_date, ";
				$sqlDenService.="i.code as icd10,i.name as icd_name,d.ttcode,dr.name as doctor,v.income,dm.name as tmcode_name ";
				$sqlDenService.="from dtmain d ";
				$sqlDenService.="left outer join doctor dr on dr.code=d.doctor ";
				$sqlDenService.="left outer join patient p on p.hn=d.hn ";
				$sqlDenService.="left outer join icd101 i on i.code=d.icd ";
				$sqlDenService.="left outer join vn_stat v on v.vn=d.vn ";
				$sqlDenService.="left outer join dttm dm on dm.code=d.tmcode ";
				$sqlDenService.="where  v.pcode='A7' and d.vstdate between '$d1' and  '$d2' ";
				$sqlDenService.="group by d.vn order by d.vstdate ";
				$resultDenService=ResultDB($sqlDenService);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultDenService)>0){ //row den
					print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,�ѹ�Դ,����ԹԨ���(ICD10),�����ä,���ѹ,����ѡ��,ᾷ��,��Һ�ԡ��\n";
					$i=0;
			          while($i<mysql_num_rows($resultDenService)){//while
						 $rsDenService=mysql_fetch_array($resultDenService);						
						   
						 $th_date=change_misis($rsDenService['patient_name']);
							if($rsDenService['cid']=="" or $rsDenService['cid'] == NULL or !$rsDenService['cid']){
								$sqlDenCidEmpty="SELECT cid FROM hipdata h WHERE fname LIKE '".$rsDenService['FName']."' and lname LIKE '".$rsDenService['LName']."' ";
								$resultDenCidEmpty=ResultDB($sqlDenCidEmpty);$rsDenCidEmpty=mysql_fetch_array($resultDenCidEmpty);
						 		$cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsDenCidEmpty['cid']); //chang format cid x-xxxx-xxxxx-xx-x
							}else{
						 		$cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsDenService['cid']); //chang format cid x-xxxx-xxxxx-xx-x
							}
                            print ($i+1).",".$cid.","."'".$rsDenService['hn'].",".$rsDenService['vst_date'].",".$th_date.",".$rsDenService['Birth_date'].",".$rsDenService['icd10'].",".$rsDenService['icd_name']
							.",".$rsDenService['ttcode'].",".$rsDenService['tmcode_name'].",";
								  if (ereg("�ѹ�ᾷ��",$rsDenService['doctor'])){ // return true,false
								  print str_replace("�ѹ�ᾷ��","��.",$rsDenService['doctor']).","; //᷹���� �ѹ�ᾷ�� �� ��. 
								  }else{ //false
  								  print change_misis($rsDenService['doctor']).","; 
								  }
							print $rsDenService['income']." �.\n"; 
						$i++;
					} //while 
				}//row den
//end den
}




elseif($exp_file=="ipd"){ //ipd


$sql_ipd_Socail="select p.cid,a.an,a.regdate,a.dchdate,a.hn,a.vn,concat(DAY(a.regdate),'/',MONTH(a.regdate),'/',(YEAR(a.regdate)+543)) as ovst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sql_ipd_Socail.=",s.name as sex,a.age_y,concat(a.pdx,'  ',a.dx0,'  ',a.dx1) as icd10,concat(a.op0,'  ',a.op1) as icd9,dr.name as doc_name,dr.licenseno,a.item_money, i.rw ";
$sql_ipd_Socail.="from an_stat a ";
$sql_ipd_Socail.="left outer join patient p on p.hn=a.hn ";
$sql_ipd_Socail.="left outer join ovst ov on ov.vn=a.vn ";
$sql_ipd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sql_ipd_Socail.="left outer join sex s on s.code=a.sex ";
$sql_ipd_Socail.="left outer join ipt i on i.an = a.an  ";

$sql_ipd_Socail.="where  a.pcode='A7' and a.regdate between '$d1' and  '$d2' and a.pdx not between 'k000' and  'k089' and pdx !='o800' and pdx!= 'z370' and pdx not like 'z35%' and pdx not like 'z36%' ";
$sql_ipd_Socail.="and pdx  not in('z32','z320','z321','z33','z34','z340','z348','z349')  and pdx <>'' and pdx not like '%xx%' and pdx is not null ";
$sql_ipd_Socail.="group by a.vn order by a.regdate,a.hn ";



				$result_ipd_Socail=ResultDB($sql_ipd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($result_ipd_Socail)>0){ //row ipd
					print"���,�ѵû�ЪҪ�,HN,AN,�ѹ���ŧ����¹,�ѹ����˹���,����-ʡ��,����(��),����ԹԨ���(ICD10),�ѵ����(ICD9),��Һ�ԡ��, Adj RW\n";
						$i=0;
			          while($i<mysql_num_rows($result_ipd_Socail)){//while
						 $rs_ipd_Socail=mysql_fetch_array($result_ipd_Socail);
						 
						 $th_date=change_misis($rs_ipd_Socail['patient_name']);
						 $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rs_ipd_Socail['cid']); //chang format cid x-xxxx-xxxxx-xx-x
						 print ($i+1).",".$cid.","."'".$rs_ipd_Socail['hn'].",".$rs_ipd_Socail['an'].",".$rs_ipd_Socail['regdate'].",".$rs_ipd_Socail['dchdate'].",".$th_date.",".$rs_ipd_Socail['age_y']
						 .",".$rs_ipd_Socail['icd10'].",".$rs_ipd_Socail['icd9'].",";
								 
				
							
							echo $rs_ipd_Socail['item_money'].","; 
							echo $rs_ipd_Socail['rw']."\n"; 
						$i++;
					} //while 
				}//row ipd
//end ipd
}






elseif($exp_file=="opd_baby"){ //ipd
$sql_ipd_Socail=$age;

if($age==1){

	$sqlOpd_Socail="select concat(pt.pname,pt.fname,'  ',pt.lname)as ptname,pt.*,ov.*,ic.name as ic_name,ic.tname as ic_tname,concat(ov.op0,'  ',ov.op1) as icd9,concat(ov.age_y,'��',' ',ov.age_m,'��͹') as age_sub 
	from vn_stat ov
	left outer join patient pt on pt.hn = ov.hn
	left outer join ovst on ovst.vn = ov.vn
	left outer join icd101 ic on ic.code = ov.dx0
	where  ov.vstdate between '$d1' and  '$d2' and ov.spclty = '01'
	and timestampdiff(MONTH,pt.birthday,ov.vstdate)  between 0 and 12 ";


}else if($age==2){
	
	$sqlOpd_Socail="select concat(pt.pname,pt.fname,'  ',pt.lname)as ptname,pt.*,ov.*,ic.name as ic_name,ic.tname as ic_tname,concat(ov.op0,'  ',ov.op1) as icd9,concat(ov.age_y,'��',' ',ov.age_m,'��͹') as age_sub
	from vn_stat ov
	left outer join patient pt on pt.hn = ov.hn
	left outer join ovst on ovst.vn = ov.vn
	left outer join icd101 ic on ic.code = ov.dx0
	where  ov.vstdate between '$d1' and  '$d2' and ov.spclty = '01'
	and timestampdiff(MONTH,pt.birthday,ov.vstdate)  between 13 and 36 ";

}else if($age==3){
	
	$sqlOpd_Socail="select concat(pt.pname,pt.fname,'  ',pt.lname)as ptname,pt.*,ov.*,ic.name as ic_name,ic.tname as ic_tname,concat(ov.op0,'  ',ov.op1) as icd9,concat(ov.age_y,'��',' ',ov.age_m,'��͹') as age_sub 
	from vn_stat ov
	left outer join patient pt on pt.hn = ov.hn
	left outer join ovst on ovst.vn = ov.vn
	left outer join icd101 ic on ic.code = ov.dx0
	where  ov.vstdate between '$d1' and  '$d2' and ov.spclty = '01'
	and timestampdiff(MONTH,pt.birthday,ov.vstdate)  between 37 and 71";

}else if($age==4){
	
	$sqlOpd_Socail="select concat(pt.pname,pt.fname,'  ',pt.lname)as ptname,pt.*,ov.*,ic.name as ic_name,ic.tname as ic_tname,concat(ov.op0,'  ',ov.op1) as icd9,concat(ov.age_y,'��',' ',ov.age_m,'��͹') as age_sub 
	from vn_stat ov
	left outer join patient pt on pt.hn = ov.hn
	left outer join ovst on ovst.vn = ov.vn
	left outer join icd101 ic on ic.code = ov.dx0
	where  ov.vstdate between '$d1' and  '$d2' and ov.spclty = '01'
	and timestampdiff(MONTH,pt.birthday,ov.vstdate)  between 72 and 155 ";

}else if($age==5){
	
	$sqlOpd_Socail="select concat(pt.pname,pt.fname,'  ',pt.lname)as ptname,pt.*,ov.*,ic.name as ic_name,ic.tname as ic_tname,concat(ov.op0,'  ',ov.op1) as icd9,concat(ov.age_y,'��',' ',ov.age_m,'��͹') as age_sub 
	from vn_stat ov
	left outer join patient pt on pt.hn = ov.hn
	left outer join ovst on ovst.vn = ov.vn
	left outer join icd101 ic on ic.code = ov.dx0
	where  ov.vstdate between '$d1' and  '$d2' and ov.spclty = '01'
	and timestampdiff(MONTH,pt.birthday,ov.vstdate)  between 156 and 227 ";

}


	$resultOpd_Socail=ResultDB($sqlOpd_Socail);
				
						
	if(mysql_num_rows($resultOpd_Socail)>0){ //row ipd
		print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,��,�ѹ�Դ,����(��),������,�������,����ԹԨ��·��1,����ԹԨ��·��2,����ԹԨ��·��3,����ԹԨ��·��4,����ԹԨ��·��5\n";
				
		$i=0;
		
		while($i<mysql_num_rows($resultOpd_Socail)){//while
						 
		$rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						 
		$th_date=change_misis($rs_opd_Socail['ptname']);
						
			 
						 $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']); //chang format cid x-xxxx-xxxxx-xx-x

						
print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vstdate'].",".$rsOpd_Socail['ptname'].",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['birthday'].",".$rsOpd_Socail['age_sub'].",".$rsOpd_Socail['moopart'].",".$rsOpd_Socail['informaddr'].",";

					
					
					$query3="SELECT ovs.*,icd.tname as tname from ovstdiag ovs 
					
					left outer join icd101  icd on icd.code = ovs.icd10
					
					WHERE ovs.vn='$rsOpd_Socail[vn]' limit 0,5";
		
					$result_3 =mysql_query($query3)or
						die('cannot select data from ovstdiag');
					$count_3 =mysql_num_rows($result_3);

					while($rs=mysql_fetch_array($result_3)){
						echo $rs['icd10']."[$rs[tname]]";
						echo ",";
					};

							echo"\n"; 
						
						
						$i++;

						
					} //while 
			
			
				}//row ipd
					
//end ipd
}




elseif($exp_file=="ipd_1"){ //ipd //��Сѹ�ѧ���������


$sql_ipd_Socail="select p.cid,a.an,a.hn,a.vn,concat(DAY(a.dchdate),'/',MONTH(a.dchdate),'/',(YEAR(a.dchdate)+543)) as ovst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sql_ipd_Socail.=",s.name as sex,a.age_y,concat(a.pdx,'  ',a.dx0,'  ',a.dx1) as icd10,concat(a.op0,'  ',a.op1) as icd9,dr.name as doc_name,dr.licenseno,a.item_money ";
$sql_ipd_Socail.="from an_stat a ";
$sql_ipd_Socail.="left outer join patient p on p.hn=a.hn ";
$sql_ipd_Socail.="left outer join ovst ov on ov.vn=a.vn ";
$sql_ipd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sql_ipd_Socail.="left outer join sex s on s.code=a.sex ";
$sql_ipd_Socail.="where a.dchdate between '$d1' and  '$d2' ";
$sql_ipd_Socail.="and pdx!='' and pdx is not null ";
$sql_ipd_Socail.="and a.pttype in('11') ";

$sql_ipd_Socail.="group by a.vn order by a.dchdate,a.hn ";




				$result_ipd_Socail=ResultDB($sql_ipd_Socail);//echo mysql_num_rows($resultDenService);
				
				if(mysql_num_rows($result_ipd_Socail)>0){ //row ipd
					print"���,�ѵû�ЪҪ�,HN,Discharge,����-ʡ��,��,����(��),����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,����¹,��Һ�ԡ��\n";
						$i=0;
			          while($i<mysql_num_rows($result_ipd_Socail)){//while
						 $rs_ipd_Socail=mysql_fetch_array($result_ipd_Socail);
						 
						 $th_date=change_misis($rs_ipd_Socail['patient_name']);
						 $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rs_ipd_Socail['cid']); //chang format cid x-xxxx-xxxxx-xx-x
						 print ($i+1).",".$cid.","."'".$rs_ipd_Socail['hn'].",".$rs_ipd_Socail['ovst_date'].",".$th_date.",".$rs_ipd_Socail['sex'].",".$rs_ipd_Socail['age_y']
						 .",".$rs_ipd_Socail['icd10'].",".$rs_ipd_Socail['icd9'].",";
								  if(ereg("���ᾷ��",$rs_ipd_Socail['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rs_ipd_Socail['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rs_ipd_Socail['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rs_ipd_Socail['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  print change_misis($rs_ipd_Socail['doc_name']).","; 
								  }
							print $rs_ipd_Socail['licenseno'].",";
							
							
							
							echo $rs_ipd_Socail['item_money']."\n"; 
						$i++;
					} //while 
				}//row ipd
//end ipd
}



elseif($exp_file=="rcpt2"){ //ipd //��Сѹ�ѧ���������


$query="SELECT

r.hn,r.arrear_date,concat(p.pname,p.fname,'  ',p.lname) as 
ptname,t.pttype,
t.name as pttype_name,r.amount, r.pt_type as pttype_status,r.paid as
paid_status

FROM rcpt_arrear r

LEFT OUTER JOIN ovst o ON o.vn=r.vn
LEFT OUTER JOIN patient p ON p.hn=r.hn
LEFT OUTER JOIN pttype t ON t.pttype = o.pttype  where r.arrear_date

BETWEEN '$d1' AND '$d2'    AND  r.paid in ('Y','N')

ORDER BY  r.arrear_id";

$result=ResultDB($query);
				
if(mysql_num_rows($result)>0){ //row ipd
	
	print"�ӴѺ���,HN,�ѹ���,����-ʡ��,�������١˹�����ѡ�Ҿ�Һ��,������,�ӹǹ�Թ,ʶҹС�è����Թ,�����˵�\n";

	$i=0;

while($i<mysql_num_rows($result)){//while
	
	$rs=mysql_fetch_array($result);
	
	print ($i+1).",";
	print $rs['hn'].",";
	print $rs['arrear_date'].",";
	print $rs['ptname'].",";
	print $rs['pttype_name'].",";
	print $rs['pttype_status'].",";
	print $rs['amount'].",";
	print $rs['paid_status'].",";
	print " \n";

	$i++;
	
	} //while 

}//row opd

//end opd
}





elseif($exp_file=="rcpt_opd"){ //opd //��ػ��������


$query="select

k.department as main_department, p.cid, v.hn,v.vstdate, concat(p.pname,p.fname, ' ', p.lname) as pt_name,
v.pdx , concat(h.hosptype, h.name) as hosp_name ,
v.pttype, pp.name as pttype_name,
v.income, v.paid_money, v.uc_money

from vn_stat  v

left outer join ovst o on o.vn = v.vn
left outer join kskdepartment k on k.depcode = o.main_dep
left outer join patient p on p.hn = v.hn
left outer join hospcode h on h.hospcode = o.hospmain
left outer join pttype pp on pp.pttype = v.pttype

where v.vstdate between '$d1' and '$d2'  ";

$result=ResultDB($query);
				
if(mysql_num_rows($result)>0){ //row ipd
	
	print"��§ҹ��ػ��Һ�ԡ�ä��� OPD\n";
	print"���,Ἱ�,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,�ä��ѡ,ʶҹ��ԡ��,�����Է���,�����Է������ѡ��,��Һ�ԡ�����,������ͧ���Թ,�١˹�����Է���\n";

	$i=0;

while($i<mysql_num_rows($result)){//while
	
	$rs=mysql_fetch_array($result);
	
	print ($i+1).",";
	print $rs['main_department'].",";
	print $rs['cid'].",";
	print "'".$rs['hn'].",";
	print $rs['vstdate'].",";
	print $rs['pt_name'].",";
	print $rs['pdx'].",";
	print $rs['hosp_name'].",";
	print $rs['pttype'].",";
	print $rs['pttype_name'].",";


	if($rs['income'] == 0) {
		print "-".",";
	} else {
		print $rs['income'].",";
	}

	if($rs['paid_money'] == 0) {
		print "-".",";
	} else {
		print $rs['paid_money'].",";
	}
	
	if($rs['uc_money'] == 0) {
		print "-".",";
	} else {
		print $rs['uc_money'].",";
	}


	print " \n";

	$i++;
	
	} //while 

}//row opd

//end opd
}




elseif($exp_file=="rcpt_ipd"){ //ipd //��ػ��������


$query="select

w.name as ward_name, a.an, p.hn, concat(p.pname, p.fname,' ',p.lname) as pt_name,

concat(o.hospmain,' ', h.hosptype, h.name) as hosp_name,
a.regdate,a.dchdate,
concat(a.pttype,' ',pp.name) as pttype_name,
a.income, a.uc_money, a.paid_money

from an_stat  a

left outer join patient p on p.hn = a.hn
left outer join ward w on w.ward = a.ward
left outer join ovst o on o.an = a.an
left outer join hospcode h on h.hospcode = o.hospmain
left outer join pttype pp on pp.pttype = a.pttype

where a.dchdate between '$d1' and '$d2' ";

$result=ResultDB($query);
				
if(mysql_num_rows($result)>0){ //row ipd
	
	print"��§ҹ��ػ��Һ�ԡ�ä��� IPD\n";
	print"�֡,AN,HN,����-ʡ��,ʶҹ��Һ����ѡ, �ѹ��� Admit, �ѹ����˹���,�Է������ѡ��, ��Һ�ԡ�����,�١˹���Է���,�����Թ�����ͧ���Թ\n";

	$i=0;

while($i<mysql_num_rows($result)){//while
	
	$rs=mysql_fetch_array($result);
	

	print $rs['ward_name'].",";
	print $rs['an'].",";
	print $rs['hn'].",";
	print $rs['pt_name'].",";
	print $rs['hosp_name'].",";
	print $rs['regdate'].",";
	print $rs['dchdate'].",";
	print $rs['pttype_name'].",";

	if($rs['income'] == 0) {
		print "-".",";
	} else {
		print $rs['income'].",";
	}

	if($rs['uc_money'] == 0) {
		print "-".",";
	} else {
		print $rs['uc_money'].",";
	}

	if($rs['paid_money'] == 0) {
		print "-".",";
	} else {
		print $rs['paid_money'].",";
	}
	
	print " \n";

	$i++;
	
	} //while 

}//row opd

//end opd
}








elseif($exp_file=="anc_opd"){ //opd anc
$sqlSocail_anc_opd="select p.cid,v.hn,v.vn,concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as ovst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlSocail_anc_opd.=",s.name as sex,v.age_y,concat(v.pdx,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.item_money ";
$sqlSocail_anc_opd.="from vn_stat v ";
$sqlSocail_anc_opd.="left outer join patient p on p.hn=v.hn ";
$sqlSocail_anc_opd.="left outer join ovst ov on ov.vn=v.vn ";
$sqlSocail_anc_opd.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlSocail_anc_opd.="left outer join sex s on s.code=v.sex ";
$sqlSocail_anc_opd.="where  v.pcode='A7' and v.vstdate between '$d1' and  '$d2'  and v.pdx not like 'k%' "; 
$sqlSocail_anc_opd.="and (pdx like 'z35%' or pdx like 'z36%' ";
$sqlSocail_anc_opd.="or pdx  in('z32','z320','z321','z33','z34','z340','z348','z349'))   and p.pname not like '%�.�%' ";
$sqlSocail_anc_opd.="group by v.vn order by v.vstdate,v.hn ";
				$resultSocail_anc_opd=ResultDB($sqlSocail_anc_opd);//echo mysql_num_rows($resultSocail_anc_opd);
				if(mysql_num_rows($resultSocail_anc_opd)>0){
				print"���,�ѵû�ЪҪ�,HN,�Ѻ��ԡ��,����-ʡ��,��,����(��),����ԹԨ���(ICD10),�ѵ����(ICD9),ᾷ��,����¹,��Һ�ԡ��\n";
				$i=0;
			          while($i<mysql_num_rows($resultSocail_anc_opd)){//while
						 $rsSocail_anc_opd=mysql_fetch_array($resultSocail_anc_opd);
						 
						 $th_date=change_misis($rsSocail_anc_opd['patient_name']);
						 $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsSocail_anc_opd['cid']); //chang format cid x-xxxx-xxxxx-xx-x
                          print ($i+1).",".$cid.","."'".$rsSocail_anc_opd['hn'].",".$rsSocail_anc_opd['vst_date'].",".$th_date.",".$rsSocail_anc_opd['sex'].",".$rsSocail_anc_opd['age_y'].
						  ",".$rsSocail_anc_opd['icd10'].",".$rsSocail_anc_opd['icd9'].",";
  								  if(ereg("���ᾷ��",$rsSocail_anc_opd['doc_name'])){ // return true,false
								  print str_replace("���ᾷ��","�.",$rsSocail_anc_opd['doc_name']).","; //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsSocail_anc_opd['doc_name'])){ //false
  								  print str_replace("ᾷ��˭ԧ","��.",$rsSocail_anc_opd['doc_name']).","; //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  echo change_misis($rsSocail_anc_opd['doc_name']).","; 
								  }
							print $rsSocail_anc_opd['licenseno'].",";							
							if($rsSocail_anc_opd['item_money']>700){
							$item_money=700;print number_format($item_money)." �.*\n"; }else{
							print $rsSocail_anc_opd['item_money']." �.\n"; }
						$i++;
					} //while 
				} //row
//end opd anc
}elseif($exp_file=="med"){ //med
		if($med_type_err=="all_err"){ //med_type
			$sqlMedAll="SELECT err_id,err_date_report,err_date,err_time,detail_err,prescrib_err ";
			//$sqlMedAll.=",order_process_err,dispens_err,adminis_err,cause,level_code,1) as level_err ";
			$sqlMedAll.=",order_process_err,dispens_err,adminis_err,cause,level_code ";
			$sqlMedAll.="FROM medication_err m ";
			//$sqlMedAll.="left outer join risk_level r on left(r.level_name,1)=m.level_code ";
			$sqlMedAll.="where err_date between '$d1' and  '$d2' order by err_date,err_time desc ";
			$resultMedAll=ResultDB($sqlMedAll);//echo mysql_num_rows($resultSocail_anc_opd);
				if(mysql_num_rows($resultMedAll)>0){ //row all
				print"���,�ѹ/��͹/��,��������´,Prescribing,Order Processing ,Dispensing,Administration,���˵�,�дѺ\n";
				$i=0;
			          while($i<mysql_num_rows($resultMedAll)){//while
						 $rsMedAll=mysql_fetch_array($resultMedAll);
                         print ($i+1).",".FormatDate($rsMedAll['err_date']).",";
						   					if(eregi(",",$rsMedAll['detail_err'])){ // return true,false
								  							print str_replace(",",".",$rsMedAll['detail_err']);
											}else{print $rsMedAll['detail_err'];} //᷹���� ' -> . 
						 print ",".$rsMedAll['prescrib_err'].",".$rsMedAll['order_process_err'].",".$rsMedAll['dispens_err'].",".$rsMedAll['adminis_err'].",".$rsMedAll['cause'].",".$rsMedAll['level_code']."\n";							
						$i++;
					} //while 
				} //row all
		}elseif($med_type_err=="pre_err"){ //med_type
			$sqlPre_err="SELECT err_id,err_date_report,err_date,err_time,detail_err,prescrib_err,cause,level_code ";
			//$sqlMedAll.=",order_process_err,dispens_err,adminis_err,cause,level_code,1) as level_err ";
			//$sqlPre_err.=",order_process_err,dispens_err,adminis_err,cause,level_code ";
			$sqlPre_err.="FROM medication_err m ";
			//$sqlMedAll.="left outer join risk_level r on left(r.level_name,1)=m.level_code ";
			$sqlPre_err.="where err_date between '$d1' and  '$d2'  ";
			$sqlPre_err.="and prescrib_err <>'' order by err_date,err_time desc ";
			$resultPre_err=ResultDB($sqlPre_err);//echo mysql_num_rows($resultSocail_anc_opd);
				if(mysql_num_rows($resultPre_err)>0){ //row pre
				print"���,�ѹ/��͹/��,��������´,Prescribing,���˵�,�дѺ\n";
				$i=0;
			          while($i<mysql_num_rows($resultPre_err)){//while
						 $rsPre_err=mysql_fetch_array($resultPre_err);
                         print ($i+1).",".FormatDate($rsPre_err['err_date']).",";
						   					if(eregi(",",$rsPre_err['detail_err'])){ // return true,false
								  							print str_replace(",",".",$rsPre_err['detail_err']);
											}else{print $rsPre_err['detail_err'];} //᷹���� ' -> . 
						 print ",".$rsPre_err['prescrib_err'].",".$rsPre_err['cause'].",".$rsPre_err['level_code']."\n";							
						$i++;
					} //while 
				} //row pre  
		}elseif($med_type_err=="order_err"){ //med_type
			$sqlOrder_err="SELECT err_id,err_date_report,err_date,err_time,detail_err,order_process_err,cause,level_code ";
			//$sqlMedAll.=",order_process_err,dispens_err,adminis_err,cause,level_code,1) as level_err ";
			//$sqlPre_err.=",order_process_err,dispens_err,adminis_err,cause,level_code ";
			$sqlOrder_err.="FROM medication_err m ";
			//$sqlMedAll.="left outer join risk_level r on left(r.level_name,1)=m.level_code ";
			$sqlOrder_err.="where err_date between '$d1' and  '$d2'  ";
			$sqlOrder_err.="and order_process_err <>'' order by err_date,err_time desc ";
			$resultOrder_err=ResultDB($sqlOrder_err);//echo mysql_num_rows($resultSocail_anc_opd);
				if(mysql_num_rows($resultOrder_err)>0){ //row order
				print"���,�ѹ/��͹/��,��������´,Order Precessing,���˵�,�дѺ\n";
				$i=0;
			          while($i<mysql_num_rows($resultOrder_err)){//while
						 $rsOrder_err=mysql_fetch_array($resultOrder_err);
                         print ($i+1).",".FormatDate($rsOrder_err['err_date']).",";
						   					if(eregi(",",$rsOrder_err['detail_err'])){ // return true,false
								  							print str_replace(",",".",$rsOrder_err['detail_err']);
											}else{print $rsOrder_err['detail_err'];} //᷹���� ' -> . 
						 print ",".$rsOrder_err['order_process_err'].",".$rsOrder_err['cause'].",".$rsOrder_err['level_code']."\n";							
						$i++;
					} //while 
				} //row order_err
		}elseif($med_type_err=="disp_err"){ //med_type
			$sqlDisp_err="SELECT err_id,err_date_report,err_date,err_time,detail_err,dispens_err,cause,level_code ";
			//$sqlMedAll.=",order_process_err,dispens_err,adminis_err,cause,level_code,1) as level_err ";
			//$sqlPre_err.=",order_process_err,dispens_err,adminis_err,cause,level_code ";
			$sqlDisp_err.="FROM medication_err m ";
			//$sqlMedAll.="left outer join risk_level r on left(r.level_name,1)=m.level_code ";
			$sqlDisp_err.="where err_date between '$d1' and  '$d2'  ";
			$sqlDisp_err.="and dispens_err <>'' order by err_date,err_time desc ";
			$resultDisp_err=ResultDB($sqlDisp_err);//echo mysql_num_rows($resultSocail_anc_opd);
				if(mysql_num_rows($resultDisp_err)>0){ //row order
				print"���,�ѹ/��͹/��,��������´,Dispensing,���˵�,�дѺ\n";
				$i=0;
			          while($i<mysql_num_rows($resultDisp_err)){//while
						 $rsDisp_err=mysql_fetch_array($resultDisp_err);
                         print ($i+1).",".FormatDate($rsDisp_err['err_date']).",";
						   					if(eregi(",",$rsDisp_err['detail_err'])){ // return true,false
								  							print str_replace(",",".",$rsDisp_err['detail_err']);
											}else{print $rsDisp_err['detail_err'];} //᷹���� ' -> . 
						 print ",".$rsDisp_err['dispens_err'].",".$rsDisp_err['cause'].",".$rsDisp_err['level_code']."\n";							
						$i++;
					} //while 
				} //row order_err
			}elseif($med_type_err=="admin_err"){ //med_type
			$sqlAdmin_err="SELECT err_id,err_date_report,err_date,err_time,detail_err,adminis_err,cause,level_code ";
			//$sqlMedAll.=",order_process_err,dispens_err,adminis_err,cause,level_code,1) as level_err ";
			//$sqlPre_err.=",order_process_err,dispens_err,adminis_err,cause,level_code ";
			$sqlAdmin_err.="FROM medication_err m ";
			//$sqlMedAll.="left outer join risk_level r on left(r.level_name,1)=m.level_code ";
			$sqlAdmin_err.="where err_date between '$d1' and  '$d2'  ";
			$sqlAdmin_err.="and adminis_err <>'' order by err_date,err_time desc ";
			$resultAdmin_err=ResultDB($sqlAdmin_err);//echo mysql_num_rows($resultSocail_anc_opd);
				if(mysql_num_rows($resultAdmin_err)>0){ //row admin
				print"���,�ѹ/��͹/��,��������´,Administrator,���˵�,�дѺ\n";
				$i=0;
			          while($i<mysql_num_rows($resultAdmin_err)){//while
						 $rsAdmin_err=mysql_fetch_array($resultAdmin_err);
                         print ($i+1).",".FormatDate($rsAdmin_err['err_date']).",";
						   					if(eregi(",",$rsAdmin_err['detail_err'])){ // return true,false
								  							print str_replace(",",".",$rsAdmin_err['detail_err']);
											}else{print $rsAdmin_err['detail_err'];} //᷹���� ' -> . 
						 print ",".$rsAdmin_err['adminis_err'].",".$rsAdmin_err['cause'].",".$rsAdmin_err['level_code']."\n";							
						$i++;
					} //while 
				} //row admin_err
	}//med type
//end med
}//choice exp_file

}//ch online
CloseDB(); //close connect db 
?>

