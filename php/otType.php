<?php
    
    require_once 'config.php';
    
    //DELETE project
    if(isset($_GET['deleteOttype'])) {

        $ottype_id = $_GET['deleteOttype'];
        $sqlDelete = "DELETE FROM ot_type WHERE OTTYPE_ID=$ottype_id";
        $result = mysqli_query($conn, $sqlDelete);
        header("location: pages/ot_type.php");
    }
    
    //INSERT project
    
    if(isset($_POST["add_ottype"])) {
        
        $ottype_id = $_POST["txtOT_TYPE_ID"];
        $ot_type = $_POST['txtOT_TYPE'];
        $ottype_name = trim($_POST["txtOT_TYPE_NAME"]);
        $create_by = $_SESSION['login_userName'];
        $ottype_rate = trim($_POST['otType_rate']);

        date_default_timezone_set('asia/bangkok');
        $create_date = date("Y/m/d H:i:s");

        $sqlInsert = "INSERT INTO ot_type(OTTYPE_ID, OT_TYPE, OTTYPE_NAME, OTTYPE_RATE, CREATE_BY, CREATE_DATE) VALUES ('$ottype_id', '$ot_type', '$ottype_name', $ottype_rate, '$create_by', '$create_date')";
        mysqli_query($conn, $sqlInsert);
    }

        $sql_maxID = "SELECT MAX(OTTYPE_ID) as maxottype_id FROM ot_type";
        $result_maxID = mysqli_query($conn, $sql_maxID);
        $row = mysqli_fetch_assoc($result_maxID);
        $_SESSION['newottype_id']  = $row['maxottype_id'] + 1;
        
     //UPDATE project
     if(isset($_POST['edit_otType'])) {
        $ottype_id = trim($_POST["txtOT_TYPE_ID"]);
        $ottype_name = trim($_POST["txtOT_TYPE_NAME"]);
        $ottype_rate = trim($_POST['otType_rate']);
        $sqlUpdate = "UPDATE ot_type SET OTTYPE_NAME = '$ottype_name', OTTYPE_RATE = '$ottype_rate'
                        WHERE OTTYPE_ID = $ottype_id";
        mysqli_query($conn, $sqlUpdate);
    } 


?>