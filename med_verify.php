<?
	session_start();

?>
<html>
	<head>
			<title>ระบบยืนยันสิทธ์การเข้าใช้งานระบบงานห้องยา</title>	 
			<meta charset="utf-8" />
	</head>


<body>

<br/><br/><br/><br/>
<center><h2><font color='blue'>ระบบยืนยันสิทธ์การเข้าใช้งานระบบงานห้องยา</font></h2></center>
<form method="post" action="<?=$PHP_SELF;?>">
				<table width="500" border="1" align="center"> 
					
					<tr align="center">
							<td>
								VERIFY CODE:
								<input type="password" name="pw" />
								<input type="submit" name="btn" value="ยืนยันรหัสผ่าน" />
							
							
							</td>
					</tr>


				</table>

</form>

<br/>
<center><a href="result_chlogin.php"><< กลับสู่หน้าหลัก</a></center>
	<?	

			$pass_verify="lamae11381";

			$pass_input = $_POST['pw'];

			if($btn!=null){

				if($pass_verify==$pass_input){
						
						//redirect
						echo "<META HTTP-EQUIV='refresh'
							CONTENT='0;URL=result_chlogin.php'>";
						
						$_SESSION["pass_verify"] = true;
				
				}else{
						//
						echo "<center><h3><font color='red'>!! กรุณาระบุ รหัสผ่าน ให้ถูกต้องด้วยครับ</font></h3></center>";
				}

					
			}

	?>







</body>


</html>