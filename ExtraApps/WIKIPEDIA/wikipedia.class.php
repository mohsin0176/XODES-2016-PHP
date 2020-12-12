<?PHP
class wikipedia
	{
	//constructor will set URL of WikiPedia
		public function __construct($wiki)
		{
		   $this->wiki = $wiki;
		}
	//destructor will unset the URL of WikiPedia
		public function __destruct()
		{
		   unset($this->wiki);
		}
	//this will get the specified page from the WikiPedia
		public function get_page($name)
		{
		  $file = file_get_contents($this->wiki.'/wiki/'.$name);
		  $file = str_replace('href="/', 'href="'.$this->wiki.'/', $file);
		  //$file = str_replace('href="#', 'href="'.$this->wiki.'/wiki/'.$name.'#', $file);
		preg_match_all('#<!-- start content -->(.*?)<!-- end content -->#es', $file, $ar);
		unset($file);
		if(is_array($ar[1]))
			{					
				return $ar[1][0];
			} else {
			return false;
			}
		}
			
	}
	
?>
