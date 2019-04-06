<!DOCTYPE html>
<html lang="en" >

<?php
session_start();
include_once 'main/classes/dbcon.php';


require_once 'main/classes/login.php';
$login_f = new login_function();



if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];

$result = $login_f -> login($username,$password);

if($result == "true"){
  header('Location: main');
}

}

?>



<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  
  <link rel='stylesheet prefetch' href='assets/plugins/bootstrap/css/bootstrap.min.css'>

      <link rel="stylesheet" href="login/css/style.css?v=1">

  
</head>

<body>


<div style="
    background: -webkit-linear-gradient(top , rgba(1, 21, 20, 0.8) 54% , rgba(17, 81, 76, 0.8) 95%);
    height: -webkit-fill-available;
    position: absolute;
    width: 100%;
    height: 100%;
    margin: 0;
">

    <div class="wrapper">
    <form class="form-signin" action=""  method="post">       
      <!-- <h2 class="form-signin-heading">Please login</h2> -->
      <div class="logo">
                          <img src="login/img/login_logo.jpg" alt="" style="max-width: 100%;">
                        </div>
      <input type="text" class="form-control" name="username" placeholder="Email Address" required autofocus />
      <br>
      <input type="password" class="form-control" name="password" placeholder="Password" required/>      
      <label class="checkbox">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>   
    </form>
  </div>
  
  </div>

</body>

</html>
