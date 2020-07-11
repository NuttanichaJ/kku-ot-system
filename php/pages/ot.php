<?php 
    session_start();
    require_once '../config.php';
    require_once '../editProject.php';
    require_once '../print.php';

    if (!isset($_SESSION['login_userName'])) {
        header('location: login_page.php');
    }

    $userID = $_SESSION['login_userID'];

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
                        <h3 class="page-title">จัดทำแบบทำงานนอกเวลา</h3>
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
                                        <div class="btn-select">
                                            <button type="button" name="btn-add" id="btn-add" method="POST" class="mdi mdi-plus btn btn-success"
                                                data-toggle="modal" data-target="#modalAdd" href="../editProject.php">
                                                เพิ่มใหม่</button>

                                        </div>

                                        <?php
                                            
                                            if(isset($_POST["search"])) {
                                                $search = trim($_POST["search"]);
                                                $sql = "SELECT OT_ID, OT_NAME, CREATE_USER_TEXT, CREATE_DATE, CREATE_ID FROM ot_project 
                                                  WHERE (OT_NAME LIKE '%".$search."%' AND CREATE_ID = $userID) OR (CREATE_USER_TEXT LIKE '%".$search."%' AND CREATE_ID = $userID) ORDER BY CREATE_DATE DESC";
                                              } else {
                                                $sql = "SELECT OT_ID, OT_NAME, CREATE_USER_TEXT, CREATE_DATE FROM ot_project
                                                WHERE CREATE_ID = $userID ORDER BY CREATE_DATE DESC";
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
                                                                echo "<th>พิมพ์</th>";
                                                                echo "<th></th>";
                                                            echo "</tr>";
                                                        echo "</thead>";
                                                        echo "<tbody>";
                        
                                                        while($row = mysqli_fetch_array($result)){
                                                            
                                                            echo "<tr>";
                                                                echo "<td>" . $row['OT_ID'] . "</td>";
                                                                echo "<td>" . $row['OT_NAME'] . "</td>";
                                                                echo "<td>" . $row['CREATE_USER_TEXT'] . "</td>";
                                                                echo "<td>" . $row['CREATE_DATE'] . "</td>";
                                                                echo "<td align='center'>";
                                                                    echo "<a type='button' class='print text-dark' data-ot-id =" . $row['OT_ID'] ." ><i
                                                                        class='mdi mdi-cloud-print-outline'></i>
                                                                        พิมพ์</a>";
                                                                echo "</td>";
                                                                echo " <td align='center'>";
                                                                    echo "<a href='editOT_page.php?edit_id=" . $row['OT_ID'] . "' class='text-primary' ><i
                                                                    class='mdi mdi-pencil'></i> แก้ไข</a> ";
                                                                    echo "|";
                                                                    echo " <a href='../editProject.php?deleteproject=" . $row['OT_ID'] . "' class='text-danger'
                                                                    onClick='return checkDelete();'><i
                                                                        class='mdi mdi-delete'></i> ลบ</a>";
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

                                        <!-- Modal: Add new Project -->
                                        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog"
                                            aria-labelledby="modalLabel" aria-hidden="true" le="display: block;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!--Header-->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">เพิ่มโครงการใหม่</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <!--Body-->
                                                    <div class="modal-body">
                                                        <form class="needs-validation" id="addproject" method="POST"
                                                            novalidate>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label"
                                                                    for="inputTitle">ID:</label>
                                                                <div class="col-sm-3">
                                                                    <input type="text" name="txtOT_ID"
                                                                        class="form-control border border-secondary" value="<?php 
                                                                        
                                                                        echo $_SESSION['newot_id'];
                                                                        ?>"
                                                                        readonly>

                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label
                                                                    class="col-sm-3 control-label" for="inputLocation">
                                                                    ชื่อโครงการ:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="txtProject_name"
                                                                        class="form-control border border-secondary"
                                                                        required>
                                                                    <div class="invalid-feedback">กรุณาใส่ชื่อโครงการ
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-6 control-label">เจ้าของโครงการ:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="txtOT_owner"
                                                                        class="form-control border border-secondary"
                                                                        value="<?php 
                                                                        
                                                                        echo $_SESSION['login_hrName'];
                                                                        ?>" required>
                                                                    <div class="invalid-feedback">กรุณาใส่เจ้าของโครงการ
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--Footer-->
                                                            <div class="modal-footer">
                                                                <button class="btn btn-success"
                                                                    type="submit" name="addproject">เพิ่ม</button>
                                                                <button type="button" class="btn btn-outline-danger"
                                                                    data-dismiss="modal" id="close">ยกเลิก</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal: Print -->
                                        <div class="modal fade" id="modalPrint" tabindex="-1" role="dialog"
                                            aria-labelledby="modalLabel" aria-hidden="true" le="display: block;">
                                            <div class="modal-dialog print" role="document" >
                                                <div class="modal-content">
                                                    <!--Header-->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">พิมพ์รายงาน</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <!--Body-->
                                                    <div class="modal-body">
                                                        <form class="needs-validation" id="print" method="POST">
                                                            <div class="form-group">
                                                                <label class="sm-3  mr-2">ID:</label>
                                                                <input type="text" name="txtOT_ID" id="txtOT_ID"
                                                                    class="border border-secondary" size="4" value="<?php echo '1'; ?>" disabled="disabled">
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="select-branch mr-2">ประจำเดือน:</label>
                                                                <input type="date" name="print_todate"
                                                                    value="<?php echo date("Y-m-d");?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="btn-print">
                                                                    <button class="printForm" type="button" name="btnPrintRegisTimeForm01">1.บัญชีเวลาการปฏิบัติงานนอกเวลาราชการปกติ</button>
                                                                </div>
                                                                <div class="btn-print">
                                                                    <button class="printForm" type="button" name="btnPrintRegisTimeForm02">2.หลักฐานการจ่ายเงินตอบแทนการปฏิบัติงานนอกเวลาราชการปกติ(ใบฟ้า)</button>
                                                                </div>
                                                                <div class="btn-print">
                                                                    <button class="printForm" type="button" name="btnPrintRegisTimeForm03">3.แบบสรุปวันปฏิบัติงานนอกเวลาราชการปกติ</button>
                                                                </div>
                                                            </div>

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
            return confirm('ต้องการลบโครงการนี้ใช่หรือไม่');
        }
    </script>

    <!-- Ajax data Search -->
    <script>
        (document).ready(function () {
            $('#search_text').keyup(function(){
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

    <script>
        $('.print').click(function () {
            //get data from edit
            var ot_id = $(this).attr('data-ot-id');

            //set value to modal
            $('#txtOT_ID').val(ot_id);

            $('#modalPrint').modal('show');
        })

    </script>
</body>

</html>