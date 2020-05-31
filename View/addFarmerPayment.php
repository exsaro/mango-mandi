<?php 
    include 'header.php';
    $paymentNumberFormat1        = $commonModel->getAutoDate();
    $paymentNumberFormat2        = $commonModel->getFinalRow('payment','auto_increment_number','auto_increment_number_id');
    $paymentNumberFormat         = 'PE'.$paymentNumberFormat1.$paymentNumberFormat2;
    $farmerOptionData = $commonModel->getData('farmer_master','list','','');

    $paymentNo      = isset($editData['billing_number'])  ? $editData['billing_number']   : $paymentNumberFormat;
    $farmer_id      = '';   
    $farmer_payment_percentage       = $language->getConfigData()['farmer_payment_percentage'];

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
                <form method="post" id="addPayment">
                    <input type="hidden" id="percentage" name="percentage" value="<?php echo $farmer_payment_percentage; ?>"/>
                    <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Bill No</label>
                                    <input type="text" class="form-control" name="payment_no" value="<?php echo $paymentNo; ?>" placeholder="Payment No" required readonly/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Bill Date</label>
                                    <div class="input-group">
                                        <input type="text" name="payment_date" id="date_picker" data-datepicker="separateRange" class="form-control datetimepicker" />
                                        <div class="input-group-append"><span class="input-group-text"><span class="material-icons text-primary">calendar_today</span></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Select Farmer</label>
                                    <select name="farmer_id" id="payment_farmer_id" class="custom-select" required>
                                        <option value="">Select Farmer</option>
                                        <?php foreach($farmerOptionData as $fKey => $fValue) {  ?>
                                            <option <?php echo ($farmer_id ==  $fValue['farmer_id'])?'selected':''; ?> value="<?php echo $fValue['farmer_id']; ?>"> <?php echo $fValue['farmer_name']." - " ; ?><?php echo $fValue['farmer_code']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Purchase No</label>
                                    <select name="purchase_id" id="payment_purchase_id" class="custom-select" required>
                                        <option value="">select Purchase</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Select Voucher No</label>
                                    <select name="voucher_id" id="payment_voucher_id" class="custom-select multi"  multiple="multiple">
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="inline-table mb-3">
                        <table class="table table-bordered table-primary d-none" id="payment_detail">
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
                            </tbody>
                        </table>
                        </div>
                        <p class="text-right h5">Total Sales Amount: ₹ <strong><span id="totalSale">0</span>/-</strong></p>
                        <p class="text-right h5">Total Detection: ₹ <strong><span id="totalDetection">0</span>/-</strong></p>
                        <input type="hidden" id="totalSaleAmt" name="totalSaleAmt" value="0"/>
                        <input type="hidden" id="reduceAmt" name="reduceAmt" value="0"/>
                        
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" id="" rows="3" autocomplete="off" spellcheck="false" required></textarea>
                        </div>

                        <p class="text-right h1 mb-5">
                        <span>Total: </span><strong>₹ <span id="totalPayAmount">0</span>/-</strong>
                        <input type="hidden" id="totalAmt" name="totalAmt" value="0"/>
                        </p>
                        
                                
                        <div class="form-group text-right d-none" id="pay_now"><button type="submit" name='payment_submit' class="btn btn-primary">PAY NOW</button></div>
                                
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