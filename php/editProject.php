<?php
    
    require_once 'config.php';
    
    //DELETE project
    if(isset($_GET['deleteproject'])) {

        $ot_id = $_GET['deleteproject'];
        $sqlDelete = "DELETE FROM ot_project WHERE OT_ID=$ot_id";
        $result = mysqli_query($conn, $sqlDelete);

        header("location: pages/ot.php");
    }
    
    //INSERT project
    $ot_id = $create_by = $project_name = $create_date = "";
    
    if(isset($_POST["addproject"])) {
        
        $ot_id = $_POST["txtOT_ID"];
        $project_name = trim($_POST["txtProject_name"]);
        $create_by = trim($_POST["txtCreate_by"]);

        date_default_timezone_set('asia/bangkok');
        $create_date = date("Y/m/d H:i:s");
        $sqlInsert = "INSERT INTO ot_project(OT_ID, OT_NAME, CREATE_BY, CREATE_DATE) VALUES ('$ot_id', '$project_name', '$create_by', '$create_date')";
        mysqli_query($conn, $sqlInsert);
    }

    // //INSERT and EDIT holiday
    // $holiday_date = $holiday_desc = $can_work = "";
    
    // if(isset($_POST["editholiday"])) {

    //     // $dt = DateTime::createFromFormat('M/d/Y', 'October/8/2004')->format('Y-m-d');
    //     // echo $dt;
        
    //     // $thisName = $_GET['name'];
    //     // echo"name: $thisName";
    //     $holiday_desc = trim($_POST["holiday_desc"]);
    //     $can_work = $_POST["can_work"];

    //     date_default_timezone_set('asia/bangkok');
    //     $create_date = date("Y/m/d H:i:s");

    //     $sqlInsert = "INSERT INTO ot_holiday(FACULTY_ID, HOLIDAY_DATE, HOLIDAY_DESC, CAN_WORK) VALUES (1, '$project_name', '$create_by', '$create_date' ,'$can_work')";
    //     mysqli_query($conn, $sqlInsert);
    // }

    
        $sql_maxID = "SELECT MAX(OT_ID) as maxot_id FROM ot_project";
        $result_maxID = mysqli_query($conn, $sql_maxID);
        $row = mysqli_fetch_assoc($result_maxID);
        $_SESSION['newot_id']  = $row['maxot_id'] + 1;
        
    


?>