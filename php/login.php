<?php 
    require_once 'config.php';

    if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM sys_user WHERE USER_NAME = '$username' AND PASSWORD = '$password' ";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $_SESSION['login_hrName'] = $row['HR_NAME'] ."". $row['HR_SURNAME']; //create by
            $_SESSION['login_userID'] = $row['USER_ID'];
            $_SESSION['login_hrID'] = $row['HR_ID'];
            $_SESSION['login_userName'] = $row['USER_NAME'];

            header("location: index.php");
        } else {
            echo "<script>";
                echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                echo "window.history.back()";
            echo "</script>";
        }
 
    }
?>