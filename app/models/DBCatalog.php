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
		private $values;
		
		public function __construct($args, $values = null)
		{
			global $dbConnection;
			
			$this->dbConnection = $dbConnection;
			
			$this->table = $args["table"];
			$this->condition = $args["condition"];
			$this->pageCount = $args["page_count"];
			$this->values = $values;
			
			if (!$_GET["page"]) 
				$this->numberPage = 1;
			else 
				$this->numberPage = $_GET["page"];
			
			if ($this->pageCount == null)
				$this->limit = "";
			else
				$this->limit = "LIMIT " . (($this->numberPage - 1) * $this->pageCount) . ", " . $this->pageCount . "";
			
			if ($args["pagin"] == true)
				$this->catalog = $this->dbConnection->get("SELECT " . $args["columns"] . " FROM `" . $this->table . "` " . $this->condition . " " . $args["order"] . " " . $this->limit . "", "plural", $this->values);
			else
				$this->catalog = $this->dbConnection->get("SELECT " . $args["columns"] . " FROM `" . $this->table . "` " . $this->condition . " " . $args["order"] . "", "plural", $this->values);
		}
		
		public function getCatalog()
		{
			return $this->catalog;
		}
		
		public function getPaginInfo()
		{
			$url = parse_url($_SERVER["REQUEST_URI"]);
			
			$countItems = $this->dbConnection->get("SELECT COUNT(*) FROM `" . $this->table . "` " . $this->condition . "", "singular", $this->values);
			
			$countPages = ceil($countItems["COUNT(*)"] / $this->pageCount);
			
			$_GET["page"] = 1;
			$firstUrl = $url["path"] . "?" . http_build_query($_GET);
			
			$_GET["page"] = $countPages;
			$lastUrl = $url["path"] . "?" . http_build_query($_GET);
			
			if ($this->numberPage > 1)
			{
				$_GET["page"] = $this->numberPage - 1;
				$prevUrl = $url["path"] . "?" . http_build_query($_GET);
			}
			
			if ($this->numberPage < $countPages)
			{
				$_GET["page"] = $this->numberPage + 1;
				$nextUrl = $url["path"] . "?" . http_build_query($_GET);
			}
			
			if ($this->numberPage)	
			
			return [
				"count_pages" => $countPages, 
				"current_page" => $this->numberPage,
				"first_url" => $firstUrl,
				"last_url" => $lastUrl,
				"prev_url" => $prevUrl,
				"next_url" => $nextUrl
			];
		}
	}
?>