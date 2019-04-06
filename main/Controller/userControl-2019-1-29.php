<?php

session_start();

include_once '../classes/DBConnection.php';

require_once '../classes/user_cotrol.php';
$uc = new user_function();





try {

    

if(isset($_POST['user_re'])){

    $utype=$_POST['user_ty'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $path="1";
    $uname=$_POST['uname'];
    $pass=$_POST['cpass'];
    $address =$_POST['address'];
    $pno =$_POST['phno'];
    
     $result_ur=$uc -> user_reg($fname,$lname,$path,$uname,$pass,$utype,$address,$pno);

     if ($result_ur) {
        $_SESSION['user_msg']='<div class="alert alert-success alert-rounded"> <i class="fa fa-check-circle"></i> User registration success.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
        header('Location:../user_reg.php');
        exit();

    } else {
        $_SESSION['user_msg']='<div class="alert alert-danger alert-rounded"> <i class="fa fa-exclamation-circle"></i> User registration failed.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
        header('Location:../user_reg.php');
        exit();

    }
}else if(isset($_POST['user_de_change'])){

    $utype=$_POST['user_ty'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $path="1";
   
    $address =$_POST['address'];
    $pno =$_POST['phno'];
    $idUser_Details =$_POST['idUser_Details'];
                                   
     $result_ur=$uc -> user_update($idUser_Details,$fname,$lname,$path,$utype,$address,$pno);

     if ($result_ur) {
        $_SESSION['user_meg']='<div class="alert alert-success alert-rounded"> <i class="fa fa-check-circle"></i> User update success.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
        header('Location:../user_manage.php');
        exit();

    } else {
        $_SESSION['user_meg']='<div class="alert alert-danger alert-rounded"> <i class="fa fa-exclamation-circle"></i> User update failed.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
        header('Location:../user_manage.php');
        exit();

    }

}else if(isset($_GET['user_delete'])){

    $idUser_Details = $_GET['user_delete'];
    $status = $_GET['status'];
    $result_ur=$uc -> user_status_status($idUser_Details,$status);

    if ($result_ur) {
      
       $_SESSION['user_meg']='<div class="alert alert-success alert-rounded"> <i class="fa fa-check-circle"></i> User delete/activate success.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
       
       header('Location:../user_manage.php');
       exit();

   } else {
     
       $_SESSION['user_meg']='<div class="alert alert-danger alert-rounded"> <i class="fa fa-exclamation-circle"></i> User delete/activate failed.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
       
       header('Location:../user_manage.php');
       exit();

   }


}else if(isset($_POST['user_pw_change'])){

     $uid=$_POST['idUser_Details'];
      $pass=$_POST['newpass'];
       $pass2=$_POST['newpass2'];

    $result_ur=$uc ->user_pass_change($uid, $pass, $pass2);
//
    if ($result_ur) {
      
       $_SESSION['user_meg']='<div class="alert alert-success alert-rounded"> <i class="fa fa-check-circle"></i> Password Changed Successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
       
       header('Location:../user_manage.php');
       exit();
//
   } else {
//     
       $_SESSION['user_meg']='<div class="alert alert-danger alert-rounded"> <i class="fa fa-exclamation-circle"></i> Password Change failed.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
//       
       header('Location:../user_manage.php');
       exit();
//
   }

}else{
    header('Location:../index.php');
    exit();
}



} catch (Exception $e) {

    echo 'Message: ' . $e->getMessage();

}

