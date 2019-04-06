<?php
session_start();
if(!isset($_SESSION['user_de'])){
    header('Location:../index.php');
    exit();
}
$user_de=$_SESSION['user_de'];
$user_type=$_SESSION['user_type'];
?>
<header class="topbar">
    <input type="hidden" name="huserid" id="huserid" value="<?php echo $user_de; ?>" readonly="readonly" />
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="http://g5.creditlanka.com/main/">
                <!-- Logo icon -->
                <b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span>
                    <!-- dark Logo text -->
                    <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                    <!-- Light Logo text -->    
                    <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0 ">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->
                <!--                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                    </a>
                                    <div class="dropdown-menu mailbox animated bounceInDown">
                                        <ul>
                                            <li>
                                                <div class="drop-title">Notifications</div>
                                            </li>
                                            <li>
                                                <div class="message-center">
                                                     Message 
                                                    <a href="#">
                                                        <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                        <div class="mail-contnet">
                                                            <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                                    </a>
                                                     Message 
                                                    <a href="#">
                                                        <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                                        <div class="mail-contnet">
                                                            <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                                    </a>
                                                     Message 
                                                    <a href="#">
                                                        <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                        <div class="mail-contnet">
                                                            <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                                    </a>
                                                     Message 
                                                    <a href="#">
                                                        <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                        <div class="mail-contnet">
                                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>-->
                <!-- ============================================================== -->
                <!-- End Comment -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->
                <!--                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                    </a>
                                    <div class="dropdown-menu mailbox animated bounceInDown" aria-labelledby="2">
                                        <ul>
                                            <li>
                                                <div class="drop-title">You have 4 new messages</div>
                                            </li>
                                            <li>
                                                <div class="message-center">
                                                     Message 
                                                    <a href="#">
                                                        <div class="user-img"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                        <div class="mail-contnet">
                                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                                    </a>
                                                     Message 
                                                    <a href="#">
                                                        <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                        <div class="mail-contnet">
                                                            <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                                    </a>
                                                     Message 
                                                    <a href="#">
                                                        <div class="user-img"> <img src="../assets/images/users/3.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                                        <div class="mail-contnet">
                                                            <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                                    </a>
                                                     Message 
                                                    <a href="#">
                                                        <div class="user-img"> <img src="../assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                                        <div class="mail-contnet">
                                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>-->
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <?php
            include 'classes/dbcon.php';
            $utype;
            $pname;
            $sql = mysqli_query($con, "SELECT
user_details.Fname,
user_details.Lname,
`user`.User_Type_idUser_Type
FROM
`user`
INNER JOIN user_details ON `user`.User_Details_idUser_Details = user_details.idUser_Details
WHERE user.idUser = $user_de");
            while ($result = mysqli_fetch_array($sql)) {
                $utype = $result['User_Type_idUser_Type'];
                $pname = $result['Fname']." ".$result['Lname'];
            }
            ?>
            <ul class="navbar-nav my-lg-0">
                <!-- <li class="nav-item hidden-sm-down">
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search for..."> <a class="srh-btn"><i class="ti-search"></i></a> </form>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="../assets/images/users/1.jpg" alt="user"></div>
                                    <div class="u-text">
                                        <h4><?php echo $pname; ?></h4>
                                        <p class="text-muted"></p><a href="http://g5.creditlanka.com/main/" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
<!--                            <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>-->
                            <li><a href="Controller/logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->

        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- <li class="nav-small-cap">PERSONAL</li> -->

<?php if ($user_type == "customer" ) { ?>
    <li>
                    <a class="" href="customer.php" aria-expanded="false"><i class="mdi mdi-gauge"></i>My Profile </a>
                </li>
    <?php }else{ ?>

                <li>
                    <a class="" href="index.php" aria-expanded="false"><i class="mdi mdi-gauge"></i>Dashboard </a>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Customer</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="debitor_reg.php">New Customer</a></li>
                        <li><a href="debitor_manage.php">Customer Manage</a></li>

                    </ul>
                </li>
                <?php if ($utype == 1 || $utype == 2) { ?>
                    <li>
                        <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Users </span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="user_reg.php">New Users</a></li>
                            <li><a href="user_manage.php">User Manage</a></li>

                        </ul>
                    </li>
                <?php } ?>
                <?php if ($utype == 1 || $utype == 2) { ?>
                    <li>
                        <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-book-multiple"></i><span class="hide-menu">Collection Areas</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="CollectAreas.php">Assign Area</a></li>
                            <li><a href="ManageAreas.php">Manage Area</a></li>
                        </ul>
                    </li> 
                <?php } ?>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Loan</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="CreditInvoice.php">Apply Loan</a></li>
                        <li><a href="CreditInvoice_Details.php">Loan Details</a></li>
                        <?php if ($utype == 1 || $utype == 2) { ?>
                            <li><a href="CreditInvoice_Approve.php">Approve Loan</a></li>
                        <?php } ?>
                    </ul>
                </li>                  
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-cart"></i><span class="hide-menu">Payments</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="MakePayment.php">Make Payment</a></li>
                        <li><a href="CreditInvoice_Details.php">Paid History</a></li>

                    </ul>
                </li>   
                <!-- <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Expenses</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="AddExpenses.php">Add Expenses</a></li>
                        <li><a href="ManageExpenses.php">Manage Expenses</a></li>

                    </ul>
                </li>  -->
                <?php if ($utype == 1 || $utype == 2) { ?>
                    <li>
                        <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Reports</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="Report_CollectedAmount.php">Collected Amounts</a></li>
                            <li><a href="Report_PaymentHistory.php">Payment History / Live Feed</a></li>

                        </ul>
                    </li> 
                <?php } ?>
                <?php if ($utype == 1 || $utype == 2|| $utype == 3) { ?>
                    <li>
                        <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Search</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="MainSearch.php">Search</a></li>

                        </ul>
                    </li>
                <?php } ?>


                 <?php } ?>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <!--    <div class="sidebar-footer">
             item
            <a href="#" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
             item
            <a href="#" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
             item
            <a href="#" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
        </div>-->
    <!-- End Bottom points-->
</aside>