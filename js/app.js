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
        pageName == 'farmer-payment.php' ||
        pageName == 'customer-payment.php'){
        $('.sidebar nav ul').hide();
        $('.sidebar nav a').removeClass('active');
        $('#transac-nav').show();
        $('#transac-nav a[href="'+pageName+'"]').addClass('active');
    }

    // console.log(pageName)

})();




$("#addCompany, #addItem, #addFarmer, #addCustomer, #addTransaction, #addUser").validate();

$(document).ready( function () {

    // Display Message
    setTimeout(function(){  
        $('.msg-alert').removeClass('d-block');
    }, 2000);

    $('#data-table').DataTable({
        lengthChange: false
    });
} );