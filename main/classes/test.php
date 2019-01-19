<?php
include_once './debitor_control.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try {
   
    $testmethod = new debitor_function();
    $res = $testmethod->debitor_update('12345','abcde', 'def', '123 a', 'cvbv', '123456', '123456', 'abc@abc.com');
    echo 'asdasd';
    echo $res;
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}