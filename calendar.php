<?

function is_weekend(DateTime $dt)
{
        if ($dt->format('l') == "Sunday" ||
            $dt->format('l') == "Saturday")
            return true;
        else
            return false;
}

class Calendar
{
    public $_month_names = array();

    public function __construct()
    {
    }

    private function num_month_range(DateTime $dt_start, DateTime $dt_end)
    {
        $dt_mod = new DateTime($dt_start->format("Y-m-d"));
        if ($dt_mod > $dt_end)
        {
            echo "Error 1";
            return 0;
        }
        $num_month = 0;
        while ($dt_mod->format("Y-m") <= $dt_end->format("Y-m"))
        {
            array_push($this->_month_names, $dt_mod->format("F"). " " . $dt_mod->format("Y"));
            $num_month++;
            $dt_mod->modify("+1 month");
        }
        return $num_month;
    }

    public function draw_header($start_at, $end_at, $name, $events)
    {

        //foreach($events as $event)
        //{
        //    print $event->_entity ."\t".$event->_header . "<br>\n";
        //}
        $dt_end = new DateTime($end_at);
        $td_bg_color_wknd = "#eeeeee";
        $td_bg_color = "#ffffff";
        $dt = new DateTime($start_at);
        $start_month = $dt->format("F");
        $end_month = $dt_end->format("F");
        $num_days_of_month = $dt->format("t");
        $num_month_in_range = $this->num_month_range($dt, $dt_end);

        echo "<style type=\"text/css\">";
        echo  "table" .
        "{
            border-collapse: collapse;\n
            border: 1px solid black;\n
            margin-left : auto; margin-right : auto;\n ".
        //    margin-top : 150;
        //".
        "}" .
        "table td" .
        "{".
        "margin-left : auto; margin-right : auto; ".
        "border: 1px solid #cccccc;" .
        //"font-weight:bold;".
        "}".
        ".cellClass { border-bottom: 1px solid #8D99F0; }".
        "td.cellClass:hover, tr.class1:hover { color: black; background-color: #C0C0C0; }".
        "</style>";

        echo "\n<table heigth=\"150\" border=\"2\"><tr>\n";
        echo "<td height=\"100\" style=\"-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg); -o-transform: rotate(90deg); writing-mode: tb-rl;\" rowspan=\"3\"><center>" . $name ."</td>\n";

        $num_days_of_end_month = $dt_end->format("t");
        $tmp_date = new DateTime( $dt->format("Y") .
                                  "-".$dt->format("m") ."-01");
        $end_date = new DateTime( $dt_end->format("Y") .
                                  "-".$dt_end->format("m") . "-" .
                                  $num_days_of_end_month);
        
        for($c = 0; $c < $num_month_in_range; $c++)
        {
            $dt_days_of_month = new DateTime($this->_month_names[$c]);
            echo "<td colspan=". $dt_days_of_month->format("t") . 
                 "><center>" . $this->_month_names[$c] . "</td>\n"; 
        }
        echo "</tr>\n<tr>\n";

        while($tmp_date->format("Y-m-d") <= $end_date->format("Y-m-d"))
        {
            //if ($tmp_date == new DateTime("2014-01-27"))
            //    $td_bg_color = "#aaaaaa";
            //else
            //    $td_bg_color = "#eeeeee";

                
            
            if (is_weekend($tmp_date))
            {
                echo "<td class=\"cellClass\" bgcolor=\"". $td_bg_color_wknd .
                     "\" width=\"20\" height=\"70\">";
            }
            else
            {
                echo "<td class=\"cellClass\" bgcolor=\"". $td_bg_color ."\" width=\"20\">";
            }

            /* Here we should find all events matching the current data */
            foreach($events as $event)
            {
                if ($event->_start_date == $tmp_date->format("Y-m-d"))
                {
                    echo "<div style='font-size: 0.3em;font-family: Arial;float:left;'>".
                         "<a target=\"showcase\" href=\"display_event.php?event_id=" . $event->_id ."\"><img src=\"indicator_transp.png\"".
                         " style=\"position: relative; ".
                         "top: 0; left: 0;\" /></a></div> ";
                }
            }
            /* This is used to print images on top of each other */
            //echo "<a href=\"#i\"><img src=\"indicator_transp.png\"".
            //     " style=\"position: relative; ".
            //     " top: -10px; left: 0px;\"/>";
            echo "</td>\n";
            $tmp_date->modify("+1 day");
        }

        echo "</tr>\n<tr>\n";

        /* Below this is only dates */

        $tmp_date2 = new DateTime( $dt->format("Y") .
                                  "-".$dt->format("m") ."-01");
        while($tmp_date2->format("Y-m-d") <= $end_date->format("Y-m-d"))
        {
            if (is_weekend($tmp_date2))
            {
                echo "<td width=\"60\" bgcolor=\"". $td_bg_color_wknd ."\" height=\"20\">";
            }
            else
            {
                echo "<td width=\"60\" height=\"10\">";
            }
            echo "<center>". $tmp_date2->format("d") .
                 "</td>\n";
            $tmp_date2->modify("+1 day");
        }
        echo "</tr>\n</table>\n";
    }
}
?>
