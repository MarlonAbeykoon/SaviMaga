<?php
include '../classes/dbcon.php';
date_default_timezone_set("Asia/Colombo");
$LastPayment;
$cid = $_POST['cid'];
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Full Payment History With Personal Details</h4>
            </div>
            <div class="card-body">
                <!--<form action="MakePayment.php" method="POST">-->
                <form id="form">
                    <div class="form-body" id="paymentFormBody">
                        <?php
                        if ($cid > 0) {


                            $sql = mysqli_query($con, "SELECT
credit_invoice.TotalAmount,
credit_invoice.GrantAmount,
credit_invoice.PenaltyPaid,
credit_invoice.DateTime,
debitors.Fname,
debitors.Address1,
debitors.Address2,
debitors.Address1,
debitors.Address2,
debitors.Pno1,
debitors.Pno2,
credit_invoice.idCredit_Invoice,
credit_invoice.DailyEqualPayment,
credit_invoice.PaidAmount,
credit_invoice.InterestRate,
credit_invoice.Days,
debitors.NIC,
debitors.Lname,
collectionarea.CollectionArea
FROM
credit_invoice
INNER JOIN debitors ON credit_invoice.Debitors_idDebitors = debitors.idDebitors
INNER JOIN collectionarea ON credit_invoice.CollectionArea_idCollectionArea = collectionarea.idCollectionArea
WHERE
                        credit_invoice.idCredit_Invoice = $cid
                        ");
                            while ($results = mysqli_fetch_array($sql)) {

                                $interestForDay = ($results['TotalAmount'] - $results['GrantAmount']) / $results['Days'];

                                $sql2 = mysqli_query($con, "SELECT * FROM
                        invoice_payments
                        WHERE
                        invoice_payments.Credit_Invoice_idCredit_Invoice = $cid
                        Order by invoice_payments.DateTime Desc limit 1
                        ");
                                $diff;
                                $new = true;
                                while ($result = mysqli_fetch_array($sql2)) {
                                    $new = false;
                                    $LastPayment = $result['DateTime'];
                                    $lastDateOnly = explode(" ", $LastPayment);
                                    $today = date("Y-m-d");
                                    $datetime1 = date_create($lastDateOnly[0]);
                                    $datetime2 = date_create($today);
                                    $interval = date_diff($datetime1, $datetime2);
                                    //echo $interval->format('%R%a days');
                                    $diff = $interval->format('%a');
                                }
                                if ($new) {
                                    $LastPayment = $results['DateTime'];
                                    $today = date("Y-m-d");
                                    $datetime1 = date_create($LastPayment);
                                    $datetime2 = date_create($today);
                                    $interval = date_diff($datetime1, $datetime2);
                                    ////echo $interval->format('%R%a days');
                                    $diff = $interval->format('%a');
                                    //            $diff =5 ;
                                }

                                $interestForPenalty = 0;
                                ?>

                                <!--<h3 class="card-title">Full Payment History With Personal Details</h3>-->
                                <hr>
                                <h3 class="card-title">Customer Info</h3>
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" id="cid" value="<?php echo $cid; ?>" />
                                            <input type="hidden" id="uid" value="<?php echo $user_de; ?>" />
                                            <label class="control-label">Full Name</label>
                                            <input type="text" id="firstName" class="form-control" placeholder="" readonly value="<?php echo $results['Fname'] . " " . $results['Lname']; ?>">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">NIC</label>
                                            <input type="text" id="lastName" class="form-control" placeholder="" readonly value="<?php echo $results['NIC'] ?>">
                                        </div>
                                        <!--/span-->
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Address 1</label>
                                            <input type="text" id="firstName" class="form-control" placeholder="" readonly value="<?php echo $results['Address1'] ?>">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Address 2</label>
                                            <input type="text" id="lastName" class="form-control" placeholder="" readonly value="<?php echo $results['Address2'] ?>">
                                        </div>
                                        <!--/span-->
                                    </div>
                                </div>
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Loan Location</label>
                                            <input type="text" id="Location" class="form-control" placeholder="" readonly value="<?php echo $results['CollectionArea'] ?>">
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <!--/row-->
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone No 1</label>
                                            <input type="text" id="firstName" class="form-control" placeholder="" readonly value="<?php echo $results['Pno1'] ?>">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone No 2</label>
                                            <input type="text" id="lastName" class="form-control" placeholder="" readonly value="<?php echo $results['Pno2'] ?>">
                                        </div>
                                        <!--/span-->
                                    </div>
                                </div>

                                <!--/row-->
                                <!--guarantor-->
                                <h3 class="card-title">Guarantors Info</h3>
                                <hr>
                                <?php
                                $gsql = mysqli_query($con, "SELECT
guarantor.Fname,
guarantor.Lname,
guarantor.PhoneNo1,
guarantor.PhoneNo2,
guarantor.Address1,
guarantor.Address2,
guarantor.Nic,
guarantor.`Status`
FROM
guarantor
WHERE
guarantor.credit_invoice_idCredit_Invoice = $cid");
                                $count = 0;
                                while ($res = mysqli_fetch_array($gsql)) {
                                    $count++;
                                    ?>
                                    <h5 class="card-title"><?php
                                        if ($count == 1) {
                                            echo 'First';
                                        } else {
                                            echo 'Second';
                                        }
                                        ?> Guarantor Info</h5>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Full Name</label>
                                                <input type="text" class="form-control" placeholder="" readonly value="<?php echo $res['Fname'] . " " . $res['Lname']; ?>">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">NIC</label>
                                                <input type="text" class="form-control" placeholder="" readonly value="<?php echo $res['Nic'] ?>">
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Address 1</label>
                                                <input type="text" class="form-control" placeholder="" readonly value="<?php echo $res['Address1'] ?>">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Address 2</label>
                                                <input type="text" class="form-control" placeholder="" readonly value="<?php echo $res['Address2'] ?>">
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Loan Location</label>
                                                <input type="text" id="Location" class="form-control" placeholder="" readonly value="<?php echo $results['CollectionArea'] ?>">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone No 1</label>
                                                <input type="text"  class="form-control" placeholder="" readonly value="<?php echo $res['PhoneNo1'] ?>">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone No 2</label>
                                                <input type="text" class="form-control" placeholder="" readonly value="<?php echo $res['PhoneNo2'] ?>">
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
        <?php } ?>
                                <!--guarantor-->

                                <!--/row-->
                                <h3 class="card-title">Payment Info</h3>
                                <hr>
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Granted Amount</label>
                                            <input type="text" id="GrantAmount" name="GrantAmount" class="form-control" placeholder="" readonly value="<?php echo $results['GrantAmount'] ?>">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Total Granted Amount with Interest <?php echo $results['InterestRate']; ?>%</label>
                                            <input type="text" id="totwithin" name="totwithin" class="form-control" placeholder="" readonly value="<?php echo $results['TotalAmount'] ?>">
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Days</label>
                                            <input type="text" id="days" name="days" class="form-control" placeholder="" readonly value="<?php echo $results['Days'] ?>">
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Repaid Amount</label>
                                            <input type="text" id="SettledAmount" name="SettledAmount" class="form-control" placeholder="" readonly value="<?php echo $results['PaidAmount'] ?>">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Additional Interest Amount Paid for delayed Payments</label>
                                            <input type="text" id="penalty" name="penalty" class="form-control" placeholder="" readonly value="<?php echo $results['PenaltyPaid'] ?>">
                                        </div>

                                        <!--/span-->
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Daily Equal Payment</label>
                                            <input type="text" id="dailyPay" name="dailyPay" class="form-control" placeholder="" readonly value="<?php echo $results['DailyEqualPayment'] ?>">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Last Payment Date</label>
                                            <input type="text" id="Ldate" name="Ldate" class="form-control" placeholder="" readonly value="<?php echo $LastPayment ?>">
                                        </div>

                                        <!--/span-->
                                    </div>
                                </div>
                                <!--/row-->

                                <?php
                            }
                        }
                        ?>                  
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Payment History</h4>
            <div class="table-responsive"style=" height:400px; overflow-y:scroll;">
                <table class="table full-color-table full-warning-table hover-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Add.Amount</th>
                        </tr>
                    </thead>
                    <tbody id="PaymentHistory">
                        <?php
                        $sql = mysqli_query($con, "SELECT *
FROM
invoice_payments
WHERE
invoice_payments.Credit_Invoice_idCredit_Invoice = $cid Order by invoice_payments.DateTime Desc");
                        $count = 1;
                        while ($results = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td><?php echo $count++ ?></td>
                                <td><?php echo $results['DateTime']; ?></td>
                                <td>Rs:<?php echo $results['Amount']; ?></td>
                                <td>Rs:<?php echo $results['AdditionalAmount']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
