<?php 
    session_start();
    require_once '../config.php';
    require_once '../holidayCalendar.php';



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
                        <h3 class="page-title">กำหนดวันหยุด</h3>
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
                                    <!-- modal: delete holiday -->
                                    <div id="editHoliday" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="modalLabel" area-hidden="true" le="display: block;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 id="myModalLabel">แก้ไขวันหยุด</h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form class="needs-validation" class="form-horizontal" method="post" novalidate>
                                                        
                                                    <div class="form-group">
                                                    <label class="col-sm-3 control-label">วันที่:</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" id="datepick" name="datepick"
                                                                    class="form-control" maxlength="32" value='เวลา' readonly>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <label class="col-sm-3 control-label">หัวข้อ:</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" id="holiday_desc" name="holiday_desc"
                                                                    class="form-control" maxlength="32" readonly>
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <label class="col-sm-3 control-label">การเบิกจ่าย:</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" id="can_work" name="can_work"
                                                                    class="form-control" maxlength="32" readonly>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer editOT">
                                            
                                                    <button name='deleteholiday' id='deleteholiday' type='submit' 
                                                                class="btn btn-danger">ลบ</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End modal: delete holiday-->

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
                                                    <form class="needs-validation" class="form-horizontal" method="post" novalidate>
                                                        
                                                        <div class="form-group">
                                                        <label class="col-sm-3 control-label">วันที่:</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" id="date_pick" name="date_pick" class="form-control" maxlength="32" value='เวลา' readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <label class="col-sm-3 control-label">หัวข้อ:</label>
                                                            <div class="col-sm-7"><input type="text" id="holiday_desc" name="holiday_desc"
                                                                    class="form-control" maxlength="32" value="วันหยุด" required>
                                                            <div class="invalid-feedback">กรุณาใส่หัวข้อ</div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">การเบิกจ่าย:</label>
                                                                
                                                            <div class="col-sm-7">
                                                                <select class="mdb-select md-form" name="can_work" required>
                                                                    <option value="Y">เบิกได้</option>
                                                                    <option value="N">เบิกไม่ได้</option>
                                                                </select>
                                                                <div class="invalid-feedback">กรุณาใส่การเบิกจ่าย</div>
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                        <div class="modal-footer">
                                                            <button name='addholiday' id='addholiday' type='submit' 
                                                                class="btn btn-success">ตกลง</button>

                                                        </div>                           
                                                    </form>
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


        $('.holiday').click(function(){
            //get data from date div (holidayCalendar.php)
            var date = $(this).attr('data-date');
            var can_work = $(this).attr('data-canwork');
            var holiday_desc = $(this).attr('data-holidaydesc');


            if(can_work == 'Y') {
                can_work = 'เบิกได้';
            } else {
                can_work = 'เบิกไม่ได้';
            }
            //set value to modal
            $('#datepick').val(date);
            $('#can_work').val(can_work);
            $('#holiday_desc').val(holiday_desc);
            $('#editHoliday').modal('show');
        })
        
        
        $('.day').click(function(){
            //get data from date div (holidayCalendar.php)
            var date = $(this).attr('data-date');
            //set value to modal
            $('#date_pick').val(date);

            $('#addHoliday').modal('show');
        })
    
    </script>
  
</body>

</html>