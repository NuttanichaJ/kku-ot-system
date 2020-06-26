<?php 

    require_once 'config.php';

    if(isset($_GET['print'])) {
        $_SESSION['ot_id'] = $_GET['print'];

        
        $sql = "SELECT OT_ID FROM ot_project WHERE OT_ID=$ot_id";
        
        echo $_SESSION['ot_id'] = $sql;



    }
?>