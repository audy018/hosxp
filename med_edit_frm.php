<br />
<!--//password:edit01-->
<center>

<form name='med_error_edit_frm' action='med_edit_frm_confirm.php' method='post'>

<table width='500'>
		<tr><td colspan='2'><h2>��䢢������غѵԡ�÷ҧ�ҷ��س��ͧ���</h2></td></tr>

		<tr>
			<td>��س��к����ʤ�����ʹ���</td>
			<td><input type='text' name='secure_code'> secure code</td>
		</tr>


		
		<tr>
			<td align='left'>&nbsp;</td>
			<td align='left'><input type='submit' value='�׹�ѹ�����䢢�����'></td>
		</tr>
			

			<input type='hidden' name='err_id' value='<?=$_GET[err_id]?>'>

</table>

</form>

</center>