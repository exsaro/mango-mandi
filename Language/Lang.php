<?php
   class Lang
   {
      public function getLanguage(){
         
         $langData = [
            "login"        => "Login",
            "user_name"    => "User Name",
            "password"     => "Password",
            "login_error"  => "Please enter valid Username and Password.",
            "master"       => "Master",
            "transaction"  => "Transaction",
            "report"       => "Report",
            "logout"       => "Logout",
            "company_master"   => "Company Master",
            "item_master"      => "Item Master",
            "farmer_master"    => "Farmer Master",
            "customer_master"   => "Customer Master",
            "transaction_master" => "Transaction Master",
            "user_master"        => "User Master",
            "s_no"               => "S No",
            "company_name"     => "Company Name",
            "address"      => "Address",
            "city"         => "City",
            "state"        => "State",
            "country"      => "Country",
            "pincode"      => "Pincode",
            "action"       => "Action",
            "delete"       => "Delete",
            "edit"         => "Edit",  
            "welcome_company"      => "Welcome Company",
            "welcome_item"         => "Welcome Item",
            "add_company"         => "Add Company",
            "edit_company"        => "Edit Company",
            "back"         => "Back",
            "status" => "status",
            "submit" => "Submit"

         ];

         return $langData;
      }

      public function getConfigData(){
         
         $configData = [
         
            //Table Name
            'c_m'          => 'company_master',
            'cu_m'         => 'customer_master',
            'f_m'          => 'farmer_master',
            'u_m'          => 'user_master',
            //Column Name
            'c_m_c'        => 'company_id',

            // Page Name
            'c_m_p'        => 'company',

         ];

         return $configData;
      }
   }
?>