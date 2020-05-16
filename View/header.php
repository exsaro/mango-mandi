<?php
    session_start();
    //Common Language
    include "../Language/Lang.php";
    $language   = new Lang();
    $lang       = $language->getLanguage();

    $display        ='d-none';
    $displayMessage = '';
    $showStatus     = '';
    if(isset($_SESSION['message'])){
        $displayMessage = $_SESSION['message'];
        $showStatus     = $_SESSION['alert'];
        $display        ='d-block';
    }
    if(isset($_SESSION['user_id'])){
        // DB Related Data Getting
        include '../Model/CommonModel.php';
        $commonModel   = new CommonModel();

        // Logout
        if(isset($_POST['logout'])){
            $commonModel->logout();
        }
        
    }else{
        header("Location:../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/datatables.css">
    <link rel="stylesheet" type="text/css" href="../css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
<header class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a href="" class="navbar-brand"><?php echo $_SESSION['company_name']; ?></a>
        <nav class="nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mr-2 active">
                    <a class="nav-link d-flex align-items-center" href="company.php">
                    <span class="material-icons mr-1">store</span><?php echo $lang['master']; ?></a>
                </li>
                <li class="nav-item mr-2 active">
                    <a class="nav-link d-flex align-items-center" href="transaction.php">
                    <span class="material-icons">attach_money</span><?php echo $lang['transaction']; ?></a>
                </li>
                <li class="nav-item mr-2 active">
                    <a class="nav-link d-flex align-items-center" href="#"><span class="material-icons mr-1">assignment</span><?php echo $lang['report']; ?></a>
                </li>
                <li class="nav-item active mr-2">
                    <form action="header.php" method="post" >
                        <button class="btn nav-link d-flex align-items-center" name="logout" type="submit"><span class="material-icons mr-1">exit_to_app</span> <?php echo $lang['logout']; ?></button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</header>
<div class="msg-alert <?php echo $display; ?>" >
    <div class="alert alert-dismissible <?php echo $showStatus; ?>">
        <?php echo $displayMessage; ?>
    </div>
</div>
