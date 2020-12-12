<?php
  class calendar {
    var $daynamefont;
    var $daynamebgcolor;
    var $daynamecolor;
    var $daynamesize;
    var $daynamebold;
    var $daynameitalic;
    var $dayfont;
    var $daybgcolor;
    var $daycolor;
    var $dayactivecolor;
    var $daysize;
    var $daybold;
    var $dayitalic;
    var $showdate;
    var $bordersize;
    var $timestamp;

    function calendar(){
      if(empty($this->daynamefont)==true)$this->daynamefont="Arial, sans-serif";
      if(empty($this->daynamebgcolor)==true)$this->daynamebgcolor="#000060";
      if(empty($this->daynamecolor)==true)$this->daynamecolor="#FFFFFF";
      if(empty($this->daynamesize)==true)$this->daynamesize="3";
      if(empty($this->daynamebold)==true)$this->daynamebold=true;
      if(empty($this->daynameitalic)==true)$this->daynameitalic=false;
      if(empty($this->dayfont)==true)$this->dayfont="Arial, sans-serif";
      if(empty($this->daybgcolor)==true)$this->daybgcolor="#FFCA00";
      if(empty($this->daycolor)==true)$this->daycolor="#000000";
      if(empty($this->dayactivecolor)==true)$this->dayactivecolor="#FF0000";
      if(empty($this->daysize)==true)$this->daysize="3";
      if(empty($this->daybold)==true)$this->daybold=true;
      if(empty($this->dayitalic)==true)$this->dayitalic=false;
      if(empty($this->showdate)==true)$this->showdate=true;
      if(empty($this->bordersize)==true)$this->bordersize="2";
      if(empty($this->timestamp)==true)$this->timestamp=time();
    }

    function show(){
      $day=date("j",$this->timestamp);
      $month=date("n",$this->timestamp);
      $year=date("Y",$this->timestamp);
      if($this->daynamebold==true){
        $daynametextprefix="<b>";
        $daynametextsuffix="</b>";
      }
      if($this->daynameitalic==true){
        $daynametextprefix.="<i>";
        $daynametextsuffix="</i>".$daynametextsuffix;
      }
      if($this->daybold==true){
        $daytextprefix="<b>";
        $daytextsuffix="</b>";
      }
      if($this->dayitalic==true){
        $daytextprefix.="<i>";
        $daytextsuffix="</i>".$daytextsuffix;
      }
      if(checkdate($month,$day,$year)==true){
        $maxdays=31;
        while(checkdate($month,$maxdays,$year)==false)$maxdays--;
        $startday=1-date("w",mktime(0,0,0,$month,1,$year));
        print("<table border='".$this->bordersize."' cellspacing='0' cellpadding='0'><tr bgcolor='".$this->daybgcolor."'><td>\n");
        print("  <table border='0' cellspacing='0' cellpadding='2'>\n");
        if($this->showdate==true)
        print("    <tr bgcolor='".$this->daynamebgcolor."'><td colspan='7'><font face='".$this->daynamefont."' color='".$this->daynamecolor."' size='".$this->daynamesize."'><div align='center'>".$daynametextprefix.date("F",mktime(0,0,0,$month,$day,$year))." $year".$daynametextsuffix."</div></font></td></tr>\n");
        print("    <tr bgcolor='".$this->daynamebgcolor."'><td align='center'><font face='".$this->daynamefont."' color='".$this->daynamecolor."' size='".$this->daynamesize."'>".$daynametextprefix." S ".$daynametextsuffix."</font></td><td align='center'><font face='".$this->daynamefont."' color='".$this->daynamecolor."' size='".$this->daynamesize."'>".$daynametextprefix." M ".$daynametextsuffix."</font></td><td align='center'><font face='".$this->daynamefont."' color='".$this->daynamecolor."' size='".$this->daynamesize."'>".$daynametextprefix." T ".$daynametextsuffix."</font></td><td align='center'><font face='".$this->daynamefont."' color='".$this->daynamecolor."' size='".$this->daynamesize."'>".$daynametextprefix." W ".$daynametextsuffix."</font></td><td align='center'><font face='".$this->daynamefont."' color='".$this->daynamecolor."' size='".$this->daynamesize."'>".$daynametextprefix." T ".$daynametextsuffix."</font></td><td align='center'><font face='".$this->daynamefont."' color='".$this->daynamecolor."' size='".$this->daynamesize."'>".$daynametextprefix." F ".$daynametextsuffix."</font></td><td align='center'><font face='".$this->daynamefont."' color='".$this->daynamecolor."' size='".$this->daynamesize."'>".$daynametextprefix." S ".$daynametextsuffix."</font></td>");
        $weekdaycount=0;
        for($daycount=$startday;$daycount<=$maxdays;$daycount++){
          if(($weekdaycount%7)==0)print("</tr>\n    <tr bgcolor='".$this->daybgcolor."'>");
          if($daycount>0){
            print("<td align='right'>");
            if($daycount!=$day){
              print("<font face='".$this->dayfont."' color='".$this->daycolor."' size='".$this->daysize."'>".$daytextprefix." ".$daycount." ".$daytextsuffix."</font>");
            } else print("<font face='".$this->dayfont."' color='".$this->dayactivecolor."' size='".$this->daysize."'>".$daytextprefix." ".$daycount." ".$daytextsuffix."</font>");
          } else print("<td>");
          print("</td>");
          $weekdaycount++;
        }
        while($weekdaycount%7<>0){
          print("<td></td>");
          $weekdaycount++;
        }
        print("</tr>\n  </table>\n");
        print("</td></tr></table>\n");
      } else print("Incorrect date");
    }
  }
?>