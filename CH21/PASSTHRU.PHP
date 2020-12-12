<?php
if (isset($image) && file_exists($image)) {
    header("Content-type: image/gif");
    passthru("giftopnm $image | pnmscale -xscale .5 -yscale .5 | ppmtogif");
    } else {
    print "<p>The image $image could not be found</p>";
 }
echo "<html><head><title>using passthru() function</title></head><body>";
echo "<h1>Using passthru() function</h1>";
print "<form action=\"$PHP_SELF\" method=\"get\">";
print "<input type=\"text\" value=\"$image\" name=\"image\" />";
print "<input type=\"submit\" />";
print "</form>";
print "<img src=\"$image\" />";
echo "</body></html>";
?>
