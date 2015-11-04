<?
session_start();
header("Content-type:text/html; charset=windows-874");

include("phpconf.php");
include("func.php");
conDB();



$sql = "SELECT hn,concat(pname,fname,'  ',lname) as pt_name,birthday  FROM patient  WHERE hn='$_REQUEST[hn]'";

$result_Search=ResultDB($sql);


if(mysql_num_rows($result_Search)>0){

$i=0;

 while($i<mysql_num_rows($result_Search)){//while
			
		$rs_search=mysql_fetch_array($result_Search);
		

		echo "<font color='yellow' size='4'><b>";
		echo "&nbsp;";
		echo $rs_search['pt_name'];
		echo "&nbsp;&nbsp;";

		/*
		echo "วันเกิด ";
		echo "&nbsp;";
		echo dateThai($rs_search['birthday']);
		echo "</b></font>";
		*/
$i++;

 }



}else{
			echo "<font color='yellow' size='5'><b>";
			echo "&nbsp;";
			echo "ไม่มีรายชื่อคนไข้นี้ในระบบ";
			echo "</b></font>";

}

?>




