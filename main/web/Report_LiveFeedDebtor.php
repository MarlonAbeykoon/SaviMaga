<?php
date_default_timezone_set("Asia/Colombo");
include '../classes/dbcon.php';
$cid = $_POST['cid'];

$sql = mysqli_query($con, "SELECT
collection_area_user.CollectionArea_idCollectionArea,
credit_invoice.TotalAmount,
credit_invoice.GrantAmount,
credit_invoice.idCredit_Invoice,
debitors.Fname,
debitors.Address1,
debitors.Address2
FROM
credit_invoice
INNER JOIN collection_area_user ON credit_invoice.CollectionArea_idCollectionArea = collection_area_user.CollectionArea_idCollectionArea
INNER JOIN debitors ON credit_invoice.Debitors_idDebitors = debitors.idDebitors
WHERE
collection_area_user.User_idUser = $cid AND
credit_invoice.Settled = 0 AND
credit_invoice.`Status` = 1
ORDER BY
credit_invoice.Debitors_idDebitors ASC");
$count = 1;
while ($result = mysqli_fetch_array($sql)) {
    
    $creditID = $result['idCredit_Invoice'];
    
    $sql2 = mysqli_query($con, "SELECT * FROM
invoice_payments
WHERE
invoice_payments.Credit_Invoice_idCredit_Invoice = $creditID
Order by invoice_payments.DateTime Desc limit 1
");
        $diff =1;
        while ($result2 = mysqli_fetch_array($sql2)) {
            $LastPayment = $result2['DateTime'];
            $lastDateOnly = explode(" ", $LastPayment);
            $today = date("Y-m-d");
            $datetime1 = date_create($lastDateOnly[0]);
            $datetime2 = date_create($today);
            $interval = date_diff($datetime1, $datetime2);
//echo $interval->format('%R%a days');
            $diff = $interval->format('%a');
        }
    ?>
<tr onclick="loadPaymentHistory(<?php echo "'".$creditID."','".$result['Fname']."'" ?>)" <?php if($diff>=1){ ?>style="background-color: #E98582; border:solid black 1px"<?php }else{ ?>style="border:solid black 1px" <?php } ?>>
        <td><?php echo $count++; ?><input type="hidden" name="cid" value="<?php echo $result['idCredit_Invoice']; ?>" /></td>
        <td><?php echo $result['Fname'] . " " . $result['Lname']; ?></td>
        <td><?php echo $result['Address1'] . " " . $result['Address2']; ?></td>
    </tr>
        <?php } ?>
