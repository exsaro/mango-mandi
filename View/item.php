<?php 
    include 'header.php';
    $itemListData = $commonModel->getData('product_master','list','','');
    $i = 1;
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php';?>
        <div class="col-md-9 mt-5 ml-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Item Master</h1>
                <a href="addItem.php" class="btn btn-primary">Add Item</a>
            </div>
            <?php include 'itemList.php'; ?>

            
        </div>
    </div>
</div>

<?php include 'footer.php';?>