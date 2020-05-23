<?php 
    include 'header.php';
    $purchaseNumberFormat1        = $commonModel->getAutoDate();
    $purchaseNumberFormat2        = $commonModel->getFinalRow('purchase','auto_increment_number','auto_increment_number_id');
    $purchaseNumberFormat         = 'P'.$purchaseNumberFormat1.$purchaseNumberFormat2;
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
        $purchaseEditData = $commonModel->getData('purchase','edit',$_GET['id'],'purchase_id');
        $purchaseGroupData = $commonModel->getData('purchase_detail','edit',$_GET['id'],'purchase_id');
        $editData   = isset($purchaseEditData[0]) ?  $purchaseEditData[0] : [] ;
        $submitType = 'update';
    }
    $id             = isset($editData['purchase_id'])    ? $editData['purchase_id'] : '';
    $purchaseNo      = isset($editData['receipt_number'])  ? $editData['receipt_number']   : $purchaseNumberFormat;
    $purchaseDate    = isset($editData['receipt_date'])  ? $editData['receipt_date']   : '';
    $farmerId       = isset($editData['farmer_id'])  ? $editData['farmer_id']   : '';
    $vehicleNo       = isset($editData['vehicle_no'])  ? $editData['vehicle_no']   : '';
    $tractorAuto       = isset($editData['tractor_auto'])  ? $editData['tractor_auto']   : '';
    $commission       = isset($editData['commission'])  ? $editData['commission']   : '';
    $eC       = isset($editData['e_c'])  ? $editData['e_c']   : '';
    $rent       = isset($editData['rent'])  ? $editData['rent']   : '';
    $unloading       = isset($editData['unloading'])  ? $editData['unloading']   : '';
    $advanced       = isset($editData['advanced'])  ? $editData['advanced']   : '';
    $status         = (isset($editData['status']) && $editData['status'] == 'IA')? 'IA': 'A';
    $purchaseDetails = isset($purchaseGroupData)   ? $purchaseGroupData : $purchaseData;
    $totalDetection = ($tractorAuto!=''?$tractorAuto:0)+($commission!=''?$commission:0)+($eC!=''?$eC:0)+($rent!=''?$rent:0)+($unloading!=''?$unloading:0)+($advanced!=''?$advanced:0);
    $totalDetection = sprintf("%.2f", $totalDetection);
?>
<div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1><?php echo $title; ?></h1>
                    <a href="purchase.php" class="btn btn-secondary">Back</a>
                </div>
                <form action="../Model/PurchaseDetail.php"  method="post" id="addPurchase">
                    <input type="hidden" id="editId" name="editId" value='<?php echo $id; ?>' />
                    <input type="hidden" id="autoIncNumber" name="autoIncNumber" value='<?php echo $purchaseNumberFormat2; ?>' />
                    
                    <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Purchase No</label>
                            <input type="text" class="form-control" id="receipt_number" name="receipt_number" placeholder="purchase No" value="<?php echo  $purchaseNo; ?>" required minlength=3 maxlength=100 readonly />
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
											<input type="text" class="form-control" id="" name="vehicle_no" value="<?php echo  $vehicleNo; ?>" />
										</div>
										<div class="col-md-3">
											<label for="">Tractor/Auto</label>
											<input type="number" class="form-control calcReduction" id="tractor_auto"  name="tractor_auto" value="<?php echo  $tractorAuto; ?>" />
										</div>
										<div class="col-md-3">
											<label for="">Commission</label>
											<input type="number" class="form-control calcReduction" id="commission"  name="commission" value="<?php echo  $commission; ?>" />
										</div>
										<div class="col-md-3">
											<label for="">E.C.</label>
											<input type="number" class="form-control calcReduction" id="e_c"  name="e_c" value="<?php echo  $eC; ?>" />
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<label for="">Rent</label>
											<input type="number" class="form-control calcReduction" id="rent"  name="rent" value="<?php echo  $rent; ?>" />
										</div>
										<div class="col-md-3">
											<label for="">Unloading</label>
											<input type="number" class="form-control calcReduction" id="unloading"  name="unloading" value="<?php echo  $unloading; ?>" />
										</div>
										<div class="col-md-3">
											<label for="">Advanced</label>
											<input type="number" class="form-control calcReduction" id="advanced"  name="advanced" value="<?php echo  $advanced; ?>" />
										</div>
									</div>
								</div>
								<div class="card-footer text-right">
									<span>Total Detection: </span><strong>₹ <span id="calcTotalReduction"><?php echo  $totalDetection; ?></span>/-</strong>
								</div>
                            </div>
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

vehicle_no
tractor_auto
commission
e_c
rent
unloading
advanced    