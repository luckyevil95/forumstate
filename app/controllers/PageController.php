<?php
	namespace app\controllers;
	
	use app\views\PageView;
	
	class PageController
	{
		protected function render($page, $metaData, $data)
		{
			$pageView = new PageView($page, $metaData, $data);
		}
	}
?>