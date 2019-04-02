<!DOCTYPE html>
<html lang="en">


    <!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
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

<script src="js/chart/highcharts.js"></script>
<script src="js/chart/modules/exporting.js"></script>
<script src="js/chart/modules/export-data.js"></script>
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

                                    <h4 class="card-title">Daily Collect</h4>
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
                                        
//                           -------------------------today income------------------------------
                                        $sql = mysqli_query($con, "SELECT
SUM(invoice_payments.Amount+invoice_payments.AdditionalAmount) as amount
FROM
invoice_payments
WHERE
invoice_payments.DateTime like '$today%'");
                                        while ($res = mysqli_fetch_array($sql)) {
                                            $todayProfit = $res['amount'];
                                        }
                                        
//                           -------------------------today income------------------------------
                                        
//                           -------------------------weekly income------------------------------                                        
                                        $sql = mysqli_query($con, "SELECT
SUM(invoice_payments.Amount+invoice_payments.AdditionalAmount) as amount
FROM
invoice_payments
WHERE
invoice_payments.DateTime BETWEEN '$sweek' AND '$eweek'");
                                        
                                        while ($res = mysqli_fetch_array($sql)) {
                                            $weekProfit = $res['amount'];
                                        }
                                        
//                           -------------------------weekly income------------------------------                                         

//                           -------------------------monthly income------------------------------                                          
                                        $sql = mysqli_query($con, "SELECT
SUM(invoice_payments.Amount+invoice_payments.AdditionalAmount) as amount
FROM
invoice_payments
WHERE
invoice_payments.DateTime like '$month%'");
                                        while ($res = mysqli_fetch_array($sql)) {
                                            $monthProfit = $res['amount'];
                                        }
                                        
//                           -------------------------monthly income------------------------------ 
                                        
//                           -------------------------yearly income------------------------------                                         
                                        $sql = mysqli_query($con, "SELECT
SUM(invoice_payments.Amount+invoice_payments.AdditionalAmount) as amount
FROM
invoice_payments
WHERE
invoice_payments.DateTime like '$year%'");
                                        while ($res = mysqli_fetch_array($sql)) {
                                            $yearProfit = $res['amount'];
                                        }
                                        
//                           -------------------------yearly income------------------------------                                         
                                        ?>
                                        <h2 class="font-light m-b-0"><i class="ti-arrow-up text-success"></i> Rs.<?php echo round($todayProfit,2); ?></h2>
                                        <span class="text-muted">Todays Income</span>
                                    </div>
                                  <!--   <span class="text-success"><?php echo round(($todayProfit/$weekProfit)*100,2); ?>%</span> -->

                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php  ?>%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Weekly Collect</h4>
                                    <div class="text-right">
                                        <h2 class="font-light m-b-0"><i class="ti-arrow-up text-info"></i> Rs.<?php echo round($weekProfit,2); ?></h2>
                                        <span class="text-muted">Weekly Income</span>
                                    </div>
                                    <span class="text-info"><?php echo round(($weekProfit/$monthProfit)*100,2); ?>%</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round(($weekProfit/$monthProfit)*100,2); ?>%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Monthly Collect</h4>
                                    <div class="text-right">
                                        <h2 class="font-light m-b-0"><i class="ti-arrow-up text-purple"></i> Rs.<?php echo round($monthProfit,2); ?></h2>
                                        <span class="text-muted">Monthly Income</span>
                                    </div>
                                    <span class="text-purple"><?php echo round(($monthProfit/$yearProfit)*100,2); ?>%</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-purple" role="progressbar" style="width: <?php echo ($monthProfit/$yearProfit)*100; ?>%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Yearly Collect</h4>
                                    <div class="text-right">
                                        <h2 class="font-light m-b-0"><i class="ti-arrow-up text-danger"></i> Rs.<?php echo round($yearProfit,2); ?></h2>
                                        <span class="text-muted">Todays Income</span>
                                    </div>
                                    <span class="text-danger">100%</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                                        <!-- <div class="col-12">
                                            <div class="d-flex flex-wrap">
                                                <div>
                                                    <h3>Revenue Statistics</h3>
                                                    <h6 class="card-subtitle">2018</h6> </div>
                                                <div class="ml-auto ">
                                                    <ul class="list-inline">
                                                        <li>
                                                            <h6 class="text-muted"><i class="fa fa-circle m-r-5 text-success"></i>Product A</h6> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-12">
                                            <div class="total-revenue4" style="height: 350px;"></div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 m-b-30 m-t-20 text-center">
                                            <h1 class="m-b-0 font-light">---</h1>
                                            <h6 class="text-muted">Total Revenue</h6></div>
                                        <div class="col-lg-3 col-md-6 m-b-30 m-t-20 text-center">
                                            <h1 class="m-b-0 font-light">---</h1>
                                            <h6 class="text-muted">Online Revenue</h6></div>
                                        <div class="col-lg-3 col-md-6 m-b-30 m-t-20 text-center">
                                            <h1 class="m-b-0 font-light">---</h1>
                                            <h6 class="text-muted">Product A</h6></div>
                                        <div class="col-lg-3 col-md-6 m-b-30 m-t-20 text-center">
                                            <h1 class="m-b-0 font-light">---</h1>
                                            <h6 class="text-muted">Product B</h6></div> -->

<?php
$query ="SELECT GROUP_CONCAT(t1.Amounts) AS amount,GROUP_CONCAT( `date`) AS date_de FROM
(SELECT  CONCAT('{name:\"', ud.`Fname`, '\", data:[',GROUP_CONCAT(i.Amount),']}') AS Amounts , CONCAT('[', DATE_FORMAT(i.`DateTime`, '%Y/%m/%d'), ']')   AS `date` 
FROM `invoice_payments` i LEFT JOIN `user` u ON i.`User_idUser`= u.`idUser`  LEFT JOIN `user_details` ud ON u.`User_Details_idUser_Details` = ud.`idUser_Details` 
 GROUP BY i.`User_idUser`) t1";

 $sql_chart = mysqli_query($con, $query);
                                         while ($res_chart = mysqli_fetch_array($sql_chart)) {
                                           /*  $amount = $res_chart['amount'];
                                            $date_de = $res_chart['date_de']; */


                                            $amount = "{
                                                name: 'Aruni Perera',
                                                data: [3, 4, 3, 5, 4, 10, 12]
                                            }, {
                                                name: 'Bathiya Wisidagama',
                                                data: [1, 3, 4, 3, 3, 5, 4]
                                            }, {
                                                name: 'Kushan Samarasinha',
                                                data: [5, 3, 6, 2, 1, 1, 2]
                                            }";


                                            $date_de = "[
            '2019-03-27',
            '2019-03-28',
            '2019-03-29',
            '2019-03-30',
            '2019-03-31',
            '2019-04-01',
            '2019-04-02'
        ]";
                                         }

?>

                                            <div class="col-12">
                                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                                            <script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: 'Last 30 Days Collect'
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 150,
        y: 100,
        floating: true,
        borderWidth: 1,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    xAxis: {
        categories: <?php echo $date_de; ?>
    },
    yAxis: {
        title: {
            text: 'Collect'
        }
    },
    tooltip: {
        shared: true,
        valueSuffix: ' Collect'
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        areaspline: {
            fillOpacity: 0.5
        }
    },
    series: [<?php echo $amount; ?>]
});
		</script>
                                            
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


        <!-- <script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script>
        <script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script> -->
        <!-- Chart JS -->
        <!-- <script src="../assets/plugins/echarts/echarts-all.js"></script>
        <script src="../assets/plugins/toast-master/js/jquery.toast.js"></script> -->
        <!-- Chart JS -->
        <!-- <script src="js/dashboard1.js"></script>
        <script src="js/toastr.js"></script> -->

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


    <!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:49 GMT -->
</html>