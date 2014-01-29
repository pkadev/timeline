<?
include ('data_access/pwd.php');
session_start();
if (!isset($_SESSION['login']))
    die("");
?>
<html><head><title></title></head>
<body>


<?
define("DB_NAME", "timeline"); 
define("TABLE_NAME__EVENT", "event");

           //FOREIGN KEY (P_Id) REFERENCES Persons(P_Id)
$sql_create_table_event = "CREATE TABLE " . TABLE_NAME__EVENT . "
                     (
                        id INT NOT NULL AUTO_INCREMENT,
                        entity TINYTEXT NOT NULL,
                        header TINYTEXT NOT NULL,
                        date DATE NOT NULL,
                        type TINYTEXT NOT NULL,
                        text TEXT,
                        img_url TEXT,
                        PRIMARY KEY (id)

                     )";

function connect()
{
    global $db_pwd;
    $con = mysql_connect("localhost","root", $db_pwd);
    if($con)
    {
        if(mysql_select_db(DB_NAME, $con))
        {
            return $con;
        }
        else
        {
            die('Could not select database: ' . mysql_error()); 
        }
    }
    else
    {
        die('Could not connect: ' . mysql_error()); 
    }
}

function dump_table($table_name)
{
    global $db_pwd;

    $con = mysql_connect("localhost","root", $db_pwd);
    mysql_select_db("timeline", $con);
    $sql_drop_query = "DROP TABLE " . $table_name ;
    if (mysql_query($sql_drop_query, $con))
    {
        echo "Table \"" . $table_name . "\" dropped<br />";
    }
    else
    {
        echo "Failed to drop table \"" . $table_name ."\"<br/>";
    }
    mysql_close($con);
}

function create_table_event($sql_query)
{
    $con = connect();
 
    if (mysql_query($sql_query, $con)) {
        echo "Table created<br />";
    }
    else {
        echo mysql_error();
    }

    mysql_close($con);
}

    switch ($_GET['var'])
    {
        case 0:
            echo "No action<br>\n";
        break;
        case 1:
            create_table_event($sql_create_table_event);
        break;
        default:
            echo "Error default ".$_POST['var'];
    }

?>
</body>
</html>
