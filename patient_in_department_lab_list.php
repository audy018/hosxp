<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();

if (!$_SESSION["ip_Log"]){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line

if ($_GET['id1']<>""){
  $id1=$_GET['id1'];}else{
 $id1=date("d-m-Y");
 }
 //�ӹǹ��������ѹ������͡
$d_conv=explode("-",$id1);$d=$d_conv[0];$m=$d_conv[1];$y=$d_conv[2];
$d_conv_search="$y-$m-$d";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - �к��Թ����� | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - ��ª��ͼ����·���Ѻ��ԡ�÷����ͧ LAB - - |</title>
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

	<script language="javascript" src="Script/codethatcalendarstd.js"></script>
	<script language="javascript" src="Samples/iframe_ex.js"></script>
	<script language="javascript">
		var c1 = new CodeThatCalendar(caldef1);
</script>
</head>
<body>
<?php
$key_word=$_GET['keyword'];
?>
<div id="Layer1" style="position:absolute; left:674px; top:190px; width:187px; height:171px; z-index:1">
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
<table width="800" border="0" cellspacing="0" cellpadding="0" id="table">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr> 
          <td colspan="2" valign="top">
<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
		  </td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp;<font color="#FFFFFF">| <a href="result_chlogin.php">˹����ѡ</a> | <a href="patient_search.php">���Ҽ�����</a> | <a href="javascript:window.print()">�����</a> | <a href="#closeform">�Դ˹�ҵ�ҧ</a>| <a href="index.php">�͡�ҡ�к�</a> | <a onClick="mini()">���˹�Ҩ�</a> | <a href="javascript:history.back(-1)">��͹��Ѻ</a> | </font>
            <Object id=miniobj type="application/x-oleobject" classid="clsid:adb880a6-d8ff-11cf-9377-00aa003b7a11" codebase="hhctrl.ocx#Version=4,72,8252,0">
              <param name="Command" value="minimize">
            </Object></td>
          <td width="160" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; 
          </td>
        </tr>
        <tr> 
          <td width="643" height="182" align="center" valign="top" class="td-left"><br> 
            <table width="620" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
            <tr align="center" bgcolor="#99CCFF">
              <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu">��ª��ͼ����·���Ѻ��ԡ�÷����ͧ LAB</td>
            </tr>
            <tr>
              <td width="339" valign="top"><!--<form method="get" action="<?php //echo $PHP_SELF; ?>">
                            &nbsp;&nbsp;���͡�ѹ��� .. 
                            <input name="id1" type="text" value="<?php //echo $id1; ?>" size="15"/>
                            <input type="button" onClick="c1.innerpopup('id1','calendar_frame');" value="..."/>
                            <input type="submit" value="Refresh">
                          </form>
						  -->
              </td>
              <td width="281"><a name="top"></a> </td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;
                  <?php 
							echo "<center><b>������ � �ѹ���</b>&nbsp;<font color=red><u>".dateThai($d_conv_search)."</u></font></center>";
						?>
              </td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;
                  <?php 
						//�Ӣ��������ʴ�㹵��ҧ
											$sqlLablist="select e.*,v.hn,v.vsttime,concat(p.pname,p.fname,'  ',p.lname) as pt_name,d.name as staff_name ";
											$sqlLablist.="from lab_head  e ";
											$sqlLablist.="left outer join ovst v on v.vn=e.vn ";
											$sqlLablist.=" left outer join patient p on p.hn=v.hn ";
											$sqlLablist.="left outer join  doctor d on d.code= e.doctor_code ";
											$sqlLablist.="where e.order_date='$d_conv_search'  order by e.order_time ";
											$resultLablist=mysql_db_query($DBName,$sqlLablist)
											or die("�������ö���͡���������ʴ���".mysql_error());
											$num_rows_Lablist = mysql_num_rows($resultLablist);
											echo "<center>";
										if ($num_rows_Lablist<>0){
											echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ӹǹ�������ԡ�÷����� : <font color=red><b>".$num_rows_Lablist."</b></font>&nbsp;����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
											if ($num_rows_Lablist>20){ //�١������͹ŧ
											echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
											echo "<a href=#below><img src=\"img_mian/arow_bl.gif\" width=13 height=9 border=0></a>&nbsp;��ҹ��ҧ";
											}//�١��
											echo "</center>";
										//$row="y";
										$bg="#B1C3D9";
										?>
                  <table width="580" border="0" align="center" cellpadding="0" cellspacing="0">
                    <!-- ���ҧ��ͺ���ҧ -->
                    <tr bgcolor="#3399CC" class="headtable">
                      <td width="12" height="16" bgcolor="#3399CC"><div align="left"><img src="img_mian/c_t_left.gif" width="8" height="16"></div></td>
                      <td width="40" background="img_mian/bgcolor2.gif" bgcolor="#3399CC"><div align="center">�ӴѺ</div></td>
                      <td width="50" background="img_mian/bgcolor2.gif"><div align="center">HN</div></td>
                      <td width="162" background="img_mian/bgcolor2.gif"><div align="left">&nbsp;&nbsp;���ͼ�����</div></td>
                      <td width="110" background="img_mian/bgcolor2.gif"><div align="left">&nbsp;&nbsp;��������</div></td>
                      <td width="146" background="img_mian/bgcolor2.gif"><div align="left">&nbsp;&nbsp;ᾷ�������</div></td>
                      <td width="52" background="img_mian/bgcolor2.gif"><div align="center">�׹�ѹ��</div></td>
                      <td width="9"><div align="right"><img src="img_mian/c_t_r.gif" width="8" height="16"></div></td>
                    </tr>
                    <tr>
                      <td height="16" colspan="8" align="center"><!-- ���ҧ���ҧ��ͺ� �����ʴ������� -->
                          <table width="580" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                            <?php
					$i=0;
			 		while($i<$num_rows_Lablist){
					$rsLablist=mysql_fetch_array($resultLablist); 
					$lab_hn=$rsLablist["hn"];//echo $er_hn;
					if ($bg=="#B1C3D9") { //color
					$bg="#FFFFFF";
					//$bgm="";
					}else{
					$bg="#B1C3D9";
					//$bgm="img_mian/bgcolor.gif";
					} //color
					?>
                            <tr bgcolor="<?php echo $bg; ?>" class="text-intable">
                              <td width="50" align="center" ><?php echo $i+1; ?></td>
                              <td width="51" align="center" >&nbsp;<?php echo $lab_hn;?></td>
                              <td width="161" align="left" bgcolor="<?php echo $bg; ?>">&nbsp;<?php echo "<a href=\"patient_medication_record.php?hn=$lab_hn\">".$rsLablist["pt_name"]."</a>"; ?></td>
                              <td width="111" align="left" ><?php echo $rsLablist["form_name"]; ?></td>
                              <td width="146" align="left" >&nbsp;
							  <?php //echo $rsLablist["staff_name"]; 
								  if(ereg("���ᾷ��",$rsLablist["staff_name"])){ // return true,false
								  echo str_replace("���ᾷ��","�.",$rsLablist["staff_name"]); //᷹���� ���ᾷ�� �� �. 
								  }elseif(ereg("ᾷ��˭ԧ",$rsLablist["staff_name"])){ //false
  								  echo str_replace("ᾷ��˭ԧ","��.",$rsLablist["staff_name"]); //᷹���� ᾷ��˭ԧ �� ��. 
								  }else{
								  echo change_misis($rsLablist["staff_name"]); 
								  }							  ?></td>
                              <td width="61" align="center" ><?php echo $rsLablist["confirm_report"]; ?></td>
                            </tr>
                            <?php
	        	$i++;//$a++;
		    	}//while  ?>
                          </table>
                          <!-- end table show data -->
                      </td>
                    </tr>
                    <tr>
                      <td valign="bottom" bgcolor="#3399CC"><div align="left"><img src="img_mian/c_l_left.gif" width="8" height="16"></div></td>
                      <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                      <td background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                      <td colspan="4" background="img_mian/bgcolor2.gif" bgcolor="#3399CC">&nbsp;</td>
                      <td valign="bottom" bgcolor="#3399CC"><div align="right"><img src="img_mian/c_l_r.gif" width="8" height="16"></div></td>
                    </tr>
                  </table>
                  <!-- end ���ҧ��ͺ���ҧ -->
                  <?php
						  			if ($num_rows_Lablist<10){ echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";}
			}else{  //row=0
			$row="n";
			echo"<center>�š�ä��� : ����բ����Ţͧ�ѹ���&nbsp;<font color=red><u>".dateThai($d_conv_search)."</u></font>&nbsp;㹰ҹ������<center>";
			echo "<br><br><br><br><br><br><br><br><br><br>";
		}//row=0
		?>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><a name="below"></a>
                  <?php
					  						if ($num_rows_Lablist>20){ //�١������͹ŧ
											echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
											echo "<a href=#top><img src=\"img_mian/arow_t.gif\" width=13 height=9 border=0></a>&nbsp;��ҹ��";
											}//�١��
					  ?>
              </td>
            </tr>
          </table>
          </td>
          <td width="160" align="center" valign="top" class="td-right"> 
            <!-- form -->
            <form method="get" action="<?php echo $PHP_SELF; ?>">
              <table width="155" border="0" cellpadding="0" cellspacing="2" class="bd-internal">
                <tr> 
                  <td background="img_mian/bgcolor2.gif" class="headmenu"><div align="center"> 
                      :: ���͡�ѹ��� ::</div></td>
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
            </form>
            <!-- end form -->
          </td>
        </tr>
        <tr>
          <td height="16" align="center" background="img_mian/bgcolor2.gif" bgcolor="#B1C3D9">|&nbsp;<?php echo"<a href=\"result_chlogin.php\">��¡����ѡ</a>" ?>&nbsp;|</td>
          <td height="16" valign="top" class="td-right">&nbsp;</td>
        </tr>
        <tr> 
          <td height="16" valign="top"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="16" valign="top">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23"><div align="center"><br>
        <br>
      </div></td>
  </tr>
</table>
<?php }//ch online
CloseDB(); //close connect db ?>
</body>
</html>
