<?php
	$files = listingDirectory("app");
	
	$arrayFiles = arrayFiles($files);
	
	function listingDirectory($dir)
	{
		foreach (glob($dir) as $file_or_dir) 
		{
			if (!is_dir($file_or_dir))
				$files[] = $file_or_dir;
			else
				$files[] = listingDirectory($file_or_dir . "/*");
		}
		
		return $files;
	}

	function arrayFiles($array)
	{
		$arrayFiles = array();
		
		for ($i = 0; $i < count($array); $i++)
		{
			if (!is_array($array[$i]))
			{
				if ($array[$i])
				{
					$path = str_replace("/", DIRECTORY_SEPARATOR, $array[$i]);
					$arrayFiles[stristr($path, ".", true)] = $array[$i];
				}	
			}
			else
				$arrayFiles = array_merge($arrayFiles, arrayFiles($array[$i]));
		}			
			
		return $arrayFiles;
	}
	
	return $arrayFiles;
?>