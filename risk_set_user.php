<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB(); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - Risk Management Report Review Detail - - |</title>
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
<SCRIPT LANGUAGE="JavaScript">
<!-- hide this script tag's contents from old browsers
function goHist(a) 
{
   history.go(a);      // Go back one.
}
//<!-- done hiding from old browsers -->
</script>

</head>
<?php
	$ip=get_ip();
	$online=Check_Online($ip); //func check online
if($online){$ip_Log=user_change($ip);}else{$ip_Log=$_SESSION['ip_Log'];}
	$aright=array("ADMIN","Risk_Review");$aright2=array("Risk_Review");
			//echo $online;
if($online){$right=access_right($ip_Log);}else{$right=$_SESSION["right"];}
if((check_right($right,$aright)!==2) and (check_right($right,$aright2)!==1)){ //check access
			//echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
			print"<br><br><center><h2>ท่านไม่สิทธ์ใช้งานหน้านี้....ครับ</h2></center><br>";
			print"<p align=center><input type='submit' value='ปิดหน้าต่าง'  id='Button' onClick='javascript:window.close();'><br><br>";
			print"Development By <b>Guprajag</b> CopyRight &copy; 04-2006 <b>IM Team Mayo Hospital.</b>All right reserved</p>";
			
}else{ //check access
if (!$ip_Log and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line
	//echo "online".$online;
?>
<body>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr> 
          <td valign="top">
<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>		  </td>
        </tr>
        <tr>
          <td height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC" class="td-left"><?php include("manu.inc"); ?></td>
        </tr>
        <tr> 
          <td height="177" align="center" valign="top" class="td-left"><br>
	<?php 
	if(!$_GET['sUser_access']){ //ch press button save
	?>
		  <table width="700" border="0" cellpadding="0" cellspacing="0" class="bd-external">
            <tr align="center" bgcolor="#99CCFF">
              <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu">กำหนดสิทธิสำหรับการเข้าถึงระบบอุบัติการ</td>
            </tr>
            <tr>
              <td width="337" valign="top" bgcolor="#3399CC">&nbsp; คุณคือ <font color="red"><b><?php echo $ip_Log;  ?></b></font></td>
              <td width="282" bgcolor="#3399CC" align="left"></td> 
            </tr>
            <tr align="center" valign="top">
              <td colspan="2"><br>
			 <form action="<?php $PHP_SELF; ?>" method="get" name="fUserRisk">
			  <table width="400" border="0" cellspacing="1" cellpadding="2" class="bd-external">
                <tr align="center">
                  <td colspan="2" bgcolor="#319ACE"><span class="headmenu">รายละเอียดของอุบัติการ</span></td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp;รายชื่อ : </td>
                  <td bgcolor="#FFCC00">&nbsp;
				  <?php 
					$sqlUser="select   loginname,name from opduser order by name  ";
					$resultUser=ResultDB($sqlUser);//echo mysql_num_rows($result);
				 	if(mysql_num_rows($resultUser)>0){
					print"<select name='slogin'  id='Txt-Field'>";
						for($i=0;$i<mysql_num_rows($resultUser);$i++){
						$rsUser=mysql_fetch_array($resultUser);
						print "<option value='".$rsUser['loginname']."'>".$rsUser['name']."</option>";
						}										    
					print"</select>";
					}
				  ?></td>
                </tr>
                <tr>
                  <td width="150" valign="top" bgcolor="#319ACE">&nbsp;หน่วยงานที่อนุญาติให้เข้าถึง : </td>
                  <td>&nbsp;
				  <?php 
				  $sqlDepartment="SELECT * FROM hospital_department ";$resultDepartment=ResultDB($sqlDepartment);
				 	if(mysql_num_rows($resultDepartment)>0){
						for($i=0;$i<mysql_num_rows($resultDepartment);$i++){
						$rsDepartment=mysql_fetch_array($resultDepartment);
						print "<input name='hos_depart".$rsDepartment['id']."' type=checkbox value='".$rsDepartment['id']."'>".$rsDepartment['name']."  ";
					 }
					}									    
				  ?></td>
                  </tr>
                <tr>
                  <td bgcolor="#319ACE">&nbsp; </td>
                  <td valign="middle" bgcolor="#FFCC00"><input name="all_access" type="radio" value="ALL">ทั้งหมด</td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>
			<?php
				//print"<input type='button' value='บันทึก' onClick=\"parent.location='risk_review_form.php?risk_id=$rs[risk_id]'\"  id='Button'>&nbsp;&nbsp;";
				print"<input name='sUser_access' type='submit' value='บันทึก' id='Button'>&nbsp;&nbsp;";
				print"<input type='submit' value='ย้อนกลับ'  id='Button' onClick='goHist(-1);'>";
				//print"<input type='submit' value='ย้อนกลับ'  id='Button' onClick='goHist(-1);'><input type='hidden' name='row_depart' value='".mysql_num_rows($resultDepartment)."'"; //send num row

			?>			</td>
                  </tr>
              </table></form></td>
            </tr>
            <tr>
              <td colspan="2"><!-- end สร้างกรอบตาราง --></td>
            </tr>
            <tr align="center" valign="top">
              <td colspan="2">			</td>
            </tr>
            <tr align="center">
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table><br><br><br><br>
	<?php }elseif($sUser_access=="บันทึก"){ //ch press button save
			$Slogin=$_GET['slogin'];//echo $Slogin; 
		//chec user in database
		$sql_ch_user="select * from risk_user_access where loginname='$Slogin' ";
		$result_ch_user=ResultDB($sql_ch_user);
	if(mysql_num_rows($result_ch_user)>0){ //yes user  //ch user
			print"<br><br><center><h2>".$Slogin."...กำหนดสิทธิไว้แล้ว...</h2>แก้ไข</center><br>";
			//echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=result_chlogin.php'>";
			print"<p align=center><input type='submit' value='ปิดหน้าต่าง'  id='Button' onClick='javascript:window.close();'>&nbsp;&nbsp;<input type='submit' value='ย้อนกลับ'  id='Button' onClick='goHist(-1);'><br><br>";
			//print"Development By <b>Guprajag</b> CopyRight &copy; 04-2006 <b>IM Team Mayo Hospital.</b>All right reserved</p>";
	}else{//no user
	  if($_GET['all_access']!=='ALL'){ //all access
		if(isset($_GET['hos_depart1'])){$_Depart1="x".$_GET['hos_depart1']."x,";}if(isset($_GET['hos_depart2'])){$_Depart2="x".$_GET['hos_depart2']."x,";}
		if(isset($_GET['hos_depart3'])){$_Depart3="x".$_GET['hos_depart3']."x,";}if(isset($_GET['hos_depart4'])){$_Depart4="x".$_GET['hos_depart4']."x,";}
		if(isset($_GET['hos_depart5'])){$_Depart5="x".$_GET['hos_depart5']."x,";}if(isset($_GET['hos_depart6'])){$_Depart6="x".$_GET['hos_depart6']."x,";}
		if(isset($_GET['hos_depart7'])){$_Depart7="x".$_GET['hos_depart7']."x,";}if(isset($_GET['hos_depart8'])){$_Depart8="x".$_GET['hos_depart8']."x,";}
		if(isset($_GET['hos_depart9'])){$_Depart9="x".$_GET['hos_depart9']."x,";}if(isset($_GET['hos_depart10'])){$_Depart10="x".$_GET['hos_depart10']."x,";}
	if(isset($_GET['hos_depart11'])){$_Depart11="x".$_GET['hos_depart11']."x,";}if(isset($_GET['hos_depart12'])){$_Depart12="x".$_GET['hos_depart12']."x,";}
	if(isset($_GET['hos_depart13'])){$_Depart13="x".$_GET['hos_depart13']."x,";}if(isset($_GET['hos_depart14'])){$_Depart14="x".$_GET['hos_depart14']."x,";}
	if(isset($_GET['hos_depart15'])){$_Depart15="x".$_GET['hos_depart15']."x,";}if(isset($_GET['hos_depart16'])){$_Depart16="x".$_GET['hos_depart16']."x,";}
	if(isset($_GET['hos_depart17'])){$_Depart17="x".$_GET['hos_depart17']."x,";}if(isset($_GET['hos_depart18'])){$_Depart18="x".$_GET['hos_depart18']."x,";}
	if(isset($_GET['hos_depart19'])){$_Depart19="x".$_GET['hos_depart19']."x,";}
$_All_Depart=$_Depart1.$_Depart2.$_Depart3.$_Depart4.$_Depart5.$_Depart6.$_Depart7.$_Depart8.$_Depart9.$_Depart10.$_Depart11.$_Depart12.$_Depart13.$_Depart14.$_Depart15.$_Depart16.$_Depart17.$_Depart18.$_Depart19;//echo $_All_Depart."<br>";
				$_access=substr($_All_Depart,0,strlen($_All_Depart)-1);
				if(!$_access){ //access
					print"<br><br><center><h2>".$Slogin."...กรุณากำหนดสิทธิการใช้งานด้วย...ครับ</h2></center><br>";
					print"<p align=center>&nbsp;<input type='submit' value='ย้อนกลับ'  id='Button' onClick='goHist(-1);'><br><br>";
				}else{//access
				//echo $_access; 
				$sql_access="INSERT INTO risk_user_access VALUES('$Slogin','$_access') ";
					mysql_query($sql_access)
					or die ("ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font></center>".mysql_error());
					echo "<center><h2>- - บันทึกข้อมูลในฐานข้อมูล เรียบร้อยแล้ว - -</h2></center>";
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=result_chlogin.php'>";
				}//access
			}else{//all access
				//echo $_GET['all_access'];exit();
				if($_GET['all_access']=='ALL'){ //all access2
				$sql_Allaccess="INSERT INTO risk_user_access VALUES('$Slogin','".$_GET['all_access']."') ";
					mysql_query($sql_Allaccess)
					or die ("ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้<br><center><font color=red><h2>ติดต่อผู้ดูแลระบบ</h2></font></center>".mysql_error());
					echo "<center><h2>- - บันทึกข้อมูลในฐานข้อมูล เรียบร้อยแล้ว - -</h2></center>";
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=result_chlogin.php'>";
				}else{ //all access2
					print"<br><br><center><h2>".$Slogin."...กรุณากำหนดสิทธิการใช้งานด้วย...ครับ</h2></center><br>";
					print"<p align=center>&nbsp;<input type='submit' value='ย้อนกลับ'  id='Button' onClick='goHist(-1);'><br><br>";
				}//all access2
			}//all access
		}//ch user		
	}//ch press button save
	?>
		  </td>
        </tr>
        <tr>
          <td height="16" align="center" background="img_mian/orizontal.jpeg">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23"><p align="center">Development By <b>กูประจักษ์ ราเหม</b> CopyRight &copy; 04-2006 
        <b>IM Team Mayo Hospital.</b>All right reserved
      </p></td>
  </tr>
</table>
<?php 
  }//ch online
}//check access
CloseDB(); //close connect db ?>
</body>
</html>
