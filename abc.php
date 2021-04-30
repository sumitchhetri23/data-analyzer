<?php
   class Emp {
      public $name = "";
      public $hobbies  = "";
      public $birthdate = "";
   }
	
   $e = new Emp();
   $e->name = "sachin";
   $e->hobbies  = "sports";
   $e->birthdate = "1975";
   echo json_encode($e);
?>