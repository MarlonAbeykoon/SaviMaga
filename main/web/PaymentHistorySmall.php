<?php
include '../classes/dbcon.php';

$cid = $_POST['cid'];

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
         <td><?php echo $results['PayFor']." days"; ?></td>
        <td>Rs:<?php echo $results['Amount']; ?></td>
        <td>Rs:<?php echo $results['AdditionalAmount']; ?></td>
    </tr>
    <?php
}
?>   
