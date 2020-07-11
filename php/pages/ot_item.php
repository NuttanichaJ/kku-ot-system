<?php 
    session_start();
    require_once '../config.php';
    require_once '../editOT.php';

    if (!isset($_SESSION['login_userName'])) {
        header('location: login_page.php');
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>ระบบงาน OT</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
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
                <li class="nav-item">
                    <a class="nav-link" href="ot_type.php">
                        <i class="mdi mdi-library-plus menu-icon"></i>
                        <span class="menu-title">กำหนดการเบิก</span>
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
                            <a href="index.php?logout='1'" class="btn btn-sm btn-dark">ออกจากระบบ</a>
                        </li>

                        <li class="nav-item nav-logout d-none d-lg-block">
                            <a class="nav-link" href="index.php">
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
                        <h3 class="page-title">แก้ไขข้อมูล</h3>
                    </div>
                    <!-- first row starts here -->
                    <div class="row">
                        <div class="col-lg-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        
                                        <?php
                                            $hr_id = $_GET['hr_id'];
                                            $ot_id = $_GET['ot_id'];
                                            $sql = "SELECT * FROM ot_item WHERE HR_ID=$hr_id AND OT_ID=$ot_id";
                                            if($result = mysqli_query($conn, $sql)) {
                                                if(mysqli_num_rows($result) > 0) {
                                                    echo "<table class='table table-striped table-bordered' id='table-data'>";
                                                        echo "<thead>";
                                                            echo "<tr class='bg-primary text-white text-center'>";
                                                                echo "<th>วันที่</th>";
                                                                echo "<th>เวลาเข้า</th>";
                                                                echo "<th>เวลาออก</th>";
                                                                echo "<th>ยอด</th>";
                                                                echo "<th></th>";
                                                            echo "</tr>";
                                                        echo "</thead>";
                                                        echo "<tbody>";
                        
                                                        while($row = mysqli_fetch_array($result)){
                                                            
                                                            echo "<tr>";
                                                                echo "<td>" . $row['WORK_DATE'] . "</td>";
                                                                echo "<td>" . $row['WORK_FROM'] . "</td>";
                                                                echo "<td>" . $row['WORK_TO'] . "</td>";
                                                                echo "<td>" . $row['AMOUNT'] . "</td>";
                                                                echo "<td align='center'>";
                                                                echo "<a href='../editOT.php?deleteOTItem=" . $row['ITEM_ID'] . "&hr_id=" . $hr_id . "&ot_id=" . $ot_id . "' class='text-danger' onClick='return checkDelete();'><i class='mdi mdi-delete'></i> ลบ</a>";
                                                                echo "</td>"; 
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
                                    </div>
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

    
    <script>
        // <!-- confirm delete -->
        function checkDelete() {
            return confirm('ต้องการลบโครงการนี้ใช่หรือไม่');
        }
    </script>
</body>

</html>