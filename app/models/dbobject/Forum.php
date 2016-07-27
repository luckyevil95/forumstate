<?php
	namespace app\models\dbobject;
	
	use app\models\DBObject;

	class Forum extends DBObject
	{
		public function __construct($id)
		{
			$this->table = "forums";
			
			$this->initObject($id);
		}
	}
?>