<?php 

$conn;
function conDB(){
global $conn;
global $Server;
global $User;
global $Pass;
global $DBName;

//connect
$conn=mysql_connect($Server,$User,$Pass);
$charset = "SET NAMES'tis620'";
mysql_query($charset) or die('Invalid query: ' . mysql_error());
//connect complete
mysql_select_db($DBName,$conn) or  die("connect  Database name $DBName error");
}//end

//closse DB
function CloseDB(){
global $conn;
mysql_close($conn);
}//end

//form login
function flogin($sendpage){
print"
<form name=fr_login method=post action=chlogin.php>
                <table width=250 border=0 cellpadding=2 cellspacing=3 class=bd-internal>
                  <tr bgcolor=#3399CC> 
                    <td colspan=2 class=headmenu background=img_mian/bgcolor2.gif><div align=center>
                        HOSxP Web Service
                      </div></td>
                  </tr>
                  <tr> 
                    <td width=80 class=detail-text1 align=left> &nbsp;<b>??????????</b></td>
                    <td width=170 align=left>&nbsp;<input type=text name=user  id=Button></td>
                  </tr>
                  <tr> 
                    <td class=detail-text1 align=left>&nbsp;<b>????????</b></td>
					<input type='hidden' name='sendpage' value='$sendpage'>
                    <td align=left>&nbsp;<input  type=password name=pwd  id=Button></td>
                  </tr>
                  <tr> 
                    <td>&nbsp;</td>
                    <td align=left>&nbsp;
                      <input name=submit type=submit value=\" ??????????? \" id=Button></td>
                  </tr>
                </table>
              </form>";
 }//end

//connect database
function ResultDB($sqltext){
include("phpconf.php");
					$result=mysql_db_query($DBName,$sqltext)
					or die ("Not Connect Database Error!!<br>".mysql_error());
					return $result;
}//end

function webconf(){
include("phpconf.php");
$sql = "SELECT * FROM  web_conf  "; //????????????????????????????
				$result = mysql_db_query($DBName,$sql)
				or $chk='N';
				// ?????????????????????
if($chk=='N'){
$sql ="CREATE TABLE `web_conf` (
`icdedit` VARCHAR( 250 ) ,
`auditor` VARCHAR( 250 ) ,
`startrev` DATE,
`header` VARCHAR( 1 ) ,
`theme` VARCHAR( 250 ) 
) TYPE = MYISAM CHARACTER SET = tis620;";
		$result = mysql_db_query($DBName,$sql)
		or die("???????????????? web_cof ???".mysql_error());
		
$sql="INSERT INTO `web_conf` ( `icdedit` , `auditor` , `startrev` , `header` , `theme` )
VALUES (
NULL , NULL, '0000-00-00' , 'N' , 'default'
);";
		$result = mysql_db_query($DBName,$sql)
		or die("???????????????? web_cof ???1".mysql_error());
 }
} //end

//create table  approve_doctor
function tb_approve(){
include("phpconf.php");
$sql = "SELECT * FROM   approve_doctor  "; //check table  approve_doctor
				$result = mysql_db_query($DBName,$sql)
				or $ch_app='N';
				// ?????????????????????
if($ch_app=='N'){
$sql ="CREATE TABLE `approve_doctor` (
`vn` VARCHAR( 13 ) NOT NULL ,
`hn` VARCHAR( 9 ) ,
`vstdate` DATE ,
`command_doctor` VARCHAR( 4 ) ,
`approve_doctor` CHAR( 1 ) ,
`chkcomment1` CHAR( 1 ) ,
`chkcomment2` CHAR( 1 ) ,
`chkcomment3` CHAR( 1 ) ,
`chkcomment4` CHAR( 1 ) ,
`chkcomment5` CHAR( 1 ) ,
`chkcomment6` CHAR( 1 ) ,
`chkcomment7` CHAR( 1 ) ,
`comment_appr` TEXT,
`date_appr` DATE,
PRIMARY KEY ( `vn` ) 
) TYPE = MYISAM CHARACTER SET = tis620; ";
		$result = mysql_db_query($DBName,$sql)
		or die("???????????????? approve_doctor ???".mysql_error());
//create table complete
	return true;
 }//else{echo "????????????????????";}
} //end

//create table  approve_doctor
function tb_webpwd(){
include("phpconf.php");
$sql = "SELECT * FROM   web_pwd "; //check table  approve_doctor
				$result = mysql_db_query($DBName,$sql)
				or $ch_web='N';
				// ?????????????????????
if($ch_web=='N'){
$sql ="CREATE TABLE `web_pwd` (
`loginname` VARCHAR( 250 ) NOT NULL ,
`passweb` VARCHAR( 250 ) ,
PRIMARY KEY ( `loginname` ) 
) TYPE = MYISAM CHARACTER SET = tis620; ";
		$result = mysql_db_query($DBName,$sql)
		or die("???????????????? approve_doctor ???".mysql_error());
//create table complete
	return true;
 }//else{echo "????????????????????2";}
} //end

//check empty passweb y/n
function empty_passweb($fip_Log){
include("phpconf.php");
		$sql="select  * from opduser  where loginname='$fip_Log' ";
		$result=mysql_db_query($DBName,$sql)
		or die("???????????????????????????".mysql_error());
	    $rs=mysql_fetch_array($result);
	     if ($rs["passweb"]=="" or $rs["passweb"]==NULL){
		 //echo "empty";
		return false;
		}else{
		 //echo "not empty";
		$user_pass=$rs["loginname"]."#".$rs["passweb"];
		return $user_pass;
		}
}//end

//check empty passweb y/n
function empty_passweb2($fip_Log){
include("phpconf.php");
		$sql="select  * from web_pwd  where loginname='$fip_Log' ";
		$result=mysql_db_query($DBName,$sql)
		or die("???????????????????????????".mysql_error());
		if(mysql_num_rows($result)==0){ //not row is pwd empty
	    //if ($rs["passweb"]=="" or $rs["passweb"]==NULL){
		 //echo "empty";
		return false;
		}else{
		 //echo "not empty";
	    	$rs=mysql_fetch_array($result);
			$user_pass=$rs["loginname"]."#".$rs["passweb"];
		return $user_pass;
		}
}//end


//encode user
function enc_create_u($fuser){ //enc u
$enc_u=strrev(strtoupper(md5(md5($fuser))));
return $enc_u;
}
//encode pwd
function enc_create_p($fpwd){ //enc p
$enc_p=strrev(strtoupper(md5(md5($fpwd))));
return $enc_p;
}
//end encode

//hospcode  2 hospname
function  hospitalname($hospcode){
include("phpconf.php");
$sql = "SELECT concat(hosptype,name) as hospname FROM hospcode  WHERE hospcode='$hospcode' "; 
				$result = mysql_db_query($DBName,$sql)
				or die("???????????????????????????".mysql_error());
				// ?????????????????????
				$num_rows = mysql_num_rows($result);
				$rs=mysql_fetch_array($result);
if($num_rows<>0){
return $rs["hospname"] ;
 }
} //end

//addressid  2 addressname
function  addressname($addresscode){
include("phpconf.php");
$sql = "SELECT name FROM thaiaddress  WHERE addressid='$addrescode' ";
				$result = mysql_db_query($DBName,$sql)
				or die("???????????????????????????".mysql_error());
				// ?????????????????????
				$num_rows = mysql_num_rows($result);
				$rs=mysql_fetch_array($result);
if($num_rows<>0){
return $rs["name"] ;
 }
} //end


//end
//check useronline on hosxp programe
function useronline_hosxp($online_user){
include("phpconf.php");
$sql = "SELECT * FROM onlineuser WHERE kskloginname='$online_user' "; //????????????????????????????
				$result = mysql_db_query($DBName,$sql)
				or die("???????????????????????????".mysql_error());
				// ?????????????????????
				$num_rows = mysql_num_rows($result);
if($num_rows==1){
return true ;
 }
} //end

//chwname

//end

//Birthday
function BirthdayText_patient($fhn){
include("phpconf.php");
	$sqlBText="SELECT birthday FROM patient  WHERE hn='$fhn' ";
	$result = mysql_db_query($DBName,$sqlBText)
	or die("???????????????????????????".mysql_error());
	$rs=mysql_fetch_array($result);
	echo $rs["birthday"];
}//end

//data  or detail from hn
function Serch_datafrom_hn($fshn){
include("phpconf.php");
			$sqlSdhn="SELECT concat(p.pname,p.fname,'  ',p.lname) as name,concat(p.addrpart,' ?.',p.moopart,' ?. ',t3.name,' ?.',t2.name,' ?. ',t1.name) as addr ";
			$sqlSdhn.="FROM patient p ";
			$sqlSdhn.="left outer join thaiaddress t1 on t1.addressid=concat(p.chwpart,'0000') ";
			$sqlSdhn.="left outer join thaiaddress t2 on t2.addressid=concat(p.chwpart,p.amppart,'00') ";
			$sqlSdhn.="left outer join thaiaddress t3 on t3.addressid=concat(p.chwpart,p.amppart,p.tmbpart) ";
			$sqlSdhn.="where p.hn='$fshn' ";
			//$sql.="order by p.fname,p.lname,p.hn,t3.name LIMIT $start,$limit ";
			$result = mysql_db_query($DBName,$sqlSdhn)
			or die("??????????????????????????".mysql_error());
			$rs=mysql_fetch_array($result);
			
			$name_addr=$rs["name"]."|".$rs["addr"];
			return $name_addr;
} //end

//age from hn
function Age_hn($fhn,$fvn){
include("phpconf.php");
			$sqlAhn="select concat(v.age_y,' ?? ',v.age_m,' ????? ',v.age_d,' ??? ') as age from vn_stat v ";
			$sqlAhn.="where hn='$fhn' and vn='$fvn' ";
			$result = mysql_db_query($DBName,$sqlAhn)
			or die("???????????????????????????".mysql_error());
			$rs=mysql_fetch_array($result);
			$Age_hn_all=$rs["age"];
			return $Age_hn_all;
} //end

//card no. on 13 digi
function Card_No($fchn){
include("phpconf.php");
  $sqlCn="select cardno,cardtype from ptcardno where hn='$fchn' ";
  $result = mysql_db_query($DBName,$sqlCn)
			or die("???????????????????????????".mysql_error());
			$rs=mysql_fetch_array($result);
			if (($rs["cardno"]=="1-1111-11111-11-1") or ($rs["cardno"]=="")){
			$card_no="????????????????????????";
			}else{
			$card_no=$rs["cardno"];
			}
return $card_no;
}//end

//card patient type
function Pt_Type($fptvn){
include("phpconf.php");
	 $sql_pt="select * from vn_stat where vn='$fptvn' ";
	  $result = mysql_db_query($DBName,$sql_pt)
			or die("???????????????????????????".mysql_error());
			$rs=mysql_fetch_array($result);
			$pty=$rs["pttype"];$pty_no=$rs["pttypeno"];
  $sqlTy="select name from pttype where pttype ='$pty' ";
  $result = mysql_db_query($DBName,$sqlTy)
			or die("???????????????????????????".mysql_error());
			$rs=mysql_fetch_array($result);
			$pt_n_no=$rs["name"]."|".$pty_no;
return $pt_n_no;
}//end

//????????????????????
function His_Pmr($fhpvn){
include("phpconf.php");
   $sqlHpmr="select * from opdscreen where vn='$fhpvn' ";
   	$result = mysql_db_query($DBName,$sqlHpmr)
			or die("???????????????????????????".mysql_error());
			$rs=mysql_fetch_array($result);
			$opd_sc=$rs["cc"]."|".$rs["pe"];
			return  $opd_sc;
}//end

//????????????
function Opd_Drug($fodhn){
include("phpconf.php");
		$sqlO_Drug1="select count(*) as drug1 from opd_allergy where hn='$fodhn' ";
		$result = mysql_db_query($DBName,$sqlO_Drug1)
		or die("???????????????????????????".mysql_error());
		$rs=mysql_fetch_array($result);
		if ($rs["drug1"] >0){
				 $sqlO_Drug2="select concat('??? ',agent,' ',symptom,' ?????????? ',report_date,' ???????? ',reporter) as drug2 ";
				$sqlO_Drug2.="from opd_allergy where hn='$fodhn' ";
					$result = mysql_db_query($DBName,$sqlO_Drug2)
					or die("???????????????????????????".mysql_error());
				$rs=mysql_fetch_array($result);
				$drugallergy=$rs["drug2"];
				}else{
				$drugallergy="??????????????????";
			}
	return $drugallergy;
}//end

//???????????
function Opd_History($fohhn){
include("phpconf.php");
		$sqlOp_H1="select  count(*)  as pastill from opd_ill_history where hn='$fohhn' and  cc_persist_disease is NOT NULL";
		$result = mysql_db_query($DBName,$sqlOp_H1)
		or die("???????????????????????????".mysql_error());
		$rs=mysql_fetch_array($result);
		if ($rs["pastill"] >0){
				 $sqlOp_H2="select cc_persist_disease from opd_ill_history where hn='$fohhn' ";
				$result = mysql_db_query($DBName,$sqlOp_H2)
				or die("???????????????????????????".mysql_error());
				$rs=mysql_fetch_array($result);
				$opd_his=$rs["cc_persist_disease"];if ($opd_his==""){$opd_his="?????????????????";}
				}else{
				$opd_his="?????????????????";
			}
	return $opd_his;
}//end

//????????????????
function Cc_Oper($fcohn){
include("phpconf.php");
		$sqlCc1="select  cc_negative_operation as cnp from opd_ill_history where hn='$fcohn' ";
		$result = mysql_db_query($DBName,$sqlCc1)
		or die("???????????????????????????".mysql_error());
		$rs=mysql_fetch_array($result);
		if ($rs["cnp"] =="Y"){
				 $sqlCc2="select concat('?????? ',cc_operation_name,' ????? ',cc_operation_year,' ??') as pastop from opd_ill_history where hn='$fcohn' ";
				$result = mysql_db_query($DBName,$sqlCc2)
				or die("???????????????????????????".mysql_error());
				$rs=mysql_fetch_array($result);
				$cc_oper=$rs["pastop"];
				}else{
				$cc_oper="??????????????????????";
			}
	return $cc_oper;
}//end

//??????????
function Vital_Sign($fvsvn){
include("phpconf.php");
		$sqlVs="select  *  from opdscreen where vn='$fvsvn' ";
		$result = mysql_db_query($DBName,$sqlVs)
		or die("???????????????????????????".mysql_error());
		$rs=mysql_fetch_array($result);
		$vsign="BT : ".sprintf("%.1f",$rs["temperature"])."&nbsp;&deg;C  BP :&nbsp;".(int) $rs["bps"]."/".(int) $rs["bpd"]."&nbsp;mmHg ";
		$vsign.="PR : ".(int) $rs["hr"]." /min "."RR : ".(int) $rs["rr"]." /min"."<br>&nbsp;BW :  ".sprintf("%.1f",$rs["bw"])." Kg. ";
		if  ($rs["height"]<>0) {  $vsign.="Ht : ".(int) $rs["height"]." Cm ";}
		if  ($rs["fbs"]<>0) {  $vsign.="FBS : ".(int) $rs["fbs"]." mg/dl"; }
		if  ($rs["bmi"]<>0) {  $vsign.="BMI : ".(int) $rs["bmi"]." Kg/(m2)"; }
	return $vsign;
} //end

//name doctor
function nDoctor($fndvn){
include("phpconf.php");
		$sqlnD1="select doctor from rx_doctor where vn='$fndvn' ";
		$result = mysql_db_query($DBName,$sqlnD1)
		or die("???????????????????????????".mysql_error());
		$rs=mysql_fetch_array($result);
		$d_code=$rs["doctor"];
		if ($d_code==""){
			$sqlnD2="select er_doctor from er_regist where vn='$fndvn' ";
			$result = mysql_db_query($DBName,$sqlnD2)
			or die("???????????????????????????".mysql_error());
			$rs=mysql_fetch_array($result);
			$d_code=$rs["er_doctor"];
		}
			$sqlnD2="select name from doctor where code='$d_code' ";
			$result = mysql_db_query($DBName,$sqlnD2)
			or die("???????????????????????????".mysql_error());
			$rs=mysql_fetch_array($result);
			$d_name=$rs["name"];
	return $d_name;
	} //end

//format for date 2005-09-10 to 10-09-2548
function FormatDate($date) {
    $data = explode("-", $date);
	$newdata=($data[2]."-".$data[1]."-".($data[0]+543));
    return $newdata;
}//end

//format for date  to 10-09-2548 to 2005-09-10
function FormatDate2($date) {
    $data = explode("-", $date);
	$newdata=(($data[2]-543)."-".$data[1]."-".$data[0]);
    return $newdata;
}//end

//name command doctor  form code vn
function cmdDoctor($fcmdvn){
include("phpconf.php");//echo $fcmdvn;
    $sqlcmd1="select command_doctor from ovst where vn='$fcmdvn' ";
	$result1=mysql_db_query($DBName,$sqlcmd1)
	or die("???????????????????????????".mysql_error());
	$rs1=mysql_fetch_array($result1);
	$cmd_code=$rs1["command_doctor"];
	
	//echo $cmd_code;
	$sqlcmd2="select name from doctor where code='$cmd_code' ";
	$result2=mysql_db_query($DBName,$sqlcmd2)
	or die("???????????????????????????".mysql_error());
	$rs2=mysql_fetch_array($result2);
	$cmd_d=$rs2["name"];
		return $cmd_d; //return name
}//end

//code command doctor  form login
function cmdDoctor_code($ulogin){
include("phpconf.php");//echo $fcmdvn;
						$sql="select  doctorcode from opduser  where loginname='$ulogin' ";
						$result=mysql_db_query($DBName,$sql)
						or die("???????????????????????????".mysql_error());
						$rs=mysql_fetch_array($result);
						return $rs["doctorcode"];//return code
}//end

//check ipaddress
function get_ip(){
$ip=$_SERVER['REMOTE_ADDR'];
//$ip = $HTTP_SERVER_VARS['REMOTE_ADDR']; 
 /*   if (getenv(HTTP_X_FORWARDED_FOR)){ 
        $ip_add=getenv(HTTP_X_FORWARDED_FOR); 
    }else{ 
     $ip_add=getenv(REMOTE_ADDR); 
   }
   */
return $ip;
}//end

//check nline
function Check_Online($fip){ //ip online
include("phpconf.php");
			$sql_ip1="select  count(*) as cc from onlineuser  where computername='$fip' ";
			$result_ip1=mysql_db_query($DBName,$sql_ip1)
			or die("???????????????????????????".mysql_error());
			$rs_ip1=mysql_fetch_array($result_ip1);//echo "<br>".$rs_ip1["cc"]."<br>";
			if ($rs_ip1["cc"]>0){
					return true; //Online
					}else{ 
					//echo "Offline in HosXP";
					return false; //Offline
					}		//return $ip_online;
} //end 



//ip online2
function Check_Onlines(){ //ip online2 by function getip()
include("phpconf.php");
			/*
			if (Check_Online(get_ip())){
					$sql_ip2="select  LEFT(sql,6) as  sqlft ,sql  from replicate_log where sql like '%$fip%' order by event_id DESC  LIMIT 1";
					$result_ip2=mysql_db_query($DBName,$sql_ip2)
					or die("???????????????????????????".mysql_error());
					$num_rows_max2=mysql_num_rows($result_ip2);
					$rs_ip2=mysql_fetch_array($result_ip2);
					
					if (($num_rows_max2>0) and ($rs_ip2["sqlft"]=="delete")) {
					$sql_ip3=$rs_ip2["sql"];
					$result_ip3=mysql_db_query($DBName,$sql_ip3)
					or die("???????????????????????????".mysql_error());
					}
					*/
					if (Check_Online(get_ip())) {
					//echo "Online in HosXP";
					return true; //Online
					}else{ 
					//echo "Offline in HosXP";
					return false; //Offline
					} //$fip==$rs_ip2["ipAddress"]
		//	 }//end $rs_ip1["cc"]>0)
} //end 

//system detail user online in hos
function sys_detail($fip){ //all system online
include("phpconf.php");
		$sql="select  * from onlineuser  where computername='$fip' ";
		$result=mysql_db_query($DBName,$sql)
		or die("???????????????????????????".mysql_error());
	    $rs=mysql_fetch_array($result);
		$ip_online_sys=$rs["computername"]."#".$rs["kskloginname"]."#".$rs["servername"]."#".$rs["department"];
		return $ip_online_sys;
}//end

//change 2005-10-11 to 11 ?????? 2548
function dateThai($date){
$_month_name=array("01"=>"??????","02"=>"??????????","03"=>"??????","04"=>"??????","05"=>"???????","06"=>"???????","07"=>"???????","08"=>"??????","09"=>"???????","10"=>"??????","11"=>"?????????","12"=>"???????");
$yy=substr($date,0,4); $mm=substr($date,5,2); $dd=substr($date,8,2); $time=substr($date,11,8);
$yy+=543;
if (intval($dd)==0){$dd="";}else{$dd=intval($dd);}
$dateT=$dd." ".$_month_name[$mm]." ".$yy." ".$time;
return $dateT;
}//end

//check user access is admin
function ch_like_admin($fip_login){
include("phpconf.php");
				  	$sqlAccess="select  count(*) as cc from opduser  where loginname='$fip_login' and accessright like '%ADMIN%' ";
					$resultAccess=mysql_db_query($DBName,$sqlAccess)
					or die("???????????????????????????".mysql_error());
	   				$rsAccess=mysql_fetch_array($resultAccess);
					if ($rsAccess["cc"]>0){  // > 0
					return true;}else{
					return false;				
				  	} //if
}//end

//check user in system hos acccount
function name_onsys($fnsys){ //name on system
include("phpconf.php");
				  	$sql_nSys="select  count(*) as cc from opduser  where loginname='$fnsys' ";
					$result_nSys=mysql_db_query($DBName,$sql_nSys)
					or die("???????????????????????????".mysql_error());
	   				$rs_nSys=mysql_fetch_array($result_nSys);
					if ($rs_nSys["cc"]>0){  // > 0
					return true;}else{
					return false;				
				  	} //if
}//end

 //check  fields passweb in database from opduser table
function ch_f(){
include("phpconf.php");
		$sql="select passweb from opduser ";
		$result = mysql_db_query($DBName,$sql) 
		or $ans="n";
		if ($ans=="n"){ //no field for create
			$sqlAdd_field="ALTER TABLE opduser ADD passweb VARCHAR( 250 ) NOT NULL AFTER password ";
			$result = mysql_db_query($DBName,$sqlAdd_field)
			or die("sorry,create field opduser table not complete<br>".mysql_error());
			return true;
		}else{ //yes field
			return true;
		}
}//end

//user online in HosXp
function num_online(){ 
include("phpconf.php");
			$sqlOnline="select * from onlineuser";
			$resultOnline=mysql_db_query($DBName,$sqlOnline)
			or die("???????????????????????????".mysql_error());
			$n_rows_online= mysql_num_rows($resultOnline);
			return $n_rows_online;
}

function qeury_max($sql){ 
include("phpconf.php");
			$result=mysql_db_query($DBName,$sql)
			or die("???????????????????????????".mysql_error());
			$num_row_max= mysql_num_rows($result);
			return $num_row_max;
}
function qeury($sql){ 
include("phpconf.php");
			$result=mysql_db_query($DBName,$sql)
			or die("???????????????????????????".mysql_error());
									return $rs=mysql_fetch_assoc($result);;
}

//add field
function ChFieldApprove(){ //add field Approve,comment,DateAppr
include("phpconf.php");
		$sql="select Approve_Doctor,Comment_Appr,Date_Appr from ovst ";
		$result = mysql_db_query($DBName,$sql) 
		or $ans="n";
		if ($ans=="n"){ //no field for create
			$sql="ALTER TABLE ovst ADD Approve_Doctor CHAR(1),ADD chkcomment1 CHAR(1),ADD chkcomment2 CHAR(1),ADD chkcomment3 CHAR(1),ADD chkcomment4 CHAR(1),ADD chkcomment5 CHAR(1),ADD chkcomment6 CHAR(1),ADD chkcomment7 CHAR(1),ADD Comment_Appr TEXT CHARACTER SET tis620,ADD Date_Appr DATE ";
			$result = mysql_db_query($DBName,$sql)
			or die("sorry,create field ovst table not complete!!!<br>".mysql_error());
			//echo "N com";
			return true;
		}else{ //yes field
			//echo "Y";
			return true;
		}
}//end */

//change 1-> ??????
function change_month_isThai($no_month){
$month_name=array("1"=>"??????","2"=>"??????????","3"=>"??????","4"=>"??????","5"=>"???????","6"=>"???????","7"=>"???????","8"=>"??????","9"=>"???????","10"=>"??????","11"=>"?????????","12"=>"???????");
return $month_name[$no_month];
}//end

function seen_lab($user,$flab_order){ //checkuser
include("phpconf.php");
				  	$sql="select count(*) as cc from lab_restict_log  where staff='$user' and lab_order_number='$flab_order'";
					$result=mysql_db_query($DBName,$sql)
					or die("???????????????????????????".mysql_error());
	   				$rs=mysql_fetch_array($result);
					return $rs["cc"];				
				  }//end

function access_right($ulogin){
include("phpconf.php");
				  	$sqlAccess="select  * from opduser  where loginname='$ulogin' ";
					$resultAccess=mysql_db_query($DBName,$sqlAccess)
					or die("???????????????????????????".mysql_error());
	   				$rsAccess=mysql_fetch_array($resultAccess);
					return $rsAccess["accessright"];
}//end

function check_right($uright,$aright){
if(count($aright)>1){
$cright=1;$oright=0;
while ($val = each($aright)){
if(!isset($cright) & !isset($oright)){$cright=$cright*strpos($uright,$val["value"]);$oright=$oright + strpos($uright,$val["value"]);}else{
$cright=$cright*strpos($uright,$val["value"]);
$oright=$oright + strpos($uright,$val["value"]);}
}
if($cright<>0){return 2;}elseif($oright<>0){return 1;}else{return 0;}
 }else
{//$cright=strpos($uright,$aright);//echo count($aright);echo $aright[0];

//if($cright<>0){
//return 2;}else{return 0;}
if(eregi($aright[0],$uright)){return 1;}else{return 0;} 

 }//$cright
}//end
#0=none 1=some 2=all 
function theme_page(){ //theme
include("phpconf.php");
				  	$sql="select  * from web_conf";
					$result=mysql_db_query($DBName,$sql)
					or die("???????????????????????????".mysql_error());
	   				$rs=mysql_fetch_array($result);
					if($rs["theme"]<>""){
						return $rs["theme"];
						}else{ 
						$theme="default";
						return $theme;
					}
}//end

//Check Eng-Number
function CheckThai($txt)
	{
	if ( !eregi("^[_a-z0-9-]",$txt))
	return true;
	}
//End
//show search color
function show_search($keywords,$icdname){
	$showcolor=array("red","green","blue","orange","pink","yellow");
	if (count($keywords)>1){
	while (($val = each($keywords)) & ($col = each($showcolor))){
	$key=$val["value"];
	$color=$col["value"];
	if($newname==""){
	$showkey="<font color=".$color."><b>".$key."</b></font>";
	if(CheckThai($key)){
	$newname=str_replace($key,$showkey,$icdname);}else{$newname=eregi_replace($key,$showkey,$icdname);}
	}else{
	$showkey="<font color=".$color."><b>".$key."</b></font>";
	if(CheckThai($key)){
	$newname=str_replace($key,$showkey,$icdname);}else{$newname=eregi_replace($key,$showkey,$newname);}
	}//else
	
	}//while
	
	}else{
	$showkey="<font color=red><b>".$keywords."</b></font>";
	$newname=eregi_replace($keywords,$showkey,$icdname);
	}
		return strtoupper($newname);
}//end

function show_list($rstext){
$rsshow=explode(",",$rstext);
return $rsshow;
}//end

//Drop list tambol hipdata
function list_tambon($tambon){
$ampor=substr($tambon, 0, 4);
$sql="select  addressid,name  from thaiaddress where addressid like '$ampor%'  and codetype='3' order by IF(addressid='$tambon',0,1),name";
$result=ResultDB($sql);
for($i=0; $i<mysql_num_rows($result);$i++){
								$rs=mysql_fetch_array($result);
								$tmb_name=$rs['name'];
								$tmb_id=$rs['addressid'];
									if(!isset($list_tambon)){
								$list_tambon="<option value=$tmb_id>$tmb_name</option>";}else{
								$list_tambon=$list_tambon."<option value=$tmb_id>$tmb_name</option>";
									}//else
									}//for
				return $list_tambon;
}
//end

//Drop list tambol from address
function list_tambon1($Cwhpart,$Amppart){
$sql="select distinct t3.* from thaiaddress t1
left outer join thaiaddress t2 on t1.chwpart=t2.chwpart
left outer join thaiaddress t3 on t3.amppart=t2.amppart
where t1.name='$Cwhpart' and t2.name='$Amppart'
and t3.codetype='3'and t1.chwpart=t3.chwpart";
$result=ResultDB($sql);
for($i=0; $i<mysql_num_rows($result);$i++){
								$rs=mysql_fetch_array($result);
								$tmb_name=$rs['name'];
								$tmb_id=$rs['addressid'];
									if(!isset($list_tambon)){
								$list_tambon="<option value=$tmb_id>$tmb_name</option>";}else{
								$list_tambon=$list_tambon."<option value=$tmb_id>$tmb_name</option>";
									}//else
									}//for
				return $list_tambon;
}
//end

//Moi status
function list_moi($moi){
								$sqlSelectMs="select moi_status from hipdata where moi_status<>'$moi' group by moi_status ";
								$resultSelectMs=ResultDB($sqlSelectMs);
								for($i=0; $i<mysql_num_rows($resultSelectMs);$i++){
								$rsMs=mysql_fetch_array($resultSelectMs);
								$moi_st=$rsMs['moi_status'];
									if(!isset($list_moi)){
								$list_moi="<option value=$moi>$moi</option><option value=$moi_st>$moi_st</option>";}else{
								$list_moi=$list_moi."<option value=$moi_st>$moi_st</option>";
									}//else
									}//for
									return $list_moi;
}
//end

//Check info complete
function msg_chk_complete($checkinfo){
foreach ($checkinfo as $key=>$value) {
if($value==""){
if(!isset($msg_err)){
$msg_err= "????????????????????????????? : ".$key;}else
{$msg_err=$msg_err.", ".$key;}
}//if $value
}//foreach
return $msg_err;
}
//end
//web config session
function webconfig_session(){
include("phpconf.php");
				$sql="select * from web_conf ";
				$result=mysql_db_query($DBName,$sql)
				or die("???????????????????????????".mysql_error());
	   			$rs=mysql_fetch_array($result);
				if($rs["theme"]<>""){$theme=$rs["theme"];
				}else{ $theme="default";	}
				
				$sql1="select * from opdconfig ";
				$result1=mysql_db_query($DBName,$sql1)
				or die("???????????????????????????".mysql_error());
	   			$rs1=mysql_fetch_array($result1);
				
				$sql_nhso="select  sys_value from sys_var where sys_name in ('NHSO_User','NHSO_Password')";
 				$result_nhso= mysql_db_query($DBName,$sql_nhso)
				or die("sorry,can't show any information".mysql_error());

for($i=0;$i<mysql_num_rows($result_nhso);$i++){
$rsNhso=mysql_fetch_array($result_nhso);
if(!isset($nhsopass)){$nhsopass=$rsNhso["sys_value"]; }else{
$nhsouser=$rsNhso["sys_value"]; }
}		
		$info_set=array($rs1["hospitalname"],$rs1["hospitalcode"],$rs["header"],$theme,$nhsouser,$nhsopass); 
		return  $info_set;
}

//end

//check create table for account system
function tb_user_account(){
include("phpconf.php");
$sql = "SELECT * FROM users_account "; //check table  
				$result = mysql_db_query($DBName,$sql)
				or $ch_tb_user='N'; //no create
				// no create
if($ch_tb_user=='N'){ //create
//echo "no";
$sql ="CREATE TABLE `users_account` (
`UserID` VARCHAR( 50 ) NOT NULL ,
`NoBank_Account` VARCHAR( 20 ) NOT NULL ,
`Status_Access` CHAR( 1 ) NOT NULL ,
`Status_social_secure` CHAR( 1 ) NOT NULL ,
PRIMARY KEY ( `UserID` ) 
) TYPE = MYISAM CHARACTER SET = tis620; "; 
		$result = mysql_db_query($DBName,$sql)
		or die("???????????????? approve_doctor ???".mysql_error());  
//create table complete
	return true;
 }//else{
 //echo "????????????????????";
 //} //end
}
//end 

function tb_detail_account(){
include("phpconf.php");
$sql = "SELECT * FROM detail_account "; //check table  
				$result = mysql_db_query($DBName,$sql)
				or $ch_detail_account='N'; //no create
				// no create
if($ch_detail_account=='N'){ //create
//echo "no";
$sql ="CREATE TABLE `detail_account` (
`UserID` VARCHAR( 50 ) NOT NULL ,
`class` DOUBLE( 15, 2 ) NOT NULL ,
`to_retaliate` DOUBLE( 15, 2 ) NOT NULL ,
`to_risk` DOUBLE( 15, 2 ) NOT NULL ,
`help_child` DOUBLE( 15, 2 ) NOT NULL ,
`to_treat` DOUBLE( 15, 2 ) NOT NULL ,
`rent_home` DOUBLE( 15, 2 ) NOT NULL ,
`child_educated` DOUBLE( 15, 2 ) NOT NULL ,
`money_position` DOUBLE( 15, 2 ) NOT NULL ,
`goverment_bank` DOUBLE( 15, 2 ) NOT NULL ,
`tax` DOUBLE( 15, 2 ) NOT NULL ,
`gpf_gratuity` DOUBLE( 15, 2 ) NOT NULL ,
`to_help_die` DOUBLE( 15, 2 ) NOT NULL ,
`credit_saving_bank` DOUBLE( 15, 2 ) NOT NULL ,
`life_insurance` DOUBLE( 15, 2 ) NOT NULL ,
`insurance` DOUBLE( 15, 2 ) NOT NULL ,
`off_country` DOUBLE( 15, 2 ) NOT NULL ,
`credit_car` DOUBLE( 15, 2 ) NOT NULL ,
`valve_all` DOUBLE( 15, 2 ) NOT NULL ,
`social_secure` DOUBLE( 15, 2 ) NOT NULL ,
`total` DOUBLE( 15, 2 ) NOT NULL ,
`mouth` VARCHAR( 2 ) NOT NULL ,
`syear` VARCHAR( 4 ) NOT NULL 
) TYPE = MYISAM CHARACTER SET = tis620; "; 
		$result = mysql_db_query($DBName,$sql)
		or die("???????????????? detail_account ???".mysql_error());  
//create table complete
	return true;
 }//else{
 //echo "????????????????????";
// } //end
}


//???????
//split array
 function array_split(&$in) {
   						$keys = func_get_args();
   						array_shift($keys);
  
   						$out = array();
  						 foreach($keys as $key) {
       					if(isset($in[$key]))
          				 $out[$key] = $in[$key];
       						else
           				$out[$key] = null;
      					 unset($in[$key]);
   						}
  
   						return $out;
					}
//end
//select table array
function sql_array($xsql,$colname){
include("phpconf.php");
if(!$xsql==""){
				$result=mysql_db_query($DBName,$xsql)
				or die("Notconnect database error".mysql_error());

	   		if(mysql_num_rows($result)>0){
				 $i=0;
				  while($i<mysql_num_rows($result)){
				    $rs=mysql_fetch_array($result);
					if(!isset($rsarray)){
					$rsarray=array($rs["Month"]=>$rs["total"]); }else{
					$rsarray=$rsarray+array($rs["Month"]=>$rs["total"]);}
					$i++;
				  }
				  $mtqt=array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0);
				  $rsarray=$rsarray+$mtqt;
				  ksort($rsarray);
				  $rsarray1=array_split($rsarray,10,11,12);
            	 $rsarray=$rsarray1+$rsarray; 
				 print "<td width='194' align='left' class='text-intable'>&nbsp;$colname</td>";
				  	foreach ($rsarray as $key => $qt ){
					  	if($qt>0){echo "<td width='30' align='center'><font color=green><b>".$qt."</b></font></td>";}else{echo "<td width='30' align='center'><font color='red'>".$qt."</font></td>";}
				   }
				}else{
							print"<tr width='194' align='left' class='text-intable'><td align='left'>&nbsp;$colname</td>";
							$j=0;
							while($j<12){
									//if($xsql!==""){print"<td width='30' align='center'>0</td>";}else{print"<td width='30' align='center'>&nbsp;</td>";}
									print"<td width='30' align='center'><font color='red'>0</font></td>";
							$j++;
							}
				print"</tr>";
				}//row
 }else{
 			print"<tr class='headtable'><td align='center'>$colname</td><td colspan='12' align='center' scope='col'>&nbsp;</td></tr>";
 }		
}
//end
//end ???????

//select table array
function change_misis($name){
include("phpconf.php");
								  if (ereg("?????",$name)){ // return true,false
								  return str_replace("?????","??.",$name); //???????? ????????? ???? ??. 
								  }else{ //false
  								  return $name;
								  }
}

//create table risk_report for web
function create_riskreport_web(){
include("phpconf.php");
$sql = "SELECT * FROM risk_report_web "; //check table  
				$result = mysql_db_query($DBName,$sql)
				or $ch_table='N'; //no create
				// no create
if($ch_table=='N'){ //create
//echo "no";
$sql ="CREATE TABLE `risk_report_web` (
`risk_id` INT NOT NULL AUTO_INCREMENT ,
`report_date_time` DATETIME NOT NULL ,
`department_id` INT,
`subject` VARCHAR( 250 ) ,
`risk_level` CHAR( 1 ) ,
`relation_program` VARCHAR( 50 ) ,
`risk_detail` LONGTEXT,
`report_user` VARCHAR( 25 ) ,
`review_status` CHAR( 1 ) ,
`review_date_time` DATETIME,
`review_staff` VARCHAR( 25 ) ,
`review_detail` LONGTEXT,
`edit_basic` LONGTEXT,
`info_system` LONGTEXT,
`respond_level_depart` LONGTEXT,
`result_follow` LONGTEXT,
`all_date_review` LONGTEXT,
PRIMARY KEY ( `risk_id` )
) TYPE = MYISAM CHARACTER SET = tis620; "; 
		$result = mysql_db_query($DBName,$sql)
		or die("???????????????? risk_report_web ???".mysql_error());  
//create table complete
	return true;
 }//else{
 //echo "????????????????????";
// } //end
}//f

//create table medicate error
function create_level_err(){
include("phpconf.php");
$sql = "SELECT * FROM level_err "; //check table  
				$result = mysql_db_query($DBName,$sql)
				or $ch_table='N'; //no create
				// no create
if($ch_table=='N'){ //create
//echo "no";
$sql ="CREATE TABLE `level_err` (
`level_code` CHAR( 1 ) NOT NULL ,
`detail` VARCHAR( 250 ) NOT NULL ,
PRIMARY KEY ( `level_code` )
) TYPE = MYISAM CHARACTER SET = tis620; "; 
		$result = mysql_db_query($DBName,$sql)
		or die("???????????????? level_err ???".mysql_error());  
//create table complete
	return true;
 }//else{
 //echo "????????????????????";
// } //end
}//end function

//create table medicate error
function create_medication_err(){
include("phpconf.php");
$sql = "SELECT * FROM medication_err "; //check table  
				$result = mysql_db_query($DBName,$sql)
				or $ch_table='N'; //no create
				// no create
if($ch_table=='N'){ //create
//echo "no";
$sql ="CREATE TABLE `medication_err` (
`err_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`user_err` VARCHAR( 250 ) NOT NULL ,
`depart_code` CHAR( 3 ) NOT NULL ,
`err_date` DATE NOT NULL ,
`err_time` TIME NOT NULL ,
`detail_err` VARCHAR( 250 ) NOT NULL ,
`prescrib_err` VARCHAR( 250 ) NOT NULL ,
`order_process_err` VARCHAR( 250 ) NOT NULL ,
`dispens_err` VARCHAR( 250 ) NOT NULL ,
`adminis_err` VARCHAR( 250 ) NOT NULL ,
`cause` VARCHAR( 250 ) NOT NULL ,
`level_code` CHAR( 1 ) NOT NULL ,
PRIMARY KEY ( `err_id` )
) TYPE = MYISAM CHARACTER SET = tis620; "; 
		$result = mysql_db_query($DBName,$sql)
		or die("???????????????? medication_err ???".mysql_error());  
//create table complete
	return true;
 }//else{
 //echo "????????????????????";
// } //end
}//end function




 //********************End function************************//
 
 
 //*************PHP Programmimg + MySQL***********//
 //*********************Code by***************************//
 // aran raka - ->Doctor 
 // guprajag raham - ->Programmer
 // and IM Team 
 //************************Mayo Hospital*****************//

?>
