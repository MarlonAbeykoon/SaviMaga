<?php



class dbcon {

    function dbcon_function() {

        $con = mysqli_connect("mysql1004.mochahost.com", "oclimb_test", "test123", "oclimb_testCredit");
        //$con = mysqli_connect("localhost", "root", "DuoS123", "oclimb_testCredit");

        if (mysqli_connect_errno()) {

            echo "faild to connect to MYSQL: " . mysqli_connect_error();
        } else {
            return $con;
        }
    }

    function disconnect() {
        mysqli_close($con); // CLOSE THE CONNECTION
    }

}
