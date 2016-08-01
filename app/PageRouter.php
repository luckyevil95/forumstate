<?php
	namespace app;

	class PageRouter
	{	
		public function __construct($url)
		{
			$url = parse_url($url);
			
			if ($url["path"][strlen($url["path"]) - 1] != "/")
				header("Location: " . $url["path"] . "/");
			
			if ($url["path"] == "/")
				$controllerName = __NAMESPACE__ . "\controllers\page\MainController";
			else
				$controllerName = $this->getControllerName($url["path"]);

			$controller = new $controllerName();
		}
		
		private function getControllerName($url)
		{
			foreach (glob("app/controllers/page/*") as $file_or_dir)
			{
				$path = stristr(str_replace(["Controller", "_"], ["", "-"], $file_or_dir), ".", true);
				$pathArray = explode("/", $path);
				
				if (strnatcasecmp(end($pathArray), str_replace("/", "", $url)) == 0)
					$finalPath = str_replace(["/", ".php"], [DIRECTORY_SEPARATOR, ""], $file_or_dir);
			}
			
			if ($finalPath)
				return $finalPath;
			else
				return __NAMESPACE__ . "\controllers\page\ErrorController";
		}
	}
?>