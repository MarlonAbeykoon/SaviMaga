<?php
include '../classes/dbcon.php';

$uid = $_POST['uid'];

$sql = mysqli_query($con, "SELECT

collectionarea.CollectionArea,

collectionarea.idCollectionArea

FROM

collectionarea

WHERE

collectionarea.`Status` = 1");

while ($result = mysqli_fetch_array($sql)) {
    $sql2 = mysqli_query($con, "SELECT collection_area_user.idCollection_Area_User
FROM collection_area_user
WHERE
collection_area_user.CollectionArea_idCollectionArea = '".$result['idCollectionArea']."' AND
collection_area_user.User_idUser = $uid");
    $stat = false;
          if($count = mysqli_fetch_array($sql2)){
              $stat = true;
          };
?>

<option value='<?php echo $result['idCollectionArea']; ?>' <?php if($stat){ ?>selected<?php }?>><?php echo $result['CollectionArea']; ?></option>

           <?php } ?>
