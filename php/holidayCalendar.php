<?php 
    
    require_once 'config.php';

    $sql_holiday = "SELECT HOLIDAY_DATE FROM ot_holiday";
    
    date_default_timezone_set('asia/bangkok');

    // Get prev & next month
    if (isset($_GET['ym'])) {
        $ym = $_GET['ym'];
    } else {
        // This month
        $ym = date('Y-m');
    }

    // Check format
    $timestamp = strtotime($ym . '-01');
    if ($timestamp === false) {
        $ym = date('Y-m');
        $timestamp = strtotime($ym . '-01');   
    }

    // Today
    $today = date('Y-m-j', time());

    // For H3 title
    $_SESSION['html_title'] = date('M Y', $timestamp);

    // Create prev & next month link     mktime(hour,minute,second,month,day,year)
    $_SESSION['prev'] = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
    $_SESSION['next'] = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
    //$_SESSION['prev'] = date('Y-m', strtotime('-1 month', $timestamp));
    //$_SESSION['next'] = date('Y-m', strtotime('+1 month', $timestamp));

    // Number of days in the month
    $day_count = date('t', $timestamp);

    $prevDate =  date('t', $timestamp-1);  
 
    // 0:Sun 1:Mon 2:Tue ...
    $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
    
    //$str = date('w', $timestamp);


    // Create Calendar!!
    $weeks = array();
    $week = "";
    
    for ($day = $str; $day > 0; $day--) {
        $week .= "<div class='prev_date'>". ($prevDate - $day + 1) . "</div>";
    }
        
    for ($day = 1; $day <= $day_count; $day++, $str++) {
     
        $date = date_format(date_create($ym . '-' . $day), "Y-m-d" );
        
        if($result = mysqli_query($conn, $sql_holiday)) {
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)){
                    if ($today == $date) {
                        if($date == $row["HOLIDAY_DATE"]) {
                            $week .= "<div class='holiday day mdi mdi-pocket' name='date' id='date'
                            data-date='$date'
                            href='../calendar?date=" . $date . "'>" . $day .  "</div>"; 
                        } else {
                            $week .= "<div class='today day mdi mdi-pocket' name='date' id='date'
                            data-date='$date'
                            href='../calendar?date=" . $date . "'>" . $day .  "</div>"; 
                        }
        
                        
                } else {
                    if($date == $row["HOLIDAY_DATE"]) {
                        $week .= "<div class='holiday day' name='date' id='date'
                            data-date='$date' 
                            href='../calendar?date=" . $date . "'>" . $day. "</div>";
                    } else {
                        $week .= "<div class='day' name='date' id='date'
                            data-date='$date' 
                            href='../calendar?date=" . $date . "'>" . $day. "</div>";
                    }
                }
            }
                        
        } else {
            if ($today == $date) {
                 $week .= "<div class='today day mdi mdi-pocket' name='date' id='date'
                            data-date='$date'
                            href='../calendar?date=" . $date . "'>" . $day .  "</div>"; 
            } else {
                 $week .= "<div class='day' name='date' id='date'
                            data-date='$date' 
                            href='../calendar?date=" . $date . "'>" . $day. "</div>";
            }
           
        }
      
        // End of the week OR End of the month
        if ($str % 7 == 6 || $day == $day_count) {

            if ($day == $day_count) {
                // Add empty cell
                $week .= str_repeat('<div></div>', 6 - ($str % 7));
            }

            $weeks[] = $week;

            // Prepare for new week
            $week = '';
        }
    }

    
 
        
    require_once 'config.php';

    
    $sql_holiday = "SELECT HOLIDAY_DATE FROM ot_holiday";
    
    date_default_timezone_set('asia/bangkok');

    // Get prev & next month
    if (isset($_GET['ym'])) {
        $ym = $_GET['ym'];
    } else {
        // This month
        $ym = date('Y-m');
    }

    // Check format
    $timestamp = strtotime($ym . '-01');
    if ($timestamp === false) {
        $ym = date('Y-m');
        $timestamp = strtotime($ym . '-01');   
    }

    // Today
    $today = date('Y-m-j', time());

    // For H3 title
    $_SESSION['html_title'] = date('M Y', $timestamp);

    // Create prev & next month link     mktime(hour,minute,second,month,day,year)
    $_SESSION['prev'] = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
    $_SESSION['next'] = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
    //$_SESSION['prev'] = date('Y-m', strtotime('-1 month', $timestamp));
    //$_SESSION['next'] = date('Y-m', strtotime('+1 month', $timestamp));

    // Number of days in the month
    $day_count = date('t', $timestamp);

    $prevDate =  date('t', $timestamp-1);  
 
    // 0:Sun 1:Mon 2:Tue ...
    $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
    
    //$str = date('w', $timestamp);


    // Create Calendar!!
    $weeks = array();
    $week = "";
    
    for ($day = $str; $day > 0; $day--) {
        $week .= "<div class='prev_date'>". ($prevDate - $day + 1) . "</div>";
    }
        
    for ($day = 1; $day <= $day_count; $day++, $str++) {
     
        $date = date_format(date_create($ym . '-' . $day), "Y-m-d" );
        
        if($result = mysqli_query($conn, $sql_holiday)) {
            if(mysqli_num_rows($result) > 0) {
                $counter = mysqli_num_rows($result);
                
                while($row = mysqli_fetch_array($result)){

                    //Check Today
                    if ($today == $date) {
                        $counter--;
                        if($date == $row['HOLIDAY_DATE']) {
                            $week .= "<div class='holiday day mdi mdi-pocket' name='holiday' id='holiday'
                            data-date='$date'

                            onClick='return checkDelete();'
                            '>" . $day .  "</div>";
                            $counter++;
                            
                        } elseif($counter == 0) {
                            $week .= "<div class='today day mdi mdi-pocket' name='date' id='date'
                            data-date='$date'
                           '>" . $day .  "</div>"; 
                        }
        
                    
                    } else {
                        $counter--;
                        if($date == $row["HOLIDAY_DATE"]) {
                            $week .= "<div class='holiday day' name='holiday' id='holiday'
                            data-date='$date' 
                            '>" . $day. "</div>";
                            $counter++;
                        } elseif($counter == 0) {
                            $week .= "<div class='day' name='date' id='date'
                            data-date='$date'
                            '>" . $day. "</div>";
                        }
                    }
                }
            
               
            } else {
                if ($today == $date) {
                    $week .= "<div class='today mdi mdi-pocket' name='date' id='date'
                            data-date='$date'
                            '>" . $day .  "</div>"; 
                } else {
                    $week .= "<div class='day' name='date' id='date'
                            data-date='$date' 
                            '>" . $day. "</div>";
                }
           
            }
        }
        
      
        // End of the week OR End of the month
        if ($str % 7 == 6 || $day == $day_count) {

            if ($day == $day_count) {
                // Add empty cell
                $week .= str_repeat('<div></div>', 6 - ($str % 7));
            }

            $weeks[] = $week;

            // Prepare for new week
            $week = '';
            }
        }
    }

    
 
        
        //INSERT holiday
        $holiday_date = $holiday_desc = $can_work = $create_date = "";
    
        
        if(isset($_POST["addholiday"])){

            $holiday_desc = trim($_POST["holiday_desc"]);
            $can_work = trim($_POST["can_work"]);
            //$create_by = trim($_POST["txtCreate_by"]);
            $holiday_date = $_POST["datepick"];
            date_default_timezone_set('asia/bangkok');
            $create_date = date("Y-m-d H:i:s");
            $sqlInsert = "INSERT INTO ot_holiday(FACULTY_ID, HOLIDAY_DATE,HOLIDAY_DESC,CAN_WORK, CREATE_DATE) VALUES ('1','$holiday_date','$holiday_desc', '$can_work', '$create_date')";
            mysqli_query($conn, $sqlInsert);

           
        }


        //DELETE holiday
    if(isset($_POST['deleteholiday'])) {
        
        //$create_by = trim($_POST["txtCreate_by"]);
        $holiday_date = $_POST["datepick"];
        
        $sqlDelete = "DELETE FROM ot_holiday WHERE HOLIDAY_DATE='$holiday_date'";
        $result = mysqli_query($conn, $sqlDelete);

        header("location: holiday.php");
    }
    
    
?>