<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - �к��Թ����� | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> |��§ҹ��ػ������ӻ�֡������ͧ�� - - |</title>
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
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
</head>
<?php
if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line

?>
<body>
<table width="1024" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="927" height="276" align="center">
	  <table width="1010" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td colspan="2" valign="top">
            <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
          </td>
        </tr>
        <tr>
          <td width="659" height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC"><?php include("manu.inc"); ?>
          </td>
          <td width="139" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; </td>
        </tr>
        <tr>
          <td height="177" colspan="2" align="center" valign="top" class="td-left"><br>
              <table width="1019" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                <tr align="center" bgcolor="#99CCFF">
                  <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> ��§ҹ��ػ������ӻ�֡������ͧ��</td>
                </tr>
                <tr align="center">
           <td colspan="2" valign="top">
<form action="<?php $PHP_SELF ?>" method="get" name="f_select_dmy">
		   <table width="360" border="0" cellspacing="2" cellpadding="1">
             <tr align="center">
               <td colspan="3"><font color="green"><b><u>���͡��ǧ����</u></b></font></td>
               </tr>
             <tr>
               <td width="78">
			<?php
				print"�ѹ���&nbsp;";
				print"<select name='sd1' id='Txt-Field'>";
				if($sd1<>""){print"<option value='$sd1'>$sd1</option>";}
					for($i=1;$i<=31;$i++){
						print"<option value='$i'>$i</option>";
					}
				print"</select>"; 
				?>
				 </td>
               <td width="129">
			<?php
				print"&nbsp;��͹&nbsp;";
				print"<select name='sm1' id='Txt-Field'>";
				if($sm1<>""){print"<option value='$sm1'>".change_month_isThai($sm1)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>"; 
				?>
			   </td>
               <td width="135">
				<?php
				print"&nbsp;��&nbsp;";
				$sqlSyear="select   DISTINCT YEAR(vstdate) as s_year  from dtmain group by  vstdate desc  ";
				$result=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				print"<select name='sy1'  id='Txt-Field'>";
				if($sy1<>""){print"<option value='$sy1'>".($sy1+543)."</option>";}
					 if(mysql_num_rows($result)>0){
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						print "<option value='".$rs['s_year']."'>".($rs['s_year']+543)."</option>";
						}										    
					}
					print"</select>";
	   		?>&nbsp;&nbsp;&nbsp;&nbsp;	�֧		   </td>
               </tr>
             <tr>
               <td><?php
				print"�ѹ���&nbsp;";
				print"<select name='sd2' id='Txt-Field'>";
				if($sd2<>""){print"<option value='$sd2'>$sd2</option>";}
					for($i=1;$i<=31;$i++){
						print"<option value='$i'>$i</option>";
					}
				print"</select>"; 
				?></td>
               <td><?php
				print"&nbsp;��͹&nbsp;";
				print"<select name='sm2' id='Txt-Field'>";
				if($sm2<>""){print"<option value='$sm2'>".change_month_isThai($sm2)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>"; 
				?></td>
               <td>
			   <?php
				print"&nbsp;��&nbsp;";
				$sqlSyear="select   DISTINCT YEAR(vstdate) as s_year  from dtmain group by  vstdate desc  ";
				$result=ResultDB($sqlSyear);//echo mysql_num_rows($result);
				print"<select name='sy2'  id='Txt-Field'>";
				if($sy2<>""){print"<option value='$sy2'>".($sy2+543)."</option>";}
					 if(mysql_num_rows($result)>0){
						for($i=0;$i<mysql_num_rows($result);$i++){
						$rs=mysql_fetch_array($result);
						print "<option value='".$rs['s_year']."'>".($rs['s_year']+543)."</option>";
						}										    
					}
				
				print"</select>&nbsp;&nbsp;&nbsp;<input type='submit' value='Continue' id='Button'>";
	   		?>				</td>
               </tr>
           </table>
</form>

		 	</td>
                </tr>
                <tr align="center">
                  <td colspan="2">
				  
				  
				  </td>
                </tr>
                <tr>
                  <td colspan="2"><!-- end ���ҧ��ͺ���ҧ --></td>
                </tr>
                <tr align="center" valign="top">
                  <td colspan="2"> </td>
                </tr>
                <tr align="center">
                  <td colspan="2">

				  </td>
                </tr>
				
				<tr>
					<td colspan='2' align='center'>
						
<?

//sql create table show
$ds1=$sy1."-".$sm1."-".$sd1;$ds2=$sy2."-".$sm2."-".$sd2;//echo $d1."dd".$d2;


$sqlOpd_Socail="SELECT

(select count(checkboxm1)   from lamae_pharmacy_advice where checkboxm1=1   and vstdate between '$ds1' and '$ds2')   as count1 ,
(select count(checkboxs11)  from lamae_pharmacy_advice where checkboxs11=1  and vstdate between '$ds1' and '$ds2')  as count11,
(select count(checkboxs12)  from lamae_pharmacy_advice where checkboxs12=1  and vstdate between '$ds1' and '$ds2')  as count12,
(select count(checkboxs13)  from lamae_pharmacy_advice where checkboxs13=1  and vstdate between '$ds1' and '$ds2')  as count13,
(select count(checkboxs14)  from lamae_pharmacy_advice where checkboxs14=1  and vstdate between '$ds1' and '$ds2')  as count14,
(select count(checkboxs15)  from lamae_pharmacy_advice where checkboxs15=1  and vstdate between '$ds1' and '$ds2')  as count15,
(select count(checkboxs16)  from lamae_pharmacy_advice where checkboxs16=1  and vstdate between '$ds1' and '$ds2')  as count16,
(select count(checkboxs17)  from lamae_pharmacy_advice where checkboxs17=1  and vstdate between '$ds1' and '$ds2')  as count17,
(select count(checkboxs18)  from lamae_pharmacy_advice where checkboxs18=1  and vstdate between '$ds1' and '$ds2')  as count18,
(select count(checkboxs19)  from lamae_pharmacy_advice where checkboxs19=1  and vstdate between '$ds1' and '$ds2')  as count19,
(select count(checkboxs110) from lamae_pharmacy_advice where checkboxs110=1 and vstdate between '$ds1' and '$ds2') as count110 ,
(select count(checkboxm2)   from lamae_pharmacy_advice where checkboxm2=1   and vstdate between '$ds1' and '$ds2')   as count2 ,
(select count(checkboxm3)   from lamae_pharmacy_advice where checkboxm3=1   and vstdate between '$ds1' and '$ds2')   as count3 ,
(select count(checkboxm4)   from lamae_pharmacy_advice where checkboxm4=1   and vstdate between '$ds1' and '$ds2')   as count4 ,
(select count(checkboxm5)   from lamae_pharmacy_advice where checkboxm5=1   and vstdate between '$ds1' and '$ds2')   as count5 ,
(select count(checkboxs51)  from lamae_pharmacy_advice where checkboxs51=1  and vstdate between '$ds1' and '$ds2')  as count51,
(select count(checkboxs52)  from lamae_pharmacy_advice where checkboxs52=1  and vstdate between '$ds1' and '$ds2')  as count52,
(select count(checkboxs53)  from lamae_pharmacy_advice where checkboxs53=1  and vstdate between '$ds1' and '$ds2')  as count53,
(select count(checkboxs54)  from lamae_pharmacy_advice where checkboxs54=1  and vstdate between '$ds1' and '$ds2')  as count54,
(select count(checkboxs55)  from lamae_pharmacy_advice where checkboxs55=1  and vstdate between '$ds1' and '$ds2')  as count55,
(select count(checkboxm6)   from lamae_pharmacy_advice where checkboxm6=1   and vstdate between '$ds1' and '$ds2')   as count6 ,
(select count(checkboxm7)   from lamae_pharmacy_advice where checkboxm7=1   and vstdate between '$ds1' and '$ds2')   as count7 ,
(select count(checkboxm8)   from lamae_pharmacy_advice where checkboxm8=1   and vstdate between '$ds1' and '$ds2')   as count8 ,
(select count(checkboxm9)   from lamae_pharmacy_advice where checkboxm9=1   and vstdate between '$ds1' and '$ds2')   as count9 ,
(select count(checkboxm10)  from lamae_pharmacy_advice where checkboxm10=1  and vstdate between '$ds1' and '$ds2')   as count10 ,
(select count(checkboxm11)  from lamae_pharmacy_advice where checkboxm11=1  and vstdate between '$ds1' and '$ds2')   as count11 ,
(select count(checkboxs111) from lamae_pharmacy_advice where checkboxs111=1 and vstdate between '$ds1' and '$ds2')  as count111,
(select count(checkboxs112) from lamae_pharmacy_advice where checkboxs112=1 and vstdate between '$ds1' and '$ds2')  as count112,
(select count(checkboxs113) from lamae_pharmacy_advice where checkboxs113=1 and vstdate between '$ds1' and '$ds2')  as count113,
(select count(checkboxs114) from lamae_pharmacy_advice where checkboxs114=1 and vstdate between '$ds1' and '$ds2')  as count114,
(select count(checkboxm12)  from lamae_pharmacy_advice where checkboxm12=1  and vstdate between '$ds1' and '$ds2')  as countm12,
(select count(checkboxs121) from lamae_pharmacy_advice where checkboxs121=1 and vstdate between '$ds1' and '$ds2')  as count121,
(select count(checkboxs122) from lamae_pharmacy_advice where checkboxs122=1 and vstdate between '$ds1' and '$ds2')  as count122,
(select count(checkboxs123) from lamae_pharmacy_advice where checkboxs123=1 and vstdate between '$ds1' and '$ds2')  as count123,
(select count(checkboxs124) from lamae_pharmacy_advice where checkboxs124=1 and vstdate between '$ds1' and '$ds2')  as count124,
(select count(checkboxm13)  from lamae_pharmacy_advice where checkboxm13=1  and vstdate between '$ds1' and '$ds2')  as countm13 ,
(select count(checkboxm14)  from lamae_pharmacy_advice where checkboxm14=1  and vstdate between '$ds1' and '$ds2')  as countm14


FROM lamae_pharmacy_advice

LIMIT 1

";

$resultOpd_Socail=ResultDB($sqlOpd_Socail);

if(mysql_num_rows($resultOpd_Socail)>0){

print"<u><font color='green'><b>�ʴ������Ţͧ�ѹ��� <font color='red'>$sd1</font> ��͹ <font color='red'>".change_month_isThai($sm1)."</font> �� <font color='red'>".($sy1+543)."</font> �֧�ѹ��� <font color='red'>$sd2</font> ��͹ <font color='red'>".change_month_isThai($sm2)."</font> �� <font color='red'>".($sy2+543)."</font>";

$rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);


?>

<table border='1' width='600'>
	<tr>
		<td width='440'>1.�ѭ�ҡ������������������㹡������</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count1']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;1.1 �����ç�Ѵ</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count11']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;1.2 ���ҼԴ�Ը� </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count12']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;1.3 ���ҷ��ᾷ����������</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count13']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;1.4 ���Ң�Ҵ���١��ͧ</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count14']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;1.5 ���ҼԴ����</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count15']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;1.6 ���ҼԴ Route</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count16']?></td>
	</tr>


	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;1.7 ��ش���ҡ�͹��˹�</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count17']?></td>
	</tr>


	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;1.8 ����Ѻ��зҹ�ҡ���� 1 ���͢���</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count18']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;1.9 ������蹷��ᾷ������������ </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count19']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;1.10 ����</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count110']?></td>
	</tr>

	<tr>
		<td width='440'>2. ������ѡ����</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count2']?></td>
	</tr>

	<tr>
		<td width='440'>3. �Դ�ҡ�����֧���ʧ��ҡ�������</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count3']?></td>
	</tr>

	<tr>
		<td width='440'>4. �Դ Drug Interaction</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count4']?></td>
	</tr>

		<tr>
		<td width='440'>5. ��äǺ����ĵԡ�����ҧ�</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count5']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;5.1 �ٺ������</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count51']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;5.2 ����͡���ѧ���</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count52']?></td>
	</tr>

	
	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;5.3 ��äǺ��������</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count53']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;5.4 ����ͧ������š����� </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count54']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;5.5 ���� </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count55']?></td>
	</tr>

	<tr>
		<td width='440'>6. ���������������ǡѺ�����ä</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count6']?></td>
	</tr>


	<tr>
		<td width='440'>7. ���������������ǡѺ��</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count7']?></td>
	</tr>


	<tr>
		<td width='440'>8. ���������������ǡѺ�����á��͹</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count8']?></td>
	</tr>

	<tr>
		<td width='440'>9. ���������������ǡѺ��û�ԺѵԵ��</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count9']?></td>
	</tr>

	<tr>
		<td width='440'>10. Medication error</td>
		<td width='60' align='center'><?=$rsOpd_Socail['count10']?></td>
	</tr>
	
	<tr>
		<td width='440'>11. ��û����Թ�ä HbA1C </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count11']?></td>
	</tr>
	
	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;11.1 Poor Control (>8%) </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count111']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;11.2 Moderate Control (7-8%) </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count112']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;11.3 Good Control (<7%)  </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count113']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;11.4 ����Һ�дѺ HbA1C ����ʹ   </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count114']?></td>
	</tr>

	<tr>
		<td width='440'>12. ��û����Թ�ä��� FBS</td>
		<td width='60' align='center'><?=$rsOpd_Socail['countm12']?></td>
	</tr>
	
	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;12.1 Poor Control (>180mg%) </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count121']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;12.2 Moderate Control (126-180 mg%) </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count122']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;12.3 Good Control (<126 mg%)  </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count123']?></td>
	</tr>

	<tr>
		<td width='440'>&nbsp;&nbsp;&nbsp;12.4 ����Һ�дѺ FBS ����ʹ </td>
		<td width='60' align='center'><?=$rsOpd_Socail['count124']?></td>
	</tr>

	<tr>
		<td width='440'>13. BMI �ҡ���� 23kg/m(2)</td>
		<td width='60' align='center'><?=$rsOpd_Socail['countm13']?></td>
	</tr>

	<tr>
		<td width='440'> 14. ����</td>
		<td width='60' align='center'><?=$rsOpd_Socail['countm14']?></td>
	</tr>




</table>



<?}?>
					</td>
					
				</tr>
				
				
                <tr>
                  <td width="544">&nbsp;</td>
                  <td width="475">&nbsp;</td>
                </tr>
              </table>
              <!-- form -->
              <!-- end form --></td>
        </tr>
        <tr>
          <td height="16" colspan="2" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"javascript:history.back(-1)\">��͹��Ѻ</a>" ?>&nbsp;|</td>
        </tr>
        <tr>
          <td height="16" valign="top"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="16" valign="top">&nbsp;</td>
        </tr>
      </table>
	</td>
  </tr>
  <tr> 
    <td height="23">
	
	</td>
  </tr>
</table>
<?php 
}//ch online
CloseDB(); //close connect db ?>
</body>
</html>
