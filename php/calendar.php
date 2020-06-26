<?php 
    
    require_once 'config.php';


    function DateThai($strDate)
	{
        
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array(
            "",
            "มกราคม",
            "กุมภาพันธ์",
            "มีนาคม",
            "เมษายน",
            "พฤษภาคม",
            "มิถุนายน",
            "กรกฎาคม",
            "สิงหาคม",
            "กันยายน",
            "ตุลาคม",
            "พฤศจิกายน",
            "ธันวาคม");

		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute:$strSeconds";
    }
    
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
    //$_SESSION['prev'] = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
    //$_SESSION['next'] = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
    $_SESSION['prev'] = date('Y-m', strtotime('-1 month', $timestamp));
    $_SESSION['next'] = date('Y-m', strtotime('+1 month', $timestamp));

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
     
        $date = $ym . '-' . $day;
        
     
        if ($today == $date) {
            $week .= "<div class='today mdi mdi-pocket' data-toggle='modal' data-target='#addHoliday'>" . $day . "</div>"; 
        } else {
            $week .= "<div data-toggle='modal' data-target='#addHoliday'>" . $day. "</div>";
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

?>