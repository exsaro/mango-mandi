<?php
   
   class Common
   {
      private $connected ="";
      function __construct()
      {
         $dbConnection =  new DBConnect();
         $this->connected = $dbConnection->dbConnect();
      }

      //Get Company Name
      public function getCompanyName($companyId){
         $query = mysqli_query($this->connected ,"SELECT company_name FROM company_master WHERE status = 'A' AND company_id ='$companyId'"); 
         $select = mysqli_fetch_assoc($query);
         return $select['company_name'];
      }
   }

?>