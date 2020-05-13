<?php
   class Lang
   {
      public function getLanguage(){
         
         $langData = [
            "login"        => "Login",
            "user_name"    => "User Name",
            "password"     => "Password",
            "login_error"  => "Please enter valid Username and Password."
         ];

         return $langData;
      }
   }
?>