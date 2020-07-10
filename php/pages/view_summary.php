<?php 
    session_start();
    require_once '../config.php';

    if (!isset($_SESSION['login_userName'])) {
        header('location: login_page.php');
    }

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

    <link rel="stylesheet" href="../../assets/css/view-summary.css">

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
                            <a href="index.php?logout='1'" class="btn btn-sm btn-dark">ออกจากระบบ</a>
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
                                        echo $row['TOTAL_AMOUNT'];
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
                                                <label class="control-label">เจ้าของโครงการ:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="txtOT_owner"
                                                        class="form-control border border-secondary"
                                                        value="<?php echo $row['OT_OWNER']; ?>" required>
                                                </div>
                                                <label class="control-label">&nbsp; &nbsp; ลงนาม:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="signer"
                                                        class="form-control border border-secondary"
                                                        value="<?php echo $row['SIGNER']; ?>">
                                                </div>
                                            </div>
                                        </form>



                                        <!-- Horizontal rule -->
                                        <hr>

                                        <div class="container-2">
                                            <div class="view-table">
                                                    
                                                        <form method="POST">
                                                            <?php
                                                            $sql = "SELECT HR_ID, NAME, SURNAME, SUM(AMOUNT) as total FROM ot_item WHERE OT_ID = $ot_id GROUP BY HR_ID";
                                                            if($result = mysqli_query($conn, $sql)) {
                                                                if(mysqli_num_rows($result) > 0) {
                                                                    echo "<table class='show_table table table-striped table-bordered'>";
                                                                        echo "<thead>";
                                                                            echo "<tr class='text-white text-center'>";
                                                                                
                                                                                echo "<th>ID</th>";
                                                                                echo "<th class='col-sm-3'>ชื่อ</th>";
                                                                                echo "<th>บาท</th>";
                                                                            echo "</tr>";
                                                                        echo "</thead>";
                                                                        echo "<tbody>";
                                                                        while($row = mysqli_fetch_array($result)) {
                                                                            echo "<tr>";
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