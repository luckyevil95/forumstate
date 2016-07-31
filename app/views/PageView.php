<?php
	namespace app\views;
	
	class PageView
	{
		public function __construct($page, $metaData = null, $data = null)
		{
			$content = "app/views/page/" . $page . ".php";
			
			require_once "app/views/layout/main.php";
		}
	}
?>