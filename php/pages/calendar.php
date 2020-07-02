<?php 
    session_start();
    require_once '../calendar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PHP Calendar</title>

    <link rel="stylesheet" href="../../assets/css/holidayCalendar-style.css">
</head>

<body>
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
                                                        calendar();
                                                    
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
                                                    <form class="form-horizontal" id="addholiday" method="post" novalidate>
                                                        <div class="date">
                                                            <h5 class="text-center" name="date"><?php ?></h5>
                                                        </div>

                                                        <div class="form-group"><label class="col-sm-3 control-label"
                                                                for="inputTitle">หัวข้อ:</label>
                                                            <div class="col-sm-7"><input type="text" name="holiday_desc"
                                                                    class="form-control" maxlength="32" value="วันหยุด" required>
                                                            </div>
                                                            <div class="invalid-feedback">กรุณาใส่หัวข้อ
                                                                    </div>
                                                        </div>
                                                        <div class="form-group"><label class="col-sm-3 control-label"
                                                                for="inputLocation">การเบิกจ่าย:</label>
                                                            <div class="col-sm-7">
                                                                <select class="mdb-select md-form" name="can_work" required>
                                                                    <option value="Y">เบิกได้</option>
                                                                    <option value="N">เบิกไม่ได้</option>
                                                                </select>
                                                            </div>
                                                            <div class="invalid-feedback">กรุณาเลือก
                                                                    </div>
                                                        </div>
                                                    
                                                        <div class="modal-footer">
                                                            <button name='addholiday' type='submit'
                                                                class="btn btn-success">ตกลง</button>
                                                        </div>
                                                    </form>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End modal: Add Holiday -->
</body>

</html>