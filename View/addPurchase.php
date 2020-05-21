<?php 
    include 'header.php';
    $checkIteration = 0;
    $title      = 'Add Purchase';
    $editData   = [];
    $submitType = 'store';
    $purchaseData = [];
    $purchaseData[0]['product_id']    = '';
    $farmerOptionData = $commonModel->getData('farmer_master','list','','');
    $purchaseOptionData = $commonModel->getData('product_master','list','','');

    if(isset($_GET['id'])){
        $title      = 'Edit Purchase';
        $purchaseEditData = $commonModel->getData('purchase_master','edit',$_GET['id'],'purchase_master_id');
        $purchaseGroupData = $commonModel->getData('purchase_master_group','edit',$_GET['id'],'purchase_master_id');
        $editData   = isset($purchaseEditData[0]) ?  $purchaseEditData[0] : [] ;
        $submitType = 'update';
    }
    $id             = isset($editData['purchase_master_id'])    ? $editData['purchase_master_id'] : '';
    $purchaseNo      = isset($editData['receipt_number'])  ? $editData['receipt_number']   : '';
    $purchaseDate    = isset($editData['receipt_date'])  ? $editData['receipt_date']   : '';
    $farmerId       = isset($editData['farmer_id'])  ? $editData['farmer_id']   : '';
    $status         = (isset($editData['status']) && $editData['status'] == 'IA')? 'IA': 'A';
    $purchaseDetails = isset($purchaseGroupData)   ? $purchaseGroupData : $purchaseData;
?>
<div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Add Purchase</h1>
                    <a href="purchase.php" class="btn btn-secondary">Back</a>
                </div>
                <form action="../Model/PurchaseDetail.php"  method="post" id="addPurchase">
                    <input type="hidden" id="editId" name="editId" value='<?php echo $id; ?>' />
                    
                    <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Purchase No</label>
                            <input type="text" class="form-control" id="receipt_number" name="receipt_number" placeholder="purchase No" value="<?php echo  $purchaseNo; ?>"  required minlength=3 maxlength=100/>
                        </div>
                        <div class="form-group">
                            <label for="">Purchase Date</label>
                            <div class="input-group">
                            <input type="text" name="receipt_date" id="date_picker" data-datepicker="separateRange" value="<?php echo  $purchaseDate; ?>"  class="form-control datetimepicker" />
                            <div class="input-group-append"><span class="input-group-text"><span class="material-icons text-primary">calendar_today</span></span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Select Farmer</label>
                            <select class="custom-select" name="farmer_id" required>
                                <option value="">select Farmer</option>
                                <?php foreach($farmerOptionData as $fKey => $fValue) { ?>
                                    <option <?php echo ($farmerId ==  $fValue['farmer_id'])?'selected':''; ?> value="<?php echo $fValue['farmer_id']; ?>"> <?php echo $fValue['farmer_name']." - " ; ?><?php echo $fValue['farmer_code']; ?> </option>
                                <?php } ?>
                            </select>    
                        </div>

                        <!-- Add and Remove purchase START-->

                        <div id="originalDiv">
                            <?php foreach($purchaseDetails as $key => $value) { 
                                    $checkIteration = $key;
                                    $removeClsBtn   = '';
                                    $addClsBtn   = '';
                                    if($checkIteration == 0 && count($purchaseDetails) == 1 )
                                        $removeClsBtn = 'display:none;';
                                    elseif(count($purchaseDetails)-1 == $checkIteration )
                                        $addClsBtn   = '';                                  
                                    else
                                        $addClsBtn   = 'display:none;';                                  
                            ?>

                                <div class="form-group identifyCls" id="identifyDiv_<?php echo $key; ?>" data-size="<?php echo $key; ?>">

                                    <div class="card mb-2">
                                        <div class="card-body alert-secondary">
                                            <label for="">Select Item</label>
                                            <select class="custom-select" id="transcationId_<?php echo $key; ?>" name="purchase_details[<?php echo $key; ?>][product_id]"   required>
                                                <option value="">Select Item</option>
                                                <?php foreach($purchaseOptionData as $tKey => $pValue) { ?>
                                                    <option <?php echo ($value['product_id'] ==  $pValue['product_id'])?'selected':''; ?> value="<?php echo $pValue['product_id']; ?>" ><?php echo $pValue['product_name']." - " ; ?><?php echo $pValue['product_code']; ?></option>
                                                <?php } ?>
                                            </select>                                            
                                        </div>
                                    </div>
                                    <p class="text-right fz12">
                                        <a style="<?php echo $addClsBtn; ?>" class="addClass badge badge-success" id="addInx_<?php echo $key; ?>" href="javascript:void(0);" onclick="addTranscation(0)" >Add </a> 
                                        <a style="<?php echo $removeClsBtn; ?>" class="removeClass badge badge-danger" id="removeInx_<?php echo $key; ?>" href="javascript:void(0);" onclick="removeTranscation(<?php echo $key; ?>)" >  Remove</a>
                                    </p>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- Add and Remove purchase END-->

                        <div class="form-group">
                            <div class="card border-primary">
								<div class="card-header">Other Detection</div>
								<div class="card-body">
									<div class="row mb-3">
										<div class="col-md-3">
											<label for="">Vehicle No</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
										<div class="col-md-3">
											<label for="">Tractor/Auto</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
										<div class="col-md-3">
											<label for="">Commission</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
										<div class="col-md-3">
											<label for="">E.C.</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<label for="">Rent</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
										<div class="col-md-3">
											<label for="">Unloading</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
										<div class="col-md-3">
											<label for="">Advanced</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
									</div>
								</div>
								<div class="card-footer text-right">
									<span>Total Detection: </span><strong>₹ 1500/-</strong>
								</div>
                            </div>
                        </div>

						<div class="my-5">
							<p class="text-right h1"><span class="h3">Total Amount: </span><strong>₹ 14500/-</strong></p>
						</div>
      
                        <div class="form-group text-right">
                            <button  type="submit" name='<?php echo $submitType; ?>' class="btn btn-primary">Submit</button>
                        </div>
                                
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

<!-- Clone Div -->
<input type="hidden" id="checklength" value='<?php echo $checkIteration; ?>'>
<div id="cloneDiv" class="d-none">
    <div class="form-group identifyClsYYY" id="identifyDiv_XXX" data-size="XXX">

        <div class="card mb-2">
            <div class="card-body alert-secondary">
                <label for="">Select Item</label>
                <select class="custom-select" id="transcationId_XXX" name="purchase_details[XXX][product_id]"   required>
                    <option value="">Select Item</option>
                    <?php foreach($purchaseOptionData as $tKey => $pValue) { ?>
                        <option  value="<?php echo $pValue['product_id']; ?>" ><?php echo $pValue['product_name']." - " ; ?><?php echo $pValue['product_code']; ?></option>
                    <?php } ?>
                </select>                                            
            </div>
        </div>
        <p class="text-right fz12">
            <a class="addClass badge badge-success" id="addInx_XXX" href="javascript:void(0);" onclick="addTranscation(0)">Add</a> 
            <a class="removeClass badge badge-danger" id="removeInx_XXX" href="javascript:void(0);" onclick="removeTranscation(XXX)">Remove</a>
        </p>
    </div>
</div>