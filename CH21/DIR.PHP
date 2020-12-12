<?php
echo "<html><head><title>using exec() to output results of dir command</title></head><body>";
echo "<h1>Directory Listing</h1>";

exec("dir /a",$output, $return);
print "<p>Returned : $return</p>";

foreach ($output as $file) {
    print "$file<br>";

}
echo "</body></html>";

 ?>
