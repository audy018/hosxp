<?php
include("phpconf.php");
include("func.php");
conDB();

function unicode_thai($text_input) {
$text_output = "";
for ($i=0;$i<strlen($text_input);$i++) {
if (ord($text_input[$i])<=126)
$text_output .= $text_input[$i];
else
$text_output .= "&#".(ord($text_input[$i])-161+3585).";";
}
return $text_output;
}

//reciept
$vstdate=$_REQUEST['vstdate'];
$grpid=$_REQUEST['grpid'];
$chart_width=$_REQUEST['chart_width'];
$chart_font=$_REQUEST['chart_font'];

include("grpsql.php");

//create temreport
 $sql2="delete  from tempreport where reportname='$reportname' ";  
  $result2 = mysql_db_query($DBName,$sql2);

  

  $result = mysql_db_query($DBName,$sql)
			or die("sorry,can't show any information".mysql_error());
			
			$num_rows_max=mysql_num_rows($result);
			
//$ftszx=(ceil(100/$num_rows_max));//font

$i=0;
$isdx="";
$isdy="";
$isname="";

while ($i < $num_rows_max){
$rs=mysql_fetch_array($result);
if ($isdx==""){
						$isdx="'".$rs["dx"]."'";}else{
						$isdx=$isdx.", '".$rs["dx"]."'"; } 
if ($isdy==""){
						$isdy="'".$rs["dy"]."'";}else{
						$isdy=$isdy.", '".$rs["dy"]."'"; }
if ($isname==""){
						$isname=name1;}else{
						$isname=$isname.",".name.($i+1); }
	
						$i++;}
						
$sqlx="insert into tempreport (reportname, id, name,$isname) values ('$reportname', 'x', '$namex',$isdx)";
$Resultx=mysql_db_query($DBName,$sqlx)
			or die("sorry,can't show any information".mysql_error());
$sqly="insert into tempreport (reportname, id, name,$isname) values ('$reportname', 'y', '$namey',$isdy)";
$Resulty=mysql_db_query($DBName,$sqly)
			or die("sorry,can't show any information".mysql_error());
//end  create temreprt

//qeury from temreport
$sqlx="select  * from  tempreport where reportname='$reportname' and id='x' order by name ";
			$resultx= mysql_db_query($DBName,$sqlx)
			or die("sorry,can't show any information".mysql_error());
			$rsx=mysql_fetch_array($resultx);
			$name=$rsx["name"];

$sqly="select  * from  tempreport where reportname='$reportname' and id='y' order by name ";
			$resulty= mysql_db_query($DBName,$sqly) and  $success='Y'
			or die("sorry,can't show any information".mysql_error());
			$num_rows_max1 = mysql_num_rows($resulty);

echo "
<chart>

	<axis_category  skip='0' font='Tahoma' size='".$chart_font."' color='000000' alpha='75'  orientation='horizontal' />
	<axis_ticks  font='Tahoma'   value_ticks='false' category_ticks='true' major_thickness='2' minor_thickness='1' minor_count='1' major_color='000000' minor_color='222222' position='inside' />
	<axis_value min='0'  font='Tahoma'  size='12' color='ffffff' alpha='50' steps='6' prefix='' suffix='' decimals='0' separator='' show_min='false'   />
<chart_data>
		<row>
			<string></string>";
		
			$a=0;
			$namea="";
			while($a<$num_rows_max){
			if ($namea=="" ){
			$namea=name1; }
			else{	$namea=name.($a+1);}
			echo"<string>".unicode_thai($rsx["$namea"])."</string>";
			$a++;
			}
		
	echo"</row>";
		$i=0;
		while ($i<$num_rows_max1 ){ 
			$rsy=mysql_fetch_array($resulty);
		echo "<row>
			<string>".unicode_thai($rsy["name"])."</string>";
			$b=0;
			$nameb="";
			while($b<$num_rows_max){
			if ($nameb=="" ){
			$nameb=name1; }
			else{	$nameb=name.($b+1);}
			echo"<number>".$rsy["$nameb"]."</number>";
			$b++;
			}
			
		echo "</row>";
		$i++;		}
		
echo "
	</chart_data>
	<chart_grid_h  alpha='10' color='000000' thickness='1' />
	<chart_pref line_thickness='2' point_shape='circle' fill_shape='false' />
	<chart_rect  x='70' y='100' width='".$chart_width."' height='300' positive_color='ffffff' positive_alpha='50' negative_color='000000' negative_alpha='10' />
	<chart_transition   type='slide_left' delay='0' duration='0.5' order='series' />
	<chart_type>".$chart_type."</chart_type>
	<chart_value   position='".$value_pos."' size='12' color='000000' background_color='aaff00' alpha='80'  as_percentage='$value_percent'/>
	
	<draw>
		<text transition='dissolve' delay='0' duration='0.5' color='000000' alpha='8' font='Arial' rotation='0' bold='true' size='36' x='120' y='-10' width='".(0.84*$chart_width)."' height='75' h_align='center' v_align='bottom'>".unicode_thai($reportname)."</text>
		<text color='ffffff'  alpha='50' rotation='-90' bold='true'  size='14' x='0' y='450' width='155' height='47' h_align='right' v_align='bottom'></text>
		<text color='ffffff' alpha='50' bold='true' size='14' x='310' y='125' width='380' height='291' h_align='right' v_align='bottom'></text>
	</draw>
	
	<legend_label layout='horizontal' bullet='line'  font='Tahoma'  bold='true' size='13' color='ffffff' alpha='65' />
	<legend_rect x='70' y='75' width='".$chart_width."' height='5' margin='5' fill_color='000000' fill_alpha='7' line_color='000000' line_alpha='0' line_thickness='0' />
	<legend_transition type='dissolve' delay='0' duration='0.5' />
	
	<series_color>
		<value>ffff00</value>
		<value>ff4444</value>
		<value>8844ff</value>
	</series_color>
	<series_explode>
		<number>0</number>
		<number>5</number>
		<number>0</number>
		<number>0</number>

	</series_explode>

</chart>";

CloseDB(); //close connect db 

?>

 
