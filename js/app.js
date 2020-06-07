(function getPageName() {
    var pageUrl, pageName, page;

    pageUrl = window.location.href;
    page = pageUrl.split("/");
    pageName = page[page.length - 1];

    if (
        pageName == "company.php" ||
        pageName == "item.php" ||
        pageName == "farmer.php" ||
        pageName == "customer.php" ||
        pageName == "transaction.php" ||
        pageName == "user.php" ||
        pageName == "addCompany.php" ||
        pageName == "addItem.php" ||
        pageName == "addFarmer.php" ||
        pageName == "addCustomer.php" ||
        pageName == "addTransaction.php" ||
        pageName == "addUser.php"
    ) {
        $(".sidebar nav ul").hide();
        $(".sidebar nav a").removeClass("active");
        $("#master-nav").show();
        $('#master-nav a[href="' + pageName + '"]').addClass("active");
    } else if (
        pageName == "voucherTransaction.php" ||
        pageName == "purchase.php" ||
        pageName == "sales.php" ||
        pageName == "farmerPayment.php" ||
        pageName == "customerPayment.php" ||
        pageName == "addVoucher.php" ||
        pageName == "addPurchase.php" ||
        pageName == "addSales.php" ||
        pageName == "addFarmerPayment.php" ||
        pageName == "addCustomerPayment.php"
    ) {
        $(".sidebar nav ul").hide();
        $(".sidebar nav a").removeClass("active");
        $("#transac-nav").show();
        $('#transac-nav a[href="' + pageName + '"]').addClass("active");
    }

    if (localStorage.getItem("themeName")) {
        $("#change_theme").attr(
            "href",
            "../css/themes/" + localStorage.getItem("themeName") + ".min.css"
        );
    }
})();

$(
    "#addCompany, #addItem, #addFarmer, #addCustomer, #addTransaction, #addUser,#adminCompany, #addVoucher,#addPurchase, #addPayment, #printReport ,#addSales"
).validate();

$(document).ready(function () {

    $('.multi').select2();

    $("#change-theme").click(function (e) {
        e.preventDefault();
        $(this).hide();
        $(this).next(".choose").show();
    });
    $(".choose li").click(function (e) {
        e.preventDefault();
        var nam = $(this).attr("class");
        if (localStorage.getItem("themeName")) {
            localStorage.removeItem("themeName");
        }
        localStorage.setItem("themeName", nam);

        $("#change_theme").attr(
            "href",
            "../css/themes/" + localStorage.getItem("themeName") + ".min.css"
        );
        $(this).parents(".choose").hide();
        $(this).parents(".choose").siblings("#change-theme").show();
    });

    $("#reportModal").on("show.bs.modal", function (event) {
        $(this).find(".custom-select,.form-control").val("");
    });

    $("#date_picker").each(function (el) {
        $(this).datetimepicker({
            format: "DD/MM/YYYY HH:MM",
            minDate: new Date(),
            maxDate: new Date(),
        });
    });

    $("#report_picker1").datetimepicker({
        format: "DD/MM/YYYY",
    });
    $("#report_picker2").datetimepicker({
        format: "DD/MM/YYYY",
        useCurrent: false, //Important! See issue #1075
    });
    $("#report_picker1").on("dp.change", function (e) {
        $("#report_picker2").data("DateTimePicker").minDate(e.date);
    });
    $("#report_picker2").on("dp.change", function (e) {
        $("#report_picker1").data("DateTimePicker").maxDate(e.date);
    });

    // Display Message
    setTimeout(function () {
        $(".msg-alert").removeClass("d-block");
    }, 2000);

    $("#data-table").DataTable({
        pageLength: 10,
    });

    //User Validation
    if ($("#addUser").length) {
        uniqueValidation(
            "user_name",
            "user_master",
            "yes",
            "user_id",
            "User name already exists"
        );
    }

    //Company Validation
    if ($("#addCompany").length) {
        uniqueValidation(
            "company_name",
            "company_master",
            "no",
            "company_id",
            "Company name already exists"
        );

        $("#pincode").rules("add", {
            number: true,
            messages: {
                number: "Please enter valid pincode",
            },
        });
    }

    //Item Validation
    if ($("#addItem").length) {
        $("#price").rules("add", {
            number: true,
            messages: {
                number: "Please enter valid amount",
            },
        });

        uniqueValidation(
            "product_name",
            "product_master",
            "yes",
            "product_id",
            "Item name already exists"
        );

        uniqueValidation(
            "product_code",
            "product_master",
            "yes",
            "product_id",
            "Item code already exists"
        );
    }

    //Farmer Validation
    if ($("#addFarmer").length) {
        uniqueValidation(
            "farmer_code",
            "farmer_master",
            "yes",
            "farmer_id",
            "Farmer code already exists"
        );
    }

    //Customer Validation
    if ($("#addCustomer").length) {
        uniqueValidation(
            "customer_code",
            "customer_master",
            "yes",
            "customer_id",
            "Customer code already exists"
        );
    }

    //Voucher Validation
    if ($("#addVoucher").length) {
        uniqueValidation(
            "voucher_no",
            "voucher",
            "yes",
            "voucher_id",
            "Voucher number already exists"
        );
    }

    //Transaction Validation
    if ($("#addTransaction").length) {
        uniqueValidation(
            "transaction_code",
            "transaction_master",
            "yes",
            "transaction_id",
            "Transaction code already exists"
        );
    }
    if($("#addPurchase").length){
        uniqueValidation('receipt_number','purchase','yes','purchase_id','Receipt No. already exists');
    }

    if($("#addSales").length){
        uniqueValidation('billing_number','sales','yes','sales_id','Billing No. already exists');
    }


    
} );


/*  Voucher Transcation Details Start*/

    function addTranscation(index){
        
        var checkLength = parseInt($('#checklength').val());
        checkLength++;
        $('#checklength').val(checkLength);
        var CloneDiv = $('#cloneDiv').html().replace(/XXX/g,checkLength).replace(/YYY/g,'');
        $('#originalDiv').append(CloneDiv);
        var length = $('.identifyCls').length -1;
        $('.identifyCls').each(function(idx){
            var findInx = $(this).data('size');
            $('.addClass').hide();
            $('.removeClass').show();
            if( length == idx){
                $('#addInx_'+findInx).show();
                $('#removeInx_'+findInx).show(); 
            }
        })
    }



function removeTranscation(index) {
    $("#identifyDiv_" + index).remove();
    var length = $(".identifyCls").length - 1;
    $(".identifyCls").each(function (idx) {
        var findInx = $(this).data("size");

        if (length > 0) {
            $(".removeClass").show();
        }
        $(".addClass").hide();

        if (length == idx) {
            if (length > 0) {
                $("#removeInx_" + findInx).show();
            } else {
                $("#removeInx_" + findInx).hide();
            }
            $("#addInx_" + findInx).show();
        }
    });
    calculateVoucher();
    calculateSales();
}

function calculateVoucher() {
    var totalAmount = 0;
    $(".identifyCls").each(function (idx) {
        var findInx = $(this).data("size");
        var totVal = $('input[name="transaction_detail[' + findInx + '][amount]"]').val() != '' ? $('input[name="transaction_detail[' + findInx + '][amount]"]').val() : 0;
        totalAmount += parseFloat(totVal);
    });
    $("#calcTotalVoucher").html(totalAmount);
}
/*  Voucher Transcation Details End*/


/*  Purchase Reduction Details Start*/
    $(".calcReduction").keyup(function () {
        var totalReduction  = 0;
        var tractorAuto     = $('#tractor_auto').val()!=''? $('#tractor_auto').val():0;
        var commission     = $('#commission').val()!=''? $('#commission').val():0;
        var eC     = $('#e_c').val()!=''? $('#e_c').val():0;
        var rent     = $('#rent').val()!=''? $('#rent').val():0;
        var unloading     = $('#unloading').val()!=''? $('#unloading').val():0;
        var advanced     = $('#advanced').val()!=''? $('#advanced').val():0;
        totalReduction      = parseFloat(tractorAuto)+parseFloat(commission)+parseFloat(eC)+parseFloat(rent)+parseFloat(unloading)+parseFloat(advanced);
        $("#calcTotalReduction").html(totalReduction.toFixed(2));
    });
/*  Purchase Reduction Details End*/


/*  Sales Addition Details Start*/
$(".totalAddition").keyup(function () {
    var totalAddition  = 0;
    var hC     = $('#h_c').val()!=''? $('#h_c').val():0;
    var mC     = $('#m_c').val()!=''? $('#m_c').val():0;
    var colli     = $('#colli').val()!=''? $('#colli').val():0;
    var packing     = $('#packing').val()!=''? $('#packing').val():0;
    var lorryAdvance     = $('#lorry_advance').val()!=''? $('#lorry_advance').val():0;
    var otherExpenses     = $('#other_expenses').val()!=''? $('#other_expenses').val():0;
    totalAddition      = parseFloat(hC)+parseFloat(mC)+parseFloat(colli)+parseFloat(packing)+parseFloat(lorryAdvance)+parseFloat(otherExpenses);
    $("#salesTotalAddition").html(totalAddition.toFixed(2));
    $("#other_addition_amount").val(totalAddition.toFixed(2));
    calculateTotalSale();
})
function calculateSales() {
    var totalAmount = 0;
    $(".identifyCls").each(function (idx) {
        var findInx = $(this).data("size");
        var totVal = $('input[name="sales_details[' + findInx + '][amount]"]').val() != '' ? $('input[name="sales_details[' + findInx + '][amount]"]').val() : 0;
        $("#hiddenSellAmnt_"+findInx).val(totVal);
        var quantity    = $('input[name="sales_details[' + findInx + '][quantity]"]').val() != '' ? $('input[name="sales_details[' + findInx + '][quantity]"]').val() : 0;
        var hiddenAmount = $("#hiddenSellAmnt_"+findInx).val() != '' ? $("#hiddenSellAmnt_"+findInx).val() : 0;
        if(parseInt(quantity) > 0){
            hiddenAmount = parseFloat(hiddenAmount) * parseInt(quantity);
        }
        $("#totalSellAmnt_"+findInx).text(hiddenAmount);
        totalAmount += parseFloat(hiddenAmount);
});
    $("#totalSales").html(totalAmount.toFixed(2));
    calculateTotalSale();
}

function calculateTotalSale() {
    var totalSalesAmount  = 0;
    var sTotal = $("#salesTotalAddition").text() != '' ? $("#salesTotalAddition").text() :0;
    var tsTotal = $("#totalSales").text() != '' ? $("#totalSales").text() :0;
    totalSalesAmount = parseFloat(sTotal) + parseFloat(tsTotal) ;
    $("#totalAmount").html(totalSalesAmount.toFixed(2));
    $("#totalAmtForSales").val(totalSalesAmount.toFixed(2));
}

function getProductAmount(sInx){
    var productId = $('#productId_'+sInx).val();;
    var postJson = {};
    postJson['salesAmount'] = 'salesAmount';
    postJson['table']  = 'product_master';
    postJson['field']  = 'price';
    postJson['column_name']  = 'product_id';
    postJson['column_value']  = productId;
    postJson['company_id'] = $("#companyId").val();
    $.post("../Model/CommonModel.php",postJson,
    function(data,status){
        if(status == 'success'){
            $('input[name="sales_details[' + sInx + '][amount]"]').val(JSON.parse(data)['amount']);
            $("#hiddenSellAmnt_"+sInx).val(JSON.parse(data)['amount']);
            calculateSales();
        }
    });
}

function updatedSaleAmnt(indx){
    var quantity    = $('input[name="sales_details[' + indx + '][quantity]"]').val() != '' ? $('input[name="sales_details[' + indx + '][quantity]"]').val() : 0;

    if(quantity == 0){
        var saleAmount  = $("#hiddenSellAmnt_"+indx).val() != '' ? $("#hiddenSellAmnt_"+indx).val() :0;
        $("#sellAmnt_"+indx).val(saleAmount);
    }

    calculateSales();
}

function getFarmerProduct(index){
    var companyId = $('#sideCompany').val();
    var farmerId = $('#sales_farmer_'+index).val();
    if(farmerId != ''){
        var postJson = {};
        postJson['selectFarmerProduct'] = '';
        postJson['company']  = companyId;
        postJson['farmerId']  = farmerId;
        $("#productId_"+index).empty();

        $.post("../Model/CommonModel.php",postJson,
        function(data,status){
            data = JSON.parse(data);
            if(data['purchase'].length > 0){
                var purchaseHtml = '<option value="" >Select Item</option>';
                $.each( data['purchase'] , function( index, item ) {
                    if(item.payment_status != 'P')
                    purchaseHtml += '<option value="'+item.product_id  +'">'+item.product_name+' - '+item.product_code+'</option>';
                });
            }else{
                var purchaseHtml = '<option value="" disabled>No Data Found</option>';
            }
            $("#productId_"+index).html(purchaseHtml);
        });
    }
}

/*  Sales Addition Details End*/



/* Common Function Unique Validation Ajax Call  Start*/

function uniqueValidation(
    filedName,
    tableName,
    companyIdcheck,
    editColumn,
    message
) {
    $("#" + filedName).rules("add", {
        remote: {
            url: "../Model/CommonModel.php",
            type: "post",
            data: {
                validation: "uniqueValidation",
                tableName: tableName,
                companyId: companyIdcheck,
                companyIdValue: function () {
                    return $("#companyId").val();
                },
                checkColumn: filedName,
                editColumn: editColumn,
                checkColumnValue: function () {
                    return $("#" + filedName).val();
                },
                editColumnValue: function () {
                    return $("#editId").val();
                },
            },
        },
        messages: {
            remote: message,
        },
    });
}
/* Unique Validation Ajax Call  End*/


function changeCompany(){
    var companyId = $('#sideCompany').val();;
    var postJson = {};
    postJson['selectCompany'] = '';
    postJson['company']  = companyId;
    postJson['changeCompany']  = '';
    $.post("../View/chooseCompany.php",postJson,
    function(data,status){
        window.location = "../View/dashboard.php";
    });
}


/******** Farmer Payment Entry Start ********/

$('#payment_farmer_id').change(function(){
    var farmerId = $('#payment_farmer_id').val();
    var editId       = $('#editId').val()!=''?$('#editId').val():0;
    $("#payment_purchase_id").empty();
    $("#payment_voucher_id").empty();
    $("#paymentTable").html('');
    $("#payment_detail").addClass('d-none');
    $("#pay_now").addClass('d-none');
    $("#totalSale").html(0);
    $("#totalDetection").html(0);
    $('#totalPayAmount').html(0);
    if(farmerId != ''){
        var postJson = {};
        postJson['getVoucherAndPurchase']  = '';
        postJson['farmer_id']   = farmerId;
        postJson['editId']      = editId;
        $.post("../Model/FarmerPayment.php",postJson,
        function(data,status){
            if(status == 'success'){
                var data = JSON.parse(data);
                $("#payment_purchase_id").empty();
                if(data['purchase'].length > 0){
                    var purchaseHtml = '<option value="">Select Purchase</option>';
                    $.each( data['purchase'] , function( index, item ) {
                        purchaseHtml += '<option value="'+item.purchase_id  +'">'+item.receipt_number+'</option>';
                    });
                }else{
                    var purchaseHtml = '<option value="">No Data Found</option>';
                }
                $("#payment_purchase_id").html(purchaseHtml);

                $("#payment_voucher_id").empty();
                if(data['voucher'].length > 0 && data['purchase'].length > 0){
                    var voucherHtml = '';
                    $.each( data['voucher'] , function( index, item ) {
                        voucherHtml += '<option value="'+item.voucher_id  +'">'+item.voucher_no+'</option>';
                    });
                    $("#payment_voucher_id").html(voucherHtml);
                }
                if(data['sales_data'].length > 0){
                    var paymentHtml = '';   
                    var percentage = $('#percentage').val();
                    var reduction = $('#totalDetection').text();
                    var totalAmount = 0;
                    var tableInx    = 0;
                    $.each( data['sales_data'] , function( index, item ) {
                        var perAmount = (parseFloat(percentage/100)*parseFloat(item.amount)).toFixed(2);
                        var amount    = item.amount - perAmount;
                        paymentHtml += '<tr>';
                        paymentHtml += '<td>'+(index+1)+'</td>';
                        paymentHtml += '<td>'+item.product_name+'('+item.product_code+')'+'</td>';
                        paymentHtml += '<td>'+item.quantity+'</td>';
                        paymentHtml += '<input type="hidden" id="quantity_'+index+'" name="farmer_payment['+index+'][quantity]" value="'+item.quantity+'" aria-label="">';
                        paymentHtml += '<input type="hidden" id="sales_id_'+index+'" name="farmer_payment['+index+'][sales_id]" value="'+item.sales_id+'" aria-label="">';
                        paymentHtml += '<input type="hidden" id="sales_detail_id_'+index+'" name="farmer_payment['+index+'][sales_detail_id]" value="'+item.sales_detail_id+'" aria-label="">';
                        paymentHtml += '<input type="hidden" id="quantity_'+index+'" name="farmer_payment['+index+'][quantity]" value="'+item.quantity+'" aria-label="">';
                        paymentHtml += '<input type="hidden" id="product_id_'+index+'" name="farmer_payment['+index+'][product_id]" value="'+item.product_id+'" aria-label="">';
                        paymentHtml += '<td>';
                        paymentHtml += '<div class="input-group mb-0">';
                        paymentHtml += '<div class="input-group-prepend">';
                        paymentHtml += '<span class="input-group-text">₹</span>';
                        paymentHtml += '</div>';
                        paymentHtml += '<input type="text" class="form-control" onkeyup="farmerPaymentAmountChange('+index+')" id="amount_'+index+'" value="'+amount+'" name="farmer_payment['+index+'][amount]" required aria-label="">';
                        paymentHtml += '</div>';
                        paymentHtml += '</td>';
                        paymentHtml += '<td>';
                        paymentHtml += '<div class="input-group mb-0">';
                        paymentHtml += '<div class="input-group-prepend">';
                        paymentHtml += '<span class="input-group-text">₹</span>';
                        paymentHtml += '</div>';
                        paymentHtml += '<input type="text" class="form-control" name="farmer_payment['+index+'][sale_net_amount]"  id="net_amount_'+index+'" value="'+amount*item.quantity+'" aria-label="" readonly>';
                        paymentHtml += '</div>';
                        paymentHtml += '</td>';
                        paymentHtml += '</tr>';
                        totalAmount +=amount*item.quantity;
                        paymentHtml += '<input type="hidden" id="index" value="'+index+'">';
                    });
                    $("#paymentTable").html(paymentHtml);
                    // $("#totalSale").html(totalAmount);
                    // $("#totalSaleAmt").val(totalAmount);
                    // $("#totalAmt").val(parseFloat(totalAmount) - parseFloat(reduction));
                    // $('#totalPayAmount').html(parseFloat(totalAmount) - parseFloat(reduction));
                }
            }
        });
    }
    
});

$('#payment_voucher_id').change(function(){
    var voucherId = $('#payment_voucher_id').val();
    var totalSale = $("#totalSale").text();
    var editId       = $('#editId').val()!=''?$('#editId').val():0;
    var reduction = 0;
    $("#totalDetection").html(reduction);
    $('#totalPayAmount').html(parseFloat(totalSale) - parseFloat(reduction));
    $('#totalAmt').val(parseFloat(totalSale) - parseFloat(reduction));
    if(voucherId != '' && voucherId.length > 0){
        var postJson = {};
        postJson['getReduction']  = '';
        postJson['voucher_id']  = voucherId;
        postJson['editId']  = editId;
        $.post("../Model/FarmerPayment.php",postJson,
        function(data,status){
            if(status == 'success'){
                var data = JSON.parse(data);
                $.each( data['reduction'] , function( index, item ) {
                    reduction += parseFloat(item.amount);
                });
            }
            $("#totalDetection").html(reduction);
            $("#reduceAmt").val(reduction);            
            $('#totalPayAmount').html(parseFloat(totalSale) - parseFloat(reduction));
            $('#totalAmt').val(parseFloat(totalSale) - parseFloat(reduction));

        });
    }
    
});

function farmerPaymentAmountChange(inx){
    var qty     = $('#quantity_'+inx).val();
    var amount  = $('#amount_'+inx).val();
    $('#net_amount_'+inx).val(amount*qty);
    farmerPaymentToatalAmount();
}

function farmerPaymentToatalAmount(){
    var inx = $('#index').val();
    var detection = $("#totalDetection").text();

    var totalAmt = 0;
    for(var i=0; i<=inx; i++){
        var amt =   $('#net_amount_'+inx).val();
        totalAmt += parseFloat(amt);        
    }
    $("#totalSale").html(totalAmt);
    $("#totalSaleAmt").val(totalAmt);
    var amtReduse = parseFloat(totalAmt)- parseFloat(detection);
    $('#totalPayAmount').html(amtReduse);
    $('#totalAmt').val(amtReduse);
}


$('#payment_purchase_id').change(function(){
    var payment_purchase_id = $('#payment_purchase_id').val();
    if(payment_purchase_id != ''){
        $("#payment_detail").removeClass('d-none');
        $("#pay_now").removeClass('d-none');
    }else{
        $("#payment_detail").addClass('d-none');
        $("#pay_now").addClass('d-none');
    }
    farmerPaymentToatalAmount();
});

/******** Farmer Payment Entry End **********/


/******** Customer Payment Entry Start ********/
$('#customer_payment_customer_id').change(function(){
    $("#payment_sales_id").empty();
    $("#customerPaymentTable").html('');
    $("#fromCustomerBank").val('');
    $("#fromCustomerIFSC").val('');
    $("#customer_sales_amount").html(0);
    $("#hidden_customer_sales_amount").val(0);
    $("#customer_paid_amount").val('');
    $("#custometBalanceAmount").html(0);
    $("#customet_balance_amount").val(0);
    $("#totalCustomerPayAmount").html(0);
    $("#totalCustomerAmt").val(0);
    $("#payment_detail").addClass('d-none');
    $("#customer_pay_now").addClass('d-none');
    $("#paymentSection").addClass('d-none');
    
    var customerId = $("#customer_payment_customer_id").val();
    if(customerId != ''){
        var postJson = {};
        postJson['getSalesDetails']  = '';
        postJson['customer_id']   = customerId;
        $.post("../Model/CustomerPayment.php",postJson,
        function(data,status){
            if(status == 'success'){
                var data = JSON.parse(data);
                if(data['sales_data'].length > 0){
                    var salesHtml = '<option value="" disabled>Select Sales No</option>';
                    $.each( data['sales_data'] , function( index, item ) {
                        salesHtml += '<option value="'+item.sales_id  +'">'+item.billing_number+'</option>';
                    });
                }else{
                    var salesHtml = '<option value="">No Data Found</option>';
                }
                $("#payment_sales_id").html(salesHtml);

                if(data['customer_data'].length > 0){
                    $("#fromCustomerBank").val(data['customer_data'][0].bank_account_number);
                    $("#fromCustomerIFSC").val(data['customer_data'][0].bank_ifsc_code);
                }
            }
        });
    }

});

$("#payment_sales_id").change(function(){
    $("#customerPaymentTable").html('');
    // $("#fromCustomerBank").val('');
    // $("#fromCustomerIFSC").val('');
    $("#customer_sales_amount").html(0);
    $("#hidden_customer_sales_amount").val(0);
    $("#customer_paid_amount").val('');
    $("#custometBalanceAmount").html(0);
    $("#customet_balance_amount").val(0);
    $("#customer_total_addition_amount").html(0);
    $("#hidden_customer_total_addition_amount").val(0);
    $("#totalCustomerPayAmount").html(0);
    $("#totalCustomerAmt").val(0);
    $("#payment_detail").addClass('d-none');
    $("#customer_pay_now").addClass('d-none');
    $("#paymentSection").addClass('d-none');
    
    var salesId = $('#payment_sales_id').val();
    var totalSalesAmt = 0;

    if(salesId != '' && salesId.length > 0){
        var postJson = {};
        postJson['getSalesData']  = '';
        postJson['sales_id']  = salesId;
        $.post("../Model/CustomerPayment.php",postJson,
        function(data,status){
            if(status == 'success'){
                var data = JSON.parse(data);
                var totalAdition = {};
                var salesHtml = '';
                var totAdd = 0;
                var cusHtmlHole = '';

                if(data['sales_detail_data'].length > 0){
                    $.each( data['sales_detail_data'] , function( index, item ) {
                        var totSalAmt = (parseFloat(item.amount)*parseFloat(item.quantity)).toFixed(2);
                        salesHtml +='<tr>'
                        salesHtml += '<td>'+(index+1)+'</td>';
                        salesHtml += '<td>'+item.billing_number+'</td>';
                        salesHtml += '<td>'+item.payment_date+'</td>';
                        salesHtml += '<td>'+item.amount+'</td>';
                        salesHtml +='</tr>'
                        salesHtml +='<input type="hidden" id="sales_id_"'+index+'" name="customer_payment_detail["'+index+'"][sales_id]" value="'+item.sales_id+'" >';
                        salesHtml +='<input type="hidden" id="sales_no_"'+index+'" name="customer_payment_detail["'+index+'"][sales_no]" value="'+item.sales_no+'" >';
                        salesHtml +='<input type="hidden" id="payment_date_"'+index+'" name="customer_payment_detail["'+index+'"][payment_date]" value=""'+item.payment_date+'" >';
                        salesHtml +='<input type="hidden" id="amount_"'+index+'" name="customer_payment_detail["'+index+'"][amount]" value="'+item.amount+'" >';
                        salesHtml +='<input type="hidden" id="net_amount_"'+index+'" name="customer_payment_detail["'+index+'"][customer_sales_net_amount]" value="'+item.customer_sales_net_amount+'" >';                        
                        salesHtml +='<input type="hidden" id="index" value=""'+index+'"></input>';
                        if(totalAdition[item.sales_id] == undefined){
                            totalAdition[item.sales_id] = item.balance_amount;  
                            cusHtmlHole += '<input type="hidden" id="cus_sales_no_'+item.sales_id+'" name="sales_payment_detail['+item.sales_id+'][sales_no]" value="'+item.billing_number+'" >';
                        }
                    });

                    $.each( totalAdition , function( index, value ) {
                        totAdd+=parseFloat(value);
                    });                   
                }   
                if(data['sales_detail'].length > 0){
                    $.each( data['sales_detail'] , function( index, item ) {
                        if(totalAdition[item.sales_id] == undefined){
                            totAdd += parseFloat(item.customer_net_amount);
                            $("#customer_sales_net_amount_"+index).val(item.customer_net_amount);
                        }
                        cusHtmlHole += '<input type="hidden" id="customer_sales_net_amount_'+item.sales_id+'" name="sales_payment_detail['+item.sales_id+'][customer_sales_net_amount]" value="'+item.customer_net_amount+'" >';
                        cusHtmlHole += '<input type="hidden" id="cus_sales_no_'+item.sales_id+'" name="sales_payment_detail['+item.sales_id+'][sales_no]" value="'+item.billing_number+'" >';
                    });
                }
                $("#customer_net_amount_hole").html(cusHtmlHole);

                if(data['sales_detail'].length > 0 || data['sales_detail_data'].length > 0){
                    $("#customerPaymentTable").html(salesHtml);
                    if(salesHtml != ''){
                        $("#payment_detail").removeClass('d-none');
                    }
                    
                    if(totAdd != 0){
                        $("#paymentSection").removeClass('d-none');
                        $("#customer_pay_now").removeClass('d-none');
                    }
                    $("#customer_sales_amount").html(totAdd);
                    $("#hidden_customer_sales_amount").val(totAdd);
                    $("#totalCustomerPayAmount").html(totAdd);
                    $("#totalCustomerAmt").val(totAdd);
                }

            }
        });
    }

});


$("#payment_type").change(function(){
    var paymentType = $('#payment_type').val();
    if(paymentType != '' && paymentType == 'cheque'){
        $('#payment_cheque').removeClass('d-none');
    }else{
        $('#payment_cheque').addClass('d-none');
    }
});

$("#customer_paid_amount").keyup(function(){
    var customerPaidAmount  = $('#customer_paid_amount').val();
    var totalSale           = $('#totalCustomerPayAmount').text();
    var balance             = 0;
    if(customerPaidAmount != ''){
        balance             = parseFloat(totalSale) - parseFloat(customerPaidAmount);
    }
    $("#custometBalanceAmount").html(balance);
    $("#customet_balance_amount").val(balance);
});
/******** Customer Payment Entry End ********/