<?php
echo "<html><head><title>using system() function</title></head><body>";
echo "<h1>Output of system() function)</h1>";
print "<p>The same thing will be shown if you type 'help' in the cmd shell of Windows XP</p>";
print "<pre>";
system("help", $ret_var);
print "</pre>";
echo "</body></html>";

?>
