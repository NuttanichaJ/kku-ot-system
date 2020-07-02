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

 ?>       
