<?php
	namespace app\models\dbobject;
	
	use app\models\DBObject;
	use app\models\DBCatalog;

	class Forum extends DBObject
	{
		private $childrens;
		private $parents;

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

		public function getParentForums($forum = self)
		{
			$parentForum = $this->dbConnection->get("SELECT `id`, `parent_forum` FROM `" . $this->table . "` WHERE `id` = '" . $forum->getAttr("parent_forum") . "'", "singular");

			$parent = new self($parentForum["id"]);

			array_push($this->parents, $parent);

			if ($parent->getAttr("parent_forum") != null)
				$this->getParentForums($parent);
			else
				return $this->parents;
		}
	}
?>