<?php
	namespace app\controllers;
	
	use app\views\PageView;
	
	class PageController
	{	
		protected function render($page, $metaData = null, $data = null)
		{
			$pageView = new PageView($page, $metaData, $data);
		}
	}
?>