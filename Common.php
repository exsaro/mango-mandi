<?php
    class Common
   {
      public function getCompanyName($connection,$companyId){
        $query = mysqli_query($connection ,"SELECT company_name FROM company_master WHERE status = 'A' AND company_id ='$companyId'"); 
        $select = mysqli_fetch_assoc($query);
         return $select['company_name'];
      }
   }
?>