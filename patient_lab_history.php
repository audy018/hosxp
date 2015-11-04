<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - สรุปรายการผล LAB และรายงานผลแล้ว - - |</title>
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
//Flash and html call this function to minimize window
function mini() {
miniobj.Click();
}
</script>
<script language="JavaScript">
<!--
<!-- hide on

function popup(popupfile,winheight,winwidth)
{
open(popupfile,"PopupWindow","resizable=no,height=" + winheight + ",width=" + winwidth + ",scrollbars=no");
}

// hide off -->

//-->
</script>
<script language="javaScript">
function Linkup()
{
var number = document.DD.DDM.selectedIndex;
location.href = document.DD.DDM.options[number].value;
}
</script>
</head>

<body>
<?php
if (!$_SESSION["ip_Log"] and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";
}else{ //on line
if  (($_SESSION["user_type"]=="online")  AND !Check_Onlines()){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=index.php'>";}
$key_word=$_GET['keyword'];
$vn=$_GET['vn'];
$hn=$_GET['hn'];
if ($hn==""){
    $sql_hn="select hn from an_stat where vn='$vn' ";
	$result_hn=mysql_db_query($DBName,$sql_hn)
	or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
	$rs_hn=mysql_fetch_array($result_hn);
	$hn=$rs_hn["hn"];
} //end hn
	//an
	 $sql_an="select an from ipt where vn='$vn' ";
	$result_an=mysql_db_query($DBName,$sql_an)
	or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
	$rs_an=mysql_fetch_array($result_an);
	$an=$rs_an["an"]; //end an
$get_Name_Addr=Serch_datafrom_hn($hn);
$pmr=explode("|",$get_Name_Addr); //แยกค่าตัวแปรที่รับมาจาก fuc ด้วย |
$p_name=$pmr[0]; // p[1] ชื่อ
$p_addr=$pmr[1]; // p[2] ที่อยู่ 
$get_Age=Age_hn($hn,$vn); //อายุ
$Card_No=Card_No($hn); //หมายเลขบัตรประชาชน
?>
<a name="top"></a>
<table width="800" border="0" cellspacing="0" cellpadding="0" id="table">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr valign="top"> 
          <td colspan="2">
		  <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
		  </td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif"><?php include("manu.inc"); ?></td>
          <td width="148" align="left" valign="bottom" background="img_mian/bgcolor.gif" bgcolor="#3399CC">&nbsp; 
          </td>
        </tr>
        <tr> 
          <td width="650" height="610" valign="top" class="td-left"><div align="center"><br>
              <table width="620" border="0" cellspacing="0" cellpadding="0"  class="bd-external">
                <tr> 
                  <td width="620" valign="top"><table width="620" border="0" cellpadding="0" cellspacing="0">
                      <tr bgcolor="#99CCFF"> 
                        <td height="24" colspan="2" class="headmenu" background="img_mian/bgcolor2.gif" align="center">&nbsp;<b>สรุปรายการ 
                            Lab และรายงานผลแล้ว</b></td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="center"><br><h3>HN : <font color="red"><u><?php echo $hn; ?></u></font> 
                            ชื่อ-สกุล :&nbsp;<font color="#0066FF"><?php echo $p_name; ?></font>&nbsp;อายุ 
                            :&nbsp;<font color="#0066FF"><?php echo $get_Age ?></font></h3></td>
                      </tr>
                      <tr> 
                        <td colspan="2"><hr></td>
                      </tr>
                      <tr valign="top"> 
                        <td colspan="2" align="left" valign="top"> 
                          <!-- start สรุปรายการ LAB ที่เคยสั่่งไว้และรายงานผล -->
                          <?php 
							$sqlLab_all="select i.lab_items_name,count(i.lab_items_code) as cc ";
							$sqlLab_all.="from lab_order l,lab_head h,lab_items i ";
							$sqlLab_all.="where l.lab_order_number = h.lab_order_number and h.hn='$hn' and l.lab_items_code=i.lab_items_code ";
							$sqlLab_all.="and l.lab_order_result is not null and l.lab_order_result<>'' group by i.lab_items_name ";
							$result_lab_all=mysql_db_query($DBName,$sqlLab_all)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$num_rows_lab_all = mysql_num_rows($result_lab_all);
									if($num_rows_lab_all==0){ //row1
										echo "&nbsp;&nbsp;<font color=#0066FF>-&nbsp;ไม่มีข้อมูลการส่งตรวจทางห้องปฏิบัติการ</font>";
									}else{ //n row
									echo "&nbsp;&nbsp;<b>สรุปรายการ LAB ที่เคยสั่งไว้และรายงานผลแล้วทั้งหมด</b><br><br>";
									 ?>
                          <!-- ตารางนอก -->
                          <center>
                            <table width="550" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
                              <tr> 
                                <td> 
                                  <!-- ตารางใน -->
                                  <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr bgcolor="#3399CC" class="headtable"> 
                                      <td width="48" background="img_mian/bgcolor2.gif"><div align="center">ลำดับ</div></td>
                                      <td width="406" background="img_mian/bgcolor2.gif"><div align="left">&nbsp;รายการ 
                                          LAB </div></td>
                                      <td width="102" background="img_mian/bgcolor2.gif"><div align="center">จำนวน</div></td>
                                    </tr>
								    <?php 
									$i=0;
									while($i<$num_rows_lab_all){ //while1
									$rs_lab_all=mysql_fetch_array($result_lab_all);
							 	?>
                                    <tr class="text-intable"> 
                                      <td width="48" align="center"><?php echo ($i+1); ?></td>
                                      <td width="406" align="left">&nbsp;<?php echo $rs_lab_all["lab_items_name"];  ?></td>
                                      <td width="102" align="center"><?php echo $rs_lab_all["cc"]; ?></td>
                                    </tr>
                                    <?php
											$i++;
										}//while1
									?>
                                  </table>
                                  <!-- ปิดตารางใน -->
                                </td>
                              </tr>
                            </table>
                          </center>
                          <!-- ปิดตารางนอก -->
                          <?php 
							} //end row1
							?>
                          <!-- end สรุปรายการ LAB ที่เคยสั่่งไว้และรายงานผล -->
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="left">
                          <!-- start รายการส่งตรวจทางห้องปฏิบัติการทั้งหมด -->
                          <?php 
							echo "<br>&nbsp;&nbsp;<b>สรุปรายการส่งตรวจทางห้องปฏิบัติการทั้งหมด</b><br><br>";
							$lab_order_list="";
							$sqlLab1="select * from lab_head where vn='$vn' order by order_date desc,report_date desc ";
							$result_lab1=mysql_db_query($DBName,$sqlLab1)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$rs_lab1=mysql_fetch_array($result_lab1);
							$num_rows_lab1 = mysql_num_rows($result_lab1);
									if($num_rows_lab1==0){ //row1
										echo "<font color=#0066FF>&nbsp;- ไม่มีข้อมูลการส่งตรวจทางห้องปฏิบัติการ<br></font>";
									}else{ //n row
									$i=0;
									while($i<$num_rows_lab1){ //while1
									$rs_lab1=mysql_fetch_array($result_lab1);
											if ($lab_order_list==""){
											$lab_order_list=$rs_lab1["lab_order_number"];}else{
							  				$lab_order_list=$lab_order_list.",".$rs_lab1["lab_order_number"]; } //end $lab_order_list
										$i++;
									 }	//while1
										if ($lab_order_list==""){ $lab_order_list="0"; }
																$sqlLab2="select l.*,i.lab_items_name,i.lab_items_unit,i.lab_items_normal_value ";
																$sqlLab2.="from lab_order l ";
																$sqlLab2.="left outer join lab_items i on i.lab_items_code=l.lab_items_code ";
																$sqlLab2.="where l.lab_order_number in  (\"$lab_order_list\") and l.lab_order_result <> \"\" ";
																$sqlLab2.="order by i.display_order,i.lab_items_name "; 
																	$result_lab2=mysql_db_query($DBName,$sqlLab2)
																	or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
																	$rs_lab2=mysql_fetch_array($result_lab2);
																	$num_rows_lab2=mysql_num_rows($result_lab2);
																		if($num_rows_lab2==0){ //a
																		echo "&nbsp;&nbsp;><font color=#0066FF>- ไม่มีรายการ</font>";}else{
																		 //row2 ?>
                          <!-- ตารางนอก -->
                          <center>
                            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
                              <tr> 
                                <td> 
                                  <!-- ตารางใน -->
                                  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr class="headtable"> 
                                      <td width="46" background="img_mian/bgcolor2.gif" align="center">ลำดับ</td>
                                      <td width="187" background="img_mian/bgcolor2.gif" align="left">&nbsp;&nbsp;ชื่อการส่งตรวจ</td>
                                      <td width="151" background="img_mian/bgcolor2.gif" align="left">&nbsp;&nbsp;ผล</td>
                                      <td width="96" background="img_mian/bgcolor2.gif" align="left">&nbsp;&nbsp;ค่าปกติ</td>
                                      <td width="120" background="img_mian/bgcolor2.gif" align="center">ผู้รายงาน</td>
                                    </tr>
                                    <?php
																				$i2=0;
																				while($i2<$num_rows_lab2){  //while2
																				$rs_lab2=mysql_fetch_array($result_lab2);
																				?>
                                    <tr class="text-intable"> 
                                      <td width="46" align="center"><?php echo ($i2+1); ?></td>
                                      <td width="187" align="left">&nbsp;<?php echo $rs_lab2["lab_items_name"]; ?></td>
                                      <td width="151" align="left"> &nbsp;
                                          <?php
																				  if ($rs_lab2["confirm"]=="Y"){
																				 echo $rs_lab2["lab_order_result"]." ".$rs_lab2["lab_items_unit"];}else{
																				 echo "- ยังไม่รายงาน";
																				 }
																				 ?>
                                      </td>
                                      <td width="96" align="left">&nbsp;<?php echo $rs_lab2["lab_items_normal_value"]; ?></td>
                                      <td width="120" align="center"> 
                                          <?php 
																				if (!$rs_lab2["staff"]==NULL){
																				echo $rs_lab2["staff"]; }else{echo "-";}
																				?>
                                      </td>
                                    </tr>
                                    <?php
																				$i2++;
																			}//while2
																			?>
                                  </table>
                                  <!-- ปิดตารางใน -->
                                </td>
                              </tr>
                            </table>
                          </center>
                          <!-- ปิดตารางนอก -->
                          <?php }
							} //end row1
							?>
                          <!-- end ส่งตรวจทางห้องปฏิบัิติการ -->						
						</td>
                      </tr>
                      <tr> 
                        <td width="451">&nbsp;</td>
                        <td width="167"><a name="below"></a></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                        <td><div align="right">&nbsp;&nbsp;<a href="#top"><img src="img_mian/arow_t.gif" width="13" height="9" border="0"></a>&nbsp;ด้านบน&nbsp;</div></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <p>&nbsp;</p>
            </div></td>
          <td width="148" align="center" valign="top" class="td-right">
            <?php 
						 $sqlPic="select count(*) as cc from patient_image where hn='$hn' ";
						 $result=mysql_db_query($DBName,$sqlPic)
				         or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
						$rs=mysql_fetch_array($result);
						if($rs["cc"]>0){
						
						echo "<br><center><b>HN : <font color=gold>".$hn."</font></b><br><a title=คลิ๊กเพื่อดูรูปขยาย href=javascript:popup(\"get_patient_image.php?hn=$hn\",260,340)><img src=\"get_patient_image.php?hn=$hn\"  width=\"120\" height=\"105\" vlign=\"middle\" border=\"1\"></a></center>";
						 } 
			?>
          </td>
        </tr>
        <tr valign="top"> 
          <td height="16" background="img_mian/bgcolor2.gif"><div align="center"> <font color=white>| 
              <a href="patient_search.php">ค้นหาใหม่</a>&nbsp;|&nbsp;<a href="javascript:history.back(-1)">ย้อนกลับ</a>&nbsp;|</font> 
          </div></td>
          <td height="16" background="img_mian/bgcolor2.gif"><div align="right"></div></td>
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
<?php }//online
CloseDB(); //close connect db ?>
</body>
</html>
