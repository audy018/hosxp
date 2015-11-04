<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>ระบบอินทราเน็ต | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?>  | - - ข้อมูลการรักษาผู้ป่วย - - |</title>
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
$aright=array("ADMIN","DOCTOR","SCREEN","View_EMR");
  if(check_right($_SESSION["right"],$aright)==0){echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;  URL=pttype_service.php?pt_search=$hn'>";}
	
if ($vn=="" and $year_come==""){
$sqlVn="select  an, vn, regdate from ipt where hn='$hn'  order by vn  desc limit 1 ";
			$result = mysql_db_query($DBName,$sqlVn)
			or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
			$rs=mysql_fetch_array($result);
			$vn=$rs["vn"];
			$an=$rs["an"];
			$datevst=$rs["regdate"];
}elseif($vn=="" and $year_come<>""){ 
$sqlVn="select  an,vn, regdate from ipt where hn='$hn' and regdate between '$year_come-01-01' and '$year_come-12-31' order by vn  desc limit 1 ";
			$result = mysql_db_query($DBName,$sqlVn)
			or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
			$rs=mysql_fetch_array($result);
			$an=$rs["an"];
			$vn=$rs["vn"];
			$datevst=$rs["regdate"];
}else{ 
$sqlVn="select  an,regdate from ipt where vn='$vn' ";
			$result = mysql_db_query($DBName,$sqlVn)
			or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
			$rs=mysql_fetch_array($result);
			$datevst=$rs["regdate"];
			$an=$rs["an"];
			}
			
$get_Name_Addr=Serch_datafrom_hn($hn);
$pmr=explode("|",$get_Name_Addr); //แยกค่าตัวแปรที่รับมาจาก fuc ด้วย |
$p_name=$pmr[0]; // p[1] ชื่อ
$p_addr=$pmr[1]; // p[2] ที่อยู่ 
$get_Age=Age_hn($hn,$vn); //อายุ
$Card_No=Card_No($hn); //หมายเลขบัตรประชาชน
$get_pt_type=Pt_Type($vn); //สิทธิและเลขที่
$pttype=explode("|",$get_pt_type); //แยกค่าตัวแปรที่รับมาจาก func ด้วย |
$pt_no=$pttype[0]; // p[1] สิทธิ
$pt_type=$pttype[1]; // p[2] เลขที่
?>
<a name="top"></a>
<table width="800" border="0" cellspacing="0" cellpadding="0" id="table">
  <tr>
    <td width="927"><table width="799" cellpadding="0" cellspacing="0">
        <tr valign="top"> 
          <td colspan="2">
		  <?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
			<?php //include("header.inc"); ?>		  
		  </td>
        </tr>
        <tr> 
          <td height="24" valign="middle" background="img_mian/bgcolor.gif"><?php include("manu.inc"); ?> </td>
          <td width="163" align="left" valign="bottom" background="img_mian/bgcolor.gif">&nbsp; 
          </td>
        </tr>
        <tr> 
          <td width="634" height="610" valign="top" class="td-left2"><div align="center"><br>
              <table width="627" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="627" valign="top"><table width="620" border="0" cellpadding="0" cellspacing="0" class="bd-external">
                      <tr  bgcolor="#99CCFF"> 
                        <td height="24" colspan="2" class="headmenu" align="center" background="img_mian/bgcolor2.gif"><b>Patient 
                            Discharge Summery (ข้อมูลการรักษาผู้ป่วยใน) <?php echo "&nbsp;".$Hospname."&nbsp;"; ?></b></td>
                      </tr>
                      <tr> 
                        <td width="455" align="left"><br>&nbsp;HN : <font color="red"><u><?php echo $hn; ?></u></font> 
                          ชื่อ-สกุล :&nbsp;<font color="#0066FF"><?php echo $p_name; ?></font>&nbsp;อายุ ณ การมาครั้งนี้
                          :&nbsp;<font color="#0066FF"><?php echo $get_Age ?></font>&nbsp;<br> 
                          &nbsp; ที่อยู่ :<font color="#0066FF"><?php echo $p_addr; ?></font><br> 
                          &nbsp;CID : <font color="#0066FF"><?php echo $Card_No; ?></font> 
                          สิทธิการรักษา :&nbsp;<font color="#0066FF"><?php echo $pt_no; ?></font><br> 
                          &nbsp;เลขที่ :&nbsp;<font color="#0066FF"><?php echo $pt_type ?></font></td>
                        <td width="172" align="center" valign="bottom"><div align="right">&nbsp;&nbsp;<a href="#below"><img src="img_mian/arow_bl.gif" width="13" height="9" border="0"></a>&nbsp;ด้านล่าง&nbsp;<br>
                            <br>
                          </div></td>
                      </tr>
                      <tr> 
                        <td colspan="2"><hr></td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="left"> 
                          <!-- start admid -->
                          <?php
						   	$sqlOv="select count(*) as cc from clinicmember where hn='$hn' ";          //check special                    
                            $resultOv=mysql_db_query($DBName,$sqlOv)
				           	or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
							$rsOv=mysql_fetch_array($resultOv);
							if ($rsOv["cc"]>0){ //cc
											$sqlClin="select n.name from clinicmember c ,clinic n where c.hn='$hn' and c.clinic=n.clinic ";                              
                           					$resultClin=mysql_db_query($DBName,$sqlClin)
				           					or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
											$rsClin=mysql_fetch_array($resultClin);echo $rsClin["name"];
											$special_clinic=$rsClin["name"];
											     if ($special_clinic<>""){
											         echo "<br>เป็นผู้ป่วยในคลินิกพิเศษ <font color=blue>$special_clinic</font>";
												} //special_clinic<>""
								} //$rsOv
													//start admit
													$sql_ipt="select count(*) as cc_ipt from ipt where vn='$vn' ";                              
                           							$result_ipt=mysql_db_query($DBName,$sql_ipt)
				           							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
													$rs_ipt=mysql_fetch_array($result_ipt);
													if ($rs_ipt["cc_ipt"]>0){ //cc_ipt
														$sql_ipt_w="select i.*,d.bedno, r.name as room_name, w.name as ward_name ,d1.name as admdoctor_name,s.name as spclty_name ";
														$sql_ipt_w.="from ipt i,ward w,iptadm d,doctor d1,bedno b,roomno r,spclty s ";
														$sql_ipt_w.="where i.vn='$vn' and i.ward=w.ward and i.an=d.an and i.spclty=s.spclty and d.bedno=b.bedno and r.roomno=b.roomno and i.admdoctor=d1.code ";                              
	                           							$result_ipt_w=mysql_db_query($DBName,$sql_ipt_w)
					           							or die("ไม่สามารถเลือกข้อมูลมาแสได้".mysql_error());
														$n_rows_ipt_w=mysql_num_rows($result_ipt_w);
														$rs_ipt_w=mysql_fetch_array($result_ipt_w);

														echo"&nbsp;<b><font color=black>Admission Number :</font><font color=red>".$rs_ipt_w["an"]."</font></b><br>";
														echo"&nbsp;<font color=blue >รับ Admit  วันที่ ".FormatDate($rs_ipt_w["regdate"])."&nbsp;เวลา ".$rs_ipt_w["regtime"]." น.</font>";
														echo"&nbsp;<br><font color=green>&nbsp;ผู้ป่วย Admit ที่ <b><font color=blue>".$rs_ipt_w["ward_name"]." ";
														echo $rs_ipt_w["room_name"]." แผนก ".$rs_ipt_w["spclty_name"]."</b></font>";
														echo"<br>&nbsp;ด้วยอาการสำคัญ <font color=blue>".$rs_ipt_w["prediag"]."</font>";
														echo"<br>&nbsp;แพทย์ผู้สั่ง <font color=blue>".$rs_ipt_w["admdoctor_name"]."</font></font>";
													} //rs_optt[cc_opt]>0
													//final diag
													
													$sql_pdxcode="select pdx from an_stat where vn='$vn'";                              
                           													$result_pdxcode=mysql_db_query($DBName,$sql_pdxcode)
																			or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
																			$rs_pdxcode=mysql_fetch_array($result_pdxcode); 
																			$pdx_code=$rs_pdxcode["pdx"];
													$sql_pdx="select  name from icd101 where code='$pdx_code' ";                              
                           													$result_pdx=mysql_db_query($DBName,$sql_pdx)
																			or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
																			$rs_pdx=mysql_fetch_array($result_pdx); 
																			$pdx_name=$rs_pdx["name"];
													
													$sql_ipt_n="select  i.*,d.name as dname,dt.name as dtname,concat(h.hosptype,h.name) as hospname  from ipt i left outer  join dchstts d on i.dchstts=d.dchstts  left outer  join dchtype dt on i.dchtype=dt.dchtype  left outer join hospcode h on  h.hospcode=i.rfrolct  where i.vn='$vn'  and i.dchdate is not null";                              
                           							$result_ipt_n=mysql_db_query($DBName,$sql_ipt_n)
				           							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
													$rs_ipt_n=mysql_fetch_array($result_ipt_n);
													$num_rows_ipt=mysql_num_rows($result_ipt_n);
													if($num_rows_ipt>0){
													echo "<br><font color=blue>&nbsp;<font color=red><b>สถานะ</b></font> ".$rs_ipt_n["dname"]." <font color=red><b>ประเภทการจำหน่าย </b></font>".$rs_ipt_n["dtname"]." ".$rs_ipt_n["hospname"]."</font>";
				                                  		echo "<p><font color=red><b>&nbsp;ผู้ป่วยถูกจำหน่ายแล้ว&nbsp;:</b></font>";
													    echo "<br>&nbsp;<font color=green>วันที่จำหน่าย : <font color=blue>".FormatDate($rs_ipt_w["dchdate"])." เวลา ".$rs_ipt_w["dchtime"]." น.";
														//ผู้hั่งจำหน่าย
																 $sqlDc_dch="select dch_doctor from ipt where vn='$vn' ";
               													$result_dch=mysql_db_query($DBName,$sqlDc_dch)
																or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
																$rs_dch=mysql_fetch_array($result_dch); 
																$dch_doctor=$rs_dch["dch_doctor"];
																
																$sqlDc_com="select name from doctor where code ='$dch_doctor' ";
               													$result_dcom=mysql_db_query($DBName,$sqlDc_com)
																or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
																$rs_dcom=mysql_fetch_array($result_dcom); 
																echo"&nbsp;&nbsp;<font color=green>ผู้สั่งจำหน่าย : </font><font color=blue>".$rs_dcom["name"]."</font>";
														
																		echo "<br>&nbsp;<u>วินิจฉัยสุดท้าย(Finally Diagnosis)</u><br>";
																		echo "&nbsp;<font color=red>Pdx. </font><font color=blue>".$pdx_code." </font><font color=green>".$pdx_name."</font>";
																			$sql_dx="select dx0,dx1,dx2,dx3,dx4,dx5 from an_stat where vn='$vn'  ";                              
                           													$result_dx=mysql_db_query($DBName,$sql_dx);
																			if ($result_dx){
																			$rs_dx=mysql_fetch_array($result_dx); 
																			$code_dxall="'".$rs_dx["dx0"]."' ,'".$rs_dx["dx1"]."' ,'".$rs_dx["dx2"]."' ,'".$rs_dx["dx3"]."' ,'".$rs_dx["dx4"]."' ,'".$rs_dx["dx5"]."'";
																			 		$sql_dxn="select  code, name  from  icd101 where code in ($code_dxall) " ;
						   															$result_dxn=mysql_db_query($DBName,$sql_dxn)
				           															or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
																				
																				$num_rows_max = mysql_num_rows($result_dxn);
																				$i=0;
																				while($i<$num_rows_max){  
																				$rs_dxn=mysql_fetch_array($result_dxn);
																				$adm_dx=$rs_dxn["name"];
																				$adm_code=$rs_dxn["code"];
																				echo  "<br>&nbsp;<font color=red>Dx.".($i+1)."</font> <font color=blue>".$adm_code."</font> <font color=green>".$adm_dx."</font>";
																				$i++;
																				}//while
															              }//if ($result_dx){
																	} //$rs_ipt_n["cc_ipt_n"]>0
																	//end final diag
						?>
                          <!-- end admit -->
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2"><hr></td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="left">&nbsp; 
                          <!-- วันนัด-->
                          <?php
							$sql_c_oapp="select count(*) as cc from oapp where vn='$vn' ";
							$result_c_oapp=mysql_db_query($DBName,$sql_c_oapp)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$rs_c_oapp=mysql_fetch_array($result_c_oapp);
							if ($rs_c_oapp["cc"]>0){
										$sql_oapp="select * from oapp where vn='$vn' ";
										$result_oapp=mysql_db_query($DBName,$sql_oapp)
										or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
										$num_rows_oapp=mysql_num_rows($result_oapp);
										if($num_rows_oapp<>0){
										echo "<font color=\"#800080\">วันนัดถัดไป&nbsp;</font>";
											$i=0;
											while($i<$num_rows_oapp){
													$rs_oapp=mysql_fetch_array($result_oapp);
													$d_oapp=$rs_oapp["doctor"]; //รหัสหมอ
													 echo "<font color=\"blue\">".FormatDate($rs_oapp["nextdate"])."</font><br>";	
						      
						        							$sql_d_oapp="select name from doctor where code='$d_oapp' ";
															$result_d_oapp=mysql_db_query($DBName,$sql_d_oapp)
															or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
															$rs_d_oapp=mysql_fetch_array($result_d_oapp);
															if ($rs_d_oapp<>"") {echo "<font color=\"#800080\">&nbsp;ผู้นัด&nbsp;</font><font color=\"blue\">".$rs_d_oapp["name"]."</font>";}
											$i++;
											} //while
										}//$num_rows_oapp<>0
									}//rs_c_oapp["cc"]>0
							?>
                          <!-- ene วันนัด -->
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td colspan="2" align="left" valign="top"> 
                          <!-- start ส่งตรวจทางห้องปฏิบัิติการ -->
                          <?php 
							$sqlLab1="select * from lab_head where vn='$an' order by order_date desc,report_date desc ";
							$result_lab1=mysql_db_query($DBName,$sqlLab1)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							//$rs_lab1=mysql_fetch_array($result_lab1);
							$num_rows_lab1 = mysql_num_rows($result_lab1);//echo $num_rows_lab1;
									if($num_rows_lab1==0){ //row1
										echo "<br>&nbsp;- <span class=detail-text2>ไม่มีข้อมูลการส่งตรวจทางห้องปฏิบัติการ</span><br></font>";
									}else{ //n row
									$i=0;
									$lab_order_list="";
									while($i<$num_rows_lab1){ //while1
									$rs_lab1=mysql_fetch_array($result_lab1);
											if ($lab_order_list==""){
												$lab_order_list="'".$rs_lab1["lab_order_number"]."'";}else{
							  					$lab_order_list=$lab_order_list.",'".$rs_lab1["lab_order_number"]."'"; }
										$i++;
									 }	//while1
									 //echo $lab_order_list;
										if ($lab_order_list==""){ $lab_order_list="0";}									
																$sqlLab2="select  l.*,i.lab_items_name,i.lab_items_unit,i.lab_items_code,i.lab_items_normal_value,e.staff ";
																$sqlLab2.="from lab_order l ";
																$sqlLab2.="left outer join lab_entry_log e on e.lab_order_number=l.lab_order_number ";
																$sqlLab2.="left outer join lab_items i on i.lab_items_code=l.lab_items_code ";
																$sqlLab2.="where l.lab_order_number in  ($lab_order_list) and l.lab_order_result <>'' group by i.lab_items_code,l.lab_order_number ";
																$sqlLab2.="order by i.display_order,i.lab_items_name "; 
																	$result_lab2=mysql_db_query($DBName,$sqlLab2)
																	or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
																	//$rs_lab2=mysql_fetch_array($result_lab2);
																	$num_rows_lab2=mysql_num_rows($result_lab2);
																		if($num_rows_lab2==0){ //a
																		echo "<br>&nbsp;- <span class=detail-text2>ไม่มีรายการ</span>";}else{
																		 //row2 ?>
                          <!-- ตารางนอก -->
                          <center>
                            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
                              <tr> 
                                <td> 
                                  <!-- ตารางใน -->
                                  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr bgcolor="#3399CC" background="img_mian/bgcolor2.gif" class="headtable"> 
                                      <td width="46" align="center">ลำดับ</td>
                                      <td width="197" align="left">ชื่อการส่งตรวจ</td>
                                      <td width="126" align="left">ผล</td>
                                      <td width="111" align="left">ค่าปกติ</td>
                                      <td width="118" align="center">ผู้รายงาน</td>
                                    </tr>
                                    <?php
																				$i2=0;
																			while($i2<$num_rows_lab2){  //while2
																				$rs_lab2=mysql_fetch_array($result_lab2);
																				?>
                                    <tr class="text-intable"> 
                                      <td width="46" align="center"><?php echo ($i2+1); ?></td>
                                      <td width="197" align="left">&nbsp;<?php echo $rs_lab2["lab_items_name"];  ?></td>
                                      <td width="126" align="left">
                                          <?php
																				  if ($rs_lab2["confirm"]=="Y"){
																				 echo $rs_lab2["lab_order_result"]." ".$rs_lab2["lab_items_unit"];}else{
																				 echo "ยังไม่รายงาน";
																				 }
																				 ?>
                                      </td>
                                      <td width="111" align="left"><?php echo $rs_lab2["lab_items_normal_value"]; ?></td>
                                      <td width="118" align="center"> 
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
                        <td colspan="2" align="left"><br>&nbsp; <u>รายการเวชภัณฑ์ที่ได้รับ</u>&nbsp;:<br> 
                          &nbsp; 
                          <!-- รายการเวชภัณฑ์ -->
                          <?php 
						  $sqlMedi="select o.*,concat(s.name,' ',s.strength,' ',s.units) as name ,SUM(o.qty) as sumqty, d.shortlist  , i.displaycolor ,sp.* , concat(sp.name1,' ',sp.name2,' ', sp.name3) as spname ";
                         $sqlMedi.="from opitemrece o ";
                         $sqlMedi.="left outer join s_drugitems s on s.icode=o.icode  ";
                         $sqlMedi.="left outer join drugusage d on d.drugusage=o.drugusage ";
                         $sqlMedi.="left outer join sp_use sp on sp.sp_use = o.sp_use  ";
                         $sqlMedi.="left outer join drugitems i on i.icode=o.icode ";
						 $sqlMedi.="where  s.name not like 'set IV%' and s.name not like 'MEDICUT%' and o.an='$an' ";
						 $sqlMedi.="and s.name not like 'HEPARIN lock%' and o.item_type<>'H' and o.sub_type in ('1') "; 
						 $sqlMedi.="group by name  order by o.order_no "; 
							$result_Me=mysql_db_query($DBName,$sqlMedi)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$num_rows_Me = mysql_num_rows($result_Me);
							if($num_rows_Me==0){ //a
								echo "<br>&nbsp;- <span class=detail-text2>ไม่มีรายการเวชภัณฑ์</span>";}else{
							//row2 ?>
                          <!-- ตารางนอก -->
                          <table width="620" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
                            <tr> 
                              <td> 
                                <!-- ตารางใน -->
                                <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr bgcolor="#3399CC" background="img_mian/bgcolor2.gif" class="headtable"> 
                                    <td width="31"><div align="center">ลำดับ</div></td>
                                    <td width="224"><div align="left">&nbsp; ชื่อเวชภัณฑ์</div></td>
                                    <td width="223"><div align="left">&nbsp;วิธีใช้</div></td>
                                    <td width="37"><div align="center">จำนวน</div></td>
                                    <td width="93"><div align="center">ผู้สั่ง</div></td>
                                  </tr>
                                  <?php
									$i=0;
									while($i<$num_rows_Me){  //while2
									$rs_Me=mysql_fetch_array($result_Me);
									?>
                                  <tr class="text-intable"> 
                                    <td width="31"><div align="center"><?php echo ($i+1); ?></div></td>
                                    <td width="224"><div align="left">&nbsp;<?php echo $rs_Me["name"];  ?></div></td>
                                    <td width="223"><div align="left">&nbsp; 
                                        <?php if($rs_Me["shortlist"]==NULL){echo "-";}else{echo $rs_Me["shortlist"];}?>
                                      </div></td>
                                    <td width="37" ><div align="center">&nbsp;<?php echo $rs_Me["qty"]; ?></div></td>
                                    <td width="93"><div align="center">&nbsp;<?php echo $rs_Me["staff"]; ?></div></td>
                                  </tr>
                                  <?php
											$i++;
										}//while2
									?>
                                </table>
                                <!-- ปิดตารางใน -->
                              </td>
                            </tr>
                          </table>
                          <!-- ปิดตารางนอก -->
                          <?php
							}//row
						?>
                          <!-- end รายการเวชภัณฑ์ -->
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2"><hr></td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="left">&nbsp;&nbsp;<u>รายการเวชภัณฑ์รับกลับบ้าน 
                          (HOME MEDICATION)</u>&nbsp;:<br> &nbsp; 
                          <!-- รายการเวชภัณฑ์ กลับบ้าน-->
                          <?php
						$sqlMedi2="select o.*,concat(s.name,' ',s.strength,' ',s.units) as name ,SUM(o.qty) as sumqty, d.shortlist  , i.displaycolor ,sp.* , concat(sp.name1,' ',sp.name2,' ', sp.name3) as spname ";
                         $sqlMedi2.="from opitemrece o ";
                         $sqlMedi2.="left outer join s_drugitems s on s.icode=o.icode  ";
                         $sqlMedi2.="left outer join drugusage d on d.drugusage=o.drugusage ";
                         $sqlMedi2.="left outer join sp_use sp on sp.sp_use = o.sp_use  ";
                         $sqlMedi2.="left outer join drugitems i on i.icode=o.icode ";
						 $sqlMedi2.="where  s.name not like 'set IV%' and s.name not like 'MEDICUT%' and o.an='$an' ";
						 $sqlMedi2.="and s.name not like 'HEPARIN lock%' and o.item_type='H' and o.sub_type in ('1','3') "; 
						 $sqlMedi2.="group by name  order by o.order_no "; 
							$result_Me2=mysql_db_query($DBName,$sqlMedi2)
							or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
							$rs_Me2=mysql_fetch_array($result_Me);
							$num_rows_Me2 = mysql_num_rows($result_Me2);
							if($num_rows_Me2==0){ //a
								echo "<br>&nbsp;- <span class=detail-text2>ไม่มีรายการเวชภัณฑ์</span>";}else{
							//row2 ?>
                          <!-- ตารางนอก -->
                          <table width="620" border="0" align="center" cellpadding="0" cellspacing="0" class="bd-external">
                            <tr> 
                              <td> 
                                <!-- ตารางใน -->
                                <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr bgcolor="#3399CC" background="img_mian/bgcolor2.gif" class="headtable"> 
                                    <td width="32" align="center">ลำดับ</td>
                                    <td width="222" align="left">&nbsp; ชื่อเวชภัณฑ์</td>
                                    <td width="225" align="left">&nbsp;วิธีใช้</td>
                                    <td width="38" align="center">จำนวน</td>
                                    <td width="91" align="center">ผู้สั่ง</td>
                                  </tr>
                                  <?php
									$i2=0;
									while($i2<$num_rows_Me2){  //while2
									$rs_Me2=mysql_fetch_array($result_Me2);
									?>
                                  <tr class="text-intable"> 
                                    <td width="32" align="center"><?php echo ($i2+1); ?></td>
                                    <td width="222" align="left">&nbsp;<?php echo $rs_Me2["name"];  ?></td>
                                    <td width="225" align="left">&nbsp; 
                                        <?php if($rs_Me2["spname"]<>""){echo $rs_Me2["spname"];}else{echo $rs_Me2["shortlist"];}?>
                                    </td>
                                    <td width="38" align="center">&nbsp;<?php echo $rs_Me2["qty"]; ?></td>
                                    <td width="91" align="center">&nbsp;<?php echo $rs_Me2["staff"]; ?></td>
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
                          <!-- ปิดตารางนอก -->
                          <?php
							}//row
						?>
                          <!-- end รายการเวชภัณฑ์ กลับบ้าน-->
                        </td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                        <td><a name="below"></a></td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                        <td align="right">&nbsp;&nbsp;<a href="#top"><img src="img_mian/arow_t.gif" width="13" height="9" border="0"></a>&nbsp;ด้านบน&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <p>&nbsp;</p>
          </div></td>
          <td width="163" align="center" valign="top" class="td-right"><table width="160" border="0" cellpadding="0" cellspacing="0" class="bd-internal">
            <tr>
              <td align="left"><!-- Start histiry vn -->
                  <?php
				  //แบ่งปี
				  $vstexp=explode("-",$datevst);
				  if(!isset($year_come)){
				$year_come=$vstexp[0];}
		$sqlyear="select  YEAR(regdate) as year_come from ipt  ";
		$sqlyear.="where hn='$hn' and hn<>'' group by  year_come order by year_come DESC";
		$resultyear=mysql_db_query($DBName,$sqlyear)
		or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
	$num_row_year = mysql_num_rows($resultyear);
	$select_year=$year_come."%";
				  //แบ่งหน้า
	$sqlmax="select  *  from  ipt ";
				$sqlmax.="where regdate between '$select_year-01-01' and '$select_year-12-31'  and  hn='$hn'   order by  an desc  "; 
		$resultmax=mysql_db_query($DBName,$sqlmax)
		or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
			// หาจำนวนเรกคอร์ดข้อมูล
			$num_row_max = mysql_num_rows($resultmax);
				  $start=$_GET['start'];
				 if(!isset($start)){
				$start = 0;}
			 	$limit =20;
	
	 echo "<center><table width=160 border=0 cellspacing=0 cellpadding=0>
  <tr bgcolor=#99CC00>
    <td align=center class=headmenu background=img_mian/bgcolor2.gif>:: ประวัติการ admit ::</td>
  </tr>
</table>";
	 echo "<b> ปี ".($year_come+543)."</b>&nbsp;,&nbsp;&nbsp;จำนวน&nbsp;";
	 echo $num_row_max." ครั้ง </center>";
//เลือกปี
echo"<center>ระบุปี ::<form name='DD'>";
echo"<Select name='DDM'  id='Txt-Field' onChange='Linkup(this.form)'>";
echo"<option value=\"$PHP_SELF?hn=$hn&vn=$ovst_vn&keyword=$keyword&year_come=$year_come&submit=$submit\">เลือกปี";
			        $y=0 ;		
					while($y<$num_row_year ){
			 		$rsYear=mysql_fetch_array($resultyear);	
					$year_came=$rsYear["year_come"];

echo"<option value=\"$PHP_SELF?hn=$hn&vn=$ovst_vn&keyword=$keyword&year_come=$year_came&submit=$submit\">".($year_came+543)."";

$y++;
					}//while $y
echo"</select>";
echo"</form></center>";
	 $sqlHis="select o.*, v.*,o.rfrolct as opdrefer, t.rfrolct as ipdrefer, a.pdx as pdx ,d.* ,d.name as dxname, c.* , c.name as cname,s.* , s.name as sname, i.name as ist_name,y.name as pttype_name from ovst o ";
		$sqlHis.="left outer join ovstist i on i.ovstist=o.ovstist ";
		$sqlHis.="left outer join pttype y on y.pttype=o.pttype ";
		$sqlHis.="left outer join vn_stat  v on v.vn=o.vn ";
		$sqlHis.="left outer join an_stat  a on a.vn=o.vn ";
		$sqlHis.="left outer join  ipt  t on t.vn=o.vn ";
		$sqlHis.="left outer join icd101 d on d.code=v.pdx ";
		$sqlHis.="left outer join icd101 c on c.code=a.pdx ";
		$sqlHis.="left outer join icd101 s on s.code=a.dx0 ";
		$sqlHis.="where v.vstdate like '$select_year'  and o.hn='$hn'  and t.an<>''  order by o.vn desc  LIMIT $start, $limit "; 
		$result=mysql_db_query($DBName,$sqlHis)
		or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
			// หาจำนวนเรกคอร์ดข้อมูล
			$num_rows = mysql_num_rows($result);
			if($num_rows<>0){
			        $i=0 ;		
					while($i<$num_rows and $i<$limit ){
			 		$rs=mysql_fetch_array($result); 
					$ovst_vn=$rs["vn"];$ovst_date=$rs["vstdate"];$ovst_time=$rs["vsttime"];
					$ovst_dxname=$rs["dxname"];$ovst_cname=$rs["cname"];$ovst_sname=$rs["sname"];
				   if ($ovst_vn==""){break;}
					if ($vn<>$ovst_vn) {
						echo "&nbsp;&nbsp;<font color=gold>>&nbsp;</font>";//.($i+1); //no
		  				echo"<font color=#CCFF00><a href=\"$PHP_SELF?hn=$hn&vn=$ovst_vn&keyword=$keyword&submit=$submit\">".FormatDate($ovst_date)."&nbsp;,&nbsp;".$ovst_time."</a><br>";		  
		  				echo"&nbsp;&nbsp;$ovst_dxname</font><br>";		  
								   if ($ovst_cname<>""){
							   	   echo "<font color=blue><B>IPD</B>(F.Dx : $ovst_cname,$ovst_sname)<br>"; }
		   
				}else{
						echo"&nbsp;<font color=\"red\">>>></font>";  //yes
      				   echo"<font color=#CCFF00><a href=\"$PHP_SELF?hn=$hn&vn=$ovst_vn&keyword=$keyword&submit=$submit\">".FormatDate($ovst_date)."&nbsp;,&nbsp;".$ovst_time."</a><br>";		 
		  				echo"&nbsp;&nbsp;$ovst_dxname</font><br>";
								   if ($ovst_cname<>""){
							   	   echo "<font color=red><B>IPD</B>(F.Dx : $ovst_cname,$ovst_sname)</font><br>"; }
				}
				 if ($rs["opdrefer"]<>"" or $rs["ipdrefer"]<>""){
							   	   echo "<font color=yellow><B>Refer</B></font><br>"; }
				
	        		$i++;
				} //whlie
		}else{echo "<center><font color=red>&nbsp;-></font>&nbsp;ไม่มีประวัติการ Admit</center>";}//n
	

	  ?>
                  <!-- end histiry vn -->
                  <br></td>
            </tr>
          </table>
            <?php
		/* ตัวแบ่งหน้า */
		$page = ceil($num_row_max/$limit ); // เอา record ทั้งหมด หารด้วย จำนวนที่จะแสดงของแต่ละหน้า
		if($num_rows<>0){
		
		echo "<br><center><font color=white>Page : </font>";
		for($p=1; $p<=$page; $p++){ //for
			if($_GET['page']==$p){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้
		//if (p
			echo "<font color=red>[<a href='?start=".$limit*($p-1)."&page=$p&hn=$hn&vn=$vn&keyword=$keyword&year_come=$year_come&submit=$submit'><B>$p</B></A>]</font>"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
	   		}else{
			echo "<font color=white>[<a href='?start=".$limit*($p-1)."&page=$p&hn=$hn&vn=$vn&keyword=$keyword&year_come=$year_come&submit=$submit'>$p</A>]</font>"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
    		}
			echo "";
	     }//for
		}

?></td>
        </tr>
        <tr valign="top"> 
          <td height="16" background="img_mian/bgcolor2.gif" align="center"><font color=white>| 
              <a href="patient_search.php">ค้นหาใหม่</a>&nbsp;|&nbsp;<a href="javascript:history.back(-1)">ย้อนกลับ</a>&nbsp;|</font> 
          </td>
          <td height="16" background="img_mian/bgcolor2.gif">&nbsp;</td>
        </tr>
        <tr valign="top"> 
          <td height="16"><img src="img_mian/bn_03_2.gif" width="634" height="36"></td>
          <td height="16">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23">&nbsp;<br><br>
      </td>
  </tr>
</table>
<?php }//
CloseDB(); //close connect db ?>
</body>
</html>
