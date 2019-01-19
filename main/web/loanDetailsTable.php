
<?php
include '../classes/dbcon.php';
$search = $_GET['search'];
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>NIC</th>
            <th>Name</th>
            <th>Repay Amount</th>
            <th>Paid</th>
            <th>Progress</th>
            <th>Deadline</th>
            <th class="text-nowrap">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = mysqli_query($con, "SELECT
                                                            debitors.NIC,
                                                            debitors.Fname,
                                                            credit_invoice.idCredit_Invoice,
                                                            credit_invoice.TotalAmount,
                                                            credit_invoice.PaidAmount,
                                                            credit_invoice.DailyEqualPayment,
                                                            credit_invoice.Days,
                                                            credit_invoice.DateTime,
                                                            credit_invoice.InterestRate,
                                                            credit_invoice.Status,
                                                            credit_invoice.Settled
                                                            FROM
                                                            credit_invoice
                                                            INNER JOIN debitors ON credit_invoice.Debitors_idDebitors = debitors.idDebitors
                                                            WHERE
                                                            debitors.NIC LIKE '%" . $search . "%' OR
                                                             debitors.Fname Like '%" . $search . "%'
                                                            LIMIT 100");

        while ($result = mysqli_fetch_array($sql)) {
            $date = new DateTime($result['DateTime']);
            $date->modify("+" . $result['Days'] . " days");
            ?>
            <tr onclick="loadPaymentInfo(<?php echo $result['idCredit_Invoice']; ?>)">
                <td><?php echo $result['NIC']; ?></td>
                <td><?php echo $result['Fname']; ?></td>
                <td><?php echo $result['TotalAmount']; ?></td>
                <td><?php echo $result['PaidAmount']; ?></td>
                <td>
                    <div class="progress progress-xs margin-vertical-10 ">
                        <?php
                        $ccid = $result['idCredit_Invoice'];
                        $sql2 = mysqli_query($con, "SELECT * FROM
invoice_payments
WHERE
invoice_payments.Credit_Invoice_idCredit_Invoice = $ccid
Order by invoice_payments.DateTime Desc limit 1
");

                        $diff = 9999;

                        while ($results = mysqli_fetch_array($sql2)) {
                            $LastPayment = $results['DateTime'];
                            $lastDateOnly = explode(" ", $LastPayment);
                            $datetime1 = date_create($lastDateOnly[0]);

                            $interval = date_diff($date, $datetime1);
                            $diff = $interval->format('%R%a');
                        }
                        if ($diff == 9999) {
                            $today = date("Y-m-d");
                            $datetime1 = date_create($today);
                            $interval = date_diff($date, $datetime1);
                            $diff = $interval->format('%R%a');
                        }
//                                                                                echo $diff;
                        ?>
                        <div 
                        <?php
                        if ($diff <= 0 && $result['Settled'] == 1) {
                            echo 'class="progress-bar bg-success"';
                        } else if ($diff > 0 && $result['Settled'] == 1) {
                            echo 'class="progress-bar bg-purple"';
                        } else if ($diff < 0 && $result['Settled'] == 0) {
                            echo 'class="progress-bar bg-info"';
                        } else {
                            echo 'class="progress-bar bg-danger"';
                        }
                        ?>
                            style="width: <?php echo (($result['PaidAmount'] / $result['TotalAmount']) * 100); ?>% ;height:6px;"></div>
                    </div>
                </td>
                <td><?php echo $date->format("Y-m-d"); ?></td>
                <td class="text-nowrap">
                    <?php
                    if ($result['Status'] == 0) {
                        echo 'Pending Approval';
                    } else if ($result['Status'] == 1 && $result['Settled'] == 0) {
                        echo 'Ongoing';
                    } else if ($result['Settled'] == 1) {
                        echo 'Completed';
                    } else if ($result['Status'] == 3) {
                        echo 'Rejected';
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>
