<?php
	namespace app\models;

	class DBObject
	{
		protected $dbConnection;
		protected $table;
		protected $objectInfo;
		protected $id;
		
		protected function initObject($id)
		{
			global $dbConnection;
			
			$this->dbConnection = $dbConnection;
			$this->id = $id;
			
			$this->objectInfo = $this->dbConnection->get("SELECT * FROM `" . $this->table . "` WHERE `id` = ':id'", "singular", [":id" => $this->id]);
		}
		
		public function getAttr($attr)
		{
			return $this->objectInfo[$attr];
		}
		
		public function setAttr($attr, $value)
		{
			global $config;
			
			$this->dbConnection->set("UPDATE `" . $config["db"]["db"] .  "`.`" . $this->table . "` SET `" . $attr . "` = ':value' WHERE `" . $this->table . "`.`id` = ':id'",
				[
						":value" => $value,
						":id" => $this->id
				]
			);
		}
	}
?>