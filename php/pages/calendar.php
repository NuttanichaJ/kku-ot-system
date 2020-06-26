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
                        <h5 class="text-center" id="month"><?php echo $_SESSION['html_title']; ?></h5>
                        
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
                    foreach ($weeks as $week) {
                        echo $week;
                    }
                ?>
                </div>

</body>

</html>