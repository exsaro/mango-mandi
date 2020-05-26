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
    // console.log(pageName)
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