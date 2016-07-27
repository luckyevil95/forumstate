<?php
	namespace app\models\dbobject;
	
	use app\models\DBObject;

	class User extends DBObject
	{
		public function __construct($id)
		{
			$this->table = "users";
			
			$this->initObject($id);
		}
	}
?>