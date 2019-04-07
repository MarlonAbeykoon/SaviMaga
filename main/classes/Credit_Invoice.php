<?php



/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */





date_default_timezone_set("Asia/Colombo");



//include '../classes/DBConnection.php';



class Credit_Invoice {



    //put your code here



    private $con = '';



    public function __construct() {

        $dbcon1 = new dbcon();

        $this->con = $dbcon1->dbcon_function();

    }



    function addCrediInvoice($totalAmount, $grantAmount, $InterestRate, $DailyEqualPayment, $Days, $PaidAmount, $Settled, $Debitors_idDebitors, $CollectionArea_idCollectionArea, $userid, $loan_type) {

//        $d = mktime(11, 14, 54, 8, 12, 2014);



        $Date = date("Y-m-d");

        $sql = "INSERT INTO credit_invoice (TotalAmount,GrantAmount,InterestRate,DailyEqualPayment,Days,PaidAmount,Settled,DateTime,Debitors_idDebitors,CollectionArea_idCollectionArea,Status,user_idUser,`type`) "

                . "VALUES ($totalAmount,$grantAmount, '$InterestRate', '$DailyEqualPayment', '$Days','$PaidAmount','$Settled','$Date','$Debitors_idDebitors','$CollectionArea_idCollectionArea', '0',$userid,'$loan_type')";



        if (mysqli_query($this->con, $sql)) {

            $last_id = $this->con->insert_id;

            return $last_id;

//            return "true";

        } else {

//            return 'error:' . mysqli_error($this->con);

            return "false";

        }

    }



    function addnewPayment($cid, $Amount, $AdditionalAmount, $days, $userid) {

//        $d = mktime(11, 14, 54, 8, 12, 2014);

        $Date = date("Y-m-d H:i");

        $sql = "INSERT INTO invoice_payments (Amount,AdditionalAmount,DateTime,Credit_Invoice_idCredit_Invoice,User_idUser,PayFor,Status) "

                . "VALUES ($Amount,$AdditionalAmount,'$Date',$cid,$userid,$days,'1')";



        if (mysqli_query($this->con, $sql)) {

//            return 'error:' . mysqli_error($this->con);

            return true;

        } else {

//            return 'error:' . mysqli_error($this->con);

            return false;

        }

    }



    function updateCreditInvoice($cid, $PaidAmount, $penaltyAmount) {



        $Settled = 0;

        $totPaid = 0;

        $totPenalty = $penaltyAmount;

        $query = mysqli_query($this->con, "SELECT * FROM credit_invoice WHERE idCredit_Invoice = $cid");

        while ($res = mysqli_fetch_array($query)) {

            $totPaid = $res['PaidAmount'] + $PaidAmount;

            $totPenalty = $totPenalty + $res['PenaltyPaid'];

            if (round($res['TotalAmount'],0) <= round($totPaid,0)) {

                $Settled = 1;

            }

        }



        $Date = date("Y-m-d");

        $sql = "UPDATE credit_invoice SET PaidAmount = $totPaid ,Settled =$Settled,PenaltyPaid=$totPenalty WHERE idCredit_Invoice = $cid";



        if (mysqli_query($this->con, $sql)) {

            return true;

        } else {

//            return 'error:' . mysqli_error($this->con);

            return false;

        }

    }

    

    

       function updateStatus($cid, $Status) {



        $Date = date("Y-m-d");

        $sql = "UPDATE credit_invoice SET Status = $Date ,Status =$Status WHERE idCredit_Invoice = $cid";



        if (mysqli_query($this->con, $sql)) {

            return true;

        } else {

//            return 'error:' . mysqli_error($this->con);

            return false;

        }

    }



    public function getValue_rowcount($query_as_f)
	{
$result = mysqli_query($this->con, $query_as_f);
		// $query_results=mysqli_query($con,$query_as_f);

		$rowcount=mysqli_num_rows($result);
		
			return $rowcount;
		
}



}



?>