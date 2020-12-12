<?php
if (!isset($_SESSION)) {
   session_start();
   $count = 1;
} else {
   $count++;
}
?>

<p>
Hello visitor, you have seen this page <?php echo $count; ?> times.
</p>

<p>
To continue, <a href="<?php echo $_SERVER['PHP_SELF'] ?>?<?php echo strip_tags(SID); ?>">click
here</a>.
</p>