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
                    <td width="281">&nbsp;</td>
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
                              <tr class="text-intable">
                                <td><div align="left">&nbsp;�ӹǹ�����·��١�觵����Ѻ��ԡ�� � ʶҹ��ԡ������ OPD</div></td>
                                <td><div align="center">
                                    <?php //�ӹǹ�����·��١�觵����Ѻ��ԡ�� �  ʶҹ��ԡ������ OPD
								$sqlOvst1="select count(*) as cc_ovst from ovst where vstdate='$d_conv_search' and ovstost='54' "; 
								$resultOvst1=mysql_db_query($DBName,$sqlOvst1)
								or die("�������ö���͡���������ʴ���".mysql_error());
								$rsOvst1=mysql_fetch_array($resultOvst1);
								echo $rsOvst1["cc_ovst"]; 	//�ӹǹ�����·��١�觵����Ѻ��ԡ�� �  ʶҹ��ԡ������ OPD
							  ?>
                                </div></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr class="text-intable">
                                <td><div align="left">&nbsp;�ӹǹ�����·��١�觵����Ѻ��ԡ�� � ʶҹ��ԡ������ IPD</div></td>
                                <td><div align="center">
                                    <?php //�ӹǹ�����·��١�觵����Ѻ��ԡ�� � ʶҹ��ԡ������ IPD
								$sql_ipt3="select count(*) as cc_ipt3 from ipt where dchdate='$d_conv_search' and dchtype='04' "; 
								$result_ipt3=mysql_db_query($DBName,$sql_ipt3)
								or die("�������ö���͡���������ʴ���".mysql_error());
								$rs_ipt3=mysql_fetch_array($result_ipt3);
								echo $rs_ipt3["cc_ipt3"]; 	//�ӹǹ�����·��١�觵����Ѻ��ԡ�� �  ʶҹ��ԡ������ OPD
							  ?>
                                </div></td>
                                <td>&nbsp;</td>
                              </tr>
                            </table>
                            <br>
                            <table width="550" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                              <tr bgcolor="#FFFFFF" class="headtable">
                                <td width="45"  background="img_mian/bgcolor2.gif"><div align="center">�ӴѺ</div></td>
                                <td width="82"  background="img_mian/bgcolor2.gif"><div align="center">����Ἱ�</div></td>
                                <td width="231"  background="img_mian/bgcolor2.gif"><div align="center"> ����Ἱ� </div></td>
                                <td width="165" valign="baseline"  background="img_mian/bgcolor2.gif"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;�ӹǹ������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
                              </tr>
                              <!-- ���ҧ�� table2 -->
                              <?php
								$sqlDepart="select v.main_dep,k.department,count(v.vn) as cc1  from ovst  v "; 
								$sqlDepart.="left outer join kskdepartment k on k.depcode=v.main_dep ";
								$sqlDepart.="where v.vstdate='$d_conv_search' group by v.main_dep  , k.department ";
								$resultDepart=mysql_db_query($DBName,$sqlDepart)
								or die("�������ö���͡���������ʴ���".mysql_error());
								$num_rows_dp= mysql_num_rows($resultDepart);
								$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            	if ($num_rows_dp<>0){
								$i_1=0;
								while($i_1<$num_rows_dp){
								$rsDepart=mysql_fetch_array($resultDepart);
								?>
                              <tr class="text-intable">
                                <td><div align="center">&nbsp;<?php echo $i_1+1;?></div></td>
                                <td><div align="center">&nbsp;<?php echo $rsDepart["main_dep"];?></div></td>
                                <td><div align="left">&nbsp;<?php echo $rsDepart["department"];?></div></td>
                                <td><div align="left">&nbsp;<?php echo "$space".$rsDepart["cc1"];?></div></td>
                              </tr>
                              <?php
							$i_1++;}//while
							?>
                              <!-- ��������ҧ�� -->
                            </table>
                            <?php }//row  ebd table2?>
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
                    <td colspan="2">&nbsp;<b>��¡��ᾷ�����Ǩ �¶١�ѹ�֡��ҹ���˹�ҷ��</b></td>
                  </tr>
                  <tr>
                    <td colspan="2"><div align="center">
                            <table width="550" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                              <tr bgcolor="#FFFFFF" class="headtable">
                                <td width="46"  background="img_mian/bgcolor2.gif"><div align="center">�ӴѺ</div></td>
                                <td width="84" background="img_mian/bgcolor2.gif"><div align="center">����ᾷ��</div></td>
                                <td width="249"  background="img_mian/bgcolor2.gif"><div align="center"> ����ᾷ��</div></td>
                                <td width="161" align="center" valign="baseline" background="img_mian/bgcolor2.gif" ><div align="center">�ӹǹ������</div></td>
                              </tr>
                              <!-- ���ҧ�� table4 -->
                              <?php //��¡��ᾷ�����Ǩ �¶١�ѹ�֡��ҹ���˹�ҷ��
								$sqlDocter="select v.dx_doctor,k.name,count(v.vn) as cc_d  from vn_stat v "; 
								$sqlDocter.="left outer join doctor k on k.code=v.dx_doctor ";
								$sqlDocter.="where v.vstdate='$d_conv_search' group by v.dx_doctor ";
								$resultDocter=mysql_db_query($DBName,$sqlDocter)
								or die("�������ö���͡���������ʴ���".mysql_error());
								$num_rows_doct= mysql_num_rows($resultDocter);
								$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                  	            if ($num_rows_doct==0){
								echo "&nbsp;&nbsp;<font color=#005CA2>-�������¡��</font>";
								echo "<tr> 
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              </tr>";
								echo "</table>";}else{
								echo "<font color=#005CA2>- �բ�����	&nbsp;".$num_rows_doct."&nbsp;��¡��</font>";
								$i_3=0;
								while($i_3<$num_rows_doct){
								$rsDocter=mysql_fetch_array($resultDocter);
								?>
                              <tr class="text-intable">
                                <td height="20"><div align="center"><?php echo $i_3+1;?></div></td>
                                <td><div align="center">&nbsp;<?php echo $rsDocter["dx_doctor"];?></div></td>
                                <td><div align="left">&nbsp;
								<?php //echo $rsDocter["name"];
								if(ereg("���ᾷ��",$rsDocter["name"])){ // return true,false
								  echo str_replace("���ᾷ��","�.",$rsDocter["name"]); //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsDocter["name"])){ //false
  								  echo str_replace("ᾷ��˭ԧ","��.",$rsDocter["name"]); //᷹���� ᾷ��˭ԧ �� ��. 
								  }elseif(ereg("�ѹ�ᾷ��",$rsDocter["name"])){ // return true,false
								  echo str_replace("�ѹ�ᾷ��","��.",$rsDocter["name"]); //᷹���� �ѹ�ᾷ�� �� ��. 
								  }else{
								  echo change_misis($rsDocter["name"]); 
								  }
								?></div></td>
                                <td align="center">&nbsp;<?php echo "$space".$rsDocter["cc_d"];?></td>
                              </tr>
                              <?php
								$i_3++;}//while
							?>
                              <!-- ��������ҧ�� table4 -->
                          </table>
                            <br>
                            <?php }//row  ebd table4?>
                    </div></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;<b>��¡��ᾷ�����Ǩ�����к��ӧҹ��ԧ (����ѹ)</b></td>
                  </tr>
                  <tr>
                    <td colspan="2"><div align="center"><br>
                            <table width="550" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                              <tr bgcolor="#FFFFFF" class="headtable">
                                <td width="46"  background="img_mian/bgcolor2.gif"><div align="center">�ӴѺ</div></td>
                                <td width="84"  background="img_mian/bgcolor2.gif"><div align="center">����ᾷ��</div></td>
                                <td width="247"  background="img_mian/bgcolor2.gif"><div align="center"> ����ᾷ��</div></td>
                                <td width="163" align="center" valign="baseline" background="img_mian/bgcolor2.gif" ><div align="center">�ӹǹ������</div></td>
                              </tr>
							                               <!-- ���ҧ�� table4 -->
                              <?php //��¡��ᾷ�����Ǩ �¶١�ѹ�֡��ҹ���˹�ҷ��
								$sqlDocter2="select v.doctor,k.name,count(v.vn) as cc_d2 from pq_doctor  v "; 
								$sqlDocter2.="left outer join doctor k on k.code=v.doctor ";
								$sqlDocter2.="where v.doctor_date='$d_conv_search' group by v.doctor  , k.name";
								$resultDocter2=mysql_db_query($DBName,$sqlDocter2)
								or die("�������ö���͡���������ʴ���".mysql_error());
								$num_rows_doct2= mysql_num_rows($resultDocter2);//echo $num_rows_doct2;
								$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            	if ($num_rows_doct2==0){
								echo "&nbsp;&nbsp;<font color=#005CA2>-�������¡��</font>";
								echo "<tr> 
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>";
								echo "</table>";}else{
								echo "<font color=#005CA2>- �բ�����	&nbsp;".$num_rows_doct2."&nbsp;��¡��</font>";
								$i_4=0;
								while($i_4<$num_rows_doct2){
								$rsDocter2=mysql_fetch_array($resultDocter2);
								?>
                            <tr class="text-intable"> 
                              <td> <div align="center"><?php echo $i_4+1;?></div></td>
                              <td><div align="center"><?php echo $rsDocter2["doctor"];?></div></td>
                              <td> <div align="left">&nbsp;
							  <?php //echo $rsDocter2["name"];
								if(ereg("���ᾷ��",$rsDocter2["name"])){ // return true,false
								  echo str_replace("���ᾷ��","�.",$rsDocter2["name"]); //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsDocter2["name"])){ //false
  								  echo str_replace("ᾷ��˭ԧ","��.",$rsDocter2["name"]); //᷹���� ᾷ��˭ԧ �� ��. 
								  }elseif(ereg("�ѹ�ᾷ��",$rsDocter2["name"])){ // return true,false
								  echo str_replace("�ѹ�ᾷ��","��.",$rsDocter2["name"]); //᷹���� �ѹ�ᾷ�� �� ��. 
								  }else{
								  echo change_misis($rsDocter2["name"]); 
								  }
							  ?></div></td>
                              <td align="center"><div align="center"><?php echo $rsDocter2["cc_d2"];?></div></td>
                            </tr>
							  <?php $i_4++;} ?>
				          </table><br>					
				<?php }//row  ebd table4?>
					</div></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;<b>��¡��ᾷ�����Ǩ�����к��ӧҹ��ԧ ੾������� 8.30-16.30&nbsp; �.</b></td>
                  </tr>
                  <tr>
                    <td colspan="2"><div align="center"><br>
                            <table width="550" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                              <tr class="headtable">
                                <td width="46"  background="img_mian/bgcolor2.gif"><div align="center">�ӴѺ</div></td>
                                <td width="84"  background="img_mian/bgcolor2.gif"><div align="center">����ᾷ��</div></td>
                                <td width="247"  background="img_mian/bgcolor2.gif"><div align="center"> ����ᾷ��</div></td>
                                <td width="163" align="center" valign="baseline" background="img_mian/bgcolor2.gif" ><div align="center">�ӹǹ������</div></td>
                              </tr>
                              <!-- ���ҧ�� table4 -->
                              <?php //��¡��ᾷ�����Ǩ �¶١�ѹ�֡��ҹ���˹�ҷ��
								$sqlDocter3="select v.doctor,k.name,count(v.vn) as cc_d3 ,doctor_time from pq_doctor  v "; 
								$sqlDocter3.="left outer join doctor k on k.code=v.doctor ";
								$sqlDocter3.="where v.doctor_date='$d_conv_search'  and (HOUR(doctor_time) between '8' and '16')  group by v.doctor  , k.name";
								$resultDocter3=mysql_db_query($DBName,$sqlDocter3)
								or die("�������ö���͡���������ʴ���".mysql_error());
								$num_rows_doct3= mysql_num_rows($resultDocter3);//echo $num_rows_doct2;
								$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            	if ($num_rows_doct3==0){
								echo "&nbsp;&nbsp;<font color=#005CA2>-�������¡��</font>";
								echo "<tr> 
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>";
								echo "</table>";}else{
								echo "<font color=#005CA2>- �բ�����	&nbsp;".$num_rows_doct3."&nbsp;��¡��</font>";
								$i_4=0;
								while($i_4<$num_rows_doct3){
								$rsDocter3=mysql_fetch_array($resultDocter3);
								?>
                              <tr class="text-intable">
                                <td align="center"><?php echo $i_4+1;?></td>
                                <td align="center">&nbsp;<?php echo $rsDocter3["doctor"];?></td>
                                <td align="left">&nbsp;
								<?php //echo $rsDocter3["name"];
								if(ereg("���ᾷ��",$rsDocter3["name"])){ // return true,false
								  echo str_replace("���ᾷ��","�.",$rsDocter3["name"]); //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsDocter3["name"])){ //false
  								  echo str_replace("ᾷ��˭ԧ","��.",$rsDocter3["name"]); //᷹���� ᾷ��˭ԧ �� ��. 
								  }elseif(ereg("�ѹ�ᾷ��",$rsDocter3["name"])){ // return true,false
								  echo str_replace("�ѹ�ᾷ��","��.",$rsDocter3["name"]); //᷹���� �ѹ�ᾷ�� �� ��. 
								  }else{
								  echo change_misis($rsDocter3["name"]); 
								  }
								?></td>
                                <td align="center">&nbsp;<?php echo $rsDocter3["cc_d3"];?></td>
                              </tr>
                              <?php $i_4++;} ?>
                            </table>
                            <br>
                            <?php }//row  ebd table4?>
                    </div></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><br><div align="center">
                      <table width="536" border="1" cellpadding="0" cellspacing="0" class="bd-external">
                        <tr  class="headtable">
                          <td width="48" align="center" background="img_mian/bgcolor2.gif">�ӴѺ</td>
                          <td width="328" background="img_mian/bgcolor2.gif">����������</td>
                          <td width="69" align="center" valign="baseline" background="img_mian/bgcolor2.gif">��Ш��ѹ</td>
                          <td width="81" align="center" valign="baseline" background="img_mian/bgcolor2.gif">��Ш���͹</td>
                        </tr>
                        <tr class="text-intable">
                          <td align="center">1</td>
                          <td align="left">&nbsp; ��ػ�����ż�����Ѻ��ԡ�õ����</td>
                          <td align="center"><?php echo "<a href=\"chart.php?vstdate=$d_conv_search&grpid=1\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          <td align="center"><?php echo "<a href=\"chart.php?vstdate=$m_conv_search&grpid=1\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                        </tr>
                        <tr class="text-intable">
                          <td align="center">2</td>
                          <td align="left">&nbsp; ��ػ�����ż�����Ѻ��ԡ�õ�����������</td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=2\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=2\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                        </tr>
                        <tr class="text-intable">
                          <td align="center">3</td>
                          <td align="left">&nbsp; ��ػ�����ż�����Ѻ��ԡ�õ���Է�ԡ���ѡ��</td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=3\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=3\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                        </tr>
                        <tr class="text-intable">
                          <td align="center">4</td>
                          <td align="left"> &nbsp;&nbsp;��ػ�����Ũӹǹ�����µ��Ἱ�</td>
                          <td align="center"><?php echo "<a href=\"chart.php?vstdate=$d_conv_search&grpid=4\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          <td align="center"><?php echo "<a href=\"chart.php?vstdate=$m_conv_search&grpid=4\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                        </tr>
                        <tr class="text-intable">
                          <td align="center">5</td>
                          <td align="left">&nbsp; ��ػ�����ż�����Ѻ��ԡ�õ���š���ԹԨ���</td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=5\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=5\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                        </tr>
                        <tr class="text-intable">
                          <td align="center">6</td>
                          <td align="left">&nbsp; ��ػ�����ż�����Ѻ��ԡ�õ��������� �¡����Ӻ� </td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=6\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=6\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                        </tr>
                        <tr class="text-intable">
                          <td align="center">7</td>
                          <td align="left"> &nbsp;&nbsp;��ػ�����ż�����Ѻ��ԡ�õ��������� �¡��������</td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=7\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=7\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                        </tr>
                        <tr class="text-intable">
                          <td align="center">8</td>
                          <td align="left">&nbsp;&nbsp;��ػ�����ż�����Ѻ��ԡ�õ��������� �¡����ѧ��Ѵ</td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=8\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=8\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                        </tr>
                        <tr class="text-intable">
                          <td align="center">9</td>
                          <td align="left">&nbsp; ��ػ�����ż�����Ѻ��ԡ�õ����ǧ���ҷ����</td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=9\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=9\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                        </tr>
                        <tr class="text-intable">
                          <td align="center">10</td>
                          <td align="left">&nbsp;&nbsp;��ػ�����ż���Ѻ��ԡ�õ��ᾷ�����Ǩ</td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=10\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=10\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                        </tr>
                        <tr class="text-intable">
                          <td align="center">11</td>
                          <td align="left">&nbsp; ��ػ�����Ť��������¡���������</td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=11\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=11\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                        </tr>
                        <tr class="text-intable">
                          <td align="center">12</td>
                          <td align="left">&nbsp; ��ػ�����ż�����������ѧ�ҧ�кҴ�Է��</td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$d_conv_search&grpid=12\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                          <td align="center"><?php echo  "<a href=\"chart.php?vstdate=$m_conv_search&grpid=12\"><img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?></td>
                        </tr>
                        <!-- ��������ҧ�� table5 -->
                      </table>
                      <br><br>
                    </div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td align="right"><div align="left">&nbsp;<a name="below"></a></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td align="right"><?php echo "<img src=\"img_mian/ghaph_true.gif\" width=\"25\" height=\"17\" align=\"absmiddle\" border=0></a>"; ?> <span class="style1">*��ҿ�ʴ�������&nbsp;</span>&nbsp;&nbsp;</td>
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
