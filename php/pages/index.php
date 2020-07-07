<?php 
    session_start();
    require_once '../config.php';

    if (!isset( $_SESSION['login_userName'])) {
        header('location: login_page.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        session_unset();
        header('location: login_page.php');
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
                        <h3 class="page-title">ตารางสรุป</h3>
                    </div>
                    <!-- first row starts here -->
                    <div class="row">
                        <div class="col-lg-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="table-project">
                                            <div class="col-sm-12">
                                                <form method="post">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label>ค้นหา</label>
                                                                <input type="text" name="search" id="search_text"
                                                                    class="form-control form-control-sm border border-secondary"
                                                                    placeholder="ชื่อโครงการ/ผู้จัดทำรายการ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Horizontal rule -->
                                        <hr>

                                        <div class="clearfix"></div>
                                        <!-- Button trigger modal-->
                                        

                                        <?php
                                            
                                            if(isset($_POST["search"])) {
                                                $search = trim($_POST["search"]);
                                                $sql = "SELECT OT_ID, OT_NAME, CREATE_BY, CREATE_DATE FROM ot_project 
                                                  WHERE OT_NAME LIKE '%".$search."%' OR CREATE_BY LIKE '%".$search."%' ORDER BY CREATE_DATE DESC";
                                              } else {
                                                $sql = "SELECT OT_ID, OT_NAME, CREATE_BY, CREATE_DATE FROM ot_project ORDER BY CREATE_DATE DESC";
                                              }
                        
                                            if($result = mysqli_query($conn, $sql)) {
                                                if(mysqli_num_rows($result) > 0) {
                                                    
                                                    echo "<table class='table table-striped table-bordered' id='table-data'>";
                                                        echo "<thead>";
                                                            echo "<tr class='bg-primary text-white text-center'>";
                                                                echo "<th>รหัส</th>";
                                                                echo "<th>โครงการ</th>";
                                                                echo "<th>ผู้จัดทำรายการ</th>";
                                                                echo "<th>วันที่สร้างโครงการ</th>";
                                                                
                                                                echo "<th></th>";
                                                            echo "</tr>";
                                                        echo "</thead>";
                                                        echo "<tbody>";
                        
                                                        while($row = mysqli_fetch_array($result)){
                                                            
                                                            echo "<tr>";
                                                                echo "<td>" . $row['OT_ID'] . "</td>";
                                                                echo "<td>" . $row['OT_NAME'] . "</td>";
                                                                echo "<td>" . $row['CREATE_BY'] . "</td>";
                                                                echo "<td>" . $row['CREATE_DATE'] . "</td>";
                                                                
                                                                echo " <td align='center'>";
                                                                    echo "<a href='editOT_page.php?edit_id=" . $row['OT_ID'] . "' class='text-primary' ><i
                                                                    class='mdi mdi-magnify'></i> เรียกดู</a> ";
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

   

    <!-- Ajax data Search -->
    <script>
        $(document).ready(function () {
            $('search_text').keyup(fucntion() {
                var txt = $(this).val();
                if(txt != '') {

            } else {
                $('#result').html('');
                $.ajax({
                    url: "ot.php",
                    method: 'post',
                    data: { search: txt },
                    dataType: "text",
                    success: function (data) {
                        $('#table-data').html(data);
                    }
                });
            }
        });

        });
    </script>
</body>

</html>