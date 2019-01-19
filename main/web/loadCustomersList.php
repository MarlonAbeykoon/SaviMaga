<?php
include '../classes/dbcon.php';
date_default_timezone_set("Asia/Colombo");
$uid = $_POST['uid'];
$sql = mysqli_query($con, "SELECT
collection_area_user.CollectionArea_idCollectionArea,
credit_invoice.TotalAmount,
credit_invoice.GrantAmount,
debitors.Fname,
debitors.Lname,
debitors.Address1,
debitors.Address2,
credit_invoice.idCredit_Invoice
FROM
credit_invoice
INNER JOIN collection_area_user ON credit_invoice.CollectionArea_idCollectionArea = collection_area_user.CollectionArea_idCollectionArea
INNER JOIN debitors ON credit_invoice.Debitors_idDebitors = debitors.idDebitors
WHERE
collection_area_user.User_idUser = $uid AND
credit_invoice.Settled = 0 AND
credit_invoice.`Status` = 1
ORDER BY
credit_invoice.Debitors_idDebitors ASC");
$count = 1;
while ($result = mysqli_fetch_array($sql)) {

    $cid = $result['idCredit_Invoice'];

    $sql2 = mysqli_query($con, "SELECT * FROM
invoice_payments
WHERE
invoice_payments.Credit_Invoice_idCredit_Invoice = $cid
Order by invoice_payments.DateTime Desc limit 1
");
    $diff = 1;
    $new = true;
    while ($results = mysqli_fetch_array($sql2)) {
        $new = false;
        $payForDays = ($results['PayFor'] - 1);
        $LastPayment = $results['DateTime'];
        $lastDateOnly = explode(" ", $LastPayment);
        $today = date("Y-m-d");
        $datetime1 = date_create($lastDateOnly[0]);

        $datetime1->modify("+" . $payForDays . " days");

        $datetime2 = date_create($today);
        $interval = date_diff($datetime1, $datetime2);
//echo $interval->format('%R%a days');
        $diff = $interval->format('%R%a');
    }
    ?>
    <tr <?php if ($diff <= 0) { ?>style="background-color: lightgreen;" <?php } ?>onclick="loadPaymentInfo(<?php echo $result['idCredit_Invoice']; ?>)">
        <td><?php echo $count++; ?><input type="hidden" name="cid" value="<?php echo $result['idCredit_Invoice']; ?>" /></td>
        <td><?php echo $result['Fname'] . " " . $result['Lname'] ?></td>
        <td><?php echo $result['Address1'] . " " . $result['Address2']; ?></td>
    </tr>
<?php } ?>

