<?
include_once 'data_access/pwd.php';
    include 'event.php';
include_once 'data_access/datamapper/EventRepository.php';
        
    echo "
    <table width=\"70%\" border=0 style=\"margin-left:15%; align: center;\">\n".
     "<tr><td width=\"60%\"><center><img style=\"border: solid 1px #444444; box-shadow: 5px 5px 5px #888888;\" width=\"50%\"src=\"http://www.rapad-oil.com/images/rig31lg.jpg\"></td>\n".
    "<td>";
    $repo = new EventRepository();
    if (isset($_GET['event_id']))
    {
        $event_obj = $repo->FindById($_GET['event_id']); 
        if ($event_obj)
            draw_event($event_obj);
    }
    
    echo "</td>\n</tr>\n</table>";

    function draw_event(Event $event)
    {
       echo $event->_entity . "<br>"; 
       echo $event->_header . "<br>"; 
       echo $event->_start_date . "<br>"; 
       echo $event->_type . "<br>"; 
       echo $event->_text . "<br>"; 
    }
?>
