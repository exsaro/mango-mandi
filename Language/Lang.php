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
            "welcome_company"      => "Company Master",
            "welcome_item"         => "Welcome Item",
            "add_company"         => "Add Company",
            "edit_company"        => "Edit Company",
            "back"         => "Back",
            "status" => "status",
            "submit" => "Submit",
            "voucher_transaction"   => "Voucher Transaction",
            "product_receipt"=>"Product Receipt/Purchase",
            "sales"=>"Sales",
            "farmer_payment_entry"=>"Farmer Payment Entry",
            "customer_payment_receive_entry"=>"Customer Payment Receive Entry"

         ];

         return $langData;
      }

      public function getConfigData(){
         
         $configData = [
         
            //Table Name
            'c_m'          => 'company_master',
            'p_m'          => 'product_master',
            'f_m'          => 'farmer_master',
            'cu_m'         => 'customer_master',
            't_m'          => 'transaction_master',
            'u_m'          => 'user_master',
            'v_t_d'        => 'voucher',
            'pu_m'         => 'purchase',
            's_t'          => 'sales',
            'f_p_e'        => 'farmer_payment',
            'c_p'          => 'customer_payment',

            //Column Name
            'c_m_c'        => 'company_id',
            'p_m_c'        => 'product_id',
            'f_m_c'        => 'farmer_id',
            'cu_m_c'       => 'customer_id',
            't_m_c'        => 'transaction_id',
            'u_m_c'        => 'user_id',
            'v_t_d_c'      => 'voucher_id',
            'pu_m_c'       => 'purchase_id',
            's_t_c'        => 'sales_id',
            'f_p_e_c'      => 'farmer_payment_id',
            'c_p_c'        => 'customer_payment_id',
            // Page Name
            'c_m_p'        => 'company',
            'p_m_p'        => 'item',
            'f_m_p'        => 'farmer',
            'cu_m_p'       => 'customer',
            't_m_p'        => 'transaction',
            'u_m_p'        => 'user',
            'v_t_d_p'      => 'voucherTransaction',
            'pu_m_p'       => 'purchase',
            's_t_p'        => 'sales',
            'f_p_e_p'      => 'farmerPayment',
            'c_p_p'        => 'customerPayment',

            //Faremer Payment Calculation
            'farmer_payment_percentage' => 10,

            //payment type
            'payment_type' => [
               'CASH' => 'cash',
               'CHEQUE' => 'cheque',
               'CARD' => 'card',
               'Net Banking' => 'card',
            ]

         ];

         return $configData;
      }
   }
?>