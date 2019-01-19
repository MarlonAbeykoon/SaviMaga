<?php

include_once 'classes/dbcon.php';


require_once 'classes/control.php';
$cf = new control_functions();


/* 
$query="INSERT INTO `user_details` ( `Fname`, `Lname`, `Path`, `Status`) VALUES ( 'fname', 'lname', 'path', '1')";

$query_ex= mysqli_query($con,$query);


echo $query_ex; */

$query_v="SELECT `Fname` AS f FROM `user_details` WHERE `idUser_Details` = '1' ";

/* $query_results=mysqli_query($con,$query_v);
		while($row=mysqli_fetch_array($query_results)){ echo "b";
			echo $row['f'];
		} */
//echo mysqli_execute($query_v);
//echo $new_useRange = $cf->getValueAsf($query_v);

show_source("classes/control.php");

?>