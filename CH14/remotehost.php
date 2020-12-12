<?php
if (isset($_SERVER['REMOTE_HOST'])) {
    print "hello visitor at".$_SERVER['REMOTE_HOST']." ";
    } elseif(isset($_SERVER['REMOTE_ADDR'])) {
        print "hello visitor at ".gethostbyaddr($_SERVER['REMOTE_ADDR'])."";

    } else {print "Hello you wherever you are";}

?>
