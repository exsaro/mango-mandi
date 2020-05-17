<?php 
    include 'header.php';
    $transactionListData = $commonModel->getData('transaction_master','list','','');
  
    $i = 1;
?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Welcome Transaction</h1>
                    <a href="addTransaction.php" class="btn btn-primary">Add Transaction</a>
                </div>
                
                <?php include 'transactionList.php'; ?>
            </div>
        </div>
    </div>

<?php include 'footer.php';?>