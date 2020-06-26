<?php

    $conn = mysqli_connect("localhost","root","","kku_ot");

    if (!$conn) {

        echo "Failed to connect to MySQL: " . mysqli_connect_error();
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



?>