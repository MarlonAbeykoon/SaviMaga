<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Savimaga</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="../assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
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
</head>


<body class="fix-header fix-sidebar card-no-border">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ==========================header==================================== -->
    <?php include 'header.php'; ?>
    <!-- ==========================header finish==================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <div class="col-md-6 col-4 align-self-center">

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Total Payment</h4>
                            <div class="text-right">
                                <?php
                                date_default_timezone_set("Asia/Colombo");
                                $first_day_of_the_week = 'Sunday';
                                $start_of_the_week = strtotime("Last $first_day_of_the_week");
                                if (strtolower(date('l')) === strtolower($first_day_of_the_week)) {
                                    $start_of_the_week = strtotime('today');
                                }
                                $end_of_the_week = $start_of_the_week + (60 * 60 * 24 * 7) - 1;
                                $date_format = 'Y-m-d H:i:s';
                                // This prints out Sunday 7th of December 2014 12:00:00 AM
                                // See PHP: date - Manual
                                // for ways to format the date
                                $sweek = date($date_format, $start_of_the_week);
                                // This prints out Saturday 13th of December 2014 11:59:59 PM
                                $eweek = date($date_format, $end_of_the_week);

                                $today = date("Y-m-d");
                                $month = date("Y-m-");
                                $year = date("Y-");

                                $todayProfit = 0;
                                $weekProfit = 0;
                                $monthProfit =0;
                                $yearProfit =0;

                                //                           ------------------------- total payment query------------------------------
                                $sql = mysqli_query($con, "select b.TotalAmount, c.total_paid_amount, b.InterestRate, b.Days from 
`user` a
inner join
(select idUser_Details from user_details where idUser_Details =  $user_de) d
on a.User_Details_idUser_Details = d.idUser_Details
left OUTER join
credit_invoice b
on a.idUser = b.user_idUser
left outer join
(select User_idUser, sum(Amount) as total_paid_amount from 
invoice_payments group by User_idUser) c
on a.idUser = c.User_idUser ");
                                while ($res = mysqli_fetch_array($sql)) {
                                    $totalAmount = $res['TotalAmount'];
                                    $totalPaidAmount = $res['total_paid_amount'];
                                    $InterestRate = $res['InterestRate'];
                                    $paymentPlan = $res['Days'];
                                }

                                //                           -------------------------Remaining Days------------------------------
                                $sql = mysqli_query($con, "select DATEDIFF(b.`DateTime`, NOW()) as remaining from 
`user` a
inner join
(select idUser_Details from user_details where idUser_Details = $user_de) d
on a.User_Details_idUser_Details = d.idUser_Details
left OUTER join
credit_invoice b
on a.idUser = b.user_idUser");
                                while ($res = mysqli_fetch_array($sql)) {
                                    $remaining = $res['remaining'];
                                }


                                //                           -------------------------total payment------------------------------


                                ?>
                                <h2 class="font-light m-b-0"><i class="ti-arrow-up text-success"></i> Rs.<?php echo round($totalPaidAmount,2); ?></h2>
                                <span class="text-muted">Total Payment</span>
                            </div>

                            <?php echo round(($totalPaidAmount/$totalAmount)*100, 2); ?>%

                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo round(($totalPaidAmount/$totalAmount)*100, 2);   ?>%; height: 6px;" aria-valuenow="<?php echo round(($totalPaidAmount/$totalAmount)*100, 2);?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Amount to be Paid</h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"><i class="ti-arrow-down text-info"></i> Rs.<?php echo round($totalAmount - $totalPaidAmount,2); ?></h2>
                                <span class="text-muted">Amount to be Paid</span>
                            </div>
                            <span class="text-info"><?php echo round((($totalAmount-$totalPaidAmount)/$totalAmount)*100, 2); ?>%</span>
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((($totalAmount-$totalPaidAmount)/$totalAmount)*100, 2); ?>%; height: 6px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="<?php echo round((($totalAmount-$totalPaidAmount)/$totalAmount)*100, 2); ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body" style="height: 80px;">
                            <h4 class="card-title">Loan Amount</h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0">Rs.<?php echo round($totalAmount,2); ?></h2>
                            </div>
                        </div>
                        <div class="card-body" style="height: 90px;">
                            <h4 class="card-title">Interest Rate</h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"><?php echo round($InterestRate,2); ?> %</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body" style="height: 80px;">
                            <h4 class="card-title">Remaining Days</h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"><?php echo $remaining; ?> days</h2>
                            </div>
                        </div>
                        <div class="card-body" style="height: 90px;">
                            <h4 class="card-title">Payment Plan</h4>
                            <div class="text-right">
                                <h2 class="font-light m-b-0"><?php echo $paymentPlan; ?> days</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
            <!-- Row -->
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex flex-wrap">
                                        <div>
                                            <h3>Payment Status</h3>
                                            <h6 class="card-subtitle"></h6> </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="ct-chart" style="height: 350px;"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row -->


        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <script src="../assets/plugins/jquery/jquery.min.js"></script>
        <?php
        include 'footer.php';
        ?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>


<script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script>
<script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<!-- Chart JS -->
<script src="../assets/plugins/echarts/echarts-all.js"></script>
<script src="../assets/plugins/toast-master/js/jquery.toast.js"></script>
<!-- Chart JS -->
<script src="js/customerDashboard.js" amntToPay = <?php echo round(($totalAmount-$totalPaidAmount), 2); ?> paidAmount = <?php echo round($totalPaidAmount,2); ?></script>
<script src="js/toastr.js"></script>

<script>
    /*    $.toast({
           heading: 'Welcome to Edebtor',
           text: '',
           position: 'top-right',
           loaderBg: '#ff6849',
           icon: 'info',
           hideAfter: 3000,
           stack: 6
       }); */
</script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>