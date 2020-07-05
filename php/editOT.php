<?php

    require_once 'config.php';
    //$ot_id = $project_name = $create_by = $sign = "";

    //UPDATE project
    if(isset($_POST['update_project'])) {
        
        $ot_id = $_POST["txtOT_ID"];
        $project_name = trim($_POST["txtProject_name"]);
        $create_by = trim($_POST["txtCreate_by"]);
        //$update_by = trim($_POST["txtUpdate_by"]);
        $signer = trim($_POST["signer"]);

        date_default_timezone_set('asia/bangkok');
        $update_date = date("Y/m/d H:i:s");
        $sqlUpdate = "UPDATE ot_project SET OT_NAME = '$project_name', CREATE_BY = '$create_by', UPDATE_DATE = '$update_date'
                        WHERE OT_ID = $ot_id";
        mysqli_query($conn, $sqlUpdate);
    } 

    //Find max OT_ITEM_ID
    $sql_maxItemID = "SELECT MAX(ITEM_ID) as maxotitem_id FROM ot_item";
    $result_maxItemID = mysqli_query($conn, $sql_maxItemID);
    $row = mysqli_fetch_assoc($result_maxItemID);
    $newOTItem_id  = $row['maxotitem_id'] + 1;
        
    //INSERT holiday
    if(isset($_POST["addNewOTItem"])){
        $ot_id = $_POST['ot_id'];
        $otItem_id = $_POST['otItem_id'];
        $work_date = $_POST['datepick'];
        $create_by = $_POST['create_by'];
        date_default_timezone_set('asia/bangkok');
        $create_date = date("Y-m-d H:i:s");
        $hr_id = 1;
        //get time work from-to
        $work_from = $_POST['work_from'];
        $work_to = $_POST['work_to'];
        //get mutiple values from select 
        $value = filter_input(INPUT_POST, 'ot_type');
        $exploded_value = explode('|', $value);
        $ot_type = $exploded_value[0];
        $ot_rate = $exploded_value[1];

        $err = check($conn, $hr_id, $work_date, $work_from, $work_to, $ot_id);
        if(!empty($err)) {
            showErr($err);
        } else {
            $amount = calculateAmount($ot_type, $work_from, $work_to, $ot_rate);
            $sqlInsert = "INSERT INTO ot_item(ITEM_ID, OT_ID, OT_TYPE, ITEM_STATUS, HR_ID, WORK_DATE, WORK_FROM, WORK_TO, AMOUNT, CREATE_BY, CREATE_DATE) 
                        VALUES ('$otItem_id','$ot_id','$ot_type', '5', $hr_id, '$work_date', '$work_from', '$work_to', '$amount', '$create_by', '$create_date')";
            mysqli_query($conn, $sqlInsert);
        }
       
    }


    function manageOTItem() {
        echo '<div id="manageOTItem" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="modalLabel" area-hidden="true" le="display: block;">';
                echo'<div class="modal-dialog modal-lg">';
                    echo'<div class="modal-content">';
                        echo'<div class="modal-header">';
                            echo'<h3 id="myModalLabel">แก้ไข</h3>';
                            echo'<button type="button" class="close" data-dismiss="modal"
                                 aria-hidden="true">×</button>';
                        echo'</div>';
                        echo'<div class="modal-body">';
                            echo'<form class="needs-validation" method="post">';
                                echo'<table class="table table-striped table-bordered">';
                                    echo'<thead>';
                                        echo'<tr class="text-center">';
                                            echo'<th>วันที่</th>';
                                            echo'<th>เวลาเข้า</th>';
                                            echo'<th>เวลาออก</th>';
                                            echo'<th>การเบิก</th>';
                                            echo'<th></th>';
                                        echo'</tr>';
                                    echo'</thead>';
                                    echo'<tbody>';
                                                                    
                                    $hr_id = $_GET['hr_id'];
                                    echo $hr_id;
                                    $sql = "SELECT WORK_DATE, WORK_FROM, WORK_TO, AMOUNT as total FROM ot_item WHERE HR_ID=$hr_id AND OT_ID = $ot_id";
                                    if($result = mysqli_query($conn, $sql)) {
                                        if(mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_array($result_type)){
                                            echo "<tr>";
                                                echo "<td>" . $row['WORK_DATE'] . "</td>";
                                                echo "<td>" . $row['WORK_FROM'] . "</td>";
                                                echo "<td>" . $row['WORK_TO'] . "</td>";
                                                echo "<td><a href='../editOT.php?deleteOTItem=" . $row['OT_ID'] . "' class='text-danger'
                                                    onClick='return checkDelete();'><i class='mdi mdi-delete'></i> ลบ</a></td>";
                                            echo "</tr>";
                                            }
                                        }
                                    }    
                                                                    
                                    echo'</tbody>';
                                echo'</table>';
                                echo'<div class="modal-footer">';
                                    echo'<button type="button" class="btn btn-success">ตกลง</button>';
                                echo'</div>';

                            echo'</form>';
                        echo'</div>';
                    echo'</div>';

                echo'</div>';

            echo'</div>';
        
            echo "<script>";
                echo"$('.manage').click(function () {";
                    echo "$('#manageOTItem').modal('show');";
                 echo "});";
            echo "</script>";                                             
        
    }
    

    function showErr($err) {
        echo '<script type="text/javascript">';
        echo 'alert("'.$err.'")'; 
        echo '</script>';
    }

    function TimeDiff($strTime1,$strTime2) {
        return abs((strtotime($strTime2) - strtotime($strTime1))/  ( 60 * 60 ));
    }

    function calculateAmount($ot_type, $work_from, $work_to, $ot_rate) {
        $amount = 0;
        if($ot_type == 1 || $ot_type == 2) {
            return $amount = $ot_rate;

        } elseif($ot_type == 3) {
            $time_work = TimeDiff($work_from,$work_to);
            return $amount = $ot_rate*$time_work;
        }
    }

    function check($conn, $hr_id, $work_date, $work_from, $work_to, $ot_id) {
        $err = "";

        $sql = "SELECT WORK_DATE, WORK_FROM, WORK_TO, HR_ID, OT_ID FROM ot_item";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
                if($row['HR_ID'] == $hr_id && $row['WORK_DATE'] == $work_date && $row['OT_ID'] == $ot_id) {
                    if($row['WORK_FROM'] >= $work_from  && $row['WORK_TO'] <=  $work_to) {
                        $err = "เกิดข้อผิดพลาด เนื่องจากช่วงเวลาซ้ำ1";
                    } elseif($row['WORK_FROM'] <= $work_from  && $row['WORK_TO'] <=  $work_to) {
                        $err = "เกิดข้อผิดพลาด เนื่องจากช่วงเวลาซ้ำ2";
                    } elseif($row['WORK_FROM'] >= $work_from  && $row['WORK_TO'] >=  $work_to) { 
                        $err = "เกิดข้อผิดพลาด เนื่องจากช่วงเวลาซ้ำ3";
                    }
                }
            }
        }
        return $err;
    }
 ?>       
