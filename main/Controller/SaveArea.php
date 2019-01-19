<?php

$areas = explode(",", $_POST['areas']);

include_once '../classes/DBConnection.php';

require_once '../classes/Areas.php';
$uc = new Areas();

$res = $uc->RemoveAreas();

if ($res) {
    for ($x = 0; $x < sizeof($areas); $x++) {
//       echo $x.",";
        $res = $uc->update_area($areas[$x], '1');
    }
    echo $res;
}

