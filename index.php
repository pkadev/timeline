<?
include "timeline.php";
include "calendar.php";
include "event.php";
?>

<html>
<head>
<title>TimeLine Test</title>
</head>
<body>

<? 
    /* Make a class out of event type */
    $evnt = new Event("Marathon Oil Corp", "Q4 report", "2014-02-06", "report");
    $evnt1 = new Event("Shamaran Petroleum", "Spud AT-4", "2013-10-20", "spud");
    $evnt2 = new Event("Shamaran Petroleum", "Spud AT-5", "2014-03-11", "spud");
    $evnt2 = new Event("Shamaran Petroleum", "Q4 report", "2014-04-30", "spud");
    $the_timeline = new TimeLine("KRG", new Calendar());
    $the_timeline->add($evnt1);
    $the_timeline->add($evnt);
    $the_timeline->add($evnt2);
    
    $the_timeline->get_first_date(); 
    //$the_timeline->draw();
    $the_timeline->calendar_draw(); 
?>
</body>
