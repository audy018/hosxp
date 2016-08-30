<?php
header('Content-type: application/csv');
if($exp_file=="opd"){ //choice
//echo "opd";
header('Content-Disposition: attachment; filename="opd_report.csv"'); 
}elseif($exp_file=="den"){
//echo "den";
header('Content-Disposition: attachment; filename="den_report.csv"'); 
}elseif($exp_file=="ipd"){
//echo "den";
header('Content-Disposition: attachment; filename="ipd_report.csv"'); 
}elseif($exp_file=="anc_opd"){
//echo "den";
header('Content-Disposition: attachment; filename="opd_anc_report.csv"'); 
}elseif($exp_file=="med"){
//echo "med";
header('Content-Disposition: attachment; filename="med_report.csv"'); 
}elseif($exp_file=="opd_uc1"){
//end choice
header('Content-Disposition: attachment; filename="opd_uc1_report.csv"');
}elseif($exp_file=="opd_uc2"){
//end choice
header('Content-Disposition: attachment; filename="opd_uc2_report.csv"');
}elseif($exp_file=="opd_uc3"){
//end choice
header('Content-Disposition: attachment; filename="opd_uc3_report.csv"');
}elseif($exp_file=="A2_11"){
//end choice
header('Content-Disposition: attachment; filename="A2_11_report.csv"');
}elseif($exp_file=="A1_5657"){
//end choice
header('Content-Disposition: attachment; filename="A1_5657_report.csv"');
}elseif($exp_file=="opd_special"){
//end choice
header('Content-Disposition: attachment; filename="opd_special.csv"');
}elseif($exp_file=="ipd_special"){
//end choice
header('Content-Disposition: attachment; filename="ipd_special.csv"');
}elseif($exp_file=="er_list_export"){ //รายงานผู้ป่วยที่มารับบริการที่ห้อง ER
//end choice
header('Content-Disposition: attachment; filename="er_list_export.csv"');
}elseif($exp_file=="opd_mianma"){
//echo "opd_mianma";
header('Content-Disposition: attachment; filename="opd_nationality_report.csv"'); 
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
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
//$sqlOpd_Socail.="where  v.pcode='A7' and v.vstdate between '$d1' and  '$d2'  and pdx not like 'k%' and pdx <>'z34' ";
$sqlOpd_Socail.="where  v.pcode='A7' and v.vstdate between '$d1' and  '$d2'  and pdx not like 'k%' and pdx not like 'z35%' and pdx not like 'z36%' ";
$sqlOpd_Socail.="and pdx  not in('z32','z320','z321','z33','z34','z340','z348','z349') and pdx <>'' and pdx not like '%xx%' and pdx is not null ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";
				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"ที่,บัตรประชาชน,HN,รับบริการ,ชื่อ-สกุล,เพศ,อายุ(ปี),การวินิจฉัย(ICD10),หัตถการ(ICD9),แพทย์,ทะเบียน,ค่าบริการ\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name นางสาว -> นาง,นายแพทย์ -> แพทย์
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("นายแพทย์",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("นายแพทย์","พ.",$rsOpd_Socail['doc_name']).","; //แทนที่คำ นายแพทย์ เป็น พ. 
								  }elseif(ereg("แพทย์หญิง",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("แพทย์หญิง","พญ.",$rsOpd_Socail['doc_name']).","; //แทนที่คำ แพทย์หญิง เป็น พญ. 
								  }else{
								  print change_misis($rsOpd_Socail['doc_name']).","; 
								  } 
  							print $rsOpd_Socail['licenseno'].",";
							if($rsOpd_Socail['item_money']>700){
							$item_money=700;print number_format($item_money)." บ.*\n"; }else{
							print $rsOpd_Socail['item_money']." บ.\n"; } 
						$i++;
					} //while 
			} //row opd
//end opd
}elseif($exp_file=="opd_uc1"){ //choice exp_file
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

$sqlOpd_Socail.="and ((pdx not between 'E100' and 'E119' and pdx !='I10')";
$sqlOpd_Socail.="and  (dx0 not between 'E100' and 'E119' and dx0 !='I10')";
$sqlOpd_Socail.="and  (dx1 not between 'E100' and 'E119' and dx1 !='I10')";
$sqlOpd_Socail.="and  (dx2 not between 'E100' and 'E119' and dx2 !='I10')";
$sqlOpd_Socail.="and  (dx3 not between 'E100' and 'E119' and dx3 !='I10')";
$sqlOpd_Socail.="and  (dx4 not between 'E100' and 'E119' and dx4 !='I10')";
$sqlOpd_Socail.="and  (dx5 not between 'E100' and 'E119' and dx5 !='I10'))";

$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";


				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"ที่,บัตรประชาชน,HN,รับบริการ,ชื่อ-สกุล,เพศ,อายุ(ปี),การวินิจฉัย(ICD10),หัตถการ(ICD9),แพทย์,ทะเบียน,ค่าบริการ\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name นางสาว -> นาง,นายแพทย์ -> แพทย์
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("นายแพทย์",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("นายแพทย์","พ.",$rsOpd_Socail['doc_name']).","; //แทนที่คำ นายแพทย์ เป็น พ. 
								  }elseif(ereg("แพทย์หญิง",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("แพทย์หญิง","พญ.",$rsOpd_Socail['doc_name']).","; //แทนที่คำ แพทย์หญิง เป็น พญ. 
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
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="where  v.pcode='UC' and v.vstdate between '$d1' and  '$d2'";
$sqlOpd_Socail.="and v.pttype in('52','54')";

$sqlOpd_Socail.="and((pdx between 'E100' and 'E119')";
$sqlOpd_Socail.="or ( dx0 between 'E100' and 'E119')";
$sqlOpd_Socail.="or ( dx1 between 'E100' and 'E119')";
$sqlOpd_Socail.="or ( dx2 between 'E100' and 'E119')";
$sqlOpd_Socail.="or ( dx3 between 'E100' and 'E119')";
$sqlOpd_Socail.="or ( dx4 between 'E100' and 'E119')";
$sqlOpd_Socail.="or ( dx5 between 'E100' and 'E119'))";

$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";



				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"ที่,บัตรประชาชน,HN,รับบริการ,ชื่อ-สกุล,เพศ,อายุ(ปี),การวินิจฉัย(ICD10),หัตถการ(ICD9),แพทย์,ทะเบียน,ค่าบริการ\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name นางสาว -> นาง,นายแพทย์ -> แพทย์
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("นายแพทย์",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("นายแพทย์","พ.",$rsOpd_Socail['doc_name']).","; //แทนที่คำ นายแพทย์ เป็น พ. 
								  }elseif(ereg("แพทย์หญิง",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("แพทย์หญิง","พญ.",$rsOpd_Socail['doc_name']).","; //แทนที่คำ แพทย์หญิง เป็น พญ. 
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
					print"ที่,บัตรประชาชน,HN,รับบริการ,ชื่อ-สกุล,เพศ,อายุ(ปี),การวินิจฉัย(ICD10),หัตถการ(ICD9),แพทย์,ทะเบียน,ค่าบริการ\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name นางสาว -> นาง,นายแพทย์ -> แพทย์
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("นายแพทย์",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("นายแพทย์","พ.",$rsOpd_Socail['doc_name']).","; //แทนที่คำ นายแพทย์ เป็น พ. 
								  }elseif(ereg("แพทย์หญิง",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("แพทย์หญิง","พญ.",$rsOpd_Socail['doc_name']).","; //แทนที่คำ แพทย์หญิง เป็น พญ. 
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

}elseif($exp_file=="A2_11"){ //choice exp_file //โครงการจ่ายตรง
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
					print"ที่,บัตรประชาชน,HN,รับบริการ,ชื่อ-สกุล,เพศ,อายุ(ปี),การวินิจฉัย(ICD10),หัตถการ(ICD9),แพทย์,ทะเบียน,ค่าบริการ\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name นางสาว -> นาง,นายแพทย์ -> แพทย์
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("นายแพทย์",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("นายแพทย์","พ.",$rsOpd_Socail['doc_name']).","; //แทนที่คำ นายแพทย์ เป็น พ. 
								  }elseif(ereg("แพทย์หญิง",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("แพทย์หญิง","พญ.",$rsOpd_Socail['doc_name']).","; //แทนที่คำ แพทย์หญิง เป็น พญ. 
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

}elseif($exp_file=="A1_5657"){ //choice exp_file //โครงการจ่ายตรง
//opd
$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money ";
$sqlOpd_Socail.="from vn_stat v ";
$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";

$sqlOpd_Socail.="where  v.pcode='A1' and v.vstdate between '$d1' and  '$d2'";
$sqlOpd_Socail.="and v.pttype in('56','57')";

//$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";
$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";



				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"ที่,บัตรประชาชน,HN,รับบริการ,ชื่อ-สกุล,เพศ,อายุ(ปี),การวินิจฉัย(ICD10),หัตถการ(ICD9),แพทย์,ทะเบียน,ค่าบริการ\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name นางสาว -> นาง,นายแพทย์ -> แพทย์
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['icd10'].",".$rsOpd_Socail['icd9'].",";
								 if(ereg("นายแพทย์",$rsOpd_Socail['doc_name'])){ // return true,false
								  print str_replace("นายแพทย์","พ.",$rsOpd_Socail['doc_name']).","; //แทนที่คำ นายแพทย์ เป็น พ. 
								  }elseif(ereg("แพทย์หญิง",$rsOpd_Socail['doc_name'])){ //false
  								  print str_replace("แพทย์หญิง","พญ.",$rsOpd_Socail['doc_name']).","; //แทนที่คำ แพทย์หญิง เป็น พญ. 
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




elseif($exp_file=="opd_special"){ //choice exp_file //รายงานแยกสิทธิ์ตามสิทธิ์ที่เลือก ผู้ป่วยนอก opd
//opd

$sqlOpd_Socail="select concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as vst_date,v.hn,v.vn,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlOpd_Socail.=",v.cid,v.pttypeno as pttypeno,s.name as sex,v.age_y,concat(ic.code,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.income,v.paid_money,remain_money,uc_money,item_money,pt.pttype as pttype_code,pt.name as pttype_name ";

$sqlOpd_Socail.="from vn_stat v ";

$sqlOpd_Socail.="left outer join patient p on p.hn=v.hn ";
$sqlOpd_Socail.="left outer join ovst ov on ov.vn=v.vn ";
$sqlOpd_Socail.="left outer join icd101 ic on ic.code=v.pdx ";
$sqlOpd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlOpd_Socail.="left outer join sex s on s.code=v.sex ";
$sqlOpd_Socail.="left outer join pttype pt on pt.pttype=v.pttype ";

$sqlOpd_Socail.="where  v.pcode='$pcode' and v.vstdate between '$d1' and  '$d2' ";

$sqlOpd_Socail.="and pdx !=''  and pdx is not null ";

$sqlOpd_Socail.="group by v.vn order by v.vstdate,v.hn ";



				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"ที่,บัตรประชาชน,HN,รับบริการ,ชื่อ-สกุล,เพศ,อายุ(ปี),เลขที่บัตร,สิทธิ์การรักษา,ค่าบริการ\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name นางสาว -> นาง,นายแพทย์ -> แพทย์
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['vst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['pttypeno'].","."[".$rsOpd_Socail['pttype_code']."]".$rsOpd_Socail['pttype_name'].",";

							
							//if($rsOpd_Socail['item_money']>700){
							//$item_money=700;print number_format($item_money)."\n"; }else{
							print $rsOpd_Socail['item_money']."\n"; 
							//} 
						
						$i++;
					} //while 
			} //row opd
//end opd

}




elseif($exp_file=="opd_mianma"){ //choice exp_file //รายงานพม่า ผู้ป่วยนอก opd
//opd


$sqlOpd_Socail="SELECT  v.vn,v.hn,v.vstdate ,v.hospmain ,p.cid,p.pname,p.fname as fname,p.lname as lname,p.birthday ,p.nationality ,
        n.name as nation_name ,s.name as sex_name,p.informaddr  ,p.informname,p.informname ,p.hometel,
		dr.name as doc_name, st.service5 as startexam
FROM vn_stat v
left outer join service_time st on st.vn = v.vn
left outer join ovst ov on ov.vn = v.vn
left outer join doctor dr on dr.code=ov.doctor
left outer join patient p on p.hn = v.hn
left outer join nationality n on n.nationality = p.nationality
left outer join sex s on s.code = p.sex
WHERE   v.vstdate between '$d1' and '$d2'
and v.pdx in ('Z008','Z000') and p.nationality!=99 and v.pttype in ('42', '43', '44','45') 
order by v.vstdate,st.service5 ";

				$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd

					print "รายงานช่วงวันที่ $d1 ถึง $d2 \n";
					print"ว/ด/ป ที่ลงทะเบียน,รหัสหน่วยงาน,เลขบัตรประจำตัว,คำนำหน้า,ชื่อ,สกุล,วันเกิด,เชื้อชาติ,ประเภท,เพศ,ที่อยู่,นายจ้าง,ชื่อนายจ้าง,เบอร์โทรศัพท์,แพทย์ผู้ตรวจ,เวลาแพทย์เริ่มตรวจ\n";
					  
					  $i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						
						
                           print FormatDateEng($rsOpd_Socail['vstdate']).",".$rsOpd_Socail['hospmain'].","."00".$rsOpd_Socail['cid'].",".$rsOpd_Socail['pname'].",".$rsOpd_Socail['fname'].",".$rsOpd_Socail['lname'].",".FormatDateEng($rsOpd_Socail['birthday']).",".$rsOpd_Socail['nation_name'].","."แรงงาน".",".$rsOpd_Socail['sex_name'].",".$rsOpd_Socail['informaddr'].",".$rsOpd_Socail['informname'].",".$rsOpd_Socail['informname'].",".$rsOpd_Socail['hometel'].",".$rsOpd_Socail['doc_name'].",".$rsOpd_Socail['startexam']."\n";

							
						
							//} 
						
						$i++;
					} //while 
			} //row opd
//end opd

}








elseif($exp_file=="er_list_export"){ //choice exp_file //รายงานผู้ป่วยที่มารับบริการที่ห้อง ER
//opd


$sqlErlist="select vs.vn as vn,vs.item_money as item_money,e.*,ert.name as emergency_name,erc.name as dch_name,o.icd10 as icd10,v.hn,v.vsttime,v.spclty as spclty,concat(p.pname,p.fname,'  ',p.lname) as pt_name,ep.name as period_name,d.name as doctor_name,k.department as name_department ";					
					
$sqlErlist.="from er_regist  e ";
											
											
$sqlErlist.="left outer join ovst v on v.vn=e.vn ";


$sqlErlist.="left outer join er_emergency_type ert on ert.er_emergency_type=e.er_emergency_type ";

$sqlErlist.="left outer join er_dch_type erc on erc.er_dch_type=e.er_dch_type ";


$sqlErlist.="left outer join ovstdiag o on o.vn = e.vn and o.diagtype='1'";


$sqlErlist.="left outer join kskdepartment k on k.depcode =v.main_dep ";

											

$sqlErlist.="left outer join patient p on p.hn=v.hn ";

$sqlErlist.="left outer join er_period ep on ep.er_period=e.er_period ";
											
											
$sqlErlist.="left outer join  doctor d on d.code= e.er_doctor ";


$sqlErlist.="left outer join  vn_stat vs on vs.vn= e.vn ";


$sqlErlist.="where e.vstdate='$id1'  order by e.vn ";



$resultEr=ResultDB($sqlErlist);
										
											
		if(mysql_num_rows($resultEr)>0){ //row opd
					print"ลำดับ,HN,ชื่อผู้ป่วย,เวลาที่มา,สถานะ,สถานะภาพ,Diag,ค่าบริการ\n";
					
					$i=0;
			         
					  
					  while($i<mysql_num_rows($resultEr)){//while
						
						 
						 $rsEr=mysql_fetch_array($resultEr); 
						
						 $er_hn=$rsEr["hn"];
						 
						
						 /* if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x */

      print ($i+1).",".$er_hn.",".$rsEr['pt_name'].",".$rsEr['vsttime'].",".$rsEr['emergency_name'].",".$rsEr['dch_name'].",".$rsEr['icd10'].",";

							
							//if($rsOpd_Socail['item_money']>700){
							//$item_money=700;print number_format($item_money)."\n"; }else{
							print $rsEr['item_money']."\n"; 

							
							//} 
						
						$i++;
					} //while 
			} //row opd
//end opd

}










elseif($exp_file=="ipd_special"){ //choice exp_file //รายงานแยกสิทธิ์ตามสิทธิ์ที่เลือก ผู้ป่วยใน IPD
//ipd


$sql_ipd_Socail="select p.cid,a.an,a.hn,a.vn,concat(DAY(a.dchdate),'/',MONTH(a.dchdate),'/',(YEAR(a.dchdate)+543)) as ovst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sql_ipd_Socail.=",s.name as sex,a.age_y,concat(a.pdx,'  ',a.dx0,'  ',a.dx1) as icd10,concat(a.op0,'  ',a.op1) as icd9,dr.name as doc_name,dr.licenseno,a.item_money,pt.pttype as pttype_code,pt.name as pttype_name,a.pttypeno as pttypeno ";

$sql_ipd_Socail.="from an_stat a ";

$sql_ipd_Socail.="left outer join patient p on p.hn=a.hn ";
$sql_ipd_Socail.="left outer join ovst ov on ov.vn=a.vn ";
$sql_ipd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sql_ipd_Socail.="left outer join sex s on s.code=a.sex ";
$sql_ipd_Socail.="left outer join pttype pt on pt.pttype=a.pttype ";


$sql_ipd_Socail.="where  a.pcode='$pcode' and a.dchdate between '$d1' and  '$d2' ";
$sql_ipd_Socail.="and pdx !='' and pdx is not null ";

$sql_ipd_Socail.="group by a.an order by a.dchdate,a.hn ";



				$resultOpd_Socail=ResultDB($sql_ipd_Socail);//echo mysql_num_rows($resultDenService);
				
				if(mysql_num_rows($resultOpd_Socail)>0){ //row opd
					print"ที่,บัตรประชาชน,HN,Discharge,ชื่อ-สกุล,เพศ,อายุ(ปี),เลขที่บัตร,สิทธิ์การรักษา,ค่าบริการ\n";
					$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
						     
						  $th_date=change_misis($rsOpd_Socail['patient_name']);//chang post name นางสาว -> นาง,นายแพทย์ -> แพทย์
						  if($rsOpd_Socail['cid']==""){ $cid="";}else{
						  $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsOpd_Socail['cid']);} //chang format cid x-xxxx-xxxxx-xx-x
                           print ($i+1).",".$cid.","."'".$rsOpd_Socail['hn'].",".$rsOpd_Socail['ovst_date'].",".$th_date.",".$rsOpd_Socail['sex'].",".$rsOpd_Socail['age_y'].",".$rsOpd_Socail['pttypeno'].","."[".$rsOpd_Socail['pttype_code']."]".$rsOpd_Socail['pttype_name'].",";

							
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
					print"ที่,บัตรประชาชน,HN,รับบริการ,ชื่อ-สกุล,วันเกิด,การวินิจฉัย(ICD10),ชื่อโรค,ซี่ฟัน,การรักษา,แพทย์,ค่าบริการ\n";
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
								  if (ereg("ทันตแพทย์",$rsDenService['doctor'])){ // return true,false
								  print str_replace("ทันตแพทย์","ทพ.",$rsDenService['doctor']).","; //แทนที่คำ ทันตแพทย์ เป็น ทพ. 
								  }else{ //false
  								  print change_misis($rsDenService['doctor']).","; 
								  }
							print $rsDenService['income']." บ.\n"; 
						$i++;
					} //while 
				}//row den
//end den
}elseif($exp_file=="ipd"){ //ipd
$sql_ipd_Socail="select p.cid,a.an,a.hn,a.vn,concat(DAY(a.regdate),'/',MONTH(a.regdate),'/',(YEAR(a.regdate)+543)) as ovst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sql_ipd_Socail.=",s.name as sex,a.age_y,concat(a.pdx,'  ',a.dx0,'  ',a.dx1) as icd10,concat(a.op0,'  ',a.op1) as icd9,dr.name as doc_name,dr.licenseno,a.item_money ";
$sql_ipd_Socail.="from an_stat a ";
$sql_ipd_Socail.="left outer join patient p on p.hn=a.hn ";
$sql_ipd_Socail.="left outer join ovst ov on ov.vn=a.vn ";
$sql_ipd_Socail.="left outer join doctor dr on dr.code=ov.doctor ";
$sql_ipd_Socail.="left outer join sex s on s.code=a.sex ";
//$sql_ipd_Socail.="where  a.pcode='A7' and a.regdate between '$d1' and  '$d2' and a.pdx not like 'k%' and a.pdx <>'z34' ";
$sql_ipd_Socail.="where  a.pcode='A7' and a.regdate between '$d1' and  '$d2' and a.pdx not like 'k%' and pdx not like 'z35%' and pdx not like 'z36%' ";
$sql_ipd_Socail.="and pdx  not in('z32','z320','z321','z33','z34','z340','z348','z349')  and pdx <>'' and pdx not like '%xx%' and pdx is not null ";
$sql_ipd_Socail.="group by a.vn order by a.regdate,a.hn ";
				$result_ipd_Socail=ResultDB($sql_ipd_Socail);//echo mysql_num_rows($resultDenService);
				if(mysql_num_rows($result_ipd_Socail)>0){ //row ipd
					print"ที่,บัตรประชาชน,HN,รับบริการ,ชื่อ-สกุล,เพศ,อายุ(ปี),การวินิจฉัย(ICD10),หัตถการ(ICD9),แพทย์,ทะเบียน,ค่าบริการ\n";
						$i=0;
			          while($i<mysql_num_rows($result_ipd_Socail)){//while
						 $rs_ipd_Socail=mysql_fetch_array($result_ipd_Socail);
						 
						 $th_date=change_misis($rs_ipd_Socail['patient_name']);
						 $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rs_ipd_Socail['cid']); //chang format cid x-xxxx-xxxxx-xx-x
						 print ($i+1).",".$cid.","."'".$rs_ipd_Socail['hn'].",".$rs_ipd_Socail['vst_date'].",".$th_date.",".$rs_ipd_Socail['sex'].",".$rs_ipd_Socail['age_y']
						 .",".$rs_ipd_Socail['icd10'].",".$rs_ipd_Socail['icd9'].",";
								  if(ereg("นายแพทย์",$rs_ipd_Socail['doc_name'])){ // return true,false
								  print str_replace("นายแพทย์","พ.",$rs_ipd_Socail['doc_name']).","; //แทนที่คำ นายแพทย์ เป็น พ. 
								  }elseif(ereg("แพทย์หญิง",$rs_ipd_Socail['doc_name'])){ //false
  								  print str_replace("แพทย์หญิง","พญ.",$rs_ipd_Socail['doc_name']).","; //แทนที่คำ แพทย์หญิง เป็น พญ. 
								  }else{
								  print change_misis($rs_ipd_Socail['doc_name']).","; 
								  }
							print $rs_ipd_Socail['licenseno'].",";
							if($rs_ipd_Socail['item_money']>700){
							$item_money=700;echo number_format($item_money)." บ.*\n"; }else{
							echo $rs_ipd_Socail['item_money']." บ.\n"; }
						$i++;
					} //while 
				}//row ipd
//end ipd
}elseif($exp_file=="anc_opd"){ //opd anc
$sqlSocail_anc_opd="select p.cid,v.hn,v.vn,concat(DAY(v.vstdate),'/',MONTH(v.vstdate),'/',(YEAR(v.vstdate)+543)) as ovst_date,concat(p.pname,p.fname,'  ',p.lname) as patient_name ";
$sqlSocail_anc_opd.=",s.name as sex,v.age_y,concat(v.pdx,'  ',v.dx0,'  ',v.dx1) as icd10,concat(v.op0,'  ',v.op1) as icd9,dr.name as doc_name,dr.licenseno,v.item_money ";
$sqlSocail_anc_opd.="from vn_stat v ";
$sqlSocail_anc_opd.="left outer join patient p on p.hn=v.hn ";
$sqlSocail_anc_opd.="left outer join ovst ov on ov.vn=v.vn ";
$sqlSocail_anc_opd.="left outer join doctor dr on dr.code=ov.doctor ";
$sqlSocail_anc_opd.="left outer join sex s on s.code=v.sex ";
$sqlSocail_anc_opd.="where  v.pcode='A7' and v.vstdate between '$d1' and  '$d2'  and v.pdx not like 'k%' "; 
$sqlSocail_anc_opd.="and (pdx like 'z35%' or pdx like 'z36%' ";
$sqlSocail_anc_opd.="or pdx  in('z32','z320','z321','z33','z34','z340','z348','z349'))   and p.pname not like '%ด.ช%' ";
$sqlSocail_anc_opd.="group by v.vn order by v.vstdate,v.hn ";
				$resultSocail_anc_opd=ResultDB($sqlSocail_anc_opd);//echo mysql_num_rows($resultSocail_anc_opd);
				if(mysql_num_rows($resultSocail_anc_opd)>0){
				print"ที่,บัตรประชาชน,HN,รับบริการ,ชื่อ-สกุล,เพศ,อายุ(ปี),การวินิจฉัย(ICD10),หัตถการ(ICD9),แพทย์,ทะเบียน,ค่าบริการ\n";
				$i=0;
			          while($i<mysql_num_rows($resultSocail_anc_opd)){//while
						 $rsSocail_anc_opd=mysql_fetch_array($resultSocail_anc_opd);
						 
						 $th_date=change_misis($rsSocail_anc_opd['patient_name']);
						 $cid = preg_replace('/([0-9]{1,1})([0-9]{4,4})([0-9]{5,5})([0-9]{2,2})([0-9]{1,1})/','$1-$2-$3-$4-$5',$rsSocail_anc_opd['cid']); //chang format cid x-xxxx-xxxxx-xx-x
                          print ($i+1).",".$cid.","."'".$rsSocail_anc_opd['hn'].",".$rsSocail_anc_opd['vst_date'].",".$th_date.",".$rsSocail_anc_opd['sex'].",".$rsSocail_anc_opd['age_y'].
						  ",".$rsSocail_anc_opd['icd10'].",".$rsSocail_anc_opd['icd9'].",";
  								  if(ereg("นายแพทย์",$rsSocail_anc_opd['doc_name'])){ // return true,false
								  print str_replace("นายแพทย์","พ.",$rsSocail_anc_opd['doc_name']).","; //แทนที่คำ นายแพทย์ เป็น พ. 
								  }elseif(ereg("แพทย์หญิง",$rsSocail_anc_opd['doc_name'])){ //false
  								  print str_replace("แพทย์หญิง","พญ.",$rsSocail_anc_opd['doc_name']).","; //แทนที่คำ แพทย์หญิง เป็น พญ. 
								  }else{
								  echo change_misis($rsSocail_anc_opd['doc_name']).","; 
								  }
							print $rsSocail_anc_opd['licenseno'].",";							
							if($rsSocail_anc_opd['item_money']>700){
							$item_money=700;print number_format($item_money)." บ.*\n"; }else{
							print $rsSocail_anc_opd['item_money']." บ.\n"; }
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
				print"ที่,วัน/เดือน/ปี,รายละเอียด,Prescribing,Order Processing ,Dispensing,Administration,สาเหตุ,ระดับ\n";
				$i=0;
			          while($i<mysql_num_rows($resultMedAll)){//while
						 $rsMedAll=mysql_fetch_array($resultMedAll);
                         print ($i+1).",".FormatDate($rsMedAll['err_date']).",";
						   					if(eregi(",",$rsMedAll['detail_err'])){ // return true,false
								  							print str_replace(",",".",$rsMedAll['detail_err']);
											}else{print $rsMedAll['detail_err'];} //แทนที่คำ ' -> . 
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
				print"ที่,วัน/เดือน/ปี,รายละเอียด,Prescribing,สาเหตุ,ระดับ\n";
				$i=0;
			          while($i<mysql_num_rows($resultPre_err)){//while
						 $rsPre_err=mysql_fetch_array($resultPre_err);
                         print ($i+1).",".FormatDate($rsPre_err['err_date']).",";
						   					if(eregi(",",$rsPre_err['detail_err'])){ // return true,false
								  							print str_replace(",",".",$rsPre_err['detail_err']);
											}else{print $rsPre_err['detail_err'];} //แทนที่คำ ' -> . 
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
				print"ที่,วัน/เดือน/ปี,รายละเอียด,Order Precessing,สาเหตุ,ระดับ\n";
				$i=0;
			          while($i<mysql_num_rows($resultOrder_err)){//while
						 $rsOrder_err=mysql_fetch_array($resultOrder_err);
                         print ($i+1).",".FormatDate($rsOrder_err['err_date']).",";
						   					if(eregi(",",$rsOrder_err['detail_err'])){ // return true,false
								  							print str_replace(",",".",$rsOrder_err['detail_err']);
											}else{print $rsOrder_err['detail_err'];} //แทนที่คำ ' -> . 
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
				print"ที่,วัน/เดือน/ปี,รายละเอียด,Dispensing,สาเหตุ,ระดับ\n";
				$i=0;
			          while($i<mysql_num_rows($resultDisp_err)){//while
						 $rsDisp_err=mysql_fetch_array($resultDisp_err);
                         print ($i+1).",".FormatDate($rsDisp_err['err_date']).",";
						   					if(eregi(",",$rsDisp_err['detail_err'])){ // return true,false
								  							print str_replace(",",".",$rsDisp_err['detail_err']);
											}else{print $rsDisp_err['detail_err'];} //แทนที่คำ ' -> . 
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
				print"ที่,วัน/เดือน/ปี,รายละเอียด,Administrator,สาเหตุ,ระดับ\n";
				$i=0;
			          while($i<mysql_num_rows($resultAdmin_err)){//while
						 $rsAdmin_err=mysql_fetch_array($resultAdmin_err);
                         print ($i+1).",".FormatDate($rsAdmin_err['err_date']).",";
						   					if(eregi(",",$rsAdmin_err['detail_err'])){ // return true,false
								  							print str_replace(",",".",$rsAdmin_err['detail_err']);
											}else{print $rsAdmin_err['detail_err'];} //แทนที่คำ ' -> . 
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

