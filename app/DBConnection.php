<?php
	namespace app;

	class DBConnection
	{
		private $CONNECT;
		
		public function __construct()
		{
			global $config;
			
			$this->CONNECT = mysqli_connect($config["db"]["host"], $config["db"]["login"], $config["db"]["password"], $config["db"]["db"]);
			
			mysqli_set_charset($this->CONNECT, "utf8");
	
			if (!$this->CONNECT) {
				die("Error connection: " . mysqli_error());
			}
		}
		
		public function get($query, $args = null)
		{	
			$query = $this->screening($query, $args);
			
			return mysqli_fetch_assoc(mysqli_query($this->CONNECT, $query));
		}
		
		public function set($query, $args)
		{
			$query = $this->screening($query, $args);
			
			mysqli_query($this->CONNECT, $query);
		}
		
		private function screening($query, $args)
		{
			if ($args)
				foreach ($args as $key => $value)
				{
					$query = str_replace($key, strip_tags(htmlspecialchars($value, ENT_QUOTES)), $query);
				}
			
			return $query;
		}
	}
?>