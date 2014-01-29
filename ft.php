<?
include_once 'data_access/pwd.php';
include_once 'data_access/datamapper/EventRepository.php';
include "timeline.php";
include "calendar.php";
include "event.php";

   /* Make a class out of event type */
   //$evnt = new Event("Marathon Oil Corp", "Q4 report", "2014-02-06", "report", "The company publishes the full year report.", "", "http://www.rapad-oil.com/images/rig31lg.jpg");
   //$evnt1 = new Event("Shamaran Petroleum", "Spud AT-4", "2013-10-20", "spud", "Spud of production well to prove oil in the crest of the structure.");
   //$evnt3 = new Event("Shamaran Petroleum", "Spud AT-5", "2014-03-11", "spud", "Production well for Atrush phase one production." );
   //$evnt2 = new Event("Shamaran Petroleum", "Q4 report", "2014-04-30", "spud", "Full year report");
   $the_timeline = new TimeLine("KRG", new Calendar());
   
   //$the_timeline->draw();
   $the_timeline->calendar_draw(); 

    //$event_repo = new EventRepository();
    //$event_repo->SaveEvent($evnt);
    //$event_repo->SaveEvent($evnt1);
    //$event_repo->SaveEvent($evnt2);
    //$event_repo->SaveEvent($evnt3);

?>
