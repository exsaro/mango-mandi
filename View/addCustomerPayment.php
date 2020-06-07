<?php 
    include 'header.php';
    $paymentNumberFormat1        = $commonModel->getAutoDate();
    $paymentNumberFormat2        = $commonModel->getFinalRow('revived_payment','auto_increment_number','auto_increment_number_id');
    $paymentNumberFormat         = 'CP'.$paymentNumberFormat1.$paymentNumberFormat2;
    $customerOptionData          = $commonModel->getData('customer_master','list','','');
    $companyData                 = $commonModel->getData('company_master','list','','')[0];
    $paymnetTypeOption           = $language->getConfigData()['payment_type'];
    $editData                    = [];
    $salesOptionData             = [];
    $customerPaymentDetailEditData = [];
    $customerPaymentEditData     = [];
    $submitType                  = 'store';
    $tableDisp                   = 'd-none';
    $payDisp                     = 'd-none';
    $lockSection                 = '';
    $lockSectionPointer          = '';

    if(isset($_GET['id'])){
        $customerPaymentEditData       = $commonModel->getData('customer_payment','edit',$_GET['id'],'customer_payment_id');
        $customerPaymentDetailEditData = $commonModel->getCustomerPaymentDetail($_GET['id']);
        $editData                      = isset($customerPaymentEditData[0]) ?  $customerPaymentEditData[0] : [] ;
        $salesOptionData               = $commonModel->getData('sales','list','','');
        $submitType                    = 'update';
        $tableDisp                     = '';
        $payDisp                       = '';
        $lockSection                   = 'lock-section-parent';
        $lockSectionPointer            = 'lock-section-pointer';
    }

    $id                         = isset($editData['customer_payment_id'])       ? $editData['customer_payment_id']      : '';
    $customer_id                = isset($editData['customer_id'])  ? $editData['customer_id']   :'';
    $paymentNo                  = isset($editData['customer_payment_number'])  ? $editData['customer_payment_number']   : $paymentNumberFormat;
    $paymentDate                = isset($editData['customer_payment_date'])  ? $editData['customer_payment_date']   : $paymentNumberFormat;
    $sales_id                   = isset($editData['edit_sales_id'])  ? explode(',',$editData['edit_sales_id'])  : [];
    $payment_type               = isset($editData['payment_type'])  ? $editData['payment_type']  : '';
    $payment_bank_account_no    = isset($editData['payment_bank_account_no'])  ? $editData['payment_bank_account_no']  : '';
    $payment_ifsc_code          = isset($editData['payment_ifsc_code'])  ? $editData['payment_ifsc_code']  : '';
    $payment_cheque             = isset($editData['payment_cheque'])  ? $editData['payment_cheque']  : ''; 
    $company_bank_account_no    = isset($editData['company_bank_account_no'])  ? $editData['company_bank_account_no']  : $companyData['company_bank_account_no']; 
    $company_ifsc_code          = isset($editData['company_ifsc_code'])  ? $editData['company_ifsc_code']  : $companyData['company_ifsc_code']; 
    $balance_amount             = isset($editData['balance_amount'])  ? $editData['balance_amount']  : 0; 
    $sales_amount               = isset($editData['sales_amount'])  ? $editData['sales_amount']  : 0; 
    $customer_paid_amount       = isset($editData['customer_paid_amount'])  ? $editData['customer_paid_amount']  : 0; 
    $total_amount               = isset($editData['total_amount'])  ? $editData['total_amount']  : 0; 
    $description                = isset($editData['description'])  ? $editData['description']  : ''; 
    // $hidden_sales_id            = [];
    $chequeDisp                 = $payment_cheque!='cheque'?'d-none':'';
    $i = 1;
?>
<div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Customer Payment Entry</h1>
                    <a href="customerPayment.php" class="btn btn-secondary">Back</a>
                </div>
                <form method="post" action="../Model/CustomerPayment.php" id="addPayment">
                    <div id="customer_net_amount_hole">
                        <?php foreach($customerPaymentDetailEditData as $cpKey => $cpValue){ ?>
                            <input type="hidden" id="cus_sales_no_<?php echo $cpValue['sales_id']; ?>" name="sales_payment_detail[<?php echo $cpValue['sales_id']; ?>][sales_no]" value="<?php echo $cpValue['sales_no']; ?>" >
                            <input type="hidden" id="customer_sales_net_amount_<?php echo $cpValue['sales_id']; ?>" name="sales_payment_detail[<?php echo $cpValue['sales_id']; ?>][customer_sales_net_amount]" value="<?php echo $cpValue['customer_sales_net_amount']; ?>" >
                        <?php }  ?>
                    </div>
                    <input type="hidden" id="hidden_sales_id" name="hidden_sales_id" value="<?php echo implode(',',$sales_id); ?>" />

                    <input type="hidden" id="editId" name="editId" value='<?php echo $id; ?>' />
                    <input type="hidden" id="autoIncNumber" name="autoIncNumber" value='<?php echo $paymentNumberFormat2; ?>' />
                    <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Bill No</label>
                                    <input type="text" class="form-control" value="<?php echo $paymentNo; ?>" name="customer_payment_number" placeholder="Bill No" readonly required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Bill Date</label>
                                    <div class="input-group">
                                        <input type="text" name="customer_payment_date" id="date_picker" data-datepicker="separateRange" class="form-control datetimepicker" required/>
                                        <div class="input-group-append"><span class="input-group-text"><span class="material-icons text-primary">calendar_today</span></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col <?php echo $lockSection; ?>">
                                <div class="form-group">
                                    <label for="">Select Customer</label>
                                    <select  name="customer_id" id="customer_payment_customer_id" class="custom-select <?php echo $lockSectionPointer; ?>" required>
                                        <option value="">Select Customer</option>
                                            <?php foreach($customerOptionData as $fKey => $fValue) {  ?>
                                                <option <?php echo ($customer_id ==  $fValue['customer_id'])?'selected':''; ?> value="<?php echo $fValue['customer_id']; ?>"> <?php echo $fValue['customer_name']." - " ; ?><?php echo $fValue['customer_code']; ?> </option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Sale No</label>
                                    <select name="sales_id[]" id="payment_sales_id" class="custom-select multi"  multiple="multiple" required>
                                        <?php foreach($salesOptionData as $fKey => $fValue) {  
                                            if((($fValue['payment_status'] != 'P' ) || ($fValue['payment_status'] == 'P' && in_array( $fValue['sales_id'] ,$sales_id))) && $fValue['customer_id'] == $customer_id) {
                                        ?>
                                            <option <?php echo (in_array( $fValue['sales_id'] ,$sales_id))?'selected':''; ?> value="<?php echo $fValue['sales_id']; ?>"> <?php echo $fValue['billing_number']?> </option>
                                        <?php } 
                                            } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Account Number</label>
                                    <div class="form-row">
                                        <div class="col">
                                        <input type="text" class="form-control" name="payment_bank_account_no" id="fromCustomerBank"  value="<?php echo $payment_bank_account_no; ?>" placeholder="From" required minlength=3 maxlength=100 >
                                        </div>
                                        <div class="col">
                                        <input type="text" class="form-control" name="company_bank_account_no" placeholder="To" value="<?php echo $company_bank_account_no; ?>" required minlength=3 maxlength=100>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">IFSC Code</label>
                                    <div class="form-row">
                                        <div class="col">
                                        <input type="text" class="form-control" id="fromCustomerIFSC"  name="payment_ifsc_code" value="<?php echo $payment_ifsc_code; ?>" placeholder="From" required minlength=3 maxlength=100>
                                        </div>
                                        <div class="col">
                                        <input type="text" class="form-control" placeholder="To" name="company_ifsc_code" value="<?php echo $company_ifsc_code; ?>" required minlength=3 maxlength=100>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Select Payment Type</label>
                                    <select name="payment_type" id="payment_type" class="custom-select" required>
                                        <option value="">payment Type</option>
                                        <?php foreach($paymnetTypeOption as $pKey => $pValue) {  ?>
                                                <option <?php echo ($payment_type ==  $pValue)?'selected':''; ?> value="<?php echo $pValue; ?>"> <?php echo $pKey; ?> </option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col <?php echo $chequeDisp; ?>" id="payment_cheque">
                                <div class="form-group">
                                    <label for="">Cheque No</label>
                                    <input type="text" value class="form-control"  name="payment_cheque" value="<?php echo $payment_cheque; ?>" required minlength=3 maxlength=100 />
                                </div>
                            </div>
                        </div>

                        <div class="inline-table mb-3">
                            <table class="table table-bordered table-primary <?php echo $tableDisp; ?>"  id="payment_detail">
                                <thead>
                                    <tr>
                                        <th>S. No</th>
                                        <th>Sales NO</th>
                                        <th>Payment Date</th>
                                        <th width="200">(₹) Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="customerPaymentTable">
                                    <?php foreach($customerPaymentDetailEditData as $key => $value) {   ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $value['sales_no']; ?></td>
                                            <td><?php echo $value['payment_date']; ?></td>
                                            <td><?php echo $value['amount']; ?></td>
                                        </tr>
                                        <input type="hidden" id="sales_id_<?php echo $key; ?>" name="customer_payment_detail[<?php echo $key; ?>][sales_id]" value="<?php echo $value['sales_id']; ?>" >
                                        <input type="hidden" id="sales_no_<?php echo $key; ?>" name="customer_payment_detail[<?php echo $key; ?>][sales_no]" value="<?php echo $value['sales_no']; ?>" >
                                        <input type="hidden" id="payment_date_<?php echo $key; ?>" name="customer_payment_detail[<?php echo $key; ?>][payment_date]" value="<?php echo $value['payment_date']; ?>" aria-label="">
                                        <input type="hidden" id="amount_<?php echo $key; ?>" name="customer_payment_detail[<?php echo $key; ?>][amount]" value="<?php echo $value['amount']; ?>" >
                                        <input type="hidden" id="net_amount_<?php echo $key; ?>" name="customer_payment_detail[<?php echo $key; ?>][customer_sales_net_amount]" value="<?php echo $value['customer_sales_net_amount']; ?>" >
                                        <input type="hidden" id="index" value="<?php echo $key; ?>">
                                    <?php $i++; }  ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- <p class="text-right h5"> <strong><span>13500.00</span>/-</strong></p> -->

                           
                        <div class="d-flex justify-content-end">
                        <table class="table table-bordered w-50 <?php echo $payDisp; ?>" id="paymentSection">
                            <tbody>
                                <tr>
                                    <td class="h5">Total Sales Amount</td>
                                    <td class="h5">₹ <span id="customer_sales_amount"><?php echo $sales_amount; ?></span>/-</td>
                                    <input type="hidden" id="hidden_customer_sales_amount" name="sales_amount" value="<?php echo $sales_amount; ?>" >
                                </tr>
                                <tr>
                                    <td class="h5">Customer Paid Amout</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" name="customer_paid_amount" id="customer_paid_amount" value="<?php echo $customer_paid_amount; ?>" class="form-control" required  >
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h5">Balance Amount</td>
                                    <td class="h5">₹ <span id="custometBalanceAmount"><?php echo $balance_amount; ?></span>/-</td>
                                    <input type="hidden" id="customet_balance_amount" name="balance_amount" value="<?php echo $balance_amount; ?>" >
                                </tr>
                            </tbody>
                        </table>

                        </div>
                        
                        
                        

                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" id="" rows="3" name="description" autocomplete="off" spellcheck="false" required><?php echo $description; ?></textarea>
                        </div>

                        <p class="text-right h1 mb-5">
                        <span>Total: </span><strong>₹ <span id="totalCustomerPayAmount"><?php echo $total_amount; ?></span>/-</strong>
                        <input type="hidden" id="totalCustomerAmt" name="total_amount" value="<?php echo $total_amount; ?>" >
                        </p>
                        
                        <div class="form-group text-right <?php echo $tableDisp; ?>" id="customer_pay_now">
                                
                            <div class="form-group text-right"><button type="submit" name='<?php echo $submitType; ?>' class="btn btn-primary">Submit</button></div>
                                
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
<?php include 'footer.php'; ?>