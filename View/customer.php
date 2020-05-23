<?php include 'header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-10 mt-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Customer Master</h1>
                    <a href="addCustomer.php" class="btn btn-primary">Add Customer</a>
                </div>
                
                <div class="table-responsive">
                <?php include 'customerList.php'; ?>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php';?>