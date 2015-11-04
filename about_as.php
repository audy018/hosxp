<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - เกี่ยวกับ HOSxP  Web Service - - |</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
body {  margin: 0px  0px; padding: 0px  0px}
a:link { color: #005CA2; text-decoration: none}
a:visited { color: #005CA2; text-decoration: none}
a:active { color: #0099FF; text-decoration: none}
a:hover { color: #0099FF; text-decoration: underline}
body{
	font-family:MS Sans Serif;
	font-size:10pt;
	background-color: #99FF00;
}
table,td{font-family:MS Sans Serif;font-size:10pt}
form{font-family:MS Sans Serif;font-size:10pt}
-->
</style>
</head>
<body>
<center>
  <table width="400" border="1" cellpadding="0" cellspacing="0" bordercolor="#0066FF" height="450">
    <tr>
      <td align="center" bgcolor="#99FF00">
	  <?php
$filename = "about.txt"; //กำหนดตัวแปรที่อ้างอิงถึงไฟล์
$handle = fopen ($filename, "r"); //ทำการเปิดไฟล์ แล้วเก็บค่า resource number เอาไว้
$contents = fread ($handle, filesize($filename)); //อ่านไฟล์ แล้วเก็บข้อมูลเอาไว้ในตัวแปร
echo $contents; //แสดงข้อมูลที่เก็บเอาไว้ออกมา
fclose ($handle); //ปิดไฟล์	  
?>
	  </td>
    </tr>
  </table>
</center>
</body>
</html>
