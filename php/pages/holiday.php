<?php 
    session_start();
    require_once '../config.php';
    require_once '../calendar.php';
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
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <!-- End layout styles -->

    <!-- Calendar -->
    <link rel="stylesheet" href="../../assets/css/holidayCalendar-style.css">
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
                    <a class="nav-link" href="#">
                        <i class="mdi mdi-calendar-range menu-icon"></i>
                        <span class="menu-title">กำหนดวันหยุด</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <!-- partial:../../partials/_navbar.html -->
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
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">จัดทำแบบทำงานนอกเวลา</h3>
                    </div>
                    <!-- first row starts here -->
                    <div class="row">
                        <div class="col-lg-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="wrapper-calendar">
                                            <div class="calendar">
                                                <div class="month">
                                                    <div class="prev">
                                                        <a href="?ym=<?php echo $_SESSION['prev']; ?>">&#10094</a>
                                                    </div>
                                                    <div>
                                                        <h5 class="text-center" id="month">
                                                            <?php echo $_SESSION['html_title']; ?></h5>

                                                    </div>
                                                    <div class="next">
                                                        <a href="?ym=<?php echo $_SESSION['next']; ?>">&#10095</a>
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

                                    <!-- modal: Add Holiday -->
                                    <div id="addHoliday" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="modalLabel" area-hidden="true" le="display: block;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 id="myModalLabel">เพิ่มวันหยุด</h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>


                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="editholiday" method="post" novalidate>
                                                        <div class="date">
                                                            <h5 class="text-center" name="date"></h5>
                                                        </div>

                                                        <div class="form-group"><label class="col-sm-3 control-label"
                                                                for="inputTitle">หัวข้อ</label>
                                                            <div class="col-sm-7"><input type="text" name="holiday_desc"
                                                                    class="form-control" maxlength="32" value="วันหยุด" required>
                                                            </div>
                                                            <div class="invalid-feedback">กรุณาใส่หัวข้อ
                                                                    </div>
                                                        </div>
                                                        <div class="form-group"><label class="col-sm-3 control-label"
                                                                for="inputLocation">การเบิกจ่าย</label>
                                                            <div class="col-sm-7">
                                                                <select class="mdb-select md-form" name="can_work" required>
                                                                    <option value="" disabled="" selected=""></option>
                                                                    <option value="Y">เบิกได้</option>
                                                                    <option value="N">เบิกไม่ได้</option>
                                                                </select>
                                                            </div>
                                                            <div class="invalid-feedback">กรุณาเลือก
                                                                    </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" name="addholiday"
                                                        class="btn btn-success">ตกลง</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End modal: Add Holiday -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php  mysqli_close($conn); ?>
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->

    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->

</body>

</html>