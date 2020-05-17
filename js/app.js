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
} );