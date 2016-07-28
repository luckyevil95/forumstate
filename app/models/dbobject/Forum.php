<?php
	namespace app\models\dbobject;
	
	use app\models\DBObject;
	use app\models\DBCatalog;

	class Forum extends DBObject
	{
		public function __construct($id)
		{
			$this->table = "forums";
			
			$this->initObject($id);
		}

		public function getChildrenForums()
		{
			$childrenForums = new DBCatalog(
				[
					"table" => "forums",
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
		}
	}
?>