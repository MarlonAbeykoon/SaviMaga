<?php
include_once 'DBConnection.php';


/* require_once 'control.php'; */

class Areas {

    private $con = '';

    public function __construct() {

        $dbcon1 = new dbcon();

        $this->con = $dbcon1->dbcon_function();
    }

    /* $cf = new control_functions(); */

    public function update_area($idCollectionArea, $Status) {

        $query = "UPDATE `collectionarea` SET `Status` = '$Status' WHERE `idCollectionArea` = '$idCollectionArea'";
        $query_ex = mysqli_query($this->con, $query);

        if ($query_ex) {
            return true;
           } else {
            return false;
        }
    }

    public function RemoveAreas() {
        $query = "UPDATE `collectionarea` SET `Status` = '0' WHERE `Status` = '1'";
        $query_ex = mysqli_query($this->con, $query);

        if ($query_ex) {
            return true;
        } else {
            return false;
        }
    }

}
?>