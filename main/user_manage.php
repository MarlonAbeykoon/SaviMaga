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
									if(isset($_SESSION['user_meg'])){
										echo $_SESSION['user_meg'];
										unset($_SESSION['user_meg']);

									}
									
									?>
                                <h4 class="card-title">User Manage</h4>
                               <!--  <h4 class="card-title">Data Table</h4>
                                <h6 class="card-subtitle">Data table example</h6> -->
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Phone No</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                        $query ="SELECT idUser,Fname,Lname,`address`,pno,idUser_Details,u.Status as ustatus FROM `user_details` d join `user` u on  d.idUser_Details = u.User_Details_idUser_Details";
                        $query_ex= mysqli_query($con,$query);
                        while($row_de = mysqli_fetch_array($query_ex)){

                            $name= $row_de['Fname']." ".$row_de['Lname'];
                            
                            /* $addres= $row_de['Address'];
                           
                            $phone_no= $row_de['Pno'];
                            */
                            $addres=$row_de['address'];
                            $phone_no=$row_de['pno'];
                            $idUser_Details= $row_de['idUser_Details'];
                            $status= $row_de['ustatus'];
                            $idUser= $row_de['idUser'];
                           

                        ?>
                                            <tr>
                                                <td><?php echo $name; ?></td>
                                                
                                                <td><?php echo $addres; ?></td>
                                               
                                                <td><?php echo $phone_no; ?></td>
                                                
                                                <td>
                                                <a class="btn btn-sm btn-rounded btn-success"  href="user_edit.php?select_edit=change_password&idUser_Details=<?php echo $idUser_Details; ?>">Reset Password</a> 
                                                <a class="btn btn-sm btn-rounded btn-primary" style="margin-left: 5px;" href="user_edit.php?select_edit=change_details&idUser_Details=<?php echo $idUser_Details; ?>">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                                                <?php
                                                if($user_de != $idUser){
                                                if($status == '1'){ ?>
                                                <a class="btn btn-sm btn-rounded btn-danger"  href="Controller/userControl.php?user_delete=<?php echo $idUser_Details; ?>">Inactive</a> 
                                                <?php }else{ ?>
                                                <a class="btn btn-sm btn-rounded btn-warning"  href="Controller/userControl.php?user_active=<?php echo $idUser_Details; ?>">Active</a>                                                     
                                                <?php } 
                                                }
                                                ?>
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