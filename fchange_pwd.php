<?php
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - Managment User สำหรับ Web Servive - -</title>
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
</head>

<body><br>
<?php 
if  (($_SESSION["user_type"]=="online")  AND !Check_Onlines()){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";}
		
$ip=get_ip();//func get ip from computer
$online=Check_Online($ip); //func check online

if(!$_SESSION['ip_Log']){ //not admin
		echo "<center><h2><font color=red>ระบบไม่สามารถ ให้ท่านกำหนดรหัสผ่านใหม่ได้<br>กรุณาเข้าระบบใหม่ โดยใช้รหัสผ่านเดิม อีกครั้ง</font></h2></center>";
}elseif(!$_POST['submit']){ //session not empty
?>
<form action="<?php $PHP_SELF; ?>" method="post" name="fchangepwd">
<table width="280" height="89" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
  <tr>
    <td width="300"><table width="280" border="0" align="center" cellpadding="1" cellspacing="3">
          <tr align="center" bgcolor="#0099FF"> 
            <td colspan="3" class="headmenu">เปลี่ยนรหัสผ่านสำหรับ Web Servive</td>
          </tr>
          <tr> 
            <td width="91" align="left" class="headtable"> &nbsp;คุณคือ</td>
            <td colspan="2" align="left">&nbsp;<?php echo $_SESSION['ip_Log'];?></td>
          </tr>
          <tr> 
            <td align="left"  class="headtable">&nbsp;รหัสผ่านเดิม</td>
            <td colspan="2" align="left"><input  type="password" name="oldpwd" id="Txt-Field"></td>
          </tr>
          <tr>
            <td align="left" class="headtable">&nbsp;รหัสผ่านใหม่</td>
            <td colspan="2" align="left"><input type="password" name="newpwd" id="Txt-Field"></td>
          </tr>
          <tr> 
            <td align="left" class="headtable">&nbsp;ยืนยันอีกครั้ง</td>
            <td colspan="2" align="left"><input type="password" name="confirm_newpwd" id="Txt-Field"></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td width="110" align="left"><input type="submit" name="submit" id="Button" value="Change"></td>
            <td width="61" align="left">&nbsp;</td>
          </tr>
        </table></td>
  </tr>
</table>
</form>
<?php }//session end

//********************change pwd***************************//
if($_POST['submit']=="Change"){ //submit
	if(!$_POST['oldpwd'] || !$_POST['newpwd'] || !$_POST['confirm_newpwd']){ //input box
		echo "<center><h2><font color=red>กรุณากรอกข้อมูลให้ครบทุกช่อง</font></h2></center>";
	}else{//input box
		//OK
		//check old pwd for user right
				$u_p=explode("#",empty_passweb2($ip_Log)); //user and pass by return from function
				$ip_Log=$u_p[0];
				$p=$u_p[1];
						$u_enc=enc_create_u(trim($ip_Log)); //user encode from login
				 		$p_enc=enc_create_p(trim($_POST['oldpwd'])); //pwd encode from login
				 		$sum_enc="$u_enc"."$p_enc"; //sum
						 if($sum_enc==$p){ //$sum_enc==$p
						 //---------------------------ok
						 		if($_POST['newpwd']==$_POST['confirm_newpwd']){ //new=old
						 			//---------------------------ok
									$n_pwd=$u_enc."".enc_create_p(trim($_POST['newpwd'])); //newpwd encode from login
									$sql="update web_pwd set passweb='$n_pwd' where loginname='$ip_Log' ";
									mysql_query($sql)
									or die("Don't Update Database".mysql_error());
									//update complete
									echo "<center><font color=red><h2>บันทึกข้อมูลเรียบร้อยแล้ว</h2></font>";
									echo"<br><a href=\"result_chlogin.php\">รายการหลัก</a></center>";
								}else{//new=old
						 			echo "<center><h2><font color=red>รหัสผ่านใหม่และยืนยันอีกครั้งไม่เหมือนกัน</font></h2></center>";
								}//new=old
						 }else{//$sum_enc==$p
						 //----------------------------no
						 echo "<center><h2><font color=red>รหัสผ่านเดิมของท่านไม่ถูกต้อง กรอกใหม่อีกครั้ง</font></h2></center>";
						 }//$sum_enc==$p
	}//input box
}//submit
?>
<center><font face="MS Sans Serif"><a href="javascript:history.back(-1)">ย้อนกลับ</a></font></center>
</body>
</html>
