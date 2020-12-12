
<?php
/*
   debugger.php -- debugging messages with varying verbosity
   usage:
         debug->add_message($message, $loglevel, __LINE__, __FILE__);
         debug->report($threshhold);       

When you put debug messages in your code, you should mark them as level 0 if
they are very important. If they are only notices or not very important, mark them with
a higher number. 

The debug report($threshhold) function will show you all debug messages 
that are marked with a number less than the $threshhold you ask for.

*/ 

class debug {

        // define properties
        var $classname = "debug";
        var $debug_messages = array();


/* 
Define the methods

   1st method is the constructor, which has the same name
   as the class and is called on every instantiation of the class
   
*/
        
        function debug () {
        // public: Constructor
        // this doesn't do anything else
        }
                     
        function report($threshold = 0) {
        /*
                public: report ($threshold)
                $threshold: show all debug messages logged with this threshold or less
        */        

        $debugmsgs = $this->debug_messages; // easier to type
        $ret = "";
        
        /* The data structure looks like this:
           $debugmsgs = array(
                              array(5, "a warning"),
                              array(1, "an error"),
                              array(10, "just a notice")
                              );
        */
        
      
        $j = 0;
        for($i=0; $i<sizeof($debugmsgs); $i++) {
             if($threshold >=  $debugmsgs[$i][0]) {
                  $ret .= "<li>". $debugmsgs[$i][1] ."<br>\n";
                  $j++;
                  }
             } // end loop thru debug message pile
             
        echo "Total Debug Calls: $i <br>\n".
             "Total Debug Calls at LogLevel-$threshold or below<b>:</b> $j <br><hr>\n".  $ret;
        
        
        } // end function report()
        

        function add_message($msg = "", $loglevel = 0, $line = "", $file = "") {
        /*
                public: add_message ($msg, $loglevel, $line, $file)
                $msg: debug message 
                $loglevel: mark the message as this integer level of log. for use with reporting thresholds
                           if you only want a message to be reported when you ask for maximum verbosity, set the
                           loglevel higher. If you want it to report your message when it's not being so verbose 
                           make the loglevel lower.
                $line: optional line number (use __LINE__)
                $file: optional executing file name (use __FILE__)
        */
                

                $l = ($line != "" ? "on line <b>$line</b>: " : "");
                $f = ($file != "" ? "<b>$file</b>, " : "");
                $this->debug_messages[] = array($loglevel, "$f $l $msg");
                        
        } // report



} // debug.php
 
 $d = new debug();
 $d->add_message("Error Found",5,100); 

 for ($x=0, $x<10; $x++) {
 	print $x."<br>";
 }
print $y;
$d->report(1);
?>
	
	