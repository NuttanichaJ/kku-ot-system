<?php 
    session_start();
    require_once '../config.php';
    require_once '../editProject.php';
    require_once '../print.php';

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
                    <a class="nav-link" href="#">
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
                        <h3 class="page-title">กำหนดการเบิก</h3>
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
                                                                echo "<th>รูปแบบการเบิก</th>";
                                                                echo "<th>ผู้จัดทำรายการ</th>";
                                                                echo "<th>วันที่สร้างการเบิก</th>";
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
                                                                    echo "<a type='button' id='edit' class='edit text-primary' ><i
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
                                                        <h4 class="modal-title" id="myModalLabel">เพิ่มการเบิกใหม่</h4>
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
                                                                        class="form-control border border-secondary" value="3"<?php 
                                                                        
                                                                        echo '3';
                                                                        ?>"
                                                                        readonly>

                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label
                                                                    class="col-sm-3 control-label" for="inputLocation">
                                                                    รูปแบบการเบิก:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="txtProject_name"
                                                                        class="form-control border border-secondary"
                                                                        required>
                                                                    <div class="invalid-feedback">กรุณาใส่รูปแบบการเบิก
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-6 control-label"
                                                                    for="inputDate">ผู้จัดทำรายการ:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="txtCreate_by"
                                                                        class="form-control border border-secondary"
                                                                        required>
                                                                    <div class="invalid-feedback">กรุณาใส่ชื่อผู้จัดทำ
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                            
                                                            <label
                                                                    class="col-sm-3 control-label" for="inputLocation">
                                                                    ค่าล่วงเวลา:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="txtProject_name"
                                                                        class="form-control border border-secondary"
                                                                        required>
                                                                    <div class="invalid-feedback">กรุณาใส่รูปแบบการเบิก
                                                                    </div>
                                                                
                                                                </div>
                                                                <label style="color: gray; padding-top: 8px;" 
                                                                    class="col-sm-10 control-label" for="inputLocation">
                                                                    กรณีแบบรายชั่วโมง กรุณาใส่เป็น บาท/ชั่วโมง</label>
                                                                    <label style="color: gray;" 
                                                                    class="col-sm-10 control-label" for="inputLocation">
                                                                    กรณีแบบรายคาบ กรุณาใส่เป็น คาบ/ชั่วโมง</label>
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
 <!-- Modal: Add new Project -->
 <div class="modal fade" id="edit_otType" tabindex="-1" role="dialog"
                                            aria-labelledby="modalLabel" aria-hidden="true" le="display: block;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!--Header-->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">แก้ไขการเบิก</h4>
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
                                                                        
                                                                        echo '3';
                                                                        ?>"
                                                                        readonly>

                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label
                                                                    class="col-sm-3 control-label" for="inputLocation">
                                                                    รูปแบบการเบิก:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="txtProject_name"
                                                                        class="form-control border border-secondary"
                                                                        value='แบบรายวัน กรณีวันปกติ' required>
                                                                    <div class="invalid-feedback">กรุณาใส่รูปแบบการเบิก
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-6 control-label"
                                                                    for="inputDate">ผู้จัดทำรายการ:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="txtCreate_by"
                                                                        class="form-control border border-secondary"
                                                                        value='นายกขค' required>
                                                                    <div class="invalid-feedback">กรุณาใส่ชื่อผู้จัดทำ
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                            
                                                            <label
                                                                    class="col-sm-3 control-label" for="inputLocation">
                                                                    ค่าล่วงเวลา:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="txtProject_name"
                                                                        class="form-control border border-secondary"
                                                                        value='200' required>
                                                                    <div class="invalid-feedback">กรุณาใส่รูปแบบการเบิก
                                                                    </div>
                                                                
                                                                </div>
                                                                
                                                            </div>

                                                            <!--Footer-->
                                                            <div class="modal-footer">
                                                                <button class="btn btn-warning"
                                                                    type="submit" name="addproject">แก้ไข</button>
                                                                
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

    <!-- confirm delete -->
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
        function checkDelete() {
            return confirm('ต้องการลบรูปแบบการเบิกนี้ใช่หรือไม่');
        }
    </script>

    <!-- Ajax data Search -->
    <script>
        $(document).ready(function () {
            $('search_text').keyup(fucntion() {
                var txt = $(this).val();
                if(txt != '') {

            } else {
                $('#result').html('');
                $.ajax({
                    url: "ot_type.php",
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
            $('.edit').click(function () {
                //get data from date div (calendar.php)
                //var date = $(this).attr('data-date');
                //set value to modal
                //$('#datepick').val(date);

                $('#edit_otType').modal('show');
            })

        </script>
</body>

</html>