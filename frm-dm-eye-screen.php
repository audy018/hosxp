<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  
  <TITLE> แบบฟอร์มคัดกรองเบาหวานเข้าจอประสาทตา รพ.ละแม อ.ละแม จ.ชุมพร </TITLE>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-874">


<script language="JavaScript" type="text/javascript">

	function frm_check(){

		if (document.frm_dm_screen.hn.value=="")
		{
			alert("คุณต้องระบุ HN คนไข้ที่ต้องการตรวจ ด้วยครับ !");
			document.frm_dm_screen.hn.focus();
			return false;
		}

		if (document.frm_dm_screen.hospital.value=="")
		{
			alert("คุณต้องระบุ สถานพยาบาล  ที่รับการรักษาด้วยครับ !");
			document.frm_dm_screen.hospital.focus();
			return false;
		}

		if ((document.frm_dm_screen.first_screen.checked=="") &&(document.frm_dm_screen.year_screen.checked=="")&& (document.frm_dm_screen.infinity_screen.checked==""))
		{
			alert("คุณต้องเลือก การตรวจจอตา  อย่างน้อย 1 ตัวเลือกครับ !");
			document.frm_dm_screen.first_screen.focus();
			return false;
		}

		if (document.frm_dm_screen.doctor_screen.value=="")
		{
			alert("คุณต้องระบุ ชื่อผู้คัดกรอง ด้วยครับ !");
			document.frm_dm_screen.doctor_screen.focus();
			return false;
		}

	


	}


	function search_hn()
	{
			var ajaxRequest;

			if(window.XMLHttpRequest)
				{
					ajaxRequest=new XMLHttpRequest();
				}
			else if(window.ActiveXObject)
				{	
					ajaxRequest=new ActiveXObject("Microsoft.XMLHTTP");
				}
			else
				{
					alert("Browser error");
					return false;
				}
				
			ajaxRequest.onreadystatechange = function()
		{
			if(ajaxRequest.readyState==4)
			{
				var show_output = document.getElementById('show_status');
				    show_output.innerHTML	= ajaxRequest.responseText;
			}
			else
			{
				var show_output = document.getElementById('show_status');
				    show_output.innerHTML	= "&nbsp;<font color='blue'>กรุณารอซักครู่ อยู่ระหว่างการค้นหาชื่อค้นไข้</font>";

			}

		}


		var hn= document.frm_dm_screen.hn.value;

		if (hn=='')
		{
			alert("กรุณากรอก HN ที่คุณต้องการก่อนคลิกปุ่มนี้ค่ะ");
			document.frm_dm_screen.hn.focus();
			return false;
		}

		ajaxRequest.open("GET","frm-dm-eye-screen-search-hn.php" + "?" + "hn=" + hn,true);

		ajaxRequest.send(null);
	}




</script>


 </HEAD>

<BODY bgcolor='pink'>

<br/>

<form enctype="multipart/form-data" method='post' name='frm_dm_screen' method="post" action="frm_dm_screen_insert.php" onSubmit='return frm_check();' >


 <table border='1' width='790' align='center' cellspacing='2' bgcolor='red'>
	
	<tr>
		<td colspan="2" align='center'>
				
				<font color='blue' size='5'><b> แบบฟอร์มคัดกรองเบาหวานเข้าจอประสาทตา รพ.ละแม  จ.ชุมพร</b></font>

		</td>
	</tr>

	<tr bgcolor='blue'>
		<td>
			&nbsp;&nbsp;
			<font color='yellow'><b>ค้นหา HN :</b></font> <input name='hn' maxlength='7' onchange='search_hn();'  style="width:100px; height:25px; font-family:Tahoma; font-size:20px; color:#000000 ;" />
			<font color='yellow'><b><<กรอกข้อมูล HN คนไข้</b></font>
			

		</td>

		<td>			
			<div id='show_status'></div>
			
		</td>

	</tr>

	<tr>
			<td colspan='2'>
				&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;
				<font color='yellow'><b>
				อายุ : <input name ='age_year' style="width:50px;" />&nbsp;ปี
				</b></font>

			</td>

	
	</tr>


	<tr bgcolor='blue'>
		<td colspan='2'>
			&nbsp;&nbsp;
			<font color='yellow'><b>DMนาน &nbsp;&nbsp; : </b></font>
					
					<select name='dm_year'>
						<option value='0'>0ปี</option>
						<option value='1'>1ปี</option>
						<option value='2'>2ปี</option>
						<option value='3'>3ปี</option>
						<option value='4'>4ปี</option>
						<option value='5'>5ปี</option>
						<option value='6'>6ปี</option>
						<option value='7'>7ปี</option>
						<option value='8'>8ปี</option>
						<option value='9'>9ปี</option>
						<option value='10'>10ปี</option>
						<option value='11'>11ปี</option>
						<option value='12'>12ปี</option>
						<option value='13'>13ปี</option>
						<option value='14'>14ปี</option>
						<option value='15'>15ปี</option>
					</select>
		
			&nbsp;&nbsp;

				<font color='yellow'><b>โรงพยาบาลที่รักษา :</b></font> <input name='hospital'  />
		
			&nbsp;&nbsp;
		
				<?php
				print"<font color='yellow'><b>วันที่ตรวจ</b></font>&nbsp;";
				print"<select name='sd1' id='Txt-Field'>";
				if($sd1<>""){print"<option value='$sd1'>$sd1</option>";}
					for($i=1;$i<=31;$i++){
						print"<option value='$i'>$i</option>";
					}
				print"</select>"; 
				?>
				
			<?php
				print"&nbsp;<font color='yellow'><b>เดือน</b></font>&nbsp;";
				print"<select name='sm1' id='Txt-Field'>";
				if($sm1<>""){print"<option value='$sm1'>".change_month_isThai($sm1)."</option>";}
					for($i=1;$i<=12;$i++){
						print"<option value='$i'>".change_month_isThai($i)."</option>";
					}
				print"</select>"; 
				?>
			  
				<?php
				print"&nbsp;<font color='yellow'><b>ปี</b></font>&nbsp;";
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
	   		?>
		</td>

		
	</tr>

	<tr bgcolor='red'>
		<td colspan='2'>
			&nbsp;
			<font color='black'><b>ตรวจจอตา :</b></font><input name='first_screen' type='checkbox' value='first_screen'>&nbsp;<font color='blue'><b>ครั้งแรก</b></font>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input name='year_screen' type='checkbox' value='year_screen'>&nbsp;<font color='blue'><b>ปีละครั้ง</b></font>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input name='infinity_screen' type='checkbox' value='infinity_screen'>&nbsp;<font color='blue'><b>ไม่แน่นอน</b></font>
		</td>
	</tr>
	
	<tr>
		<td>
				<table width='420' border='0'>
					<tr>
						<td>
							<b>VA</b>&nbsp;&nbsp;RE :<input name='va_re'/>&nbsp;&nbsp;PH :<input name='va_ph1' />
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							LE &nbsp;:<input name='va_le' />&nbsp;&nbsp;PH :<input name='va_ph2' />
						</td>
					</tr>
				</table>

		</td>
	
		<td>
				<table width='420' border='0'>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;
							<b>Dilate :</b>&nbsp;&nbsp;<input name='dilate_be'type='checkbox' 
							 value='dilate_be' />&nbsp;BE
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='dilate_re'type='checkbox'    
							 value='dilate_re' />&nbsp;&nbsp;RE
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='dilate_le'type='checkbox' 
							 value='dilate_le' />&nbsp;&nbsp;LE
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input name='no_dilate'type='checkbox' value='no_dilate'/>
							No dilate
							<input name='no_dilate_comment'  style="width:200px;"/>
						</td>
					</tr>
				</table>

		</td>
	</tr>


	<tr>
			<td align='center'>

					<table border='0' width='420' bgcolor='yellow'>

						<tr>
							<td colspan='2' align='center'>
								<b><u>ตาขวา</u></b>
							</td>
						</tr>

						<tr>
							<td align='right'>
									<input type='checkbox' name='no_dr_right_eye' value='no_dr_right_eye' />
							</td>
							<td>
									<b>NO DR </b>
							</td>
						</tr>

						<tr>
							<td align='right'>
									<input type='checkbox' name='mild_npdr_right_eye' value='mild_npdr_right_eye' />
							</td>
							<td>
									<b>mild NPDR </b>
							</td>
						</tr>

						<tr>
							<td align='right'>
									<input type='checkbox' name='moderlate_npdr_right_eye' value='moderlate_npdr_right_eye' />
							</td>
							<td>
									<b>moderlate NPDR </b>
							</td>
						</tr>

						<tr>
							<td align='right'>
								<input type='checkbox' name='serve_npdr_right_eye' value='serve_npdr_right_eye' />
							</td>
							<td>
									<b>serve NPDR </b>
							</td>
						</tr>

						<tr>
							<td align='right'>
									<input type='checkbox' name='pdr_right_eye' value='pdr_right_eye' />
							</td>
							<td>
									<b>PDR </b>
							</td>
						</tr>

						
						<tr>
							<td align='right'>
									<input type='checkbox' name='dme_right_eye' value='dme_right_eye' />
							</td>
							<td>
									<b>DME </b>
							</td>
						</tr>

							
						<tr>
							<td align='right'>
									<input type='checkbox' name='other_right_eye' value='other_right_eye' />
							</td>
							<td>
									<b>อื่นๆ </b>
									&nbsp;
									<input name='comment_right_eye' />
							</td>
						</tr>


					</table>

			</td>

			<td align='center'>
					<table border='0' width='420' bgcolor='orange'>

						<tr>
							<td colspan='2' align='center'>
								<b><u>ตาซ้าย</u></b>
							</td>
						</tr>

						<tr>
							<td align='right'>
									<input type='checkbox' name='no_dr_left_eye' value='no_dr_left_eye'  />
							</td>
							<td>
									<b>NO DR </b>
							</td>
						</tr>

						<tr>
							<td align='right'>
									<input type='checkbox' name='mild_npdr_left_eye' value='mild_npdr_left_eye' />
							</td>
							<td>
									<b>mild NPDR </b>
							</td>
						</tr>

						<tr>
							<td align='right'>
							<input type='checkbox' name='moderlate_npdr_left_eye' value='moderlate_npdr_left_eye' />
							</td>
							<td>
									<b>moderlate NPDR </b>
							</td>
						</tr>

						<tr>
							<td align='right'>
							<input type='checkbox' name='serve_npdr_left_eye'  value='serve_npdr_left_eye' />
							</td>
							<td>
									<b>serve NPDR </b>
							</td>
						</tr>

						<tr>
							<td align='right'>
									<input type='checkbox' name='pdr_left_eye'  value='pdr_left_eye' />
							</td>
							<td>
									<b>PDR </b>
							</td>
						</tr>

						
						<tr>
							<td align='right'>
									<input type='checkbox' name='dme_left_eye' value='dme_left_eye' />
							</td>
							<td>
									<b>DME </b>
							</td>
						</tr>

							
						<tr>
							<td align='right'>
									<input type='checkbox' name='other_left_eye' value='other_left_eye' />
							</td>
							<td>
									<b>อื่นๆ </b>
									&nbsp;&nbsp;
									<input name='comment_left_eye' />
							</td>
						</tr>




					</table>

			</td>
	</tr>
	
	<tr>
			<td colspan='2'>
				&nbsp;
				<b>การรักษา : </b><input name='screen_dx' style="width:371px; height:25px;" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<b>ผู้คัดกรอง : </b><input name='doctor_screen' style="width:200px; height:25px;"/>
			</td>
	</tr>

	<tr>
			<td colspan='2'>
				&nbsp;
				<b>คำแนะนำ FU&nbsp;&nbsp;&nbsp;&nbsp; </b><input name='fu_one_year' type='checkbox' value='fu_one_year' />&nbsp;<font color='blue'><b>1 ปี</b></font>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input name='fu_six_month' type='checkbox' value='fu_six_month' />&nbsp;<font color='blue'><b>6 เดือน</b></font>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input name='fu_three_month' type='checkbox' value='fu_three_month' />&nbsp;<font color='blue'><b>3 เดือน</b></font>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input name='fu_refer' type='checkbox' value='fu_refer' />&nbsp;<font color='blue'><b>Refer</b></font>
			</td>
	</tr>
	

	<tr>

			<td>
					<table border='0' width='420' cellspacing='0'>

						<tr>
							<td align='center' bgcolor='blue'>
								<font color='yellow'><b>ใส่รูปภาพตา ขวา</b></font>

							</td>
						</tr>
						<tr bgcolor='yellow'>
							<td colspan='2'>
								&nbsp;<input type='file' name='fileupload_eye_right1' size='53' />
							</td>
						</tr>

					</table>
			</td>

			

			

			<td>
					<table border='0' width='420' cellspacing='0'>

						<tr>
							<td align='center' bgcolor='blue'>
								<font color='yellow'><b>ใส่รูปภาพตา ซ้าย</b></font>

							</td>
						</tr>
						<tr bgcolor='orange'>
							<td colspan='2'>
								&nbsp;<input type='file' name='fileupload_eye_left1' size='53' />
							</td>
						</tr>

					</table>
			</td>

			



	</tr>

	<tr>
		<td colspan='2' align='center'>
				
				<input type='submit' value='บันทึกข้อมูลการคัดกรอง' style="width:220; height:45px; font-family:Tahoma; font-size:20px; color:#000000 ;" />

		</td>
	</tr>






</table>


</form>
  
 </BODY>
</HTML>
