<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();

if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";
}else{ //on line
if  (($_SESSION["user_type"]=="online")  AND !Check_Online(get_ip())){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";}
		
if ($_GET['id1']<>""){
  $id1=$_GET['id1'];}else{
 $id1=date("d-m-Y");
 }
$d_conv=explode("-",$id1);$d=$d_conv[0];$m=$d_conv[1];$y=$d_conv[2];
$d_conv_search="$y-$m-$d";
$m_conv_search="$y-$m";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>�к��Թ����� | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ��ػ�����Ż�Ш��ѹ - - |</title>
<style type="text/css">
<!--
body {  margin: 0px  0px; padding: 0px  0px}
body{font-family:MS Sans Serif;font-size:10pt}
table,td{font-family:MS Sans Serif;font-size:10pt}
form{font-family:MS Sans Serif;font-size:10pt}
.style1 {color: #FF0000}
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

	<script language="javascript" src="Script/codethatcalendarstd.js"></script>
	<script language="javascript" src="Samples/iframe_ex.js"></script>
	<script language="javascript">
		var c1 = new CodeThatCalendar(caldef1);
</script>
</head>
<body>
<a name="top"></a> 
<div id="Layer1" style="position:absolute; left:666px; top:179px; width:187px; height:171px; z-index:1"> 
  <script>
			// Create iframe
	                if(ua.oldOpera)document.write("<div id=\"calendar_div\">");
			document.write("<iframe id=\"calendar_frame\" name=\"calendar_frame\"");
			document.write(" frameborder=\"0\""); 
			document.write(" scrolling=\"no\""); 
			document.write(" style=\"visibility:hidden;\"");
			if(ua.oldOpera) 
   				document.write(" src=\"Samples/codethatcalendar.html\">");
			else document.write(">");
			document.write("</iframe>");
			if(ua.oldOpera)document.write("</div>");
		</script>
</div>
<table width="800" border="0" cellspacing="0" cellpadding="0" id="table"><a name="top"></a>
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr valign="top"> 
          <td colspan="2">
		  <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
	</td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif"><?php include("manu.inc"); ?></td>
          <td width="166" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp;</td>
        </tr>
        <tr> 
          <td width="634" height="187" valign="top" class="td-left2"><div align="center"><br> 
            <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="620" valign="top"><table width="620" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                  <tr bgcolor="#99CCFF">
                    <td height="24" colspan="2" class="headmenu" background="img_mian/bgcolor2.gif" align="center">��ػ�����Ż�Ш��ѹ  <?php echo "&nbsp;".$Hospname."&nbsp;"; ?></td>
                  </tr>
                  <tr>
                    <td width="339" valign="top">
					<!--<form method="get" action="<?php echo $PHP_SELF; ?>">
                            &nbsp;&nbsp;���͡�ѹ��� .. 
                            <input name="id1" type="text" value="<?php echo $id1; ?>" size="15"/>
                            <input type="button" onClick="c1.innerpopup('id1','calendar_frame');" value="..."/>
                            <input type="submit" value="Refresh">
                          </form>
						  -->
                    </td>
                    <td width="281" align="right">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><?php 
							echo "&nbsp;<b>������ � �ѹ���</b>&nbsp;<font color=red><u>".dateThai($d_conv_search)."</u></font>";
						?>
                    </td>
                  </tr>
                  <tr>
                    <td><?php
						//�ӹǹ��������ѹ������͡
//�ӹǹ��
						$sql_c_ovst1="select count(distinct hn) as cc1 from ovst where vstdate='$d_conv_search' "; 
						$result_c_ovst1=mysql_db_query($DBName,$sql_c_ovst1)
						or die("�������ö���͡���������ʴ���".mysql_error());
						$rs_c_ovst1=mysql_fetch_array($result_c_ovst1);
//�ӹǹ����
						$sql_c_ovst2="select count(*) as cc2 from ovst where vstdate='$d_conv_search' "; //�ӹǹ����
						$result_c_ovst2=mysql_db_query($DBName,$sql_c_ovst2)
						or die("�������ö���͡���������ʴ���".mysql_error());
						$rs_c_ovst2=mysql_fetch_array($result_c_ovst2);
						echo "<b>&nbsp;�ӹǹ������Ѻ��ԡ�÷����� :".$rs_c_ovst1["cc1"]."&nbsp;��&nbsp;".$rs_c_ovst2["cc2"]."&nbsp;����</b>"; //�ʴ��ӹǹ������Ѻ��ԡ��
						?>
                    </td>
                    <td><div align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                  </tr>
                  <?php if ($rs_c_ovst1["cc1"]>0){ ?>
                  <tr valign="top">
                    <td colspan="2"><div align="right"><a href="#below"><img src="img_mian/arow_bl.gif" width="13" height="9" border="0"></a>&nbsp;��ҹ��ҧ&nbsp;&nbsp;</div></td>
                  </tr>
                  <tr valign="top">
                    <td colspan="2"><div align="center"><br>
                            <table width="550" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                              <tr bgcolor="#FFFFFF" class="headtable">
                                <td width="380" background="img_mian/bgcolor2.gif" align="center"> ��ػ�ʹ�������ԡ��</td>
                                <td width="89"  background="img_mian/bgcolor2.gif" align="center">�ӹǹ</td>
                                <td width="73" background="img_mian/bgcolor2.gif" align="center">Task</td>
                              </tr>
                              <tr class="text-intable">
                                <td><div align="left">&nbsp;�ӹǹ�����·���Ѻ��ԡ�÷����ͧ ER</div></td>
                                <td><div align="center">
                                    <?php	//�ӹǹ�����·���Ѻ��ԡ�÷����ͧ ER										  
						$sqlEr="select count(*) as cc_er from er_regist where vstdate='$d_conv_search' "; 
						$resultEr=mysql_db_query($DBName,$sqlEr)
						or die("�������ö���͡���������ʴ���".mysql_error());
						$rsEr=mysql_fetch_array($resultEr);
						echo $rsEr["cc_er"];
							?>
                                </div></td>
                                <td><div align="center"><?php echo "<a href=\"patient_in_department_er_list.php?id1=$id1\">�ʴ���ª���</a>"; ?></div></td>
                              </tr>
                              <tr class="text-intable">
                                <td><div align="left">&nbsp;�ӹǹ�����·���ҹ��ëѡ����ѵ�</div></td>
                                <td><div align="center">
                                    <?php	//�ӹǹ�����·���ҹ��ëѡ����ѵ�										  
						$sqlPq="select count(*) as cc_pq from pq_screen where screen_date='$d_conv_search' "; 
						$resultPq=mysql_db_query($DBName,$sqlPq)
						or die("�������ö���͡���������ʴ���".mysql_error());
						$rsPq=mysql_fetch_array($resultPq);
						echo $rsPq["cc_pq"];
							?>
                                </div></td>
                                <td><div align="center"><?php echo"<a href=\"patient_in_department_screen_list.php?id1=$id1\">�ʴ���ª���</a>"; ?></div></td>
                              </tr>
                              <tr class="text-intable">
                                <td><div align="left">&nbsp;�ӹǹ�����·���ҹ��õ�Ǩ � ��ͧ��Ǩᾷ��</div></td>
                                <td><div align="center">
                                    <?php	//�ӹǹ�����·���ҹ��õ�Ǩ � ��ͧ��Ǩᾷ��										  
						$sqlPqd="select count(*) as cc_pqd from pq_doctor where doctor_date='$d_conv_search' "; 
						$resultPqd=mysql_db_query($DBName,$sqlPqd)
						or die("�������ö���͡���������ʴ���".mysql_error());
						$rsPqd=mysql_fetch_array($resultPqd);
						echo $rsPqd["cc_pqd"];
							?>
                                </div></td>
                                <td><div align="center"><?php echo "<a href=\"patient_in_department_doctor_list.php?id1=$id1\">�ʴ���ª���</a>"; ?></div></td>
                              </tr>
                              <tr class="text-intable">
                                <td><div align="left">&nbsp;�ӹǹ�����·���Ѻ��ԡ�� � ��ͧ�ѹ�����</div></td>
                                <td><div align="center">
                                    <?php	//�ӹǹ�����·���Ѻ��ԡ�� � ��ͧ�ѹ�����										  
						$sqlDt="select count(distinct hn) as cc_dt from dtmain where vstdate='$d_conv_search' "; 
						$resultDt=mysql_db_query($DBName,$sqlDt)
						or die("�������ö���͡���������ʴ���".mysql_error());
						$rsDt=mysql_fetch_array($resultDt);
						echo $rsDt["cc_dt"];
							?>
                                </div></td>
                                <td><div align="center"><?php echo "<a href=\"patient_in_department_dental_list.php?id1=$id1\">�ʴ���ª���</a>"; ?></div></td>
                              </tr>
                              <tr class="text-intable">
                                <td><div align="left">&nbsp;�ӹǹ��觵�Ǩ�ҧ��ͧ��Ժѵԡ�� / �ӹǹ��§ҹ</div></td>
                                <td><div align="center">
                                    <?php	//�ӹǹ��觵�Ǩ�ҧ��ͧ��Ժѵԡ�� / �ӹǹ��§ҹ										  
						$sqlLab1="select count(*) as cc_lab1 from lab_head where order_date='$d_conv_search' "; 
						$resultLab1=mysql_db_query($DBName,$sqlLab1)
						or die("�������ö���͡���������ʴ���".mysql_error());
						$rsLab1=mysql_fetch_array($resultLab1);
							//�ӹǹ��§ҹ
							$sqlLab2="select count(*) as cc_lab2 from lab_head where order_date='$d_conv_search' and confirm_report='Y' "; 
							$resultLab2=mysql_db_query($DBName,$sqlLab2)
							or die("�������ö���͡���������ʴ���".mysql_error());
							$rsLab2=mysql_fetch_array($resultLab2);
						echo $rsLab1["cc_lab1"]." / ".$rsLab2["cc_lab2"]; 	//�ӹǹ��觵�Ǩ�ҧ��ͧ��Ժѵԡ�� / �ӹǹ��§ҹ
							?>
                                </div></td>
                                <td><div align="center"><?php echo "<a href=\"patient_in_department_lab_list.php?id1=$id1\">�ʴ���ª���</a>"; ?></div></td>
                              </tr>
                              <tr class="text-intable">
                                <td><div align="left">&nbsp;�ӹǹ������Ѻ�Թ������� / �ӹǹ�Թ</div></td>
                                <td><div align="center">
                                    <?php	//�ӹǹ������Ѻ�Թ������� / �ӹǹ�Թ	
							  $d_con1=$d_conv_search." "."00:00:01";$d_con2=$d_conv_search." "."23:59:59";
						$sqlRcp1="select count(*) as cc_r1 from rcpt_print where bill_date_time between '$d_con1' and '$d_con2' "; 
						$resultRcp1=mysql_db_query($DBName,$sqlRcp1)
						or die("�������ö���͡���������ʴ���".mysql_error());
						$rsRcp1=mysql_fetch_array($resultRcp1);
							//�ӹǹ��§ҹ
							$sqlRcp2="select  sum(bill_amount) as cc_r2 from rcpt_print where bill_date_time between '$d_con1' and '$d_con2' "; 
							$resultRcp2=mysql_db_query($DBName,$sqlRcp2)
							or die("�������ö���͡���������ʴ���".mysql_error());
							$rsRcp2=mysql_fetch_array($resultRcp2);$con_mon_input=sprintf("%.2f",$rsRcp2["cc_r2"]);
						echo $rsRcp1["cc_r1"]." / ".number_format($con_mon_input)." �."; 	//�ӹǹ������Ѻ�Թ������� / �ӹǹ�Թ
							?>
                                </div></td>
                                <td><div align="center"><?php echo "<a href=\"patient_in_department_finance_list.php?id1=$id1\">�ʴ���ª���</a>"; ?></div></td>
                              </tr>
                              <tr class="text-intable">
                                <td><div align="left">&nbsp;�ӹǹ��¡����觨����Ҩҡ��ͧ��</div></td>
                                <td><div align="center">
                                    <?php	//�ӹǹ��¡����觨����Ҩҡ��ͧ��
								  $d_1=explode("-",$d_conv_search);
								  $sub_y=substr(($d_1[0]+543),2,2);
								  $d_rx=$sub_y.$d_1[1].$d_1[2]."%";
								$sqlRx="select count(*) as cc_rx from rx_operator where vn like '$d_rx' "; 
								$resultRx=mysql_db_query($DBName,$sqlRx)
								or die("�������ö���͡���������ʴ���".mysql_error());
								$rsRx=mysql_fetch_array($resultRx);
						     	echo $rsRx["cc_rx"]; 	//�ӹǹ��¡����觨����Ҩҡ��ͧ��

							   ?>
                                </div></td>
                                <td><div align="center"><?php echo "<a href=\"patient_in_department_item_list.php?id1=$id1\">�ʴ���ª���</a>"; ?></div></td>
                              </tr>
                              <tr class="text-intable">
                                <td><div align="left">&nbsp;�ӹǹ��¡�÷��١�ѹ�֡������ � ������������</div></td>
                                <td><div align="center">
                                    <?php //�ӹǹ��¡�÷��١�ѹ�֡������ � ������������
								$sqlRx2="select count(*) as cc_rx2 from rx_operator where vn like '$d_rx' and pay='Y' "; 
								$resultRx2=mysql_db_query($DBName,$sqlRx2)
								or die("�������ö���͡���������ʴ���".mysql_error());
								$rsRx2=mysql_fetch_array($resultRx2);
								echo $rsRx2["cc_rx2"]; 	//�ӹǹ��¡����觨����Ҩҡ��ͧ��
							  ?>
                                </div></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr class="text-intable">
                                <td><div align="left">&nbsp;�ӹǹ�����·��١ Admit</div></td>
                                <td><div align="center">
                                    <?php //�ӹǹ�����·��١ Admit
								$sql_ipt="select count(*) as cc_ipt from ipt where regdate='$d_conv_search' "; 
								$result_ipt=mysql_db_query($DBName,$sql_ipt)
								or die("�������ö���͡���������ʴ���".mysql_error());
								$rs_ipt=mysql_fetch_array($result_ipt);
								echo $rs_ipt["cc_ipt"]; 	//�ӹǹ�����·��١ Admit
							  ?>
                                </div></td>
                                <td><div align="center"><?php echo "<a href=\"patient_in_department_admit_list.php?id1=$id1\">�ʴ���ª���</a>"; ?></div></td>
                              </tr>
                              <tr class="text-intable">
                                <td><div align="left">&nbsp;�ӹǹ�����·��١��˹���</div></td>
                                <td><div align="center">
                                    <?php //�ӹǹ�����·��١��˹���
								$sql_ipt2="select count(*) as cc_ipt2 from ipt where dchdate='$d_conv_search' "; 
								$result_ipt2=mysql_db_query($DBName,$sql_ipt2)
								or die("�������ö���͡���������ʴ���".mysql_error());
								$rs_ipt2=mysql_fetch_array($result_ipt2);
								echo $rs_ipt2["cc_ipt2"]; 	//�ӹǹ�����·��١��˹���
							  ?>
                                </div></td>
                                <td><div align="center"><?php echo "<a href=\"patient_in_department_discharge_list.php?id1=$id1\">�ʴ���ª���</a>"; ?></div></td>
                              </tr>
                             
                            </table>
                            <br>
                          
                          
                            <br>
                            <table width="550" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                              <tr bgcolor="#FFFFFF" class="headtable">
                                <td width="46"  background="img_mian/bgcolor2.gif"><div align="center">�ӴѺ</div></td>
                                <td width="69"  background="img_mian/bgcolor2.gif"><div align="center">�����Է��</div></td>
                                <td width="195"  background="img_mian/bgcolor2.gif"><div align="center"> �����Է��</div></td>
                                <td width="115" valign="baseline"  background="img_mian/bgcolor2.gif"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;�ӹǹ������&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</div></td>
                                <td width="113" valign="baseline"  background="img_mian/bgcolor2.gif"><div align="center">�����������</div></td>
                              </tr>
                              <!-- ���ҧ�� table3 -->
                              <?php
								$sqlOvst2="select v.pttype,k.name,count(v.vn) as cc2,sum(t.income) as mc  from ovst  v "; 
								$sqlOvst2.="left outer join pttype k on k.pttype=v.pttype ";
								$sqlOvst2.="left outer join vn_stat t on t.vn=v.vn ";
								$sqlOvst2.="where v.vstdate='$d_conv_search' group by v.pttype  , k.name ";
								$resultOvst2=mysql_db_query($DBName,$sqlOvst2)
								or die("�������ö���͡���������ʴ���".mysql_error());
								$num_rows_Ovst2= mysql_num_rows($resultOvst2);
								$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            	if ($num_rows_Ovst2<>0){
								$sum_money=0;$i_2=0;
								while($i_2<$num_rows_Ovst2){
								$rsOvst2=mysql_fetch_array($resultOvst2);
								?>
                              <tr class="text-intable">
                                <td><div align="center"><?php echo $i_2+1;?></div></td>
                                <td><div align="center">&nbsp;<?php echo $rsOvst2["pttype"];?></div></td>
                                <td><div align="left">&nbsp;<?php echo $rsOvst2["name"];?></div></td>
                                <td><div align="left">&nbsp;<?php echo "$space".$rsOvst2["cc2"];?></div></td>
                                <td><div align="center">&nbsp;<?php echo number_format($rsOvst2["mc"])." �.";?></div></td>
                              </tr>
                              <?php
							$sum_money=($sum_money+$rsOvst2["mc"]);$i_2++; }//while
							?>
                              <!-- ��������ҧ�� -->
                              <tr class="headtable">
                                <td colspan="3">&nbsp;</td>
                                <td><div align="center">���</div></td>
                                <td><div align="center"><?php echo number_format($sum_money)." �.";?></div></td>
                              </tr>
                            </table>
                            <br>
                            <?php }//row  ebd table3?>
                    </div></td>
                  </tr>
                 
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><br></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td align="right"><div align="left">&nbsp;<a name="below"></a></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td align="right"><span class="style1">&nbsp;</span>&nbsp;&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div align="right">&nbsp;<a href="#top"><img src="img_mian/arow_t.gif" width="13" height="9" border="0"></a>&nbsp;��ҹ��&nbsp;&nbsp;</div></td>
                  </tr>
                  <?php } ?>
                </table></td>
              </tr>
            </table>
            <br> <center>
              </center></td>
          <td align="center" valign="top" class="td-right"><form method="get" action="<?php echo $PHP_SELF; ?>">
            <table width="160" border="0" cellpadding="0" cellspacing="2" class="bd-internal">
              <tr>
                <td bgcolor="#99CCFF" background="img_mian/bgcolor2.gif" class="headmenu"><div align="center"> :: <b>���͡�ѹ���</b> ::</div></td>
              </tr>
              <tr>
                <td><div align="left">&nbsp;
                        <input name="id1" type="text" id="Txt-Field" value="<?php echo $id1; ?>" size="18"/>
&nbsp; </div></td>
              </tr>
              <tr>
                <td align="center"><div align="left">&nbsp;
                        <input name="button" id="Button" type="button" onClick="c1.innerpopup('id1','calendar_frame');" value="...&gt;"/>
&nbsp;
          <input name="submit" type="submit" value="REFRESH" id="Button">
                </div></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><a href="graphic_result.php"><b>��Ҿ��ػ������</b></a></td>
              </tr>
            </table>
          </form> </td>
        </tr>
        <tr valign="top">
          <td height="16" align="center" background="img_mian/bgcolor2.gif">|&nbsp;<?php echo"<a href=\"result_chlogin.php\">��͹��Ѻ</a>" ?>&nbsp;|</td>
          <td height="16" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
        </tr>
        <tr valign="top"> 
          <td height="16"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="16">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23"><div align="center"><br>
        <br>
      </div></td>
  </tr>
</table>
<?php 
}//ch online
CloseDB(); //close connect db ?>
</body>
</html>
