<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
<?php include 'head.php'; ?>

<?php




if(isset($_GET['idDebitors'])){

    $idDebitors = $_GET['idDebitors'];

    $query ="SELECT * FROM `debitors` idDebitors WHERE `idDebitors` = $idDebitors AND `Status` = '1'";
                        $query_ex= mysqli_query($con,$query);
                        if($row_de = mysqli_fetch_array($query_ex)){

                            $fname= $row_de['Fname'];
                            $lname= $row_de['Lname'];
                            $idno= $row_de['NIC'];
                            $addres1= $row_de['Address1'];
                            $addres2= $row_de['Address2'];
                            $email= $row_de['Email'];
                            $phone_no1= $row_de['Pno1'];
                            $phone_no2= $row_de['Pno2'];
                            $idDebitors= $row_de['idDebitors'];

                        }

}else{


}



?>

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
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">New Customer</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                      
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Debitor Manage</h4>
                                <h6 class="card-subtitle"></h6>
                                <form class="form p-t-20" id="deb_editform" name="deb_editform" action="Controller/debitorControl.php" method="POST">

                                <div class="form-group">
                                        <label for="exampleInputuname">Nic</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="nic" value="<?php echo $idno; ?>" id="nic" placeholder="Nic">
                                            <input type="hidden"  name="idDebitors" id="idDebitors" value="<?php echo $idDebitors; ?>" >
                                        </div>
                                    </div>

                                      <div class="form-group">
                                        <label for="exampleInputuname">First Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $fname; ?>" placeholder="First Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputuname">Last Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $lname; ?>" placeholder="Last Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-email"></i>
                                                </span>
                                            </div>
                                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter email">
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="exampleInputuname">Address 1</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-home"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="address1" id="address1" value="<?php echo $addres1; ?>" placeholder="Address 1">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputuname">Address 2</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-home"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="address2" id="address2" value="<?php echo $addres2; ?>" placeholder="Address 2">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputuname">Phone No 1</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-mobile"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="phno1" id="phno1" value="<?php echo $phone_no1; ?>" placeholder="Phone No 1">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputuname">Phone No 2</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-mobile"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="phno2" id="phno2" value="<?php echo $phone_no2; ?>" placeholder="Phone No 2">
                                        </div>
                                    </div>
                                    
                                   <!--  <div class="form-group">
                                        <label for="pwd1">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-lock"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control" id="pwd1" placeholder="Enter email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd2">Confirm Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-lock"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control" id="pwd2" placeholder="Enter email">
                                        </div>
                                    </div>
 -->
                                    <button type="submit" name="debitor_edit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                    <a href="debitor_manage.php" class="btn btn-inverse waves-effect waves-light">Cancel</a>
                                </form>
                            </div>
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
   
    </body>


<script type="text/javascript">
$(document).ready(function() {
    $('#deb_editform').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nic: {
                validators: {
                    notEmpty: {
                        message: 'This field is required and cannot be empty'
                    },
                    
                    regexp: {
                        regexp: /^[A-Z a-z 0-9\s]+$/i,
                        message: 'Special Character\'s are not allowed'
                    }
                }
            },
            fname: {
                validators: {
                    notEmpty: {
                        message: 'This field is required and cannot be empty'
                    },
                    
                    regexp: {
                        regexp: /^[A-Z a-z 0-9\s]+$/i,
                        message: 'Special Character\'s are not allowed'
                    }
                }
            },
            lname: {
                validators: {
                    notEmpty: {
                        message: 'This field is required and cannot be empty'
                    },
                    
                    regexp: {
                        regexp: /^[A-Z a-z 0-9\s]+$/i,
                        message: 'Special Character\'s are not allowed'
                    }
                }
            },
           
            email: {
               
                validators: {
                    notEmpty: {
                        message: 'This field is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            },
            address1: {
                validators: {
                    notEmpty: {
                        message: 'This field is required and cannot be empty'
                    },
                    
                    regexp: {
                        regexp: /^[A-Z a-z 0-9\s]+$/i,
                        message: 'Special Character\'s are not allowed'
                    }
                }
            },
            address2: {
                validators: {
                    notEmpty: {
                        message: 'This field is required and cannot be empty'
                    },
                    
                    regexp: {
                        regexp: /^[A-Z a-z 0-9\s]+$/i,
                        message: 'Special Character\'s are not allowed'
                    }
                }
            },
           
            phno1: {
               
               validators: {
                notEmpty: {
                        message: 'This field is required and cannot be empty'
                    },
        stringLength: {
           max: 10,
           message: 'The value must be less than 10 characters'
                },
                    
                    regexp: {
                        regexp: /^[0-9]+$/i,
                        message: 'Special Character\'s are not allowed'
                    }

               }
           },
           
           phno2: {
              
              validators: {
               
       stringLength: {
          max: 10,
          message: 'The value must be less than 10 characters'
               },
                   
                   regexp: {
                       regexp: /^[0-9]+$/i,
                       message: 'Special Character\'s are not allowed'
                   }

              }
          }
           
        }
    });
});
</script>

</html>