<div class="col-md-2 sidebar bg-light py-5 px-0">
    <div class="user text-center mb-5">
        <div class="user-img bg-primary mb-3">
            <a href="dashboard.php"><span class="material-icons">person</span></a>
        </div>
        <h4><?php echo $_SESSION['user_name']; ?></h4>
    </div>
    <nav>
        <ul id="master-nav">
            <?php if($_SESSION['user_type_id'] == 1) {?><li><a href="company.php"><?php echo $lang['company_master']; ?></a></li><?php } ?>
            <li><a href="item.php"><?php echo $lang['item_master']; ?></a></li>
            <li><a href="farmer.php"><?php echo $lang['farmer_master']; ?></a></li>
            <li><a href="customer.php"><?php echo $lang['customer_master']; ?></a></li>
            <li><a href="transaction.php"><?php echo $lang['transaction_master']; ?></a></li>
            <?php  if($_SESSION['user_type_id'] == 1) { ?><li><a href="user.php"><?php echo $lang['user_master']; ?></a></li><?php } ?>
        </ul>
        <ul id="transac-nav">
            <li><a href="voucherTransaction.php"><?php echo $lang['voucher_transaction']; ?></a></li>
            <li><a href="purchase.php"><?php echo $lang['product_receipt']; ?></a></li>
            <li><a href="sales.php"><?php echo $lang['sales']; ?></a></li>
            <li><a href="farmerPayment.php"><?php echo $lang['farmer_payment_entry']; ?></a></li>
            <li><a href="customerPayment.php"><?php echo $lang['customer_payment_receive_entry']; ?></a></li>
        </ul>
    </nav>
</div>