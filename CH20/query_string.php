<?php
if (!session_is_registered('count')) {
   session_register('count');
   $count = 1;
} else {
   $count++;
}
?>
<p>
Hello visitor, you have seen this page <?php echo $count; ?> times.
</p>
<p>
To continue, <a href="nextpage.php?<?php echo strip_tags(SID); ?>">click
here</a>.
</p>