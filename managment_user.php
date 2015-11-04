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

if(!check_right($_SESSION["right"],"ADMIN")){ //not admin
		echo "<center><h2><font color=red>ท่านไม่มีสิทธิใช้งานหน้านี้</font></h2></center>";
		//session_unregister("ip_Log","permission");
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
		}else{ //admin ok
?>
<form action="nagment_pwd.php" method="post" name="fcpwd">
<table width="280" height="89" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
  <tr>
    <td width="300"><table width="280" border="0" align="center" cellpadding="1" cellspacing="3">
          <tr align="center" bgcolor="#0099FF"> 
            <td colspan="3" class="headmenu">Managment User สำหรับ Web Servive</td>
          </tr>
          <tr> 
            <td width="53" align="left" class="headtable"> &nbsp;คุณคือ</td>
            <td colspan="2" align="left">&nbsp;<?php echo $_SESSION['ip_Log'];?></td>
          </tr>
          <tr> 
            <td align="left"  class="headtable">&nbsp;ชื่อผู้ใช้</td>
            <td colspan="2" align="left">&nbsp;
              <?php 
			  $sql="select w.*,o.accessright as access_menu from web_pwd w ";
			  $sql.="left outer join opduser o on o.loginname=w.loginname ";
			  $sql.="where o.accessright  not like '%ADMIN%' order by w.loginname ";
			//$sql="select * from opduser where  accessright  not like '%ADMIN%' order by loginname";
				$result=mysql_db_query($DBName,$sql)
				or die("ไม่สามารถแสดงข้อมูลได้<br>".mysql_error());
				$n_rows=mysql_num_rows($result);
				echo"<select  name=\"s_user\" size=\"1\" id=\"Txt-Field\">";
			 //set form
			 $i=0;
			 while($i<$n_rows){
			 $rs=mysql_fetch_array($result);$login_name=$rs["loginname"];
			 echo "<option value=\"$login_name\">$login_name</option>";
			 $i++;
			}
			echo"</select>";
			?>
            </td>
          </tr>
          <tr> 
            <td align="left">&nbsp;</td>
            <td colspan="2" align="left">&nbsp; <input name="s_clear" type="radio" value="user" checked>
              &nbsp;ชื่อผู้ใช้&nbsp;<input name="s_clear" type="radio" value="self">&nbsp;<?php echo $_SESSION['ip_Log']; ?></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td width="148" align="left">&nbsp; <input type="submit" id="Button" value="Clear Password"></td>
            <td width="61" align="left">&nbsp;</td>
          </tr>
        </table></td>
  </tr>
</table>
</form>
<?php }//admin

?>
<center><font face="MS Sans Serif"><a href="javascript:history.back(-1)">ย้อนกลับ</a></font></center>
</body>
</html>
