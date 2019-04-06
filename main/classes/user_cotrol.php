<?php
include_once 'DBConnection.php';


/* require_once 'control.php'; */

class user_function {

    private $con = '';

    public function __construct() {

        $dbcon1 = new dbcon();

        $this->con = $dbcon1->dbcon_function();
    }

    /* $cf = new control_functions(); */

    public function user_reg($fname, $lname, $path, $uname, $pass, $utype, $address, $pno, $debitorsId) {

        $query = "INSERT INTO `user_details` ( `Fname`, `Lname`, `Path`,`address` , `pno` ,`Status`) VALUES ( '$fname', '$lname', '$path', '$address', '$pno','1')";

        $query_ex = mysqli_query($this->con, $query);


        if ($query_ex) {
             $new_user_id = 0;

            if($debitorsId == null)
                $new_user_id = mysqli_insert_id($this->con);

            $query1 = "INSERT INTO `user` (`Uname`, `Pass`, `User_Type_idUser_Type`, `User_Details_idUser_Details`, `debitors_idDebitors`, `Status`) VALUES ('$uname', '$pass', '$utype', '$new_user_id', '$debitorsId', '1')";

            $query_ex1 = mysqli_query($this->con, $query1);

            if ($query_ex1) {
                return "true";
                //return "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Vertical Group creation is successful</strong></div>";
            } else {
                //return "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Vertical Group creation failed</strong></div>";
                return "false";
            }
        } else {
            //return "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Vertical Group creation failed</strong></div>";
            return "false";
        }
    }

    public function user_update($idUser_Details, $fname, $lname, $path, $utype, $address, $pno,$debitorsId) {


        // $user_id = $cf->getValueAsf($query_v);


        $query = "UPDATE `user_details` SET `Fname` = '$fname' , `Lname` = '$lname' , `Path` = '$path' ,`address` = '$address' , `pno` = '$pno' WHERE `idUser_Details` = '$idUser_Details'";
        $query_ex = mysqli_query($this->con, $query);

        if ($query_ex) {
            return "true";
            //return "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Vertical Group creation is successful</strong></div>";
        } else {
            //return "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Vertical Group creation failed</strong></div>";
            return "false";
        }
    }

    public function user_status_status($uid, $status) {

        $query_v = "UPDATE `user` SET `Status` = '$status'  WHERE `User_Details_idUser_Details` = '$uid' ";

        $query_vex = mysqli_query($this->con, $query_v);



        if ($query_vex) {


            $query = "UPDATE `user_details` SET `Status` = '$status'  WHERE `idUser_Details` = '$uid'";
            $query_ex = mysqli_query($this->con, $query);

            if ($query_ex) {
                return "true";
            } else {
                return "false";
            }
        } else {
            return "false";
        }
    }

    public function user_pass_change($uid, $pass1, $pass2) {


        if ($pass1 == $pass2) {
            $query_v = "UPDATE `user` SET  `Pass`='$pass1' WHERE `idUser` = $uid";

            $query_vex = mysqli_query($this->con, $query_v);

            if ($query_vex) {
                return true;
            }else{
                 // return 'error:' . mysqli_error($this->con);
                return false;
            }
        }else{     
            return false;

       }
    }

    public function SaveCollectionAreastoCollector($area, $uid) {
        $sql = "INSERT INTO `collection_area_user` (`CollectionArea_idCollectionArea`, `User_idUser`) VALUES ($area, $uid)";
        if (mysqli_query($this->con, $sql)) {
            return true;
        } else {
//            return 'error:' . mysqli_error($this->con);
            return false;
        }
    }

    public function RemoveCollectionAreasFromCollector($uid) {
        $sql = "delete FROM collection_area_user where collection_area_user.User_idUser in ($uid)";
        if (mysqli_query($this->con, $sql)) {
            return true;
        } else {
//            return 'error:' . mysqli_error($this->con);
            return false;
        }
    }

}
?>