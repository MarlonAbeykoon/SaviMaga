<link href="../../assets/plugins/wizard/steps.css" rel="stylesheet">
<!-- Validation wizard -->
<div class="row" id="validation">
    <div class="col-12">
        <div class="card wizard-content">
            <div class="card-body">
                <h4 class="card-title">Step wizard with validation</h4>
                <h6 class="card-subtitle">You can us the validation like what we did</h6>
                <form action="#" class="validation-wizard wizard-circle">
                    <!-- Step 1 -->
                    <h6>Step 1</h6>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wfirstName2"> First Name : <span class="danger">*</span> </label>
                                    <input type="text" class="form-control required" id="wfirstName2" name="firstName"> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wlastName2"> Last Name : <span class="danger">*</span> </label>
                                    <input type="text" class="form-control required" id="wlastName2" name="lastName"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wemailAddress2"> Email Address : <span class="danger">*</span> </label>
                                    <input type="email" class="form-control required" id="wemailAddress2" name="emailAddress"> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wphoneNumber2">Phone Number1 :</label>
                                    <input type="tel" class="form-control" id="wphoneNumber2"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wphoneNumber2">Phone Number2 :</label>
                                    <input type="tel" class="form-control" id="wphoneNumber2"> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="wnic">NIC :</label>
                                    <input type="text" class="form-control" id="wnic"> </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 2 -->
                    <h6>Step 2</h6>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Address1">Address1 :</label>
                                    <input type="text" class="form-control required" id="Address1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Address2">Address2 :</label>
                                    <input type="text" class="form-control required" id="Address2">
                                </div>   
                            </div>
                        </div>
                    </section>
                    <!-- Step 3 -->
                    <h6>Step 3</h6>
                    <section>

                    </section>
                    <!-- Step 4 -->
                    <h6>Step 4</h6>
                    <section>

                    </section>
                </form>
            </div>
        </div>
    </div>
</div>
    <script src="js/custom.min.js"></script>
    <script src="../assets/plugins/moment/min/moment.min.js"></script>
    <script src="../assets/plugins/wizard/jquery.steps.min.js"></script>
    <script src="../assets/plugins/wizard/jquery.validate.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../assets/plugins/wizard/steps.js"></script>