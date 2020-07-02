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
                        <p>จำนวนเงินรวม 620 บาท</p>

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
                                                                    <td><?php echo '100000'?></td>
                                                                    <td><?php echo 'นายขอน แก่น'?></td>
                                                                    <td><?php echo '620'?></td>
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

                                        <!-- modal: Add OT -->
                                        <div id="addOT" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="modalLabel" area-hidden="true" le="display: block;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 id="myModalLabel">เพิ่ม</h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>


                                                    <div class="modal-body">
                                                        <form class="form-horizontal" id="addEvent" action=""
                                                            method="post" novalidate>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label"
                                                                    for="inputTitle">วันที่:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" id="datepick" name="datepick"
                                                                        class="form-control" maxlength="32" value='เวลา'
                                                                        readonly>

                                                                </div>
                                                            </div>

                                                            <div class="form-group"><label
                                                                    class="col-sm-5 control-label"
                                                                    for="inputLocation">ชื่อ</label>
                                                                <div class="col-sm-7">
                                                                    <select class="selectpicker mdb-select md-form"
                                                                        required>
                                                                        <option value="" disabled="" selected="">
                                                                        </option>
                                                                        <option value="1">ชื่อ1</option>
                                                                        <option value="2">ชื่อ2</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group"><label
                                                                    class="col-sm-4 control-label"
                                                                    for="inputTitle">การเบิก</label>
                                                                <div class="col-sm-7">
                                                                    <select class="mdb-select md-form">
                                                                        <option value="" disabled="" selected="">
                                                                        </option>
                                                                        <option value="1">รายวัน</option>
                                                                        <option value="2">รายคาบ</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label
                                                                    class="col-sm-3 control-label"
                                                                    for="inputTitle">เวลาเข้า</label>
                                                                <div class="col-sm-7"><input type="time"
                                                                        class="form-control" maxlength="32"
                                                                        style="font-size:16px;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label
                                                                    class="col-sm-3 control-label"
                                                                    for="inputTitle">เวลาออก</label>
                                                                <div class="col-sm-7"><input type="time"
                                                                        class="form-control" maxlength="32">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer addOT"><button type="button" id="addOT"
                                                            name="addOT" class="btn btn-success">ตกลง</button></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End modal: Add OT-->


                                        <!-- modal: Edit OT -->
                                        <div id="editOT" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="modalLabel" area-hidden="true" le="display: block;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 id="myModalLabel">แก้ไข</h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>วันที่</th>
                                                                    <th>เวลาเข้า</th>
                                                                    <th>เวลาออก</th>
                                                                   
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
				        // if(count($userData)>0){
					    //     $s	=	'';
					    //     foreach($userData as $val){
					    // 	    $s++;
		            ?>
                                                                <tr>
                                                                    
                                                                    <td><?php echo '2020-05-20';?></td>
                                                                    <td><?php echo '16.30';?></td>
                                                                    <td><?php echo '20.00';?></td>
                                                                    <td><a class="mdi mdi-trash-can-outline" type="button" name="deleteDataOT"></a></td>
                                                                </tr>
                                                                <tr>
                                                                    
                                                                    <td><?php echo '2020-07-02';?></td>
                                                                    <td><?php echo '08.30';?></td>
                                                                    <td><?php echo '16.30'?></td>
                                                                    <td><a class="mdi mdi-trash-can-outline" type="button" name="deleteDataOT"></a></td>
                                                                </tr>
                                                                <?php 
					    // 	}
					    // }else{
					    // ?>
                                                                <?php //} ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer editOT"><button type="button" id="editOT"
                                                            name="editOT" class="btn btn-success">ตกลง</button></div>
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



        <!-- plugins:js -->
        <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->

        <!-- inject:js -->
        <script src="../../assets/js/off-canvas.js"></script>
        <script src="../../assets/js/hoverable-collapse.js"></script>
        <script src="../../assets/js/misc.js"></script>
        <!-- endinject -->
        <script>
            $('.day').click(function () {
                //get data from date div (calendar.php)
                var date = $(this).attr('data-date');
                //set value to modal
                $('#datepick').val(date);

                $('#addOT').modal('show');
            })

        </script>

</body>

</html>