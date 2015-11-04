<?php
session_start();

class permiss_access { //class

function Access_ForUser($ulogin) { //accessright in db for login name
include("phpconf.php");
				  	$sqlAccess="select  * from opduser  where loginname='$ulogin' ";
					$resultAccess=mysql_db_query($DBName,$sqlAccess)
					or die("ไม่สามารถเลือกข้อมูลมาแสดงได้".mysql_error());
	   				$rsAccess=mysql_fetch_array($resultAccess);
					return $rsAccess["accessright"];
}

function AccessStr_User($ip_login,$str,$access_user) { //accessright for user
	//echo "Access=".$access_user;
	/*if(eregi($str,$access_user))	return true;
      else return false; //end if  */

 for($i=0;$i< count($str);$i++) {
      if (eregi("($str[$i])",$access_user)) {
	  		$a.=$str[$i]."#";//echo $a;
	   }//if
   }//for
//echo $a;

/*foreach ($a as $value) {
   $newdata .= $value;

}
echo "ddd".$newdata; */
   		return $ip_login."#".$a;
}//function


}//end class
?>
