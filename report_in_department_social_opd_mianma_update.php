<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - �к��Թ����� | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - �ʹ����Ѻ��ԡ�� -> ��§ҹ���� ����� Diag= Z008 - - |</title>
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
                  <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> �к���Ѻ��ا�����ŵ�Ǩ�آ�Ҿ�ç�ҹ��ҧ���� </td>
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
	   		
			print"</select>&nbsp;&nbsp;&nbsp;<input type='submit' value='Continue' id='Button'>";


			?>		   </td>
               </tr>
             <tr>
               <td></td>
               <td>
			   <?php
				
				
				
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
                <tr align="center">
                  <td colspan="2">

<form method='post' action='print_card_mianma.php' target='_blank' >
		 
				
			<?php
				//sql create table show
				$d1=$sy1."-".$sm1."-".$sd1;$d2=$sy2."-".$sm2."-".$sd2;//echo $d1."dd".$d2;


$sqlOpd_Socail="select p.hn,p.cid,v.vn,v.hn,v.vstdate,concat(p.pname,p.fname,'  ',p.lname) as pt_name,
(
	select o.sum_price from opitemrece o where o.vn =v.vn and 
	o.icode = 3008183
	limit 1
) as sum_3008183,

(
	select o.qty from opitemrece o where o.vn =v.vn and 
	o.icode = 3008183
	limit 1
) as qty_3008183

from vn_stat v

left outer join patient p on p.hn = v.hn

where v.vstdate = '$d1' and
(
       select count(o.icode) from opitemrece o where o.vn = v.vn  and o.icode = '3008110'
)  = 1 ";


$resultOpd_Socail=ResultDB($sqlOpd_Socail);//echo mysql_num_rows($resultDenService);
				
				if(mysql_num_rows($resultOpd_Socail)>0){
					print"<u><font color='green'><b>�ʴ������Ţͧ�ѹ��� <font color='red'>$sd1</font> ��͹ <font color='red'>".change_month_isThai($sm1)."</font> �� <font color='red'>".($sy1+543)."</font> �֧�ѹ��� <font color='red'>$sd2</font> ��͹ <font color='red'>".change_month_isThai($sm2)."</font> �� <font color='red'>".($sy2+543)."</font>";
					print"<br>�շ����� ".mysql_num_rows($resultOpd_Socail)." ��¡��</b></font></u>";
						//create row
						?><br><br>

		

					<table width="1000" border="1" cellspacing="0" cellpadding="0" class="bd-external">
                      <tr>
                        <td height="44" align="center"><table width="1000" border="0" cellpadding="1" cellspacing="1">
                          <tr class="headtable">
                          
							<td height="21"  align="center" background="img_mian/bgcolor2.gif">�/�/� ���ŧ����¹</td> 
							 <td  align="center"  background="img_mian/bgcolor2.gif">HN</td>
                            <td  align="center"  background="img_mian/bgcolor2.gif">����-ʡ��</td>
							 <td  align="center"  background="img_mian/bgcolor2.gif">�Ţ�ѵ�</td>
							  <td  align="center"  background="img_mian/bgcolor2.gif">�óյ�Ǩ����ҹ</td>
                            <td  align="center"  background="img_mian/bgcolor2.gif">��Ѻ��ا������</td>

                                          
                          </tr>
                          <?php
				$i=0;
			          while($i<mysql_num_rows($resultOpd_Socail)){//while
						 $rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);
					if ($bg=="#FFFFFF") { //color
						$bg="#B1C3D9";
					//$bgm="";
						}else{
						$bg="#FFFFFF";
						//$bgm="img_mian/bgcolor.gif";
						} //color
						?>
                          <tr bgcolor="<?php echo $bg;?>">
							
							
 
                            <td  align="center"><?php echo FormatDateEng($rsOpd_Socail['vstdate']); ?></td>
							 <td align="center"><?php echo $rsOpd_Socail['hn']; ?></td>
                            <td align="left"><?php echo $rsOpd_Socail['pt_name']; ?></td>
							<td align="center"><?php echo $rsOpd_Socail['cid']; ?></td>

					<?php if($rsOpd_Socail['qty_3008183'] != 0) {?>
						<td align="left">&nbsp;<?php echo "<a href='report_in_department_social_opd_mianma_update_zero_success.php?hn=".$rsOpd_Socail['hn']."&vn=".$rsOpd_Socail['vn']."&vstdate=".$rsOpd_Socail['vstdate']."'    
						 target='_blank'>".��Ѻ��һ�Сѹ�آ�Ҿ���ٹ��."</a>"; ?></td>
					
					<?php } else { ?>
						<td>
							<?php 
								if($rsOpd_Socail['qty_3008183']==0) {
									echo "<a href='report_in_department_social_opd_mianma_update_non_zero_success.php?hn=".$rsOpd_Socail['hn']."&vn=".$rsOpd_Socail['vn']."&vstdate=".$rsOpd_Socail['vstdate']."'    
						 target='_blank'>".'0'."</a>";
								}
							?>
						</td>
					<?php } ?>
                            
							<td align="left">&nbsp;<?php echo "<a href='report_in_department_social_opd_mianma_update_success.php?hn=".$rsOpd_Socail['hn']."&vn=".$rsOpd_Socail['vn']."&vstdate=".$rsOpd_Socail['vstdate']."'    
						 target='_blank'>".��Ѻ��ا������."</a>"; ?></td>

         
                   

                          </tr>
                          <?php
						$i++;
					} //while 
					?>
                        </table></td>
                      </tr>
                    </table>
					<?php 
		

				}else{
						if($sy1<>""){print"<font color='green'><b>����բ����Ţͧ<br>�ѹ��� <font color='red'>$sd1</font> ��͹ <font color='red'>".change_month_isThai($sm1)."</font> �� <font color='red'>".($sy1+543)."</font> �֧�ѹ��� <font color='red'>$sd2</font> ��͹ <font color='red'>".change_month_isThai($sm2)."</font> �� <font color='red'>".($sy2+543)."</font></b></font>";
						}else{print"<font color='green'><b>��س����͡��ǧ���� ����Ѻ��§ҹ</b></font><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";}
				}
				?>
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

</form> 

<?php 
}//ch online
CloseDB(); //close connect db ?>
</body>
</html>
