<?php
	namespace app\controllers\page;
	
	use app\controllers\PageController;
	use app\models\DBCatalog;
	use app\models\dbobject\Forum;
	use app\models\dbobject\Topic;
	
	class ForumController extends PageController
	{
		private $metaData;
		
		public function __construct()
		{
			$forum = new Forum($_GET["id"]);
			
			$this->metaData =
			[
				"title" => $forum->getAttr("title"),
				"keywords" => $forum->getAttr("keywords"),
				"description" => $forum->getAttr("description")
			];
			
			$childrens = $forum->getChildrenForums();
			
			for ($i = 0; $i < $countChildrensID; $i++)
				$childrens[$i] = new Forum($childrensID["id"]);
			
			$topicsID = new DBCatalog(
				[
					"table" => "topics",
					"columns" => "`id`",
					"condition" => "WHERE `forum_id` = :forum",
					"page_count" => 20,
					"order" => "ORDER BY `date_last_post` DESC",
					"pagin" => true
				],
				[
					":forum" => $forum->getAttr("id")
				]
			);
			
			$topicsCatalog = $topicsID->getCatalog();
			
			$countTopicsCatalog = count($topicsCatalog);
			
			for ($i = 0; $i < $countTopicsCatalog; $i++)
				$topics[$i] = new Topic($topicsCatalog[$i]["id"]);
			
			$this->render("forum", $this->metaData, ["forum" => $forum, "childrens" => $childrens, "topics" => $topics, "topics_pagin" => $topicsID->getPaginInfo()]);
		}
	}
?>