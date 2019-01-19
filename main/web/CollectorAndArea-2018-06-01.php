<?php
include '../classes/dbcon.php';
$uid = $_GET[uid];
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
$selectedArea = "";
while ($result = mysqli_fetch_array($sql)) {
    if ($selectedArea == "") {
        $selectedArea = $result['collection_area_user.CollectionArea_idCollectionArea'];
    } else {
        $selectedArea = $selectedArea . "," . $result['collection_area_user.CollectionArea_idCollectionArea'];
    }
}
?>

    <?php
    $sql2 = mysqli_query($con, "SELECT
collectionarea.CollectionArea,
collectionarea.idCollectionArea
FROM
collectionarea
WHERE
collectionarea.`Status` = 1");
//    while ($result2 = mysqli_fetch_array($sql2)) {
        ?>
        <!--<option value='elem_1' ><?php echo $result2['CollectionArea']; ?></option>-->
    <?php // } ?>

        <div class="ms-selectable"><ul class="ms-list" tabindex="-1"><li class="ms-elem-selectable" id="-1300566143-selectable"><span>Homagama</span></li><li class="ms-elem-selectable" id="-1300566143-selectable"><span>Maharagama</span></li><li class="ms-elem-selectable" id="-1300566143-selectable"><span>Nugegoda</span></li></ul></div><div class="ms-selection"><ul class="ms-list" tabindex="-1"><li class="ms-elem-selection" id="-1300566143-selection" style="display: none;"><span>Homagama</span></li><li class="ms-elem-selection" id="-1300566143-selection" style="display: none;"><span>Maharagama</span></li><li class="ms-elem-selection" id="-1300566143-selection" style="display: none;"><span>Nugegoda</span></li></ul></div>