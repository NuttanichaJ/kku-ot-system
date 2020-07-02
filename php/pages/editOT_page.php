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

    
 
        
        //INSERT holiday
        $holiday_date = $holiday_desc = $can_work = $create_date = "";
    
        
        if(isset($_POST["addholiday"])){

            $holiday_desc = trim($_POST["holiday_desc"]);
            $can_work = trim($_POST["can_work"]);
            //$create_by = trim($_POST["txtCreate_by"]);
            $holiday_date = $_POST["datepick"];
            date_default_timezone_set('asia/bangkok');
            $create_date = date("Y-m-d H:i:s");
            $sqlInsert = "INSERT INTO ot_holiday(FACULTY_ID, HOLIDAY_DATE,HOLIDAY_DESC,CAN_WORK, CREATE_DATE) VALUES ('1','$holiday_date','$holiday_desc', '$can_work', '$create_date')";
            mysqli_query($conn, $sqlInsert);
        }


        //DELETE holiday
    if(isset($_POST['deleteholiday'])) {
        
        //$create_by = trim($_POST["txtCreate_by"]);
        $holiday_date = $_POST["datepick"];
        
        $sqlDelete = "DELETE FROM ot_holiday WHERE HOLIDAY_DATE='$holiday_date'";
        $result = mysqli_query($conn, $sqlDelete);

        header("location: holiday.php");
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
                    <a class="nav-link" href="#">
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
                        <p>จำนวนเงินรวม 0 บาท</p>

                    </div>
                    <!-- first row starts here -->
                    <div class="row">
                        <div class="col-lg-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <form method="POST">
                                            <div class="form-group d-flex">
                                                <label class="control-label" for="inputTitle">ID:</label>
                                                <div class="col-sm-2">
                                                    <input type="text" name="txtOT_ID"
                                                        class="form-control border border-secondary" value="<?php echo $row['OT_ID']; ?>" readonly>
                                                </div>
                                                <label class="control-label"> &nbsp; &nbsp; ชื่อโครงการ:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="txtProject_name" class="form-control border border-secondary" value="<?php echo $row['OT_NAME']; ?>" required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group d-flex">
                                                <label class="control-label">ชื่อผู้จัดทำโครงการ:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="txtCreate_by" class="form-control border border-secondary" value="<?php echo $row['CREATE_BY']; ?>" required>
                                                </div>
                                                 <label class="control-label">&nbsp; &nbsp; ลงนาม:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="signer" class="form-control border border-secondary" value="<?php echo $row['SIGNER']; ?>">
                                                </div>

                                                <button class="btn btn-light" type="submit" name="update_project">แก้ไข</button>
                                            </div>
                                        </form>



                                        <!-- Horizontal rule -->
                                        <hr>

                                        <div class="container-2">
                                            <div class="wrapper-calendar">
                                                <div class="calendar">
                                                    <div class="left-side">
                                                        <table class="editOt_table table table-striped table-bordered">
                                                            <thead>
                                                                <tr class="text-white text-center">
                                                                    <th></th>
                                                                    <th>ID</th>
                                                                    <th class="col-sm-3">ชื่อ</th>
                                                                    <th>บาท</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr>
                                                                    <td><a type="button"
                                                                            class="mdi mdi-account-edit text-primary"
                                                                            data-target='#editOT'
                                                                            data-toggle='modal'></a>
                                                                    </td>
                                                                    <td><?php //echo $s;?></tdclass=>
                                                                    <td><?php //echo $val['username'];?></tdass=>
                                                                    <td><?php //echo $val['useremail'];?></td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="right-side">
                                                        <div class="month">
                                                            <div class="prev">
                                                                <a data-otID="<?php echo $ot_id ?>"
                                                                    href="?ym=<?php echo $_SESSION['prev']; ?>&edit_id=<?php  echo $row['OT_ID'] ?>">&#10094</a>
                                                            </div>
                                                            <div>
                                                                <h5 class="text-center" id="month">
                                                                    <?php echo $_SESSION['html_title']; ?></h5>

                                                            </div>
                                                            <div class="next">
                                                                <a data-otID="<?php echo $ot_id ?>"
                                                                    href="?ym=<?php echo $_SESSION['next']; ?>&edit_id=<?php  echo $row['OT_ID'] ?>">&#10095</a>
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

</body>

</html>