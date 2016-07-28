<?php
	namespace app\controllers\page;
	
	use app\controllers\PageController;
	use app\models\DBCatalog;
	use app\models\dbobject\Forum;
	
	class ForumController extends PageController
	{
		private $metaData;
		
		public function __construct()
		{
			$forum = new Forum($_GET["id"]);
			
			$childrenForums = $forum->getChildrenForums();
			
			$countChildrenForums = count($childrenForums);
			
			for ($i = 0; $i < $countChildrenForums; $i++)
			{
				$childrens[$i] = new Forum($childrenForums[$i]["id"]);
			}
			
			$this->metaData =
			[
				"title" => $forum->getAttr("title"),
				"keywords" => $forum->getAttr("keywords"),
				"description" => $forum->getAttr("description")
			];
			
			$this->render("forum", $this->metaData, ["categories" => $categoriesCatalog, "forum" => $forum, "childrens" => $childrens]);
		}
	}
?>