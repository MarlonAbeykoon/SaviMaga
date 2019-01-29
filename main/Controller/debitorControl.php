<?php

session_start();

include_once '../classes/DBConnection.php';

require_once '../classes/debitor_control.php';
    $dc = new debitor_function();

//PF [lines: ~10-30]
//passing a new hidden input field 'frontend_testing'. 
//If == 1, no further backend processing else things process as normal.
//value sets to 0 during testing only.
if ( isset($_POST['frontend_testing']) && $_POST['frontend_testing'] == 1)   
{   
    echo "<br><table>";
    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td style='border-right:1px solid black'>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }
    echo '</table>';
}
else 
{   
    try {
        
        if(isset($_POST['debitor_reg'])){

            $nic=$_POST['nic'];
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $email=$_POST['email'];
            $address1=$_POST['address1'];
            $address2=$_POST['address2'];
            $pno1=$_POST['phno1'];
            $pno2=$_POST['phno2'];


            
            $result= $dc -> debitor_reg($nic, $fname, $lname, $address1, $address2, $pno1, $pno2, $email);

            if ($result) {

            $_SESSION['de_msg']='<div class="alert alert-success alert-rounded"> <i class="fa fa-check-circle"></i> Debetor registration success.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
            
            header('Location:../debitor_reg.php?ok');
            exit();

            } else {
                $_SESSION['de_msg']='<div class="alert alert-danger alert-rounded"> <i class="fa fa-exclamation-circle"></i> Debetor registration failed.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
                
                header('Location:../debitor_reg.php?noop');
                exit();

            }
            
        }else if(isset($_POST['debitor_edit'])){
            
            $nic=$_POST['nic'];
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $email=$_POST['email'];
            $address1=$_POST['address1'];
            $address2=$_POST['address2'];
            $pno1=$_POST['phno1'];
            $pno2=$_POST['phno2'];
            $id=$_POST['idDebitors'];


                                    
            $result= $dc -> debitor_update( $id,$nic, $fname, $lname, $address1, $address2, $pno1, $pno2, $email);

            if ($result) {

            $_SESSION['de_msg']='<div class="alert alert-success alert-rounded"> <i class="fa fa-check-circle"></i> Debtor update success.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
            
            header('Location:../debitor_manage.php');
            exit();

            } else {

                $_SESSION['de_msg']='<div class="alert alert-danger alert-rounded"> <i class="fa fa-exclamation-circle"></i> Debtor update failed.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
                
                header('Location:../debitor_manage.php');
                exit();

            }


        }else if(isset($_GET['debitor_delete'])){

            $id =$_GET['debitor_delete'];

            $result= $dc -> debitor_change_status( $id,'0');

            if ($result) {

            $_SESSION['de_msg']='<div class="alert alert-success alert-rounded"> <i class="fa fa-check-circle"></i> Debetor delete success.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
            
            header('Location:../debitor_manage.php');
            exit();

            } else {
                $_SESSION['de_msg']='<div class="alert alert-danger alert-rounded"> <i class="fa fa-exclamation-circle"></i> Debetor delete failed.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>';
                
                header('Location:../debitor_manage.php');
                exit();

            }

        }else {

            header('Location:../debitor_reg.php');
            exit();

        }



    } catch (Exception $e) {

        echo 'Message: ' . $e->getMessage();

    }
}

