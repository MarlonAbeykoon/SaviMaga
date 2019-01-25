<?php

include_once '../classes/DBConnection.php';
include_once '../classes/Credit_Invoice.php';


session_start();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try {
    $cid = $_POST['cid'];
    $status = $_POST['status'];

    if ($cid != "") {
        $credit = new Credit_Invoice();
        $res = $credit->updateStatus($cid, $status);
        if ($res) {
            echo true;
        } else {
            echo false;
        }
    } else {
        echo false;
    }
//echo $res;
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}
