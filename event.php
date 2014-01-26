<?

class Event
{
    public $_entity;
    public $_header;
    public $_type;
    public $_start_date;
    public function __construct($entity, $header, $date, $type)
    {
        $this->_entity = $entity;
        $this->_header = $header;
        $this->_start_date = $date;
        $this->_type = $type;
    }
}
?>
