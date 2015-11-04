<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB(); //connect db
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - Connect NHSO - - |</title>
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
<script language="JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<body>
<div align="left">
<table width="100%" height="50"  border="0" align="center" cellpadding="0" cellspacing="0" background="img_mian/nhso.jpg">
  <tr>
    <td width="953" align="left"><form method="post" action="http://ucsearch.nhso.go.th/login.jsp">
						<INPUT TYPE="hidden" name="pagestatus" value="null">      
						  <input name="error13" type="hidden" id="error13" value="google.com">
                              <input type=hidden name="user" size="13" value="<?php echo $Nhsouser;?>">
                              <input type=hidden name="password" size="13" value="<?php echo $Nhsopass;?>">
                          <div align="center"><font color="white" size="3"><b>เชื่อมต่อกับเวบไซด์ สปสช.</font>
						  <?php $act="connect";?>
                              <input name="LOGIN" type="submit" id="LOGIN" value="เชื่อมต่อ" onClick="<?php  $act="connect";session_register("act");?>">   
							  <INPUT TYPE="button" VALUE="ยกเลิก" onClick="parent.location='hipdata.php?act=disconnect'">
							  						      
        </div>
    </form>	</td>
  </tr>
</table>
</div>
</body>
</html>
<?php  CloseDB(); ?>