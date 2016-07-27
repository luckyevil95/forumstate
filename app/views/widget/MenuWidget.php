<?php
	namespace app\views\widget;
	
	class MenuWidget
	{
		public function __construct($items, $class)
		{
			echo "<ul class='" . $class . "'>";
			
			foreach ($items as $key => $value)
				echo "<li><a href='" . $value . "'>" . $key . "</a></li>";
			
			echo "</ul>";
		}
	}
?>