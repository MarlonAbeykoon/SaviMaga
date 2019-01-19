<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
<?php include 'head.php'; ?>
  <!-- This is data table -->
 
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
                    <!-- <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div> -->
                    <div class="col-md-6 col-4 align-self-center">
                      
                    </div>
                </div>
               
                <!-- Row -->
                
               
                <div class="card">
                            <div class="card-body">
                            <?php
									if(isset($_SESSION['de_msg'])){
										echo $_SESSION['de_msg'];
										unset($_SESSION['de_msg']);

									}
									
									?>
                               <!--  <h4 class="card-title">Data Table</h4>
                                <h6 class="card-subtitle">Data table example</h6> -->
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>NIC</th>
                                                <th>Address</th>
                                                <th>E-Mail</th>
                                                <th>Phone No1</th>
                                                <th>Phone No2</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                        $query ="SELECT * FROM `debitors` WHERE `Status` = '1'";
                        $query_ex= mysqli_query($con,$query);
                        while($row_de = mysqli_fetch_array($query_ex)){

                            $name= $row_de['Fname']." ".$row_de['Lname'];
                            $idno= $row_de['NIC'];
                            $addres= $row_de['Address1']." ".$row_de['Address2'];
                            $email= $row_de['Email'];
                            $phone_no1= $row_de['Pno1'];
                            $phone_no2= $row_de['Pno2'];
                            $idDebitors= $row_de['idDebitors'];

                        ?>
                                            <tr>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $idno; ?></td>
                                                <td><?php echo $addres; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $phone_no1; ?></td>
                                                <td><?php echo $phone_no2; ?></td>
                                                <td>
                                                <a id="de_<?php echo $id ?>'"  class="btn btn-sm btn-rounded btn-primary" style="margin-left: 5px;" href="debitor_edit.php?idDebitors=<?php echo  $idDebitors; ?>">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                                                <a class="btn btn-sm btn-rounded btn-danger" href="Controller/debitorControl.php?debitor_delete=<?php echo  $idDebitors; ?>">Delete</a> 

                                              
                                                 </td>
                                            </tr>

                                            <?php } ?>
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                
               
            </div>
           
            <!-- footer -->
            <!-- ============================================================== -->
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
   
    <!-- All Jquery -->
    <!-- ============================================================== -->
   
</body>


 <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    
    <script>
    
    $(document).ready(function() {
     $('#myTable').DataTable({
        "columns": [
                                                                null,
                                                                null,
                                                                null,
                                                                null,
                                                                null,
                                                                null,
                                                                { "orderable": false }
                                                            ]
     });
        
    });
  /*   $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    }); */
    </script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    

</html>