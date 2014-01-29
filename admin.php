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
        /* This is where we need to be when logged in */

        echo "Hi ".$_SESSION['username'] . "<br>\n";
        echo "<a href=\"admin_exec.php?var=1\" target=\"exec\">Create table 'event'</a>";



        echo "<br><br><br><br><br><br><br><br>";

        echo "<br><a href=\"?logout=true\">Logout</a><br><br><div id=\"admexec\"".
             "style=\"position:relative; border: 1px solid gray;width=\"100%\" bottom:35%;\">".
             " <iframe id=\"exec\" name=\"exec\" height=\"15%\"".
             " src=\"admin_exec.php?var=0\" frameborder=\"0\" width=\"100%\">".
             " <p>Your browser does not support iframes.</p></iframe></div>";    }
    
    echo "</body> </html>";
?>

