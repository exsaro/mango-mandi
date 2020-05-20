<?php 
    include 'header.php';
    $checkIteration = 0;
    $title      = 'Add Voucher';
    $editData   = [];
    $submitType = 'store';
    $transcationData = [];
    $transcationData[0]['transaction_id']    = '';
    $transcationData[0]['amount']            = '';
    $transcationData[0]['description']       = '';
    $farmerOptionData = $commonModel->getData('farmer_master','list','','');
    $transcationOptionData = $commonModel->getData('transaction_master','list','','');
    $amount = 0;

    if(isset($_GET['id'])){
        $title      = 'Edit Voucher';
        $voucherEditData = $commonModel->getData('voucher_transaction_detail','edit',$_GET['id'],'voucher_transaction_detail_id');
        $voucherGroupData = $commonModel->getData('voucher_transaction_group','edit',$_GET['id'],'voucher_transaction_detail_id');
        $editData   = isset($voucherEditData[0]) ?  $voucherEditData[0] : [] ;
        $submitType = 'update';
    }
    $id             = isset($editData['voucher_transaction_detail_id'])    ? $editData['voucher_transaction_detail_id']      : '';
    $voucherNo      = isset($editData['voucher_no'])  ? $editData['voucher_no']   : '';
    $voucherDate    = isset($editData['voucher_date'])  ? $editData['voucher_date']   : '';
    $farmerId       = isset($editData['farmer_id'])  ? $editData['farmer_id']   : '';
    $transcationDetails = isset($voucherGroupData)   ? $voucherGroupData : $transcationData;
    $status      = (isset($editData['status']) && $editData['status'] == 'IA')? 'IA': 'A';
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php';?>
        <div class="col-md-9 mt-5 ml-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-3">
                <h1><?php echo $title; ?></h1>
                <a href="voucherTransaction.php" class="btn btn-secondary">Back</a>
            </div>
            <form action="../Model/VoucherTransactionDetail.php" method="post" id="addVoucher">
                
                    <input type="hidden" id="editId" name="editId" value='<?php echo $id; ?>' />
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Voucher No</label>
                            <input type="text" class="form-control" name="voucher_no" id="voucher_no"  placeholder="Voucher No" value="<?php echo  $voucherNo; ?>" required  minlength=3 maxlength=100 />
                        </div>
                        <div class="form-group">
                            <label for="">Voucher Date</label>
                            <div class="input-group">
                                <input type="text" name="voucher_date" id="date_picker" data-datepicker="separateRange" class="form-control datetimepicker" value="<?php echo $voucherDate; ?>" />
                                <div class="input-group-append" >
                                    <span class="input-group-text"><span class="material-icons text-primary">calendar_today</span></span>
                                </div>
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


                        <!-- Add and Remove Transaction START-->
                        <div id="originalDiv">
                            <?php foreach($transcationDetails as $key => $value) { 
                                    $checkIteration = $key;
                                    $removeClsBtn   = '';
                                    $addClsBtn   = '';
                                    if($checkIteration == 0 && count($transcationDetails) == 1 )
                                        $removeClsBtn = 'display:none;';
                                    elseif(count($transcationDetails)-1 == $checkIteration )
                                        $addClsBtn   = '';                                  
                                    else
                                        $addClsBtn   = 'display:none;';                                  
                                    $amount += $value['amount'];
                            ?>

                                <div class="form-group identifyCls" id="identifyDiv_<?php echo $key; ?>" data-size="<?php echo $key; ?>">

                                    <div class="card mb-2">
                                        <div class="card-body alert-secondary">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">Voucher Title</label>
                                                    <select class="custom-select" id="transcationId_<?php echo $key; ?>" name="transaction_detail[<?php echo $key; ?>][transaction_id]"   required>
                                                        <option value="">Select Transcation</option>
                                                        <?php foreach($transcationOptionData as $tKey => $tValue) { ?>
                                                            <option <?php echo ($value['transaction_id'] ==  $tValue['transaction_id'])?'selected':''; ?> value="<?php echo $tValue['transaction_id']; ?>" ><?php echo $tValue['transaction_name']." - " ; ?><?php echo $tValue['transaction_code']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="">(₹) Amount</label>
                                                    <input type="number" value="<?php echo $value['amount']; ?>" onkeyup="calculateVoucher()" class="form-control calculateVoucher" name="transaction_detail[<?php echo $key; ?>][amount]"  placeholder="Amount" required minlength=1 maxlength=100 />
                                                </div>
                                                <div class="col">
                                                    <label for="">Description</label>
                                                    <input type="text" value="<?php echo $value['description']; ?>" class="form-control" name="transaction_detail[<?php echo $key; ?>][description]"  placeholder="Description" required  minlength=3 maxlength=100  />
                                                </div>
                                            </div>        
                                        </div>
                                    </div>
                                    <p class="text-right fz12">
                                        <a style="<?php echo $addClsBtn; ?>" class="addClass" id="addInx_<?php echo $key; ?>" href="javascript:void(0);" onclick="addTranscation(0)" >Add </a> 
                                        <a style="<?php echo $removeClsBtn; ?>" class="removeClass" id="removeInx_<?php echo $key; ?>" href="javascript:void(0);" onclick="removeTranscation(<?php echo $key; ?>)" >  Remove</a>
                                    </p>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- Add and Remove Transaction END-->
                                  <p><span class="font-weight-bold">Total Amount : </span> <span id="calcTotalVoucher"><?php echo $amount; ?> </span></span></p>                              

                        <div class="form-group text-right">
                        <button  type="submit" name='<?php echo $submitType; ?>' class="btn btn-primary">Submit</button>
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
                <div class="row">
                    <div class="col">
                        <label for="">Voucher Title</label>
                        <select class="custom-select" id="transcationId_XXX"  name="transaction_detail[XXX][transaction_id]"  required>
                        <option value="">Select Transcation</option>
                            <?php foreach($transcationOptionData as $tKey => $tValue) { ?>
                                <option value="<?php echo $tValue['transaction_id']; ?>" ><?php echo $tValue['transaction_name']." - " ; ?><?php echo $tValue['transaction_code']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="">(₹) Amount</label>
                        <input type="number" class="form-control calculateVoucherYYY" placeholder="Amount" name="transaction_detail[XXX][amount]"  onkeyup="calculateVoucher()" required  minlength=1 maxlength=100 />
                    </div>
                    <div class="col">
                        <label for="">Description</label>
                        <input type="text" class="form-control" placeholder="Description" name="transaction_detail[XXX][description]" required   minlength=3 maxlength=100/>
                    </div>
                </div>        
            </div>
        </div>
        <p class="text-right fz12">
            <a class="addClass" id="addInx_XXX" href="javascript:void(0);" onclick="addTranscation(0)">Add</a> 
            <a class="removeClass" id="removeInx_XXX" href="javascript:void(0);" onclick="removeTranscation(XXX)">Remove</a>
        </p>
    </div>
</div>