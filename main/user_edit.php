<!DOCTYPE html>
<html lang="en">



<!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
<?php include 'head.php'; ?>

<?php


if(isset($_GET['select_edit']) && isset($_GET['idUser_Details']) ){
   echo $select_edit = $_GET['select_edit'];
    $idUser_Details = $_GET['idUser_Details'];

 
    $query ="SELECT * FROM `user` u JOIN `user_details` d ON u.`User_Details_idUser_Details` = d.`idUser_Details` WHERE d.`idUser_Details`= $idUser_Details and u.`Status` = '1'";
    $query_ex= mysqli_query($con,$query);
    if($row_de = mysqli_fetch_array($query_ex)){

        $fname= $row_de['Fname'];
        $lname=$row_de['Lname'];
                         
        $addres=$row_de['address'];
        $phone_no=$row_de['pno'];
        $idUser_Type=$row_de['User_Type_idUser_Type'];
        $idUser_Details= $row_de['idUser_Details'];
        $userid = $row_de['idUser'];
    }


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
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                      
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">User Edit <i class="text-muted"><?php echo str_replace('_', ' ', $select_edit); ?></i></h4>
                                <h6 class="card-subtitle"></h6>
                                <?php  if($select_edit == "change_details"){ ?>
                                <form class="form p-t-20" name="user_details" id="user_details" action="Controller/userControl.php" method="POST">
                                <?php }else if($select_edit == "change_password"){?>
                                <form class="form p-t-20" name="change_password" id="change_password" action="Controller/userControl.php" method="POST">
                                <?php }?>

                                <?php if($select_edit == "change_details"){ ?>

                                    <div class="form-group">
                                        <label for="user_ty">User Type</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-tag"></i>
                                                </span>
                                            </div>
                                            <select class="form-control custom-select" id="user_ty" data-placeholder="Choose a Applicant" tabindex="1" name="user_ty">
                        <option value="">-- select an option --</option>

                        <?php
                        $query ="SELECT * FROM `user_type` WHERE `Status` = '1'";
                        $query_ex= mysqli_query($con,$query);
                        while($row_ut = mysqli_fetch_array($query_ex)){
                        ?>
                        <option <?php if( $row_ut['idUser_Type'] == $idUser_Type){echo "selected";} ?> value="<?php echo $row_ut['idUser_Type']; ?>"><?php echo $row_ut['Type']; ?></option>
                        <?php } ?>
                    </select>
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
                                            <input type="text" class="form-control" name="fname" id="fname" value ="<?php echo $fname; ?>" placeholder="First Name">
                                            <input type="hidden"  name="idUser_Details" id="idUser_Details" value ="<?php echo $idUser_Details; ?>">
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
                                            <input type="text" class="form-control" name="lname" id="lname" value ="<?php echo $lname; ?>" placeholder="Last Name">
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
                                            <input type="text" class="form-control" name="address" id="address" value ="<?php echo $addres; ?>" placeholder="Address" autocomplete="off">
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
                                            <input type="text" class="form-control" name="phno" id="phno" value ="<?php echo $phone_no; ?>" placeholder="Phone No">
                                        </div>
                                    </div>

                                   <!--  <div class="form-group">
                                        <label for="uname">User Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="uname" id="uname" placeholder="Username">
                                        </div>
                                    </div> -->
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
                                    <button type="submit" name="user_de_change" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                        

                        <?php }else {?>
                                  
                                    <div class="form-group">
                                        <label for="pwd1">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-lock"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control" name="newpass" id="newpass" placeholder="Enter Password">
                                            <input type="hidden"  name="idUser_Details" id="idUser_Details" value ="<?php echo $userid; ?>">
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
                                            <input type="password" class="form-control" name="newpass2" id="newpass2" placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <button type="submit" name="user_pw_change" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                    <?php } ?>
                                    <!-- <div class="form-group">
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox1" type="checkbox">
                                            <label for="checkbox1"> Remember me </label>
                                        </div>
                                    </div> -->
                                    
                                    <a href="user_manage.php" class="btn btn-inverse waves-effect waves-light">Cancel</a>
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
    
    <script type="text/javascript">
    $(document).ready(function() {
        var str_user_ty_required = "Please select a User Type";

        var str_inputNameU_required = "Please enter your User Name";
        var str_inputNameU_minlength = "Please enter a valid User Name";
        var str_inputNameU_maxlength = "Your User Name seems too long!";

        var str_inputNameF_required = "Please enter your First Name";
        var str_inputNameF_minlength = "Please enter a valid First Name";
        var str_inputNameF_maxlength = "Your First Name seems too long!";
        var str_inputNameF_regx = "Please enter valid characters";

        var str_inputNameL_required = "Please enter a valid Last Name";
        var str_inputNameL_minlength = "Please enter your correct Last Name";
        var str_inputNameL_maxlength = "Your Last Name seems too long!"; 
        var str_inputNameL_regx = "Please enter valid characters";

        var str_inputAddress_required = "Please enter your correct Address";
        var str_inputAddress_minlength = "Please enter a valid Address";
        var str_inputAddress_maxlength = "Your Address seems little too long!";

        var str_phone_required = "Please enter a your Phone number";
        var str_phone_minlength = "Your Phone number is too short";
        var str_phone_maxlength = "Your number is too long to be valid";
        var str_phone_regx = "Please enter a valid Phone number";

        var str_pass_required = "Please the password is required";
        var str_pass_minlength = "Your password must have at least 6 characters";

        var str_cpass_required = "Please the confirm password is required";
        var str_cpass_minlength = "Your confirm password must have at least 6 characters";  
        var str_cpass_equalTo = "This should match with the password above";   

    //--form validation code begin--[PF]
    var str_validatorAddMethod_regx = "Please enter a valid value.";
        $.validator.addMethod("regx", function(value, element, regexpr) {    
            var re = new RegExp(regexpr);     
            return this.optional(element) || re.test(value);
        }, str_validatorAddMethod_regx);

        $("#user_details, #change_password").validate({    
            rules: {
                user_ty: {
                    required: true
                },
                uname: {
                    required: true, 
                    minlength: 3,
                    maxlength: 15, //--should decide on this [PF]
                },                
                fname: {
                    required: true, 
                    minlength: 3,
                    maxlength: 40, //--should decide on this [PF]
                    regx: /^[^0-9@+-]{3,}$/
                },
                lname: {
                    required: true, 
                    minlength: 3,
                    maxlength: 80, //--should decide on this [PF]
                    regx: /^[^0-9@+-]{3,}$/
                },
                address: {
                    required: true, 
                    minlength: 3,
                    maxlength: 200 //--should decide on this [PF]
                },
                phno: {
                    required: true, 
                    regx: /^[0-9-+]{7,}$/,
                    minlength: 7,
                    maxlength: 14
                },
                newpass: {
                    required: true,
                    minlength: 6    //--should decide on this [PF]
                }, 
                newpass2: {
                    required: true,
                    minlength: 5,
                    equalTo: "#newpass"
                }                

            },
            messages: {
                user_ty: {
                    required: str_user_ty_required 
                },                
                uname: {
                    required: str_inputNameU_required,
                    minlength: str_inputNameU_minlength,
                    maxlength: str_inputNameU_maxlength
                },                
                fname: {
                    required: str_inputNameF_required,
                    minlength: str_inputNameF_minlength,
                    maxlength: str_inputNameF_maxlength,
                    regx: str_inputNameF_regx
                },
                lname: {
                    required: str_inputNameL_required,
                    minlength: str_inputNameL_minlength,
                    maxlength: str_inputNameL_maxlength,
                    regx: str_inputNameL_regx
                },
                address: {
                    required: str_inputAddress_required,
                    minlength: str_inputAddress_minlength,
                    maxlength: str_inputAddress_maxlength
                },
                phno: {
                    required: str_phone_required, 
                    minlength: str_phone_minlength,
                    maxlength: str_phone_maxlength,
                    regx: str_phone_regx
                },
                newpass: {
                    required: str_pass_required, 
                    minlength: str_pass_minlength
                },
                newpass2: {
                    required: str_cpass_required, 
                    minlength: str_cpass_minlength,
                    equalTo: str_cpass_equalTo
                }                

            },
            validClass: "success",
            errorPlacement: function(error, element) {
                //console.log(element.attr('id')+' '+element.closest('div').attr('class'));
                if( element.closest('div').is('[class^="input-group"]') ) {
                    //to check one particular element, you'd use .is(), not hasClass:

                    //otherwise bootsrap labels break when on displaying validation error
                    error.insertAfter(element.closest('div'));
                }
                else {
                    error.insertAfter(element);
                }
            },
            invalidHandler: function(event, validator) {
                //Callback for custom code when an invalid form is submitted. 

                var errors = validator.numberOfInvalids(); //number of errors
                console.log('errors: ' + errors);

                for (var i=0;i<validator.errorList.length;i++){
                    console.log(validator.errorList[i]);
                } 

                for (var i in validator.errorMap) {
                    console.log(i, ":", validator.errorMap[i]);
                }                                          
            }
        });

        //these edits are important for form validation to works nicely--[PF]
        $("#user_details input, #user_details select").focus(function() {
            //checkboxes also includes if any
            var enteredValue = $(this).val();
            console.log($(this).attr('id') +' [focused] val: '+enteredValue+' class: '+$(this).attr('class'));

            //removing success class when no valid value (Choose.. OR selectedIndex is 0) selected in a dropdown (on focus of dropdown menu)
            if( ($(this)[0].selectedIndex == 0) && $(this).hasClass('success')) {
                $(this).removeClass('success');
            }  
        });

        //these edits are important for form validation to works nicely--[PF]
        $("#user_details input, #user_details select").blur(function() {
            //checkboxes also includes
            var enteredValue = $(this).val();
            console.log($(this).attr('id') +' [blured] val: '+enteredValue +' class: '+$(this).attr('class'));
            
            if( (enteredValue == null || enteredValue == "") && $(this).hasClass('success')) {
                $(this).removeClass('success');
            }

            if( ($(this)[0].selectedIndex == 0) && $(this).hasClass('success')) {
                $(this).removeClass('success');
            }                     
        });            
        
        //--[PF]
        $("#user_details select").change(function() {
            var enteredValue = $(this).val();
            if( enteredValue == ""){
                //trigger
                $("#user_details").validate().element( "#"+$(this).attr('id') );
            }
            console.log($(this).attr('id') +' [changed] val: '+enteredValue+' class: '+$(this).attr('class'));
        }); 
    });        
    </script>

  </body>

</html>