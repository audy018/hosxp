<?php 
session_start();
include("../phpconf.php");
include("../func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ระบบเงินเดือน - -|</title>
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
print "<link href='../css/$Theme.css' rel='stylesheet' type='text/css'>";
?>
<SCRIPT LANGUAGE="JavaScript">
<!-- hide this script tag's contents from old browsers
function goHist(a) 
{
   history.go(a);      // Go back one.
}
//<!-- done hiding from old browsers -->
</script>

</head>
<body>
<?php
if (!$_SESSION["ip_Log"]){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";
}else{ //on line
	//echo"คุณ คือ ".$s_name;echo"- > ".$t_no_bank;echo"-> ".$s_Submit_add;
//save conform
if($s_ConSave_ADD="ยืนยันข้อมูล"){ //ยืนยันข้อมูล
//save in database
//echo $s_ConSave.$s_name.$s_month.$s_year;
//check ข้อมูลซ้ำ
$sql_ch_data="select * from detail_account where UserID='$s_name' and mouth='$s_month' and syear='$s_year' ";
$resultch_data=ResultDB($sql_ch_data);
	 if(mysql_num_rows($resultch_data)>0){ //row ready
		print"<center><h2><font color='red'>ข้อมูล ในเดือนนี้ของคุณ $s_Fullname ในเดือน $s_month ปี $s_year คุณได้บันทึกลงแล้ว</font></h2>";
		
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;  URL=faccount.php?link_menu=salary'>";
	}else{ //row
	//sql save-insert
	//echo $t_social_secure.$total;
	//exit();
		$sqlSave_DataUser="INSERT INTO detail_account(UserID,class,to_retaliate,to_risk,help_child,to_treat,rent_home,child_educated,money_position ";
		$sqlSave_DataUser.=",goverment_bank,tax,gpf_gratuity,to_help_die,credit_saving_bank,life_insurance,insurance,off_country,credit_car,valve_all,social_secure,total,mouth,syear) ";
		$sqlSave_DataUser.="VALUES ('$s_name','$t_class','$t_to_retaliate','$t_to_risk','$t_help_child','$t_to_treat','$t_rent_home','$t_child_education','$t_money_position' ";
		$sqlSave_DataUser.=",'$t_goverment_bank','$t_tax','$t_gpf_gratuity','$t_to_help_die','$t_credit_saving_bank','$t_life_insurance','$t_insurance','$t_off_country','$t_credit_car','$t_valve_all','$t_social_secure','$total','$s_month','$s_year') ";
		//echo 	$sqlSave_DataUser;
		//echo $t_social_secure.$total;
		//exit();
		mysql_query($sqlSave_DataUser)
			or die ("ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font></center>".mysql_error());
			echo "<center><font color='green'><h2>- - บันทึกข้อมูลในฐานข้อมูล เรียบร้อยแล้ว - -<br>รอสักครู่...เพื่อทำรายการใหม่</h2></font></center>";
	//complete
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;  URL=account_main.php'>";
	}//row
} //ยืนยันข้อมูล
//end save conform
} //online
//close db
 CloseDB(); //close connect db 
?>
</body>
</html>

