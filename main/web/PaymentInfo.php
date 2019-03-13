<?php
date_default_timezone_set("Asia/Colombo");
include '../classes/dbcon.php';

$cid = $_POST['cid'];
$LastPayment;
if ($cid > 0) {


    $sql = mysqli_query($con, "SELECT
credit_invoice.TotalAmount,
credit_invoice.GrantAmount,
credit_invoice.PenaltyPaid,
credit_invoice.DateTime,
debitors.Fname,
debitors.Lname,
debitors.Address1,
debitors.Address2,
credit_invoice.idCredit_Invoice,
credit_invoice.DailyEqualPayment,
credit_invoice.PaidAmount,
credit_invoice.InterestRate,
credit_invoice.Days,
credit_invoice.type,
debitors.NIC,
debitors.Lname
FROM
credit_invoice
INNER JOIN debitors ON credit_invoice.Debitors_idDebitors = debitors.idDebitors
WHERE
credit_invoice.Settled = 0 AND
credit_invoice.`Status` = 1 AND
credit_invoice.idCredit_Invoice = $cid
");
    while ($results = mysqli_fetch_array($sql)) {
        $payment_type = $result['type'];
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
        
        if($payment_type='Daily'){
            $payment_cat ='Days';
            $diff_qty=1;
        }else if($payment_type='Weekly'){
            $payment_cat ='Weeks';
            $diff_qty=1;
        }else if($payment_type='Monthly'){
            $payment_cat ='Months';
            $diff_qty=30;
        }

        $diff_count = ($diff - 1)/$diff_qty;
        if ($diff >= 1) {

            


           // $interestForPenalty = $interestForDay * ($diff - 1);
            $interestForPenalty = $interestForDay * $diff_count;
            ?>
            <div class="alert alert-danger alert-rounded"> <?php echo $diff_count; ?> <?php echo $payment_cat; ?> of Payments Didn't Make On time. Please Check Payment History.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
        <?php } ?>
        <h3 class="card-title">Person Info</h3>
        <hr>
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

        <!--/row-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Paying For</label>
                    <select class="form-control custom-select" id="payFor" name="payFor" onchange="CalculatePayment();">
                    <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                        <option value="0">Full Amount</option>
                    </select>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Sub Total</label>
                    <input type="text" class="form-control" placeholder="" readonly value="<?php echo $results['DailyEqualPayment'] ?>" id="subTot" name="subTot">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Additional Interest Amount for delayed Payment of <?php echo $diff_count; ?> <?php echo $payment_cat; ?></label>
                    <input type="text" id="addAmount" name="addAmount" class="form-control" placeholder="" value="<?php echo number_format($interestForPenalty, 2); ?>" oninput="CalculatePayment();">
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Total Amount</label>
                    <input type="text" id="totAmount" name="totAmount" class="form-control" placeholder="" readonly value="<?php echo (  number_format($results['DailyEqualPayment'] + $interestForPenalty, 2)) ?>">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row" hidden>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Paid Amount</label>
                    <input type="text" id="paidAmount"  name="paidAmount" class="form-control" placeholder="" value="0" oninput="CalculatePayment();">
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="control-label">Balance</label>
                    <input type="text" id="balance" name="balance" class="form-control" placeholder="" readonly>
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->

        <?php
    }
} else {
    ?>   
    <h3 class="card-title">Person Info</h3>
    <hr>
    <div class="row p-t-20">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Full Name</label>
                <input type="text" id="firstName" class="form-control" placeholder="" readonly>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">NIC</label>
                <input type="text" id="lastName" class="form-control" placeholder="" readonly>
            </div>
            <!--/span-->
        </div>
    </div>
    <!--/row-->
    <div class="row p-t-20">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Address 1</label>
                <input type="text" id="firstName" class="form-control" placeholder="" readonly>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Address 2</label>
                <input type="text" id="lastName" class="form-control" placeholder="" readonly>
            </div>
            <!--/span-->
        </div>
    </div>
    <!--/row-->
    <h3 class="card-title">Payment Info</h3>
    <hr>
    <div class="row p-t-20">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Daily Payment Amount</label>
                <input type="text" id="dailyPay" class="form-control" placeholder="" readonly name="dailyPay">
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Last Payment Date</label>
                <input type="date" id="LastDate" class="form-control" placeholder="" readonly name="LastDate">
            </div>

            <!--/span-->
        </div>
    </div>
    <!--/row-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Paying For</label>
                <select class="form-control custom-select" id="payFor" >
                    <option value="1">1Day</option>
                    <option value="2">2Day</option>
                    <option value="3">3Day</option>
                    <option value="4">4Day</option>
                    <option value="5">5Day</option>
                    <option value="6">6Day</option>
                    <option value="7">7Day</option>
                    <option value="0">Full Amount</option>
                </select>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Sub Total</label>
                <input type="text" class="form-control" placeholder="" readonly id="subTot">
            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Additional Interest Amount for delayed Payment</label>
                <input type="text" id="dpay" class="form-control" placeholder="">
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Total Amount</label>
                <input type="text" id="dpay" class="form-control" placeholder="" readonly>
            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Paid Amount</label>
                <input type="text" id="dpay" class="form-control" placeholder="">
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Balance</label>
                <input type="text" id="dpay" class="form-control" placeholder="" readonly>
            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->

<?php } ?>                                  