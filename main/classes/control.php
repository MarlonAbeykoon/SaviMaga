<?php


 include 'DBConnection.php'; 



class control_functions {



    private $con = '';

    public function __construct() {

        $dbcon1 = new dbcon();

        $this->con = $dbcon1->dbcon_function();
    }




public function getValueAsf($query_as_f)
	{
$result = mysqli_query($this->con, $query_as_f);
		// $query_results=mysqli_query($con,$query_as_f);
		while($row=mysqli_fetch_array($result)){ 
			return $row['f'];
		}
}






}

?>