<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title>�к��Թ����� | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ����ǡѺ HOSxP  Web Service - - |</title>
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
$filename = "about.txt"; //��˹�����÷����ҧ�ԧ�֧���
$handle = fopen ($filename, "r"); //�ӡ���Դ��� �����纤�� resource number ������
$contents = fread ($handle, filesize($filename)); //��ҹ��� �����红�����������㹵����
echo $contents; //�ʴ������ŷ�����������͡��
fclose ($handle); //�Դ���	  
?>
	  </td>
    </tr>
  </table>
</center>
</body>
</html>
