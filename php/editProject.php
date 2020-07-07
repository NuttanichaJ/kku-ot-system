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
    
    if(isset($_POST["addproject"])) {
        
        $ot_id = $_POST["txtOT_ID"];
        $project_name = trim($_POST["txtProject_name"]);
        $create_by = trim($_POST["txtCreate_by"]);
        $create_id = $_SESSION['login_userID'];                
        date_default_timezone_set('asia/bangkok');
        $create_date = date("Y/m/d H:i:s");
        $create_user_text = $_SESSION['login_hrName'];
        $sqlInsert = "INSERT INTO ot_project(OT_ID, OT_NAME, CREATE_BY, CREATE_DATE, CRAETE_ID, CREATE_USER_TEXT) VALUES ('$ot_id', '$project_name', '$create_by', '$create_date', '$create_id', '$create_user_text')";
        mysqli_query($conn, $sqlInsert);
    }

    
        $sql_maxID = "SELECT MAX(OT_ID) as maxot_id FROM ot_project";
        $result_maxID = mysqli_query($conn, $sql_maxID);
        $row = mysqli_fetch_assoc($result_maxID);
        $_SESSION['newot_id']  = $row['maxot_id'] + 1;
        
    


?>