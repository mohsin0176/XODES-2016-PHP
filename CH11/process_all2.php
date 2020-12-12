<html>
   <head>
      <title>Example Form Processor (Process All Fields)</title>
    </head>
   <body>
    <?php
   print "<p>Here are the fields and values: <ul>";
    foreach ($_POST as $key=>$value) {
      if (gettype($value) == "array") {
        print "<li>$key == <br /> <ol>";
        foreach ($value as $val){
          print "<li> $val";
        }
        print "</ol>";
      } else {
        print "<li>$key == $value <br />";
      }
     }
    print "</ul>";
  ?>
   </body>
</html>
