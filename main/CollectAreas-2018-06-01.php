<!DOCTYPE html>
<html lang="en">

    <link href="../assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

    <!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
    <?php include 'head.php'; ?>
    <script>
        function LoadSelection() {
            var uid = $("#collector").val()

//            for (i = 0; i < document.getElementsByName('radio').length; i++) {
//                if (document.getElementsByName('radio')[i].checked) {
//                    id = document.getElementsByName('radio')[i].value;
//                }
//            }

            var dataString = 'uid=' + uid;

            $.ajax({
                type: "GET",
                url: "web/CollectorAndArea.php",
                data: dataString,
                cache: false,
                success: function (data) {
                  //  alert(html)
                   // document.getElementById("ms-pre-selected-options").innerHTML = html;
                    $("#pre-selected-options").empty().append(data);
	  $("#pre-selected-options").multiSelect('refresh');	

                }
            });
        }

        function Calculate() {
            var amount = document.getElementsByName("amount")[0].value;
            var days = document.getElementsByName("days")[0].value;
            var rate = document.getElementsByName("rate")[0].value;
            var interest = ((amount / 100) * rate);

            var dailyPay = (parseFloat((interest / 30) * days) + parseFloat(amount)) / days;
            var tot = dailyPay * days;
            document.getElementsByName("dpay")[0].value = dailyPay.toFixed(2);
            document.getElementsByName("tot")[0].value = tot.toFixed(2);
        }
    </script>
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
                                <li class="breadcrumb-item active">Assign Collection Areas</li>
                            </ol>
                        </div>
                        <div class="col-md-6 col-4 align-self-center">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Existing Applicants</label>
                                        <div class="col-md-9">
                                            <select class="form-control custom-select" data-placeholder="Choose a Collector" tabindex="1" id="collector" onchange="LoadSelection()">
                                                <?php
                                                $sql = mysqli_query($con, "SELECT
`user`.idUser,
user_details.Fname
FROM
`user`
INNER JOIN user_details ON `user`.User_Details_idUser_Details = user_details.idUser_Details
WHERE
`user`.User_Type_idUser_Type = 3");
                                                while ($result = mysqli_fetch_array($sql)) {
                                                    ?>
                                                    <option value="<?php echo $result['idUser'] ?>"><?php echo $result['Fname']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xlg-4  m-b-30" id="selectArea">
                                    <?php
                                    $uid = $_GET[uid];
                                    $sql = mysqli_query($con, "SELECT
collectionarea.CollectionArea,
collection_area_user.CollectionArea_idCollectionArea,
collection_area_user.User_idUser,
collectionarea.idCollectionArea
FROM
collection_area_user
INNER JOIN collectionarea ON collection_area_user.CollectionArea_idCollectionArea = collectionarea.idCollectionArea
WHERE
collection_area_user.User_idUser = '$uid'");
                                    $selectedArea = "";
                                    while ($result = mysqli_fetch_array($sql)) {
                                        if ($selectedArea == "") {
                                            $selectedArea = $result['CollectionArea_idCollectionArea'];
                                        } else {
                                            $selectedArea = $selectedArea . "," . $result['CollectionArea_idCollectionArea'];
                                        }
                                    }
                                    ?>
                                    <input type="hidden" name="selectedAreas" value="<?php echo $selectedArea; ?>" />

                                    <h5 class="box-title">Assigned Areas for Collector</h5>
                                    <select id='pre-selected-options' multiple='multiple'>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT
collectionarea.CollectionArea,
collectionarea.idCollectionArea
FROM
collectionarea
WHERE
collectionarea.`Status` = '1'");
                                        while ($result2 = mysqli_fetch_array($sql)) {
                                            ?>
                                            <option value='elem_1'><?php echo $result2['CollectionArea']; ?></option>
                                        <?php } ?>
                                            <option value='elem_1'>abc</option>
                                    </select>


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

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/plugins/multiselect/js/jquery.multi-select.js"></script>
    <script>
                                                jQuery(document).ready(function () {
                                                    // Switchery
                                                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                                                    $('.js-switch').each(function () {
                                                        new Switchery($(this)[0], $(this).data());
                                                    });
                                                    // For select 2
                                                    $(".select2").select2();
                                                    $('.selectpicker').selectpicker();
                                                    //Bootstrap-TouchSpin
                                                    $(".vertical-spin").TouchSpin({
                                                        verticalbuttons: true,
                                                        verticalupclass: 'ti-plus',
                                                        verticaldownclass: 'ti-minus'
                                                    });
                                                    var vspinTrue = $(".vertical-spin").TouchSpin({
                                                        verticalbuttons: true
                                                    });
                                                    if (vspinTrue) {
                                                        $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
                                                    }
                                                    $("input[name='tch1']").TouchSpin({
                                                        min: 0,
                                                        max: 100,
                                                        step: 0.1,
                                                        decimals: 2,
                                                        boostat: 5,
                                                        maxboostedstep: 10,
                                                        postfix: '%'
                                                    });
                                                    $("input[name='tch2']").TouchSpin({
                                                        min: -1000000000,
                                                        max: 1000000000,
                                                        stepinterval: 50,
                                                        maxboostedstep: 10000000,
                                                        prefix: '$'
                                                    });
                                                    $("input[name='tch3']").TouchSpin();
                                                    $("input[name='tch3_22']").TouchSpin({
                                                        initval: 40
                                                    });
                                                    $("input[name='tch5']").TouchSpin({
                                                        prefix: "pre",
                                                        postfix: "post"
                                                    });
                                                    // For multiselect
                                                    $('#pre-selected-options').multiSelect();
                                                    $('#optgroup').multiSelect({
                                                        selectableOptgroup: true
                                                    });
                                                    $('#public-methods').multiSelect();
                                                    $('#select-all').click(function () {
                                                        $('#public-methods').multiSelect('select_all');
                                                        return false;
                                                    });
                                                    $('#deselect-all').click(function () {
                                                        $('#public-methods').multiSelect('deselect_all');
                                                        return false;
                                                    });
                                                    $('#refresh').on('click', function () {
                                                        $('#public-methods').multiSelect('refresh');
                                                        return false;
                                                    });
                                                    $('#add-option').on('click', function () {
                                                        $('#public-methods').multiSelect('addOption', {
                                                            value: 42,
                                                            text: 'test 42',
                                                            index: 0
                                                        });
                                                        return false;
                                                    });
                                                    $(".ajax").select2({
                                                        ajax: {
                                                            url: "https://api.github.com/search/repositories",
                                                            dataType: 'json',
                                                            delay: 250,
                                                            data: function (params) {
                                                                return {
                                                                    q: params.term, // search term
                                                                    page: params.page
                                                                };
                                                            },
                                                            processResults: function (data, params) {
                                                                // parse the results into the format expected by Select2
                                                                // since we are using custom formatting functions we do not need to
                                                                // alter the remote JSON data, except to indicate that infinite
                                                                // scrolling can be used
                                                                params.page = params.page || 1;
                                                                return {
                                                                    results: data.items,
                                                                    pagination: {
                                                                        more: (params.page * 30) < data.total_count
                                                                    }
                                                                };
                                                            },
                                                            cache: true
                                                        },
                                                        escapeMarkup: function (markup) {
                                                            return markup;
                                                        }, // let our custom formatter work
                                                        minimumInputLength: 1,
                                                        templateResult: formatRepo, // omitted for brevity, see the source of this page
                                                        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
                                                    });
                                                });
    </script>

</html>