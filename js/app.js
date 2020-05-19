(function getPageName(){
    var pageUrl, pageName, page;

    pageUrl = window.location.href;
    page = pageUrl.split('/');
    pageName = page[page.length - 1];

    if(
        pageName == 'company.php' || 
        pageName == 'item.php' || 
        pageName == 'farmer.php' ||
        pageName == 'customer.php' ||
        pageName == 'transaction.php' ||
        pageName == 'user.php' || 
        pageName == 'addCompany.php' || 
        pageName == 'addItem.php' || 
        pageName == 'addFarmer.php' ||
        pageName == 'addCustomer.php' ||
        pageName == 'addTransaction.php' ||
        pageName == 'addUser.php'){
        $('.sidebar nav ul').hide();
        $('.sidebar nav a').removeClass('active');
        $('#master-nav').show();
        $('#master-nav a[href="'+pageName+'"]').addClass('active');
    }else if(
        pageName == 'voucherTransaction.php' ||
        pageName == 'purchase.php' ||
        pageName == 'sales.php' ||
        pageName == 'farmerPayment.php' ||
        pageName == 'customerPayment.php' ||
        pageName == 'addVoucher.php' ||
        pageName == 'addPurchase.php' ||
        pageName == 'addSales.php' ||
        pageName == 'addFarmerPayment.php' ||
        pageName == 'addCustomerPayment.php'){
        $('.sidebar nav ul').hide();
        $('.sidebar nav a').removeClass('active');
        $('#transac-nav').show();
        $('#transac-nav a[href="'+pageName+'"]').addClass('active');
    }


    if(localStorage.getItem("themeName")){   
        $('#change_theme').attr('href','../css/themes/'+localStorage.getItem("themeName")+'.min.css');
    }
    // console.log(pageName)

})();


$("#addCompany, #addItem, #addFarmer, #addCustomer, #addTransaction, #addUser,#adminCompany, #addVoucher,#addPurchase, #addPayment, #printReport").validate();

$(document).ready( function () {

    $('#change-theme').click(function(e){
        e.preventDefault();
        $(this).hide();
        $(this).next('.choose').show();
    })
    $('.choose li').click(function(e){
        e.preventDefault();
        var nam = $(this).attr('class');
        if(localStorage.getItem("themeName")){
            localStorage.removeItem("themeName");
        }
        localStorage.setItem("themeName", nam);

        $('#change_theme').attr('href','../css/themes/'+localStorage.getItem("themeName")+'.min.css');
        $(this).parents('.choose').hide();
        $(this).parents('.choose').siblings('#change-theme').show();
    })

    $('#reportModal').on('show.bs.modal', function (event) {
        $(this).find('.custom-select,.form-control').val('');
    });

    $('#date_picker').each(function(el){
        $(this).datetimepicker({
            format: 'DD/MM/YYYY HH:MM',
            minDate:new Date(),
            maxDate: new Date()
        })
    });

    $('#report_picker1').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#report_picker2').datetimepicker({
        format: 'DD/MM/YYYY',
        useCurrent: false //Important! See issue #1075
    });
    $("#report_picker1").on("dp.change", function (e) {
        $('#report_picker2').data("DateTimePicker").minDate(e.date);
    });
    $("#report_picker2").on("dp.change", function (e) {
        $('#report_picker1').data("DateTimePicker").maxDate(e.date);
    });



    // Display Message
    setTimeout(function(){  
        $('.msg-alert').removeClass('d-block');
    }, 2000);

    $('#data-table').DataTable({
        pageLength: 10
    });


    //User Validation
    if($("#addUser").length)
    {
        uniqueValidation('user_name','user_master','yes','user_id','User name already exists');
    }

    //Company Validation
    if($("#addCompany").length)
    {
        uniqueValidation('company_name','company_master','no','company_id','Company name already exists');

        $('#pincode').rules("add", {
            number: true,
            messages: {
                number: "Please enter valid pincode"
            }
        });
    }

    //Item Validation
    if($("#addItem").length)
    {
        $('#price').rules("add", {
            number: true,
            messages: {
                number: "Please enter valid amount"
            }
        });   

        uniqueValidation('product_name','product_master','yes','product_id','Item name already exists');

        uniqueValidation('product_code','product_master','yes','product_id','Item code already exists');

    }
    
    //Farmer Validation
    if($("#addFarmer").length)
    {
        uniqueValidation('farmer_code','farmer_master','yes','farmer_id','Farmer code already exists');
    }

    //Customer Validation
    if($("#addCustomer").length)
    {
        uniqueValidation('customer_code','customer_master','yes','customer_id','Customer code already exists');
    }

    //Voucher Validation
    if($("#addVoucher").length)
    {
        uniqueValidation('voucher_no','voucher_transaction_detail','yes','voucher_transaction_detail_id','Voucher number already exists');
    }

    //Transaction Validation
    if($("#addTransaction").length)
    {
        uniqueValidation('transaction_code','transaction_master','yes','transaction_id','Transaction code already exists');
    }

} );


/*  Voucher Transcation Details Start*/

    function addTranscation(index){
        
        var checkLength = parseInt($('#checklength').val());
        checkLength++;
        $('#checklength').val(checkLength);
        var CloneDiv = $('#voucherCloneDiv').html().replace(/XXX/g,checkLength).replace(/YYY/g,'');
        $('#voucherTranscationDiv').append(CloneDiv);
        var length = $('.identifyCls').length -1;
        $('.identifyCls').each(function(idx){
            var findInx = $(this).data('size');
            $('#addInx_'+findInx).hide();
            $('#removeInx_'+findInx).hide();
            if( length == idx){
                $('#addInx_'+findInx).show();
            }else{
                $('#removeInx_'+findInx).show(); 
            }
        })
    }

    function removeTranscation(index){
        $("#identifyDiv_"+index).remove();
    }


    function setTrancationName(index){
        var textData = $('#transcationId_'+index+' option:selected').text();
        var textName = textData.split(' - ')[0];
        $('#transactionName_'+index).val(textName);
        console.log(index);
        console.log( $('#transactionName_'+index));
        console.log(textName);
    }
/*  Voucher Transcation Details End*/

/* Common Function Unique Validation Ajax Call  Start*/

function uniqueValidation(filedName,tableName,companyIdcheck,editColumn,message){
    $('#'+filedName).rules("add", {
        remote : {
            url : '../Model/CommonModel.php',
            type : 'post',
            data: {
                validation:'uniqueValidation',
                tableName: tableName,
                companyId: companyIdcheck,
                companyIdValue:  function() {
                    return $( "#companyId" ).val();
                },
                checkColumn : filedName,
                editColumn  : editColumn,
                checkColumnValue: function() {
                    return $( "#"+filedName ).val();
                },
                editColumnValue: function() {
                    return $( "#editId" ).val();
                }
            }
        },
        messages: {
            remote: message
        }
    });
}
/* Unique Validation Ajax Call  End*/