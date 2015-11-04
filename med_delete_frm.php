<br />

<center>

<form name='med_error_delete_frm' action='med_error_delete' method='post'>

<table width='500'>
		<tr><td colspan='2'><h2>ลบข้อมูลอุบัติการทางยาที่คุณต้องการ</h2></td></tr>

		<tr>
			<td>กรุณาระบุรหัสความปลอดภัย</td>
			<td><input type='text' name='secure_code'> secure code</td>
		</tr>

		
		<tr>
			<td align='left'>&nbsp;</td>
			<td align='left'><input type='submit' value='ยืนยันการลบข้อมูล'></td>
		</tr>

			<input type='hidden' name='err_id' value='<?=$_GET[err_id]?>'>

</table>

</form>

</center>