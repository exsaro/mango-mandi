<div class="col-md-2 sidebar py-5 px-0">
    <div class="user text-center mb-5">
        <div class="user-img mb-3">
            <span class="material-icons">person</span>
        </div>
        <h4><?php echo $_SESSION['user_name']; ?></h4>
    </div>
    <nav>
        <ul id="master-nav">
            <li><a href="company.php"><?php echo $lang['company_master']; ?></a></li>
            <li><a href="item.php"><?php echo $lang['item_master']; ?></a></li>
            <li><a href="farmer.php"><?php echo $lang['farmer_master']; ?></a></li>
            <li><a href="customer.php"><?php echo $lang['customer_master']; ?></a></li>
            <li><a href="transaction.php"><?php echo $lang['transaction_master']; ?></a></li>
            <li><a href="user.php"><?php echo $lang['user_master']; ?></a></li>
        </ul>
        <ul id="transac-nav">
            <li><a href="voucherTransaction.php">Voucher Transaction</a></li>
            <li><a href="purchase.php">Product Receipt/Purchase</a></li>
            <li><a href="sales.php">Sales</a></li>
            <li><a href="farmer-payment.php">Farmer Payment Entry</a></li>
            <li><a href="customer-payment.php">Customer Payment Receive Entry</a></li>
        </ul>
    </nav>
</div>