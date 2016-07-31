<?php
	namespace app\models\dbobject;
	
	use app\models\DBObject;
	use app\models\DBCatalog;
	use app\models\dbobject\Post;

	class Forum extends DBObject
	{
		private $childrens = array();
		private $parents = array();

		public function __construct($id)
		{
			$this->table = "forums";
			
			$this->initObject($id);
		}

		public function getChildrenForums()
		{
			$childrenForums = new DBCatalog(
				[
					"table" => $this->table,
					"columns" => "`id`",
					"condition" => "WHERE `parent_forum` = :parent_forum",
					"page_count" => null,
					"order" => "ORDER BY `position` ASC",
					"pagin" => false
				],
				[
					":parent_forum" => $this->getAttr("id")
				]
			);
			
			$childrenForumsCatalog = $childrenForums->getCatalog();

			$childrenForumsCount = count($childrenForumsCatalog);

			for ($i = 0; $i < $childrenForumsCount; $i++)
				$this->childrens[$i] = new self($childrenForumsCatalog[$i]["id"]);
			
			return $this->childrens;
		}

		public function getParentForums($forum = null)
		{
			if ($forum == null)
				$forum = $this;
			
			$parentForum = $this->dbConnection->get("SELECT `id`, `parent_forum` FROM `" . $this->table . "` WHERE `id` = '" . $forum->getAttr("parent_forum") . "'", "singular");
			
			if ($parentForum)
			{
				$parent = new self($parentForum["id"]);

				array_push($this->parents, $parent);
				
				if ($parent->getAttr("parent_forum") != null)
					$this->getParentForums($parent);
				else
					return $this->parents;
			}

			return array_reverse($this->parents);
		}
		
		public function getCountTopics()
		{
			$countTopics = $this->dbConnection->get("SELECT COUNT(*) FROM `topics` WHERE `forum_id` = '" . $this->getAttr("id") . "'", "singular");
			
			return $countTopics["COUNT(*)"];
		}
		
		public function getCountPosts()
		{
			$countPosts = $this->dbConnection->get("
				SELECT COUNT(*)
				FROM `posts` t1
				LEFT JOIN `topics` t2
				ON t1.topic_id = t2.id
				WHERE t2.forum_id = '" . $this->getAttr("id") . "'
			", "singular");
			
			return $countPosts["COUNT(*)"];
		}
		
		public function getLastPost()
		{
			$lastPostID = $this->dbConnection->get("
				SELECT t1.id
				FROM `posts` t1
				LEFT JOIN `topics` t2
				ON t1.topic_id = t2.id
				WHERE t2.forum_id = '" . $this->getAttr("id") . "'
				ORDER BY t1.id DESC
				LIMIT 1
			", "singular");
			
			$lastPost = new Post($lastPostID["id"]);
			
			return $lastPost;
		}
	}
?>