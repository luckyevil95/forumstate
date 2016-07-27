<?php
	namespace app\controllers\page;
	
	use app\controllers\PageController;
	use app\models\DBCatalog;

	class MainController extends PageController
	{
		private $metaData = ["title" => "forumstate.com - Форумное государство", 
							 "keywords" => "forumstate, форумное государство, виртуальное государство, политическая игра", 
							 "description" => "Первое в Рунете самоуправляемое форумное государство"];
		
		public function __construct()
		{
			$categories = new DBCatalog(
				[
					"table" => "categories",
					"columns" => "*",
					"condition" => "",
					"page_count" => 0,
					"order" => "ORDER BY `position` ASC",
					"pagin" => false
				]
			);
			
			$this->render("main", $this->metaData, ["categories" => $categories]);
		}
	}
?>