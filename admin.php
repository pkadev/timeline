<?
session_start(); 
if(isset($_GET['logout']))
{
    unset($_SESSION['login']);
}
    echo "<html><head><title>TimeLine Admin</title></head>
    <body>
    <div id=\"header\" style=\"background-color:#5882FA;\">
    <h1 style=\"margin-bottom:0;\">Admin pages</h1></div>";
    
    
    
    if (!isset($_SESSION['login']))
    {

        echo "You need to <a href=\"login.php\">log in</a>";
    }
    else
    {
        echo "Hi ".$_SESSION['username'];
        echo "<br><a href=\"?logout=true\">Logout</a>";
    }

    echo "</body> </html>";
?>

