<!DOCTYPE html>
<html lang="en">



<!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
<?php include 'head.php'; ?>

<?php
/* require_once 'classes/user_cotrol.php';
$uc = new user_function();

if(isset($_POST['user_re'])){

    $utype=$_POST['user_ty'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $path="1";
    $uname=$_POST['uname'];
    $pass=$_POST['cpass'];
    
     $result_ur=$uc -> user_reg($fname,$lname,$path,$uname,$pass,$utype);
 
   
}*/

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
                            <li class="breadcrumb-item active">New Users</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                      
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <?php
									if(isset($_SESSION['user_msg'])){
										echo $_SESSION['user_msg'];
										unset($_SESSION['user_msg']);

									}
									
									?>
                                <h4 class="card-title">User Registration</h4>
                                <h6 class="card-subtitle"></h6>
                                <form id="user_regform" name="user_regform" class="form p-t-20" action="Controller/userControl.php" method="POST">

                                    <div class="form-group">
                                        <label for="user_ty">User Type</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-user"></i>
                                                </span>
                                            </div>
                                            <select class="form-control custom-select" id="user_ty" data-placeholder="Choose a Applicant" tabindex="1" name="user_ty">
                        <option value="">-Select User Type-</option>

                        <?php
                        $query ="SELECT * FROM `user_type` WHERE `Status` = '1'";
                        $query_ex= mysqli_query($con,$query);
                        while($row_ut = mysqli_fetch_array($query_ex)){
                        ?>
                        <option value="<?php echo $row_ut['idUser_Type']; ?>"><?php echo $row_ut['Type']; ?></option>
                        <?php } ?>
                    </select>
                                        </div>
                                    </div>

				    <div class="form-group">
                                        <label for="uname">User Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="uname" id="uname" placeholder="Username">
                                        </div>
                                    </div>
					

                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name">
                                        </div>
                                    </div>
                                    
                                    
				<div class="form-group">
                                        <label for="exampleInputuname">Address </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-home"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="address" id="address" placeholder="Address" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputuname">Phone No</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-mobile"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="phno" id="phno" placeholder="Phone No">
                                        </div>
                                    </div>

                                   <!--  <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-email"></i>
                                                </span>
                                            </div>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="pwd1">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-lock"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control" name="pass" id="pass" placeholder="Enter Password">
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
                                            <input type="password" class="form-control" name="cpass" id="cpass" placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                       <!-- <div class="checkbox checkbox-success">
                                            <input id="checkbox1" type="checkbox">
                                            <label for="checkbox1"> Remember me </label>
                                        </div> -->
                                    </div>
                                    <button type="submit" name="user_re" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                    <a href="user_reg.php" class="btn btn-inverse waves-effect waves-light">Cancel</a>
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
    $('#user_regform').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            user_ty: {
                validators: {
                    notEmpty: {
                        message: 'This field is required and cannot be empty'
                    }
                }
            },
            uname: {
             
                validators: {
                    notEmpty: {
                        message: 'This field is required and cannot be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[A-Za-z0-9]+$/i,
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
                        regexp: /^[A-Z a-z\s]+$/i,
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
                        regexp: /^[A-Z a-z\s]+$/i,
                        message: 'Special Character\'s are not allowed'
                    }
                }
            },
           
           /*  email: {
               
                validators: {
                    notEmpty: {
                        message: 'This field is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            }, */
            address: {
                validators: {
                    notEmpty: {
                        message: 'This field is required and cannot be empty'
                    }
                }
            },
          
           
            phno: {
               
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
           pass: {
            validators: {

                notEmpty: {
                        message: 'This field is required and cannot be empty'
                    },
                    
                    regexp: {
                        regexp: /^[A-Za-z0-9]+$/i,
                        message: 'Special Character\'s are not allowed'
                    },

                identical: {
                    field: 'cpass',
                    message: 'The password and its confirm are not the same'
                }
            }
        },
        cpass: {
            validators: {
                notEmpty: {
                        message: 'This field is required and cannot be empty'
                    },
                    
                    regexp: {
                        regexp: /^[A-Za-z0-9]+$/i,
                        message: 'Special Character\'s are not allowed'
                    },
                identical: {
                    field: 'pass',
                    message: 'The password and its confirm are not the same'
                }
            }
        }



           
        }
    });
});
</script>

</html>