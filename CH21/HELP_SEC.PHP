<?php
echo "<html><head><title>using escapeshellcmd() function</title></head><body>";
echo "<h1>Using escapeshellcmd() function</h1>";
print "<p>To get HELP about any Windows XP shell command, please type the name of the command and press the [Submit] button</p>";
print "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">";
print "<input type=\"text\" value=\"".$_POST['command']."\" name=\"command\" />";
print "<input type=\"submit\" />";
print "</form>";
print "<pre>";
$cmd = "help";
if (isset($_POST['command'])) {
    $command = escapeshellcmd($_POST['command']);
    system("help $_POST[command]");    //for windows help
    /* system("man $command | col -b");   //for linux manual pages  */
}
print "</pre>";
echo "</body></html>";
?>
