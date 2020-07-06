<?php 
    session_start();
    require_once '../config.php';
    require_once '../editOT.php';
    require_once '../otCalendar.php';

    $ot_id = $_GET['edit_id'];
    $sql = "SELECT * FROM ot_project WHERE OT_ID ='$ot_id'";

    $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Plus Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->

    <link rel="stylesheet" href="../../assets/css/editOT.css">

    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <!-- End layout styles -->




</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item border-bottom">
                    <div class="nav-item-head">
                        <h3 href="#">ระบบงาน OT</h3>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="mdi mdi-home-circle menu-icon"></i>
                        <span class="menu-title">หน้าหลัก</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ot.php">
                        <i class="mdi mdi-file-document-box menu-icon"></i>
                        <span class="menu-title">จัดทำแบบทำงานนอกเวลา</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="holiday.php">
                        <i class="mdi mdi-calendar-range menu-icon"></i>
                        <span class="menu-title">กำหนดวันหยุด</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ot_type.php">
                        <i class="mdi mdi-library-plus menu-icon"></i>
                        <span class="menu-title">กำหนดการเบิก</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid page-body-wrapper">


            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-chevron-double-left"></span>
                    </button>

                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-logout d-none d-md-block">
                            <button class="btn btn-sm btn-dark">ออกจากระบบ</button>
                        </li>

                        <li class="nav-item nav-logout d-none d-lg-block">
                            <a class="nav-link" href="../index.html">
                                <i class="mdi mdi-home-circle"></i>
                            </a>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>


            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">แก้ไขจัดทำแบบทำงานนอกเวลา</h3>
                        <p>จำนวนเงินรวม <?php 
                                        $sum_allProject = "SELECT SUM(AMOUNT) as total FROM ot_item WHERE OT_ID = $ot_id";
                                        $query_sum = mysqli_query($conn, $sum_allProject);
                                        $result_sum = mysqli_fetch_array($query_sum);
                                        echo $result_sum['total'];
                                        ?> บาท</p>

                    </div>
                    <!-- first row starts here -->
                    <div class="row">
                        <div class="col-lg-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <form method="POST">
                                            <div class="form-group d-flex">
                                                <label class="control-label">ID:</label>
                                                <div class="col-sm-2">
                                                    <input type="text" name="txtOT_ID"
                                                        class="form-control border border-secondary"
                                                        value="<?php echo $row['OT_ID']; ?>" readonly>
                                                </div>
                                                <label class="control-label"> &nbsp; &nbsp; ชื่อโครงการ:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="txtProject_name"
                                                        class="form-control border border-secondary"
                                                        value="<?php echo $row['OT_NAME']; ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group d-flex">
                                                <label class="control-label">ชื่อผู้จัดทำโครงการ:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="txtCreate_by"
                                                        class="form-control border border-secondary"
                                                        value="<?php echo $row['CREATE_BY']; ?>" required>
                                                </div>
                                                <label class="control-label">&nbsp; &nbsp; ลงนาม:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="signer"
                                                        class="form-control border border-secondary"
                                                        value="<?php echo $row['SIGNER']; ?>">
                                                </div>

                                                <button class="btn btn-light" type="submit"
                                                    name="update_project">แก้ไข</button>
                                            </div>
                                        </form>



                                        <!-- Horizontal rule -->
                                        <hr>

                                        <div class="container-2">
                                            <div class="wrapper-calendar">
                                                <div class="calendar">
                                                    <div class="left-side">
                                                        <form method="POST">
                                                            <?php
                                                            $sql = "SELECT HR_ID, NAME, SURNAME, SUM(AMOUNT) as total FROM ot_item WHERE OT_ID = $ot_id GROUP BY HR_ID";
                                                            if($result = mysqli_query($conn, $sql)) {
                                                                if(mysqli_num_rows($result) > 0) {
                                                                    echo "<table class='editOt_table table table-striped table-bordered'>";
                                                                        echo "<thead>";
                                                                            echo "<tr class='text-white text-center'>";
                                                                                echo "<th></th>";
                                                                                echo "<th>ID</th>";
                                                                                echo "<th class='col-sm-3'>ชื่อ</th>";
                                                                                echo "<th>บาท</th>";
                                                                            echo "</tr>";
                                                                        echo "</thead>";
                                                                        echo "<tbody>";
                                                                        while($row = mysqli_fetch_array($result)) {
                                                                            echo "<tr>";
                                                                                echo "<td><a href='ot_item.php?hr_id=" . $row['HR_ID'] ."&ot_id=" . $ot_id ."' type='button' class='manage mdi mdi-account-edit text-primary' name='manage' id='manage'></a></td>";
                                                                                echo "<td>" . $row['HR_ID'] . "</td>";
                                                                                echo "<td>" . $row['NAME'] . " " . $row['SURNAME'] . "</td>";
                                                                                echo "<td>" . $row['total'] . "</td>";
                                                                            echo "</tr>";
                                                                        }
                                                                        echo "</tbody>";
                                                                    echo "</table>";
                                                                    mysqli_free_result($result);
                                                                } else {
                                                                    echo "<p class='lead'><em>No records were found.</em></p>";
                                                                } 
                                                            }
                                                    ?>
                                                        </form>
                                                    </div>
                                                            
                                                    <div class="right-side">
                                                        <div class="month">
                                                            <div class="prev">
                                                                <a data-otID="<?php echo $ot_id ?>"
                                                                    href="?ym=<?php echo $_SESSION['prev']; ?>&edit_id=<?php  echo $ot_id ?>">&#10094</a>
                                                            </div>
                                                            <div>
                                                                <h5 class="text-center" id="month">
                                                                    <?php echo $_SESSION['html_title']; ?></h5>

                                                            </div>
                                                            <div class="next">
                                                                <a data-otID="<?php echo $ot_id ?>"
                                                                    href="?ym=<?php echo $_SESSION['next']; ?>&edit_id=<?php  echo $ot_id ?>">&#10095</a>
                                                            </div>
                                                        </div>

                                                        <div class="weekends">
                                                            <div>Sun</div>
                                                            <div>Mon</div>
                                                            <div>Tue</div>
                                                            <div>Wed</div>
                                                            <div>Thu</div>
                                                            <div>Fri</div>
                                                            <div>Sat</div>
                                                        </div>

                                                        <div class="days">
                                                            <?php
                                                                foreach ($weeks as $week) {
                                                                    echo $week;
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- modal: Add OTITEM -->
                                        <div id="addOTItem" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="modalLabel" area-hidden="true" le="display: block;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 id="myModalLabel">เพิ่ม</h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>


                                                    <div class="modal-body">
                                                        <form class="needs-validation" class="form-horizontal"
                                                            id="addOT" name="addOT" method="post" novalidate>
                                                            <input type="hidden" value='<?php echo $ot_id ?>'
                                                                name='ot_id'>
                                                            <input type="hidden" value='<?php echo $newOTItem_id?>'
                                                                name='otItem_id'>

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">วันที่:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" id="datepick" name="datepick"
                                                                        class="form-control" maxlength="32" value='เวลา'
                                                                        readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-group"><label
                                                                    class="col-sm-5 control-label">ชื่อ</label>
                                                                <div class="col-sm-7">
                                                                    <?php 
                                                                        echo '<select class="mdb-select md-form" name="create_by" required>';
                                                                        
                                                                        // $sqlOtType = "SELECT OTTYPE_NAME, OTTYPE_RATE FROM ot_type";

                                                                        // if($result_type = mysqli_query($conn, $sqlOtType)) {
                                                                        //     if(mysqli_num_rows($result_type) > 0) {
                                                                                
                                                                        //        echo '<option value="" disabled="" selected=""></option>';

                                                                        //         while($row = mysqli_fetch_array($result_type)){
                                                                                     echo "<option value='aaa'>aaa</option>";
                                                                        //         }
                                                                        //     }
                                                                        // }
                                                                        
                                                                        echo '</select>';
                                                                    ?>
                                                                    <div class="invalid-feedback">กรุณาเลือกชื่อ</div>
                                                                </div>

                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">การเบิก</label>
                                                                <div class="col-sm-7">
                                                                    <?php 
                                                                        echo '<select class="mdb-select md-form" name="ot_type" required>';
                                                                        
                                                                        $sqlOtType = "SELECT OT_TYPE, OTTYPE_RATE, OTTYPE_NAME FROM ot_type";


                                                                        if($result_type = mysqli_query($conn, $sqlOtType)) {
                                                                            if(mysqli_num_rows($result_type) > 0) {
                                                                                
                                                                                
                                                                                echo '<option value="" disabled="" selected=""></option>';

                                                                                while($row = mysqli_fetch_array($result_type)){

                                                                                    if($row['OT_TYPE'] == 1){
                                                                                        $ot_type = 'แบบเหมารายวัน';
                                                                                    } elseif($row['OT_TYPE'] == 2){
                                                                                        $ot_type = 'แบบรายคาบ';
                                                                                    } elseif($row['OT_TYPE'] == 3){
                                                                                        $ot_type = 'แบบรายชั่วโมง';
                                                                                    }
                                                                                    echo "<option value='". $row['OT_TYPE']."|". $row['OTTYPE_RATE']."'>". $ot_type." ". $row['OTTYPE_NAME']."</option>";
                                                                                }
                                                                            }
                                                                        }
                                                                        echo '</select>';
                                                                    ?>
                                                                    <div class="invalid-feedback">กรุณาเลือกการเบิก
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label
                                                                    class="col-sm-3 control-label">เวลาเข้า</label>
                                                                <div class="col-sm-7">
                                                                    <input type="time" class="form-control"
                                                                        maxlength="32" name='work_from' id='work_from'
                                                                        required>
                                                                    <div class="invalid-feedback">กรุณาใส่เวลาเข้า</div>
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">เวลาออก</label>
                                                                <div class="col-sm-7">
                                                                    <input type="time" name='work_to' id='work_to'
                                                                        class="form-control" maxlength="32" required>
                                                                    <div class="invalid-feedback">กรุณาใส่เวลาออก</div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" id="addNewOTItem"
                                                                    name="addNewOTItem"
                                                                    class="btn btn-success">ตกลง</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End modal: Add OT-->

                                        <!-- modal: Edit OT -->
                                        <div id="manageOTItem" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="modalLabel" area-hidden="true" le="display: block;">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 id="myModalLabel">แก้ไข</h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="needs-validation" method="post">
                                                            <input id='hr_id'>
                                                            <table class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <th>วันที่</th>
                                                                        <th>เวลาเข้า</th>
                                                                        <th>เวลาออก</th>
                                                                        <th>การเบิก</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 


                                                                            
                                                                                
                                                                            
                                                                        
                                                                        // $sql = "SELECT WORK_DATE, WORK_FROM, WORK_TO, AMOUNT as total FROM ot_item WHERE HR_ID=$hr_id AND OT_ID = $ot_id";
                                                                        // if($result = mysqli_query($conn, $sql)) {
                                                                        //     if(mysqli_num_rows($result) > 0) {
                                                                        //         while($row = mysqli_fetch_array($result_type)){
                                                                        //         echo "<tr>";
                                                                        //             echo "<td>" . $row['WORK_DATE'] . "</td>";
                                                                        //             echo "<td>" . $row['WORK_FROM'] . "</td>";
                                                                        //             echo "<td>" . $row['WORK_TO'] . "</td>";
                                                                        //             echo "<td><a href='../editOT.php?deleteOTItem=" . $row['OT_ID'] . "' class='text-danger'
                                                                        //                 onClick='return checkDelete();'><i class='mdi mdi-delete'></i> ลบ</a></td>";
                                                                        //         echo "</tr>";
                                                                        //         }
                                                                        //     }
                                                                        // }    

                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-success">ตกลง</button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <!-- End modal: Edit OT-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->

    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <!-- endinject -->
    <script>
        //check input !empty
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // <!-- confirm delete -->
        function checkDelete() {
            return confirm('ต้องการลบใช่หรือไม่');
        }

       $('.day').click(function () {
            //get data from date div (calendar.php)
            var date = $(this).attr('data-date');
            //set value to modal
            $('#datepick').val(date);
            $('#addOTItem').modal('show');
        });

    </script>

</body>

</html>