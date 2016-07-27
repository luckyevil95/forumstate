<?php
	namespace app\models;

	class DBCatalog
	{
		private $dbConnection;
		private $numberPage;
		private $condition;
		private $table;
		private $columns;
		private $pageCount;
		private $maxPage;	
		private $catalog;
		private $limit;
		
		public function __construct($args, $values = null)
		{
			global $dbConnection;
			
			$this->dbConnection = $dbConnection;
			
			$this->table = $args["table"];
			$this->condition = $args["condition"];
			$this->pageCount = $args["page_count"];
			
			if (!$args["number_page"]) 
				$this->numberPage = 1;
			else 
				$this->numberPage = $args["number_page"];
			
			if ($this->pageCount == null)
				$this->limit = "";
			else
				$this->limit = "LIMIT " . (($this->numberPage - 1) * $this->pageCount) . ", " . $this->pageCount . "";
			
			if ($args["pagin"] == true)
				$this->catalog = $this->dbConnection->get("SELECT " . $args["columns"] . " FROM `" . $this->table . "` " . $this->condition . " " . $args["order"] . " " . $this->limit . "", "plural", $values);
			else
				$this->catalog = $this->dbConnection->get("SELECT " . $args["columns"] . " FROM `" . $this->table . "` " . $this->condition . " " . $args["order"] . "", "plural", $values);
		}
		
		public function getCatalog()
		{
			return $this->catalog;
		}
	}
?>