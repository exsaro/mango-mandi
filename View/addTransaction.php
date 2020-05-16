<?php 
    include 'header.php';
    
    $title      = 'Add Transaction';
    $editData   = [];
    $submitType = 'store';

    if(isset($_GET['id'])){
        $title      = 'Edit Transaction';
        $farmerEditData = $commonModel->getData('transaction_master','edit',$_GET['id'],'transaction_id');
        $editData   = isset($farmerEditData[0]) ?  $farmerEditData[0] : [] ;
        $submitType = 'update';
    }
    
    $id          = isset($editData['transaction_id'])       ? $editData['transaction_id']      : '';
    $transactionCode  = isset($editData['transaction_code'])     ? $editData['transaction_code']      : '';
    $transactionName  = isset($editData['transaction_name'])  ? $editData['transaction_name']   : '';
    $status      = (isset($editData['status']) && $editData['status'] == 'IA')? 'IA': 'A';
?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Add Transaction</h1>
                    <a href="transaction.php" class="btn btn-secondary">Back</a>
                </div>
                <form action="../Model/TransactionMaster.php" method="post" id="addTransaction">
                    <input type="hidden" name="editId" value='<?php echo $id; ?>' />
                    <div class="card">
                    <div class="card-body">
                                <div class="form-group">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="mb-0" for="">Transaction Code</label>
                                        <div class="custom-control custom-switch ml-4">
                                                <input type="checkbox" name="status" class="custom-control-input" id="customSwitch1" value='A'  <?php echo $status=='A'? 'checked' :''; ?> >
                                                <label class="custom-control-label" for="customSwitch1">Status</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="transaction_code" placeholder="Transaction Code" required minlength=3 maxlength=100 value='<?php echo $transactionCode; ?>'>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Transaction Name</label>
                                    <input type="text" class="form-control" name="transaction_name" placeholder="Transaction Name" required  minlength=3 maxlength=100 value='<?php echo $transactionName; ?>'>
                                </div>
                                
                                <div class="form-group text-right"><button type="submit" name='<?php echo $submitType; ?>' class="btn btn-primary">Submit</button></div>
                                
                            </div>
                            
                        
                    </div>
                </div> 
                </form>  
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>

<?php include 'footer.php';?>