<?php  
    session_start(); 

    //Language File Added
    include "Language/Lang.php";
    $language   = new Lang();
    $lang       = $language->getLanguage();
    $loginError = false;

    if(isset($_POST['submit'])){

        //DB Connection
        require "DataBase/DBConnect.php";
        $dbConnection   = new DBConnect();
        $connection     = $dbConnection->dbConnect();

        //Login Checking
        $userName       = $_POST['userName'];
        $password       = $_POST['password'];

        $query = mysqli_query($connection ,"SELECT user_id,user_name,user_password,company_id FROM user_master WHERE status = 'A' AND user_name = '$userName' AND user_password ='$password'"); 
        $select = mysqli_fetch_assoc($query);

        if($userName == $select['user_name'] && $password == $select['user_password'])
        { 
            include "Common/Common.php";
            $commonData = new Common();
            $_SESSION['company_id']     = $select['company_id']; 
            $_SESSION['user_id']        = $select['user_id']; 
            $_SESSION['user_name']      = $select['user_name']; 
            $_SESSION['company_name']   = $commonData->getCompanyName($select['company_id']); 
            header("Location:View/dashboard.php");

        }else{
            $loginError = true;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
        <div class="container">
            <a href="" class="navbar-brand">Company Name</a>
        </div>
    </header>
    <div class="container pt-5">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-4">
                <h2><?php echo $lang['login']; ?></h2>
                <div class="card">
                    <div class="card-body">
                        <?php 
                        // Show Login Error Message
                        if($loginError){
                            echo '<div class="alert alert-danger" role="alert">'.
                                        $lang['login_error']
                                    .'</div>';
                        } 
                        ?>
                        <form action="index.php" method="post" id="loginForm" name="loginForm" autocomplete="off">
                            <div class="form-group">
                                <label for="userName"><?php echo $lang['user_name']; ?></label>
                                <input type="text" name="userName" class="form-control" id="userName">
                                <small id='err1' class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="password"><?php echo $lang['password']; ?></label>
                                <input type="password" name="password" class="form-control" id="password">
                                <small id='err2' class="text-danger"></small>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" name="submit" id="login" class="btn btn-primary"><?php echo $lang['login']; ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-4 text-center"><a href="register.html" class="btn btn-dark w-50">Register</a></div>
                
            </div>
            
        </div>
    </div>
    <!-- Jquery  -->
    <script src="js/jquery/jquery-3.3.1.min.js"></script>
    <!-- Validation Plug-in -->
    <script src="js/Validation/jquery.validate.min.js"></script>
    <!--External Js  -->
    <script src="js/script/login.js"></script>
    
</body>
</html>