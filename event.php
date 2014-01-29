<?

class Event
{
    public $_id;
    public $_entity;
    public $_header;
    public $_type;
    public $_start_date;
    public $_text;
    public $_img_url;
    public function __construct($entity, $header, $date, $type, $text,
                                $id='', $img_url='')
    {
        $this->_id = $id;
        $this->_entity = $entity;
        $this->_header = $header;
        $this->_start_date = $date;
        $this->_type = $type;
        $this->_text = $text;
        $this->_img_url = $img_url;
    }
}
?>
