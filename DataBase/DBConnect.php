<?php

   require_once "./Libraries/Config.php";
   
   class DBConnect
   {
      public function dbConnect()
      {   
         
         $conn = mysqli_connect(serverName, userName, password, dataBaseName);
         
         if(!$conn)
         {
            die ("Cannot connect to the database");
         }
         return $conn;        
      }
   }

?>