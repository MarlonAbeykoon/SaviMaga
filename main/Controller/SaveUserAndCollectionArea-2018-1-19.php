<?php

$uid = $_POST['uid'];
$areas = explode(",",$_POST['areas']);

include_once '../classes/DBConnection.php';

require_once '../classes/user_cotrol.php';
$uc = new user_function();

$res = $uc ->RemoveCollectionAreasFromCollector($uid);

if($res){
   for($x =0;$x<sizeof($areas);$x++){
//       echo $x.",";
       $res = $uc ->SaveCollectionAreastoCollector($areas[$x], $uid);
       
   }
   echo $res;
}


