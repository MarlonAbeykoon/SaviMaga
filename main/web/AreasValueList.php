<?php

include '../classes/dbcon.php';

$uid = $_POST['uid'];

$sql = mysqli_query($con, "SELECT

  collectionarea.CollectionArea,

  collection_area_user.CollectionArea_idCollectionArea,

  collection_area_user.User_idUser,

  collectionarea.idCollectionArea

  FROM

  collection_area_user

  INNER JOIN collectionarea ON collection_area_user.CollectionArea_idCollectionArea = collectionarea.idCollectionArea

  WHERE

  collection_area_user.User_idUser = '$uid'");

$result = "";

while ($results = mysqli_fetch_array($sql)) {
    if ($result == "") {
        $result = $results['CollectionArea'];
    } else {
        $result = $result . "," . $results['CollectionArea'];
    }
} echo $result;
?>


