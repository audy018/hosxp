<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>- - �к��Թ����� | <?php echo "&nbsp;".$Hospname."&nbsp;"; ?> | - - Risk Management Report Review Form - - |</title>
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
<SCRIPT LANGUAGE="JavaScript">
<!-- hide this script tag's contents from old browsers
function goHist(a) 
{
   history.go(a);      // Go back one.
}
//<!-- done hiding from old browsers -->
</script>

<script type="text/javascript">

var regiondb = new Object()
regiondb["africa"] = [{value:"102", text:"Cairo"},
                      {value:"88", text:"Lagos"},
                      {value:"80", text:"Nairobi"},
                      {value:"55", text:"Pretoria"}];
regiondb["asia"] = [{value:"30", text:"Ankara"},
                    {value:"21", text:"Bangkok"},
                    {value:"49", text:"Beijing"},
                    {value:"76", text:"New Delhi"},
                    {value:"14", text:"Tokyo"}];


function setCities(chooser) {
    var newElem;
    var where = (navigator.appName == "Microsoft Internet Explorer") ? -1 : null;
    var cityChooser = chooser.form.elements["city"];
    while (cityChooser.options.length) {
        cityChooser.remove(0);
    }
    var choice = chooser.options[chooser.selectedIndex].value;
    var db = regiondb[choice];
    newElem = document.createElement("option");
    newElem.text = "Choose a City:";
    newElem.value = "";
    cityChooser.add(newElem, where);
    if (choice != "") {
        for (var i = 0; i < db.length; i++) {
            newElem = document.createElement("option");
            newElem.text = db[i].text;
            newElem.value = db[i].value;
            cityChooser.add(newElem, where);
        }
    }
}

</script>
</head>
<?php
	$ip=get_ip();
	$online=Check_Online($ip); //func check online
if($online){$ip_Log=user_change($ip);}else{$ip_Log=$_SESSION['ip_Log'];}
	$aright=array("ADMIN","Risk_Review");$aright2=array("Risk_Review");
			//echo $online;
if($online){$right=access_right($ip_Log);}else{$right=$_SESSION["right"];}
if((check_right($right,$aright)!==2) and (check_right($right,$aright2)!==1)){ //check access
			print"<br><br><center><h2>��ҹ����Է����ҹ˹�ҹ��....��Ѻ</h2></center><br>";
			print"<p align=center><input type='submit' value='�Դ˹�ҵ�ҧ'  id='Button' onClick='javascript:window.close();'><br><br>";
			print"Development By <b>Guprajag</b> CopyRight &copy; 04-2006 <b>IM Team Mayo Hospital.</b>All right reserved</p>";
			//echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //check access

//if (!$_SESSION["ip_Log"] and !Check_Online(get_ip()) and check_right(!$_SESSION['right'],"Risk_Review")==2){ //check  ->off line
if (!$ip_Log and !Check_Online(get_ip())){ //check  ->off line
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=index.php'>";
}else{ //on line

?>
<body>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="927"><table width="800" cellpadding="0" cellspacing="0">
        <tr> 
          <td valign="top">
<?php if (Check_Online(get_ip()) and $Header=="N") {} else {include("header.inc");} ?>
		  </td>
        </tr>
        <tr> 
          <td height="177" align="center" valign="top" class="td-left"><br>
		  <table width="700" border="0" cellpadding="0" cellspacing="0" class="bd-external">
            <tr align="center" bgcolor="#99CCFF">
              <td height="24" colspan="2" background="img_mian/bgcolor2.gif" class="headmenu"> Risk Management Report Review From </td>
            </tr>
            <tr>
              <td width="337" valign="top" bgcolor="#3399CC">&nbsp;<strong>��¡��</strong> - &gt; <strong>��¡���غѵԡ��</strong> |  <a href="javascript:history.back(-1)">��͹��Ѻ</a> | <a href="#closeform">�Դ˹�ҵ�ҧ</a> |      
              </td>
              <td width="282" bgcolor="#3399CC">&nbsp;id = <?php echo "<font color='red'><b>".$risk_id."</b></font>"; ?></td> 
            </tr>
            <tr align="center">
              <td colspan="2">
	<?php 
	$d=date("d");$m=date("n");$y=date("Y"); //date in the day ,month 05->m,5->n
	$date_current=$d." ".change_month_isThai($m)." ".($y+543); //date cuurent thai
	$time_current=date(" H:i:s");//time cuurent
	//sql form id
	//echo $subject;
	if($submit_review<>"�ѹ�֡"){ //<>"Save"
			$sql="select r.*,h.name as depart_name,rl.level_name as n_level,rc.name as n_cause,rt.typename,rcm.mname ";
			$sql.="from risk_report_web r  ";
			$sql.="left outer join hospital_department h on h.id=r.department_id ";
			$sql.="left outer join risk_level rl on left(rl.level_name,1)=r.risk_level ";
			$sql.="left outer join risk_cause rc on rc.idc=r.idc ";
			$sql.="left outer join risk_type rt on rt.idt=r.type ";
			$sql.="left outer join risk_can_manage rcm on rcm.idm=r.idm ";
			$sql.="where risk_id='$risk_id' ";
			/*$sql="select *,h.name as depart_name from risk_report_web r  ";
			$sql.="left outer join hospital_department h on h.id=r.department_id ";
			$sql.="where risk_id='$risk_id' "; */
			//$sql.="where risk_id='$risk_id' and subject like '%$subject%' ";
	$result=ResultDB($sql);//echo mysql_num_rows($result);
	$rs=mysql_fetch_array($result);
	?>
	<br><table width="625" border="0" cellspacing="0" cellpadding="0" class="bd-external">
                <tr align="center">
                  <td width="12635" colspan="4" bgcolor="#319ACE"><span class="headmenu">���ǹ ��¡���غѵԡ��<br>
                  <h1>���������ҧ����������� �ѧ�������ö�ѹ�֡��÷��ǹ��</h1></span></td>
                  </tr>
                <tr align="left" valign="top">
                  <td colspan="4"><table width="625" border="0" cellspacing="1" cellpadding="0">
                    <tr>
                      <td width="149" bgcolor="#319ACE">&nbsp;����ͧ : </td>
                      <td width="473" bgcolor="#FFFFCC">  &nbsp;<?php echo $rs['subject']; ?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;˹��§ҹ : </td>
                      <td bgcolor="#FFFFCC"> &nbsp;<?php echo $rs['depart_name']; ?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;������§����� :</td>
                      <td bgcolor="#FFFFCC"> &nbsp;<?php echo $rs['relation_program']; ?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;�ѹ����Դ : </td>
                      <td bgcolor="#FFFFCC"> &nbsp;<?php //echo $rs['report_date_time']; 
				  $date_time_report=explode(" ",$rs['report_date_time']);$dreport=$date_time_report[0];$treport=$date_time_report[1];
				  $d_split=explode("-",$dreport);//if(strlen($d_split[1])==1){ $d_s="0".$d_split[1];}
				  echo $d_split[2]."-".$d_split[1]."-".($d_split[0]+543)."  ����".$treport;
				  ?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;�дѺ�����ع�ç :</td>
                      <td bgcolor="#FFFFCC">&nbsp;<?php  
			//$level=$rs['risk_level'];
			//$sqlLevel="select * from risk_level  where  level_name like '$level%' ";$resultLevel=ResultDB($sqlLevel);$rsLevel=mysql_fetch_array($resultLevel);
			//echo $rs['level_name'];
					echo $rs['n_level'];				  
					?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;������� : </td>
                      <td bgcolor="#FFFFCC">
					<?php
						if($rs['freq']){
						echo "<input type='text' name='freq' size='3'  style='color:white;background:red' id='Txt-Field' value='".$rs['freq']."' onkeyup=\"this.value=this.value.replace(/\D/g,'')\" onchange=\"this.value=this.value.replace(/\D/g,'')\"> ����&nbsp;<font color='red'>* ����¹�ŧ����� ੾�е���Ţ</font>";
						}else{
						echo "<input type='text' name='freq' size='3'  style='color:white;background:red' id='Txt-Field' value='0' onkeyup=\"this.value=this.value.replace(/\D/g,'')\" onchange=\"this.value=this.value.replace(/\D/g,'')\"> ����&nbsp;<font color='red'>* ����¹�ŧ����� ੾�е���Ţ</font>";
						}
					?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;</td>
                      <td bgcolor="#FFFFCC">
<select name="continent" onChange="setCities(this)">
    <option value="" selected>Choose a Region:</option>
    <option value="africa">Africa</option>
    <option value="asia">Asia</option>
</select>&nbsp;
<select name="city">
    <option value="" selected>Choose a City:</option>
</select>
</form>					  
</td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;������ :</td>
                      <td bgcolor="#FFFFCC">
				<?php
				  $sqlS_type="SELECT * FROM risk_type ";$resultS_type=ResultDB($sqlS_type);
				  //echo ">".$rs['type'];echo mysql_num_rows($resultS_type);
				 if(mysql_num_rows($resultS_type)>0){//r
					print"<select name='type'  style='color:white;background:red' id='Txt-Field'>";
						if(!$rs['type'] or $rs['type']==0){//1
								print "<option>--���͡--</option>";
							for($i=0;$i<mysql_num_rows($resultS_type);$i++){ //for
								$rsS_type=mysql_fetch_array($resultS_type);
								print "<option value='".$rsS_type['idt']."'>".$rsS_type['typename']."</option>";
				  			}//for
						}else{//1
						print "<option value='".$rs['type']."'>".$rs['typename']."</option>";
				  		}//1
					print"</select>";
				}//r
				  ?>	</td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;���˵�</td>
                      <td bgcolor="#FFFFCC">
				<?php
				  $sqlS_cause="SELECT * FROM risk_cause ";$resultS_cause=ResultDB($sqlS_cause);
				  //echo ">".$rs['idc'];echo mysql_num_rows($resultS_cause);
				 if(mysql_num_rows($resultS_cause)>0){//r
					print"<select name='idc'  style='color:white;background:red' id='Txt-Field'>";
						if(!$rs['idc'] or $rs['idc']==0){//1
								print "<option>--���͡--</option>";
							for($i=0;$i<mysql_num_rows($resultS_cause);$i++){ //for
								$rsS_cause=mysql_fetch_array($resultS_cause);
								print "<option value='".$rsS_cause['idc']."'>".$rsS_cause['name']."</option>";
				  			}//for
						}else{//1
						print "<option value='".$rs['idc']."'>".$rs['n_cause']."</option>";
				  		}//1
					print"</select>";
				}//r
				?>					  </td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;��������´ : </td>
                      <td bgcolor="#FFFFCC"><?php echo $rs['risk_detail']; ?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;���������ͧ�� : </td>
                      <td bgcolor="#FFFFCC">&nbsp;<?php echo $rs['edit_basic']; ?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;����й��ԧ�к�(�����§ҹ) : </td>
                      <td bgcolor="#FFFFCC">&nbsp;<?php echo $rs['info_system']; ?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;��÷��ǹ :</td>
                      <td bgcolor="#FFFFCC">&nbsp;<?php 
				  if($rs['review_status']=='Y'){echo "���ǹ";}else{echo "�ѧ��跺�ǹ";} 
				  if($rs['review_date_time']<>""){
				    if($rs['review_status']=='Y'){ 
				 		//echo "dddddddd";$rs['review_date_time'];
				  		print "�ѹ��跺�ǹ��������ش :  ";
				  		$date_time_review=explode(" ",$rs['review_date_time']);$dreview=$date_time_review[0];$treview=$date_time_review[1];
				  		$d_split_review=explode("-",$dreview);//if(strlen($d_split[1])==1){ $d_s="0".$d_split[1];}
				  		echo $d_split_review[2]."-".$d_split_review[1]."-".($d_split_review[0]+543)."  ���� ".$treview;
						}
				  }//else{ print "���ŧ����";}
				  ?></td>
                    </tr>
                  </table></td>
                  </tr>
                <tr align="left">
                  <td colspan="4" valign="top">			
				  <form method="get" name="frisk_report"  action="<?php $PHP_SELF; ?>">
				    <table width="625" border="0" cellspacing="2" cellpadding="0">
                    <tr>
                      <td width="149" valign="top" bgcolor="#319ACE">&nbsp;���ǹ : </td>
                      <td width="473" valign="top" bgcolor="#FFFFCE"><textarea name="review_detail" rows="7" cols="55"><?php echo $rs['review_detail']; ?>
				      </textarea></td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;��鷺�ǹ :</td>
                      <td bgcolor="#FFFFCE"> &nbsp;<?php if($rs['review_staff']){echo $rs['review_staff'];}else{echo "�ѧ��跺�ǹ";} ?></td>
                    </tr>
                    <tr>
                      <td valign="top" bgcolor="#319ACE">&nbsp;��õͺʹͧ�дѺ���� :</td>
                      <td bgcolor="#FFFFCE"><textarea name="respond_level_depart" rows="7" cols="55"><?php echo $rs['respond_level_depart']; ?>
				      </textarea></td>
                    </tr>
                    <tr>
                      <td valign="top" bgcolor="#319ACE">&nbsp;��������ö㹡�èѴ���<br>
                        &nbsp;���(�дѺ)</td>
                      <td align="left" valign="middle" bgcolor="#FFFFCE">
				<?php
				  $sqlS_manage="SELECT * FROM risk_can_manage ";$resultS_manage=ResultDB($sqlS_manage);
				  //echo ">".$rs['idm'];echo mysql_num_rows($resultS_manage);
					print"<select name='idc'  style='color:white;background:red' id='Txt-Field'>";
						if(!$rs['idm'] or $rs['idm']==0){//1
							print "<option>--���͡--</option>";
 						 //if(mysql_num_rows($resultS_manage)>0){//r
							for($i=0;$i<mysql_num_rows($resultS_manage);$i++){ //for
								$rsS_manage=mysql_fetch_array($resultS_manage);
								//$sub_str=explode(":",$rsS_Level['level_name']);$level_en=$sub_str['0'];$level_text=$sub_str['1'];
							if(strlen($rsS_manage['mname'])>55){$t_long=substr($rsS_manage['mname'],0,55)."......";}else{$t_long=substr($rsS_manage['mname'],0,55);}								
								print "<option value='".$rsS_manage['idm']."'>".$t_long."</option>";
				  			}//for
						}else{//1
							print "<option value='".$rs['idm']."'>".$rs['mname']."</option>";
				  		}//1
					print"</select>";
				//}//r
				?>			  					  </td>
                    </tr>
                    <tr>
                      <td valign="top" bgcolor="#319ACE">&nbsp;��ػ�Դ��� :</td>
                      <td valign="top" bgcolor="#FFFFCE"><textarea name="result_follow" rows="7" cols="55"><?php echo $rs['result_follow']; ?>
				      </textarea></td>
                    </tr>
                    <tr>
                      <td valign="top" bgcolor="#319ACE">&nbsp;����ʹ��Шҡ RM : </td>
                      <td bgcolor="#FFFFCE" align="left"><textarea name="intro_rm" rows="7" cols="55"><?php echo $rs['result_follow']; ?>
				      </textarea></td>
                    </tr>
                    <tr>
                      <td bgcolor="#319ACE">&nbsp;��÷��ǹ/���</td>
                      <td bgcolor="#FFFFCE" align="left">
				 &nbsp;<?php
				  if($rs['review_date_time']<>""){
				     if($rs['review_status']=='Y'){ 
				  		$date_time_review=explode(" ",$rs['review_date_time']);$dreview=$date_time_review[0];$treview=$date_time_review[1];
				  		$d_split_review=explode("-",$dreview);//if(strlen($d_split[1])==1){ $d_s="0".$d_split[1];}
				  		$all_date_review="[".$rs['review_staff'].",".$d_split_review[2]."-".$d_split_review[1]."-".($d_split_review[0]+543).",".$treview."]"; 
						}
				  }else{ print "�ѧ��跺�ǹ";}
				 
				 if($rs['all_date_review']=="" or $rs['all_date_review']==NULL){ 
				 $all_date_total=$all_date_review;echo $all_date_total;
				  }else{ 
				  	//sql select  all_date_review
				  $all_date_total=$rs['all_date_review'].";".$all_date_review;echo $all_date_total;
				  }
				  ?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>
			<!--<input type="submit" name="submit_review" value="�ѹ�֡"  id='Button'> -->
			<input  type="hidden" name="risk_id" value="<?php echo $rs['risk_id']; ?>"  id='Button'>
			<input  type="hidden" name="subject" value="<?php echo $rs['subject']; ?>"  id='Button'>
			<input  type="hidden" name="all_date_total" value="<?php echo $all_date_total; ?>"  id='Button'>
			<input type="submit" name="submit_risk" value="�Դ˹�ҵ�ҧ"  id='Button' onClick="javascript:window.close();">
			<input type="button" VALUE="��͹��Ѻ" onClick="goHist(-1)"  id="Button"></td>
                    </tr>
                  </table>
				  </form></td>
                  </tr>
              </table>
			<?php
			}// <>"Save"
			//save review
			elseif($submit_review=="�ѹ�֡"){//�ѹ�֡
				$date_current=date("Y-m-d");//date cuurent 
				$time_current=date("H:i:s");//time cuurent
				$date_time=$date_current." ".$time_current;
				//echo $review_detail."********".$respond_level_depart."**********".$result_follow."*************".$all_date_total;
			print"<br><font color='red'><b>*��ѧ�ҡ��� ���ǹ��¡���غѵ����º�������� ��سҡ����� Refresh</b></font>";
			//echo "Save<br>";echo "Subject".$subject." Login ".$ip_Log;
			//sql Save Update
			//$sqlData="SELECT * FROM risk_report_web WHERE risk_id='$risk_id' and subject='$subject' ";
			$sqlData="SELECT * FROM risk_report_web WHERE risk_id='$risk_id' ";
			$resultData=ResultDB($sqlData);
				if(mysql_num_rows($resultData)>0){ //row data
					$rsData=mysql_fetch_array($resultData);
					$sqlUpdate="UPDATE risk_report_web SET review_status='Y',review_date_time='$date_time',review_staff='$ip_Log', ";
					$sqlUpdate.="review_detail='$review_detail',respond_level_depart='$respond_level_depart',result_follow='$result_follow',all_date_review='$all_date_total' ";
					$sqlUpdate.="WHERE risk_id='$risk_id' ";
					//$sqlUpdate.="WHERE risk_id='$risk_id' and subject='$subject' ";
					mysql_query($sqlUpdate)
					or die ("�������ö�ѹ�֡������㹰ҹ��������<br><center><font color=red><h2>�Դ��ͼ������к�</h2></font><br><a href='javascript:history.back(-1)'>��͹��Ѻ</a></center>".mysql_error());
					
					echo "<center><h2>�ѹ�֡������㹰ҹ������ ���º��������....���ѡ����</h2><br></center>";
					//echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;  URL=$PHP_SELF'>";
					//echo "<br>�բ�����";
				}else{echo "���������١��ͧ";}//row data
			
			print"<input type='submit' value='�Դ˹�ҵ�ҧ'  id='Button' onClick='javascript:window.close();'>";
			}//�ѹ�֡
			?>			  </td>
            </tr>
            <tr>
              <td colspan="2"></td>
            </tr>
            <tr align="center" valign="top">
              <td colspan="2">
			</td>
            </tr>
            <tr align="center">
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>            
</td>
        </tr>
        <tr>
          <td height="16" align="center" background="img_mian/orizontal.jpeg">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23"><p align="center">Development By <b>�ٻ�Шѡ�� �����</b> CopyRight &copy; 04-2006  <b>IM Team Mayo Hospital.</b>All right reserved
      </p></td>
  </tr>
</table>
<?php 
 }//ch online
}//ch access
CloseDB(); //close connect db ?>
</body>
</html>
