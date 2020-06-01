<?php 
    include 'header.php';
    $paymentNumberFormat1        = $commonModel->getAutoDate();
    $paymentNumberFormat2        = $commonModel->getFinalRow('payment','auto_increment_number','auto_increment_number_id');
    $paymentNumberFormat         = 'PE'.$paymentNumberFormat1.$paymentNumberFormat2;
    $farmerOptionData            = $commonModel->getData('farmer_master','list','','');
    $purchaseOptionData          = [];
    $voucherOptionData           = [];
    $editData                    = [];
    $farmerPaymentDetailEditData = [];
    $submitType                  = 'store';
    $farmer_payment_percentage   = $language->getConfigData()['farmer_payment_percentage'];// config percentage 10%
    $tableDisp                   = 'd-none';
    $lockSection                 = '';
    $lockSectionPointer          = '';
    if(isset($_GET['id'])){
        $farmerPaymentEditData       = $commonModel->getData('farmer_payment','edit',$_GET['id'],'farmer_payment_id');
        $farmerPaymentDetailEditData = $commonModel->getFarmerPaymentDetail($_GET['id']);
        $editData                    = isset($farmerPaymentEditData[0]) ?  $farmerPaymentEditData[0] : [] ;
        $purchaseOptionData          = $commonModel->getData('purchase','list','','');
        $voucherOptionData           = $commonModel->getData('voucher','list','','');
        $submitType                  = 'update';
        $tableDisp                   = '';
        $lockSection                 = 'lock-section-parent';
        $lockSectionPointer          = 'lock-section-pointer';
    }
    $id                 = isset($editData['farmer_payment_id'])       ? $editData['farmer_payment_id']      : '';
    $paymentNo          = isset($editData['farmer_payment_number'])  ? $editData['farmer_payment_number']   : $paymentNumberFormat;
    $paymentDate        = isset($editData['farmer_payment_date'])  ? $editData['farmer_payment_date']   : $paymentNumberFormat;
    $farmer_id          = isset($editData['farmer_id'])  ? $editData['farmer_id']   : '';
    $purchase_id        = isset($editData['purchase_id'])  ? $editData['purchase_id']   : '';
    $voucher_id         = isset($editData['voucher_id'])  ? explode(',',$editData['voucher_id'])  : [];
    $total_sales_amount = isset($editData['total_sales_amount'])  ? $editData['total_sales_amount']   : 0;
    $total_detection    = isset($editData['total_detection'])  ? $editData['total_detection']   : 0;
    $total_amount       = isset($editData['total_amount'])  ? $editData['total_amount']   : 0;
    $description        = isset($editData['description'])  ? $editData['description']   : '';
    $payment_status     = isset($editData['payment_status '])  ? $editData['payment_status ']   : '';
    $i                  = 1;
    
?>
<div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Farmer Payment Entry</h1>
                    <a href="farmerPayment.php" class="btn btn-secondary">Back</a>
                </div>
                <form action="../Model/FarmerPayment.php" method="post" id="addPayment">
                    <input type="hidden" id="percentage" name="percentage" value="<?php echo $farmer_payment_percentage; ?>"/>
                    <input type="hidden" id="hidden_voucher_id" name="hidden_voucher_id" value="<?php echo implode(',',$voucher_id); ?>"/>
                    <input type="hidden" id="editId" name="editId" value='<?php echo $id; ?>' />
                    <input type="hidden" id="autoIncNumber" name="autoIncNumber" value='<?php echo $paymentNumberFormat2; ?>' />
                    <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Bill No</label>
                                    <input type="text" class="form-control" name="farmer_payment_number" value="<?php echo $paymentNo; ?>" placeholder="Payment No" required readonly/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Bill Date</label>
                                    <div class="input-group">
                                        <input type="text" name="farmer_payment_date" id="date_picker" data-datepicker="separateRange" class="form-control datetimepicker" value="<?php echo $paymentDate; ?>" />
                                        <div class="input-group-append"><span class="input-group-text"><span class="material-icons text-primary">calendar_today</span></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col <?php echo $lockSection; ?>">
                                <div class="form-group">
                                    <label for="">Select Farmer</label>
                                    <select name="farmer_id" id="payment_farmer_id" class="custom-select <?php echo $lockSectionPointer; ?>" required>
                                        <option value="">Select Farmer</option>
                                        <?php foreach($farmerOptionData as $fKey => $fValue) {  ?>
                                            <option <?php echo ($farmer_id ==  $fValue['farmer_id'])?'selected':''; ?> value="<?php echo $fValue['farmer_id']; ?>"> <?php echo $fValue['farmer_name']." - " ; ?><?php echo $fValue['farmer_code']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col <?php echo $lockSection; ?>">
                                <div class="form-group">
                                    <label for="">Purchase No</label>
                                    <select name="purchase_id" id="payment_purchase_id" class="custom-select <?php echo $lockSectionPointer; ?>" required>
                                        <option value="">select Purchase</option>
                                        <?php foreach($purchaseOptionData as $fKey => $fValue) {  
                                            if(($fValue['payment_status'] != 'P' && $fValue['farmer_id'] == $farmer_id) || ($fValue['payment_status'] == 'P' && $fValue['purchase_id'] == $purchase_id  && $fValue['farmer_id'] == $farmer_id)) {
                                        ?>
                                            
                                            <option <?php echo ($purchase_id ==  $fValue['purchase_id'])?'selected':''; ?> value="<?php echo $fValue['purchase_id']; ?>"> <?php echo $fValue['receipt_number']?> </option>
                                        <?php } 
                                            } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Voucher No</label>
                                    <select name="voucher_id[]" id="payment_voucher_id" class="custom-select multi"  multiple="multiple">
                                    <?php foreach($voucherOptionData as $fKey => $fValue) {  
                                        if((($fValue['payment_status'] != 'P' ) || ($fValue['payment_status'] == 'P' && in_array( $fValue['voucher_id'] ,$voucher_id))) && $fValue['farmer_id'] == $farmer_id) {
                                    ?>
                                        <option <?php echo (in_array( $fValue['voucher_id'] ,$voucher_id))?'selected':''; ?> value="<?php echo $fValue['voucher_id']; ?>"> <?php echo $fValue['voucher_no']?> </option>
                                    <?php } 
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="inline-table mb-3">
                        <table class="table table-bordered table-primary <?php echo $tableDisp; ?>"  id="payment_detail">
                            <thead>
                                <tr>
                                    <th>S. No</th>
                                    <th>Item</th>
                                    <th>Qty (kg)</th>
                                    <th width="200">Amount (per kg)</th>
                                    <th width="200">(₹) Net Amount</th>
                                </tr>
                            </thead>
                            <tbody id="paymentTable">
                                <?php foreach($farmerPaymentDetailEditData as $key => $value) { ?>
                                   <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value['product_name'].' ('.$value['product_code'].' )'; ?></td>
                                        <td><?php echo $value['quantity']; ?></td>  
                                        <td>
                                            <div class="input-group mb-0">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₹</span>
                                                </div>
                                                <input type="text" class="form-control" onkeyup="farmerPaymentAmountChange(<?php echo $key; ?>)" id="amount_<?php echo $key; ?>" value="<?php echo $value['amount']; ?>" name="farmer_payment[<?php echo $key; ?>][amount]" required aria-label="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group mb-0">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₹</span>
                                                </div>
                                                <input type="text" class="form-control" name="farmer_payment[<?php echo $key; ?>][sale_net_amount]"  id="net_amount_<?php echo $key; ?>" value="<?php echo $value['sale_net_amount']; ?>" aria-label="" readonly>
                                            </div>
                                        </td> 
                                   </tr>
                                   <input type="hidden" id="quantity_<?php echo $key; ?>" name="farmer_payment[<?php echo $key; ?>][quantity]" value="<?php echo $value['quantity']; ?>" >
                                   <input type="hidden" id="sales_detail_id_<?php echo $key; ?>" name="farmer_payment[<?php echo $key; ?>][sales_detail_id]" value="<?php echo $value['sales_detail_id']; ?>" aria-label="">
                                   <input type="hidden" id="sales_id_<?php echo $key; ?>" name="farmer_payment[<?php echo $key; ?>][sales_id]" value="<?php echo $value['sales_id']; ?>" >
                                   <input type="hidden" id="product_id_<?php echo $key; ?>" name="farmer_payment[<?php echo $key; ?>][product_id]" value="<?php echo $value['product_id']; ?>" aria-label="">
                                   <input type="hidden" id="index" value="<?php echo $key; ?>">
                                <?php $i++; }  ?>
                            </tbody>
                        </table>
                        </div>
                        <p class="text-right h5">Total Sales Amount: ₹ <strong><span id="totalSale"><?php echo $total_sales_amount; ?></span>/-</strong></p>
                        <p class="text-right h5">Total Detection: ₹ <strong><span id="totalDetection"><?php echo $total_detection; ?></span>/-</strong></p>
                        <input type="hidden" id="totalSaleAmt" name="total_sales_amount" value="<?php echo $total_sales_amount; ?>"/>
                        <input type="hidden" id="reduceAmt" name="total_detection" value="<?php echo $total_detection; ?>"/>
                        
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" id="" name="description" rows="3" autocomplete="off" spellcheck="false" required><?php echo $description; ?></textarea>
                        </div>

                        <p class="text-right h1 mb-5">
                        <span>Total: </span><strong>₹ <span id="totalPayAmount"><?php echo $total_amount; ?></span>/-</strong>
                        <input type="hidden" id="totalAmt" name="total_amount" value="<?php echo $total_amount; ?>"/>
                        </p>
                        
                                
                        <div class="form-group text-right <?php echo $tableDisp; ?>" id="pay_now">
                            <button type="submit" name='<?php echo $submitType; ?>'  class="btn btn-primary">PAY NOW</button>
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