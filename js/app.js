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
        pageName == 'user.php'){
        $('#master-nav a').removeClass('active');
        $('#master-nav').show();
        $('#master-nav a[href="'+pageName+'"]').addClass('active');
    }

    console.log(pageName)

})();