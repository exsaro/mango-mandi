<?php 
    include 'header.php';
    $salesNumberFormat1        = $commonModel->getAutoDate();
    $salesNumberFormat2        = $commonModel->getFinalRow('sales','auto_increment_number','auto_increment_number_id');
    $salesNumberFormat         = 'S'.$salesNumberFormat1.$salesNumberFormat2;
    $checkIteration = 0;
    $title      = 'Add Sales';
    $editData   = [];
    $submitType = 'store';
    $salesData = [];
    $salesData[0]['farmer_id']    = '';
    $salesData[0]['product_id']    = '';
    $salesData[0]['quantity']    = '';
    $salesData[0]['amount']    = '';
    $farmerOptionData = $commonModel->getData('farmer_master','list','','');
    $customerOptionData = $commonModel->getData('customer_master','list','','');
    $salesOptionData = $commonModel->getData('product_master','list','','');

    if(isset($_GET['id'])){
        $title      = 'Edit Sales';
        $salesEditData = $commonModel->getData('sales','edit',$_GET['id'],'sales_id');
        $salesGroupData = $commonModel->getData('sales_detail','edit',$_GET['id'],'sales_id');
        $editData   = isset($salesEditData[0]) ?  $salesEditData[0] : [] ;
        $submitType = 'update';
    }
    $id             = isset($editData['sales_id'])    ? $editData['sales_id'] : '';
    $salesNo      = isset($editData['billing_number'])  ? $editData['billing_number']   : $salesNumberFormat;
    $salesDate    = isset($editData['billing_date'])  ? $editData['billing_date']   : '';
    $customerId       = isset($editData['customer_id'])  ? $editData['customer_id']   : '';
    $vehicleNo       = isset($editData['vehicle_no'])  ? $editData['vehicle_no']   : '';
    $hC       = isset($editData['h_c'])  ? $editData['h_c']   : '';
    $mC       = isset($editData['m_c'])  ? $editData['m_c']   : '';
    $colli       = isset($editData['colli'])  ? $editData['colli']   : '';
    $packing       = isset($editData['packing'])  ? $editData['packing']   : '';
    $lorryAdvance       = isset($editData['lorry_advance'])  ? $editData['lorry_advance']   : '';
    $otherExpenses       = isset($editData['other_expenses'])  ? $editData['other_expenses']   : '';
    $status         = (isset($editData['status']) && $editData['status'] == 'IA')? 'IA': 'A';
    $salesDetails = isset($salesGroupData)   ? $salesGroupData : $salesData;
    $totalAddition = ($hC!=''?$hC:0)+($mC!=''?$mC:0)+($colli!=''?$colli:0)+($packing!=''?$packing:0)+($lorryAdvance!=''?$lorryAdvance:0)+($otherExpenses!=''?$otherExpenses:0);
    $totalAddition = sprintf("%.2f", $totalAddition);
    $totalsales    = 0;

?>
<div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1><?php echo $title; ?></h1>
                    <a href="sales.php" class="btn btn-secondary">Back</a>
                </div>


                <form action="../Model/SalesDetail.php" method="post" id="addSales">
                    <input type="hidden" id="editId" name="editId" value='<?php echo $id; ?>' />
                    <input type="hidden" id="autoIncNumber" name="autoIncNumber" value='<?php echo $salesNumberFormat2; ?>' />
              
                    <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Billing No</label>
                            <input type="text" class="form-control" id="billing_number" name="billing_number" value="<?php echo $salesNo; ?>" placeholder="Billing No" required readonly />
                        </div>
                        <div class="form-group">
                            <label for="">Billing Date</label>
                            <div class="input-group">
                            <input type="text" name="billing_date" id="date_picker" value="<?php echo $salesDate; ?>" data-datepicker="separateRange" class="form-control datetimepicker" />
                            <div class="input-group-append"><span class="input-group-text"><span class="material-icons text-primary">calendar_today</span></span></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="">Select Customer</label>
                            <select name="customer_id" class="custom-select" required>
                                <option value="">Select Customer</option>
                                <?php foreach($customerOptionData as $cKey => $cValue) { ?>
                                    <option <?php echo ($customerId ==  $cValue['customer_id'])?'selected':''; ?> value="<?php echo $cValue['customer_id']; ?>"> <?php echo $cValue['customer_name']." - " ; ?><?php echo $cValue['customer_code']; ?> </option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="card mb-3 border-primary">
                         <div class="card-body">

                        <div id="originalDiv">
                            <?php foreach($salesDetails as $key => $value) { 
                                
                                    $checkIteration = $key;
                                    $removeClsBtn   = '';
                                    $addClsBtn   = '';
                                    if($checkIteration == 0 && count($salesDetails) == 1 )
                                        $removeClsBtn = 'display:none;';
                                    elseif(count($salesDetails)-1 == $checkIteration )
                                        $addClsBtn   = '';                                  
                                    else
                                        $addClsBtn   = 'display:none;';        
                                        $totalsales +=$value['amount'] != '' ?$value['amount']:0;                    
                            ?>
                                <div class="form-group identifyCls" id="identifyDiv_<?php echo $key; ?>" data-size="<?php echo $key; ?>">
                                    <div class="card mb-2">
                                        <div class="card-body alert-secondary">
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="">Select Farmer</label>
                                                    <select name="sales_details[<?php echo $key; ?>][farmer_id]" class="custom-select" required>
                                                        <option value="">Select Farmer</option>
                                                        <?php foreach($farmerOptionData as $fKey => $fValue) { ?>
                                                            <option <?php echo ($value['farmer_id'] ==  $fValue['farmer_id'])?'selected':''; ?> value="<?php echo $fValue['farmer_id']; ?>"> <?php echo $fValue['farmer_name']." - " ; ?><?php echo $fValue['farmer_code']; ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="">Select Item</label>
                                                    <select  name="sales_details[<?php echo $key; ?>][product_id]"  class="custom-select"  id="productId_<?php echo $key; ?>"onchange="getProductAmount(<?php echo $key; ?>)" required>
                                                        <option value="">Select Item</option>
                                                        <?php foreach($salesOptionData as $sKey => $sValue) { ?>
                                                            <option <?php echo ($value['product_id'] ==  $sValue['product_id'])?'selected':''; ?> value="<?php echo $sValue['product_id']; ?>" ><?php echo $sValue['product_name']." - " ; ?><?php echo $sValue['product_code']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">Quantity</label>
                                                    <input type="number" value="<?php echo $value['quantity']; ?>" onkeyup="updatedSaleAmnt(<?php echo $key; ?>)" min="1" class="form-control" name="sales_details[<?php echo $key; ?>][quantity]" placeholder="Quantity" required />
                                                </div>
                                                <div class="col">
                                                    <label for="">Amount (₹)</label>
                                                    <input type="number" onkeyup="calculateSales()" id="sellAmnt_<?php echo $key; ?>" value="<?php echo $value['amount']; ?>"min="1" class="form-control" name="sales_details[<?php echo $key; ?>][amount]" placeholder="Amount" required />
                                                    <input type="hidden" id="hiddenSellAmnt_<?php echo $key; ?>" name="autoIncNumber" value='<?php echo $value['amount']; ?>' />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-right fz12">
                                        <a style="<?php echo $addClsBtn; ?>" class="addClass badge badge-success" id="addInx_<?php echo $key; ?>" href="javascript:void(0);" onclick="addTranscation(0)" >Add </a> 
                                        <a style="<?php echo $removeClsBtn; ?>" class="removeClass badge badge-danger" id="removeInx_<?php echo $key; ?>" href="javascript:void(0);" onclick="removeTranscation(<?php echo $key; ?>)" >  Remove</a>
                                    </p>
                                </div>
                            <?php } ?>
                        </div>


</div>
<div class="card-footer text-right">
    <span>Total Sales: </span><strong>₹ <span id="totalSales"><?php echo  sprintf("%.2f", $totalsales); ?></span>/-</strong>
</div>
</div>





                        <div class="form-group">
                            <div class="card border-primary">
								<div class="card-header">Other Addition</div>
								<div class="card-body">
									<div class="row mb-3">
										<div class="col-md-3">
											<label for="">Vehicle No</label>
											<input type="text" class="form-control totalAddition" id="vehicle_no" name="vehicle_no" value="<?php echo $vehicleNo; ?>"  />
										</div>
										<div class="col-md-3">
											<label for="">H.C</label>
											<input type="text" class="form-control totalAddition" id="h_c" name="h_c" value="<?php echo $hC; ?>"  />
										</div>
										<div class="col-md-3">
											<label for="">M.C</label>
											<input type="text" class="form-control totalAddition" id="m_c" name="m_c" value="<?php echo $mC; ?>"  />
										</div>
										<div class="col-md-3">
											<label for="">Colli.</label>
											<input type="text" class="form-control totalAddition" id="colli" name="colli" value="<?php echo $colli; ?>"  />
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<label for="">Packing</label>
											<input type="text" class="form-control totalAddition" id="packing" name="packing" value="<?php echo $packing; ?>"  />
										</div>
										<div class="col-md-3">
											<label for="">Lorry Adv.</label>
											<input type="text" class="form-control totalAddition" id="lorry_advance" name="lorry_advance" value="<?php echo $lorryAdvance; ?>"  />
										</div>
										<div class="col-md-3">
											<label for="">Other expenses</label>
											<input type="text" class="form-control totalAddition" id="other_expenses" name="other_expenses" value="<?php echo $otherExpenses; ?>"  />
										</div>
									</div>
								</div>
								<div class="card-footer text-right">
									<span>Total Addition: </span><strong>₹ <span id="salesTotalAddition"><?php echo $totalAddition; ?></span>/-</strong>
								</div>
                            </div>
                        </div>
                        
						<div class="my-5">
							<p class="text-right h1"><span class="h3">Total Amount: </span><strong>₹ <span id="totalAmount"><?php echo sprintf("%.2f",$totalsales+$totalAddition); ?></span>/-</strong></p>
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

<!-- Clone Div -->
<input type="hidden" id="checklength" value='<?php echo $checkIteration; ?>'>
<div id="cloneDiv" class="d-none">
    <div class="form-group identifyClsYYY" id="identifyDiv_XXX" data-size="XXX">

    <div class="card mb-2">
        <div class="card-body alert-secondary">
            <div class="row mb-3">
                <div class="col">
                    <label for="">Select Farmer</label>
                    <select name="sales_details[XXX][farmer_id]" class="custom-select" required>
                        <option value="">Select Farmer</option>
                        <?php foreach($farmerOptionData as $fKey => $fValue) { ?>
                            <option  value="<?php echo $fValue['farmer_id']; ?>"> <?php echo $fValue['farmer_name']." - " ; ?><?php echo $fValue['farmer_code']; ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <label for="">Select Item</label>
                    <select  name="sales_details[XXX][product_id]" id="productId_XXX" onchange="getProductAmount(XXX)"class="custom-select" required>
                        <option value="">Select Item</option>
                        <?php foreach($salesOptionData as $sKey => $sValue) { ?>
                            <option  value="<?php echo $sValue['product_id']; ?>" ><?php echo $sValue['product_name']." - " ; ?><?php echo $sValue['product_code']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="">Quantity</label>
                    <input type="number" value="" min="1"  onkeyup="updatedSaleAmnt(XXX)" class="form-control" name="sales_details[XXX][quantity]" placeholder="Quantity" required />
                </div>
                <div class="col">
                    <label for="">Amount (₹)</label>
                    <input type="number" value="" id="sellAmnt_XXX" onkeyup="calculateSales()"  min="1" class="form-control" name="sales_details[XXX][amount]" placeholder="Amount" required />
                    <input type="hidden" id="hiddenSellAmnt_XXX" name="autoIncNumber" value='' />
                </div>
            </div>
        </div>
    </div>
        <p class="text-right fz12">
            <a class="addClass badge badge-success" id="addInx_XXX" href="javascript:void(0);" onclick="addTranscation(0)">Add</a> 
            <a class="removeClass badge badge-danger" id="removeInx_XXX" href="javascript:void(0);" onclick="removeTranscation(XXX)">Remove</a>
        </p>
    </div>
</div>