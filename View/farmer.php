<?php include 'header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Farmer Master</h1>
                    <a href="addFarmer.php" class="btn btn-primary">Add Farmer</a>
                </div>
                

                <?php include 'farmerList.php'; ?>



            </div>
        </div>
    </div>

<?php include 'footer.php';?>