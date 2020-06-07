  //Login Validation
  if($("#login").length)
  {
      $("#loginForm").validate({
        rules:{
            userName: 'required',
            password:'required',
        },
        errorPlacement: function (error, element) {
            $(element).parent().append(error)
        },
        submitHandler: function(form) {
            form.submit();
        }

      });
  }


function printFarmerPayment(check){
    if(check == 'printCheck')
        window.print();
        
    window.location = "../View/farmerPayment.php";
}

function printCustomerPayment(check){
    if(check == 'printCheck')
        window.print();
        
    window.location = "../View/customerPayment.php";
}
