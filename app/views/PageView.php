<?php
	namespace app\views;
	
	class PageView
	{
		public function __construct($page, $metaData, $data)
		{
			$content = "app/views/page/" . $page . ".php";
			
			require_once "app/views/layout/main.php";
		}
	}
?>