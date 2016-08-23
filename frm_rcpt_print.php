<?php 
session_start();
include("phpconf.php");
include("func.php");
conDB();

$hn			= $_GET['hn'];
$full_name  =$_GET['full_name'];

?>



<html>
<head>
<title>&nbsp;</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body leftmargin="35" topmargin="100" marginwidth="50" marginheight="100">

<center>
  <table width="750" border="0" cellspacing='0' cellpadding='0'>
    <tr> 
      <td colspan="4" align="center"> <table width='184' >
          <tr> 
            <td width="120" align="center"><img src="img_mian/krut.jpg" width="120"  height="120"></img></td>
            <td width="52" align="center"></img></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td colspan="2"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">ชพ 
        0032.301/พิเศษ</font><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td width="159"><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td width="237"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">โรงพยาบาลละแม</font></td>
    </tr>
    <tr> 
      <td width="50"><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td width="286"><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">ถ.เพชรเกษม 
        อ.ละแม </font></td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">จ.ชุมพร 86170</font></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
    </tr>
    <tr> 
      <td colspan="4"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">เรื่อง 
        ขอแจ้งให้ชำระหนี้ค่ารักษาพยาบาล</font></td>
    </tr>
    <tr> 
      <td colspan="3">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">เรียน&nbsp;คุณ 
        <?=$_GET['full_name']?>
        </font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td colspan="3"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ท่านได้เข้ารับบริการรักษาพยาบาล 
        ที่โรงพยาบาลละแม และได้ค้างชำระค่ารักษาพยาบาล</font></td>
    </tr>
    <tr> 
      <td colspan="4"><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">ดังรายละเอียดต่อไปนี้</font></td>
    </tr>
    <tr> 
      <td colspan='4'> 
        <?


$sqlOpd_Socail="select r.hn,concat(p.fname,'  ',p.lname) as patient_name,p.cid as cid, ";  
$sqlOpd_Socail.="r.*,o.vstdate,o.vsttime,t.name as pttype_name  ";
$sqlOpd_Socail.="from rcpt_arrear r  ";


$sqlOpd_Socail.="left outer join ovst o on o.vn=r.vn  ";
$sqlOpd_Socail.="left outer join patient p on p.hn=r.hn  ";
$sqlOpd_Socail.="left outer join pttype t on t.pttype = o.pttype  ";
$sqlOpd_Socail.="where r.hn=$hn ";  



$sqlOpd_Socail.="and r.paid in ('N')  order by r.arrear_id ";


	$resultOpd_Socail=ResultDB($sqlOpd_Socail);

if(mysql_num_rows($resultOpd_Socail)>0){
					
	$i=0;
	
	while($i<mysql_num_rows($resultOpd_Socail)){

		$rsOpd_Socail=mysql_fetch_array($resultOpd_Socail);

		echo "<table width='730' border='0'>";
		echo "<tr>";
		echo "<td width='63' align='right'>".($i+1).".</td>";
		echo "<td width=380'>วันที่มารักษาพยาบาล&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".thai_date(strtotime($rsOpd_Socail['arrear_date']))."</td>";
	
		echo "<td width='150'>จำนวนเงินที่ค้างชำระ</td>";

		echo "<td align='right' width='55'>".number_format(floor($rsOpd_Socail['amount']))."</td>";

		echo "<td>&nbsp;&nbsp;บาท</td>";
		
		echo "</tr>";
		echo "</table>";
					
                          
		$i++;
	}
					
}//while 

?>
        <?

		$sql_sum_price = "select sum(amount) as price from rcpt_arrear where hn='$hn' and paid ='N' group by hn";

		$resultOpd_Socail_sum=ResultDB($sql_sum_price);

		$resultOpd_Socail_sum=mysql_fetch_array($resultOpd_Socail_sum);

		
		$price = $resultOpd_Socail_sum['price'];


?>
      </td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td colspan="3"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC"><strong>&nbsp; 
        &nbsp;&nbsp;&nbsp;รวมเป็นเงินค้างชำระทั้งสิ้น &nbsp; 
        <?= number_format(floor($resultOpd_Socail_sum['price']));?>
        &nbsp;&nbsp;บาท  (<?=num2wordsThai(floor($price))?>บาทถ้วน)</strong></font> 
        <?
		  
		 
		 
		?>
      </td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td colspan="3"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดทราบและขอให้ท่านชำระหนี้ดังกล่าวข้างต้น 
        โดยด่วนด้วย จักขอบคุณยิ่ง</font></td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td colspan="2"> <table width="392">
          <tr> 
            <td width="70">&nbsp;</td>
            <td width="310"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">ขอแสดงความนับถือ</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td colspan="2"> <table width="392">
          <tr> 
            <td width="48">&nbsp;</td>
            <td width="332"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;&nbsp;(นายกฤตภิษัช 
              &nbsp;&nbsp;ไม้ทองงาม)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td colspan="2"> <table width="392">
          <tr> 
            <td width="10">&nbsp;</td>
            <td width="370"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">นายแพทย์ปฏิบัติการ 
              รักษาการในตำแหน่ง</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td colspan="2"> <table width="392">
          <tr> 
            <td width="47">&nbsp;</td>
            <td width="333"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">ผู้อำนวยการโรงพยาบาลละแม</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
    </tr>
    <tr> 
      <td colspan="2"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">งานประกันสุขภาพและจัดเก็บรายได้</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
    </tr>
  
    <tr> 
      <td colspan="2"><font size="+2" face="AngsanaUPC, BrowalliaUPC, CordiaUPC">โทร. 
        077-559116 ต่อ 125</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
    </tr>
    <tr> 
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
      <td><font face="AngsanaUPC, BrowalliaUPC, CordiaUPC">&nbsp;</font></td>
    </tr>
  </table>

</center>

</body>
</html>
