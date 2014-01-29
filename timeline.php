<?

class Timeline
{
    public $_events = array();
    public $_event_repo;
    protected $_name;
    protected $_calendar;

    public function __construct($name, $calendar)
    {
        $this->_name = $name;
        $this->_calendar = $calendar;
        $this->_event_repo = new EventRepository();
        $this->_events = $this->_event_repo->FindAll();
    }

    public function calendar_draw()
    {
        $this->_calendar->draw_header($this->_event_repo->GetNewest(), 
                                     $this->_event_repo->GetOldest(),
                                     $this->_name,
                                     $this->_events);
        
    }
    public function get_last_date()
    {
        $end_date = "1000-01-01";
        foreach($this->_events as $event)
        {
            
            if ($event->_start_date > $end_date)
            {
                $end_date = $event->_start_date;
            } 
        }
        return $end_date;
    }
    public function get_first_date()
    {
        $start_date = "8000-01-01";
        foreach($this->_events as $event)
        {
            
            if ($event->_start_date < $start_date)
            {
                $start_date = $event->_start_date;
            } 
        }
        return $start_date;
    }
    public function draw()
    {
        foreach($this->_events as $event)
        {
            echo $event->_entity . "<br>\n";
            echo $event->_header . "<br>\n";
            echo $event->_start_date . "<br>\n";
        }
    }
}

?>
