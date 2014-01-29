<?
include_once ('MySQLAdapter.php');

class EventRepository
{
    protected $_mySQLAdapter;

    public function __construct()
    {
        global $db_pwd;
        $param = array("localhost", "root", $db_pwd, "timeline");
        $this->_mySQLAdapter = MySQLAdapter::getInstance($param);
        
        if(!$this->_mySQLAdapter)
        {
            echo("SQL adapter failed to create instance<br>");
        }
    }

    //public function ExistInDB($isin)
    //{
    //    $this->_mySQLAdapter->connect();

    //    $this->_mySQLAdapter->select("stock", " isin='" . $isin . "'");

    //    while($stocklistRow = $this->_mySQLAdapter->fetch())
    //    {
    //        return true;
    //    }
    //    return false;
    //}

    public function FindAll()
    {
        $this->_mySQLAdapter->connect();

        $this->_mySQLAdapter->select("event", $id);
        $obj = array();
        while ($stocksRow = $this->_mySQLAdapter->fetch())
        {
            array_push($obj, new Event($stocksRow[entity], $stocksRow[header],
                             $stocksRow[date], $stocksRow[type], $stocksRow[text],
                             $stocksRow[id]));
        }

        return $obj;
    }

    public function FindById($id)
    {
        $this->_mySQLAdapter->select("event", "id='".$id."'");
        $stocksRow = $this->_mySQLAdapter->fetch();
        $obj = new Event($stocksRow[entity], $stocksRow[header],
                         $stocksRow[date], $stocksRow[type], $stocksRow[text],
                         $stocksRow[id]);
        return $obj;
    }

    public function GetNewest()
    {
        $id = "*";
        $this->_mySQLAdapter->connect();

        $this->_mySQLAdapter->select("event","", "date", "date ASC");
        $stocksRow = $this->_mySQLAdapter->fetch();
        return $stocksRow[date];
    }
    public function GetOldest()
    {
        $id = "*";
        $this->_mySQLAdapter->connect();

        $this->_mySQLAdapter->select("event","", "date", "date DESC");
        $stocksRow = $this->_mySQLAdapter->fetch();
        return $stocksRow[date];
    }
    
    function SaveEvent(Event $event)
    {
        $data = array(
                      entity => $event->_entity,
                      header => $event->_header,
                      date => $event->_start_date,
                      type => $event->_type,
                      text => $event->_text,
                        ); 

        $this->_mySQLAdapter->connect();
        $this->_mySQLAdapter->insert("event", $data); 
        $this->_mySQLAdapter->disconnect();
    }
}
?>
