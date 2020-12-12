
<?
/*
 Graphite - PHP graphing class (C) C.E Publications  
 Description: Graphite is a generic php data graphing class.
 Version: 0.5
 Author: Nathan Cassano <nathan@cjhunter.com>
 Homepage: http://www1.cjhunter.com/~nathan/
 Example: http://www1.cjhunter.com/~nathan/graphite_exampe.gif
 Usage:

$test = new graphite();
 
$test->filename = "mygif.gif";
$test->width = 400;
$test->height = 300;
$test->y_axis_label = "Meaningless data";
$test->y_lables = xrange(-100, 1000, 50);
$test->x_axis_label = "Days of the Week";
$test->data = array(210, -59, 171, 603, 335, 427, 556);
$test->data_lables = array("Sun", "Mon","Tue","Wed","Thr","Fri","Sat");

$test->init();

$test->prep();
$test->plot(20);

$test->data = array(110, -9, 121, 303, 135, 227, 256);
$test->graph_color = ImageColorAllocate($test->image,0,255,0);

$test->prep();
$test->plot(20);
$test->close();

*/

class graphite {

/* Public variables */

/* filename image is saved as */
var $filename = "graphite.gif";

/* Size of the gif */
var $width = 600;
var $height = 400;

/* Text labels describing the x and y axis */
var $x_axis_label = "x_axis";
var $y_axis_label = "y_axis";

/* The array of integers data to be plotted */
var $data = array();

/* Text labels on the x axis corresponding to each element in $data */
var $data_lables = array();

/* Text labels on the y axis describing the range of the data */
var $y_lables = array();

/* Default font to use when printing */
var $font = 3;

/* Default colors */
var $background_color = 0;
var $border_color = 0;
var $graph_color = 0;

/*
 * Private variables (only in thought)
 */

/* image handle */
var $image;

/* The virtual range within that the data is displayed on the graph */
var $y_range_pos;
var $y_range_neg;

/* cooridnate the x axis is graphed */
var $x_axis;

/* Width and Height in pixels of the plotting area */
var $plotarea_width;
var $plotarea_height;

/* Array of Plotted data  in (x,y) format */
var $plotted_data = array();


/*
 * Defacto Data class constructor
 */
function init()
{
	/* Create image handle */
	$this->image = imagecreate($this->width, $this->height);
			
	/* Allocate Standard Colors */
	$this->background_color = ImageColorAllocate($this->image, 255,255,255);
	$this->border_color = ImageColorAllocate($this->image, 0,0,0);
	$this->graph_color = ImageColorAllocate($this->image, 0,0,255);
			
	/* Find longest string of the y_lables */
	$longest = strlen(max($this->y_lables));
	$this->plotarea_width = $this->width - 35 - ($longest * 7);
	$this->plotarea_height = $this->height - 50;

	/*  Set the display range */
	if(!isset($this->y_range_pos))
	{
		$this->y_range_pos = max($this->y_lables);
	}
	
	if(!isset($this->y_range_neg))
	{
		$this->y_range_neg = abs(min($this->y_lables));
	}
	
	/* Calculate where to graph the x axis */
	$this->x_axis = ($this->y_range_pos / ($this->y_range_pos + $this->y_range_neg)) * $this->plotarea_height;
	
	/* Draw Background */
	imagefilledrectangle($this->image,
	0,0,$this->width - 1, $this->height - 1,
	$this->background_color);

	/* Draw y axis label */
	imagestringup($this->image, $this->font,
	10, ($this->plotarea_height / 2) + (strlen($this->y_axis_label) * 3.5), $this->y_axis_label,
	$this->border_color);

	/* Draw x axis label */	
	imagestring($this->image, $this->font,
	(($this->width - $this->plotarea_width) + $this->plotarea_width / 2) - (strlen($this->x_axis_label) * 3.5),
	$this->height - 25,	$this->x_axis_label, $this->border_color);

	/* Draw plot borders */
	imageline($this->image,
	$this->width - $this->plotarea_width, 0,
	$this->width - $this->plotarea_width, $this->plotarea_height, $this->border_color);

	imageline($this->image,
	$this->width - $this->plotarea_width, $this->plotarea_height,
	$this->width, $this->plotarea_height, $this->border_color);

	/* Draw x axis*/
	imageline($this->image,
	$this->width - $this->plotarea_width, $this->x_axis,
	$this->width, $this->x_axis, $this->border_color);
	
	/* Draw y lables, if present */
	if($num_lable = count($this->y_lables))
	{
		reset($this->y_lables);
		
		/* Calculate the space between each label */
		$label_space = $this->plotarea_height / ($num_lable - 1);
		
		for($y = $this->plotarea_height; $y > -1; $y = $y - $label_space)
		{
			$label = current($this->y_lables);
			$left_offset = strlen($label) * 7;

			/* Write label string */
			imagestring($this->image, $this->font,
			$this->width - $this->plotarea_width - $left_offset - 4, $y - 1,
			$label, $this->border_color);

			/* Draw Data marker */
			imageline($this->image,
			$this->width - $this->plotarea_width - 2, $y,
			$this->width - $this->plotarea_width, $y,
			$this->border_color);
			
			next($this->y_lables);
		}
	}
	
	/* Draw data lables, if present */
	if($num_lable = count($this->data_lables))
	{
		current($this->data_lables);

		/* Calculate the space between each label */
		$label_space = $this->plotarea_width / ($num_lable + 1);
		
		for($x = ($this->width - $this->plotarea_width) + $label_space; $x < $this->width; $x = $x + $label_space)
		{
			$label = current($this->data_lables);
			$left_offset = (strlen($label) * 6) / 2;

			/* Write label string */
			imageline($this->image,
			$x, $this->plotarea_height,
			$x, $this->plotarea_height + 2,
			$this->border_color);

			/* Draw Data marker */			
			imagestring($this->image, $this->font,
			$x - $left_offset, $this->plotarea_height + 4,
			$label, $this->border_color);
			
			next($this->data_lables);
		}
	}
}

/*
 * Plot data to plotted_data 
 */
function prep()
{
	
	/* If data_lables present get spacing from data_lables */
	if($num_lable = count($this->data_lables))
	{
		$label_space = $this->plotarea_width / ($num_lable + 1);

	/* If data present get spacing from data */
	}elseif($num_lable = count($this->data)){
		$label_space = $this->plotarea_width / ($num_lable + 1);

	}else{
		echo "Error: No data to prepare";
		exit;
	}

	reset($this->data);
	$plotted_index = 0;
			
	for($x = ($this->width - $this->plotarea_width) + $label_space; $x < $this->width; $x = $x + $label_space)
	{
		$data_entry = current($this->data);

		/* if data_entry off the top of the chart, clip it */
		if($data_entry > $this->y_range_pos)
		{$data_entry = $this->y_range_pos;}

		/* if data_entry off the bottom of the chart, clip it */
		if($data_entry < ($this->y_range_neg * -1))
		{$data_entry = $this->y_range_neg * -1;}
		
		if($data_entry >= 0)
		{
			$y = $this->x_axis - ($this->x_axis * ($data_entry / $this->y_range_pos));

		}else{
			$y = $this->x_axis + (($this->plotarea_height - $this->x_axis) * (($data_entry  * -1) / $this->y_range_neg));

		}

		/* Write plotting data to plotted_data variable */
		$this->plotted_data[$plotted_index] = array($x, $y);

		$plotted_index++;
		next($this->data);
	}
}

/*
 * Plot data to image as solid bars
 */
function plot($bar_width = 10)
{
	reset($this->plotted_data);
	$bar_width = $bar_width / 2;
	
	while(list($x, $y) = current($this->plotted_data))
	{	

		if($y < $this->x_axis)
		{
			imagefilledrectangle($this->image,
			$x - $bar_width, $y,
			$x + $bar_width, $this->x_axis,
			$this->graph_color);
			
		}else{
			imagefilledrectangle($this->image,
			$x - $bar_width, $this->x_axis,
			$x + $bar_width, $y,
			$this->graph_color);			

		}
		
		next($this->plotted_data);
	}
}

/*
 * Save file and free memory
 */
function close()
{
	imagegif($this->image, $this->filename);
	imagedestroy($this->image);
}

}

/*
 * graphite_line Class extend plot() function 
 */
class graphite_line extends graphite
{

function plot()
{
	$count = count($this->plotted_data);
	reset($this->plotted_data);
	$y_last = $this->x_axis;
	list($x_last, $junk) = current($this->plotted_data);

	reset($this->plotted_data);
	
	for($i = 0; $i < $count; $i++)
	{
		list($x_next, $y_next) = current($this->plotted_data);
		imageline($this->image,
		$x_next, $y_next,
		$x_last, $y_last,
		$this->graph_color);
		
		$x_last = $x_next;
		$y_last = $y_next;
		
		next($this->plotted_data);
	}

	imageline($this->image,
	$x_last, $y_last,
	$x_next, $this->x_axis,
	$this->graph_color);

}

}

/*
 * graphite_area Class extend plot() function 
 */
class graphite_area extends graphite
{

	function plot()
	{
	
		reset($this->plotted_data);
	
		list($x, $y) = current($this->plotted_data);
		$poly[] = $x;
		$poly[] = $this->x_axis;
	
		reset($this->plotted_data);	
		while(list($x, $y) = current($this->plotted_data))
		{	
			$poly[] = $x;
			$poly[] = $y;
			$x_last = $x;
			next($this->plotted_data);
		}
	
		$poly[] = $x_last;
		$poly[] = $this->x_axis;
	
		imagefilledpolygon($this->image,
		$poly,
		count($poly) / 2,
		$this->graph_color);
	
	}
}


/*
 * Returns an array of integers given a range
 */
function xrange($begin, $end, $step = 1)
{
	if($begin > $end){
	
		if($step >= 0)	{echo "Error: 'step' argument is positive or zero"; exit;}

		for($i = $begin; $i >= $end; $i = $i + $step)
		{$range[] = $i;}
		
	}else{
		if($step <= 0){echo "Error: 'step' argument is negitive or zero"; exit;}

		for($i = $begin; $i <= $end; $i = $i + $step)
		{$range[] = $i;}
	}

return $range;
}


?>
	
	