<?
include ('/var/www/dinAktie2/dinAktie/data_access/pwd.php');
include ('DailyStockCollection.php');    
include ('MySQLAdapter.php');
include('/var/www/dinAktie2/dinAktie/data_access/largeCap.php');
include('/var/www/dinAktie2/dinAktie/data_access/midCap.php');
include('/var/www/dinAktie2/dinAktie/data_access/smallCap.php');
include('/var/www/dinAktie2/dinAktie/data_access/firstNorth.php');

class DailyStockRepository
{
    protected $_mySQLAdapter;

    public function __construct()
    {
        global $db_pwd;
        $param = array("localhost", "root", $db_pwd, "dinAktie");
        $this->_mySQLAdapter = MySQLAdapter::getInstance($param);
        
        if(!$this->_mySQLAdapter)
        {
            echo("SQL adapter failed to create instance<br>");
        }
    }

    public function FindByType($filter)
    {
        $this->_mySQLAdapter->connect();
        $parsed_filters = array();
        $combined_filters;

        forEach($filter as $f)
            $parsed_filters[] .= " AND " .$f->type ." ". $f->condition ." '". $f->value . "'";

        foreach($parsed_filters as $filter)
            $combined_filters .= $filter;

        $this->_mySQLAdapter->select("daily", "date='2012-10-22'" .
                                     $combined_filters, "isin", "date DESC");
        while ($stocksRow = $this->_mySQLAdapter->fetch())
        {
            $result[] .= $stocksRow[isin];
        }        

            return $result;
    }

    public function FindByIsin($isin, $range = '')
    {
        $this->_mySQLAdapter->connect();

        $result = new DailyStockCollection();
        $this->_mySQLAdapter->select("stock", "isin='" . $isin ."'");
        $stocksRow = $this->_mySQLAdapter->fetch();
        $this->_mySQLAdapter->select("stocklist", "listId='" . $stocksRow[listId] . "'");
        $stocklistRow = $this->_mySQLAdapter->fetch();
        
        $num = $this->_mySQLAdapter->select("daily", "isin='" . $isin . "'", "*", "date DESC", $range);
        while($row = $this->_mySQLAdapter->fetch())
        { 
            $result->add(new Stock($stocksRow[isin], $stocksRow[name],
                                   $stocksRow[listId], $stocklistRow[listName],
                                   $row[date], $row[open], $row[close],
                                   $row[high], $row[low], $row[volume]));
        }
        $this->_mySQLAdapter->disconnect();
        return $result;
    }
    
    public function FindByText($isin)
    {
        $this->_mySQLAdapter->connect();

        $result = new DailyStockCollection();

        /* Search freetext in "NAME" */
        $this->_mySQLAdapter->select("stock", "name like '%" . $isin ."%'");
        while($stocksRow = $this->_mySQLAdapter->fetch())
        {
            $result->add(new Stock($stocksRow[isin], $stocksRow[name],
                                   $stocksRow[listId], $stocklistRow[listName],
                                   $row[date], $row[open], $row[close],
                                   $row[high], $row[low], $row[volume]));
        }
        

        /* Extract collection to avoid adding duplicate serch result */
        $col = $result->GetCollection();

        /* Search freetext in "ISIN" */
        $this->_mySQLAdapter->select("stock", "isin like '%" . $isin ."%'");
        while($stocksRow = $this->_mySQLAdapter->fetch())
        {
            
            $unique_hit = true;
            foreach($col as $hit) {
                if ($hit->_isin == $stocksRow[isin]) {
                    $unique_hit = false;
                }
            }
            if ($unique_hit == true) {
                    $result->add(new Stock($stocksRow[isin], $stocksRow[name],
                                           $stocksRow[listId], $stocklistRow[listName],
                                           $row[date], $row[open], $row[close],
                                           $row[high], $row[low], $row[volume]));
            } 
        }
        
        $this->_mySQLAdapter->disconnect();

                

        return $result;
    }


    public function Save(Stock $stock)
    {
        $data = array(isin => $stock->_isin, date => $stock->_date,
                      high => $stock->_high, low => $stock->_low,
                      open => $stock->_open, close => $stock->_close,
                      volume => $stock->volume); 
        $this->_mySQLAdapter->connect();
        $this->_mySQLAdapter->insert("daily", $data); 
    }
        
    public function GetNumDaysToDate() 
    {
        return shell_exec("date");   
    }
    
 }

?>
