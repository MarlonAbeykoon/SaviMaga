<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
<?php include 'head.php'; ?>

<?php


/* require_once 'classes/debitor_control.php';
$dc = new debitor_function();

if(isset($_POST['debitor_reg'])){

    $nic=$_POST['nic'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $address1=$_POST['address1'];
    $address2=$_POST['address2'];
    $pno1=$_POST['phno1'];
    $pno2=$_POST['phno2'];


   
   echo $result= $dc -> debitor_reg($nic, $fname, $lname, $address1, $address2, $pno1, $pno2, $email);

} */
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
                            <li class="breadcrumb-item active">New Debitor</li>
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
									if(isset($_SESSION['de_msg'])){
										echo $_SESSION['de_msg'];
										unset($_SESSION['de_msg']);

									}
									
									?>
                                <h4 class="card-title">Customer Registration</h4>
                                <h6 class="card-subtitle"></h6>

                                <div class="lang_select_btn" id="lang_select_btn">
                                    <fieldset style="float:right">
                                        <!--<legend></legend>-->
                                        <div>
                                            <label id="lang_select1" class="lang_select_btn_label selected">En
                                                <input name="lang_select" id="english" type="radio" value="english" checked />
                                            </label>
                                            <label id="lang_select2" class="lang_select_btn_label">සිං
                                                <input name="lang_select" id="sinhala" type="radio" value="sinhala" />
                                            </label>
                                            <label id="lang_select3" class="lang_select_btn_label">த
                                                <input name="lang_select" id="tamil" type="radio" value="tamil" />
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>

                                <form class="form p-t-20" id="deb_regform" name="deb_regform" action="Controller/debitorControl.php" method="POST">

                                    <input type="hidden" name="frontend_testing" value=0> <!--value should set to 0 in production :Prince-->

                                    <div class="form-group">
                                        <label for="nic">NIC No.</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-book"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="nic" id="nic" placeholder="ID Card No.">
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
                                            <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name">
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
                                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name">
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
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
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
                                            <input type="text" class="form-control" name="address1" id="address1" placeholder="Address 1">
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
                                            <input type="text" class="form-control" name="address2" id="address2" placeholder="Address 2">
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
                                            <input type="text" class="form-control" name="phno1" id="phno1" placeholder="Phone No 1">
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
                                            <input type="text" class="form-control" name="phno2" id="phno2" placeholder="Phone No 2">
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
                                    <button type="submit" name="debitor_reg" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                    <a href="debitor_reg.php" class="btn btn-inverse waves-effect waves-light">Cancel</a>
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
   
    <script>
        //global variables
        var selectedLang = 'english';

        var str_inputNIC_required = "Please enter your National ID Card number";
        var str_inputNIC_minlength = "Your National ID card number consists of at least 9 characters";
        var str_inputNIC_regx = "For example: 850961188v or 198509601188";

        var str_inputNameF_required = "Please enter your First Name";
        var str_inputNameF_minlength = "Please enter a valid First Name";
        var str_inputNameF_maxlength = "Your First Name seems too long!";
        var str_inputNameF_regx = "Please enter valid characters";

        var str_inputNameL_required = "Please enter a valid Last Name";
        var str_inputNameL_minlength = "Please enter your correct Last Name";
        var str_inputNameL_maxlength = "Your Last Name seems too long!"; 
        var str_inputNameL_regx = "Please enter valid characters";

        var str_inputAddress1_required = "Please enter your Address Line 1";
        var str_inputAddress1_minlength = "Please enter a valid Address Line 1";
        var str_inputAddress1_maxlength = "Your Address Line 1 seems too long!";

        var str_inputAddress2_required = "Please enter your Address Line 2";
        var str_inputAddress2_minlength = "Please enter a valid Address Line 2";
        var str_inputAddress2_maxlength = "Your Address Line 2 seems too long!";

        var str_phone1_required = "Please enter a your Phone number";
        var str_phone1_minlength = "Your Phone number is too short";
        var str_phone1_maxlength = "Your number is too long to be valid";
        var str_phone1_regx = "Please enter a valid Phone number";

        var str_phone2_required = "Please enter a your Phone number";
        var str_phone2_minlength = "Your Phone number is too short";
        var str_phone2_maxlength = "Your number is too long to be valid";
        var str_phone2_regx = "Please enter a valid Phone number";  


        var str_inputNIC_required_sinhala = "කරුණාකර ඔබගේ ජාතික හැදුනුම්පත් අ. ඇතුලත් කරන්න";
        var str_inputNIC_minlength_sinhala = "ඔබගේ ජාතික හැදුනුම්පත් අංකය සදහා අවම වශයෙන් ඉල්ලක්කම් 9ක් ඇත";
        var str_inputNIC_regx_sinhala = "උදාහරනයක් වශයෙන්: 850961188v හෝ 198509601188";

        var str_inputNIC_required_tamil = "உங்கள் தேசிய அடையாள அட்டை எண்ணை உள்ளிடவும்";
        var str_inputNIC_minlength_tamil = "உங்கள் தேசிய அடையாள அட்டையில் 9 கடிதங்கள் உள்ளன";
        var str_inputNIC_regx_tamil = "உதாரணமாக: 850961188v அல்லது 198509601188";

        var str_inputNameF_required_sinhala = "කරුණාකර ඔබගේ පළමු නම ඇතුලත් කරන්න";
        var str_inputNameF_minlength_sinhala = "කරුණාකර වලංගු පළමු නමක් ඇතුළත් කරන්න";
        var str_inputNameF_maxlength_sinhala = "ඔබේ පළමු නම දිග වැඩියි!";
        var str_inputNameF_regx_sinhala = "කරුණාකර වලංගු අක්ෂර ඇතුලත් කරන්න";

        var str_inputNameF_required_tamil = "உங்கள் முதல் பெயரை உள்ளிடவும்";
        var str_inputNameF_minlength_tamil = "செல்லுபடியாகும் முதல் பெயரை உள்ளிடுக";
        var str_inputNameF_maxlength_tamil = "உங்கள் முதல் பெயர் மிக நீண்டதாக தோன்றுகிறது!";
        var str_inputNameF_regx_tamil = "சரியான எழுத்துக்களை உள்ளிடுக";

        var str_inputNameL_required_sinhala = "කරුණාකර වලංගු අවසාන නමක් ඇතුළත් කරන්න";
        var str_inputNameL_minlength_sinhala = "කරුණාකර ඔබේ නිවැරදි අවසන් නම ඇතුලත් කරන්න";
        var str_inputNameL_maxlength_sinhala = "ඔබේ අවසාන නම දිග වැඩියි!"; 
        var str_inputNameL_regx_sinhala = "කරුණාකර වලංගු අක්ෂර ඇතුලත් කරන්න";

        var str_inputNameL_required_tamil = "சரியான கடைசி பெயரை உள்ளிடுக";
        var str_inputNameL_minlength_tamil = "கடைசி கடைசி பெயரை உள்ளிடவும்"; 
        var str_inputNameL_maxlength_tamil = "உங்கள் கடைசி பெயர் நீண்டது"; 
        var str_inputNameL_regx_tamil = "சரியான எழுத்துக்களை உள்ளிடுக";        

        var str_inputAddress1_required_sinhala = "කරුණාකර ඔබේ ලිපින පේළිය 1 ඇතුලත් කරන්න";
        var str_inputAddress1_minlength_sinhala = "කරුණාකර වලංගු ලිපින පේළිය 1 ඇතුලත් කරන්න";
        var str_inputAddress1_maxlength_sinhala = "ඔබේ ලිපින පේළිය 1 දිග වැඩියි!";

        var str_inputAddress1_required_tamil = "உங்கள் முகவரி வரி 1 ஐ உள்ளிடவும்";
        var str_inputAddress1_minlength_tamil = "சரியான முகவரி வரி 1 ஐ உள்ளிடுக";
        var str_inputAddress1_maxlength_tamil = "உங்கள் முகவரி வரி 1 மிக நீளமாக உள்ளது!";

        var str_inputAddress2_required_sinhala = "කරුණාකර ඔබේ ලිපින පේළිය 2 ඇතුලත් කරන්න";
        var str_inputAddress2_minlength_sinhala = "කරුණාකර වලංගු ලිපින පේළිය 2 ඇතුලත් කරන්න";
        var str_inputAddress2_maxlength_sinhala = "ඔබේ ලිපින පේළිය 2 දිග වැඩියි!";

        var str_inputAddress2_required_tamil = "உங்கள் முகவரி வரி 2 ஐ உள்ளிடவும்";
        var str_inputAddress2_minlength_tamil = "சரியான முகவரி வரி 2 ஐ உள்ளிடுக";
        var str_inputAddress2_maxlength_tamil = "உங்கள் முகவரி வரி 2 மிக நீளமாக உள்ளது!";

        var str_phone1_required_sinhala = "කරුණාකර ඔබගේ දුරකථන අංකය ඇතුළත් කරන්න";
        var str_phone1_minlength_sinhala = "ඔබගේ දුරකථන අංකයේ ඉලක්කන් අඩුය";
        var str_phone1_maxlength_sinhala = "ඔබේ අංකය දිග වැඩිය";
        var str_phone1_regx_sinhala = "කරුණාකර වලංගු දුරකථන අංකය ඇතුලත් කරන්න";

        var str_phone1_required_tamil = "உங்கள் தொடர்பு எண்ணை அளிக்கவும்";
        var str_phone1_minlength_tamil = "உங்கள் தொலைபேசி எண் மிகவும் குறுகியதாக உள்ளது";
        var str_phone1_maxlength_tamil = "உங்கள் எண் மிக நீளமாக உள்ளது";
        var str_phone1_regx_tamil = "சரியான தொலைபேசி எண்ணை உள்ளிடுக";

        var str_phone2_required_sinhala = "කරුණාකර ඔබගේ දුරකථන අංකය ඇතුළත් කරන්න";
        var str_phone2_minlength_sinhala = "ඔබගේ දුරකථන අංකයේ ඉලක්කන් අඩුය";
        var str_phone2_maxlength_sinhala = "ඔබේ අංකය දිග වැඩිය";
        var str_phone2_regx_sinhala = "කරුණාකර වලංගු දුරකථන අංකය ඇතුලත් කරන්න";

        var str_phone2_required_tamil = "உங்கள் தொடர்பு எண்ணை அளிக்கவும்";
        var str_phone2_minlength_tamil = "உங்கள் தொலைபேசி எண் மிகவும் குறுகியதாக உள்ளது";
        var str_phone2_maxlength_tamil = "உங்கள் எண் மிக நீளமாக உள்ளது";
        var str_phone2_regx_tamil = "சரியான தொலைபேசி எண்ணை உள்ளிடுக";

        $(document).ready(function() {

            //--form validation code begin--[PF]
            var str_validatorAddMethod_regx = "Please enter a valid value.";
            $.validator.addMethod("regx", function(value, element, regexpr) {    
                var re = new RegExp(regexpr);     
                return this.optional(element) || re.test(value);
            }, str_validatorAddMethod_regx);

            $("#deb_regform").validate({    
                rules: {
                    nic: {
                        minlength: 9,
                        required: true, 
                        maxlength: 12,
                        regx: /^([0-9]{9}[V|v|X|x]$|[0-9]{12}$)/
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
                    email: {
                        required: true,
                        email: true
                    },
                    address1: {
                        required: true, 
                        minlength: 3,
                        maxlength: 100 //--should decide on this [PF]
                    },
                    address2: {
                        required: true, 
                        minlength: 3,
                        maxlength: 100 //--should decide on this [PF]
                    },
                    phno1: {
                        required: true, 
                        minlength: 7,
                        regx: /^[0-9-+]{7,}$/,
                        maxlength: 14
                    },
                    phno2: {
                        minlength: 7,
                        regx: /^[0-9-+]{7,}$/,
                        maxlength: 14
                    }                                      
                },
                messages: {
                    nic: {
                        required: str_inputNIC_required, 
                        minlength: str_inputNIC_minlength,
                        regx: str_inputNIC_regx
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
                    address1: {
                        required: str_inputAddress1_required,
                        minlength: str_inputAddress1_minlength,
                        maxlength: str_inputAddress1_maxlength
                    },
                    address2: {
                        required: str_inputAddress2_required,
                        minlength: str_inputAddress2_minlength,
                        maxlength: str_inputAddress2_maxlength
                    },
                    phno1: {
                        required: str_phone1_required, 
                        minlength: str_phone1_minlength,
                        maxlength: str_phone1_maxlength,
                        regx: str_phone1_regx
                    },
                    phno2: {
                        minlength: str_phone2_minlength,
                        maxlength: str_phone2_maxlength,
                        regx: str_phone2_regx
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
            $("#deb_regform input, #deb_regform select").focus(function() {
                //checkboxes also includes if any
                var enteredValue = $(this).val();
                console.log($(this).attr('id') +' [focused] val: '+enteredValue+' class: '+$(this).attr('class'));

                //removing success class when no valid value (Choose.. OR selectedIndex is 0) selected in a dropdown (on focus of dropdown menu)
                if( ($(this)[0].selectedIndex == 0) && $(this).hasClass('success')) {
                    $(this).removeClass('success');
                }  
            });

            //these edits are important for form validation to works nicely--[PF]
            $("#deb_regform input, #deb_regform select").blur(function() {
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
            $("#deb_regform select").change(function() {
                var enteredValue = $(this).val();
                console.log($(this).attr('id') +' [changed] val: '+enteredValue+' class: '+$(this).attr('class'));
            }); 

            //--form validation code end--[PF]

            $('input[type=radio][name=lang_select]').change(function() {
                console.log('selectedLang (before): '+selectedLang);
                console.log( $(this).attr('id') );
                $("#lang_select1").removeClass('selected');
                $("#lang_select2").removeClass('selected');
                $("#lang_select3").removeClass('selected');

                var selId = $(this).parent().prop('id'); //lang_select1

                if (this.value == 'english') {
                    $("#"+selId).addClass('selected');
                    selectedLang = this.value;
                    
                    $('#deb_regform input[name="nic"]').rules('add', {
                        messages: {
                            required: str_inputNIC_required,
                            minlength: str_inputNIC_minlength,
                            regx: str_inputNIC_regx
                        }
                    }); 
                   // $("#deb_regform").validate().element( 'input[name="nic"]');                

                }
                else if (this.value == 'sinhala') {
                    $("#"+selId).addClass('selected');
                    selectedLang = this.value;

                    $('#deb_regform input[name="nic"]').rules('add', {
                        messages: {
                            required: str_inputNIC_required_sinhala,
                            minlength: str_inputNIC_minlength_sinhala,
                            regx: str_inputNIC_regx_sinhala
                        }
                    }); 

                    $('#deb_regform input[name="fname"]').rules('add', {
                        messages: {
                            required: str_inputNameF_required_sinhala,
                            minlength: str_inputNameF_minlength_sinhala,
                            maxlength: str_inputNameF_maxlength_sinhala,
                            regx: str_inputNameF_regx_sinhala
                        }
                    }); 

                    $('#deb_regform input[name="lname"]').rules('add', {
                        messages: {
                            required: str_inputNameL_required_sinhala,
                            minlength: str_inputNameL_minlength_sinhala,
                            maxlength: str_inputNameL_maxlength_sinhala,
                            regx: str_inputNameL_regx_sinhala
                        }
                    }); 

                    $('#deb_regform input[name="address1"]').rules('add', {
                        messages: {
                            required: str_inputAddress1_required_sinhala,
                            minlength: str_inputAddress1_minlength_sinhala,
                            maxlength: str_inputAddress1_maxlength_sinhala
                        }
                    });

                    $('#deb_regform input[name="address2"]').rules('add', {
                        messages: {
                            required: str_inputAddress2_required_sinhala,
                            minlength: str_inputAddress2_minlength_sinhala,
                            maxlength: str_inputAddress2_maxlength_sinhala
                        }
                    });   

                    $('#deb_regform input[name="phno1"]').rules('add', {
                        messages: {
                            required: str_phone1_required_sinhala, 
                            minlength: str_phone1_minlength_sinhala,
                            maxlength: str_phone1_maxlength_sinhala,
                            regx: str_phone1_regx_sinhala
                        }
                    }); 

                    $('#deb_regform input[name="phno2"]').rules('add', {
                        messages: {
                            minlength: str_phone2_minlength_sinhala,
                            maxlength: str_phone2_maxlength_sinhala,
                            regx: str_phone2_regx_sinhala
                        }
                    });                                                                                                      
                 }
                else if (this.value == 'tamil') {
                    $("#"+selId).addClass('selected');
                    selectedLang = this.value;

                    $('#deb_regform input[name="nic"]').rules('add', {
                        messages: {
                            required: str_inputNIC_required_tamil,
                            minlength: str_inputNIC_minlength_tamil,
                            regx: str_inputNIC_regx_tamil
                        }
                    }); 

                    $('#deb_regform input[name="fname"]').rules('add', {
                        messages: {
                            required: str_inputNameF_required_tamil,
                            minlength: str_inputNameF_minlength_tamil,
                            maxlength: str_inputNameF_maxlength_tamil,
                            regx: str_inputNameF_regx_tamil
                        }
                    });

                    $('#deb_regform input[name="lname"]').rules('add', {
                        messages: {
                            required: str_inputNameL_required_tamil,
                            minlength: str_inputNameL_minlength_tamil,
                            maxlength: str_inputNameL_maxlength_tamil,
                            regx: str_inputNameL_regx_tamil
                        }
                    });

                    $('#deb_regform input[name="address1"]').rules('add', {
                        messages: {
                            required: str_inputAddress1_required_tamil,
                            minlength: str_inputAddress1_minlength_tamil,
                            maxlength: str_inputAddress1_maxlength_tamil
                        }
                    });

                    $('#deb_regform input[name="address2"]').rules('add', {
                        messages: {
                            required: str_inputAddress2_required_tamil,
                            minlength: str_inputAddress2_minlength_tamil,
                            maxlength: str_inputAddress2_maxlength_tamil
                        }
                    }); 
                    
                    $('#deb_regform input[name="phno1"]').rules('add', {
                        messages: {
                            required: str_phone1_required_tamil, 
                            minlength: str_phone1_minlength_tamil,
                            maxlength: str_phone1_maxlength_tamil,
                            regx: str_phone1_regx_tamil
                        }
                    }); 

                    $('#deb_regform input[name="phno2"]').rules('add', {
                        messages: {
                            minlength: str_phone2_minlength_tamil,
                            maxlength: str_phone2_maxlength_tamil,
                            regx: str_phone2_regx_tamil
                        }
                    }); 
                }
                else {
                }

                //$("#deb_regform").validate();

                console.log('selectedLang (now): '+selectedLang);
                
                //console.log( $('#lang_select_btn').data('selected_lang') );
                //console.log( $(this).parent().get( 0 ).tagName );
                //console.log( $(this).parent().prop('className') );
                /*
                $('#lang_select_btn').find('.lang_select_btn_label').each(function() {
                    console.log( $(this).attr('id') );
                });
                */
            });

        });



    </script>



    </body>


</html>