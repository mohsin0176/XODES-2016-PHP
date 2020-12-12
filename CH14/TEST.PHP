<?
putenv("ORACLE_HOME","/usr/local/oracle/8i/u01/app/oracle/product/8.1.5")
   if($conn = OCILogon("user_id","password","db"))
    {
     printf("%s</P>", OCIServerVersion($conn));
    }
    else
    {
     print("Connection Failed");
   }

 ?>
