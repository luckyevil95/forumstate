<?php
	namespace app\controllers\page;
	
	use app\controllers\PageController;
	use app\models\DBCatalog;
	use app\models\dbobject\Forum;

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
					"page_count" => null,
					"order" => "ORDER BY `position` ASC",
					"pagin" => false
				]
			);
			
			$categoriesCatalog = $categories->getCatalog();
			
			$categoriesCount = count($categoriesCatalog);
			
			for ($i = 0; $i < $categoriesCount; $i++)
			{
				$forums = new DBCatalog(
					[
						"table" => "forums",
						"columns" => "`id`",
						"condition" => "WHERE `category_id` = :category",
						"page_count" => null,
						"order" => "ORDER BY `position` ASC",
						"pagin" => false
					],
					[
						":category" => $categoriesCatalog[$i]["id"]
					]
				);
				
				$forums = $forums->getCatalog();
				
				$countForums = count($forums);
				
				for ($j = 0; $j < $countForums; $j++)
					$forumsCatalog[$i][$j] = new Forum($forums[$j]["id"]);
			}
			
			$this->render("main", $this->metaData, ["categories" => $categoriesCatalog, "forums" => $forumsCatalog]);
		}
	}
?>