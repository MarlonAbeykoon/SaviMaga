<?php

include_once '../classes/DBConnection.php';
include_once '../classes/expenses.php';


session_start();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try {
    $user_de = $_SESSION['user_de'];


    $type = $_POST['type'];

    if ($type == "1") {

        $amount = $_POST['amount'];
        $detail = $_POST['detail'];


        $expenses = new expenses_function();
        $res = $expenses->new_expenses($detail, $amount, $user_de);

        echo $res;
    } else if ($type == "2") {
        $eid = $_POST['eid'];
        $status = $_POST['status'];
        $expenses = new expenses_function();
        $res = $expenses->update_expenses($eid, $status);

        echo $res;
    }
//echo $res;
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}
