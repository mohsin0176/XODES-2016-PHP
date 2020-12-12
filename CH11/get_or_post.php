<html>
   <head>
      <title>Form Processor for both GET and POST</title>
    </head>
   <body>
    <?php
    if ($_SERVER['REQUEST_METHOD']=="GET") {
    	$params = $_GET;
    } else {
    	$params=$_POST;
    }
    	 
    foreach ($params as $key=>$value) {
      if (gettype($value) == "array") {
        print "$key == <br /> ";
        foreach ($value as $val){
          print "........... $val <br />";
        }
      } else {
        print "$key == $value <br />";
      }
     }
  ?>
   </body>
</html>
