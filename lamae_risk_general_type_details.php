<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>

<html>
	<head>
		<title>��èѴ�дѺ�����ع�ç�ͧ�غѵԡ�÷���� (non - clinic)</title>
	</head>

<body>

<br />
<br />

<table width="700" border="1" align="center" cellpadding="3" cellspacing="3">
	<tr>
		<td colspan="2" align="center" height="25"><font size="4"><b>��èѴ�дѺ�����ع�ç�ͧ�غѵԡ�÷���� (non - clinic)</b></font></td>
	</tr>

	<tr>
		<td width="100" align="center"><b>�����ع�ç</b></td>
		<td align="left"><b>�˵ء�ó�</b></td>
	</tr>



	 <tr>
                <?php
				 $sqlS_general_relation="SELECT * FROM risk_relation_general_program ";$resultS_relation=ResultDB($sqlS_general_relation);
				 if(mysql_num_rows($resultS_relation)>0){
					
				
						
						for($i=0;$i<mysql_num_rows($resultS_relation);$i++){
						$rsS_relation=mysql_fetch_array($resultS_relation);
						

						print "<tr><td align='center'><b>".$rsS_relation['name']."</b></td><td>".$rsS_relation['description']."</td></tr>";
						
						
						}}										    
				

?>



</table>

<br/>
<center><input type="button" value="�Դ˹�ҵ�ҧ���" onclick="javascript:window.close()"></center>


</body>

</html>
