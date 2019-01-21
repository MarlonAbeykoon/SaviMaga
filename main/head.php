<?php
session_start();



if(!isset($_SESSION['user_de'])){
    header('Location:../index.php');
    exit();
}

// if ($_SESSION['user_de'] + 10 * 60 < time()) {
//     unset($_SESSION['user_de']);
//     header('Location:../index.php');
//     exit();
//  }


include_once 'classes/dbcon.php';


require_once 'classes/control.php';
$cf = new control_functions();

$user_de=$_SESSION['user_de'];

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>eDebtor</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="../assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="../assets/plugins/wizard/steps.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">

    
    
    <link rel="stylesheet" href="css/bootstrapValidator.css"/>
    <style>
        .success {
            color: #000;
            background-color: #f4fcf0;
        }
        .error {
            color: #c44f4f;
        }

        .form-group .error {
            margin-bottom:0px;
        }

        .error.valid {
            color:rgb(103, 139, 112);
        }        
    </style>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
   
   

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    
<![endif]-->
    <script>
//    (function(i, s, o, g, r, a, m) {
//        i['GoogleAnalyticsObject'] = r;
//        i[r] = i[r] || function() {
//            (i[r].q = i[r].q || []).push(arguments)
//        }, i[r].l = 1 * new Date();
//        a = s.createElement(o), m = s.getElementsByTagName(o)[0];
//        a.async = 1;
//        a.src = g;
//        m.parentNode.insertBefore(a, m)
//    })(window, document, 'script', '../../../../../www.google-analytics.com/analytics.js', 'ga');
//    ga('create', 'UA-85622565-1', 'auto');
//    ga('send', 'pageview');
    </script>

    <!--<script src="../assets/plugins/jquery/jquery.min.js"></script>-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../assets/plugins/jq-validation/1.19.0/jquery.validate.min.js"></script>


	</head>
