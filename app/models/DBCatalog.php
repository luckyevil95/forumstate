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
		
		public function __construct($args)
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
			
			if ($this->pageCount == 0)
				$this->limit = "";
			else
				$this->limit = "LIMIT " . (($this->numberPage - 1) * $this->pageCount) . ", " . $this->pageCount . "";
			echo "SELECT " . $columnsString . " FROM `" . $this->table . "` " . $this->condition . " " . $args["order"] . "";
			if ($args["pagin"] == true)
				$this->catalog = $this->dbConnection->get("SELECT " . $args["columns"] . " FROM `" . $this->table . "` " . $this->condition . " " . $args["order"] . " " . $this->limit . "");
			else
				$this->catalog = $this->dbConnection->get("SELECT " . $args["columns"] . " FROM `" . $this->table . "` " . $this->condition . " " . $args["order"] . "");
			
			return $this->catalog;
		}
	}
?>