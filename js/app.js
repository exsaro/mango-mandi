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

    // console.log(pageName)

})();




$("#addCompany, #addItem, #addFarmer, #addCustomer, #addTransaction, #addUser,#adminCompany, #addVoucher,#addPurchase, #addPayment, #printReport").validate();

$(document).ready( function () {

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
        $.extend($.validator.messages, 
        { 
            remote:"User name already exists",
        }); 

        $('#user_name').rules("add", {
            remote : {
                url : '../Model/CommonModel.php',
                type : 'post',
                data: {
                    validation:'uniqueValidation',
                    tableName: 'user_master',
                    companyId: 'yes',
                    companyIdValue:  function() {
                        return $( "#companyId" ).val();
                    },
                    checkColumn:'user_name',
                    editColumn:'user_id',
                    checkColumnValue: function() {
                        return $( "#user_name" ).val();
                    },
                    editColumnValue: function() {
                        return $( "#editId" ).val();
                    }
                }
            }
        });
    }

    //Company Validation
    if($("#addCompany").length)
    {
        $('#pincode').rules("add", {
            number: true
        });
        $.extend($.validator.messages, 
            { 
                remote:"Company name already exists",
            });     
    
            $('#company_name').rules("add", {
                remote : {
                    url : '../Model/CommonModel.php',
                    type : 'post',
                    data: {
                        validation:'uniqueValidation',
                        tableName: 'company_master',
                        companyId: 'no',
                        checkColumn:'company_name',
                        editColumn:'company_id',
                        checkColumnValue: function() {
                            return $( "#company_name" ).val();
                        },
                        editColumnValue: function() {
                            return $( "#editId" ).val();
                        }
                    }
                }
            });
    }

    //Item Validation
    if($("#addItem").length)
    {
        $('#price').rules("add", {
            number: true
        });
        $.extend($.validator.messages, 
        { 
            number:"Please enter a valid amount"
        });     

        $('#product_name').rules("add", {
            remote : {
                url : '../Model/CommonModel.php',
                type : 'post',
                data: {
                    validation:'uniqueValidation',
                    tableName: 'product_master',
                    companyId: 'yes',
                    companyIdValue:  function() {
                        return $( "#companyId" ).val();
                    },
                    checkColumn:'product_name',
                    editColumn:'product_id',
                    checkColumnValue: function() {
                        return $( "#product_name" ).val();
                    },
                    editColumnValue: function() {
                        return $( "#editId" ).val();
                    }
                }
            },
            messages: {
                remote: "Item name already exists"
            }
        });


        $('#product_code').rules("add", {
            remote : {
                url : '../Model/CommonModel.php',
                type : 'post',
                data: {
                    validation:'uniqueValidation',
                    tableName: 'product_master',
                    companyId: 'yes',
                    companyIdValue:  function() {
                        return $( "#companyId" ).val();
                    },
                    checkColumn:'product_code',
                    editColumn:'product_id',
                    checkColumnValue: function() {
                        return $( "#product_code" ).val();
                    },
                    editColumnValue: function() {
                        return $( "#editId" ).val();
                    }
                }
            },
            messages: {
                remote: "Item code already exists"
            }
        });
    }
    
    //Farmer Validation
    if($("#addFarmer").length)
    {
        $('#farmer_code').rules("add", {
            remote : {
                url : '../Model/CommonModel.php',
                type : 'post',
                data: {
                    validation:'uniqueValidation',
                    tableName: 'farmer_master',
                    companyId: 'yes',
                    companyIdValue:  function() {
                        return $( "#companyId" ).val();
                    },
                    checkColumn:'farmer_code',
                    editColumn:'farmer_id',
                    checkColumnValue: function() {
                        return $( "#farmer_code" ).val();
                    },
                    editColumnValue: function() {
                        return $( "#editId" ).val();
                    }
                }
            },
            messages: {
                remote: "Farmer code already exists"
            }
        });
    }

    //Customer Validation
    if($("#addCustomer").length)
    {
        $('#customer_code').rules("add", {
            remote : {
                url : '../Model/CommonModel.php',
                type : 'post',
                data: {
                    validation:'uniqueValidation',
                    tableName: 'customer_master',
                    companyId: 'yes',
                    companyIdValue:  function() {
                        return $( "#companyId" ).val();
                    },
                    checkColumn:'customer_code',
                    editColumn:'customer_id',
                    checkColumnValue: function() {
                        return $( "#customer_code" ).val();
                    },
                    editColumnValue: function() {
                        return $( "#editId" ).val();
                    }
                }
            },
            messages: {
                remote: "Customer code already exists"
            }
        });
    }

    //Transaction Validation
    if($("#addTransaction").length)
    {
        $('#transaction_code').rules("add", {
            remote : {
                url : '../Model/CommonModel.php',
                type : 'post',
                data: {
                    validation:'uniqueValidation',
                    tableName: 'transaction_master',
                    companyId: 'yes',
                    companyIdValue:  function() {
                        return $( "#companyId" ).val();
                    },
                    checkColumn:'transaction_code',
                    editColumn:'transaction_id',
                    checkColumnValue: function() {
                        return $( "#transaction_code" ).val();
                    },
                    editColumnValue: function() {
                        return $( "#editId" ).val();
                    }
                }
            },
            messages: {
                remote: "Transaction code already exists"
            }
        });
    }

} );


