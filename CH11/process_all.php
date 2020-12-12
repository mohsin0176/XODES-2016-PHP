<html>
   <head>
      <title>Example Form Processor (Process All Fields)</title>
    </head>
   <body>
    <?php
   print "<p>Here are the fields and values: <ul>";
    foreach ($_POST as $key=>$value) {
      print "<li>$key == $value <br />";
    }
    print "</ul>";
    ?>
   </body>
</html>
