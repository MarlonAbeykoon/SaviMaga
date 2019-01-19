<?php



session_start();




try {

    
    
if(isset($_SESSION['user_de'])){
    unset($_SESSION['user_de']);
    header('Location:../../index.php');
    exit();
}
    


} catch (Exception $e) {

    echo 'Message: ' . $e->getMessage();

}

