<?php

include '../classes/dbcon.php';

$id = $_POST['id'];

if ($id == '0') {

    ?>

    <div class="row">

        <div class="col-md-6">

            <div class="form-group row">

                <label class="control-label text-right col-md-3">Existing Applicants</label>

                <div class="col-md-9">

                    <select class="form-control custom-select" data-placeholder="Choose a Applicant" tabindex="1" name="extApplicant">

                        <?php

                         $sql = mysqli_query($con, "SELECT debitors.idDebitors,debitors.Fname,debitors.NIC FROM debitors");

                         while ($result = mysqli_fetch_array($sql)) {

                        ?>

                        <option value="<?php echo $result['idDebitors'] ?>"><?php echo $result['Fname']." (".$result['NIC'].")"; ?></option>

                         <?php } ?>

                    </select>

                </div>

            </div>

        </div>

    </div>

<?php } else { ?>

    <h3 class="box-title">Person Info</h3>

    <hr class="m-t-0 m-b-40">

    <div class="row">

        <div class="col-md-6">

            <div class="form-group row">

                <label class="control-label text-right col-md-3">First Name</label>

                <div class="col-md-9">

                    <input type="text" class="form-control" name="firstName" placeholder="First Name" required pattern="^[A-Za-z -]+$">

                    <small class="form-control-feedback"></small> </div>

            </div>

        </div>

        <!--/span-->

        <div class="col-md-6">

            <div class="form-group row">

                <label class="control-label text-right col-md-3">Last Name</label>

                <div class="col-md-9">

                    <input type="text" class="form-control" name="lastName" placeholder="Last Name" required pattern="^[A-Za-z -]+$">

                    <small class="form-control-feedback"></small> </div>

            </div>

        </div>

        <!--/span-->

    </div>

    <div class="row">

        <!-- <div class="col-md-6">

            <div class="form-group row">

                <label class="control-label text-right col-md-3">Gender</label>

                <div class="col-md-9">

                    <select class="form-control custom-select">

                        <option value="Male">Male</option>

                        <option value="Female">Female</option>

                    </select>

                    <small class="form-control-feedback"> Select your gender. </small> </div>

            </div>

        </div> -->

          <div class="col-md-6">

<div class="form-group row">

    <label class="control-label text-right col-md-3">Email</label>

    <div class="col-md-9">

        <input type="text" class="form-control" name="email" placeholder="Email Address" required="" data-validation-required-message="This field is required" aria-invalid="false">

        <small class="form-control-feedback"></small> </div>

</div>

</div>

        <!--/span-->

        <div class="col-md-6">

            <div class="form-group row">

                <label class="control-label text-right col-md-3">NIC No</label>

                <div class="col-md-9">

                    <input type="text" class="form-control" name="nic" placeholder="123456789V" required>

                    <small class="form-control-feedback"></small> </div>

            </div>

        </div>

        <!--/span-->

    </div>

    <div class="row">

        <div class="col-md-6">

            <div class="form-group row">

                <label class="control-label text-right col-md-3">Phone No1</label>

                <div class="col-md-9">

                    <input type="text" class="form-control" name="phone1" placeholder="123456789" required pattern="[0-9]{10}" title="10 Digit Phone No">

                    <small class="form-control-feedback"></small> </div>

            </div>

        </div>

        <!--/span-->

        <div class="col-md-6">

            <div class="form-group row">

                <label class="control-label text-right col-md-3">Phone No2</label>

                <div class="col-md-9">

                    <input type="text" class="form-control" name="phone2" placeholder="123456789" pattern="[0-9]{10}" title="10 Digit Phone No">

                    <small class="form-control-feedback"></small> </div>

            </div>

        </div>

        <!--/span-->

    </div>

    <div class="row">

      <!--   <div class="col-md-6">

            <div class="form-group row">

                <label class="control-label text-right col-md-3">Email</label>

                <div class="col-md-9">

                    <input type="text" class="form-control" name="email" placeholder="abc@abc.com" required="" data-validation-required-message="This field is required" aria-invalid="false">

                    <small class="form-control-feedback"></small> </div>

            </div>

        </div> -->

    </div>

    <h3 class="box-title">Address</h3>

    <hr class="m-t-0 m-b-40">

    <!--/row-->

    <div class="row">

        <div class="col-md-6">

            <div class="form-group row">

                <label class="control-label text-right col-md-3">Address 1</label>

                <div class="col-md-9">

                    <input type="text" class="form-control" name="address1" required>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group row">

                <label class="control-label text-right col-md-3">Address 2</label>

                <div class="col-md-9">

                    <input type="text" class="form-control" name="address2">

                </div>

            </div>

        </div>

    </div>

<?php }

?>  

